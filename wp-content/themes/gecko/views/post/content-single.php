<?php
/**
 * The template part for displaying single posts.
 * 
 * @since   1.0.0
 * @package Gecko
 */
?>
<?php do_action( 'jas_gecko_before_single_post' ); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-content">
		<?php
			the_content( sprintf(
				wp_kses_post( 'Continue reading %s', 'gecko' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) );
		?>
	</div>
</article><!-- #post-# -->
<?php do_action( 'jas_gecko_after_single_post' ); ?>