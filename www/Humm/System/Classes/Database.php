<?php

/**
 * This file implement the Database system class.
 *
 * Humm PHP use this class to provide user site classes,
 * views and plugins with an easy way to work with databases.
 *
 * @author DecSoft Utils <info@decsoftutils.com>
 * @link https://www.decsoftutils.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C) Humm PHP - DecSoft Utils
 */

namespace Humm\System\Classes;

/**
 * System Database class implementation.
 *
 * This class can be used by user site classes, views
 * and plugins to connect and work with databases.
 */
class Database extends Unclonable
{
  /**
   * Store our PDOExtended object.
   *
   * @var PDOExtended
   */
  private static $pdo = null;

  /**
   * Look for the database DSN and try to connect if exists.
   *
   * An user site can set the HUMM_DATABASE_DSN constant
   * with the appropiate database DSN string in order to
   * perform an automatically database connection.
   *
   * @static
   * @staticvar int $init Prevent twice execution.
   */
  public static function init()
  {
    static $init = 0;
    if (!$init) {
      $init = 1;
      if (!StrUtils::isTrimEmpty(\HUMM_DATABASE_DSN)) {
        self::tryToConnect();
      }
    }
  }

  /**
   * Find if certain database record exists.
   *
   * <code>
   *   // Find if a note with id = 1 exists
   *   if (Database::exists('notes', array('id' => 1))) {
   *     // Make something
   *   }
   *
   *   // Find if a note with id = 1 and priority = 1 exists
   *   if (Database::exists('notes', array('id' => 1, 'priority' => 1))) {
   *     // Make something
   *   }
   * </code>
   *
   * @static
   * @param string $table Database table name.
   * @param array $keyValues Associated array with field keys/values.
   * @return boolean True if the record exists, False if not.
   */
  public static function exists($table, $keyValues)
  {
    return self::$pdo->exists($table, $keyValues);
  }

  /**
   * Delete a record from the database.
   *
   * <code>
   *  <?php
   *   // Delete the note with ID = 1
   *   Database::delete('notes', array('id' => 1));
   *
   *   // Delete the note with ID = 1 and priority = 1
   *   Database::delete('notes', array('id' => 1, 'priority' => 1));
   *  ?>
   * </code>
   *
   * @static
   * @param string $table Database table name.
   * @param array $keyValues Associated array with field keys/values.
   * @return boolean True on succes, False on failure.
   */
  public static function delete($table, $keyValues)
  {
    return self::$pdo->delete($table, $keyValues);
  }

  /**
   * Insert a new database record.
   *
   * <code>
   *   # Insert a new note
   *   Database::insert
   *   (
   *     'notes',
   *     array('text' => 'First note', 'date' => time())
   *   );
   * </code>
   *
   * @static
   * @param string $table Database table name.
   * @param array $keyValues Associated array with field keys/values.
   * @return boolean True on succes, False on failure.
   */
  public static function insert($table, $keyValues)
  {
    return self::$pdo->insert($table, $keyValues);
  }

  /**
   * Update an existing database record.
   *
   * <code>
   *   # Update note text and title with ID = 1
   *   Database::update
   *   (
   *     'notes',
   *     array('id' => 1),
   *     array('text' => 'New text', 'title' => 'New title')
   *   );
   * </code>
   *
   * @static
   * @param string $table Database table name.
   * @param array $keyFields Associated array with field keys.
   * @param array $fieldValues Associated array with field values.
   * @return boolean True on succes, False on failure.
   */
  public static function update($table, $keyFields, $fieldValues)
  {
    return self::$pdo->update($table, $keyFields, $fieldValues);
  }

