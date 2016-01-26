<?php
/**
 * Guilds class
 *
 * @package bbguild v2.0
 * @copyright 2016 bbDKP <https://github.com/bbDKP>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace bbdkp\bbguild\model\player;
use bbdkp\bbguild\model\admin\Admin;
use bbdkp\bbguild\model\games\Game;
use bbdkp\bbguild\model\player\Player;
use bbdkp\bbguild\model\player\Ranks;
use bbdkp\bbguild\model\wowapi\BattleNet;

/**
 * Manages Guild creation
 * @package bbdkp\bbguild\model\player
 * @property int $game_id
 * @property int $guildid
 * @property string $name
 * @property string $realm
 * @property string $region
 * @property int $achievements
 * @property int $playercount
 * @property int $startdate
 * @property int $showroster
 * @property int $min_armory
 * @property int $recstatus
 * @property int $guilddefault
 * @property int $aionlegionid
 * @property int $aionserverid
 * @property int $achievementpoints
 * @property int $level
 * @property string $emblempath
 * @property array $emblem
 * @property string $battlegroup
 * @property string $guildarmoryurl
 * @property array $playerdata
 * @property int $side
 * @property array $possible_recstatus
 * @property boolean $armory_enabled
 * @property int $raidtrackerrank
 * @property int $applyrank
 * @property string $armoryresult
 * @property int $recruitforum
 * @property array $guildnews
 *
 */
class Guilds extends Admin
{
	/**
	 * guild game id
	 * @var string
	 */
	public $game_id = '';
	/**
	 * Guild pk
	 * @var int
	 */
	public $guildid = 0;
	/**
	 * guild name
	 * @var string
	 */
	private $name = '';
	/**
	 * guiled realm
	 * @var string
	 */
	protected $realm = '';
	/**
	 * guild region
	 * @var string
	 */
	protected $region = '';
	/**
	 * guild achievements
	 * @var int
	 */
	protected $achievements = 0;
	/**
	 * guild player count
	 * @var int
	 */
	protected $playercount = 0;
	/**
	 * guild start date
	 * @var int
	 */
	protected $startdate = 0;
	/**
	 * guild on roster ?
	 * @var int 1 or 0
	 */
	protected $showroster = 0;
	/**
	 * min. level on roster
	 * @var int
	 */
	protected $min_armory = 0;
	/**
	 * does guild recruit ?
	 * @var int 1 or 0
	 */
	protected $recstatus = 1;
	/**
	 * is this the default guild ?
	 * @var int 1 or 0
	 */
	protected $guilddefault = 1;

	//aion parameters
	/**
	 * Aion legion id
	 * @var int
	 */
	protected $aionlegionid = 0;
	/**
	 * Aion Server id
	 * @var int
	 */
	protected $aionserverid = 0;

	//wow parameters
	/**
	 * guild achievement points
	 * @var int
	 */
	protected $achievementpoints = 0;
	/**
	 * guild level
	 * @var int 1-25
	 */
	protected $level = 0;
	/**
	 * guild emblem image path
	 */
	protected $emblempath = '';

	/**
	 * battle net emblem info so we can make the image
	 * @var array
	 */
	protected $emblem = array();
	/**
	 * guild battlegroup
	 * @var string
	 */
	protected $battlegroup = '';
	/**
	 * guild armory url
	 * @var string
	 */
	protected $guildarmoryurl = '';
	/**
	 * guild players
	 * @var array
	 */
	protected $playerdata = array();
	/**
	 * guild side
	 * @var int 0 or 1
	 */
	protected $side = 0;

	/**
	 * holds recruitment statuses
	 * @var array
	 */
	protected $possible_recstatus = array();

	/**
	 * true if armory is on
	 * @var boolean
	 */
	public $armory_enabled;

	/**
	 * rank to which raidtracker should add new attendees
	 *
	 * @var int
	 */
	public $raidtrackerrank;

	/**
	 * rank to which apply should add new recruits
	 *
	 * @var int
	 */
	public $applyrank;
	/**
	 * search result Battle.NET
	 *
	 * @var string
	 */
	public $armoryresult;

	/**
	 * default recruitment forum. this is the forum linked to in the recruitment block
	 * you can install the Apply plugin to further customise the application process.
	 *
	 * @var int
	 */
	public $recruitforum;

    /**
     * guildnews array from battle.NET
     *
     * @var array
     */
    public $guildnews;


