<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #page div and all content after
 *
 * @package     @@pkg.name
 * @author      @@pkg.author
 * @license     @@pkg.license
 */

?>

			</main>

		</div>

		<?php do_action( 'coblocks_before_footer' ); ?>

		<footer class="site-footer">

			<?php get_sidebar(); ?>

			<div class="site-info container center-align h5 medium sans-serif-font gray" role="contentinfo">

				<span class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?></a>
				</span>

				<span class="site-theme">
					<?php /* translators: 1: theme, 2: designer */ ?>
					<a href="https://coblocks.com/" class="powered-by-coblocks"><?php printf( esc_html__( 'Powered by %1$s', '@@textdomain' ), 'CoBlocks' ); ?></a>
				</span>

			</div>

			<?php if ( has_nav_menu( 'footer' ) ) : ?>

				<nav class="footer-navigation container" aria-label="<?php esc_attr_e( 'Footer Menu', '@@textdomain' ); ?>">

					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'menu_class'     => 'footer-menu sans-serif-font medium gray h5 list-reset',
							'depth'          => '1',
						)
					);
					?>

				</nav>

			<?php endif; ?>

		</footer>

		<?php do_action( 'coblocks_after_footer' ); ?>

	</div>

	<?php wp_footer(); ?>

	</body>

</html>
