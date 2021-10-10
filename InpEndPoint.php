<?php
/**
 * Inp Custom Endpoint
 * php version 7.4.10
 *
 * @category  Wordpress_Plugin
 * @package   Inp_Custom_Endpoint
 * @author    Velyana Petrova <velyana.vp@gmail.com>
 * @copyright 2021 Velyana Petrova
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      http://localhost/
 * 
 * @wordpress-plugin
 * Plugin Name:       Inp Custom Endpoint
 * Plugin URI:        https://example.com/InpCustomEndpoint
 * Description:       Create a custom, not a WP API REST API endpoint "http://localhost/your_site/task/company". When a visitor navigates to that endpoint, the plugin sends an HTTP request to the REST API endpoint. The API is available at https://jsonplaceholder.typicode.com/users. The plugin parses the JSON response and uses it to build and display an HTML table. The clicking to the rows of the main table displays a second table with all details for one user.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Velyana Petrova
 * Author URI:        https://example.com
 * Text Domain:       plugin-slug
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Update URI:        https://example.com/my-plugin/
 */

defined('ABSPATH') or die('No script kiddies please!');
if (! defined('ABSPATH')) {
    die;
}

// Make sure we don't expose any info if called directly
if (! function_exists('add_action') ) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}

define('WP_DEBUG', false);
define('WP_DEBUG_LOG', false);
define('WP_DEBUG_DISPLAY', false);
define('INPCUSTOMENDPOINT__PLUGIN_DIR', plugin_dir_path(__FILE__));

require plugin_dir_path(__FILE__) . 'vendor/autoload.php';
require plugin_dir_path(__FILE__) . '/src/UserService.php';
require plugin_dir_path(__FILE__) . '/src//FileUser.php';
require plugin_dir_path(__FILE__) . '/src/WPContainer.php';

require_once INPCUSTOMENDPOINT__PLUGIN_DIR.'/src/Class.inpEndPoint.php';
require_once INPCUSTOMENDPOINT__PLUGIN_DIR.
    '/src/Class.inpEndPoint.processRequest.php';

$dependencies = [
    UserService::class => function ($container) {
        return new UserService($container->make(UserInterface::class));
    },
    UserInterface::class => function ($container) {
        return new FileUser();
    }
];

WPContainer::instance($dependencies);

add_action(
    'init', 
    function () {
        $userService = WPContainer::instance()->make(UserService::class);
        $users = $userService->getUsers();
    }
);
