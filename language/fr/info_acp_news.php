<?php
/**
 * bbguild acp language file for News (FR)
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
    'ACP_BBGUILD_NEWS'			=> 'Gestion des Actualités',
	'ACP_ADD_NEWS_EXPLAIN' 		=>  'Ici vous pouvez ajouter et modifier diverses actualités de la Guilde.',
	'ACP_BBGUILD_NEWS_ADD'		=> 'Ajouter une Actualité',
	'ACP_BBGUILD_NEWS_LIST'		=> 'Actualités',
	'ACP_BBGUILD_NEWS_LIST_EXPLAIN'	=> 'Ceci montre les Informations de la Guilde. ',
));
