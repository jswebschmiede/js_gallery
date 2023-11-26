<?php

/**
 * The template for the JS Gallery shortcode.
 *
 * @package js-gallery
 */


// WP_Query arguments
$args = [
	'post_type' => 'js_gallery',
	'post_status' => 'publish',
	'post__in' => $id,
	'posts_per_page' => -1,
];

// The Query
$query = new WP_Query($args);
?>

<div class="js-gallery">
	<?php while ($query->have_posts()) : ?>
		<?php $query->the_post(); ?>

		<?php foreach (get_post_meta(get_the_ID(), '_js_gallery_gal_ids', true) as $idx => $gal_id) : ?>
			<figure class="js-gallery__image">
				<img class="" src="<?php echo wp_get_attachment_image_src($gal_id, 'large')[0]; ?>" alt="<?php echo (get_post_meta($gal_id, '_wp_attachment_image_alt', true) !== "") ? get_post_meta($gal_id, '_wp_attachment_image_alt', true) : get_the_title($gal_id); ?>" loading="lazy">
			</figure>
		<?php endforeach; ?>

	<?php endwhile; ?>

	<?php wp_reset_postdata(); ?>
</div>