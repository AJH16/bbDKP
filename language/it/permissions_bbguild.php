<?php
/**
 * bbGuild Permission Set Italiano
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
    'ACP_BBGUILD'		    => array('lang' => 'bbGuild Permissions'),
    'ACL_A_BBGUILD'		    => array('lang' => 'Può accedere a modulo bbDKP ACP'),
    'ACL_U_BBGUILD'		    => array('lang' => 'Può visualizzare le pagine DKP'),
    'ACL_U_CHARCLAIM'	    => array('lang' => 'Può selezionare il proprio personaggio da UCP'),
    'ACL_U_CHARADD'	        => array('lang' => 'Può aggiungere il proprio personaggio da UCP.'),
    'ACL_U_CHARUPDATE'	    => array('lang' => 'Può aggiornare il proprio personaggio da UCP'),
    'ACL_U_CHARDELETE'	    => array('lang' => 'Può cancellare il proprio personaggio da UCP.'),
));
