<?php
/**
 * Header rendering
 *
 * @package NexaWP
 */

namespace NexaWP\Frontend;

defined( 'ABSPATH' ) || exit;

final class Header {

	public static function render(): void {

		// Allow plugin Pro (Disable Elements, dll)
		if ( ! apply_filters( 'nexawp_show_header', true ) ) {
			return;
		}

		// Above header (optional)
		if ( get_theme_mod( 'nexawp_header_above_enabled', 0 ) ) {
			?>
			<div class="nexawp-header-above">
				<div class="nexawp-container nexawp-header-above-inner">
					<?php if ( get_theme_mod( 'nexawp_header_above_logo', 1 ) ) { self::site_branding(); } ?>
					<?php self::nav_location( 'above' ); ?>
				</div>
			</div>
			<?php
		}

		// Primary header
		?>
		<header class="nexawp-header" role="banner">
			<div class="nexawp-container nexawp-header-inner">
				<?php self::site_branding(); ?>
				<?php self::nav_location( 'primary' ); ?>
			</div>
		</header>
		<?php

		// Below header (optional)
		if ( get_theme_mod( 'nexawp_header_below_enabled', 0 ) ) {
			?>
			<div class="nexawp-header-below">
				<div class="nexawp-container nexawp-header-below-inner">
					<?php if ( get_theme_mod( 'nexawp_header_below_logo', 1 ) ) { self::site_branding(); } ?>
					<?php self::nav_location( 'below' ); ?>
				</div>
			</div>
			<?php
		}
	}

	public static function site_branding(): void {
		?>
		<div class="nexawp-site-branding">
			<?php
			if ( has_custom_logo() ) {
				the_custom_logo();
			} else {
				?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nexawp-site-title">
					<?php bloginfo( 'name' ); ?>
				</a>
				<?php
			}
			?>
		</div>
		<?php
	}

	public static function primary_navigation(): void {
		if ( ! has_nav_menu( 'primary' ) ) {
			return;
		}
		?>
		<nav class="nexawp-primary-nav" aria-label="<?php esc_attr_e( 'Primary Menu', 'nexawp' ); ?>">
			<?php
			wp_nav_menu(
				[
					'theme_location' => 'primary',
					'menu_class'     => 'nexawp-menu',
					'container'      => false,
					'fallback_cb'    => false,
				]
			);
			?>
		</nav>
		<?php
	}

	public static function nav_location( string $location ): void {
		if ( ! has_nav_menu( $location ) ) {
			return;
		}

		$classes = 'nexawp-' . $location . '-nav';
		$label   = sprintf( /* translators: %s: location */ esc_attr__( '%s Menu', 'nexawp' ), ucfirst( $location ) );
		?>
		<nav class="<?php echo esc_attr( $classes ); ?>" aria-label="<?php echo esc_attr( $label ); ?>">
			<?php wp_nav_menu( [ 'theme_location' => $location, 'container' => false, 'menu_class' => $classes . ' nexawp-menu' ] ); ?>
		</nav>
		<?php
	}
}
