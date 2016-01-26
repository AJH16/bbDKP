<?php
/**
 * abstract class aGameInstall
 *
 * @package bbguild v2.0
 * @copyright 2016 bbDKP <https://github.com/bbDKP>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */
namespace bbdkp\bbguild\model\games\library;

/**
 * @ignore
 */
use bbdkp\bbguild\model\games\rpg\Classes;
use bbdkp\bbguild\model\games\rpg\Faction;
use bbdkp\bbguild\model\games\rpg\Races;
use bbdkp\bbguild\model\games\rpg\Roles;

if (! defined('IN_PHPBB'))
{
	exit();
}

/**
 * Game interface
 * this abstract class is the framework for all game installers
 * @package bbdkp\bbguild\model\games\library
 */
abstract class GameInstall
{

    protected $game_id;
    protected $bossbaseurl;
    protected $zonebaseurl;

    private $gamename;

    /**
     * @return string
     */
    public final function getBossbaseurl()
    {
        return $this->bossbaseurl;
    }

    /**
     * @return string
     */
    public final function getZonebaseurl()
    {
        return $this->zonebaseurl;
    }

    /**
	 * Install a game
     * can be implemented, this is the default install
     * @param $game_id
     * @param $gamename
     * @param $bossbaseurl
     * @param $zonebaseurl
     */
    public final function Install($game_id, $gamename, $bossbaseurl, $zonebaseurl)
	{
		global $cache, $db;
		$this->game_id = $game_id;
		$this->gamename = $gamename;
        $this->bossbaseurl = $bossbaseurl;
        $this->zonebaseurl = $zonebaseurl;

		$db->sql_transaction ( 'begin' );
		$this->Installfactions();
		$this->InstallClasses();
		$this->InstallRaces();
        $this->InstallRoles();

		//insert a new entry in the game table
		$data = array (
				'game_id' => $this->game_id,
				'game_name' => $this->gamename,
				'imagename' => $this->game_id,
				'armory_enabled' => ($this->game_id == 'wow' ? 1 : 0),
                'bossbaseurl' => $this->bossbaseurl,
                'zonebaseurl' => $this->zonebaseurl ,
				'status' => 1
		);

		$sql = 'INSERT INTO ' . BBGAMES_TABLE . ' ' . $db->sql_build_array ( 'INSERT', $data );
		$db->sql_query ( $sql );

		$db->sql_transaction ( 'commit' );
        $cache->destroy( 'sql', BBGAMES_TABLE );
        $cache->destroy( 'sql', CLASS_TABLE );
        $cache->destroy( 'sql', BB_LANGUAGE );
        $cache->destroy( 'sql', RACE_TABLE );
        $cache->destroy( 'sql', PLAYER_LIST_TABLE );
        $cache->destroy( 'sql', BB_GAMEROLE_TABLE );

	}

    /**
     * Uninstall a game
     * @param $game_id
     * @param $gamename
     */
    Public final function Uninstall($game_id, $gamename)
    {
        global $cache, $db;
        $this->game_id = $game_id;
        $this->gamename = $gamename;

        $db->sql_transaction('begin');

        $factions = new Faction;
        $factions->game_id = $this->game_id;
        $factions->Delete_all_factions();

        $races = new Races;
        $races->game_id = $this->game_id;
        $races->Delete_all_races();

        $classes = new Classes;
        $classes->game_id = $this->game_id;
        $classes->Delete_all_classes();

        $roles = new Roles;
        $roles->game_id = $this->game_id;
        $roles->Delete_all_roles();

        $sql = 'DELETE FROM ' . BBGAMES_TABLE . " WHERE game_id = '" .   $this->game_id . "'";
        $db->sql_query ($sql);

        $db->sql_transaction ( 'commit' );

        $cache->destroy( 'sql', BBGAMES_TABLE );
        $cache->destroy( 'sql', CLASS_TABLE );
        $cache->destroy( 'sql', BB_LANGUAGE );
        $cache->destroy( 'sql', RACE_TABLE );
        $cache->destroy( 'sql', PLAYER_LIST_TABLE );
    }

	/**
	 * Installs factions
	 * must be implemented
	 */
    abstract protected function Installfactions();

	/**
	 * Installs game classes
	 * must be implemented
	*/
    abstract protected function InstallClasses();

	/**
	 * Installs races
	 * must be implemented
	*/
    abstract protected function InstallRaces();

