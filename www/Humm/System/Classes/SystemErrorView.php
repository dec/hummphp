<?php

/**
 * This file implement the SystemErrorView system class.
 *
 * This class is the associated class for the system errors
 * view and can interact with such view providing view HTML
 * template variables and so on.
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link https://www.davidesperalta.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2019 Humm PHP - David Esperalta
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
