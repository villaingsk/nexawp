<?php
defined( 'ABSPATH' ) || exit;

get_header();

// 🔑 Allow Site Builder to override archive
if ( has_action( 'nexawp_render_archive' ) ) {
	ob_start();
	do_action( 'nexawp_render_archive' );
	$custom_archive = trim( ob_get_clean() );

	if ( $custom_archive !== '' ) {
		echo $custom_archive;
		get_footer();
		return;
	}
}

// Default archive loop
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		get_template_part( 'templates/content', 'archive' );
	endwhile;

	the_posts_navigation();
endif;

get_footer();
