<?php
/**
 * Battle.net WoW API PHP SDK
 * The Character Profile API is the primary way to access character information.
 * This Character Profile API can be used to fetch a single character at a time through an
 * HTTP GET request to a URL describing the character profile resource.

 * @package bbguild v2.0
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 * @author	  Andreas Vandenberghe <sajaki9@gmail.com>
 * @author	  Chris Saylor
 * @author	  Daniel Cannon <daniel@danielcannon.co.uk>
 * @copyright Copyright (c) 2011, 2015 Chris Saylor, Daniel Cannon, Andreas Vandenberghe
 * @link 	  https://dev.battle.net/
 * @link	  https://github.com/bbDKP
 *
 */

namespace bbdkp\bbguild\model\wowapi;

use bbdkp\bbguild\model\wowapi\Resource;

/**
 * @ignore
 */
if (!defined('IN_PHPBB'))
{
    exit;
}

/**
 * Character resource.
 *   @package bbguild
 */
class Character extends Resource
{

    /**
     * accepted methods : none in this resource (asterisk)
     *
     * @var array
     */
    protected $methods_allowed = array('*');

    /**
     * available extra Fields from guild
     * standard fields are name, level, faction and achievement points.
     *
    + * @var array
     */
    private $extrafields = array(
        'achievements',
        'appearance',
        'feed',
        'guild',
        'hunterPets',
        'items',
        'mounts',
        'pets',
        'petSlots',
        'professions',
        'progression',
        'pvp',
        /*'quests',*/
        'reputation',
        'stats',
        'talents',
        'titles',
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
     * fetch character results
     * example : http://eu.battle.net/api/wow/character/Lightbringer/Sajaki
     * example : http://eu.battle.net/api/wow/character/Lightbringer/Sajaki?fields=progression,professions
     *
     * @param string $name
     * @param string $realm
     * @param array $fields
     * @return mixed
     */
    public function getCharacter($name = '', $realm = '', $fields=array())
    {
        global $user;

        if(empty($name))
        {
            trigger_error($user->lang['WOWAPI_NO_CHARACTER']);
        }

        /* caution input has to be utf8 */
        /* RFC 3986 as per http://us.battle.net/wow/en/forum/topic/3050125211 */
        $name = rawurlencode($name);
        if (empty($realm))
        {
            trigger_error($user->lang['WOWAPI_NO_REALMS']);
        }

        $realm = rawurlencode($realm);

        // URL = Host + "/api/wow/character/" + Realm + "/" + Name
        $field_str = '';
        if (is_array($fields) && count($fields) > 0)
        {
            $field_str = 'fields=' . implode(',', $fields);
            //check if correct keys were requested
            $keys = $this->getFields();
            if (count( array_intersect($fields, $keys)) == 0 )
            {
                trigger_error(sprintf($user->lang['WOWAPI_INVALID_FIELD'], $field_str));
            }

            $data = $this->consume( $realm. '/'. $name , array(
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
