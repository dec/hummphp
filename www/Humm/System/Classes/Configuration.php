<?php

/**
 * This file implement the Configuration system class.
 *
 * Humm PHP use this class to setup the appropiate
 * system and user site configuration.
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link https://www.davidesperalta.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2018 Humm PHP - David Esperalta
 */

namespace Humm\System\Classes;

/**
 * System Configuration class implementation.
 *
 * This is a system internal Humm PHP class and do not
 * contain useful stuff from the site point of view.
 */
class Configuration extends Unclonable
{
  /**
   * Setup the Humm PHP configuration.
   *
   * @static
   * @staticvar int $init Prevent twice execution.
   */
  public static function init()
  {
    static $init = 0;
    if (!$init) {
      $init = 1;
      $siteConfig = FilePaths::siteConfig();
      if (\file_exists($siteConfig)) {
        require $siteConfig;
      }
      // Always after site config
      require FilePaths::systemConfig();
    }
  }
}
