<?php

/**
 * This file implement the Languages system class.
 *
 * Even when this class exposed methods for string translations,
 * we use instead certain I18n short functions when need to
 * translate strings.
 *
 * This refered functions are t(), e(), n() and ne() and
 * are implemented into the ShortFunctions.php file, which
 * is required by this class whenn initialized.
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link https://www.davidesperalta.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2018 Humm PHP - David Esperalta
 */

namespace Humm\System\Classes;

/**
 * System Languages class implementation.
 *
 * This class are used internally by the system to deal with
 * the site internationalization but also provided with useful
 * methods from the user sites point of view.
 *
 * However then you need to translate strings from site classes,
 * plugins and views, remember that the best choice is to use
 * the short I18n functions: t(), e(), n() and ne().
 */
class Languages extends Unclonable
{
  /**
   * Define the main (default) text I18n text domain.
   */
  const DEFAULT_DOMAIN = 'Main';

  /**
   * Define the left to right languages identifier.
   */
  const LEFT_TO_RIGHT_LANG = 'ltr';

  /**
   * Define the right to left languages identifier.
   */
  const RIGHT_TO_LEFT_LANG = 'rtl';

  /**
   * Define the file name in which I18n short functions resides.
   */
  const SHORT_FUNCTIONS_FILE = 'I18nFunctions.php';

  /**
   * List of parsed MO file paths.
   *
   * @var array
   */
  private static $moFiles = null;

  /**
   * List of messages from parsed MO files.
   *
   * @var array
   */
  private static $messages = null;

  /**
   * Associative array with language codes/names.
   *
   * @var array
   */
  private static $langsMap = null;

  /**
   * List of available site language codes.
   *
   * @var array
   */
  private static $langCodes = null;

  /**
   * Function to be used when translate plurals.
   *
   * @var callable
   */
  private static $pluralFunc = null;

  /**
   * Initialize the I18n system stuff.
   *
   * Put availables the I18n short functions; initialize
   * the languages maps and load the right text domains.
   *
   * @static
   * @staticvar int $init Prevent twice execution.
   */
  public static function init()
  {
    static $init = 0;
    if (!$init) {
      $init = 1;
      self::$moFiles = array();
      self::$messages = array();
      self::$pluralFunc = StrUtils::EMPTY_STRING;
      require FilePaths::systemI18nFunctions();
      // After require the I18n functions
      self::$langsMap = LanguagesMap::getMap();
      self::$langCodes = LanguagesMap::getCodes();
      self::loadTextDomain(FilePaths::siteTextDomain());
      self::loadTextDomain(FilePaths::sitesSharedTextDomain());
      self::loadTextDomain(FilePaths::systemTextDomain());
    }
  }

  /**
   * Retrieve the available language codes and names.
   *
   * @static
   * @return array Available codes and language names.
   */
  public static function getLanguages()
  {
    return self::$langsMap;
  }

  /**
   * Retrieve the currently used language code.
   *
   * @static
   * @return string Currently used language code.
   */
  public static function getCurrentLanguage()
  {
    $result = \HUMM_LANGUAGE;
    $langCode = UserInput::session(ClientSession::HUMM_LANGUAGE);
    if (self::languageExists($langCode)) {
      $result = $langCode;
    }
    return $result;
  }

  /**
   * Set the language to be use by the system and site.
   *
   * Note that we change the language storing it into the
   * user session, but in fact the changes do not take effect
   * until the next user request.
   *
   * The recommended approach when change the language is
   * to refresh the user request, of course with attention
   * to do not enter in a infinite loop.
   *
   * For example, supose you have an HTML form to change the
   * site language. This form action URL can be like this:
   *
   * http://www.yoursite.com/?newLanguage=es
   *
   * So in your HomeView class (which is the recommended
   * way instead of use the view template file itself) you
   * can check for the "newLanguage" input code, set the new
   * language using this class method, and finally redirect
   * the user to the home URL:
   *
   * http://www.yoursite.com/
   *
   * So at that time the language has been established, and
   * since the "newLanguage" user input do not exists, your
   * check file and therefore cannot redirect it again.
   *
   * @static
   * @param string $langCode Valid language code to be set.
   * @return boolean True if success, False on failure.
   */
  public static function setCurrentLanguage($langCode)
  {
    $result = false;
    if (self::languageExists($langCode)) {
      $result = ClientSession::setVar(ClientSession::HUMM_LANGUAGE, $langCode);
    }
    self::reset();
    return $result;
  }

