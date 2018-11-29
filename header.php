<?php
/**
 * The header for our theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package     @@pkg.name
 * @author      @@pkg.author
 * @license     @@pkg.license
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="site">

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', '@@textdomain' ); ?></a>

	<?php do_action( 'coblocks_before_header' ); ?>

	<header id="masthead" class="site-header" role="banner">

		<div class="container max-width flex justify-between">

			<div class="flex justify-start items-center">

				<?php coblocks_site_logo(); ?>

				<?php if ( has_nav_menu( 'social' ) ) : ?>

					<span class="sep"></span>

					<nav class="social-navigation" aria-label="<?php esc_attr_e( 'Social Menu', '@@textdomain' ); ?>">

						<?php
							wp_nav_menu(
								array(
									'theme_location' => 'social',
									'menu_class'     => 'sans-serif-font medium smooth gray h6 list-reset',
									'depth'          => 1,
									'link_before'    => '<span class="screen-reader-text">',
									'link_after'     => '</span>' . coblocks_get_svg( array( 'icon' => 'chain' ) ),
								)
							);
						?>

					</nav>

				<?php endif; ?>
			</div>

			<div class="flex items-center">

				<?php do_action( 'coblocks_before_nav' ); ?>

				<nav id="site-navigation" class="main-navigation nav primary flex items-center justify-end" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', '@@textdomain' ); ?>">

					<?php if ( has_nav_menu( 'primary' ) ) : ?>
						<button class="menu-toggle" aria-controls="top-menu" aria-expanded="false">
							<span class="screen-reader-text"><?php echo esc_html__( 'Menu', '@@textdomain' ); ?></span>
						</button>

						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'primary',
								'menu_class'     => 'primary-menu sans-serif-font medium smooth gray h6 list-reset',
								'depth'          => '2',
							)
						);
						?>

						<span class="sep"></span>

					<?php endif; ?>

					<?php coblocks_search_toggle(); ?>

					<?php coblocks_night_toggle(); ?>

				</nav>

				<?php do_action( 'coblocks_after_nav' ); ?>

			</div>

		</div>

	</header>

	<?php do_action( 'coblocks_after_header' ); ?>

	<div id="content" class="site-content">

		<main id="main" class="site-main" role="main">
