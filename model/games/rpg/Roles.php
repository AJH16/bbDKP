<?php
/**
 * Role class
 * @package bbguild v2.0
 * @copyright 2016 bbDKP <https://github.com/bbDKP>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */
namespace bbdkp\bbguild\model\games\rpg;
use bbdkp\bbguild\model\games\Game;

/**
 * Roles
 * @package bbdkp\bbguild\model\games\rpg
 */
class Roles
{
    /**
     * the game_id (unique key)
     * @var string
     */
    public $game_id;

    /**
     * Primary key
     * @var int
     */
    public $role_pkid;

    /**
     * Class id
     * @var INT
     */
    public $role_id;

    /**
     * name of class
     * @var String
     */
    public $rolename;

    /**
     * name of image file without extension
     * @var String
     */
    public $role_icon;

    /**
     * name of role category icon without extension
     * @var
     */
    public $role_cat_icon;

    /**
     * class color hex
     * used in raid planner
     * @var string
     */
    public $role_color;

    /**
     * Role constructor
     */
    public function __construct()
    {
        $this->role_pkid = 0;
        $this->role_id = 0;
        $this->rolename = '';
        $this->role_icon = '';
        $this->role_cat_icon = '';
        $this->role_color = '';
    }

    /**
     * gets 1 class from database
     *
     */
    public function Get()
    {
        global $db, $config;

        $sql_array = array (
            'SELECT' => ' r.role_pkid, r.game_id, r.role_id, l.name AS rolename, r.role_icon, r.role_cat_icon, r.role_color ',
            'FROM' => array (
                BB_GAMEROLE_TABLE => 'r', BB_LANGUAGE => 'l' ),
            'WHERE' => " r.role_id = l.attribute_id
							AND l.attribute='role'
							AND l.game_id = '" . $this->game_id . "'
							AND r.game_id = l.game_id
							AND l.language= '" . $config ['bbguild_lang'] . "'
							AND r.role_id = " . $this->role_id);

        $sql = $db->sql_build_query ( 'SELECT', $sql_array );
        $result = $db->sql_query ( $sql );
        while ( $row = $db->sql_fetchrow ($result))
        {
            $this->role_pkid = $row['role_pkid'];
            $this->role_id = (int) $row['role_id'];
            $this->rolename = (string) $row['rolename'];
            $this->role_icon = (string) $row['role_icon'];
            $this->role_cat_icon = (string) $row['role_cat_icon'];
            $this->role_color = (string) $row['role_color'];
        }
        $db->sql_freeresult ( $result );

    }

    /**
     * adds a role to database
     */
    public function Make()
    {
        global $user, $db, $config, $cache;

        $sql = 'SELECT count(*) AS countrole FROM ' . BB_GAMEROLE_TABLE . ' WHERE role_id  = ' .
            $this->role_id . " AND game_id = '" . $this->game_id . "'";
        $resultc = $db->sql_query ($sql);

        if (( int ) $db->sql_fetchfield ( 'countrole', false, $resultc ) > 0)
        {
            trigger_error ( sprintf ( $user->lang ['ADMIN_ADD_ROLE_FAILED'], $this->rolename ), E_USER_WARNING );
        }
        $db->sql_freeresult ( $resultc );
        unset ( $resultc );

        $data = array (
            'game_id' => ( string ) $this->game_id,
            'role_id' => ( int ) $this->role_id,
            'role_icon' => $this->role_icon,
            'role_cat_icon' => $this->role_cat_icon,
            'role_color' => $this->role_color );

        $db->sql_transaction ( 'begin' );

        $sql = 'INSERT INTO ' . BB_GAMEROLE_TABLE . ' ' . $db->sql_build_array ( 'INSERT', $data );
        $db->sql_query ( $sql );


        $names = array (
            'game_id' => ( string ) $this->game_id,
            'attribute_id' => $this->role_id,
            'language' => $config ['bbguild_lang'],
            'attribute' => 'role',
            'name' => ( string ) $this->rolename,
            'name_short' => ( string ) $this->rolename );

        $sql = 'INSERT INTO ' . BB_LANGUAGE . ' ' . $db->sql_build_array ( 'INSERT', $names );
        $db->sql_query ( $sql );
        $db->sql_transaction ( 'commit' );
        $cache->destroy ( 'sql', BB_LANGUAGE );
        $cache->destroy ( 'sql', BB_GAMEROLE_TABLE );
    }

    /**
     * updates a class to database
     * @param Roles $oldrole
     */
    public function Update(Roles $oldrole)
    {
        global $db, $config, $cache;

        $data = array (
            'game_id' => ( string ) $this->game_id,
            'role_id' => ( int ) $this->role_id,
            'role_icon' => $this->role_icon,
            'role_cat_icon' => $this->role_cat_icon,
            'role_color' => $this->role_color );

        $db->sql_transaction ( 'begin' );

        $sql = 'UPDATE ' . BB_GAMEROLE_TABLE . ' SET ' . $db->sql_build_array ( 'UPDATE', $data ) . '
			    WHERE role_pkid = ' . $this->role_pkid;

        $db->sql_query($sql);

        // now update the language table!
        $names = array (
            'attribute_id' => ( string ) $this->role_id,
            'name' => ( string ) $this->rolename,
            'name_short' => ( string ) $this->rolename);

        $sql = 'UPDATE ' . BB_LANGUAGE . ' SET ' . $db->sql_build_array ( 'UPDATE', $names ) . '
             WHERE attribute_id = ' . $oldrole->role_id . " AND attribute='role'
             AND language= '" . $config ['bbguild_lang'] . "' AND game_id = '" . $this->game_id . "'";
        $db->sql_query ( $sql );

        $db->sql_transaction ( 'commit' );

        $cache->destroy ( 'sql', BB_LANGUAGE );
        $cache->destroy ( 'sql', BB_GAMEROLE_TABLE );

    }


    /**
     * deletes a role from database
     */
    public function Delete()
    {
        global $db, $config, $cache;

        $db->sql_transaction ( 'begin' );

        $sql = 'DELETE FROM ' . BB_GAMEROLE_TABLE . ' WHERE role_id  = ' . $this->role_id . " and game_id = '" . $this->game_id . "'";
        $db->sql_query ( $sql );

        $sql = 'DELETE FROM ' . BB_LANGUAGE . " WHERE language= '" . $config ['bbguild_lang'] . "' AND attribute = 'role'
                and attribute_id= " . $this->role_id . " and game_id = '" . $this->game_id . "'";
        $db->sql_query ( $sql );

        $db->sql_transaction ( 'commit' );
        $cache->destroy ( 'sql', CLASS_TABLE );
        $cache->destroy ( 'sql', BB_LANGUAGE );
    }

    /**
     * deletes all roles from a game
     */
    public function Delete_all_roles()
    {
        global $db, $cache;

        $sql = 'DELETE FROM ' . BB_GAMEROLE_TABLE . " WHERE game_id = '" .   $this->game_id . "'"  ;
        $db->sql_query ( $sql );

        $sql = 'DELETE FROM ' . BB_LANGUAGE . " WHERE attribute = 'role' AND game_id = '" . $this->game_id . "'";
        $db->sql_query ($sql);

        $cache->destroy ( 'sql', BB_GAMEROLE_TABLE );
        $cache->destroy ( 'sql', BB_LANGUAGE );
    }

    /**
     * lists all roles
     * @param string $order
     * @return array
     */
    public function listroles($order= 'role_id')
    {
        global $db, $config;

        $sql_array = array (
            'SELECT' => ' r.game_id, r.role_pkid, r.role_id, l.name AS rolename, r.role_icon, r.role_cat_icon, r.role_color, g.game_name ',
            'FROM' => array (
                BB_GAMEROLE_TABLE => 'r',
                BB_LANGUAGE => 'l',
                BBGAMES_TABLE => 'g' ),
            'WHERE' => " r.role_id = l.attribute_id AND r.game_id = g.game_id
                            AND r.game_id = l.game_id AND l.game_id = '" . $db->sql_escape ( $this->game_id ) . "'
							AND l.attribute='role' AND l.language= '" . $config ['bbguild_lang'] . "'",
            'ORDER_BY' => $order);

        $sql = $db->sql_build_query ( 'SELECT', $sql_array );
        $result = $db->sql_query ( $sql );
        $roles=array();
        while ( $row = $db->sql_fetchrow ($result))
        {
            $roles[$row['role_id']]  = array(
                'role_pkid'     => (int) $row['role_pkid'],
                'game_name'     => $row ['game_name'],
                'role_id'       => (int) $row['role_id'],
                'rolename'      => (string) $row['rolename'],
                'role_icon'     => (string) $row['role_icon'],
                'role_cat_icon'     => (string) $row['role_cat_icon'],
                'role_color'    => (string) $row['role_color'],
            );
        }
        $db->sql_freeresult ( $result );
        return $roles;
    }
}
