<?php

/**
 * This file implement the DirPaths system class.
 *
 * Humm PHP use this class to discover and use absolute
 * paths of well know directories.
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link https://www.davidesperalta.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2018 Humm PHP - David Esperalta
 */

namespace Humm\System\Classes;

/**
 * System DirPaths class implementation.
 *
 * This class can be used by user site classes, views
 * and plugins to retrieve well know directory paths.
 */
class DirPaths extends Unclonable
{
  /**
   * Store the Humm PHP root absolute directory path.
   *
   * @static
   * @var string
   */
  private static $rootDir = null;

  /**
   * Store the Humm PHP root directory path.
   *
   * @static
   * @staticvar int $init Prevent twice execution.
   * @param string $rootDir Humm PHP root absolute directory path.
   * @param string Humm PHP directory path.
   */
  public static function init($rootDir)
  {
    static $init = 0;
    if (!$init) {
      $init = 1;
      self::$rootDir = $rootDir;
    }
  }

  /**
   * Retrieve the root directory path.
   *
   * @static
   * @return string Root absolute directory path.
   */
  public static function root()
  {
    return self::$rootDir.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the root/humm directory path.
   *
   * @static
   * @return string Root/humm absolute directory path.
   */
  public static function humm()
  {
    return self::root().
            DirNames::HUMM.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the version directory path.
   *
   * @static
   * @return string Version absolute directory path.
   */
  public static function version()
  {
    return self::system().
            DirNames::VERSION.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve a Humm PHP plugins directory path.
   *
   * @static
   * @return string Humm PHP plugins absolute directory path.
   */
  public static function plugins()
  {
    return self::humm().
            DirNames::PLUGINS.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve a plugin locale directory path.
   *
   * @static
   * @param string $pluginDir Plugin directory name.
   * @return string Plugin locale absolute directory path.
   */
  public static function pluginLocale($pluginDir)
  {
    return $pluginDir.
            DirNames::LOCALE.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the system directory path.
   *
   * @static
   * @return string System absolute directory path.
   */
  public static function system()
  {
    return self::humm().
            DirNames::SYSTEM.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the system config directory path.
   *
   * @static
   * @return string System config absolute directory path.
   */
  public static function systemConfig()
  {
    return self::system().
            DirNames::CONFIG.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the system locale directory path.
   *
   * @static
   * @return string System locale absolute directory path.
   */
  public static function systemLocale()
  {
    return self::system().
            DirNames::LOCALE.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the system classes directory path.
   *
   * @static
   * @return string System classes absolute directory path.
   */
  public static function systemClasses()
  {
    return self::system().
            DirNames::CLASSES.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the system procedural directory path.
   *
   * @static
   * @return string System procedural absolute directory path.
   */
  public static function systemProcedural()
  {
    return self::system().
            DirNames::PROCEDURAL.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the system views directory path.
   *
   * @static
   * @return string System views absolute directory path.
   */
  public static function systemViews()
  {
    return self::system().
            DirNames::VIEWS.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the system files directory path.
   *
   * @static
   * @return string System files absolute directory path.
   */
  public static function systemViewsFiles()
  {
    return self::systemViews().
            DirNames::FILES.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the system helpers directory path.
   *
   * @static
   * @return string System helpers absolute directory path.
   */
  public static function systemViewsHelpers()
  {
    return self::systemViews().
            DirNames::HELPERS.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the system images directory path.
   *
   * @static
   * @return string System images absolute directory path.
   */
  public static function systemViewsImages()
  {
    return self::systemViews().
            DirNames::IMAGES.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the system styles directory path.
   *
   * @static
   * @return string System styles absolute directory path.
   */
  public static function systemViewsStyles()
  {
    return self::systemViews().
            DirNames::STYLES.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the system scripts directory path.
   *
   * @static
   * @return string System scripts absolute directory path.
   */
  public static function systemViewsScripts()
  {
    return self::systemViews().
            DirNames::SCRIPTS.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve a site config directory path.
   *
   * @static
   * @return string Site config absolute directory path.
   */
  public static function siteConfig()
  {
    return self::site().
            DirNames::CONFIG.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve a site locale directory path.
   *
   * @static
   * @return string Site locale absolute directory path.
   */
  public static function siteLocale()
  {
    return self::site().
            DirNames::LOCALE.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve a site classes directory path.
   *
   * @static
   * @return string Site classes absolute directory path.
   */
  public static function siteClasses()
  {
    return self::site().
            DirNames::CLASSES.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the site procedural directory path.
   *
   * @static
   * @return string site procedural absolute directory path.
   */
  public static function siteProcedural()
  {
    return self::site().
            DirNames::PROCEDURAL.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the site directory path.
   *
   * @static
   * @return string Site absolute directory path.
   */
  public static function site()
  {
    return self::humm().DirNames::SITES
            .\DIRECTORY_SEPARATOR.UserSites::siteDirName().
             \DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve a user site directory path.
   *
   * @static
   * @return string User site absolute directory path.
   */
  public static function siteViews()
  {
    return self::site().
            DirNames::VIEWS.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve a site files directory path.
   *
   * @static
   * @return string Site files absolute directory path.
   */
  public static function siteViewsFiles()
  {
    return self::siteViews().
            DirNames::FILES.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve a site helpers directory path.
   *
   * @static
   * @return string Site helpers absolute directory path.
   */
  public static function siteViewsHelpers()
  {
    return self::siteViews().
            DirNames::HELPERS.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve a site images directory path.
   *
   * @static
   * @return string Site images absolute directory path.
   */
  public static function siteViewsImages()
  {
    return self::siteViews().
            DirNames::IMAGES.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve a site scripts directory path.
   *
   * @static
   * @return string Site scripts absolute directory path.
   */
  public static function siteViewsScripts()
  {
    return self::siteViews().
            DirNames::SCRIPTS.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve a site styles directory path.
   *
   * @static
   * @return string Site styles absolute directory path.
   */
  public static function siteViewsStyles()
  {
    return self::siteViews().
            DirNames::STYLES.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the sites shared directory path.
   *
   * @static
   * @return string Sites shared absolute directory path.
   */
  public static function sitesShared()
  {
    return self::humm().
            DirNames::SITES.\DIRECTORY_SEPARATOR.
            DirNames::SHARED.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the sites shared locale directory path.
   *
   * @static
   * @return string Sites shared locale absolute directory path.
   */
  public static function sitesSharedLocale()
  {
    return self::sitesShared().
            DirNames::LOCALE.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the sites shared classes directory path.
   *
   * @static
   * @return string Sites shared classes absolute directory path.
   */
  public static function sitesSharedClasses()
  {
    return self::sitesShared().
            DirNames::CLASSES.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the sites shared procedural directory path.
   *
   * @static
   * @return string Sites shared procedural absolute directory path.
   */
  public static function sitesSharedProcedural()
  {
    return self::sitesShared().
            DirNames::PROCEDURAL.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the sites shared views directory path.
   *
   * @static
   * @return string Sites shared views absolute directory path.
   */
  public static function sitesSharedViews()
  {
    return self::sitesShared().
            DirNames::VIEWS.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the sites shared files directory path.
   *
   * @static
   * @return string Sites shared files absolute directory path.
   */
  public static function sitesSharedViewsFiles()
  {
    return self::sitesSharedViews().
            DirNames::FILES.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the sites shared helpers directory path.
   *
   * @static
   * @return string Sites shared helpers absolute directory path.
   */
  public static function sitesSharedViewsHelpers()
  {
    return self::sitesSharedViews().
            DirNames::HELPERS.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the sites shared images directory path.
   *
   * @static
   * @return string Sites shared images absolute directory path.
   */
  public static function sitesSharedViewsImages()
  {
    return self::sitesSharedViews().
            DirNames::IMAGES.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the sites shared styles directory path.
   *
   * @static
   * @return string Sites shared styles absolute directory path.
   */
  public static function sitesSharedViewsStyles()
  {
    return self::sitesSharedViews().
            DirNames::STYLES.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the sites shared scripts directory path.
   *
   * @static
   * @return string Sites shared scripts absolute directory path.
   */
  public static function sitesSharedViewsScripts()
  {
    return self::sitesSharedViews().
            DirNames::SCRIPTS.\DIRECTORY_SEPARATOR;
  }
}
