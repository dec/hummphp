<?php

/**
 * This file implement the LanguagesMap system class.
 *
 * This class offer an ISO_639-1 language codes/names map,
 * look for the available language codes and provide other
 * useful stuff internally used by the Language class.
 *
 * @author DecSoft Utils <info@decsoftutils.com>
 * @link https://www.decsoftutils.com/
 * @license https://github.com/dec/hummphp/blob/master/LICENSE
 * @copyright (C) Humm PHP - DecSoft Utils
 */

namespace Humm\System\Classes;

/**
 * System LanguagesMap class implementation.
 *
 * This is a system class internally used from the
 * system Languages class and user site stuff do not
 * need to use it directly.
 */
class LanguagesMap extends Unclonable
{
  /**
   * Available language codes/names.
   *
   * @var array
   */
  private static $map = null;

  /**
   * Available language codes.
   *
   * @var array
   */
  private static $codes = null;

  /**
   * RTL language codes/names.
   *
   * @var array
   */
  private static $rtlMap = null;

  /**
   * Retrieve the available language codes.
   *
   * @static
   * @return array Available language codes.
   */
  public static function getCodes()
  {
    if (self::$codes === null) {
      self::$codes = self::getSiteLocaleDirNames();
      if (!in_array(\HUMM_LANGUAGE, self::$codes)) {
        self::$codes[] = \HUMM_LANGUAGE;
      }
    }
    return self::$codes;
  }

  /**
   * List with the available language codes/names.
   *
   * @static
   * @link http://en.wikipedia.org/wiki/ISO_639-1
   * @return array ISO_639-1 language codes/names.
   */
  public static function getMap()
  {
    if (self::$map === null) {
      $map = array
      (
        'en' => 'English',
        'aa' => 'Afar',
        'ab' => 'Abkhazian',
        'af' => 'Afrikaans',
        'am' => 'Amharic',
        'ar' => 'Arabic',
        'as' => 'Assamese',
        'ay' => 'Aymara',
        'az' => 'Azerbaijani',
        'ba' => 'Bashkir',
        'be' => 'Byelorussian',
        'bg' => 'Bulgarian',
        'bh' => 'Bihari',
        'bi' => 'Bislama',
        'bn' => 'Bengali/Bangla',
        'bo' => 'Tibetan',
        'br' => 'Breton',
        'ca' => 'Catalan',
        'co' => 'Corsican',
        'cs' => 'Czech',
        'cy' => 'Welsh',
        'da' => 'Danish',
        'de' => 'German',
        'dz' => 'Bhutani',
        'el' => 'Greek',
        'eo' => 'Esperanto',
        'es' => 'Español',
        'et' => 'Estonian',
        'eu' => 'Basque',
        'fa' => 'Persian',
        'fi' => 'Finnish',
        'fj' => 'Fiji',
        'fo' => 'Faeroese',
        'fr' => 'French',
        'fy' => 'Frisian',
        'ga' => 'Irish',
        'gd' => 'Scots/Gaelic',
        'gl' => 'Galician',
        'gn' => 'Guarani',
        'gu' => 'Gujarati',
        'ha' => 'Hausa',
        'hi' => 'Hindi',
        'hr' => 'Croatian',
        'hu' => 'Hungarian',
        'hy' => 'Armenian',
        'ia' => 'Interlingua',
        'ie' => 'Interlingue',
        'ik' => 'Inupiak',
        'in' => 'Indonesian',
        'is' => 'Icelandic',
        'it' => 'Italian',
        'iw' => 'Hebrew',
        'ja' => 'Japanese',
        'ji' => 'Yiddish',
        'jw' => 'Javanese',
        'ka' => 'Georgian',
        'kk' => 'Kazakh',
        'kl' => 'Greenlandic',
        'km' => 'Cambodian',
        'kn' => 'Kannada',
        'ko' => 'Korean',
        'ks' => 'Kashmiri',
        'ku' => 'Kurdish',
        'ky' => 'Kirghiz',
        'la' => 'Latin',
        'ln' => 'Lingala',
        'lo' => 'Laothian',
        'lt' => 'Lithuanian',
        'lv' => 'Latvian/Lettish',
        'mg' => 'Malagasy',
        'mi' => 'Maori',
        'mk' => 'Macedonian',
        'ml' => 'Malayalam',
        'mn' => 'Mongolian',
        'mo' => 'Moldavian',
        'mr' => 'Marathi',
        'ms' => 'Malay',
        'mt' => 'Maltese',
        'my' => 'Burmese',
        'na' => 'Nauru',
        'ne' => 'Nepali',
        'nl' => 'Dutch',
        'no' => 'Norwegian',
        'oc' => 'Occitan',
        'om' => '(Afan)/Oromoor/Oriya',
        'pa' => 'Punjabi',
        'pl' => 'Polish',
        'ps' => 'Pashto/Pushto',
        'pt' => 'Portuguese',
        'qu' => 'Quechua',
        'rm' => 'Rhaeto-Romance',
        'rn' => 'Kirundi',
        'ro' => 'Romanian',
        'ru' => 'Russian',
        'rw' => 'Kinyarwanda',
        'sa' => 'Sanskrit',
        'sd' => 'Sindhi',
        'sg' => 'Sangro',
        'sh' => 'Serbo-Croatian',
        'si' => 'Singhalese',
        'sk' => 'Slovak',
        'sl' => 'Slovenian',
        'sm' => 'Samoan',
        'sn' => 'Shona',
        'so' => 'Somali',
        'sq' => 'Albanian',
        'sr' => 'Serbian',
        'ss' => 'Siswati',
        'st' => 'Sesotho',
        'su' => 'Sundanese',
        'sv' => 'Swedish',
        'sw' => 'Swahili',
        'ta' => 'Tamil',
        'te' => 'Tegulu',
        'tg' => 'Tajik',
        'th' => 'Thai',
        'ti' => 'Tigrinya',
        'tk' => 'Turkmen',
        'tl' => 'Tagalog',
        'tn' => 'Setswana',
        'to' => 'Tonga',
        'tr' => 'Turkish',
        'ts' => 'Tsonga',
        'tt' => 'Tatar',
        'tw' => 'Twi',
        'uk' => 'Ukrainian',
        'ur' => 'Urdu',
        'uz' => 'Uzbek',
        'vi' => 'Vietnamese',
        'vo' => 'Volapuk',
        'wo' => 'Wolof',
        'xh' => 'Xhosa',
        'yo' => 'Yoruba',
        'zh' => 'Chinese',
        'zu' => 'Zulu'
      );
      foreach ($map as $code => $name) {
        if (\in_array($code, self::getCodes())) {
          self::$map[$code] = $name;
        }
      }
      \asort(self::$map);
    }
    return self::$map;
  }

