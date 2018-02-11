<?php

/**
 * This file implement the FilterArguments system class.
 *
 * Humm PHP use this class when a plugin filter is execued:
 * this class encapsulate the available filter arguments.
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link https://www.davidesperalta.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2018 Humm PHP - David Esperalta
 */

namespace Humm\System\Classes;

/**
 * System FilterArguments class implementation.
 *
 * This class can be used by system and site plugins
 * to access the executed filters arguments.
 */
class FilterArguments extends PluginArguments
{
  /**
   * Define the name of the filter ID property.
   *
   * We use this when need to provide the appropiate
   * plugin filter ID for the executing plugin filter.
   */
  const FILTER = 'filter';

  /**
   * Plugin arguments filter ID.
   *
   * @var int
   */
  public $filter = null;

  /**
   * Construct an FilterArguments object.
   *
   * @param array $arguments Filter arguments associated array
   */
  public function __construct($arguments = array())
  {
    $this->filter = null;
    parent::__construct($arguments);
  }
}
