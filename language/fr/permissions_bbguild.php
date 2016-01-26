<?php
/**
 * bbGuild Permission Set English
 *
 * @package bbguild v2.0
 * @copyright 2015 bbDKP <https://github.com/bbDKP>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

/**
 * DO NOT CHANGE
 */
if (!defined('IN_PHPBB'))
{
    exit;
}

if (empty($lang) || !is_array($lang))
{
    $lang = array();
}
$lang = array_merge($lang, array(
    'ACP_BBGUILD'		    => array('lang' => 'Accès pages bbGuild'),
    'ACL_A_BBGUILD'		    => array('lang' => 'peut accèder PCA bbGuild'),
    'ACL_U_BBGUILD'		    => array('lang' => 'Can see bbGuild pages'),
    'ACL_U_CHARCLAIM'	    => array('lang' => 'Peut lier des charactères à son compte phpBB en PCU'),
    'ACL_U_CHARADD'	        => array('lang' => 'Peut créer ses charactères en PCU'),
    'ACL_U_CHARUPDATE'	    => array('lang' => 'Peut mettre à jour ses charactères en PCU'),
    'ACL_U_CHARDELETE'	    => array('lang' => 'Peut supprimer ses charactères en PCU'),
));
