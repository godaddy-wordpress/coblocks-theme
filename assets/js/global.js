/**
 * Theme javascript functions file.
 */

( function( $ ) {
	"use strict";

	var
	html			= $( 'html' ),
	body			= $( 'body' ),
	searchToggle 		= $( '#search-toggle' ),
	searchOverlay 		= $( '#site-search-overlay' ),
	searchOpen		= ( 'site-search-open' ),
	nightToggle 		= $( '#night-mode-toggle' ),
	nightActive 		= ( 'night-mode' );

	/**
	 * Removes "no-js" and adds "js" classes to the body tag.
	 */
	(function(html){html.className = html.className.replace( /\bno-js\b/,'js' );})(document.documentElement);

	/**
	 * Test if inline SVGs are supported.
	 * @link https://github.com/Modernizr/Modernizr/
	 */
	function supportsInlineSVG() {
		var div = document.createElement( 'div' );
		div.innerHTML = '<svg/>';
		return 'http://www.w3.org/2000/svg' === ( 'undefined' !== typeof SVGRect && div.firstChild && div.firstChild.namespaceURI );
	}

	/* Document Ready */
	$( document ).ready( function () {

		supportsInlineSVG();

		if ( true === supportsInlineSVG() ) {
			document.documentElement.className = document.documentElement.className.replace( /(\s*)no-svg(\s*)/, '$1svg$2' );
		}

		/* FitVids */
		$( '.entry-content' ).fitVids();

		/* Night Mode */
		nightToggle.on( 'click', function( e ) {

			if ( html.hasClass( nightActive ) ) {
				html.removeClass( nightActive );
				localStorage.setItem( 'night-mode', 'false' );
			} else {
				html.addClass( nightActive );
				localStorage.setItem( 'night-mode', 'true' );
			}
		});

		/* Search */
		searchToggle.on( 'click', function( e ) {
			e.preventDefault();

			if ( body.hasClass( searchOpen ) ) {
				body.removeClass( searchOpen );
			} else {
				body.addClass( searchOpen );
				$( '#site-search .search-field' ).focus();
			}
		});

		/* Search overlay */
		searchOverlay.on( 'click', function( e ) {
			e.preventDefault();
			body.removeClass( searchOpen );
		});

		// Runs for auto-post-load.
		$( '.nav-previous' ).find( 'a' ).attr( 'rel', 'prev' );
	});

	// Runs when auto-post-load is triggered.
	$( document.body ).on( 'alnp-post-loaded', function( e, post_title, post_url, post_ID, post_count ) {
		$( '.nav-previous' ).find( 'a' ).attr( 'rel', 'prev' );
		$( '.entry-footer' ).addClass( 'alnp-post-loaded' );
	} );

} )( jQuery );

! ( function( e, t, n ) {

	t.addEventListener( 'DOMContentLoaded', function() {

		function i( e, i ) {
			var r = 2 < arguments.length && arguments[2] !== n ? arguments[2] : 'click';
			var c = t.querySelectorAll( e );

			if ( e && i ) {

				c && c.forEach( function( e ) {
					e.addEventListener( r, function() {
						var e = 'true' === this.getAttribute( i );
						this.setAttribute( i, String( ! e ) );
					});
				});
			}
		}

		i( '[aria-checked]', 'aria-checked' );

	});

}( window, document ) );
