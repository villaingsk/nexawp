<?php
/**
 * Color settings
 *
 * @package NexaWP
 */

namespace NexaWP\Customizer;

defined( 'ABSPATH' ) || exit;

final class Colors {

	public static function init( \WP_Customize_Manager $wp_customize ): void {

		$wp_customize->add_section(
			'nexawp_colors_section',
			[
				'title'    => __( 'Colors', 'nexawp' ),
				'priority' => 50,
			]
		);

		// Text Color
		$wp_customize->add_setting(
			'nexawp_color_text',
			[
				'default'           => '#222222',
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'refresh',
			]
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'nexawp_color_text',
				[
					'label'   => __( 'Text Color', 'nexawp' ),
					'section' => 'nexawp_colors_section',
				]
			)
		);

		// Background Color
		$wp_customize->add_setting(
			'nexawp_color_background',
			[
				'default'           => '#ffffff',
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'refresh',
			]
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'nexawp_color_background',
				[
					'label'   => __( 'Background Color', 'nexawp' ),
					'section' => 'nexawp_colors_section',
				]
			)
		);

		// Link Color
		$wp_customize->add_setting(
			'nexawp_color_link',
			[
				'default'           => '#0066cc',
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'refresh',
			]
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'nexawp_color_link',
				[
					'label'   => __( 'Link Color', 'nexawp' ),
					'section' => 'nexawp_colors_section',
				]
			)
		);

		// Link Hover Color
		$wp_customize->add_setting(
			'nexawp_color_link_hover',
			[
				'default'           => '#004999',
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'refresh',
			]
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'nexawp_color_link_hover',
				[
					'label'   => __( 'Link Hover Color', 'nexawp' ),
					'section' => 'nexawp_colors_section',
				]
			)
		);
	}
}

add_action(
	'customize_register',
	static function ( \WP_Customize_Manager $wp_customize ) {
		Colors::init( $wp_customize );
	}
);
