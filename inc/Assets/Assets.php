<?php

/**
 * plugin assets class.
 *
 * @package js-gallery
 */

namespace JS_Gallery\Assets;

defined('ABSPATH') or die('Thanks for visting');

class Assets
{
	public static function init()
	{
		add_action('wp_enqueue_scripts', [__CLASS__, 'enqueue_scripts']);
	}

	public static function enqueue_scripts()
	{
	}
}
