<?php
/**
 * Scabbia2 Tasks Component
 * http://www.scabbiafw.com/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @link        https://github.com/scabbiafw/scabbia2-tasks for the canonical source repository
 * @copyright   2010-2015 Scabbia Framework Organization. (http://www.scabbiafw.com/)
 * @license     http://www.apache.org/licenses/LICENSE-2.0 - Apache License, Version 2.0
 */

namespace Scabbia\Tasks;

use Scabbia\Formatters\FormatterInterface;
use Scabbia\Formatters\Formatters;
use Scabbia\Tasks\TaskBase;

/**
 * A small command line implementation which helps us during the development of
 * Scabbia2 PHP Framework's itself and related production code
 *
 * @package     Scabbia\Tasks
 * @author      Eser Ozvataf <eser@ozvataf.com>
 * @since       2.0.0
 */
class Tasks
{
    /** @type string base class */
    const BASE_CLASS = "\\Scabbia\\Tasks\\TaskBase";


    /** @type array  task namespaces */
    public static $namespaces = [
        "Scabbia"
    ];


    /**
     * Resolves given task name into class name
     *
     * @param string $uTask task name
     *
     * @return string resolved class name
     */
    public static function taskClassName($uTask)
    {
        $tOutput = "\\";
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

        $tClassName = "{$tOutput}Task";
        if (is_subclass_of($tClassName, self::BASE_CLASS)) {
            return $tClassName;
        }

        foreach (self::$namespaces as $tNamespace) {
            $tClassName = "\\{$tNamespace}{$tOutput}Task";

            if (is_subclass_of($tClassName, self::BASE_CLASS)) {
                return $tClassName;
            }
        }

        return null;
    }

    /**
     * Runs given task
     *
     * @param string             $uTask        name of the task
     * @param array              $uParameters  set of parameters
     * @param FormatterInterface $uFormatter   formatter class
     *
     * @return int exit code
     */
    public static function run($uTask, array $uParameters, $uFormatter = null)
    {
        if ($uFormatter === null) {
            $uFormatter = Formatters::getCurrent();
        }

        if ($tHelpCommand = ($uTask === "help")) {
            $uTask = array_shift($uParameters);
        }

        if ($uTask === null) {
            $uFormatter->write("Please specify a task");
            return 1;
        }

        $tClassName = self::taskClassName($uTask);
        if ($tClassName === null) {
            $uFormatter->write(sprintf("Task not found - %s", $uTask));
            return 1;
        }

        try {
            $tInstance = new $tClassName ();
            if ($tHelpCommand) {
                $tInstance->help($uFormatter);
                return 0;
            }

            return $tInstance->executeTask($uParameters, $uFormatter);
        } catch (\Exception $ex) {
            $uFormatter->write(sprintf("%s: %s", get_class($ex), $ex->getMessage()));
            return 1;
        }
    }
}