	/**
	 * guild class constructor
	 * @param int $guild_id
	 */
	function __construct($guild_id = 0)
	{
		global $user;
		parent::__construct();
		$this->guildid = $guild_id;
        if($guild_id>0)
        {
            $this->Getguild();
        }


		$this->possible_recstatus = array(
			0 => $user->lang['CLOSED'] ,
			1 => $user->lang['OPEN']);

	}

    /**
     * guild class property setter
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
	 * guild class property setter
	 * @param string $property
	 * @param string $value
	 */
	public function __set($property, $value)
	{
		global $user;
		switch ($property)
		{
			case 'playercount':
				$this->countplayers();
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
	 * inserts a new guild to database
	 *
	 * we always add guilds with an id greater than zero. this way, the guild with id=zero is the "guildless" guild
	 * the zero guild is added by default in a new install.
	 * do not delete the zero record in the guild table or you will see that guildless players
	 * become invisible in the roster and in the playerlist or in any list player selection that makes
	 * an inner join with the guild table.
	 */
	public function MakeGuild()
	{
		global $cache, $user, $db;

		if ($this->name == null || $this->realm == null)
		{
			trigger_error($user->lang['ERROR_GUILDEMPTY'], E_USER_WARNING);
		}
        $cache->destroy('sql', GUILD_TABLE);

		// check existing guild-realmname
		$result = $db->sql_query("SELECT count(*) as evcount from " . GUILD_TABLE . "
			WHERE id !=0 AND UPPER(name) = '" . strtoupper($db->sql_escape($this->name)) . "'
			AND UPPER(realm) = '" . strtoupper($db->sql_escape($this->realm)) . "'");
		$grow = $db->sql_fetchrow($result);

		if ($grow['evcount'] != 0)
		{
			trigger_error($user->lang['ERROR_GUILDTAKEN'], E_USER_WARNING);
		}

		$result = $db->sql_query("SELECT MAX(id) as id FROM " . GUILD_TABLE . ";");
		$row = $db->sql_fetchrow($result);
		$this->guildid = (int) $row['id'] + 1;

		//@todo complete this
		$this->aionlegionid = 0;
		$this->aionserverid = 0;

		$query = $db->sql_build_array('INSERT', array(
				'game_id' => $this->game_id,
				'id' => $this->guildid,
				'name' => $this->name ,
				'realm' => $this->realm,
				'region' => $this->region ,
				'roster' => $this->showroster ,
				'aion_legion_id' => $this->aionlegionid ,
				'aion_server_id' => $this->aionserverid,
				'min_armory' => $this->min_armory,
				'guilddefault' => $this->guilddefault,
				'armory_enabled' => $this->armory_enabled,
                'rec_status' => $this->recstatus,
				'recruitforum' => $this->recruitforum,
				'players' => 0,
                'armoryresult' => 'NA',
			));

		$db->sql_query('INSERT INTO ' . GUILD_TABLE . $query);

		$newrank = new Ranks($this->guildid);
		// add guildleader rank
		$newrank->RankName = $user->lang['GUILDLEADER'];
		$newrank->RankId = 0;
		$newrank->RankHide = 0;
		$newrank->RankPrefix = '';
		$newrank->RankSuffix = '';
		$newrank->Makerank();

		$log_action = array(
				'header' => 'L_ACTION_GUILD_ADDED' ,
				'id' =>  $this->guildid ,
				'L_USER' => $user->data['user_id'] ,
				'L_USERCOLOUR' => $user->data['user_colour'] ,
				'L_NAME' => $this->name ,
				'L_REALM' => $this->realm ,
				'L_ADDED_BY' => $user->data['username']);

		$this->log_insert(array(
				'log_type' => $log_action['header'] ,
				'log_action' => $log_action));

        if ($this->game_id == 'wow')
        {
            $data =  $this->GetApiInfo(array());
            $this->ApiUpdateBattleNet($data, array() );
        }

		return true;

	}

    /**
     * updates a guild to database
     * @param Guilds $old_guild
     * @param $params
     * @return bool
     */
	public function Guildupdate(Guilds $old_guild, $params)
	{
		global $user, $cache, $db;

        $cache->destroy('sql', GUILD_TABLE);

		// check if already exists
		if($this->name != $old_guild->name || $this->realm != $old_guild->realm)
		{
			// check existing guild-realmname
			$result = $db->sql_query("SELECT count(*) as evcount from " . GUILD_TABLE . "
				WHERE UPPER(name) = '" . strtoupper($db->sql_escape($this->name)) . "'
				AND UPPER(realm) = '" . strtoupper($db->sql_escape($this->realm)) . "'");
			$grow = $db->sql_fetchrow($result);
			if ($grow['evcount'] != 0)
			{
				trigger_error($user->lang['ERROR_GUILDTAKEN'], E_USER_WARNING);
			}
		}
		$this->countplayers();

		$query = $db->sql_build_array('UPDATE', array(
				'game_id' => $this->game_id,
				'id' => $this->guildid,
				'name' => $this->name ,
				'realm' => $this->realm,
				'region' => $this->region ,
				'roster' => $this->showroster ,
				'aion_legion_id' => $this->aionlegionid ,
				'aion_server_id' => $this->aionserverid,
				'min_armory' => $this->min_armory,
				'rec_status' => $this->recstatus,
				'players' => $this->playercount,
				'guilddefault' => $this->guilddefault,
				'armory_enabled' => $this->armory_enabled,
                'emblemurl' => $this->emblempath,
				'recruitforum' => $this->recruitforum,
		));

		$db->sql_query('UPDATE ' . GUILD_TABLE . ' SET ' . $query . ' WHERE id= ' . $this->guildid);

        $data = $this->GetApiInfo($params);

        $this->ApiUpdateBattleNet($data, $params);

        return true;
    }


    /**
     * updates the default guild flag
     * @param int $id
     */
    public function update_guilddefault($id)
    {
        global $cache, $db;
        $cache->destroy('sql', GUILD_TABLE);
        $sql = 'UPDATE ' . GUILD_TABLE . ' SET guilddefault = 1 WHERE id = ' . (int) $id;
        $db->sql_query ( $sql );

        $sql = 'UPDATE ' . GUILD_TABLE . ' SET guilddefault = 0 WHERE id != ' . (int) $id;
        $db->sql_query ( $sql );

    }

	/**
	 * deletes a guild from database
	 */
	public function Guildelete()
	{
		global $user, $cache, $db;

		if($this->guildid == 0)
		{
			trigger_error($user->lang['ERROR_INVALID_GUILD_PROVIDED'], E_USER_WARNING);
		}
        $cache->destroy('sql', GUILD_TABLE);
		// check if guild has players
		$sql = 'SELECT COUNT(*) as mcount FROM ' . PLAYER_LIST_TABLE . '
           WHERE player_guild_id = ' . $this->guildid;
		$result = $db->sql_query($sql);
		if ((int) $db->sql_fetchfield('mcount') >= 1)
		{
			trigger_error($user->lang['ERROR_GUILDHASPLAYERS'], E_USER_WARNING);
		}
        $db->sql_freeresult($result);

		$sql = 'DELETE FROM ' . PLAYER_RANKS_TABLE . ' WHERE guild_id = ' .  $this->guildid;
		$db->sql_query($sql);

		$sql = 'DELETE FROM ' . GUILD_TABLE . ' WHERE id = ' .  $this->guildid;
		$db->sql_query($sql);

        $imgfile = $this->ext_path . "images/guildemblem/". $this->region.'_'. $this->realm .'_'. $this->mb_str_replace(' ', '_', $this->name) .".png";

        if (file_exists($imgfile))
        {
            $fp = fopen($imgfile, "r+");
            // try to  acquire an exclusive lock
            if (flock($fp, LOCK_EX))
            {
                unlink($imgfile);
                flock($fp, LOCK_UN);
                // release the lock
            }
            unset($fp);
        }

        $log_action = array(
				'header' => sprintf($user->lang['ACTION_GUILD_DELETED'], $this->name) ,
				'L_NAME' => $this->name ,
				'L_UPDATED_BY' => $user->data['username'],
				);

		$this->log_insert(array(
				'log_type' => $log_action['header'] ,
				'log_action' => $log_action));


	}

    /**
	 * function to create a Wow Guild emblem, adapted for phpBB from http://us.battle.net/wow/en/forum/topic/3082248497#8
	 *
 	 * @author Thomas Andersen <acoon@acoon.dk>
	 * @copyright Copyright (c) 2011, Thomas Andersen, http://sourceforge.net/projects/wowarmoryapi
     * @param bool $showlevel
     * @param int $width
     * @return string
     */
	private function createEmblem($showlevel=TRUE, $width=115)
	{
		//location to create the file
		$imgfile = $this->ext_path . "images/guildemblem/".$this->region.'_'.$this->realm.'_'. $this->mb_str_replace(' ', '_', $this->name) .".png";
		$outputpath = $this->ext_path . "images/guildemblem/".$this->region.'_'.$this->realm.'_'. $this->mb_str_replace(' ', '_', $this->name).".png";

		if (file_exists($imgfile) AND $width==(imagesx(imagecreatefrompng($imgfile))) AND (filemtime($imgfile)+86000) > time())
		{
			$finalimg = imagecreatefrompng($imgfile);
			imagesavealpha($finalimg,true);
			imagealphablending($finalimg, true);
		}
		else
		{
			if ($width > 1 AND $width < 215)
			{
				$height = ($width/215)*230;
				$finalimg = imagecreatetruecolor($width, $height);
				$trans_colour = imagecolorallocatealpha($finalimg, 0, 0, 0, 127);
				imagefill($finalimg, 0, 0, $trans_colour);
				imagesavealpha($finalimg,true);
				imagealphablending($finalimg, true);
			}

			if ($this->side == 0)
			{
				$ring = 'alliance';
			}
			else
			{
				$ring = 'horde';
			}

			$imgOut = imagecreatetruecolor(215, 230);

			$emblemURL = $this->ext_path  ."images/wowapi/emblems/emblem_".sprintf("%02s",$this->emblem['icon']).".png";
			$borderURL = $this->ext_path  ."images/wowapi/borders/border_".sprintf("%02s",$this->emblem['border']).".png";
			$ringURL = $this->ext_path  ."images/wowapi/static/ring-".$ring.".png";
			$shadowURL = $this->ext_path  ."images/wowapi/static/shadow_00.png";
			$bgURL = $this->ext_path  ."images/wowapi/static/bg_00.png";
			$overlayURL = $this->ext_path  ."images/wowapi//static/overlay_00.png";
			$hooksURL = $this->ext_path  ."images/wowapi/static/hooks.png";
			//$levelURL = $this->ext_path  ."images/wowapi/static/";

			imagesavealpha($imgOut,true);
			imagealphablending($imgOut, true);
			$trans_colour = imagecolorallocatealpha($imgOut, 0, 0, 0, 127);
			imagefill($imgOut, 0, 0, $trans_colour);

			$ring = imagecreatefrompng($ringURL);
			$ring_size = getimagesize($ringURL);

			$emblem = imagecreatefrompng($emblemURL);
			$emblem_size = getimagesize($emblemURL);
			imagelayereffect($emblem, IMG_EFFECT_OVERLAY);
			$emblemcolor = preg_replace('/^ff/i','',$this->emblem['iconColor']);
			$color_r = hexdec(substr($emblemcolor,0,2));
			$color_g = hexdec(substr($emblemcolor,2,2));
			$color_b = hexdec(substr($emblemcolor,4,2));
			imagefilledrectangle($emblem,0,0,$emblem_size[0],$emblem_size[1],imagecolorallocatealpha($emblem, $color_r, $color_g, $color_b,0));


			$border = imagecreatefrompng($borderURL);
			$border_size = getimagesize($borderURL);
			imagelayereffect($border, IMG_EFFECT_OVERLAY);
			$bordercolor = preg_replace('/^ff/i','',$this->emblem['borderColor']);
			$color_r = hexdec(substr($bordercolor,0,2));
			$color_g = hexdec(substr($bordercolor,2,2));
			$color_b = hexdec(substr($bordercolor,4,2));
			imagefilledrectangle($border,0,0,$border_size[0]+100,$border_size[0]+100,imagecolorallocatealpha($border, $color_r, $color_g, $color_b,0));

			$shadow = imagecreatefrompng($shadowURL);

			$bg = imagecreatefrompng($bgURL);
			$bg_size = getimagesize($bgURL);
			imagelayereffect($bg, IMG_EFFECT_OVERLAY);
			$bgcolor = preg_replace('/^ff/i','',$this->emblem['backgroundColor']);
			$color_r = hexdec(substr($bgcolor,0,2));
			$color_g = hexdec(substr($bgcolor,2,2));
			$color_b = hexdec(substr($bgcolor,4,2));
			imagefilledrectangle($bg,0,0,$bg_size[0]+100,$bg_size[0]+100,imagecolorallocatealpha($bg, $color_r, $color_g, $color_b,0));


			$overlay = imagecreatefrompng($overlayURL);
			$hooks = imagecreatefrompng($hooksURL);

			$x = 20;
			$y = 23;

			imagecopy($imgOut,$ring,0,0,0,0, $ring_size[0],$ring_size[1]);

			$size = getimagesize($shadowURL);
			imagecopy($imgOut,$shadow,$x,$y,0,0, $size[0],$size[1]);
			imagecopy($imgOut,$bg,$x,$y,0,0, $bg_size[0],$bg_size[1]);
			imagecopy($imgOut,$emblem,$x+17,$y+30,0,0, $emblem_size[0],$emblem_size[1]);
			imagecopy($imgOut,$border,$x+13,$y+15,0,0, $border_size[0],$border_size[1]);
			$size = getimagesize($overlayURL);
			imagecopy($imgOut,$overlay,$x,$y+2,0,0, $size[0],$size[1]);
			$size = getimagesize($hooksURL);
			imagecopy($imgOut,$hooks,$x-2,$y,0,0, $size[0],$size[1]);

            //Blizzard disabled guild levels
            /*
            if ($showlevel)
			{
				$level = $this->level;
				if ($level < 10)
				{
					$levelIMG = imagecreatefrompng($levelURL.$level.".png");
				}
				else
				{
					$digit[1] = substr($level,0,1);
					$digit[2] = substr($level,1,1);
					$digit1 = imagecreatefrompng($levelURL.$digit[1].".png");
					$digit2 = imagecreatefrompng($levelURL.$digit[2].".png");
					$digitwidth = imagesx($digit1);
					$digitheight = imagesy($digit1);
					$levelIMG = imagecreatetruecolor($digitwidth*2,$digitheight);
					$trans_colour = imagecolorallocatealpha($levelIMG, 0, 0, 0, 127);
					imagefill($levelIMG, 0, 0, $trans_colour);
					imagesavealpha($levelIMG,true);
					imagealphablending($levelIMG, true);
					// Last image added first because of the shadow need to be behind first digit
					imagecopy($levelIMG,$digit2,$digitwidth-12,0,0,0, $digitwidth, $digitheight);
					imagecopy($levelIMG,$digit1,12,0,0,0, $digitwidth, $digitheight);
				}
				$size[0] = imagesx($levelIMG);
				$size[1] = imagesy($levelIMG);
				$levelemblem = imagecreatefrompng($ringURL);
				imagesavealpha($levelemblem,true);
				imagealphablending($levelemblem, true);
				imagecopy($levelemblem,$levelIMG,(215/2)-($size[0]/2),(215/2)-($size[1]/2),0,0,$size[0],$size[1]);
				imagecopyresampled($imgOut, $levelemblem, 143, 150,0,0, 215/3, 215/3, 215, 215);
			}
            */
            //endregion

			if ($width > 1 AND $width < 215)
			{
				imagecopyresampled($finalimg, $imgOut, 0, 0, 0, 0, $width, $height, 215, 230);
			}
			else
			{
				$finalimg = $imgOut;
			}

			imagepng($finalimg,$imgfile);

		}
		return $outputpath;
	}

	/**
	 * replace string in utf8 string
	 * @param $needle
	 * @param $replacement
	 * @param $haystack
	 * @return string
	 */
	function mb_str_replace( $needle, $replacement, $haystack ) {
		$needle_len = mb_strlen($needle);
		$pos = mb_strpos( $haystack, $needle);
		while (!($pos ===false)) {
			$front = mb_substr( $haystack, 0, $pos );
			$back  = mb_substr( $haystack, $pos + $needle_len);
			$haystack = $front.$replacement.$back;
			$pos = mb_strpos( $haystack, $needle);
		}
		return $haystack;
	}


    /**
     * gets a guild from database
     * used in sidebar
     * cached for 7 days
     */
    public function Getguild()
    {
        global $db;

        $sql = 'SELECT id, name, realm, region, roster, game_id, players,
				achievementpoints, level, battlegroup, guildarmoryurl, emblemurl, min_armory, rec_status, guilddefault, armory_enabled, armoryresult, recruitforum
				FROM ' . GUILD_TABLE . '
				WHERE id = ' . $this->guildid;
        $result = $db->sql_query($sql, 604800);

        $row = $db->sql_fetchrow($result);
        $db->sql_freeresult($result);
        if ($row)
        {
            // load guild object
            $this->game_id = $row['game_id'];
            $this->guildid = $row['id'];
            $this->name = $row['name'];
            $this->realm = $row['realm'];
            $this->region = $row['region'];
            $this->showroster = $row['roster'];
            $this->achievementpoints = $row['achievementpoints'];
            $this->level = $row['level'];
            $this->battlegroup = $row['battlegroup'];
            $this->guildarmoryurl = $row['guildarmoryurl'];
            $this->emblempath = $row['emblemurl'];
            $this->min_armory = $row['min_armory'];
            $this->recstatus = $row['rec_status'];
            $this->armory_enabled = $row['armory_enabled'];
			$this->armoryresult = $row['armoryresult'];
            $this->countplayers();
            $this->guilddefault = $row['guilddefault'];
            $this->raidtrackerrank = $this->maxrank();
            $this->applyrank = $this->maxrank();
			$this->recruitforum = $row['recruitforum'];
        }


    }

    /**
     * returns a player listing for this guild
     *
     * @param string $order
     * @param int $start
     * @param int $mode
     * @param int $minlevel
     * @param int $maxlevel
     * @param int $selectactive
     * @param int $selectnonactive
     * @param string $player_filter
     * @param bool $last_update
     * @return array
     */
	public function listplayers($order = 'm.player_name', $start=0, $mode = 0, $minlevel=1, $maxlevel=200, $selectactive=1, $selectnonactive=1, $player_filter= '', $last_update = false)
	{

		global $db, $config;
		$sql_array = array(
				'SELECT' => 'm.* , u.username, u.user_id, u.user_colour, g.name, l.name as player_class, r.rank_id,
			    				r.rank_name, r.rank_prefix, r.rank_suffix,
								 c.colorcode , c.imagename, m.player_gender_id, a.image_female, a.image_male' ,
				'FROM' => array(
						PLAYER_LIST_TABLE => 'm' ,
						PLAYER_RANKS_TABLE => 'r' ,
						CLASS_TABLE => 'c' ,
						RACE_TABLE => 'a' ,
						BB_LANGUAGE => 'l' ,
						GUILD_TABLE => 'g') ,
				'LEFT_JOIN' => array(
						array(
								'FROM' => array(
										USERS_TABLE => 'u') ,
								'ON' => 'u.user_id = m.phpbb_user_id ')) ,
				'WHERE' => " (m.player_rank_id = r.rank_id)
			    				and m.game_id = l.game_id
			    				AND l.attribute_id = c.class_id and l.game_id = c.game_id AND l.language= '" . $config['bbguild_lang'] . "' AND l.attribute = 'class'
								AND (m.player_guild_id = g.id)
								AND (m.player_guild_id = r.guild_id)
								AND (m.player_guild_id = " . $this->guildid . ')
								AND m.game_id =  a.game_id
								AND m.game_id =  c.game_id
								AND m.player_race_id =  a.race_id
								AND (m.player_class_id = c.class_id)
								AND m.player_level >= ' . $minlevel . '
								AND m.player_level <= ' . $maxlevel,
				'ORDER_BY' => $order);

		if($selectactive == 0 && $selectnonactive == 1)
		{
			$sql_array['WHERE'] .= ' AND m.player_status = 0 ';
		}
		elseif ($selectactive == 1 && $selectnonactive == 0)
		{
			$sql_array['WHERE'] .= ' AND m.player_status = 1 ';
		}
        elseif($selectactive == 1 && $selectnonactive == 1)
        {
            $sql_array['WHERE'] .= ' AND 1=1 ';
        }
        elseif($selectactive == 0 && $selectnonactive == 0)
        {
            $sql_array['WHERE'] .= ' AND 1=0 ';
        }

        if ($last_update)
        {
            $sql_array['WHERE'] .= ' AND m.last_update >= 0 and m.last_update < ' . ($this->time - 900) ;
        }

        if ($player_filter != '')
        {
            $sql_array['WHERE'] .= ' AND lcase(m.player_name) ' . $db->sql_like_expression($db->any_char . $db->sql_escape(mb_strtolower($player_filter)) . $db->any_char);
        }

		$sql = $db->sql_build_query('SELECT', $sql_array);

		if($mode == 1)
		{
			$players_result = $db->sql_query_limit($sql, $config['bbguild_user_llimit'], $start);
		}
		else
		{
			$players_result = $db->sql_query($sql);
		}

		return $players_result;

	}

	/**
	 *
	 * returns a class distribution array for this guild
	 * @return array
	 */
	public function classdistribution()
	{

		global $config, $db;

		$sql = 'SELECT c.class_id, ';
		$sql .= ' l.name                   AS classname, ';
		$sql .= ' Count(m.player_class_id) AS classcount ';
		$sql .= ' FROM  ' . CLASS_TABLE . ' c ';
		$sql .= ' INNER JOIN ' . GUILD_TABLE . ' g ON c.game_id = g.game_id ';
		$sql .= ' LEFT OUTER JOIN (SELECT * FROM ' . PLAYER_LIST_TABLE . ' WHERE player_level >= ' . $this->min_armory . ') m';
		$sql .= '   ON m.game_id = c.game_id  AND m.player_class_id = c.class_id  ';
		$sql .= ' INNER JOIN ' . BB_LANGUAGE . ' l ON  l.attribute_id = c.class_id AND l.game_id = c.game_id ';
		$sql .= ' WHERE  1=1 ';
		$sql .= " AND l.language = '" . $config['bbguild_lang']."' AND l.attribute = 'class' ";
		$sql .= ' AND g.id =  ' . $this->guildid;
		$sql .= ' GROUP  BY c.class_id, l.name ';
		$sql .= ' ORDER  BY c.class_id ASC ';

		$result = $db->sql_query($sql);
		$classes = array();
		while($row = $db->sql_fetchrow($result))
		{
			$classes[$row['class_id']] = array(
				'classname' => $row['classname'],
				'classcount' => $row['classcount']
				);
		}
		$db->sql_freeresult($result);
		return $classes;


	}

	/**
	 * counts all guild players
	 */
	private function countplayers()
	{
		global $db, $config;
		//get total players
		$sql_array = array(
				'SELECT' => 'count(*) as playercount ' ,
				'FROM' => array(
						PLAYER_LIST_TABLE => 'm' ,
						PLAYER_RANKS_TABLE => 'r' ,
						CLASS_TABLE => 'c' ,
						RACE_TABLE => 'a' ,
						BB_LANGUAGE => 'l' ,
						GUILD_TABLE => 'g') ,
				'LEFT_JOIN' => array(
						array(
								'FROM' => array(
										USERS_TABLE => 'u') ,
								'ON' => 'u.user_id = m.phpbb_user_id ')) ,
				'WHERE' => " (m.player_rank_id = r.rank_id)
				    				and m.game_id = l.game_id
				    				AND l.attribute_id = c.class_id and l.game_id = c.game_id AND l.language= '" . $config['bbguild_lang'] . "' AND l.attribute = 'class'
									AND (m.player_guild_id = g.id)
									AND (m.player_guild_id = r.guild_id)
									AND (m.player_guild_id = " . $this->guildid . ')
									AND m.game_id =  a.game_id
									AND m.game_id =  c.game_id
									AND m.player_race_id =  a.race_id
									AND (m.player_class_id = c.class_id)');
		$sql = $db->sql_build_query('SELECT', $sql_array);
		$result = $db->sql_query($sql);
		$total_players = (int) $db->sql_fetchfield('playercount');
		$db->sql_freeresult($result);
		$this->playercount = $total_players;
		return $total_players;
	}

	/**
	 * get default rank to add new player to
	 *
	 * @return number
	 */
	private function maxrank()
	{
		global $db;
		$sql = 'select max(rank_id) AS rank_id from ' . PLAYER_RANKS_TABLE . ' where guild_id = ' . (int) $this->guildid . ' and rank_id != 90';
		$result = $db->sql_query_limit($sql,1);
		$defaultrank_id = (int) $db->sql_fetchfield ('rank_id', false, $result );
		$db->sql_freeresult($result);
		return $defaultrank_id;
	}

    /**
     * gets list of guilds, used in dropdowns
     *
     * @param int $guild_id, defqults to zero, to include noguild
     * @return array
     */
	public function guildlist($guild_id = 0)
	{
		global $db;
		$sql_array = array(
				'SELECT' => 'a.game_id, a.guilddefault, a.id, a.name, a.realm, a.region, count(c.player_id) as playercount, max(b.rank_id) as joinrank ' ,
				'FROM' => array(
						GUILD_TABLE => 'a' ,
						PLAYER_RANKS_TABLE => 'b' ,),
				'LEFT_JOIN' => array(
						array(
								'FROM'  => array(PLAYER_LIST_TABLE => 'c'),
								'ON'    => 'a.id = c.player_guild_id '
						)
				),
				'WHERE' => " a.id = b.guild_id AND b.rank_id != 90 and b.guild_id >= " . $guild_id,
				'GROUP_BY' => ' a.guilddefault, a.id, a.name, a.realm, a.region ',
 				'ORDER_BY' => ' a.guilddefault desc,  count(c.player_id) desc, a.id asc'
				);

		$sql = $db->sql_build_query('SELECT', $sql_array);
		$result = $db->sql_query($sql, 604800);
		$guild = array();
		while ($row = $db->sql_fetchrow($result))
		{
			$guild [] = array (
				'game_id' => $row['game_id'] ,
				'id' => $row['id'] ,
				'name' => $row['name'],
				'guilddefault' => $row['guilddefault'],
				'playercount' => $row['playercount'],
				'realm' => $row['realm'],
				'joinrank' => $row['joinrank'],
			);
		}
		$db->sql_freeresult($result);
		return $guild;
	}


    /**
     * get api info
     *
     * @param $params
     * @return bool
     */
    public function GetApiInfo($params)
    {
        global $user;
        $data= 0;
        if ($this->game_id != 'wow')
        {
            return false;
        }
        if ($this->guildid == "0")
        {
            return false;
        }
        $game          = new Game;
        $game->game_id = $this->game_id;
        $game->Get();
        // are both game and guild armory-enabled and does player have Wow Mashery Account api key and locale ?
        if ($game->getArmoryEnabled() == 1 &&
            $this->armory_enabled == 1 &&
            trim($game->getApikey()) != '' &&
            trim($game->getApilocale()) != ''
        )
        {
            //available extra fields : 'members', 'achievements','news'
            $api  = new BattleNet('guild', $this->region, $game->getApikey(), $game->getApilocale(), $game->getPrivkey(), $this->ext_path);
            $data = $api->Guild->getGuild($this->name, $this->realm, $params);
            $data = $data['response'];
            unset($api);
            if (!isset ($data))
            {
                $this->armoryresult = 'KO';
                $log_action         = array(
                    'header'       => 'L_ERROR_ARMORY_DOWN',
                    'L_UPDATED_BY' => $user->data['username'],
                    'L_GUILD'      => $this->name . '-' . $this->realm,
                );
                $this->log_insert(array(
                    'log_type'   => $log_action['header'],
                    'log_action' => $log_action,
                    'log_result' => 'L_ERROR'
                ));
                return false;
            }
            //if we get error code
            if (isset($data['code']))
            {
                if ($data['code'] == '403')
                {
                    // even if we have active API account, it may be that Blizzard account is inactive
                    $this->armoryresult = 'KO';
                    $log_action         = array(
                        'header'       => 'L_ERROR_BATTLENET_ACCOUNT_INACTIVE',
                        'L_UPDATED_BY' => $user->data['username'],
                        'L_GUILD'      => $this->name . '-' . $this->realm,
                    );
                    $this->log_insert(array(
                        'log_type'   => $log_action['header'],
                        'log_action' => $log_action,
                        'log_result' => 'L_ERROR'
                    ));
                    return false;
                }
            }
            $this->armoryresult = 'OK';
        }
        else
        {
            $this->armoryresult = 'KO';
        }

        return $data;
    }


	/**
	 * fetch Guild API information
     * @param $data
     * @param $params
     */
	private function ApiUpdateBattleNet($data, $params)
	{
        global $db;

        if($this->armoryresult == 'KO')
        {
            return;
        }

        $this->achievementpoints = isset( $data['achievementPoints']) ? $data['achievementPoints'] : 0;
        $this->level = isset($data['level']) ? $data['level']: 0;
        $this->battlegroup = isset($data['battlegroup']) ? $data['battlegroup']: '';
        $this->side = isset($data['side']) ? $data['side']: '';

        if(isset($data['name']))
        {
            $this->guildarmoryurl = sprintf('http://%s.battle.net/wow/en/', $this->region) . 'guild/' . $this->realm. '/' . $data['name'] . '/';
        }
        else
        {
            $this->guildarmoryurl = '';
        }

        $this->emblem = isset($data['emblem']) ? $data['emblem']: '';
        $this->emblempath = isset($data['emblem']) ?  $this->createEmblem(false)  : '';
        $this->playerdata = isset($data['members']) ? $data['members']: '';

        $query = $db->sql_build_array('UPDATE', array(
            'achievementpoints' => $this->achievementpoints,
            'level'             => $this->level,
            'guildarmoryurl'    => $this->guildarmoryurl,
            'emblemurl'         => $this->emblempath,
            'battlegroup'       => $this->battlegroup,
            'armoryresult'      => $this->armoryresult,
        ));

        $db->sql_query('UPDATE ' . GUILD_TABLE . ' SET ' . $query . ' WHERE id= ' . $this->guildid);
        if (in_array('members', $params))
        {
            // update ranks table
            $rank = new Ranks($this->guildid);
            $rank->WoWArmoryUpdate($this->playerdata, $this->guildid, $this->region);
            //update player table
            $mb = new Player();
            $mb->WoWArmoryUpdate($this->playerdata, $this->guildid, $this->region, $this->min_armory);
        }

	}

    /**
     * get news from Battle.NET
     * @param $data
     */
    public function GetGuildNews($data)
    {
        if($this->armoryresult == 'KO')
        {
            return;
        }

        $this->guildnews = isset($data['news']) ? $data['news']: array();
    }


}

