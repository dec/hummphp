<?php

/**
 * This file implement the FilePaths system class.
 *
 * This class is used internally by Humm PHP and also
 * can be used by site classes, views and plugins to
 * retrieve Humm PHP related file paths.
 *
 * @author DecSoft Utils <info@decsoftutils.com>
 * @link https://www.decsoftutils.com/
 * @license https://github.com/dec/hummphp/blob/master/LICENSE
 * @copyright (C) Humm PHP - DecSoft Utils
 */

namespace Humm\System\Classes;

/**
 * System FilePaths class implementation.
 *
 * Although this class is internally used by other
 * Humm PHP system classes, contain stuff which can
 * also be useful from the user site point of view.
 */
class FilePaths extends Unclonable
{
  /**
   * Retrieve the system configuration file path.
   *
   * @static
   * @return string System configuration file path.
   */
  public static function systemConfig()
  {
    return DirPaths::systemConfig().
            FileNames::CONFIG;
  }

  /**
   * Retrieve the system version file path.
   *
   * @static
   * @return string System version file path.
   */
  public static function systemVersion()
  {
    return DirPaths::version().
            FileNames::VERSION;
  }

  /**
   * Retrieve the system text domain or MO file path.
   *
   * @static
   * @return string System text domain or MO file path.
   */
  public static function systemTextDomain()
  {
    $langCode = Languages::getCurrentLanguage();
    return DirPaths::systemLocale().
           $langCode.
           \DIRECTORY_SEPARATOR.
           $langCode.
           FileExts::DOT_MO;
  }

  /**
   * Retrieve the current site configuration file path.
   *
   * @static
   * @return string Current site configuration file path.
   */
  public static function siteConfig()
  {
    return DirPaths::siteConfig().
            FileNames::CONFIG;
  }

  /**
   * Retrieve the current site text domain or MO file path.
   *
   * @static
   * @return string Current site text domain or MO file path.
   */
  public static function siteTextDomain()
  {
    $langCode = Languages::getCurrentLanguage();
    return DirPaths::siteLocale().
           $langCode.
           \DIRECTORY_SEPARATOR.
           $langCode.
           FileExts::DOT_MO;
  }

  /**
   * Retrieve the sites shared text domain or MO file path.
   *
   * @static
   * @return string sites shared text domain or MO file path.
   */
  public static function sitesSharedTextDomain()
  {
    $langCode = Languages::getCurrentLanguage();
    return DirPaths::sitesSharedLocale().
           $langCode.
           \DIRECTORY_SEPARATOR.
           $langCode.
           FileExts::DOT_MO;
  }

  /**
   * Retrieve the system I18n functions file path.
   *
   * @static
   * @return string System I18n functions file path.
   */
  public static function systemI18nFunctions()
  {
    return DirPaths::systemProcedural().
            FileNames::I18N_FUNCTIONS;
  }

  /**
   * Retrieve a plugin text domain or MO file path.
   *
   * @static
   * @param String $pluginDir Absolute plugin directory path.
   * @return string Plugin text domain or MO file path.
   */
  public static function pluginTextDomain($pluginDir)
  {
    $langCode = Languages::getCurrentLanguage();
    return DirPaths::pluginLocale($pluginDir).
           $langCode.
           \DIRECTORY_SEPARATOR.
           $langCode.
           FileExts::DOT_MO;
  }
}
