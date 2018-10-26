<?php
/**
 * TGMPA Plugins.
 *
 * Register the plugins for this theme.
 *
 * @package     @@pkg.name
 * @author      @@pkg.author
 * @license     @@pkg.license
 */

/**
 * Load the TGMPA class.
 */
require get_parent_theme_file_path( '/inc/class-tgm-plugin-activation.php' );

/**
 * Register the required plugins for this theme.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function coblocks_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		array(
			'name'     => esc_html__( 'Gutenberg', '@@textdomain' ),
			'slug'     => 'gutenberg',
			'required' => false,
		),
		array(
			'name'     => esc_html__( 'CoBlocks', '@@textdomain' ),
			'slug'     => 'coblocks',
			'required' => false,
		),
		array(
			'name'     => esc_html__( 'Block Gallery', '@@textdomain' ),
			'slug'     => 'block-gallery',
			'required' => false,
		),
		array(
			'name'     => esc_html__( 'Login Designer', '@@textdomain' ),
			'slug'     => 'login-designer',
			'required' => false,
		),
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'coblcoks',              // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be at the top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}

add_action( 'tgmpa_register', 'coblocks_register_required_plugins' );
