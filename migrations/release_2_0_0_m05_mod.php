<?php
/**
 * bbGuild database installer
 *
 * @package bbguild v2.0
 * @copyright 2015 bbDKP <https://github.com/bbDKP>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace bbdkp\bbguild\migrations;
use phpbb\db\migration\migration;

/**
 * Migration stage 5 module setup
 */
class release_2_0_0_m05_mod extends migration
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
        return array('\bbdkp\bbguild\migrations\release_2_0_0_m04_permissions');
    }

    /**
     * Add or update data in the database
     *
     * @return array Array of table data
     * @access public
     */
    public function update_data()
    {

        $categories = array(
            //array('module.add', array('acp', 'ACP_CAT_DOT_MODS', 'ACP_CAT_BBGUILD')),
            array('module.add', array('acp', 0, 'ACP_CAT_BBGUILD')),
            array('module.add', array('acp', 'ACP_CAT_BBGUILD', 'ACP_BBGUILD_MAINPAGE')),
            array('module.add', array('acp', 'ACP_CAT_BBGUILD', 'ACP_BBGUILD_PLAYER')),
            array('module.add', array('ucp', '0', 'UCP_BBGUILD')),
        );

        $modules = array(
            array('module.add', array(
                'acp',
                'ACP_BBGUILD_MAINPAGE',
                array(
                    'module_basename' => '\bbdkp\bbguild\acp\main_module',
                    'modes'           => array('panel', 'config', 'logs', 'index') ,
                )
            )),

            array('module.add', array(
                'acp',
                'ACP_BBGUILD_MAINPAGE',
                array(
                    'module_basename' => '\bbdkp\bbguild\acp\game_module',
                    'modes'           => array('listgames', 'editgames', 'addfaction', 'addrace', 'addclass', 'addrole'),
                )
            )),

            array('module.add', array(
                'acp',
                'ACP_BBGUILD_PLAYER',
                array(
                    'module_basename' => '\bbdkp\bbguild\acp\guild_module',
                    'modes'           => array('addguild', 'editguild', 'listguilds') ,
                )
            )),

            array('module.add', array(
                'acp',
                'ACP_BBGUILD_PLAYER',
                array(
                    'module_basename' => '\bbdkp\bbguild\acp\player_module',
                    'modes'           => array('addplayer', 'listplayers') ,
                )
            )),

            array('module.add', array(
                'ucp', 'UCP_BBGUILD', array(
                    'module_basename' => '\bbdkp\bbguild\ucp\bbguild_module',
                    'modes'           => array('char', 'add') ,
                )
            )),
        );

        return array_merge($categories, $modules);

    }
}
