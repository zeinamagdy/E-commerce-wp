<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $woocommerce, $product;

$tmp = get_post_meta( get_the_ID(), '_product_image_swatch_gallery', true );
$img = '';
if ( is_array( $tmp ) && ! empty( $tmp ) ) {
	$img = array_keys( $tmp, true );
}

// Get page options
$options = get_post_meta( get_the_ID(), '_custom_wc_options', true );

// Get product single style
$style = ( is_array( $options ) && $options['wc-single-style'] ) ? $options['wc-single-style'] : cs_get_option( 'wc-single-style' );

if ( $style == '1' || $style == '3' ) {
	$attr = '{"slidesToShow": 1,"slidesToScroll": 1,"asNavFor": ".p-nav","fade":true}';
} else {
	$attr = '{"slidesToShow": 3,"slidesToScroll": 1,"centerMode":true, "responsive":[{"breakpoint": 960,"settings":{"slidesToShow": 2, "centerMode":false}},{"breakpoint": 480,"settings":{"slidesToShow": 1, "centerMode":false}}]}';
}
?>
<div class="single-product-thumbnail pr">
	<?php if ( ! empty( $img ) && $product->is_type( 'variable' ) ) { ?>
		<div class="p-thumb-gallery"></div>
	<?php } else { ?>
	<div class="p-thumb images jas-carousel" data-slick='<?php echo esc_attr( $attr ); ?>'>
		<?php
			if ( has_post_thumbnail() ) {
				$image_caption = get_post( get_post_thumbnail_id() )->post_excerpt;
				$image_link    = wp_get_attachment_url( get_post_thumbnail_id() );
				$image         = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
					'title'	=> get_the_title( get_post_thumbnail_id() )
				) );
				$image_small   = wp_get_attachment_image_src( get_post_thumbnail_id(), 'shop_single' );

				$attachment_count = count( $product->get_gallery_attachment_ids() );

				if ( $attachment_count > 0 ) {
					$gallery = '[product-gallery]';
				} else {
					$gallery = '';
				}

				if ( cs_get_option( 'wc-single-elevate' ) ) {
					$image = '<img class="jas-image-zoom" data-zoom-image="' . esc_url( $image_link ) . '" src="' . esc_url( $image_small[0] ) . '" width="' . esc_attr( $image_small[1] ) . '" height="' . esc_attr( $image_small[2] ) . '" alt="' . get_the_title() . '" />';
				}

				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div class="p-item"><a href="%s" itemprop="image" class="zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a></div>', $image_link, $image_caption, $image ), $post->ID );

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

					$image_title   = esc_attr( get_the_title( $attachment_id ) );
					$image_caption = esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );

					$image = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_single' ), 0, $attr = array(
						'title'	=> $image_title,
						'alt'	=> $image_title
						) );

					echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<div class="p-item"><a href="%s" itemprop="image" class="zoom" title="%s" data-rel="prettyPhoto[product-gallery]">%s</a></div>', $image_link, $image_caption, $image ), $attachment_id, $post->ID );
				}
			}
		?>
	</div>
	<?php } ?>
	<?php do_action( 'woocommerce_product_thumbnails' ); ?>
	<?php if ( isset( $options ) && ! empty( $options['wc-single-video-upload'] ) || ! empty( $options['wc-single-video-url'] ) ) : ?>
		<div class="p-video pa">
			<?php
				if ( $options['wc-single-video'] == 'url' ) {
					echo '<a href="' . esc_url( $options['wc-single-video-url'] ) . '" class="br__50 tc db bghp jas-popup-url"><i class="pe-7s-play pr"></i></a>';
				} else {
					echo '<a href="#jas-vsh" class="br__50 tc db bghp jas-popup-mp4"><i class="pe-7s-play pr"></i></a>';
					echo '<div id="jas-vsh" class="mfp-hide">' . do_shortcode( '[video src="' . esc_url( $options['wc-single-video-upload'] ) . '" width="640" height="320"]' ) . '</div>';
				}
			?>
		</div>
	<?php endif; ?>
</div>