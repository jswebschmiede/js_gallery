<?php

/**
 * Main plugin class.
 *
 * @package js-gallery
 */

namespace JS_Gallery;

defined('ABSPATH') or die('Thanks for visting');

use JS_Gallery\Assets\Assets;
use JS_Gallery\Backend\AdminMenu;
use JS_Gallery\Backend\MetaBoxes;
use JS_Gallery\PostTypes\CP_Gallery;
use JS_Gallery\Shortcodes\Shortcode;

/**
 * Main plugin class.
 */
class Gallery
{
	/**
	 * Initializes the plugin.
	 *
	 * @return void
	 */
	public static function init(): void
	{
		self::define_constants();
		add_action('after_setup_theme', [__CLASS__, 'add_custom_image_sizes']);

		Assets::init();
		CP_Gallery::init();
		AdminMenu::init();
		MetaBoxes::init();
		Shortcode::init();
	}


	/**
	 * Defines the constants for the JS Gallery plugin.
	 * @return void
	 */
	private static function define_constants(): void
	{
		define('JS_GALLERY_VERSION', '1.0.0');
		define('JS_GALLERY_PLUGIN_PATH', plugin_dir_path(__FILE__));
		define('JS_GALLERY_PLUGIN_URL', plugin_dir_url(__FILE__));
	}

	public static function add_custom_image_sizes(): void
	{
		add_image_size('js-gallery-large', 770, 580, true);
	}

	/**
	 * Activates the plugin.
	 *
	 * @return void
	 */
	public static function activate(): void
	{
		flush_rewrite_rules();
	}

	/**
	 * Deactivates the plugin.
	 *
	 * @return void
	 */
	public static function deactivate(): void
	{
		flush_rewrite_rules();
		unregister_post_type('js_gallery');
	}

	/**
	 * Uninstalls the plugin.
	 *
	 * @return void
	 */
	public static function uninstall(): void
	{
	}
}
