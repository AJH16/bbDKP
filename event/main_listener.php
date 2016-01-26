<?php
/**
 * @package bbguild v2.0
 * @copyright 2016 bbDKP <https://github.com/bbDKP>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace bbdkp\bbguild\event;

use phpbb\config\config;
use phpbb\controller\helper;
use phpbb\template\template;
use phpbb\user;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Event listener
 */
class main_listener implements EventSubscriberInterface
{
    /* @var helper */
    protected $helper;

    /* @var template */
    protected $template;

    /* @var user */
    protected $user;

    /* @var config */
    protected $config;

    /**
    x
     *
     * @param helper $helper Controller helper object
     * @param \phpbb\template|template $template Template object
     * @param user $user
     * @param config $config
     */

    /**
     * @param helper $helper
     * @param template $template
     * @param user $user
     * @param config $config
     */
    public function __construct(helper $helper,
                                template $template,
                                user $user,
                                config $config
    )
    {
        $this->helper = $helper;
        $this->template = $template;
        $this->user = $user;
        $this->config = $config;
    }


    /**
     * Assign functions defined in this class to event listeners in the core
     *
     * @return array
     */
    static public function getSubscribedEvents()
    {
        return array(
            // for all defined events, write a function below
            'core.permissions'						=> 'add_permission_cat',
            'core.user_setup'						=> 'load_language_on_setup',
            'core.page_header'						=> 'add_page_header_link',
        );
    }

    /**
     * core.user_setup
     * @param $event
     */
    public function load_language_on_setup($event)
    {
        $lang_set_ext = $event['lang_set_ext'];
        $lang_set_ext[] = array(
            'ext_name' => 'bbdkp/bbguild',
            'lang_set' => array('common','admin') ,
        );
        $event['lang_set_ext'] = $lang_set_ext;
    }


    /**
     * core.page_header
     * @param $event
     */
    public function add_page_header_link($event)
    {
        $this->template->assign_vars(array(
            'U_BBGUILD'	=> $this->helper->route('bbdkp_bbguild_00',
                array('guild_id' => 1)),
        ));
    }


    /**
     * bbGuild permission category
     * @param $event
     */
    public function add_permission_cat($event)
    {
        $perm_cat = $event['categories'];
        $perm_cat['bbguild'] = 'ACP_BBGUILD';
        $event['categories'] = $perm_cat;

        $permission = $event['permissions'];
        $permission['a_bbguild']	= array('lang' => 'ACL_A_BBGUILD',		'cat' => 'bbguild');
        $permission['u_bbguild']	= array('lang' => 'ACL_U_BBGUILD',		'cat' => 'bbguild');
        $permission['u_charclaim']	= array('lang' => 'ACL_U_CHARCLAIM',	'cat' => 'bbguild');
        $permission['u_charadd']	= array('lang' => 'ACL_U_CHARADD',	    'cat' => 'bbguild');
        $permission['u_chardelete']	= array('lang' => 'ACL_U_CHARUPDATE',	'cat' => 'bbguild');
        $permission['u_charupdate']	= array('lang' => 'ACL_U_CHARDELETE',	'cat' => 'bbguild');
        $event['permissions'] = $permission;
    }

}
