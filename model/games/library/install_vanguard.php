<?php
/**
 * bbguild vanguard install data
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
 * Vanguard Installer class
 * @package bbdkp\bbguild\controller\games
 */
class install_vanguard extends GameInstall
{
    protected $bossbaseurl = 'http://vg.mmodb.com/bestiary/%s.php';
    protected $zonebaseurl = 'http://vg.mmodb.com/zones/%s.php';

    /**
	 * Installs factions
	 */
    protected function Installfactions()
	{
		
		global  $db;
		// factions
		$db->sql_query('DELETE FROM ' . FACTION_TABLE . " WHERE game_id = '" . $this->game_id . "'" );
		$sql_ary = array();
		$sql_ary[] = array('game_id' => $this->game_id,'faction_id' => 1, 'faction_name' => 'Thestra' );
		$sql_ary[] = array('game_id' => $this->game_id,'faction_id' => 2, 'faction_name' => 'Kojan' );
		$sql_ary[] = array('game_id' => $this->game_id,'faction_id' => 3, 'faction_name' => 'Qalia' );
		$db->sql_multi_insert( FACTION_TABLE, $sql_ary);
		unset ($sql_ary);
	}
	
	/**
	 * Installs game classes
	*/
    protected function InstallClasses()
	{
		global  $db;
		
		// class :
		$db->sql_query('DELETE FROM ' . CLASS_TABLE . " WHERE game_id = '" . $this->game_id . "'" );
		$sql_ary = array();
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 0, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 1 , 'class_max_level'  => 50,  'colorcode' =>  '#999', 'imagename' => 'vanguard_unknown');
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 1, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 1 , 'class_max_level'  => 50,  'colorcode' =>  '#FF0044', 'imagename' => 'vanguard_bard' );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 3, 'class_armor_type' => 'CLOTH' , 'class_min_level' => 1 , 'class_max_level'  => 50,  'colorcode' =>  '#33FF00',  'imagename' => 'vanguard_bloodmage' );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 4, 'class_armor_type' => 'PLATE' , 'class_min_level' => 1 , 'class_max_level'  => 50,  'colorcode' =>  '#33FF00', 'imagename' => 'vanguard_cleric' );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 5, 'class_armor_type' => 'CLOTH' , 'class_min_level' => 1 , 'class_max_level'  => 50,  'colorcode' =>  '#33FF00', 'imagename' => 'vanguard_disciple' );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 6, 'class_armor_type' => 'PLATE' , 'class_min_level' => 1 , 'class_max_level'  => 50,  'colorcode' =>  '#CC9933', 'imagename' => 'vanguard_dreadknight' );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 7, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 1 , 'class_max_level'  => 50,  'colorcode' =>  '#CC00BB', 'imagename' => 'vanguard_druid' );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 8, 'class_armor_type' => 'CLOTH' , 'class_min_level' => 1 , 'class_max_level'  => 50,  'colorcode' =>  '#FF0044', 'imagename' => 'vanguard_monk' );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 9, 'class_armor_type' => 'CLOTH' , 'class_min_level' => 1 , 'class_max_level'  => 50,  'colorcode' =>  '#CC00BB',  'imagename' => 'vanguard_necromancer' );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 10, 'class_armor_type' => 'PLATE' , 'class_min_level' => 1 , 'class_max_level'  => 50,  'colorcode' =>  '#CC9933', 'imagename' => 'vanguard_paladin' );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 11, 'class_armor_type' => 'CLOTH' , 'class_min_level' => 1 , 'class_max_level'  => 50,  'colorcode' =>  '#CC00BB', 'imagename' => 'vanguard_psionicist' );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 12, 'class_armor_type' => 'MAIL' , 'class_min_level' => 1 , 'class_max_level'  => 50,  'colorcode' =>  '#FF0044', 'imagename' => 'vanguard_ranger' );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 13, 'class_armor_type' => 'MAIL' , 'class_min_level' => 1 , 'class_max_level'  => 50,  'colorcode' =>  '#FF0044', 'imagename' => 'vanguard_rogue' );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 14, 'class_armor_type' => 'CLOTH' , 'class_min_level' => 1 , 'class_max_level'  => 50,  'colorcode' =>  '#CC00BB', 'imagename' => 'vanguard_sorcerer' );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 15, 'class_armor_type' => 'PLATE' , 'class_min_level' => 1 , 'class_max_level'  => 50,  'colorcode' =>  '#CC9933', 'imagename' => 'vanguard_warrior' );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 16, 'class_armor_type' => 'MAIL' , 'class_min_level' => 1 , 'class_max_level'  => 50,  'colorcode' =>  '#33FF00',  'imagename' => 'vanguard_shaman' );
		$db->sql_multi_insert( CLASS_TABLE, $sql_ary);
		unset ($sql_ary);
		
		$db->sql_query('DELETE FROM ' . BB_LANGUAGE . "  WHERE game_id = '" . $this->game_id . "' and attribute='class' ");
		$sql_ary = array();
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 0, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Unknown' ,  'name_short' =>  'Unknown' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 1, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Bard' ,  'name_short' =>  'Bard' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 3, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Blood Mage' ,  'name_short' =>  'Blood Mage' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 4, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Cleric' ,  'name_short' =>  'Cleric' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 5, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Disciple' ,  'name_short' =>  'Disciple' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 6, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Dread Knight' ,  'name_short' =>  'Dread Knight' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 7, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Druid' ,  'name_short' =>  'Druid' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 8, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Monk' ,  'name_short' =>  'Monk' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 9, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Necromancer' ,  'name_short' =>  'Necromancer' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 10, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Paladin' ,  'name_short' =>  'Paladin' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 11, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Psionicist' ,  'name_short' =>  'Psionicist' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 12, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Ranger' ,  'name_short' =>  'Ranger' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 13, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Rogue' ,  'name_short' =>  'Rogue' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 14, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Sorcerer' ,  'name_short' =>  'Sorcerer' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 15, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Warrior' ,  'name_short' =>  'Warrior' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 16, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Shaman' ,  'name_short' =>  'Shaman' );
		$db->sql_multi_insert ( BB_LANGUAGE , $sql_ary);
		unset ( $sql_ary );
		
		
	}
	
	/**
	 * Installs races
	*/
    protected function InstallRaces()
	{
		global  $db;
		// races
		$db->sql_query('DELETE FROM ' .  RACE_TABLE . "  where game_id = '" . $this->game_id . "'");
		$sql_ary = array();
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 0, 'race_faction_id' => 1,  'image_female' => ' ',  'image_male' => ' '  ); //Unknown
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 1, 'race_faction_id' => 1,  'image_female' => 'vanguard_thestran',  'image_male' => 'vanguard_thestran'  ); //Thestran Human
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 2, 'race_faction_id' => 1 , 'image_female' => 'vanguard_dwarf',  'image_male' => 'vanguard_dwarf' ); ///Dwarf
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 3, 'race_faction_id' => 1 , 'image_female' => 'vanguard_halfling',  'image_male' => 'vanguard_halfling' ); ///Halfling
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 4, 'race_faction_id' => 1 , 'image_female' => 'vanguard_helf',  'image_male' => 'vanguard_helf' ) ; //High Elf
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 5, 'race_faction_id' => 1  , 'image_female' => 'vanguard_vulmane',  'image_male' => 'vanguard_vulmane' ); //Vulmane
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 6, 'race_faction_id' => 1 , 'image_female' => 'vanguard_varanjer',  'image_male' => 'vanguard_varanjer' ); //Varanjar
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 7, 'race_faction_id' => 2 , 'image_female' => 'vanguard_lgiant',  'image_male' => 'vanguard_lgiant' ); //Lesser Giant
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 8, 'race_faction_id' => 2 , 'image_female' => 'vanguard_kojani',  'image_male' => 'vanguard_kojani' ); //Kojani Human
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 9, 'race_faction_id' => 2 , 'image_female' => 'vanguard_welf',  'image_male' => 'vanguard_welf' ); //Wood Elf
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 10, 'race_faction_id' => 2 , 'image_female' => 'vanguard_aelf',  'image_male' => 'vanguard_aelf' ); //Half Elf
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 11, 'race_faction_id' => 2 , 'image_female' => 'vanguard_orc',  'image_male' => 'vanguard_orc' ); //Orc
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 12, 'race_faction_id' => 2 , 'image_female' => 'vanguard_goblin',  'image_male' => 'vanguard_goblin' ); //Goblin
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 13, 'race_faction_id' => 2 , 'image_female' => 'vanguard_raki',  'image_male' => 'vanguard_raki' ); //Raki
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 14, 'race_faction_id' => 3 , 'image_female' => 'vanguard_qual',  'image_male' => 'vanguard_qual' ); //Qaliathar
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 15, 'race_faction_id' => 3 , 'image_female' => 'vanguard_gnome',  'image_male' => 'vanguard_gnome' ); //Gnome
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 16, 'race_faction_id' => 3 , 'image_female' => 'vanguard_delf',  'image_male' => 'vanguard_delf' ); //Dark Elf
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 17, 'race_faction_id' => 3 , 'image_female' => 'vanguard_kurashasa',  'image_male' => 'vanguard_kurashasa' ); //Kurashasa
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 18, 'race_faction_id' => 3 , 'image_female' => 'vanguard_mordebi',  'image_male' => 'vanguard_mordebi' ); //Mordebi Human
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 19, 'race_faction_id' => 3 , 'image_female' => 'vanguard_varan',  'image_male' => 'vanguard_varan' ); //Varanthari
		$db->sql_multi_insert(  RACE_TABLE , $sql_ary);
		unset ( $sql_ary );
		
		$db->sql_query('DELETE FROM ' . BB_LANGUAGE . "  WHERE game_id = '" . $this->game_id . "' and attribute='race' ");
		$sql_ary = array();
		
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 1, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Thestran Human' ,  'name_short' =>  'Thestran Human' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 2, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Dwarf' ,  'name_short' =>  'Dwarf' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 3, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Halfling' ,  'name_short' =>  'Halfling' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 4, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'High Elf' ,  'name_short' =>  'High Elf' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 5, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Vulmane' ,  'name_short' =>  'Vulmane' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 6, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Varanjar' ,  'name_short' =>  'Varanjar' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 7, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Lesser Giant' ,  'name_short' =>  'Lesser Giant' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 8, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Kojani Human' ,  'name_short' =>  'Kojani Human' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 9, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Wood Elf' ,  'name_short' =>  'Wood Elf' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 10, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Half Elf' ,  'name_short' =>  'Half Elf' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 11, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Orc' ,  'name_short' =>  'Orc' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 12, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Goblin' ,  'name_short' =>  'Goblin' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 13, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Raki' ,  'name_short' =>  'Raki' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 14, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Qaliathar' ,  'name_short' =>  'Qaliathar' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 15, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Gnome' ,  'name_short' =>  'Gnome' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 16, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Dark Elf' ,  'name_short' =>  'Dark Elf' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 17, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Kurashasa' ,  'name_short' =>  'Kurashasa' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 18, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Mordebi Human' ,  'name_short' =>  'Mordebi Human' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 19, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Varanthari' ,  'name_short' =>  'Varanthari' );
		$db->sql_multi_insert ( BB_LANGUAGE , $sql_ary);
		unset ( $sql_ary );
		
		
	}



}