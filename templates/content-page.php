<?php
/**
 * Page content template
 *
 * @package NexaWP
 */

defined( 'ABSPATH' ) || exit;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'nexawp-page' ); ?>>
	<header class="nexawp-entry-header">
		<h1 class="nexawp-entry-title"><?php the_title(); ?></h1>
	</header>

	<div class="nexawp-entry-content">
		<?php the_content(); ?>
	</div>
</article>
