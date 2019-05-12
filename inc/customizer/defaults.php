<?php
/**
 * Customizer defaults
 *
 * @package CoBlocks
 */

/**
 * Get the default option for CoBlocks's Customizer settings.
 *
 * @param  string|string $name Option key name to get.
 * @return mixin
 */
function coblocks_defaults( $name ) {
	static $defaults;

	if ( ! $defaults ) {
		$defaults = apply_filters(
			'coblocks_defaults', array(

				// Identity.
				'site_title'                   => false,
				'custom_logo_max_width'        => 50,
				'custom_logo_mobile_max_width' => 50,
				'custom_logo_border_radius'    => true,

				// Colors.
				'heading_color'                => '#191521',
				'alt_heading_color'            => '#565d67',
				'text_color'                   => '#191521',
				'header_icon_color'            => '#191521',
				'nav_color'                    => '#565d67',
				'mobile_nav_color'             => '#191521',
				'footer_bg_color'              => '#f1f1f1',
				'footer_text_color'            => '#191521',

				// Options.
				'header_search'                => true,
				'night_mode'                   => true,
				'categories'                   => true,
				'tags'                         => true,
				'author_meta'                  => true,
			)
		);
	}

	return isset( $defaults[ $name ] ) ? $defaults[ $name ] : null;
}
