<?php
/**
 * Variable product add to cart
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $product;

$attribute_keys    = array_keys( $attributes );
$enable_pre_select = openwatch_get_option( 'openwatch_attribute_pre_select' );

if ( ! $swatch_attrs = openwatch_get_option( 'openwatch_attribute_swatch' ) ) {
	$swatch_attrs = array();
}
$default = array();
$allow_swatch = false;
foreach( $swatch_attrs as $s ) {
	if ( $s == 1 ) {
		$allow_swatch = true;
	}
}
$openwatch_attribute_image_swatch = openwatch_get_option( 'openwatch_attribute_image_swatch' );

// Get page options
$options = get_post_meta( get_the_ID(), '_custom_wc_options', true );

// Get product single style
$style = ( is_array( $options ) && $options['wc-single-style'] ) ? $options['wc-single-style'] : cs_get_option( 'wc-single-style' );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->id ); ?>" data-product_variations="<?php echo esc_attr( json_encode( $available_variations ) ) ?>">
	<?php do_action( 'woocommerce_before_variations_form' ); ?>

	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
		<p class="stock out-of-stock"><?php _e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>
	<?php else : ?>
		<div class="variations" cellspacing="0">
			<?php foreach ( $attributes as $attribute_name => $options ) : ?>
				<div class="product-attribute">
					<h4 class="label"><label for="<?php echo sanitize_title( $attribute_name ); ?>"><?php echo wc_attribute_label( $attribute_name ); ?></label></h4>
					<div <?php if ( isset( $swatch_attrs[$attribute_name] ) && $swatch_attrs[$attribute_name] == 1 && taxonomy_exists( $attribute_name ) ) : ?>style="display: none;" <?php endif; ?>>
					<?php
						$selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) : $product->get_variation_default_attribute( $attribute_name );
						wc_dropdown_variation_attribute_options( array( 'options' => $options, 'attribute' => $attribute_name, 'product' => $product, 'selected' => $selected ) );
					?>
					</div>
					<?php
						$name = $attribute_name;
						if ( isset( $swatch_attrs[$name] ) && $swatch_attrs[$name] == 1 ) : ?>
							<div class="atttribute-value">
								<ul  id="<?php echo esc_attr( sanitize_title( $name ) ); ?>" class="swatch">
									<?php
										if ( is_array( $options ) ) {

											if ( isset( $_REQUEST[ 'attribute_' . sanitize_title( $name ) ] ) ) {
												$selected_value = $_REQUEST[ 'attribute_' . sanitize_title( $name ) ];
											} elseif ( isset( $selected_attributes[ sanitize_title( $name ) ] ) ) {
												$selected_value = $selected_attributes[ sanitize_title( $name ) ];
												$default[sanitize_title( $name )] = $selected_value;
											} else {
												$selected_value = '';
											}

											// Get terms if this is a taxonomy - ordered
											if ( taxonomy_exists( $name ) ) {
												$terms = wc_get_product_terms( $product->get_post_data()->ID, $name, array( 'fields' => 'all' ) );
												foreach ( $terms as $term ) {
													if ( ! in_array( $term->slug, $options ) ) {
														continue;
													}
													$class = ( sanitize_title( $selected_value ) == sanitize_title( $term->slug ) ) ? 'selected' : '';

													$thumbnail_id = absint( get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true ) );
													$image = ColorSwatch::getSwatchImage( $term->term_id, $product->get_post_data()->ID );
													if ( $image ) {
														$style = "background-image: url('" . esc_url( $image ) . "'); text-indent: -999em;'";
													} else {
														$style = '';
													}
													echo '<li option-value="' . esc_attr( $term->slug ) . '" data-toggle="tooltip" title="' . esc_attr( $term->name ) . '" class="swatch-item ' . esc_attr( $class ) . '  ' . esc_attr( $term->slug ) . '" ><span style="' . esc_attr( $style ) . '">' . apply_filters( 'woocommerce_variation_option_name', $term->name ) . '</span></li>';
												}
											}
										}
									?>
								</ul>
							</div>
					<?php
						endif;
						echo end( $attribute_keys ) === $attribute_name ? '<a class="reset_variations" href="#">' . __( 'Clear selection', 'woocommerce' ) . '</a>' : '';
					?>
				</div>
			<?php endforeach;?>
		</div>

		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		<div class="single_variation_wrap" style="display:none;">
			<?php
				/**
				 * woocommerce_before_single_variation Hook
				 */
				do_action( 'woocommerce_before_single_variation' );

				/**
				 * woocommerce_single_variation hook. Used to output the cart button and placeholder for variation data.
				 * @since 2.4.0
				 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
				 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
				 */
				do_action( 'woocommerce_single_variation' );

				/**
				 * woocommerce_after_single_variation Hook
				 */
				do_action( 'woocommerce_after_single_variation' );
			?>
		</div>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

	<?php endif; ?>

	<?php do_action( 'woocommerce_after_variations_form' ); ?>

	<!-- start swatch js  -->
	<script type="text/javascript">
		(function($) {
			"use strict";
			<?php if ( ! empty( $available_variations ) ) : ?>
			function swatchImage( productId, option ) {
				$.ajax({
					type: 'post',
					url: openwatch_ajax_url,
					data: {
						action: 'openwatch_swatch_images',
						product_id: productId,
						option:option
					},
					dataType: 'html',
					beforeSend:function(){
						$( '#product-' + productId + ' .p-thumb-gallery' ).addClass( 'loading' );
					},
					success:function(data){
						$( '#product-' + productId + ' .p-thumb-gallery' ).removeClass( 'loading' );
						if ( data.length > 5 ) {
							$( '#product-' + productId + ' .p-thumb-gallery' ).html( data );

							// Lightbox
							$("a.zoom").prettyPhoto({
								hook: 'data-rel',
								social_tools: false,
								theme: 'pp_woocommerce',
								horizontal_padding: 20,
								opacity: 0.8,
								deeplinking: false
							});
							$("a[data-rel^='prettyPhoto']").prettyPhoto({
								hook: 'data-rel',
								social_tools: false,
								theme: 'pp_woocommerce',
								horizontal_padding: 20,
								opacity: 0.8,
								deeplinking: false
							});

							<?php if ( $style == '1' ) : ?>
								$( '.product-attributes' ).slick({
									slidesToShow: 1,
									slidesToScroll: 1,
									fade: true,
									asNavFor: '.product-attributes-thumb'
								});
							<?php else : ?>
								$( '.product-attributes' ).slick({
									slidesToShow: 1,
									slidesToScroll: 1,
									centerMode: true,
								});
							<?php endif; ?>
							$( '.product-attributes-thumb' ).slick({
								slidesToShow: 4,
								slidesToScroll: 1,
								asNavFor: '.product-attributes',
								arrows: false,
								focusOnSelect: true
							});
						}
					}
				});
			}
			<?php endif; ?>

			$(document).ready(function(){
				<?php if(openwatch_get_option('openwatch_attribute_tooltips')): ?>
				$('[data-toggle="tooltip"]').tooltipster();
				<?php endif; ?>
				<?php if ( ! empty( $available_variations )) : ?>

				<?php if($openwatch_attribute_image_swatch != ''): ?>
				$(document).on('change','select#<?php echo esc_attr($openwatch_attribute_image_swatch); ?>',function(){
					var selected = $(this).val();
					if(selected != '')
					{
						swatchImage('<?php echo (int)$product->id; ?>',selected);
					}
				});
				<?php endif; ?>

				<?php endif; ?>

				<?php if ( ! empty( $available_variations ) && $allow_swatch ) : ?>
				var attributes = [<?php foreach ( $attributes as $name => $options ): ?> '<?php echo esc_attr( sanitize_title( $name ));?>', <?php endforeach; ?>];
				var $variation_form = $('.variations_form');
				var $product_variations = $variation_form.data( 'product_variations' );
				$('li.swatch-item').on('click touchstart', function() {
					var current = $( this );
					if ( ! current.hasClass( 'selected' ) ) {
						var value = current.attr('option-value');
						var selector_name = current.closest('ul').attr('id');
						if ( selector_name == attributes[0] ) {
							$('ul.swatch li').each(function(){
								$(this).removeClass('selected');
							});
							$variation_form.find( '.variations select' ).val( '' ).change();
							$variation_form.trigger('reset_data');

						}

						if($("select#"+selector_name).find('option[value="'+value+'"]').length > 0)
						{
							$(this).closest('ul').children('li').each(function(){
								$(this).removeClass('selected');
								$(this).removeClass('disable');
							});
							if(!$(this).hasClass('selected'))
							{
								current.addClass('selected');
								$("select#"+selector_name).val(value).change();
								$("select#"+selector_name).trigger('change');
								$variation_form.trigger( 'wc_variation_form' );
								$variation_form
									.trigger( 'woocommerce_variation_select_change' )
									.trigger( 'check_variations', [ '', false ] );
							}
						}else{
							current.addClass('disable');
						}
						<?php if($enable_pre_select): ?>
						if(selector_name == attributes[0])
						{
							var check = false;
							$('ul#'+selector_name+' li').each(function(){
								if($(this).hasClass('selected'))
								{
									check = true;
								}
							});
							if(check)
							{
								for(var i = 1;i<attributes.length;i++)
								{
									var attribute = attributes[i];
									var check = false;
									$('ul#'+attribute+' li').each(function(){
										if($(this).hasClass('selected'))
										{
											check = true;
										}
									});

									if(!check)
									{
										if($('select#'+attribute+' option').length > 1)
										{
											var value = $('select#'+attribute+' option:last-child').val();
											$('ul#'+attribute+' li[option-value="'+value+'"]').trigger('click');
											$('select#'+attribute+' option[value="'+value+'"]').prop('selected',true);
											$variation_form.trigger( 'wc_variation_form' );
											$variation_form
												.trigger( 'woocommerce_variation_select_change' )
												.trigger( 'check_variations', [ '', false ] );
										}

									}

								}
							}
						}
						<?php endif; ?>
					}
				});

				$variation_form.on('wc_variation_form', function() {
					$( this ).on( 'click', '.reset_variations', function( event ) {
						$('ul.swatch li').each(function(){
							$(this).removeClass('selected');
						});
						swatchImage('<?php echo (int)$product->id; ?>','null');
					});
				});

				$variation_form.on('reset_data',function(){
					$variation_form.find( '.variations select').each(function(){
						if($(this).val() == '')
						{
							var id = $(this).attr('id');
							$('ul#'+id+' li').removeClass('selected');
						}
					});
				});
				<?php endif; ?>
			});

		} )( jQuery );
	</script>
	<!-- end swatch js  -->
</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
