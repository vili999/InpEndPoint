<?php
/**
 * Test_sample File Doc Comment
 * php version 7.4.10
 * 
 * @category Test_sample
 * @package  MyPackage
 * @author   Velyana Petrova <velyana.vp@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://localhost/
 */
// define fake ABSPATH
if (! defined('ABSPATH')) {
    define('ABSPATH', sys_get_temp_dir());
}
// define fake PLUGIN_ABSPATH
if (! defined('PLUGIN_ABSPATH')) {
    define('PLUGIN_ABSPATH', sys_get_temp_dir() .
    '/wp-content/plugins/inp-end-point/');
}
require dirname(dirname(__FILE__)) . '/InpEndPoint.php';


use PHPUnit\Framework\TestCase;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Brain\Monkey;


/**
 * Test_sample Class Doc Comment
 * 
 * Test_sample Class
 * 
 * @category Test_sample_Class
 * @package  MyPackage
 * @author   Velyana Petrova <velyana.vp@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://localhost/
 */
class Test_sample extends TestCase
{
    use MockeryPHPUnitIntegration;

    protected function setUp(): void {
        parent::setUp();
        Monkey\setUp();
    }


    public function test_sample()
    {
        ( new FileUser() )->addHooks();
        self::assertTrue(has_action('init', [ FileUser::class, 'init' ]));
    }
    
}
