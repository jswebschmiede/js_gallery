<?php

/**
 * The shortcode class.
 *
 * @package js-gallery
 */

namespace JS_Gallery\Shortcodes;

defined('ABSPATH') or die('Thanks for visting');


/**
 * Shortcode class.
 */
class Shortcode
{
	/**
	 * Initializes the shortcode.
	 *
	 * @return void
	 */
	public static function init()
	{
		add_shortcode('js_gallery', [__CLASS__, 'render_shortcode']);
	}

	/**
	 * Renders the shortcode.
	 *
	 * @param array $atts
	 * @param string $content
	 * @param string $tag
	 * @return string|bool
	 */
	public static function render_shortcode(array $atts = [], $content = null, string $tag = ''): string | bool
	{
		$atts = array_change_key_case((array)$atts, CASE_LOWER);

		// set default attributes
		extract(shortcode_atts([
			'id' => '',
			'orderby' => 'date',
		], $atts, $tag));

		// sanitize attributes
		if (!empty($id)) {
			$id = array_map('absint', explode(',', $id));
		}

		ob_start();

		require  plugin_dir_path(dirname(dirname(__FILE__))) . 'views/js-gallery_shortcode.php';

		return ob_get_clean();
	}
}
