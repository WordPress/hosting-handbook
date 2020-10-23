# Reliability

When we have a site operational already, hosting's work is not finished. Servers can fail, so we need to have some methodology to check it is working and has a backup.

## Backup

WordPress does not have automatic backup system by default, so you have to rely on a third-party tool to do it.

When you are making a backup, you must remember WordPress is made up of thre completely different elements: files, data and configuration. The files part is stored on your file-server, and can be accessed by FTP or any other method, the data is stored in the database and the config files are associate on each application (web server, database server...). 

When you make a backup you have to do it from those three elements, since one does not work without the others.

### Where to make copies

There are many ways to back up, so you must use the best for your project / site.

The first one is the hosting server itself. Usually providers themselves offer the possibility of making a copy of all the contents hosted on the machine. Usually these copies are made externally on a specific backup server. In this case, you should know how it works and when the copies are done, as well as how to restore the copy, if it can be partial or total, and if you have access to the data in a simple way.

A second way is manually, through the operating system. In this case you must create everything to make a copy of all files (for example in a ZIP), dump the database to obtain a copy of the SQL file with all the data and also the configurations. Once you have all the information, you should try to have a local copy and an external out the actual network.

WordPress users may not know how they can access the server o create a manual backup, so the easiest way is to use a backup plugin. There are many [backup plugins](https://wordpress.org/plugins/search/backup/) and you should try them until you find the one that suits your needs. It is not the same to make a backup of a small site (500 MB) than a large one (5 GB). Response times and server's performance could cause saturation on the system and not create the copies; try different plugins until you find the one that works the best.

It is also important to have redundancy on your copies. This means you should have a local copy (for easy access in simple restoring) for that moment when your site gets corrupted but it doesn't affect the machine, so having the files close by and available quickly is usually very helpful. The other is to have them outside the server, in an external place, even outside the same network or provider or country. The fact that it is in another place would allow that even if that provider had a serious problem (and for example you had no possibility to access it) you could restore your site from an external place or another provider.

### When to make copies

You can make as many copies as you want. It will depend on how many changes are made in your site and knowing how much data you are willing to lose in an extreme case. Everything has risk, so you must know them.

For example, if you have a site where you publish content every week, and your visitors post some comments, a daily backup is probably enough.

On the other hand, if you are newspaper publishing some articles a day and there is a lot of interaction, you will probably want to make a copy every few hours.

In any case, be advised to have, at least, one daily copy for a week, and then store a weekly copy for at least a few months. This way you'll be sure to have copies that go back 3-6 months. Again, this will depend on the size and configuration of your site.

## Monitoring

Monitoring tools will allow you to check if your site is working properly, at many different levels.

### Uptime

One of the basic monitoring systems is to know that the site is active, in addition to small elements of loading speed or response times. Usually you use external ping services that call your website frequently and check that it is working and online, and whether access is fast or slow. In case there is a problem, it usually sends some kind of warning as an alert.

In addition, these services usually have panels in which they can analyze these times and possible service failures in a historical way and notifications system (like mail, SMS, mobile-push...).

### Performance

Your hosting has some common data, like the CPU and memory load, the bandwidth consumption, storage space. The web server has the amount of valid and invalid requests and responses. PHP has the memory and execution consumption. Database has the size, the amount of queries and those that are slow.

The measurement of these data is usually done internally as they mainly affect the services available to the machine. Those data should be monitored so your site works well.