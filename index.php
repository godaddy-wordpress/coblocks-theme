<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package CoBlocks
 */

get_header();

if ( have_posts() ) :

	/* Start the Loop */
	while ( have_posts() ) :

		the_post();

		/*
		 * Include the Post-Format-specific template for the content.
		 * If you want to override this in a child theme, then include a file
		 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
		 */
		get_template_part( 'components/post/content', get_post_format() );

	endwhile;

	if ( ! class_exists( 'Jetpack' ) || ! Jetpack::is_module_active( 'infinite-scroll' ) ) :
		/*
		 * The posts pagination outputs a set of page numbers with links to the previous and next pages of posts.
		 *
		 * @link https://codex.wordpress.org/Function_Reference/the_posts_pagination
		 */
		the_posts_pagination(
			array(
				'prev_text'          => coblocks_get_icon_svg( 'chevron_left', 40 ) . '<span class="screen-reader-text">' . __( 'Previous', 'coblocks' ) . '</span>',
				'next_text'          => '<span class="screen-reader-text">' . __( 'Next', 'coblocks' ) . '</span>' . coblocks_get_icon_svg( 'chevron_right', 40 ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'coblocks' ) . ' </span>',
			)
		);
	endif;

else :
	get_template_part( 'components/post/content', 'none' );
endif;

get_footer();
