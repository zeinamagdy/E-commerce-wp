<?php
/**
 * The template part for displaying content.
 * 
 * @since   1.0.0
 * @package Gecko
 */

$column = '';
if ( cs_get_option( 'blog-style' ) == 'masonry' ) {
	$column = ' jas-col-md-' . cs_get_option( 'blog-masonry-column' );
}
?>
<?php do_action( 'jas_gecko_before_post' ); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'mb__30' . $column ); ?>>
	<?php jas_gecko_post_thumbnail(); ?>
	
	<div class="post-content">
		<?php echo do_shortcode( wp_trim_words( get_the_content(), 20, '...' ) ); ?>

		<div class="post-action flex between-xs middle-xs mt__30">
			<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
				<div class="comments-link"><i class="pe-7s-comment dib pr mr__5"></i><?php comments_popup_link( esc_html__( '0 Comment', 'gecko' ), esc_html__( '1 Comment', 'gecko' ), esc_html__( '% Comments', 'gecko' ) ); ?></div>
			<?php endif; ?>
			<a class="read-more pr" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more', 'gecko' ); ?><i class="pa pe-7s-angle-right ts__03"></i></a>
		</div>
	</div><!-- .post-content -->
</article><!-- #post-# -->
<?php do_action( 'jas_gecko_after_post' ); ?>