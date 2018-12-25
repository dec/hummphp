<?php

/**
 * This file implement the main site Shared view class.
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link https://www.davidesperalta.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2019 Humm PHP - David Esperalta
 */

namespace Humm\Sites\Main\Classes;

use
  \Humm\System\Classes\HummView,
  \Humm\System\Classes\HtmlTemplate;

/**
 * Implement the main site SharedView class.
 *
 * This class is instantiated automatically by the system
 * when the site home view is required.
 */
class SharedView extends HummView
{
  public function __construct(HtmlTemplate $template)
  {
    parent::__construct($template);
  }
}
