<?php
/**
 * bbDKP WoW Battle.net API
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
 */

namespace bbdkp\bbguild\model\wowapi;
use bbdkp\bbguild\model\wowapi\Realm;
use bbdkp\bbguild\model\wowapi\Guild;
use bbdkp\bbguild\model\wowapi\Character;

/**
 * Battle.net WoW API PHP SDK
 * 
 * @package bbguild
 */
class BattleNet
{
	/**
	 * acceptable regions for WoW
	 * @var array
	 */
	protected $region = array(
		'us', 'eu', 'kr', 'tw', 'sea'
	);
	
	/**
	 * Implemented API's
	 * @var array
	 */
	protected $API = array(
		'guild', 'realm', 'character'
	);


	/**
	 * Realm object instance
	 *
	 */
	public $Realm;
	
	/**
	 * Guild object instance
	 *
	 * @var Guild
	 */
	public $Guild;

	
	/**
	 * Character object instance
	 *
	 * @var Character
	 */
	public $Character;

	/**
	 * locale
	 *
	 * @var string
	 */
	public $locale;

	/**
	 * Battle.net API key
	 *
	 */
	public $apikey;

	/**
	 * WoWAPI Class constructor
	 * 
	 * @param string $API
	 * @param string $region
	 * @param string $apikey
	 * @param string $locale
     * @param string $privkey
     * @param string $ext_path
	 */
	public function __construct($API, $region, $apikey, $locale, $privkey, $ext_path)
	{
		global $user;

		// check for correct API call
		if (!in_array($API, $this->API))
		{
			trigger_error($user->lang['WOWAPI_API_NOTIMPLEMENTED']);
		}

		if (!in_array($region, $this->region))
		{
			trigger_error($user->lang['WOWAPI_REGION_NOTALLOWED']);
		}

		$this->API = $API;
		$this->region = $region;
        $this->ext_path = $ext_path;

		switch ($this->API)
		{
			case 'realm':
				$this->Realm = new Realm($region);
				$this->Realm->apikey = $apikey;
				$this->Realm->locale = $locale;
				$this->Realm->privkey = $privkey;
				break;
			case 'guild':
				$this->Guild = new Guild($region);
				$this->Guild->apikey = $apikey;
				$this->Guild->locale = $locale;
				$this->Guild->privkey = $privkey;
				break;
			case 'character':
				$this->Character = new Character($region);
				$this->Character->apikey = $apikey;
				$this->Character->locale = $locale;
				$this->Character->privkey = $privkey;
				break;

		}

	}
}
