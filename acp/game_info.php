<?php
/**
 * @package bbguild v2.0
 * @copyright 2016 bbDKP <https://github.com/bbDKP>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace bbdkp\bbguild\acp;

/**
 * info class for acp module game
 *   @package bbguild
 */
class game_info
{
    /**
     * phpbb module function
     */
    function module()
    {
        return array(
            'filename'	=> '\bbdkp\bbguild\acp\game_module',
            'title'		=> 'ACP_BBGUILD_MAINPAGE',
            'version'	=> '2.0.0',
            'modes'		=> array(
                'listgames'		=> array(
                    'title' => 'ACP_BBGUILD_GAME_LIST',
                    'auth' => 'ext_bbdkp/bbguild && acl_a_board && acl_a_bbguild',
                    'cat' => array('ACP_BBGUILD_GAME') ,
                    'display' => true),
                'editgames'		=> array(
                    'title' => 'ACP_BBGUILD_GAME_EDIT',
                    'auth' => 'ext_bbdkp/bbguild && acl_a_board && acl_a_bbguild',
                    'cat' => array('ACP_BBGUILD_GAME') ,
                    'display' => false),
                'addfaction'	=> array(
                    'title' => 'ACP_BBGUILD_FACTION_ADD',
                    'auth' => 'ext_bbdkp/bbguild && acl_a_board && acl_a_bbguild',
                    'cat' => array('ACP_BBGUILD_GAME') ,
                    'display' => false),
                'addrace'		=> array(
                    'title' => 'ACP_BBGUILD_RACE_ADD',
                    'auth' => 'ext_bbdkp/bbguild && acl_a_board && acl_a_bbguild',
                    'cat' => array('ACP_BBGUILD_GAME') ,
                    'display' => false),
                'addclass'		=> array(
                    'title' => 'ACP_BBGUILD_CLASS_ADD',
                    'auth' => 'ext_bbdkp/bbguild && acl_a_board && acl_a_bbguild',
                    'cat' => array('ACP_BBGUILD_GAME') ,
                    'display' => false),
                'addrole'		=> array(
                    'title' => 'ACP_BBGUILD_ROLE_ADD',
                    'auth' => 'ext_bbdkp/bbguild && acl_a_board && acl_a_bbguild',
                    'cat' => array('ACP_BBGUILD_GAME') ,
                    'display' => false),
            ),
        );
    }

}
