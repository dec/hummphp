<?php

/**
 * This file implement the Unclonable system class.
 *
 * This class is intended to be inherited by other classes
 * which contain only static members.
 *
 * @author D. Esperalta <info@decsoftutils.com>
 * @link https://www.decsoftutils.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2021 Humm PHP - David Esperalta
 */

namespace Humm\System\Classes;

/**
 * System Unclonable class implementation.
 *
 * Inherited by lot of system classes which only contain
 * static members and therefore don't need to be cloned
 * nor instantiated.
 *
 * @abstract
 */
abstract class Unclonable extends BaseClass
{
  /**
   * Hide the way to construct class objects.
   */
  private function __construct(){}

  /**
   * Hide the way to clone class objects.
   */
  private function __clone(){}
}
