<?php
/**
 *
 * @package bbguild v2.0
 * @copyright 2016 bbDKP <https://github.com/bbDKP>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace bbdkp\bbguild;

use phpbb\extension\base;

class ext extends base
{
    /**
     * override enable step
     * enable_step is executed on enabling an extension until it returns false.
     *
     * Calls to this function can be made in subsequent requests, when the
     * function is invoked through a webserver with a too low max_execution_time.
     *
     * @param	mixed	$old_state	The return value of the previous call
     *								of this method, or false on the first call
     * @return	mixed				Returns false after last step, otherwise
     *								temporary state which is passed as an
     *								argument to the next step
     */
    function enable_step($old_state)
    {
        ini_set('max_execution_time', 300);
        return parent::enable_step($old_state);
    }
}
