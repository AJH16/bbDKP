<?php
/**
 * Wow Installer File
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
 * Wow installer Class
 * @package bbdkp\bbguild\model\games\library
 */
class install_wow extends GameInstall
{
    protected $bossbaseurl = 'http://www.wowhead.com/?npc=%s';
    protected $zonebaseurl = 'http://www.wowhead.com/?zone=%s';

    /**
	 * Installs factions
	 */
    protected function Installfactions()
	{
		global $db;
		// factions
		$db->sql_query('DELETE FROM ' . FACTION_TABLE . " WHERE game_id = '" . $this->game_id . "'" );
		$sql_ary = array();
		$sql_ary [] = array ('game_id' => $this->game_id ,'faction_id' => 1, 'faction_name' => 'Alliance' );
		$sql_ary [] = array ('game_id' => $this->game_id ,'faction_id' => 2, 'faction_name' => 'Horde' );
		$db->sql_multi_insert ( FACTION_TABLE, $sql_ary );
		unset ( $sql_ary );
	}

	/**
	 * Installs game classes
	*/
    protected function InstallClasses()
	{
		global $db;

		// classes
		// note class 10 does not exist
		$db->sql_query('DELETE FROM ' . CLASS_TABLE . " WHERE game_id = 'wow'" );
		$sql_ary = array ();
		$sql_ary [] = array ('game_id' => $this->game_id , 'class_id' => 0, 'class_armor_type' => 'PLATE', 'class_min_level' => 1, 'class_max_level' => 100 , 'colorcode' =>  '#999', 'imagename' => 'wow_unknown');
		$sql_ary [] = array ('game_id' => $this->game_id ,'class_id' => 1, 'class_armor_type' => 'PLATE', 'class_min_level' => 1, 'class_max_level' => 100 , 'colorcode' =>  '#C79C6E', 'imagename' => 'wow_warrior');
		$sql_ary [] = array ('game_id' => $this->game_id , 'class_id' => 4, 'class_armor_type' => 'LEATHER', 'class_min_level' => 1, 'class_max_level' => 100, 'colorcode' =>  '#FFF569',  'imagename' => 'wow_rogue');
		$sql_ary [] = array ('game_id' => $this->game_id ,'class_id' => 3, 'class_armor_type' => 'MAIL', 'class_min_level' => 1, 'class_max_level' => 100 , 'colorcode' =>  '#ABD473',  'imagename' => 'wow_hunter');
		$sql_ary [] = array ('game_id' => $this->game_id ,'class_id' => 2, 'class_armor_type' => 'PLATE', 'class_min_level' => 1, 'class_max_level' => 100 ,  'colorcode' =>  '#F58CBA',  'imagename' => 'wow_paladin');
		$sql_ary [] = array ('game_id' => $this->game_id ,'class_id' => 7, 'class_armor_type' => 'MAIL', 'class_min_level' => 1, 'class_max_level' => 100 , 'colorcode' =>  '#0070DE',  'imagename' => 'wow_shaman');
		$sql_ary [] = array ('game_id' => $this->game_id ,'class_id' => 11, 'class_armor_type' => 'LEATHER', 'class_min_level' => 1, 'class_max_level' => 100 , 'colorcode' =>  '#FF7D0A',  'imagename' => 'wow_druid');
		$sql_ary [] = array ('game_id' => $this->game_id ,'class_id' => 9, 'class_armor_type' => 'CLOTH', 'class_min_level' => 1, 'class_max_level' => 100 , 'colorcode' =>  '#9482C9',  'imagename' => 'wow_warlock');
		$sql_ary [] = array ('game_id' => $this->game_id ,'class_id' => 8, 'class_armor_type' => 'CLOTH', 'class_min_level' => 1, 'class_max_level' => 100 , 'colorcode' =>  '#69CCF0',  'imagename' => 'wow_mage');
		$sql_ary [] = array ('game_id' => $this->game_id ,'class_id' => 5, 'class_armor_type' => 'CLOTH', 'class_min_level' => 1, 'class_max_level' => 100 ,  'colorcode' =>  '#FFFFFF', 'imagename' => 'wow_priest');
		$sql_ary [] = array ('game_id' => $this->game_id ,'class_id' => 6, 'class_armor_type' => 'PLATE', 'class_min_level' => 55, 'class_max_level' => 100 , 'colorcode' =>  '#C41F3B',  'imagename' => 'wow_death_knight');
		$sql_ary [] = array ('game_id' => $this->game_id ,'class_id' => 10, 'class_armor_type' => 'LEATHER', 'class_min_level' => 1, 'class_max_level' => 100 ,  'colorcode' =>  '#008467', 'imagename' => 'wow_monk');
		$db->sql_multi_insert ( CLASS_TABLE, $sql_ary );
		unset ( $sql_ary );

		// languages
		$db->sql_query('DELETE FROM ' . BB_LANGUAGE . " WHERE game_id = '". $this->game_id . "' AND attribute='class' ");

		$sql_ary = array ();
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 0, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Unknown' ,  'name_short' =>  'Unknown' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 1, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Warrior' ,  'name_short' =>  'Warrior' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 4, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Rogue' ,  'name_short' =>  'Rogue' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 3, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Hunter' ,  'name_short' =>  'Hunter' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 2, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Paladin' ,  'name_short' =>  'Paladin' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 7, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Shaman' ,  'name_short' =>  'Shaman' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 11, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Druid' ,  'name_short' =>  'Druid' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 9, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Warlock' ,  'name_short' =>  'Warlock' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 8, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Mage' ,  'name_short' =>  'Mage' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 5, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Priest' ,  'name_short' =>  'Priest' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 6, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Death Knight' ,  'name_short' =>  'Death Knight' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 10, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Monk' ,  'name_short' =>  'Monk' );

