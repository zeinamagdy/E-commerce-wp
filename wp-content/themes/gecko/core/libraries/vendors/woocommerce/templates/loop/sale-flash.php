<?php
/**
 * Product loop sale flash
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/sale-flash.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;

// Get page options
$options = get_post_meta( get_the_ID(), '_custom_wc_options', true );

$postdate      = get_the_time( 'Y-m-d' );
$postdatestamp = strtotime( $postdate );

// Get time to set new product (day(s))
$new = isset( $options['wc-single-new-arrival'] ) ? $options['wc-single-new-arrival'] : '5';

if ( ! $product->is_on_sale() && ( time() - ( 60 * 60 * 24 * (int) $new ) ) > $postdatestamp ) return;
?>
<span class="badge tu tc fs__10 ls__2">
	<?php
		if ( $product->is_on_sale() ) {
			echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale pa right db">' . esc_html__( 'Sale', 'gecko' ) . '</span>', $post, $product );
		}

		if ( ! $product->is_in_stock() ) {
			echo '<span class="sold-out pa db left">' . esc_html__( 'Sold Out', 'gecko' ) . '</span>';
		} else {
			if ( ( time() - ( 60 * 60 * 24 * $new ) ) < $postdatestamp ) {
				echo '<span class="new pa left db">' . esc_html__( 'New', 'gecko' ) . '</span>';
			}
		}
	?>
</span>
