<?php

/**
 * The admin page for the JS gallery plugin.
 *
 * @package js-gallery
 */

defined('ABSPATH') or die('Thanks for visting');

?>
<div class="wrap">
	<h1><?php echo esc_html(get_admin_page_title()); ?></h1>
	<p><?php echo __('This is the admin page for the Simple Gallery plugin.', 'js-gallery'); ?></p>

	<form action="options.php" method="post">

		<?php
		settings_fields('js_gallery_group_1');
		do_settings_sections('js_gallery_page1');

		submit_button();
		?>

	</form>
</div>