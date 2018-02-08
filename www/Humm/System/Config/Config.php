<?php

/**
 * This file defines Humm PHP configuration constants.
 *
 * Humm PHP run out of the box and do not need any
 * configuration nor installation, but the users can
 * define certain optional configuration constants.
 *
 * In this file we assert such constants are well
 * defined into the global PHP namespace if the user
 * decide to do not provide any configuration file.
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link http://www.davidesperalta.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2017 Humm PHP - David Esperalta
 */

/**
 * Define the default Humm PHP language.
 */
if (!\defined('\HUMM_LANGUAGE')) {
  \define('HUMM_LANGUAGE', 'en');
}

/**
 * Define the Humm PHP active plugins.
 */
if (!\defined('\HUMM_ACTIVE_PLUGINS')) {
  \define('HUMM_ACTIVE_PLUGINS', '');
}

/**
 * Define the default Humm PHP error level.
 */
if (!\defined('\HUMM_SHOW_ERRORS')) {
  \define('HUMM_SHOW_ERRORS', true);
}

/**
 * Define the default Humm PHP database DSN.
 */
if (!\defined('\HUMM_DATABASE_DSN')) {
  \define('HUMM_DATABASE_DSN', '');
}

/**
 * Define the default Humm PHP database user.
 */
if (!\defined('\HUMM_DATABASE_USER')) {
  \define('HUMM_DATABASE_USER', '');
}

/**
 * Define the default Humm PHP database password.
 */
if (!\defined('\HUMM_DATABASE_PASS')) {
  \define('HUMM_DATABASE_PASS', '');
}