  /**
   * Get record fields as key and value pairs.
   *
   * <code>
   *   // Get date (as key) and text (as value) note with id = 1
   *   Database::keyVal
   *   (
   *     'SELECT date, text FROM notes WHERE id = ?', array(1)
   *   );
   *
   *   // Get date (as key) and text (as value) note with id = 1
   *   Database::keyVal
   *   (
   *     'SELECT date, text FROM notes WHERE id = :id', array('id' => 1)
   *   );
   * </code>
   *
   * @static
   * @param string $sql SQL statement to be prepared and executed.
   * @param array $params SQL statement parameters.
   * @return array Record field keys and values pairs.
   */
  public static function getPair($sql, $params = array())
  {
    return self::$pdo->getPair($sql, $params);
  }

  /**
   * Get an specific record field value.
   *
   * <code>
   *   // Get the text of a note with id = 1 (using value)
   *   Database::val
   *   (
   *     'SELECT text FROM notes WHERE id = ?',
   *     array(1)
   *   );
   *
   *   // Get the text of a note with id = 1 (using binded param)
   *   Database::val
   *   (
   *     'SELECT text FROM notes WHERE id = :id',
   *     array('id' => 1)
   *   );
   * </code>
   *
   * @static
   * @param string $sql SQL statement to be prepared and executed.
   * @param array $params SQL statement arguments.
   * @return string Value of the specified record field.
   */
  public static function getValue($sql, $params = array())
  {
    return self::$pdo->getValue($sql, $params);
  }

  /**
   * Get records field values as a column.
   *
   * <code>
   *   // Get all notes text field values
   *   Database::column('SELECT text FROM notes');
   *
   *   // Get all notes text with priority = 1 (using value)
   *   Database::column
   *   (
   *     'SELECT text FROM notes WHERE priority = ?',
   *     array(1)
   *   );
   *
   *   // Get all notes with priority = 1 (using binded param)
   *   Database::column
   *   (
   *     'SELECT text FROM notes WHERE priority = :priority',
   *     array('priority' => 1)
   *   );
   * </code>
   *
   * @static
   * @param string $sql SQL statement to be prepared an executed.
   * @param array $params SQL statement arguments.
   * @return array Values of the specified record field.
   */
  public static function getColumn($sql, $params = array())
  {
    return self::$pdo->getColumn($sql, $params);
  }

  /**
   * Get an specific record as a row.
   *
   * <code>
   *   // Get all fields of the note with id = 1 (using value)
   *   Database::row('SELECT * FROM notes WHERE id = ?', array(1));
   *
   *   // Get all fields of the note with id = 1 (using binded param)
   *   Database::row('SELECT * FROM notes WHERE id = :id', array('id' => 1));
   * </code>
   *
   * @static
   * @param string $sql SQL statement to be prepared an executed.
   * @param array $params SQL statement arguments.
   * @param string $class Optional class name to fetch the results.
   * @return array|object|null Specified record fields.
   */
  public static function getRow($sql, $params = array(), $class = '')
  {
    return self::$pdo->getRow($sql, $params, $class);
  }

  /**
   * Retrieve the results of an SQL statement.
   *
   * <code>
   *   // Get all notes from database
   *   Database::results('SELECT * FROM notes');
   *
   *   // Get all notes with priority = 1 (using value)
   *   Database::results
   *   (
   *     'SELECT * FROM notes WHERE priority = ?',
   *     array(1)
   *   );
   *
   *   // Get all notes with priority = 1 (using binded param)
   *   Database::results
   *   (
   *     'SELECT * FROM notes WHERE priority = :priority',
   *     array('priority' => 1)
   *   );
   * </code>
   *
   * @param string $sql SQL statement to be prepared an executed.
   * @param array $params SQL statement arguments.
   * @param string $class Optional class name to fetch the results.
   * @return array Specified records fields.
   */
  public static function getResults($sql, $params = array(), $class = '')
  {
    return self::$pdo->getResults($sql, $params, $class);
  }

  /**
   * Get the affected last SQL statement affedted rows.
   *
   * @static
   * @return int Affected rows by the last SQL statement.
   */
  public static function getRowCount()
  {
    return self::$pdo->getRowCount();
  }

