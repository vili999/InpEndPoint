<?php
/**
 * FileUser File Doc Comment
 * php version 7.4.10
 * 
 * @category FileUser
 * @package  MyPackage
 * @author   Velyana Petrova <velyana.vp@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://localhost/
 */
if (! defined('ABSPATH')) {
    exit;
}

/**
 * FileUser Class Doc Comment
 * 
 * FileUser Class
 * 
 * @category FileUser_Class
 * @package  MyPackage
 * @author   Velyana Petrova <velyana.vp@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://localhost/
 */

class FileUser implements UserInterface
{
    /**
     * Function addHooks() 
     * 
     * @return -
     */
    public function addHooks() 
    {
        add_action('init', array( 'InpEndPoint', 'init' ));
        add_action('parse_request', array( 'InpEndPoint', 'endpoint' ), 0);
    }
}