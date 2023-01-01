<?php

/**
 * This file implement the PluginFilters system class.
 *
 * This class is intended to define constants to be
 * used as Humm plugins filters identifiers.
 *
 * @author DecSoft Utils <info@decsoftutils.com>
 * @link https://www.decsoftutils.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C) Humm PHP - DecSoft Utils
 */

namespace Humm\System\Classes;

/**
 * System PluginFilters class implementation.
 *
 * This class is intended to define constants to be
 * used as Humm plugins filters identifiers.
 */
class PluginFilters extends Unclonable
{
  /**
   * Define the output buffer plugin filter ID.
   *
   * This filter is executed from OutputBuffer::filter()
   * and provide as the filter content with the response
   * buffer to be filtered before sent to the user.
   *
   * A plugin cannot print anything under this filter
   * execution, but can filter the content or do other
   * taks but never print anything.
   *
   * Like in any other filter, the plugin must return
   * theh filter arguments content, filtered or not, in
   * order to maintain the chain.
   */
  const BUFFER_OUTPUT = 1001;

  /**
   * Define the view template plugin filter ID.
   *
   * Executed from ViewsHandler::filterTemplate() this
   * filter provide as the filter content with an HtmlTemplate
   * object instance which can be filtered.
   *
   * This means that the plugin can update or setup
   * new HtmlTemplate variables to put it availables into
   * the HtmlTemplate associated view.
   *
   * Like in any other filter, the plugin must return
   * theh filter arguments content, filtered or not, in
   * order to maintain the chain.
   */
  const VIEW_TEMPLATE = 1002;

  /**
   * Define the database SQL plugin filter ID.
   *
   * Executed from PDOExtended::translateSQL() this filter
   * is provided to translate executed SQL statements just
   * before are executed against the database.
   *
   * This means that the plugin can filter the SQL statement
   * in some way, although this filter is mainly intended to
   * provide a way to translate SQL statements into specific
   * database drivers statements.
   *
   * Like in any other filter, the plugin must return
   * the filter arguments content, filtered or not, in
   * order to maintain the chain.
   */
  const DATABASE_SQL = 1003;
}
