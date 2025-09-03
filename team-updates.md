# Monthly Hosting Team Updates
The Hosting Team is publishing monthly updates to make.wordpress.org/hosting and https://make.wordpress.org/updates/ with the team activtiy currently measured in:

- Acitvity on the Hosting Tests
- GitHub Activities on Hosting Team mantained Repos 

As an example you can view the monthly update for [July 2025](https://wp.me/p8aY12-Bn7), which was the first one published.

## How to generate the reports

### Activity on Hosting Tests

For the Hosting Tests we report the newly shared reports by hosts for that month. This data can be gathered from the WordPress Backend of make.wordpress.org/hosting. Best is to access the result page directly with a filter applied like https://make.wordpress.org/hosting/wp-admin/edit.php?s&post_status=all&post_type=result&action=-1&m=202507, with having the last number being the year and month you want to get results for. 
While on this page you can see the total amount of all published "post" as number of all test results ever shared. 

Last but not least we need to get the number of Test Reporters and the recent active ones. The total amount of all bot users can be checked from the [WordPress Backend too](https://make.wordpress.org/hosting/wp-admin/users.php?role=test-reporter). The number of recent active reporters can be counted on https://make.wordpress.org/hosting/test-results/. 


### GitHub Report

Collecting the numbers of contributions from GitHub is semi-automated as GitHub already provides us with a nice report for the last month:

- [Advanced Administration Handbook](https://github.com/WordPress/Advanced-administration-handbook/pulse/monthly)
- [Hosting Handbook](https://github.com/WordPress/hosting-handbook/pulse/monthly)
- [Hosting Test Runner](https://github.com/WordPress/phpunit-test-runner/pulse/monthly)
- [Hosting Test Reporter](https://github.com/WordPress/phpunit-test-reporter/pulse/monthly)

Those pages directly provide us with an overview of the opened and closed PRs and Issues as well as a contributor overview. We're mentioning very active users as the most active GitHub contributors at the end of the post. 

## Publishing on make.wordpress.org

Once the data is collected go ahead and copy the report of last month from the WordPress Backend. Update all the **data and dates** and ask the team for a review before publishing. 