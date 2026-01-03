<?php
/**
 * Typography settings
 *
 * @package NexaWP
 */

namespace NexaWP\Customizer;

defined( 'ABSPATH' ) || exit;

final class Typography {

	public static function init( \WP_Customize_Manager $wp_customize ): void {

		$wp_customize->add_section(
			'nexawp_typography_section',
			[
				'title'    => __( 'Typography', 'nexawp' ),
				'priority' => 40,
			]
		);

		// Body Font Family
		$wp_customize->add_setting(
			'nexawp_body_font_family',
			[
				'default'           => 'system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif',
				'sanitize_callback' => [ __CLASS__, 'sanitize_font_family' ],
				'transport'         => 'refresh',
			]
		);

		$wp_customize->add_control(
			'nexawp_body_font_family',
			[
				'type'    => 'text',
				'section' => 'nexawp_typography_section',
				'label'   => __( 'Body Font Family', 'nexawp' ),
			]
		);

		// Base Font Size
		$wp_customize->add_setting(
			'nexawp_body_font_size',
			[
				'default'           => 16,
				'sanitize_callback' => 'absint',
				'transport'         => 'refresh',
			]
		);

		$wp_customize->add_control(
			'nexawp_body_font_size',
			[
				'type'        => 'number',
				'section'     => 'nexawp_typography_section',
				'label'       => __( 'Base Font Size (px)', 'nexawp' ),
				'input_attrs' => [
					'min'  => 12,
					'max'  => 22,
					'step' => 1,
				],
			]
		);
	}

	public static function sanitize_font_family( string $value ): string {
		$value = wp_strip_all_tags( $value );
		return trim( $value );
	}
}

add_action(
	'customize_register',
	static function ( \WP_Customize_Manager $wp_customize ) {
		Typography::init( $wp_customize );
	}
);