  /**
   * Get the currently used database fetch mode.
   *
   * @static
   * @return int Fetch mode currently used.
   */
  public static function getFetchMode()
  {
    return self::$pdo->getFetchMode();
  }

  /**
   * Set the specified database fecth mode.
   *
   * @static
   * @param int $fetchMode Database fetch mode.
   */
  public static function setFetchMode($fetchMode)
  {
    self::$pdo->setFetchMode($fetchMode);
  }

  /**
   * Retrieve the currently used database fetch class.
   *
   * @static
   * @return string Fetch class name
   */
  public static function getFetchClass()
  {
    return self::$pdo->getFetchClass();
  }

  /**
   * Set the fetch class which you want to use.
   *
   * @static
   * @param string $class Class name
   */
  public static function setFetchClass($class)
  {
    self::$pdo->setFetchClass($class);
  }

  /**
   * Retrieve the currently used database driver name.
   *
   * @static
   * @return string Database driver name.
   */
  public static function getDriverName()
  {
    return self::$pdo->getDriverName();
  }

  /**
   * Get the established database error mode.
   *
   * @static
   * @return int Database error mode.
   */
  public static function getErrorMode()
  {
    return self::$pdo->getErrorMode();
  }

  /**
   * Set the database error mode to use.
   *
   * @static
   * @param int $errorMode Error mode to be established.
   * @return boolean True on success, False on failure
   */
  public static function setErrorMode($errorMode)
  {
    return self::$pdo->setErrorMode($errorMode);
  }

  /**
   * Perform a connection with a database.
   *
   * @static
   * @param string $dsn Database connection string.
   * @param string $user Database user name.
   * @param string $pass Database user password.
   * @param array $options Database connection options.
   * @param boolean $force True to force a connection, False to not.
   * @return boolean True on success connection, False if fail.
   */
  public static function connect($dsn, $user = '',
   $pass = '', $options = array(), $force = false)
  {
    $result = false;
    if (!(self::$pdo instanceof \PDO) || $force) {
      self::$pdo = new PDOExtended($dsn, $user, $pass, $options);
      $result = self::$pdo instanceof \PDO;
    }
    return $result;
  }

  /**
   * Disconnect from the database.
   *
   * @static
   */
  public static function disconnect()
  {
    if (self::$pdo instanceof \PDO) {
      self::$pdo = null;
    }
  }

  /**
   * Find if the database connectino is established.
   *
   * @static
   * @return boolean True if is connected, False when not
   */
  public static function isConnected()
  {
    return self::$pdo instanceof \PDO;
  }

  /**
   * Retrieve the last operation error information.
   *
   * @static
   * @link http://php.net/manual/en/pdo.errorinfo.php
   * @return array Last error information.
   */
  public static function errorInfo()
  {
    return self::$pdo->errorInfo();
  }

  /**
   * Retrieve the last error operation message.
   *
   * @static
   * @link http://php.net/manual/en/pdo.errorinfo.php
   * @return string Last error message.
   */
  public static function errorMessage()
  {
    $errorInfo = self::$pdo->errorInfo();
    return isset($errorInfo[2]) ? $errorInfo[2] : null;
  }

  /**
   * Retrieve the last operation error code.
   *
   * @static
   * @link http://php.net/manual/en/pdo.errorcode.php
   * @return string Last error message.
   */
  public static function errorCode()
  {
    return self::$pdo->errorCode();
  }

  /**
   * Initiates a transaction
   *
   * @static
   * @link www.php.net/manual/en/pdo.begintransaction.php
   * @return boolean True on success or False on failure.
   */
  public static function beginTransaction()
  {
    return self::$pdo->beginTransaction();
  }

  /**
   * Checks if inside a transaction.
   *
   * @static
   * @link http://www.php.net/manual/en/pdo.intransaction.php
   * @return boolean True if a trasantion is active, False if not
   */
  public static function inTransaction()
  {
    return self::$pdo->inTransaction();
  }

