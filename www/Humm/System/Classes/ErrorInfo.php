<?php

/**
 * This file implement the ErrorInfo system class.
 *
 * This class is used internally by Humm PHP to
 * encapsulate PHP errors and exceptions information.
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link https://www.davidesperalta.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2018 Humm PHP - David Esperalta
 */

namespace Humm\System\Classes;

/**
 * System ErrorInfo class implementation.
 *
 * This class is used internally by our error handler in order
 * to encapsulate a PHP error or exception information.
 */
class ErrorInfo extends BaseClass
{
  /**
   * Error file path.
   *
   * @var string
   */
  public $file = null;

  /**
   * Error file number.
   *
   * @var int
   */
  public $lineNum = null;

  /**
   * Error message.
   *
   * @var string
   */
  public $message = null;

  /**
   * Error code.
   *
   * @var int
   */
  public $errorCode = null;

  /**
   * Error code string.
   *
   * @var string
   */
  public $errorCodeStr = null;

  /**
   * Construct an ErrorInfo object.
   *
   * @param int $errorCode Error code.
   * @param string $message Error message.
   * @param string $file Error file path.
   * @param int $lineNum Error file number.
   */
  public function __construct($errorCode, $message, $file, $lineNum)
  {
    $this->file = $file;
    $this->lineNum = $lineNum;
    $this->errorCode = $errorCode;
    $this->message = \trim($message);
    $this->errorCodeStr = $this->getCodeAsString();
  }

  /**
   * Translate an error code into string.
   *
   * @return string Error code string representation.
   */
  private function getCodeAsString()
  {
    switch ($this->errorCode) {
      case E_ALL: $result = 'E_ALL'; break;
      case E_PARSE: $result = 'E_PARSE'; break;
      case E_ERROR: $result = 'E_ERROR'; break;
      case E_NOTICE: $result = 'E_NOTICE'; break;
      case E_STRICT: $result = 'E_STRICT'; break;
      case E_WARNING: $result = 'E_WARNING'; break;
      case E_USER_ERROR: $result = 'E_USER_ERROR'; break;
      case E_CORE_ERROR: $result = 'E_CORE_ERROR'; break;
      case E_USER_NOTICE: $result = 'E_USER_NOTICE'; break;
      case E_USER_WARNING: $result = 'E_USER_WARNING'; break;
      case E_CORE_WARNING: $result = 'E_CORE_WARNING'; break;
      case E_COMPILE_ERROR: $result = 'E_COMPILE_ERROR'; break;
      case E_COMPILE_WARNING: $result = 'E_COMPILE_WARNING'; break;
      case E_RECOVERABLE_ERROR: $result = 'E_RECOVERABLE_ERROR'; break;
      default: $result = 'Unknow error'; break;
    }
    return $result;
  }
}
