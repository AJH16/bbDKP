<?php
/**
 * bbDKP database installer
 *
 * @package bbdkp v2.0
 * @copyright 2015 bbdkp <https://github.com/bbDKP>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace bbdkp\bbguild\migrations;
use phpbb\db\migration\container_aware_migration;

/**
 * Migration stage 2: Initial data
 */
class release_2_0_0_m02_data extends container_aware_migration
{
    protected $guild_table;
    protected $player_ranks_table;
    protected $bb_gamerole_table;
    protected $bb_language;
    protected $welcome_msg_table;

    protected $bbgames_table;
    protected $news_table;
    protected $bblogs_table;
    protected $player_list_table;
    protected $class_table;
    protected $race_table;
    protected $faction_table;
    protected $bbrecruit_table;
    protected $plugins_table;


    static public function depends_on()
    {
        return array('\bbdkp\bbguild\migrations\release_2_0_0_m01_schema');
    }

    public function update_data()
    {
        return array(
            array('custom', array(array($this, 'insert_sample_data'))),
        );
    }

    /**
     * populate with staring data.
     */
    /**
     * populate with starting data.
     */
    public function insert_sample_data()
    {
        $user = $this->container->get('user');
        $user->add_lang_ext('bbdkp/bbguild', 'admin');
        $welcome_message = $this->encode_message($user->lang['WELCOME_DEFAULT']);

        $this->bbgames_table = $this->table_prefix  . 'bb_games';
        $this->news_table = $this->table_prefix  . 'bb_news';
        $this->bblogs_table = $this->table_prefix  . 'bb_logs';
        $this->player_ranks_table = $this->table_prefix  . 'bb_ranks';
        $this->guild_table = $this->table_prefix  . 'bb_guild';
        $this->welcome_msg_table = $this->table_prefix  . 'bb_welcomemsg';
        $this->bb_gamerole_table = $this->table_prefix  . 'bb_gameroles';
        $this->bb_language = $this->table_prefix  . 'bb_language';

        $guildless = array(
            array(
                'id'	        => 0,
                'name'          => 'Guildless',
                'realm'         => 'default',
                'region'        => 'us',
                'battlegroup'   => ' ',
                'roster'        =>  0,
                'aion_legion_id'    => 0,
                'aion_server_id'    => 0,
                'level'             => 0,
                'players'           => 0,
                'achievementpoints' =>  0,
                'guildarmoryurl'    => '',
                'emblemurl'         => '',
                'game_id'           => 'wow',
                'min_armory'        => 0,
                'rec_status'        => 0,
                'guilddefault'      => 0,
                'armory_enabled'    => 0,
                'armoryresult'      => '',
                'recruitforum'      => 0,
            )
        );

        if ( $this->db_tools->sql_table_exists($this->guild_table))
        {
            $this->db->sql_multi_insert($this->guild_table, $guildless);
        }

        $outrank = array(
            array(
                'guild_id'	    => 0,
                'rank_id'	    => 99,
                'rank_name'	    => 'Out',
                'rank_hide'	    => 1,
                'rank_prefix'	=> '',
                'rank_suffix'	=> '',
            ));

        if ( $this->db_tools->sql_table_exists($this->player_ranks_table))
        {
            $this->db->sql_multi_insert($this->player_ranks_table, $outrank);
        }

        $welcome = array(
            array(
                'welcome_title' => 'Welcome to our guild',
                'welcome_timestamp' => (int) time(),
                'welcome_msg' => $welcome_message['text'],
                'bbcode_uid' => $welcome_message['uid'],
                'bbcode_bitfield' => $welcome_message['bitfield'],
                'user_id' => $user->data['user_id']
            )
        );

        if ( $this->db_tools->sql_table_exists($this->welcome_msg_table))
        {
            $this->db->sql_multi_insert($this->welcome_msg_table, $welcome);
        }

        /*standard game roles */
        $game_id = 'wow';
        $i=0;
        $Standardoles= array(
            array(
                // dps
                'game_id'          => $game_id,
                'role_id'          => $i,
                'role_color'       => '#FF4455',
                'role_icon'        => 'dps_icon',
            ),
            array(
                // healer
                'game_id'          => $game_id,
                'role_id'          => $i+1,
                'role_color'       => '#11FF77',
                'role_icon'        => 'healer_icon',
            ),
            array(
                // tank
                'game_id'          => $game_id,
                'role_id'          => $i+2,
                'role_color'       => '#c3834c',
                'role_icon'        => 'tank_icon',
            ),

        );

        if ( $this->db_tools->sql_table_exists($this->bb_gamerole_table))
        {
            $this->db->sql_multi_insert($this->bb_gamerole_table, $Standardoles);
        }


        /* language strings for these roles */

        $rolelangs = array(
            array(
                // dps
                'game_id'           => $game_id,
                'attribute_id'      => $i,
                'language'          => 'en',
                'attribute'         => 'role',
                'name'              => 'Damage',
                'name_short'        => 'DPS',
            ),
            array(
                // healer
                'game_id'           => $game_id,
                'attribute_id'      => $i+1,
                'language'          => 'en',
                'attribute'         => 'role',
                'name'              => 'Healer',
                'name_short'        => 'HPS',
            ),
            array(
                // defense
                'game_id'           => $game_id,
                'attribute_id'      => $i+2,
                'language'          => 'en',
                'attribute'         => 'role',
                'name'              => 'Defense',
                'name_short'        => 'DEF',
            ),
            array(
                // dps
                'game_id'           => $game_id,
                'attribute_id'      => $i,
                'language'          => 'fr',
                'attribute'         => 'role',
                'name'              => 'Dégats',
                'name_short'        => 'DPS',
            ),
            array(
                // healer
                'game_id'           => $game_id,
                'attribute_id'      => $i+1,
                'language'          => 'fr',
                'attribute'         => 'role',
                'name'              => 'Soigneur',
                'name_short'        => 'HPS',
            ),
            array(
                // tank
                'game_id'           => $game_id,
                'attribute_id'      => $i+2,
                'language'          => 'fr',
                'attribute'         => 'role',
                'name'              => 'Défense',
                'name_short'        => 'DEF',
            ),
            array(
                // dps
                'game_id'           => $game_id,
                'attribute_id'      => $i,
                'language'          => 'de',
                'attribute'         => 'role',
                'name'              => 'Kämpfer',
                'name_short'        => 'Schaden',
            ),
            array(
                // healer
                'game_id'           => $game_id,
                'attribute_id'      => $i+1,
                'language'          => 'de',
                'attribute'         => 'role',
                'name'              => 'Heiler',
                'name_short'        => 'Heil',
            ),
            array(
                // tank
                'game_id'           => $game_id,
                'attribute_id'      => $i+2,
                'language'          => 'de',
                'attribute'         => 'role',
                'name'              => 'Verteidigung',
                'name_short'        => 'Schutz',
            ),
            array(
                // dps
                'game_id'           => $game_id,
                'attribute_id'      => $i,
                'language'          => 'it',
                'attribute'         => 'role',
                'name'              => 'Danni',
                'name_short'        => 'Danni',
            ),
            array(
                // healer
                'game_id'           => $game_id,
                'attribute_id'      => $i+1,
                'language'          => 'it',
                'attribute'         => 'role',
                'name'              => 'Cura',
                'name_short'        => 'Cura',
            ),
            array(
                // tank
                'game_id'           => $game_id,
                'attribute_id'      => $i+2,
                'language'          => 'it',
                'attribute'         => 'role',
                'name'              => 'Difeza',
                'name_short'        => 'Tank',
            ),

        );

        if ( $this->db_tools->sql_table_exists($this->bb_language))
        {
            $this->db->sql_multi_insert($this->bb_language, $rolelangs);
        }

    }

    /**
     * encode welcome text
     *
     * @param string $text
     * @return array
     * @package bbdkp
     */
    private function encode_message($text)
    {
        $uid = $bitfield = $options = ''; // will be modified by generate_text_for_storage
        $allow_bbcode = $allow_urls = $allow_smilies = true;
        generate_text_for_storage($text, $uid, $bitfield, $options, $allow_bbcode, $allow_urls, $allow_smilies);
        $welcome_message['text']=$text;
        $welcome_message['uid']=$uid;
        $welcome_message['bitfield']=$bitfield;
        return $welcome_message;
    }

}
