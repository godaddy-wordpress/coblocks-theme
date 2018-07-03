<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package     @@pkg.name
 * @author      @@pkg.author
 * @license     @@pkg.license
 */

if ( ! function_exists( 'coblocks_night_toggle' ) ) :
	/**
	 * Toggle for the night mode option.
	 *
	 * Create your own coblocks_night_toggle() to override in a child theme.
	 */
	function coblocks_night_toggle() {

		$night      = get_theme_mod( 'night_mode', coblocks_defaults( 'night_mode' ) );
		$visibility = ( false === $night ) ? ' hidden' : null;

		if ( $night || is_customize_preview() ) {
			?>
			<button id="night-mode-toggle" class="site-header__button header__button--night-mode button--chromeless<?php echo esc_attr( $visibility ); ?>" role="switch" aria-checked="false" aria-label="<?php esc_attr_e( 'Toggle Night Mode', '@@textdomain' ); ?>">
				<?php echo wp_kses( coblocks_get_svg( array( 'icon' => 'night' ) ), coblocks_svg_allowed_html() ); ?>
				<span class="screen-reader-text"><?php echo esc_html_x( 'Settings', 'settings button', '@@textdomain' ); ?></span>
			</button>
			<?php
		}
	}
endif;

if ( ! function_exists( 'coblocks_header_search' ) ) :
	/**
	 * Site-wide search bar.
	 *
	 * Create your own coblocks_header_search() to override in a child theme.
	 */
	function coblocks_header_search() {

		$search            = get_theme_mod( 'header_search', coblocks_defaults( 'header_search' ) );
		$search_visibility = ( false === $search ) ? ' hidden' : null;

		if ( $search || is_customize_preview() ) {
			?>
			<div id="site-search" class="site-search <?php echo esc_attr( $search_visibility ); ?>">
				<?php get_search_form(); ?>
				<div id="site-search-overlay" class="site-search-overlay"></div>
			</div>
			<?php
		}

	}
endif;
add_action( 'coblocks_before_header', 'coblocks_header_search' );

if ( ! function_exists( 'coblocks_search_toggle' ) ) :
	/**
	 * Trigger toggle for the site-wide search bar.
	 *
	 * Create your own coblocks_search_toggle() to override in a child theme.
	 */
	function coblocks_search_toggle() {

		$search            = get_theme_mod( 'header_search', coblocks_defaults( 'header_search' ) );
		$search_visibility = ( false === $search ) ? ' hidden' : null;

		if ( $search || is_customize_preview() ) {
			?>
			<button id="search-toggle" type="submit" class="button--chromeless search-toggle search-submit <?php echo esc_attr( $search_visibility ); ?>">
				<?php echo wp_kses( coblocks_get_svg( array( 'icon' => 'search' ) ), coblocks_svg_allowed_html() ); ?>
				<span class="screen-reader-text"><?php echo esc_html_x( 'Search', 'submit button', '@@textdomain' ); ?></span>
			</button>
		<?php
		}

	}
endif;

if ( ! function_exists( 'coblocks_post_thumbnail' ) ) :
	/**
	 * Display an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function coblocks_post_thumbnail() {

		global $post;

		if ( post_password_required() || is_attachment() || is_single() ) {
			return;
		}

		if ( '' !== get_the_post_thumbnail() ) {
		?>

			<div class="entry-media bottom-spacer center-align">

				<?php
				if ( is_singular() ) :
					the_post_thumbnail( 'york-featured-image' );
				else :
				?>
					<a class="post-thumbnail" href="<?php esc_url( the_permalink() ); ?>" aria-hidden="true">
						<?php the_post_thumbnail( 'coblocks-featured-image' ); ?>
					</a>
					<?php
				endif;
				?>

			</div>

			<?php
		}
	}
endif;

if ( ! function_exists( 'coblocks_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the author and comments.
	 * Based on Twenty Seventeen.
	 */
	function coblocks_posted_on() {

		// Is the option enabled?
		$author            = get_theme_mod( 'author_meta', coblocks_defaults( 'author_meta' ) );
		$author_visibility = ( false === $author ) ? ' hidden' : null;

		// Check for link post format and output a link icon if it is one.
		$link        = get_post_meta( get_the_ID(), '_coblocks_link', true );
		$format_icon = ( has_post_format( 'link' ) && $link ) ? coblocks_get_svg( array( 'icon' => 'chain' ) ) : null;

		// Add a sticky icon, if it's necessary.
		$sticky_icon = ( is_sticky() && is_home() ) ? coblocks_get_svg( array( 'icon' => 'thumb-tack' ) ) : null;

		// Add a lock icon, if it's necessary.
		$password_icon = ( post_password_required() && is_home() ) ? coblocks_get_svg( array( 'icon' => 'lock' ) ) : null;

		// Get the author name; wrap it in a link.
		$byline = sprintf(
			/* translators: %s: post author */
			'<span>' . __( 'by %s', '@@textdomain' ) . '</span>',
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a></span>'
		);

		$allowed_html = array(
			'time' => array(
				'class'    => array(),
				'datetime' => array(),
			),
			'span' => array(
				'class' => array(),
			),
			'a'    => array(
				'class' => array(),
				'href'  => array(),
			),
		);

		// Finally, let's write all of this to the page.
		echo '<div class="entry-meta h5 medium sans-serif-font gray">' . wp_kses( $password_icon, coblocks_svg_allowed_html() ), wp_kses( $sticky_icon, coblocks_svg_allowed_html() ), wp_kses( $format_icon, coblocks_svg_allowed_html() ) . '<span class="posted-on">' . wp_kses( coblocks_time_link(), $allowed_html ) . '</span><span class="byline ' . esc_attr( $author_visibility ) . '"> ' . wp_kses( $byline, $allowed_html ) . '</span></div>';

	}
