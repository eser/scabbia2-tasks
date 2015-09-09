<?php
/**
 * Scabbia2 PHP Framework Code
 * http://www.scabbiafw.com/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @link        http://github.com/scabbiafw/scabbia2-fw for the canonical source repository
 * @copyright   2010-2015 Scabbia Framework Organization. (http://www.scabbiafw.com/)
 * @license     http://www.apache.org/licenses/LICENSE-2.0 - Apache License, Version 2.0
 */

namespace Scabbia\Tasks;

use Scabbia\Interfaces\IInterface;
use Scabbia\Interfaces\Interfaces;
use Scabbia\Tasks\TaskBase;

/**
 * A small command line implementation which helps us during the development of
 * Scabbia2 PHP Framework's itself and related production code
 *
 * @package     Scabbia\Tasks
 * @author      Eser Ozvataf <eser@sent.com>
 * @since       2.0.0
 */
class Tasks
{
    /**
     * Transforms given task name into correct form
     *
     * @param string $uTask task name
     *
     * @return string task name in correct form
     */
    public static function taskName($uTask)
    {
        $tOutput = "";
        $tCapital = true;

        for ($tPos = 0, $tLen = strlen($uTask); $tPos < $tLen; $tPos++) {
            $tChar = $uTask[$tPos];

            if ($tChar === ":") {
                $tOutput .= "\\";
                $tCapital = true;
                continue;
            }

            if ($tCapital) {
                $tOutput .= strtoupper($tChar);
                $tCapital = false;
                continue;
            }

            $tOutput .= $tChar;
        }

        return "\\{$tOutput}Task";
    }

    /**
     * Runs given task
     *
     * @param string     $uName        name of the task
     * @param array      $uParameters  set of parameters
     * @param IInterface $uInterface   interface class
     *
     * @return int exit code
     *
     * @todo pass current interface to task
     */
    public static function run($uTask, array $uParameters, $uInterface = null)
    {
        if ($uInterface === null) {
            $uInterface = Interfaces::getCurrent();
        }

        if ($tHelpCommand = ($uTask === "help")) {
            $uTask = array_shift($uParameters);
        }

        if ($uTask === null) {
            $uInterface->write("Please specify a task");
            return 1;
        }

        $uTaskPath = self::taskName($uTask);

        if (!is_subclass_of($uTaskPath, "\\Scabbia\\Tasks\\TaskBase")) {
            // try again with \Scabbia prefix.
            $uTaskPath = "\\Scabbia{$uTaskPath}";

            if (!is_subclass_of($uTaskPath, "\\Scabbia\\Tasks\\TaskBase")) {
                $uInterface->write(sprintf("Task not found - %s", $uTask));
                return 1;
            }
        }

        try {
            $tInstance = new $uTaskPath ();
            if ($tHelpCommand) {
                $tInstance->help($uInterface);
                return 0;
            }

            return $tInstance->executeTask($uParameters, $uInterface);
        } catch (\Exception $ex) {
            $uInterface->write(sprintf("%s: %s", get_class($ex), $ex->getMessage()));
            return 1;
        }
    }
}
