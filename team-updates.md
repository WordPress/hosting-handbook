# Monthly Hosting Team Updates
The Hosting Team is publishing monthly updates to make.wordpress.org/hosting and https://make.wordpress.org/updates/ with the team activity currently measured in:

- Activity on the Hosting Tests
- GitHub Activities on Hosting Team maintained Repos 

As an example you can view the monthly update for [July 2025](https://wp.me/p8aY12-Bn7), which was the first one published.

In order to publish those reports you need to have Administrator access to make.wordpress.org/hosting and Editor access to make.wordpress.org/updates.

## How to generate the reports

### Activity on Hosting Tests

For Hosting Tests the team reports the newly shared reports by hosts for that month. This data can be gathered from the WordPress Backend of make.wordpress.org/hosting. The results page can be accessed directly https://make.wordpress.org/hosting/wp-admin/edit.php?s&post_status=all&post_type=result&action=-1&m=202507, with having the last number being the year and month you want to get results for. 
While on this page you can see the total amount of all published "posts" as number of all test results ever shared. 

Last but not least the number of test reporters and recent activity can be retrieved from the [WordPress Backend too](https://make.wordpress.org/hosting/wp-admin/users.php?role=test-reporter). The number of recent active reporters can be counted on https://make.wordpress.org/hosting/test-results/. 


### GitHub Report

We prepared a script that collects stats from GitHub through the API and outputs the table and the contributors. Right now the script is located in [this repo](https://github.com/Crixu/github-stats).

Follow the readme, create your own .env file and run the script. Once it is finished it will output all the required stats in the `report` folder. 

## Publishing on make.wordpress.org

Once the data is collected go ahead and copy the report of last month from the WordPress Backend. Update all the **data and dates** and ask the team for a review before publishing. 

The Crosspost to `/updates` won't include the content of the post. In order to fix this you need to login to make.wordpress.org/updates and edit the post to add the content.

