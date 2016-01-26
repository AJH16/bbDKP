<?php
/**
 * bbguild Rift install data
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
 * Rift Installer class
 * @package bbdkp\bbguild\model\games\library
 */
class install_rift extends GameInstall
{
    protected $bossbaseurl = 'http://rift.zam.com/en/npc.html?riftnpc=%s';
    protected $zonebaseurl = 'ttp://rift.zam.com/en/zone/%s';

    /**
	 * Installs factions
	 */
    protected function Installfactions()
	{
		global $db;
		// factions
		$db->sql_query('DELETE FROM ' . FACTION_TABLE . " where game_id = '".$this->game_id."'" );
		$sql_ary = array();
		$sql_ary[] = array('game_id' => $this->game_id,'faction_id' => 1, 'faction_name' => 'Guardians' );
		$sql_ary[] = array('game_id' => $this->game_id,'faction_id' => 2, 'faction_name' => 'Defiant' );
		$sql_ary[] = array('game_id' => $this->game_id,'faction_id' => 3, 'faction_name' => 'NPC' );
		$db->sql_multi_insert( FACTION_TABLE, $sql_ary);
		unset ($sql_ary);
	}
	
	/**
	 * Installs game classes
	 * @note : only the core classes are created
	*/
    protected function InstallClasses()
	{
		global $db;
		$db->sql_query('DELETE FROM ' . CLASS_TABLE . " where game_id = '".$this->game_id."'" );
		$sql_ary = array();
		
		// class general
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 0, 'class_armor_type' => 'PLATE' , 'class_min_level' => 1 , 'class_max_level'  => 60, 'colorcode' =>  '#999', 'imagename' => 'rift_Unknown' );
		
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 40, 'class_armor_type' => 'PLATE' , 'class_min_level' => 1 , 'class_max_level'  => 60, 'colorcode' =>  '#C41F3B','imagename' => 'rift_warrior' );
		//     $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 1, 'class_armor_type' => 'PLATE' , 'class_min_level' => 1 , 'class_max_level'  => 60, 'colorcode' =>  '#C41F3B','imagename' => 'rift_champion' );
		//     $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 2, 'class_armor_type' => 'PLATE' , 'class_min_level' => 1 , 'class_max_level'  => 60, 'colorcode' =>  '#C79C6E','imagename' => 'rift_reaver' );
		//     $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 3, 'class_armor_type' => 'PLATE' , 'class_min_level' => 1 , 'class_max_level'  => 60, 'colorcode' =>  '#C79C6E', 'imagename' => 'rift_paladin' );
		//     $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 4, 'class_armor_type' => 'PLATE' , 'class_min_level' => 1 , 'class_max_level'  => 60, 'colorcode' =>  '#C79C6E', 'imagename' => 'rift_warlord' );
		//     $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 5, 'class_armor_type' => 'PLATE' , 'class_min_level' => 1 , 'class_max_level'  => 60, 'colorcode' =>  '#C41F3B','imagename' => 'rift_paragon' );
		//     $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 6, 'class_armor_type' => 'PLATE' , 'class_min_level' => 1 , 'class_max_level'  => 60, 'colorcode' =>  '#C41F3B','imagename' => 'rift_riftblade' );
		//     $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 7, 'class_armor_type' => 'PLATE' , 'class_min_level' => 1 , 'class_max_level'  => 60, 'colorcode' =>  '#C79C6E', 'imagename' => 'rift_voidknight' );
		//     $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 8, 'class_armor_type' => 'PLATE' , 'class_min_level' => 1 , 'class_max_level'  => 60,  'colorcode' =>  '#ABD473', 'imagename' => 'rift_beastmaster' );
		
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 41, 'class_armor_type' => 'MAIL' , 'class_min_level' => 1 , 'class_max_level'  => 60,  'colorcode' =>  '#F58CBA','imagename' => 'rift_cleric' );
		//     $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 9, 'class_armor_type' => 'MAIL' , 'class_min_level' => 1 , 'class_max_level'  => 60,  'colorcode' =>  '#F58CBA','imagename' => 'rift_purifier' );
		//     $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 10, 'class_armor_type' => 'MAIL' , 'class_min_level' => 1 , 'class_max_level'  => 60,  'colorcode' =>  '#F58CBA','imagename' => 'rift_inquisitor' );
		//     $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 11, 'class_armor_type' => 'MAIL' , 'class_min_level' => 1 , 'class_max_level'  => 60,  'colorcode' =>  '#F58CBA','imagename' => 'rift_sentinel' );
		//     $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 12, 'class_armor_type' => 'MAIL' , 'class_min_level' => 1 , 'class_max_level'  => 60,  'colorcode' =>  '#F58CBA','imagename' => 'rift_justicar' );
		//     $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 13, 'class_armor_type' => 'MAIL' , 'class_min_level' => 1 , 'class_max_level'  => 60, 'colorcode' =>  '#FF7D0A', 'imagename' => 'rift_shaman' );
		//     $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 14, 'class_armor_type' => 'MAIL' , 'class_min_level' => 1 , 'class_max_level'  => 60, 'colorcode' =>  '#FF7D0A', 'imagename' => 'rift_warden' );
		//     $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 15, 'class_armor_type' => 'MAIL' , 'class_min_level' => 1 , 'class_max_level'  => 60, 'colorcode' =>  '#FF7D0A','imagename' => 'rift_druid' );
		//     $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 16, 'class_armor_type' => 'MAIL' , 'class_min_level' => 1 , 'class_max_level'  => 60, 'colorcode' =>  '#FF7D0A', 'imagename' => 'rift_cabalist' );
		
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 42, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 1 , 'class_max_level'  => 60, 'colorcode' =>  '#FFF569',  'imagename' => 'rift_rogue' );
		//     $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 17, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 1 , 'class_max_level'  => 60, 'colorcode' =>  '#FFF569',  'imagename' => 'rift_nightblade' );
		//     $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 18, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 1 , 'class_max_level'  => 60, 'colorcode' =>  '#ABD473', 'imagename' => 'rift_ranger' );
		//     $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 19, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 1 , 'class_max_level'  => 60, 'colorcode' =>  '#FFF569',  'imagename' => 'rift_bladedancer' );
		//     $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 20, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 1 , 'class_max_level'  => 60, 'colorcode' =>  '#FFF569', 'imagename' => 'rift_assassin' );
		//     $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 21, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 1 , 'class_max_level'  => 60, 'colorcode' =>  '#ABD473', 'imagename' => 'rift_riftstalker' );
		//     $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 22, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 1 , 'class_max_level'  => 60, 'colorcode' =>  '#ABD473', 'imagename' => 'rift_marksman' );
		//     $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 23, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 1 , 'class_max_level'  => 60, 'colorcode' =>  '#FFF569', 'imagename' => 'rift_saboteur' );
		//     $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 24, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 1 , 'class_max_level'  => 60, 'colorcode' =>  '#ABD473', 'imagename' => 'rift_bard' );
		
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 43, 'class_armor_type' => 'CLOTH' , 'class_min_level' => 1 , 'class_max_level'  => 60, 'colorcode' =>  '#0070DE', 'imagename' => 'rift_mage' );
		//     $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 25, 'class_armor_type' => 'CLOTH' , 'class_min_level' => 1 , 'class_max_level'  => 60, 'colorcode' =>  '#0070DE', 'imagename' => 'rift_elementalist' );
		//     $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 26, 'class_armor_type' => 'CLOTH' , 'class_min_level' => 1 , 'class_max_level'  => 60, 'colorcode' =>  '#9482C9', 'imagename' => 'rift_warlock' );
		//     $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 27, 'class_armor_type' => 'CLOTH' , 'class_min_level' => 1 , 'class_max_level'  => 60, 'colorcode' =>  '#69CCF0', 'imagename' => 'rift_pyromancer' );
		//     $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 28, 'class_armor_type' => 'CLOTH' , 'class_min_level' => 1 , 'class_max_level'  => 60, 'colorcode' =>  '#0070DE','imagename' => 'rift_stormcaller' );
		//     $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 29, 'class_armor_type' => 'CLOTH' , 'class_min_level' => 1 , 'class_max_level'  => 60, 'colorcode' =>  '#0070DE','imagename' => 'rift_archon' );
		//     $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 30, 'class_armor_type' => 'CLOTH' , 'class_min_level' => 1 , 'class_max_level'  => 60, 'colorcode' =>  '#9482C9', 'imagename' => 'rift_necromancer' );
		//     $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 31, 'class_armor_type' => 'CLOTH' , 'class_min_level' => 1 , 'class_max_level'  => 60, 'colorcode' =>  '#69CCF0', 'imagename' => 'rift_dominator' );
		//     $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 32, 'class_armor_type' => 'CLOTH' , 'class_min_level' => 1 , 'class_max_level'  => 60, 'colorcode' =>  '#9482C9', 'imagename' => 'rift_chloromancer' );
		
		$db->sql_multi_insert( CLASS_TABLE, $sql_ary);
		unset ($sql_ary);
		
		$db->sql_query('DELETE FROM ' . BB_LANGUAGE . "  where game_id = '".$this->game_id."' and attribute='class'   ");
		$sql_ary = array();
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 0, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Unknown' ,  'name_short' =>  'Unknown' );
		
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 40, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Warrior' ,  'name_short' =>  'Warrior' );
		
		// 	$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 1, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Champion' ,  'name_short' =>  'Champion' );
		// 	$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 2, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Reaver' ,  'name_short' =>  'Reaver' );
		// 	$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 3, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Paladin' ,  'name_short' =>  'Paladin' );
		// 	$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 4, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Warlord' ,  'name_short' =>  'Warlord' );
		// 	$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 5, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Paragon' ,  'name_short' =>  'Paragon' );
		// 	$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 6, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Riftblade' ,  'name_short' =>  'Riftblade' );
		// 	$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 7, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Voidknight' ,  'name_short' =>  'Voidknight' );
		// 	$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 8, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Beastmaster' ,  'name_short' =>  'Beastmaster' );
		
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 41, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Cleric' ,  'name_short' =>  'Cleric' );
		
		// 	$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 9, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Purifier' ,  'name_short' =>  'Purifier' );
		// 	$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 10, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Inquisitor' ,  'name_short' =>  'Inquisitor' );
		// 	$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 11, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Sentinel' ,  'name_short' =>  'Sentinel' );
		// 	$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 12, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Justicar' ,  'name_short' =>  'Justicar' );
		// 	$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 13, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Shaman' ,  'name_short' =>  'Shaman' );
		// 	$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 14, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Warden' ,  'name_short' =>  'Warden' );
		// 	$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 15, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Druid' ,  'name_short' =>  'Druid' );
		// 	$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 16, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Cabalist' ,  'name_short' =>  'Cabalist' );
		
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 42, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Rogue' ,  'name_short' =>  'Rogue' );
		
		// 	$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 17, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Nightblade' ,  'name_short' =>  'Nightblade' );
		// 	$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 18, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Ranger' ,  'name_short' =>  'Ranger' );
		// 	$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 19, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Bladedancer' ,  'name_short' =>  'Bladedancer' );
		// 	$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 20, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Assassin' ,  'name_short' =>  'Assassin' );
		// 	$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 21, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Riftstalker' ,  'name_short' =>  'Riftstalker' );
		// 	$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 22, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Marksman' ,  'name_short' =>  'Marksman' );
		// 	$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 23, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Saboteur' ,  'name_short' =>  'Saboteur' );
		// 	$sql_ary[] = array( 'game_id' => $this->game_id, 'attribute_id' => 24, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Bard' ,  'name_short' =>  'Bard' );
		
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 43, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Mage' ,  'name_short' =>  'Mage' );
		
		// 	$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 25, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Elementalist' ,  'name_short' =>  'Elementalist' );
		// 	$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 26, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Warlock' ,  'name_short' =>  'Warlock' );
		// 	$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 27, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Pyromancer' ,  'name_short' =>  'Pyromancer' );
		// 	$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 28, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Stormcaller' ,  'name_short' =>  'Stormcaller' );
		// 	$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 29, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Archon' ,  'name_short' =>  'Archon' );
		// 	$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 30, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Necromancer' ,  'name_short' =>  'Necromancer' );
		// 	$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 31, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Dominator' ,  'name_short' =>  'Dominator' );
		// 	$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 32, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Chloromancer' ,  'name_short' =>  'Chloromancer' );
		$db->sql_multi_insert ( BB_LANGUAGE , $sql_ary );
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
		$sql_ary = array ();
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 0, 'race_faction_id' => 1,  'image_female' => ' ',  'image_male' => ' '  ); //Unknown
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 1, 'race_faction_id' => 1,  'image_female' => 'rift_dwarf_female',  'image_male' => 'rift_dwarf_male'  ); //dwarf
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 2, 'race_faction_id' => 1 , 'image_female' => 'rift_highelf_female',  'image_male' => 'rift_highelf_male' ); //Orchigh elf
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 3, 'race_faction_id' => 1 , 'image_female' => 'rift_mathosian_female',  'image_male' => 'rift_mathosian_male' ); //mathosian
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 4, 'race_faction_id' => 2 , 'image_female' => 'rift_bahmi_female',  'image_male' => 'rift_bahmi_male' ) ; //Bahmi
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 5, 'race_faction_id' => 2 , 'image_female' => 'rift_eth_female',  'image_male' => 'rift_eth_male' ); //eth
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 6, 'race_faction_id' => 2 , 'image_female' => 'rift_kelari_female',  'image_male' => 'rift_kelari_male' ); //kelari
		$db->sql_multi_insert (  RACE_TABLE , $sql_ary );
		unset ( $sql_ary );
		
		$db->sql_query('DELETE FROM ' . BB_LANGUAGE . "  where game_id = '".$this->game_id."' and attribute = 'race' ");
		$sql_ary = array();
		
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 0, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Unknown' ,  'name_short' =>  'Unknown' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 1, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Dwarves' ,  'name_short' =>  'Dwarves' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 2, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'High Elves' , 'name_short' =>  'High Elves' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 3, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Mathosian' ,  'name_short' =>  'Mathosian' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 4, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Bahmi' ,  'name_short' =>  'Bahmi' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 5, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Eth' , 'name_short' =>  'Eth' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 6, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Kelari' ,  'name_short' =>  'Kelari' );
		
		$db->sql_multi_insert ( BB_LANGUAGE , $sql_ary );
		unset ( $sql_ary );
		
		
		
	}


}

