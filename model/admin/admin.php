<?php
/**
 * bbGuild Admin class file
 *
 *
 * @package bbguild v2.0
 * @copyright 2016 bbDKP <https://github.com/bbDKP>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace bbdkp\bbguild\model\admin;
use bbdkp\bbguild\model\games\Game;
use phpbb\extension\metadata_manager;
use phpbb\version_helper;
use bbdkp\bbguild\model\admin\log;
use phpbb\file_downloader;

/**
 *
 * bbDKP Admin foundation
 *   @package bbguild
 */
class Admin
{

    /**
     * bbguild timestamp
     * @var integer
     */
    public $time = 0;
    /**
     * game ragions
     * @var array
     */
    public $regions;

    /**
     * supported languages. The game related texts (class names etc) are not stored in language files but in the database.
     * supported languages are en, fr, de : to add a new language you need to a) make language files b) make db installers in new language c) adapt this array
     *
     * @var array
     */
    public $languagecodes;

    /**
     * bbtips is installed ?
     * @var boolean
     */
    public $bbtips = false;

    /**
     * installed games
     * @var array
     */
    public $games;

    /**
     * extension path
     * @var
     */
    public $ext_path;

    /**
     * Admin class constructor
     */
    public function __construct()
    {
        global $user, $phpEx, $phpbb_extension_manager;
        $this->ext_path = $phpbb_extension_manager->get_extension_path('bbdkp/bbguild', true);
        $user->add_lang_ext('bbdkp/bbguild', array('admin','common'));
        include_once($this->ext_path . 'model/admin/constants.' . $phpEx);

        // Check for required extensions
        if (!function_exists('curl_init'))
        {
            trigger_error($user->lang['CURL_REQUIRED'], E_USER_WARNING);
        }

        $this->regions = array(
            'cn' => $user->lang['REGIONCN'],
            'eu' => $user->lang['REGIONEU'],
            'kr' => $user->lang['REGIONKR'],
            'sea' => $user->lang['REGIONSEA'],
            'tw' => $user->lang['REGIONTW'],
            'us' => $user->lang['REGIONUS'],
        );

        //sort alphabetically
        asort($this->regions);

        $this->languagecodes = array(
            'de' => $user->lang['LANG_DE'],
            'en' => $user->lang['LANG_EN'],
            'fr' => $user->lang['LANG_FR'],
            'it' => $user->lang['LANG_IT']
        );

        $boardtime = getdate(time() + $user->timezone + $user->timezone->getOffset(new \DateTime('UTC')));
        $this->time = $boardtime[0];
        $listgames = new Game;
        $this->games = $listgames->games;
        unset($listgames);
    }

    /**
     * creates a unique key, used as adjustments, import, items and raid identifier
     *
     * @param string $part1
     * @param string $part2
     * @param string $part3
     * @return string $group_key
     */
    public final function gen_group_key($part1, $part2, $part3)
    {
        // Get the first 10-11 digits of each password_hash
        $part1 = substr(password_hash($part1, PASSWORD_DEFAULT), 0, 10);
        $part2 = substr(password_hash($part2, PASSWORD_DEFAULT), 0, 11);
        $part3 = substr(password_hash($part3, PASSWORD_DEFAULT), 0, 11);
        // Group the hashes together and create a new hash based on uniqid()
        $group_key = $part1 . $part2 . $part3;
        $group_key = password_hash(uniqid($group_key), PASSWORD_DEFAULT);

        return $group_key;
    }

