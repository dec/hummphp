<?php

/**
 * This file implement the SystemHomeView system class.
 *
 * This class is the associated class for the system home
 * view and can interact with such view providing view HTML
 * template variables and so on.
 *
 * @author DecSoft Utils <info@decsoftutils.com>
 * @link https://www.decsoftutils.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2022 Humm PHP - DecSoft Utils
 */

namespace Humm\System\Classes;

/**
 * System SystemHomeView class implementation.
 *
 * This class is automatically loaded before the associate
 * system home view must be displayed.
 *
 */
class SystemHomeView extends SystemSharedView
{
  /**
   * Construct a SystemHomeView object.
   *
   * @param HtmlTemplate $template Template of the associated view.
   */
  public function __construct(HtmlTemplate $template)
  {
    parent::__construct($template);
    // Disallow direct user requests to this view URL
    if (\strtolower(UrlArguments::get(0)) ==
     \strtolower(RequestedView::SYSTEM_HOME_VIEW)) {
       UserClient::redirectToHome();
    }
  }
}
