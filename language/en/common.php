<?php
/**
 * bbguild common language file - [en]

 * @package phpBB Extension - bbguild
 * @copyright 2009 bbguild <https://github.com/bbDKP>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 * @author sajaki <sajaki@gmail.com>
 * @link http://www.avathar.be/bbdkp
 * @version 2.0
 *
 */

/**
 * DO NOT CHANGE
 */
if (!defined('IN_PHPBB'))
{
    exit;
}

/**
 * DO NOT CHANGE
 */
if (empty($lang) || !is_array($lang))
{
    $lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
    'BBDKPDISABLED' => 'bbGuild is currently disabled.',
    'FOOTERBBDKP' => 'bbGuild',

//---- Portal blocks -----
    'PORTAL' => 'Portal',
    'USER_MENU'			=> 'User menu',
    'RECENTLOOT' => 'Recent Loot',
    'REMEMBERME' => 'Remember me',
    'INFORUM' => 'Posted in',
    'BBGUILD' => 'Guild',
    'DKP' => 'DKP',
    'NEWS' => 'News',
    'COMMENT' => 'Comment',
    'LIST_NEWS' => 'List News',
    'NO_NEWS' => 'No news entries found.',
    'NEWS_PER_PAGE' => 'News Entries per Page',
    'ERROR_INVALID_NEWS_PROVIDED' => 'A valid news id was not provided.',
    'BOSSPROGRESS' => 'Bossprogress',
    'WELCOME' => 'Welcome',
    'RECENT_LENGTH' => 'Number of chars retrieved',
    'NUMTOPICS' => 'Number of topics retrieved',
    'SHOW_RT_BLOCK' => 'Show Recent Topics',
    'RECENT_TOPICS_SETTING' => 'Recent Topics Settings',
    'RECENT_TOPICS' => 'Recent Topics',
    'NO_RECENT_TOPICS' => 'No recent topics',
    'POSTED_BY_ON' => 'by %1$s on %2$s',
    'LATESTPLAYERS' => 'Latest players',

// Main Menu
    'MENU' => 'Navigation',
    'MENU_ADMIN_PANEL' => 'Administration Panel',
    'MENU_BOSS' => 'Bossprogress',
    'MENU_EVENTS' => 'Events',
    'MENU_ITEMVAL' => 'Item Values',
    'MENU_ITEMHIST' => 'Item History',
    'MENU_NEWS' => 'News',
    'MENU_RAIDS' => 'Raids',
    'MENU_ROSTER' => 'Roster',
    'MENU_STATS' => 'Statistics',
    'MENU_SUMMARY' => 'Summary',
    'MENU_STANDINGS' => 'Leaderboard',
    'MENU_VIEWPLAYER' => 'View Player',
    'MENU_VIEWITEM' => 'View Item',
    'MENU_VIEWRAID' => 'View Raid',
    'MENU_VIEWEVENT' => 'View Event',
    'MENU_PLANNER' => 'Planner',

//links
    'MENU_LINKS' => 'Weblinks',
    'LINK1' => 'http://www.avathar.be/bbdkp',
    'LINK1T' => 'Powered By: bbGuild',
    'LINK2' => 'http://uk.aiononline.com',
    'LINK2T' => 'Aion Online',
    'LINK3' => 'http://darkageofcamelot.com',
    'LINK3T' => 'Dark age of Camelot',
    'LINK4' => 'http://everquest2.station.sony.com/',
    'LINK4T' => 'Everquest 2',
    'LINK5' => 'http://www.playonline.com/ff11us/index.shtml',
    'LINK5T' => 'FFXI',
    'LINK6' => 'http://de.finalfantasyxiv.com/lodestone/',
    'LINK6T' => 'FFXIV',
    'LINK7' => 'http://www.guildwars2.com',
    'LINK7T' => 'Guild Wars 2',
    'LINK8' => 'http://www.lineage2.com',
    'LINK8T' => 'Lineage 2',
    'LINK9' => 'http://www.lotro.com',
    'LINK9T' => 'Lord of the Rings',
    'LINK10' => 'http://www.riftgame.com',
    'LINK10T' => 'Rift',
    'LINK11' => 'http://www.swtor.com',
    'LINK11T' => 'Star Wars : ToR',
    'LINK12' => 'http://tera.enmasse.com/',
    'LINK12T' => 'Tera',
    'LINK13' => 'http://www.vanguardmmorpg.com',
    'LINK13T' => 'Vanguard',
    'LINK14' => 'http://www.warhammeronline.com',
    'LINK14T' => 'Warhammer',
    'LINK15' => 'http://www.worldofwarcraft.com',
    'LINK15T' => 'World of Warcraft',

//games preinstalled
    'AION'       => 'Aion' ,
    'DAOC'       => 'Dark Age of Camelot' ,
    'EQ'         => 'EverQuest' ,
    'EQ2'        => 'EverQuest II' ,
    'FFXI'       => 'Final Fantasy XI',
    'GW2'    => 'GuildWars 2',
    'LINEAGE2'   => 'Lineage 2',
    'LOTRO'      => 'Lord of the Rings Online' ,
    'RIFT'       => 'Rift',
    'SWTOR'      => 'Starwars : The old Republic',
    'TERA'    => 'Tera',
    'VANGUARD'  => 'Vanguard Saga of Heroes' ,
    'WARHAMMER'  => 'Warhammer Online' ,
    'WOW'        => 'World of Warcraft' ,
    'FFXIV'        => 'Final Fantasy XIV' ,
    'PREINSTALLED' => 'Preinstalled games: %s',

//Recruitment
    'RECRUITMENT_BLOCK' => 'Recruitment Status',
    'RECRUIT_CLOSED' => 'Closed',
    'RECRUIT_OPEN' => 'Open',
    'TANK' => 'Tank',
    'DPS' => 'Dps' ,
    'HEAL' => 'Heal',
    'HEALER' => 'Healer',
    'RECRUIT_MESSAGE' => 'We are currently looking for new players for the following classes:',

//ROSTER
    'GUILDROSTER' => 'Guild Roster',
    'RANK'   => 'Rank',
    'CLASS'   => 'Class',
    'LVL'   => 'Level',
    'REALM'  => 'Realm',
    'REGION'  => 'Region',
    'ACHIEV'  => 'Achievements',
    'PROFFESSION' => 'Proffessions',

//listplayers
    'ADJUSTMENT' => 'Adjustment',
    'ALL' => 'All',
    'CURRENT' => 'Current',
    'EARNED' => 'Earned',
    'FILTER' => 'Filter',
    'LASTRAID' => 'Last Raid',
    'LEVEL' => 'Level',
    'LISTPLAYERS_TITLE' => 'Leaderboard',
    'MNOTFOUND' => 'Could not obtain player information',
    'RNOTFOUND' => 'Could not obtain Raid information',
    'EMPTYRAIDNAME' => 'Raidname Not Found',
    'NAME' => 'Name',
    'POOL' => 'Point Pool',
    'RAID_ATTENDANCE_HISTORY' => 'Raid Attendance History',
    'RAIDS_LIFETIME' => 'Lifetime (%s - %s)',
    'ATTENDANCE_LIFETIME' => 'Lifetime Attendance',
    'RAIDS_X_DAYS' => 'Last %d Days',
    'SPENT' => 'Spent',
    'COMPARE_PLAYERS' => 'Compare Players',
    'LISTPLAYERS_FOOTCOUNT' => '... found %d players',
    'SURNAME' => 'Surname/Title',
    'LISTADJ_TITLE' => 'Adjustment Listing',
    'LISTEVENTS_TITLE' => 'Event Values',
    'LISTIADJ_TITLE' => 'Individual Adjustment Listing',
    'LISTITEMS_TITLE' => 'Item Values',
    'LISTPURCHASED_TITLE' => 'Item History',
    'LISTRAIDS_TITLE' => 'Raids Listing',
    'LOGIN_TITLE' => 'Login',
    'STATS_TITLE' => '%s Stats',
    'TITLE_PREFIX' => '%s %s',
    'VIEWEVENT_TITLE' => 'Viewing Recorded Raid History for %s',
    'VIEWITEM_TITLE' => 'Viewing Purchase History for %s',
    'VIEWPLAYER_TITLE' => 'History for %s',
    'VIEWRAID_TITLE' => 'Raid Summary',
    'NODKPACCOUNTS' => 'No DKP accounts found',
    'NOUCPACCESS' => 'You are not authorised to claim characters',
    'NOUCPADDCHARS' => 'You are not authorised to add characters',
    'NOUCPUPDCHARS' => 'You are not authorised to update your characters',
    'NOUCPDELCHARS' => 'You are not authorised to delete your characters',

// Various
    'ACCOUNT' => 'Account',
    'ACTION' => 'Action',
    'ACHIEVED' => 'earned the achievement ',
    'ADD' => 'Add',
    'ADDED_BY' => 'Added by %s',

    'ADMINISTRATION' => 'Administration',
    'ADMINISTRATIVE_OPTIONS' => 'Administrative Options',
    'ADMIN_INDEX' => 'Admin Index',
    'ATTENDANCE_BY_EVENT' => 'Attendance by Event',
    'ATTENDED' => 'Attended',
    'ATTENDEES' => 'Attendees',
    'ATTENDANCE' => 'Attendance',
    'ATT' => 'Att.',
    'AVERAGE' => 'Average',
    'BOSS' => 'Boss',
    'BUYER' => 'Buyer',
    'BUYERS' => 'Buyers',
    'ARMOR' => 'Armor',
    'STATS_SOCIAL' => '< 20% Attendance',
    'STATS_RAIDER' => '< 50% Attendance',
    'STATS_CORERAIDER' => '> 70% Attendance',

// TYPES of armor are static across games, no need to put it in DB
    'CLOTH' => 'Very light / Cloth',
    'ROBE' => 'Robes',
    'LEATHER' => 'Light / Leather',
    'AUGMENTED' => 'Augmented Suit',
    'MAIL' =>  'Medium / Chain Mail',
    'HEAVY' => 'Heavy Armor',
    'PLATE' => 'Heavy / Plate',

    'CLASSID' => 'Class ID',
    'CLASS_FACTOR' => 'Class Factor',
    'CLASSARMOR' => 'Class Armor',
    'CLASSIMAGE' => 'Image',
    'CLASSMIN' => 'Min level',
    'CLASSMAX' => 'Max level',
    'CLASS_DISTRIBUTION' => 'Class Distribution',
    'CLASS_SUMMARY' => 'Class Summary: %s to %s',
    'CONFIGURATION' => 'Configuration',
    'DATE' => 'Date',
    'DELETE' => 'Delete',
    'DELETE_CONFIRMATION' => 'Delete Confirmation',
    'DKP_VALUE' => '%s Value',

    'NO_CHARACTERS' => 'No characters in database',
    'STATUS' => 'Status Y/N',
    'CHARACTER' => 'Here is a list of all your Characters. ',
    'CHARACTER_EXPLAIN' => 'Choose an unclaimed Character to claim it and press submit.',
    'CHARACTERS_UPDATED' => 'The Charactername %s was assigned to your account. ',
    'NO_CHARACTERS_BOUND' => 'No characters bound to your Account.',

    'DROPS' => 'Drops',
    'EVENTNOTE' => 'Note: only lists attended raids or obtained loot from active events.',
    'EVENT' => 'Event',
    'EVENTNAME' => 'Event Name',
    'EVENTS' => 'Events',
    'FACTION' => 'Faction',
    'FACTIONID' => 'Faction ID',
    'FIRST' => 'First',
    'FORNPOINTS' => ' for %s points.',
    'HIGH' => 'High',
    'ADJUSTMENTS' => 'Adjustments',
    'ADJUSTMENT_HISTORY' => 'Adjustments History',
    'INDIV_ADJ' => 'Indiv. Adj.',
    'ITEM' => 'Item',
    'ITEMS' => 'Items',
    'ITEMVALUE' => 'Item Value',
    'ITEMDECAY' => 'Item Decay',
    'ITEMTOTAL' => 'Total value',
    'ITEM_PURCHASE_HISTORY' => 'Item Purchase History',
    'JOINDATE' => 'Guild Join date',
    'LAST' => 'Last',
    'LASTLOOT' => 'Last Loot',
    'LAST_VISIT' => 'Last Visit',
    'LAST_UPDATE' => 'Last Update',
    'LOG_DATE_TIME' => 'Date/Time of this Log',
    'LOOT_FACTOR' => 'Loot Factor',
    'LOOTS' => 'Loots',
    'LOOTDIST_CLASS' => 'Loot distribution per Class',
    'LOOTED' => 'obtained',
    'LOW' => 'Low',
    'MANAGE' => 'Manage',
    'MEDIUM' => 'Medium',
    'PLAYER' => 'Player',
    'PLAYERS' => 'Players',
    'NA' => 'N/A',
    'NETADJUSTMENT' => 'Net',
    'NETSPENT' => 'Net',
    'NO_DATA' => 'No Data',
    'NO_LOOT' => 'No Loot',
    'NO_RAIDS' => 'No Raids',
    'NO_ADJUSTMENTS' => 'No Adjustments',
    'RAID_ON' => 'Raid on %s on %s',
    'MAX_CHARS_EXCEEDED' => 'Sorry, you can only have %s Characters bound to your phpBB account.',
    'MISCELLANEOUS' => 'Miscellaneous',
    'NEWEST' => 'Newest raid',

    'NOTE' => 'Note',
    'OLDEST' => 'Oldest raid',
    'OPEN' => 'Open',
    'OPTIONS' => 'Options',
    'OUTDATE' => 'Guild leave date',
    'PERCENT' => 'Percent',
    'PERMISSIONS' => 'Permissions',
    'PER_DAY' => 'Per Day',
    'PER_RAID' => 'Per Raid',
    'PCT_EARNED_LOST_TO' => '% Earned Lost to',
    'PREFERENCES' => 'Preferences',
    'PURCHASE_HISTORY_FOR' => 'Purchase History for %s',
    'LEADERBOARDSTAT' => 'Leaderboard vs. Raidcount',
    'QUOTE' => 'Quote',
    'RACE' => 'Race',
    'RACEID' => 'Race ID',
    'RAIDSTART' => 'Raid Start',
    'RAIDEND' => 'Raid End',
    'RAIDDURATION' => 'Duration',
    'RAID' => 'Raid',
    'RAIDCOUNT' => 'Raidcount',
    'RAIDS' => 'Raids',
    'RAID_ID' => 'Raid ID',
    'RAIDVALUE' => 'Raid Value',
    'RAIDBONUS' => 'Raid Bonus',
    'RANK_DISTRIBUTION' => 'Rank Distribution',
    'RECORDED_RAID_HISTORY' => 'Raid History',
    'RECORDED_DROP_HISTORY' => 'Purchase History',
    'REASON' => 'Reason',
    'RESULT' => 'Result',

    'SESSION_ID' => 'Session ID',

    'SUMMARY_DATES' => 'Raid Summary: %s to %s',
    'TIME' => 'Time',
    'TIME_BONUS' => 'Time bonus',
    'TOTAL' => 'Total',
    'TIMEVALUE' => 'Time Value',
    'TOTAL_ADJUSTMENTS' => 'Total Adjustments',
    'TOTAL_EARNED' => 'Total Earned',
    'TOTAL_ITEMS' => 'Total Items',
    'TOTAL_RAIDS' => 'Total Raids',
    'TOTAL_SPENT' => 'Total Spent',
    'TRANSFER_PLAYER_HISTORY' => 'Transfer Player History',
    'TYPE' => 'Type',
    'UPDATE' => 'Update',
    'UPDATED_BY' => 'Updated by %s',
    'USER' => 'User',
    'USERNAME' => 'Username',
    'VALUE' => 'Value',
    'VIEW' => 'View',
    'VIEW_ACTION' => 'View Action',
    'VIEW_LOGS' => 'View Logs',
    'ZSVALUE' => 'Zerosum',
    'ZEROSUM' => 'Zerosum bonus',
    'APPLICANTS' => 'Applicants',
    'POSITIONS' => 'Positions',

//lootsystems
    'EP' => 'EP',
    'EPLONG' => 'Effort points',
    'EPNET' => 'EP net',
    'EPNETLONG' => 'Net Effort Points',
    'GP' => 'GP',
    'GPLONG' => 'Gear points',
    'GPNET' => 'GP net',
    'PR' => 'PR',
    'PRLONG' => 'Priority ratio',
    'RAIDDECAY' => 'Raid Decay',
    'ADJDECAY' => 'Adjustment decay',
    'DECAY' => 'Decay',

// Page Foot Counts

    'LISTEVENTS_FOOTCOUNT' => '... found %d events',
    'LISTIADJ_FOOTCOUNT' => '... found %d individual adjustment(s) / %d per page',
    'LISTITEMS_FOOTCOUNT' => '... found %d unique items / %d per page',
    'LISTNEWS_FOOTCOUNT' => '... found %d News Items',
    'LISTPLAYERS_ACTIVE_FOOTCOUNT' => '... found %d active players / %sshow all</a>',
    'LISTPLAYERS_COMPARE_FOOTCOUNT' => '... comparing %d players',
    'LISTPURCHASED_FOOTCOUNT' => '... found %d item(s) / %d per page',
    'LISTPURCHASED_FOOTCOUNT_SHORT' => '... found %d item(s)',
    'LISTRAIDS_FOOTCOUNT' => '... found %d raid(s) / %d per page',
    'STATS_ACTIVE_FOOTCOUNT' => '... found %d active player(s) / %sshow all</a>',
    'STATS_FOOTCOUNT' => '... found %d player(s) /%sshow active</a>',
    'VIEWEVENT_FOOTCOUNT' => '... found %d raid(s)',
    'VIEWITEM_FOOTCOUNT' => '... found %d item(s)',
    'VIEWPLAYER_ADJUSTMENT_FOOTCOUNT' => '... found %d individual adjustment(s)',
    'VIEWPLAYER_ITEM_FOOTCOUNT' => '... found %d purchased item(s) / %d per page',
    'VIEWPLAYER_RAID_FOOTCOUNT' => '... found %d attended raid(s) / %d per page',
    'VIEWPLAYER_EVENT_FOOTCOUNT' => '... found %d attended event(s)',
    'VIEWRAID_ATTENDEES_FOOTCOUNT' => '... found %d attendee(s)',
    'VIEWRAID_DROPS_FOOTCOUNT' => '... found %d drop(s)',

// Submit Buttons
    'LOG_ADD_DATA' => 'Add Data to Form',
    'PROCEED' => 'Proceed',
    'UPGRADE' => 'Upgrade',

// Form Element Descriptions
    'ENDING_DATE' => 'Ending Date',
    'GUILD_TAG' => 'Guild Tag',
    'LANGUAGE' => 'Language',
    'STARTING_DATE' => 'Starting Date',
    'TO' => 'To',

// Pagination
    'NEXT_PAGE' => 'Next Page',
    'PAGE' => 'Page',
    'PREVIOUS_PAGE' => 'Previous Page',

// Permission Messages
    'NOAUTH_DEFAULT_TITLE' => 'Permission Denied',
    'NOAUTH_U_EVENT_LIST' => 'You do not have permission to list events.',
    'NOAUTH_U_EVENT_VIEW' => 'You do not have permission to view events.',
    'NOAUTH_U_ITEM_LIST' => 'You do not have permission to list items.',
    'NOAUTH_U_ITEM_VIEW' => 'You do not have permission to view items.',
    'NOAUTH_U_PLAYER_LIST' => 'You do not have permission to view player standings.',
    'NOAUTH_U_PLAYER_VIEW' => 'You do not have permission to view player history.',
    'NOAUTH_U_RAID_LIST' => 'You do not have permission to list raids.',
    'NOAUTH_U_RAID_VIEW' => 'You do not have permission to view raids.',

// Miscellaneous
    'DEACTIVATED_BY_API' => 'Deactivated by API',
    'DEACTIVATED_BY_USR' => 'Deactivated by User',

    'ADDED' => 'Added',
    'BOSSKILLCOUNT' => 'Bosskills',
    'CLOSED' => 'Closed',
    'DELETED' => 'Deleted',
    'ENTER_NEW' => 'Enter New Name',
    'ENTER_NEW_GAMEITEMID' => 'Game item ID',
    'FEMALE' => 'Female',
    'GENDER' => 'Gender',
    'GUILD' => 'Guild',
    'LIST' => 'List',
    'LIST_EVENTS' => 'List Events',
    'LIST_INDIVADJ' => 'List Individual Adjustments',
    'LIST_ITEMS' => 'List Items',
    'LIST_PLAYERS' => 'List Players',
    'LIST_RAIDS' => 'List Raids',
    'MALE' => 'Male',
    'MAY_BE_NEGATIVE_NOTE' => 'may be negative',
    'NOT_AVAILABLE' => 'Not Available',
    'NORAIDS' => 'No Raids',
    'OF_RAIDS' => '%d',
    'OF_RAIDS_CHAR' => '%s',
    'OR' => 'or',
    'REQUIRED_FIELD_NOTE' => 'Items marked with a * are required fields.',
    'SELECT_EXISTING' => 'Select Existing',
    'UPDATED' => 'Updated',
    'NOVIEW' => 'Unknown Viewname %s',
    'IRCTLIFE' => 'Ind.Raidcount Life',
    'GRCTLIFE' => 'All.Raidcount Life',
    'ATTLIFE' => 'Attendance Life',
    'IRCT90' => 'Ind.Raidcount 90d',
    'GRCT90' => 'All.Raidcount 90d',
    'ATT90' => 'Attendance 90d',
    'IRCT60' => 'Ind.Raidcount 60d',
    'GRCT60' => 'All.Raidcount 60d',
    'ATT60' => 'Attendance 60d',
    'IRCT30' => 'Ind.Raidcount 30d',
    'GRCT30' => 'All.Raidcount 30d',
    'ATT30' => 'Attendance 30d',

//---- About --- here be dragons
//tabs
    'ABOUT' => 'About',
    'MAINIMG' => 'bbguild.png',
    'IMAGE_ALT' => 'Logo',
    'REPOSITORY_IMAGE' => 'Google.jpg',
    'TCOPYRIGHT' => 'Copyright',
    'TCREDITS' => 'Credits',
    'TEAM' => 'Dev Team',
    'TSPONSORS' => 'Donators',
    'TPLUGINS' => 'PlugIns',
    'CREATED' => 'Created by',
    'DEVELOPEDBY' => 'Developed by',
    'DEVTEAM' => 'bbGuild Development Team',
    'AUTHNAME' => 'Ippeh',
    'WEBNAME' =>'Website',
    'SVNNAME' => 'Repository',
    'SVNURL' => 'https://github.com/bbDKP',
    'WEBURL' => 'http://www.avathar.be/bbdkp',
    'WOWHEADID' => 'Wowhead id',
    'AUTHWEB' => 'http://www.avathar.be/bbdkp/',
    'DONATIONCOMMENT' => 'bbGuild is freeware, but you can support our development efforts by making a contribution.',
    'PAYPALLINK' => '<form action="https://www.paypal.com/cgi-bin/webscr" method="post"><input type="hidden" name="cmd" value="_s-xclick"><input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
"><input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt=""><img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>',
    'LICENSE1' => 'bbGuild is free software: you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation, either version 3 of the License, or
   (at your option) any later version.

   bbGuild is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.

   You should have received a copy of the GNU General Public License
   along with bbGuild.  If not, see http://www.gnu.org/licenses',
    'LICENSE2' => 'Powered by bbDKP (c) 2009 The bbDKP Project Team. If you use this software and find it to be useful, we ask that you retain the copyright notice below. While not required for free use, it will help build interest in the bbDKP project and is <strong>required for obtaining support</strong>.',
    'COPYRIGHT3' => 'bbDKP (c) 2010 Sajaki, Malfate, Blazeflack <br />
bbDKP (c) 2008, 2009 Sajaki, Malfate, Kapli, Hroar',
    'COPYRIGHT2' => 'bbDKP (c) 2007 Ippeh, Teksonic, Monkeytech, DWKN',
    'COPYRIGHT1' => 'EQDkp (c) 2003 The EqDkp Project Team ',

    'PRODNAME' => 'Product',
    'VERSION' => 'Version',
    'DEVELOPER' => 'Developer',
    'JOB' => 'Job',
    'DEVLINK' => 'Link',
    'PROD' => 'bbGuild',
    'DEVELOPERS' => '<a href=mailto:sajaki9@gmail.com>Sajaki</a>',
    'PHPBB' => 'phpBB',
    'PHPBBGR' => 'phpBB Group',
    'PHPBBLINK' => 'http://www.phpbb.com',
    'EQDKP' => 'Original EQDKP',
    'EQDKPVERS' => '1.3.2',
    'EQDKPDEV' => 'Tsigo',
    'EQDKPLINK' => 'http://www.eqdkp.com/',

    'PLUGINS' => 'Plugins',
    'PLUGINVERS' => 'Version',
    'AUTHOR' => 'Author',
    'MAINT' => 'Maintainer',
    'DONATION' => 'Donation',
    'DONA_NAME' => 'Name',
    'ADDITIONS' => 'Code Additions',
    'CONTRIB' => 'Contributions',

));