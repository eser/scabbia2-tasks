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

/**
 * Default methods needed for implementation of a task
 *
 * @package     Scabbia\Tasks
 * @author      Eser Ozvataf <eser@ozvataf.com>
 * @since       2.0.0
 */
abstract class TaskBase
{
    /**
     * Initializes a task
     */
    public function __construct()
    {
    }

    /**
     * Executes the task
     *
     * @param array              $uParameters  parameters
     * @param FormatterInterface $uFormatter   formatter class
     *
     * @return int exit code
     */
    abstract public function executeTask(array $uParameters, FormatterInterface $uFormatter);

    /**
     * Returns the usage form and list of available parameters
     *
     * @param FormatterInterface $uFormatter   formatter class
     *
     * @return void
     */
    abstract public function help(FormatterInterface $uFormatter);
}
