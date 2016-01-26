<?php
/**
 * Logging class file
 *
 * @package bbguild v2.0
 * @copyright 2016 bbDKP <https://github.com/bbDKP>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace bbdkp\bbguild\model\admin;

/**
 * Singleton bbDKP Logging class
 * @package bbguild
 *
 */
class log
{

	/**
	 * number of logs
	 * @var int
	 */
	protected $total_logs;
    /**
     * @return int
     */
    public function getTotalLogs()
    {
        return $this->logcount();
    }

    /**
     * refers to this instance of the logging class
     * @var log
     */
    private static $instance;

    /**
     * dkp system added
     */
    const DKPSYS_ADDED = 1;
    /**
     * dkp system updated
     */
    const DKPSYS_UPDATED = 2;
    /**
     * dkp system deleted
     */
    const DKPSYS_DELETED = 3;
    /**
     * event added
     */
    const EVENT_ADDED = 4;
    /**
     * event updated
     */
    const EVENT_UPDATED = 5;
    /**
     * event deleted
     */
    const EVENT_DELETED = 6;
    /**
     * history transferred
     */
    const HISTORY_TRANSFER = 7;
    /**
     * individual adjustment added
     */
    const INDIVADJ_ADDED = 8;
    /**
     * individual adjustment updated
     */
    const INDIVADJ_UPDATED = 9;
    /**
     * individual adjustment deleted
     */
    const INDIVADJ_DELETED = 10;
    /**
     * item added
     */
    const ITEM_ADDED = 11;
    /**
     * item updated
     */
    const ITEM_UPDATED = 12;
    /**
     * item deleted
     */
    const ITEM_DELETED= 13;
    /**
     * new player was added
     */
    const PLAYER_ADDED = 14;
    /**
     * player file was updated
     */
    const PLAYER_UPDATED = 15;
    /**
     * player was removed
     */
    const PLAYER_DELETED = 16;
    /**
     * rank was added
     */
    const RANK_ADDED = 17;
    /**
     * rank was updated
     */
    const RANK_UPDATED = 18;
    /**
     * rank was deleted
     */
    const RANK_DELETED = 19;
    /**
     * news was added
     */
    const NEWS_ADDED = 20;
    /**
     * news was updated
     */
    const NEWS_UPDATED = 21;
    /**
     * news was deleted
     */
    const NEWS_DELETED = 22;
    /**
     * a new raid was added
     */
    const RAID_ADDED = 23;
    /**
     * raid was updated
     */
    const RAID_UPDATED = 24;
    /**
     * raid was deleted
     */
    const RAID_DELETED = 25;
    /**
     * an action was completed
     */
    const ACTION_DELETED = 26;
    /**
     * raidtracker config was updated
     */
    const RT_CONFIG_UPDATED = 27;
    /**
     * the decay was synchronised
     */
    const DECAYSYNC = 28;
    /**
     * decay was switched off
     */
    const DECAYOFF = 29;
    /**
     * zero sum dkp was synced
     */
    const ZSYNC = 30;
    /**
     * dkp was synchronised
     */
    const DKPSYNC = 31;
    /**
     * default pool was changed
     */
    const DEFAULT_DKP_CHANGED = 32;
    /**
     * new guild was added
     */
    const GUILD_ADDED = 33;
    /**
     * new player points account was opened
     */
    const PLAYERDKP_UPDATED = 34;
    /**
     * points account was deleted
     */
    const PLAYERDKP_DELETED = 35;
    /**
     * a game was added
     */
    const GAME_ADDED = 36;
    /**
     * a game was deleted */
	const GAME_DELETED = 37;
    /**
     * settings were updated
     */
    const SETTINGS_CHANGED = 38;
    /**
     * portal settings were changed
     */
    const PORTAL_CHANGED = 39;
    /**
     * a faction was deleted
     */
    const FACTION_DELETED = 40;
    /**
     * bbguild logs were purged
     */
    const LOG_DELETED = 41;
    /**
     * a faction was added
     */
    const FACTION_ADDED = 42;
    /**
     * a race was added
     */
    const RACE_ADDED = 43;
    /**
     * a race was deleted
     */
    const RACE_DELETED = 44;
    /**
     * a class was added
     */
    const CLASS_ADDED = 45;
    /**
     * a class was deleted
     */
    const CLASS_DELETED = 46;
    /**
     * a race was updated
     */
    const RACE_UPDATED = 47;
    /**
     * a class was updated
     */
    const CLASS_UPDATED = 48;
    /**
     * a previously inactive player was reactivated
     */
    const PLAYER_DEACTIVATED = 49;
    /**
     * a guild was updated
     */
    const GUILD_UPDATED = 50;
    /**
     * battle.NET is down
     */
    const ARMORY_DOWN = 51;
    /**
     * a faction was updated
     */
    const FACTION_UPDATED = 52;
    /**
     * A role was added
     */
    const ROLE_ADDED = 53;
    /**
     * a role was updated
     */
    const ROLE_UPDATED = 54;
    /**
     * a role was updated
     */
    const ROLE_DELETED = 55;
    /**
     * inactive account
     */
    const  BATTLENET_ACCOUNT_INACTIVE = 56;

