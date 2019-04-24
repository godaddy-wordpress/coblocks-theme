<?php
/**
 * Template part for displaying the singular post.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package CoBlocks
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header top-spacer bottom-spacer">

		<?php
		do_action( 'coblocks_before_entry_title' );

		if ( is_single() ) {
			the_title( '<h1 class="entry-title h1">', '</h1>' );
		} else {
			the_title( '<h2 class="entry-title h1"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}

		do_action( 'coblocks_after_entry_title' );
		?>

		<?php coblocks_posted_on(); ?>

	</header>

	<?php coblocks_post_thumbnail(); ?>

	<?php do_action( 'coblocks_before_content' ); ?>

	<div class="entry-content">

		<?php
		the_content();

		wp_link_pages(
			array(
				'before'      => '<div class="page-links">' . __( 'Pages:', '@@textdomain' ),
				'after'       => '</div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			)
		);
		?>

	</div>

	<?php do_action( 'coblocks_after_content' ); ?>

	<?php if ( is_single() ) { ?>

		<footer class="entry-footer flex justify-between">

			<div class="entry-footer__taxonomy justify-start self-center items-center">

				<?php coblocks_categories(); ?>

				<?php coblocks_tags(); ?>

			</div>

		</footer>

	<?php } ?>

	<nav class="post-navigation">
		<?php previous_post_link(); ?>
		<?php next_post_link(); ?>
	</nav>

</article><!-- #post-## -->