  /**
   * Commits a transaction.
   *
   * @static
   * @link http://www.php.net/manual/en/pdo.commit.php
   * @return boolean True on success, False on failure
   */
  public static function commit()
  {
    return self::$pdo->commit();
  }

  /**
   * Rolls back a transaction.
   *
   * @static
   * @link http://www.php.net/manual/en/pdo.rollback.php
   * @return boolean True on success, False on failure
   */
  public static function rollBack()
  {
    return self::$pdo->rollBack();
  }

  /**
   * Quotes a string for use in a query.
   *
   * @static
   * @link http://www.php.net/manual/en/pdo.quote.php
   * @param string $string Unsafe string to be quoted.
   * @param int $paramType Hint for drivers that have alternate quoting styles.
   * @return string|boolean Safe quoted string or False if an error occur.
   */
  public static function quote($string, $paramType = \Pdo::PARAM_STR)
  {
    return self::$pdo->quote($string, $paramType);
  }

  /**
   * Retrieve the ID of the last inserted row or sequence value.
   *
   * @static
   * @link http://www.php.net/manual/en/pdo.lastinsertid.php
   * @param string $name Optional Name of the sequence object.
   * @return string Last inserted row ID.
   */
  public static function lastInsertID($name = '')
  {
    return self::$pdo->lastInsertID($name);
  }

  /**
   * Retrieve a database connection attribute.
   *
   * @static
   * @link http://www.php.net/manual/en/pdo.getattribute.php
   * @param int $attribute One of the PDO::ATTR_* constants.
   * @return mixed|null Value of the requested PDO attribute or null.
   */
  public static function getAttribute($attribute)
  {
    return self::$pdo->getAttribute($attribute);
  }

  /**
   * Set a database connection attribute.
   *
   * @static
   * @link http://www.php.net/manual/en/pdo.setattribute.php
   * @param int $attribute One of the PDO::ATTR_* constants.
   * @param mixed $value Connection attribute value.
   * @return boolean True on success, False on failure.
   */
  public static function setAttribute($attribute, $value)
  {
    return self::$pdo->setAttribute($attribute, $value);
  }

  /**
   * Execute an SQL statement and return the number of affected rows.
   *
   * @static
   * @link http://www.php.net/manual/en/pdo.exec.php
   * @param string $sql The SQL statement to prepare and execute.
   * @return int Number of affected rows or zero if not affected.
   */
  public static function exec($sql)
  {
    return self::$pdo->exec($sql);
  }

  /**
   * Prepares a statement for execution and returns a statement object.
   *
   * @static
   * @link http://www.php.net/manual/en/pdo.prepare.php
   * @param string $sql The SQL statement to prepare.
   * @param array $options Driver specific options.
   * @return PDOStatement object instance.
   */
  public static function prepare($sql, $options = array())
  {
    return self::$pdo->prepare($sql, $options);
  }

  /**
   * Closes the cursor, enabling the statement to be executed again.
   *
   * @static
   * @link https://www.php.net/manual/en/pdostatement.closecursor
   * @return boolean True on success, False on failure
   */
  public static function closeCursor()
  {
    return self::$pdo->closeCursor();
  }

  /**
   * Executes an SQL statement, returning a result set.
   *
   * @static
   * @link http://www.php.net/manual/en/pdo.query.php
   * @param string $sql The SQL statement to prepare and execute.
   * @param array $params The SQL statement arguments.
   * @param string $class Class name to fetch the results.
   * @return PDOStatement|boolean object instance or False on failure.
   */
  public function query($sql, $params = array(), $class = '')
  {
    return self::$pdo->_query($sql, $params, $class);
  }

  /**
   * Try a database connectin and notify the plugins if success.
   *
   * @static
   */
  private static function tryToConnect()
  {
    if (self::connect(\HUMM_DATABASE_DSN,
     \HUMM_DATABASE_USER, \HUMM_DATABASE_PASS)) {
       HummPlugins::execSimpleAction(PluginActions::DATABASE_CONNECTED);
    }
  }
}
