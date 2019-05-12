<?php
/**
 * Theme Customizer functionality
 *
 * @package CoBlocks
 */

/**
 * Customizer.
 *
 * @param WP_Customize_Manager $wp_customize the Customizer object.
 */
function coblocks_customize_register( $wp_customize ) {

	/**
	 * Customize.
	 */
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	$wp_customize->selective_refresh->add_partial(
		'blogname', array(
			'selector'        => '.site-title a',
			'settings'        => array( 'blogname' ),
			'render_callback' => 'coblocks_customize_partial_blogname',
		)
	);

	$wp_customize->selective_refresh->add_partial(
		'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'coblocks_customize_partial_blogdescription',
		)
	);

	/**
	 * Add custom controls.
	 */
	require get_parent_theme_file_path( 'inc/customizer/class-coblocks-range-control.php' );
	require get_parent_theme_file_path( 'inc/customizer/class-coblocks-upgrade-control.php' );

	/**
	 * Register custom controls.
	 */
	$wp_customize->register_control_type( 'CoBlocks_Range_Control' );
	$wp_customize->register_section_type( 'CoBlocks_Upgrade_Control' );

	/**
	 * Add the upgrade section, only if either of the CoBlocks plugins are not installed.
	 *
	 * @see https://github.com/justintadlock/trt-customizer-pro
	 */
	if ( ! class_exists( 'CoBlocks' ) || class_exists( 'CoBlocks_Pro' ) ) {

		$wp_customize->add_section(
			new CoBlocks_Upgrade_Control(
				$wp_customize, 'theme_upgrade', array(
					'type'     => 'upgrade-theme',
					'title'    => esc_html__( 'Get the CoBlocks Plugin', 'coblocks' ),
					'pro_text' => esc_html__( 'Download', 'coblocks' ),
					'pro_url'  => 'https://coblocks.com',
					'priority' => 9999,
				)
			)
		);
	}

	/**
	 * Top-Level Customizer sections and panels.
	 */
	$wp_customize->add_section(
		'coblocks_theme_options', array(
			'title'    => esc_html__( 'Theme Options', 'coblocks' ),
			'priority' => 30,
		)
	);

	/**
	 * Add the site logo max-width options to the Site Identity section.
	 */
	$wp_customize->add_setting(
		'custom_logo_max_width', array(
			'default'           => coblocks_defaults( 'custom_logo_max_width' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new CoBlocks_Range_Control(
			$wp_customize, 'custom_logo_max_width', array(
				'default'     => coblocks_defaults( 'custom_logo_max_width' ),
				'type'        => 'coblocks-range',
				'label'       => esc_html__( 'Max Width', 'coblocks' ),
				'description' => 'px',
				'section'     => 'title_tagline',
				'priority'    => 8,
				'input_attrs' => array(
					'min'  => 40,
					'max'  => 300,
					'step' => 2,
				),
			)
		)
	);

	$wp_customize->add_setting(
		'custom_logo_mobile_max_width', array(
			'default'           => coblocks_defaults( 'custom_logo_max_width' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new CoBlocks_Range_Control(
			$wp_customize, 'custom_logo_mobile_max_width', array(
				'default'     => coblocks_defaults( 'custom_logo_max_width' ),
				'type'        => 'coblocks-range',
				'label'       => esc_html__( 'Mobile Max Width', 'coblocks' ),
				'description' => 'px',
				'section'     => 'title_tagline',
				'priority'    => 9,
				'input_attrs' => array(
					'min'  => 40,
					'max'  => 200,
					'step' => 2,
				),
			)
		)
	);

	$wp_customize->add_setting(
		'custom_logo_border_radius', array(
			'default'           => coblocks_defaults( 'custom_logo_border_radius' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'coblocks_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'custom_logo_border_radius',
		array(
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Border Radius', 'coblocks' ),
			'section'  => 'title_tagline',
			'priority' => 9,
		)
	);

	$wp_customize->add_setting(
		'site_title', array(
			'default'           => coblocks_defaults( 'site_title' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'coblocks_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'site_title',
		array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Display the Site Title and Logo', 'coblocks' ),
			'section' => 'title_tagline',
		)
	);

	$wp_customize->add_setting(
		'header_search', array(
			'default'           => coblocks_defaults( 'header_search' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'coblocks_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'header_search',
		array(
			'type'        => 'checkbox',
			'label'       => esc_html__( 'Header Search', 'coblocks' ),
			'description' => esc_html__( 'A site-wide searching element next to the header navigation.', 'coblocks' ),
			'section'     => 'coblocks_theme_options',
		)
	);

	$wp_customize->add_setting(
		'night_mode', array(
			'default'           => coblocks_defaults( 'night_mode' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'coblocks_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'night_mode',
		array(
			'type'        => 'checkbox',
			'label'       => esc_html__( 'Night Mode', 'coblocks' ),
			'description' => esc_html__( 'Enable for readers to view content easily while in the dark.', 'coblocks' ),
			'section'     => 'coblocks_theme_options',
		)
	);

	$wp_customize->add_setting(
		'author_meta', array(
			'default'           => coblocks_defaults( 'author_meta' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'coblocks_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'author_meta',
		array(
			'type'        => 'checkbox',
			'label'       => esc_html__( 'Author', 'coblocks' ),
			'description' => esc_html__( 'Add the post author metadata below the post title.', 'coblocks' ),
			'section'     => 'coblocks_theme_options',
		)
	);

	$wp_customize->add_setting(
		'categories', array(
			'default'           => coblocks_defaults( 'categories' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'coblocks_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'categories',
		array(
			'type'        => 'checkbox',
			'label'       => esc_html__( 'Categories', 'coblocks' ),
			'description' => esc_html__( 'Enable or disable categories that display in the post footer.', 'coblocks' ),
			'section'     => 'coblocks_theme_options',
		)
	);

	$wp_customize->add_setting(
		'tags', array(
			'default'           => coblocks_defaults( 'tags' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'coblocks_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'tags',
		array(
			'type'        => 'checkbox',
			'label'       => esc_html__( 'Tags', 'coblocks' ),
			'description' => esc_html__( 'Enable or disable tags that display in the post footer.', 'coblocks' ),
			'section'     => 'coblocks_theme_options',
		)
	);

	$wp_customize->add_setting(
		'more_tag', array(
			'default'           => coblocks_defaults( 'more_tag' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_html',
		)
	);

	/**
	 * Colors.
	 */
	$wp_customize->add_setting(
		'heading_color', array(
			'default'           => coblocks_defaults( 'heading_color' ),
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'heading_color', array(
				'label'   => esc_html__( 'Heading Color', 'coblocks' ),
				'section' => 'colors',
			)
		)
	);

	$wp_customize->add_setting(
		'alt_heading_color', array(
			'default'           => coblocks_defaults( 'alt_heading_color' ),
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'alt_heading_color', array(
				'label'   => esc_html__( 'Alt Heading Color', 'coblocks' ),
				'section' => 'colors',
			)
		)
	);

	$wp_customize->add_setting(
		'text_color', array(
			'default'           => coblocks_defaults( 'text_color' ),
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'text_color', array(
				'label'   => esc_html__( 'Text Color', 'coblocks' ),
				'section' => 'colors',
			)
		)
	);

	$wp_customize->add_setting(
		'header_icon_color', array(
			'default'           => coblocks_defaults( 'header_icon_color' ),
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'header_icon_color', array(
				'label'   => esc_html__( 'Header Icon Color', 'coblocks' ),
				'section' => 'colors',
			)
		)
	);

	$wp_customize->add_setting(
		'nav_color', array(
			'default'           => coblocks_defaults( 'nav_color' ),
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'nav_color', array(
				'label'   => esc_html__( 'Navigation Color', 'coblocks' ),
				'section' => 'colors',
			)
		)
	);

	$wp_customize->add_setting(
		'mobile_nav_color', array(
			'default'           => coblocks_defaults( 'mobile_nav_color' ),
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'mobile_nav_color', array(
				'label'   => esc_html__( 'Mobile Navigation Color', 'coblocks' ),
				'section' => 'colors',
			)
		)
	);

	$wp_customize->add_setting(
		'footer_bg_color', array(
			'default'           => coblocks_defaults( 'footer_bg_color' ),
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'footer_bg_color', array(
				'label'   => esc_html__( 'Footer Background Color', 'coblocks' ),
				'section' => 'colors',
			)
		)
	);

	$wp_customize->add_setting(
		'footer_text_color', array(
			'default'           => coblocks_defaults( 'footer_text_color' ),
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'footer_text_color', array(
				'label'   => esc_html__( 'Footer Text Color', 'coblocks' ),
				'section' => 'colors',
			)
		)
	);
}

add_action( 'customize_register', 'coblocks_customize_register', 11 );

/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 */
function coblocks_customize_preview_js() {
	wp_enqueue_script( 'coblocks-customize-preview', get_theme_file_uri( '/assets/js/customize-preview.js' ), array( 'customize-preview' ), '@@pkg.version', true );
}
add_action( 'customize_preview_init', 'coblocks_customize_preview_js' );

/**
 * Load dynamic logic for the customizer controls area.
 */
function coblocks_customize_controls_js() {
	wp_enqueue_script( 'coblocks-customize-controls', get_theme_file_uri( '/assets/js/customize-controls.js' ), array( 'customize-controls' ), '@@pkg.version', true );
}
add_action( 'customize_controls_enqueue_scripts', 'coblocks_customize_controls_js' );

/**
 * CSS to make the Customizer controls look a bit better.
 */
function coblocks_customize_controls_css() {
	wp_enqueue_style( 'coblocks-customize-preview', get_theme_file_uri( '/assets/css/customize-controls.css' ), '@@pkg.version', true );
}
add_action( 'customize_controls_print_styles', 'coblocks_customize_controls_css' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @see coblocks_customize_register()
 *
 * @return void
 */
function coblocks_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @see coblocks_customize_register()
 *
 * @return void
 */
function coblocks_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Render the custom more tag for the selective refresh partial.
 *
 * @see coblocks_customize_register()
 */
function coblocks_customize_partial_more_tag() {
	return get_theme_mod( 'more_tag' );
}