	/**
	 * A key-value list of built-in log types that cannot be overridden
	 * @var array
	 */
	public static $valid_action_types = array(
        self::DKPSYS_ADDED => 'DKPSYS_ADDED' ,
        self::DKPSYS_UPDATED => 'DKPSYS_UPDATED' ,
        self::DKPSYS_DELETED =>'DKPSYS_DELETED' ,
        self::EVENT_ADDED =>'EVENT_ADDED' ,
        self::EVENT_UPDATED =>'EVENT_UPDATED' ,
        self::EVENT_DELETED =>'EVENT_DELETED' ,
        self::HISTORY_TRANSFER =>'HISTORY_TRANSFER' ,
        self::INDIVADJ_ADDED =>'INDIVADJ_ADDED' ,
        self::INDIVADJ_UPDATED =>'INDIVADJ_UPDATED' ,
        self::INDIVADJ_DELETED =>'INDIVADJ_DELETED' ,
        self::ITEM_ADDED =>'ITEM_ADDED' ,
        self::ITEM_UPDATED =>'ITEM_UPDATED' ,
        self::CLASS_UPDATED =>'ITEM_DELETED' ,
        self::PLAYER_ADDED =>'PLAYER_ADDED' ,
        self::PLAYER_UPDATED =>'PLAYER_UPDATED' ,
        self::PLAYER_DELETED =>'PLAYER_DELETED' ,
        self::RANK_ADDED =>'RANK_ADDED' ,
        self::RANK_UPDATED =>'RANK_UPDATED' ,
        self::RANK_DELETED =>'RANK_DELETED' ,
        self::NEWS_ADDED =>'NEWS_ADDED' ,
        self::NEWS_UPDATED =>'NEWS_UPDATED' ,
        self::NEWS_DELETED =>'NEWS_DELETED' ,
        self::RAID_ADDED =>'RAID_ADDED' ,
        self::RAID_UPDATED =>'RAID_UPDATED' ,
        self::RAID_DELETED =>'RAID_DELETED' ,
        self::ACTION_DELETED =>'ACTION_DELETED' ,
        self::RT_CONFIG_UPDATED =>'RT_CONFIG_UPDATED' ,
        self::DECAYSYNC =>'DECAYSYNC' ,
        self::DECAYOFF =>'DECAYOFF' ,
        self::ZSYNC =>'ZSYNC' ,
        self::DKPSYNC =>'DKPSYNC' ,
        self::DEFAULT_DKP_CHANGED =>'DEFAULT_DKP_CHANGED' ,
        self::GUILD_ADDED =>'GUILD_ADDED' ,
        self::PLAYERDKP_UPDATED =>'PLAYERDKP_UPDATED' ,
        self::CLASS_UPDATED =>'PLAYERDKP_DELETED',
        self::GAME_ADDED => 'GAME_ADDED',
        self::GAME_DELETED => 'GAME_DELETED',
        self::SETTINGS_CHANGED => 'SETTINGS_CHANGED',
        self::PORTAL_CHANGED => 'PORTAL_CHANGED',
        self::FACTION_DELETED => 'FACTION_DELETED',
        self::LOG_DELETED => 'LOG_DELETED',
        self::FACTION_ADDED => 'FACTION_ADDED',
        self::RACE_ADDED => 'RACE_ADDED',
        self::RACE_DELETED => 'RACE_DELETED',
        self::CLASS_ADDED => 'CLASS_ADDED',
        self::CLASS_DELETED => 'CLASS_DELETED',
        self::RACE_UPDATED => 'RACE_UPDATED',
        self::CLASS_UPDATED => 'CLASS_UPDATED',
        self::PLAYER_DEACTIVATED => 'PLAYER_DEACTIVATED',
        self::GUILD_UPDATED => 'GUILD_UPDATED',
        self::ARMORY_DOWN => 'ARMORY_DOWN',
        self::FACTION_UPDATED => 'FACTION_UPDATED',
        self::ROLE_ADDED => 'ROLE_ADDED',
        self::ROLE_UPDATED => 'ROLE_UPDATED',
        self::ROLE_DELETED => 'ROLE_DELETED',
        self::BATTLENET_ACCOUNT_INACTIVE => 'BATTLENET_ACCOUNT_INACTIVE',
    );

