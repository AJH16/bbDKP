<?php
/**
 * bbguild ffxiv install data
 *
 * @package bbguild v2.0
 * @copyright 2016 bbDKP <https://github.com/bbDKP>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 * @author Brytor (Legion of Altana)
 * @author Sajaki
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
 * ffxiv Installer Class
 * @package bbdkp\bbguild\model\games\library
 */
class install_ffxiv extends GameInstall
{
    protected $bossbaseurl = 'http://na.finalfantasyxiv.com/lodestone/playguide/db/npc/enemy/%s/';
    protected $zonebaseurl = 'http://na.finalfantasyxiv.com/lodestone/playguide/db/npc/?category2=enemy&area=%s';

	/**
	 * Installs factions
	 */
    protected function Installfactions()
	{
		global  $db;

		// factions
		$db->sql_query('DELETE FROM ' . FACTION_TABLE . " where game_id = '" .$this->game_id . "'" );
		$sql_ary = array();
	    $sql_ary[] = array('game_id' => $this->game_id,'faction_id' => 1, 'faction_name' => 'Limsa Lominsa: The Maelstrom' );
	    $sql_ary[] = array('game_id' => $this->game_id,'faction_id' => 2, 'faction_name' => 'Gridania: The Order of the Twin Adder' );
	    $sql_ary[] = array('game_id' => $this->game_id,'faction_id' => 3, 'faction_name' => 'Ul’dah: The Immortal Flames' );
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
	    $db->sql_query('DELETE FROM ' . CLASS_TABLE . " where game_id = '" .$this->game_id . "'" );
	    $sql_ary = array();
	    $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 0, 'class_armor_type' => 'CLOTH' , 'class_min_level' => 1 , 'class_max_level'  => 50, 'imagename' => 'ffxiv_unknown' );
	    $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 1, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 1 , 'class_max_level'  => 50, 'imagename' => 'ffxiv_archer' );
	    $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 2, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 1 , 'class_max_level'  => 50, 'imagename' => 'ffxiv_bard' );
	    $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 3, 'class_armor_type' => 'PLATE' , 'class_min_level' => 1 , 'class_max_level'  => 50, 'imagename' => 'ffxiv_gladiator' );
	    $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 4, 'class_armor_type' => 'PLATE' , 'class_min_level' => 1 , 'class_max_level'  => 50, 'imagename' => 'ffxiv_paladin' );
	    $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 5, 'class_armor_type' => 'PLATE' , 'class_min_level' => 1 , 'class_max_level'  => 50, 'imagename' => 'ffxiv_lancer' );
	    $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 6, 'class_armor_type' => 'PLATE' , 'class_min_level' => 1 , 'class_max_level'  => 50, 'imagename' => 'ffxiv_dragoon' );
	    $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 7, 'class_armor_type' => 'PLATE' , 'class_min_level' => 1 , 'class_max_level'  => 50, 'imagename' => 'ffxiv_marauder' );
	    $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 8, 'class_armor_type' => 'PLATE' , 'class_min_level' => 1 , 'class_max_level'  => 50, 'imagename' => 'ffxiv_warrior' );
	    $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 9, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 1 , 'class_max_level'  => 50, 'imagename' => 'ffxiv_pugilist' );
	    $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 10, 'class_armor_type' => 'LEATHER' , 'class_min_level' => 1 , 'class_max_level'  => 50, 'imagename' => 'ffxiv_conjurer' );
	    $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 11, 'class_armor_type' => 'CLOTH' , 'class_min_level' => 1 , 'class_max_level'  => 50, 'imagename' => 'ffxiv_white_mage' );
	    $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 12, 'class_armor_type' => 'CLOTH' , 'class_min_level' => 1 , 'class_max_level'  => 50, 'imagename' => 'ffxiv_thaumaturge' );
	    $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 13, 'class_armor_type' => 'CLOTH' , 'class_min_level' => 1 , 'class_max_level'  => 50, 'imagename' => 'ffxiv_black_mage' );
	    $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 14, 'class_armor_type' => 'CLOTH' , 'class_min_level' => 1 , 'class_max_level'  => 50, 'imagename' => 'ffxiv_arcanist' );
	    $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 15, 'class_armor_type' => 'CLOTH' , 'class_min_level' => 1 , 'class_max_level'  => 50, 'imagename' => 'ffxiv_summoner' );
	    $sql_ary[] = array('game_id' => $this->game_id,'class_id' => 16, 'class_armor_type' => 'CLOTH' , 'class_min_level' => 1 , 'class_max_level'  => 50, 'imagename' => 'ffxiv_scholar' );
		$db->sql_multi_insert( CLASS_TABLE, $sql_ary);
		unset ($sql_ary);

		// Language table
		$db->sql_query('DELETE FROM ' . BB_LANGUAGE . "  where game_id = '" .$this->game_id . "' and attribute='class' ");
		$sql_ary = array();
		$sql_ary[] = array('game_id' => $this->game_id,'attribute_id' => 0, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Unknown' ,  'name_short' =>  'Unknown' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 1, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Archer' ,  'name_short' =>  'Archer' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 2, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Bard' ,  'name_short' =>  'Bard' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 3, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Gladiator' ,  'name_short' =>  'Gladiator' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 4, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Paladin' ,  'name_short' =>  'Paladin' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 5, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Lancer' ,  'name_short' =>  'Dragoon' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 6, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Marauder' ,  'name_short' =>  'Marauder' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 7, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Warrior' ,  'name_short' =>  'Warrior' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 8, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Pugilist' ,  'name_short' =>  'Pugilist' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 9, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Monk' ,  'name_short' =>  'Monk' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 10, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Conjurer' ,  'name_short' =>  'Conjurer' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 11, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'White Mage' ,  'name_short' =>  'White Mage' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 12, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Thaumaturge' ,  'name_short' =>  'Thaumaturge' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 13, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Black Mage' ,  'name_short' =>  'Black Mage' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 14, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Arcanist' ,  'name_short' =>  'Arcanist' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 15, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Summoner' ,  'name_short' =>  'Summoner' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 16, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Scholar' ,  'name_short' =>  'Scholar' );

		$sql_ary[] = array('game_id' => $this->game_id,'attribute_id' => 0, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Unknown' ,  'name_short' =>  'Unknown' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 1, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Archer' ,  'name_short' =>  'Archer' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 2, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Bard' ,  'name_short' =>  'Bard' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 3, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Gladiator' ,  'name_short' =>  'Gladiator' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 4, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Paladin' ,  'name_short' =>  'Paladin' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 5, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Lancer' ,  'name_short' =>  'Dragoon' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 6, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Marauder' ,  'name_short' =>  'Marauder' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 7, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Warrior' ,  'name_short' =>  'Warrior' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 8, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Pugilist' ,  'name_short' =>  'Pugilist' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 9, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Monk' ,  'name_short' =>  'Monk' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 10, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Conjurer' ,  'name_short' =>  'Conjurer' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 11, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'White Mage' ,  'name_short' =>  'White Mage' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 12, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Thaumaturge' ,  'name_short' =>  'Thaumaturge' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 13, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Black Mage' ,  'name_short' =>  'Black Mage' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 14, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Arcanist' ,  'name_short' =>  'Arcanist' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 15, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Summoner' ,  'name_short' =>  'Summoner' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 16, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Scholar' ,  'name_short' =>  'Scholar' );

		$sql_ary[] = array('game_id' => $this->game_id,'attribute_id' => 0, 'language' =>   'fr' , 'attribute' =>  'class' , 'name' =>  'Unknown' ,  'name_short' =>  'Unknown' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 1, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Archer' ,  'name_short' =>  'Archer' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 2, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Bard' ,  'name_short' =>  'Bard' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 3, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Gladiator' ,  'name_short' =>  'Gladiator' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 4, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Paladin' ,  'name_short' =>  'Paladin' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 5, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Lancer' ,  'name_short' =>  'Dragoon' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 6, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Marauder' ,  'name_short' =>  'Marauder' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 7, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Warrior' ,  'name_short' =>  'Warrior' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 8, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Pugilist' ,  'name_short' =>  'Pugilist' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 9, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Monk' ,  'name_short' =>  'Monk' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 10, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Conjurer' ,  'name_short' =>  'Conjurer' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 11, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'White Mage' ,  'name_short' =>  'White Mage' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 12, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Thaumaturge' ,  'name_short' =>  'Thaumaturge' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 13, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Black Mage' ,  'name_short' =>  'Black Mage' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 14, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Arcanist' ,  'name_short' =>  'Arcanist' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 15, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Summoner' ,  'name_short' =>  'Summoner' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 16, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Scholar' ,  'name_short' =>  'Scholar' );
		$db->sql_multi_insert (  BB_LANGUAGE  , $sql_ary );
		unset ( $sql_ary );

	}

	/**
	 * Installs races
	*/
    protected function InstallRaces()
	{
		global  $db;
		$db->sql_query('DELETE FROM ' .  RACE_TABLE . "  where game_id = '" .$this->game_id . "'");
		$sql_ary = array();
		$sql_ary[] = array('game_id' => $this->game_id,'race_id' => 1, 'race_faction_id' => 3, 'image_female' => '',  'image_male' => '' ); //Unknown
		$sql_ary[] = array('game_id' => $this->game_id,'race_id' => 2, 'race_faction_id' => 1, 'image_female' => 'ffxiv_roegadyn_female',  'image_male' => 'ffxiv_roegadyn_male' ); //Roegadyn
		$sql_ary[] = array('game_id' => $this->game_id,'race_id' => 3, 'race_faction_id' => 3, 'image_female' => 'ffxiv_hyur_female',  'image_male' => 'ffxiv_hyur_female' ); //Hyur
		$sql_ary[] = array('game_id' => $this->game_id,'race_id' => 4, 'race_faction_id' => 2, 'image_female' => 'ffxiv_elezen_female',  'image_male' => 'ffxiv_elezen_male' ); ///Elezen
		$sql_ary[] = array('game_id' => $this->game_id,'race_id' => 5, 'race_faction_id' => 2, 'image_female' => 'ffxiv_lalafell_female',  'image_male' => 'ffxiv_lalafell_male' ); //Lalafell
		$sql_ary[] = array('game_id' => $this->game_id,'race_id' => 6, 'race_faction_id' => 3, 'image_female' => 'ffxiv_miqote_female',  'image_male' => 'ffxiv_miqote_male' ); //Miqo'te
		$db->sql_multi_insert(  RACE_TABLE , $sql_ary);

		// Language table
		$db->sql_query('DELETE FROM ' . BB_LANGUAGE . "  where game_id = '" .$this->game_id . "' and attribute='race' ");
		$sql_ary = array();

		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 1, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Unknown' ,  'name_short' =>  'Unknown' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 2, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Roegadyn' ,  'name_short' =>  'Roegadyn' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 3, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Hyur' ,  'name_short' =>  'Hyur' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 4, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Elezen' ,  'name_short' =>  'Elezen' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 5, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Lalafell' ,  'name_short' =>  'Lalafell' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 6, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Miqo’te' ,  'name_short' =>  'Miqo’te' );

		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 1, 'language' =>  'fr' , 'attribute' =>  'race' , 'name' =>  'Unknown' ,  'name_short' =>  'Unknown' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 2, 'language' =>  'fr' , 'attribute' =>  'race' , 'name' =>  'Roegadyn' ,  'name_short' =>  'Roegadyn' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 3, 'language' =>  'fr' , 'attribute' =>  'race' , 'name' =>  'Hyur' ,  'name_short' =>  'Hyur' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 4, 'language' =>  'fr' , 'attribute' =>  'race' , 'name' =>  'Elezen' ,  'name_short' =>  'Elezen' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 5, 'language' =>  'fr' , 'attribute' =>  'race' , 'name' =>  'Lalafell' ,  'name_short' =>  'Lalafell' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 6, 'language' =>  'fr' , 'attribute' =>  'race' , 'name' =>  'Miqo’te' ,  'name_short' =>  'Miqo’te' );

		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 1, 'language' =>  'de' , 'attribute' =>  'race' , 'name' =>  'Unknown' ,  'name_short' =>  'Unknown' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 2, 'language' =>  'de' , 'attribute' =>  'race' , 'name' =>  'Roegadyn' ,  'name_short' =>  'Roegadyn' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 3, 'language' =>  'de' , 'attribute' =>  'race' , 'name' =>  'Hyur' ,  'name_short' =>  'Hyur' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 4, 'language' =>  'de' , 'attribute' =>  'race' , 'name' =>  'Elezen' ,  'name_short' =>  'Elezen' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 5, 'language' =>  'de' , 'attribute' =>  'race' , 'name' =>  'Lalafell' ,  'name_short' =>  'Lalafell' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 6, 'language' =>  'de' , 'attribute' =>  'race' , 'name' =>  'Miqo’te' ,  'name_short' =>  'Miqo’te' );
		$db->sql_multi_insert (  BB_LANGUAGE  , $sql_ary );
		unset ( $sql_ary );

	}


}