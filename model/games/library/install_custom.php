<?php
/**
 * Custom Game Installer file
 *
 * @package bbguild v2.0
 * @copyright 2016 bbDKP <https://github.com/bbDKP>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */
namespace bbdkp\bbguild\model\games\library;
use bbdkp\bbguild\model\games\library\GameInstall;

/**
 * @ignore
 */
if (! defined ( 'IN_PHPBB' ))
{
	exit ();
}

/**
 * Custom Installer Class
 * @package bbdkp\bbguild\model\games\library
 */
class install_custom extends GameInstall
{
    protected $bossbaseurl = '';
    protected $zonebaseurl = '';

	/**
	 * Installs factions
	 */
    protected function Installfactions()
	{


	}

	/**
	 * Installs game classes
	 */
    protected function InstallClasses()
	{

	}

	/**
	 * Installs races
	 */
    protected function InstallRaces()
	{

	}




}
