<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package     @@pkg.name
 * @author      @@pkg.author
 * @license     @@pkg.license
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary">

	<div class="widget-area__inner">

		<div class="widget-area__wrapper">

			<?php do_action( 'coblocks_before_footer_widgets' ); ?>

			<?php dynamic_sidebar( 'sidebar-1' ); ?>

			<?php do_action( 'coblocks_after_footer_widgets' ); ?>
		</div>

	</div>
</aside>
