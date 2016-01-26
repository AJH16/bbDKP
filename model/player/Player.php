<?php
/**
 * Player class file
 *
 * @package bbguild v2.0
 * @copyright 2016 bbDKP <https://github.com/bbDKP>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace bbdkp\bbguild\model\player;

use bbdkp\bbguild\model\admin\Admin;
use bbdkp\bbguild\model\games\Game;
use bbdkp\bbguild\model\player\Guilds;
use bbdkp\bbguild\model\wowapi\BattleNet;

/**
 * manages player creation
 * @package bbdkp\bbguild\model\player
 * @property array $playerdata
 * @property int $game_id
 * @property int $player_id
 * @property string $player_name
 * @property bool $player_status
 * @property int $player_level
 * @property int $player_race_id
 * @property string $player_race
 * @property int $player_class_id
 * @property int $player_rank_id
 * @property string $player_comment
 * @property int $player_joindate
 * @property int $player_joindate_d
 * @property int $player_joindate_mo
 * @property int $player_joindate_y
 * @property int $player_outdate
 * @property int $player_outdate_d
 * @property int $player_outdate_mo
 * @property int $player_outdate_y
 * @property int $player_guild_id
 * @property string $player_guild_name
 * @property string $player_realm
 * @property string $player_region
 * @property string $regionlist
 * @property int $player_gender_id
 * @property int $player_achiev
 * @property string $player_armory_url
 * @property string $player_portrait_url
 * @property int $phpbb_user_id
 * @property string $colorcode
 * @property string $race_image
 * @property string $class_image
 * @property string $talents
 * @property string $player_title
 * @property string $deactivate_reason
 * @property int $last_update
 * @property string $player_role
 * @property array $guildplayerlist
 * @property array $guildlist
 *
 */
class Player extends Admin
{

	/**
	 * game id
	 * @var string
	 */
	public $game_id;

	/**
	 * primary key in the bbDKP player table
	 * @var integer
	 */
	public $player_id;

	/**
	 * utF-8 player name
	 * @var string
	 */
	protected $player_name;

	/**
	 * status (0 or 1)
	 * @var bool
	 */
	protected $player_status;

	/**
	 * level
	 * @var int
	 */
	protected $player_level;

	/**
	 * race id
	 * @var integer
	 */
	protected $player_race_id;
	/**
	 * race name
	 * @var string
	 */
	protected $player_race;
	/**
	 * Class id
	 * @var integer
	 */
	protected $player_class_id;
	/**
	 * Class name
	 * @var string
	 */
	protected $player_class;

	/**
	 * guild rankid
	 * @var int
	 */
	protected $player_rank_id;

	/**
	 * administrator comment
	 * @var string
	 */
	protected $player_comment;

	/**
	 * player guild join date
	 * @var integer
	 */
	protected $player_joindate;
	/**
	 * join day
	 * @var integer
	 */
	protected $player_joindate_d;
	/**
	 * join month
	 * @var integer
	 */
	protected $player_joindate_mo;
	/**
	 * join year
	 * @var integer
	 */
	protected $player_joindate_y;
	/**
	 * out date
	 * @var int
	 */
	protected $player_outdate;
	/**
	 * out day
	 * @var integer
	 */
	protected $player_outdate_d;
	/**
	 * out month
	 * @var integer
	 */
	protected $player_outdate_mo;
	/**
	 * out year
	 * @var integer
	 */
	protected $player_outdate_y;

	/**
	 * the id of my guild
	 * @var int
	 */
	protected $player_guild_id;

	/**
	 * my guildname
	 * @var string
	 */
	protected $player_guild_name;

	/**
	 * character realm
	 * @var string
	 */
	protected $player_realm;

	/**
	 * region to which the char is on
	 * @var string
	 */
	protected $player_region;


	/**
	 * Allowed regions
	 * readonly!
	 * @var array
	 */
	protected $regionlist = array( 'eu', 'us' , 'kr', 'tw', 'cn', 'sea');

	/**
	 *gender ID 0=male, 1=female
	 * @var int
	 */
	protected $player_gender_id;

	/**
	 * Achievement points
	 * @var int
	 */
	protected $player_achiev;

	/**
	 * url to armory
	 * @var string
	 */
	protected $player_armory_url;

	/**
	 * (wow) battle.net portrait url
	 * @var string
	 */
	protected $player_portrait_url;

	/**
	 * The phpBB player id linked to this player
	 * @var int
	 */
	protected $phpbb_user_id;

	/**
	 * Class color
	 * @var string
	 */
	protected $colorcode;

	/**
	 * Race icon
	 * @var string
	 */
	protected $race_image;

	/**
	 * Class icon
	 * @var string
	 */
	protected $class_image;

	/**
	 * current talent builds
	 * @var string
	 */
	protected $talents;

	/**
	 * current title
	 * @var string
	 */
	protected $player_title;


    /**
     * reason for deactivating account
     * choice between
     * - "inactivity" (>90 days)
     * - "other"
     * @var string
     */
    protected $deactivate_reason;

    /**
     * datetime of last update of this player account
     * @var int
     */
    protected $last_update;

	/**
	 * the role (for possible roles see role class)
	 * @var string
	 */
	protected $player_role;

	/**
	 * contains list of players for guild x
	 * @var array
	 */
	public $guildplayerlist;

	/**
	 * array of guilds
	 * @var array
	 */
	public $guildlist;


    /**
     * Player class constructor
     *
     * @param int $player_id
     * @param array $guildlist
     */
	function __construct($player_id = 0, $guildlist = null)
	{
		parent::__construct();
		if(isset($player_id))
		{
			if($player_id > 0)
			{
				$this->player_id = $player_id;
				$this->Getplayer();
			}
		}
		else
		{
			$this->player_id = 0;
		}

		$this->guildplayerlist = array();
		if($guildlist == null)
		{
			$guild = new Guilds();
			$this->guildlist = $guild->guildlist(1);
		}
		else
		{
			$this->guildlist = $guildlist;
		}

	}


    /**
     * player class property getter
     * @param string $fieldName
     * @return null
     */
	public function __get($fieldName)
	{
		global $user;

		if (property_exists($this, $fieldName))
		{
			return $this->$fieldName;
		}
		else
		{
			trigger_error($user->lang['ERROR'] . '  '. $fieldName, E_USER_WARNING);
		}
        return null;
	}

	/**
	 * player class property setter
	 * @param string $property
	 * @param string $value
	 */
	public function __set($property, $value)
	{
		global $user;
		switch ($property)
		{
			case 'regionlist':
				// is readonly
				break;
			default:
				if (property_exists($this, $property))
				{
					$this->$property = $value;
				}
				else
				{
					trigger_error($user->lang['ERROR'] . '  '. $property, E_USER_WARNING);
				}
		}
	}

