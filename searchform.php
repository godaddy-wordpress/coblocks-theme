<?php
/**
 * Template for displaying search forms in CoBlocks
 *
 * @package CoBlocks
 */

$unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo esc_attr( $unique_id ); ?>">
		<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'coblocks' ); ?></span>
	</label>
	<input type="search" id="<?php echo esc_attr( $unique_id ); ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'coblocks' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="button--chromeless search-submit"><?php echo coblocks_get_icon_svg( 'search', 27 ); ?><span class="screen-reader-text"><?php echo esc_html_x( 'Search', 'submit button', 'coblocks' ); ?></span></button>
</form>
