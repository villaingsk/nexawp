<?php
/**
 * Header builder customizer
 *
 * @package NexaWP
 */

namespace NexaWP\Customizer;

defined( 'ABSPATH' ) || exit;

final class Header {

	public static function init( \WP_Customize_Manager $wp_customize ): void {

		$wp_customize->add_panel(
			'nexawp_header_panel',
			[
				'title'       => __( 'Header Builder', 'nexawp' ),
				'priority'    => 35,
			]
		);

		// Primary Header section
		$wp_customize->add_section(
			'nexawp_header_primary',
			[
				'title' => __( 'Primary Header', 'nexawp' ),
				'panel' => 'nexawp_header_panel',
				'priority' => 10,
			]
		);

		$wp_customize->add_setting(
			'nexawp_header_primary_bg',
			[
				'default'           => '#ffffff',
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'refresh',
			]
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'nexawp_header_primary_bg',
				[
					'label'   => __( 'Background Color', 'nexawp' ),
					'section' => 'nexawp_header_primary',
				]
			)
		);

		$wp_customize->add_setting(
			'nexawp_header_primary_border_color',
			[
				'default'           => '#e6e6e6',
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'refresh',
			]
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'nexawp_header_primary_border_color',
				[
					'label'   => __( 'Border Color', 'nexawp' ),
					'section' => 'nexawp_header_primary',
				]
			)
		);

		$wp_customize->add_setting(
			'nexawp_header_primary_border_width',
			[
				'default'           => 1,
				'sanitize_callback' => 'absint',
				'transport'         => 'refresh',
			]
		);

		$wp_customize->add_control( 'nexawp_header_primary_border_width', [
			'label'       => __( 'Border Bottom Width (px)', 'nexawp' ),
			'section'     => 'nexawp_header_primary',
			'type'        => 'number',
			'input_attrs' => [
				'min' => 0,
				'max' => 20,
				'step' => 1,
			],
		] );

		$wp_customize->add_setting(
			'nexawp_header_primary_padding_inline',
			[
				'default'           => 24,
				'sanitize_callback' => 'absint',
				'transport'         => 'refresh',
			]
		);

		$wp_customize->add_control( 'nexawp_header_primary_padding_inline', [
			'label'       => __( 'Inline Padding (px)', 'nexawp' ),
			'section'     => 'nexawp_header_primary',
			'type'        => 'number',
			'input_attrs' => [
				'min' => 0,
				'max' => 200,
				'step' => 1,
			],
		] );

		// Selective refresh for header fragments
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial(
				'nexawp_header_partial',
				[
					'selector'        => '.nexawp-header',
					'render_callback' => static function() {
						\NexaWP\Frontend\Header::render();
					},
				]
			);

			$wp_customize->selective_refresh->add_partial(
				'nexawp_site_branding_partial',
				[
					'selector'        => '.nexawp-site-branding',
					'render_callback' => static function() {
						\NexaWP\Frontend\Header::site_branding();
					},
				]
			);
		}

		// Above Header
		$wp_customize->add_section(
			'nexawp_header_above',
			[
				'title' => __( 'Above Header', 'nexawp' ),
				'panel' => 'nexawp_header_panel',
				'priority' => 20,
			]
		);

		$wp_customize->add_setting( 'nexawp_header_above_enabled', [ 'default' => 0, 'sanitize_callback' => 'absint', 'transport' => 'refresh' ] );
		$wp_customize->add_control( 'nexawp_header_above_enabled', [ 'label' => __( 'Enable Above Header', 'nexawp' ), 'section' => 'nexawp_header_above', 'type' => 'checkbox' ] );

		// Logo visibility in Above Header
		$wp_customize->add_setting( 'nexawp_header_above_logo', [ 'default' => 1, 'sanitize_callback' => 'absint', 'transport' => 'refresh' ] );
		$wp_customize->add_control( 'nexawp_header_above_logo', [ 'label' => __( 'Show Logo in Above Header', 'nexawp' ), 'section' => 'nexawp_header_above', 'type' => 'checkbox' ] );

		$wp_customize->add_setting( 'nexawp_header_above_bg', [ 'default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh' ] );
		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'nexawp_header_above_bg', [ 'label' => __( 'Background Color', 'nexawp' ), 'section' => 'nexawp_header_above' ] ) );

		$wp_customize->add_setting( 'nexawp_header_above_border_color', [ 'default' => '#e6e6e6', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh' ] );
		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'nexawp_header_above_border_color', [ 'label' => __( 'Border Color', 'nexawp' ), 'section' => 'nexawp_header_above' ] ) );

		$wp_customize->add_setting( 'nexawp_header_above_border_width', [ 'default' => 1, 'sanitize_callback' => 'absint', 'transport' => 'refresh' ] );
		$wp_customize->add_control( 'nexawp_header_above_border_width', [ 'label' => __( 'Border Bottom Width (px)', 'nexawp' ), 'section' => 'nexawp_header_above', 'type' => 'number', 'input_attrs' => [ 'min' => 0, 'max' => 20, 'step' => 1 ] ] );

		$wp_customize->add_setting( 'nexawp_header_above_padding_inline', [ 'default' => 24, 'sanitize_callback' => 'absint', 'transport' => 'refresh' ] );
		$wp_customize->add_control( 'nexawp_header_above_padding_inline', [ 'label' => __( 'Inline Padding (px)', 'nexawp' ), 'section' => 'nexawp_header_above', 'type' => 'number', 'input_attrs' => [ 'min' => 0, 'max' => 200, 'step' => 1 ] ] );

		// Below Header
		$wp_customize->add_section(
			'nexawp_header_below',
			[
				'title' => __( 'Below Header', 'nexawp' ),
				'panel' => 'nexawp_header_panel',
				'priority' => 30,
			]
		);

		$wp_customize->add_setting( 'nexawp_header_below_enabled', [ 'default' => 0, 'sanitize_callback' => 'absint', 'transport' => 'refresh' ] );
		$wp_customize->add_control( 'nexawp_header_below_enabled', [ 'label' => __( 'Enable Below Header', 'nexawp' ), 'section' => 'nexawp_header_below', 'type' => 'checkbox' ] );

		// Logo visibility in Below Header
		$wp_customize->add_setting( 'nexawp_header_below_logo', [ 'default' => 1, 'sanitize_callback' => 'absint', 'transport' => 'refresh' ] );
		$wp_customize->add_control( 'nexawp_header_below_logo', [ 'label' => __( 'Show Logo in Below Header', 'nexawp' ), 'section' => 'nexawp_header_below', 'type' => 'checkbox' ] );

		$wp_customize->add_setting( 'nexawp_header_below_bg', [ 'default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh' ] );
		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'nexawp_header_below_bg', [ 'label' => __( 'Background Color', 'nexawp' ), 'section' => 'nexawp_header_below' ] ) );

		$wp_customize->add_setting( 'nexawp_header_below_border_color', [ 'default' => '#e6e6e6', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh' ] );
		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'nexawp_header_below_border_color', [ 'label' => __( 'Border Color', 'nexawp' ), 'section' => 'nexawp_header_below' ] ) );

		$wp_customize->add_setting( 'nexawp_header_below_border_width', [ 'default' => 1, 'sanitize_callback' => 'absint', 'transport' => 'refresh' ] );
		$wp_customize->add_control( 'nexawp_header_below_border_width', [ 'label' => __( 'Border Bottom Width (px)', 'nexawp' ), 'section' => 'nexawp_header_below', 'type' => 'number', 'input_attrs' => [ 'min' => 0, 'max' => 20, 'step' => 1 ] ] );

		$wp_customize->add_setting( 'nexawp_header_below_padding_inline', [ 'default' => 24, 'sanitize_callback' => 'absint', 'transport' => 'refresh' ] );
		$wp_customize->add_control( 'nexawp_header_below_padding_inline', [ 'label' => __( 'Inline Padding (px)', 'nexawp' ), 'section' => 'nexawp_header_below', 'type' => 'number', 'input_attrs' => [ 'min' => 0, 'max' => 200, 'step' => 1 ] ] );
	}
}

add_action( 'customize_register', static function ( \WP_Customize_Manager $wp_customize ) {
	Header::init( $wp_customize );
} );
