<?php

/**
 * This file implement the FileNames system class.
 *
 * Humm PHP use this class to define not localizables,
 * case sensitive file names of Humm PHP.
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link https://www.davidesperalta.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2018 Humm PHP - David Esperalta
 */

namespace Humm\System\Classes;

/**
 * System FileNames class implementation.
 *
 * Define certain not localizables, case sensitive
 * sytem and user sites file names.
 */
class FileNames extends Unclonable
{
  /**
   * Define the configurations files name.
   */
  const CONFIG = 'Config.php';

  /**
   * Define the system version file name.
   */
  const VERSION = 'Version.php';

  /**
   * Define the system I18n functions file name.
   */
  const I18N_FUNCTIONS = 'I18nFunctions.php';

  /**
   * Define an index PHP file: like Humm PHP entry point.
   */
  const PHP_INDEX = 'index.php';
}
