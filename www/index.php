<?php

/**
 * This file implement the Humm PHP entry point.
 *
 * Every user request to a Humm PHP managed site
 * end here and then Humm initiates the boot strap.
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link https://www.davidesperalta.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2018 Humm PHP - David Esperalta
 */

/**
 * Register our classes autoload.
 */
\spl_autoload_register(function($class)
{
  require __DIR__.\DIRECTORY_SEPARATOR.\str_replace(
         '\\', \DIRECTORY_SEPARATOR, $class).'.php';
});

 /**
 * Initiates the system boot strap.
 */
\Humm\System\Classes\BootStrap::init(__DIR__);
