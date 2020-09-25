<?php

/**
 * This file implement the Humm PHP entry point.
 *
 * Every user request to a Humm PHP managed site
 * end here and then Humm initiates the boot strap.
 *
 * @author D. Esperalta <info@decsoftutils.com>
 * @link https://www.decsoftutils.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2019 Humm PHP - David Esperalta
 */

/**
 * Register our classes autoload.
 */
\spl_autoload_register(function($class)
{
  $class_file_path = __DIR__.\DIRECTORY_SEPARATOR.
   \str_replace('\\', \DIRECTORY_SEPARATOR, $class).'.php';  
    
  if (file_exists($class_file_path)) {
    require_once $class_file_path;      
  }  
});

 /**
 * Initiates the system boot strap.
 */
\Humm\System\Classes\BootStrap::init(__DIR__);