		//classes in fr
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 0, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Unknown' ,  'name_short' =>  'Unknown' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 1, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Warrior' ,  'name_short' =>  'Warrior' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 4, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Voleur' ,  'name_short' =>  'Voleur' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 3, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Chasseur' ,  'name_short' =>  'Chasseur' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 2, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Paladin' ,  'name_short' =>  'Paladin' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 7, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Chaman' ,  'name_short' =>  'Chaman' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 11, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Druide' ,  'name_short' =>  'Druide' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 9, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Démoniste' ,  'name_short' =>  'Démoniste' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 8, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Mage' ,  'name_short' =>  'Mage' );
		$sql_ary[] = array('game_id' => $this->game_id ,'attribute_id' => 5, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Prêtre' ,  'name_short' =>  'Prêtre' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 6, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Chevalier de la Mort' ,  'name_short' =>  'Chevalier de la Mort' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 10, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Moine' ,  'name_short' =>  'Moine' );

		//classes in de
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 0, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Unbekannt' ,  'name_short' =>  'Unbekannt' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 1, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Krieger' ,  'name_short' =>  'Krieger' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 4, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Schurke' ,  'name_short' =>  'Schurke' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 3, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Jäger' ,  'name_short' =>  'Jäger' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 2, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Paladin' ,  'name_short' =>  'Paladin' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 7, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Schamane' ,  'name_short' =>  'Schamane' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 11, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Druide' ,  'name_short' =>  'Druide' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 9, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Hexenmeister' ,  'name_short' =>  'Hexenmeister' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 8, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Magier' ,  'name_short' =>  'Magier' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 5, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Priester' ,  'name_short' =>  'Priester' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 6, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Todesritter' ,  'name_short' =>  'Todesritter' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 10, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Mönch' ,  'name_short' =>  'Mönch' );

