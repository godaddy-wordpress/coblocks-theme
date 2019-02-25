<?php
/**
 * Enqueues front-end CSS for Customizer options.
 *
 * @package     @@pkg.name
 * @author      @@pkg.author
 * @license     @@pkg.license
 */

/**
 * Set the Custom CSS via Customizer options.
 */
function coblocks_customizer_css() {

	$background_color      = get_theme_mod( 'background_color', '#ffffff' );
	$background_color_rgba = coblocks_hex2rgb( $background_color );
	$background_color_rgba = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.1)', $background_color_rgba );

	$site_logo_width        = get_theme_mod( 'custom_logo_max_width', coblocks_defaults( 'custom_logo_max_width' ) );
	$site_logo_mobile_width = get_theme_mod( 'custom_logo_mobile_max_width', coblocks_defaults( 'custom_logo_mobile_max_width' ) );

	$heading_color     = get_theme_mod( 'heading_color', coblocks_defaults( 'heading_color' ) );
	$alt_heading_color = get_theme_mod( 'alt_heading_color', coblocks_defaults( 'alt_heading_color' ) );
	$nav_color         = get_theme_mod( 'nav_color', coblocks_defaults( 'nav_color' ) );
	$mobile_nav_color  = get_theme_mod( 'mobile_nav_color', coblocks_defaults( 'mobile_nav_color' ) );
	$text_color        = get_theme_mod( 'text_color', coblocks_defaults( 'text_color' ) );
	$header_icon_color = get_theme_mod( 'header_icon_color', coblocks_defaults( 'header_icon_color' ) );
	$footer_bg_color   = get_theme_mod( 'footer_bg_color', coblocks_defaults( 'footer_bg_color' ) );
	$footer_text_color = get_theme_mod( 'footer_text_color', coblocks_defaults( 'footer_text_color' ) );

	$css =
	'
	body {
		color: ' . esc_attr( $text_color ) . ';
	}

	body .custom-logo-link img.custom-logo {
		width: ' . esc_attr( $site_logo_mobile_width ) . 'px;
	}

	@media (min-width: 600px) {
		body .custom-logo-link img.custom-logo {
			width: ' . esc_attr( $site_logo_width ) . 'px;
		}
	}

	body .widget-area__wrapper {
		background: ' . esc_attr( $footer_bg_color ) . ';
	}

	body .widget-area__wrapper,
	body .widget-area__wrapper .h1,
	body .widget-area__wrapper .h2,
	body .widget-area__wrapper .h3,
	body .widget-area__wrapper .h4,
	body .widget-area__wrapper .h5,
	body .widget-area__wrapper .h6 {
		color: ' . esc_attr( $footer_text_color ) . ';
	}

	@media (max-width: 599px) {
		.site-header {
			background: ' . esc_attr( $background_color ) . ' !important;
		}

		.main-navigation ul:not(.sub-menu) {
			top: calc( 30px + ' . esc_attr( $site_logo_mobile_width ) . 'px ) !important;
			padding-top: ' . esc_attr( $site_logo_mobile_width ) . 'px !important;
		}

		.admin-bar .main-navigation ul:not(.sub-menu) {
			top: calc( 46px + 30px + ' . esc_attr( $site_logo_mobile_width ) . 'px ) !important;
		}

		body .main-navigation ul:not(.sub-menu) a {
			color: ' . esc_attr( $mobile_nav_color ) . ' !important;
		}
	}

	@media (max-width: 599px) {
		.site-header::after {
			top: calc( 30px + ' . esc_attr( $site_logo_mobile_width ) . 'px )!important;
			background: transparent;
   			background: -webkit-linear-gradient( #' . esc_attr( $background_color ) . ' 0%, ' . esc_attr( $background_color_rgba ) . ')!important;
   			background: linear-gradient( #' . esc_attr( $background_color ) . ' 0%, ' . esc_attr( $background_color_rgba ) . ')!important;
		}

		.admin-bar .site-header::after {
			top: calc( 46px + 30px + ' . esc_attr( $site_logo_mobile_width ) . 'px ) !important;
		}
	}

	.gray,
	label,
	.logged-in-as,
	.wp-caption-text,
	.page-links a span,
	.comment-metadata a,
	.taxonomy-description,
	.entry-content figcaption:not(.blockgallery--caption),
	.entry-content .blockgallery:not(.has-caption-color) figcaption,
	.comment-reply-title small,
	.no-svg .dropdown-toggle .svg-fallback.icon-down {
		color: ' . esc_attr( $alt_heading_color ) . ';
	}

	body .search-toggle .svg-icon, body .site-header .social-navigation svg, body .search-form .search-submit .svg-icon {
		fill: ' . esc_attr( $header_icon_color ) . ';
	}

	body .menu-toggle::after, body .menu-toggle::before {
		background-color: ' . esc_attr( $header_icon_color ) . ';
	}

	.site-header .nav li a {
		color: ' . esc_attr( $nav_color ) . ';
	}

	.main-navigation .dropdown-toggle .svg-icon {
		fill: ' . esc_attr( $nav_color ) . ';
	}

	h1, h2, h3, h4, h5, h6, .h1:not(.gray), .h2:not(.gray), .h3:not(.gray), .h4:not(.gray), .h5:not(.gray), .h6:not(.gray), .home:not(.blog) .entry-content h5 {
		color: ' . esc_attr( $heading_color ) . ';
	}

	body #course-body #course-element-title-content {
		color: ' . esc_attr( $heading_color ) . ' !important;
	}
	';

	wp_add_inline_style( 'coblocks-style', wp_strip_all_tags( $css ) );

}
add_action( 'wp_enqueue_scripts', 'coblocks_customizer_css' );
