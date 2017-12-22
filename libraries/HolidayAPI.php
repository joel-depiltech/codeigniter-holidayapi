<?php
// @codeCoverageIgnoreStart
defined('BASEPATH') || exit('No direct script access allowed');
// @codeCoverageIgnoreEnd

use HolidayAPI\v1 as HolidayAPIv1;

/**
 * Codeigniter PHP framework library class for dealing with Holiday API.
 *
 * @package    CodeIgniter
 * @subpackage Libraries
 * @category   Language
 * @author     Joël Gaujard <joel@depiltech.com>
 * @link       https://github.com/joel-depiltech/codeigniter-holidayapi
 */
class HolidayAPI
{
    /**
     * Environment which uses Live API key
     *
     * @var string
     */
    const ENVIRONMENT_LIVE = 'live';

    /**
     * Environment which uses Test API key
     *
     * @var string
     */
    const ENVIRONMENT_TEST = 'test';


    /**
     * API key
     *
     * @var string
     */
    private $key;

    /**
     * Class instance of official PHP library
     *
     * @var HolidayAPIv1
     */
    private $hapi;

    /**
     * Class instance of Code Igniter
     *
     * @var CI_Controller
     */
    private $CI;


    /**
     * Initialize Codeigniter PHP framework and get configuration
     *
     * @param array $config Override default configuration
     */
    public function __construct(array $config = array())
    {
        log_message('info', 'HolidayAPI Library class initialized');

        $this->CI =& get_instance();

        $this->_setConfig($config);

        // instance official PHP library class
        $this->hapi = new HolidayAPIv1($this->getKey());
    }

    /**
     * Merge config as parameter and default config (config/holidayapi.php file)
     *
     * @param array $config
     */
    private function _setConfig(array $config = array())
    {
        // Load default config
        $this->CI->load->config('holidayapi');

        $environment = isset($config['holidayapi_environment'])
            ? $config['holidayapi_environment'] : config_item('holidayapi_environment');

        $test_api_key = isset($config['holidayapi_test_api_key'])
            ? $config['holidayapi_test_api_key'] : config_item('holidayapi_test_api_key');

        $live_api_key = isset($config['holidayapi_live_api_key'])
            ? $config['holidayapi_live_api_key'] : config_item('holidayapi_live_api_key');

        // Define key from environment
        if ($environment === self::ENVIRONMENT_LIVE) {
            $this->setKey($live_api_key);
        }
        elseif ($environment === self::ENVIRONMENT_TEST) {
            $this->setKey($test_api_key);
        }
        else {
            throw new OutOfRangeException('Unknown "' . $environment . '" Holiday API environment.');
        }
    }

    public function getKey()
    {
        return $this->key;
    }

    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * Load a domain
     *
     * @param string $domain
     */
    public function holidays(
        $country = 'US',
        $year = NULL,
        $month = NULL,
        $day = NULL,
        $previous = FALSE,
        $upcoming = FALSE,
        $public = TRUE,
        $pretty = TRUE
    )
    {
        $parameters = array(
            // Required
            'key'       => $this->getKey(),
            'country'   => $country,
            'year'      => empty($year) ? date('Y') : $year,
            // Optional
            'month'     => empty($month) ? NULL : $month,
            'day'       => empty($day) ? NULL : $day,
            'previous' => (bool) $previous,
            'upcoming' => (bool) $upcoming,
            'public'   => (bool) $public,
            'pretty'   => (bool) $pretty
        );

        $response = $this->hapi->holidays($parameters);

        return $response;
    }

}


/* End of file HolidayAPI.php */
/* Location: ./application/third_party/holidayapi/libraries/HolidayAPI.php */