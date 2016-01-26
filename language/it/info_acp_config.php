<?php
/**
 * bbguild acp language file for mainmenu
 * @author lucasari
 * @package phpBB Extension - bbguild
 * @copyright 2011 bbguild <https://github.com/bbDKP>
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
    'ACP_CAT_BBGUILD'			=> 'BBDKP',
	'ACP_BBGUILD_MAINPAGE'		=> 'Impostazioni Generali',
	'ACP_BBGUILD_PANEL'		    	=> 'Pannello Admin',
	'ACP_BBGUILD_CONFIG'		=> 'Impostazioni bbguild',
	'ACP_BBGUILD_INDEX'			=> 'Impostazioni Portale',
	'ACP_BBGUILD_LOGS'			=> 'Vedi Log',
));
