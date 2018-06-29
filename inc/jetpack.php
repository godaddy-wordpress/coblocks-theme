<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package     @@pkg.name
 * @author      @@pkg.author
 * @license     @@pkg.license
 */

/**
 * Add JetPack support.
 */
function coblocks_jetpack_setup() {

	/**
	 * Add support for JetPack Infinite scrolling.
	 *
	 * @see https://jetpack.com/support/infinite-scroll/
	 * @since CoBlocks 1.0.5
	 */
	add_theme_support(
		'infinite-scroll', array(
			'container' => 'main',
			'footer'    => false,
			'render'    => 'coblocks_infinite_scroll',
		)
	);

}
add_action( 'after_setup_theme', 'coblocks_jetpack_setup' );

/**
 * Custom Infinite Scroll Render function.
 */
function coblocks_infinite_scroll() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'components/post/content', get_post_format() );
	}
}

/**
 * Filter Jetpack's Infinite Scroll text on button that loads more posts.
 *
 * @param array $settings An array of settings for infinite scroll.
 */
function coblocks_filter_jetpack_infinite_scroll_button_text( $settings ) {

	$text = apply_filters( 'coblocks_infinite_scroll_button_text', esc_html__( 'Load More...', '@@textdomain' ) );

	$settings['text'] = esc_html( $text );

	return $settings;
}
add_filter( 'infinite_scroll_js_settings', 'coblocks_filter_jetpack_infinite_scroll_button_text' );

/**
 * Remove sharing, so we can place it elsewhere.
 */
function coblocks_filter_jetpack_sharing() {
	remove_filter( 'the_content', 'sharing_display', 19 );
	remove_filter( 'the_excerpt', 'sharing_display', 19 );
}
add_action( 'loop_start', 'coblocks_filter_jetpack_sharing' );

if ( ! function_exists( 'coblocks_jetpack_sharing' ) ) :
	/**
	 * Jetpack's sharing module.
	 *
	 * Create your own coblocks_jetpack_sharing() to override in a child theme.
	 */
	function coblocks_jetpack_sharing() {

		if ( ! class_exists( 'Jetpack' ) ) {
			return;
		}

		if ( function_exists( 'sharing_display' ) ) :

			echo '<div class="container">';

			if ( function_exists( 'sharing_display' ) ) {
				sharing_display( '', true );
			}
			echo '</div>';

		endif;

	}
endif;
add_action( 'coblocks_after_comments', 'coblocks_jetpack_sharing' );