endif;

if ( ! function_exists( 'coblocks_time_link' ) ) :
	/**
	 * Gets a nicely formatted string for the published date.
	 * Based on Twenty Seventeen.
	 */
	function coblocks_time_link() {

		// Get the updated and the published times.
		$time_string = '<span>%5$s</span> <time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<span>%5$s</span> <time class="updated" datetime="%3$s">%4$s</time><time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			get_the_date( DATE_W3C ),
			get_the_date(),
			get_the_modified_date( DATE_W3C ),
			get_the_modified_date(),
			apply_filters( 'coblocks_post_meta_updated_text', esc_html__( 'Published', '@@textdomain' ) )
		);

		// Wrap the time string in a link, and preface it with 'Posted on'.
		return sprintf(
			/* translators: %s: post date */
			__( '<span class="screen-reader-text">Posted on</span> %s', '@@textdomain' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);
	}
endif;

if ( ! function_exists( 'coblocks_site_logo' ) ) :
	/**
	 * Output an <img> tag of the site logo.
	 */
	function coblocks_site_logo() {

		// Let's check to see if the option is enabled via the Customizer.
		$site_title       = get_theme_mod( 'site_title', coblocks_defaults( 'site_title' ) );
		$visibility       = ( false === $site_title ) ? ' screen-reader-text' : null;
		$with_custom_logo = ( has_custom_logo() ) ? ' with-custom-logo' : null;

		do_action( 'coblocks_before_site_logo' );

		the_custom_logo();

		printf( '<h1 class="h3 site-title %1$s" itemscope itemtype="http://schema.org/Organization"><a href="%2$s" rel="home" itemprop="url" class="black">%3$s</a></h1>', esc_attr( $visibility . $with_custom_logo ), esc_url( home_url( '/' ) ), esc_html( get_bloginfo( 'name' ) ) );

		do_action( 'coblocks_after_site_logo' );
	}

endif;

if ( ! function_exists( 'coblocks_categories' ) ) :
	/**
	 * Prints HTML with meta information for the categories.
	 */
	function coblocks_categories() {
		if ( 'post' === get_post_type() ) {

			// Let's check to see if the option is enabled via the Customizer.
			$option     = get_theme_mod( 'categories', coblocks_defaults( 'categories' ) );
			$visibility = ( false === $option ) ? ' hidden' : null;

			if ( ! $option && ! is_customize_preview() ) {
				return;
			}

			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( '' );

			if ( $categories_list && coblocks_categorized_blog() ) {
				printf( '<span class="cat-links sans-serif-font extra-small medium smooth dark-gray %1$s">%2$s</span>', esc_attr( $visibility ), $categories_list ); // WPCS: XSS OK.
			}
		}
	}
endif;

if ( ! function_exists( 'coblocks_tags' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function coblocks_tags() {

		// Hide category and tag text for pages.
		if ( is_singular() && 'post' === get_post_type() ) {

			// Let's check to see if the option is enabled via the Customizer.
			$option     = get_theme_mod( 'tags', coblocks_defaults( 'tags' ) );
			$visibility = ( false === $option ) ? ' hidden' : null;

			if ( ! $option && ! is_customize_preview() ) {
				return;
			}

			$tags_list = get_the_tag_list( '', '' );

			if ( ! $tags_list ) {
				return;
			}

			if ( $tags_list ) {
				printf( '<span class="tags-links sans-serif-font extra-small medium smooth dark-gray %1$s">%2$s</span>', esc_attr( $visibility ), $tags_list ); // WPCS: XSS OK.
			}
		}
	}
endif;

/**
 * Determine whether blog/site has more than one category.
 *
 * @return bool True of there is more than one category, false otherwise.
 */
function coblocks_categorized_blog() {
	// Create an array of all the categories that are attached to posts.
	if ( false === ( $all_the_cool_cats = get_transient( 'coblocks_categories' ) ) ) {
		$all_the_cool_cats = get_categories(
			array(
				'fields'     => 'ids',
				'hide_empty' => 1,
				'number'     => 2,
			)
		);

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'coblocks_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so coblocks_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so coblocks_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in { @see coblocks_categorized_blog() }.
 */
function coblocks_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'coblocks_categories' );
}
add_action( 'edit_category', 'coblocks_category_transient_flusher' );
add_action( 'save_post', 'coblocks_category_transient_flusher' );
