<?php
/**
 * The template for displaying search results pages.
 *
 * @since   1.0.0
 * @package Gecko
 */
get_header();
?>
<div id="jas-content">
	<?php get_template_part( 'views/common/page', 'head' ); ?>
	
	<div class="jas-container">
		<div class="jas-row jas-page">
			<div class="jas-col-md-8 jas-col-md-offset-2 mt__60" role="main">
				<?php
					if ( have_posts() ) :
						while ( have_posts() ) : the_post();
							get_template_part( 'views/post/content' );
						endwhile;

						jas_gecko_pagination();

						// If no content, include the "No posts found" template.
					else :
						get_template_part( 'views/post/content', 'none' );
					endif;
				?>
			</div><!-- $classes -->
		</div><!-- .jas-row -->
	</div>
</div><!-- #jas-content -->
<?php get_footer();