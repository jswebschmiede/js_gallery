<?php

/**
 * Meta Boxes class.
 *
 * @package js-gallery
 */

namespace JS_Gallery\Backend;

use WP_Post;

defined('ABSPATH') or die('Thanks for visting');

/**
 * Meta Boxes class.
 */
class MetaBoxes
{
	/**
	 * Initializes the meta boxes.
	 *
	 * @return void
	 */
	public static function init(): void
	{
		add_action('add_meta_boxes', [__CLASS__, 'add_meta_boxes']);
		add_action('save_post', [__CLASS__, 'save_meta_box'], 10, 2);
	}

	/**
	 * Adds the meta boxes for the post type.
	 * @link https://developer.wordpress.org/reference/hooks/add_meta_boxes/
	 * @return void
	 */
	public static function add_meta_boxes(): void
	{
		/**
		 * Add the meta box.
		 * @link https://developer.wordpress.org/reference/functions/add_meta_box/
		 */
		add_meta_box(
			'js_gallery_meta_box',
			__('Galerie', 'js-gallery'),
			[__CLASS__, 'render_meta_box'],
			'js_gallery',
			'normal',
			'high'
		);
	}

	/**
	 * Renders the meta box.
	 *
	 * @param WP_Post $post The post object.
	 * @return void
	 */
	public static function render_meta_box(WP_Post $post): void
	{
		require_once plugin_dir_path(dirname(dirname(__FILE__))) . 'views/js-gallery_metabox.php';
	}

	/**
	 * Saves the meta box.
	 * @link https://developer.wordpress.org/reference/hooks/save_post/
	 * @param int $post_id The post ID.
	 * @return void
	 */
	public static function save_meta_box(int $post_id): void
	{
		/**
		 * Verify the post action.
		 */
		if (array_key_exists('action', $_POST) && $_POST['action'] === 'editpost') {

			/**
			 * Verify the nonce.
			 * @link https://developer.wordpress.org/reference/functions/wp_verify_nonce/
			 */
			if (!array_key_exists('js_gallery_nonce', $_POST) || !wp_verify_nonce($_POST['js_gallery_nonce'], 'js_gallery_nonce')) {
				return;
			}

			/**
			 * Prevent the data from being autosaved.
			 */
			if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
				return;
			}

			/**
			 * Verify the post type.
			 */
			if (!array_key_exists('post_type', $_POST) || $_POST['post_type'] !== 'js_gallery') {
				return;
			}

			/**
			 * Verify the user's permissions.
			 * @link https://developer.wordpress.org/reference/functions/current_user_can/
			 */
			if (!current_user_can('edit_post', $post_id) || !current_user_can('edit_page', $post_id)) {
				return;
			}

			/**
			 * Get the old values.
			 * @link https://developer.wordpress.org/reference/functions/get_post_meta/
			 */
			$old_ids = get_post_meta($post_id, '_js_gallery_gal_ids', true);

			/**
			 * Sanitize the data and save it to the database.
			 * @link https://developer.wordpress.org/reference/functions/update_post_meta/
			 */
			if (array_key_exists('js-gallery_gallery_id', $_POST)) {
				$new_ids = [];

				foreach ($_POST['js-gallery_gallery_id'] as $key => $value) {
					$new_ids[$key] = absint($value);
				}

				update_post_meta(
					$post_id,
					'_js_gallery_gal_ids',
					$new_ids,
					$old_ids
				);
			} else {
				delete_post_meta($post_id, '_js_gallery_gal_ids', $old_ids);
			}
		}
	}
}