	/**
	 * only these tags can be entered in logs
	 * if tags are not in list then it's not logged
	 * @var array
	 */
	private static $valid_tags = array(
				'L_NAME' ,
				'L_EARNED_BEFORE' ,
				'L_EARNED_AFTER' ,
				'L_SPENT_BEFORE' ,
                'L_SPENT_AFTER' ,
				'L_REALM_BEFORE',
				'L_REALM_AFTER',
				'L_NAME_BEFORE' ,
				'L_NAME_AFTER',
				'L_RACE_BEFORE',
				'L_RACE_AFTER',
				'L_LEVEL_BEFORE',
				'L_LEVEL_AFTER',
				'L_LEVEL_BEFORE',
				'L_LEVELAFTER',
				'L_RANK_BEFORE',
				'L_RANK_AFTER',
				'L_CLASS_BEFORE',
				'L_CLASS_AFTER',
				'L_GENDER_BEFORE',
				'L_GENDER_AFTER',
				'L_ACHIEV_BEFORE',
				'L_ACHIEV_AFTER',
				'L_ORIGIN',
				'L_REALM',
				'L_RAIDS' ,
				'L_LOG_ID',
				'L_EVENT',
				'L_EVENT_ID',
				'L_EVENT_BEFORE',
				'L_VALUE_BEFORE',
				'L_VALUE_AFTER',
				'L_HEADLINE',
				'L_HEADLINE_BEFORE',
				'L_BUYER',
				'L_BUYERS',
				'L_BUYERS_BEFORE',
				'L_ADJUSTMENT',
				'L_ADJUSTMENT_BEFORE',
				'L_PLAYERS',
				'L_PLAYERS_AFTER',
				'L_FROM',
				'L_TO',
				'L_DKPSYS_NAME',
				'L_DKPSYSNAME_BEFORE',
				'L_DKPSYSNAME_AFTER',
				'L_DKPSYS_STATUS',
				'L_GAME',
				'L_SETTINGS',
				'L_FACTION',
				'L_ADDED_BY',
				'L_UPDATED_BY',
				'L_RACE',
				'L_CLASS',
				'L_LEVEL',
				'L_WRONG_KEY',
				'id',
				'L_RAID_ID',
				'L_VALUE',
				'L_DAYSAGO',
                'L_ROLE',
                'L_GUILD',
                'L_ACTION_BATTLENET_ACCOUNT_INACTIVE'

	);

	/**
	 * Call this method to get singleton log instance
	 * @return log
	 */
	public static function Instance()
	{
		if (!isset(self::$instance))
		{
            $className = __CLASS__;
            self::$instance = new $className;
        }
        return self::$instance;
	}

	/**
	 * Cloning class is blocked
	 */
	public function __clone()
	{
		//cloning not allowed
		global $user;
		trigger_error($user->lang['ERROR'], E_USER_ERROR);
	}

	/**
	 * cannot deserialise
	 */
	public function __wakeup()
	{
		global $user;
		trigger_error($user->lang['ERROR'], E_USER_ERROR);
	}

	/**
	 * SINGLETON CLASS !
	 */
	private function __construct()
	{


	}

    /**
     * get this log entry
     *
     * @param int $log_id
     * @return mixed
     */
    public function get_logentry($log_id)
    {
        global $db;
        $sql_array = array(
            'SELECT' 	=> 'l.*, u.username, u.user_id, u.user_colour' ,
            'FROM' 		=> 	array(BBLOGS_TABLE => 'l') ,
            'LEFT_JOIN' => array(
                array(
                    'FROM' => array(USERS_TABLE => 'u') ,
                    'ON' => 'u.user_id=l.log_userid')) ,
            'WHERE' => 'log_id=' . (int) $log_id);
        $total_sql = $db->sql_build_query('SELECT', $sql_array);
        $result = $db->sql_query($total_sql);
        $log = $db->sql_fetchrow($result);
        $db->sql_freeresult($result);
        $log['colouruser'] = get_username_string('full', $log['user_id'], $log['username'], $log['user_colour']);

        $log['log_type'] = str_replace( 'L_ACTION_', '', $log['log_type']);
        $log['log_type'] = str_replace( 'L_ERROR_', '', $log['log_type']);
        $log['log_type'] = str_replace( 'L_', '', $log['log_type']);

        $log['log_action'] = str_replace( 'L_ACTION_', '', $log['log_action']);
        $log['log_action'] = str_replace( 'L_ERROR_', '', $log['log_action']);
        $log['log_action'] = str_replace( 'L_', '', $log['log_action']);

        $log['log_result'] = str_replace( 'L_', '', $log['log_result']);

        return $log;

    }

