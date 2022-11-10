<?php

namespace WP_CLI\Hosting_Handbook;

use WP_CLI;
use Mustache_Engine;
use WP_CLI\Utils;

/**
 * WP-CLI commands to generate docs from the codebase.
 */

define( 'HOSTING_HANDBOOK_PATH', dirname( dirname( __FILE__ ) ) );

/**
 * @when before_wp_load
 */
class Command {

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
	 * @subcommand gen-hb-manifest
	 */
	public function gen_hb_manifest() {
		$manifest = array();
		// Top-level pages
		foreach( glob( HOSTING_HANDBOOK_PATH . '/*.md' ) as $file ) {
			$slug = basename( $file, '.md' );
			if ( 'README' === $slug || 'CODE_OF_CONDUCT' === $slug || 'CONTRIBUTING' === $slug ) {
				continue;
			}
			$title = '';
			$contents = file_get_contents( $file );
			if ( preg_match( '/^#\s(.+)/', $contents, $matches ) ) {
				$title = $matches[1];
			}
			$manifest[ $slug ] = array(
				'title'           => $title,
				'slug'            => 'index' === $slug ? 'handbook' : $slug,
				'markdown_source' => sprintf( 'https://github.com/wordpress/hosting-handbook/blob/main/%s.md', $slug ),
				'parent'          => null,
			);
		}
		file_put_contents( HOSTING_HANDBOOK_PATH . '/bin/handbook-manifest.json', json_encode( $manifest, JSON_PRETTY_PRINT ) );
		WP_CLI::success( 'Generated bin/handbook-manifest.json' );
	}
}

WP_CLI::add_command( 'hosting-handbook', '\WP_CLI\Hosting_Handbook\Command' );
