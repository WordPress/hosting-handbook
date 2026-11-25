<?php

namespace WP_CLI\Hosting_Handbook;

use WP_CLI;

/**
 * WP-CLI commands to generate docs from the codebase.
 */

define( 'HOSTING_HANDBOOK_PATH', dirname( dirname( __FILE__ ) ) );

/**
 * @when before_wp_load
 */
class Command {

	/**
	 * Top-level Markdown files that are not handbook pages.
	 */
	const IGNORED_FILES = array( 'README', 'CODE_OF_CONDUCT', 'CONTRIBUTING' );

	/**
	 * Top-level directories that never contain handbook pages.
	 */
	const IGNORED_DIRS = array( '.git', '.github', 'assets', 'bin', 'node_modules', 'vendor' );

	/**
	 * Regenerates all doc pages.
	 *
	 * ## OPTIONS
	 *
	 * [--verbose]
	 * : If set will list command pages as they are generated.
	 *
	 * @subcommand gen-all
	 */
	public function gen_all( $args, $assoc_args ) {
		// Warn if not invoked with null WP_CLI_CONFIG_PATH.
		if ( '/dev/null' !== getenv( 'WP_CLI_CONFIG_PATH' ) ) {
			WP_CLI::warning( "Should be invoked on the target WP-CLI with 'WP_CLI_CONFIG_PATH=/dev/null'." );
		}

		self::gen_hb_manifest();
		WP_CLI::success( 'Generated all doc pages.' );
	}

	/**
	 * Generates a manifest document of all handbook pages.
	 *
	 * Pages are discovered in the repository root and in its sub-directories
	 * (for example `version/`). Titles are taken from the `# Heading` on the
	 * first line of each file. The `slug`, `parent` and `order` values of
	 * pages already in the manifest are preserved, so the curated handbook
	 * hierarchy is not lost when the manifest is regenerated. New pages are
	 * appended with the file name as their slug (the directory name for a
	 * sub-directory's `index.md`) and the next free `order` under their
	 * parent; pages whose files were deleted are removed.
	 *
	 * @subcommand gen-hb-manifest
	 */
	public function gen_hb_manifest() {
		$manifest_file = HOSTING_HANDBOOK_PATH . '/bin/handbook-manifest.json';
		$existing      = self::read_manifest( $manifest_file );

		$pages   = array();
		$sources = array();
		foreach ( self::find_pages() as $relative_path => $page ) {
			$key = $page['key'];
			if ( isset( $sources[ $key ] ) ) {
				WP_CLI::error( sprintf( "Duplicate manifest key '%s' for %s and %s.", $key, $sources[ $key ], $relative_path ) );
			}
			$sources[ $key ] = $relative_path;

			if ( '' === $page['title'] ) {
				WP_CLI::warning( sprintf( "No '# Heading' on the first line of %s; its title is empty.", $relative_path ) );
			}

			$entry = array(
				'title'           => $page['title'],
				'slug'            => $page['slug'],
				'markdown_source' => sprintf( 'https://github.com/wordpress/hosting-handbook/blob/main/%s', $relative_path ),
				'parent'          => $page['parent'],
			);

			if ( isset( $existing[ $key ] ) && is_array( $existing[ $key ] ) ) {
				// Keep the hand-maintained values of existing pages. The title is
				// always refreshed from the page heading, as before.
				foreach ( array( 'slug', 'parent', 'order' ) as $field ) {
					if ( array_key_exists( $field, $existing[ $key ] ) ) {
						$entry[ $field ] = $existing[ $key ][ $field ];
					}
				}
			}

			$pages[ $key ] = $entry;
		}

		// Keep the existing page order, then append any new pages.
		$manifest = array();
		foreach ( array_keys( $existing ) as $key ) {
			if ( isset( $pages[ $key ] ) ) {
				$manifest[ $key ] = $pages[ $key ];
				unset( $pages[ $key ] );
			}
		}

		// New pages get the next free `order` among their siblings, so the
		// importer always has one. Slug and order can then be adjusted by hand.
		$added = array();
		foreach ( $pages as $key => $entry ) {
			$entry['order']   = self::next_order( $manifest, $entry['parent'] );
			$manifest[ $key ] = $entry;
			$added[]          = sprintf( '%s (slug: %s, parent: %s, order: %d)', $sources[ $key ], $entry['slug'], null === $entry['parent'] ? 'null' : $entry['parent'], $entry['order'] );
		}
		if ( $added ) {
			WP_CLI::warning( sprintf( "Added %d new page(s) to the manifest. Review their slug and order by hand:\n  - %s", count( $added ), implode( "\n  - ", $added ) ) );
		}

		// Pages whose files no longer exist are dropped from the manifest.
		$removed = array_keys( array_diff_key( $existing, $sources ) );
		if ( $removed ) {
			WP_CLI::warning( sprintf( "Removed %d page(s) whose files no longer exist:\n  - %s", count( $removed ), implode( "\n  - ", $removed ) ) );
		}

		// The importer looks up each parent by its manifest key, so a missing
		// parent (e.g. a sub-directory without an index.md) breaks the import.
		foreach ( $manifest as $key => $entry ) {
			if ( null !== $entry['parent'] && ! isset( $manifest[ $entry['parent'] ] ) ) {
				WP_CLI::warning( sprintf( "Parent '%s' of %s is not in the manifest.", $entry['parent'], $sources[ $key ] ) );
			}
		}

		$json = json_encode( $manifest, JSON_PRETTY_PRINT );
		if ( false === $json ) {
			WP_CLI::error( sprintf( 'Unable to encode the manifest as JSON: %s', json_last_error_msg() ) );
		}

		// Match the two-space indentation used by the committed manifest.
		$json = preg_replace_callback(
			'/^(?: {4})+/m',
			function ( $matches ) {
				return str_repeat( '  ', strlen( $matches[0] ) / 4 );
			},
			$json
		);

		// .editorconfig sets insert_final_newline = true.
		$json .= "\n";

		if ( false === file_put_contents( $manifest_file, $json ) ) {
			WP_CLI::error( 'Unable to write bin/handbook-manifest.json' );
		}
		WP_CLI::success( 'Generated bin/handbook-manifest.json' );
	}

