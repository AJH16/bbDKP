<?php
/**
 * bbDKP database installer
 *
 * @package bbguild v2.0
 * @copyright 2016 bbDKP <https://github.com/bbDKP>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace bbdkp\bbguild\migrations;
use phpbb\db\migration\migration;

/**
 * Migration stage 4 permissions
 */
class release_2_0_0_m04_permissions extends migration
{

    /**
     * Assign migration file dependencies for this migration
     *
     * @return array Array of migration files
     * @static
     * @access public
     */
    static public function depends_on()
    {
        return array('\bbdkp\bbguild\migrations\release_2_0_0_m03_config');
    }

    /**
     * Add or update data in the database
     *
     * @return array Array of table data
     * @access public
     */
    public function update_data()
    {

        $data_sets = array(
            // Add permission
            array('permission.add', array('a_bbguild', true)),
            array('permission.add', array('u_bbguild', true)),
            array('permission.add', array('u_charclaim', true)),
            array('permission.add', array('u_charadd', true)),
            array('permission.add', array('u_chardelete', true)),
            array('permission.add', array('u_charupdate', true)),
        );

        //admin role can access bbguild acp
        if($this->role_exists('ROLE_ADMIN_FULL'))
        {
            $data_sets[] =  array('permission.permission_set', array('ROLE_ADMIN_FULL', 'a_bbguild'));
        }

        if($this->role_exists('ROLE_ADMIN_STANDARD'))
        {
            $data_sets[] =  array('permission.permission_set', array('ROLE_ADMIN_STANDARD', 'a_bbguild'));
        }

        //user can access pages
        if($this->role_exists('ROLE_USER_STANDARD'))
        {
            $data_sets[] = array('permission.permission_set', array('ROLE_USER_STANDARD', array('u_bbguild',)));
        }

        //full user can access pages and ucp
        if($this->role_exists('ROLE_USER_FULL'))
        {
            $data_sets[] = array('permission.permission_set', array('ROLE_USER_STANDARD', array('u_bbguild', 'u_charclaim', 'u_charadd', 'u_chardelete', 'u_charupdate')));
        }
        return $data_sets;

    }

    /**
     * check if role exists
     *
     * @param $role
     * @return bool
     */
    protected function role_exists($role)
    {
        $sql = 'SELECT COUNT(role_id) AS role_count
	        FROM ' . ACL_ROLES_TABLE . "
	        WHERE role_name = '" . $this->db->sql_escape($role) . "'";
        $result = $this->db->sql_query_limit($sql, 1);
        $role_count = $this->db->sql_fetchfield('role_count');
        $this->db->sql_freeresult($result);
        return $role_count > 0;
    }
}
