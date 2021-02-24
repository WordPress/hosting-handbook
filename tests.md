# Tests

The WordPress Hosting Team provides tools for hosting companies to run the WordPress automated tests on their infrastructure to improve compatibility with WordPress. These results can be published them on the [Host Test Result information page](https://make.wordpress.org/hosting/test-results/), to help WordPress' compatibility with hosts as well.

It consists of two tools: the Runner is the part that runs core's PHPUnit tests on a host and optionally [sends the information to the results page](https://make.wordpress.org/hosting/test-results/); and the Reporter which is the plugin that [works on the hosting page](https://make.wordpress.org/hosting/) and shows the results.

## What is it

### Runner

Hosting companies can have several to millions of websites hosted with WordPress, so it's important to make sure their configuration is as compatible as possible with the software.

To verify this compatibility, the WordPress Community provides a series of [PHPUnit](https://phpunit.de/) tests with which to check the operation of WordPress in any environment.

### Reporter

The Runner tests generates a report with the test results related to a bot user (a hosting company), and this captures and displays those test results at the [Host Test Result](https://make.wordpress.org/hosting/test-results/) page.

## Try the PHPUnit Test Runner

### What's the phpunit-test-runner

The [phpunit-test-runner](https://github.com/WordPress/phpunit-test-runner) is a tool designed to make it easier for hosting companies to run the WordPress project's automated tests.

There is a [whole documentation about this tool](https://make.wordpress.org/hosting/test-results-getting-started/). Also, if you want, you can make your test results appear in the [Host Test Results page](https://make.wordpress.org/hosting/test-results/) of WordPress.

The tool can be run manually or through an automated system like Travis. To see how it works and the purpose of this document, will be shown how to run the tests manually.

### Requirements

To use the Runner, the following is required:
* A server / hosting (infrastructure) with the usual configuration you have.
* A database where you can test (it will be created and destroyed several times)

### Installing the Runner

First, download the software. This example use `/home/wptestrunner/` folder, but set the best for this environment.

```bash
cd /home/wptestrunner/
git clone https://github.com/WordPress/phpunit-test-runner.git
cd phpunit-test-runner/
```
The next step will be to configure the environment. To do this, make a copy of the example file and then configure it.

```bash
cp .env.default .env
vim .env
```
The content (in summary form) can be something like this:

```bash
# Path to the directory where files can be prepared before being delivered to the environment.
export WPT_PREPARE_DIR=/home/wptestrunner/wordpress

# Path to the directory where the WordPress develop checkout can be placed and tests can be run. When running tests in the same environment, set WPT_TEST_DIR to WPT_PREPARE_DIR
export WPT_TEST_DIR=$WPT_PREPARE_DIR

# API key to authenticate with the reporting service in 'username:password' format. Check the "Creating your bot" section on how to get your authentication.
export WPT_REPORT_API_KEY=
#export WPT_REPORT_API_KEY=examplehostingcompanybot:XXXX XXXX XXXX XXXX

# (Optionally) define an alternate reporting URL
export WPT_REPORT_URL=

# Credentials for a database that can be written to and reset. WARNING!!! This database will be destroyed between tests. Only use safe database credentials.
export WPT_DB_NAME=wordpress
export WPT_DB_USER=wordpress
export WPT_DB_PASSWORD=__PASSWORD__
export WPT_DB_HOST=localhost

# (Optionally) set a custom table prefix to permit concurrency against the same database.
export WPT_TABLE_PREFIX=${WPT_TABLE_PREFIX-wptests_}

# (Optionally) define the PHP executable to be called
export WPT_PHP_EXECUTABLE=${WPT_PHP_EXECUTABLE-php}

# (Optionally) define the PHPUnit command execution call. Use if `php phpunit.phar` can't be called directly for some reason.
export WPT_PHPUNIT_CMD=

# (Optionally) define the command execution to remove the test directory. Use if `rm -r` can't be called directly for some reason.
export WPT_RM_TEST_DIR_CMD=

# SSH connection string (can also be an alias). Leave empty if tests are meant to run in the same environment.
export WPT_SSH_CONNECT=

# Any options to be passed to the SSH connection. Defaults to '-o StrictHostKeyChecking=no'
export WPT_SSH_OPTIONS=

# SSH private key, base64 encoded.
export WPT_SSH_PRIVATE_KEY_BASE64=

# Output logging. Use 'verbose' to increase verbosity
export WPT_DEBUG=
```

Configure the folder where the WordPress software downloads and the database accesses will be made in order to prepare the tests.

### Preparing the environment

Before performing the first test, let's update all the components. This process can be run before each test in this environment if wanted to keep it up to date, although it will depend more if it is in a production environment.

```bash
cd /home/wptestrunner/phpunit-test-runner/
git pull
source .env
```

### Preparing the test

Now there is the environment ready, run the test preparation.

```bash
php prepare.php
```

The system will run a long series of installations, configurations and compilations of different elements in order to prepare the test. If warnings and warnings come out you should not worry too much, as it is quite normal. At the end of the process it will warn you if it needs something it doesn't have. If it works, you should see something like this at the end:

```
Done.
Replacing variables in wp-tests-config.php
Success: Prepared environment.
```

Now that the environment has been prepared, the next step is to run the tests for the first time.

\[info\]The 4 steps have to be executed every time a test is done. The preparation of the environment as well, even if you do not change the configuration.\[/info\]

### Running the test

Now that the environment is ready, let's run the tests. To do this, execute the file that will perform it.

```bash
php test.php
```

What do the symbols mean?

`.` → Each dot means that the test has been passed correctly.

`S` → It means the test has been skipped. This is usually because these tests are only valid in certain configurations.

`F` → Means that the test has failed. Information about why this happened is displayed at the end.

`E` → It means that the test has failed due to a PHP error, which can be an error, warning or notice.

`I` → Means that the test has been marked as incomplete.

If you follow these steps, everything should work perfectly and not make any mistakes. In case you get any error, it may be normal due to some missing adjustment or extension of PHP, among others. We recommend that you adjust the configuration until it works correctly. After all, this tool is to help you improve the optimal configuration for WordPress in that infrastructure.

### Creating a report

Even if the test has failed, a report will be made. The first one shows the information about our environment. Among the most important elements are the extensions that are commonly used in WordPress and some utilities that are also generally useful.

```bash
cat /home/wptestrunner/wordpress/env.json
```

The content of this file is somewhat similar to this:

```json
{
  "php_version": "7.4.5",
  "php_modules": {
    "bcmath": false,
    "curl": "7.4.5",
    "filter": "7.4.5",
    "gd": false,
    "libsodium": false,
    "mcrypt": false,
    "mod_xml": false,
    "mysqli": "7.4.5",
    "imagick": false,
    "pcre": "7.4.5",
    "xml": "7.4.5",
    "xmlreader": "7.4.5",
    "zlib": "7.4.5"
  },
  "system_utils": {
    "curl": "7.58.0 (x86_64-pc-linux-gnu) libcurl\/7.58.0 OpenSSL\/1.1.1g zlib\/1.2.11 libidn2\/2.3.0 libpsl\/0.19.1 (+libidn2\/2.0.4) nghttp2\/1.30.0 librtmp\/2.3",
    "ghostscript": "",
    "imagemagick": false,
    "openssl": "1.1.1g 21 Apr 2020"
  },
  "mysql_version": "mysql Ver 15.1 Distrib 10.4.12-MariaDB, for debian-linux-gnu (x86_64) using readline 5.2",
  "os_name": "Linux",
  "os_version": "4.15.0-20-generic"
}
```

In addition to this report, a definitive file with all the information of what happened in the tests. This is the one that includes all the tests that are made (more than 10,000) giving information of the time that they take to be executed, problems that have arisen...

```bash
cat /home/wptestrunner/wordpress/junit.xml
```

At this point we can generate the reports by sending them to WordPress.org, if necessary. Even if you haven't included the WordPress user (see below for how to create it), you can still run this file.

```bash
php report.php
```

### Cleaning up the environment for other tests

Having the tests working, all that remains is to delete all the files that have been created so that we can start over. To do this, execute the following command:

```bash
php cleanup.php
```

### Automating the execution

Once this first manual test has been done, please automate all these steps in a script, since it is required that each of these steps is executed sequentially for each test execution.

This script should be run every time there is a change / commit in the WordPress master. Many hosting companies use a cron to run the script every few hours / days to make the appropriate checks, or when a change is made.

### Improving the configuration

Do not forget that the aim of this tool is to verify that the environment and infrastructure is the optimal one for WordPress to work, so, following the example, could make several improvements such as installing the extension of `bcmath`, `gd`, `libsodium`, `mcrypt`, `mod_xml` and `imagick` or utilities such as `ghostscript` and `imagemagick`.

The goal? To be error free and have the green light for the perfect configuration.

\[alert\]Some tests may be skipped or there may be tests with some risk. It is normal for errors to occur even with a properly configured environment.\[/alert\]

## How to report: Creating your bot for WordPress.org

If you / your company want the test [results to appear on the WordPress.org page](https://make.wordpress.org/hosting/test-results/), create a user for that.

The first thing to do is [create a user on WordPress.org](https://login.wordpress.org/register). If your company is called *ExampleHostingCompany, Inc*, for example, call your user something like *examplehostingcompanybot*. Keep in mind that the associated email account should be checked frequently, as emails will arrive regarding the possible operation of the tests.

Create [an issue on the test page](https://github.com/WordPress/phpunit-test-runner/issues/new) asking to include the bot in the results page as a *Test Reporter*, indicating the email account you used with that user.

\[tip\]The avatar of this user must be your company's logo, and the name and URL must make clear which company it is.\[/tip\]

\[info\]Someone in the hosting team will review the request and add a user for you, or request additional information. The team will reply as quickly as possible, but as this step is manual, please be patient.\[/info\]

Once the user has been created in the system, you'll get an invitation to join via email. Then, you can log into make/hosting and create an Application Password in Users -> Your Profile.

To get things reporting properly, place the username for the bot, along with the application password in the .env file, which will look something like this: `export WPT_REPORT_API_KEY='examplehostingcompanybot:ABCD 1234 abcd 4567 EFGH efgh'`.

\[info\]If you’re interested in improving this handbook, check the [Github Handbook repo](https://github.com/WordPress/hosting-handbook/), or leave a message in the [#hosting-community channel](https://wordpress.slack.com/archives/hosting-community/) of the official [WordPress Slack](https://make.wordpress.org/chat/).\[/info\]

## Changelog

- 2021-02-17: Changelog added.
- 2021-02-10: Published from Github.
