<?php
/**
 * Footer builder customizer
 *
 * @package NexaWP
 */

namespace NexaWP\Customizer;

defined( 'ABSPATH' ) || exit;

final class Footer {

	public static function init( \WP_Customize_Manager $wp_customize ): void {

		$wp_customize->add_panel(
			'nexawp_footer_panel',
			[
				'title'    => __( 'Footer Builder', 'nexawp' ),
				'priority' => 36,
			]
		);

		// Footer Settings
		$wp_customize->add_section( 'nexawp_footer_main', [ 'title' => __( 'Footer', 'nexawp' ), 'panel' => 'nexawp_footer_panel', 'priority' => 10 ] );

		// Copyright text
		$default_copyright = sprintf( /* translators: %s: site title */ __( 'Copyright %s %s | development by Kref Studio', 'nexawp' ), '[copyright]', date( 'Y' ) . ' ' . get_bloginfo( 'name' ) );

		$wp_customize->add_setting( 'nexawp_footer_copyright', [ 'default' => $default_copyright, 'sanitize_callback' => 'wp_kses_post', 'transport' => 'refresh' ] );
		$wp_customize->add_control( 'nexawp_footer_copyright', [ 'label' => __( 'Copyright Text', 'nexawp' ), 'section' => 'nexawp_footer_main', 'type' => 'textarea' ] );

		// Widget area enable
		$wp_customize->add_setting( 'nexawp_footer_widgets_enable', [ 'default' => 1, 'sanitize_callback' => 'absint', 'transport' => 'refresh' ] );
		$wp_customize->add_control( 'nexawp_footer_widgets_enable', [ 'label' => __( 'Enable Footer Widgets', 'nexawp' ), 'section' => 'nexawp_footer_main', 'type' => 'checkbox' ] );

		// Columns
		$wp_customize->add_setting( 'nexawp_footer_widgets_columns', [ 'default' => 4, 'sanitize_callback' => 'absint', 'transport' => 'refresh' ] );
		$wp_customize->add_control( 'nexawp_footer_widgets_columns', [ 'label' => __( 'Footer Widget Columns', 'nexawp' ), 'section' => 'nexawp_footer_main', 'type' => 'select', 'choices' => [ 1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6' ] ] );

		// Footer width
		$wp_customize->add_setting( 'nexawp_footer_width', [ 'default' => 'boxed', 'sanitize_callback' => [ __CLASS__, 'sanitize_footer_width' ], 'transport' => 'refresh' ] );
		$wp_customize->add_control( 'nexawp_footer_width', [ 'label' => __( 'Footer Width', 'nexawp' ), 'section' => 'nexawp_footer_main', 'type' => 'radio', 'choices' => [ 'full' => __( 'Full Width', 'nexawp' ), 'boxed' => __( 'Boxed', 'nexawp' ) ] ] );

		// Back to top
		$wp_customize->add_setting( 'nexawp_back_to_top', [ 'default' => 1, 'sanitize_callback' => 'absint', 'transport' => 'refresh' ] );
		$wp_customize->add_control( 'nexawp_back_to_top', [ 'label' => __( 'Back To Top Button', 'nexawp' ), 'section' => 'nexawp_footer_main', 'type' => 'checkbox' ] );

		// Selective refresh for footer
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'nexawp_footer_partial', [
				'selector'        => '.nexawp-footer',
				'render_callback' => static function() {
					\NexaWP\Frontend\Footer::render();
				},
			] );
		}
	}

	public static function sanitize_footer_width( $value ) {
		return in_array( $value, [ 'full', 'boxed' ], true ) ? $value : 'boxed';
	}
}

add_action( 'customize_register', static function ( \WP_Customize_Manager $wp_customize ) {
	Footer::init( $wp_customize );
} );
