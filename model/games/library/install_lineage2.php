<?php
/**
 * bbguild Lineage2 install file
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
 * Lineage 2 Installer class
 * @package bbdkp\bbguild\model\games\library
 */
class install_lineage2 extends GameInstall
{
    protected $bossbaseurl = 'http://www.lineage2-online.com/database/en/monsters/%s.php';
    protected $zonebaseurl = 'http://www.lineage2-online.com/database/en/quests/%s.php';

    /**
	 * Installs factions
	 */
    protected function Installfactions()
	{
		global $db;
		
		// factions
		$db->sql_query('DELETE FROM ' . FACTION_TABLE . " where game_id = '".$this->game_id."'" );
		$sql_ary = array();
		$sql_ary[] = array('game_id' => $this->game_id,'faction_id' => 1, 'faction_name' => 'Default' );
		$db->sql_multi_insert( FACTION_TABLE, $sql_ary);
		unset ($sql_ary);
		
	}
	
	/**
	 * Installs game classes
	*/
    protected function InstallClasses()
	{
		global $db;
		
		$db->sql_query('DELETE FROM ' . CLASS_TABLE . " where game_id = '".$this->game_id."'" );
		$sql_ary = array();
		
		// class general
		// Unknown
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 0, 'class_armor_type' => 'HEAVY' , 'class_min_level' => 1 , 'class_max_level'  => 20,  'colorcode' =>  '#BBBBBB', 'imagename' => 'lineage2_Unknown' );
		
