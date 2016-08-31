<?php
/**
 * The template for displaying product content in the content-quickview-product.php template
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $quickview;
$quickview = true;
?>
<div class="product-quickview pr">
	<div class="jas-row">
		<div class="jas-col-md-7 jas-col-sm-7 jas-col-xs-12 pr">
			<div class="p-thumb images jas-carousel" data-slick='{"slidesToShow": 1,"slidesToScroll": 1,"dots": true,"fade":true}'>
				<?php
					if ( has_post_thumbnail() ) {
						$image_caption = get_post( get_post_thumbnail_id() )->post_excerpt;
						$image_link    = wp_get_attachment_url( get_post_thumbnail_id() );
						$image         = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
							'title'	=> get_the_title( get_post_thumbnail_id() )
						) );

						$attachment_count = count( $product->get_gallery_attachment_ids() );

						if ( $attachment_count > 0 ) {
							$gallery = '[product-gallery]';
						} else {
							$gallery = '';
						}

						echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div><a href="%s" itemprop="image"  title="%s">%s</a></div>', $image_link, $image_caption, $image ), $post->ID );

					} else {
						echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'gecko' ) ), $post->ID );
					}

					$attachment_ids = $product->get_gallery_attachment_ids();

					if ( $attachment_ids ) {
						$loop = 0;
						foreach ( $attachment_ids as $attachment_id ) {
							$image_link = wp_get_attachment_url( $attachment_id );
							if ( ! $image_link )
								continue;

							$image_title 	= esc_attr( get_the_title( $attachment_id ) );
							$image_caption 	= esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );

							$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_single' ), 0, $attr = array(
								'title'	=> $image_title,
								'alt'	=> $image_title
								) );

							echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<div><a href="%s" itemprop="image" title="%s">%s</a></div>', $image_link, $image_caption, $image ), $attachment_id, $post->ID );
						}
					}
				?>
			</div>
		</div><!-- .jas-col-md-6 -->
		
		<div class="jas-col-md-5 jas-col-sm-5 jas-col-xs-12">
			<div class="content-quickview entry-summary">
				<?php
					/**
					 * woocommerce_single_product_summary hook
					 *
					 * @hooked woocommerce_template_single_title - 5
					 * @hooked woocommerce_template_single_rating - 10
					 * @hooked woocommerce_template_single_price - 10
					 * @hooked woocommerce_template_single_excerpt - 20
					 * @hooked woocommerce_template_single_add_to_cart - 30
					 * @hooked woocommerce_template_single_meta - 40
					 * @hooked woocommerce_template_single_sharing - 50
					 */
					do_action( 'woocommerce_single_product_summary' );
				?>
			</div><!-- .summary -->
		</div><!-- .jas-col-md-6 -->
	</div><!-- .row -->
</div><!-- .product-quickview -->