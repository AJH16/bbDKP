<?php
/**
 * bbguild acp language file for guilds -german
 *
 * @package phpBB Extension - bbguild
 * @copyright 2010 bbguild <https://github.com/bbGuild>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 * @author sajaki <sajaki@gmail.com>
 * @link http://www.avathar.be/bbdkp
 * @version 2.0
 * @translation various unknown authors, killerpommes
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
	'ACP_BBGUILD_GUILD'		=> 'Gilden',
 	'ACP_BBGUILD_GUILD_ADD'	=> 'Neue Gilde',
	'ACP_BBGUILD_GUILD_EDIT'	=> 'Gilde bearbeiten',
	'ACP_BBGUILD_GUILD_LIST'	=> 'Gildenliste',
));
