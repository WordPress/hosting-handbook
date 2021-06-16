# Troubleshooting Security issues
Traditionally, there are two types of measures:

- Reactive measures
> When something bad actually happened, pain mitigation
These measures are intended to react to a security issue. There are some very commons:
    - Scan the site. There are several 3rd party scans out there, here you have some useful ones:
       * Virustotal: A meta scanner, will check several blacklists and scanners from it. Link: [virustotal.com](https://virustotal) 
       * SiteCheck: A scanner which will take a snapshot of what an user would receive from a website (it uses several User Agents) and analyse the result seaerching for signs of infection.
    - CRC (Check, Remove, Change): Nemonic technique oriented to encourage to CHECK the different site sections (e.g: admin users list, plugin list, themes list, etc.), REMOVE those that are **not strictly needed** and CHANGE values (E.g: passwords).
    - Update the site, plugins and themes. Keep in mind that everytime you update a component in WordPress, the existing code is overwritten with the fresh & udpated one directly from the repository. 
    However, this could be dangerous, specially with the themes since those user that haven't follow the [themes handbook](https://developer.wordpress.org/themes/) could have added manual changes to their parent themes. 
    - As the last measure, restore a backup.

- Proactive measures
> Before something bad happens, risk mitigation
   - Install a [WAF](https://en.wikipedia.org/wiki/Web_application_firewall)
   - Follow Security recomendations.
   - CRC (as explained above)
   - Have a good backup strategy in place
   - Invest in Security (security plugins, security services, security suites, etc.)

## Agents involved in a Security Breach
In order, these are the layers  that should be touched in a bad scenario:
- Site's owner and administrators
- Hosting support
- Customers/registered users 

Bear in mind special policies that affects depending where are you located, like GDPR (Europe), CCPA (California), etc. They might obligate you to declare the security issue to other authorities layers.

## Basic Troubleshooting
Without the appropiate tools to analyse what is going on, one of the first troubleshooting measure that could be taking is:
- Update everything. This will overwrite the existing (and might infected) code with fresh and updated one directly from the official repository.
- **Replace core folders and files**. WordPress is designed in a way we can safely replace all the core files/folder. The process happen as follows:
   - Download and extract the files of the [WordPress](https://wordpress.org/download/) repository which matchs with your current version, or an updated one if you prefer that. 
   Keep in mind that if you update the WordPress version, you could have issues of compatility. Get in touch with a professional developer to do it safely.
   - Move the following folders from your site into a secondary folder (backup, for instance):
       - `wp-admin`
       - `wp-includes`
   - Upload those folders from the copy you have downloaded from wordpress.org
   - Upload and replace all the files in the root directory from the copy downloaded from WordPress to your site's root directory.
Bear in mind that your site's file and code lays in the `wp-content` folder and in the `wp-config.php` file. If you keep those, your site should remain the same, but now totally freshly replaced by a good and clean copy directly from the WordPress repository.
