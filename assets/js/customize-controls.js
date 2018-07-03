/**
 * Scripts within the customizer controls window.
 *
 * Contextually shows the color hue control and informs the preview
 * when users open or close the front page sections section.
 */

( function() {

	// Extends our custom "upgrade-theme" section.
	wp.customize.sectionConstructor['upgrade-theme'] = wp.customize.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

	wp.customize.bind( 'ready', function() {

		/**
		 * Function to hide/show Customizer options, based on another control.
		 *
		 * Parent option, Affected Control, Value which affects the control.
		 */
		function customizer_image_option_display( parent_setting, affected_control, speed ) {
			wp.customize( parent_setting, function( setting ) {
				wp.customize.control( affected_control, function( control ) {
					var visibility = function() {
						if ( setting.get() && 'none' !== setting.get() && '0' !== setting.get() ) {
							control.container.slideDown( speed );
						} else {
							control.container.slideUp( speed );
						}
					};

					visibility();
					setting.bind( visibility );
				});
			});
		}

		// Only show the logo max width options, if a logo is uploaded.
		customizer_image_option_display( 'custom_logo', 'custom_logo_max_width', 140 );
		customizer_image_option_display( 'custom_logo', 'custom_logo_mobile_max_width', 140 );
		customizer_image_option_display( 'custom_logo', 'custom_logo_border_radius', 140 );
		customizer_image_option_display( 'custom_logo', 'site_title', 140 );
	});

} )( jQuery );
