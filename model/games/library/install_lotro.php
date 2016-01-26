<?php
/**
 * bbguild LOTRO install file
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
 * Lotro Installer class
 * @package bbdkp\bbguild\model\games\library
 */
class install_lotro extends GameInstall
{
    protected $bossbaseurl = 'http://lotro.allakhazam.com/db/bestiary.html?lotrmob=%s';
    protected $zonebaseurl = 'http://lotro.allakhazam.com/db/geography.html?lotrarea=%s';

    /**
	 * Installs factions
	 */
    protected function Installfactions()
	{
		global  $db;
		
		// factions
		$db->sql_query('DELETE FROM ' . FACTION_TABLE . " where game_id = '" . $this->game_id . "'" );
		$sql_ary = array();
		$sql_ary[] = array('game_id' => $this->game_id,'faction_id' => 1, 'faction_name' => 'Free Peoples' );
		$sql_ary[] = array('game_id' => $this->game_id,'faction_id' => 2, 'faction_name' => 'Servants of the Eye' );
		$db->sql_multi_insert( FACTION_TABLE, $sql_ary);
		unset ($sql_ary);
	}
	
	/**
	 * Installs game classes
	*/
    protected function InstallClasses()
	{
		global  $db;
		
		$db->sql_query('DELETE FROM ' . CLASS_TABLE . " where game_id = '" . $this->game_id . "'" );
		$sql_ary = array();
		
		// class :
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 0, 'class_armor_type' => 'MAIL' , 'class_min_level' => 1 , 'class_max_level'  => 75, 'colorcode' =>  '#999999', 'imagename' => 'lotro_unknown' );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 1, 'class_armor_type' => 'MAIL' , 'class_min_level' => 1 , 'class_max_level'  => 75, 'colorcode' =>  '#FF0044',  'imagename' => 'lotro_burglar'  );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 2, 'class_armor_type' => 'PLATE' , 'class_min_level' => 1 , 'class_max_level'  => 75, 'colorcode' =>  '#CC9933', 'imagename' => 'lotro_captain'  );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 3, 'class_armor_type' => 'PLATE' , 'class_min_level' => 1 , 'class_max_level'  => 75, 'colorcode' =>  '#FF0044',  'imagename' => 'lotro_champion'  );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 4, 'class_armor_type' => 'PLATE' , 'class_min_level' => 1 , 'class_max_level'  => 75, 'colorcode' =>  '#CC9933', 'imagename' => 'lotro_guardian'  );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 5, 'class_armor_type' => 'MAIL' , 'class_min_level' => 1 , 'class_max_level'  => 75,  'colorcode' =>  '#0077DD', 'imagename' => 'lotro_hunter'  );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 6, 'class_armor_type' => 'CLOTH' , 'class_min_level' => 1 , 'class_max_level'  => 75, 'colorcode' =>  '#CC00AA', 'imagename' => 'lotro_lore-master'  );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 7, 'class_armor_type' => 'CLOTH' , 'class_min_level' => 1 , 'class_max_level'  => 75, 'colorcode' =>  '#66FFCC', 'imagename' => 'lotro_minstrel'  );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 8, 'class_armor_type' => 'CLOTH' , 'class_min_level' => 1 , 'class_max_level'  => 75, 'colorcode' =>  '#66FFCC', 'imagename' => 'lotro_rune-keeper'  );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 9, 'class_armor_type' => 'MAIL' , 'class_min_level' => 1 , 'class_max_level'  => 75, 'colorcode' =>  '#FF0044',  'imagename' => 'lotro_warden');
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 20, 'class_armor_type' => 'MAIL' , 'class_min_level' => 75 , 'class_max_level'  => 75,  'colorcode' =>  '#FF0044', 'imagename' => 'lotro_reaver'  );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 21, 'class_armor_type' => 'CLOTH' , 'class_min_level' => 75 , 'class_max_level'  => 75, 'colorcode' =>  '#66FFCC', 'imagename' => 'lotro_defiler'  );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 22, 'class_armor_type' => 'CLOTH' , 'class_min_level' => 75 , 'class_max_level'  => 75, 'colorcode' =>  '#CC00AA', 'imagename' => 'lotro_weaver'  );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 23, 'class_armor_type' => 'MAIL' , 'class_min_level' => 75 , 'class_max_level'  => 75, 'colorcode'  =>  '#0077DD', 'imagename' => 'lotro_blackarrow'  );
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 24, 'class_armor_type' => 'PLATE' , 'class_min_level' => 75 , 'class_max_level'  => 75, 'colorcode' =>  '#CC9933',  'imagename' => 'lotro_warleader');
		$sql_ary[] = array('game_id' => $this->game_id,'class_id' => 25, 'class_armor_type' => 'MAIL' , 'class_min_level' => 75 , 'class_max_level'  => 75, 'colorcode' =>  '#FF0044',  'imagename' => 'lotro_stalker');
		
		$db->sql_multi_insert( CLASS_TABLE, $sql_ary);
		unset ($sql_ary);
		

		$db->sql_query('DELETE FROM ' . BB_LANGUAGE . "  where game_id = '" . $this->game_id . "' and attribute='class'  ");
		$sql_ary = array();
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 0, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Unknown' ,  'name_short' =>  'Unknown' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 1, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Burglar' ,  'name_short' =>  'Burglar' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 2, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Captain' ,  'name_short' =>  'Captain' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 3, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Champion' ,  'name_short' =>  'Champion' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 4, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Guardian' ,  'name_short' =>  'Guardian' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 5, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Hunter' ,  'name_short' =>  'Hunter' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 6, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Lore-master' ,  'name_short' =>  'Lore-master' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 7, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Minstrel' ,  'name_short' =>  'Minstrel' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 8, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Rune-keeper' ,  'name_short' =>  'Rune-keeper' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 9, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Warden' ,  'name_short' =>  'Warden' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 20, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Reaver' ,  'name_short' =>  'Reaver' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 21, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Defiler' ,  'name_short' =>  'Defiler' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 22, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Weaver' ,  'name_short' =>  'Weaver' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 23, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'BlackArrow' ,  'name_short' =>  'Blackarrow' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 24, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Warleader' ,  'name_short' =>  'Warleader' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 25, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Stalker' ,  'name_short' =>  'Stalker' );
		
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 0, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Unbekannt' ,  'name_short' =>  'Unbekannt' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 1, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Schurke' ,  'name_short' =>  'Schurke' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 2, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Hauptmann' ,  'name_short' =>  'Capitaine' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 3, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Waffenmeister' ,  'name_short' =>  'Champion' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 4, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Wächter' ,  'name_short' =>  'Guardien' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 5, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Jager' ,  'name_short' =>  'Chasseur' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 6, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Kundiger' ,  'name_short' =>  'Kundiger' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 7, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Barde' ,  'name_short' =>  'Barde' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 8, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Runenbewahrer' ,  'name_short' =>  'Runenbewahrer' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 9, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Hüter' ,  'name_short' =>  'Hüter' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 20, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Schnitter' ,  'name_short' =>  'Schnitter' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 21, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Defiler' ,  'name_short' =>  'Defiler' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 22, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Weberspinne' ,  'name_short' =>  'Weberspinne' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 23, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Schwarzpfeil' ,  'name_short' =>  'Schwarzpfeil' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 24, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Kriegsanführer' ,  'name_short' =>  'Kriegsanführer' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 25, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Pirscher' ,  'name_short' =>  'Pirscher' );
		
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 0, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Inconnu' ,  'name_short' =>  'Inconnu' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 1, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Cambrioleur' ,  'name_short' =>  'Cambrioleur' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 2, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Capitaine' ,  'name_short' =>  'Capitaine' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 3, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Champion' ,  'name_short' =>  'Champion' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 4, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Guardien' ,  'name_short' =>  'Guardien' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 5, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Chasseur' ,  'name_short' =>  'Chasseur' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 6, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Maitre du Savoir' ,  'name_short' =>  'Maitre du Savoir' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 7, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Ménestrel' ,  'name_short' =>  'Ménestrel' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 8, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Gardien des Rune' ,  'name_short' =>  'Gardien des Rune' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 9, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Sentinelle' ,  'name_short' =>  'Sentinelle' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 20, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Coupeur' ,  'name_short' =>  'Coupeur' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 21, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Defiler' ,  'name_short' =>  'Defiler' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 22, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Araignée' ,  'name_short' =>  'Araignée' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 23, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Flêche Noire' ,  'name_short' =>  'Flêche Noire' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 24, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Commandeur' ,  'name_short' =>  'Commandeur' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 25, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Malfrat' ,  'name_short' =>  'Malfrat' );

        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 0, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Unknown' ,  'name_short' =>  'Unknown' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 1, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Burglar' ,  'name_short' =>  'Burglar' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 2, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Captain' ,  'name_short' =>  'Captain' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 3, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Champion' ,  'name_short' =>  'Champion' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 4, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Guardian' ,  'name_short' =>  'Guardian' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 5, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Hunter' ,  'name_short' =>  'Hunter' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 6, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Lore-master' ,  'name_short' =>  'Lore-master' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 7, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Minstrel' ,  'name_short' =>  'Minstrel' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 8, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Rune-keeper' ,  'name_short' =>  'Rune-keeper' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 9, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Warden' ,  'name_short' =>  'Warden' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 20, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Reaver' ,  'name_short' =>  'Reaver' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 21, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Defiler' ,  'name_short' =>  'Defiler' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 22, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Weaver' ,  'name_short' =>  'Weaver' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 23, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'BlackArrow' ,  'name_short' =>  'Blackarrow' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 24, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Warleader' ,  'name_short' =>  'Warleader' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 25, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Stalker' ,  'name_short' =>  'Stalker' );


		$db->sql_multi_insert (  BB_LANGUAGE  , $sql_ary );
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
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 0, 'race_faction_id' => 1,  'image_female' => 'lotro_unknown',  'image_male' => 'lotro_unknown'  ); //Unknown
		
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 1, 'race_faction_id' => 1,  'image_female' => 'lotro_man',  'image_male' => 'lotro_man'  ); //Human
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 11, 'race_faction_id' => 1,  'image_female' => 'lotro_man_dalelands',  'image_male' => 'lotro_man_dalelands'  ); //Human of Dalelands
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 12, 'race_faction_id' => 1,  'image_female' => 'lotro_man_gondor',  'image_male' => 'lotro_man_gondor'  ); //Human of Gondor
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 13, 'race_faction_id' => 1,  'image_female' => 'lotro_man_rohan',  'image_male' => 'lotro_man_rohan'  ); //Human of Rohan
		
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 2, 'race_faction_id' => 1,  'image_female' => 'lotro_hobbit',  'image_male' => 'lotro_hobbit'  ); //Hobbit
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 21, 'race_faction_id' => 1,  'image_female' => 'lotro_hobbit_fallohide',  'image_male' => 'lotro_hobbit_fallohide'  ); //Hobbit Fallohide
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 22, 'race_faction_id' => 1,  'image_female' => 'lotro_hobbit_harfoot',  'image_male' => 'lotro_hobbit_harfoot'  ); //Hobbit Harfoot
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 23, 'race_faction_id' => 1,  'image_female' => 'lotro_hobbit_stoor',  'image_male' => 'lotro_hobbit_stoor'  ); //Hobbit Stoor
		
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 3, 'race_faction_id' => 1,  'image_female' => 'lotro_elf',  'image_male' => 'lotro_elf'  ); //Elf
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 31, 'race_faction_id' => 1,  'image_female' => 'lotro_elf_edhellond',  'image_male' => 'lotro_elf_edhellond'  ); //Elf Edhellond
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 32, 'race_faction_id' => 1,  'image_female' => 'lotro_elf_lindon',  'image_male' => 'lotro_elf_lindon'  ); //Elf Lindon
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 33, 'race_faction_id' => 1,  'image_female' => 'lotro_elf_lorien',  'image_male' => 'lotro_elf_lorien'  ); //Elf Lorien
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 34, 'race_faction_id' => 1,  'image_female' => 'lotro_elf_mirkwood',  'image_male' => 'lotro_elf_mirkwood'  ); //Elf Mirkwood
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 35, 'race_faction_id' => 1,  'image_female' => 'lotro_elf_rivendell',  'image_male' => 'lotro_elf_rivendell'  ); //Elf Rivendell
		
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 4, 'race_faction_id' => 1,  'image_female' => 'lotro_dwarf',  'image_male' => 'lotro_dwarf'  ); //Dwarf
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 41, 'race_faction_id' => 1,  'image_female' => 'lotro_dwarf_blue',  'image_male' => 'lotro_dwarf_blue'  ); //Dwarf Blue Mountains
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 42, 'race_faction_id' => 1,  'image_female' => 'lotro_dwarf_grey',  'image_male' => 'lotro_dwarf_grey'  ); //Dwarf Grey Mountains
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 43, 'race_faction_id' => 1,  'image_female' => 'lotro_dwarf_iron',  'image_male' => 'lotro_dwarf_iron'  ); //Dwarf Iron Hills
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 44, 'race_faction_id' => 1,  'image_female' => 'lotro_dwarf_lonely',  'image_male' => 'lotro_dwarf_lonely'  ); //Dwarf The Lonely Mountain
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 45, 'race_faction_id' => 1,  'image_female' => 'lotro_dwarf_white',  'image_male' => 'lotro_dwarf_white'  ); //Dwarf White Mountains
		
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 50, 'race_faction_id' => 2,  'image_female' => 'lotro_monster',  'image_male' => 'lotro_monster'  ); //Unknown
		
		$db->sql_multi_insert(  RACE_TABLE , $sql_ary);
		unset ($sql_ary);
		
		$db->sql_query('DELETE FROM ' . BB_LANGUAGE . "  where game_id = '" . $this->game_id . "' and attribute = 'race' ");
		$sql_ary = array();

		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 0, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Unknown' ,  'name_short' =>  'Unknown' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 1, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Man' ,  'name_short' =>  'Man' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 11, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Man of Dalelands' ,  'name_short' =>  'Dalelands' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 12, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Man of Gondor' ,  'name_short' =>  'Gondorian' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 13, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Man of Rohan' ,  'name_short' =>  'Rohirrim' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 2, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Hobbit' ,  'name_short' =>  'Hobbit' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 21, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Fallohide Hobbit' ,  'name_short' =>  'Fallohide' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 22, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Harfoot Hobbit' ,  'name_short' =>  'Harfoot' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 23, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Stoor Hobbit ' ,  'name_short' =>  'Stoor' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 3, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Elf' ,  'name_short' =>  'Elf' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 31, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Nandor Elf' ,  'name_short' =>  'Nandor' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 32, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Lorien Elf' ,  'name_short' =>  'Lorien' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 33, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Mirkwood Elf' ,  'name_short' =>  'Mirkwood' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 34, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Rivendell Elf' ,  'name_short' =>  'Rivendell' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 4, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Dwarf' ,  'name_short' =>  'Dwarf' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 41, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Blue Mountains Dwarf' ,  'name_short' =>  'Blue Mountains' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 42, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Grey Mountain Dwarf' ,  'name_short' =>  'Grey Mountains' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 43, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Iron Hill Dwarf' ,  'name_short' =>  'Iron Hills' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 44, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Lonely Mountain Dwarf' ,  'name_short' =>  'Lonely Montain' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 45, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'White Mountain Dwarf' ,  'name_short' =>  'White Mountain' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 50, 'language' =>  'en' , 'attribute' =>  'race' , 'name' =>  'Servant of the Eye' ,  'name_short' =>  'Servant of the Eye' );
		
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 1, 'language' =>  'de' , 'attribute' =>  'race' , 'name' =>  'Mensch' ,  'name_short' =>  'Mensch' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 11, 'language' =>  'de' , 'attribute' =>  'race' , 'name' =>  'Thallandmenschen' ,  'name_short' =>  'Thalland' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 12, 'language' =>  'de' , 'attribute' =>  'race' , 'name' =>  'Gondormensch' ,  'name_short' =>  'Gondor' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 13, 'language' =>  'de' , 'attribute' =>  'race' , 'name' =>  'Riddermark' ,  'name_short' =>  'Rohirrim' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 2, 'language' =>  'de' , 'attribute' =>  'race' , 'name' =>  'Hobbit' ,  'name_short' =>  'Hobbit' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 21, 'language' =>  'de' , 'attribute' =>  'race' , 'name' =>  'Falbhauthobbits' ,  'name_short' =>  'Falbhaut' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 22, 'language' =>  'de' , 'attribute' =>  'race' , 'name' =>  'Harfusshobbits' ,  'name_short' =>  'Harfuss' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 23, 'language' =>  'de' , 'attribute' =>  'race' , 'name' =>  'Starrenhobbit ' ,  'name_short' =>  'Starren' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 3, 'language' =>  'de' , 'attribute' =>  'race' , 'name' =>  'Elb' ,  'name_short' =>  'Elb' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 31, 'language' =>  'de' , 'attribute' =>  'race' , 'name' => 'Nandor Elben' ,  'name_short' =>  'Nandor' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 32, 'language' =>  'de' , 'attribute' =>  'race' , 'name' => 'Lorien Elben' ,  'name_short' =>  'Lorien' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 33, 'language' =>  'de' , 'attribute' =>  'race' , 'name' =>  'Waldelben' ,  'name_short' =>  'Düsterwald Elben' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 34, 'language' =>  'de' , 'attribute' =>  'race' , 'name' =>  'Rivendell Elben' ,  'name_short' =>  'Rivendell' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 4, 'language' =>  'de' , 'attribute' =>  'race' , 'name' =>   'Zwerg' ,  'name_short' =>  'Zwerg' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 41, 'language' =>  'de' , 'attribute' =>  'race' , 'name' =>  'Blaue Zwerge' ,  'name_short' =>  'Blauer Zwerge' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 42, 'language' =>  'de' , 'attribute' =>  'race' , 'name' =>  'Graue Zwerge' ,  'name_short' =>  'Graue Zwerge' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 43, 'language' =>  'de' , 'attribute' =>  'race' , 'name' =>  'Eisenzwerge' ,  'name_short' =>  'Eisenzwerg' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 44, 'language' =>  'de' , 'attribute' =>  'race' , 'name' =>  'Smaugzwergen' ,  'name_short' =>  'Einsamer Berg Zwergen' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 45, 'language' =>  'de' , 'attribute' =>  'race' , 'name' =>  'Weisse Zwergen' ,  'name_short' =>  'Weisse Zwergen' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 50, 'language' =>  'de' , 'attribute' =>  'race' , 'name' =>  'Böse Seite' ,  'name_short' =>  'Böse Seite' );
		
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 1, 'language' =>  'fr' , 'attribute' =>  'race' , 'name' =>  'Humain' ,  'name_short' =>  'Humain' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 2, 'language' =>  'fr' , 'attribute' =>  'race' , 'name' =>  'Hobbit' ,  'name_short' =>  'Hobbit' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 21, 'language' =>  'fr' , 'attribute' =>  'race' , 'name' =>  'Hobbits Pâles' ,  'name_short' =>  'Hobbits Pâles' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 22, 'language' =>  'fr' , 'attribute' =>  'race' , 'name' =>  'Hobbits Pieds Velus' ,  'name_short' =>  'Hobbits Pieds Velus' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 23, 'language' =>  'fr' , 'attribute' =>  'race' , 'name' =>  'Hobbits Forts' ,  'name_short' =>  'Hobbits Forts' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 3, 'language' =>  'fr' , 'attribute' =>  'race' , 'name' =>   'Elfe' ,  'name_short' =>  'Elfe' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 31, 'language' =>  'fr' , 'attribute' =>  'race' , 'name' =>  'Elfe d‘Edhollond' ,  'name_short' =>  'Elfe d‘Edhollond' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 32, 'language' =>  'fr' , 'attribute' =>  'race' , 'name' =>  'Elfe de Lorien' ,  'name_short' =>  'Elfe de Lorien' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 33, 'language' =>  'fr' , 'attribute' =>  'race' , 'name' =>  'Elfe de la forêt Noire' ,  'name_short' =>  'Forêt Noire' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 34, 'language' =>  'fr' , 'attribute' =>  'race' , 'name' =>  'Elfe de Rivendell' ,  'name_short' =>  'Rivendell' );
		
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 4, 'language' =>  'fr' , 'attribute' =>  'race' , 'name' =>  'Nain' ,  'name_short' =>  'Nain' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 41, 'language' =>  'fr' , 'attribute' =>  'race' , 'name' =>  'Nains bleus' ,  'name_short' =>  'Nains bleus' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 42, 'language' =>  'fr' , 'attribute' =>  'race' , 'name' =>  'Nains gris' ,  'name_short' =>  'Nain Gris' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 43, 'language' =>  'fr' , 'attribute' =>  'race' , 'name' =>  'Nains de fer' ,  'name_short' =>  'Nains de Fer' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 44, 'language' =>  'fr' , 'attribute' =>  'race' , 'name' =>  'Nains seuls' ,  'name_short' =>  'Nains seuls' );
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 45, 'language' =>  'fr' , 'attribute' =>  'race' , 'name' =>  'Nains blancs' ,  'name_short' =>  'Nains blancs' );
		
		$sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 50, 'language' =>  'fr' , 'attribute' =>  'race' , 'name' =>  'Serviteurs de l‘Oeil' ,  'name_short' =>  'Serviteurs de l‘Oeil' );

        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 0, 'language' =>  'it' , 'attribute' =>  'race' , 'name' =>  'Unknown' ,  'name_short' =>  'Unknown' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 1, 'language' =>  'it' , 'attribute' =>  'race' , 'name' =>  'Man' ,  'name_short' =>  'Man' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 11, 'language' =>  'it' , 'attribute' =>  'race' , 'name' =>  'Man of Dalelands' ,  'name_short' =>  'Dalelands' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 12, 'language' =>  'it' , 'attribute' =>  'race' , 'name' =>  'Man of Gondor' ,  'name_short' =>  'Gondorian' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 13, 'language' =>  'it' , 'attribute' =>  'race' , 'name' =>  'Man of Rohan' ,  'name_short' =>  'Rohirrim' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 2, 'language' =>  'it' , 'attribute' =>  'race' , 'name' =>  'Hobbit' ,  'name_short' =>  'Hobbit' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 21, 'language' =>  'it' , 'attribute' =>  'race' , 'name' =>  'Fallohide Hobbit' ,  'name_short' =>  'Fallohide' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 22, 'language' =>  'it' , 'attribute' =>  'race' , 'name' =>  'Harfoot Hobbit' ,  'name_short' =>  'Harfoot' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 23, 'language' =>  'it' , 'attribute' =>  'race' , 'name' =>  'Stoor Hobbit ' ,  'name_short' =>  'Stoor' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 3, 'language' =>  'it' , 'attribute' =>  'race' , 'name' =>  'Elf' ,  'name_short' =>  'Elf' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 31, 'language' =>  'it' , 'attribute' =>  'race' , 'name' =>  'Nandor Elf' ,  'name_short' =>  'Nandor' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 32, 'language' =>  'it' , 'attribute' =>  'race' , 'name' =>  'Lorien Elf' ,  'name_short' =>  'Lorien' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 33, 'language' =>  'it' , 'attribute' =>  'race' , 'name' =>  'Mirkwood Elf' ,  'name_short' =>  'Mirkwood' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 34, 'language' =>  'it' , 'attribute' =>  'race' , 'name' =>  'Rivendell Elf' ,  'name_short' =>  'Rivendell' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 4, 'language' =>  'it' , 'attribute' =>  'race' , 'name' =>  'Dwarf' ,  'name_short' =>  'Dwarf' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 41, 'language' =>  'it' , 'attribute' =>  'race' , 'name' =>  'Blue Mountains Dwarf' ,  'name_short' =>  'Blue Mountains' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 42, 'language' =>  'it' , 'attribute' =>  'race' , 'name' =>  'Grey Mountain Dwarf' ,  'name_short' =>  'Grey Mountains' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 43, 'language' =>  'it' , 'attribute' =>  'race' , 'name' =>  'Iron Hill Dwarf' ,  'name_short' =>  'Iron Hills' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 44, 'language' =>  'it' , 'attribute' =>  'race' , 'name' =>  'Lonely Mountain Dwarf' ,  'name_short' =>  'Lonely Montain' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 45, 'language' =>  'it' , 'attribute' =>  'race' , 'name' =>  'White Mountain Dwarf' ,  'name_short' =>  'White Mountain' );
        $sql_ary[] = array( 'game_id' => $this->game_id,'attribute_id' => 50, 'language' =>  'it' , 'attribute' =>  'race' , 'name' =>  'Servant of the Eye' ,  'name_short' =>  'Servant of the Eye' );

		$db->sql_multi_insert ( BB_LANGUAGE , $sql_ary );
		unset ( $sql_ary );
		
		
		
	}

}