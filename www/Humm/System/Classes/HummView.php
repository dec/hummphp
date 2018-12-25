<?php

/**
 * This file implement the HummView system class.
 *
 * The HummView system class is intented to be inherited
 * by all system and user sites views classes.
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link https://www.davidesperalta.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2019 Humm PHP - David Esperalta
 */

namespace Humm\System\Classes;

/**
 * System HummView class implementation.
 *
 * Every Humm PHP view class must inherites from this
 * in order to be considered a valid views class.
 *
 * @abstract
 */
abstract class HummView extends BaseClass
{
  /**
   * Store the view HtmlTemplate object.
   *
   * @var HtmlTemplate
   */
  protected $template = null;

  /**
   * Construct an HtmlView object and store their associated template.
   *
   * @param HtmlTemplate $template HTML template object.
   */
  public function __construct(HtmlTemplate $template)
  {
    $this->template = $template;
  }
}
