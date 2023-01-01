<?php

/**
 * This file implement the Requeriments system class.
 *
 * This system class is used to check the system and
 * plugins requisites and inform the user with the
 * appropiate error messages when requisites fail.
 *
 * @author DecSoft Utils <info@decsoftutils.com>
 * @link https://www.decsoftutils.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C) Humm PHP - DecSoft Utils
 */

namespace Humm\System\Classes;

/**
 * System Requeriments class implementation.
 *
 * Part of the system boot strap this class check the
 * system and plugins possible requeriments and can
 * inform the user about possible requisites fails.
 *
 */
class Requeriments extends Unclonable
{
  /**
   * Check for system and plugins requisites.
   *
   * @static
   * @staticvar int $init Prevent twice execution.
   */
  public static function init()
  {
    static $init = 0;
    if (!$init) {
      $init = 1;
      // Order matter here
      self::systemCheck();
      HummPlugins::execSimpleAction(
       PluginActions::CHECK_REQUERIMENTS);
    }
  }

  /**
   * Check the Humm PHP system requisites.
   *
   * Use the \trigger_error() the times you need to specify
   * all possible requisites fails. The system is responsible
   * to shown this error messages later to the user.
   *
   * @static
   */
  private static function systemCheck()
  {
    // Check the first system requeriment...
    if (!true) {
      \trigger_error(t('Requeriment error...'), \E_USER_WARNING);
    }
    // Check the second system requeriment...
    if (!true) {
      \trigger_error(t('Requeriment error...'), \E_USER_WARNING);
    }
  }
}
