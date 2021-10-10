<?php
/**
 * PluginTestCase File Doc Comment
 * php version 7.4.10
 * 
 * @category PluginTestCase
 * @package  MyPackage
 * @author   Velyana Petrova <velyana.vp@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://localhost/
 */
use PHPUnit\Framework\TestCase;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Brain\Monkey;

/**
 * An abstraction over WP_Mock to do things fast
 * It also uses the snapshot trait
 */
/**
 * PluginTestCase Class Doc Comment
 * 
 * PluginTestCaser Class
 * 
 * @category PluginTestCase_Class
 * @package  MyPackage
 * @author   Velyana Petrova <velyana.vp@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://localhost/
 */

class PluginTestCase extends TestCase
{
    use MatchesSnapshots;
    use MockeryPHPUnitIntegration;

    /**
     * Setup which calls \WP_Mock setup
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        Monkey\setUp();
        // A few common passthrough
        // 1. WordPress i18n functions
        Monkey\Functions\when('__')
            ->returnArg(1);
        Monkey\Functions\when('_e')
            ->returnArg(1);
        Monkey\Functions\when('_n')
            ->returnArg(1);
    }

    /**
     * Teardown which calls \WP_Mock tearDown
     *
     * @return void
     */
    public function tearDown(): void 
    {
        Monkey\tearDown();
        parent::tearDown();
    }
}

