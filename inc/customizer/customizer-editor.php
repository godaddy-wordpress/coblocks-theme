<?php
/**
 * Add customizer colors to the block editor.
 *
 * @package     CoBlocks
 */

/**
 * Add customizer colors to the block editor.
 */
function coblocks_editor_customizer_generated_values() {

	// Retrieve colors from the Customizer.
	$background_color  = get_theme_mod( 'background_color', '#ffffff' );
	$text_color        = get_theme_mod( 'text_color', coblocks_defaults( 'text_color' ) );
	$heading_color     = get_theme_mod( 'heading_color', coblocks_defaults( 'heading_color' ) );
	$alt_heading_color = get_theme_mod( 'alt_heading_color', coblocks_defaults( 'alt_heading_color' ) );

	// Fonts.
	$heading_font = get_theme_mod( 'heading_font', coblocks_defaults( 'heading_font' ) );
	$body_font    = get_theme_mod( 'body_font', coblocks_defaults( 'body_font' ) );

	if ( 'System Fonts' === $heading_font ) {
		$heading_font = '-apple-system, BlinkMacSystemFont, segoe ui, fira sans, helvetica neue, arial, sans-serif';
	}

	if ( 'System Fonts' === $body_font ) {
		$body_font = '-apple-system, BlinkMacSystemFont, segoe ui, fira sans, helvetica neue, arial, sans-serif';
	}

	if ( 'System Serif' === $heading_font ) {
		$heading_font = 'serif';
	}

	if ( 'System Serif' === $body_font ) {
		$body_font = 'serif';
	}

	// Build styles.
	$css = '';

	$css .= '.block-editor__container { background-color: #' . esc_attr( $background_color ) . '; }';
	$css .= '.editor-styles-wrapper.edit-post-visual-editor { color: ' . esc_attr( $text_color ) . '; }';
	$css .= '.wp-block-heading h1, .wp-block-heading h2, .wp-block-heading h3, .wp-block-heading h4, .wp-block-heading h5, .wp-block-heading h6 { color: ' . esc_attr( $heading_color ) . ' !important; }';
	$css .= '.editor-styles-wrapper.edit-post-visual-editor .editor-post-title__block .editor-post-title__input { color: ' . esc_attr( $heading_color ) . '; }';
	$css .= '.editor-styles-wrapper.edit-post-visual-editor figcaption:not(.blockgallery--caption), .editor-styles-wrapper.edit-post-visual-editor .blockgallery:not(.has-caption-color) figcaption { color: ' . esc_attr( $alt_heading_color ) . ' }';

	return wp_strip_all_tags( apply_filters( 'coblocks_editor_customizer_generated_values', $css ) );
}

/**
 * Enqueue Customizer settings into the block editor.
 */
function coblocks_editor_customizer_styles() {

	// Register Customizer styles within the editor to use for inline additions.
	wp_register_style( 'coblocks-editor-customizer-styles', false, '@@pkg.version', 'all' );

	// Enqueue the Customizer style.
	wp_enqueue_style( 'coblocks-editor-customizer-styles' );

	// Add custom colors to the editor.
	wp_add_inline_style( 'coblocks-editor-customizer-styles', coblocks_editor_customizer_generated_values() );
}
add_action( 'enqueue_block_editor_assets', 'coblocks_editor_customizer_styles' );
