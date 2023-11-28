<?php

/**
 * The template for the JS Gallery shortcode.
 *
 * @package js-gallery
 */

defined('ABSPATH') or die('Thanks for visting');

use JS_Gallery\Backend\Settings;

// WP_Query arguments
$args = [
	'post_type' => 'js_gallery',
	'post_status' => 'publish',
	'post__in' => $id,
	'posts_per_page' => -1,
	'meta_query' => [
		[
			'key' => '_js_gallery_gal_ids',
			'compare' => 'EXISTS',
		],
	],
];

// The Query
$query = new WP_Query($args);

$js_gallery_primary_color = Settings::$options['js_gallery_primary_color'];
?>


<style>
	:root {
		--js-gallery-primary-color: <?php echo $js_gallery_primary_color; ?>;
	}
</style>

<div class="js-gallery grid grid-cols-12 gap-4">
	<?php while ($query->have_posts()) : ?>
		<?php $query->the_post(); ?>
		<?php $gal_ids = get_post_meta(get_the_ID(), '_js_gallery_gal_ids', true); ?>

		<div class="js-gallery__left col-span-9">
			<?php if (isset($gal_ids[0])) : ?>
				<figure class="js-gallery__image-wrap m-0 p-0 h-full relative overflow-hidden rounded-2xl">
					<img class="js-gallery__image w-full h-full object-cover m-0 p-0" src="<?php echo wp_get_attachment_image_src($gal_ids[0], (boolval(get_post_meta(get_the_ID(), '_js_gallery_crop_images', true))) ? 'js-gallery-large' : 'full')[0]; ?>" alt="<?php echo esc_attr((get_post_meta($gal_ids[0], '_wp_attachment_image_alt', true) !== "") ? get_post_meta($gal_ids[0], '_wp_attachment_image_alt', true) : get_the_title($gal_ids[0])); ?>" loading="lazy">
					<div class="js-gallery__overlay">
						<span class="js-gallery__overlay--text text-xl max-w-sm">
							<?php echo nl2br(esc_textarea(get_post_field('post_content', $gal_ids[0]))); ?>
						</span>

						<a class="js-gallery__openlightbox js-gallery__link absolute top-8 right-8 p-4 rounded-2xl" data-gall="js-gallery-<?php echo get_the_ID(); ?>" href="<?php echo wp_get_attachment_image_src($gal_ids[0], 'js-gallery-large')[0]; ?>">
							<svg class="js-gallery__openlightbox--icon w-9 h-9 text-white" width="24" height="24" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
								<path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3" />
								<path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2M14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1M2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10" />
							</svg>
						</a>
					</div>
				</figure>
			<?php endif; ?>
		</div>

		<div class="js-gallery__right col-span-3 grid gap-4">
			<?php for ($idx = 1; $idx <= count($gal_ids); $idx++) : ?>
				<?php if (isset($gal_ids[$idx])) : ?>
					<figure class="js-gallery__image-wrap relative overflow-hidden rounded-2xl m-0 p-0" <?php if ($idx > 3) : ?>style="display: none;" <?php endif ?>>
						<a class="js-gallery__link" data-gall="js-gallery-<?php echo get_the_ID(); ?>" href="<?php echo wp_get_attachment_image_src($gal_ids[$idx], 'js-gallery-large')[0]; ?>">
							<img class="js-gallery__image w-full h-full object-cover m-0 p-0" src="<?php echo wp_get_attachment_image_src($gal_ids[$idx], (boolval(get_post_meta(get_the_ID(), '_js_gallery_crop_images', true))) ? 'js-gallery-large' : 'full')[0]; ?>" alt="<?php echo esc_attr((get_post_meta($gal_ids[$idx], '_wp_attachment_image_alt', true) !== "") ? get_post_meta($gal_ids[$idx], '_wp_attachment_image_alt', true) : get_the_title($gal_ids[$idx])); ?>" loading="lazy">
						</a>
					</figure>
				<?php endif; ?>
			<?php endfor; ?>
		</div>
	<?php endwhile; ?>

	<?php wp_reset_postdata(); ?>
</div>