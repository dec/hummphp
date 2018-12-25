<?php

/**
 * This file implement the HtmlTemplate system class.
 *
 * This class is used by Humm PHP views to construct
 * their HTML templates in a simple but powerful way.
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link https://www.davidesperalta.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2019 Humm PHP - David Esperalta
 */

namespace Humm\System\Classes;

/**
 * System HtmlTemplate class implementation.
 *
 * This class provide methods to assign variables into
 * the HTML template, add views paths and therefore display
 * the views, which can use the assigned template variables.
 */
class HtmlTemplate extends BaseClass
{
  /**
   * Internal variables stack.
   *
   * @var array
   */
  private $varsStack = array();

  /**
   * Views directory paths.
   *
   * @var array
   */
  private $viewsDirs = array();

  /**
   * A convenient magic way to assign variables to the template.
   *
   * @param string $varName Variable name.
   * @param mixed $varValue Variable value.
   */
  public function  __set($varName, $varValue)
  {
    $this->varsStack[$varName] = $varValue;
  }

  /**
   * A convenient magic way to retrieve template variable values.
   *
   * @param string $varName Variable name.
   * @return mixed|null Variable value or null if not exists.
   */
  public function  __get($varName)
  {
    $result = null;
    if (isset($this->varsStack[$varName])) {
      $result = $this->varsStack[$varName];
    }
    return $result;
  }

  /**
   * A convenient magic way to find if template variables exists.
   *
   * @param string $varName Variable name.
   * @return boolean True if template variable exists, False if not.
   */
  public function  __isset($varName)
  {
    return isset($this->varsStack[$varName]);
  }

  /**
   * A convenient magic way to unset template variables.
   *
   * @param string $varName Variable name.
   */
  public function  __unset($varName)
  {
    if (isset($this->varsStack[$varName])) {
      unset($this->varsStack[$varName]);
    }
  }

  /**
   * Assign template variables from an associative array.
   *
   * If you want to assign just a variable remember you
   * can assign it directly as a property of this object
   * since the use of the __set() magic method.
   *
   * @param array $vars Associative array containing names/values
   */
  public function assign($vars)
  {
    foreach ($vars as $k => $v) {
      $this->varsStack[$k] = $v;
    }
  }

  /**
   * Extract the template variables and display the specified view.
   *
   * @param string $aViewName View name you want to display.
   */
  public function displayView($aViewName)
  {
    if (\file_exists($this->getViewFilePath($aViewName))) {
      \extract($this->varsStack, \EXTR_OVERWRITE);
      require $this->getViewFilePath($aViewName);
    }
  }

  /**
   * Retrieve the HTML template variables stack.
   *
   * @return array HTML template variables stack.
   */
  public function getVariables()
  {
    return $this->varsStack;
  }

  /**
   * Clear the HTML template variables stack.
   */
  public function clearVariables()
  {
    $this->varsStack = array();
  }

  /**
   * Retrieve the HTML template views directory paths.
   *
   * @return array HTML template views directory paths.
   */
  public function getViewsDirPaths()
  {
    return $this->viewsDirs;
  }

  /**
   * Clear the HTML template views directory paths.
   */
  public function clearViewsDirPaths()
  {
    $this->viewsDirs = array();
  }

  /**
   * Set a directory path in which views resides.
   *
   * @param string $dirPath Views directory path.
   */
  public function addViewsDirPath($dirPath)
  {
    if (!\in_array($dirPath, $this->viewsDirs)) {
      $this->viewsDirs[] = $dirPath;
    }
  }

  /**
   * Set more than one directory path in which views resides.
   *
   * @param array $dirPaths Bunch of views directory paths.
   */
  public function addViewsDirPaths($dirPaths)
  {
    foreach ($dirPaths as $dirPath) {
      $this->addViewsDirPath($dirPath);
    }
  }

  /**
   * Find if the specified view file exists or not.
   *
   * @param string $aViewName View name to looking for.
   * @return boolean True if the view file exists, False if not.
   */
  public function viewFileExists($aViewName)
  {
    // We use ucfirst() to follow the views names convention
    return \file_exists($this->getViewFilePath(\ucfirst($aViewName)));
  }

  /**
   * Retrieve the file path of the specified view.
   *
   * Note that view files names must be capitalized.
   *
   * @param string $aViewName View name to looking for.
   * @return string The specified view file path.
   */
  private function getViewFilePath($aViewName)
  {
    $result = $aViewName;
    foreach ($this->viewsDirs as $path) {
      if (\file_exists($path.$aViewName.FileExts::DOT_PHP)) {
        $result = $path.$aViewName.FileExts::DOT_PHP;
        break;
      }
    }
    return $result;
  }
}
