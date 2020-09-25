<?php

/**
 * This file implement the PluginArguments system class.
 *
 * This class is intended to be inherited by the system
 * ActionArguments and FilterArguments classes.
 *
 * @author D. Esperalta <info@decsoftutils.com>
 * @link https://www.decsoftutils.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2019 Humm PHP - David Esperalta
 */

namespace Humm\System\Classes;

/**
 * System PluginArguments class implementation.
 *
 * To be inherited by system ActionArguments and
 * FilterArguments classes provide the basic logic
 * for a plugin arguments object.
 *
 * Everytime the system want to perform a filter or an
 * action over the available plugins they prepare a bunch
 * of filter or action arguments into the appropiate
 * FilterArguments or ActionArguments classes.
 *
 * @abstract
 */
abstract class PluginArguments extends BaseClass
{
  /**
   * Property name to store the bundle part of the arguments.
   */
  const BUNDLE = 'bundle';

  /**
   * Property name to store the content part of the arguments.
   */
  const CONTENT = 'content';

  /**
   * Plugin arguments bundle.
   *
   * @var mixed
   */
  public $bundle = null;

  /**
   * Plugin arguments content.
   *
   * @var mixed
   */
  public $content = null;

  /**
   * Magic method for direct access this object properties.
   *
   * @param string $variableName Variable name.
   * @return mixed Object property value.
   */
  public function __get($variableName)
  {
    return $this->$variableName;
  }

  /**
   * Construct a PluginArguments object.
   *
   * @param array $arguments Associative array with arguments.
   */
  public function __construct($arguments = array())
  {
    $this->bundle = null;
    $this->content = null;
    // Put the array arguments as this object properties
    foreach ($arguments as $propertyName => $propertyValue) {
      $this->$propertyName = $propertyValue;
    }
  }
}
