<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package CoBlocks
 */

get_header(); ?>

<section class="error-404 container center-align top-spacer bottom-spacer not-found">
	<header class="page-header">
		<h1 class="h1"><?php echo esc_html( apply_filters( 'coblocks_404', esc_html__( 'Yikes!', 'coblocks' ) ) ); ?></h1>
		<h2 class="h2"><?php echo esc_html( apply_filters( 'coblocks_404_text', esc_html__( 'It looks like you\'re lost.', 'coblocks' ) ) ); ?></h2>
	</header>
	<div class="page-content container--sml">
		<?php get_search_form(); ?>
	</div>
</section>

<?php
get_footer();
