<?php

/**
 * This file implement the PluginPriorities system class.
 *
 * This class is intended to define constants to be
 * used as Humm plugins priorities identifiers.
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link https://www.davidesperalta.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2019 Humm PHP - David Esperalta
 */

namespace Humm\System\Classes;

/**
 * System PluginPriorities class implementation.
 *
 * This class is intended to define constants to be
 * used as Humm plugins priorities identifiers.
 */
class PluginPriorities extends Unclonable
{
  /**
   * Define the plugins lower priority.
   */
  const LOWER = 3001;

  /**
   * Define the plugins low priority.
   */
  const LOW = 3002;

  /**
   * Define the plugins normal priority.
   */
  const NORMAL = 3003;

  /**
   * Define the plugins higher priority.
   */
  const HIGHER = 3004;

  /**
   * Define the plugins highest priority.
   */
  const HIGHEST = 3005;

  /**
   * Define the plugins critical priority.
   */
  const CRITICAL = 3006;
}