    /**
     * makes an entry in the bbguild log table
     * log_action is an xml containing the log
     *
     * @param array $values
     * @return boolean
     */
    public static function log_insert($values = array())
    {
        global $db, $user;
        /**
         *
         * log_id	int(11)		UNSIGNED	No		auto_increment
         * log_date	int(11)			No	0
         * log_type	varchar(255)	utf8_bin		No
         * log_action	text	utf8_bin		No
         * log_ipaddress	varchar(15)	utf8_bin		No
         * log_sid	varchar(32)	utf8_bin		No
         * log_result	varchar(255)	utf8_bin		No
         * log_userid	mediumint(8)	UNSIGNED	No	0
         */
        $log_fields = array('log_date', 'log_type', 'log_action', 'log_ipaddress', 'log_sid', 'log_result', 'log_userid');

        /**
         * //example usage
         * $log_action = array(
        'header' => ACTION_INDIVADJ_DELETED ,
        'id' => $adjust_id ,
        'L_ADJUSTMENT' => $deleteadj->adjustment_value ,
        'L_REASON' => $deleteadj->adjustment_reason ,
        'L_PLAYERS' =>  $deleteadj->player_name );

        $this->log_insert(array(
        'log_type' => $log_action['header'] ,
        'log_action' => $log_action));
         */

        // Default our log values
        $defaultlog = array(
            'log_date'      => time(),
            'log_type'      => NULL,
            'log_action'    => NULL,
            'log_ipaddress' => $user->ip,
            'log_sid'       => $user->session_id,
            'log_result'    => 'L_SUCCESS',
            'log_userid'    => $user->data['user_id']);

        if ( sizeof($values) > 0 )
        {
            // If they set the value, we use theirs, otherwise we use the default
            foreach ( $log_fields as $field )
            {
                $values[$field] = ( isset($values[$field]) ) ? $values[$field] : $defaultlog[$field];

                switch ($field)
                {
                    case 'log_type':
                        $log_type = str_replace( 'L_ACTION_', '', $values['log_type']);
                        if (!in_array($log_type,  (array) self::$valid_action_types ))
                        {
                            $log_type = str_replace( 'L_ERROR_', '', $values['log_type']);
                            if (!in_array($log_type,  (array) self::$valid_action_types ))
                            {
                                //wrong logging type, can't log
                                return false;
                            }
                        }

                        break;
                    case 'log_action':

                        //check log tags
                        foreach ( $values['log_action'] as $key => $value )
                        {
                            //check tags but skip the header
                            if ($key != 'header')
                            {
                                if (!in_array($key, (array) self::$valid_tags	))
                                {
                                    //wrong logging type
                                    $key = 'L_WRONG_KEY';
                                }
                            }

                        }

                        // serialise log entries
                        //$values['log_action'] = json_encode( (array) $values['log_action']);

                        // make xml with
                        $str_action="<log>";
                        foreach ( $values['log_action'] as $key => $value )
                        {
                            $str_action .= "<" . $key . ">" . $value . "</" . $key . ">";
                        }
                        $str_action .="</log>";
                        $str_action = substr($str_action, 0, strlen($str_action));
                        // Take the newlines and tabs (or spaces > 1) out
                        $str_action = preg_replace("/[[:space:]]{2,}/", '', $str_action);
                        $str_action = str_replace("\t", '', $str_action);
                        $str_action = str_replace("\n", '', $str_action);
                        $str_action = preg_replace("#(\\\){1,}#", "\\", $str_action);
                        $values['log_action'] = $str_action;
                        break;
                }
            }
            $query = $db->sql_build_array('INSERT', $values);
            $sql = 'INSERT INTO ' . BBLOGS_TABLE . $query;
            $db->sql_query($sql);
            return true;
        }
        return false;
    }


    /**
     * delete log from Database
     *
     * @param array $marked
     * @return multitype:unknown
     */
    public function delete_log($marked)
    {
        global $db;

        //they hit yes
        $sql = 'DELETE FROM ' . BBLOGS_TABLE . ' WHERE 1=1 ';
        $sql_in = array();
        foreach ($marked as $mark)
        {
            $sql_in[] = $mark;
        }
        $sql .= ' AND ' . $db->sql_in_set('log_id', $sql_in);
        $db->sql_query($sql);

        return $sql_in;

    }


