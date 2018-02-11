<?php

/**
 * This file implement the DirNames system class.
 *
 * Humm PHP use this class to define not localizables,
 * case sensitive directory names of Humm PHP.
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link https://www.davidesperalta.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2018 Humm PHP - David Esperalta
 */

namespace Humm\System\Classes;

/**
 * System DirNames class implementation.
 *
 * Define certain not localizables, case sensitive
 * sytem and user sites directory names.
 */
class DirNames extends Unclonable
{
  /**
   * Define the root directory name.
   */
  const HUMM = 'Humm';

  /**
   * Define the sites directory name.
   */
  const SITES = 'Sites';

  /**
   * Define the shared directory name.
   */
  const SHARED = 'Shared';

  /**
   * Define the Humm PHP main site directory name.
   */
  const MAIN_SITE = 'Main';

  /**
   * Define the system directory name.
   */
  const SYSTEM = 'System';

  /**
   * Define the system classes name.
   */
  const CLASSES = 'Classes';

  /**
   * Define the config directory name.
   */
  const CONFIG = 'Config';

  /**
   * Define the locale directory name.
   */
  const LOCALE = 'Locale';

  /**
   * Define the plugins directory name.
   */
  const PLUGINS = 'Plugins';

  /**
   * Define the version directory name.
   */
  const VERSION = 'Version';

  /**
   * Define the procedural directory name.
   */
  const PROCEDURAL = 'Procedural';

  /**
   * Define the views directory name.
   */
  const VIEWS = 'Views';

  /**
   * Define the helpers name.
   */
  const FILES = 'Files';

  /**
   * Define the helpers name.
   */
  const HELPERS = 'Helpers';

  /**
   * Define the styles directory name.
   */
  const STYLES = 'Styles';

  /**
   * Define the scripts directory name.
   */
  const SCRIPTS = 'Scripts';

  /**
   * Define the images directory name.
   */
  const IMAGES = 'Images';
}
