<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.9
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Get page options
$options = get_post_meta( get_the_ID(), '_custom_wc_options', true );

// Get product single style
$style = ( is_array( $options ) && $options['wc-single-style'] ) ? $options['wc-single-style'] : cs_get_option( 'wc-single-style' );

if ( $style == '1' ) {
	$classes = 'price-stock flex between-xs middle-xs mt__10 pb__10 mb__20';
} elseif ( $style == '2' ) {
	$classes = 'price-stock mt__10 pb__10 mb__10';
} else {
	$classes = 'price-stock flex between-xs middle-xs mt__10 pb__10 mb__20';
}
?>
<div class="<?php echo esc_attr( $classes ); ?>" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
	
	<div>
		<p class="price"><?php echo wp_kses_post( $product->get_price_html() ); ?></p>

		<meta itemprop="price" content="<?php echo esc_attr( $product->get_price() ); ?>" />
		<meta itemprop="priceCurrency" content="<?php echo esc_attr( get_woocommerce_currency() ); ?>" />
		<link itemprop="availability" href="http://schema.org/<?php echo esc_attr( $product->is_in_stock() ) ? 'InStock' : 'OutOfStock'; ?>" />
	</div>
	<div class="availability">
		<?php
			if ( $product->is_in_stock() ) {
				echo '<span>' . esc_html__( 'In Stock', 'gecko' ) . '</span>';
			} else {
				echo esc_html__( 'Out of Stock', 'gecko' );
			}
		?>
	</div>

</div>
