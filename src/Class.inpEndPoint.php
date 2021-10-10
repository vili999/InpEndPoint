<?php
/**
 * Class.inpEndPoint File Doc Comment
 * php version 7.4.10
 * 
 * @category InpEndPoint
 * @package  MyPackage
 * @author   Velyana Petrova <velyana.vp@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://localhost/
 */
define('HOURS', 60 * 60);

class InpEndPoint
{
    private static $_initiated = false;

    public static function init() 
    {
        if (! self::$_initiated ) {
            self::init_hooks();
        }
    }

    /**
     * Init hooks
     * 
     * @return null
     */
    public static function init_hooks()
    {
        self::$_initiated = true;
        add_action('init', 'add_endpoint');
    }


    /**
     * Create a independent endpoint
     * 
     * @return null
     */
    public static function endpoint() 
    {

        global $wp;

        $endpoint_vars = $wp->query_vars;

        // if endpoint
        if ($wp->request == 'task/company') {
            // Your own function to process endpoint
            self::processEndPoint();
            exit;
        } elseif (isset($endpoint_vars['tracking']) 
            && !empty($endpoint_vars['tracking'])
        ) {
            $request = [
            'tracking_id' => $endpoint_vars['tracking']
            ];
            
            self::processEndPoint($request);
        } elseif (isset($_GET['utm_source']) && !empty($_GET['utm_source'])) {
            self::processGoogleTracking($_GET);
        }
    }

    /**
     * @param null
     * @return null
     * @description Create a permalink endpoint for projects tracking
     */
    private static function add_endpoint()
    {
        add_rewrite_endpoint('tracking', EP_PERMALINK | EP_PAGES, true);
    }

    /**
     * @param null
     * return null
     * Description: Send process API request and serve json response to HTML Table
     */
    public static function processEndPoint()
    {
        $response = self::get_api_info();
        ProcessRequest::process($response);
    }

    private static function get_api_info() {
        global $apiInfo; // Check if it's in the runtime cache (saves database calls)
        // Check database (saves expensive HTTP requests)
        if (empty($apiInfo)) { 
            $apiInfo = get_transient('api_info'); 
        }; 
        if (!empty($apiInfo)) { 
            return $apiInfo;
        };
        $response = wp_remote_get('https://jsonplaceholder.typicode.com/users');
        $data = wp_remote_retrieve_body($response);
        if (empty($data)) {
            return false;
        };
         // Load data into runtime cache
        $apiInfo = json_decode($data);
        // Store in database for up to 12 hours
        set_transient('api_info', $apiInfo, 24 * HOURS); 
        return $apiInfo;
    }

}