  /**
   * Find if a language code is available to use.
   *
   * @static
   * @param string $langCode Language code to be validated.
   * @return boolean True on available languages, False when not.
   */
  public static function languageExists($langCode)
  {
    return \in_array($langCode, self::$langCodes);
  }

  /**
   * Load a text domain into the messages stack.
   *
   * @static
   * @param string $moFilePath MO file file path.
   * @param string $textDomain Messages text domain.
   * @return boolean True on success, False on failure.
   */
  public static function loadTextDomain($moFilePath,
   $textDomain = Languages::DEFAULT_DOMAIN)
  {
    return self::loadMOFile($moFilePath, $textDomain);
  }

  /**
   * Returns an string translation or the original one.
   *
   * Remember you can use the short function t() which
   * is an alias for this class method.
   *
   * @static
   * @param string $message String to be translated.
   * @param string $textDomain Messages text domain.
   * @return string Translated string or the original one.
   */
  public static function translate($message,
   $textDomain = Languages::DEFAULT_DOMAIN)
  {
    if (isset(self::$messages[$textDomain][$message])) {
      $message = self::$messages[$textDomain][$message][1][0];
    }
    return $message;
  }

  /**
   * Returns the singular or plural version of a message.
   *
   * Remember you can use the short function n() which
   * is an alias for this class method.
   *
   * @static
   * @param string $singular Message in singular version.
   * @param type $plural Message in plural version.
   * @param type $count Number to determine what version retrieve.
   * @param string $textDomain Message text domain.
   * @return string Singular or plural message version.
   */
  public static function nTranslate($singular, $plural,
   $count, $textDomain = Languages::DEFAULT_DOMAIN
  )
  {
    $result = $count == 1 ? $singular : $plural;

    if (isset(self::$messages[$textDomain][$singular])) {
      $fn = self::$pluralFunc;
      $n = $fn($count);
      if (isset(self::$messages[$textDomain][$singular][1][$n])) {
        $result = self::$messages[$textDomain][$singular][1][$n];
      }
    }
    return $result;
  }

  /**
   * Retrieve the direction of the current language.
   *
   * This function result can be used directly in HTML "dir"
   * element attributes to specify the language direction.
   *
   * @static
   * @return string Language direction identifier.
   */
  public static function getLanguageDirection()
  {
    $result = self::LEFT_TO_RIGHT_LANG;
    if (\in_array(self::getCurrentLanguage(),
     \array_keys(LanguagesMap::getRtlMap()))) {
       $result = self::RIGHT_TO_LEFT_LANG;
    }
    return $result;
  }

  /**
   * Load messages from a MO file into the specified text domain.
   *
   * @static
   * @param string $moFilePath Text domain MO file.
   * @param string $textDomain Messages text domain.
   * @return boolean True on success, False on failure.
   */
  private static function loadMOFile($moFilePath, $textDomain)
  {
    $result = true;
    if (!\in_array($moFilePath, self::$moFiles)) {
      if (MOFileParser::parseFile($moFilePath,
       $textDomain, self::$messages, self::$pluralFunc)) {
         // To avoid load twice
         self::$moFiles[] = $moFilePath;
      } else {
        $result = false;
      }
    }
    return $result;
  }

  /**
   * This method is intended to be called by self::setCurrentLanguage(),
   * in order to properly apply the language change.
   * 
   * @static
   */  
  private static function reset()
  {
    self::$moFiles = array();
    self::$messages = array();
    self::loadTextDomain(FilePaths::siteTextDomain());
    self::loadTextDomain(FilePaths::sitesSharedTextDomain());
    self::loadTextDomain(FilePaths::systemTextDomain());
  }  
}
