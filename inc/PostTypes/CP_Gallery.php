<?php

/**
 *  plugin costum post type gallery class.
 * @package js-gallery
 */

namespace JS_Gallery\PostTypes;

defined('ABSPATH') or die('Thanks for visting');

class CP_Gallery
{
	public static function init()
	{
		add_action('init', [__CLASS__, 'create_post_type']);
	}


	/**
	 * Registers the post type.
	 * @link https://codex.wordpress.org/Function_Reference/register_post_type
	 * @return void
	 */
	public static function create_post_type(): void
	{
		register_post_type('js_gallery', [
			'label' => __('JS Gallery', 'js-gallery'),
			'description' => __('JS Gallery', 'js-gallery'),
			'labels' => [
				'name' => __('JS Gallery', 'js-gallery'),
				'singular_name' => __('JS Gallery', 'js-gallery'),
			],
			'public'            => true,
			'has_archive'       => false,
			'supports'          => ['title', 'editor', 'thumbnail'],
			'hierarchical'      => false,
			'show_ui'           => true,
			'show_in_menu'      => false,
			'show_in_admin_bar' => true,
			'menu_position'     => 20, // Below 'Pages
			'menu_icon'         => 'dashicons-images-alt2',
			'can_export'        => true,
			'show_in_rest'      => false,
		]);
	}
}