<?php

/**
 * This file implement the short I18n functions.
 *
 * Instead of use the Languages system class to translate string
 * we implement here (into the global namespace) convenient and
 * short I18n functions for string translation.
 *
 * This file is required by the system Languages class when
 * it's initialized in order to put this functions availables.
 *
 * @author DecSoft Utils <info@decsoftutils.com>
 * @link https://www.decsoftutils.com/
 * @license https://github.com/dec/hummphp/blob/master/LICENSE
 * @copyright (C) Humm PHP - DecSoft Utils
 */

use
  \Humm\System\Classes\Languages;

/**
 * Get an string translation or the original one.
 *
 * @param string $message String to be translated.
 * @param string $textDomain Optional messages text domain.
 * @return string Translated or untouched string.
 */
function t($message, $textDomain = Languages::DEFAULT_DOMAIN)
{
  return Languages::translate($message, $textDomain);
}

/**
 * Print a string translation or the original one.
 *
 * @param string $message String to be translated.
 * @param string $textDomain Optional messages text domain.
 */
function e($message, $textDomain = Languages::DEFAULT_DOMAIN)
{
  echo Languages::translate($message, $textDomain);
}

/**
 * Get a singular or plural translation or the original string.
 *
 * @param string $singular Singular version of the message.
 * @param string $plural Plural version of the message.
 * @param int $count Number which determine what version use.
 * @param string $textDomain Optional messages text domain.
 * @return string Translated or untouched singular or plural version.
 */
function n($singular, $plural, $count,
 $textDomain = Languages::DEFAULT_DOMAIN)
{
  return Languages::nTranslate($singular,
   $plural, $count, $textDomain);
}

/**
 * Print a singular or plural translation or the original string.
 *
 * @param string $singular Singular version of the message.
 * @param string $plural Plural version of the message.
 * @param int $count Number which determine what version use.
 * @param string $textDomain Optional messages text domain.
 */
function ne($singular, $plural, $count,
 $textDomain = Languages::DEFAULT_DOMAIN)
{
  echo Languages::nTranslate($singular,
   $plural, $count, $textDomain);
}
