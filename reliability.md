# Reliability

Once your site is up, how do you keep it that way? And what can you do if it goes down? In most cases, the same best practices apply to WordPress as with other web applications, but some differences and recommendations are detailed here.

## Backups

Your WordPress database contains every post, every comment and every link you have on your blog. If your database gets erased or corrupted, you stand to lose everything you have written. There are many reasons why this could happen, and not all are things you can control. With a proper backup of your WordPress database and files, you can quickly restore things back to normal.

Site backups are essential because problems inevitably occur and you need to be in a position to take action when disaster strikes. Spending a few minutes to make an easy, convenient backup of your database will allow you to spend even more time being creative and productive with your website.

_Note: Want to skip the hard stuff? Skip to automated solutions such as [WordPress Plugins](https://wordpress.org/plugins/search.php?q=backup) for backups._

### Backup questions

_Back up your database regularly, and always before an upgrade._

**How often should you back up?**

That depends on how often you blog, how often you want to do this, and how you would feel if your database were lost along with a few posts. It is your decision. General suggestion when backups should be made:

 - For smaller websites with fewer posts, backups should be made once a week.
 - For high-activity websites with a lot of posts, backups should be made daily.

**Can you use this method to back up other data?**

Yes. Backups are good all around.

**How many backups should I keep?**

You should keep at least 3–5 recent WordPress backups to stay safe from data loss, with copies stored in different locations — for example, one on your hosting server, one on cloud storage (Google Drive, Dropbox, etc.), and one downloaded to your local computer. This way, even if one backup fails or is lost, you'll always have a reliable version to restore your website.

**Can backups be automated?**

Yes. There are several methods of automating the backup process available, and we've listed some in [Automatic backups](#automatic-backups). However, it is highly recommended that you back up those auto backups with a manual backup once in a while to guarantee that the process is working.

### Database and files: why both are needed

There are two parts to backing up your WordPress site: **Database** and **Files**. You need both to be able to fully restore a typical WordPress site.

It is common to wonder whether “backing up the files” also backs up the database. In a typical WordPress setup, the answer is **no**:

- **WordPress files** are the files in your WordPress directory on the web server (WordPress core, themes, plugins, uploads, `wp-config.php`, `.htaccess`, etc.).
- **The WordPress database** is stored in a separate database system (usually MySQL/MariaDB). You usually **cannot** back it up by downloading your WordPress directory, because the database lives outside of it.

When you “back up the database” you usually create an **export/dump file** (for example, a `.sql`, `.gz`, or `.bz2` file). That exported file *is* a file and you can store it alongside your file backups — but restoring still requires importing it back into MySQL/MariaDB.

Your WordPress site consists of the following:

1. WordPress Core installation
2. WordPress plugins
3. WordPress themes
4. Images and files
5. JavaScript, PHP, and other code files
6. Additional files and static web pages

All of these are used in various combinations to generate your website. The database contains your posts and a lot of data generated on your site, but it does not include the above elements that all come together to create the look and information on your site. These need to be saved.

### Recommended backup and restore order

To keep backups consistent, it helps to treat the **files + database** as one “backup set” (for example, both created around the same time).

- **Backup (typical order)**:
  - **Back up the database first**, then back up the WordPress files.
  - Optionally store the database export file inside the same backup folder/zip as the file backup, so they stay together.
- **Restore (typical order)**:
  - **Restore the WordPress files first**, then restore/import the database.
  - If you changed database credentials during a migration, update `wp-config.php` to match.

### Backing up your WordPress files

Everything that has anything to do with the look and feel of your site is in a file somewhere and needs to be backed up. Additionally, you must back up all of your files in your WordPress directory (including subdirectories) and your [`.htaccess`](https://wordpress.org/documentation/article/wordpress-glossary/#.htaccess) file.

Most hosts back up the entire server, including your site, but it takes time to request a copy of your site from their backups, and a speedy recovery is critical. It is better that you back up your own files. The easiest method is to use an [FTP program](https://developer.wordpress.org/advanced-administration/upgrade/ftp/) to download all of your WordPress files from your host to your local computer.

By default, the files in the directory called `wp-content` are your own user-generated content, such as edited themes, new plugins, and uploaded files. Pay particular attention to backing up this area, along with your `wp-config.php`, which contains your connection details.

The remaining files are mostly the WordPress Core files, which are supplied by the [WordPress download zip file](https://wordpress.org/download/). Normally, there would be no need to copy the WordPress core files, as you can replace them from a fresh download of the WordPress zip file.

Here are some methods to back up your site files.

**Website host provided backup software**

Most website hosts provide software to back up your site. Check with your host to find out what services and programs they provide.

**Create syncs with your site**

[WinSCP](https://winscp.net/eng/index.php) and other programs allow you to synchronize with your website to keep a mirror copy of the content on your server and hard drive updated. It saves time and makes sure you have the latest files in both places.

To synchronize your files in WinSCP:

1. Log in to your ftp server normally using WinSCP.
2. Press the "Synchronize" button. Remote directory will automatically be set to the current ftp directory (often your root directory). Local directory would be set to the local directory as it was when you pressed Synchronize. You may want to change this to some other directory on your computer. Direction should be set to "local" to copy files FROM your web host TO your machine. Synchronization Mode would be set to Synchronize files.
3. Click "OK" to show a summary of actions.
4. Click "OK" again to complete the synchronization.

**Copy your files to your desktop**

Using [FTP Clients](https://developer.wordpress.org/advanced-administration/upgrade/ftp/) or [UNIX Shell Skills](https://codex.wordpress.org/UNIX_Shell_Skills) you can copy the files to a folder on your computer. Once there, you can compress them into a zip file to save space, allowing you to keep several versions.

Remember, keep at least three backups on file, just in case one is corrupted or lost, and store them in different places and on different mediums (such as CD's, DVDs or hard drives).

### Backing up your database

Back up your WordPress database regularly, and always before an upgrade or a move to a new location. The following information will help you back up your WordPress database using various popular server software packages. For detailed information, contact your website host for more information.

**NOTE:** The steps below back up the WordPress database (posts, pages, comments, settings, etc.) but they do **not** back up your WordPress files (themes, plugins, uploads, `wp-config.php`, etc.). For a full-site backup, see [Backing up your WordPress files](#backing-up-your-wordpress-files).

#### Accessing phpMyAdmin

See [phpMyAdmin](https://developer.wordpress.org/advanced-administration/upgrade/phpmyadmin/) for more information on phpMyAdmin.

While familiarity with phpMyAdmin is not necessary to back up your WordPress database, these instructions should take you step-by-step through the process of finding phpMyAdmin on your server.

##### Plesk

On your Websites & Domains screen, click Open button corresponding to the database you have set up during the [WordPress installation](https://developer.wordpress.org/advanced-administration/before-install/howto-install/). This will open **phpMyAdmin** interface:

![image](https://user-images.githubusercontent.com/8250598/189548052-05143263-7980-45b5-b2dc-23fc5a8b19fd.png)

If you cannot see the **Open** button, make sure to close the **Start creating your website** prompt:

![image](https://user-images.githubusercontent.com/8250598/189548074-703c1d79-a437-445b-8bf7-ac51272b69f8.png)

Click Select Existing Database to find select your WordPress database:

![image](https://user-images.githubusercontent.com/8250598/189548312-c455cf50-757e-4bf7-9128-825e3cb0832c.png)

##### cPanel

On your main control panel for cPanel, look for the MySQL logo and click the link to MySQL Databases. On the next page, look for **phpMyAdmin** link and click it to access your phpMyAdmin.

![image](https://user-images.githubusercontent.com/8250598/189548290-9e815d91-e598-4b31-8bde-3101ac09bd89.png)

![image](https://user-images.githubusercontent.com/8250598/189548157-74dd7be8-ea45-4ee0-90d4-e16f57225d24.png)

##### Direct Admin

From **Your Account** page, look for **MySQL Management** and click it to access **phpMyAdmin**.

![image](https://user-images.githubusercontent.com/8250598/189548174-6951023a-c593-4f46-af78-5bf43a390279.png)

![image](https://user-images.githubusercontent.com/8250598/189548195-4b1ca6c1-0a6d-4191-8060-c90e59696ee3.png)

##### Ensim

Look for the MySQL Admin logo and click the link. Under **Configuration** choose **MySQL Administration Tool**.

![image](https://user-images.githubusercontent.com/8250598/189548260-d911357c-8681-4c27-a1ad-043d7a678c22.png)

![image](https://user-images.githubusercontent.com/8250598/189548265-2a7b7721-10e9-41d7-a150-ab11422c29cd.png)

##### vDeck

From the main control panel, click **Host Manager**, then click **Databases**. In the next window, click **Admin**. Another window will popup taking you to the phpMyAdmin login screen.

![image](https://user-images.githubusercontent.com/8250598/189548348-9f1135eb-4336-4f45-9fe6-8fa482f758d5.png)

![image](https://user-images.githubusercontent.com/8250598/189548353-75778b1a-686c-44a7-ab15-89b49d94e146.png)

##### Ferozo

Login to your Ferozo Control Panel by using your credentials. Once inside, go to the "Base de Datos" ("Data Base") menu and then click on "Acceso phpMyAdmin" ("Access phpMyAdmin"). A new window will open displaying the phpMyAdmin login screen.

![image](https://user-images.githubusercontent.com/8250598/189548372-ebebffc3-9723-4e4f-b478-df0d38499e58.png)

#### Using phpMyAdmin

[phpMyAdmin](https://developer.wordpress.org/advanced-administration/upgrade/phpmyadmin/) is the name of the program used to manipulate your database.

Information below has been tried and tested using phpMyAdmin version 4.4.13 connects to MySQL version 5.6.28 running on Linux.

[![phpmyadmin_top](https://wordpress.org/documentation/files/2018/11/phpmyadmin_top.jpg)](https://wordpress.org/documentation/files/2018/11/phpmyadmin_top.jpg)

##### Quick backup process

When you backup all tables in the WordPress database without compression, you can use simple method. To restore this backup, your new database should not have any tables.

1. Log into phpMyAdmin on your server
2. From the left side window, select your WordPress database. In this example, the name of database is "wp".
3. The right side window will show you all the tables inside your WordPress database. Click the 'Export' tab on the top set of tabs.

[![](https://wordpress.org/documentation/files/2018/11/phpmyadmin_dbtop.jpg)](https://wordpress.org/documentation/files/2018/11/phpmyadmin_dbtop.jpg)

4. Ensure that the Quick option is selected, and click 'Go' and you should be prompted for a file to download. Save the file to your computer. Depending on the database size, this may take a few moments.

[![phpmyadmin_quick_export](https://wordpress.org/documentation/files/2018/11/phpmyadmin_quick_export.jpg)](https://wordpress.org/documentation/files/2018/11/phpmyadmin_quick_export.jpg)

##### Custom backup process

If you want to change default behavior, select Custom backup. In above Step 4, select Custom option. Detailed options are displayed.

[![phpmyadmin_custom_export](https://wordpress.org/documentation/files/2018/11/phpmyadmin_custom_export.jpg)](https://wordpress.org/documentation/files/2018/11/phpmyadmin_custom_export.jpg)

**The Table section**

All the tables in the database are selected. If you have other programs that use the database, then choose only those tables that correspond to your WordPress install. They will be the ones with that start with "wp_" or whatever 'table_prefix' you specified in your 'wp-config.php' file.

If you only have your WordPress blog installed, leave it as is (or click 'Select All' if you changed the selection)

**The Output section**

Select 'zipped' or 'gzipped' from Compression box to compress the data.

[![phpmyadmin_export_output](https://wordpress.org/documentation/files/2018/11/phpmyadmin_export_output.jpg)](https://wordpress.org/documentation/files/2018/11/phpmyadmin_export_output.jpg)

**The Format section**

Ensure that the SQL is selected. Unlike CSV or other data formats, this option exports a sequence of SQL commands.

In the Format-specific options section, leave options as they are.

[![phpmyadmin_export_formatspecific](https://wordpress.org/documentation/files/2018/11/phpmyadmin_export_formatspecific.jpg)](https://wordpress.org/documentation/files/2018/11/phpmyadmin_export_formatspecific.jpg)

**The Object creation options section**

Select Add DROP TABLE / VIEW / PROCEDURE / FUNCTION / EVENT / TRIGGER statement. Before table creation on target database, it will call DROP statement to delete the old existing table if it exist.

Checking "IF NOT EXISTS" prevents errors during restores if the tables are already there.

[![phpmyadmin_export_object](https://wordpress.org/documentation/files/2018/11/phpmyadmin_export_object.jpg)](https://wordpress.org/documentation/files/2018/11/phpmyadmin_export_object.jpg)

**The Data creation options section**

Leave options as they are.

[![phpmyadmin_export_data](https://wordpress.org/documentation/files/2018/11/phpmyadmin_export_data.jpg)](https://wordpress.org/documentation/files/2018/11/phpmyadmin_export_data.jpg)

Now click 'Go' at the bottom of the window and you should be prompted for a file to download. Save the file to your computer. Depending on the database size, this may take a few moments.

**Remember** – you have NOT backed up the files and folders – such as images – but all your posts and comments are now safe.

#### Backup using cPanel X

cPanel is a popular control panel used by many web hosts. The backup feature can be used to backup your MySQL database. Do not generate a full backup, as these are strictly for archival purposes and cannot be restored via cPanel. Look for 'Download a MySQL Database Backup' and click the name of the database. A `*.gz` file will be downloaded to your local drive.

There is no need to unzip this file to restore it. Using the same cPanel program, browse to the gz file and upload it. Once the upload is complete, the bottom of the browser will indicate dump complete. If you are uploading to a new host, you will need to recreate the database user along with the matching password. If you change the password, make the corresponding change in the `wp-config.php` file.

#### Using straight MySQL/MariaDB commands

phpMyAdmin cannot handle large databases so using straight MySQL/MariaDB code will help.

Change your directory to the directory you want to export backup to:

```
user@linux:~> cd files/blog
user@linux:~/files/blog>
```

Use the `mysqldump` command with your MySQL server name, user name and database name. It prompts you to input password (For help, try: `man mysqldump`).

**To backup all database tables**

```
mysqldump --add-drop-table -h mysql_hostserver -u mysql_username -p mysql_databasename
```

Example:

```
user@linux:~/files/blog> mysqldump --add-drop-table -h db01.example.net -u dbocodex -p wp > blog.bak.sql
Enter password: (type password)
```

**Use bzip2 to compress the backup file**

```
user@linux:~/files/blog> bzip2 blog.bak.sql
```

You can do the same thing that above two commands do in one line:

```
user@linux:~/files/blog> mysqldump --add-drop-table -h db01.example.net -u dbocodex -p wp | bzip2 -c > blog.bak.sql.bz2
Enter password: (type password)
```

The `bzip2 -c` after the `|` (pipe) means the backup is compressed on the fly, and the `> blog.bak.sql.bz2` sends the bzip output to a file named `blog.bak.sql.bz2`.

Despite bzip2 being able to compress most files more effectively than the older compression algorithms (.Z, .zip, .gz), it is [considerably slower](https://en.wikipedia.org/wiki/Bzip2) (compression and decompression). If you have a large database to backup, gzip is a faster option to use.

```
user@linux:~/files/blog> mysqldump --add-drop-table -h db01.example.net -u dbocodex -p wp | gzip > blog.bak.sql.gz
```

#### Using MySQL Workbench

[MySQL Workbench](https://dev.mysql.com/downloads/workbench/) (formerly known as My SQL Administrator) is a program for performing administrative operations, such as configuring your MySQL server, monitoring its status and performance, starting and stopping it, managing users and connections, performing backups, restoring backups and a number of other administrative tasks.

You can perform most of those tasks using a command line interface such as that provided by [mysqladmin](https://dev.mysql.com/doc/refman/8.0/en/mysqladmin.html) or [mysql](https://dev.mysql.com/doc/refman/8.0/en/mysql.html), but MySQL Workbench is advantageous in the following respects:

* Its graphical user interface makes it more intuitive to use.
* It provides a better overview of the settings that are crucial for the performance, reliability, and security of your MySQL servers.
* It displays performance indicators graphically, thus making it easier to determine and tune server settings.
* It is available for Linux, Windows and MacOS X, and allows a remote client to backup the database across platforms. As long as you have access to the MySQL databases on the remote server, you can backup your data to wherever you have write access.
* There is no limit to the size of the database to be backed up as there is with phpMyAdmin.

Information below has been tried and tested using MySQL Workbench version 6.3.6 connects to MySQL version 5.6.28 running on Linux.

[![mysql_workbench_top](https://wordpress.org/documentation/files/2018/11/mysql_workbench_top.jpg)](https://wordpress.org/documentation/files/2018/11/mysql_workbench_top.jpg)

**Backing up the database**

This assumes you have already installed MySQL Workbench and set it up so that you can login to the MySQL Database Server either locally or remotely. Refer to the documentation that comes with the installation package of MySQL Workbench for your platform for installation instructions or [online document](https://dev.mysql.com/doc/workbench/en/).

1. Launch the MySQL Workbench
2. Click your database instance if it is displayed on the top page. Or, Click Database -> Connect Database from top menu, enter required information and Click OK.
3. Click Data Export in left side window.

[![mysql_workbench_export](https://wordpress.org/documentation/files/2018/11/mysql_workbench_export.jpg)](https://wordpress.org/documentation/files/2018/11/mysql_workbench_export.jpg)

4. Select your WordPress databases that you want to backup.
5. Specify target directory on Export Options. You need write permissions in the directory to which you are writing the backup.
6. Click Start Export on the lower right of the window.

[![mysql_workbench_export2](https://wordpress.org/documentation/files/2018/11/mysql_workbench_export2.jpg)](https://wordpress.org/documentation/files/2018/11/mysql_workbench_export2.jpg)

**Restoring from a backup**

1. Launch the MySQL Workbench
2. Click your database instance if it is displayed on the top page. Or, Click Database -> Connect Database, and Click OK.
3. Click Data Import/Restore in left side window.
4. Specify folder where you have backup files. Click "…" at the right of Import from Dump Project Folder, select backup folder, and click Open.
5. Click Start Import on the lower right of the window. The database restore will commence.

[![mysql_workbench_import](https://wordpress.org/documentation/files/2018/11/mysql_workbench_import.jpg)](https://wordpress.org/documentation/files/2018/11/mysql_workbench_import.jpg)

#### MySQL GUI tools

In addition to MySQL Workbench, there are many GUI tools that let you backup (export) your database.

| Name | OS (Paid edition) | OS (Free edition) | Notes |
|---|---|---|---|
| [MySQL Workbench](https://www.mysql.com/products/workbench/) | Windows/Mac/Linux | Windows/Mac/Linux | See [Using MySQL Workbench](#using-mysql-workbench) |
| [EMS SQL Management Studio for MySQL](https://www.sqlmanager.net/products/mysql/studio) | Windows | | |
| [Aqua Data Studio](https://www.aquafold.com/) | Windows/Mac/Linux | Windows/Mac/Linux (14 days trial) | Available in 9 languages |
| [Navicat for MySQL](https://www.navicat.com/en/products/navicat-for-mysql) | Windows/Mac/Linux | Windows/Mac/Linux (14 days trial) | Available in 8 languages |
| [SQLyog](https://webyog.com/en/) | Windows | | |
| [Toad for MySQL](https://www.toadworld.com/) | | Windows | |
| [HeidiSQL](https://www.heidisql.com/) | | Windows | |
| [Sequel Pro](https://sequelpro.com/) | Mac | CocoaMySQL successor | |
| [Querious](https://www.araelium.com/querious/) | | Mac | |

#### Using a WordPress database backup plugin

You can find plugins that can help you back up your database in the [WordPress Plugin Directory](https://wordpress.org/plugins/search/database+backup/).

The instructions below are for the plugin called [WP-DB-Backup](https://wordpress.org/plugins/wp-db-backup/).

To install it:

1. Search for "WP-DB-Backup" on [Administration](https://wordpress.org/documentation/article/administration-screens/) > [Plugins](https://wordpress.org/documentation/article/administration-screens/#plugins-add-functionality-to-your-blog) > [Add New](https://wordpress.org/documentation/article/administration-screens/#add-new-plugins).
2. Click Install Now.
3. Activate the plugin.

To back up:

1. Navigate to [Administration](https://wordpress.org/documentation/article/administration-screens/) > [Tools](https://wordpress.org/documentation/article/administration-screens/#tools-managing-your-blog) > Backup
2. Core WordPress tables will always be backed up. Select some options from Tables section.

[![wp-db-backup_table](https://wordpress.org/documentation/files/2018/11/wp-db-backup_table.jpg)](https://wordpress.org/documentation/files/2018/11/wp-db-backup_table.jpg)

3. Select the Backup Options; the backup can be downloaded, or emailed.
4. Finally, click on the Backup Now! button to actually perform the backup. You can also schedule regular backups.

[![wp-db-backup_settings](https://wordpress.org/documentation/files/2018/11/wp-db-backup_settings.jpg)](https://wordpress.org/documentation/files/2018/11/wp-db-backup_settings.jpg)

The file created is a standard SQL file. To upload it again, see [Restoring your database from backup](#restoring-your-database-from-backup).

### Restoring your database from backup

The following instructions will **replace** your current database with the backup, **reverting** your database to the state it was in when you backed up.

#### Using phpMyAdmin

[phpMyAdmin](https://developer.wordpress.org/advanced-administration/upgrade/phpmyadmin/) is a program used to manipulate databases remotely through a web interface. A good hosting package will have this included.

Information here has been tested using phpMyAdmin 4.0.5 running on Unix.

Using phpMyAdmin, follow the steps below to restore a MySQL/MariaDB database.

1. Login to phpMyAdmin.
2. Click "Databases" and select the database that you will be importing your data into.
3. You will then see either a list of tables already inside that database or a screen that says no tables exist. This depends on your setup.
4. Across the top of the screen will be a row of tabs. Click the **Import** tab.
5. On the next screen will be a location of text file box, and next to that a button named **Browse**.
6. Click **Browse**. Locate the backup file stored on your computer.
7. Make sure **SQL** is selected in the **Format** drop-down menu.
8. Click the **Go** button.

Now grab a coffee. This bit takes a while. Eventually you will see a success screen.

If you get an error message, your best bet is to post to the [WordPress support forums](https://wordpress.org/documentation/) to get help.

#### Using MySQL/MariaDB commands

The restore process consists of unarchiving your archived database dump, and importing it into your MySQL/MariaDB database.

Assuming your backup is a `.bz2` file, created using instructions similar to those given in [Using straight MySQL/MariaDB commands](#using-straight-mysqlmariadb-commands), the following steps will guide you through restoring your database:

1. Unzip your `.bz2` file:

```
user@linux:~/files/blog> bzip2 -d blog.bak.sql.bz2
```

**Note:** If your database backup was a `.tar.gz` file called `blog.bak.sql.tar.gz`, then

```
tar -zxvf blog.bak.sql.tar.gz
```

is the command that should be used instead of the above.

2. Put the backed-up SQL back into MySQL/MariaDB:

```
user@linux:~/files/blog> mysql -h mysqlhostserver -u mysqlusername -p databasename < blog.bak.sql  
Enter password: (enter your mysql password)   
user@linux:~/files/blog>
```

### Automatic backups

Various plugins exist to take automatic scheduled backups of your WordPress database. This helps to manage your backup collection easily. You can find automatic backup plugins in the **Plugin Browser** on the WordPress Administration Screens or through the [WordPress Plugin Directory](https://wordpress.org/plugins/).

* [List of Backup Plugins](https://wordpress.org/plugins/tags/backup)

### Backup resources

* [Using phpMyAdmin with WordPress](https://developer.wordpress.org/advanced-administration/upgrade/phpmyadmin/)
* [FTP Clients](https://developer.wordpress.org/advanced-administration/upgrade/ftp/)
* [Using FileZilla](https://developer.wordpress.org/advanced-administration/upgrade/ftp/filezilla/)
* [FTP Backups](https://www.guyrutenberg.com/2010/02/28/improved-ftp-backup-for-wordpress/) – How to automate backing up to an FTP server
* [Incremental Backups](https://www.guyrutenberg.com/2013/03/28/incremental-wordpress-backups-using-duply-duplicity/) – How to make encrypted incremental backups using duplicity
* [How to Schedule Daily Backup of WordPress Database](https://www.narga.net/schedule-backup-wordpress-database/)
* [Upgrading WordPress Extended](https://developer.wordpress.org/advanced-administration/upgrade/upgrading/)

## Monitoring

Site monitoring systems and services can notify you when your site isn't working properly. They can often correct any minor issues, or help you to do so before they become major issues.

### Uptime monitoring

Uptime monitoring is traditionally done at the server level or by checking one or more URLs on the site at regular intervals to make sure they are responding properly. A combination of internal and external uptime monitoring is ideal for users, and there exist a variety of software and services to handle this for you.

### Performance monitoring

While a site's services may be responding, to a user, a site being "up" means more than this to them. Performance monitoring is similar to uptime monitoring, but also takes note of certain metrics that could indicate trouble. Metrics like "page load time" and "slowest average transactions" should be monitored and reported regularly to help keep you ahead of performance issues. Monitoring slow logs for problematic queries or requests can also help keep user sites stable. MySQL, PHP-FPM, and others provide options to capture these for monitoring.

### Performance profiling

It is best practice to use performance profiling tools, such as New Relic, AppDynamics or Tideways, to diagnose the performance bottlenecks of your website and infrastructure. These tools will give you insight such as slow performing functions, external HTTP requests, slow database queries and more that are causing poor performance.

## Loopbacks

A loopback is when your own server or website tries to connect to it self.

WordPress uses this functionality to trigger scheduled posts, and other scheduled events that plugins or themes may introduce.

They are also used when making changes in the Plugin- or Theme-editor, by connecting back to the website and making sure that the changes made does not break your website.

### Troubleshooting loopback issues

If you are having problems with scheduled posts or other timed events not running, or seeing Site Health warnings about loopbacks failing, you may want to troubleshoot these.

The most common cause of loopback failures is a plugin or theme conflict, you should start by following the normal troubleshooting steps:

* Deactivating **all plugins** (yes, all) to see if this resolves the problem. If this works, re-activate the plugins one by one until you find the problematic plugin(s). If you can't get into your admin dashboard, try resetting the plugins folder by [SFTP/FTP](https://developer.wordpress.org/advanced-administration/upgrade/ftp/) or phpMyAdmin (read [How to deactivate all plugins when you can't log in to wp-admin](https://wordpress.org/documentation/article/faq-troubleshooting/) if you need help). Sometimes, an apparently inactive plugin can still cause problems. Also remember to deactivate any plugins in the `mu-plugins` folder. The easiest way is to rename that folder to `mu-plugins-old`.
* Switching to a Twenty-Something theme to rule out any theme-specific problems. If you can't log in to change themes, you can remove the theme folders via [SFTP/FTP](https://developer.wordpress.org/advanced-administration/upgrade/ftp/) so the only one is `twentytwentythree`. That will force your site to use it.
* If you can install plugins, install the plugin [Health Check](https://wordpress.org/plugins/health-check/). On the troubleshooting tab, you can click the button to disable all plugins and change the theme for you, while you're still logged in, **without affecting normal visitors to your site**.

## Version Control

See [Version Control](https://developer.wordpress.org/advanced-administration/debug/version-control/).
