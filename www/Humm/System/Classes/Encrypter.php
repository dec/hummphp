<?php

/**
 * This file implement the Encrypter system class.
 *
 * Humm PHP offers this class to be useful in the sites.
 * The code is enterely based in the "Simple PHP encrypt and 
 * decrypt" article by Naveen Nayak - https://goo.gl/41sx8s
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link https://www.davidesperalta.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2019 Humm PHP - David Esperalta
 */

namespace Humm\System\Classes;

/**
 * System Encrypter class implementation.
 *
 * This is another useful class to be used in the 
 * Humm PHP managed sites.
 */
class Encrypter extends Unclonable
{
  /**
   * Encrypt the specified text string.
   *
   * This method encrypt the specified text string using
   * the also provided "secret key" and "secret IV".
   *
   * @static
   * @param string $text String to be encrypted
   * @param string $secretKey The secret key to be used
   * @param string $secretIV The secret IV to be used
   * @return string The encrypted text in base64 codification
   */
  public static function encrypt($text, $secretKey, $secretIV)
  {
    return \base64_encode
    (
      \openssl_encrypt
      (
        $text, 
        'AES-256-CBC', 
        \hash('sha256', $secretKey), 
        0, 
        \substr(\hash('sha256', $secretIV), 0, 16)
      )
    );
  }
  
  /**
   * Decrypt the specified previously encrypted string.
   *
   * This method decrypt the specified previously encrypted text 
   * string using the also provided "secret key" and "secret IV".
   *
   * @static
   * @param string $text Base64 codified string to be decrypted
   * @param string $secretKey The secret key used when encrypt
   * @param string $secretIV The secret IV used when encrypt
   * @return string The decrypted text
   */
  public static function decrypt($text, $secretKey, $secretIV)
  {
    return \openssl_decrypt
    (
      \base64_decode($text), 
      'AES-256-CBC', 
      \hash('sha256', $secretKey), 
      0, 
      \substr(\hash('sha256', $secretIV), 0, 16)
    );
  }  
}
