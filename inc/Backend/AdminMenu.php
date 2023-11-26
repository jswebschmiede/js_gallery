<?php

/**
 * Admin Menu class.
 *
 * @package js-gallery
 */

namespace JS_Gallery\Backend;

defined('ABSPATH') or die('Thanks for visting');

/**
 * Admin Menu class.
 */
class AdminMenu
{
	public static function init(): void
	{
		add_action('admin_menu', [__CLASS__, 'add_admin_menu']);
		add_filter('manage_js_gallery_posts_columns', [__CLASS__, 'add_columns']);
		add_filter('manage_edit-js_gallery_sortable_columns', [__CLASS__, 'sortable_columns']);
		add_action('manage_js_gallery_posts_custom_column', [__CLASS__, 'render_columns'], 10, 2);
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

	/**
	 * Adds the columns to the post type.
	 * @link https://developer.wordpress.org/reference/hooks/manage_post_type_posts_columns/
	 * @param array $columns The columns.
	 * @return array The new added columns.
	 */
	public static function add_columns(array $columns): array
	{
		$columns = [
			'cb' => $columns['cb'],
			'title' => esc_html__('Title'),
			'js_gallery_images' => esc_html__('Bilder', 'js-gallery'),
			'js_gallery_shortcode' => esc_html__('Shortcode', 'js-gallery'),
			'date' => esc_html__('Date')
		];

		return $columns;
	}

	/**
	 * Makes the columns sortable.
	 * @link https://developer.wordpress.org/reference/hooks/manage_this-screen-id_sortable_columns/
	 * @param array $columns The columns.
	 * @return array The sortable columns.
	 */
	public static function sortable_columns(array $columns): array
	{
		return $columns;
	}

	/**
	 * Renders the columns for the post type.
	 * @link https://developer.wordpress.org/reference/hooks/manage_posts_custom_column/
	 * @param string $column The column.
	 * @param int $post_id The post ID.
	 * @return void
	 */
	public static function render_columns(string $column, int $post_id): void
	{
		switch ($column) {
			case 'js_gallery_shortcode':
				echo '<code>[js_gallery id="' . $post_id . '"]</code>';
				break;
			case 'js_gallery_images':
				foreach (get_post_meta($post_id, '_js_gallery_gal_ids', true) as $image) {
					echo '<img width="50" height="50" style="margin-right:5px;" src="' . wp_get_attachment_image_src($image)[0] . '" alt="' . get_post_meta($image, '_wp_attachment_image_alt', true) . '" loading="lazy">';
				}
				break;
			default:
				break;
		}
	}
}
