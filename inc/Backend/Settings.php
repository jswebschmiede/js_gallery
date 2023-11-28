<?php

/**
 * Settings class.
 *
 * @package js-gallery
 */

namespace JS_Gallery\Backend;

defined('ABSPATH') or die('Thanks for visting');

/**
 * Settings class.
 */
class Settings
{
	public static bool|array $options;

	/**
	 * Initializes the settings.
	 *
	 * @return void
	 */
	public static function init(): void
	{
		self::$options = get_option('js_gallery_options');
		add_action('admin_init', [__CLASS__, 'register_options']);
	}

	/**
	 * Registers the settings for the JS Gallery plugin.
	 * @link https://developer.wordpress.org/reference/functions/register_setting/
	 * @link https://developer.wordpress.org/reference/functions/add_settings_section/
	 * @link https://developer.wordpress.org/reference/functions/add_settings_field/
	 * @link https://developer.wordpress.org/reference/hooks/admin_init/
	 * @return void
	 */
	public static function register_options(): void
	{
		// Register the settings.
		register_setting(
			'js_gallery_group_1',
			'js_gallery_options',
			[__CLASS__, 'sanitize_options']
		);

		// Register the settings sections.
		add_settings_section(
			'js_gallery_main_section',
			__('Gallery Colors', 'js-gallery'),
			null,
			'js_gallery_page1'
		);

		add_settings_field(
			'js_gallery_primary_color',
			__('Primary Color', 'js-gallery'),
			[__CLASS__, 'js_gallery_primary_color_cb'],
			'js_gallery_page1',
			'js_gallery_main_section',
			[
				'label_for' => 'js_gallery_primary_color',
			]
		);
	}

	/**
	 * Renders the primary color field.
	 * @param array $args The arguments for the field.
	 * @return void
	 */
	public static function js_gallery_primary_color_cb($args): void
	{
		$js_gallery_primary_color = self::$options['js_gallery_primary_color'] ?? '#000';
?>
		<input type="text" name="js_gallery_options[js_gallery_primary_color]" id="js_gallery_primary_color" value="<?php echo esc_attr($js_gallery_primary_color); ?>" class="color-picker" />
		<script>
			jQuery(document).ready(function($) {
				$('.color-picker').wpColorPicker();
			});
		</script>
<?php
	}

	/**
	 * Sanitizes the options.
	 * @param array $input The options to sanitize.
	 * @return array The sanitized options.
	 */
	public function sanitize_options($input): array
	{
		$new_input = [];

		foreach ($input as $key => $value) {
			switch ($key) {
				case 'js_gallery_primary_color':
					$new_input[$key] = sanitize_hex_color($value);
					break;
				default:
					$new_input[$key] = sanitize_text_field($value);
					break;
			}
		}
		return $new_input;
	}
}