	/**
	 * Gets the next free `order` value among pages with the same parent.
	 *
	 * @param array       $manifest Entries added so far.
	 * @param string|null $parent   Parent of the new page.
	 * @return int One more than the highest sibling order, or 1 if there are no siblings.
	 */
	private static function next_order( $manifest, $parent ) {
		$max = 0;
		foreach ( $manifest as $entry ) {
			if ( $entry['parent'] === $parent && isset( $entry['order'] ) && $entry['order'] > $max ) {
				$max = $entry['order'];
			}
		}
		return (int) $max + 1;
	}

	/**
	 * Reads the existing manifest, if there is one.
	 *
	 * @param string $manifest_file Absolute path to the manifest.
	 * @return array Manifest entries keyed by page.
	 */
	private static function read_manifest( $manifest_file ) {
		if ( ! file_exists( $manifest_file ) ) {
			return array();
		}

		$contents = file_get_contents( $manifest_file );
		if ( false === $contents ) {
			WP_CLI::error( 'Unable to read bin/handbook-manifest.json' );
		}

		$manifest = json_decode( $contents, true );
		if ( ! is_array( $manifest ) ) {
			WP_CLI::error( sprintf( 'bin/handbook-manifest.json is not valid JSON (%s); fix or remove it before regenerating.', json_last_error_msg() ) );
		}

		return $manifest;
	}

	/**
	 * Finds all handbook pages.
	 *
	 * @return array Page data keyed by the file path relative to the repository root.
	 */
	private static function find_pages() {
		$pages = array();

		// Top-level pages.
		$top_files = glob( HOSTING_HANDBOOK_PATH . '/*.md' );
		if ( false === $top_files ) {
			WP_CLI::error( 'Unable to read markdown files in the handbook repository.' );
		}
		foreach ( $top_files as $file ) {
			$slug = basename( $file, '.md' );
			if ( in_array( $slug, self::IGNORED_FILES, true ) ) {
				continue;
			}
			$pages[ $slug . '.md' ] = array(
				'key'    => $slug,
				'title'  => self::get_title( $file ),
				'slug'   => 'index' === $slug ? 'handbook' : $slug,
				'parent' => null,
			);
		}

		// Pages in sub-directories, e.g. version/index.md and version/7-0-compatibility.md.
		$dirs = glob( HOSTING_HANDBOOK_PATH . '/*', GLOB_ONLYDIR );
		if ( false === $dirs ) {
			WP_CLI::error( 'Unable to read directories in the handbook repository.' );
		}
		foreach ( $dirs as $dir ) {
			$dir_name = basename( $dir );
			if ( in_array( $dir_name, self::IGNORED_DIRS, true ) ) {
				continue;
			}
			if ( ! is_readable( $dir ) ) {
				WP_CLI::error( sprintf( 'Unable to read directory %s', $dir ) );
			}
			$files = glob( $dir . '/*.md' );
			if ( false === $files ) {
				WP_CLI::error( sprintf( 'Unable to read directory %s', $dir ) );
			}
			// List index.md first, so a new directory's parent page comes before its children in the manifest.
			$index = $dir . '/index.md';
			if ( in_array( $index, $files, true ) ) {
				$files = array_merge( array( $index ), array_diff( $files, array( $index ) ) );
			}
			foreach ( $files as $file ) {
				$slug     = basename( $file, '.md' );
				$is_index = 'index' === $slug;

				$pages[ $dir_name . '/' . $slug . '.md' ] = array(
					'key'    => $is_index ? $dir_name : $slug,
					'title'  => self::get_title( $file ),
					'slug'   => $is_index ? $dir_name : $slug,
					'parent' => $is_index ? null : $dir_name,
				);
			}
		}

		return $pages;
	}

	/**
	 * Gets a page title from the `# Heading` on the first line of a Markdown file.
	 *
	 * @param string $file Absolute path to the Markdown file.
	 * @return string Page title, or an empty string if none is found.
	 */
	private static function get_title( $file ) {
		$contents = file_get_contents( $file );
		if ( false === $contents ) {
			WP_CLI::error( sprintf( 'Unable to read %s', $file ) );
		}

		// Stop before any "\r" so Windows (CRLF) checkouts do not leak it into the title.
		if ( preg_match( '/\A(?:\xEF\xBB\xBF)?#[ \t]+([^\r\n]+)/', $contents, $matches ) ) {
			return trim( $matches[1] );
		}

		return '';
	}
}

WP_CLI::add_command( 'hosting-handbook', '\WP_CLI\Hosting_Handbook\Command' );
