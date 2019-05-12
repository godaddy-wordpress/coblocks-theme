<?php
/**
 * Auto Load Next Post ompatibility File
 * See https://wordpress.org/plugins/auto-load-next-post/
 *
 * @package CoBlocks
 */

if ( ! function_exists( 'coblocks_alnp_setup' ) ) :
	/**
	 * Add Auto Load Next Post support.
	 */
	function coblocks_alnp_setup() {
		add_theme_support(
			'auto-load-next-post', array(
				'content_container'    => 'main.site-main',
				'title_selector'       => 'h1.entry-title',
				'navigation_container' => 'nav.post-navigation',
				'comments_container'   => 'div#comments',
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'coblocks_alnp_setup' );

/**
 * Filter the location of the auto load next post template.
 */
function coblocks_alnp_template_location() {
	return '/components/post/';
}
add_filter( 'alnp_template_location', 'coblocks_alnp_template_location' );

/**
 * Modify the post divider with a little more pizazz.
 */
function coblocks_alnp_post_divider() {
	?>
	<div class="alnp--read-more center-align">
		<span id="alnp--read-more__text" class="display-inline-block sans-serif-font gray">
			<?php echo esc_html( apply_filters( 'coblocks_post_up_next', esc_html__( 'Read my next article', 'coblocks' ) ) ); ?>
		</span>
		<?php echo coblocks_get_icon_svg( 'arrow-down', 20 ); ?>
	</div>
<?php
}

add_action( 'alnp_load_before_loop', 'coblocks_alnp_post_divider', 0 );
