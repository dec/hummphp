<?php

/**
 * This file implement the HummPlugins system class.
 *
 * This is the system and site plugins manager class,
 * which is responsible to load the plugins and execute
 * the available plugin actions and filters.
 *
 * @author D. Esperalta <info@decsoftutils.com>
 * @link https://www.decsoftutils.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2019 Humm PHP - David Esperalta
 */

namespace Humm\System\Classes;

/**
 * System HummPlugins class implementation.
 *
 * Manage the available plugins and provide useful
 * methods to execute actions, filters and more.
 */
class HummPlugins extends Unclonable
{
  /**
   * Define the plugins base class name.
   */
  const PLUGIN_BASE_CLASS = 'HummPlugin';

  /**
   * Define the plugins execute action method.
   */
  const EXEC_ACTION_METHOD = 'execAction';

  /**
   * Define the plugins apply filter method.
   */
  const APPLY_FILTER_METHOD = 'applyFilter';

  /**
   * Define the plugins get priority method.
   */
  const GET_PRIORITY_METHOD = 'getPriority';

  /**
   * Define the active plugins separator.
   */
  const ACTIVE_PLUGINS_SEPARATOR = ',';

  /**
   * List of HummPlugin objects.
   *
   * @var array
   */
  private static $plugins = array();

  /**
   * Load the available system and site plugins.
   *
   * @static
   * @staticvar int $init Prevent twice execution.
   */
  public static function init()
  {
    static $init = 0;
    if (!$init) {
      $init = 1;
      if (!StrUtils::isTrimEmpty(\HUMM_ACTIVE_PLUGINS)) {
        self::loadPlugins();
      }
    }
  }

  /**
   * Retrieve the loaded plugins as HummPlugin class objects.
   *
   * @static
   * @return array Loaded HummPlugin class objects.
   */
  public static function getPlugins()
  {
    return self::$plugins;
  }

  /**
   * Apply a simple filter over the plugins.
   *
   * A simple filter is a filter which is composed only
   * with a filter ID and their content. So instead create
   * the appropiate FilterArguments object and prepare it,
   * let this method to apply simple filters like that.
   *
   * @static
   * @param int $filterID Filter ID to be applied.
   * @param mixed $content Content to be filter it.
   * @return mixed Filtered or untouched filter argument content.
   */
  public static function applySimpleFilter($filterID, $content)
  {
    return self::applyFilter(new FilterArguments(array
    (
      FilterArguments::FILTER =>  $filterID,
      FilterArguments::CONTENT => $content
    )));
  }

  /**
   * Execute a simple action over the plugins.
   *
   * A simple action is an action which is composed only
   * by their ID and do not need any other argument. So instead
   * create the appropiate ActionArguments object and prepare it,
   * let this method to execute simple actions like that.
   *
   * @static
   * @param int $actionID Action ID to be called.
   */
  public static function execSimpleAction($actionID)
  {
    HummPlugins::execAction(new ActionArguments(array
    (
      ActionArguments::ACTION => $actionID
    )));
  }

  /**
   * Apply certain filter over the plugins.
   *
   * The contents to be filter are always stored into the
   * $arguments->content property. We pass to the plugin this
   * value in order to be filtered and always return such value
   * filtered or untouched.
   *
   * The value of the filter content depend of the filter and in
   * fact are a mixed value: an string, an array, and object, etc.
   *
   * @static
   * @param FilterArguments $arguments Plugin filter arguments.
   * @return mixed Filtered or untouched filter argument content.
   */
  public static function applyFilter(FilterArguments $arguments)
  {
    foreach (self::$plugins as $plugin) {
      if (\method_exists($plugin, self::APPLY_FILTER_METHOD)) {
        $arguments->content = \call_user_func
        (
          array($plugin, self::APPLY_FILTER_METHOD),
          $arguments
        );
      }
    }
    return $arguments->content;
  }

  /**
   * Execute certain action over the plugins.
   *
   * Thanks to this method we can tell the plugins about various
   * system actions in the way that the plugins can react and do
   * some tasks when the appropiate action occur.
   *
   * @static
   * @param ActionArguments $arguments Plugin action arguments.
   */
  public static function execAction(ActionArguments $arguments)
  {
    foreach (self::$plugins as $plugin) {
      if (\method_exists($plugin, self::EXEC_ACTION_METHOD)) {
        \call_user_func
        (
          array($plugin, self::EXEC_ACTION_METHOD),
          $arguments
        );
      }
    }
  }

  /**
   * Load and instantiate all available plugins.
   *
   * @static
   */
  private static function loadPlugins()
  {
    foreach (self::getPluginDirs() as $pluginDir) {
      $pluginClass = self::getPluginClass($pluginDir);
      if (self::isValidPluginClass($pluginClass)) {
        self::$plugins[] = new $pluginClass;
      }
    }
    // Notify the plugins
    self::execSimpleAction(
     PluginActions::PLUGINS_LOADED
    );
  }

  /**
   * Retrieve all paths in which plugins can reside.
   *
   * @static
   * @return array Plugins directories paths.
   */
  private static function getPluginDirs()
  {
    $result = array();
    $pluginsDir = DirPaths::plugins();
    if (\file_exists($pluginsDir)) {
      foreach (new \DirectoryIterator($pluginsDir) as $fileInfo) {
        if (self::pluginIsActive($fileInfo) &&
         self::pluginFileExists($fileInfo)) {
           $result[] = $fileInfo->getPathName();
        }
      }
    }
    return $result;
  }

  /**
   * Find if a plugin is currently active or not.
   *
   * @static
   * @param SplFileInfo $fileInfo Object with file information.
   * @return boolean True if the plugin is active, False if not.
   */
  private static function pluginIsActive(\SplFileInfo $fileInfo)
  {
    return \in_array
    (
      $fileInfo->getBasename(),
      \explode(self::ACTIVE_PLUGINS_SEPARATOR, \HUMM_ACTIVE_PLUGINS)
    );
  }

  /**
   * Find if the specified file info have an existing plugin file.
   *
   * @static
   * @param SplFileInfo $fileInfo Object with file information.
   * @return boolean True if the plugin file exists, False if not.
   */
  private static function pluginFileExists(\SplFileInfo $fileInfo)
  {
    return !$fileInfo->isDot() && $fileInfo->isDir() && \file_exists
    (
      $fileInfo->getPathName().
      \DIRECTORY_SEPARATOR.
      $fileInfo->getBasename().
      FileExts::DOT_PHP
    );
  }

  /**
   * Retrieve the appropiate plugin class from their directory.
   *
   * @static
   * @param string $pluginDir Plugin directory path.
   * @return string Plugin class name.
   */
  private static function getPluginClass($pluginDir)
  {
    return \str_replace
    (
      array(DirPaths::root(), \DIRECTORY_SEPARATOR),
      array(StrUtils::EMPTY_STRING, StrUtils::PHP_NS_SEPARATOR),
      $pluginDir
    ).StrUtils::PHP_NS_SEPARATOR.\basename($pluginDir);
  }

  /**
   * Find if the specified class name is a valid plugin class.
   *
   * @static
   * @param string $className Plugin class name to be validated.
   * @return boolean True if the plugin class is valid, False if not.
   */
  private static function isValidPluginClass($className)
  {
    return \get_parent_class($className) ===
     __NAMESPACE__.StrUtils::PHP_NS_SEPARATOR.
      self::PLUGIN_BASE_CLASS;
  }
}
