<?php
/**
 * Game ACP file
 *
 * @package bbguild v2.0
 * @copyright 2016 bbDKP <https://github.com/bbDKP>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */
namespace bbdkp\bbguild\acp;

use bbdkp\bbguild\model\admin\Admin;
use bbdkp\bbguild\model\games\Game;
use bbdkp\bbguild\model\games\rpg\Classes;
use bbdkp\bbguild\model\games\rpg\Faction;
use bbdkp\bbguild\model\games\rpg\Races;
use bbdkp\bbguild\model\games\rpg\Roles;
/**
 * This class manages Game settings
 * @package bbdkp\bbguild\acp
 */
class game_module extends Admin
{
	/**
	 * link in trigger window
	 * @var string
	 */
	private $link;

    /**
     * partly installed games
     * @var string
     */
    private $gamelist;

    /** @var \phpbb\request\request **/
    protected $request;
    /** @var \phpbb\template\template **/
    protected $template;
    /** @var \phpbb\user **/
    protected $user;

	public $ext_path;
	public $ext_manager;
    public $u_action;
    public $id;
    public $mode;

	/**
	 * main ACP game function
	 * @param int $id the id of the node who parent has to be returned by function
	 * @param int $mode id of the submenu
	 * @access public
	 */
	function main($id, $mode)
	{

		global $user, $template, $phpbb_admin_path, $phpEx;
        global $phpbb_container, $request;
        parent::__construct();

		// Get an instance of the admin controller
		$admin_controller = $phpbb_container->get('bbdkp.bbguild.admin.controller');

        $this->id = $id;
        $this->mode = $mode;
        $this->request=$request;
        $this->template=$template;
        $this->user=$user;

		$form_key = 'bbdkp/bbguild';
		add_form_key ( $form_key );
		$this->tpl_name = 'acp_' . $this->mode;

        //list installed games
        $listgames = new Game;
        $sort_order = array(
            0 => array(	'id' , 'id desc') ,
            1 => array('game_id' , 'game_id desc') ,
            2 => array('game_name' , 'game_name desc'));

        $current_order = $this->switch_order($sort_order);

        $sort_index = explode('.', $current_order['uri']['current']);
        $this->gamelist = $listgames->listgames($current_order['sql']);

        $installed = array();
        foreach( $this->gamelist as $game)
        {
            $installed[$game['game_id']] = $game['name'];
        }

		switch ($this->mode)
		{
			case 'listgames' :

				$this->link = '<br /><a href="' . append_sid ( "{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\game_module&amp;mode=listgames' ) . '"><h3>' . $this->user->lang['RETURN_GAMELIST'] . '</h3></a>';

				//game dropdown
				$newpresetgame = $this->request->is_set_post('addgame1');
				$newcustomgame = $this->request->is_set_post('addgame2');

				if ($newpresetgame || $newcustomgame)
				{
					// ask for permission
					if (confirm_box ( true ))
					{
						$editgame = new Game;
						$editgame->game_id = $this->request->variable( 'hidden_game_id','' );
						$editgame->setName($this->request->variable('hidden_game_name', '', true));
						$editgame->install();
                        //
                        // Logging
                        //
                        $log_action = array(
                            'header' => 'L_ACTION_GAME_ADDED' ,
                            'L_GAME' => $editgame->game_id ,
                        );

                        $this->log_insert(array(
                            'log_type' =>  'L_ACTION_GAME_ADDED',
                            'log_action' => $log_action));

						trigger_error ( sprintf ( $this->user->lang ['ADMIN_INSTALLED_GAME_SUCCESS'], $editgame->getName() ) . $this->link, E_USER_NOTICE );
					}
					else
					{
						// get field content
						$listgames->game_id = $this->request->variable('ngame_id' , '');
						if($newpresetgame)
						{
							$listgames->setName($listgames->preinstalled_games[$listgames->game_id]) ;
						}
						elseif($newcustomgame)
						{
							$listgames->setName($this->request->variable('ngame_name', '', true));
						}

						$s_hidden_fields = build_hidden_fields ( array (
								'addgame1' => $newpresetgame,
								'addgame2' => $newcustomgame,
								'hidden_game_id' => $listgames->game_id,
								'hidden_game_name' => $listgames->getName(),

						));
						confirm_box ( false, sprintf ( $this->user->lang ['CONFIRM_INSTALL_GAME'], $listgames->getName() ), $s_hidden_fields );
					}
				}

				///template load
				$can_install_count = 0;

				//is anything installed ?
                $not_installed = array();
				if(count($installed) > 0)
				{
					$not_installed = array_diff($listgames->preinstalled_games, $installed);
				}
				else
				{
					// brand new install
					$not_installed = $listgames->preinstalled_games;
				}

				foreach ($not_installed as $key => $game)
			    {
					$can_install_count +=1;
			        $this->template->assign_block_vars('gamelistrow', array(
			            'VALUE'      => $key,
			            'OPTION'     => $game,
			        	'SELECTED'   => '',
			        ));
			    }

				foreach($this->gamelist as $game_id => $game)
			    {
			    	$this->template->assign_block_vars('gamerow', array(
			    			'ID' => $game['id'] ,
			    			'NAME' => $game['name'] ,
			    			'GAME_ID' => $game['game_id'] ,
			    			'U_VIEW_GAME' => append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\game_module&amp;mode=editgames&amp;' . URI_GAME . '=' . $game['game_id'] ),
			    			'STATUS' => $game['status'],
			    	));
			    }

			    $this->template->assign_vars ( array (
			    		'U_LIST_GAME' => append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\game_module&amp;mode=listgames') ,
			    		'CANINSTALL' => ($can_install_count == 0) ? false : true,
			    		'O_ID' => $current_order['uri'][0] ,
			    		'O_GAMEID' => $current_order['uri'][1] ,
			    		'O_GAMENAME' => $current_order['uri'][2] ,
					));

			    $form_key = 'bbdkp/bbguild';
			    add_form_key($form_key);

			    $this->page_title = 'ACP_LISTGAME';
			    break;

			case 'editgames' :

                $action = $this->request->variable('action', '');

				$editgame = new Game;
				$editgame->game_id = $this->request->variable(URI_GAME, $this->request->variable ( 'hidden_game_id','' ));
                $editgame->Get();

				$this->link = '<br /><a href="' . append_sid ( "{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\game_module&amp;mode=editgames&amp;' . URI_GAME ."={$editgame->game_id}" ) . '"><h3>' .
						$this->user->lang ['RETURN_GAMEVIEW'] . '</h3></a>';

                $gamereset = $this->request->is_set_post('gamereset');
				$gamedelete = $this->request->is_set_post('gamedelete');
				$gamesettings = $this->request->is_set_post('gamesettings');

                $this->template->assign_vars ( array (
                    'U_BACK' => append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\game_module&amp;mode=listgames') ,
                ));

				if($gamereset)
				{
                    $this->ResetGame($editgame, $this->request);
                }

				// save game settings
				if($gamesettings)
				{
                    $editgame = $this->SaveGameSettings($this->request);
					$success_message = sprintf($this->user->lang['ADMIN_UPDATED_GAME_SUCCESS'], $editgame->game_id, $editgame->getName());
					meta_refresh(0.5, append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\game_module&amp;mode=editgames&amp;' . URI_GAME . "={$editgame->game_id}"));
					trigger_error($success_message . $this->link, E_USER_NOTICE);


				}

				if($gamedelete)
				{
                    $this->DeleteGame($editgame, $this->request);
                }

                $addrole = $this->request->is_set_post('showrolesadd');
                if ($addrole)
                {
                    $this->BuildTemplateRole($editgame, $this->request);
                    break;
                }

                if ($action=='deleterole')
                {
                    $this->DeleteRole($editgame, $this->request);
                    break;
                }
                elseif ($action=='editrole')
                {
                    $this->BuildTemplateRole($editgame, $this->request);
                    break;
                }


                $addfaction = $this->request->is_set_post('showfactionadd');
                if ($addfaction)
                {
                    $this->BuildTemplateFaction($editgame, $this->request);
                    break;
                }

                if ($action=='deletefaction')
                {
                    $this->DeleteFaction($editgame, $this->request);
                    break;
                }
                elseif ($action=='editfaction')
                {
                    $this->BuildTemplateFaction($editgame, $this->request);
                    break;
                }

                $addrace = $this->request->is_set_post('showraceadd');
                $raceedit = (isset ( $_GET ['raceedit'] )) ? true : false;
                $racedelete = (isset ( $_GET ['racedelete'] )) ? true : false;

				if ($raceedit || $addrace)
				{
					// Load template for adding/editing
					if (isset ( $_GET ['id'] ))
					{
						// edit this race
                        $this->BuildTemplateEditRace($editgame, $this->request);
					}
					else
					{
                        $this->BuildTemplateAddRace($editgame, $this->request);
                    }
					break;
				}

				if ($racedelete)
				{
                    $this->DeleteRace($editgame, $this->request);
                    break;
                }

                $addclass = $this->request->is_set_post('showclassadd');
                $classedit = (isset ( $_GET ['classedit'] )) ? true : false;
                $classdelete = (isset ( $_GET ['classdelete'] )) ? true : false;

                if ($classedit || $addclass)
				{
					// Load template for adding/editing
					if (isset ( $_GET ['id'] ))
					{
                        $this->BuildTemplateEditClass($editgame, $this->request);
                    }
					else
					{
                        $this->BuildTemplateAddClass($editgame);
                    }
					break;
				}

				if ($classdelete)
				{
                    // user pressed delete class
                    $this->DeleteClass($editgame, $this->request);
                    break;
                }

				$this->showgame($editgame);
				$this->page_title = 'ACP_ADDGAME';

				break;

            case 'addrole' :

                $role = new Roles();
                $role->game_id = $this->request->variable ( 'game_id', $this->request->variable ( 'hidden_game_id', ''));
                $editgame = new Game;
                $editgame->game_id = $role->game_id;
                $editgame->Get();

                $addnew = $this->request->is_set_post('addrole');
                $editfaction = $this->request->is_set_post('editrole');
                if ($addnew)
                {
                    $this->AddRole($role, $editgame, $this->request);
                }
                if ($editfaction)
                {
                    $this->EditRole($role, $editgame, $this->request);
                }
                break;

            case 'addfaction' :

				$faction = new Faction();
				$faction->game_id = $this->request->variable ( 'game_id', $this->request->variable ( 'hidden_game_id', '' ) );
				$editgame = new Game;
				$editgame->game_id = $faction->game_id;
				$editgame->Get();

				$addnew = $this->request->is_set_post('factionadd');
                $editfaction = $this->request->is_set_post('factionedit');
				if ($addnew)
				{
                    $this->AddFaction($faction, $editgame, $this->request);
				}
                if ($editfaction)
                {
                    $this->EditFaction($faction, $editgame, $this->request);
                }
				break;

			case 'addrace' :
				$raceadd = $this->request->is_set_post('add');
				$raceupdate = $this->request->is_set_post('update');

				if ($raceadd || $raceupdate)
				{
					if (! check_form_key ( 'bbdkp/bbguild' ))
					{
						trigger_error ( 'FORM_INVALID' );
					}
				}

				if ($raceadd)
				{
                    $this->AddRace($this->request);
				}
				elseif ($raceupdate)
				{
                    $this->RaceUpdate($this->request);
				}

				$this->page_title = 'ACP_LISTGAME';
				break;

			case 'addclass':
				// collects data after BuildTemplateEditClass, calls class updater

				$classadd = $this->request->is_set_post('add');
				$classupdate = $this->request->is_set_post('update');

				if ($classadd || $classupdate)
				{
					if (! check_form_key ( 'bbdkp/bbguild' ))
					{
						trigger_error ( 'FORM_INVALID' );
					}
				}

				if ($classadd)
				{
                    $this->AddClass($this->request);
				}
				elseif ($classupdate)
				{
                    $this->EditClass($this->request);

				}
				$this->page_title = 'ACP_LISTGAME';
				break;


		}
	}

    /**
     * Save Game Settings
     * @return Game
     */
    private function SaveGameSettings()
    {
        $editgame = new Game;
        $editgame->game_id = $this->request->variable(URI_GAME, $this->request->variable( 'hidden_game_id','' ));
        $editgame->Get();

        $editgame->setImagename($this->request->variable('imagename',''));
        $editgame->setArmoryEnabled($this->request->variable('enable_armory', 0));
        $editgame->setBossbaseurl($this->request->variable('bossbaseurl','' ));
        $editgame->setZonebaseurl($this->request->variable('zonebaseurl','' ));
        $editgame->setName($this->request->variable ( 'game_name', ' ', true ));
        $editgame->setApikey($this->request->variable('apikey','' ));
		$editgame->setApilocale($this->request->variable('apilocale','' ));
        $editgame->setPrivkey($this->request->variable('privkey','' ));
        $editgame->update();

        return $editgame;
    }

    /**
     * Reset Game
     * @param Game $editgame
     */
    private function ResetGame(Game $editgame)
    {
        global $phpbb_admin_path, $phpEx;

        if (confirm_box(true))
        {
            $editgame          = new Game;
            $editgame->game_id = $this->request->variable('hidden_game_id', '');
            $editgame->get();
            $editgame->Delete();
            $editgame->install();
            meta_refresh(1, append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\game_module&amp;mode=listgames'));
            trigger_error(sprintf($this->user->lang ['ADMIN_RESET_GAME_SUCCESS'], $editgame->getName()) . $this->link, E_USER_WARNING);
        }
        else
        {
            // get field content
            $s_hidden_fields = build_hidden_fields(array(
                'gamereset'      => true,
                'hidden_game_id' => $editgame->game_id,
            ));

            confirm_box(false, sprintf($this->user->lang ['CONFIRM_RESET_GAME'], $editgame->getName()), $s_hidden_fields);

        }
    }

    /**
     * Delete Game from bbGuild
     * @param Game $editgame
     */
    private function DeleteGame(Game $editgame)
    {

        if (confirm_box(true))
        {
            $deletegame          = new Game;
            $deletegame->game_id = $this->request->variable('hidden_game_id', '');
            $deletegame->Get();
            $deletegame->Delete();

            $log_action = array(
                'header' => 'L_ACTION_GAME_DELETED',
                'L_GAME' => $deletegame->game_id,
            );

            $this->log_insert(array(
                'log_type'   => 'L_ACTION_GAME_DELETED',
                'log_action' => $log_action));
            //meta_refresh(1, append_sid ( "{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\game_module&amp;mode=listgames') );
            trigger_error(sprintf($this->user->lang ['ADMIN_DELETE_GAME_SUCCESS'], $deletegame->getName()), E_USER_WARNING);

        } else
        {

            // get field content
            $s_hidden_fields = build_hidden_fields(array(
                'gamedelete'     => true,
                'hidden_game_id' => $editgame->game_id,

            ));
            confirm_box(false, sprintf($this->user->lang ['CONFIRM_DELETE_GAME'], $editgame->getName()), $s_hidden_fields);

        }

    }

    /**
     * Add Role
     * @param Roles $role
     * @param Game $editgame
     */
    private function AddRole(Roles $role, Game $editgame)
    {
        global $phpbb_admin_path, $phpEx;

        if (!check_form_key('bbdkp/bbguild'))
        {
            trigger_error('FORM_INVALID');
        }
        $role->rolename = $this->request->variable('rolename', '', true);
        $role->role_id = $this->request->variable('role_id', 0);
        $role->role_color = $this->request->variable('role_color', '');
        $role->role_icon = $this->request->variable('role_icon', '');
        $role->role_cat_icon = $this->request->variable('role_cat_icon', '');
        $role->Make();

        $log_action = array(
            'header'    => 'L_ACTION_ROLE_ADDED',
            'L_GAME'    => $editgame->game_id,
            'L_ROLE'    => $role->rolename,
        );

        $this->log_insert(array(
            'log_type'   => 'L_ACTION_ROLE_ADDED',
            'log_result' => 'L_SUCCESS',
            'log_action' => $log_action));

        meta_refresh(1, append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\game_module&amp;mode=editgames&amp;' . URI_GAME . "={$role->game_id}"));
        trigger_error(sprintf($this->user->lang ['ADMIN_ADD_ROLE_SUCCESS'], $role->rolename), E_USER_NOTICE);
    }

    /**
     * @param Roles $role
     * @param Game $editgame
     */
    private function EditRole(Roles $role, Game $editgame)
    {
        global $phpbb_admin_path, $phpEx;

        $oldrole             = new Roles();
        $oldrole->game_id    = $editgame->game_id;
        $oldrole->role_id    = $this->request->variable('hidden_role_id', 0);
        $oldrole->get();

        $newrole               = new Roles();
        $newrole->game_id      = $editgame->game_id;
        $newrole->role_id   = $this->request->variable('hidden_role_id', 0);
        $newrole->get(); // in order to get the pk

        $newrole->rolename = $this->request->variable('rolename', '', true);
        $newrole->role_color = $this->request->variable('role_color', '');
        $newrole->role_icon = $this->request->variable('role_icon', '');
        $newrole->role_cat_icon = $this->request->variable('role_cat_icon', '');

        $newrole->Update($oldrole);

        $log_action = array(
            'header'    => 'L_ACTION_ROLE_UPDATED',
            'L_GAME'    => $editgame->game_id,
            'L_ROLE'    => $newrole->rolename,
        );

        $this->log_insert(array(
            'log_type'   => 'L_ACTION_ROLE_UPDATED',
            'log_result' => 'L_SUCCESS',
            'log_action' => $log_action));

        meta_refresh(1, append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\game_module&amp;mode=editgames&amp;' . URI_GAME . "={$newrole->game_id}"));
        trigger_error(sprintf($this->user->lang ['ADMIN_UPDATE_ROLE_SUCCESS'], $newrole->rolename), E_USER_NOTICE);

    }

    /**
     * @param Game $editgame
     */
    private function DeleteRole(Game $editgame)
    {
        global $phpbb_admin_path, $phpEx;

        if (confirm_box(true))
        {
            $deleterole               = new Roles();
            $deleterole->game_id      =  $this->request->variable('hidden_game_id', '');
            $deleterole->role_id    = $this->request->variable('hidden_role_id', 0);
            $deleterole->get(); // in order to get the pk
            $deleterole->Delete();

            $log_action = array(
                'header'    => 'L_ACTION_FACTION_DELETED',
                'L_GAME'    => $deleterole->game_id,
                'L_FACTION' => $deleterole->rolename,
            );
            $this->log_insert(array(
                'log_type'   => 'L_ACTION_FACTION_DELETED',
                'log_result' => 'L_SUCCESS',
                'log_action' => $log_action));


            meta_refresh(1, append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\game_module&amp;mode=editgames&amp;' . URI_GAME . "={$deleterole->game_id}"));

            trigger_error(sprintf($this->user->lang ['ADMIN_DELETE_ROLE_SUCCESS'], $deleterole->rolename) . $this->link, E_USER_WARNING);

        }
        else
        {
            $deleterole               = new Roles();
            $deleterole->game_id      = $editgame->game_id;
            $deleterole->role_id      = $this->request->variable('role_id', 0);
            $deleterole->get(); // in order to get the pk

            $s_hidden_fields = build_hidden_fields(array(
                'factiondelete'     => true,
                'hidden_role_id'    => $deleterole->role_id,
                'hidden_game_id'    => $deleterole->game_id,
            ));
            confirm_box(false, sprintf($this->user->lang ['CONFIRM_DELETE_ROLE'], $deleterole->rolename), $s_hidden_fields);

        }
        $this->showgame($editgame);
    }

    /**
     * Add Faction
     * @param Faction $faction
     * @param Game $editgame
     */
    private function AddFaction(Faction $faction, Game $editgame)
    {
        global $phpbb_admin_path, $phpEx;

        if (!check_form_key('bbdkp/bbguild'))
        {
            trigger_error('FORM_INVALID');
        }
        $faction->faction_name = $this->request->variable('factionname', '', true);
        $faction->Make();

        $log_action = array(
            'header'    => 'L_ACTION_FACTION_ADDED',
            'L_GAME'    => $editgame->game_id,
            'L_FACTION' => $faction->faction_name,
        );
        $this->log_insert(array(
            'log_type'   => 'L_ACTION_FACTION_ADDED',
            'log_result' => 'L_SUCCESS',
            'log_action' => $log_action));
        meta_refresh(1, append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\game_module&amp;mode=editgames&amp;' . URI_GAME . "={$faction->game_id}"));

        trigger_error(sprintf($this->user->lang ['ADMIN_ADD_FACTION_SUCCESS'], $faction->faction_name), E_USER_NOTICE);
    }

    /**
     * @param Faction $faction
     * @param Game $editgame
     */
    private function EditFaction(Faction $faction, Game $editgame)
    {
        $oldfaction             = new Faction();
        $oldfaction->game_id    = $editgame->game_id;
        $oldfaction->faction_id = $this->request->variable('hidden_faction_id', 0);
        $oldfaction->get();

        $newfaction               = new Faction();
        $newfaction->game_id      = $editgame->game_id;
        $newfaction->faction_name = $this->request->variable('factionname', '', true);
        $newfaction->faction_id   = $this->request->variable('hidden_faction_id', 0);
        $newfaction->update();

        trigger_error(sprintf($this->user->lang ['ADMIN_UPDATE_FACTION_SUCCESS'], $newfaction->faction_name), E_USER_WARNING);

    }

    /**
     * @param Game $editgame
     */
    private function DeleteFaction(Game $editgame)
    {
        global $phpbb_admin_path, $phpEx;

        if (confirm_box(true))
        {
            $faction             = new Faction();
            $faction->game_id    = $this->request->variable('hidden_game_id', '');
            $faction->faction_id = $this->request->variable('hidden_faction_id', 0);
            $faction->get();
            $faction->Delete();

            $log_action = array(
                'header'    => 'L_ACTION_FACTION_DELETED',
                'L_GAME'    => $faction->game_id,
                'L_FACTION' => $faction->faction_name,
            );
            $this->log_insert(array(
                'log_type'   => 'L_ACTION_FACTION_DELETED',
                'log_result' => 'L_SUCCESS',
                'log_action' => $log_action));
            meta_refresh(1, append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\game_module&amp;mode=editgames&amp;' . URI_GAME . "={$faction->game_id}"));
            trigger_error(sprintf($this->user->lang ['ADMIN_DELETE_FACTION_SUCCESS'], $faction->game_id, $faction->faction_name) . $this->link, E_USER_WARNING);

        }
        else
        {
            $faction             = new Faction();
            $faction->game_id    = $editgame->game_id;
            $faction->faction_id = $this->request->variable('id', 0);
            $faction->get();

            $s_hidden_fields = build_hidden_fields(array(
                'factiondelete'     => true,
                'hidden_faction_id' => $faction->faction_id,
                'hidden_game_id'    => $faction->game_id,
            ));
            confirm_box(false, sprintf($this->user->lang ['CONFIRM_DELETE_FACTION'], $faction->faction_name), $s_hidden_fields);

        }
        $this->showgame($editgame);
    }

    /**
     * Add Class
     */
    private function AddClass()
    {
        global $phpbb_admin_path, $phpEx;
        $newclass             = new Classes();
        $newclass->game_id    = $this->request->variable('game_id', $this->request->variable('hidden_game_id', ''));
        $newclass->classname  = $this->request->variable('class_name', '', true);
        $newclass->class_id   = $this->request->variable('class_id', 0);
        $newclass->min_level  = $this->request->variable('class_level_min', 0);
        $newclass->max_level  = $this->request->variable('class_level_max', 0);
        $newclass->armor_type = $this->request->variable('armory', '');
        $newclass->imagename  = $this->request->variable('image', '');
        $newclass->colorcode  = $this->request->variable('classcolor', '');
        $newclass->faction_id = '';
        $newclass->dps        = '';
        $newclass->heal       = '';
        $newclass->tank       = '';
        $newclass->Make();
        meta_refresh(1, append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\game_module&amp;mode=editgames&amp;' . URI_GAME . "={$newclass->game_id}"));
        trigger_error(sprintf($this->user->lang ['ADMIN_ADD_CLASS_SUCCESS'], $newclass->classname) . $this->link, E_USER_NOTICE);
    }

    /**
     * Edit Class
     */
    private function EditClass()
    {
        global $phpbb_admin_path, $phpEx;
        $oldclass           = new Classes();
        $oldclass->game_id  = $this->request->variable('game_id', $this->request->variable('hidden_game_id', ''));
        $oldclass->class_id = $this->request->variable('class_id0', 0);
        $oldclass->c_index  = $this->request->variable('c_index', 0);
        $oldclass->Get();

        $newclass           = new Classes();
        $newclass->game_id  = $this->request->variable('game_id', $this->request->variable('hidden_game_id', ''));
        $newclass->class_id = $this->request->variable('class_id0', 0);
        $newclass->c_index  = $this->request->variable('c_index', 0);
        $newclass->Get();
        $newclass->class_id   = $this->request->variable('class_id', 0);
        $newclass->classname  = $this->request->variable('class_name', '', true);
        $newclass->min_level  = $this->request->variable('class_level_min', 0);
        $newclass->max_level  = $this->request->variable('class_level_max', 0);
        $newclass->armor_type = $this->request->variable('armory', '');
        $newclass->imagename  = $this->request->variable('image', '');
        $newclass->colorcode  = $this->request->variable('classcolor', '');
        $newclass->faction_id = '';
        $newclass->dps        = '';
        $newclass->heal       = '';
        $newclass->tank       = '';
        $newclass->Update($oldclass);
        meta_refresh(1, append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\game_module&amp;mode=editgames&amp;' . URI_GAME . "={$newclass->game_id}"));
        trigger_error(sprintf($this->user->lang ['ADMIN_UPDATE_CLASS_SUCCESS'], $newclass->classname) . $this->link, E_USER_NOTICE);
    }

    /**
     * Delete Class
     * @param Game $editgame
     */
    private function DeleteClass(Game $editgame)
    {
        global $phpbb_admin_path, $phpEx;

        if (confirm_box(true))
        {
            $deleteclass           = new Classes();
            $deleteclass->class_id = $this->request->variable('hidden_class_id', 0);
            $deleteclass->game_id  = $this->request->variable('hidden_game_id', '');
            $deleteclass->get();
            $deleteclass->Delete();
            meta_refresh(1, append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\game_module&amp;mode=editgames&amp;' . URI_GAME . "={$deleteclass->game_id}"));
            trigger_error(sprintf($this->user->lang ['ADMIN_DELETE_CLASS_SUCCESS'], $deleteclass->classname) . $this->link, E_USER_WARNING);
        } else
        {
            $deleteclass           = new Classes();
            $deleteclass->class_id = $this->request->variable('id', 0);
            $deleteclass->game_id  = $editgame->game_id;
            $deleteclass->get();

            $s_hidden_fields = build_hidden_fields(array(
                    'classdelete'     => true,
                    'hidden_game_id'  => $deleteclass->game_id,
                    'hidden_class_id' => $deleteclass->class_id)
            );
            confirm_box(false, sprintf($this->user->lang ['CONFIRM_DELETE_CLASS'], $deleteclass->classname), $s_hidden_fields);
        }
        $this->showgame($editgame);

    }

    /**
     * Update a Race
     */
    private function RaceUpdate()
    {
        global $phpbb_admin_path, $phpEx;

        $oldrace          = new Races();
        $oldrace->game_id = $this->request->variable('game_id', $this->request->variable('hidden_game_id', ''));
        $oldrace->race_id = $this->request->variable('race_id', 0);
        $oldrace->Get();
        $race          = new Races();
        $race->game_id = $oldrace->game_id;
        $race->race_id = $oldrace->race_id;
        $race->Get();
        $race->race_name       = $this->request->variable('racename', '', true);
        $race->race_faction_id = $this->request->variable('faction', 0);
        $race->image_male      = $this->request->variable('image_male', '', true);
        $race->image_female    = $this->request->variable('image_female', '', true);
        $race->Update($oldrace);
        //
        // Logging
        //
        $log_action = array(
            'header' => 'L_ACTION_RACE_UPDATED',
            'L_GAME' => $race->game_id,
            'L_RACE' => $race->race_name,
        );
        $this->log_insert(array(
            'log_type'   => 'L_ACTION_RACE_UPDATED',
            'log_result' => 'L_SUCCESS',
            'log_action' => $log_action));
        meta_refresh(1, append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\game_module&amp;mode=editgames&amp;' . URI_GAME . "={$race->game_id}"));
        trigger_error(sprintf($this->user->lang ['ADMIN_UPDATE_RACE_SUCCESS'], $race->race_name) . $this->link, E_USER_NOTICE);
    }

    /**
     * Add a Race
     */
    private function AddRace()
    {
        global $phpbb_admin_path, $phpEx;
        $race                  = new Races();
        $race->game_id         = $this->request->variable('game_id', $this->request->variable('hidden_game_id', ''));
        $race->race_id         = $this->request->variable('race_id', $this->request->variable('hidden_race_id', ''));
        $race->race_name       = $this->request->variable('racename', '', true);
        $race->race_faction_id = $this->request->variable('faction', 0);
        $race->image_male      = $this->request->variable('image_male', '', true);
        $race->image_female    = $this->request->variable('image_female', '', true);
        $race->Make();

        $log_action = array(
            'header' => 'L_ACTION_RACE_ADDED',
            'L_GAME' => $race->game_id,
            'L_RACE' => $race->race_name,
        );
        $this->log_insert(array(
            'log_type'   => 'L_ACTION_RACE_ADDED',
            'log_result' => 'L_SUCCESS',
            'log_action' => $log_action));
        meta_refresh(1, append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\game_module&amp;mode=editgames&amp;' . URI_GAME . "={$race->game_id}"));
        trigger_error(sprintf($this->user->lang ['ADMIN_ADD_RACE_SUCCESS'], $race->race_name) . $this->link, E_USER_NOTICE);
    }

    /**
     * Delete Race
     * @param Game $editgame
     */
    private function DeleteRace(Game $editgame)
    {

        global $phpbb_admin_path, $phpEx;


        if (confirm_box(true))
        {
            $deleterace          = new Races();
            $deleterace->race_id = $this->request->variable('hidden_raceid', 0);
            $deleterace->game_id = $this->request->variable('hidden_gameid', '');
            $deleterace->get();
            $deleterace->Delete();

            $log_action = array(
                'header' => 'L_ACTION_RACE_DELETED',
                'L_GAME' => $deleterace->game_id,
                'L_RACE' => $deleterace->race_name,
            );
            $this->log_insert(array(
                'log_type'   => 'L_ACTION_RACE_DELETED',
                'log_result' => 'L_SUCCESS',
                'log_action' => $log_action));
            $success_message = sprintf($this->user->lang['ADMIN_DELETE_RACE_SUCCESS'], $deleterace->game_id, $deleterace->race_name);
            meta_refresh(1, append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\game_module&amp;mode=editgames&amp;' . URI_GAME . "={$deleterace->game_id}"));
            trigger_error($success_message . $this->link, E_USER_WARNING);

        } else
        {
            $deleterace          = new Races;
            $deleterace->race_id = $this->request->variable('id', 0);
            $deleterace->game_id = $this->request->variable('game_id', '');
            $deleterace->get();

            $s_hidden_fields = build_hidden_fields(array(
                'racedelete'    => true,
                'hidden_raceid' => $deleterace->race_id,
                'hidden_gameid' => $editgame->game_id
            ));

            confirm_box(false, sprintf($this->user->lang ['CONFIRM_DELETE_RACE'], $deleterace->game_id, $deleterace->race_name), $s_hidden_fields);

        }
        $this->showgame($editgame);
    }

    /**
     * load template add race
     * @param Game $editgame
     */
    private function BuildTemplateAddRace(Game  $editgame)
    {
        global $phpbb_admin_path, $phpEx;

        $listraces          = new Races();
        $listraces->game_id = $editgame->game_id;

        $listfactions          = new Faction();
        $listfactions->game_id = $editgame->game_id;
        $fa = $listfactions->getfactions();
        if (count($fa) == 0)
        {
            trigger_error('ERROR_NOFACTION', E_USER_WARNING);
        }
        $s_faction_options = '';
        foreach ($fa as $faction_id => $faction)
        {
            $s_faction_options .= '<option value="' . $faction['faction_id'] . '" > ' . $faction['faction_name'] . '</option>';
        }
        unset($listfactions);
        $this->template->assign_vars(array(
            'GAME_ID'               => $listraces->game_id,
            'GAME_NAME'             => $editgame->getName(),
            'S_FACTIONLIST_OPTIONS' => $s_faction_options,
            'S_ADD'                 => true,
            'U_ACTION'              => append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\game_module&amp;mode=addrace'),
            'LA_ALERT_AJAX' => $this->user->lang ['ALERT_AJAX'],
            'LA_ALERT_OLDBROWSER' => $this->user->lang ['ALERT_OLDBROWSER'],
            'UA_FINDFACTION' => append_sid ( $phpbb_admin_path . "style/dkp/findfaction.$phpEx" ),
            'MSG_NAME_EMPTY'        => $this->user->lang ['FV_REQUIRED_NAME']));

        $this->page_title = 'ACP_LISTGAME';
        $this->tpl_name = 'acp_addrace';
    }

    /**
     * Load Template Edit Race
     * @param Game $editgame
     */
    private function BuildTemplateEditRace(Game $editgame)
    {
        global $phpbb_admin_path, $phpEx;

        $races = new Races();
        $races->race_id = $this->request->variable('id', 0);
        $races->game_id = $editgame->game_id;
        $races->get();
        if (!empty($this)) {
            foreach ($this->gamelist as $key => $gamename)
            {
                $this->template->assign_block_vars('game_row', array(
                    'VALUE'    => $key,
                    'SELECTED' => ($races->game_id == $key) ? ' selected="selected"' : '',
                    'OPTION'   => $gamename));
            }
        }
        // faction dropdown
        $listfactions          = new Faction();
        $listfactions->game_id = $editgame->game_id;
        $fa                    = $listfactions->getfactions();
        $s_faction_options = '';
        foreach ($fa as $faction_id => $faction)
        {
            $selected = ($faction_id == $races->race_faction_id) ? ' selected="selected"' : '';
            $s_faction_options .= '<option value="' . $faction['faction_id'] . '" ' . $selected . '> ' . $faction['faction_name'] . '</option>';
        }
        unset($listfactions);

        $femalesize = getimagesize($this->ext_path . "images/race_images/" . $races->image_female . ".png" , $info);
        $malesize = getimagesize($this->ext_path . "images/race_images/" . $races->image_male . ".png" , $info);
        $femalesizewarning ='';
        $malesizewarning ='';
        if($femalesize[0] > 32 || $femalesize[0] >32)
        {
            $femalesizewarning = sprintf($this->user->lang['IMAGESIZE_WARNING'], $femalesize[0], $femalesize[1]);
        }
        if($malesize[0] > 32 || $femalesize[0] >32)
        {
            $malesizewarning = sprintf($this->user->lang['IMAGESIZE_WARNING'], $malesize[0], $malesize[1]);
        }


        // send parameters to template
        $this->template->assign_vars(array(
            'GAME_ID'               => $races->game_id,
            'GAME_NAME'             => $editgame->getName(),
            'RACE_ID'               => $races->race_id,
            'RACE_NAME'             => $races->race_name,
            'RACE_IMAGENAME_M'      => $races->image_male,
            'FIMAGEWARNING'         => $femalesizewarning,
            'MIMAGEWARNING'         => $malesizewarning,
            'RACE_IMAGE_M'          => (strlen($races->image_male) > 1) ? $this->ext_path . "images/race_images/" . $races->image_male . ".png" : '',
            'RACE_IMAGENAME_F'      => $races->image_female,
            'RACE_IMAGE_F'          => (strlen($races->image_female) > 1) ? $this->ext_path . "images/race_images/" . $races->image_female . ".png" : '',
            'S_RACE_IMAGE_M_EXISTS' => (strlen($races->image_male) > 1) ? true : false,
            'S_RACE_IMAGE_F_EXISTS' => (strlen($races->image_female) > 1) ? true : false,
            'S_FACTIONLIST_OPTIONS' => $s_faction_options,
            'S_ADD'                 => false,
            'LA_ALERT_AJAX' => $this->user->lang ['ALERT_AJAX'],
            'LA_ALERT_OLDBROWSER' => $this->user->lang ['ALERT_OLDBROWSER'],
            'UA_FINDFACTION' => append_sid ( $phpbb_admin_path . "style/dkp/findfaction.$phpEx" ),
            'U_ACTION'              => append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\game_module&amp;mode=addrace'),
            'MSG_NAME_EMPTY'        => $this->user->lang ['FV_REQUIRED_NAME']));
        unset($races);

        $this->page_title = 'ACP_LISTGAME';
        $this->tpl_name = 'acp_addrace';
    }

    /**
     * Load Template Edit Classes
     * @param Game $editgame
     */
    private function BuildTemplateEditClass(Game $editgame)
    {
       global  $phpbb_admin_path, $phpEx;

        $GameClass           = new Classes;
        $GameClass->class_id = $this->request->variable('id', 0);
        $GameClass->game_id  = $editgame->game_id;
        $GameClass->Get();

        // list installed games
        if (!empty($this)) {
            foreach ($this->gamelist as $key => $gamename)
            {
                $this->template->assign_block_vars('game_row', array(
                    'VALUE'    => $key,
                    'SELECTED' => ($GameClass->game_id == $key) ? ' selected="selected"' : '',
                    'OPTION'   => $gamename));
            }
        }

        //list armor types
        $s_armor_options = '';
        foreach ($GameClass->armortypes as $armor => $armorname)
        {
            $selected = ($armor == $GameClass->armor_type) ? ' selected="selected"' : '';
            $s_armor_options .= '<option value="' . $armor . '" ' . $selected . '> ' . $armorname . '</option>';
        }
        $size = getimagesize($this->ext_path . "images/class_images/" . $GameClass->imagename . ".png" , $info);

        $warning ='';
        if($size[0] > 32 || $size[0] >32)
        {
            $warning = sprintf($this->user->lang['IMAGESIZE_WARNING'], $size[0], $size[1]);
        }

        $this->template->assign_vars(array(
            'GAME_ID'              => $GameClass->game_id,
            'GAME_NAME'            => $editgame->getName(),
            'C_INDEX'              => $GameClass->c_index,
            'CLASS_ID'             => $GameClass->class_id,
            'CLASS_NAME'           => $GameClass->classname,
            'CLASS_MIN'            => $GameClass->min_level,
            'CLASS_MAX'            => $GameClass->max_level,
            'S_ARMOR_OPTIONS'      => $s_armor_options,
            'IMAGESIZE'            => $size[3],
            'IMAGEWARNING'         => $warning,
            'CLASS_IMAGENAME'      => $GameClass->imagename,
            'COLORCODE'            => ($GameClass->colorcode == '') ? '#254689' : $GameClass->colorcode,
            'CLASS_IMAGE'          => (strlen($GameClass->imagename) > 1) ? $this->ext_path . "images/class_images/" . $GameClass->imagename . ".png" : '',
            'S_CLASS_IMAGE_EXISTS' => (strlen($GameClass->imagename) > 1) ? true : false,
            'S_ADD'                => false,
            'U_ACTION'             => append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\game_module&amp;mode=addclass'),
            'MSG_NAME_EMPTY'       => $this->user->lang ['FV_REQUIRED_NAME'],
            'MSG_ID_EMPTY'         => $this->user->lang ['FV_REQUIRED_ID']));

        $this->page_title = 'ACP_LISTGAME';
        $this->tpl_name = 'acp_addclass';
    }

    /**
     * Load Template Add Classes
     * @param Game $editgame
     */
    private function BuildTemplateAddClass(Game $editgame)
    {
        global $phpbb_admin_path, $phpEx;

        $listclasses          = new Classes;
        $listclasses->game_id = $editgame->game_id;
        $s_armor_options = '';
        foreach ($listclasses->armortypes as $armor => $armorname)
        {
            $s_armor_options .= '<option value="' . $armor . '" > ' . $armorname . '</option>';
        }
        // send parameters to template
        $this->template->assign_vars(array(
            'GAME_ID'         => $listclasses->game_id,
            'GAME_NAME'       => $editgame->getName(),
            'S_ARMOR_OPTIONS' => $s_armor_options,
            'S_ADD'           => true,
            'COLORCODE'       => '#EE8611',
            'U_ACTION'        => append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\game_module&amp;mode=addclass'),
            'MSG_NAME_EMPTY'  => $this->user->lang ['FV_REQUIRED_NAME'],
            'MSG_ID_EMPTY'    => $this->user->lang ['FV_REQUIRED_ID']));

        $this->page_title = 'ACP_LISTGAME';
        $this->tpl_name = 'acp_addclass';
    }


    /**
     * @param Game $editgame
     */
    private function BuildTemplateFaction(Game $editgame)
    {
        global $phpbb_admin_path, $phpEx;

        $faction = new Faction();
        $faction->game_id = $editgame->game_id;
        $faction->faction_id = $this->request->variable('id', 0);
        $faction->Get();

        // send parameters to template
        $this->template->assign_vars(array(
            'FACTION_NAME'          => $faction->faction_name,
            'FACTION_ID'            => $faction->faction_id,
            'GAME_ID'               => $faction->game_id,
            'GAME_NAME'             => $editgame->getName(),
            'IS_ADD'                => $faction->faction_id == 0 ? true : false,
            'U_ACTION'              => append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\game_module&amp;mode=addfaction'),
            'MSG_NAME_EMPTY'        => $this->user->lang ['FV_REQUIRED_NAME']));
        unset($races);

        $this->page_title = $this->user->lang['FACTION'];
        $this->tpl_name = 'acp_addfaction';
    }


    /**
     * @param Game $editgame
     */
    private function BuildTemplateRole(Game $editgame)
    {
        global $phpbb_admin_path, $phpEx;

        $role = new Roles();
        $role->game_id = $editgame->game_id;
        $add=true;
        if( isset($_POST['role_id']) ||isset($_GET['role_id']) )
        {
            $role->role_id = $this->request->variable('role_id', 0);
            $role->Get();
            $add=false;
        }

        // send parameters to template
        $this->template->assign_vars(array(
            'ROLE_NAME'          => $role->rolename,
            'ROLE_ID'            => $role->role_id,
            'ROLE_CAT_ICON'      => $role->role_cat_icon,
            'ROLE_ICON'          => $role->role_icon,
            'ROLE_ICON_IMG' 	 => (strlen($role->role_icon) > 1) ? $this->ext_path . "images/role_icons/" . $role->role_icon . ".png" : '',
            'ROLE_COLOR'         => $role->role_color,
            'GAME_ID'            => $role->game_id,
            'GAME_NAME'          => $editgame->getName(),
            'IS_ADD'             => $add,
            'U_ACTION'           => append_sid("{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\game_module&amp;mode=addrole&amp;game_id=' . $editgame->game_id),
            'MSG_NAME_EMPTY'     => $this->user->lang ['FV_REQUIRED_NAME']));
        unset($role);

        $this->page_title = $this->user->lang['ROLE'];
        $this->tpl_name = 'acp_addrole';
    }

    /**
	 * lists game parameters
     * @param Game $editgame
     */
	private function showgame( Game $editgame)
	{
		global $phpbb_admin_path, $phpEx;

		//populate dropdown
		foreach ($this->gamelist as $key => $game)
		{
			$this->template->assign_block_vars('gamelistrow', array(
					'VALUE'      => $key,
					'OPTION'     => $game,
					'SELECTED'   => $editgame->game_id == $key ? ' selected="selected"' : '' ,
			));
		}

		// list the factions
		$listfactions = new Faction();
		$listfactions->game_id = $editgame->game_id;
		$fa = $listfactions->getfactions();
		$total_factions = 0;
		foreach($fa as $faction_id => $faction)
		{
			$total_factions ++;
			$this->template->assign_block_vars ( 'faction_row', array (
			'ID' => $faction['f_index'],
			'FACTIONGAME' => $editgame->game_id,
			'FACTIONID' => $faction['faction_id'],
			'FACTIONNAME' => $faction['faction_name'],
			'U_DELETE' => append_sid ( "{$phpbb_admin_path}index.$phpEx",
                    'i=\bbdkp\bbguild\acp\game_module&amp;mode=editgames&amp;action=deletefaction&amp;id=' . $faction['f_index'] . '&amp;' . URI_GAME . '=' . $editgame->game_id),
			'U_EDIT' => append_sid ( "{$phpbb_admin_path}index.$phpEx",
            'i=\bbdkp\bbguild\acp\game_module&amp;mode=editgames&amp;action=editfaction&amp;id=' . $faction['f_index'] . '&amp;' . URI_GAME . '=' . $editgame->game_id),
        ));
		}

		// list the races
		$sort_order = array (
			0 => array ('game_id asc, race_id asc', 'game_id desc, race_id asc' ),
			1 => array ('race_id', 'race_id desc' ),
			2 => array ('race_name', 'race_name desc' ),
			3 => array ('faction_name desc', 'faction_name, race_name desc'));
		$current_order = $this->switch_order ( $sort_order );
		$total_races = 0;

		$listraces = new Races();
		$listraces->game_id = $editgame->game_id;
		$ra = $listraces->listraces($current_order ['sql']);
		foreach ( $ra as $race_id => $race )
		{
			$total_races ++;
			$this->template->assign_block_vars ( 'race_row', array (
				'GAME' => $race['game_name'],
				'RACEID' => $race['race_id'],
				'RACENAME' => $race['race_name'],
				'FACTIONNAME' => $race['faction_name'],
				'RACE_IMAGE_M' => (strlen ( $race['image_male'] ) > 1) ? $this->ext_path . 'images/race_images/' . $race['image_male'] . ".png" : '',
				'RACE_IMAGE_F' => (strlen ( $race['image_female'] ) > 1) ? $this->ext_path . 'images/race_images/' . $race['image_female'] . ".png" : '',
				'S_RACE_IMAGE_M_EXISTS' => (strlen ( $race['image_male'] ) > 1) ? true : false,
				'S_RACE_IMAGE_F_EXISTS' => (strlen ( $race['image_female'] ) > 1) ? true : false,
				'U_VIEW_RACE' => append_sid ( "{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\game_module&amp;mode=addrace&amp;r=' . $race['race_id'] . '&amp;' . URI_GAME ."={$listraces->game_id}" ),
                'U_DELETE' =>  $this->u_action. "&amp;racedelete=1&amp;id={$race['race_id']}&amp;" . URI_GAME ."={$listraces->game_id}",
                'U_EDIT' =>  $this->u_action.   "&amp;raceedit=1&amp;id={$race['race_id']}&amp;" . URI_GAME ."={$listraces->game_id}",
            ) );
		}
		unset($listraces, $ra);


        // list the roles
        $sort_order = array (
            0 => array ('game_id asc, role_id asc', 'game_id desc, role_id asc' ),
            1 => array ('role_id', 'role_id desc' ),
            2 => array ('rolename', 'rolename desc' ));

        $current_order3 = $this->switch_order ( $sort_order );
        $listroles = new Roles();
        $listroles->game_id = $editgame->game_id;
        $total_roles=0;
        $roles = $listroles->listroles($current_order3 ['sql']);
        foreach ( $roles as $role_id => $role )
        {
            $total_roles++;
            $this->template->assign_block_vars('role_row', array(
                'ROLE_ID' 		=> $role['role_id'],
                'ROLE_NAME' 		=> $role['rolename'],
                'ROLE_COLOR' 	=> $role['role_color'],
                'ROLE_ICON' 		=> $role['role_icon'],
                'S_ROLE_ICON_EXISTS'	=>  (strlen($role['role_icon']) > 0) ? true : false,
                'U_ROLE_ICON' 	=> (strlen($role['role_icon']) > 0) ? $this->ext_path . "images/role_icons/" . $role['role_icon'] . ".png" : '',
                'ROLE_CAT_ICON' 		=> $role['role_cat_icon'],
                'S_ROLE_CAT_ICON_EXISTS'	=>  (strlen($role['role_cat_icon']) > 0) ? true : false,
                'U_ROLE_CAT_ICON' 	=> (strlen($role['role_cat_icon']) > 0) ? $this->ext_path . "images/role_icons/" . $role['role_cat_icon'] . ".png" : '',
                'U_DELETE' 		=> $this->u_action. '&amp;action=deleterole&amp;role_id=' . $role['role_id'] . '&amp;' .URI_GAME . "=" . $editgame->game_id  ,
                'U_EDIT' 		=> $this->u_action. '&amp;action=editrole&amp;role_id=' . $role['role_id'] . '&amp;' .URI_GAME . "=" . $editgame->game_id,
            ));
        }


		// list the classes
		$sort_order2 = array(
			0 => array ('c.game_id asc, c.class_id asc', 'c.game_id desc, c.class_id asc'),
			1 => array ('class_id', 'class_id desc' ),
			2 => array ('class_name', 'class_name desc'),
			3 => array ('class_armor_type', 'class_armor_type, class_id desc'),
			4 => array ('class_min_level', 'class_min_level, class_id desc' ),
			5 => array ('class_max_level', 'class_max_level, class_id desc' ));
		$current_order2 = $this->switch_order ( $sort_order2, "o1" );
		$total_classes = 0;

		$listclasses = new  Classes();
		$listclasses->game_id = $editgame->game_id;
		$cl = $listclasses->listclasses($current_order2['sql'], 1);
		foreach ( $cl as $c_index => $class )
		{
			$total_classes ++;
			$this->template->assign_block_vars ( 'class_row', array (
				'GAME' => $class['game_name'],
				'C_INDEX' => $c_index,
				'CLASSID' => $class ['class_id'],
				'CLASSNAME' => $class ['class_name'],
				'COLORCODE' => $class ['colorcode'],
				'CLASSARMOR' => (isset ( $this->user->lang [$class ['class_armor_type']] ) ? $this->user->lang [$class ['class_armor_type']] : ' '),
				'CLASSMIN' => $class ['class_min_level'],
				'CLASSMAX' => $class ['class_max_level'],
				'CLASSHIDE' => $class ['class_hide'],
				'S_CLASS_IMAGE_EXISTS' => (strlen ( $class ['imagename'] ) > 1) ? true : false,
				'CLASSIMAGE' => (strlen ( $class ['imagename'] ) > 1) ? $this->ext_path . "images/class_images/" . $class ['imagename'] . ".png" : '',
				'U_VIEW_CLASS' => append_sid ( "{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\game_module&amp;mode=addclass&amp;r=' . $class ['class_id'] . '&amp;game_id=' . $listclasses->game_id ),
				'U_DELETE' => append_sid ( "{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\game_module&amp;mode=editgames&amp;classdelete=1&amp;id=' . $class['class_id'] . '&amp;game_id=' . $listclasses->game_id ),
				'U_EDIT' => append_sid ( "{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\game_module&amp;mode=editgames&amp;classedit=1&amp;id=' . $class['class_id'] . '&amp;game_id=' . $listclasses->game_id ) ) );
		}

		unset ( $listclasses, $cl );

		$imgexists = file_exists($this->ext_path. 'images/bbguild/gameworld/'. $editgame->game_id. '/'. $editgame->getImagename() . '.png');

        //set the other fields
		$this->template->assign_vars ( array (
				'F_ENABLEARMORY' => $editgame->getArmoryEnabled() ,
				'GAMEIMAGEEXPLAIN' => sprintf($this->user->lang['GAME_IMAGE_EXPLAIN'], $editgame->game_id),
				'GAMEIMAGE' => $editgame->getImagename(),
                'GAME_NAME' => $editgame->getName(),
				'GAMEPATH' => $this->ext_path. 'images/bbguild/gameworld/'. $editgame->game_id. '/'. $editgame->getImagename() . '.png',
				'S_GAMEIMAGE_EXISTS' => (strlen($editgame->getImagename()) > 0 && $imgexists  ) ? true : false,
				'EDITGAME' => sprintf($this->user->lang['ACP_EDITGAME'], $editgame->getName()  ) ,
                'BOSSBASEURL' => $editgame->getBossbaseurl(),
                'ZONEBASEURL' => $editgame->getZonebaseurl(),
                'ISWOW'     => $editgame->game_id == 'wow' ? 1: 0,
                'APIKEY'    => $editgame->getApikey(),
                'PRIVKEY'    => $editgame->getPrivkey(),
				'LOCALE'  => $editgame->getApilocale(),
				'GAME_ID'   => $editgame->game_id,
				'URI_GAME' => URI_GAME,
				'O_RACEGAMEID' => $current_order ['uri'] [0],
				'O_RACEID' => $current_order ['uri'] [1],
				'O_RACENAME' => $current_order ['uri'] [2],
				'O_FACTIONNAME' => $current_order ['uri'] [3],

				'O_CLASSGAMEID' => $current_order2 ['uri'] [0],
				'O_CLASSID' => $current_order2 ['uri'] [1],
				'O_CLASSNAME' => $current_order2 ['uri'] [2],
				'O_CLASSARMOR' => $current_order2 ['uri'] [3],
				'O_CLASSMIN' => $current_order2 ['uri'] [4],
				'O_CLASSMAX' => $current_order2 ['uri'] [5],

				'U_ADD_GAMES' => append_sid ( "{$phpbb_admin_path}index.$phpEx", 'i=\bbdkp\bbguild\acp\game_module&amp;mode=editgames&amp;' ),
				'LISTFACTION_FOOTCOUNT' => sprintf ( $this->user->lang ['LISTFACTION_FOOTCOUNT'], $total_factions ),
				'LISTRACE_FOOTCOUNT' => sprintf ( $this->user->lang ['LISTRACE_FOOTCOUNT'], $total_races ),
				'LISTCLASS_FOOTCOUNT' => sprintf ( $this->user->lang ['LISTCLASS_FOOTCOUNT'], $total_classes ),
                'LISTROLES_FOOTCOUNT' => sprintf ( $this->user->lang ['LISTROLES_FOOTCOUNT'], $total_roles ),
				'U_ACTION' => $this->u_action ) );
	}

}
