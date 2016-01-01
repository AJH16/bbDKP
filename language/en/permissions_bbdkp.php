<?php
/**
 * bbDKP Permission Set English
 * 
 * @package phpBB Extension - bbdkp
 * @copyright 2009 bbdkp <https://github.com/bbDKP>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 * @author sajaki <sajaki@gmail.com>
 * @link http://www.bbdkp.com
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

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// Define categories 
$lang['permission_cat']['bbdkp'] = 'bbDKP';

// Adding new permission set
$lang['permission_type']['bbdkp_'] = 'bbDKP Permissions';


// bbDKP Permissions
$lang = array_merge($lang, array(
	'acl_a_dkp'		=> array('lang' => 'Can access bbDKP ACP', 'cat' => 'bbdkp'),
	'acl_u_dkp'		=> array('lang' => 'Can see DKP pages', 'cat' => 'bbdkp'),
	'acl_u_dkpucp'	=> array('lang' => 'Can claim characters in UCP', 'cat' => 'bbdkp'),
	'acl_u_dkp_charadd'	=> array('lang' => 'Can add own characters in UCP', 'cat' => 'bbdkp'),
	'acl_u_dkp_charupdate'	=> array('lang' => 'Can update own characters in UCP', 'cat' => 'bbdkp'),
	'acl_u_dkp_chardelete'	=> array('lang' => 'Can delete own characters in UCP', 'cat' => 'bbdkp'),
));
