<?php

/**
 * plugin assets class.
 *
 * @package js-gallery
 */

namespace JS_Gallery\Assets;

defined('ABSPATH') or die('Thanks for visting');

/**
 * plugin assets class.
 */
class Assets
{
	/**
	 * Initializes the plugin assets.
	 *
	 * @return void
	 */
	public static function init()
	{
		add_action('wp_enqueue_scripts', [__CLASS__, 'enqueue_scripts']);
		add_action('admin_enqueue_scripts', [__CLASS__, 'enqueue_metabox_scripts']);
	}

	/**
	 * Enqueues the plugin assets.
	 *
	 * @return void
	 */
	public static function enqueue_scripts()
	{
	}

	/**
	 * Enqueues the plugin assets for the metabox.
	 *
	 * @return void
	 */
	public static function enqueue_metabox_scripts(): void
	{
		global $typenow;

		if ($typenow == 'js_gallery') {
			wp_enqueue_script('js-gallery-admin', plugin_dir_url(dirname(dirname(__FILE__))) . 'assets/js/gallery-metabox.js', array('jquery'), JS_GALLERY_VERSION, true);
			wp_enqueue_style('js-gallery-admin', plugin_dir_url(dirname(dirname(__FILE__))) . 'assets/css/gallery-metabox.css', array(), JS_GALLERY_VERSION, 'all');
		}
	}
}
