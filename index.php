<?php
/**
 * Main index template
 *
 * @package NexaWP
 */

defined( 'ABSPATH' ) || exit;

get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		get_template_part( 'templates/content', get_post_type() );
	endwhile;

	the_posts_navigation();
else :
	get_template_part( 'templates/content', 'none' );
endif;

get_footer();
