<?php

/**
 * This file implement the RequestedView system class.
 *
 * This class is the responsible to find the requested
 * site view and offer information about it.
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link https://www.davidesperalta.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2019 Humm PHP - David Esperalta
 */

namespace Humm\System\Classes;

/**
 * System RequestedView class implementation.
 *
 * Just a helper to the ViewsHandler system class which find
 * the appropiate requested site view and offer information
 * and more about it.
 *
 */
class RequestedView extends Unclonable
{
  /**
   * Define the default view name for site home.
   */
  const SITE_HOME_VIEW = 'Home';

  /**
   * Define a fall out view when missing the site home view.
   */
  const SYSTEM_HOME_VIEW = 'SystemHome';

  /**
   * Store all availables views directory paths.
   *
   * @var array
   */
  private static $viewsDirs = null;

  /**
   * Get the appropiate view to be displayed.
   *
   * @static
   * @param HtmlTemplate $template Reference to an HTML template object.
   * @return string The URL requested view.
   */
  public static function getViewName(HtmlTemplate $template)
  {
    /**
     * Now Humm PHP can support "deep" views from the URL, something
     * like in this one: http://www.server.com/admin/user/profile
     * 
     * Previously this change Humm PHP determine that the above URL
     * end into the "admin" view and optional class to be loaded.
     * 
     * The below code allows Humm PHP to support "deep" views and
     * optional classes, so the above URL end into the "AdminUserProfile"
     * view and optional class ("AdminUserProfileView") to be loaded.
     */
    $view = self::getDeepView($template);
    
    // Check the existence of a possible "deep" view
    if (!self::isMainView($view) || !$template->viewFileExists($view)) {
      
      // Fallback to the Humm PHP system's home view.
      if ($view === '') {
        $view = self::SYSTEM_HOME_VIEW; 
      }
      
      /**
       * The below code is for backward compatibility: as is mentioned above,
       * previously to support "deep" views, Humm PHP only support one main
       * view, which corresponde with the first URL argument, in the above
       * URL sample the "admin" view.
       * 
       * So the below code try to take the view from the first URL argument.
       */
      if (self::isMainView(UrlArguments::get(0)) &&
       $template->viewFileExists(UrlArguments::get(0))) {
        
        $view = UrlArguments::get(0);  
        
      } else if (self::isMainView(self::SITE_HOME_VIEW) &&
       $template->viewFileExists(self::SITE_HOME_VIEW)) {
        
        $view = self::SITE_HOME_VIEW;
      }
    }
    
    return \ucfirst($view);
  }
  
  /**
   * Try to find a possible deep view from the URL.
   * 
   * @static
   * @param HtmlTemplate $template The current template
   * @return string The possible deep view name
   */
  private static function getDeepView(HtmlTemplate $template)
  {
    $view = ''; 
    $result = '';
    $views = array();
    $args = UrlArguments::getAll();    
    
    foreach ($args as $arg) {
      /**
       * We continue supporting URLs which don't use the Apache's rewrite 
       * module, for example (other servers provides something similar).
       * 
       * Then the below URLs works if we use the Apache rewrite module:
       * 
       * http://www.server.com/admin/user/profile
       * http://www.server.com/admin/user/profile/?var=value
       * 
       * And this other URL also works as expected without rewrite module:
       * 
       * http://www.server.com/?admin/user/profile
       * 
       * Note that this other URL also works as expected:
       * 
       * http://www.server.com/?admin/user/profile/&var=value
       * 
       */
      if ((\substr($arg, 0, 1) !== '?') && (\substr($arg, 0, 1) !== '&')) {
        $view .= \ucfirst($arg);
      }
      
      if (!\in_array($view, $views)) {
        $views[] = $view;
      }
    }
    
    /**
     * We must return here the first existing view according with the
     * URL arguments, for example, supose the below URL:
     * 
     * http://www.site.com/forum/section/12
     * 
     * The above URL causes we have three possible views & views' classes:
     * 
     * Forum
     * ForumSection
     * ForumSection12
     * 
     * Instead of fallback to the home view if "ForumSection12" did not
     * exists, we want to use the ForumSection view.
     * 
     * In this way we can provide more arguments into the URL and always
     * use the expected view and view's class, for example:
     * 
     * http://www.site.com/forum/section/id/12
     * 
     * Probably we don't wanted a view & class like "ForumSectionId", but
     * wanted to use the ForumSection view & class.
     * 
     * We can provide an ForumSectionId if we wanted that, of course.
     * 
     */
    
    $total_views = \count($views);    
    
    for ($i = $total_views - 1; $i >= 0; $i--) {
      if (self::isMainView($views[$i]) && 
       $template->viewFileExists($views[$i])) {
         $result = $views[$i];
         break;
      }
    }
    
    return $result;    
  }


  /**
   * Find if a view is a main view or not.
   *
   * Main views corresponded with URL arguments. On the
   * contrary we count also with views helpers, which are
   * also views but do not corresponde with URL arguments
   * and are intended to use as views helpers.
   *
   * @static
   * @param string $viewName The view name to be checked.
   * @return boolean True if the view is a main view, False if not.
   */
  private static function isMainView($viewName)
  {
    // By convention views files must be first capitalized.
    return in_array(\ucfirst($viewName), self::getMainViewsDirs());
  }

  /**
   * Retrieve the directory paths in which views can resides.
   *
   * @static
   * @return array Directory paths for all possible main views.
   */
  private static function getMainViewsDirs()
  {
    if (self::$viewsDirs == null) {
      // Order matter here:
      // 1º Shared sites
      // 2º Site specific
      // 3º System specific
      self::$viewsDirs = \array_unique(\array_merge(
        self::getDirectoryViews(DirPaths::sitesSharedViews()),
        self::getDirectoryViews(DirPaths::siteViews()),
        self::getDirectoryViews(DirPaths::systemViews())
      ));
    }
    return self::$viewsDirs;
  }

  /**
   * Get the views files of the specified directory.
   *
   * @static
   * @param string $dirPath Directory in which views resides.
   * @return array Directory views file paths.
   */
  private static function getDirectoryViews($dirPath)
  {
    $views = array();
    if (\file_exists($dirPath)) {
      foreach (new \DirectoryIterator($dirPath) as $fileInfo) {
        if (self::isMainViewFile($fileInfo)) {
          $views[] = self::getMainViewName($fileInfo);
        }
      }
    }
    return $views;
  }

  /**
   * Find if a file can be considered a view file.
   *
   * In fact all PHP files in a views directory are
   * considered valid views, but not others like HTML
   * files or others.
   *
   * @static
   * @param SplFileInfo $fileInfo File information.
   * @return boolean True if a file is considered a view.
   */
  private static function isMainViewFile(\SplFileInfo $fileInfo)
  {
    return $fileInfo->isFile() &&
      ($fileInfo->getExtension() === FileExts::PHP);
  }

  /**
   * Extract the view name from a view file path.
   *
   * @static
   * @param SplFileInfo $fileInfo File information.
   * @return string View name.
   */
  private static function getMainViewName(\SplFileInfo $fileInfo)
  {
    return \str_replace(
      FileExts::DOT_PHP,
      StrUtils::EMPTY_STRING,
      $fileInfo->getBasename()
    );
  }
}
