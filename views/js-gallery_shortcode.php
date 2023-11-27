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
		<?php $gal_ids = get_post_meta(get_the_ID(), '_js_gallery_gal_ids', true); ?>

		<div class="js-gallery__left">
			<?php if (isset($gal_ids[0])) : ?>
				<figure class="js-gallery__image-wrap">
					<img class="js-gallery__image" src="<?php echo wp_get_attachment_image_src($gal_ids[0], (boolval(get_post_meta(get_the_ID(), '_js_gallery_crop_images', true))) ? 'js-gallery-large' : 'full')[0]; ?>" alt="<?php echo esc_attr((get_post_meta($gal_ids[0], '_wp_attachment_image_alt', true) !== "") ? get_post_meta($gal_ids[0], '_wp_attachment_image_alt', true) : get_the_title($gal_ids[0])); ?>" loading="lazy">
					<div class="js-gallery__overlay">
						<span class="js-gallery__overlay--text">
							<?php echo nl2br(esc_textarea(get_post_field('post_content', $gal_ids[0]))); ?>
						</span>

						<a class="js-gallery__openlightbox js-gallery__link" data-gall="js-gallery-<?php echo get_the_ID(); ?>" href="<?php echo wp_get_attachment_image_src($gal_ids[0], 'js-gallery-large')[0]; ?>">
							<svg class="js-gallery__openlightbox--icon" width="24" height="24" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
								<path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3" />
								<path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2M14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1M2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10" />
							</svg>
						</a>
					</div>
				</figure>
			<?php endif; ?>
		</div>

		<div class="js-gallery__right">
			<?php for ($idx = 1; $idx <= count($gal_ids); $idx++) : ?>
				<?php if (isset($gal_ids[$idx])) : ?>
					<figure class="js-gallery__image-wrap" <?php if ($idx > 3) : ?>style="display: none;" <?php endif ?>>
						<a class="js-gallery__link" data-gall="js-gallery-<?php echo get_the_ID(); ?>" href="<?php echo wp_get_attachment_image_src($gal_ids[$idx], 'js-gallery-large')[0]; ?>">
							<img class="js-gallery__image" src="<?php echo wp_get_attachment_image_src($gal_ids[$idx], (boolval(get_post_meta(get_the_ID(), '_js_gallery_crop_images', true))) ? 'js-gallery-large' : 'full')[0]; ?>" alt="<?php echo esc_attr((get_post_meta($gal_ids[$idx], '_wp_attachment_image_alt', true) !== "") ? get_post_meta($gal_ids[$idx], '_wp_attachment_image_alt', true) : get_the_title($gal_ids[$idx])); ?>" loading="lazy">
						</a>
					</figure>
				<?php endif; ?>
			<?php endfor; ?>
		</div>
	<?php endwhile; ?>

	<?php wp_reset_postdata(); ?>
</div>