    /**
     * read simple log
     *
     * @param string $order
     * @param bool|string $search
     * @param bool|string $verbose
     * @param string $search_term
     * @param string $start
     * @return multitype:multitype:string NULL unknown mixed
     */
    public function read_log($order= '', $search = false, $verbose = false, $search_term = '', $start = '')
	{
		global $user, $db;

		$sql_array = array(
				'SELECT' => 'l.*, u.username, u.user_colour ' ,
				'FROM' => array(
						BBLOGS_TABLE => 'l' ,
						USERS_TABLE => 'u') ,
				'WHERE' => 'u.user_id=l.log_userid');

		// If they're looking for something specific, we have to figure out what that is
		if ($search)
		{

			// Check if it's a valid log type
            if (array_search($search_term, self::$valid_action_types))
            {
                $sql_array['WHERE'] = " u.user_id=l.log_userid
                    AND ( l.log_type='" . $db->sql_escape( 'L_ACTION_' . $search_term  ) . "'
                          OR  l.log_type='" . $db->sql_escape( 'L_ERROR_' . $search_term  ) . "')";
            }
			// Check it's an IP
			elseif (preg_match("/[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}/", $search_term))
			{
				$sql_array['WHERE'] = "  u.user_id=l.log_userid AND l.log_ipaddress='" . $db->sql_escape($search_term) . "'";
			}
			// Still going? It's a username
			elseif ($search_term != '')
			{
				$sql_array['WHERE'] = " u.user_id=l.log_userid AND u.user_id='" . $db->sql_escape($search_term) . "'";
			}
			else
			{
				//empty searchterm, dont add criterium
			}
		}

		if($verbose == false)
		{
			$sql_array['ORDER_BY'] = $order;
			$sql = $db->sql_build_query('SELECT', $sql_array);
			$result = $db->sql_query_limit($sql, 30);
		}
		else
		{
			$sql_array['ORDER_BY'] = 'log_id DESC';
			$sql = $db->sql_build_query('SELECT', $sql_array);
			$result = $db->sql_query_limit($sql, USER_LLIMIT, $start);
		}

		$outlog = array();
		while ($row = $db->sql_fetchrow($result))
		{
			$log = $this->getxmltag($row['log_action']);
			$log_type = str_replace( 'L_ACTION_', '', $row['log_type']);
            $log_type = str_replace( 'L_ERROR_', '', $log_type);
			$logline = $this->get_logmessage($log_type, $row['log_action'], $row['log_userid'], $row['username'], $row['user_colour'], $verbose);
			$outlog[] = array(
				'log_id' 		=> $row['log_id'],
				'datestamp' 	=> date('d.m.y - H:i:s', $row['log_date']),
				'log_line' 		=> $logline,
				'log_type'		=> $log_type,
				'username'		=> get_username_string('full', $row['log_userid'], $row['username'], $row['user_colour']),
				'log_ipaddress'	=> $row['log_ipaddress'],
				'log_result'	=> $user->lang[str_replace( 'L_', '', $row['log_result'])],
				'cssresult'		=> (str_replace( 'L_', '', $row['log_result']) == 'SUCCESS') ? 'positive' : 'negative',
				'encoded_type' 	=> urlencode($row['log_type']) ,
				'encoded_user' 	=> urlencode($row['username']) ,
				'encoded_ip' 	=> urlencode($row['log_ipaddress'])
			);
		}

		return $outlog;

	}


    /**
     * Get error message of a value. It's actually the lang value of the constant's name
     * @param integer $value
     * @param boolean $verbose
     * @return string
     */
    public function getLogMessage($value, $verbose = false)
    {
        global $user;
        if($verbose)
        {
            return $user->lang['VLOG_' . self::$valid_action_types[constant("self::$value")] ];
        }
        else
        {
            return $user->lang['ACTION_' . self::$valid_action_types[constant("self::$value")] ];
        }


    }


    /**
     * Get number of logs
     * @return int  total_logs
     */
    private function logcount()
    {
        global $db;
        $sql6 = 'SELECT count(*) as log_count FROM ' . BBLOGS_TABLE;
        $result6 = $db->sql_query($sql6);
        $this->total_logs = (int) $db->sql_fetchfield('log_count');
        $db->sql_freeresult($result6);
        unset($result6);
        return $this->total_logs;

    }


