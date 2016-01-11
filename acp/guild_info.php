<?php
/**
 * @package bbguild v2.0
 * @copyright 2016 bbDKP <https://github.com/bbDKP>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace sajaki\bbguild\acp;

/**
 * info class for acp module guild
 *   @package bbguild
 */
class guild_info
{
    /**
     * phpbb module function
     */
    function module()
    {
        return array(
            'filename'	=> '\sajaki\bbguild\acp\guild_module',
            'title'		=> 'ACP_BBGUILD_MEMBER',
            'version'	=> '2.0.0',
            'modes'		=> array(
                'addguild'	    => array(
                    'title' => 'ACP_BBGUILD_GUILD_ADD',
                    'auth' => 'ext_sajaki/bbguild && acl_a_board && a_bbguild',
                    'cat' => array('ACP_BBGUILD_MEMBER'),
                    'display' => false),
                'editguild'	    => array(
                    'title' => 'ACP_BBGUILD_GUILD_EDIT',
                    'auth' => 'ext_sajaki/bbguild && acl_a_board && a_bbguild',
                    'cat' => array('ACP_BBGUILD_MEMBER'),
                    'display' => false),
                'listguilds'	    => array(
                    'title' => 'ACP_BBGUILD_GUILD_LIST',
                    'auth' => 'ext_sajaki/bbguild && acl_a_board && a_bbguild',
                    'cat' => array('ACP_BBGUILD_MEMBER')),
            ),
        );
    }

}