        //classes in it
        $sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 0, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Sconosciuto' ,  'name_short' =>  'Sconosciuto' );
        $sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 1, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Guerriero' ,  'name_short' =>  'Guerriero' );
        $sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 4, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Ladro' ,  'name_short' =>  'Ladro' );
        $sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 3, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Cacciatore' ,  'name_short' =>  'Cacciatore' );
        $sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 2, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Paladino' ,  'name_short' =>  'Paladino' );
        $sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 7, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Sciamano' ,  'name_short' =>  'Sciamano' );
        $sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 11, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Druido' ,  'name_short' =>  'Druido' );
        $sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 9, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Stregone' ,  'name_short' =>  'Stregone' );
        $sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 8, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Mago' ,  'name_short' =>  'Mago' );
        $sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 5, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Sacerdote' ,  'name_short' =>  'Sacerdote' );
        $sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 6, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Cavaliere della Morte' ,  'name_short' =>  'Cavaliere della Morte' );
        $sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 10, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Monaco' ,  'name_short' =>  'Monaco' );

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
		$db->sql_query('DELETE FROM ' .  RACE_TABLE . " WHERE game_id = '" . $this->game_id . "' ");
		$sql_ary = array ();
		$sql_ary [] = array ('game_id' => $this->game_id ,'race_id' => 0, 'race_faction_id' => 0, 'image_female' => ' ',  'image_male' => ' '  ); //Unknown
		$sql_ary [] = array ('game_id' => $this->game_id ,'race_id' => 1, 'race_faction_id' => 1, 'image_female' => 'wow_human_female',  'image_male' => 'wow_human_male'  ); //Human
		$sql_ary [] = array ('game_id' => $this->game_id ,'race_id' => 2, 'race_faction_id' => 2 , 'image_female' => 'wow_orc_female',  'image_male' => 'wow_orc_male' ); //Orc
		$sql_ary [] = array ('game_id' => $this->game_id ,'race_id' => 3, 'race_faction_id' => 1 , 'image_female' => 'wow_dwarf_female',  'image_male' => 'wow_dwarf_male' ); //Dwarf
		$sql_ary [] = array ('game_id' => $this->game_id ,'race_id' => 4, 'race_faction_id' => 1 , 'image_female' => 'wow_nightelf_female',  'image_male' => 'wow_nightelf_male' ) ; //Night Elf
		$sql_ary [] = array ('game_id' => $this->game_id ,'race_id' => 5, 'race_faction_id' => 2 , 'image_female' => 'wow_scourge_female',  'image_male' => 'wow_scourge_male' ); //Undead
		$sql_ary [] = array ('game_id' => $this->game_id ,'race_id' => 6, 'race_faction_id' => 2 , 'image_female' => 'wow_tauren_female',  'image_male' => 'wow_tauren_male' ); //Tauren
		$sql_ary [] = array ('game_id' => $this->game_id ,'race_id' => 7, 'race_faction_id' => 1 , 'image_female' => 'wow_gnome_female',  'image_male' => 'wow_gnome_male' ); //Gnome
		$sql_ary [] = array ('game_id' => $this->game_id ,'race_id' => 8, 'race_faction_id' => 2 , 'image_female' => 'wow_troll_female',  'image_male' => 'wow_troll_male' ); //Troll
		$sql_ary [] = array ('game_id' => $this->game_id ,'race_id' => 9, 'race_faction_id' => 2 , 'image_female' => 'wow_goblin_female',  'image_male' => 'wow_goblin_male' ); //Goblin
		$sql_ary [] = array ('game_id' => $this->game_id ,'race_id' => 10, 'race_faction_id' => 2 , 'image_female' => 'wow_bloodelf_female',  'image_male' => 'wow_bloodelf_male' ); //Blood Elf
		$sql_ary [] = array ('game_id' => $this->game_id ,'race_id' => 11, 'race_faction_id' => 1 , 'image_female' => 'wow_draenei_female',  'image_male' => 'wow_draenei_male' ); //Draenei
		$sql_ary [] = array ('game_id' => $this->game_id ,'race_id' => 22, 'race_faction_id' => 1 , 'image_female' => 'wow_worgen_female',  'image_male' => 'wow_worgen_male' ); //Worgen
		$sql_ary [] = array ('game_id' => $this->game_id ,'race_id' => 25, 'race_faction_id' => 1 , 'image_female' => 'wow_pandaren_female',  'image_male' => 'wow_pandaren_male' ); //Pandaren alliance
		$sql_ary [] = array ('game_id' => $this->game_id ,'race_id' => 26, 'race_faction_id' => 2 , 'image_female' => 'wow_pandaren_female',  'image_male' => 'wow_pandaren_male' ); //Pandaren Horde
		$db->sql_multi_insert (  RACE_TABLE , $sql_ary );
		unset ( $sql_ary );

		$db->sql_query('DELETE FROM ' . BB_LANGUAGE . " WHERE game_id = '" . $this->game_id . "' AND attribute = 'race' ");

