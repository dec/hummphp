<?php

/**
 * This file implement the SystemErrorView system class.
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
 * System SystemErrorView class implementation.
 *
 * This class is automatically loaded before the associate
 * system error view must be displayed.
 *
 */
class SystemErrorView extends SystemSharedView
{
  /**
   * Construct a SystemErrorView object.
   *
   * @param HtmlTemplate $template Template of the associated view.
   */
  public function __construct(HtmlTemplate $template)
  {
    parent::__construct($template);
    // Disallow direct user requests to this view URL
    if (\count($template->errors) === 0) {
      UserClient::redirectToHome();
    }
  }
}
