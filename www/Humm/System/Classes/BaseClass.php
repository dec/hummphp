<?php

/**
 * This file implement the BaseClass system class.
 *
 * Humm PHP use this class as a base for almost all
 * other system classes.
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link http://www.davidesperalta.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2017 Humm PHP - David Esperalta
 */

namespace Humm\System\Classes;

/**
 * System BaseClass class implementation.
 *
 * This class can be used by system and site classes
 * as a convenient PHP base class for use in Humm PHP.
 *
 * @abstract
 */
abstract class BaseClass extends \StdClass
{
  /**
   * Retrieve the calling class directory URL.
   *
   * @return string The calling class directory URL.
   */
  protected function getClassDirUrl()
  {
    return self::doGetClassDirUrl(\get_class($this));
  }

  /**
   * Retrieve the calling class directory path.
   *
   * @return string The calling class directory path.
   */
  protected function getClassDirPath()
  {
    return self::doGetClassDirPath(\get_class($this));
  }

  /**
   * Retrieve the calling class directory URL.
   *
   * @static
   * @return string The calling class directory path.
   */
  protected static function getClassDirUrlEx()
  {
    return self::doGetClassDirUrl(\get_called_class());
  }

  /**
   * Retrieve the calling class directory path.
   *
   * @static
   * @return string The calling class directory path.
   */
  protected static function getClassDirPathEx()
  {
    return self::doGetClassDirPath(\get_called_class());
  }

  /**
   * Retrieve the directory URL for the specified class.
   *
   * @static
   * @param type $class Qualified class name.
   * @return string The class directory path.
   */
  private static function doGetClassDirUrl($class)
  {
    return UrlPaths::root().
     \str_replace(
       StrUtils::PHP_NS_SEPARATOR,
       StrUtils::URL_SEPARATOR,
       \trim($class, \basename($class)));
  }

  /**
   * Retrieve the directory path for the specified class.
   *
   * @static
   * @param type $class Qualified class name.
   * @return string The class directory path.
   */
  private static function doGetClassDirPath($class)
  {
    return DirPaths::root().
     \str_replace(
       StrUtils::PHP_NS_SEPARATOR,
       \DIRECTORY_SEPARATOR,
       \trim($class, \basename($class)));
  }
}
