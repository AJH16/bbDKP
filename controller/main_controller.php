<?php
/**
 * @package bbguild
 * @copyright 2016 bbDKP <https://github.com/bbDKP>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace bbdkp\bbguild\controller;

class main
{
	/* @var \phpbb\config\config */
	protected $config;

	/* @var \phpbb\config\db_text */
	protected $config_text;

	/* @var \phpbb\controller\helper */
	protected $helper;

	/* @var \phpbb\template\template */
	protected $template;

	/* @var \phpbb\user */
	protected $user;

	/* @var string phpEx */
	protected $php_ext;

	/**
	* Constructor
	*
	* @param \phpbb\config\config		$config
	* @param \phpbb\config\db_text		$config_text
	* @param \phpbb\controller\helper	$helper
	* @param \phpbb\template\template	$template
	* @param \phpbb\user				$user
	* @param string						$php_ext	phpEx
	*/
	public function __construct(\phpbb\config\config $config,
                                \phpbb\config\db_text $config_text,
                                \phpbb\controller\helper $helper,
                                \phpbb\template\template $template,
                                \phpbb\user $user,
                                $php_ext)
	{
		$this->config 	= $config;
		$this->helper 	= $helper;
		$this->template = $template;
		$this->user 	= $user;
		$this->php_ext 	= $php_ext;
		$this->config_text = $config_text;
	}

    /**
     * Controller for route app.php/dkp.php and /dkp
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
	public function handleRaid($raid_id)
    {
        if ($this->config['acme_demo_goodbye'] == 'DEMO_HELLO')
        {
            $l_message = 'DEMO_GOODBYE';
        } else
        {
            $l_message = 'DEMO_HELLO';
        }
        $a = $this->user->lang($l_message, $raid_id);
        $this->template->assign_var('DEMO_MESSAGE', $a);
        $err = $this->helper->error('True is somehow identical to false. The world is over.', 500);
        // full rendered page source that will be output on the screen.
        $response = $this->helper->render('dkp/dkpmain.html', $raid_id);
        return $response;
    }

    /**
     * Controller for route app.php/dkp.php and /dkp
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handleGuild($guild_id)
    {
        if ($this->config['acme_demo_goodbye'] == 'DEMO_HELLO')
        {
            $l_message = 'DEMO_GOODBYE';
        } else
        {
            $l_message = 'DEMO_HELLO';
        }
        $a = $this->user->lang($l_message, $guild_id);
        $this->template->assign_var('DEMO_MESSAGE', $a);
        $err = $this->helper->error('True is somehow identical to false. The world is over.', 500);
        // full rendered page source that will be output on the screen.
        $response = $this->helper->render('dkp/dkpmain.html', $guild_id);
        return $response;
    }


    /**
     * Controller for route app.php/dkp.php and /dkp
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handlePlayer($player_id)
    {
        if ($this->config['acme_demo_goodbye'] == 'DEMO_HELLO')
        {
            $l_message = 'DEMO_GOODBYE';
        } else
        {
            $l_message = 'DEMO_HELLO';
        }
        $a = $this->user->lang($l_message, $player_id);
        $this->template->assign_var('DEMO_MESSAGE', $a);
        $err = $this->helper->error('True is somehow identical to false. The world is over.', 500);
        // full rendered page source that will be output on the screen.
        $response = $this->helper->render('dkp/dkpmain.html', $player_id);
        return $response;
    }
}
