<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package CoBlocks
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
} ?>

<div id="comments" class="comments">

	<div class="comments__inner container">

		<?php
		if ( have_comments() ) :
			?>

			<h2 class="comments-title h4">
				<?php
				$comments_number = get_comments_number();
				if ( '1' === $comments_number ) {
					/* translators: %s: post title */
					printf( _x( 'One reply to &ldquo;%s&rdquo;', 'comments title', 'coblocks' ), get_the_title() );
				} else {
					printf(
						/* translators: 1: number of comments, 2: post title */
						_nx(
							'%1$s reply to &ldquo;%2$s&rdquo;',
							'%1$s replies to &ldquo;%2$s&rdquo;',
							$comments_number,
							'comments title',
							'coblocks'
						),
						number_format_i18n( $comments_number ),
						get_the_title()
					);
				}
				?>
			</h2>

			<ol class="comment-list list-reset">
				<?php
				wp_list_comments(
					array(
						'avatar_size' => 100,
						'style'       => 'ol',
						'short_ping'  => true,
					)
				);
				?>
			</ol>

			<?php
			the_comments_pagination(
				array(
					'prev_text' => coblocks_get_icon_svg( 'chevron_left', 40 ) . '<span class="screen-reader-text">' . __( 'Previous', 'coblocks' ) . '</span>',
					'next_text' => '<span class="screen-reader-text">' . __( 'Next', 'coblocks' ) . '</span>' . coblocks_get_icon_svg( 'chevron_right', 22 ),
				)
			);

		endif; // Check for have_comments().

		comment_form();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'coblocks' ); ?></p>
		<?php
		endif;
		?>

	</div>

</div>