    /**
     * Install sample roles.
     * if a game needs a special role, then implement that role in the game installer class.
     * the only game needing special roles is GW2 due to it not following the holy trinity
     * http://www.mmo-champion.com/threads/1125142-GW2-Roles-An-explanation
     *
     * can be implemented
     */
    protected function InstallRoles()
    {

        global $db;

        $db->sql_query('DELETE FROM ' .  BB_GAMEROLE_TABLE . " WHERE role_id < 3 and game_id = '" . $this->game_id . "'");
        $db->sql_query('DELETE FROM ' .  BB_LANGUAGE . " WHERE attribute_id < 3 and  attribute = 'role' and game_id = '" . $this->game_id  . "'");

        $sql_ary = array(
            array(
                // dps
                'game_id'  		   => $this->game_id ,
                'role_id'    	   => 0,
                'role_color'       => '#FF4455',
                'role_icon'    	   => 'dps_icon',
            ),
            array(
                // healer
                'game_id'  		   => $this->game_id ,
                'role_id'    	   => 1,
                'role_color'       => '#11FF77',
                'role_icon'    	   => 'healer_icon',
            ),
            array(
                // tank
                'game_id'  		   => $this->game_id ,
                'role_id'    	   => 2,
                'role_color'       => '#c3834c',
                'role_icon'    	   => 'tank_icon',
            ),
        );
        $db->sql_multi_insert(BB_GAMEROLE_TABLE, $sql_ary);

        //english
        $sql_ary = array(
            array(
                // dps
                'game_id'  		    => $this->game_id ,
                'attribute_id'    	=>  0,
                'language'          => 'en',
                'attribute'    	    => 'role',
                'name'    	        => 'Damage',
                'name_short'        => 'DPS',
            ),
            array(
                // healer
                'game_id'  		    => $this->game_id ,
                'attribute_id'    	=>  1,
                'language'          => 'en',
                'attribute'    	    => 'role',
                'name'    	        => 'Healer',
                'name_short'        => 'HPS',
            ),
            array(
                // defense
                'game_id'  		    => $this->game_id ,
                'attribute_id'    	=>  2,
                'language'          => 'en',
                'attribute'    	    => 'role',
                'name'    	        => 'Defense',
                'name_short'        => 'DEF',
            ),
            array(
                // dps
                'game_id'  		    => $this->game_id ,
                'attribute_id'    	=>  0,
                'language'          => 'fr',
                'attribute'    	    => 'role',
                'name'    	        => 'Dégats',
                'name_short'        => 'DPS',
            ),
            array(
                // healer
                'game_id'  		    => $this->game_id ,
                'attribute_id'    	=> 1,
                'language'          => 'fr',
                'attribute'    	    => 'role',
                'name'    	        => 'Soigneur',
                'name_short'        => 'HPS',
            ),
            array(
                // tank
                'game_id'  		    => $this->game_id ,
                'attribute_id'    	=> 2,
                'language'          => 'fr',
                'attribute'    	    => 'role',
                'name'    	        => 'Défense',
                'name_short'        => 'DEF',
            ),
            array(
                // dps
                'game_id'  		    => $this->game_id ,
                'attribute_id'    	=> 0,
                'language'          => 'de',
                'attribute'    	    => 'role',
                'name'    	        => 'Kämpfer',
                'name_short'        => 'Schaden',
            ),
            array(
                // healer
                'game_id'  		    => $this->game_id ,
                'attribute_id'    	=>  1,
                'language'          => 'de',
                'attribute'    	    => 'role',
                'name'    	        => 'Heiler',
                'name_short'        => 'Heil',
            ),
            array(
                // tank
                'game_id'  		    => $this->game_id ,
                'attribute_id'    	=>  2,
                'language'          => 'de',
                'attribute'    	    => 'role',
                'name'    	        => 'Verteidigung',
                'name_short'        => 'Schutz',
            ),
            array(
                // dps
                'game_id'  		    => $this->game_id ,
                'attribute_id'    	=> 0,
                'language'          => 'it',
                'attribute'    	    => 'role',
                'name'    	        => 'Danni',
                'name_short'        => 'Danni',
            ),
            array(
                // healer
                'game_id'  		    =>  $this->game_id ,
                'attribute_id'    	=> 1,
                'language'          => 'it',
                'attribute'    	    => 'role',
                'name'    	        => 'Cura',
                'name_short'        => 'Cura',
            ),
            array(
                // tank
                'game_id'  		    =>  $this->game_id ,
                'attribute_id'    	=>  2,
                'language'          => 'it',
                'attribute'    	    => 'role',
                'name'    	        => 'Difeza',
                'name_short'        => 'Tank',
            ),
        );
        $db->sql_multi_insert(BB_LANGUAGE, $sql_ary);
    }
}