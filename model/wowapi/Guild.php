<?php
/**
 * Battle.net WoW API PHP SDK
 *
 * @package bbguild v2.0
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 * @author	  Andreas Vandenberghe <sajaki9@gmail.com>
 * @author	  Chris Saylor
 * @author	  Daniel Cannon <daniel@danielcannon.co.uk>
 * @copyright Copyright (c) 2011, 2015 Chris Saylor, Daniel Cannon, Andreas Vandenberghe
 * @link 	  https://dev.battle.net/
 * @link	  https://github.com/bbDKP
 *
 * The guild profile API is the primary way to access guild information. This guild profile API can be used to fetch a single guild
 * at a time through an HTTP GET request to a url describing the guild profile resource. By default, a basic dataset will be
 * returned and with each request and zero or more additional fields can be retrieved. To access this API,
 * craft a resource URL pointing to the guild whos information is to be retrieved.
 *	URL = Host + "/api/wow/guild/" + Realm + "/" + GuildName
 *	Realm = <proper realm name> | <normalized realm name>
 *	There are no required query string parameters when accessing this resource, although the "fields" query string parameter
 *	can optionally be passed to indicate that one or more of the optional datasets is to be retrieved. Those additional
 *	fields are listed in the subsection titled "Optional Fields".
 *
 */

namespace bbdkp\bbguild\model\wowapi;
use bbdkp\bbguild\model\wowapi\Resource;

/**
 * Guild resource.
 * @package bbdkp\bbguild\model\wowapi
 */
class Guild extends Resource
{
   
	/**
	 * accepted methods : none in this resource (asterisk) 
	 *
	 * @var array
	 */
	protected $methods_allowed = array('*');

	/**
	 * standard fields are name, level, faction and achievement points.
	 * 
	 * available extra fields from guild: 
	 * members: a list of characters that are a member of the guild 
	 * achievements : a set of data structures that describe the achievements earned by the guild.
	 * news : a set of data structures that describe the news feed of the guild. (currently not used)
	 * 
	 *
	 * @var array
	 */
	private $extrafields = array(
	    'members',
	    'achievements',
		'news'
	  );
	  
	/**
	  * return the private fields
	  *
	  * @return array
	  */
	 public function getFields()
	 {
	 	return $this->extrafields;
	 }

    /**
     * fetch guild results
     *
     * @param string $name
     * @param string $realm
     * @param array $fields
     * @return mixed
     */
	public function getGuild($name = '', $realm = '', $fields=array()) 
	{
		global $user;
	
		if(empty($name))
		{
			trigger_error($user->lang['WOWAPI_NO_GUILD']);
		}
		
		if (empty($realm))
		{
			trigger_error($user->lang['WOWAPI_NO_REALMS']);
		}

        $realm = str_replace(' ', '%20', $realm);
        $name = str_replace(' ', '%20', $name);

		if (is_array($fields) && count($fields) > 0)
		{
			$field_str = 'fields=' . implode(',', $fields);
			//check if correct keys were requested
			$keys = $this->getFields();
			if (count( array_intersect($fields, $keys)) == 0 )
			{
				trigger_error(sprintf($user->lang['WOWAPI_INVALID_FIELD'], $field_str));
			}
			
			$data = $this->consume( $realm. '/'. $name, array(
				'data' => $field_str
			));
		}
		else
		{
			$data = $this->consume( $realm. '/'. $name);
		}

			
		return $data;
	}
}
