<?php

/**
 * This file implement the SystemSharedView system class.
 *
 * This class is the associated class for the system errors
 * view and can interact with such view providing view HTML
 * template variables and so on.
 *
 * @author DecSoft Utils <info@decsoftutils.com>
 * @link https://www.decsoftutils.com/
 * @license https://github.com/dec/hummphp/blob/master/LICENSE
 * @copyright (C) Humm PHP - DecSoft Utils
 */

namespace Humm\System\Classes;

/**
 * System SystemSharedView class implementation.
 *
 * This class is automatically loaded before any other
 * system view must be displayed.
 *
 */
class SystemSharedView extends HummView
{
  const HUMM_SITE_URL = 'https://www.decsoftutils.com/?lang=%s';

  /**
   * Construct a SystemSharedView object.
   *
   * @param HtmlTemplate $template Template of the associated view.
   */
  public function __construct(HtmlTemplate $template)
  {
    parent::__construct($template);
    $this->setDefaultTemplateVars();
  }

  private function setDefaultTemplateVars()
  {
    $this->template->hummPhpSiteUrl = \sprintf(
      self::HUMM_SITE_URL, Languages::getCurrentLanguage()
    );
  }
}
