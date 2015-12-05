<?php
/**
 * bbdkp acp language file for mainmenu - german
 *
 * @package phpBB Extension - bbdkp
 * @copyright 2010 bbdkp <https://github.com/bbDKP>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 * @author sajaki <sajaki@gmail.com>
 * @link http://www.bbdkp.com
 * @version 2.0
 * @translation various unknown authors, killerpommes
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
    'ACP_CAT_DKP'			=> 'bbDKP',
	'ACP_DKP_MAINPAGE'		=> 'Allgemeine Einstellungen',
	'ACP_DKP_PANEL'		    	=> 'Adminmenü',
	'ACP_DKP_CONFIG'		=> 'Haupteinstellungen',
	'ACP_DKP_INDEX'			=> 'Portaleinstellungen',
	'ACP_DKP_LOGS'			=> 'bbDKP-Protokoll',
));
