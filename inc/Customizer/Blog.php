<?php
/**
 * Blog settings
 *
 * @package NexaWP
 */

namespace NexaWP\Customizer;

defined( 'ABSPATH' ) || exit;

final class Blog {

	public static function init( \WP_Customize_Manager $wp_customize ): void {

		// Blog / Archive sidebar layout
		$wp_customize->add_section(
			'nexawp_blog_layout',
			[
				'title'    => __( 'Blog & Archive', 'nexawp' ),
				'panel'    => 'nexawp_layout_panel',
				'priority' => 60,
			]
		);

		$wp_customize->add_setting( 'nexawp_layout_blog_sidebar', [ 'default' => 'right', 'sanitize_callback' => [ __CLASS__, 'sanitize_layout' ], 'transport' => 'refresh' ] );
		$wp_customize->add_control( 'nexawp_layout_blog_sidebar', [ 'label' => __( 'Blog / Archive Sidebar', 'nexawp' ), 'section' => 'nexawp_blog_layout', 'type' => 'radio', 'choices' => [ 'none' => __( 'No sidebar', 'nexawp' ), 'right' => __( 'Right', 'nexawp' ), 'left' => __( 'Left', 'nexawp' ) ] ] );

		// Single post sidebar layout
		$wp_customize->add_setting( 'nexawp_layout_single_sidebar', [ 'default' => 'right', 'sanitize_callback' => [ __CLASS__, 'sanitize_layout' ], 'transport' => 'refresh' ] );
		$wp_customize->add_control( 'nexawp_layout_single_sidebar', [ 'label' => __( 'Single Post Sidebar', 'nexawp' ), 'section' => 'nexawp_blog_layout', 'type' => 'radio', 'choices' => [ 'none' => __( 'No sidebar', 'nexawp' ), 'right' => __( 'Right', 'nexawp' ), 'left' => __( 'Left', 'nexawp' ) ] ] );

	}

	public static function sanitize_layout( $value ) {
		return in_array( $value, [ 'none', 'left', 'right' ], true ) ? $value : 'none';
	}
}
