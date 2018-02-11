<?php

/**
 * This file implement the Localization system class.
 *
 * This class offer a way to works with locale data like
 * months and days in a convenient way.
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link https://www.davidesperalta.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2018 Humm PHP - David Esperalta
 */

namespace Humm\System\Classes;

/**
 * System Localization class implementation.
 *
 * System and user site can use this class to works
 * with locale data, for example, retrieving month
 * and day names well localized.
 */
class Localization extends Unclonable
{
  /**
   * Locale data information.
   *
   * @var array
   */
  private static $map = null;

  /**
   * Store the locale data information.
   *
   * @static
   * @staticvar int $init Prevent twice execution.
   */
  public static function init()
  {
    static $init = 0;
    if (!$init) {
      $init = 1;
      self::$map = LocalizationMap::getMap();
    }
  }

  /**
   * Retrieve a localized day name (english by default).
   *
   * @static
   * @param int $dayNumber Day number.
   * @return string Localized day name.
   */
  public static function getDayName($dayNumber)
  {
    if (isset(self::$map[LocalizationMap::DAYS][$dayNumber])) {
      return self::$map[LocalizationMap::DAYS][$dayNumber];
    }
  }

  /**
   * Retrieve localized day names (english by default).
   *
   * @static
   * @return arrau Localized day names.
   */
  public static function getDayNames()
  {
    if (isset(self::$map[LocalizationMap::DAYS])) {
      return self::$map[LocalizationMap::DAYS];
    }
  }

  /**
   * Retrieve a localized day abbreviation (english by default).
   *
   * @static
   * @param int $dayName Localized day name.
   * @return string Localized day abbreviation.
   */
  public static function getDayAbbr($dayName)
  {
    if (isset(self::$map[LocalizationMap::DAYS_ABBR][$dayName])) {
      return self::$map[LocalizationMap::DAYS_ABBR][$dayName];
    }
  }

  /**
   * Retrieve a localized day initial (english by default).
   *
   * @static
   * @param int $dayName Localized day name.
   * @return string Localized day initial.
   */
  public static function getDayInitial($dayName)
  {
    if (isset(self::$map[LocalizationMap::DAYS_INIT][$dayName])) {
      return self::$map[LocalizationMap::DAYS_INIT][$dayName];
    }
  }

  /**
   * Retrieve localized month names (english by default).
   *
   * @static
   * @return arrau Localized month names.
   */
  public static function getMonthNames()
  {
    if (isset(self::$map[LocalizationMap::MONTHS])) {
      return self::$map[LocalizationMap::MONTHS];
    }
  }

  /**
   * Retrieve a localized month name (english by default).
   *
   * @static
   * @param int $monthNumber Month number.
   * @return string Localized month name.
   */
  public static function getMonthName($monthNumber)
  {
    if (isset(self::$map[LocalizationMap::MONTHS][$monthNumber])) {
      return self::$map[LocalizationMap::MONTHS][$monthNumber];
    }
  }

  /**
   * Retrieve a localized month abbreviation.
   *
   * @static
   * @param int $monthNumber Month number.
   * @return string Localized month abbreviation.
   */
  public static function getMonthAbbr($monthNumber)
  {
    if (isset(self::$map[LocalizationMap::MONTHS_ABBR][$monthNumber])) {
      return self::$map[LocalizationMap::MONTHS_ABBR][$monthNumber];
    }
  }

  /**
   * Retrieve a localized meridiem.
   *
   * The meridiem param can be one of the Localization::MERIDIEM_* constants.
   *
   * @static
   * @param string $meridiem English lower or uppercase meridiam.
   * @return string Localized meridiam.
   */
  public static function getMeridiem($meridiem)
  {
    if (isset(self::$map[LocalizationMap::MERIDIAMS][$meridiem])) {
      return self::$map[LocalizationMap::MERIDIAMS][$meridiem];
    }
  }
}
