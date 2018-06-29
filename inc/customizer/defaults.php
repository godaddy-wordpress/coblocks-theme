<?php
/**
 * Customizer defaults
 *
 * @package     @@pkg.name
 * @author      @@pkg.author
 * @license     @@pkg.license
 */

/**
 * Get the default option for @@pkg.name's Customizer settings.
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
				'custom_logo_max_width'        => 50,
				'custom_logo_mobile_max_width' => 50,
				'custom_logo_border_radius'    => true,

				// Colors.
				'heading_color'                => '#2a2a2a',
				'alt_heading_color'            => '#656e79',
				'text_color'                   => '#2a2a2a',
				'header_icon_color'            => '#2a2a2a',
				'nav_color'                    => '#656e79',
				'mobile_nav_color'             => '#2a2a2a',
				'footer_bg_color'              => '#f1f1f1',
				'footer_text_color'            => '#2a2a2a',

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
