<?php
/**
 * WPContainer File Doc Comment
 * php version 7.4.10
 * 
 * @category WPContainer
 * @package  MyPackage
 * @author   Velyana Petrova <velyana.vp@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://localhost/
 */
if (! defined('ABSPATH')) {
    exit;
}

/**
 * WPContainer Class Doc Comment
 * 
 * WPContainer Class
 * 
 * @category WPContainer_Class
 * @package  MyPackage
 * @author   Velyana Petrova <velyana.vp@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://localhost/
 */


class WPContainer
{
    private static $_instance;

    private $_dependencies = [];

    /**
     * Function construct
     * 
     * @param array $_dependencies 
     */
    private function __construct($_dependencies = [])
    {
        $this->_dependencies = $_dependencies;
    }

    /**
     * Function instance
     * 
     * @param $_dependencies 
     * 
     * @return $_instance
     */
    public static function instance($_dependencies = [])
    {
        if (null === self::$_instance) {
            self::$_instance = new self($_dependencies);
        }

        return self::$_instance;
    }

    /**
     * Function instance
     * 
     * @param string $id 
     * 
     * @return _dependencies[$id]
     */
    public function has(string  $id) : bool
    {
        return isset($this->_dependencies[ $id ]);
    }

    /**
     * Function get
     * 
     * @param string $id 
     * 
     * @return mixed
     * throws \Exception
     */
    public function get(string $id)
    {
        if ($this->has($id)) {
            return $this->_resolve($id);
        } else {
            throw new \Exception("Dependency $id not found.");
        }
    }

    /**
     * Function make
     * 
     * @param string $id 
     * 
     * @return $id
     **/
    public function make(string  $id)
    {
        try {
            return $this->get($id);
        }
        catch (\Exception $e) {
            return new $id();
        }
    }

    /**
     * Function _resolve
     * 
     * @param string $id 
     * 
     * @return _dependencies[$id]
     **/
    private function _resolve(string $id)
    {
        return call_user_func($this->_dependencies[ $id ], $this);
    }
}