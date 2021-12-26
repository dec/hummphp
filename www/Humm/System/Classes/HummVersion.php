<?php

/**
 * This file implement the HummVersion system class.
 *
 * This class just setup the appropiate Humm PHP
 * version related constants.
 *
 * @author DecSoft Utils <info@decsoftutils.com>
 * @link https://www.decsoftutils.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2022 Humm PHP - DecSoft Utils
 */

namespace Humm\System\Classes;

/**
 * System HummVersion class implementation.
 *
 * Put available the Humm PHP version related constants.
 */
class HummVersion extends Unclonable
{
  /**
   * Require the file in which Humm PHP version is defined.
   *
   * @static
   * @staticvar int $init Prevent twice execution.
   */
  public static function init()
  {
    static $init = 0;
    if (!$init) {
      $init = 1;
      require FilePaths::systemVersion();
    }
  }
}
