<?php

/**
 * This file implement the MOFileParser system class.
 *
 * This class are used by the system Languages to parse
 * text domain MO files and extract their string messages.
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link https://www.davidesperalta.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2019 Humm PHP - David Esperalta
 */

namespace Humm\System\Classes;

/**
 * System MOFileParser class implementation.
 *
 * This class is intented to be used internally by the Languages
 * system class and user sites code do not need to use it.
 *
 * Credits for this class code go to Danilo Segan <danilo@kvota.net>
 * which writen it (if I am not wrong) for the PHP-Gettext project.
 */
class MOFileParser extends Unclonable
{
  /**
   * Extract the string messages from an MO file.
   *
   * @static
   * @param string $filePath MO file path.
   * @param string $textDomain Text domain in which store the messages.
   * @param array $messages Reference variable to store the messages.
   * @param string $pluralFunc Reference variable to store the plural function.
   * @return boolean True on success, False on failure.
   */
  public static function parseFile(
   $filePath, $textDomain, &$messages, &$pluralFunc)
  {
    $result = false;
    $fileData = self::getFileData($filePath);
    $fileHeader = self::getFileHeader($filePath, $fileData);
    if (($fileData !== null) && ($fileHeader !== null)) {
      self::fillMessages($fileData, $fileHeader, $textDomain, $messages);
      if (isset($messages[$textDomain]) &&
       (\count($messages[$textDomain]) > 0)) {
         $result = true;
         $textFileHeader = $messages[$textDomain][''][1][0];
         $pluralFunc = self::getPluralFunc($textFileHeader);
      }
    }
    return $result;
  }

  /**
   * Retrieve the data of a MO file.
   *
   * This method also validate if the file data have the
   * appropiate "revision" and length.
   *
   * @static
   * @param string $filePath MO file path.
   * @return mixed|null File data on success or null in other case.
   */
  private static function getFileData($filePath)
  {
    $result = null;
    if (\is_readable($filePath) && \filesize($filePath) > 24) {
      $fileHandle = \fopen($filePath, 'rb');
      $fileData = \fread($fileHandle, \filesize($filePath));
      \fclose($fileHandle);
      $strLen = \strlen($fileData);
      $revision = \substr($fileData, 4, 4);
      if (($revision == 0) && ($strLen >= 20)) {
        $result = $fileData;
      }
    }
    return $result;
  }

  /**
   * Find if the MO file data is in little endian.
   *
   * @static
   * @param string $fileData MO file data.
   * @return boolean True if data is little endian, False when not.
   */
  private static function isLittleEndian($fileData)
  {
    $result = false;
    $unpack = \unpack('V1', substr($fileData, 0, 4));
    $magic = isset($unpack[1]) ? $unpack[1] : false;
    switch ($magic & 0xFFFFFFFF) {
      case (int)0x950412de:
        $result = true;
        break;
      case (int)0xde120495:
        $result = false;
        break;
    }
    return $result;
  }

  /**
   * Get the header of a MO file.
   *
   * This method also validate the file header.
   *
   * @static
   * @param string $filePath MO file path.
   * @param string $fileData MO file data.
   * @return array|null Unpacked MO file header on success or null.
   */
  private static function getFileHeader($filePath, $fileData)
  {
    $result = null;
    if ($fileData !== null) {
      $l = self::isLittleEndian($fileData) ? 'V' : 'N';
      $fileHeader = \unpack
      (
        "{$l}1msgcount/{$l}1msgblock/{$l}1transblock",
        \substr($fileData, 8, 12)
      );
      if (($fileHeader['msgblock'] + ($fileHeader['msgcount'] - 1) * 8) <
       \filesize($filePath)) {
         $result = $fileHeader;
      }
    }
    return $result;
  }