	/**
	 * gets 1 player from database
	 */
	public function Getplayer()
	{
		global $db, $config, $phpbb_root_path;

		$sql_array = array(
			'SELECT' => 'm.*, c.colorcode , c.imagename,  c1.name AS player_class, l1.name AS player_race,
						r.image_female, r.image_male,
						g.id as guild_id, g.name as guild_name, m.player_realm , g.region' ,
			'FROM' => array(
					PLAYER_LIST_TABLE => 'm' ,
					CLASS_TABLE => 'c' ,
					BB_LANGUAGE => 'l1' ,
					RACE_TABLE => 'r' ,
					GUILD_TABLE => 'g') ,
			'LEFT_JOIN' => array(
					array(
						'FROM' => array(
							BB_LANGUAGE => 'c1') ,
						'ON' => "c1.attribute_id = c.class_id
						AND c1.game_id = c.game_id
						AND c1.language= '" . $config['bbguild_lang'] . "'
						AND c1.attribute = 'class'")) ,
			'WHERE' => "
					l1.attribute_id = r.race_id AND l1.game_id = r.game_id AND l1.language= '" . $config['bbguild_lang'] . "' AND l1.attribute = 'race'
					AND m.game_id = c.game_id
					AND m.player_class_id = c.class_id
					AND m.game_id = r.game_id
					AND m.player_race_id = r.race_id
					AND m.player_guild_id = g.id
					AND player_id = " . (int) $this->player_id);

		$sql = $db->sql_build_query('SELECT', $sql_array);
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		if ($row)
		{
			$this->player_id = $row['player_id'] ;
			$this->player_name = $row['player_name'] ;
			$this->player_race_id = $row['player_race_id'] ;
			$this->player_race = $row['player_race'] ;
			$this->player_class_id = $row['player_class_id'] ;
			$this->player_class = $row['player_class'] ;
			$this->player_level = $row['player_level'] ;
			$this->player_rank_id = $row['player_rank_id'] ;
			$this->player_comment = $row['player_comment'] ;
			$this->player_gender_id = $row['player_gender_id'] ;
			$this->player_joindate = $row['player_joindate'] ;
			$this->player_role = $row['player_role'] ;
			$this->player_joindate_d = date('j', $row['player_joindate']) ;
			$this->player_joindate_mo = date('n', $row['player_joindate']);
			$this->player_joindate_y = date('Y', $row['player_joindate']) ;
			$this->player_outdate = $row['player_outdate'];
			$this->player_outdate_d = date('j', $row['player_outdate']);
			$this->player_outdate_mo = date('n', $row['player_outdate']);
			$this->player_outdate_y = date('Y', $row['player_outdate']);
			$this->player_guild_name = $row['guild_name'];
			$this->player_guild_id = $row['guild_id'];
			$this->player_realm = $row['player_realm'];
			$this->player_region = $row['region'];
			$this->player_armory_url = $row['player_armory_url'];
			$this->player_portrait_url = $row['player_portrait_url'];
			$this->phpbb_user_id = $row['phpbb_user_id'];
			$this->player_status = $row['player_status'];
			$this->player_achiev = $row['player_achiev'];
			$this->game_id = $row['game_id'];
            $this->last_update = $row['last_update'];
            $this->deactivate_reason = $row['deactivate_reason'];
			$this->colorcode = $row['colorcode'];
			$race_image = (string) (($row['player_gender_id'] == 0) ? $row['image_male'] : $row['image_female']);
			$this->race_image = (strlen($race_image) > 1) ? $phpbb_root_path . "images/bbguild/race_images/" . $race_image . ".png" : '';
			$this->class_image = (strlen($row['imagename']) > 1) ? $phpbb_root_path . "images/bbguild/class_images/" . $row['imagename'] . ".png" : '';
			$this->player_title  = $row['player_title'];

			return $this->player_id;
		}
		else
		{
			// load games class
			$games = new Game();
			if(isset($games->games))
			{
				$this->games = $games->games;
				foreach($this->games as $key => $value)
				{
					$this->game_id = $key;
					break;
				}
			}
			unset($games);
			$this->player_id = 0 ;
			$this->player_name = '';
			$this->player_race_id = 0 ;
			$this->player_race = '' ;
			$this->player_class_id = 0;
			$this->player_class = '' ;
			$this->player_level = 1;
			$this->player_rank_id = 0;
			$this->player_comment = '' ;
			$this->player_gender_id = 0;
			$this->player_role = 'NA';
			$this->player_joindate = $this->time;
			$this->player_joindate_d = date('j', $this->time) ;
			$this->player_joindate_mo = date('n', $this->time);
			$this->player_joindate_y = date('Y', $this->time) ;
			$this->player_outdate = 0;
			$this->player_outdate_d = date('j', 0);
			$this->player_outdate_mo = date('n', 0);
			$this->player_outdate_y = date('Y', 0);
			$this->player_guild_name = '';
			$this->player_guild_id = 0;
			$this->player_realm = '';
			$this->player_region = '';
			$this->player_armory_url = '';
			$this->player_portrait_url = '';
			$this->phpbb_user_id = '';
			$this->player_status = 1;
			$this->player_achiev = 0;
			$this->colorcode = "#8899aa";
			$this->race_image = '';
			$this->class_image = '';
			$this->player_title = '';
            $this->last_update =  $this->time;
            $this->deactivate_reason = '';
            return 0;
		}
	}

    /**
     * get player id given a player name and guild
     *
     * @param string $playername
     * @param string $playerrealm
     * @param int $guild_id optional
     * @return int
     */
	public function get_player_id ($playername, $playerrealm, $guild_id = 0)
	{
		global $db;
		if($guild_id !=0)
		{
			$sql = 'SELECT player_id
                FROM ' . PLAYER_LIST_TABLE . '
                WHERE player_name ' . $db->sql_like_expression($db->any_char . $db->sql_escape($playername) . $db->any_char) . '
                AND player_realm ' . $db->sql_like_expression($db->any_char . $db->sql_escape($playerrealm) . $db->any_char) . '
                AND player_guild_id = ' . (int) $db->sql_escape($guild_id);
		}
		else
		{
			$sql = 'SELECT player_id
                FROM ' . PLAYER_LIST_TABLE . '
                WHERE player_name ' . $db->sql_like_expression($db->any_char . $db->sql_escape($playername) . $db->any_char) . '
                AND player_realm ' . $db->sql_like_expression($db->any_char . $db->sql_escape($playerrealm) . $db->any_char);
		}

		$result = $db->sql_query($sql);
        //take first one
		while ($row = $db->sql_fetchrow($result))
		{
			$membid = $row['player_id'];
			break;
		}

		$db->sql_freeresult($result);
		if (isset($membid))
		{
			return $membid;
		}
		else
		{
			return 0;
		}
	}

    /**
	 * update player
     *
     * @param Player $old_player
     * @return bool
     */
	public function Updateplayer(Player $old_player)
	{
		global $user, $db;
        global $config;

		if ($this->player_id == 0)
		{
			return false;
		}

		// if user chooses other name then check if the new name already exists. if so refuse update
		// namechange to existing playername is not allowed
		if($this->player_name != $old_player->player_name)
		{
			$sql = 'SELECT count(*) as playerexists
				FROM ' . PLAYER_LIST_TABLE . '
				WHERE player_id <> ' . $this->player_id . "
				AND UPPER(player_name) = UPPER('" . $db->sql_escape($this->player_name) . "')";
			$result = $db->sql_query($sql);
			$countm = $db->sql_fetchfield('playerexists');
			$db->sql_freeresult($result);
			if ($countm != 0)
			{
				trigger_error(sprintf($user->lang['ADMIN_UPDATE_PLAYER_FAIL'], ucwords($this->player_name)) , E_USER_WARNING);
			}
		}

			// check if rank exists
		$sql = 'SELECT count(*) as rankccount
				FROM ' . PLAYER_RANKS_TABLE . '
				WHERE rank_id=' . (int) $this->player_rank_id . ' and guild_id = ' . $this->player_guild_id;
		$result = $db->sql_query($sql);
		$countm = $db->sql_fetchfield('rankccount');
		$db->sql_freeresult($result);
		if ($countm == 0)
		{
			trigger_error($user->lang['ERROR_INCORRECTRANK'], E_USER_WARNING);
		}

		// check level
		$sql = 'SELECT max(class_max_level) as maxlevel FROM ' . CLASS_TABLE;
		$result = $db->sql_query($sql);
		$maxlevel = $db->sql_fetchfield('maxlevel');
		$db->sql_freeresult($result);
		if ($this->player_level > $maxlevel)
		{
			$this->player_level = $maxlevel;
		}

		switch ($this->game_id)
		{
			case 'aion':
				if(trim($this->player_portrait_url) == '')
				{
					$this->generate_portraitlink();
				}
				break;
		}

		// update the data including the phpbb userid
		$query = $db->sql_build_array('UPDATE', array(
			'player_name' => $this->player_name ,
			'player_realm' => $this->player_realm,
			'player_region' => $this->player_region,
			'player_status' => $this->player_status ,
			'player_level' => $this->player_level ,
			'player_race_id' => $this->player_race_id ,
			'player_class_id' => $this->player_class_id,
			'player_role' => $this->player_role,
			'player_rank_id' => $this->player_rank_id ,
			'player_gender_id' => $this->player_gender_id ,
			'player_comment' => $this->player_comment ,
			'player_guild_id' => $this->player_guild_id,
			'player_outdate' => $this->player_outdate,
			'player_joindate' => $this->player_joindate,
			'phpbb_user_id' => $this->phpbb_user_id,
			'player_armory_url' => $this->player_armory_url,
			'player_portrait_url' => $this->player_portrait_url,
			'player_achiev' => $this->player_achiev,
			'game_id' => $this->game_id,
			'player_title' => $this->player_title,
            'deactivate_reason' => $this->deactivate_reason,
            'last_update'   => $this->time
			));

        $sql = 'UPDATE ' . PLAYER_LIST_TABLE . ' SET ' . $query . '
			WHERE player_id= ' . $this->player_id;

		$db->sql_query($sql);

		// if status was 1 before then add a line in user comments and set an adjustment
		if ($this->player_status == 0 && $old_player->player_status == 1)
		{
			// update the comment including the phpbb userid
			$query = $db->sql_build_array('UPDATE', array(
				'player_comment' => $this->player_comment . '
' . sprintf($user->lang['BBGUILD_PLAYERDEACTIVATED'] , $user->data['username'], date( 'd.m.y G:i:s', $this->time ))  ,
			));

			$db->sql_query('UPDATE ' . PLAYER_LIST_TABLE . ' SET ' . $query . '
				WHERE player_id= ' . $this->player_id);

		}

        // if status was 0 before then add a line in user comments and set an adjustment
        if ($this->player_status == 1 && $old_player->player_status == 0)
        {
            // update the comment including the phpbb userid
            $query = $db->sql_build_array('UPDATE', array(
                'player_comment' => $this->player_comment . '
' . sprintf($user->lang['BBGUILD_PLAYERACTIVATED'] , $user->data['username'], date( 'd.m.y G:i:s', $this->time ))  ,
            ));
            $db->sql_query('UPDATE ' . PLAYER_LIST_TABLE . ' SET ' . $query . '
				WHERE player_id= ' . $this->player_id);
        }

        $log_action = array(
			'header' => 'L_ACTION_PLAYER_UPDATED' ,
			'L_NAME' => $this->player_name ,
			'L_NAME_BEFORE' => $old_player->player_name,
			'L_LEVELBEFORE' => $old_player->player_level,
			'L_RACE_BEFORE' => $old_player->player_race_id,
			'L_RANK_BEFORE' => $old_player->player_rank_id,
			'L_CLASS_BEFORE' => $old_player->player_class_id,
			'L_GENDER_BEFORE' => $old_player->player_gender_id,
			'L_ACHIEV_BEFORE' => $old_player->player_achiev,
			'L_NAME_AFTER' => $this->player_name,
			'L_LEVELAFTER' => $this->player_level,
			'L_RACE_AFTER' => $this->player_race_id ,
			'L_RANK_AFTER' => $this->player_rank_id,
			'L_CLASS_AFTER' => $this->player_class_id ,
			'L_GENDER_AFTER' => $this->player_gender_id,
			'L_ACHIEV_AFTER' => $this->player_achiev,
			'L_UPDATED_BY' => $user->data['username']);

		$this->log_insert(array(
			'log_type' => $log_action['header'] ,
			'log_action' => $log_action));

        return true;

	}

	/**
	 * delete player from all tables
	 */
	public function Deleteplayer()
	{
		global $user, $db;

		$sql = 'DELETE FROM ' . PLAYER_LIST_TABLE . ' where player_id = ' . (int) $this->player_id;
		$db->sql_query($sql);

		$log_action = array(
			'header' => sprintf($user->lang['ACTION_PLAYER_DELETED'], $this->player_name) ,
			'L_NAME' => $this->player_name ,
			'L_LEVEL' => $this->player_level ,
			'L_RACE' => $this->player_race_id ,
			'L_CLASS' => $this->player_class_id);

		$this->log_insert(array(
			'log_type' => $log_action['header'] ,
			'log_action' => $log_action));

	}

    /**
     * Insert new player
     * @return number
     */
    public function Makeplayer()
    {
        global $user, $db, $config;

        $error = array ();

        //perform checks

        // check if playername exists
        $sql = 'SELECT count(*) as playerexists
				FROM ' . PLAYER_LIST_TABLE . "
				WHERE player_name= '" . $db->sql_escape(ucwords($this->player_name)) . "'
				AND player_realm= '" . $db->sql_escape(ucwords($this->player_realm)) . "'
				AND player_guild_id = " . $this->player_guild_id;
        $result = $db->sql_query($sql);
        $countm = $db->sql_fetchfield('playerexists');
        $db->sql_freeresult($result);
        if ($countm != 0)
        {
            $error[]= $user->lang['ERROR_PLAYEREXIST'];
        }

        if($this->player_rank_id === null)
        {
            $error[]= $user->lang['ERROR_INCORRECTRANK'];
        }

        if($this->player_status === null )
        {
            $this->player_status = 1;
        }

        if($this->player_title === null )
        {
            $this->player_title = ' ';
        }

        // check if rank exists
        $sql = 'SELECT count(*) as rankccount
			FROM ' . PLAYER_RANKS_TABLE . '
			WHERE rank_id=' . (int) $this->player_rank_id . '
			AND guild_id = ' . (int) $this->player_guild_id;
        $result = $db->sql_query($sql);
        $countm = $db->sql_fetchfield('rankccount');
        $db->sql_freeresult($result);
        if ($countm == 0)
        {
            $error[]= $user->lang['ERROR_INCORRECTRANK'];
        }

        if (count($error) > 0)
        {
            $log_action = array(
                'header' 	 => 'L_ACTION_PLAYER_ADDED' ,
                'L_NAME' 	 => ucwords($this->player_name) . implode(',', $error)  ,
                'L_GAME' 	 => $this->game_id,
                'L_LEVEL' 	 => $this->player_level,
                'L_RACE' 	 => $this->player_race_id,
                'L_CLASS' 	 => $this->player_class_id,
                'L_ADDED_BY' => $user->data['username']);

            $this->log_insert(array(
                'log_type' 		=> 'L_ACTION_PLAYER_ADDED' ,
                'log_result' 	=> 'L_FAILED' ,
                'log_action' 	=> $log_action));

            return 0;
        }

        // check level
        $sql = 'SELECT max(class_max_level) as maxlevel FROM ' . CLASS_TABLE;
        $result = $db->sql_query($sql);
        $maxlevel = $db->sql_fetchfield('maxlevel');
        $db->sql_freeresult($result);
        if ($this->player_level > $maxlevel)
        {
            $this->player_level = $maxlevel;
        }

        // if region/realm is nil then default it from guild
        if($this->player_realm =='' or  $this->player_region =='')
        {
            $sql = 'SELECT realm, region FROM ' . GUILD_TABLE . ' WHERE id = ' . (int) $this->player_guild_id;
            $result = $db->sql_query($sql);
            $this->player_realm  = $config['bbguild_default_realm'];
            $this->player_region = '';
            while ($row = $db->sql_fetchrow($result))
            {
                $this->player_realm = $row['realm'];
                $this->player_region = $row['region'];
            }
        }

        $game = new Game;
        $game->game_id = $this->game_id;
        $game->Get();

        switch ($this->game_id)
        {
            case 'aion':
                $this->player_portrait_url = $this->generate_portraitlink();
        }

        $this->last_update = $this->time;
        $query = $db->sql_build_array('INSERT', array(
            'player_name' => ucwords($this->player_name) ,
            'player_status' => $this->player_status ,
            'player_level' => $this->player_level,
            'player_race_id' => $this->player_race_id ,
            'player_class_id' => $this->player_class_id ,
            'player_rank_id' => $this->player_rank_id ,
            'player_role' => $this->player_role,
            'player_realm' => $this->player_realm,
            'player_region' => $this->player_region,
            'player_comment' => (string) $this->player_comment ,
            'player_joindate' => (int) $this->player_joindate ,
            'player_outdate' => (int) $this->player_outdate ,
            'player_guild_id' => $this->player_guild_id ,
            'player_gender_id' => $this->player_gender_id ,
            'player_achiev' => $this->player_achiev ,
            'player_armory_url' => (string) $this->player_armory_url ,
            'phpbb_user_id' => (int) $this->phpbb_user_id ,
            'game_id' => (string) $this->game_id ,
            'player_portrait_url' => (string) $this->player_portrait_url,
            'player_title' => $this->player_title,
            'last_update' => $this->last_update,
        ));

        $db->sql_query('INSERT INTO ' . PLAYER_LIST_TABLE . $query);

        $this->player_id = $db->sql_nextid();
        
        $log_action = array(
            'header' 	 => 'L_ACTION_PLAYER_ADDED' ,
            'L_NAME' 	 => ucwords($this->player_name)  ,
            'L_GAME' 	 => $this->game_id,
            'L_LEVEL' 	 => $this->player_level,
            'L_RACE' 	 => $this->player_race_id,
            'L_CLASS' 	 => $this->player_class_id,
            'L_ADDED_BY' => $user->data['username']);

        $this->log_insert(array(
            'log_type' => 'L_ACTION_PLAYER_ADDED' ,
            'log_action' => $log_action));

        return $this->player_id;

    }


	/**
	 * fetch info from Armory
	 *
	 * @return integer
	 */
	public function Armory_getplayer()
	{
		global $user;

		$game = new Game;
		$game->game_id = $this->game_id;
		$game->Get();

		if ($this->game_id != 'wow')
		{
            $this->player_portrait_url = '';
            $this->deactivate_reason = '';
			return -1;
		}

		if ($game->getArmoryEnabled() == 0)
		{
			return -1;
		}

        //Initialising the class
		/**
			* available extra fields :
		 * 'guild','stats','talents','items','reputation','titles','professions','appearance',
		 * 'companions','mounts','pets','achievements','progression','pvp','quests'
		 */
		$api = new BattleNet('character', $this->player_region, $game->getApikey(),$game->getApilocale() , $game->getPrivkey() , $this->ext_path);
		$params = array('guild', 'titles', 'talents' );

		$data = $api->Character->getCharacter($this->player_name, $this->player_realm, $params);
		unset($api);

		// if $data == false then there is no character data, so
        if (!isset ($data) || !isset($data['response']))
        {
            $this->armoryresult = 'KO';
            $log_action = array(
                'header'       => 'L_ERROR_ARMORY_DOWN',
                'L_UPDATED_BY' => $user->data['username'],
                'L_GUILD' => $this->name . '-' . $this->realm,
            );

            $this->log_insert(array(
                'log_type'   => $log_action['header'],
                'log_action' => $log_action,
                'log_result' => 'L_ERROR'
            ));
            return -1;
        }

        $data = $data['response'];

        //if we get error code
        if (isset($data['code']))
        {
            if($data['code'] == '403')
            {
                // even if we have active API account, it may be that Blizzard account is inactive
                $this->armoryresult = 'KO';
                $log_action = array(
                    'header'       => 'L_ERROR_BATTLENET_ACCOUNT_INACTIVE',
                    'L_UPDATED_BY' => $user->data['username'],
                    'L_GUILD' => $this->name . '-' . $this->realm,
                );

                $this->log_insert(array(
                    'log_type'   => $log_action['header'],
                    'log_action' => $log_action,
                    'log_result' => 'L_ERROR'
                ));
                return -1;

            }
        }

        if (isset($data['reason']))
        {
            //not found in armory
            $this->player_status = 0;
            $this->deactivate_reason = 'DEACTIVATED_BY_API';
            return -1;

        }

        $this->player_level = isset($data['level']) ? $data['level'] : $this->player_level;
        $this->player_race_id = isset($data['race']) ? $data['race'] : $this->player_race_id;
        $this->player_class_id = isset($data['class']) ? $data['class'] : $this->player_class_id;

        /*
         * select the build
        */
        $buildid = 0;
        if(isset($data['talents'][0]) && isset( $data['talents'][1]) )
        {
            if( isset($data['talents'][0]['selected']))
            {
                $buildid = 0;
            }
            elseif(isset($data['talents'][1]['selected']))
            {
                $buildid = 1;
            }
        }
        elseif(isset( $data['talents'][0]))
        {
            $buildid = 0;
        }
        elseif(isset( $data['talents'][1]))
        {
            $buildid = 1;
        }

        $conversion_array = array(
            'DPS' => 0,
            'HEALING' => 1,
            'TANK' => 2,
        );

        $role = isset($data['talents'][$buildid]['spec']['role']) ? $data['talents'][$buildid]['spec']['role'] : 'DPS';

        if (isset($role) && in_array($role,$conversion_array))
        {
            $this->player_role = $conversion_array[$role];
        }

        $this->player_gender_id = isset($data['gender']) ? $data['gender'] : $this->player_gender_id;
        $this->player_achiev = isset($data['achievementPoints']) ? $data['achievementPoints'] : $this->player_achiev;

        if(isset($data['name']))
        {
            $this->player_armory_url = sprintf('http://%s.battle.net/wow/en/', $this->player_region) . 'character/' . $this->player_realm . '/' . $data ['name'] . '/simple';
        }

        if(isset($data['thumbnail']))
        {
            $this->player_portrait_url = sprintf('http://%s.battle.net/static-render/%s/', $this->player_region, $this->player_region) . $data['thumbnail'];
        }

        if(isset($data['realm']))
        {
            $this->player_realm = $data['realm'];
        }

        if (isset($data['guild']))
        {
            $found=false;
            foreach($this->guildlist as $guild)
            {
                if(strtolower($guild['name']) == strtolower($data['guild']['name']))
                {
                    $this->player_guild_id = $guild['id'];
                    $this->player_guild_name = $guild['name'];
                    $found=true;
                    break;
                }
            }
            if($found==false)
            {
                $this->player_guild_id = 0;
                $this->player_rank_id = 99;
            }
        }
        else
        {
            $this->player_guild_id = 0;
            $this->player_rank_id = 99;
        }

        if (isset($data['titles']))
        {
            foreach($data['titles'] as $key => $title)
            {
                if (isset($title['selected']))
                {
                    $this->player_title = $title['name'];
                    break;
                }
            }
        }

        //if the last logged-in date is > 3 months ago then disable the account
        if( isset($data['lastModified']))
        {
            $latest = $data['lastModified'];
            $diff = \round( \abs ( \time() - ($latest/1000)) / 60 / 60 / 24, 2) ;
            if($diff > 90 && $this->player_status == 1)
            {
                $this->player_status = 0;
                $this->deactivate_reason = 'DEACTIVATED_BY_API';

            }
            if($diff < 90 && $this->player_status == 0 && $this->deactivate_reason == 'DEACTIVATED_BY_API')
            {
                $this->player_status = 1;
                $this->deactivate_reason = '';

            }
        }

        return 1;

	}

     /* activates all checked players
     *
     *  for each player in $mwindow
     *   get player
     *   if player is in $mlist
     *       add activation dkp
     *   else
     *      if player status was active then deactivate and add deactivation dkp
     *
     * @param array $mlist
     * @param array $mwindow
     */
    public function Activateplayers(array $mlist, array $mwindow)
    {
        foreach($mwindow as $player_id)
        {
            $this->player_id = $player_id;
            $this->Getplayer();
            if (in_array($player_id,$mlist))
            {
                $this->Activate_player();
            }
            else
            {
                $this->Deactivate_player();
            }
        }
    }

    /**
     * @internal param $config
     * @internal param $user
     * @return bool
     */
    private function Activate_player()
    {
        global $config, $user,  $db;
        $changed = false;
        if ($this->player_status == "0")
        {
            $changed = true;
            $this->player_status = "1";
        }

        if ($changed)
        {
            $query = $db->sql_build_array('UPDATE', array(
                'player_status' => $this->player_status ,
            ));

            $db->sql_query('UPDATE ' . PLAYER_LIST_TABLE . ' SET ' . $query . '
                WHERE player_id= ' . $this->player_id);
        }

        $log_action = array(
            'header' 	 => 'L_ACTION_PLAYER_ACTIVATED' ,
            'L_NAME' 	 => \ucwords($this->player_name)  ,
            'L_ADDED_BY' => $user->data['username']);

        $this->log_insert(array(
            'log_type' 		=> 'L_ACTION_PLAYER_ACTIVATED' ,
            'log_result' 	=> 'L_SUCCESS' ,
            'log_action' 	=> $log_action));


        return $changed;
    }

    /**
     * @internal param $config
     * @internal param $user
     * @return bool
     */
    private function Deactivate_player()
    {
        global $config, $user, $db;
        $changed = false;
        if ($this->player_status == "1")
        {
            $changed = true;
            $this->player_status = "0";
        }

        if ($changed)
        {
            $query = $db->sql_build_array('UPDATE', array(
                'player_status' => $this->player_status ,
            ));

            $db->sql_query('UPDATE ' . PLAYER_LIST_TABLE . ' SET ' . $query . '
                WHERE player_id= ' . $this->player_id);
        }

        $log_action = array(
            'header' 	 => 'L_ACTION_PLAYER_DEACTIVATED' ,
            'L_NAME' 	 => \ucwords($this->player_name)  ,
            'L_ADDED_BY' => $user->data['username']);

        $this->log_insert(array(
            'log_type' 		=> 'L_ACTION_PLAYER_DEACTIVATED' ,
            'log_result' 	=> 'L_SUCCESS' ,
            'log_action' 	=> $log_action));

        return $changed;
    }


	/**
	 * generates a standard portrait image url for aion based on characterdata
	 */
	private function generate_portraitlink()
	{
	    $this->player_portrait_url = $this->ext_path . 'images/roster_portraits/aion/' . $this->player_race_id . '_' . $this->player_gender_id . '.jpg';
        return $this->player_portrait_url;
	}

	/**
	 * function for removing player from guild but leave him in the player table.;
	 * @param string $player_name
	 * @param int $guild_id
	 * @return boolean
	 * @todo fix this
	 */
	public function GuildKick($player_name, $guild_id)
	{
		global $db, $user;
		// find id for existing player name
		$sql = "SELECT *
				FROM " . PLAYER_LIST_TABLE . "
				WHERE player_name = '" . $db->sql_escape($player_name) . "' and player_guild_id = " . (int) $guild_id;
		$result = $db->sql_query($sql);
		// get old data
		while ($row = $db->sql_fetchrow($result))
		{
			$this->old_player = array(
					'player_id' => $row['player_id'] ,
					'player_rank_id' => $row['player_rank_id'] ,
					'player_guild_id' => $row['player_guild_id'] ,
					'player_comment' => $row['player_comment']);
		}
		$db->sql_freeresult($result);

		$sql_arr = array(
			'player_rank_id' => 99 ,
			'player_comment' => "Player left " . date("F j, Y, g:i a") . ' by Armory plugin' ,
			'player_outdate' => $this->time ,
			'player_guild_id' => 0);

        $sql = 'UPDATE ' . PLAYER_LIST_TABLE . '
			SET ' . $db->sql_build_array('UPDATE', $sql_arr) . '
			WHERE player_id = ' . (int) $this->old_player['player_id'] . ' and player_guild_id = ' . (int) $this->old_player['player_guild_id'];

		$db->sql_query($sql);

		$log_action = array(
			'header' => 'L_ACTION_PLAYER_UPDATED' ,
			'L_NAME' => $player_name ,
			'L_RANK_BEFORE' => $this->old_player['player_rank_id'] ,
			'L_COMMENT_BEFORE' => $this->old_player['player_comment'] ,
			'L_RANK_AFTER' => 99 ,
			'L_COMMENT_AFTER' => "Player left " . date("F j, Y, g:i a") . ' by Armory plugin' ,
			'L_UPDATED_BY' => $user->data['username']);

		$this->log_insert(array(
			'log_type' => $log_action['header'] ,
			'log_action' => $log_action));

		return true;
	}

	/**
	 * Process Blizzard Battle.NET Character API data
	 * @param array $playerdata
	 * @param int $guild_id
	 * @param string $region
	 * @param int $min_armory
	 */
	public function WoWArmoryUpdate($playerdata, $guild_id, $region, $min_armory)
	{
		global $user, $db;

		$player_ids = array();
		$oldplayers = array();
		$newplayers = array();

		/* GET OLD RANKS */
		$sql = ' select player_name, player_id, player_realm FROM ' . PLAYER_LIST_TABLE . '
				WHERE player_guild_id =  ' . (int) $guild_id . "
				AND game_id='wow' order by player_name ASC";
		$result = $db->sql_query ($sql);
		while ($row = $db->sql_fetchrow ($result))
		{
			$oldplayers[] = $row['player_name'] . '-' . $row['player_realm'];

			//this is to find the playerindex when updating
			$player_ids[ bin2hex($row['player_name'] . '-' . $row['player_realm'])] = $row['player_id'];

		}
		$db->sql_freeresult ( $result );

		foreach($playerdata as $mb)
		{
			$newplayers[] = $mb['character']['name'] . '-' . $mb['character']['realm'];
		}

		// get the new players to insert
		$to_add = array_diff($newplayers, $oldplayers);

		// start transaction
		$db->sql_transaction('begin');

		foreach($playerdata as $mb)
		{
			if (in_array($mb['character']['name'] . '-' . $mb['character']['realm'], $to_add) && $mb['character']['level'] >= $min_armory )
			{
				if(!isset( $mb['character']['realm']))
				{
					$realm = 'unknown';
				}
				else
				{
					$realm = $mb['character']['realm'];
				}

				if(isset($mb['character']['realm']))
				{
					$this->player_realm = $mb['character']['realm'];
				}
				$this->game_id ='wow';
				$this->player_region = $region;
				$this->player_guild_id = $guild_id;
				$this->player_rank_id = isset($mb['rank']) ? $mb['rank'] : 1;
				$this->player_name = $mb['character']['name'];
				$this->player_level = (int) $mb['character']['level'];
				$this->player_gender_id = (int) $mb['character']['gender'];
				$this->player_race_id = (int) $mb['character']['race'];
				$this->player_class_id = (int) $mb['character']['class'];
				$this->player_achiev = (int) $mb['character']['achievementPoints'];
				$this->player_armory_url = sprintf('http://%s.battle.net/wow/en/', $region) . 'character/' . $realm . '/' . $this->player_name . '/simple';
				$this->player_status = 1;
                $this->player_role = 'NA';
				$this->player_comment = sprintf($user->lang['ADMIN_ADD_PLAYER_SUCCESS'], $this->player_name, date("F j, Y, g:i a") );
				$this->player_joindate = $this->time;
				$this->player_outdate = mktime ( 0, 0, 0, 12, 31, 2030 );
				$this->player_portrait_url = sprintf('http://%s.battle.net/static-render/%s/', $region, $region) . $mb['character']['thumbnail'];
				$this->player_title = '';
				if (isset($mb['titles']))
				{
					foreach($mb['titles'] as $key => $title)
					{
						if (isset($title['selected']))
						{
							$this->player_title = $title['name'];
						}
					}
				}
                $this->Makeplayer();
			}
		}



		// get the players to update
		$to_update = array_intersect($newplayers, $oldplayers);
		foreach($playerdata as $mb)
		{

			if(!isset( $mb['character']['realm']))
			{
				$realm = 'unknown';
			}
			else
			{
				$realm = $mb['character']['realm'];
			}

			if (in_array($mb['character']['name'] . '-' . $mb['character']['realm'], $to_update))
			{
				$player_id =  (int) $player_ids[bin2hex($mb['character']['name'] . '-' . $mb['character']['realm'])];
				$this->game_id ='wow';
				$this->player_region = $region;
				$this->player_realm = $mb['character']['realm'];
				$this->player_rank_id = $mb['rank'];
				$this->player_name = $mb['character']['name'];
				$this->player_guild_id = $guild_id;
				$this->player_level = (int) $mb['character']['level'];
				$this->player_gender_id = (int) $mb['character']['gender'];
				$this->player_race_id = (int) $mb['character']['race'];
				$this->player_class_id = (int) $mb['character']['class'];
				$this->player_achiev = (int) $mb['character']['achievementPoints'];
				$this->player_armory_url = sprintf('http://%s.battle.net/wow/en/', $region) . 'character/' . $realm  . '/' . $this->player_name . '/simple';
				$this->player_portrait_url = sprintf('http://%s.battle.net/static-render/%s/', $region, $region) . $mb['character']['thumbnail'];

				$sql_ary = array (
					'player_name' => ucwords($this->player_name) ,
					'player_level' => $this->player_level,
					'player_race_id' => $this->player_race_id ,
					'player_realm' => $this->player_realm,
					'player_region' => $this->player_region,
					'player_class_id' => $this->player_class_id ,
					'player_rank_id' => $this->player_rank_id ,
					'player_guild_id' => $this->player_guild_id ,
					'player_gender_id' => $this->player_gender_id ,
					'player_achiev' => $this->player_achiev ,
					'player_armory_url' => (string) $this->player_armory_url ,
					'player_portrait_url' => (string) $this->player_portrait_url,
				);


				$sql = 'UPDATE ' . PLAYER_LIST_TABLE . '
						SET ' . $db->sql_build_array('UPDATE', $sql_ary) . '
						WHERE player_id = ' . $player_id;
				$db->sql_query($sql);
			}
		}

        $db->sql_transaction('commit');



	}


    /**
	 * Enter joindate for guildplayer (query is cached for 1 week !)
     *
     * @param $player_id
     * @return bool|mixed
     */
	public function get_joindate($player_id)
	{
		// get player joindate
		global $db;
		$sql = 'SELECT player_joindate  FROM ' . PLAYER_LIST_TABLE . ' WHERE player_id = ' . $player_id;
		$result = $db->sql_query($sql,3600);
		$joindate = $db->sql_fetchfield('player_joindate');

		$db->sql_freeresult($result);
		return $joindate;

	}


    /**
     * ACP listplayers grid
     * get a player list for given guild
     *
     * @param int $guild_id
     * @param bool $assignedonly
     */
	public function listallplayers($guild_id = 0, $assignedonly=false)
	{
		global $db;

		$sql_array = array(
			'SELECT'    => 'r.rank_name, m.player_id ,m.player_name, m.player_realm ',
			'FROM'      => array(
					PLAYER_LIST_TABLE 	  => 'm',
					PLAYER_RANKS_TABLE    => 'r',
			),

			'WHERE'     =>  ' m.player_guild_id = r.guild_id
								AND m.player_rank_id = r.rank_id
								AND r.rank_hide != 1 ',
			'ORDER_BY' => 'm.player_rank_id asc, m.player_level desc, m.player_name asc'
		);

		if($assignedonly == true)
		{
			$sql_array['WHERE'] .= ' AND m.phpbb_user_id = 0 ';
		}

		if($guild_id != 0)
		{
			$sql_array['WHERE'] .= ' AND m.player_guild_id = ' . $guild_id;
		}

		$sql = $db->sql_build_query('SELECT', $sql_array);
		$result = $db->sql_query ( $sql );

		while ( $row = $db->sql_fetchrow ( $result ) )
		{
			$this->guildplayerlist[] = array(
				'player_id' 	=> $row['player_id'],
				'player_name' 	=> $row['player_name'],
				'rank_name'  	=> $row['rank_name'],
				'player_realm'	=> $row['player_realm'],
			);
		}

		$db->sql_freeresult( $result );
	}

	/**
	 * Claim a character to your phpbb User
	 */
	public function Claim_Player()
	{
		global $db, $user;

		$sql_ary = array(
				'phpbb_user_id'	=> $user->data['user_id'],
		);

		$sql = 'UPDATE ' . PLAYER_LIST_TABLE . '
						SET ' . $db->sql_build_array('UPDATE', $sql_ary) . '
						WHERE player_id = ' . $this->player_id;
		$db->sql_query($sql);
	}

	/**
	 * check if user exceeded allowed character count
	 *
	 * @return boolean
	 */
	public function has_reached_maxbbguildaccounts()
	{
		global $config, $user, $db;
		$sql = 'SELECT count(*) as charcount
				FROM ' . PLAYER_LIST_TABLE . '
				WHERE phpbb_user_id = ' . (int) $user->data['user_id'];
		$result = $db->sql_query($sql);
		$countc = $db->sql_fetchfield('charcount');
		$db->sql_freeresult($result);

		if ($countc >= $config['bbguild_maxchars'])
		{
			return true;
		}
		else
		{
			return false;
		}
	}

    /**
     * Frontview : player Roster listing
     *
     * @param $start
     * @param $mode ('listing' or 'class')
     * @param $query_by_armor
     * @param $query_by_class
     * @param $filter
     * @param $game_id
     * @param int $guild_id optional=0
     * @param int $class_id optional=0
     * @param int $race_id optional=0
     * @param int $level1 optional=1
     * @param int $level2 optional=200
     * @param bool $mycharsonly optional=false
     * @param string $player_filter optional = ''
     * @param int $all
     * @return array
     *
     */
    public function getplayerlist($start, $mode, $query_by_armor, $query_by_class, $filter,
			$game_id, $guild_id = 0, $class_id = 0, $race_id = 0, $level1=0, $level2=200, $mycharsonly=false, $player_filter = '' , $all=1)
	{
		global $db, $config, $user, $phpbb_root_path;
		$sql_array = array();

		$sql_array['SELECT'] =  'm.player_id, m.game_id, m.player_guild_id,  m.player_name, m.player_level, m.player_race_id, e1.name as race_name,
    		m.player_class_id, m.player_gender_id, m.player_rank_id, m.player_achiev, m.player_armory_url, m.player_portrait_url, m.player_status,
    		r.rank_prefix , r.rank_name, r.rank_suffix, e.image_female, e.image_male,
    		g.name as guildname, m.player_realm, g.region, c1.name as class_name, c.colorcode, c.imagename, m.phpbb_user_id, u.username, u.user_colour  ';

		$sql_array['FROM'] = array(
				PLAYER_LIST_TABLE    =>  'm',
				CLASS_TABLE          =>  'c',
				GUILD_TABLE          =>  'g',
				PLAYER_RANKS_TABLE   =>  'r',
				RACE_TABLE           =>  'e',
				BB_LANGUAGE			 =>  'e1');

		$sql_array['LEFT_JOIN'] = array(
				array(
						'FROM'  => array(USERS_TABLE => 'u'),
						'ON'    => 'u.user_id = m.phpbb_user_id '),
				array(
						'FROM'  => array(BB_LANGUAGE => 'c1'),
						'ON'    => "c1.attribute_id = c.class_id AND c1.language= '" . $config['bbguild_lang'] . "' AND c1.attribute = 'class'  and c1.game_id = c.game_id "
				));

		$sql_array['WHERE'] = " c.class_id = m.player_class_id
			AND c.game_id = m.game_id
			AND e.race_id = m.player_race_id
			AND e.game_id = m.game_id
			AND g.id = m.player_guild_id

			AND r.guild_id = m.player_guild_id
			AND r.rank_id = m.player_rank_id AND r.rank_hide = 0
			 ";

        if($all != 1)
        {
            $sql_array['WHERE'] .= " AND m.player_status = '1' ";
        }

		if ($mycharsonly ==false)
		{
			$sql_array['WHERE'] .= " AND m.player_level >= ".  intval($config['bbguild_minrosterlvl']) ;
		}

        if ($player_filter != '')
        {
            $sql_array['WHERE'] .= ' AND lcase(m.player_name) ' . $db->sql_like_expression($db->any_char . $db->sql_escape(mb_strtolower($player_filter)) . $db->any_char);
        }

        $sql_array['WHERE'] .= " AND m.player_rank_id != 99
			AND e1.attribute_id = e.race_id AND e1.language= '" . $config['bbguild_lang'] . "'
			AND e1.attribute = 'race' and e1.game_id = e.game_id";


		if($game_id != '' )
		{
			$sql_array['WHERE'] .= " AND m.game_id =  '" .  $db->sql_escape($game_id) . "'";
		}

		if($mycharsonly == true)
		{
			$sql_array['WHERE'] .= ' AND m.phpbb_user_id =  ' . $user->data['user_id'];
		}

		if($guild_id > 0)
		{
			$sql_array['WHERE'] .= " AND m.player_guild_id =  " . $guild_id;
		}

		if($class_id > 0 && $query_by_class == true)
		{
			$sql_array['WHERE'] .= " AND m.player_class_id =  " . $class_id;
		}

		if($race_id > 0)
		{
			$sql_array['WHERE'] .= " AND m.player_race_id =  " . $race_id;
		}

		if($level1 > 0)
		{
			$sql_array['WHERE'] .= " AND m.player_level >=  " . $level1;
		}

		if($level2 != 200)
		{
			$sql_array['WHERE'] .= " AND m.player_level <=  " . $level2;
		}

		if ($filter != '' && $query_by_armor == true)
		{
			$sql_array['WHERE'] .= " AND c.class_armor_type =  '" . $db->sql_escape ( $filter ) . "'";
		}

		// order
		$sort_order = array(
				0 => array('m.player_name', 'm.player_name desc'),
				1 => array('m.game_id', 'm.player_name desc'),
				2 => array('m.player_class_id', 'm.player_class_id desc'),
				3 => array('m.player_rank_id', 'm.player_rank_id desc'),
				4 => array('m.player_level', 'm.player_level  desc'),
				5 => array('u.username', 'u.username desc'),
				6 => array('m.player_achiev', 'm.player_achiev  desc')
		);

		$current_order = $this->switch_order($sort_order);

		if( $mode == 1)
		{
			$sql_array['ORDER_BY']  = " m.player_class_id, " . $current_order['sql'];
		}
		elseif ($mode == 0)
		{
			$sql_array['ORDER_BY']  = $current_order['sql'];
		}

		$sql = $db->sql_build_query('SELECT', $sql_array);

		if ($mode == 0)
		{
			// LISTING MODE
			$player_count=0;

			// get playercount in selection
			$result = $db->sql_query($sql);
			while ($row = $db->sql_fetchrow($result))
			{
				$player_count++;
			}

			//now get wanted window
			$result = $db->sql_query_limit ( $sql, $config ['bbguild_user_llimit'], $start );
			$dataset = $db->sql_fetchrowset($result);
		}
		elseif ($mode == 1)
		{
			// CLASS mode
			$result = $db->sql_query($sql);
			$dataset = $db->sql_fetchrowset($result);
			$player_count = count($dataset);
		}

		$db->sql_freeresult($result);

		$characters = array();

		foreach ($dataset as $row)
		{
			$characters[]= array(
					'game_id' => $this->games[$row['game_id']],
					'player_id' => $row['player_id'],
					'player_name' => $row['player_name'],
					'guildname' => $row['guildname'],
					'realm'	=> $row['player_realm'],
					'region'	=> $row['region'],
					'colorcode' => $row['colorcode'],
					'player_class_id' => $row['player_class_id'],
					'class_name' => $row['class_name'],
					'class_image' => $phpbb_root_path . 'images/bbguild/class_images/' . $row['imagename'] . '.png',
					'race_name' => $row['race_name'],
					'player_gender_id' => $row['player_gender_id'],
					'race_image' =>  $phpbb_root_path . 'images/bbguild/race_images/' . (($row['player_gender_id']==0) ? $row['image_male'] : $row['image_female']) . '.png',
					'image_female' => $row['image_female'],
					'image_male' => $row['image_male'],
					'player_rank'	=> $row['rank_prefix'] . ' ' . $row['rank_name'] . ' ' . $row['rank_suffix'],
					'player_level' => $row['player_level'],
					'username' => get_username_string('full', $row['phpbb_user_id'], $row['username'], $row['user_colour']),
					'player_portrait_url' => $row['player_portrait_url'],
					'player_armory_url' => $row['player_armory_url'],
					'player_achiev' => $row['player_achiev'],
                    'player_status' => $row['player_status'],
			);
		}
		$db->sql_freeresult($result);

		return array($characters, $current_order, $player_count);
	}

	/**
	 * Frontview : gets all classes in roster selection
	 *
	 * @param string $filter
	 * @param bool $query_by_armor
	 * @param int $classid
	 * @param string $game_id
	 * @param int $guild_id
	 * @param int $race_id
	 * @param int $level1
	 * @param int $level2
	 * @return array
	 */
	public function get_classes($filter, $query_by_armor, $classid, $game_id, $guild_id = 0,  $race_id = 0, $level1=0, $level2=200)
	{
		global $db, $user, $config;
		$sql_array = array(
				'SELECT'    => 'c.class_id, c1.name as class_name, c.imagename, c.colorcode' ,
				'FROM'      => array(
						PLAYER_LIST_TABLE    =>  'm',
						CLASS_TABLE          =>  'c',
						BB_LANGUAGE			=>  'c1',
						PLAYER_RANKS_TABLE   =>  'r',
				),
				'WHERE'     => " c.class_id = m.player_class_id
    							AND c.game_id = m.game_id
    							AND r.guild_id = m.player_guild_id
    							AND r.rank_id = m.player_rank_id AND r.rank_hide = 0
    							AND c1.attribute_id =  c.class_id AND c1.language= '" . $config['bbguild_lang'] . "' AND c1.attribute = 'class'
    							AND (c.game_id = '" . $db->sql_escape($game_id) . "')
    							AND c1.game_id=c.game_id

    							",
				'ORDER_BY'  =>  'c1.name asc',
				'GROUP_BY'  =>  'c.class_id, c1.name, c.imagename, c.colorcode'
		);

		// filters
		if ($filter != $user->lang['ALL'] && $query_by_armor == true)
		{
			$sql_array['WHERE'] .= " AND c.class_armor_type =  '" . $db->sql_escape ( $filter ) . "'";
		}

		if($guild_id > 0)
		{
			$sql_array['WHERE'] .= " AND m.player_guild_id =  " . $guild_id;
		}

		if($filter != $user->lang['ALL']  && $classid > 0)
		{
			$sql_array['WHERE'] .= " AND m.player_class_id =  " . $classid;
		}

		if($race_id > 0)
		{
			$sql_array['WHERE'] .= " AND m.player_race_id =  " . $race_id;
		}

		if($level1 > 0)
		{
			$sql_array['WHERE'] .= " AND m.player_level >=  " . $level1;
		}

		if($level2 != 200)
		{
			$sql_array['WHERE'] .= " AND m.player_level <=  " . $level2;
		}

		$sql = $db->sql_build_query('SELECT', $sql_array);
		$result = $db->sql_query($sql);
		$dataset = $db->sql_fetchrowset($result);
		$db->sql_freeresult($result);
		unset ($result);
		return $dataset;
	}

}