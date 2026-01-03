<?php
defined( 'ABSPATH' ) || exit;

get_header();

// 🔑 Allow Site Builder 404 override
if ( has_action( 'nexawp_render_404' ) ) {
	ob_start();
	do_action( 'nexawp_render_404' );
	$custom_404 = trim( ob_get_clean() );

	if ( $custom_404 !== '' ) {
		echo $custom_404;
		get_footer();
		return;
	}
}
?>

<section class="nexawp-404">
	<h1><?php esc_html_e( 'Page not found', 'nexawp' ); ?></h1>
	<p><?php esc_html_e( 'Sorry, the page you are looking for does not exist.', 'nexawp' ); ?></p>
</section>

<?php
get_footer();
