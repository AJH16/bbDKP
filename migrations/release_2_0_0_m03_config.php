<?php
/**
 * bbDKP database installer
 *
 * @package bbguild v2.0
 * @copyright 2016 bbDKP <https://github.com/bbDKP>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace bbdkp\bbguild\migrations;
use phpbb\db\migration\migration;

/**
 * Migration stage 3: config data
 */
class release_2_0_0_m03_config extends migration
{

    protected $bbguild_version = '2.0.0-a1-dev';

    /**
     * Assign migration file dependencies for this migration
     *
     * @return array Array of migration files
     * @static
     * @access public
     */
    static public function depends_on()
    {
        return array('\bbdkp\bbguild\migrations\release_2_0_0_m02_data');
    }

    /**
     * Add or update data in the database
     *
     * @return array Array of table data
     * @access public
     */
    public function update_data()
    {
        $data_sets = array(
            array('config.add', array('bbguild_version', $this->bbguild_version )),
            array('config.add', array('bbguild_date_format', 'd.m.y')),
            array('config.add', array('bbguild_default_game', 'wow')),
            array('config.add', array('bbguild_default_realm', '')),
            array('config.add', array('bbguild_default_region', '')),
            array('config.add', array('bbguild_eqdkp_start', 1447196400)),
            // guildfaction : limit the possible races to be available to users to those available in the guild's chosen faction
            array('config.add', array('bbguild_guild_faction', 1)),
            array('config.add', array('bbguild_hide_inactive', 1)),
            array('config.add', array('bbguild_lang', 'en')),
            array('config.add', array('bbguild_maxchars', 5)),
            array('config.add', array('bbguild_minrosterlvl', 50)),
            array('config.add', array('bbguild_n_news', 5)),
            array('config.add', array('bbguild_news_forumid', 2)),
            array('config.add', array('bbguild_regid', 0)),
            // roster layout: main parameter for steering roster layout
            array('config.add', array('bbguild_roster_layout', 0)),
            // showachiev : show the achievement points
            array('config.add', array('bbguild_show_achiev', 0)),
            array('config.add', array('bbguild_user_llimit', 30)),
            array('config.add', array('bbguild_user_nlimit', 20)),
            // portal settings
            array('config.add', array('bbguild_portal_links', 1)),
            array('config.add', array('bbguild_portal_loot', 1)),
            array('config.add', array('bbguild_portal_maxnewplayers', 5)),
            array('config.add', array('bbguild_portal_menu', 1)),
            array('config.add', array('bbguild_portal_newplayers', 1)),
            array('config.add', array('bbguild_portal_onlineblockposition', 1)),
            array('config.add', array('bbguild_portal_recent', 1)),
            array('config.add', array('bbguild_portal_recruitments', 1)),
            array('config.add', array('bbguild_portal_rtlen', 15)),
            array('config.add', array('bbguild_portal_rtno', 5)),
            array('config.add', array('bbguild_portal_showedits', 1)),
            array('config.add', array('bbguild_portal_welcomemsg', 1)),
            array('config.add', array('bbguild_portal_whoisonline', 1)),

        );

        return $data_sets;
    }


}
