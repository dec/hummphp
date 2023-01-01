<?php

/**
 * This file implement the FileExts system class.
 *
 * Humm PHP use this class to define not localizables,
 * case sensitive file extensions of Humm PHP.
 *
 * @author DecSoft Utils <info@decsoftutils.com>
 * @link https://www.decsoftutils.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C) Humm PHP - DecSoft Utils
 */

namespace Humm\System\Classes;

/**
 * System FileExts class implementation.
 *
 * Define certain not localizables, case sensitive of the
 * sytem and also the user sites file extensions.
 */
class FileExts extends Unclonable
{
  /**
   * Define a PHP file extension.
   */
  const PHP = 'php';

  /**
   * Define a MO file dotted extension.
   */
  const DOT_MO = '.mo';

  /**
   * Define a PHP file dotted extension.
   */
  const DOT_PHP = '.php';
}
