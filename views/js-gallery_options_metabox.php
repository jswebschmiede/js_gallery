<?php

/**
 * The template for the JS gallery metabox.
 *
 * @package js-gallery
 */

defined('ABSPATH') or die('Thanks for visting');



?>

<table class="form-table js-gallery-options-metabox">
	<tr>
		<td>
			<input type="checkbox" name="js-gallery-crop-images" id="js-gallery-crop-images" value="1" <?php checked(get_post_meta($post->ID, '_js_gallery_crop_images', true), 1); ?>>
			<label for="js-gallery-crop-images"><?php esc_html_e('Bilder zuschneiden', 'js-gallery'); ?></label>
			<p class="hint">
				<?php echo __(' Bilder werden auf die default Größe zugeschnitten.', 'js-gallery') ?>
			</p>
		</td>
	</tr>
</table>