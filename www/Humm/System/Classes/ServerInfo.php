<?php

/**
 * This file implement the ServerInfo system class.
 *
 * This class provide information about the server in
 * which Humm PHP is executed.
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link http://www.davidesperalta.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2017 Humm PHP - David Esperalta
 */

namespace Humm\System\Classes;

/**
 * System ServerInfo class implementation.
 *
 * This class is internally used by the system and their
 * stuff can also be useful for user sites.
 *
 */
class ServerInfo extends Unclonable
{
  /**
   * Define the localhost IP address.
   */
  const LOCALHOST_ADDRESS = '127.0.0.1';

  /**
   * Store the server root URL.
   *
   * @var string
   */
  private static $url = null;

  /**
   * Retrieve the current server URI.
   *
   * @static
   * @return string Current server URI.
   */
  public static function uri()
  {
    return UserInput::server('REQUEST_URI');
  }

  /**
   * Retrieve the server script name.
   *
   * @static
   * @return string Current server script name.
   */
  public static function script()
  {
    return UserInput::server('SCRIPT_NAME');
  }
  
  /**
   * Retrieve the server document root path.
   *
   * @static
   * @return string Current server document root path.
   */
  public static function docRoot()
  {
    return UserInput::server('DOCUMENT_ROOT');
  }  

  /**
   * Find if the server is a localhost or not.
   *
   * @static
   * @return boolean True if the server is local, False if not.
   */
  public static function isLocal()
  {
    return UserInput::server('SERVER_ADDR') ===
            self::LOCALHOST_ADDRESS;
  }

  /**
   * Retrieve the server root URL.
   *
   * @static
   * @return string Server root URL.
   */
  public static function url()
  {
    if (self::$url == null) {
      $protocol = 'http';
      if ((UserInput::server('HTTPS') != null)
       && (UserInput::server('HTTPS') != 'off')) {
         $protocol .= 's';
      }
      self::$url = \sprintf
      (
        '%s://%s',
        $protocol,
        UserInput::server('SERVER_NAME')
      );
    }
    return self::$url;
  }
}
