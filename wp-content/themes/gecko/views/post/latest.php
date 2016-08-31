<?php
/**
 * The template display latest post.
 *
 * @since   1.0.0
 * @package Gecko
 */
?>
<div class="jas-blog-slider jas-carousel" data-slick='{"slidesToShow": 3,"slidesToScroll": 1, "responsive":[{"breakpoint": 960,"settings":{"slidesToShow": 2}},{"breakpoint": 480,"settings":{"slidesToShow": 1}}]}'>
	<?php while ( have_posts() ) : the_post(); ?>
		<div class="post-thumbnail pr">
			<a href="<?php esc_url( the_permalink() ); ?>" aria-hidden="true">
				<?php
					if ( has_post_thumbnail() ) :
						$url   = get_the_post_thumbnail_url();
						$image = aq_resize( $url, 480, 310, true );
						if ( ! empty( $url ) ) {
							$size  = getimagesize( $url );
						}
						if ( $size[0] > 479 && $size[1] > 309 ) {
							echo '<img src="' . esc_url( $image ) . '" width="480" height="310" alt="' . get_the_title() . '" />';
						} else {
							echo '<img src="' . get_template_directory_uri() . '/assets/images/placeholder.png" width="480" height="310" alt="' . get_the_title() . '" />';
						}
					else :
						echo '<img src="' . get_template_directory_uri() . '/assets/images/placeholder.png" width="480" height="310" alt="' . get_the_title() . '" />';
					endif;
				?>
			</a>
			<div class="pa tc cg w__100">
				<?php jas_gecko_post_meta(); ?>
				<?php jas_gecko_post_title(); ?>
				<?php jas_gecko_posted_on(); ?>
			</div>
		</div>
	<?php
		endwhile;
		wp_reset_postdata();
	?>
</div><!-- .jas-blog-slider -->