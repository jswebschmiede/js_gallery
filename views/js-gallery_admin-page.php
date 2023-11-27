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


	<form action="options.php" method="post">
		<?php
		echo "Gallery";

		submit_button();
		?>
	</form>
</div>