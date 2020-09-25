<?php

/**
 * This file implement the LocalizationMap system class.
 *
 * This class provide with the appropiate localized information
 * only to be used by the Localization class. Use the Localization
 * instead of this class to deal with the localization.
 *
 * @author D. Esperalta <info@decsoftutils.com>
 * @link https://www.decsoftutils.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2019 Humm PHP - David Esperalta
 */

namespace Humm\System\Classes;

/**
 * System LocalizationMap class implementation.
 *
 * The idea of this class come from an old Wordpress.org PHP class
 * and provide with a way to work with localized months, days, etc.
 */
class LocalizationMap extends Unclonable
{
  /**
   * Define the days key for use in the locale information map.
   */
  const DAYS = 'days';

  /**
   * Define the days abbreviation key for use in the locale information map.
   */
  const DAYS_ABBR = 'daysAbbr';

  /**
   * Define the days initials key for use in the locale information map.
   */
  const DAYS_INIT = 'daysInit';

  /**
   * Define the months key for use in the locale information map.
   */
  const MONTHS = 'months';

  /**
   * Define the month abbreviations key for use in the locale information map.
   */
  const MONTHS_ABBR = 'monthsAbbr';

  /**
   * Define the meridiams key for use in the locale information map.
   */
  const MERIDIAMS = 'meridiams';

  /**
   * Define the default (english) "am" lower meridiem.
   */
  const MERIDIEM_AM_LOWER = 'am';

  /**
   * Define the default (english) "AM" upper meridiem.
   */
  const MERIDIEM_AM_UPPER = 'AM';

  /**
   * Define the default (english) "pm" lower meridiem.
   */
  const MERIDIEM_PM_LOWER = 'pm';

  /**
   * Define the default (english) "PM" lower meridiem.
   */
  const MERIDIEM_PM_UPPER = 'PM';

  /**
   * Localized information map.
   *
   * @var array
   */
  private static $map = null;

  /**
   * Retrieve the locale information map.
   *
   * @static
   * @return array Associative array with locale information.
   */
  public static function getMap()
  {
    if (self::$map === null) {
      self::$map = array();
      self::setMeridiams();

      self::setDays();
      // After set days
      self::setDayAbbrevs();
      self::setDayInitials();

      self::setMonths();
      // After set months
      self::setMonthAbbrevs();
    }
    return self::$map;
  }

  /**
   * Localize and store meridiams.
   *
   * @static
   */
  private static function setMeridiams()
  {
    $m = self::$map;
    $m[self::MERIDIAMS][self::MERIDIEM_AM_LOWER] = t('am');
    $m[self::MERIDIAMS][self::MERIDIEM_PM_LOWER] = t('pm');
    $m[self::MERIDIAMS][self::MERIDIEM_AM_UPPER] = t('AM');
    $m[self::MERIDIAMS][self::MERIDIEM_PM_UPPER] = t('PM');
    self::$map = $m;
  }

  /**
   * Localize and store day names.
   *
   * @static
   */
  private static function setDays()
  {
    $m = self::$map;
    $m[self::DAYS][1] = t('Monday');
    $m[self::DAYS][2] = t('Tuesday');
    $m[self::DAYS][3] = t('Wednesday');
    $m[self::DAYS][4] = t('Thursday');
    $m[self::DAYS][5] = t('Friday');
    $m[self::DAYS][6] = t('Saturday');
    $m[self::DAYS][7] = t('Sunday');
    self::$map = $m;
  }

  /**
   * Localize and store day abbreviations.
   *
   * @static
   */
  private static function setDayAbbrevs()
  {
    $m = self::$map;
    $m[self::DAYS_ABBR][$m[self::DAYS][1]] = t('Mon');
    $m[self::DAYS_ABBR][$m[self::DAYS][2]] = t('Tue');
    $m[self::DAYS_ABBR][$m[self::DAYS][3]] = t('Wed');
    $m[self::DAYS_ABBR][$m[self::DAYS][4]] = t('Thu');
    $m[self::DAYS_ABBR][$m[self::DAYS][5]] = t('Fri');
    $m[self::DAYS_ABBR][$m[self::DAYS][6]] = t('Sat');
    $m[self::DAYS_ABBR][$m[self::DAYS][7]] = t('Sun');
    self::$map = $m;
  }

  /**
   * Localize and store day initials.
   *
   * @static
   */
  private static function setDayInitials()
  {
    $m = self::$map;
    $m[self::DAYS_INIT][$m[self::DAYS][1]] = t('M_Monday_initial');
    $m[self::DAYS_INIT][$m[self::DAYS][2]] = t('T_Tuesday_initial');
    $m[self::DAYS_INIT][$m[self::DAYS][3]] = t('W_Wednesday_initial');
    $m[self::DAYS_INIT][$m[self::DAYS][4]] = t('T_Thursday_initial');
    $m[self::DAYS_INIT][$m[self::DAYS][5]] = t('F_Friday_initial');
    $m[self::DAYS_INIT][$m[self::DAYS][6]] = t('S_Saturday_initial');
    $m[self::DAYS_INIT][$m[self::DAYS][7]] = t('S_Sunday_initial');

    foreach ($m[self::DAYS_INIT] as $day => $initial) {
      $m[self::DAYS_INIT][$day] = \preg_replace
      (
        '/_.+_initial$/',
        StrUtils::EMPTY_STRING,
        $initial
      );
    }
    self::$map = $m;
  }

  /**
   * Localize and store day months.
   *
   * @static
   */
  private static function setMonths()
  {
    $m = self::$map;
    $m[self::MONTHS][1] = t('January');
    $m[self::MONTHS][2] = t('February');
    $m[self::MONTHS][3] = t('March');
    $m[self::MONTHS][4] = t('April');
    $m[self::MONTHS][5] = t('May');
    $m[self::MONTHS][6] = t('June');
    $m[self::MONTHS][7] = t('July');
    $m[self::MONTHS][8] = t('August');
    $m[self::MONTHS][9] = t('September');
    $m[self::MONTHS][10] = t('October');
    $m[self::MONTHS][11] = t('November');
    $m[self::MONTHS][12] = t('December');
    self::$map = $m;
  }

  /**
   * Localize and store month abbreviations.
   *
   * @static
   */
  private static function setMonthAbbrevs()
  {
    $m = self::$map;
    $m[self::MONTHS_ABBR][$m[self::MONTHS][1]] = t('Jan');
    $m[self::MONTHS_ABBR][$m[self::MONTHS][2]] = t('Feb');
    $m[self::MONTHS_ABBR][$m[self::MONTHS][3]] = t('Mar');
    $m[self::MONTHS_ABBR][$m[self::MONTHS][4]] = t('Apr');
    $m[self::MONTHS_ABBR][$m[self::MONTHS][5]] = t('May');
    $m[self::MONTHS_ABBR][$m[self::MONTHS][6]] = t('Jun');
    $m[self::MONTHS_ABBR][$m[self::MONTHS][7]] = t('Jul');
    $m[self::MONTHS_ABBR][$m[self::MONTHS][8]] = t('Aug');
    $m[self::MONTHS_ABBR][$m[self::MONTHS][9]] = t('Sep');
    $m[self::MONTHS_ABBR][$m[self::MONTHS][10]] = t('Oct');
    $m[self::MONTHS_ABBR][$m[self::MONTHS][11]] = t('Nov');
    $m[self::MONTHS_ABBR][$m[self::MONTHS][12]] = t('Dec');
    self::$map = $m;
  }
}
