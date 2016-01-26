<?php
/**
 * @package bbguild v2.0
 * @copyright 2016 bbDKP <https://github.com/bbDKP>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace bbdkp\bbguild\acp;

/**
 * info class for acp module guild
 *   @package bbguild
 */
class recruit_info
{
    /**
     * phpbb module function
     */
    function module()
    {
        return array(
            'filename'	=> '\bbdkp\bbguild\acp\recruit_module',
            'title'		=> 'ACP_BBGUILD_RECRUIT',
            'version'	=> '2.0.0',
            'modes'		=> array(
                'addrecruit'	    => array(
                    'title' => 'ACP_BBGUILD_RECRUIT_ADD',
                    'auth' => 'ext_bbdkp/bbguild && acl_a_board && acl_a_bbguild',
                    'cat' => array('ACP_BBGUILD_PLAYER'),
                    'display' => false),
                'editrecruit'	    => array(
                    'title' => 'ACP_BBGUILD_RECRUIT_EDIT',
                    'auth' => 'ext_bbdkp/bbguild && acl_a_board && acl_a_bbguild',
                    'cat' => array('ACP_BBGUILD_PLAYER'),
                    'display' => false),
                'listrecruit'	    => array(
                    'title' => 'ACP_BBGUILD_RECRUIT_LIST',
                    'auth' => 'ext_bbdkp/bbguild && acl_a_board && acl_a_bbguild',
                    'cat' => array('ACP_BBGUILD_PLAYER'),
                    'display' => true),
            ));
    }

}

