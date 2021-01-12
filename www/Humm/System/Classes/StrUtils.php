<?php

/**
 * This file implement the StrUtils system class.
 *
 * This class is intended to encapsulate string utils stuff
 * like constants and methods for string manipulation.
 *
 * @author D. Esperalta <info@decsoftutils.com>
 * @link https://www.decsoftutils.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2021 Humm PHP - David Esperalta
 */

namespace Humm\System\Classes;

/**
 * System StrUtils class implementation.
 *
 * This system class can be used both in system and
 * user sites for string manipulation.
 *
 */
class StrUtils extends Unclonable
{
  /**
   * Define a dot.
   */
  const DOT = '.';

  /**
   * Define an empty string.
   */
  const EMPTY_STRING = '';

  /**
   * Define an URL separator.
   */
  const URL_SEPARATOR = '/';

  /**
   * Define a PHP namespace separator.
   */
  const PHP_NS_SEPARATOR = '\\';

  /**
   * Find if the specified string is empty.
   *
   * @static
   * @param string $string String to be evaluated.
   * @return boolean True if string is empty, False if not.
   */
  public static function isEmpty($string)
  {
    return $string === self::EMPTY_STRING;
  }

  /**
   * Find if the specified string is empty after trim.
   *
   * @static
   * @param string $string String to be evaluated.
   * @return boolean True if string is empty, False if not.
   */
  public static function isTrimEmpty($string)
  {
    return \trim($string) === self::EMPTY_STRING;
  }
}
