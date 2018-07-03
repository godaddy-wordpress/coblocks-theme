/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. This javascript will grab settings from customizer controls, and
 * then make any necessary changes to the page using jQuery.
 */

( function( $ ) {

	wp.customize( 'background_color', function( value ) {
		value.bind( function( to ) {
			var style, el;

			style = '<style class="background_color">@media (max-width: 599px) { .site-header::after { background: ' + to + '; } }</style>';

			el = $( '.background_color' );

			if ( el.length ) {
				el.replaceWith( style );
			} else {
				$( 'head' ).append( style );
			}
		} );
	} );

	wp.customize( 'custom_logo', function( value ) {
		value.bind( function( to ) {

			if ( to ) {
				$( '.site-title' ).addClass( 'with-custom-logo' );
			} else {
				$( '.site-title' ).removeClass( 'with-custom-logo' );
			}
		} );
	} );

	wp.customize( 'site_title', function( value ) {
		value.bind( function( to ) {

			if ( true === to ) {

				$( '.site-title' ).css({
					clip: 'auto',
					position: 'relative'
				});

				$( '.site-title' ).removeClass( 'screen-reader-text' );

			} else {

				$( '.site-title' ).css({
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute'
				});
			}
		});
	});

	wp.customize( 'custom_logo_max_width', function( value ) {
		value.bind( function( to ) {
			var style, el;

			style = '<style class="custom_logo_max_width">@media (min-width: 600px) { body .custom-logo-link img.custom-logo { width: ' + to + 'px; } }</style>';

			el = $( '.custom_logo_max_width' );

			if ( el.length ) {
				el.replaceWith( style );
			} else {
				$( 'head' ).append( style );
			}
		} );
	} );

	wp.customize( 'custom_logo_mobile_max_width', function( value ) {
		value.bind( function( to ) {
			var style, el;

			style = '<style class="custom_logo_mobile_max_width">@media (max-width: 599px) { body .custom-logo-link img.custom-logo { width: ' + to + 'px; } .main-navigation ul:not(.sub-menu) { top: calc( 30px + ' + to + 'px ); padding-top: ' + to + 'px; } .site-header::after { top: calc( 50px + ' + to + 'px ); } }</style>';

			el = $( '.custom_logo_mobile_max_width' );

			if ( el.length ) {
				el.replaceWith( style );
			} else {
				$( 'head' ).append( style );
			}
		} );
	} );

	wp.customize( 'custom_logo_border_radius', function( value ) {
		value.bind( function( to ) {

			if ( true === to ) {
				$( '#masthead .site-logo' ).removeClass( 'no-border-radius' );

			} else {

				$( '#masthead .site-logo' ).addClass( 'no-border-radius' );
			}
		});
	});

	wp.customize( 'text_color', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).css( 'color', to );
		} );
	} );

	wp.customize( 'footer_bg_color', function( value ) {
		value.bind( function( to ) {
			$( 'body .widget-area__wrapper' ).css( 'background', to );
		} );
	} );

	wp.customize( 'footer_text_color', function( value ) {
		value.bind( function( to ) {
			$( 'body .widget-area__wrapper, body .widget-area__wrapper h1, body .widget-area__wrapper h2, body .widget-area__wrapper h3, body .widget-area__wrapper h4, body .widget-area__wrapper h5, body .widget-area__wrapper h6' ).css( 'color', to );
		} );
	} );

	wp.customize( 'header_icon_color', function( value ) {
		value.bind( function( to ) {

			$( '.search-toggle .icon, .site-header .social-navigation svg, .search-form .search-submit .icon' ).css( 'fill', to );

			var style, el;

			style = '<style class="header_icon_color">body .menu-toggle::after, body .menu-toggle::before { background-color: ' + to + ' !important; } }</style>';

			el = $( '.header_icon_color' );

			if ( el.length ) {
				el.replaceWith( style );
			} else {
				$( 'head' ).append( style );
			}
		} );
	} );

	wp.customize( 'heading_color', function( value ) {
		value.bind( function( to ) {
			$( 'body #course-body #course-element-title-content, body h1, body h2, body h3, body 4, body h5, body h6, body .h1:not(.gray), body .h2:not(.gray), body .h3:not(.gray), body .h4:not(.gray), body .h5:not(.gray), body .h6:not(.gray), .home:not(.blog) .entry-content h5' ).css( 'color', to );
		} );
	} );

	wp.customize( 'nav_color', function( value ) {
		value.bind( function( to ) {
			$( '.site-header .nav li a' ).css( 'color', to );
			$( '.main-navigation .dropdown-toggle .icon' ).css( 'fill', to );
		} );
	} );

	wp.customize( 'mobile_nav_color', function( value ) {
		value.bind( function( to ) {
			var style, el;

			style = '<style class="mobile_nav_color">@media (max-width: 599px) { body .main-navigation ul:not(.sub-menu) a { color: ' + to + ' !important; } }</style>';

			el = $( '.mobile_nav_color' );

			if ( el.length ) {
				el.replaceWith( style );
			} else {
				$( 'head' ).append( style );
			}
		} );
	} );

	wp.customize( 'alt_heading_color', function( value ) {
		value.bind( function( to ) {
			$( '.gray, label, blockquote, .logged-in-as, .wp-caption-text, .page-links a span, .comment-metadata a, .taxonomy-description, .comment-reply-title small, .no-svg .dropdown-toggle .svg-fallback.icon-down' ).css( 'color', to );
		} );
	} );

	wp.customize( 'header_search', function( value ) {
		value.bind( function( to ) {

			if ( true === to ) {

				$( '#search-toggle, #site-search' ).css({
					clip: 'auto',
					position: 'relative'
				});

				$( '#site-search' ).css({
					position: 'fixed'
				});

				$( '#search-toggle, #site-search' ).removeClass( 'hidden' );

			} else {

				$( '#search-toggle, #site-search' ).css({
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute'
				});

				// Remove the open class, just in case it's applied.
				$( 'body' ).removeClass( 'site-search-open' );
			}
		});
	});

	wp.customize( 'night_mode', function( value ) {
		value.bind( function( to ) {

			if ( true === to ) {

				$( '#night-mode-toggle' ).css({
					clip: 'auto',
					position: 'relative'
				});

				$( '#night-mode-toggle' ).removeClass( 'hidden' );

			} else {

				$( '#night-mode-toggle' ).css({
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute'
				});
			}
		});
	});

	wp.customize( 'author_meta', function( value ) {
		value.bind( function( to ) {

			if ( true === to ) {

				$( '.byline' ).css({
					clip: 'auto',
					position: 'relative'
				});

				$( '.byline' ).removeClass( 'hidden' );

			} else {

				$( '.byline' ).css({
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute'
				});
			}
		});
	});

	wp.customize( 'categories', function( value ) {
		value.bind( function( to ) {

			if ( true === to ) {

				$( '.cat-links' ).css({
					clip: 'auto',
					position: 'relative'
				});

				$( '.cat-links' ).removeClass( 'hidden' );

			} else {

				$( '.cat-links' ).css({
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute'
				});
			}
		});
	});

	wp.customize( 'tags', function( value ) {
		value.bind( function( to ) {

			if ( true === to ) {

				$( '.tags-links' ).css({
					clip: 'auto',
					position: 'relative'
				});

				$( '.tags-links' ).removeClass( 'hidden' );

			} else {

				$( '.tags-links' ).css({
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute'
				});
			}
		});
	});

	function jsUcfirst( string ) {
		return string.charAt( 0 ).toUpperCase() + string.slice( 1 );
	}

} )( jQuery );
