<?php

/**
 * This file implement the TemplatePaths system class.
 *
 * This class is the responsible to set the appropiate
 * directory paths used in the requested view HTML template.
 *
 * @author DecSoft Utils <info@decsoftutils.com>
 * @link https://www.decsoftutils.com/
 * @license https://github.com/dec/hummphp/blob/master/LICENSE
 * @copyright (C) Humm PHP - DecSoft Utils
 */

namespace Humm\System\Classes;

/**
 * System TemplatePaths class implementation.
 *
 * Just a helper to the ViewsHandler system class which set the
 * right directory paths used in the requested view HTML template.
 *
 */
class TemplatePaths extends Unclonable
{
  /**
   * Set the directory paths in which views resides.
   *
   * @static
   * @param HtmlTemplate $template Reference to an HTML template object.
   */
  public static function setTemplatePaths(HtmlTemplate $template)
  {
    $template->addViewsDirPaths(array(
      /*
       * Order matter here. We want to look firstly in the
       * sites shared views and helpers directory; then we
       * look for the requested site directory; and finally
       * we look into the system views and helpers directory.
       */
      DirPaths::sitesSharedViews(),
      DirPaths::sitesSharedViewsHelpers(),
      DirPaths::siteViews(),
      DirPaths::siteViewsHelpers(),
      DirPaths::systemViews(),
      DirPaths::systemViewsHelpers()
    ));

    // Yes; plugins also can add views and helpers
    foreach (HummPlugins::getPlugins() as $plugin) {
      $template->addViewsDirPath($plugin->viewsDir());
      $template->addViewsDirPath($plugin->viewsHelpersDir());
    }
  }
}
