<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package     @@pkg.name
 * @author      @@pkg.author
 * @license     @@pkg.license
 */

get_header();

while ( have_posts() ) :

	the_post();

	get_template_part( 'components/page/content', 'page' );

	do_action( 'coblocks_before_comments' );

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;

	do_action( 'coblocks_after_comments' );

endwhile; // End of the loop.

get_footer();
