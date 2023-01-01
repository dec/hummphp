<?php

/**
 * This file implement the ActionArguments system class.
 *
 * Humm PHP use this class when a plugin action is execued:
 * this class encapsulate the available action arguments.
 *
 * @author DecSoft Utils <info@decsoftutils.com>
 * @link https://www.decsoftutils.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C) Humm PHP - DecSoft Utils
 */

namespace Humm\System\Classes;

/**
 * System ActionArguments class implementation.
 *
 * This class can be used by system and site plugins
 * to access the executed actions arguments.
 */
class ActionArguments extends PluginArguments
{
  /**
   * Define the name of the action ID property.
   *
   * We use this when need to provide the appropiate
   * plugin action ID for the executing plugin action.
   */
  const ACTION = 'action';

  /**
   * Plugin arguments action ID.
   *
   * @var int
   */
  public $action = null;

  /**
   * Construct an ActionArguments object.
   *
   * @param array $arguments Action arguments associated array
   */
  public function __construct($arguments = array())
  {
    $this->action = null;
    parent::__construct($arguments);
  }
}