  /**
   * Retrieve a map of RTL language codes/names.
   *
   * @static
   * @link http://en.wikipedia.org/wiki/Right-to-left
   * @return array RTL language codes/names.
   */
  public static function getRtlMap()
  {
    if (self::$rtlMap === null) {
      self::$rtlMap = array
      (
        'ar'  => 'Arabic',
        'arc' => 'Aramaic',
        'bcc' => 'Southern Balochi',
        'bqi' => 'Bakthiari',
        'ckb' => 'Sorani',
        'dv'  => 'Dhivehi',
        'fa'  => 'Persian',
        'glk' => 'Gilaki',
        'he'  => 'Hebrew',
        'ku'  => 'Kurdish',
        'mzn' => 'Mazanderani',
        'pnb' => 'Western Punjabi',
        'ps'  => 'Pashto',
        'sd'  => 'Sindhi',
        'ug'  => 'Uyghur',
        'ur'  => 'Urdu',
        'yi'  => 'Yiddish'
      );
    }
    return self::$rtlMap;
  }

  /**
   * Retrive the available site locale directory names.
   *
   * @static
   * @return array List of founded site locale directory names.
   */
  private static function getSiteLocaleDirNames()
  {
    $result = array();
    $siteLocaleDir = DirPaths::siteLocale();
    if (\file_exists($siteLocaleDir)) {
      foreach (new \DirectoryIterator($siteLocaleDir) as $fileInfo) {
        if (self::moFileExists($fileInfo)) {
          $result[] = $fileInfo->getBasename();
        }
      }
    }
    return $result;
  }

  /**
   * Find if a MO file exists or not.
   *
   * @static
   * @param \SplFileInfo $fileInfo File information.
   * @return boolean True if the MO file exists, False if not
   */
  private static function moFileExists(\SplFileInfo $fileInfo)
  {
    return $fileInfo->isDir() && \file_exists(self::getMOFilePath($fileInfo));
  }

  /**
   * Get an MO file absolute path.
   *
   * @static
   * @param \SplFileInfo $fileInfo File information.
   * @return string Absolute MO file path.
   */
  private static function getMOFilePath(\SplFileInfo $fileInfo)
  {
    return $fileInfo->getPath().
           \DIRECTORY_SEPARATOR.
           $fileInfo->getBasename().
           \DIRECTORY_SEPARATOR.
           $fileInfo->getBasename().
           FileExts::DOT_MO;
  }
}
