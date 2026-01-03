<?php
/**
 * Main layout helpers
 *
 * @package NexaWP
 */

namespace NexaWP\Frontend;

defined( 'ABSPATH' ) || exit;

final class Layout {

	private static string $layout = 'none';

	public static function content_open(): void {
		// Determine layout
		if ( is_singular( 'page' ) ) {
			$meta = get_post_meta( get_the_ID(), 'nexawp_page_sidebar_layout', true );
			self::$layout = $meta ? $meta : 'none';
		} elseif ( is_singular( 'post' ) ) {
			self::$layout = get_theme_mod( 'nexawp_layout_single_sidebar', 'none' );
		} elseif ( is_home() || is_archive() ) {
			self::$layout = get_theme_mod( 'nexawp_layout_blog_sidebar', 'none' );
		} else {
			self::$layout = 'none';
		}

		$class = 'nexawp-layout';
		if ( 'left' === self::$layout ) {
			$class .= ' nexawp-layout--sidebar-left';
		} elseif ( 'right' === self::$layout ) {
			$class .= ' nexawp-layout--sidebar-right';
		} else {
			$class .= ' nexawp-layout--no-sidebar';
		}

		echo '<div class="' . esc_attr( $class ) . '">';
		echo '<main id="primary" class="nexawp-content">';
		echo '<div class="nexawp-container">';
	}

	public static function content_close(): void {
		echo '</div></main>';

		if ( in_array( self::$layout, [ 'left', 'right' ], true ) ) {
			// Output sidebar
			echo '<aside id="secondary" class="nexawp-sidebar" role="complementary">';
			if ( is_active_sidebar( 'sidebar-1' ) ) {
				dynamic_sidebar( 'sidebar-1' );
			}
			echo '</aside>';
		}

		echo '</div>'; // .nexawp-layout
	}
}
