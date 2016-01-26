<?php
/**
 * @package bbguild v2.0
 * @copyright 2016 bbDKP <https://github.com/bbDKP>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */
namespace bbdkp\bbguild\ucp;

/**
 * @ignore
 */
if (!defined('IN_PHPBB'))
{
    exit;
}

/**
 * Class bbguild_info
 */
class bbguild_info
{
    function module()
    {
        return array(
            'filename'	=> '\bbdkp\bbguild\ucp\bbguild_module',
            'title'		=> 'UCP_BBGUILD',
            'version'	=> '2.0.0',
            'modes'		=> array(
                'char'	=> array(
                    'title' => 'UCP_CHARACTERS',
                    'auth' => 'ext_bbdkp/bbguild && acl_u_charclaim',
                    'cat' => array('UCP_BBGUILD')),
                'add'	=> array(
                    'title' => 'UCP_CHARACTER_ADD',
                    'auth' => 'ext_bbdkp/bbguild && acl_u_charadd',
                    'cat' => array('UCP_BBGUILD')),
            ),
        );
    }
}
