<?php

/**
 * This file implement the TemplateVars system class.
 *
 * This class is the responsible to set some default
 * variables to the requested view HTML template.
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link https://www.davidesperalta.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2019 Humm PHP - David Esperalta
 */

namespace Humm\System\Classes;

/**
 * System TemplateVars class implementation.
 *
 * Just a helper to the ViewsHandler system class which set the
 * default variables used in the requested view HTML template.
 *
 */
class TemplateVars extends Unclonable
{
  /**
   * Set the default site view variables.
   *
   * @static
   * @param HtmlTemplate $template Reference to an HTML template object.
   */
  public static function setDefaultSiteVars(HtmlTemplate $template)
  {
    // Previous views code will fail if this variables are renamed
    $template->hummVersion = \HUMM_VERSION_STRING;
    $template->hummRelease = \HUMM_VERSION_RELEASE;

    $template->requestUri = UrlPaths::current();
    $template->siteLanguage = Languages::getCurrentLanguage();
    $template->siteLanguages = Languages::getLanguages();
    $template->siteLanguageDir = Languages::getLanguageDirection();

    $template->siteUrl = UrlPaths::root();
    $template->viewsUrl = UrlPaths::siteViews();
    $template->viewsFilesUrl = UrlPaths::siteViewsFiles();
    $template->viewsImagesUrl = UrlPaths::siteViewsImages();
    $template->viewsStylesUrl = UrlPaths::siteViewsStyles();
    $template->viewsScriptsUrl = UrlPaths::siteViewsScripts();

    $template->sharedViewsUrl = UrlPaths::sitesSharedViews();
    $template->sharedViewsFilesUrl = UrlPaths::sitesSharedViewsFiles();
    $template->sharedViewsImagesUrl = UrlPaths::sitesSharedViewsImages();
    $template->sharedViewsStylesUrl = UrlPaths::sitesSharedViewsStyles();
    $template->sharedViewsScriptsUrl = UrlPaths::sitesSharedViewsScripts();
  }

  /**
   * Set the default system view variables.
   *
   * @static
   * @param HtmlTemplate $template Reference to an HTML template object.
   */
  public static function setDefaultSystemVars(HtmlTemplate $template)
  {
    // Used by the system Home view
    $template->systemViewsUrl = UrlPaths::systemViews();
    $template->systemViewsImagesUrl = UrlPaths::systemViewsImages();
    $template->systemViewsStylesUrl = UrlPaths::systemViewsStyles();
    $template->systemViewsScriptsUrl = UrlPaths::systemViewsScripts();
  }
}
