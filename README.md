=== Inp Custom Endpoint ===
Contributors: (Velyana Petrova)
Author URI: https://www.example.com
Tags: wordpress, plugin
Requires at least: wordpress 5
Tested up to: 5.7.2
Stable tag: 5.7.2
Requires PHP: 7.4.10 
License URI: https://www.gnu.org/licenses/gpl-3.0.html


== Description ==
Create a custom, not a WP API REST API endpoint "http://localhost/your_site/task/company". When a visitor navigates to that endpoint, the plugin sends an HTTP request to the REST API endpoint. The API is available at https://jsonplaceholder.typicode.com/users. The plugin parses the JSON response and uses it to build and display an HTML table. The clicking to the rows of the main table displays a second table with all details for one user.

== Installation and Work ==
This section describes how to install the plugin and how it is working.
1. Upload the plugin files to the `/wp-content/plugins/example-directory` directory, start "composer install" command.
2. Activate the plugin through the Dashboard, Plugins screen in WordPress.
3. When installed, the plugin makes available a custom endpoint on the WordPress site "/task/company". With “custom endpoint” we mean an arbitrary URL.
This is not a REST endpoint. When a visitor navigates to that endpoint, the plugin sends an HTTP request to a REST API endpoint. The API is available at https://jsonplaceholder.typicode.com/ and the endpoint to call is /users.
The plugin parses the JSON response and uses it to build and display an HTML table. Each row in the HTML table will show the details for a user - id, name, username, and email.
The content of the columns has a link (<a> tag). When a visitor clicks any of these links, the details of that user are shown. For that, the plugin will do another API request to the user-details endpoint.
These details fetching requests is asynchronous (AJAX) and the user details are shown without reloading the page.
At any time, the page will show details for at max one user. In fact, at every link click, a new user detail will load, replacing the one currently shown.

== INFO section ==
About requesting  HTTP cache, the "function get_api_info()" store in the database for up to 24 hours. Then, you just need to call get_api_info() anywhere in your code to retrieve the data you need. If you call the function multiple times in the same request/script, it will still only yell out to the database once. If you call the function in multiple requests within 24 hours, it will only send the API request once.
For the "user details request",  I prefer to fetch to default cache.
The plugin has been testing on the browser with a localhost WP installation.
