<?php
/**
 * bbguild acp language file for Game, Race and Class  (FR)
 *
 * @package phpBB Extension - bbguild
 * @copyright 2009 bbguild <https://github.com/bbDKP>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 * @author sajaki <sajaki@gmail.com>
 * @link http://www.avathar.be/bbdkp
 * @version 2.0
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
    'ACP_BBGUILD_GAME'			=> 'Factions, Races, Classes',
	'ACP_BBGUILD_FACTION_ADD'		=> 'Ajouter Faction',
	'ACP_BBGUILD_RACE_ADD'		=> 'Ajouter Race',
	'ACP_BBGUILD_CLASS_ADD'		=> 'Ajouter Classe',
	'ACP_BBGUILD_GAME_LIST'		=> 'Réglages Jeux',
	'ACP_BBGUILD_GAME_EDIT'		=> 'Edition Jeux',
));
