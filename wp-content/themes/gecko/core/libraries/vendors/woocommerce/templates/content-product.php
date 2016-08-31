<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $jassc;

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

// Extra post classes
$classes = array();
$classes[] = $jassc ? 'jas-col-md-' . (int) $jassc['columns'] . ' jas-col-sm-4 jas-col-xs-12 mt__30' : 'jas-col-md-' . (int) cs_get_option( 'wc-column' ) . ' jas-col-sm-4 jas-col-xs-12 mt__30';

// Get product hover style
$hover_style = $jassc ? $jassc['hover-style'] : cs_get_option( 'wc-hover-style' );
$btn_group = $hover_class = '';

if ( $hover_style == 1 ) {
	$btn_group = 'product-button pa tc';
} elseif ( $hover_style == 2 ) {
	$btn_group = 'product-button pa flex tc center-xs';
} elseif ( $hover_style == 3 ) {
	$hover_class = ' single-btn oh';
} else {
	$hover_class = ' no-btn';
}

// Countdown for sale product
$start = get_post_meta( get_the_ID(), '_sale_price_dates_from', true );
$end   = get_post_meta( get_the_ID(), '_sale_price_dates_to', true );
$now   = date( 'd-m-y' );

$attributes = $product->get_attributes();
?>
<div <?php post_class( $classes ); ?>>
	
	<div class="product-image pr<?php echo esc_attr( $hover_class ); ?>">
		<?php
			/**
			 * woocommerce_before_shop_loop_item hook.
			 *
			 * @hooked woocommerce_template_loop_product_link_open - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item' );
		?>
		<a class="db" href="<?php esc_url( the_permalink() ); ?>">
			<?php
				/**
				 * woocommerce_before_shop_loop_item_title hook.
				 *
				 * @hooked woocommerce_show_product_loop_sale_flash - 10
				 * @hooked woocommerce_template_loop_product_thumbnail - 10
				 */
				do_action( 'woocommerce_before_shop_loop_item_title' );
			?>
		</a>
		<?php
			if ( $hover_style == 3 ) {
				echo '<a class="btn-quickview pa cp bghp tc dib" href="javascript:void(0);" data-prod="' . esc_attr( $post->ID ) . '">' . esc_html__( 'Quick View', 'gecko' ) . '</a>';
			}
		?>
		<?php if ( $hover_style != 4 ) { ?>
			<div class="<?php echo esc_attr( $btn_group ); ?>">
				<?php
					/**
					 * woocommerce_after_shop_loop_item hook.
					 *
					 * @hooked woocommerce_template_loop_product_link_close - 5
					 * @hooked woocommerce_template_loop_add_to_cart - 10
					 */
					do_action( 'woocommerce_after_shop_loop_item' );
				?>
			</div><!-- .product-button -->
		<?php } ?>

		<?php if ( $hover_style == 4 ) { ?>
			<div class="product-info tc pa w__100 ts__03">
				<?php
					/**
					 * woocommerce_after_shop_loop_item_title hook.
					 *
					 * @hooked woocommerce_template_loop_rating - 5
					 * @hooked woocommerce_template_loop_price - 10
					 */
					do_action( 'woocommerce_after_shop_loop_item_title' );

					/**
					 * woocommerce_shop_loop_item_title hook.
					 *
					 * @hooked woocommerce_template_loop_product_title - 10
					 */
					do_action( 'woocommerce_shop_loop_item_title' );
				?>
			</div>
		<?php } ?>
		<?php if ( ! empty( $jassc['countdown'] ) && ( $end && date( 'd-m-y', $start ) <= $now ) ) : ?>
			<div class="product-countdown pa">
				<div class="jas-countdown flex tc" data-time='{"day": "<?php echo date( 'd', $end ); ?>", "month": "<?php echo date( 'M', $end ); ?>", "year": "<?php echo date( 'Y', $end ); ?>"}'></div>
			</div>
		<?php endif; ?>
		<?php
			$attrs = cs_get_option( 'wc-attr' );
			if ( $attrs ) {
				echo '<div class="product-attr">';
					foreach ( $attrs as $attr ) {
						$attr_op = 'pa_' . $attr;
						foreach ( $attributes as $attribute ) {
							$values = wc_get_product_terms( $product->id, $attribute['name'], array( 'fields' => 'names' ) );
							if ( $attr_op == $attribute['name'] ) {
								echo apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values );
							}
						}
					}
				echo '</div>';
			}
		?>
	</div><!-- .product-image -->

	<?php if ( $hover_style != 4 ) { ?>
		<div class="product-info tc mt__15">
			<?php
				/**
				 * woocommerce_shop_loop_item_title hook.
				 *
				 * @hooked woocommerce_template_loop_product_title - 10
				 */
				do_action( 'woocommerce_shop_loop_item_title' );

				/**
				 * woocommerce_after_shop_loop_item_title hook.
				 *
				 * @hooked woocommerce_template_loop_rating - 5
				 * @hooked woocommerce_template_loop_price - 10
				 */
				do_action( 'woocommerce_after_shop_loop_item_title' );
			?>
		</div>
	<?php } ?>
</div>
