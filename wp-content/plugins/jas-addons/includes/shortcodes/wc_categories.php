<?php
/**
 * Blog shortcode.
 *
 * @package JASAddons
 * @since   1.0.0
 */

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'jas_shortcode_wc_categories' ) ) {
	function jas_shortcode_wc_categories( $atts, $content = null ) {
		global $post;

		$output = '';

		extract( shortcode_atts( array(
			'columns' => 4,
			'exclude' => 3,
			'class'   => '',
		), $atts ) );

		$classes = array( 'jas-sc-wc-categories ' . $class );

		// Get product category
		$terms = get_terms( 'product_cat', array( 'hide_empty' => 0, 'exclude' => explode( ',', $exclude ) ) );

		$output .= '<div class="' . implode( ' ', $classes ) . '">';
			$output .= '<div class="jas-row jas-masonry" data-masonry=\'{"selector":".product-category", "columnWidth":".grid-sizer","layoutMode":"masonry"}\'>';
			$output .= '<div class="grid-sizer size-' . esc_attr( $columns ) . '"></div>';
			if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
				foreach ( $terms as $term ) {
					// Get category thumbnail ID
					$thumbnail_id = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );

					// Generate HTML to display category thumbnail
					$image_data = '';

					if ( $thumbnail_id ) {
						$image = wp_get_attachment_image_src( $thumbnail_id, 'full' );
					} else {
						$image[0] = wc_placeholder_img_src();
						$image[1] = $image[2] = '';
					}

					$link = get_term_link( $term->slug, 'product_cat' );

					$output .= '<div class="mt__30 pr jas-col-md-' . esc_attr( $columns ) . ' jas-col-sm-6 jas-col-xs-12 product-category">';
						$output .= '<a href="' . esc_url( $link ) . '">';
							if ( $image ) {
								$output .= '<img src="' . esc_url( $image[0] ) . '" alt="" width="' . esc_attr( $image[1] ) . '" height="' . esc_attr( $image[2] ) . '" />';
							}
						$output .= '</a>';
						$output .= '<h3>' . $term->name . '</h3>';
					$output .= '</div>';
				}
			}
			$output .= '</div>';
		$output .= '</div>';

		// Restore global product data in case this is shown inside a product post
		wc_setup_product_data( $post );

		// Return output
		return apply_filters( 'jas_shortcode_wc_categories', force_balance_tags( $output ) );
	}
}