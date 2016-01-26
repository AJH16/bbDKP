<?php
/**
 * bbGuild Mainpage ACP
 *
 * @package bbguild v2.0
 * @copyright 2016 bbDKP <https://github.com/bbDKP>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 */

namespace bbdkp\bbguild\acp;

use bbdkp\bbguild\model\admin\Admin;
use bbdkp\bbguild\model\admin\log;

class main_module extends Admin
{
    public $u_action;
    private $link;

    /** @var \phpbb\request\request **/
    protected $request;
    /** @var \phpbb\template\template **/
    protected $template;
    /** @var \phpbb\user **/
    protected $user;
    /** @var \phpbb\db\driver\driver_interface */
    protected $db;

    public $id;
    public $mode;

    /**
     * @param $id
     * @param $mode
     */
    function main ($id, $mode)
    {
        global $db, $user, $template, $request, $phpbb_admin_path, $cache;
        global $config, $phpEx, $phpbb_container;

        $this->id = $id;
        $this->mode = $mode;
        $this->request=$request;
        $this->template=$template;
        $this->user=$user;
        $this->db=$db;

        parent::__construct();

        $form_key = 'bbdkp/bbguild';
        add_form_key($form_key);
        $this->page_title = 'ACP_BBGUILD_MAINPAGE';
        $this->tpl_name = 'acp_' . $mode;
        $this->link = '<br /><a href="' . append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\main_module') . '"><h3>' . $this->user->lang['ACP_BBGUILD'] . '</h3></a>';

        switch ($mode)
        {
            // MAINPAGE
            case 'panel':
                // get inactive players
                $sql = 'SELECT count(*) as player_count FROM ' . PLAYER_LIST_TABLE . " WHERE player_status='0'";
                $result = $this->db->sql_query($sql);
                $total_players_inactive = (int) $this->db->sql_fetchfield('player_count');
                //get the active players
                $sql = 'SELECT count(*) as player_count FROM ' . PLAYER_LIST_TABLE . " WHERE player_status='1'";
                $result = $this->db->sql_query($sql);
                $total_players_active = (int) $this->db->sql_fetchfield('player_count');
                // active player kpi
                $total_players = $total_players_active . ' / ' . $total_players_inactive;
                //number of guilds
                $sql = 'SELECT count(*) as guild_count  FROM ' . GUILD_TABLE;
                $result = $this->db->sql_query($sql);
                $total_guildcount = (int) $this->db->sql_fetchfield('guild_count');
                //start date
                if ($config['bbguild_eqdkp_start'] != 0)
                {
                    $bbguild_started = date($config['bbguild_date_format'], $config['bbguild_eqdkp_start']);
                }
                else
                {
                    $bbguild_started = '';
                }

                $latest_version_info = parent::get_productversion($this->request->variable('versioncheck_force', false));
                if ($latest_version_info === false)
                {
                    $this->template->assign_var('S_VERSIONCHECK_FAIL', true);
                }
                else
                {
                    if(phpbb_version_compare($latest_version_info, BBGUILD_VERSION, '='))
                    {
                        $this->template->assign_vars(array(
                            'S_VERSION_UP_TO_DATE'	=> true,
                        ));
                    }
                    elseif(phpbb_version_compare($latest_version_info, BBGUILD_VERSION, '>'))
                    {
                        // you have an old version
                        $this->template->assign_vars(array(
                            'BBGUILD_NOT_UP_TO_DATE_TITLE' => sprintf($this->user->lang['NOT_UP_TO_DATE_TITLE'], 'bbGuild'),
                            'S_PRERELEASE'	=> false,
                            'BBGUILD_LATESTVERSION' => $latest_version_info,
                            'BBGUILDVERSION' => $this->user->lang['BBGUILD_YOURVERSION'] . BBGUILD_VERSION ,
                            'UPDATEINSTR' => $this->user->lang['BBGUILD_LATESTVERSION'] . $latest_version_info . ', <a href="' . $this->user->lang['WEBURL'] . '">' . $this->user->lang['DOWNLOAD'] . '</a>'));

                    }
                    else
                    {
                        // you have a prerelease or development version
                        $this->template->assign_vars(array(
                            'BBGUILD_NOT_UP_TO_DATE_TITLE' => sprintf($this->user->lang['PRELELEASE_TITLE'], 'bbGuild'),
                            'BBGUILD_LATESTVERSION' => $latest_version_info,
                            'S_PRERELEASE'	=> true,
                            'BBGUILDVERSION' => $this->user->lang['BBGUILD_YOURVERSION'] . BBGUILD_VERSION ,
                            'UPDATEINSTR' => $this->user->lang['BBGUILD_LATESTVERSION'] . $latest_version_info . ', <a href="' . $this->user->lang['WEBURL'] . '">' . $this->user->lang['DOWNLOAD'] . '</a>'));
                    }
                }

                // read verbose log
                $logs = log::Instance();
                $listlogs = $logs->read_log('', false, true, '', '');
                if(isset($listlogs))
                {
                    foreach ($listlogs as $key => $log)
                    {
                        $this->template->assign_block_vars('actions_row', array(
                            'U_VIEW_LOG' 	=> append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\main_module&amp;mode=logs&amp;' . URI_LOG . '=' . $log['log_id']  ) ,
                            'LOGDATE' 		=> $log['datestamp'],
                            'ACTION' 		=> $log['log_line'],
                        ));
                    }
                }

                //LOOP PLUGINS TABLE
                $plugins_installed = 0;
                $plugin_versioninfo = (array) parent::get_plugin_info($this->request->variable('versioncheck_force', false));
                foreach($plugin_versioninfo as $pname => $pdetails)
                {
                    $a = phpbb_version_compare(trim( $pdetails['latest'] ), $pdetails['version'] , '<=');
                    $this->template->assign_block_vars('plugin_row', array(
                        'PLUGINNAME' 	=> ucwords($pdetails['name']) ,
                        'VERSION' 		=> $pdetails['version'] ,
                        'ISUPTODATE'	=> phpbb_version_compare(trim( $pdetails['latest'] ), $pdetails['version'] , '<=') ,
                        'LATESTVERSION' => $pdetails['latest'] ,
                        'UPDATEINSTR' 	=> '<a href="' . BBDKP_PLUGINURL . '">' . $this->user->lang['DOWNLOAD_LATEST_PLUGINS'] . $pdetails['latest'] . '</a>',
                        'INSTALLDATE' 	=> $pdetails['installdate'],
                    ));
                    $plugins_installed +=1;
                }

                $this->template->assign_vars(array(
                    'GLYPH' => $this->ext_path . "adm/images/glyphs/view.gif" ,
                    'NUMBER_OF_PLAYERS' => $total_players ,
                    'NUMBER_OF_GUILDS' => $total_guildcount ,
                    'BBGUILD_STARTED' => $bbguild_started,
                    'BBGUILD_VERSION'	=> BBGUILD_VERSION,
                    'U_VERSIONCHECK_FORCE' => append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\main_module&amp;mode=panel&amp;versioncheck_force=1'),
                    'GAMES_INSTALLED' => count($this->games) > 0 ? implode(", ", $this->games) : $this->user->lang['NA'],
                    'PLUGINS_INSTALLED' => $plugins_installed,
                ));
                break;

            /**
             *
             * DKP CONFIG
             */
            case 'config':

                if ($this->request->is_set_post('register'))
                {
                    $regdata = array(
                        'domainname'	=> $config['server_name'],
                        'phpbbversion'	=> $this->request->variable('phpbbversion', ''),
                        'bbguildversion' 	=> $this->request->variable('bbguildversion', ''),
                    );
                    $this->post_register_request($regdata);
                }

                if ($this->request->is_set_post('updateconfig'))
                {
                    if (! check_form_key('acp_dkp'))
                    {
                        trigger_error($this->user->lang['FV_FORMVALIDATION'], E_USER_WARNING);
                    }
                    $day = $this->request->variable('bbguild_start_dd', 0);
                    $month = $this->request->variable('bbguild_start_mm', 0);
                    $year = $this->request->variable('bbguild_start_yy', 0);
                    $bbguild_start = mktime(0, 0, 0, $month, $day, $year);
                    $settings = array(
                        'bbguild_default_realm' => $this->request->variable('realm', '', true),
                        'bbguild_default_region' => $this->request->variable('region', '', true),
                        'bbguild_eqdkp_start' => $bbguild_start,
                        'bbguild_date_format' => $this->request->variable('date_format', ''),
                        'bbguild_name' => $this->request->variable('name', '', true),
                        'bbguild_lang' => $this->request->variable('language', 'en'),
                        'bbguild_user_nlimit' => $this->request->variable('bbguild_user_nlimit', 0),
                        'bbguild_user_llimit' => $this->request->variable('bbguild_user_llimit', 0),
                        'bbguild_maxchars' => $this->request->variable('maxchars', 2),
                        'bbguild_roster_layout' => $this->request->variable('rosterlayout', 0),
                        'bbguild_show_achiev' => $this->request->variable('showachievement', 0),
                        'bbguild_minrosterlvl' => $this->request->variable('bbguild_minrosterlvl', 0),
                    );
                    // reg id
                    $config->set('bbguild_regid', 1, true);

                    $config->set('bbguild_default_realm', $settings['bbguild_default_realm'], true);
                    $config->set('bbguild_default_region', $settings['bbguild_default_region'], true);
                    $config->set('bbguild_name',  $settings['bbguild_name'], true);
                    $config->set('bbguild_eqdkp_start', $settings['bbguild_eqdkp_start'], true);

                    $config->set('bbguild_user_nlimit', $settings['bbguild_user_nlimit'] , true);
                    $config->set('bbguild_date_format', $settings['bbguild_date_format'] , true);
                    $config->set('bbguild_lang', $settings['bbguild_lang'] , true);
                    $config->set('bbguild_maxchars', $settings['bbguild_maxchars'], true);

                    //roster
                    $config->set('bbguild_minrosterlvl', $settings['bbguild_minrosterlvl'], true);
                    $config->set('bbguild_roster_layout', $settings['bbguild_roster_layout'], true);
                    $config->set('bbguild_show_achiev', $settings['bbguild_show_achiev'], true);

                    // Purge config cache
                    $cache->destroy('config');

                    //
                    // Logging
                    //
                    $log_action = array(
                        'header' => 'L_ACTION_SETTINGS_CHANGED'	 ,
                        'L_SETTINGS' => json_encode ($settings),
                    );

                    $this->log_insert(array(
                        'log_type' =>  'L_ACTION_SETTINGS_CHANGED',
                        'log_action' => $log_action));

                    trigger_error($this->user->lang['ACTION_SETTINGS_CHANGED']. $this->link, E_USER_NOTICE);
                }

                $s_lang_options = '';
                foreach ($this->languagecodes as $lang => $langname)
                {
                    $selected = ($config['bbguild_lang'] == $lang) ? ' selected="selected"' : '';
                    $s_lang_options .= '<option value="' . $lang . '" ' . $selected . '> ' . $langname . '</option>';
                }

                $this->template->assign_block_vars('hide_row', array(
                    'VALUE' => "YES" ,
                    'SELECTED' => ($config['bbguild_hide_inactive'] == 1) ? ' selected="selected"' : '' ,
                    'OPTION' => "YES"));

                $this->template->assign_block_vars('hide_row', array(
                    'VALUE' => "NO" ,
                    'SELECTED' => ($config['bbguild_hide_inactive'] == 0) ? ' selected="selected"' : '' ,
                    'OPTION' => "NO"));

                // Default Region
                foreach ($this->regions as $regionid => $regionvalue)
                {
                    $this->template->assign_block_vars('region_row', array(
                        'VALUE' => $regionid ,
                        'SELECTED' => ($regionid == $config['bbguild_default_region']) ? ' selected="selected"' : '' ,
                        'OPTION' => $regionvalue));
                }

                //roster layout
                $rosterlayoutlist = array(
                    0 => $this->user->lang['ARM_STAND'] ,
                    1 => $this->user->lang['ARM_CLASS']);

                foreach ($rosterlayoutlist as $lid => $lname)
                {
                    $this->template->assign_block_vars('rosterlayout_row', array(
                        'VALUE' => $lid ,
                        'SELECTED' => ($lid == $config['bbguild_roster_layout']) ? ' selected="selected"' : '' ,
                        'OPTION' => $lname));
                }

                $this->template->assign_vars(array(
                    'REGID' => isset($config['bbguild_regid']) ? $config['bbguild_regid'] : '',
                    'S_BBDKPREGISTERED' => isset($config['bbguild_regid']) ? $config['bbguild_regid'] : '',
                    'U_REGISTER' => append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\main_module&amp;mode=config&amp;action=register'),

                    'REALM' => $config['bbguild_default_realm'] ,
                    'EQDKP_START_DD' => date('d', $config['bbguild_eqdkp_start']) ,
                    'EQDKP_START_MM' => date('m', $config['bbguild_eqdkp_start']) ,
                    'EQDKP_START_YY' => date('Y', $config['bbguild_eqdkp_start']) ,
                    'DATE_FORMAT' => $config['bbguild_date_format'] ,
                    'DKP_NAME' => $config['bbguild_name'] ,
                    'DEFAULT_GAME' =>  count($this->games) > 0 ? implode(", ", $this->games) : $this->user->lang['NA'],
                    'S_LANG_OPTIONS' => $s_lang_options,
                    'USER_NLIMIT' => $config['bbguild_user_nlimit'] ,
                    'USER_LLIMIT' => $config['bbguild_user_llimit'] ,
                    'MAXCHARS' => $config['bbguild_maxchars'] ,
                    'F_SHOWACHIEV' => $config['bbguild_show_achiev'] ,
                    'MINLEVEL' => $config['bbguild_minrosterlvl'],

                    'HIDE_INACTIVE_YES_CHECKED' => ($config['bbguild_hide_inactive'] == '1') ? ' checked="checked"' : '' ,
                    'HIDE_INACTIVE_NO_CHECKED' => ($config['bbguild_hide_inactive'] == '0') ? ' checked="checked"' : '' ,
                    'INACTIVE_PERIOD' => $config['bbguild_inactive_period'] ,
                    'LIST_P1' => $config['bbguild_list_p1'] ,
                    'LIST_P2' => $config['bbguild_list_p2'] ,
                    'LIST_P3' => $config['bbguild_list_p3'] ,

                    'USER_ELIMIT' => $config['bbguild_user_elimit'] ,
                    'EVENT_VIEWALL_YES_CHECKED' => ($config['bbguild_event_viewall'] == '1') ? ' checked="checked"' : '' ,
                    'EVENT_VIEWALL_NO_CHECKED' => ($config['bbguild_event_viewall'] == '0') ? ' checked="checked"' : '' ,

                    'USER_RLIMIT' => $config['bbguild_user_rlimit'] ,
                    'USER_ILIMIT' => $config['bbguild_user_ilimit'] ,

                    'USER_ALIMIT' => $config['bbguild_user_alimit'] ,
                    'STARTING_DKP' => $config['bbguild_starting_dkp'] ,
                    'INACTIVE_POINT' => $config['bbguild_inactive_point_adj'] ,
                    'ACTIVE_POINT' => $config['bbguild_active_point_adj'] ,

                    'U_ADDCONFIG' => append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\main_module&amp;mode=config&amp;action=addconfig'),
                    'PHPBBVER' => $config['version'],
                    'BBDKPVER' => BBGUILD_VERSION,

                ));

                add_form_key('acp_dkp');
                $this->page_title = 'ACP_BBGUILD_CONFIG';

                break;

            /**
             * PORTAL CONFIG
             */
            case 'index':
                $submit = $this->request->is_set_post('update');
                if ($submit)
                {
                    if (! check_form_key('acp_portal'))
                    {
                        trigger_error($this->user->lang['FV_FORMVALIDATION'], E_USER_WARNING);
                    }
                    if (isset($config['bbguild_gameworld_version']))
                    {
                        $config->set('bbguild_portal_bossprogress', $this->request->variable('show_bosspblock', 0), true);
                    }
                    $config->set('bbguild_news_forumid', $this->request->variable('news_id', 0), true);
                    $config->set('bbguild_n_news', $this->request->variable('n_news', 0), true);
                    $config->set('bbguild_n_items', $this->request->variable('n_items', 0), true);
                    $config->set('bbguild_recruitment', $this->request->variable('bbguild_recruitment', 0), true);
                    $config->set('bbguild_portal_loot', $this->request->variable('show_lootblock', 0), true);
                    $config->set('bbguild_portal_recruitment', $this->request->variable('show_recrblock', 0), true);
                    $config->set('bbguild_portal_links', $this->request->variable('show_linkblock', 0), true);
                    $config->set('bbguild_portal_menu', $this->request->variable('show_menublock', 0), true);
                    $config->set('bbguild_portal_welcomemsg', $this->request->variable('show_welcomeblock', 0), true);
                    $config->set('bbguild_portal_recent', $this->request->variable('show_recenttopics', 0), true);
                    $config->set('bbguild_portal_rtlen', $this->request->variable('n_rclength', 0), true);
                    $config->set('bbguild_portal_rtno', $this->request->variable('n_rcno', 0), true);
                    $config->set('bbguild_portal_newplayers', $this->request->variable('show_newplayers', 0), true);
                    $config->set('bbguild_portal_maxnewplayers', $this->request->variable('num_newplayers', 0), true);
                    $config->set('bbguild_portal_whoisonline', $this->request->variable('show_onlineblock', 0), true);
                    $config->set('bbguild_portal_onlineblockposition', $this->request->variable('onlineblockposition', 0), true);

                    $cache->destroy('config');
                    $welcometext = $this->request->variable('welcome_message', '', true);

                    $uid = $bitfield = $options = ''; // will be modified by generate_text_for_storage
                    $allow_bbcode = $allow_urls = $allow_smilies = true;
                    generate_text_for_storage($welcometext, $uid, $bitfield, $options, $allow_bbcode, $allow_urls, $allow_smilies);

                    $sql = 'UPDATE ' . WELCOME_MSG_TABLE . " SET
							welcome_msg = '" . (string) $this->db->sql_escape($welcometext) . "' ,
							welcome_timestamp = " . (int) time() . " ,
							bbcode_bitfield = 	'" . (string) $bitfield . "' ,
							bbcode_uid = 		'" . (string) $uid . "'
							WHERE welcome_id = 1";
                    $this->db->sql_query($sql);
                    trigger_error($this->user->lang['ADMIN_PORTAL_SETTINGS_SAVED'] . $this->link, E_USER_NOTICE);
                }

                // get welcome msg
                $sql = 'SELECT welcome_msg, bbcode_bitfield, bbcode_uid FROM ' . WELCOME_MSG_TABLE;
                $this->db->sql_query($sql);
                $result = $this->db->sql_query($sql);
                while ($row = $this->db->sql_fetchrow($result))
                {
                    $welcometext = $row['welcome_msg'];
                    $bitfield = $row['bbcode_bitfield'];
                    $uid = $row['bbcode_uid'];
                }

                $textarr = generate_text_for_edit($welcometext, $uid, $bitfield, 7);
                // number of news and items to show on front page
                $n_news = $config['bbguild_n_news'];
                $n_items = $config['bbguild_n_items'];

                add_form_key('acp_portal');
                if (isset($config['bbguild_gameworld_version']))
                {
                    $this->template->assign_vars(array(
                        'S_BP_SHOW' => true ,
                        'SHOW_BOSS_YES_CHECKED' => ($config['bbguild_portal_bossprogress'] == '1') ? ' checked="checked"' : '' ,
                        'SHOW_BOSS_NO_CHECKED' => ($config['bbguild_portal_bossprogress'] == '0') ? ' checked="checked"' : ''));
                }
                else
                {
                    $this->template->assign_var('S_BP_SHOW', false);
                }

                $this->template->assign_vars(array(
                    'WELCOME_MESSAGE' => $textarr['text'] ,
                    'N_NEWS' => $n_news,
                    'FORUM_NEWS_OPTIONS' => make_forum_select($config['bbguild_news_forumid'], false, false, true) ,
                    'SHOW_WELCOME_YES_CHECKED' => ($config['bbguild_portal_welcomemsg'] == '1') ? 'checked="checked"' : '' ,
                    'SHOW_WELCOME_NO_CHECKED' => ($config['bbguild_portal_welcomemsg'] == '0') ? 'checked="checked"' : '' ,
                    'SHOW_ONLINE_YES_CHECKED' => ($config['bbguild_portal_whoisonline'] == '1') ? 'checked="checked"' : '' ,
                    'SHOW_ONLINE_NO_CHECKED' => ($config['bbguild_portal_whoisonline'] == '0') ? 'checked="checked"' : '' ,

                    'SHOW_ONLINE_BOTTOM_CHECKED' => ($config['bbguild_portal_onlineblockposition'] == '1') ? 'checked="checked"' : '' ,
                    'SHOW_ONLINE_SIDE_CHECKED' => ($config['bbguild_portal_onlineblockposition'] == '0') ? 'checked="checked"' : '' ,

                    'SHOW_REC_YES_CHECKED' => ($config['bbguild_portal_recruitment'] == '1') ? ' checked="checked"' : '' ,
                    'SHOW_REC_NO_CHECKED' => ($config['bbguild_portal_recruitment'] == '0') ? ' checked="checked"' : '' ,
                    'SHOW_LOOT_YES_CHECKED' => ($config['bbguild_portal_loot'] == '1') ? ' checked="checked"' : '' ,
                    'SHOW_LOOT_NO_CHECKED' => ($config['bbguild_portal_loot'] == '0') ? ' checked="checked"' : '' ,
                    'N_ITEMS' => $n_items ,
                    'N_RTNO' 	=> $config['bbguild_portal_rtno'],
                    'N_RTLENGTH' 	=> $config['bbguild_portal_rtlen'],
                    'SHOW_RT_YES_CHECKED' => ($config['bbguild_portal_recent'] == '1') ? ' checked="checked"' : '' ,
                    'SHOW_RT_NO_CHECKED' => ($config['bbguild_portal_recent'] == '0') ? ' checked="checked"' : '' ,
                    'SHOW_LINK_YES_CHECKED' => ($config['bbguild_portal_links'] == '1') ? ' checked="checked"' : '' ,
                    'SHOW_LINK_NO_CHECKED' => ($config['bbguild_portal_links'] == '0') ? ' checked="checked"' : '' ,
                    'SHOW_MENU_YES_CHECKED' => ($config['bbguild_portal_menu'] == '1') ? ' checked="checked"' : '' ,
                    'SHOW_MENU_NO_CHECKED' => ($config['bbguild_portal_menu'] == '0') ? ' checked="checked"' : '',
                    'SHOW_NEWM_YES_CHECKED' => ($config['bbguild_portal_newplayers'] == '1') ? ' checked="checked"' : '' ,
                    'SHOW_NEWM_NO_CHECKED' => ($config['bbguild_portal_newplayers'] == '0') ? ' checked="checked"' : '' ,
                    'N_NUMNEWM' => $config['bbguild_portal_maxnewplayers'],
                ));
                $this->page_title = $this->user->lang['ACP_INDEXPAGE'];

                break;

            /**
             * DKP LOGS
             *
             **/
            case 'logs':
                $this->page_title = 'ACP_BBGUILD_LOGS';

                $logs =  log::Instance();
                $log_id = $this->request->variable(URI_LOG, 0);
                $search = $this->request->variable('search', 0);
                if ($log_id)
                {
                    $action = 'view';
                }
                else
                {
                    $action = 'list';
                }


                switch ($action)
                {
                    case 'list':

                        $deletemark = ($this->request->is_set_post('delmarked')) ? true : false;
                        $marked = $this->request->variable('mark', array(0));
                        $search_term = $this->request->variable('search', '');
                        $start = $this->request->variable('start', 0);

                        if ($deletemark)
                        {
                            //if marked array isnt empty
                            if (sizeof($marked) && is_array($marked))
                            {
                                if (confirm_box(true))
                                {
                                    $marked = $this->request->variable('mark', array(0));
                                    $logs = log::Instance();
                                    $log_action = array(
                                        'header' => 'L_ACTION_LOG_DELETED' ,
                                        'L_ADDED_BY' => $this->user->data['username'] ,
                                        'L_LOG_ID' => implode(",", $logs->delete_log($marked)  ));

                                    $this->log_insert(array(
                                        'log_type' => $log_action['header'] ,
                                        'log_action' => $log_action));

                                    //redirect to listing
                                    $meta_info = append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\main_module&amp;mode=logs');
                                    meta_refresh(3, $meta_info);
                                    $message = '<a href="' . append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\main_module&amp;mode=logs') . '">' . $this->user->lang['RETURN_LOG'] . '</a><br />' . sprintf($this->user->lang['ADMIN_LOG_DELETE_SUCCESS'], implode($marked));
                                    trigger_error($message, E_USER_WARNING);
                                }
                                else
                                {
                                    // display confirmation
                                    confirm_box(false, $this->user->lang['CONFIRM_DELETE_BBDKPLOG'], build_hidden_fields(array(
                                        'delmarked' => true ,
                                        'mark' 		=> $marked)));
                                }
                                // they hit no
                                $message = '<a href="' . append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\main_module&amp;mode=logs') . '">' . $this->user->lang['RETURN_LOG'] . '</a><br />' . sprintf($this->user->lang['ADMIN_LOG_DELETE_FAIL'], implode($marked));
                                trigger_error($message, E_USER_WARNING);
                            }
                        }

                        $sort_order = array(
                            0 => array('log_id desc' ,'log_id') ,
                            1 => array('log_date desc' ,'log_date') ,
                            2 => array('log_type' ,'log_type desc') ,
                            3 => array('username' ,'username dsec') ,
                            4 => array('log_ipaddress' ,'log_ipaddress desc') ,
                            5 => array('log_result' , 'log_result desc'));

                        $current_order = $this->switch_order($sort_order);
                        $verbose = true;
                        $listlogs = $logs->read_log($current_order['sql'], $search, $verbose, $search_term, $start);

                        foreach ($listlogs as $key => $log)
                        {
                            $this->template->assign_block_vars('logs_row', array(
                                'ID'		=> $log['log_id'],
                                'DATE' 		=> $log['datestamp'],
                                'TYPE' 		=> $log['log_type'],
                                'U_VIEW_LOG' => append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\main_module&amp;mode=logs&amp;' . URI_LOG . '=' . $log['log_id'] . '&amp;search=' . $search_term . '&amp;start=' . $start ) ,
                                'VERBOSE'	=> $verbose,
                                'IMGPATH'    => $this->ext_path . 'adm/images/glyphs/view.gif',
                                'USER' 		=> $log['username'],
                                'ACTION' 	=> $log['log_line'],
                                'IP' 		=> $log['log_ipaddress'],
                                'RESULT' 	=> $log['log_result'],
                                'C_RESULT' 	=> $log['cssresult'] ,
                                'ENCODED_TYPE' => urlencode($log['log_type']) ,
                                'ENCODED_USER' => urlencode($log['username']) ,
                                'ENCODED_IP' => urlencode($log['log_ipaddress'])));
                        }
                        $logcount = $logs->getTotalLogs();

                        $pagination = $phpbb_container->get('pagination');

                        $pagination_url = append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\main_module&amp;mode=logs&amp;') . '&amp;search=' . $search_term . '&amp;o=' . $current_order['uri']['current'];
                        $pagination->generate_template_pagination($pagination_url, 'pagination', 'page', $logcount, USER_LLIMIT, $start);

                        $this->template->assign_vars(array(
                            'S_LIST' 	=> true ,
                            'L_TITLE' 	=> $this->user->lang['ACP_BBGUILD_LOGS'] ,
                            'L_EXPLAIN' => $this->user->lang['ACP_BBGUILD_LOGS_EXPLAIN'] ,
                            'O_DATE' 	=> $current_order['uri'][0] ,
                            'O_TYPE' 	=> $current_order['uri'][1] ,
                            'O_USER' 	=> $current_order['uri'][2] ,
                            'O_IP' 		=> $current_order['uri'][3] ,
                            'O_RESULT' 	=> $current_order['uri'][4] ,
                            'U_LOGS' 	=> append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\main_module&amp;mode=logs&amp;') . '&amp;search=' . $search_term . '&amp;start=' . $start ,
                            'U_LOGS_SEARCH' => append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\main_module&amp;mode=logs'),
                            'CURRENT_ORDER' => $current_order['uri']['current'] ,
                            'START' => $start ,
                            'VIEWLOGS_FOOTCOUNT' => sprintf($this->user->lang['VIEWLOGS_FOOTCOUNT'], $logcount, USER_LLIMIT) ,
                            'PAGE_NUMBER'        => $pagination->on_page($logcount, USER_LLIMIT, $start)
                        ));
                        break;

                    case 'view':
                        $viewlog = $logs->get_logentry($log_id);
                        $log_actionxml = $viewlog['log_action'];
                        $search_term = $this->request->variable('search', '');
                        $start = $this->request->variable('start', 0);
                        $log_action = (array) simplexml_load_string($log_actionxml);
                        // loop the action elements and fill template
                        foreach ($log_action as $key => $value)
                        {
                            switch(strtolower($key))
                            {
                                case 'usercolour':
                                case 'id':
                                    break;
                                case 'header':
                                    if (in_array($log_action['header'], $logs::$valid_action_types))
                                    {
                                        $log_actionstr = $logs->getLogMessage($log_action['header'], false);
                                    }
                                    break;
                                default:
                                    $this->template->assign_block_vars('logaction_row', array(
                                        'KEY' 	=> 	(isset($this->user->lang[$key]))  ? $this->user->lang[$key] . ': ' : $key,
                                        'VALUE' => 	$value));


                            }
                        }


                        // fill constant template elements
                        $this->template->assign_vars(array(
                            'S_LIST' => false ,
                            'L_TITLE' => $this->user->lang['ACP_BBGUILD_LOGS'] ,
                            'L_EXPLAIN' => $this->user->lang['ACP_BBGUILD_LOGS_EXPLAIN'] ,
                            'LOG_DATE' => (! empty($viewlog['log_date'])) ? $this->user->format_date($viewlog['log_date'])  : '&nbsp;' ,
                            'LOG_USERNAME' => $viewlog['colouruser'],
                            'LOG_IP_ADDRESS' => $viewlog['log_ipaddress'] ,
                            'LOG_SESSION_ID' => $viewlog['log_sid'] ,
                            'LOG_RESULT' => $viewlog['log_result'] ,
                            'LOG_ACTION' => $log_actionstr, ));

                        break;
                }

                $this->template->assign_vars(array(
                    'U_BACK'    => append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\main_module&amp;mode=logs') . '&amp;search=' . $search_term . '&amp;start=' . $start . '&amp;' ,
                ));
                break;
        }


    }
}