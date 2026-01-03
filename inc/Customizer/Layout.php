<?php
/**
 * Layout & Container settings
 *
 * @package NexaWP
 */

namespace NexaWP\Customizer;

defined( 'ABSPATH' ) || exit;

final class Layout {

	public static function init( \WP_Customize_Manager $wp_customize ): void {

		$wp_customize->add_section(
			'nexawp_container_section',
			[
				'title'    => __( 'Container', 'nexawp' ),
				'panel'    => 'nexawp_layout_panel',
				'priority' => 10,
			]
		);

		// Container Width
		$wp_customize->add_setting(
			'nexawp_container_width',
			[
				'default'           => 1200,
				'sanitize_callback' => [ __CLASS__, 'sanitize_number' ],
				'transport'         => 'refresh',
			]
		);

		$wp_customize->add_control(
			'nexawp_container_width',
			[
				'type'        => 'number',
				'section'     => 'nexawp_container_section',
				'label'       => __( 'Container Width (px)', 'nexawp' ),
				'input_attrs' => [
					'min'  => 768,
					'max'  => 1920,
					'step' => 10,
				],
			]
		);

		// Container Padding
		$wp_customize->add_setting(
			'nexawp_container_padding',
			[
				'default'           => 24,
				'sanitize_callback' => [ __CLASS__, 'sanitize_number' ],
				'transport'         => 'refresh',
			]
		);

		$wp_customize->add_control(
			'nexawp_container_padding',
			[
				'type'        => 'number',
				'section'     => 'nexawp_container_section',
				'label'       => __( 'Container Padding (px)', 'nexawp' ),
				'input_attrs' => [
					'min'  => 0,
					'max'  => 80,
					'step' => 2,
				],
			]
		);
	}

	public static function sanitize_number( $value ): int {
		return absint( $value );
	}
}

add_action(
	'customize_register',
	static function ( \WP_Customize_Manager $wp_customize ) {
		Layout::init( $wp_customize );
	}
);