		//races in en
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 0, 'language' => 'en' , 'attribute' =>  'race' , 'name' =>  'Unknown' ,  'name_short' =>  'Unknown' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 1, 'language' => 'en' , 'attribute' =>  'race' , 'name' =>  'Human' ,  'name_short' =>  'Human' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 2, 'language' => 'en' , 'attribute' =>  'race' , 'name' =>  'Orc' ,  'name_short' =>  'Orc' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 3, 'language' => 'en' , 'attribute' =>  'race' , 'name' =>  'Dwarf' ,  'name_short' =>  'Dwarf' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 4, 'language' => 'en' , 'attribute' =>  'race' , 'name' =>  'Night Elf' ,  'name_short' =>  'Night Elf' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 5, 'language' => 'en' , 'attribute' =>  'race' , 'name' =>  'Undead' ,  'name_short' =>  'Undead' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 6, 'language' => 'en' , 'attribute' =>  'race' , 'name' =>  'Tauren' ,  'name_short' =>  'Tauren' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 7, 'language' => 'en' , 'attribute' =>  'race' , 'name' =>  'Gnome' ,  'name_short' =>  'Gnome' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 8, 'language' => 'en' , 'attribute' =>  'race' , 'name' =>  'Troll' ,  'name_short' =>  'Troll' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 10, 'language' => 'en' , 'attribute' =>  'race' , 'name' =>  'Blood Elf' ,  'name_short' =>  'Blood Elf' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 11, 'language' => 'en' , 'attribute' =>  'race' , 'name' =>  'Draenei' ,  'name_short' =>  'Draenei' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 9, 'language' => 'en' , 'attribute' =>  'race' , 'name' =>  'Goblin' ,  'name_short' =>  'Goblin' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 22, 'language' => 'en' , 'attribute' =>  'race' , 'name' =>  'Worgen' ,  'name_short' =>  'Worgen' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 25, 'language' => 'en' , 'attribute' =>  'race' , 'name' =>  'Pandaren Alliance' ,  'name_short' =>  'Pandaren Alliance' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 26, 'language' => 'en' , 'attribute' =>  'race' , 'name' =>  'Pandaren Horde' ,  'name_short' =>  'Pandaren Horde' );

		// races in fr
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 0, 'language' => 'fr' , 'attribute' =>  'race' , 'name' =>  'Inconnu' ,  'name_short' =>  'Inconnu' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 1, 'language' => 'fr' , 'attribute' =>  'race' , 'name' =>  'Humain' ,  'name_short' =>  'Humain' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 2, 'language' => 'fr' , 'attribute' =>  'race' , 'name' =>  'Orc' ,  'name_short' =>  'Orc' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 3, 'language' => 'fr' , 'attribute' =>  'race' , 'name' =>  'Nain' ,  'name_short' =>  'Nain' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 4, 'language' => 'fr' , 'attribute' =>  'race' , 'name' =>  'Elfe de la Nuit' ,  'name_short' =>  'Elfe de la Nuit' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 5, 'language' => 'fr' , 'attribute' =>  'race' , 'name' =>  'Mort-Vivant' ,  'name_short' =>  'Mort-Vivant' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 6, 'language' => 'fr' , 'attribute' =>  'race' , 'name' =>  'Tauren' ,  'name_short' =>  'Tauren' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 7, 'language' => 'fr' , 'attribute' =>  'race' , 'name' =>  'Gnome' ,  'name_short' =>  'Gnome' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 8, 'language' => 'fr' , 'attribute' =>  'race' , 'name' =>  'Troll' ,  'name_short' =>  'Troll' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 10, 'language' => 'fr' , 'attribute' =>  'race' , 'name' =>  'Elfe de Sang' ,  'name_short' =>  'Elfe de Sang' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 11, 'language' => 'fr' , 'attribute' =>  'race' , 'name' =>  'Draeneï' ,  'name_short' =>  'Draeneï' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 9, 'language' => 'fr' , 'attribute' =>  'race' , 'name' =>  'Goblin' ,  'name_short' =>  'Goblin' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 22, 'language' => 'fr' , 'attribute' =>  'race' , 'name' =>  'Worgen' ,  'name_short' =>  'Worgen' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 25, 'language' => 'fr' , 'attribute' =>  'race' , 'name' =>  'Pandaren Alliance' ,  'name_short' =>  'Pandaren Alliance' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 26, 'language' => 'fr' , 'attribute' =>  'race' , 'name' =>  'Pandaren Horde' ,  'name_short' =>  'Pandaren Horde' );

		//races in de
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 0, 'language' => 'de' , 'attribute' =>  'race' , 'name' =>  'Unbekannt' ,  'name_short' =>  'Unbekannt' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 1, 'language' => 'de' , 'attribute' =>  'race' , 'name' =>  'Mensch' ,  'name_short' =>  'Mensch' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 2, 'language' => 'de' , 'attribute' =>  'race' , 'name' =>  'Orc' ,  'name_short' =>  'Orc' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 3, 'language' => 'de' , 'attribute' =>  'race' , 'name' =>  'Zwerg' ,  'name_short' =>  'Zwerg' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 4, 'language' => 'de' , 'attribute' =>  'race' , 'name' =>  'Nachtelf' ,  'name_short' =>  'Nachtelf' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 5, 'language' => 'de' , 'attribute' =>  'race' , 'name' =>  'Untoter' ,  'name_short' =>  'Untoter' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 6, 'language' => 'de' , 'attribute' =>  'race' , 'name' =>  'Tauren' ,  'name_short' =>  'Tauren' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 7, 'language' => 'de' , 'attribute' =>  'race' , 'name' =>  'Gnome' ,  'name_short' =>  'Gnome' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 8, 'language' => 'de' , 'attribute' =>  'race' , 'name' =>  'Troll' ,  'name_short' =>  'Troll' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 10, 'language' => 'de' , 'attribute' =>  'race' , 'name' =>  'Blutelf' ,  'name_short' =>  'Blutelf' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 11, 'language' => 'de' , 'attribute' =>  'race' , 'name' =>  'Draenei' ,  'name_short' =>  'Draenei' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 9, 'language' =>  'de' , 'attribute' =>  'race' , 'name' =>  'Goblin' ,  'name_short' =>  'Goblin' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 22, 'language' => 'de' , 'attribute' =>  'race' , 'name' =>  'Worgen' ,  'name_short' =>  'Worgen' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 25, 'language' => 'de' , 'attribute' =>  'race' , 'name' =>  'Pandaren Alliance' ,  'name_short' =>  'Pandaren Alliance' );
		$sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 26, 'language' => 'de' , 'attribute' =>  'race' , 'name' =>  'Pandaren Horde' ,  'name_short' =>  'Pandaren Horde' );

        //races in it
        $sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 0, 'language' => 'it' , 'attribute' =>  'race' , 'name' =>  'Sconosciuto' ,  'name_short' =>  'Sconosciuto' );
        $sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 1, 'language' => 'it' , 'attribute' =>  'race' , 'name' =>  'Umani' ,  'name_short' =>  'Umani' );
        $sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 2, 'language' => 'it' , 'attribute' =>  'race' , 'name' =>  'Orchi' ,  'name_short' =>  'Orchi' );
        $sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 3, 'language' => 'it' , 'attribute' =>  'race' , 'name' =>  'Nani' ,  'name_short' =>  'Nani' );
        $sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 4, 'language' => 'it' , 'attribute' =>  'race' , 'name' =>  'Elfi del Sangue' ,  'name_short' =>  'Elfi del Sangue' );
        $sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 5, 'language' => 'it' , 'attribute' =>  'race' , 'name' =>  'Non Morti' ,  'name_short' =>  'Non Morti' );
        $sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 6, 'language' => 'it' , 'attribute' =>  'race' , 'name' =>  'Tauren' ,  'name_short' =>  'Tauren' );
        $sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 7, 'language' => 'it' , 'attribute' =>  'race' , 'name' =>  'Gnomi' ,  'name_short' =>  'Gnomi' );
        $sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 8, 'language' => 'it' , 'attribute' =>  'race' , 'name' =>  'Troll' ,  'name_short' =>  'Troll' );
        $sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 10, 'language' => 'it' , 'attribute' =>  'race' , 'name' =>  'Elfi del Sangue' ,  'name_short' =>  'Elfi del Sangue' );
        $sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 11, 'language' => 'it' , 'attribute' =>  'race' , 'name' =>  'Draenei' ,  'name_short' =>  'Draenei' );
        $sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 9, 'language' => 'it' , 'attribute' =>  'race' , 'name' =>  'Goblin' ,  'name_short' =>  'Goblin' );
        $sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 22, 'language' => 'it' , 'attribute' =>  'race' , 'name' =>  'Worgen' ,  'name_short' =>  'Worgen' );
        $sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 25, 'language' => 'it' , 'attribute' =>  'race' , 'name' =>  'Pandaren Alleanza' ,  'name_short' =>  'Pandaren Alleanza' );
        $sql_ary[] = array('game_id' => $this->game_id , 'attribute_id' => 26, 'language' => 'it' , 'attribute' =>  'race' , 'name' =>  'Pandaren Orda' ,  'name_short' =>  'Pandaren Orda' );


		$db->sql_multi_insert ( BB_LANGUAGE , $sql_ary );
		unset ( $sql_ary );

	}

}
