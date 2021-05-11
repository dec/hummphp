<?php

/**
 * This file implement the PDOExtended system class.
 *
 * Humm PHP use this class internally from the Database
 * class in order to work with databases. Site classes,
 * views and plugins must use the Database instead this.
 *
 * @author D. Esperalta <info@decsoftutils.com>
 * @link https://www.decsoftutils.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2021 Humm PHP - David Esperalta
 */

namespace Humm\System\Classes;

/**
 * System PDOExtended class implementation.
 *
 * This class are used internally by the Database class,
 * which is the recommended way to work with databases
 * from site classes, views and plugins.
 *
 */
class PDOExtended extends \PDO
{
  /**
   * Define the default PHP class to fetch results.
   */
  const DEFAULT_FETCH_CLASS = '\StdClass';

  /**
   * Last executed SQL statement.
   *
   * @var PDOStatement
   */
  protected $statement = null;

  /**
   * Fetch mode currently established.
   *
   * @var int
   */
  protected $fetchMode = parent::FETCH_CLASS;

  /**
   * Fetch class currently established.
   *
   * @var string
   */
  protected $fetchClass = self::DEFAULT_FETCH_CLASS;

  /**
   * Construct a PDOExtended object.
   *
   * @param string $dsn Database connection string.
   * @param string $user Database user name.
   * @param string $pass Database user password.
   * @param array $options Database connection options.
   */
  public function __construct($dsn, $user = '', $pass = '', $options = null)
  {
    parent::__construct($dsn, $user, $pass, $options);
    parent::setAttribute(parent::ATTR_ERRMODE, parent::ERRMODE_EXCEPTION);
  }

  /**
   * Get an specific record field value.
   *
   * <code>
   *   // Get the text of a note with id = 1 (using value)
   *   Database::getValue
   *   (
   *     'SELECT text FROM notes WHERE id = ?',
   *     array(1)
   *   );
   *
   *   // Get the text of a note with id = 1 (using binded param)
   *   Database::getValue
   *   (
   *     'SELECT text FROM notes WHERE id = :id',
   *     array('id' => 1)
   *   );
   * </code>
   *
   * @param string $sql SQL statement to be prepared and executed.
   * @param array $params SQL statement arguments.
   * @return string Value of the specified record field.
   */
  public function getValue($sql, $params = array())
  {
    $result = null;
    if ($this->_query($sql, $params)) {
      $fetch = $this->statement->fetch(parent::FETCH_NUM);
      if (isset($fetch[0])) {
        $result = $fetch[0];
      }
    }
    return $result;
  }

  /**
   * Get record fields as key and value pairs.
   *
   * <code>
   *   // Get date (as key) and text (as value) note with id = 1
   *   Database::getPair
   *   (
   *     'SELECT date, text FROM notes WHERE id = ?', array(1)
   *   );
   *
   *   // Get date (as key) and text (as value) note with id = 1
   *   Database::getPair
   *   (
   *     'SELECT date, text FROM notes WHERE id = :id', array('id' => 1)
   *   );
   * </code>
   *
   * @param string $sql SQL statement to be prepared and executed.
   * @param array $params SQL statement parameters.
   * @return array Record field keys and values pairs.
   */
  public function getPair($sql, $params = array())
  {
    $result = array();
    if ($this->_query($sql, $params)) {
      $results = $this->statement->fetchAll(parent::FETCH_NUM);
      foreach ($results as $row) {
        $result[$row[0]] = $row[1];
      }
    }
    return $result;
  }

  /**
   * Get an specific record as a row.
   *
   * <code>
   *   // Get all fields of the note with id = 1 (using value)
   *   Database::getRow('SELECT * FROM notes WHERE id = ?', array(1));
   *
   *   // Get all fields of the note with id = 1 (using binded param)
   *   Database::getRow('SELECT * FROM notes WHERE id = :id', array('id' => 1));
   * </code>
   *
   * @param string $sql SQL statement to be prepared an executed.
   * @param array $params SQL statement arguments.
   * @param string $class Optional class name to fetch the results.
   * @return array Specified record fields.
   */
  public function getRow($sql, $params = array(), $class = '')
  {
    $result = null;
    if ($this->_query($sql, $params, $class)) {
      $result = $this->statement->fetch();
    }
    return $result;
  }

