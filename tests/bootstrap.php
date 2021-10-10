<?php
/**
 *  PHPUnit bootstrap File Doc Comment
 * php version 7.4.10
 * 
 * @category PHPUnit
 * @package  MyPackage
 * @author   Velyana Petrova <velyana.vp@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://localhost/
 */

$_tests_dir = getenv('WP_TESTS_DIR');

if (! $_tests_dir) {
    $_tests_dir = rtrim(sys_get_temp_dir(), '/\\') . '/wordpress-tests-lib';
}

if (! file_exists($_tests_dir . '/includes/functions.php')) {
    // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    echo "Could not find $_tests_dir/includes/functions.php, 
        have you run bin/install-wp-tests.sh ?" . PHP_EOL; 
    exit(1);
}

// Give access to tests_add_filter() function.
require_once $_tests_dir . '/includes/functions.php';

/**
 * Manually load the plugin being tested.
 * 
 * @return -
 */
function Manually_Load_plugin() 
{
    include dirname(dirname(__FILE__)) . '/InpEndPoint.php';
}
tests_add_filter('muplugins_loaded', '_manually_load_plugin');

// Start up the WP testing environment.
require $_tests_dir . '/includes/bootstrap.php';
