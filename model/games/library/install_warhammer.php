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
 * Warhammer installer class
 * @package bbdkp\bbguild\controller\games
 */
class install_warhammer extends GameInstall
{
    protected $bossbaseurl = ' ';
    protected $zonebaseurl = ' ';

    /**
	 * Installs factions
	 */
    protected function Installfactions()
	{
		global  $db;
		// factions
		unset ($sql_ary);
		$db->sql_query('DELETE FROM ' . FACTION_TABLE . " WHERE game_id = '" . $this->game_id . "'" );
		$sql_ary = array();
		$sql_ary[] = array('game_id' => $this->game_id,'faction_id' => 1, 'faction_name' => 'Order' );
		$sql_ary[] = array('game_id' => $this->game_id,'faction_id' => 2, 'faction_name' => 'Destruction' );
		$db->sql_multi_insert( FACTION_TABLE, $sql_ary);
	}
	
	/**
	 * Installs game classes
	*/
    protected function InstallClasses()
	{
		global  $db;
		
		$db->sql_query('DELETE FROM ' . CLASS_TABLE . " WHERE game_id = '" . $this->game_id . "'" );
		$sql_ary = array();
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 0, 'class_armor_type' => 'MAIL' , 'class_min_level' => 1 , 'class_max_level'  => 40,  'colorcode' =>  '#999', 'imagename' => 'warhammer_unknown' );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 1, 'class_armor_type' => 'MAIL' , 'class_min_level' => 1 , 'class_max_level'  => 40,   'colorcode' =>  '#FF0044','imagename' => 'warhammer_witch_Elf'  );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 2, 'class_armor_type' => 'CLOTH' , 'class_min_level' => 1 , 'class_max_level'  => 40, 'colorcode' =>  '#CC00BB', 'imagename' => 'warhammer_sorcerer'  );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 3, 'class_armor_type' => 'CLOTH' , 'class_min_level' => 1 , 'class_max_level'  => 40, 'colorcode' =>  '#32CD32', 'imagename' => 'warhammer_disciple_of_khaine'  );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 4, 'class_armor_type' => 'PLATE' , 'class_min_level' => 1 , 'class_max_level'  => 40,'colorcode' =>  '#CC9933', 'imagename' => 'warhammer_chosen'  );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 5, 'class_armor_type' => 'PLATE' , 'class_min_level' => 1 , 'class_max_level'  => 40,  'colorcode' =>  '#FF0044', 'imagename' => 'warhammer_marauder'  );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 6, 'class_armor_type' => 'CLOTH' , 'class_min_level' => 1 , 'class_max_level'  => 40, 'colorcode' =>  '#32CD32', 'imagename' => 'warhammer_zealot'  );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 7, 'class_armor_type' => 'CLOTH' , 'class_min_level' => 1 , 'class_max_level'  => 40, 'colorcode' =>  '#CC00BB', 'imagename' => 'warhammer_magus'  );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 8, 'class_armor_type' => 'MAIL' , 'class_min_level' => 1 , 'class_max_level'  => 40, 'colorcode' =>  '#CC00BB','imagename' => 'warhammer_squig_herder'  );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 9, 'class_armor_type' => 'PLATE' , 'class_min_level' => 1 , 'class_max_level'  => 40, 'colorcode' =>  '#CC9933', 'imagename' => 'warhammer_black_orc'  );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 10,'class_armor_type' => 'CLOTH' , 'class_min_level' => 1 , 'class_max_level'  => 40, 'colorcode' =>  '#32CD32', 'imagename' => 'warhammer_shaman'  );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 11, 'class_armor_type' => 'CLOTH' , 'class_min_level' => 1 , 'class_max_level'  => 40, 'colorcode' =>  '#32CD32',  'imagename' => 'warhammer_rune_priest'  );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 12, 'class_armor_type' => 'PLATE' , 'class_min_level' => 1 , 'class_max_level'  => 40, 'colorcode' =>  '#CC9933', 'imagename' => 'warhammer_iron_breaker'  );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 13, 'class_armor_type' => 'PLATE' , 'class_min_level' => 1 , 'class_max_level'  => 40, 'colorcode' =>  '#CC00BB', 'imagename' => 'warhammer_engineer'  );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 14, 'class_armor_type' => 'MAIL' , 'class_min_level' => 1 , 'class_max_level'  => 40,  'colorcode' =>  '#FF0044', 'imagename' => 'warhammer_witch_hunter'  );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 15, 'class_armor_type' => 'CLOTH' , 'class_min_level' => 1 , 'class_max_level'  => 40, 'colorcode' =>  '#CC00BB', 'imagename' => 'warhammer_bright_wizard'  );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 16, 'class_armor_type' => 'CLOTH' , 'class_min_level' => 1 , 'class_max_level'  => 40, 'colorcode' =>  '#32CD32', 'imagename' => 'warhammer_warrior_priest'  );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 17, 'class_armor_type' => 'CLOTH' , 'class_min_level' => 1 , 'class_max_level'  => 40, 'colorcode' =>  '#32CD32', 'imagename' => 'warhammer_archmage'  );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 18, 'class_armor_type' => 'PLATE' , 'class_min_level' => 1 , 'class_max_level'  => 40, 'colorcode' =>  '#CC9933', 'imagename' => 'warhammer_swordmaster'  );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 19, 'class_armor_type' => 'MAIL' , 'class_min_level' => 1 , 'class_max_level'  => 40,  'colorcode' =>  '#FF0044', 'imagename' => 'warhammer_shadow_warrior'  );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 20, 'class_armor_type' => 'PLATE' , 'class_min_level' => 1 , 'class_max_level'  => 40,  'colorcode' =>  '#FF0044', 'imagename' => 'warhammer_white_lion'  );
		$db->sql_multi_insert( CLASS_TABLE, $sql_ary);
		
		$db->sql_query('DELETE FROM ' . BB_LANGUAGE . "  WHERE game_id = '" . $this->game_id . "' AND attribute='class' ");
		unset ( $sql_ary );
		
		$sql_ary = array();
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 0, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Unknown' ,  'name_short' =>  'Unknown' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 1, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Witch Elf' ,  'name_short' =>  'Witch Elf' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 2, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Sorcerer' ,  'name_short' =>  'Sorcerer' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 3, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Disciple of Khaine' ,  'name_short' =>  'Disciple of Khaine' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 4, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Chosen' ,  'name_short' =>  'Chosen' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 5, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Marauder' ,  'name_short' =>  'Marauder' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 6, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Zealot' ,  'name_short' =>  'Zealot' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 7, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Magus' ,  'name_short' =>  'Magus' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 8, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Squig Herder' ,  'name_short' =>  'Squig Herder' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 9, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Black Orc' ,  'name_short' =>  'Black Orc' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 10, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Shaman' ,  'name_short' =>  'Shaman' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 11, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Rune Priest' ,  'name_short' =>  'Rune Priest' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 12, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Iron Breaker' ,  'name_short' =>  'Iron Breaker' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 13, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Engineer' ,  'name_short' =>  'Engineer' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 14, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Witch Hunter' ,  'name_short' =>  'Witch Hunter' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 15, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Bright Wizard' ,  'name_short' =>  'Bright Wizard' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 16, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Warrior Priest' ,  'name_short' =>  'Warrior Priest' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 17, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Archmage' ,  'name_short' =>  'Archmage' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 18, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Swordmaster' ,  'name_short' =>  'Swordmaster' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 19, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Shadow Warrior' ,  'name_short' =>  'Shadow Warrior' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 20, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'White Lion' ,  'name_short' =>  'White Lion' );
		
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 0, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Unknown' ,  'name_short' =>  'Unknown' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 1, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Witch Elf' ,  'name_short' =>  'Witch Elf' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 2, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Sorcerer' ,  'name_short' =>  'Sorcerer' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 3, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Disciple of Khaine' ,  'name_short' =>  'Disciple of Khaine' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 4, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Chosen' ,  'name_short' =>  'Chosen' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 5, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Marauder' ,  'name_short' =>  'Marauder' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 6, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Zealot' ,  'name_short' =>  'Zealot' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 7, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Magus' ,  'name_short' =>  'Magus' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 8, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Squig Herder' ,  'name_short' =>  'Squig Herder' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 9, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Black Orc' ,  'name_short' =>  'Black Orc' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 10, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Shaman' ,  'name_short' =>  'Shaman' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 11, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Rune Priest' ,  'name_short' =>  'Rune Priest' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 12, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Iron Breaker' ,  'name_short' =>  'Iron Breaker' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 13, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Engineer' ,  'name_short' =>  'Engineer' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 14, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Witch Hunter' ,  'name_short' =>  'Witch Hunter' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 15, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Bright Wizard' ,  'name_short' =>  'Bright Wizard' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 16, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Warrior Priest' ,  'name_short' =>  'Warrior Priest' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 17, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Archmage' ,  'name_short' =>  'Archmage' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 18, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Swordmaster' ,  'name_short' =>  'Swordmaster' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 19, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Shadow Warrior' ,  'name_short' =>  'Shadow Warrior' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 20, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'White Lion' ,  'name_short' =>  'White Lion' );


        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 0, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Unknown' ,  'name_short' =>  'Unknown' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 1, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Witch Elf' ,  'name_short' =>  'Witch Elf' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 2, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Sorcerer' ,  'name_short' =>  'Sorcerer' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 3, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Disciple of Khaine' ,  'name_short' =>  'Disciple of Khaine' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 4, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Chosen' ,  'name_short' =>  'Chosen' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 5, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Marauder' ,  'name_short' =>  'Marauder' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 6, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Zealot' ,  'name_short' =>  'Zealot' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 7, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Magus' ,  'name_short' =>  'Magus' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 8, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Squig Herder' ,  'name_short' =>  'Squig Herder' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 9, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Black Orc' ,  'name_short' =>  'Black Orc' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 10, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Shaman' ,  'name_short' =>  'Shaman' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 11, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Rune Priest' ,  'name_short' =>  'Rune Priest' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 12, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Iron Breaker' ,  'name_short' =>  'Iron Breaker' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 13, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Engineer' ,  'name_short' =>  'Engineer' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 14, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Witch Hunter' ,  'name_short' =>  'Witch Hunter' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 15, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Bright Wizard' ,  'name_short' =>  'Bright Wizard' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 16, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Warrior Priest' ,  'name_short' =>  'Warrior Priest' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 17, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Archmage' ,  'name_short' =>  'Archmage' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 18, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Swordmaster' ,  'name_short' =>  'Swordmaster' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 19, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Shadow Warrior' ,  'name_short' =>  'Shadow Warrior' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 20, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'White Lion' ,  'name_short' =>  'White Lion' );

        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 0, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Unknown' ,  'name_short' =>  'Unknown' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 1, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Witch Elf' ,  'name_short' =>  'Witch Elf' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 2, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Sorcerer' ,  'name_short' =>  'Sorcerer' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 3, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Disciple of Khaine' ,  'name_short' =>  'Disciple of Khaine' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 4, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Chosen' ,  'name_short' =>  'Chosen' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 5, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Marauder' ,  'name_short' =>  'Marauder' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 6, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Zealot' ,  'name_short' =>  'Zealot' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 7, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Magus' ,  'name_short' =>  'Magus' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 8, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Squig Herder' ,  'name_short' =>  'Squig Herder' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 9, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Black Orc' ,  'name_short' =>  'Black Orc' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 10, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Shaman' ,  'name_short' =>  'Shaman' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 11, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Rune Priest' ,  'name_short' =>  'Rune Priest' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 12, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Iron Breaker' ,  'name_short' =>  'Iron Breaker' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 13, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Engineer' ,  'name_short' =>  'Engineer' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 14, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Witch Hunter' ,  'name_short' =>  'Witch Hunter' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 15, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Bright Wizard' ,  'name_short' =>  'Bright Wizard' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 16, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Warrior Priest' ,  'name_short' =>  'Warrior Priest' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 17, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Archmage' ,  'name_short' =>  'Archmage' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 18, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Swordmaster' ,  'name_short' =>  'Swordmaster' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 19, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Shadow Warrior' ,  'name_short' =>  'Shadow Warrior' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 20, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'White Lion' ,  'name_short' =>  'White Lion' );

		$db->sql_multi_insert ( BB_LANGUAGE , $sql_ary );
		unset ( $sql_ary );
	}
	
	/**
	 * Installs races
	*/
    protected function InstallRaces()
	{
		
		global  $db;
		
		$db->sql_query('DELETE FROM ' .  RACE_TABLE . "  WHERE game_id = '" . $this->game_id . "'");
		$sql_ary = array();
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 0, 'race_faction_id' => 1,  'image_female' => ' ',  'image_male' => ' '  ); //Unknown
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 1, 'race_faction_id' => 1,  'image_female' => 'warhammer_dwarf',  'image_male' => 'warhammer_dwarf'  ); //Dwarf
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 2, 'race_faction_id' => 1 , 'image_female' => 'warhammer_empire',  'image_male' => 'warhammer_empire' ); ///The Empire'
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 3, 'race_faction_id' => 1 , 'image_female' => 'warhammer_highelves',  'image_male' => 'warhammer_highelves' ); ///High Elves
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 4, 'race_faction_id' => 2 , 'image_female' => 'warhammer_delves',  'image_male' => 'warhammer_delves' ) ; //Dark Elf
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 5, 'race_faction_id' => 2 , 'image_female' => 'warhammer_chaos',  'image_male' => 'warhammer_chaos' ); //chaos
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 6, 'race_faction_id' => 2 , 'image_female' => 'warhammer_greenskin',  'image_male' => 'warhammer_greenskin' ); //Greenskins
		 
		$db->sql_multi_insert(  RACE_TABLE , $sql_ary);
		
		$db->sql_query('DELETE FROM ' . BB_LANGUAGE . "  WHERE game_id = '" . $this->game_id . "' AND attribute = 'race' ");
		unset ( $sql_ary );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 0, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Unknown' ,  'name_short' =>  'Unknown' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 1, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Dwarf' ,  'name_short' =>  'Dwarf' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 2, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'The Empire' ,  'name_short' =>  'The Empire' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 3, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'High Elves' ,  'name_short' =>  'High Elves' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 4, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Dark Elves' ,  'name_short' =>  'Dark Elves' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 5, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Chaos' ,  'name_short' =>  'Chaos' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 6, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Greenskins' ,  'name_short' =>  'Greenskins' );
			
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 0, 'language' =>  'fr' , 'attribute' =>  'race' , 'name' =>  'Unknown' ,  'name_short' =>  'Unknown' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 1, 'language' =>  'fr' , 'attribute' =>  'race' , 'name' =>  'Dwarf' ,  'name_short' =>  'Dwarf' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 2, 'language' =>  'fr' , 'attribute' =>  'race' , 'name' =>  'The Empire' ,  'name_short' =>  'The Empire' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 3, 'language' =>  'fr' , 'attribute' =>  'race' , 'name' =>  'High Elves' ,  'name_short' =>  'High Elves' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 4, 'language' =>  'fr' , 'attribute' =>  'race' , 'name' =>  'Dark Elves' ,  'name_short' =>  'Dark Elves' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 5, 'language' =>  'fr' , 'attribute' =>  'race' , 'name' =>  'Chaos' ,  'name_short' =>  'Chaos' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 6, 'language' =>  'fr' , 'attribute' =>  'race' , 'name' =>  'Greenskins' ,  'name_short' =>  'Greenskins' );

        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 0, 'language' =>  'de' , 'attribute' =>  'race' , 'name' =>  'Unknown' ,  'name_short' =>  'Unknown' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 1, 'language' =>  'de' , 'attribute' =>  'race' , 'name' =>  'Dwarf' ,  'name_short' =>  'Dwarf' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 2, 'language' =>  'de' , 'attribute' =>  'race' , 'name' =>  'The Empire' ,  'name_short' =>  'The Empire' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 3, 'language' =>  'de' , 'attribute' =>  'race' , 'name' =>  'High Elves' ,  'name_short' =>  'High Elves' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 4, 'language' =>  'de' , 'attribute' =>  'race' , 'name' =>  'Dark Elves' ,  'name_short' =>  'Dark Elves' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 5, 'language' =>  'de' , 'attribute' =>  'race' , 'name' =>  'Chaos' ,  'name_short' =>  'Chaos' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 6, 'language' =>  'de' , 'attribute' =>  'race' , 'name' =>  'Greenskins' ,  'name_short' =>  'Greenskins' );

        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 0, 'language' =>  'it' , 'attribute' =>  'race' , 'name' =>  'Unknown' ,  'name_short' =>  'Unknown' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 1, 'language' =>  'it' , 'attribute' =>  'race' , 'name' =>  'Dwarf' ,  'name_short' =>  'Dwarf' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 2, 'language' =>  'it' , 'attribute' =>  'race' , 'name' =>  'The Empire' ,  'name_short' =>  'The Empire' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 3, 'language' =>  'it' , 'attribute' =>  'race' , 'name' =>  'High Elves' ,  'name_short' =>  'High Elves' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 4, 'language' =>  'it' , 'attribute' =>  'race' , 'name' =>  'Dark Elves' ,  'name_short' =>  'Dark Elves' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 5, 'language' =>  'it' , 'attribute' =>  'race' , 'name' =>  'Chaos' ,  'name_short' =>  'Chaos' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 6, 'language' =>  'it' , 'attribute' =>  'race' , 'name' =>  'Greenskins' ,  'name_short' =>  'Greenskins' );

		$db->sql_multi_insert ( BB_LANGUAGE , $sql_ary );
		unset ( $sql_ary );
	}


    

}
