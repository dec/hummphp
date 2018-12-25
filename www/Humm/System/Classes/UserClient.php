<?php

/**
 * This file implement the UserClient system class.
 *
 * This class is intended to offer a convenient way
 * to get information about the current user client.
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link https://www.davidesperalta.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2019 Humm PHP - David Esperalta
 */

namespace Humm\System\Classes;

/**
 * System UserClient class implementation.
 *
 * This class can be used by both system and user site
 * in order to retrieve information of the user client.
 *
 */
class UserClient extends Unclonable
{
  /**
   * Store the user client IP address.
   *
   * @var string
   */
  private static $ipAddress = null;

  /**
   * Redirect the user to certain URL.
   *
   * This method exit the script execution
   * after the redirection is performed.
   *
   * @static
   * @param string $url To redirecting.
   */
  public static function redirectTo($url)
  {
    header('Location: '.$url);
    exit;
  }

  /**
   * Redirect the user to the current site home.
   *
   * @static
   */
  public static function redirectToHome()
  {
    self::redirectTo(UrlPaths::root());
  }

  /**
   * Retrieve the user client two language code.
   *
   * @static
   * @return string User client two letters language code.
   */
  public static function language()
  {
    return \substr(UserInput::server(
     'HTTP_ACCEPT_LANGUAGE', \HUMM_LANGUAGE), 0, 2);
  }

  /**
   * Retrieve the user client IP address.
   *
   * @static
   * @return string User client IP address.
   */
  public static function ipAddress()
  {
    if (self::$ipAddress === null) {
      self::$ipAddress = StrUtils::EMPTY_STRING;
      if (UserInput::server('REMOTE_ADDR') != null) {
        self::$ipAddress = UserInput::server('REMOTE_ADDR');
      } else if (UserInput::server('HTTP_CLIENT_IP') != null) {
        self::$ipAddress = UserInput::server('HTTP_CLIENT_IP');
      } else if (UserInput::server('HTTP_X_FORWARDED_FOR') != null) {
        self::$ipAddress = UserInput::server('HTTP_X_FORWARDED_FOR');
      } else if (UserInput::server('HTTP_VIA') != null) {
        self::$ipAddress = UserInput::server('HTTP_VIA');
      }
    }
    return self::$ipAddress;
  }
}
