<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package CoBlocks
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="page-wrapper">

		<?php
		// Don't show the entry title on any Beaver Builder enabled pages.
		if ( ! class_exists( 'FLBuilder' ) || ! FLBuilderModel::is_builder_enabled() ) {
		?>

			<header class="entry-header top-spacer bottom-spacer">

				<?php do_action( 'coblocks_before_entry_title' ); ?>

				<?php the_title( '<h1 class="entry-title h1">', '</h1>' ); ?>

				<?php do_action( 'coblocks_after_entry_title' ); ?>

				<?php coblocks_posted_on(); ?>

			</header>

		<?php } ?>

		<?php do_action( 'coblocks_before_content' ); ?>

		<div class="entry-content">
			<?php
				the_content();

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'coblocks' ),
						'after'  => '</div>',
					)
				);
			?>
		</div>

		<?php do_action( 'coblocks_after_content' ); ?>

	</div>

</article>
