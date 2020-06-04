# Reliability

When we already have a site in operation, the work of hosting does not end. The machines can and do fail, so we need to have methods to check that it is working as well as a backup system.

## Backup

WordPress does not have any automatic backup system by default, so you have to rely on a third-party tool to do so.

When making a backup, you must bear in mind that WordPress is made up of two completely different elements: the files and the data. The file part is stored on your server, and can be accessed by FTP or any other method, and the data is stored in the database. This means that when you make a backup you have to do it from both parts, since one does not work without the other.

### Where to make copies

There are many methods for making backups. The first is the hosting server itself. Usually the providers themselves offer the possibility of making a copy of all the contents hosted on the machine. Usually these copies are made externally on a specific backup server. In this case, you should know how it works and when it is done, as well as how to restore the copy, if it can be partial, total, and if you have access to the data in a simple way.

A second way is manually, through the operating system, so that you mount a system that makes a copy of all files (for example in a ZIP) and on the other hand to dump the database to obtain a copy of the SQL file with all the data.

Finally, and most often (in addition to what the provider can provide) is to have a backup plugin. There are many plugins and in general we recommend that you try several until you find the one that suits your needs. It is not the same to make a backup of a small site (200 MB) as to make a large one (5 GB). The response times and performance of the server could cause the system to become saturated and not perform the copies, so we recommend that you try the different systems until you find the one that works best.

It's also important that when you back up your data, it's stored in at least two different locations. One is usually the server where the website is located. Sometimes the site gets corrupted but it doesn't affect the machine, so having the files close by and available quickly is usually very helpful. The other case is to have them outside the server, in an external place, and even outside the same network or provider or country. The fact that it is in another place would allow that even if that provider had a serious problem (and for example you had no possibility to access it) you could restore your site from an external place.

### When to make copies

You can make as many copies as you want, though in moderation, like everything else. In general, it will depend on how many changes you make to your website and how often to determine how much data you are willing to lose in an extreme case.

For example, if you have a site where you publish content every week, and your visitors post some comments, a daily backup is probably enough.

On the other hand, if you are a media outlet that publishes a hundred articles a day and there is a lot of interaction, you will probably want to make a copy every few hours.

In any case, it is advisable to have at least one daily copy for a week, and then store a weekly copy for at least a few months. This way you'll be sure to have copies that go back 3-6 months. Again, this will depend on the size and configuration of your site.

## Monitoring

Having monitoring tools will allow you to check if the site is working properly, at many different levels.

### Uptime

One of the basic monitoring systems is to know that the site is active, in addition to small elements of loading speed or response times. Usually you use external ping services that call your website frequently and check that it is working and online, and whether access is fast or slow. In case there is a problem, it usually sends some kind of warning as an alert.

In addition, these services usually have panels in which they can analyze these times and possible service failures in a historical way.

### Performance

In general, the measurement of these data is usually done internally as they mainly affect the services available to the machine. For a WordPress to work we need at least the server with its operating system, the web server, the PHP and the database. In addition, we can have the caching systems. Well, the performance monitoring system analyzes all this.

For example, some common data of the server and operating system is the CPU and memory load, the consumed bandwidth or storage space and performance, in the web server part the amount of valid and invalid requests and responses that are returned, in the PHP the memory and execution consumption and in the database the size, the amount of queries and those that are slow.