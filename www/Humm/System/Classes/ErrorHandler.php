<?php

/**
 * This file implement the ErrorHandler system class.
 *
 * This class is used internally by Humm PHP to handle
 * the PHP errors, exceptions and shutdown.
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link https://www.davidesperalta.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2018 Humm PHP - David Esperalta
 */

namespace Humm\System\Classes;

/**
 * System ErrorHandler class implementation.
 *
 * This class is used internally by Humm PHP and do not offer
 * any useful stuff from the user site point of view.
 */
class ErrorHandler extends Unclonable
{
  /**
   * Define the system error view name.
   */
  const ERROR_VIEW = 'SystemError';

  /**
   * Define the system error view class name.
   */
  const ERROR_VIEW_CLASS = 'SystemErrorView';

  /**
   * Define this class method name to handle errors.
   */
  const ERROR_HANDLER = 'onError';

  /**
   * Define this class method name to handle shutdown.
   */
  const SHUTDOWN_HANDLER = 'onShutdown';

  /**
   * Define this class method name to handle exceptions.
   */
  const EXCEPTION_HANDLER = 'onException';

  /**
   * List of ErrorInfo objects.
   *
   * @var array
   */
  private static $errors = null;

  /**
   * Register the needed PHP handlers.
   *
   * @static
   * @staticvar int $init Prevent twice execution.
   */
  public static function init()
  {
    static $init = 0;
    if (!$init) {
      $init = 1;
      self::$errors = array();
      \set_error_handler(array(__CLASS__, self::ERROR_HANDLER));
      \set_exception_handler(array(__CLASS__, self::EXCEPTION_HANDLER));
      \register_shutdown_function(array(__CLASS__, self::SHUTDOWN_HANDLER));
    }
  }

  /**
   * Handle the possible PHP errors.
   *
   * @static
   * @param int $code Error code.
   * @param string $message Error message.
   * @param string $file File path in which error occur.
   * @param int $lineNum Number of the line in which error occur.
   * @return boolean True indicating we effectively handle the error.
   */
  public static function onError($code, $message, $file, $lineNum)
  {
    self::$errors[] = new ErrorInfo($code, $message, $file, $lineNum);
    // Tells PHP don't continue executing the PHP internal error handler
    return true;
  }

  /**
   * Handle the possible PHP exceptions.
   *
   * @static
   * //@param \Exception $e Throwed exception object. in PHP < 7
   * //@param \Throwable $e Throved error object ini PHP >= 7
   * // Do not specify the type below appear compatible with PHP 5.x and 7.x
   * @TODO We must take another decision here instead to remove the type
   */
  public static function onException($e)
  {
    // $e can be null according the PHP help.
    if ($e !== null) {
      self::$errors[] = new ErrorInfo($e->getCode(),
       $e->getMessage(), $e->getFile(), $e->getLine());
    }
  }

  /**
   * Handle the PHP shutdown function.
   *
   * @static
   */
  public static function onShutdown()
  {
    if (!empty(self::$errors)) {
      \ob_end_clean();
      self::displayView();
    }
    HummPlugins::execSimpleAction(
     PluginActions::SCRIPT_SHUTDOWN);
  }

  /**
   * Display the system error view to the user.
   *
   * @static
   */
  private static function displayView()
  {
    $template = new HtmlTemplate();
    self::setViewTemplatePaths($template);
    self::setDefaultTemplateVars($template);
    if (ServerInfo::isLocal() || \HUMM_SHOW_ERRORS) {
      $template->displayView(self::ERROR_VIEW);
    }
  }

  /**
   * Add the appropiate views to an HtmlTemplate object.
   *
   * @static
   * @param HtmlTemplate $template Object instance.
   */
  private static function setViewTemplatePaths(HtmlTemplate $template)
  {
    $template->addViewsDirPaths(array
    (
      // Order matter here
      DirPaths::systemViews(),
      DirPaths::systemViewsHelpers()
    ));
  }

  /**
   * Add default variables to the system view HTML template.
   *
   * @static
   * @param HtmlTemplate $template Object instance
   */
  private static function setDefaultTemplateVars(HtmlTemplate $template)
  {
    $template->errors = self::$errors;

    $template->hummVersion = \HUMM_VERSION_STRING;
    $template->hummRelease = \HUMM_VERSION_RELEASE;

    $template->viewName = self::ERROR_VIEW;
    $template->viewClass = new SystemErrorView($template);

    $template->requestUri = UrlPaths::current();
    $template->siteLanguages = Languages::getLanguages();
    $template->siteLanguage = Languages::getCurrentLanguage();
    $template->siteLanguageDir = Languages::getLanguageDirection();

    $template->siteUrl = UrlPaths::root();
    $template->systemViewsUrl = UrlPaths::systemViews();
    $template->systemViewsImagesUrl = UrlPaths::systemViewsImages();
    $template->systemViewsStylesUrl = UrlPaths::systemViewsStyles();
    $template->systemViewsScriptsUrl = UrlPaths::systemViewsScripts();
  }
}
