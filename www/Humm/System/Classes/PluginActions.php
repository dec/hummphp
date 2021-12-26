<?php

/**
 * This file implement the PluginActions system class.
 *
 * This class is intended to define constants to be
 * used as Humm plugins actions identifiers.
 *
 * @author DecSoft Utils <info@decsoftutils.com>
 * @link https://www.decsoftutils.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2022 Humm PHP - DecSoft Utils
 */

namespace Humm\System\Classes;

/**
 * System PluginActions class implementation.
 *
 * This class is intended to define constants to be
 * used as Humm plugins actions identifiers.
 */
class PluginActions extends Unclonable
{
  /**
   * Define the plugins loaded plugin action ID.
   *
   * Executed from PluginActions::loadPlugins() (this class)
   * this action tell the plugins that all the available
   * plugins has been loaded.
   *
   * A plugin can use this action to make some needed taks
   * which are doing in an early system boot strap state,
   * before the output buffer are started.
   */
  const PLUGINS_LOADED = 2001;

  /**
   * Define the script shutdown plugin action ID.
   *
   * Executed from ErrorHandler::onShutdown() this action
   * inform the plugins when the PHP script shutdown occur,
   * after the appropiate user response are sent.
   *
   * A plugin can use this action to make some needed taks
   * which are doing in an final system boot strap state,
   * after the output buffer has been flush.
   */
  const SCRIPT_SHUTDOWN = 2002;

  /**
   * Define the check requeriments plugin action ID.
   *
   * Executed from Requeriments::pluginsCheck() this action
   * allows the plugins to check their own requriments and
   * trigger an error if the requeriments are not supplied.
   *
   * The plugins can react to this action calling one or more
   * times the PHP \trigger_error() function providing the
   * appropiate check requeriments errors information:
   *
   * Do not print anything to the buffer output: just use the
   * \trigger_error() action and let the system to inform the
   * user about the plugin check requeriments errors.
   *
   */
  const CHECK_REQUERIMENTS = 2003;

  /**
   * Define the connected database plugin action ID.
   *
   * Executed from Requeriments::pluginsCheck() this action
   * allows the plugins to check their own requriments and
   * trigger an error if the requeriments are not supplied.
   *
   * The plugins can react to this action calling one or more
   * times the PHP \trigger_error() function providing the
   * appropiate check requeriments errors information:
   *
   * Do not print anything to the buffer output: just use the
   * \trigger_error() action and let the system to inform the
   * user about the plugin check requeriments errors.
   *
   */
  const DATABASE_CONNECTED = 2004;
}
