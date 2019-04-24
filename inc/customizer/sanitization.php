<?php
/**
 * Customizer: Sanitization Callbacks
 *
 * This file defines sanitization callback functions for various data types
 * referred to in the Customizer.
 *
 * @see https://github.com/WPTRT/code-examples/blob/master/customizer/sanitization-callbacks.php
 *
 * @package CoBlocks
 */

/**
 * Checkbox sanitization callback example.
 *
 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
 * as a boolean value, either TRUE or FALSE.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function coblocks_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true === $checked ) ? true : false );
}

/**
 * Sanitization: html
 * Control: textarea
 *
 * Sanitization callback for 'html' type text inputs. This
 * callback sanitizes $input for HTML allowable in posts.
 *
 * https://codex.wordpress.org/Function_Reference/wp_kses
 * https://gist.github.com/adamsilverstein/10783774
 * https://github.com/devinsays/options-framework-plugin/blob/master/options-check/functions.php#L69
 * http://ottopress.com/2010/wp-quickie-kses/
 *
 * @uses wp_filter_post_kses() https://developer.wordpress.org/reference/functions/wp_filter_post_kses/
 * @uses wp_kses() https://developer.wordpress.org/reference/functions/wp_kses/
 *
 * @param string|string $input Text to sanitize.
 */
function coblocks_sanitize_html( $input ) {
	global $allowedposttags;
	return wp_kses( $input, $allowedposttags );
}

/**
 * Select sanitization callback example.
 *
 * - Sanitization: select
 * - Control: select, radio
 *
 * Sanitization callback for 'select' and 'radio' type controls. This callback sanitizes `$input`
 * as a slug, and then validates `$input` against the choices defined for the control.
 *
 * @see sanitize_key()               https://developer.wordpress.org/reference/functions/sanitize_key/
 * @see $wp_customize->get_control() https://developer.wordpress.org/reference/classes/wp_customize_manager/get_control/
 *
 * @param string|string        $input   Slug to sanitize.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
 */
function coblocks_sanitize_select( $input, $setting ) {

	// Ensure input is a slug.
	$input = sanitize_key( $input );

	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;

	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
