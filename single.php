<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package     @@pkg.name
 * @author      @@pkg.author
 * @license     @@pkg.license
 */

get_header();

// Start the loop.
while ( have_posts() ) :

	the_post();

	/*
	 * Include the Post-Format-specific template for the content.
	 * If you want to override this in a child theme, then include a file
	 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
	 */
	get_template_part( 'components/post/content', get_post_format() );

	do_action( 'coblocks_before_comments' );

	/*
	 * If comments are open or we have at least one comment, load up the comment template.
	 *
	 * @link https://codex.wordpress.org/Function_Reference/comments_open/
	 * @link https://codex.wordpress.org/Template_Tags/get_comments_number/
	 * @link https://developer.wordpress.org/reference/functions/comments_template/
	 */
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;

	do_action( 'coblocks_after_comments' );

endwhile;

get_footer();