		// Human Fighter - 1-20
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 1, 'class_armor_type' => 'HEAVY' , 'class_min_level' => 1 , 'class_max_level'  => 20,  'colorcode' =>  '#FF0044', 'imagename' => 'lineage2_hfighter' );
		// Human Warrior - 20-40
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 2, 'class_armor_type' => 'HEAVY' , 'class_min_level' => 20 , 'class_max_level'  => 40,  'colorcode' =>  '#FF0044',  'imagename' => 'lineage2_hwarrior' );
		// Human Knight - 20-40
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 3, 'class_armor_type' => 'HEAVY' , 'class_min_level' => 20 , 'class_max_level'  => 40,  'colorcode' =>  '#CC9933',  'imagename' => 'lineage2_hknight' );
		// Human Rogue - 20-40
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 4, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 20 , 'class_max_level'  => 40,  'colorcode' =>  '#FF0044',  'imagename' => 'lineage2_hrogue' );
		
		// Human Mystic - 1-20
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 5, 'class_armor_type' => 'ROBE' , 'class_min_level' => 1 , 'class_max_level'  => 20, 'colorcode' =>  '#32CD32',  'imagename' => 'lineage2_hmystic' );
		// Human Wizard - 20-40
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 6, 'class_armor_type' => 'ROBE' , 'class_min_level' => 20 , 'class_max_level'  => 40, 'colorcode' =>  '#CC00BB', 'imagename' => 'lineage2_hwizard' );
		// Human Cleric - 20-40
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 7, 'class_armor_type' => 'ROBE' , 'class_min_level' => 20 , 'class_max_level'  => 40, 'colorcode' =>  '#CC00BB', 'imagename' => 'lineage2_hcleric' );
		
		// Human Warlord
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 8, 'class_armor_type' => 'HEAVY' , 'class_min_level' => 40 , 'class_max_level'  => 76,  'colorcode' =>  '#CC00BB',  'imagename' => 'lineage2_warlord' );
		// Human Gladiator
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 9, 'class_armor_type' => 'HEAVY' , 'class_min_level' => 40 , 'class_max_level'  => 76,  'colorcode' =>  '#FF0044',  'imagename' => 'lineage2_gladiator' );
		// Human Paladin
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 10, 'class_armor_type' => 'HEAVY' , 'class_min_level' => 40 , 'class_max_level'  => 76, 'colorcode' =>  '#CC9933', 'imagename' => 'lineage2_paladin' );
		// Human Dark Avenger
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 11, 'class_armor_type' => 'HEAVY' , 'class_min_level' => 40 , 'class_max_level'  => 76, 'colorcode' =>  '#CC00BB', 'imagename' => 'lineage2_darkavenger' );
		// Human Treasure Hunter
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 12, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 40 , 'class_max_level'  => 76, 'colorcode' =>  '#FF0044', 'imagename' => 'lineage2_treasurehunter' );
		// Human Hawkeye
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 13, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 40 , 'class_max_level'  => 76, 'colorcode' =>  '#FF0044', 'imagename' => 'lineage2_hawkeye' );
		
		// Human Sorcerer
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 14, 'class_armor_type' => 'ROBE' , 'class_min_level' => 40 , 'class_max_level'  => 76, 'colorcode' =>  '#CC00BB', 'imagename' => 'lineage2_sorc' );
		// Human Necormancer
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 15, 'class_armor_type' => 'ROBE' , 'class_min_level' => 40 , 'class_max_level'  => 76, 'colorcode' =>  '#CC00BB', 'imagename' => 'lineage2_necro' );
		// Human Warlock
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 16, 'class_armor_type' => 'ROBE' , 'class_min_level' => 40 , 'class_max_level'  => 76, 'colorcode' =>  '#CC00BB', 'imagename' => 'lineage2_warlock' );
		// Human Bishop
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 17, 'class_armor_type' => 'ROBE' , 'class_min_level' => 40 , 'class_max_level'  => 76, 'colorcode' =>  '#32CD32', 'imagename' => 'lineage2_bishop' );
		// Human Prophet
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 18, 'class_armor_type' => 'ROBE' , 'class_min_level' => 40 , 'class_max_level'  => 76, 'colorcode' =>  '#32CD32',  'imagename' => 'lineage2_prophet' );
		
		// Human Dreadnought
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 19, 'class_armor_type' => 'HEAVY' , 'class_min_level' => 76 , 'class_max_level'  => 85,  'colorcode' =>  '#FF0044',  'imagename' => 'lineage2_dreadnought' );
		// Human Duelist
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 20, 'class_armor_type' => 'HEAVY' , 'class_min_level' => 76 , 'class_max_level'  => 85,  'colorcode' =>  '#FF0044',  'imagename' => 'lineage2_duelist' );
		// Human Phoenix Knight
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 21, 'class_armor_type' => 'HEAVY' , 'class_min_level' => 76 , 'class_max_level'  => 85, 'colorcode' =>  '#CC9933', 'imagename' => 'lineage2_phoenixknight' );
		// Human Hell Knight
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 22, 'class_armor_type' => 'HEAVY' , 'class_min_level' => 76 , 'class_max_level'  => 85, 'colorcode' =>  '#CC9933', 'imagename' => 'lineage2_hellknight' );
		// Human Adventurer
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 23, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 76 , 'class_max_level'  => 85,  'colorcode' =>  '#FF0044',  'imagename' => 'lineage2_adventurer' );
		// Human Sagittarius
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 24, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 76 , 'class_max_level'  => 85, 'colorcode' =>  '#CC00BB', 'imagename' => 'lineage2_sagittarius' );
		
		// Human Archmage
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 25, 'class_armor_type' => 'ROBE' , 'class_min_level' => 76 , 'class_max_level'  => 85, 'colorcode' =>  '#CC00BB', 'imagename' => 'lineage2_archmage' );
		// Human Soultaker
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 26, 'class_armor_type' => 'ROBE' , 'class_min_level' => 76 , 'class_max_level'  => 85, 'colorcode' =>  '#CC00BB', 'imagename' => 'lineage2_soultaker' );
		// Human Arcana Lord
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 27, 'class_armor_type' => 'ROBE' , 'class_min_level' => 76 , 'class_max_level'  => 85, 'colorcode' =>  '#CC00BB', 'imagename' => 'lineage2_arcanalord' );
		// Human Cardinal
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 28, 'class_armor_type' => 'ROBE' , 'class_min_level' => 76 , 'class_max_level'  => 85, 'colorcode' =>  '#32CD32',  'imagename' => 'lineage2_cardinal' );
		// Human Hierophant
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 29, 'class_armor_type' => 'ROBE' , 'class_min_level' => 76 , 'class_max_level'  => 85, 'colorcode' =>  '#CC00BB', 'imagename' => 'lineage2_hierophant' );
		
		// ================ ELVES ================ //
		// Elven Fighter - 1-20
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 30, 'class_armor_type' => 'HEAVY' , 'class_min_level' => 1 , 'class_max_level'  => 20, 'colorcode' =>  '#FF0044', 'imagename' => 'lineage2_efighter' );
		// Elven Mystic - 1-20
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 31, 'class_armor_type' => 'ROBE' , 'class_min_level' => 1 , 'class_max_level'  => 20, 'colorcode' =>  '#32CD32',  'imagename' => 'lineage2_emystic' );
		
		// Elven Knight - 20-40
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 32, 'class_armor_type' => 'HEAVY' , 'class_min_level' => 20 , 'class_max_level'  => 40, 'colorcode' =>  '#CC9933', 'imagename' => 'lineage2_eknight' );
		// Elven Scout - 20-40
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 33, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 20 , 'class_max_level'  => 40,  'colorcode' =>  '#FF0044',  'imagename' => 'lineage2_escout' );
		
		// Elven Wizard - 20-40
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 34, 'class_armor_type' => 'ROBE' , 'class_min_level' => 20 , 'class_max_level'  => 40, 'colorcode' =>  '#CC00BB', 'imagename' => 'lineage2_ewizard' );
		// Elven Oracle - 20-40
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 35, 'class_armor_type' => 'ROBE' , 'class_min_level' => 20 , 'class_max_level'  => 40, 'colorcode' =>  '#32CD32',  'imagename' => 'lineage2_eoracle' );
		
		// Temple Knight
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 36, 'class_armor_type' => 'HEAVY' , 'class_min_level' => 40 , 'class_max_level'  => 76, 'colorcode' =>  '#CC9933', 'imagename' => 'lineage2_templeknight' );
		// Sword Singer
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 37, 'class_armor_type' => 'HEAVY' , 'class_min_level' => 40 , 'class_max_level'  => 76,  'colorcode' =>  '#FF0044',  'imagename' => 'lineage2_swordsinger' );
		// Plainswalker
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 38, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 40 , 'class_max_level'  => 76,  'colorcode' =>  '#FF0044',  'imagename' => 'lineage2_plainswalker' );
		// Silver Ranger
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 39, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 40 , 'class_max_level'  => 76, 'colorcode' =>  '#FF0044',  'imagename' => 'lineage2_silverranger' );
		
		// Spell Singer
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 40, 'class_armor_type' => 'ROBE' , 'class_min_level' => 40 , 'class_max_level'  => 76, 'colorcode' =>  '#CC00BB', 'imagename' => 'lineage2_spellsinger' );
		// Elemental Summoner
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 41, 'class_armor_type' => 'ROBE' , 'class_min_level' => 40 , 'class_max_level'  => 76, 'colorcode' =>  '#CC00BB',  'imagename' => 'lineage2_elementalsummoner' );
		// Elven Elder
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 42, 'class_armor_type' => 'ROBE' , 'class_min_level' => 40 , 'class_max_level'  => 76, 'colorcode' =>  '#32CD32', 'imagename' => 'lineage2_elvenelder' );
		
		// Evas Templar
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 43, 'class_armor_type' => 'HEAVY' , 'class_min_level' => 76 , 'class_max_level'  => 85, 'colorcode' =>  '#CC9933', 'imagename' => 'lineage2_evastemplar' );
		// Sword Muse
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 44, 'class_armor_type' => 'HEAVY' , 'class_min_level' => 76 , 'class_max_level'  => 85,  'colorcode' =>  '#FF0044',  'imagename' => 'lineage2_swordmuse' );
		// Wind Rider
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 45, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 76 , 'class_max_level'  => 85, 'colorcode' =>  '#CC00BB', 'imagename' => 'lineage2_windrider' );
		// Moonlight Sentinel
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 46, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 76 , 'class_max_level'  => 85,  'colorcode' =>  '#FF0044', 'imagename' => 'lineage2_moonlightsentinel' );
		
		// Mystic Muse
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 47, 'class_armor_type' => 'ROBE' , 'class_min_level' => 76 , 'class_max_level'  => 85, 'colorcode' =>  '#CC00BB', 'imagename' => 'lineage2_mysticmuse' );
		// Elemental Master
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 48, 'class_armor_type' => 'ROBE' , 'class_min_level' => 76 , 'class_max_level'  => 85, 'colorcode' =>  '#CC00BB', 'imagename' => 'lineage2_elementalmaster' );
		// Eva's Saint
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 49, 'class_armor_type' => 'ROBE' , 'class_min_level' => 76 , 'class_max_level'  => 85, 'colorcode' =>  '#32CD32', 'imagename' => 'lineage2_evassaint' );
		
		// ================ DARK ELVES ================ //
		
		// Dark Fighter - 1-20
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 50, 'class_armor_type' => 'HEAVY' , 'class_min_level' => 1 , 'class_max_level'  => 20,  'colorcode' =>  '#FF0044', 'imagename' => 'lineage2_defighter' );
		// Dark Mystic - 1-20
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 51, 'class_armor_type' => 'ROBE' , 'class_min_level' => 1 , 'class_max_level'  => 20,  'colorcode' =>  '#CC00BB', 'imagename' => 'lineage2_demystic' );
		
		// Palus Knight - 20-40
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 52, 'class_armor_type' => 'HEAVY' , 'class_min_level' => 20 , 'class_max_level'  => 40, 'colorcode' =>  '#CC9933', 'imagename' => 'lineage2_palusknight' );
		// Assassin - 20-40
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 53, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 20 , 'class_max_level'  => 40,  'colorcode' =>  '#FF0044', 'imagename' => 'lineage2_assassin' );
		
		// Dark Wizard - 20-40
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 54, 'class_armor_type' => 'ROBE' , 'class_min_level' => 20 , 'class_max_level'  => 40, 'colorcode' =>  '#CC00BB', 'imagename' => 'lineage2_dewizard' );
		// Shillien Oracle - 20-40
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 55, 'class_armor_type' => 'ROBE' , 'class_min_level' => 20 , 'class_max_level'  => 40, 'colorcode' =>  '#32CD32', 'imagename' => 'lineage2_soracle' );
		
		// Shillien Knight
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 56, 'class_armor_type' => 'HEAVY' , 'class_min_level' => 40 , 'class_max_level'  => 76, 'colorcode' =>  '#CC9933','imagename' => 'lineage2_shillienknight' );
		// Blade Dancer
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 57, 'class_armor_type' => 'HEAVY' , 'class_min_level' => 40 , 'class_max_level'  => 76,  'colorcode' =>  '#FF0044',  'imagename' => 'lineage2_bladedancer' );
		// Abyss Walker
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 58, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 40 , 'class_max_level'  => 76,  'colorcode' =>  '#FF0044',  'imagename' => 'lineage2_abyssswalker' );
		// Phantom Ranger
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 59, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 40 , 'class_max_level'  => 76, 'colorcode' =>  '#CC00BB', 'imagename' => 'lineage2_phantomranger' );
		
		// Spell Howler
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 60, 'class_armor_type' => 'ROBE' , 'class_min_level' => 40 , 'class_max_level'  => 76, 'colorcode' =>  '#CC00BB', 'imagename' => 'lineage2_spellhowler' );
		// Phantom Summoner
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 61, 'class_armor_type' => 'ROBE' , 'class_min_level' => 40 , 'class_max_level'  => 76, 'colorcode' =>  '#CC00BB', 'imagename' => 'lineage2_phantomsummoner' );
		// Shillien Elder
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 62, 'class_armor_type' => 'ROBE' , 'class_min_level' => 40 , 'class_max_level'  => 76, 'colorcode' =>  '#32CD32',  'imagename' => 'lineage2_shillienelder' );
		
		// Shillien Templar
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 63, 'class_armor_type' => 'HEAVY' , 'class_min_level' => 76 , 'class_max_level'  => 85, 'colorcode' =>  '#CC9933','imagename' => 'lineage2_shillientemplar' );
		// Spectral Dancer
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 64, 'class_armor_type' => 'HEAVY' , 'class_min_level' => 76 , 'class_max_level'  => 85,  'colorcode' =>  '#FF0044',  'imagename' => 'lineage2_spectraldancer' );
		// Ghost Hunter
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 65, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 76 , 'class_max_level'  => 85, 'colorcode' =>  '#CC00BB', 'imagename' => 'lineage2_ghosthunter' );
		// Ghost Sentinel
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 66, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 76 , 'class_max_level'  => 85,  'colorcode' =>  '#FF0044',  'imagename' => 'lineage2_ghosttsentinel' );
		
		// Storm Screamer
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 67, 'class_armor_type' => 'ROBE' , 'class_min_level' => 76 , 'class_max_level'  => 85, 'colorcode' =>  '#CC00BB', 'imagename' => 'lineage2_stormscreamer' );
		// Spectral Master
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 68, 'class_armor_type' => 'ROBE' , 'class_min_level' => 76 , 'class_max_level'  => 85, 'colorcode' =>  '#32CD32',  'imagename' => 'lineage2_spectralmaster' );
		// Shillien Saint
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 69, 'class_armor_type' => 'ROBE' , 'class_min_level' => 76 , 'class_max_level'  => 85, 'colorcode' =>  '#32CD32',  'imagename' => 'lineage2_shilliensaint' );
		
		// ================ ORCS ================ //
		
		// Orc Fighter - 1-20
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 70, 'class_armor_type' => 'HEAVY' , 'class_min_level' => 1 , 'class_max_level'  => 20,  'colorcode' =>  '#FF0044', 'imagename' => 'lineage2_ofighter' );
		// Orc Mystic - 1-20
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 71, 'class_armor_type' => 'HEAVY' , 'class_min_level' => 1 , 'class_max_level'  => 20, 'colorcode' =>  '#CC00BB','imagename' => 'lineage2_omystic' );
		
		// Orc Raider - 20-40
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 72, 'class_armor_type' => 'HEAVY' , 'class_min_level' => 20 , 'class_max_level'  => 40,  'colorcode' =>  '#FF0044',  'imagename' => 'lineage2_oraider' );
		// Orc Monk - 20-40
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 73, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 20 , 'class_max_level'  => 40,  'colorcode' =>  '#FF0044',  'imagename' => 'lineage2_omonk' );
		
		// Orc Shaman - 20-40
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 74, 'class_armor_type' => 'ROBE' , 'class_min_level' => 20 , 'class_max_level'  => 40, 'colorcode' =>  '#32CD32',  'imagename' => 'lineage2_oshaman' );
		
		
		// Destroyer
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 75, 'class_armor_type' => 'HEAVY' , 'class_min_level' => 40 , 'class_max_level'  => 76,  'colorcode' =>  '#FF0044',  'imagename' => 'lineage2_destroyer' );
		// Tyrant
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 76, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 40 , 'class_max_level'  => 76, 'colorcode' =>  '#FF0044',  'imagename' => 'lineage2_tyrant' );
		
		// Overlord
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 77, 'class_armor_type' => 'ROBE' , 'class_min_level' => 40 , 'class_max_level'  => 76, 'colorcode' =>  '#CC9933', 'imagename' => 'lineage2_overlord' );
		// Warcryer
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 78, 'class_armor_type' => 'ROBE' , 'class_min_level' => 40 , 'class_max_level'  => 76,  'colorcode' =>  '#FF0044',  'imagename' => 'lineage2_warcyer' );
		
		
		// Titan
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 79, 'class_armor_type' => 'HEAVY' , 'class_min_level' => 76 , 'class_max_level'  => 85, 'colorcode' =>  '#CC9933','imagename' => 'lineage2_titan' );
		// Grand Khavatari
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 80, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 76 , 'class_max_level'  => 85, 'colorcode' =>  '#CC00BB','imagename' => 'lineage2_grandkhavatari' );
		
		// Dominator
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 81, 'class_armor_type' => 'ROBE' , 'class_min_level' => 76 , 'class_max_level'  => 85, 'colorcode' =>  '#CC00BB', 'imagename' => 'lineage2_dominator' );
		// Doomcryer
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 82, 'class_armor_type' => 'ROBE' , 'class_min_level' => 76 , 'class_max_level'  => 85,  'colorcode' =>  '#FF0044',  'imagename' => 'lineage2_doomcryer' );
		
		
		// ================ DWARVES ================ //
		
		// Dwarf Fighter - 1-20
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 83, 'class_armor_type' => 'HEAVY' , 'class_min_level' => 1 , 'class_max_level'  => 20,  'colorcode' =>  '#FF0044', 'imagename' => 'lineage2_dfighter' );
		
		// Scavenger - 20-40
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 84, 'class_armor_type' => 'HEAVY' , 'class_min_level' => 20 , 'class_max_level'  => 40,  'colorcode' =>  '#FF0044', 'imagename' => 'lineage2_scavenger' );
		// Artisan - 20-40
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 85, 'class_armor_type' => 'HEAVY' , 'class_min_level' => 20 , 'class_max_level'  => 40, 'colorcode' =>  '#32CD32', 'imagename' => 'lineage2_artisan' );
		
		// Bounty Hunter - 40-76
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 86, 'class_armor_type' => 'HEAVY' , 'class_min_level' => 40 , 'class_max_level'  => 76,  'colorcode' =>  '#FF0044', 'imagename' => 'lineage2_bountyhunter' );
		// Warsmith - 40-76
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 87, 'class_armor_type' => 'HEAVY' , 'class_min_level' => 40 , 'class_max_level'  => 76, 'colorcode' =>  '#CC9933','imagename' => 'lineage2_warsmith' );
		
		// Fortune Seeker - 76-85
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 88, 'class_armor_type' => 'HEAVY' , 'class_min_level' => 76 , 'class_max_level'  => 85, 'colorcode' =>  '#32CD32', 'imagename' => 'lineage2_fortuneseeker' );
		// Maestro - 76-85
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 89, 'class_armor_type' => 'HEAVY' , 'class_min_level' => 76 , 'class_max_level'  => 85, 'colorcode' =>  '#32CD32',  'imagename' => 'lineage2_maestro' );
		
		
		// ================ KAMAELS ================ //
		// Kamael Male Soldier - 1-20
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 90, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 1 , 'class_max_level'  => 20,  'colorcode' =>  '#FF0044', 'imagename' => 'lineage2_kmsoldier' );
		// Kamael Female Soldier - 1-20
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 91, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 1 , 'class_max_level'  => 20,  'colorcode' =>  '#FF0044', 'imagename' => 'lineage2_kfsoldier' );
		
		// Trooper - 20-40
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 92, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 20 , 'class_max_level'  => 40, 'colorcode' =>  '#CC9933', 'imagename' => 'lineage2_trooper' );
		// Warder - 20-40
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 93, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 20 , 'class_max_level'  => 40, 'colorcode' =>  '#CC9933','imagename' => 'lineage2_warder' );
		
		// Berserker - 40-76
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 94, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 40 , 'class_max_level'  => 76,  'colorcode' =>  '#FF0044', 'imagename' => 'lineage2_berserker' );
		// Soul Breaker - 40-76
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 95, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 40 , 'class_max_level'  => 76, 'colorcode' =>  '#CC00BB', 'imagename' => 'lineage2_soulbreaker' );
		// Arbalester - 40-76
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 96, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 40 , 'class_max_level'  => 76, 'colorcode' =>  '#32CD32', 'imagename' => 'lineage2_arbalester' );
		
		
		// Doombringer - 76-85
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 97, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 76 , 'class_max_level'  => 85,  'colorcode' =>  '#FF0044', 'imagename' => 'lineage2_doombringer' );
		// Soul Hound - 76-85
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 98, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 76 , 'class_max_level'  => 85,  'colorcode' =>  '#FF0044', 'imagename' => 'lineage2_soulhound' );
		// Trickster - 76-85
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 99, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 76 , 'class_max_level'  => 85,  'colorcode' =>  '#FF0044', 'imagename' => 'lineage2_trickster' );
		
		// Inspector - 40-76
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 100, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 40 , 'class_max_level'  => 76, 'colorcode' =>  '#CC00BB','imagename' => 'lineage2_inspector' );
		// Judicator - 76-85
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 101, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 76 , 'class_max_level'  => 85, 'colorcode' =>  '#CC00BB','imagename' => 'lineage2_judicator' );
		
		
		// ================ NEW CLASSES ================ //
		// Yr Archer - 85-99
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 102, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 85 , 'class_max_level'  => 99,  'colorcode' =>  '#CC00BB', 'imagename' => 'lineage2_yrarcher' );
		// Tyr Warrior - 85-99
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 103, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 85 , 'class_max_level'  => 99, 'colorcode' =>  '#CC9933', 'imagename' => 'lineage2_tyrwarrior' );
		// Feoh Wizard - 85-99
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 104, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 85 , 'class_max_level'  => 99, 'colorcode' =>  '#CC00BB','imagename' => 'lineage2_feohwizard' );
		// Othell Rogue - 85-99
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 105, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 85 , 'class_max_level'  => 99,  'colorcode' =>  '#FF0044', 'imagename' => 'lineage2_othellrogue' );
		// Iss Enchanter - 85-99
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 106, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 85 , 'class_max_level'  => 99, 'colorcode' =>  '#CC00BB','imagename' => 'lineage2_issenchanter' );
		// Sigel Knight - 85-99
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 107, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 85 , 'class_max_level'  => 99, 'colorcode' =>  '#CC9933', 'imagename' => 'lineage2_sigelknight' );
		// Eolh Healer - 85-99
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 108, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 85 , 'class_max_level'  => 99, 'colorcode' =>  '#32CD32', 'imagename' => 'lineage2_eolhhealer' );
		// Wynn Summoner - 85-99
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 109, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 85 , 'class_max_level'  => 99, 'colorcode' =>  '#CC00BB', 'imagename' => 'lineage2_wynnsummoner' );
		
		$db->sql_multi_insert( CLASS_TABLE, $sql_ary);
		unset ($sql_ary);
		
		$db->sql_query('DELETE FROM ' . BB_LANGUAGE . "  where game_id = '".$this->game_id."' and attribute='class' ");
		$sql_ary = array();
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 0, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Unknown' ,  'name_short' =>  'Unknown' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 1, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Human Fighter' ,  'name_short' =>  'Human Fighter' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 2, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Human Warrior' ,  'name_short' =>  'Human Warrior' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 3, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Human Knight' ,  'name_short' =>  'Human Knight' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 4, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Human Rogue' ,  'name_short' =>  'Human Rogue' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 5, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Human Mystic' ,  'name_short' =>  'Human Mystic' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 6, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Human Wizard' ,  'name_short' =>  'Human Wizard' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 7, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Human Cleric' ,  'name_short' =>  'Human Cleric' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 8, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Warlord' ,  'name_short' =>  'Warlord' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 9, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Gladiator' ,  'name_short' =>  'Gladiator' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 10, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Paladin' ,  'name_short' =>  'Paladin' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 11, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Dark Avenger' ,  'name_short' =>  'Dark Avenger' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 12, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Treasure Hunter' ,  'name_short' =>  'Treasure Hunter' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 13, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Hawkeye' ,  'name_short' =>  'Hawkeye' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 14, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Sorcerer' ,  'name_short' =>  'Sorcerer' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 15, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Necromancer' ,  'name_short' =>  'Necromancer' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 16, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Warlock' ,  'name_short' =>  'Warlock' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 17, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Bishop' ,  'name_short' =>  'Bishop' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 18, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Prophet' ,  'name_short' =>  'Prophet' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 19, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Dreadnought' ,  'name_short' =>  'Dreadnought' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 20, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Duelist' ,  'name_short' =>  'Duelist' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 21, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Phoenix Knight' ,  'name_short' =>  'Phoenix Knight' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 22, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Hell Knight' ,  'name_short' =>  'Hell Knight' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 23, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Adventurer' ,  'name_short' =>  'Adventurer' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 24, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Sagittarius' ,  'name_short' =>  'Sagittarius' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 25, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Archmage' ,  'name_short' =>  'Archmage' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 26, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Soultaker' ,  'name_short' =>  'Soultaker' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 27, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Arcana Lord' ,  'name_short' =>  'Arcana Lord' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 28, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Cardinal' ,  'name_short' =>  'Cardinal' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 29, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Hierophant' ,  'name_short' =>  'Hierophant' );
		
		// ================ ELVES ================ //
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 30, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Elven Fighter' ,  'name_short' =>  'Elven Fighter' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 31, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Elven Mystic' ,  'name_short' =>  'Elven Mystic' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 32, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Elven Knight' ,  'name_short' =>  'Elven Knight' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 33, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Elven Scout' ,  'name_short' =>  'Elven Scout' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 34, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Elven Wizard' ,  'name_short' =>  'Elven Wizard' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 35, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Elven Oracle' ,  'name_short' =>  'Elven Oracle' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 36, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Temple Knight' ,  'name_short' =>  'Temple Knight' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 37, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'SwordSinger' ,  'name_short' =>  'SwordSinger' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 38, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Plainswalker' ,  'name_short' =>  'Plainswalker' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 39, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Silver Ranger' ,  'name_short' =>  'Silver Ranger' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 40, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'SpellSinger' ,  'name_short' =>  'SpellSinger' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 41, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Elemental Summoner' ,  'name_short' =>  'Elemental Summoner' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 42, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Elven Elder' ,  'name_short' =>  'Elven Elder' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 43, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Eva\'s Templar' ,  'name_short' =>  'Eva Templar' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 44, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Sword Muse' ,  'name_short' =>  'Sword Muse' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 45, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Wind Rider' ,  'name_short' =>  'Wind Rider' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 46, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Moonglight Sentinel' ,  'name_short' =>  'Moonglight Sentinel' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 47, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Mystic Muse' ,  'name_short' =>  'Mystic Muse' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 48, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Elemental Master' ,  'name_short' =>  'Elemental Master' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 49, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Eva\'s Saint' ,  'name_short' =>  'Eva Saint' );
		
		// ================ DARK ELVES ================ //
		
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 50, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Dark Fighter' ,  'name_short' =>  'Dark Fighter' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 51, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Dark Mystic' ,  'name_short' =>  'Dark Mystic' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 52, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Palus Knight' ,  'name_short' =>  'Palus Knight' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 53, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Assassin' ,  'name_short' =>  'Assassin' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 54, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Dark Wizard' ,  'name_short' =>  'Dark Wizard' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 55, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Shillien Oracle' ,  'name_short' =>  'Shillien Oracle' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 56, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Shillien Knight' ,  'name_short' =>  'Shillien Knight' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 57, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Blade Dancer' ,  'name_short' =>  'Blade Dancer' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 58, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Abyss Walker' ,  'name_short' =>  'Abyss Walker' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 59, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Phantom Ranger' ,  'name_short' =>  'Phantom Ranger' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 60, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Spell Howler' ,  'name_short' =>  'Spell Howler' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 61, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Phantom Summoner' ,  'name_short' =>  'Phantom Summoner' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 62, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Shillien Elder' ,  'name_short' =>  'Shillien Elder' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 63, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Shillien Templar' ,  'name_short' =>  'Shillien Templar' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 64, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Spectral Dancer' ,  'name_short' =>  'Spectral Dancer' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 65, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Ghost Rider' ,  'name_short' =>  'Ghost Rider' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 66, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Ghost Sentinel' ,  'name_short' =>  'Ghost Sentinel' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 67, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Storm Screamer' ,  'name_short' =>  'Storm Screamer' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 68, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Spectral Master' ,  'name_short' =>  'Spectral Master' );
		// Shillien Saint
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 69, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Shillien Saint' ,  'name_short' =>  'Shillien Saint' );
		
		// ================ ORCS ================ //
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 70, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Orc Fighter' ,  'name_short' =>  'Orc Fighter' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 71, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Orc Mystic' ,  'name_short' =>  'Orc Mystic' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 72, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Orc Raider' ,  'name_short' =>  'Orc Raider' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 73, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Orc Monk' ,  'name_short' =>  'Orc Monk' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 74, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Orc Shaman' ,  'name_short' =>  'Orc Shaman' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 75, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Destroyer' ,  'name_short' =>  'Destroyer' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 76, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Tyrant' ,  'name_short' =>  'Tyrant' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 77, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Overlord' ,  'name_short' =>  'Overlord' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 78, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Warcryer' ,  'name_short' =>  'Warcryer' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 79, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Titan' ,  'name_short' =>  'Titan' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 80, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Grand Khavatari' ,  'name_short' =>  'Grand Khavatari' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 81, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Dominator' ,  'name_short' =>  'Dominator' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 82, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Doomcryer' ,  'name_short' =>  'Doomcryer' );
		
		// ================ DWARVES ================ //
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 83, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Dwarven Fighter' ,  'name_short' =>  'Dwarven Fighter' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 84, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Scavenger' ,  'name_short' =>  'Scavenger' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 85, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Artisan' ,  'name_short' =>  'Artisan' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 86, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Bounty Hunter' ,  'name_short' =>  'Bounty Hunter' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 87, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Warsmith' ,  'name_short' =>  'Warsmith' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 88, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Fortune Seeker' ,  'name_short' =>  'Fortune Seeker' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 89, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Maestro' ,  'name_short' =>  'Maestro' );
		
		// ================ KAMAELS ================ //
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 90, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Kamael Male Solder' ,  'name_short' =>  'Kamael Male Solder' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 91, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Kamael Female Solder' ,  'name_short' =>  'Kamael Female Solder' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 92, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Trooper' ,  'name_short' =>  'Trooper' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 93, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Warder' ,  'name_short' =>  'Warder' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 94, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Berserker' ,  'name_short' =>  'Berserker' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 95, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Soul Breaker' ,  'name_short' =>  'Soul Breaker' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 96, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Arbalester' ,  'name_short' =>  'Arbalester' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 97, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Doombringer' ,  'name_short' =>  'Doombringer' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 98, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Soul Hound' ,  'name_short' =>  'Soul Hound' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 99, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Trickster' ,  'name_short' =>  'Trickster' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 100, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Inspector' ,  'name_short' =>  'Inspector' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 101, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Judicator' ,  'name_short' =>  'Judicator' );
		
		// ================ NEW CLASSES ================ //
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 102, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Yr Archer' ,  'name_short' =>  'Yr Archer' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 103, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Tyr Warrior' ,  'name_short' =>  'Tyr Warrior' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 104, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Feoh Wizard' ,  'name_short' =>  'Feoh Wizard' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 105, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Othell Rogue' ,  'name_short' =>  'Othell Rogue' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 106, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Iss Enchanter' ,  'name_short' =>  'Iss Enchanter' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 107, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Sigel Knight' ,  'name_short' =>  'Sigel Knight' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 108, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Eolh Healer' ,  'name_short' =>  'Eolh Healer' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 109, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Wynn Summoner' ,  'name_short' =>  'Wynn Summoner' );

		$db->sql_multi_insert (  BB_LANGUAGE  , $sql_ary );
		unset ( $sql_ary );
		
	}
	
	/**
	 * Installs races
	*/
    protected function InstallRaces()
	{
		global $db;
		
		// races
		$db->sql_query('DELETE FROM ' .  RACE_TABLE . "  where game_id = '".$this->game_id."'");
		$sql_ary = array();
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 0, 'race_faction_id' => 1,  'image_female' => ' ',  'image_male' => ' '  ); //Unknown
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 1, 'race_faction_id' => 1,  'image_female' => 'lineage2_human_female',  'image_male' => 'lineage2_human_male'  ); //Human
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 2, 'race_faction_id' => 1 , 'image_female' => 'lineage2_elf_female',  'image_male' => 'lineage2_elf_male' ); //Orc
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 3, 'race_faction_id' => 1 , 'image_female' => 'lineage2_delf_female',  'image_male' => 'lineage2_delf_male' ); //Dwarf
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 4, 'race_faction_id' => 1 , 'image_female' => 'lineage2_dwarf_female',  'image_male' => 'lineage2_dwarf_male' ) ; //Night Elf
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 5, 'race_faction_id' => 1 , 'image_female' => 'lineage2_orc_female',  'image_male' => 'lineage2_orc_male' ); //Undead
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 6, 'race_faction_id' => 1 , 'image_female' => 'lineage2_kamael_female',  'image_male' => 'lineage2_kamael_male' ); //Tauren
		$db->sql_multi_insert(  RACE_TABLE , $sql_ary);
		unset ($sql_ary);
		
		$db->sql_query('DELETE FROM ' . BB_LANGUAGE . "  where game_id = '".$this->game_id."' and attribute='race' ");
		$sql_ary = array();
		
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 0, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Unknown' ,  'name_short' =>  'Unknown' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 1, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Human' ,  'name_short' =>  'Human' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 2, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Elf' , 'name_short' =>  'Elf' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 3, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Dark Elf' ,  'name_short' =>  'Dark Elf' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 4, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Dwarf' ,  'name_short' =>  'Dwarf' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 5, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Orc' , 'name_short' =>  'Orc' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 6, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Kamael' ,  'name_short' =>  'Kamael' );
		
		$db->sql_multi_insert (  BB_LANGUAGE  , $sql_ary );
		unset ( $sql_ary );
		
	}


}
	
