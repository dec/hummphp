<?php

/**
 * This file implement the Humm plugin Sample.
 *
 * @author D. Esperalta <info@decsoftutils.com>
 * @link https://www.decsoftutils.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2019 Humm PHP - David Esperalta
 */

namespace Humm\Plugins\Sample;

use
  \Humm\System\Classes\HummPlugin,
  \Humm\System\Classes\PluginFilters,
  \Humm\System\Classes\PluginActions,
  \Humm\System\Classes\FilterArguments,
  \Humm\System\Classes\ActionArguments;

class Sample extends HummPlugin
{
  public function execAction(ActionArguments $arguments)
  {
    switch ($arguments->action) {
      case PluginActions::PLUGINS_LOADED:
        break;
      case PluginActions::CHECK_REQUERIMENTS:
        break;
      case PluginActions::DATABASE_CONNECTED:
        break;
      case PluginActions::SCRIPT_SHUTDOWN:
        break;
    }
  }

  public function applyFilter(FilterArguments $arguments)
  {
    switch ($arguments->filter) {
      case PluginFilters::DATABASE_SQL:
        break;
      case PluginFilters::VIEW_TEMPLATE:
        break;
      case PluginFilters::BUFFER_OUTPUT:
        break;
    }
    // Filtered or not
    return $arguments->content;
  }
}
