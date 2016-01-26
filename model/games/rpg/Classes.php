<?php
/**
 * This file contains the game Classes
 *
 * @package bbguild v2.0
 * @copyright 2016 bbDKP <https://github.com/bbDKP>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace bbdkp\bbguild\model\games\rpg;
use bbdkp\bbguild\model\games\Game;

/**
 * Classes
 *
 * Manages all Game Classes
 *
 *   @package bbguild
 */
 class Classes
 {

     /**
      * the game_id (unique key)
      * @var string
      */
     public $game_id;

     /**
      * Class id
      * @var INT
      */
     public $class_id;

     /**
      * Primary key
      * @var int
      */
     public $c_index;
     /**
      * game faction ID
      * @var int
      */
     public $faction_id;
     /**
      * minimum level
      * @var number
      */
     public $min_level;
     /**
      * maximum level
      * @var int
      */
     public $max_level;
     /**
      * name of class
      * @var String
      */
     public $classname;
     /**
      * class is hidden or not?
      * @var bool
      */
     public $hide;
     /**
      * how many needed of this class in the Dps role ?
      * @var number
      */
     public $dps;
     /**
      * how many needed of this class in the tank role ?
      * @var int
      */
     public $tank;
     /**
      * how many needed of this class in the heal role ?
      * @var int
      */
     public $heal;
     /**
      * name of image file
      * @var String
      */
     public $imagename;
     /**
      * class color hex
      * @var string
      */
     public $colorcode;
     /**
      * armor type
      * @var String
      */
     public $armor_type;

     /**
      * array of all armor types
      * @var array
      */
     public $armortypes;



	/**
	 * Classes Class constructor
	 */
	public function __construct()
	{
		global $user;

		$this->armortypes = array (
				'CLOTH' => $user->lang ['CLOTH'],
				'ROBE' => $user->lang ['ROBE'],
				'LEATHER' => $user->lang ['LEATHER'],
				'AUGMENTED' => $user->lang ['AUGMENTED'],
				'MAIL' => $user->lang ['MAIL'],
				'HEAVY' => $user->lang ['HEAVY'],
				'PLATE' => $user->lang ['PLATE'] );

		$this->game_id = '';
		$this->c_index = 0;
		$this->class_id = 0;
		$this->classname = '';
		$this->min_level = 0;
		$this->max_level = 0;
		$this->armor_type = '';
		$this->imagename = '';
		$this->colorcode = '';
		$this->faction_id = 0;
	}

	/**
	 * gets 1 class from database
	 */
	public function Get()
	{
		global $db, $config;

		$sql_array = array (
				'SELECT' => ' c.c_index, c.class_id, l.name AS class_name, c.class_min_level, c.class_max_level, c.class_faction_id,
							c.class_armor_type, c.imagename, c.colorcode ',
				'FROM' => array (
						CLASS_TABLE => 'c', BB_LANGUAGE => 'l' ),
				'WHERE' => " c.class_id = l.attribute_id
							AND l.attribute='class'
							AND l.game_id = '" . $this->game_id . "'
							AND c.game_id = l.game_id
							AND l.language= '" . $config ['bbguild_lang'] . "'
							AND c.class_id = " . $this->class_id);

		$sql = $db->sql_build_query ( 'SELECT', $sql_array );
		$result = $db->sql_query ( $sql );
		while ( $row = $db->sql_fetchrow ($result))
		{
			$this->c_index = $row['c_index'];
			$this->class_id = (int) $row['class_id'];
			$this->classname = (string) $row['class_name'];
			$this->min_level = (int) $row['class_min_level'];
			$this->max_level = (int) $row['class_max_level'];
			$this->armor_type = (string) $row['class_armor_type'];
			$this->imagename = (string) $row['imagename'];
			$this->colorcode = (string) $row['colorcode'];
			$this->faction_id = (string) $row['class_faction_id'];
		}
		$db->sql_freeresult ( $result );

	}

	/**
	 * adds a class to database
	 */
	public function Make()
	{
		global $user, $db, $config, $cache;

		$sql = 'SELECT count(*) AS countclass FROM ' . CLASS_TABLE . ' WHERE class_id  = ' .
			$this->class_id . " AND game_id = '" . $this->game_id . "'";
		$resultc = $db->sql_query ($sql);

		if (( int ) $db->sql_fetchfield ( 'countclass', false, $resultc ) > 0)
		{
			trigger_error ( sprintf ( $user->lang ['ADMIN_ADD_CLASS_FAILED'], $this->classname ), E_USER_WARNING );
		}
		$db->sql_freeresult ( $resultc );
		unset ( $resultc );

		$data = array (
				'class_id' => ( int ) $this->class_id,
				'game_id' => ( string ) $this->game_id,
				'class_min_level' => ( int ) $this->min_level,
				'class_max_level' => ( int ) $this->max_level,
				'class_armor_type' => ( string ) $this->armor_type,
				'imagename' => $this->imagename,
				'class_hide' => 0,
				'colorcode' => $this->colorcode );

		$db->sql_transaction ( 'begin' );

		$sql = 'INSERT INTO ' . CLASS_TABLE . ' ' . $db->sql_build_array ( 'INSERT', $data );
		$db->sql_query ( $sql );


		$names = array (
				'game_id' => ( string ) $this->game_id,
				'attribute_id' => $this->class_id,
				'language' => $config ['bbguild_lang'],
				'attribute' => 'class',
				'name' => ( string ) $this->classname,
				'name_short' => ( string ) $this->classname );

		$sql = 'INSERT INTO ' . BB_LANGUAGE . ' ' . $db->sql_build_array ( 'INSERT', $names );
		$db->sql_query ( $sql );

		$db->sql_transaction ( 'commit' );
		$cache->destroy ( 'sql', BB_LANGUAGE );
		$cache->destroy ( 'sql', CLASS_TABLE );
	}

	/**
	 * deletes a class from database
	 */
	public function Delete()
	{
		global $user, $db, $config, $cache;

		// see if there are players in this class
		$sql_array = array (
				'SELECT' => ' c.class_id, COUNT(*) AS classcount  ',
				'FROM' => array (
						PLAYER_LIST_TABLE => 'm',
						CLASS_TABLE => 'c' ),
				'WHERE' => 	"m.game_id = c.game_id AND m.game_id = '" . $this->game_id . "'
    					and m.player_class_id = c.class_id AND c.class_id =  " . $this->class_id ,
				'GROUP_BY' => 'c.class_id'
		);

		$sql = $db->sql_build_query ( 'SELECT', $sql_array );
		$result = $db->sql_query ( $sql );
		$classcount = ( int ) $db->sql_fetchfield ( 'classcount', false, $result );
		$db->sql_freeresult ( $result );


		if ($classcount == 0)
		{
			$db->sql_transaction ( 'begin' );

			$sql = 'DELETE FROM ' . CLASS_TABLE . ' WHERE class_id  = ' . $this->class_id . " and game_id = '" . $this->game_id . "'";
			$db->sql_query ( $sql );

			$sql = 'DELETE FROM ' . BB_LANGUAGE . " WHERE language= '" . $config ['bbguild_lang'] . "' AND attribute = 'class'
					and attribute_id= " . $this->class_id . " and game_id = '" . $this->game_id . "'";
			$db->sql_query ( $sql );

			$db->sql_transaction ( 'commit' );
			$cache->destroy ( 'sql', CLASS_TABLE );
			$cache->destroy ( 'sql', BB_LANGUAGE );
		}
		else
		{
			trigger_error ( sprintf ( $user->lang ['ADMIN_DELETE_CLASS_FAILED'], $this->class_id ) , E_USER_WARNING );
		}



	}

	/**
	 * deletes all classes from a game
	 */
	public function Delete_all_classes()
	{
		global $db, $cache;

		$sql = 'DELETE FROM ' . CLASS_TABLE . " WHERE game_id = '" .   $this->game_id . "'"  ;
		$db->sql_query ( $sql );

		$sql = 'DELETE FROM ' . BB_LANGUAGE . " WHERE attribute = 'class'
							AND game_id = '" . $this->game_id . "'";
		$db->sql_query ($sql);

		$cache->destroy ( 'sql', CLASS_TABLE );
		$cache->destroy ( 'sql', BB_LANGUAGE );
	}

     /**
	 * updates a class to database
     * @param Classes $oldclass
     */
	public function Update(Classes $oldclass)
	{
		global $user, $db, $config, $cache;

		// check for unique classid exception : if the new class id exists already
		$sql = 'SELECT count(*) AS countclass FROM ' . CLASS_TABLE . '
				WHERE c_index != ' . $this->c_index . "
				AND class_id = '" . $db->sql_escape ( $oldclass->class_id ) . "'
				AND game_id = '" . $this->game_id. "'";

		$result = $db->sql_query ( $sql );
		if (( int ) $db->sql_fetchfield ( 'countclass', false, $result ) > 0)
		{
			trigger_error ( sprintf ( $user->lang ['ADMIN_ADD_CLASS_FAILED'], $this->classname ), E_USER_WARNING );
		}
		$db->sql_freeresult ( $result );

		$data = array (
				'class_id' => ( int ) $this->class_id,
				'class_min_level' => ( int ) $this->min_level,
				'class_max_level' => ( int ) $this->max_level,
				'class_armor_type' => ( string ) $this->armor_type,
				'imagename' => $this->imagename,
				'class_hide' => 0,
				'colorcode' => $this->colorcode );
		$db->sql_transaction ( 'begin' );

		$sql = 'UPDATE ' . CLASS_TABLE . ' SET ' . $db->sql_build_array ( 'UPDATE', $data ) . '
			    WHERE c_index = ' . $this->c_index;

		$db->sql_query($sql);

		// now update the language table!
		$names = array (
				'attribute_id' => ( string ) $this->class_id, //new classid
				'name' => ( string ) $this->classname,
				'name_short' => ( string ) $this->classname);

		$sql = 'UPDATE ' . BB_LANGUAGE . ' SET ' . $db->sql_build_array ( 'UPDATE', $names ) . '
		 WHERE attribute_id = ' . $oldclass->class_id . " AND attribute='class'
		 AND language= '" . $config ['bbguild_lang'] . "' AND game_id = '" . $this->game_id . "'";
		$db->sql_query ( $sql );

		$db->sql_transaction ( 'commit' );
		$cache->destroy ( 'sql', BB_LANGUAGE );
		$cache->destroy ( 'sql', CLASS_TABLE );

	}


     /**
      *
      * lists all classes
      * @param string $order
      * @param int|number $mode
      * @return array
      */
	public function listclasses($order= 'class_id', $mode = 0)
	{
		global $db, $config;

		$sql_array = array (
				'SELECT' => ' c.game_id, c.c_index, c.class_id, l.name AS class_name, c.class_min_level, c.class_hide,
					c.class_max_level, c.class_armor_type, c.imagename, c.colorcode,  g.game_name ',
				'FROM' => array (
						CLASS_TABLE => 'c',
						BB_LANGUAGE => 'l',
						BBGAMES_TABLE => 'g'  ),
				'WHERE' => " c.class_id = l.attribute_id
							AND c.game_id = g.game_id AND c.game_id = l.game_id AND l.game_id = '" . $db->sql_escape ( $this->game_id ) . "'
							AND l.attribute='class' AND l.language= '" . $config ['bbguild_lang'] . "'",
				'ORDER_BY' => $order );

		if($mode == 0)
		{
			$sql_array['WHERE'] .=	'AND c.class_id = ' . $this->class_id;
		}

		$sql = $db->sql_build_query ( 'SELECT', $sql_array );
		$result = $db->sql_query ( $sql );
		$cl=array();
		while ( $row = $db->sql_fetchrow ($result))
		{
			$cl[$row['class_id']]  = array(
				'c_index' => (int) $row['c_index'],
				'game_name' => $row ['game_name'],
				'class_id' => (int) $row['class_id'],
				'class_name' => (string) $row['class_name'],
				'class_min_level' => (int) $row['class_min_level'],
				'class_max_level' => (int) $row['class_max_level'],
				'class_armor_type' => (string) $row['class_armor_type'],
				'class_hide' => (string) $row['class_hide'],
				'imagename' => (string) $row['imagename'],
				'colorcode' => (string) $row['colorcode'],
			);
		}
		$db->sql_freeresult ( $result );
		return $cl;
	}

}

