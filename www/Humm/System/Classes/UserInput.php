<?php

/**
 * This file implement the UserInput system class.
 *
 * This class is intended to offer a convenient way
 * to access diferents user input variables.
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link http://www.davidesperalta.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2017 Humm PHP - David Esperalta
 */

namespace Humm\System\Classes;

/**
 * System UserInput class implementation.
 *
 * Provide stuff to deal with user input variables using the
 * appropiate input filters instead of accessing it directly.
 *
 */
class UserInput extends Unclonable
{
  /**
   * Retrieve an INPUT_GET variable or execute a filter.
   *
   * @static
   * @param string $varName Variable name to be retrieved.
   * @param mixed $defaultValue Default value to fall out.
   * @param int $filter Input filter to be applied.
   * @return mixed The resulted variable value or filter result.
   */
  public static function get($varName, $defaultValue = null,
   $filter = \FILTER_DEFAULT)
  {
    return self::getVariable($varName,
     \INPUT_GET, $defaultValue, $filter);
  }

  /**
   * Retrieve an INPUT_POST variable or execute a filter.
   *
   * @static
   * @param string $varName Variable name to be retrieved.
   * @param mixed $defaultValue Default value to fall out.
   * @param int $filter Input filter to be applied.
   * @return mixed The resulted variable value or filter result.
   */
  public static function post($varName, $defaultValue = null,
   $filter = \FILTER_DEFAULT)
  {
    return self::getVariable($varName,
     \INPUT_POST, $defaultValue, $filter);
  }

  /**
   * Retrieve an INPUT_SERVER variable or execute a filter.
   *
   * @todo Use the filter input instead of $_SERVER direct access.
   * @static
   * @param string $varName Variable name to be retrieved.
   * @param mixed $defaultValue Default value to fall out.
   * @param int $filter Input filter to be applied.
   * @return mixed The resulted variable value or filter result.
   */
  public static function server($varName, $defaultValue = null,
   $filter = \FILTER_DEFAULT)
  {
    $result = $defaultValue;
    // For some reason we cannot use filter_input with
    // INPUT_SERVER in certain PHP versions or servers... (?)
    if (isset($_SERVER[$varName])) {
      $result = \filter_var($_SERVER[$varName], $filter);
    }
    return $result;
  }

  /**
   * Retrieve an INPUT_SESSION variable or execute a filter.
   *
   * @todo Use the filter input instead of $_SESSION direct access.
   * @static
   * @param string $varName Variable name to be retrieved.
   * @param mixed $defaultValue Default value to fall out.
   * @param int $filter Input filter to be applied.
   * @return mixed The resulted variable value or filter result.
   */
  public static function session($varName, $defaultValue = null,
   $filter = \FILTER_DEFAULT)
  {
    // For some reason we cannot use filter_input with
    // INPUT_SESSION in certain PHP versions or servers... (?)
    $result = $defaultValue;
    if (isset($_SESSION[$varName])) {
      $result = \filter_var($_SESSION[$varName], $filter);
    }
    return $result;
  }

  /**
   * Retrieve an INPUT_COOKIE variable or execute a filter.
   *
   * @static
   * @param string $varName Variable name to be retrieved.
   * @param mixed $defaultValue Default value to fall out.
   * @param int $filter Input filter to be applied.
   * @return mixed The resulted variable value or filter result.
   */
  public static function cookie($varName, $defaultValue = null,
   $filter = \FILTER_DEFAULT)
  {
    return self::getVariable($varName,
     \INPUT_COOKIE, $defaultValue, $filter);
  }

  /**
   * Retrieve a variable from the specified INPUT type.
   *
   * @param string $varName Variable name to be retrieved.
   * @param int $inputType One of the availables input filter.
   * @param mixed $defaultValue Default value to fall out.
   * @param int $filter Input filter to be applied.
   *  @return mixed The resulted variable value or filter result.
   */
  private static function getVariable($varName, $inputType,
   $defaultValue = null, $filter = \FILTER_DEFAULT)
  {
    $result = $defaultValue;
    if (\filter_has_var($inputType, $varName)) {
      $result = \filter_input($inputType, $varName, $filter);
    }
    return $result;
  }
}
