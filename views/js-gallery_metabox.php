<?php

/**
 * The template for the JS gallery metabox.
 *
 * @package js-gallery
 */

defined('ABSPATH') or die('Thanks for visting');

$ids = get_post_meta($post->ID, '_js_gallery_gal_ids', true);

wp_enqueue_media();
?>

<table class="form-table js-gallery-metabox">
	<tr>
		<td>
			<a class="gallery-add button" href="#" data-uploader-title="<?php esc_html_e('Change image', 'js-gallery'); ?>" data-uploader-remove-text="<?php esc_html_e('Remove image', 'js-gallery'); ?>" data-uploader-title=" <?php esc_html_e('Add images to gallery', 'js-galler'); ?>" data-uploader-button-text="<?php esc_html_e('Add images', 'js-galler'); ?>"><?php esc_html_e('Add images', 'js-gallery'); ?></a>
			<ul id="gallery-metabox-list">
				<?php if ($ids) : foreach ($ids as $key => $value) : $image = wp_get_attachment_image_src($value); ?>
						<li>
							<input type="hidden" name="js-gallery_gallery_id[<?php echo $key; ?>]" value="<?php echo $value; ?>">
							<img class="image-preview" src="<?php echo esc_url($image[0]); ?>">

							<a class="change-image button button-small" href="#" data-uploader-title="<?php esc_html_e('Change image', 'js-gallery'); ?>" data-uploader-remove-text="<?php esc_html_e('Remove image', 'js-gallery'); ?>" data-uploader-button-text="<?php esc_html_e('Change image', 'js-gallery'); ?>">
								<?php esc_html_e('Change image', 'js-gallery'); ?>
							</a><br>

							<small><a class="remove-image delete" href="#"><?php esc_html_e('Remove image', 'js-gallery'); ?></a></small>
						</li>
				<?php endforeach;
				endif; ?>
			</ul>
		</td>
	</tr>
	<input type="hidden" name="js_gallery_nonce" value="<?php echo wp_create_nonce('js_gallery_nonce'); ?>">
</table>