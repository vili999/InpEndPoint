<?php
/**
 * UserService File Doc Comment
 * php version 7.4.10
 * 
 * @category UserService
 * @package  MyPackage
 * @author   Velyana Petrova <velyana.vp@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://localhost/
 */

require plugin_dir_path(__FILE__) . 'UserInterface.php';

if (! defined('ABSPATH')) {
    exit;
}

/**
 * WPContainer Class Doc Comment
 * 
 * UserService Class
 * 
 * @category UserService_Class
 * @package  MyPackage
 * @author   Velyana Petrova <velyana.vp@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://localhost/
 */

class UserService
{
    private $_user;

    /**
     * Function construct
     * 
     * @param UserInterface $_user from UserIntreface
     */
    public function __construct(UserInterface $_user)
    {
        $this->user = $_user;
    }

    /**
     * Function getUsers()
     * 
     * @return []
     */
    public function getUsers() : array
    {
        $this->user->addHooks();
        return [];
    }
}