<?php
/**
 * Add element product for visual composer.
 *
 * @since   1.0.0
 * @package Gecko
 */

function jas_gecko_vc_map_product() {
	vc_remove_element( 'product' );
	vc_map(
		array(
			'name'        => esc_html__( 'Product', 'gecko' ),
			'description' => esc_html__( 'Show a single product by ID or SKU', 'gecko' ),
			'base'        => 'jas_product',
			'icon'        => 'pe-7s-shopbag',
			'category'    => esc_html__( 'WooCommerce', 'gecko' ),
			'params'      => array(
				array(
					'param_name' => 'hover-style',
					'heading'    => esc_html__( 'Hover Style', 'gecko' ),
					'type'       => 'dropdown',
					'value' => array(
						esc_html__( 'Style 1', 'gecko' ) => '1',
						esc_html__( 'Style 2', 'gecko' ) => '2',
						esc_html__( 'Style 3', 'gecko' ) => '3',
						esc_html__( 'Style 4', 'gecko' ) => '4',
					),
				),
				array(
					'param_name'  => 'id',
					'heading'     => esc_html__( 'Select identificator', 'gecko' ),
					'type'        => 'autocomplete',
					'description' => esc_html__( 'Input product ID or product SKU or product title to see suggestions', 'gecko' ),
				),
				array(
					'param_name' => 'sku',
					'type'       => 'hidden',
					'dependency' => array(
						'element' => 'order',
						'value'   => 'all',
					),
				),
				array(
					'param_name'  => 'countdown',
					'heading'     => esc_html__( 'Enable countdown for sale product', 'gecko' ),
					'description' => esc_html__( 'Setup sale schedule in product page first.', 'gecko' ),
					'type'        => 'checkbox',
					'edit_field_class' => 'vc_col-xs-12 vc_column pt__15',
				),
				vc_map_add_css_animation(),
				array(
					'param_name'  => 'class',
					'heading'     => esc_html__( 'Extra class name', 'gecko' ),
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'gecko' ),
					'type' 	      => 'textfield',
					'edit_field_class' => 'vc_col-xs-12 vc_column pt__15',
				),
				array(
					'param_name' => 'issc',
					'type'       => 'hidden',
					'value'      => true,
				),
			)
		)
	);
}
add_action( 'vc_before_init', 'jas_gecko_vc_map_product' );