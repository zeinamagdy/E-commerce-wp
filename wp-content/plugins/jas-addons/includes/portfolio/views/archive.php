<?php
/**
 * Portfolio archive pages.
 *
 * @package JASAddons
 * @since   1.0.0
 */

get_header(); ?>
	<div id="jas-content">
		<div class="jas-portfolio">
			<?php get_template_part( 'views/common/page', 'head' ); ?>
			
			<div class="jas-container mt__60 mb__60">
				<?php
					if ( cs_get_option( 'portfolio-number-per-page' ) ) {
						$limit = cs_get_option( 'portfolio-number-per-page' );
					} else {
						$limit = -1;
					}

					$columns = cs_get_option( 'portfolio-column' );

					$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

					// Filter portfolio post type
					$args = array(
						'post_type'      => 'portfolio',
						'post_status'    => 'publish',
						'posts_per_page' => $limit,
						'paged'          => $paged
					);

					if ( ! empty( $cat ) ) {
						$args['tax_query'] = array(
							'relation' => 'AND',
							array(
								'taxonomy' => 'portfolio_cat',
								'field'    => 'id',
								'terms'    => explode( ',', $cat )
							),
						);
					}
					$query = new WP_Query( $args );

					$i = 0;

					// Retrieve all the categories
					$filters = get_terms( 'portfolio_cat', array( 'include' => $cat ) );
				?>
				<div class="portfolio-filter jas-filter fwb tc tu mb__25">
					<a data-filter="*" class="selected dib cg chp" href="javascript:void(0);"><?php _e( 'All', 'gecko' ); ?></a>
					<?php foreach ( $filters as $cat ) : ?>
						<a data-filter=".<?php esc_attr_e( $cat->slug ); ?>" class="dib cg chp" href="javascript:void(0);"><?php esc_html_e( $cat->name ); ?></a>
					<?php endforeach; ?>
				</div>
				
				<div class="jas-row jas-masonry portfolios" data-masonry='{"selector":".portfolio-item","layoutMode":"masonry"}'>
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>
						<?php
							// Get portfolio category
							$categories = wp_get_post_terms( get_the_ID(), 'portfolio_cat' );

							$classes = array( 'jas-col-md-' . $columns . ' portfolio-item pr mb__30' );
							if ( $categories ) {
								foreach ( $categories as $category ) {
									$classes[] = "{$category->slug}";
								}
							}
							$delay = 0.00;
							$wait  = 0.15;

							$delay = $i % ( $columns * 2 ) * $wait;
						?>
						<figure id="portfolio-<?php the_ID(); ?>"  class="jas-col-sm-6 jas-col-xs-12 <?php echo esc_attr( implode( ' ', $classes ) ); ?>">
							<div class="jas-animated">
								<a href="<?php the_permalink(); ?>" class="mask db pr chp">
									<?php
										if ( has_post_thumbnail() ) :
											the_post_thumbnail();
										endif;
									?>
								</a>
								<figcaption class="pa tc ts__03">
									<h4 class="fs__14 tu mg__0"><a class="cd chp" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
									<?php
										if ( $categories ) {
											echo '<span>' . get_the_term_list( $post->ID, 'portfolio_cat', '', ', ' ) . '</span>';
										}
									?>
								</figcaption>
							</div>
						</figure>
						<?php $i++; ?>
					<?php endwhile; ?>
				</div><!-- .jas-row -->
				<?php
					echo '<div class="jas-ajax-load tc" data-load-more=\'{"page":"' . esc_attr( $query->max_num_pages ) . '","container":"portfolios","layout":"loadmore"}\'>';
						next_posts_link( __( 'Load More', 'gecko' ), $query->max_num_pages );
					echo '</div>';

					wp_reset_postdata();
				?>
			</div><!-- .jas-container -->
		</div><!-- .jas-portfolio -->
	</div><!-- #jas-content -->
<?php get_footer(); ?>