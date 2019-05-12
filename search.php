<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package CoBlocks
 */

get_header(); ?>

<section class="search-wrapper">

	<header class="page-header container center-align bottom-spacer">
		<?php if ( have_posts() ) : ?>
			<?php /* translators: 1: search query */ ?>
			<h1 class="h2"><?php printf( esc_html__( 'Searching for: %s', 'coblocks' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		<?php else : ?>
			<h1 class="h2"><?php esc_html_e( 'Nothing Found', 'coblocks' ); ?></h1>
		<?php endif; ?>
	</header>

	<?php
	if ( have_posts() ) :
		/* Start the Loop */
		while ( have_posts() ) :

			the_post();

			/**
			 * Run the loop for the search to output the results.
			 * If you want to overload this in a child theme then include a file
			 * called content-search.php and that will be used instead.
			 */
			get_template_part( 'components/post/content', 'excerpt' );

		endwhile; // End of the loop.

		the_posts_pagination(
			array(
				'prev_text'          => coblocks_get_icon_svg( 'chevron_left', 40 ) . '<span class="screen-reader-text">' . __( 'Previous', 'coblocks' ) . '</span>',
				'next_text'          => '<span class="screen-reader-text">' . __( 'Next', 'coblocks' ) . '</span>' . coblocks_get_icon_svg( 'chevron_right', 22 ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'coblocks' ) . ' </span>',
			)
		);

	else :
	?>

		<div class="container--sml center-align">
			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try searching again.', 'coblocks' ); ?></p>
			<?php get_search_form(); ?>
		</div>

	<?php endif; ?>

</section>

<?php
get_footer();
