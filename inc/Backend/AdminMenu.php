<?php

/**
 * Main plugin class.
 *
 * @package js-gallery
 */

namespace JS_Gallery\Backend;

defined('ABSPATH') or die('Thanks for visting');

class AdminMenu
{
	public static function init(): void
	{
		add_action('admin_menu', [__CLASS__, 'add_admin_menu']);
	}

	/**
	 * create the admin page menu for the JS Gallery plugin.
	 * @link https://developer.wordpress.org/reference/functions/add_menu_page/
	 * @return void
	 */
	public static function add_admin_menu(): void
	{
		add_menu_page(
			__('JS Gallery', 'js-gallery'),
			__('JS Gallery', 'js-gallery'),
			'manage_options',
			'js-gallery-admin',
			[__CLASS__, 'render_admin_page'],
			'dashicons-images-alt2'
		);

		add_submenu_page(
			'js-gallery-admin',
			__('Manage Gallerys', 'js-gallery'),
			__('Manage Gallerys', 'js-gallery'),
			'manage_options',
			'edit.php?post_type=js_gallery',
			null,
			null
		);

		add_submenu_page(
			'js-gallery-admin',
			__('Add New Gallery', 'js-gallery'),
			__('Add New Gallery', 'js-gallery'),
			'manage_options',
			'post-new.php?post_type=js_gallery',
			null,
			null
		);
	}

	/**
	 * Renders the admin page for the JS Gallery plugin.
	 * @return void
	 */
	public static function render_admin_page(): void
	{
		if (!current_user_can('manage_options')) {
			return;
		}

		if (isset($_GET['settings-updated'])) {
			// add settings saved message with the class of "updated"
			add_settings_error('js_gallery_options', 'js_gallery_message', __('Settings Saved', 'js-gallery'), 'success');
		}
		// show error/update messages
		settings_errors('js_gallery_options');


		require_once plugin_dir_path(dirname(dirname(__FILE__))) . 'views/js-gallery_admin-page.php';
	}
}