    /**
     * connects to remote site and gets xml or html using Curl
     * @param $url
     * @param array $return_Server_Response_Header
     * @param bool $loud
     * @param bool $json
     * @return array
     */
    public final function curl($url, $return_Server_Response_Header, $loud= false, $json=true)
    {

        $data = array(
            'response'		    => '',
            'response_headers'  => '',
            'error'				=> '',
        );

        if ( function_exists ( 'curl_init' ))
        {
            /* Create a CURL handle. */
            if (($curl = curl_init($url)) === false)
            {
                trigger_error('curl_init Failed' , E_USER_WARNING);
            }

            // set options
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url,
                CURLOPT_USERAGENT => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:21.0) Gecko/20100101 Firefox/21.0',
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_FOLLOWLOCATION, true,
                CURLOPT_TIMEOUT => 60,
                CURLOPT_VERBOSE => true,
                CURLOPT_HEADER => $return_Server_Response_Header,
                CURLOPT_HEADER => false
            ));

            $response = curl_exec($curl);
            $headers = curl_getinfo($curl);

            if($response === FALSE || $response === "" )
            {
                trigger_error(curl_error($curl), E_USER_WARNING);
            }
            else
            {
                $data = array(
                    'response'		    => $json && $this->isJSON($response) ? json_decode($response, true) : $response,
                    'response_headers'  => (array) $headers,
                    'error'				=> '',
                );
            }

            curl_close ($curl);
            return $data;

        }

        //report errors?
        if($loud == true)
        {
            trigger_error($data['error'], E_USER_WARNING);
        }
        return $data['response'];

    }

    /**
     * @param $string
     * @return bool check if is json
     */
    function isJSON($string){
        return is_string($string) && is_object(json_decode($string)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
    }


    /**
     * sends POST request to bbguild.com for registration
     * @param array $regdata
     */
    public final function post_register_request($regdata)
    {
        $rndhash = base_convert(mt_rand(5, 60466175) . mt_rand(5, 60466175), 10, 36);
        // bbguild registration url
        $url = "http://www.avathar.be/services/registerbbkdp.php";
        // Create URL parameter string
        $fields_string = '';
        foreach( $regdata as $key => $value )
        {
            $fields_string .= $key.'='.$value.'&';
        }
        $fields_string .= 'rndhash='.$rndhash;

        $ch = curl_init();

        // set options
        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POST=> 4,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:21.0) Gecko/20100101 Firefox/21.0',
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_POSTFIELDS => $fields_string,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_FOLLOWLOCATION, true,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_VERBOSE => true,
            CURLOPT_HEADER => false
        ));

        curl_exec($ch);
        curl_close( $ch );

        $this->get_register_request($rndhash);
    }

    /**
     * GET requests for registration ID
     * @param $regcode
     */
    private final function get_register_request($regcode)
    {
        global $cache, $config;
        $url = 'http://www.avathar.be/services/registerbbdkp.php?rndhash=' . $regcode;
        $data = $this->Curl($url, 'GET');
        $regID = isset($data['response']) ? isset($data['response']['registration']) ? $data['response']['registration'] : '' : '';
        if( $regID != '')
        {
            $config->set('bbguild_regid', $regID, true);
            $cache->destroy('config');
            trigger_error('Registration Successful : ' . $config['bbguild_regid'], E_USER_NOTICE );
        }
        else
        {
            trigger_error('Registration failed ', E_USER_WARNING );
        }
    }

    /**
     * get latest plugin info
     * @param bool $force_update
     * @param int $ttl
     * @return array|bool
     */
    public final function get_plugin_info($force_update = false, $ttl = 86400)
    {
        global $cache, $db;
        //get latest productversion from cache
        $plugins = $cache->get('bbguildplugins');

        //if update is forced or cache expired then make the query to refresh latest productversion
        if ($plugins === false || $force_update)
        {
            $plugins = array();
            $sql = 'SELECT name, value, version, installdate FROM ' . BBDKPPLUGINS_TABLE . ' ORDER BY installdate DESC ';
            $result = $db->sql_query ($sql);
            while($row = $db->sql_fetchrow($result))
            {
                $data = $this->curl(BBGUILD_VERSIONURL . $row['name'] .'.json' , false, false, false);
                $response = $data['response'];
                $latest_version = json_decode($response, true);
                $latest_version_a = $latest_version['stable']['3.1']['current'];

                $plugins[$row['name']] = array(
                    'name' => $row['name'],
                    'value' => $row['value'],
                    'version' => $row['version'],
                    'latest' =>  $latest_version_a,
                    'installdate' => $row['installdate']
                );
            }
            $db->sql_freeresult($result);

            $cache->destroy('bbguildplugins');
            $cache->put( 'bbguildplugins', $plugins, $ttl);
        }
        return $plugins;

    }

    /**
     * retrieve latest bbguild productversion
     * @param bool $force_update Ignores cached data. Defaults to false.
     * @param bool $warn_fail Trigger a warning if obtaining the latest version information fails. Defaults to false.
     * @param int $ttl  Cache version information for $ttl seconds. Defaults to 86400 (24 hours).
     * @return bool
     */
    public final function get_productversion($force_update = false, $warn_fail = false, $ttl = 86400)
    {
        global $user, $cache;

        //get latest productversion from cache
        $latest_version_a = $cache->get('latest_bbguild');

        //if update is forced or cache expired then make the call to refresh latest productversion
        if ($latest_version_a === false || $force_update)
        {
            $data = $this->curl(BBGUILD_VERSIONURL . 'bbguild.json', false, false, false);
            if (empty($data))
            {
                $cache->destroy('latest_bbguild');
                if ($warn_fail)
                {
                    trigger_error($user->lang['VERSION_NOTONLINE'], E_USER_WARNING);
                }
                return false;
            }

            $response = $data['response'];
            $latest_version = json_decode($response, true);
            $latest_version_a = $latest_version['stable']['3.1']['current'];

            //put this info in the cache
            $cache->put('latest_bbguild' , $latest_version_a, $ttl);
        }

        return $latest_version_a;
    }

    private function version_check(metadata_manager $md_manager, $force_update = false, $force_cache = false)
    {
        global $cache, $config, $user;
        $meta = $md_manager->get_metadata('all');
        if (!isset($meta['extra']['version-check']))
        {
            throw new \RuntimeException($this->user->lang('NO_VERSIONCHECK'), 1);
        }
        $version_check = $meta['extra']['version-check'];
        $version_helper = new version_helper($cache, $config, new file_downloader(), $user);
        $version_helper->set_current_version($meta['version']);
        $version_helper->set_file_location($version_check['host'], $version_check['directory'], $version_check['filename']);
        $version_helper->force_stability($this->config['extension_force_unstable'] ? 'unstable' : null);
        return $updates = $version_helper->get_suggested_updates($force_update, $force_cache);
    }

    /**
     * Switch array order
     * Switches the sorting order of a supplied array, prerserving key values
     * The array is in the format [number][0/1] (0 = the default, 1 = the opposite)
     * Returns an array containing the code to use in an SQL query and the code to
     * use to pass the sort value through the URI.  URI is in the format
     * checks that the 2nd element is either 0 or 1
     *
     * @param $sort_order
     * @param string $arg
     * @param string $defaultorder
     * @return mixed
     */
    public final function switch_order($sort_order, $arg = URI_ORDER, $defaultorder = '0.0')
    {
        global $request;
        $uri_order = $request->variable($arg, $defaultorder);
        $uri_order = explode('.', $uri_order);

        $element1 = ( isset($uri_order[0]) ) ? $uri_order[0] : 0;
        $element2 = ( isset($uri_order[1]) ) ? $uri_order[1] : 0;
        // check if correct input
        if ( $element2 != 1 )
        {
            $element2 = 0;
        }

        foreach((array) $sort_order as $key => $value )
        {
            if ( $element1 == $key )
            {
                $uri_element2 = ( $element2 == 0 ) ? 1 : 0;
            }
            else
            {
                $uri_element2 = 0;
            }
            $current_order['uri'][$key] = $key . '.' . $uri_element2;
        }

        $current_order['uri']['current'] = $element1.'.'.$element2;
        $current_order['sql'] = $sort_order[$element1][$element2];

        return $current_order;
    }


    /**
     * remove end of a string
     * @param string $string
     * @param string $stringToRemove
     * @return string
     */
    public function removeFromEnd($string, $stringToRemove)
    {
        $stringToRemoveLen = strlen($stringToRemove);
        $stringLen = strlen($string);
        $pos = $stringLen - $stringToRemoveLen;
        $out = substr($string, 0, $pos);
        return $out;
    }

    /**
     * makes an entry in the bbguild log table
     * log_action is an xml containing the log
     *
     * log_id    int(11)        UNSIGNED    No        auto_increment
     * log_date    int(11)            No    0
     * log_type    varchar(255)    utf8_bin        No
     * log_action    text    utf8_bin        No
     * log_ipaddress    varchar(15)    utf8_bin        No
     * log_sid    varchar(32)    utf8_bin        No
     * log_result    varchar(255)    utf8_bin        No
     * log_userid    mediumint(8)    UNSIGNED    No    0
     *
     * @param array $values
     * @return bool
     */
    public final function log_insert($values = array())
    {
        $logs = log::Instance();
        return $logs->log_insert($values);

    }



}
