<?php

/**
 * This file implement the HummVersion system class.
 *
 * This class just setup the appropiate Humm PHP
 * version related constants.
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link https://www.davidesperalta.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2018 Humm PHP - David Esperalta
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