  /**
   * Get records field values as a column.
   *
   * <code>
   *   // Get all notes text field values
   *   Database::column('SELECT text FROM notes');
   *
   *   // Get all notes text with priority = 1 (using value)
   *   Database::getColumn
   *   (
   *     'SELECT text FROM notes WHERE priority = ?',
   *     array(1)
   *   );
   *
   *   // Get all notes with priority = 1 (using binded param)
   *   Database::getColumn
   *   (
   *     'SELECT text FROM notes WHERE priority = :priority',
   *     array('priority' => 1)
   *   );
   * </code>
   *
   * @param string $sql SQL statement to be prepared an executed.
   * @param array $params SQL statement arguments.
   * @return array Values of the specified record field.
   */
  public function getColumn($sql, $params = array())
  {
    $result = null;
    if ($this->_query($sql, $params)) {
      $result = $this->statement->fetchAll(parent::FETCH_COLUMN);
    }
    return $result;
  }

  /**
   * Retrieve the results of an SQL statement.
   *
   * <code>
   *   // Get all notes from database
   *   Database::getResults('SELECT * FROM notes');
   *
   *   // Get all notes with priority = 1 (using value)
   *   Database::getResults
   *   (
   *     'SELECT * FROM notes WHERE priority = ?',
   *     array(1)
   *   );
   *
   *   // Get all notes with priority = 1 (using binded param)
   *   Database::getResults
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
  public function getResults($sql, $params = array(), $class = '')
  {
    $result = null;
    if ($this->_query($sql, $params, $class)) {
      $result = $this->statement->fetchAll();
    }
    return $result;
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
   * @param string $table Database table name.
   * @param array $keyValues Associated array with field keys/values.
   * @return boolean True if the record exists, False if not.
   */
  public function exists($table, $keyValues)
  {
    $params = array();
    $preKeys = StrUtils::EMPTY_STRING;

    foreach ($keyValues as $field => $value) {
      $preKeys .= ' AND ('.$field.') = ? ';
      $params[] = $value;
    }

    $result = $this->getValue
    (
      \sprintf('SELECT 1 as c FROM %s WHERE (1 = 1) %s', $table, $preKeys),
      $params
    );

    return $result != null;
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
   * @param string $table Database table name.
   * @param array $keyValues Associated array with field keys/values.
   * @return boolean True on succes, False on failure.
   */
  public function insert($table, $keyValues)
  {
    $params = array();
    $preValues = StrUtils::EMPTY_STRING;
    $preFields = StrUtils::EMPTY_STRING;

    foreach ($keyValues as $field => $value) {
      $preValues .= '?,';
      $preFields .= $field.',';
      $params[] = $value;
    }

    $sqlValues = \trim($preValues, ',');
    $sqlFields = \trim($preFields, ',');

    $result = $this->_query
    (
      'INSERT INTO '.$table.' ('.$sqlFields.') VALUES ('.$sqlValues.')',
      $params
    );

    return $result instanceof \PDOStatement;
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
   * @param string $table Database table name.
   * @param array $keyFields Associated array with field keys.
   * @param array $fieldValues Associated array with field values.
   * @return boolean True on succes, False on failure.
   */
  public function update($table, $keyFields, $fieldValues)
  {
    $result = false;
    if ($this->exists($table, $keyFields)) {
      $params = array();
      $preKeys = StrUtils::EMPTY_STRING;
      $preValues = StrUtils::EMPTY_STRING;
      foreach ($fieldValues as $field => $value) {
        $preValues .= ' '.$field.' = ?,';
        $params[] = $value;
      }
      foreach ($keyFields as $field => $value) {
        $preKeys .= ' AND ('.$field.' = ?)';
        $params[] = $value;
      }
     $sqlKeys = $preKeys;
     $sqlValues = \trim($preValues, ',');

     $results = $this->_query
     (
       \sprintf('UPDATE %s SET %s WHERE (1 = 1) %s',
        $table, $sqlValues, $sqlKeys),
       $params
     );
     $result = $results instanceof \PDOStatement;
    }
    return $result;
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
   * @param string $table Database table name.
   * @param array $keyValues Associated array with field keys/values.
   * @return boolean True on succes, False on failure.
   */
  public function delete($table, $keyValues)
  {
    $params = array();
    $sqlKeys = StrUtils::EMPTY_STRING;

    foreach ($keyValues as $field => $value) {
      $sqlKeys .= ' AND ('.$field.' = ?)';
      $params[] = $value;
    }

    $result = $this->_query
    (
      \sprintf('DELETE FROM %s WHERE (1 = 1) %s', $table, $sqlKeys),
      $params
    );

    return $result instanceof \PDOStatement;
  }

  /**
   * Get the affected last SQL statement affedted rows.
   *
   * @return int Affected rows by the last SQL statement.
   */
  public function getRowCount()
  {
    return $this->statement->getRowCount();
  }

  /**
   * Get the currently used database fetch mode.
   *
   * @return int Fetch mode currently used.
   */
  public function getFetchMode()
  {
    return $this->fetchMode;
  }

  /**
   * Set the specified database fecth mode.
   *
   * @param int $fetchMode Database fetch mode.
   */
  public function setFetchMode($fetchMode)
  {
    if ($this->fetchMode != $fetchMode) {
      $this->fetchMode = $fetchMode;
    }
  }

  /**
   * Retrieve the currently used database fetch class.
   *
   * @return string Fetch class name
   */
  public function getFetchClass()
  {
    return $this->fetchClass;
  }

  /**
   * Set the fetch class which you want to use.
   *
   * @param string $class Class name
   */
  public function setFetchClass($class)
  {
    if ($this->fetchClass != $class) {
      $this->fetchClass = $class;
      $this->fetchMode = parent::FETCH_CLASS;
    }
  }

  /**
   * Retrieve the currently used database driver name.
   *
   * @return string Database driver name.
   */
  public function getDriverName()
  {
    return $this->getAttribute(parent::ATTR_DRIVER_NAME);
  }

  /**
   * Get the established database error mode.
   *
   * @return int Database error mode.
   */
  public function getErrorMode()
  {
    return $this->getAttribute(parent::ATTR_ERRMODE);
  }

  /**
   * Set the database error mode to use.
   *
   * @param int $errorMode Error mode to be established.
   * @return boolean True on success, False on failure
   */
  public function setErrorMode($errorMode)
  {
    return $this->setAttribute(parent::ATTR_ERRMODE, $errorMode);
  }

  /**
   * Execute an SQL statement and return the number of affected rows.
   *
   * @link http://www.php.net/manual/en/pdo.exec.php
   * @param string $sql The SQL statement to prepare and execute.
   * @return int Number of affected rows or zero if not affected.
   */
  public function exec($sql)
  {
    return parent::exec($this->translateSQL($sql));
  }

  /**
   * Prepares a statement for execution and returns a statement object.
   *
   * @link http://www.php.net/manual/en/pdo.prepare.php
   * @param string $sql The SQL statement to prepare.
   * @param array $options Driver specific options.
   * @return \PDOStatement object instance.
   */
  public function prepare($sql, $options = array())
  {
    return parent::prepare($this->translateSQL($sql), $options);
  }

  /**
   * Executes an SQL statement, returning a result set.
   *
   * @link http://www.php.net/manual/en/pdo.query.php
   * @param string $sql The SQL statement to prepare and execute.
   * @param array $params The SQL statement arguments.
   * @param string $class Class name to fetch the results.
   * @return \PDOStatement|boolean object instance or False on failure.
   */
  public function _query($sql, $params = array(), $class = '')
  {
    $result = false;
    if ($this->statement instanceof \PDOStatement) {
      $this->statement->closeCursor();
    }
    $this->statement = $this->prepare
    (
      $this->translateSQL($sql, $params),
      array(self::ATTR_EMULATE_PREPARES => true)
    );
    if ($this->statement instanceof \PDOStatement) {
      if (!StrUtils::isTrimEmpty($class)) {
        $this->fetchClass = $class;
        $this->fetchMode = parent::FETCH_CLASS;
      }
      if ($this->fetchMode == parent::FETCH_CLASS) {
        $this->statement->setFetchMode(parent::FETCH_CLASS, $this->fetchClass);
      } else {
        $this->statement->setFetchMode($this->fetchMode);
      }
      if ($this->statement->execute($params)) {
        // Back to the default class
        $this->fetchClass = self::DEFAULT_FETCH_CLASS;
        $result = $this->statement;
      }
    }
    return $result;
  }

  /**
   * Translate an SQL statement for an specific driver.
   *
   * Since Humm use PHP PDO and therefore support various
   * database drivers, this method is intended to offer a
   * way to the user (using a plugin) in order to translate
   * SQL queries into specific database drivers queries.
   *
   * @param string $sql The SQL statement to prepare and execute.
   * @param array $params The SQL statement arguments.
   * @return string Untouched or translated SQL statement
   */
  private function translateSQL($sql, $params = array())
  {
    return HummPlugins::applyFilter(new FilterArguments(array
    (
      FilterArguments::CONTENT => $sql,
      FilterArguments::BUNDLE => $params,
      FilterArguments::FILTER => PluginFilters::DATABASE_SQL
    )));
  }
}
