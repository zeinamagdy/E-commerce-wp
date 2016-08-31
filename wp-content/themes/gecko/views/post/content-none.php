<?php
/**
 * The template part for displaying content none.
 * 
 * @since   1.0.0
 * @package Gecko
 */
?>
<?php do_action( 'jas_gecko_before_post' ); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'mb__80' ); ?>>
	<div class="post-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( wp_kses_post( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'gecko' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>
			
			<div class="tc">
				<h4 class="mb__30"><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'gecko' ); ?></h4>
				<?php get_search_form(); ?>
			</div>

		<?php else : ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'gecko' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>
	</div><!-- .post-content -->
</article><!-- #post-# -->
<?php do_action( 'jas_gecko_after_post' ); ?>