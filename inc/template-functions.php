<?php
/**
 * Additional features to allow styling of the templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package CoBlocks
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function coblocks_body_classes( $classes ) {
	global $post;

	// If comments are open and there are no comments.
	if ( ! is_404() && ( ! get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) ) {
		if ( comments_open() && ! get_comments_number() ) {
			$classes[] = 'has-no-comments';
		}
	}

	return $classes;
}
add_filter( 'body_class', 'coblocks_body_classes' );
