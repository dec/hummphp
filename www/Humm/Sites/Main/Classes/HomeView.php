<?php

/**
 * This file implement the main site Home view class.
 *
 * @author D. Esperalta <info@decsoftutils.com>
 * @link https://www.decsoftutils.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2021 Humm PHP - David Esperalta
 */

namespace Humm\Sites\Main\Classes;

use
  \Humm\System\Classes\HummView,
  \Humm\System\Classes\HtmlTemplate;

/**
 * Main site HomeView class implementation.
 *
 * This class is instantiated automatically by the system
 * when the site home view is required.
 */
class HomeView extends HummView
{
  public function __construct(HtmlTemplate $template)
  {
    parent::__construct($template);
  }
}
