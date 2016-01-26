<?php
/**
 * bbguild Guildwars2 install data
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
 * Guildwars2 Installer Class
 * @package bbdkp\bbguild\model\games\library
 */
class install_gw2 extends GameInstall
{
    protected $bossbaseurl = '';
    protected $zonebaseurl = '';

    /**
	 * Installs factions
	 */
    protected function Installfactions()
	{
		global  $db;
		
		// factions
		$db->sql_query('DELETE FROM ' . FACTION_TABLE . " where game_id = '" . $this->game_id . "'" );
		$sql_ary = array();
		$sql_ary [] = array ('game_id' => $this->game_id,'faction_id' => 1, 'faction_name' => 'Tyria' );
		$sql_ary [] = array ('game_id' => $this->game_id,'faction_id' => 2, 'faction_name' => 'Zaithan' );
		$db->sql_multi_insert ( FACTION_TABLE, $sql_ary );
		unset ( $sql_ary );
	}
	
	/**
	 * Installs game classes
	*/
    protected function InstallClasses()
	{
		global  $db;
		
		// professions
		$db->sql_query('DELETE FROM ' . CLASS_TABLE . " where game_id = '" . $this->game_id . "'" );
		$sql_ary = array ();
		//**Soldiers**
		$sql_ary [] = array ('game_id' => $this->game_id, 'class_id' => 0, 'class_faction_id' => 1, 'class_armor_type' => 'CLOTH', 'class_min_level' => 1, 'class_max_level' => 80 , 'colorcode' =>  '#222222', 'imagename' => 'gw2_unknown');
		//warrior
		$sql_ary [] = array ('game_id' => $this->game_id, 'class_id' => 1, 'class_faction_id' => 1, 'class_armor_type' => 'PLATE', 'class_min_level' => 1, 'class_max_level' => 80, 'colorcode' =>  '#FFAA44',  'imagename' => 'gw2_warrior');
		//Guardian
		$sql_ary [] = array ('game_id' => $this->game_id,'class_id' => 2, 'class_faction_id' => 1, 'class_armor_type' => 'PLATE', 'class_min_level' => 1, 'class_max_level' => 80 , 'colorcode' =>  '#006699',  'imagename' => 'gw2_guardian');
		//**Adventurers**
		//engineer
		$sql_ary [] = array ('game_id' => $this->game_id, 'class_id' => 3, 'class_faction_id' => 1, 'class_armor_type' => 'MAIL', 'class_min_level' => 1, 'class_max_level' => 80, 'colorcode' =>  '#B67721',  'imagename' => 'gw2_engineer');
		//ranger
		$sql_ary [] = array ('game_id' => $this->game_id,'class_id' => 4, 'class_faction_id' => 1, 'class_armor_type' => 'LEATHER', 'class_min_level' => 1, 'class_max_level' => 80 , 'colorcode' =>  '#00CC66', 'imagename' => 'gw2_ranger');
		//Thief
		$sql_ary [] = array ('game_id' => $this->game_id, 'class_id' => 5, 'class_faction_id' => 1, 'class_armor_type' => 'LEATHER', 'class_min_level' => 1, 'class_max_level' => 80, 'colorcode' =>  '#777777',  'imagename' => 'gw2_thief');
		//**Scholars**
		$sql_ary [] = array ('game_id' => $this->game_id,'class_id' => 6, 'class_faction_id' => 1, 'class_armor_type' => 'MAIL', 'class_min_level' => 1, 'class_max_level' => 80 ,  'colorcode' =>  '#BB0044',  'imagename' => 'gw2_elementalist');
		//Mesmer
		$sql_ary [] = array ('game_id' => $this->game_id,'class_id' => 7, 'class_faction_id' => 1, 'class_armor_type' => 'ROBE', 'class_min_level' => 1, 'class_max_level' => 80 , 'colorcode' =>  '#FF33DD',  'imagename' => 'gw2_mesmer');
		//Necromancer
		$sql_ary [] = array ('game_id' => $this->game_id,'class_id' => 8, 'class_faction_id' => 1, 'class_armor_type' => 'ROBE', 'class_min_level' => 1, 'class_max_level' => 80 ,  'colorcode' =>  '#00FF88',  'imagename' => 'gw2_necromancer');
		//Commando
		//$sql_ary [] = array ('game_id' => $this->game_id,'class_id' => 9, 'class_faction_id' => 1, 'class_armor_type' => 'HEAVY', 'class_min_level' => 1, 'class_max_level' => 80 ,  'colorcode' =>  '#0077BB',  'imagename' => 'gw2_comm');
		
		$db->sql_multi_insert ( CLASS_TABLE, $sql_ary );
		unset ( $sql_ary );
		
		// Dictionary
		$db->sql_query('DELETE FROM ' . BB_LANGUAGE . "  where game_id = '" . $this->game_id . "' and attribute = 'class'  ");
		$sql_ary = array ();
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 0, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Unknown' ,  'name_short' =>  'Unknown' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 1, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Warrior' ,  'name_short' =>  'Warrior' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 2, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Guardian' ,  'name_short' =>  'Guardian' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 3, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Engineer' ,  'name_short' =>  'Engineer' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 4, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Ranger' ,  'name_short' =>  'Ranger' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 5, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Thief' ,  'name_short' =>  'Thief' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 6, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Elementalist' ,  'name_short' =>  'Elementalist' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 7, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Mesmer' ,  'name_short' =>  'Mesmer' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 8, 'language' =>  'en' , 'attribute' =>  'class' , 'name' =>  'Necromancer' ,  'name_short' =>  'Necromancer' );

        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 0, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Inconnu' ,  'name_short' =>  'Inconnu' );
        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 1, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Guerrier' ,  'name_short' =>  'Guerrier' );
        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 2, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Gardien' ,  'name_short' =>  'Guardien' );
        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 3, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Ingénieur' ,  'name_short' =>  'Ingénieur' );
        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 4, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Rôdeur' ,  'name_short' =>  'Rôdeur' );
        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 5, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Voleur' ,  'name_short' =>  'Voleur' );
        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 6, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Élémentaliste' ,  'name_short' =>  'Élémentaliste' );
        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 7, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Envoûteur' ,  'name_short' =>  'Envoûteur' );
        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 8, 'language' =>  'fr' , 'attribute' =>  'class' , 'name' =>  'Nécromant' ,  'name_short' =>  'Nécromant' );

        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 0, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Unknown' ,  'name_short' =>  'Unknown' );
        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 1, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Warrior' ,  'name_short' =>  'Warrior' );
        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 2, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Guardian' ,  'name_short' =>  'Guardian' );
        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 3, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Engineer' ,  'name_short' =>  'Engineer' );
        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 4, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Ranger' ,  'name_short' =>  'Ranger' );
        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 5, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Thief' ,  'name_short' =>  'Thief' );
        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 6, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Elementalist' ,  'name_short' =>  'Elementalist' );
        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 7, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Mesmer' ,  'name_short' =>  'Mesmer' );
        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 8, 'language' =>  'de' , 'attribute' =>  'class' , 'name' =>  'Necromancer' ,  'name_short' =>  'Necromancer' );

        //http://www.tapugames.it/articles.php
        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 0, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Sconosciuto' ,  'name_short' =>  'Sconosciuto' );
        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 1, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Guerriero' ,  'name_short' =>  'Guerriero' );
        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 2, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Guardiano' ,  'name_short' =>  'Guardiano' );
        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 3, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Ingegnere' ,  'name_short' =>  'Ingegnere' );
        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 4, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Ranger' ,  'name_short' =>  'Ranger' );
        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 5, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Thief' ,  'name_short' =>  'Thief' );
        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 6, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Elementalist' ,  'name_short' =>  'Elementalist' );
        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 7, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Mesmer' ,  'name_short' =>  'Mesmer' );
        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 8, 'language' =>  'it' , 'attribute' =>  'class' , 'name' =>  'Necromancer' ,  'name_short' =>  'Necromancer' );

        $db->sql_multi_insert (  BB_LANGUAGE  , $sql_ary );
		unset ( $sql_ary );
	
	}
	
	/**
	 * Installs races
	*/
    protected function InstallRaces()
	{
		global  $db;

		$db->sql_query('DELETE FROM ' .  RACE_TABLE . "  where game_id = '" . $this->game_id . "'");
		$sql_ary = array ();
		//Unknown
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 0, 'race_faction_id' => 1, 'image_female' => 'gw2_unknown', 'image_male' => 'gw2_unknown'  );
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 1, 'race_faction_id' => 1, 'image_female' => 'gw2_sylvari',  'image_male' => 'gw2_sylvari' );
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 2, 'race_faction_id' => 1, 'image_female' => 'gw2_norn',  'image_male' => 'gw2_norn' );
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 3, 'race_faction_id' => 1, 'image_female' => 'gw2_charr',  'image_male' => 'gw2_charr' );
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 4, 'race_faction_id' => 1, 'image_female' => 'gw2_asura',  'image_male' => 'gw2_asura' ) ;
		$sql_ary [] = array ('game_id' => $this->game_id,'race_id' => 5, 'race_faction_id' => 1, 'image_female' => 'gw2_human',  'image_male' => 'gw2_human'  );
		$db->sql_multi_insert ( RACE_TABLE , $sql_ary);
		unset ( $sql_ary );

		$db->sql_query('DELETE FROM ' . BB_LANGUAGE . "  WHERE game_id = '" . $this->game_id . "' and attribute='race' ");
		$sql_ary = array();
		
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 0, 'language' => 'en' , 'attribute' =>  'race' , 'name' =>  'Unknown' ,  'name_short' =>  'Unknown' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 1, 'language' => 'en' , 'attribute' =>  'race' , 'name' =>  'Sylvari' ,  'name_short' =>  'Sylvari' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 2, 'language' => 'en' , 'attribute' =>  'race' , 'name' =>  'Norn' ,  'name_short' =>  'Norn' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 3, 'language' => 'en' , 'attribute' =>  'race' , 'name' =>  'Charr' ,  'name_short' =>  'Charr' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 4, 'language' => 'en' , 'attribute' =>  'race' , 'name' =>  'Asura' ,  'name_short' =>  'Asura' );
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 5, 'language' => 'en' , 'attribute' =>  'race' , 'name' =>  'Human' ,  'name_short' =>  'Human' );

        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 0, 'language' => 'fr' , 'attribute' =>  'race' , 'name' =>  'Inconnu' ,  'name_short' =>  'Inconnu' );
        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 1, 'language' => 'fr' , 'attribute' =>  'race' , 'name' =>  'Sylvari' ,  'name_short' =>  'Sylvari' );
        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 2, 'language' => 'fr' , 'attribute' =>  'race' , 'name' =>  'Norn' ,  'name_short' =>  'Norn' );
        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 3, 'language' => 'fr' , 'attribute' =>  'race' , 'name' =>  'Charr' ,  'name_short' =>  'Charr' );
        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 4, 'language' => 'fr' , 'attribute' =>  'race' , 'name' =>  'Asura' ,  'name_short' =>  'Asura' );
        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 5, 'language' => 'fr' , 'attribute' =>  'race' , 'name' =>  'Humain' ,  'name_short' =>  'Humain' );

        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 0, 'language' => 'de' , 'attribute' =>  'race' , 'name' =>  'Unbekannt' ,  'name_short' =>  'Unbekannt' );
        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 1, 'language' => 'de' , 'attribute' =>  'race' , 'name' =>  'Sylvari' ,  'name_short' =>  'Sylvari' );
        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 2, 'language' => 'de' , 'attribute' =>  'race' , 'name' =>  'Norn' ,  'name_short' =>  'Norn' );
        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 3, 'language' => 'de' , 'attribute' =>  'race' , 'name' =>  'Charr' ,  'name_short' =>  'Charr' );
        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 4, 'language' => 'de' , 'attribute' =>  'race' , 'name' =>  'Asura' ,  'name_short' =>  'Asura' );
        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 5, 'language' => 'de' , 'attribute' =>  'race' , 'name' =>  'Mensch' ,  'name_short' =>  'Mensch' );

        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 0, 'language' => 'it' , 'attribute' =>  'race' , 'name' =>  'Sconosciuto' ,  'name_short' =>  'Sconosciuto' );
        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 1, 'language' => 'it' , 'attribute' =>  'race' , 'name' =>  'Sylvari' ,  'name_short' =>  'Sylvari' );
        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 2, 'language' => 'it' , 'attribute' =>  'race' , 'name' =>  'Norn' ,  'name_short' =>  'Norn' );
        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 3, 'language' => 'it' , 'attribute' =>  'race' , 'name' =>  'Charr' ,  'name_short' =>  'Charr' );
        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 4, 'language' => 'it' , 'attribute' =>  'race' , 'name' =>  'Asura' ,  'name_short' =>  'Asura' );
        $sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 5, 'language' => 'it' , 'attribute' =>  'race' , 'name' =>  'Umani' ,  'name_short' =>  'Umani' );

        $db->sql_multi_insert (  BB_LANGUAGE  , $sql_ary );
		unset ( $sql_ary );
		
	}


    /**
     * installs GW2 game roles.
     * these are special
     */
    protected function InstallRoles()
    {

        global $db;

        $db->sql_query('DELETE FROM ' .  BB_GAMEROLE_TABLE . " WHERE role_id < 3 and game_id = '" . $this->game_id . "'");
        $db->sql_query('DELETE FROM ' .  BB_LANGUAGE . " WHERE attribute_id < 3 and  attribute = 'role' and game_id = '" . $this->game_id  . "'");

        $sql_ary = array(
            array(
                // Damage
                'game_id'  		   => $this->game_id ,
                'role_id'    	   => 0,
                'role_color'       => '#FF4455',
                'role_icon'    	   => 'dps_icon',
            ),
            array(
                // healer
                'game_id'  		   => $this->game_id ,
                'role_id'    	   => 1,
                'role_color'       => '#11FF77',
                'role_icon'    	   => 'healer_icon',
            ),
            array(
                // tank
                'game_id'  		   => $this->game_id ,
                'role_id'    	   => 2,
                'role_color'       => '#c3834c',
                'role_icon'    	   => 'tank_icon',
            ),
        );
        $db->sql_multi_insert(BB_GAMEROLE_TABLE, $sql_ary);

        $sql_ary = array(
            array(
                // dps
                'game_id'  		    => $this->game_id ,
                'attribute_id'    	=>  0,
                'language'          => 'en',
                'attribute'    	    => 'role',
                'name'    	        => 'Damage',
                'name_short'        => 'DPS',
            ),
            array(
                // healer
                'game_id'  		    => $this->game_id ,
                'attribute_id'    	=>  1,
                'language'          => 'en',
                'attribute'    	    => 'role',
                'name'    	        => 'Support',
                'name_short'        => 'Sup',
            ),
            array(
                // defense
                'game_id'  		    => $this->game_id ,
                'attribute_id'    	=>  2,
                'language'          => 'en',
                'attribute'    	    => 'role',
                'name'    	        => 'Control',
                'name_short'        => 'Con',
            ),
            array(
                // dps
                'game_id'  		    => $this->game_id ,
                'attribute_id'    	=>  0,
                'language'          => 'fr',
                'attribute'    	    => 'role',
                'name'    	        => 'Dégats',
                'name_short'        => 'DPS',
            ),
            array(
                // healer
                'game_id'  		    => $this->game_id ,
                'attribute_id'    	=> 1,
                'language'          => 'fr',
                'attribute'    	    => 'role',
                'name'    	        => 'Support',
                'name_short'        => 'Sup',
            ),
            array(
                // tank
                'game_id'  		    => $this->game_id ,
                'attribute_id'    	=> 2,
                'language'          => 'fr',
                'attribute'    	    => 'role',
                'name'    	        => 'Contrôle',
                'name_short'        => 'Con',
            ),
            array(
                // dps
                'game_id'  		    => $this->game_id ,
                'attribute_id'    	=> 0,
                'language'          => 'de',
                'attribute'    	    => 'role',
                'name'    	        => 'Kämpfer',
                'name_short'        => 'Schaden',
            ),
            array(
                // healer
                'game_id'  		    => $this->game_id ,
                'attribute_id'    	=>  1,
                'language'          => 'de',
                'attribute'    	    => 'role',
                'name'    	        => 'Stütz',
                'name_short'        => 'Stütz',
            ),
            array(
                // tank
                'game_id'  		    => $this->game_id ,
                'attribute_id'    	=>  2,
                'language'          => 'de',
                'attribute'    	    => 'role',
                'name'    	        => 'Kontrolle',
                'name_short'        => 'Kontrolle',
            ),
            array(
                // dps
                'game_id'  		    => $this->game_id ,
                'attribute_id'    	=> 0,
                'language'          => 'it',
                'attribute'    	    => 'role',
                'name'    	        => 'Danni',
                'name_short'        => 'Danni',
            ),
            array(
                // healer
                'game_id'  		    =>  $this->game_id ,
                'attribute_id'    	=> 1,
                'language'          => 'it',
                'attribute'    	    => 'role',
                'name'    	        => 'Supporto',
                'name_short'        => 'Supporto',
            ),
            array(
                // tank
                'game_id'  		    =>  $this->game_id ,
                'attribute_id'    	=>  2,
                'language'          => 'it',
                'attribute'    	    => 'role',
                'name'    	        => 'Controllo',
                'name_short'        => 'Controllo',
            ),
        );
        $db->sql_multi_insert(BB_LANGUAGE, $sql_ary);
    }
}
