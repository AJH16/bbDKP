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
    'ACP_BBGUILD'		    => array('lang' => 'bbGuild Berechtigungen'),
    'ACL_A_BBGUILD'		    => array('lang' => 'Hat Zugriff auf den bbGuild AdministrationsbereicP'),
    'ACL_U_BBGUILD'		    => array('lang' => 'Kann die bbGuild Seiten sehen'),
    'ACL_U_CHARCLAIM'	    => array('lang' => 'Kann sich Charaktere in Benutzermenü zuweisen'),
    'ACL_U_CHARADD'	        => array('lang' => 'Kann eigene Charaktere im Benutzermenü hinzufügen'),
    'ACL_U_CHARUPDATE'	    => array('lang' => 'Kann eigene Charaktere im Benutzermenü bearbeiten.'),
    'ACL_U_CHARDELETE'	    => array('lang' => 'Kann eigene Charaktere im Benutzermenü löschen.'),
));
