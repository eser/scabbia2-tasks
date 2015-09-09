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

/**
 * Default methods needed for implementation of a task
 *
 * @package     Scabbia\Tasks
 * @author      Eser Ozvataf <eser@sent.com>
 * @since       2.0.0
 */
abstract class TaskBase
{
    /**
     * Initializes a task
     *
     * @return TaskBase
     */
    public function __construct()
    {
    }

    /**
     * Executes the task
     *
     * @param array $uParameters parameters
     *
     * @return int exit code
     */
    abstract public function executeTask(array $uParameters);

    /**
     * Returns the usage form and list of available parameters
     *
     * @return array usage summary
     */
    abstract public function help();
}
