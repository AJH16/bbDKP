<?php
/**
 * bbguild acp language file for mainmenu (FR)
 *
 * @package phpBB Extension - bbguild
 * @copyright 2009 bbguild <https://github.com/bbDKP>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 * @author sajaki <sajaki@gmail.com>
 * @link http://www.avathar.be/bbdkp
 * @version 2.0
 * 
 */

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

// Create the lang array if it does not already exist
if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// Merge the following language entries into the lang array
$lang = array_merge($lang, array(
    'ACP_CAT_BBGUILD'			=> 'bbDKP',
	'ACP_BBGUILD_MAINPAGE'		=> 'Paramètres généraux',
	'ACP_BBGUILD_PANEL'		    	=> 'Statistiques',
	'ACP_BBGUILD_CONFIG'		=> 'Réglages bbguild',
	'ACP_BBGUILD_INDEX'			=> 'Réglages portail',
	'ACP_BBGUILD_LOGS'			=> 'Consulter les Logs',
));