    /**
     * returns logline
     * @param string $log_type
     * @param string $log_action
     * @param string $log_userid
     * @param string $username
     * @param string $user_colour
     * @param bool $verbose
     * @return string
     */
    private function get_logmessage($log_type, $log_action, $log_userid, $username, $user_colour, $verbose = false)
	{
		global $user;

			$logline = '';
			$log = $this->getxmltag($log_action);
			$userstring = get_username_string('full', $log_userid, $username, $user_colour);

			switch ( $log_type )
			{
				case 'LOG_DELETED':
					$logline = sprintf($this->getLogMessage('LOG_DELETED', $verbose), $userstring , $log['L_LOG_ID'] ) ;
					break;
				case 'DKPSYS_ADDED':
					$logline = sprintf($this->getLogMessage('DKPSYS_ADDED', $verbose), $userstring, $log['L_DKPSYS_NAME'], $log['L_DKPSYS_STATUS']);
					break;
				case 'DKPSYS_UPDATED':
					$logline = sprintf($this->getLogMessage('DKPSYS_UPDATED', $verbose), $userstring, $log['L_DKPSYSNAME_BEFORE'], $log['L_DKPSYSNAME_AFTER']);
					break;
				case 'DKPSYS_DELETED':
					$logline = sprintf($this->getLogMessage('DKPSYS_DELETED', $verbose), $userstring, $log['L_DKPSYS_NAME']);
					break;
				case 'EVENT_ADDED':
					$logline = sprintf($this->getLogMessage('EVENT_ADDED', $verbose), $userstring, $log['L_NAME'], $log['L_VALUE']);
					break;
				case 'EVENT_UPDATED':
					$logline = sprintf($this->getLogMessage('EVENT_UPDATED', $verbose), $userstring, $log['L_NAME_BEFORE']);
					break;
				case 'EVENT_DELETED':
					$logline = sprintf($this->getLogMessage('EVENT_DELETED', $verbose), $userstring, $log['L_NAME']);
					break;
				case 'HISTORY_TRANSFER':
					$logline = sprintf($this->getLogMessage('HISTORY_TRANSFER', $verbose), $userstring, $log['L_FROM'] , $log['L_TO'] );
					break;
				case 'INDIVADJ_ADDED':
					$logline = sprintf($this->getLogMessage('INDIVADJ_ADDED', $verbose), $userstring, $log['L_ADJUSTMENT'], count( explode(",", $log['L_PLAYERS']) ), $log['L_PLAYERS']);
					break;
				case 'INDIVADJ_UPDATED':
					$logline = sprintf($this->getLogMessage('INDIVADJ_UPDATED', $verbose), $userstring, $log['L_ADJUSTMENT_BEFORE'], $log['L_PLAYERS_AFTER']);
					break;
				case 'INDIVADJ_DELETED':
					$logline = sprintf($this->getLogMessage('INDIVADJ_DELETED', $verbose), $userstring, $log['L_ADJUSTMENT'], $log['L_PLAYERS']);
					break;
				case 'ITEM_ADDED':
					$logline = sprintf($this->getLogMessage('ITEM_ADDED', $verbose), $userstring,
						isset($log['L_NAME']) ? $log['L_NAME'] : '',
						isset($log['L_BUYERS']) ? $log['L_BUYERS'] : ''	,
						 $log['L_VALUE']  );
					break;
				case 'ITEM_UPDATED':
					$logline = sprintf($this->getLogMessage('ITEM_UPDATED', $verbose), $userstring, $log['L_NAME_BEFORE'], $log['L_VALUE_AFTER']);
					break;
				case 'ITEM_DELETED':
					$logline = sprintf($this->getLogMessage('ITEM_DELETED', $verbose), $userstring, $log['L_NAME'], (isset($log['L_BUYER']) ? $log['L_BUYER'] : '') , (isset($log['L_VALUE']) ? $log['L_VALUE'] : '0')  );
					break;
				case 'PLAYER_ADDED':
					$logline = sprintf($this->getLogMessage('PLAYER_ADDED', $verbose), $userstring, $log['L_NAME']);
					break;
				case 'PLAYER_UPDATED':
					$logline = sprintf($this->getLogMessage('PLAYER_UPDATED', $verbose), $userstring, $log['L_NAME']);
					break;
				case 'PLAYER_DELETED':
					$logline = sprintf($this->getLogMessage('PLAYER_DELETED', $verbose), $userstring, $log['L_NAME']);
					break;
				case 'RANK_DELETED':
					$logline = sprintf($this->getLogMessage('RANK_DELETED', $verbose), $userstring, $log['L_NAME']);
					break;
				case 'RANK_ADDED':
					$logline = sprintf($this->getLogMessage('RANK_ADDED', $verbose), $userstring, $log['L_NAME']);
					break;
				case 'RANK_UPDATED':
					$logline = sprintf($this->getLogMessage('RANK_UPDATED', $verbose), $userstring, $log['L_NAME_BEFORE'], $log['L_NAME_AFTER']);
					break;
				case 'NEWS_ADDED':
					$logline = sprintf($this->getLogMessage('NEWS_ADDED', $verbose), $userstring, $log['L_HEADLINE'] );
					break;
				case 'NEWS_UPDATED':
					$logline = sprintf($this->getLogMessage('NEWS_UPDATED', $verbose), $userstring, $log['L_HEADLINE_BEFORE'] );
					break;
				case 'NEWS_DELETED':
					$logline = sprintf($this->getLogMessage('NEWS_DELETED', $verbose), $userstring, $log['L_HEADLINE'] );
					break;
				case 'RAID_ADDED':
					$logline = sprintf($this->getLogMessage('RAID_ADDED', $verbose), $userstring, $log['L_EVENT'] );
					break;
				case 'RAID_UPDATED':
					$logline = sprintf($this->getLogMessage('RAID_UPDATED', $verbose), $userstring, $log['L_EVENT_BEFORE'] );
					break;
				case 'RAID_DELETED':
					$logline = sprintf($this->getLogMessage('RAID_DELETED', $verbose), $userstring, $log['L_EVENT'] );
					break;
				case 'RT_CONFIG_UPDATED':
					$logline = sprintf($this->getLogMessage('RT_CONFIG_UPDATED', $verbose), $userstring );
					break;
				case 'DECAYSYNC':

					if (isset($log['L_ORIGIN']) )
					{
						$origin = $log['L_ORIGIN'];
					}
					else
					{
						$origin = '';
					}
					$logline = sprintf($this->getLogMessage('DECAYSYNC', $verbose), $userstring, isset($log['L_RAIDS']) ? $log['L_RAIDS'] : 0) . ' ' . $origin;
					break;
				case 'DECAYOFF':
					if (isset($log['L_ORIGIN']) )
					{
						$origin = $log['L_ORIGIN'];
					}
					else
					{
						$origin = '';
					}
					$logline = sprintf($this->getLogMessage('DECAYOFF', $verbose), $userstring, $origin);
					break;
				case 'ZSYNC':
					if (isset($log['L_ORIGIN']) )
					{
						$origin = $log['L_ORIGIN'];
					}
					else
					{
						$origin = '';
					}
					$logline = sprintf($this->getLogMessage('ZSYNC', $verbose), $userstring, isset($log['L_RAIDS']) ? $log['L_RAIDS'] :0 ) . ' '. $origin;
					break;
				case 'DKPSYNC':
					if (isset($log['L_ORIGIN']) )
					{
						$origin = $log['L_ORIGIN'];
					}
					else
					{
						$origin = '';
					}
					$logline = sprintf($this->getLogMessage('DKPSYNC', $verbose), $userstring) . ' '. $origin;
					break;
				case 'DEFAULT_DKP_CHANGED':
					if (isset($log['L_ORIGIN']) )
					{
						$origin = $log['L_ORIGIN'];
					}
					else
					{
						$origin = '';
					}
					$logline = sprintf($this->getLogMessage('DEFAULT_DKP_CHANGED', $verbose), $userstring , $origin) ;
					break;
				case 'GUILD_ADDED':
					$logline = sprintf($this->getLogMessage('GUILD_ADDED', $verbose), $userstring , $log['L_REALM'] . '-' . $log['L_NAME'] ) ;
					break;
				case 'GUILD_UPDATED':
					$logline = sprintf($this->getLogMessage('GUILD_UPDATED', $verbose), $userstring, $log['L_REALM_BEFORE'] . '-' .
							$log['L_NAME_BEFORE'], $log['L_REALM_AFTER'] . '-' . $log['L_NAME_AFTER'] );
							break;
				case 'GUILD_DELETED':
					$logline = sprintf($this->getLogMessage('GUILD_DELETED', $verbose), $userstring , $log['L_NAME'] ) ;
					break;
				case 'PLAYERDKP_UPDATED':
					$logline = sprintf($this->getLogMessage('PLAYERDKP_UPDATED', $verbose), $userstring, $log['L_NAME'],
					$log['L_EARNED_BEFORE'], $log['L_EARNED_AFTER'], $log['L_SPENT_BEFORE'], $log['L_SPENT_AFTER']);
					break;
				case 'GAME_ADDED':
					$logline = sprintf($this->getLogMessage('GAME_ADDED', $verbose), $userstring , isset($user->lang[strtoupper($log['L_GAME'])]) ? $user->lang[strtoupper($log['L_GAME'])] : $log['L_GAME']   ) ;
					break;
				case 'GAME_DELETED':
					$logline = sprintf($this->getLogMessage('GAME_DELETED', $verbose), $userstring , isset($user->lang[strtoupper($log['L_GAME'])]) ? $user->lang[strtoupper($log['L_GAME'])] : $log['L_GAME'] ) ;
					break;
				case 'SETTINGS_CHANGED':
					$logline = sprintf($this->getLogMessage('SETTINGS_CHANGED', $verbose), $userstring , $log['L_SETTINGS'] ) ;
					break;
				case 'FACTION_ADDED':
					$logline = sprintf($this->getLogMessage('FACTION_ADDED', $verbose), $userstring , $log['L_FACTION'], isset($user->lang[strtoupper($log['L_GAME'])]) ? $user->lang[strtoupper($log['L_GAME'])] : $log['L_GAME'] ) ;
					break;
				case 'FACTION_DELETED':
					$logline = sprintf($this->getLogMessage('FACTION_DELETED', $verbose), $userstring , $log['L_FACTION'], isset($user->lang[strtoupper($log['L_GAME'])]) ? $user->lang[strtoupper($log['L_GAME'])] : $log['L_GAME'] ) ;
					break;
				case 'RACE_ADDED':
					$logline = sprintf($this->getLogMessage('RACE_ADDED', $verbose), $userstring , $log['L_RACE'], isset($user->lang[strtoupper($log['L_GAME'])]) ? $user->lang[strtoupper($log['L_GAME'])] : $log['L_GAME'] ) ;
					break;
				case 'RACE_DELETED':
					$logline = sprintf($this->getLogMessage('RACE_DELETED', $verbose), $userstring , $log['L_RACE'], isset($user->lang[strtoupper($log['L_GAME'])]) ? $user->lang[strtoupper($log['L_GAME'])] : $log['L_GAME'] ) ;
					break;
				case 'RACE_UPDATED':
					$logline = sprintf($this->getLogMessage('RACE_UPDATED', $verbose), $userstring , $log['L_RACE'], isset($user->lang[strtoupper($log['L_GAME'])]) ? $user->lang[strtoupper($log['L_GAME'])] : $log['L_GAME'] ) ;
					break;
				case 'CLASS_ADDED':
					$logline = sprintf($this->getLogMessage('CLASS_ADDED', $verbose), $userstring , $log['L_CLASS'], isset($user->lang[strtoupper($log['L_GAME'])]) ? $user->lang[strtoupper($log['L_GAME'])] : $log['L_GAME'] ) ;
					break;
				case 'CLASS_DELETED':
					$logline = sprintf($this->getLogMessage('CLASS_DELETED', $verbose), $userstring , $log['L_CLASS'], isset($user->lang[strtoupper($log['L_GAME'])]) ? $user->lang[strtoupper($log['L_GAME'])] : $log['L_GAME'] ) ;
					break;
				case 'CLASS_UPDATED':
					$logline = sprintf($this->getLogMessage('CLASS_UPDATED', $verbose), $userstring , $log['L_CLASS'], isset($user->lang[strtoupper($log['L_GAME'])]) ? $user->lang[strtoupper($log['L_GAME'])] : $log['L_GAME']  ) ;
					break;
				case 'PLAYER_DEACTIVATED':
					$logline = sprintf($this->getLogMessage('PLAYER_DEACTIVATED', $verbose), $userstring , $log['L_NAME'], '' ) ;
					break;
                case 'ARMORY_DOWN':
                    $logline = sprintf($this->getLogMessage('ARMORY_DOWN', $verbose), $userstring , ' ', ' ' ) ;
                    break;
                case 'BATTLENET_ACCOUNT_INACTIVE':
                    $logline = sprintf($this->getLogMessage('BATTLENET_ACCOUNT_INACTIVE', $verbose), $userstring , isset($user->lang[strtoupper($log['L_GUILD'])]) ? $user->lang[strtoupper($log['L_GUILD'])] : $log['L_GUILD'], ' ' ) ;
                    break;
                case 'FACTION_UPDATED':
                    $logline = sprintf($this->getLogMessage('FACTION_UPDATED', $verbose), $userstring , $log['L_FACTION'], isset($user->lang[strtoupper($log['L_GAME'])]) ? $user->lang[strtoupper($log['L_GAME'])] : $log['L_GAME'] ) ;
                    break;
                case 'ROLE_ADDED':
                    $logline = sprintf($this->getLogMessage('ROLE_ADDED', $verbose), $userstring , $log['L_ROLE'], isset($user->lang[strtoupper($log['L_GAME'])]) ? $user->lang[strtoupper($log['L_GAME'])] : $log['L_GAME'] ) ;
                    break;
                case 'ROLE_UPDATED':
                    $logline = sprintf($this->getLogMessage('ROLE_UPDATED', $verbose), $userstring , $log['L_ROLE'], isset($user->lang[strtoupper($log['L_GAME'])]) ? $user->lang[strtoupper($log['L_GAME'])] : $log['L_GAME'] ) ;
                    break;
                case 'ROLE_DELETED':
                    $logline = sprintf($this->getLogMessage('ROLE_DELETED', $verbose), $userstring , $log['L_ROLE'], isset($user->lang[strtoupper($log['L_GAME'])]) ? $user->lang[strtoupper($log['L_GAME'])] : $log['L_GAME'] ) ;
                    break;
			}

			return $logline;

	}


	/**
	 * returns log tags from xml
	 *
	 * @param string $haystack
	 * @return multitype:string
	 */
	private function getxmltag($haystack)
	{
		$found = array();
		$array_temp = (array) @simplexml_load_string($haystack);
		foreach ($array_temp as $tag => $value)
		{
			if (in_array($tag, self::$valid_tags))
			{
				$found[$tag] = $value;
			}
		}
		return $found;
	}







}

