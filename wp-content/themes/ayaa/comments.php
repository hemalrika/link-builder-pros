<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ayaa
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
?>
	<div id="comments" class="comments-area">
		<div class="comments-title-wrap mb-35">
			<h5 class="comments-title">
				<?php
				$ayaa_comment_count = get_comments_number();
				if ( '1' === $ayaa_comment_count ) {
					printf(
						/* translators: 1: title. */
						esc_html__('1 Comment', 'ayaa')
					);
				} else {
					printf( 
						esc_html($ayaa_comment_count.' Comments')
					);
				}
				?>
			</h5><!-- .comments-title -->
		</div>
		<?php the_comments_navigation(); ?>
		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'walker'      => new Farzaa_Walker_Comment(),
					'style'      => 'ol',
					'avatar_size' => 100,
					'short_ping' => true,
				)
			);
			?>
		</ol><!-- .comment-list -->

		

	</div><!-- #comments -->
<?php
// Check for have_comments(). 
endif; ?>
<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() ) :
		?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'ayaa' ); ?></p>
		<?php
	endif;
	comment_form();
?>