<?php

/**
 * This file implement the main site About view class.
 *
 * @author DecSoft Utils <info@decsoftutils.com>
 * @link https://www.decsoftutils.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2022 Humm PHP - DecSoft Utils
 */

namespace Humm\Sites\Main\Classes;

use
  \Humm\System\Classes\HummView,
  \Humm\System\Classes\HtmlTemplate;

/**
 * Main site AboutView class implementation.
 *
 * This class is instantiated automatically by the system
 * when the site about view is required.
 */
class AboutView extends HummView
{
  public function __construct(HtmlTemplate $template)
  {
    parent::__construct($template);
    
    $this->template->headerTitle = 'About!';
  }
}
