<?php

/**
 * Plugin Name: Simple Gallery
 * Plugin URI: https://joerg-schoeneburg.de
 * Description: A simple gallery plugin.
 * Version: 1.0
 * Author: Joerg Schoeneburg
 * Author URI: https://joerg-schoeneburg.de
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: js-gallery
 * Domain Path: /languages
 */


defined('ABSPATH') or die('Thanks for visting');

use JS_Gallery\Gallery;

require_once(plugin_dir_path(__FILE__) . '/vendor/autoload.php');

register_activation_hook(__FILE__, ['JS_Gallery\Gallery', 'activate']);
register_deactivation_hook(__FILE__, ['JS_Gallery\Gallery', 'deactivate']);
register_uninstall_hook(__FILE__, ['JS_Gallery\Gallery', 'uninstall']);

Gallery::init();
