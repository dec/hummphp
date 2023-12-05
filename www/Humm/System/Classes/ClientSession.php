<?php

/**
 * This file implement the ClientSession system class.
 *
 * Humm PHP use this class to start and in general to
 * work with the PHP user session.
 *
 * @author DecSoft Utils <info@decsoftutils.com>
 * @link https://www.decsoftutils.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C) Humm PHP - DecSoft Utils
 */

namespace Humm\System\Classes;

/**
 * System BootStrap class implementation.
 *
 * This is a system internal Humm PHP class wich also
 * can be used by site plugins, site views, etc. in
 * order to work with the user session.
 */
class ClientSession extends Unclonable
{
  const
    /**
     * Define the user language variable
     *
     * We use this key to save the Humm PHP language
     * into the appropiate user session variable.
     */
    HUMM_LANGUAGE = 'Humm.Language';

  /**
   * Set the value of an user session variable.
   *
   * @static
   * @param string $name Session variable name
   * @param mixed $value Session variable value
   */
  public static function setVar($name, $value)
  {
    $_SESSION[$name] = $value;
  }

  /**
   * Unset an user session variable.
   *
   * @static
   * @param string $name Session variable name
   */
  public static function unsetVar($name)
  {
    if (isset($_SESSION[$name])) {
      unset($_SESSION[$name]);
    }
  }
}
