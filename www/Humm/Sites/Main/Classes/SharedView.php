<?php

/**
 * This file implement the main site Shared view class.
 *
 * @author DecSoft Utils <info@decsoftutils.com>
 * @link https://www.decsoftutils.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C) Humm PHP - DecSoft Utils
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
    
    $this->template->copyrightYear = \date('Y');
  }
}
