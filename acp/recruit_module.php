<?php
/**
 * Recruitment ACP file
 *
 *
 * @package bbguild v2.0
 * @copyright 2016 bbDKP <https://github.com/bbDKP>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace bbdkp\bbguild\acp;

use bbdkp\bbguild\model\admin\Admin;
use bbdkp\bbguild\model\player\Guilds;
use bbdkp\bbguild\model\games\rpg\roles;
use bbdkp\bbguild\model\player\Recruitment;

/**
 * This class manages guilds
 *
 *   @package bbguild
 */
class recruit_module  extends Admin
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
     * current rul
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

    public $id;
    public $mode;

    /**
     *
     */
    private  $apply_installed;

    /**
     * main acp function
     * @param integer $id
     * @param string $mode
     */
    public function main ($id, $mode)
    {
        global $user, $template, $db, $phpbb_admin_path, $phpEx;
        global $request;

        $this->id = $id;
        $this->mode = $mode;
        $this->request=$request;
        $this->template=$template;
        $this->user=$user;
        $this->db=$db;

        parent::__construct();
        $this->tpl_name = 'dkp/acp_' . $mode;
        $this->link = '<br /><a href="' . append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\recruit_module&amp;mode=listrecruit') . '"><h3>'.$this->user->lang['RETURN_RECLIST'].'</h3></a>';
        $form_key = 'bbdkp/bbguild';
        add_form_key($form_key);

        $this->apply_installed = false;
        $plugin_versioninfo = (array) parent::get_plugin_info($this->request->variable('versioncheck_force', false));

        if(isset($plugin_versioninfo['apply']))
        {
            $this->apply_installed = true;
        }

        $guild_id = $this->request->variable(URI_GUILD, 1);
        $Guild = new Guilds();
        $guildlist   = $Guild->guildlist(1);
        foreach ($guildlist as $g)
        {
            $this->template->assign_block_vars('guild_row', array(
                'VALUE'    => $g['id'],
                'SELECTED' => ($guild_id == $g['id']) ? ' selected="selected"' : '',
                'OPTION'   => (!empty($g['name'])) ? $g['name'] : '(None)'));
        }
        $Guild->guildid= $guild_id;
        $Guild->Getguild();

        $this->template->assign_vars(array(
            'APPLY_INSTALLED'       => $this->apply_installed ? 1 : 0,
            'GUILD_EMBLEM'          => $Guild->emblempath,
            'U_VIEW_GUILD'          => append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\guild_module&amp;mode=editguild&amp;' . URI_GUILD . '=' . $Guild->guildid),
            'U_ADDRECRUIT'          => append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\recruit_module&amp;mode=addrecruit&amp;' . URI_GUILD . '=' . $Guild->guildid),
            'U_RECRUITLIST'         => append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\recruit_module&amp;mode=listrecruit&amp;' . URI_GUILD . '=' . $Guild->guildid),
            'U_EDITRECRUIT'         => append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\recruit_module&amp;mode=editrecruit'),
            'U_LIST_GUILD'          => append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\guild_module&amp;mode=listguilds'),
        ));

        switch ($mode)
        {
            /***************************************
             * List recruitments
             ***************************************/
            case 'listrecruit':

                $this->BuildTemplateListRecruits($guild_id );
                break;

            /*************************************
             *  Add recruit
             *************************************/
            case 'addrecruit':

                $recruit = new Recruitment();
                $recruit->setGuildId($Guild->guildid);
                $recruit->setLastUpdate($this->time);
                $add = $this->request->is_set_post('add');
                $update = $this->request->is_set_post('update');
                $action = $this->request->variable('action', '');
                if($this->apply_installed)
                {
                    //if apply is installed then fetch list of templates
                    $result = $this->db->sql_query ( 'SELECT * FROM ' . APPTEMPLATELIST_TABLE );
                    $apply_templates = array();
                    while ( $row = $this->db->sql_fetchrow ( $result ) )
                    {
                        $apply_templates[$row ['template_id']] = $row ['template_name'];
                    }
                    $this->db->sql_freeresult ( $result );
                }


                if($action=='delete')
                {
                    $recruit->id = $this->request->variable('id', 0);
                    $recruit->get($recruit->id);
                    $recruit->delete();

                    $success_message = sprintf($this->user->lang['ADMIN_DELETE_RECRUITMENT_SUCCESS'], $recruit->id);
                    trigger_error($success_message . $this->link, E_USER_WARNING);

                }
                elseif ($action=='edit')
                {
                    $recruit->id = $this->request->variable('id', 0);
                    $recruit->get($recruit->id);

                    $this->template->assign_vars(array(
                            'S_UPDATE'              => true,
                            'RECRUIT_ID'            => $recruit->id,
                            'RECSTATUS'             => $recruit->getStatus() == '1' ? 'checked="checked"' : '',
                            'RECRUIT_STATUS'        => $recruit->getStatus() == '1' ? $this->user->lang['RECRUIT_OPEN'] : $this->user->lang['RECRUIT_CLOSED'],
                            'NUMPOSITIONS'          => $recruit->getPositions(),
                            'APPLICANTS'            => $recruit->getApplicants(),
                            'RECRUIT_LEVEL'         => $recruit->getLevel(),
                            'NOTE'                  => $recruit->getNote(),
                        )
                    );
                }
                else
                {
                    //add
                    $this->template->assign_vars(array(
                        'RECSTATUS'             => 'checked="checked"',
                        'S_ADD'                 => true,
                        'NUMPOSITIONS'          => '1',
                        'RECRUIT_LEVEL'         => $Guild->min_armory,
                        )
                    );

                }

                if($this->apply_installed)
                {
                    foreach($apply_templates as $apply_template_id => $value)
                    {
                        $this->template->assign_block_vars('applytemplates_row', array(
                            'VALUE'    => $apply_template_id,
                            'SELECTED' => ($apply_template_id ==  $recruit->getApplytemplateid()) ? ' selected="selected"' : '',
                            'OPTION'   => $value
                        ));

                    }
                }

                if ($add || $update)
                {

                    if (!check_form_key('bbdkp/bbguild'))
                    {
                        trigger_error('FORM_INVALID');
                    }

                    $recruit->id = $this->request->variable('hidden_recruit_id', 0);
                    $recruit->role_id = $this->request->variable('role', 0);
                    $recruit->setClassId($this->request->variable('class_id', 0));
                    $recruit->setPositions($this->request->variable('numpositions', 0));
                    $recruit->setApplicants($this->request->variable('applicants', 0));
                    $recruit->setStatus($this->request->variable('recruitstatus', '') == 'on' ? 1 : 0 );
                    $recruit->setLevel($this->request->variable('recruit_level', 0));
                    $recruit->setNote(utf8_normalize_nfc($this->request->variable('note', '', true)));
                    $recruit->setApplytemplateid($this->request->variable('applytemplateid', 1));

                }

                if ($add)
                {
                    $recruit->Make();

                    $success_message = sprintf($this->user->lang['ADMIN_ADD_RECRUITMENT_SUCCESS'], $recruit->id);
                    trigger_error($success_message . $this->link, E_USER_NOTICE);

                }
                elseif($update)
                {
                    $recruit->update();
                    $success_message = sprintf($this->user->lang['ADMIN_UPDATE_RECRUITMENT_SUCCESS'], $recruit->id);
                    trigger_error($success_message . $this->link, E_USER_NOTICE);

                }
                else
                {
                    $this->BuildDropDowns($Guild, $recruit);
                }
                $this->page_title = $this->user->lang['ACP_ADDRECRUITS'];
                break;

            default:
                $this->page_title = 'ACP_BBGUILD_MAINPAGE';
                $success_message = 'Error';
                trigger_error($success_message . $this->link, E_USER_WARNING);
        }
    }

    /**
     * list the recruitments
     * @param $guild_id
     *
     */
    private function BuildTemplateListRecruits($guild_id)
    {
        global $phpbb_admin_path, $phpEx;
        if (count($this->games) == 0)
        {
            trigger_error($this->user->lang['ERROR_NOGAMES'], E_USER_WARNING);
        }

        $recruits = new Recruitment();
        $recruits->setGuildId($guild_id);
        $result   = $recruits->ListRecruitments(1);
        $recruit_count= 0;
        while ($row = $this->db->sql_fetchrow($result))
        {
            $recruit_count++;
            $this->template->assign_block_vars('recruit_row', array(
                    'ID'                => $row['id'],
                    'GUILD_ID'          => $row['guild_id'],
                    'ROLE_ID'           => $row['role_id'],
                    'CLASS_ID'          => $row['class_id'],
                    'CLASS_NAME'        => $row['class_name'],
                    'COLOR_CODE'        => $row['colorcode'],
                    'S_CLASS_IMAGE_EXISTS' => (strlen ( $row ['imagename'] ) > 1) ? true : false,
                    'CLASS_IMAGE'       => (strlen ( $row ['imagename'] ) > 1) ? $this->ext_path . "images/class_images/" . $row ['imagename'] . ".png" : '',
                    'POSITIONS'         => $row['positions'],
                    'APPLICANTS'        => $row['applicants'],
                    'STATUS'            => $row['status'] == '1' ? $this->user->lang['RECRUIT_OPEN'] : $this->user->lang['RECRUIT_CLOSED'],
                    'NOTE'              => $row['note'],
                    'ROLE_COLOR'        => $row['role_color'],
                    'ROLE_NAME'         => $row['role_name'],
                    'APPLYTEMPLATE_ID'  => $row['applytemplate_id'],
                    'U_DELETE_RECRUIT'  => append_sid("{$phpbb_admin_path}index.$phpEx", 'i=recruit&amp;mode=addrecruit&amp;action=delete&amp;id=' . $row['id']),
                    'U_VIEW_RECRUIT'    => append_sid("{$phpbb_admin_path}index.$phpEx", 'i=recruit&amp;mode=addrecruit&amp;action=edit&amp;id=' . $row['id']),
                )
            );

        }

        // if apply is installed insert an extra column in recruitment listing to indicate the template to be used for that recruitment.
        $this->template->assign_vars(array(
            'RECRUIT_FOOTCOUNT'     => sprintf($this->user->lang['RECRUIT_FOOTCOUNT'], $recruit_count),
        ));
        $this->page_title = 'ACP_LISTRECRUITS';
    }

    /**
     * @param $Guild
     * @param $recruit
     */
    private function BuildDropDowns($Guild, Recruitment $recruit)
    {
        global $config;

        // Class dropdown
        // reloading is done from ajax to prevent redraw
        $sql_array = array(
            'SELECT'   => ' c.class_id, l.name as class_name, c.class_hide,
									  c.class_min_level, class_max_level, c.class_armor_type, c.imagename ',
            'FROM'     => array(
                CLASS_TABLE => 'c',
                BB_LANGUAGE => 'l'),
            'WHERE'    => " l.game_id = c.game_id  AND c.game_id = '" . $Guild->game_id . "'
					AND l.attribute_id = c.class_id  AND l.language= '" . $config['bbguild_lang'] . "' AND l.attribute = 'class' ",
            'ORDER_BY' => 'l.name asc'
        );
        $sql    = $this->db->sql_build_query('SELECT', $sql_array);
        $result = $this->db->sql_query($sql);
        while ($row = $this->db->sql_fetchrow($result))
        {
            $this->template->assign_block_vars('class_row', array(
                'VALUE'    => $row['class_id'],
                'SELECTED' => ($recruit->getClassId() == $row['class_id']) ? ' selected="selected"' : '',
                'OPTION'   => $row['class_name']));
        }
        $this->db->sql_freeresult($result);
        // get roles
        $Roles           = new Roles();
        $Roles->game_id  = $Guild->game_id;
        $Roles->guild_id = $Guild->guildid;
        $listroles       = $Roles->listroles();
        foreach ($listroles as $roleid => $Role)
        {
            $this->template->assign_block_vars('role_row', array(
                'VALUE'    => $Role['role_id'],
                'SELECTED' => ($recruit->role_id == $Role['role_id']) ? ' selected="selected"' : '',
                'OPTION'   => $Role['rolename']));
        }
    }
}
