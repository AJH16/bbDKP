<?php
/**
 * Guild ACP file
 *
 * @package bbguild v2.0
 * @copyright 2016 bbDKP <https://github.com/bbDKP>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace bbdkp\bbguild\acp;
use bbdkp\bbguild\model\admin\Admin;
use bbdkp\bbguild\model\games\Game;
use bbdkp\bbguild\model\player\Guilds;
use bbdkp\bbguild\model\player\Ranks;

/**
 * This class manages guilds
 *
 *   @package bbguild
 */
class guild_module extends Admin
{
    /**
     * url action
     * @var string
     */
    public $u_action;

    /**
     * trigger url
     * @var string
     */
    public $link = ' ';

    /**
     * current url
     * @var string
     */
    public  $url_id;

    /** @var \phpbb\request\request **/
    protected $request;
    /** @var \phpbb\template\template **/
    protected $template;
    /** @var \phpbb\user **/
    protected $user;
    /** @var \phpbb\db\driver\driver_interface */
    protected $db;
    /** @var \phpbb\config\config */
    protected $config;

    public $id;
    public $mode;

    /**
     * ACP guild function
     * @param int $id the id of the node who parent has to be returned by function
     * @param int $mode id of the submenu
     */
    public function main($id, $mode)
    {
        global $config, $user, $template, $db, $phpbb_admin_path, $phpEx;
        global $request;

        $this->config = $config;
        $this->id = $id;
        $this->mode = $mode;
        $this->request=$request;
        $this->template=$template;
        $this->user=$user;
        $this->db=$db;

        parent::__construct();
        $form_key = 'bbdkp/bbguild';
        add_form_key ( $form_key );

        $this->tpl_name = 'acp_' . $mode;
        $this->link = '<br /><a href="' . append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\guild_module&amp;mode=listguilds') . '"><h3>'.$this->user->lang['RETURN_GUILDLIST'].'</h3></a>';
        $this->page_title = 'ACP_LISTGUILDS';

        switch ($mode)
        {
            case 'listguilds':
                $this->BuildTemplateListGuilds();
                break;
            case 'addguild':
                $addguild = new Guilds();

                if ($this->request->is_set_post('newguild'))
                {
                    $this->AddGuild($addguild);
                }
                $addguild->region = $config['bbguild_default_region'];
                foreach ($this->regions as $key => $regionname)
                {
                    $this->template->assign_block_vars('region_row', array(
                        'VALUE' => $key ,
                        'SELECTED' => ($addguild->region == $key) ? ' selected="selected"' : '' ,
                        'OPTION' => (! empty($regionname)) ? $regionname : '(None)'));
                }

                $addguild->game_id = $config['bbguild_default_game'];

                $thisgame = new Game;
                $thisgame->game_id = $addguild->game_id;
                $thisgame->Get();
                if($thisgame->getApikey() != '' && $thisgame->game_id =='wow')
                {
                    $addguild->armory_enabled = true;
                }

                if(isset($this->games))
                {
                    foreach ($this->games as $key => $gamename)
                    {
                        $this->template->assign_block_vars('game_row', array(
                            'VALUE' => $key,
                            'SELECTED' => ($addguild->game_id == $key) ? ' selected="selected"' : '' ,
                            'OPTION' => (! empty($gamename)) ? $gamename : '(None)'));
                    }
                }
                else
                {
                    trigger_error('ERROR_NOGAMES', E_USER_WARNING );
                }

                $this->template->assign_vars(array(
                    'F_ENABLEARMORY'	=> $addguild->armory_enabled,
                    'DEFAULTREALM'      => $config['bbguild_default_realm'],
                    'RECSTATUS'         => true,
                    'MIN_ARMORYLEVEL'   => $config['bbguild_minrosterlvl'],
                ));
                $this->page_title = $this->user->lang['ACP_ADDGUILD'];

                break;
            case 'editguild':

                $this->url_id = $this->request->variable(URI_GUILD, 0);
                $updateguild = new Guilds($this->url_id);
                if ($this->request->is_set_post('playeradd'))
                {
                    redirect(append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\mm_module&amp;mode=addplayer&amp;' . URI_GUILD . "=" . $this->url_id  ));
                }

                $action = $this->request->variable('action', '');
                switch($action)
                {
                    case 'guildranks':
                        $updaterank = $this->request->is_set_post('updaterank');
                        $deleterank = ($this->request->variable('deleterank', '')) != '' ? true : false;
                        $addrank = $this->request->is_set_post('addrank');
                        $this->link = '<br /><a href="' . append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\guild_module&amp;mode=editguild&amp;action=guildranks&amp;' . URI_GUILD . '=' . $updateguild->guildid) . '"><h3>'.$this->user->lang['RETURN_GUILDLIST'].'</h3></a>';
                        if ($updaterank || $addrank)
                        {
                            if (! check_form_key('bbdkp/bbguild'))
                            {
                                trigger_error('FORM_INVALID');
                            }
                        }
                        if ($addrank)
                        {
                            $this->AddRank($updateguild);
                        }
                        if ($addrank)
                        {
                            $this->AddRank($updateguild);
                        }
                        if ($updaterank)
                        {
                            $this->UpdateRank($updateguild);
                        }
                        if ($deleterank)
                        {
                            $this->DeleteRank();
                        }

                        $this->tpl_name = 'acp_editguild_ranks';
                        $this->BuildTemplateEditGuildRanks($updateguild);
                        break;

                    case 'editguild':
                    default:
                        $submit = $this->request->is_set_post('updateguild');
                        $delete = $this->request->is_set_post('deleteguild');
                        $armoryenabled = $this->request->is_set_post('armory_enabled');
                        $updatearmory = $this->request->is_set_post('armory');
                        $this->link = '<br /><a href="' . append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\guild_module&amp;mode=editguild&amp;action=guildedit&amp;' . URI_GUILD . '=' . $updateguild->guildid) . '"><h3>'.$this->user->lang['RETURN_GUILDLIST'].'</h3></a>';
                        // POST check
                        if ($submit)
                        {
                            if (! check_form_key('bbdkp/bbguild'))
                            {
                                trigger_error('FORM_INVALID', E_USER_NOTICE);
                            }

                            if($armoryenabled)
                            {
                                $this->UpdateGuild($updateguild, true);
                            }
                            else
                            {
                                $this->UpdateGuild($updateguild, false);
                            }
                        }

                        if($updatearmory)
                        {
                            $this->UpdateGuild($updateguild, true);
                        }

                        if ($delete)
                        {
                            $this->DeleteGuild($updateguild);
                        }
                        // start template loading
                        $this->BuildTemplateEditGuild($updateguild);
                        break;
                }

                break;

            default:
                $this->page_title = 'ACP_BBGUILD_MAINPAGE';
                $success_message = 'Error';
                trigger_error($success_message . $this->link, E_USER_WARNING);
        }
    }

    /**
     * @param Guilds $addguild
     */
    private function AddGuild(Guilds $addguild)
    {
        if (!check_form_key('bbdkp/bbguild'))
        {
            trigger_error('FORM_INVALID');
        }

        $addguild->name = $this->request->variable('guild_name', '', true);
        $addguild->realm = $this->request->variable('realm', '', true);
        $addguild->region = $this->request->variable('region_id', '');
        $addguild->game_id = $this->request->variable('game_id', '');
        $addguild->showroster = $this->request->is_set_post('showroster');
        $addguild->min_armory = $this->request->variable('min_armorylevel', 0);
        $addguild->armory_enabled = $this->request->variable('armory_enabled', 0);
        $addguild->recstatus = $this->request->variable('switchon_recruitment', 0);
        $addguild->recruitforum = $this->request->variable('recruitforum', 0);

        if ($addguild->MakeGuild() == true)
        {
            $success_message = sprintf($this->user->lang['ADMIN_ADD_GUILD_SUCCESS'], $addguild->name);
            trigger_error($success_message . $this->link, E_USER_NOTICE);
        }
        else
        {
            $success_message = sprintf($this->user->lang['ADMIN_ADD_GUILD_FAIL'], $addguild->name);
            trigger_error($success_message . $this->link, E_USER_WARNING);
        }
    }

    /**
     * update the default flag
     * @param $updateguild
     */
    private function UpdateDefaultGuild(Guilds $updateguild)
    {
        $id = $this->request->variable('defaultguild', 0);
        $updateguild->update_guilddefault($id);
        $success_message = sprintf($this->user->lang['ADMIN_UPDATE_GUILD_SUCCESS'], $id);
        trigger_error($success_message . $this->link, E_USER_NOTICE);
    }

    /**
     * @param $updateguild
     * @param $updateArmory
     * @return void
     */
    private function UpdateGuild(Guilds $updateguild, $updateArmory)
    {
        $updateguild->guildid = $this->url_id;
        $updateguild->Getguild();
        $old_guild = new Guilds($this->url_id);
        $old_guild->Getguild();

        $updateguild->game_id = $this->request->variable('game_id', '');
        $updateguild->name = $this->request->variable('guild_name', '', true);
        $updateguild->realm = $this->request->variable('realm', '', true);
        $updateguild->region = $this->request->variable('region_id', ' ');
        $updateguild->showroster = $this->request->variable('showroster', 0);
        $updateguild->min_armory = $this->request->variable('min_armorylevel', 0);
        $updateguild->recstatus = $this->request->variable('switchon_recruitment', 0);
        $updateguild->armory_enabled = $this->request->variable('armory_enabled', 0);
        $updateguild->recruitforum = $this->request->variable('recruitforum', 0);

        //in the request we expect the file name here including extension, no path
        $updateguild->emblempath = $this->ext_path . "images/guildemblem/". $this->request->variable('guild_emblem', '', true);

        $updateguild->aionlegionid = 0;
        $updateguild->aionserverid = 0;

        $GuildAPIParameters= array();

        if($updateArmory)
        {
            $GuildAPIParameters = array('members');
        }

        if($updateguild->Guildupdate($old_guild, $GuildAPIParameters))
        {
            $success_message = sprintf($this->user->lang['ADMIN_UPDATE_GUILD_SUCCESS'], $this->url_id);
            trigger_error($success_message . $this->link, E_USER_NOTICE);
        }
        else
        {
            $success_message = sprintf($this->user->lang['ADMIN_UPDATE_GUILD_FAILED'], $this->url_id);
            trigger_error($success_message . $this->link, E_USER_WARNING);
        }

    }

    /**
     *
     * delete a guild
     * @param $updateguild
     */
    private function DeleteGuild(Guilds $updateguild)
    {
        if (confirm_box(true))
        {
            $deleteguild = new Guilds($this->request->variable('guildid', 0));
            $deleteguild->Getguild();
            $deleteguild->Guildelete();
            $success_message = sprintf($this->user->lang['ADMIN_DELETE_GUILD_SUCCESS'], $deleteguild->guildid);
            trigger_error($success_message . $this->link, E_USER_NOTICE);

        }
        else
        {
            $s_hidden_fields = build_hidden_fields(array(
                'deleteguild' => true,
                'guildid' => $updateguild->guildid));

            $this->template->assign_vars(array(
                'S_HIDDEN_FIELDS' => $s_hidden_fields));

            confirm_box(false, $this->user->lang['CONFIRM_DELETE_GUILD'], $s_hidden_fields);

        }
    }

    /**
     * Add a guild rank
     * @param $updateguild
     */
    private function AddRank(Guilds $updateguild)
    {
        $newrank = new Ranks($updateguild->guildid);
        $newrank->RankName = $this->request->variable('nrankname', '', true);
        $newrank->RankId = $this->request->variable('nrankid', 0);
        $newrank->RankGuild = $updateguild->guildid;
        $newrank->RankHide = $this->request->is_set_post('nhide');
        $newrank->RankPrefix = $this->request->variable('nprefix', '', true);
        $newrank->RankSuffix = $this->request->variable('nsuffix', '', true);
        $newrank->Makerank();
        $success_message = $this->user->lang['ADMIN_RANKS_ADDED_SUCCESS'];
        trigger_error($success_message . $this->link);
    }

    /**
     * Update a rank
     * @param $updateguild
     *
     * @return int|string
     */
    private function UpdateRank(Guilds $updateguild)
    {
        $newrank = new Ranks($updateguild->guildid);
        $oldrank = new Ranks($updateguild->guildid);

        // template
        $modrank = $this->request->variable('ranks', array(0 => ''), true);
        foreach ($modrank as $rank_id => $rank_name)
        {
            $oldrank->RankId = $rank_id;
            $oldrank->RankGuild = $updateguild->guildid;
            $oldrank->Getrank();

            $newrank->RankId = $rank_id;
            $newrank->RankGuild = $oldrank->RankGuild;
            $newrank->RankName = $rank_name;
            $newrank->RankHide = (isset($_POST['hide'][$rank_id])) ? 1 : 0;

            $rank_prefix = $this->request->variable('prefix', array((int) $rank_id => ''), true);
            $newrank->RankPrefix = $rank_prefix[$rank_id];

            $rank_suffix = $this->request->variable('suffix', array((int) $rank_id => ''), true);
            $newrank->RankSuffix = $rank_suffix[$rank_id];

            // compare old with new,
            if ($oldrank != $newrank)
            {
                $newrank->Rankupdate($oldrank);
            }
        }
        $success_message = $this->user->lang['ADMIN_RANKS_UPDATE_SUCCESS'];
        trigger_error($success_message . $this->link);
        return $rank_id;
    }

    /**
     * delete a guild rank
     */
    private function DeleteRank()
    {

        if (confirm_box(true))
        {
            $guildid = $this->request->variable('hidden_guildid', 0);
            $rank_id = $this->request->variable('hidden_rank_id', 999);
            $deleterank = new Ranks($guildid, $rank_id);
            $deleterank->Rankdelete(false);
        }
        else
        {
            // delete the rank only if there are no players left
            $rank_id = $this->request->variable('ranktodelete', 999);
            $guildid = $this->request->variable(URI_GUILD, 0);
            $old_guild = new Guilds($guildid);
            $deleterank = new Ranks($guildid, $rank_id);

            $s_hidden_fields = build_hidden_fields(array(
                'deleterank' => true,
                'hidden_rank_id' => $rank_id,
                'hidden_guildid' => $guildid
            ));

            confirm_box(false, sprintf($this->user->lang['CONFIRM_DELETE_RANKS'], $deleterank->RankName, $old_guild->name), $s_hidden_fields);
        }
    }

    /**
     * @param $updateguild
     */
    private function BuildTemplateEditGuild($updateguild)
    {
        global $phpEx,  $phpbb_admin_path;

        foreach ($this->regions as $key => $regionname)
        {
            $this->template->assign_block_vars('region_row', array(
                'VALUE'    => $key,
                'SELECTED' => ($updateguild->region == $key) ? ' selected="selected"' : '',
                'OPTION'   => (!empty($regionname)) ? $regionname : '(None)'));
        }

        if (isset($this->games))
        {
            foreach ($this->games as $key => $gamename)
            {
                $this->template->assign_block_vars('game_row', array(
                    'VALUE'    => $key,
                    'SELECTED' => ($updateguild->game_id == $key) ? ' selected="selected"' : '',
                    'OPTION'   => (!empty($gamename)) ? $gamename : '(None)'));
            }
        }
        else
        {
            trigger_error('ERROR_NOGAMES', E_USER_WARNING);
        }

        $game          = new Game;
        $game->game_id = $updateguild->game_id;
        $game->Get();


        $this->template->assign_vars(array(
            'F_ENABLGAMEEARMORY' => $game->getArmoryEnabled(),
            'F_ENABLEARMORY'     => $updateguild->armory_enabled,
            'RECRUITFORUM_OPTIONS' => make_forum_select ($updateguild->recruitforum, false, false, true ),
            'RECSTATUS'          => $updateguild->recstatus,
            'GAME_ID'            => $updateguild->game_id,
            'GUILDID'            => $updateguild->guildid,
            'GUILD_NAME'         => $updateguild->name,
            'REALM'              => $updateguild->realm,
            'REGION'             => $updateguild->region,
            'PLAYERCOUNT'        => $updateguild->playercount,
            'ARMORY_URL'         => $updateguild->guildarmoryurl,
            'MIN_ARMORYLEVEL'    => $updateguild->min_armory,
            'SHOW_ROSTER'        => ($updateguild->showroster == 1) ? 'checked="checked"' : '',
            'ARMORYSTATUS'       => $updateguild->armoryresult,
            // Language
            'L_TITLE'            => $this->user->lang['ACP_EDITGUILD'],
            'L_EXPLAIN'          => $this->user->lang['ACP_EDITGUILD_EXPLAIN'],
            'L_EDIT_GUILD_TITLE'  => $this->user->lang['EDIT_GUILD'],
            // Javascript messages
            'MSG_NAME_EMPTY'     => $this->user->lang['FV_REQUIRED_NAME'],
            'EMBLEM'             => $updateguild->emblempath,
            'EMBLEMFILE'         => basename($updateguild->emblempath),

            'U_EDIT_GUILD' => append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\guild_module&amp;mode=editguild&amp;action=editguild&amp;' . URI_GUILD . '=' . $updateguild->guildid),
            'U_EDIT_GUILDRANKS' => append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\guild_module&amp;mode=editguild&amp;action=guildranks&amp;'. URI_GUILD . '=' . $updateguild->guildid),
            'U_EDIT_GUILDRECRUITMENT' => append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\guild_module&amp;mode=editguild&amp;action=guildrecruitment&amp;' . URI_GUILD . '=' . $updateguild->guildid)
        ));

        // extra
        if ($updateguild->game_id == 'wow')
        {
            $this->template->assign_vars(array(
                'S_WOW'  => true,
                'ARMORY' => $updateguild->guildarmoryurl,
                'ACHIEV' => $updateguild->achievementpoints,
            ));
        }

        $this->page_title = $this->user->lang['ACP_EDITGUILD'];
    }

    /**
     * list the ranks for this guild
     * @param $updateguild
     */
    private function BuildTemplateEditGuildRanks($updateguild)
    {
        global $phpEx,  $phpbb_admin_path;
        // everything from rank 90 is readonly
        $listranks          = new Ranks($updateguild->guildid);
        $listranks->game_id = $updateguild->game_id;
        $result             = $listranks->listranks();
        while ($row = $this->db->sql_fetchrow($result))
        {
            $prefix = $row['rank_prefix'];
            $suffix = $row['rank_suffix'];
            $this->template->assign_block_vars('ranks_row', array(
                'RANK_ID'       => $row['rank_id'],
                'RANK_NAME'     => $row['rank_name'],
                'RANK_PREFIX'   => $prefix,
                'RANK_SUFFIX'   => $suffix,
                'HIDE_CHECKED'  => ($row['rank_hide'] == 1) ? 'checked="checked"' : '',
                'S_READONLY'    => ($row['rank_id'] >= 90) ? true : false,
                'U_DELETE_RANK' => append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\guild_module&amp;mode=editguild&amp;deleterank=1&amp;ranktodelete=' . $row['rank_id'] . "&amp;" . URI_GUILD . "=" . $updateguild->guildid)
            ));
        }
        $this->db->sql_freeresult($result);

        $game          = new Game;
        $game->game_id = $updateguild->game_id;
        $game->Get();

        $this->template->assign_vars(array(
            // Form values
            'S_GUILDLESS'        => ($updateguild->guildid == 0) ? true : false,
            'F_ENABLGAMEEARMORY' => $game->getArmoryEnabled(),
            'F_ENABLEARMORY'     => $updateguild->armory_enabled,
            'GAME_ID'            => $updateguild->game_id,
            'GUILDID'            => $updateguild->guildid,
            'GUILD_NAME'         => $updateguild->name,
            'U_ADD_RANK'         => append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\guild_module&amp;mode=editguild&amp;addrank=1&amp;guild=' . $updateguild->guildid),
            // Language
            'L_TITLE'            => ($this->url_id < 0) ? $this->user->lang['ACP_ADDGUILD'] : $this->user->lang['ACP_EDITGUILD'],
            'L_EXPLAIN'          => ($this->url_id < 0) ? $this->user->lang['ACP_ADDGUILD_EXPLAIN'] : $this->user->lang['ACP_EDITGUILD_EXPLAIN'],
            'L_ADD_GUILD_TITLE'  => ($this->url_id < 0) ? $this->user->lang['ADD_GUILD'] : $this->user->lang['EDIT_GUILD'],
            // Javascript messages
            'MSG_NAME_EMPTY'     => $this->user->lang['FV_REQUIRED_NAME'],
            'EMBLEM'             => $updateguild->emblempath,
            'EMBLEMFILE'         => basename($updateguild->emblempath), //only filename
            'S_ADD'              => ($this->url_id < 0) ? true : false,
            'U_EDIT_GUILD'              => append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\guild_module&amp;mode=editguild&amp;action=editguild&amp;' . URI_GUILD . '=' . $updateguild->guildid),
            'U_EDIT_GUILDRANKS'         => append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\guild_module&amp;mode=editguild&amp;action=guildranks&amp;' . URI_GUILD . '=' . $updateguild->guildid),
            'U_EDIT_GUILDRECRUITMENT'   => append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\guild_module&amp;mode=editguild&amp;action=guildrecruitment&amp;' . URI_GUILD . '=' . $updateguild->guildid)
        ));

        $this->page_title = $this->user->lang['ACP_EDITGUILD'];
    }

    /**
     *
     * list the guilds
     */
    private function BuildTemplateListGuilds()
    {
        global   $phpbb_admin_path, $phpEx;
        if (count($this->games) == 0)
        {
            trigger_error($this->user->lang['ERROR_NOGAMES'], E_USER_WARNING);
        }

        $updateguild = new Guilds();
        $guildlist   = $updateguild->guildlist(1);
        foreach ($guildlist as $g)
        {
            $this->template->assign_block_vars('defaultguild_row', array(
                'VALUE'    => $g['id'],
                'SELECTED' => ($g['guilddefault'] == '1') ? ' selected="selected"' : '',
                'OPTION'   => (!empty($g['name'])) ? $g['name'] : '(None)'));
        }
        $guilddefaultupdate = (isset($_POST['upddefaultguild'])) ? true : false;
        if ($guilddefaultupdate)
        {
            $this->UpdateDefaultGuild($updateguild);
        }
        $guildadd = (isset($_POST['addguild'])) ? true : false;
        if ($guildadd)
        {
            redirect(append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\guild_module&amp;mode=addguild'));
        }

        $sort_order = array(
            0 => array('id', 'id desc'),
            1 => array('name', 'name desc'),
            2 => array('realm desc', 'realm desc'),
            3 => array('region', 'region desc'),
            4 => array('roster', 'roster desc'));
        $current_order   = $this->switch_order($sort_order);
        $guild_count     = 0;
        $previous_data   = '';
        $sort_index      = explode('.', $current_order['uri']['current']);
        $previous_source = preg_replace('/( (asc|desc))?/i', '', $sort_order[$sort_index[0]][$sort_index[1]]);
        $show_all        = ((isset($_GET['show'])) && $this->request->variable('show', '') == 'all') ? true : false;

        $sql = 'SELECT id, name, realm, region, roster, game_id FROM ' . GUILD_TABLE . ' WHERE id > 0 ORDER BY ' . $current_order['sql'];
        if (!($guild_result = $this->db->sql_query($sql)))
        {
            trigger_error($this->user->lang['ERROR_GUILDNOTFOUND'], E_USER_WARNING);
        }
        $lines = 0;
        while ($row = $this->db->sql_fetchrow($guild_result))
        {
            $guild_count++;
            $listguild = new Guilds($row['id']);
            $this->template->assign_block_vars('guild_row', array(
                    'ID'           => $listguild->guildid,
                    'NAME'         => $listguild->name,
                    'REALM'        => $listguild->realm,
                    'REGION'       => $listguild->region,
                    'GAME'         => $listguild->game_id,
                    'PLAYERCOUNT'  => $listguild->playercount,
                    'SHOW_ROSTER'  => ($listguild->showroster == 1 ? 'yes' : 'no'),
                    'U_VIEW_GUILD' => append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\guild_module&amp;mode=editguild&amp;' . URI_GUILD . '=' . $listguild->guildid)
                )
            );
            $previous_data = $row[$previous_source];
        }

        $this->template->assign_vars(array(
            'U_GUILDLIST'            => append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\guild_module') . '&amp;mode=listguilds',
            'U_ADDGUILD'             => append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\guild_module') . '&amp;mode=addguild',
            'U_GUILD'                => append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\guild_module') . '&amp;mode=editguild',
            'L_TITLE'                => $this->user->lang['ACP_LISTGUILDS'],
            'L_EXPLAIN'              => $this->user->lang['ACP_LISTGUILDS_EXPLAIN'],
            'BUTTON_VALUE'           => $this->user->lang['DELETE_SELECTED_GUILDS'],
            'O_ID'                   => $current_order['uri'][0],
            'O_NAME'                 => $current_order['uri'][1],
            'O_REALM'                => $current_order['uri'][2],
            'O_REGION'               => $current_order['uri'][3],
            'O_ROSTER'               => $current_order['uri'][4],
            'U_LIST_GUILD'           => append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\guild_module&amp;mode=listguilds'),
            'GUILDPLAYERS_FOOTCOUNT' => sprintf($this->user->lang['GUILD_FOOTCOUNT'], $guild_count)));
        $this->page_title = 'ACP_LISTGUILDS';
    }
}
