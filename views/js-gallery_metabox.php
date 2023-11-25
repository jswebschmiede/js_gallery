<?php

/**
 * The template for the JS gallery metabox.
 *
 * @package js-gallery
 */

$link_text = get_post_meta($post->ID, '_js_gallery_link_text', true);
$link_url = get_post_meta($post->ID, '_js_gallery_link_url', true);

?>

<table class="form-table js-gallery-metabox">
	<tr>
		<th>
			<label for="js_gallery_link_text">Link Text</label>
		</th>
		<td>
			<input type="text" name="js_gallery_link_text" id="js_gallery_link_text" class="regular-text link-text" value="<?php echo (isset($link_text)) ? esc_html($link_text) : ''; ?>" required>
		</td>
	</tr>
	<tr>
		<th>
			<label for="js_gallery_link_url">Link URL</label>
		</th>
		<td>
			<input type="url" name="js_gallery_link_url" id="js_gallery_link_url" class="regular-text link-url" value="<?php echo (isset($link_url)) ? esc_url($link_url) : ''; ?>" required>
		</td>
	</tr>
	<input type="hidden" name="js_gallery_nonce" value="<?php echo wp_create_nonce('js_gallery_nonce'); ?>">
</table>