  /**
   * Retrieve the messages from a MO file.
   *
   * @static
   * @param string $fileData MO file data.
   * @param array $fileHeader Unpacked MO file header.
   * @param string $textDomain Text domain in which store the messages.
   * @param array $messages Reference variable to store the messages.
   */
  private static function fillMessages(
   $fileData, $fileHeader, $textDomain, &$messages)
  {
    $l = self::isLittleEndian($fileData) ? 'V' : 'N';
    $lo = "{$l}1length/{$l}1offset";
    for ($msgIndex = 0; $msgIndex < $fileHeader['msgcount']; $msgIndex++) {
      $msgInfo = \unpack($lo, \substr($fileData,
       $fileHeader['msgblock'] + $msgIndex * 8, 8));

      $msgids = \explode('\0', \substr($fileData,
       $msgInfo['offset'], $msgInfo['length']));

      $transInfo = \unpack($lo, \substr($fileData,
       $fileHeader['transblock'] + $msgIndex * 8, 8));

      $transIDs = \explode('\0', \substr($fileData,
       $transInfo['offset'], $transInfo['length']));

      $messages[$textDomain][$msgids[0]] = array($msgids, $transIDs);
    }
  }

  /**
   * Find a MO file defined plurals function and get it.
   *
   * @static
   * @param string $textFileHeader MO file header.
   * @param array $matches Reference for the matched strings.
   * @return boolean True if a plural function is found.
   */
  private static function matchPluralFunc($textFileHeader, &$matches)
  {
    return
    (
      \preg_match
      (
        '/plural-forms: (.*)/i',
        $textFileHeader,
        $matches
      )
      &&
      \preg_match
      (
        '/^\s*nplurals\s*=\s*(\d+)\s*;\s*plural=(.*)/',
        $matches[1],
        $matches
      )
    );
  }

  /**
   * Retrieve the MO file defined plurals function.
   *
   * @static
   * @param string $textFileHeader MO file header.
   * @return string MO file defined function or the default function.
   */
  private static function getPluralFunc($textFileHeader)
  {
    $matches = array();
    $result = self::defaultPluralFunc();
    if (self::matchPluralFunc($textFileHeader, $matches)) {
      $body = self::getPluralFuncBody($matches);
      $result = \create_function('$n', $body);
    }
    return $result;
  }

  /**
   * Get the default plurals function.
   *
   * @static
   * @return string Unique function name as a string or False on error.
   */
  private static function defaultPluralFunc()
  {
    return \create_function
    (
      '$n',
      '$nplurals=2;
      $plural = ($n == 1 ? 0 : 1);
      return ($plural >= $nplurals ? $nplurals - 1 : $plural);'
    );
  }

  /**
   * Retrieve the plurals function from MO file matches.
   *
   * @static
   * @param array $matches Plurals function matches.
   * @return string Body for the plurals function.
   */
  private static function getPluralFuncBody($matches)
  {
    $nPlurals = \preg_replace('/[^0-9]/', '', $matches[1]);
    $plural = \preg_replace('/[^n0-9:\(\)\?\|\&=!<>+*\/\%\-]/','',$matches[2]);

    $body = \str_replace
    (
      array('plural', 'n', '$n$plurals'),
      array('$plural', '$n', '$nPlurals'),
      'nplurals='.$nPlurals.'; plural='.$plural
    );

    return self::fixPluralFuncBody($body).
     'return ($plural >= $nPlurals ? $nPlurals - 1: $plural);';
  }

  /**
   * Fix the plural function body.
   *
   * @static
   * @param string $body Plural function body.
   * @return string Plural function body fixed.
   */
  private static function fixPluralFuncBody($body)
  {
    $p = 0; $res = ''; $body .= ';';

    for ($i = 0; $i < \strlen($body); $i++) {
      switch ($body[$i]) {
        case '?':
          $res.= ' ? ('; $p++;
          break;
        case ':':
          $res.= ') : (';
          break;
        case ';':
          $res.= \str_repeat(')', $p).';';
          $p = 0;
          break;
        default:
          $res.= $body[$i];
          break;
      }
    }
    return $res;
  }
}
