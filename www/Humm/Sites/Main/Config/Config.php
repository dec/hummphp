<?php

/**
 * Humm PHP user interfaz language.
 *
 * String value (ISO 639-1), "en" by default.
 *
 * Note that the right PO files must exists.
 *
 */
\define('HUMM_LANGUAGE', 'en');

/**
 * Determine the active Humm PHP plugins.
 *
 * Comma separated plugin dir/names to activate.
 *
 * String value, empty by default.
 *
 */
\define('HUMM_ACTIVE_PLUGINS', '');

/**
 * Determine if Humm PHP shown errors.
 *
 * Boolean value, "true" by default.
 *
 */
\define('HUMM_SHOW_ERRORS', true);

/**
 * Optional database connection string (DSN).
 *
 * Example: "mysql:host=localhost;dbname=database"
 *
 * String value, empty by default
 *
 */
\define('HUMM_DATABASE_DSN', '');

/**
 * The appropiate database user name.
 *
 * String value, empty by default
 *
 */
\define('HUMM_DATABASE_USER', '');

/**
 * The appropiate database user password.
 *
 * String value, empty by default
 *
 */
\define('HUMM_DATABASE_PASS', '');

/**
 * Define the default Humm PHP database charset name.
 *
 * String value, empty by default
 *
 * Can be "utf8", for example.
 *
 */
\define('HUMM_DATABASE_CHARSET_NAME', '');
