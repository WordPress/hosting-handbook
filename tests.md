# PHPUnit Tests

## What is it

### Runner

Hosting companies can have hundreds of websites hosted with WordPress, so it's important to make sure your configuration is as compatible as possible with the software.

To verify this compatibility, the [WordPress Hosting Community team](https://make.wordpress.org/hosting/) provides a series of [PHPUnit](https://phpunit.de/) tests with which to check the operation of WordPress in any environment.

### Reporter

Something here...

## Setting up on hosting systems

### Local Environment Recommendations

Something here...

### Travis, Circle or other CI

Something here...

## Try the PHPUnit Test Runner

### Requirements

It takes little to make the tests. The first thing is to have an infrastructure with the usual configuration of your system. On the other hand, a database where you can test (as it will be created and destroyed).

### Installing the phpunit-test-runner (manual testing)

The phpunit-test-runner is a small test piece of PHPUnit specifically designed for hosting companies. There is a [whole documentation about this tool](https://make.wordpress.org/hosting/test-results-getting-started/). Also, if you want, you can make your test results appear in the [Host Test Results page](https://make.wordpress.org/hosting/test-results/) of WordPress.

The tool can be run manually or through an automated system like Travis. To see how it works and the purpose of this document, we will run the tests manually.

#### Installing the test

The first thing we'll do is download and synchronize the tool.

```bash
cd /tmp/
git clone https://github.com/WordPress/phpunit-test-runner.git
cd phpunit-test-runner/
```

The next step will be to configure the environment. To do this, first we'll make a copy of the example file and then we'll configure it.

```bash
cp .env.default .env
vim .env
```

The content (in summary form) can be something like this:

```php
export WPT_PREPARE_DIR=/tmp/wordpress
export WPT_TEST_DIR=/tmp/wordpress
export WPT_REPORT_API_KEY=
export WPT_REPORT_URL=
export WPT_DB_NAME=wordpress
export WPT_DB_USER=wordpress
export WPT_DB_PASSWORD=__PASSWORD__
export WPT_DB_HOST=localhost
export WPT_TABLE_PREFIX=${WPT_TABLE_PREFIX-wptests_}
export WPT_PHP_EXECUTABLE=${WPT_PHP_EXECUTABLE-php}
WPT_PHPUNIT_CMD=
WPT_RM_TEST_DIR_CMD=
export WPT_SSH_CONNECT=
export WPT_SSH_OPTIONS=
export WPT_SSH_PRIVATE_KEY_BASE64=
```

We will configure the folder where the WordPress software downloads and the database accesses will be made in order to prepare the tests.

#### Preparing the environment

Before we do the first test, we'll catch up on everything. This process can be run before each test in this environment if we want to keep it up to date, although it will depend more if it is in a production environment.

```bash
cd /tmp/phpunit-test-runner/
git pull
npm update
source .env
```

#### **Preparing the test**

Now that we have the environment ready, we can run the test preparation.

```bash
cd /tmp/phpunit-test-runner/
php prepare.php
```

The system will run a long series of installations, configurations and compilations of different elements in order to prepare the test. If warnings and warnings come out you should not worry too much, as it is quite normal. At the end of the process it will warn you if it needs something it doesn't have. In principle, there should be something like this:

```
Done.
Replacing variables in wp-tests-config.php
Success: Prepared environment.
```

If the environment has been prepared, the next step is to make a first test.

#### Running the test

Now that we have the environment ready, let's go get the test. To do this we will execute the file that will perform it.

```bash
cd /tmp/phpunit-test-runner/
php test.php
```

What do the symbols mean?

`.` → Each dot means that the test has been passed correctly.

`S` → It means the test has been skipped. This is usually because these tests are only valid in certain configurations.

`F` → Means that the test has failed. Information about why this happened is displayed at the end.

`E` → It means that the test has failed due to a PHP error, which can be an error, warning or notice.

`I` → Means that the test has been marked as incomplete.

If you have followed all the steps up to this point it is very likely that the test you have run will fail quite a bit (for example, because by default it will not be able to do image processing). But that's OK, as I said, this is an example to check and verify the operation.

#### Creating a report

Even if the test has failed, we can generate the report and (if necessary) send it. But first things first, which is the creation of the reports. To do this we will execute the file that does it.

```bash
cd /tmp/phpunit-test-runner/
php report.php
```

This system will generate the two files that are sent as reports.

In the first one we can see the information about our environment.

```bash
cat /tmp/wordpress/env.json
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

As you can see, among the most important elements are the extensions that are commonly used in WordPress and some utilities that are also generally useful.

The other file is the one that includes all the tests that are made (more than 10,000) giving information of the time that they take to be executed, problems that have arisen...

```bash
cat /tmp/wordpress/junit.xml
```

#### Cleaning up the environment for other tests

Now that we have the tests working, all that remains is to delete all the files that have been created so that we can start over. To do this we will execute the following command:

```bash
cd /tmp/phpunit-test-runner/
php cleanup.php
```

#### Improving the configuration

We must not forget that the aim of this tool is to verify that our environment and infrastructure is the optimal one for WordPress to work, so, following the example above, we could make several improvements such as installing the extension of bcmath, gd, libsodium, mcrypt, mod_xml and imagick or utilities such as ghostscript and imagemagick.

The goal? To be error free and have the green light for the perfect configuration.

## How to report: Creating your bot for WordPress.org

If you want your test [results to appear on the WordPress.org page](https://make.wordpress.org/hosting/test-results/), you can create a user for that.

The first thing to do is [create a user on WordPress.org](https://login.wordpress.org/register). If your company is called *ExampleHostingCompany, Inc*, for example, you can call your users something like examplehostingcmpanybot. Keep in mind that the associated email account should be checked frequently, as emails will arrive regarding the possible operation of the tests.

Create [an issue on the test page](https://github.com/WordPress/phpunit-test-runner/issues/new) asking to include the bot in the results page as a "Test Reporter", indicating the email account you used with that user.

Once the user has been created in the system you will be given access to a password so that you can configure the system to send the information automatically. You will have to go to Users -> Your Profile and there generate the application password. Later you can modify the environment constant with something similar to `export WPT_REPORT_API_KEY='somoshostingbot:ABCD 1234 abcd 4567 EFGH efgh'`.

