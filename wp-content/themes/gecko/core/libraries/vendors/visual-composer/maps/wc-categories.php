<?php
/**
 * Add element woocommerce categories for visual composer.
 *
 * @since   1.0.0
 * @package Gecko
 */

function jas_gecko_vc_map_wc_categories() {
	vc_remove_element( 'product_categories' );
	vc_map(
		array(
			'name'     => esc_html__( 'Product Categories', 'gecko' ),
			'base'     => 'jas_wc_categories',
			'category' => esc_html__( 'WooCommerce', 'gecko' ),
			'icon'     => 'pe-7s-shopbag',
			'params'   => array(
				array(
					'param_name' => 'columns',
					'heading'    => esc_html__( 'Columns', 'gecko' ),
					'type'       => 'dropdown',
					'value'      => array(
						esc_html__( '2 columns', 'gecko' ) => 6,
						esc_html__( '3 columns', 'gecko' ) => 4,
						esc_html__( '4 columns', 'gecko' ) => 3,
					),
					'std' => 6
				),
				array(
					'param_name'  => 'exclude',
					'heading'     => esc_html__( 'Exclude', 'gecko' ),
					'description' => esc_html__( 'Enter category id to exclude (Note: separate values by commas ",").', 'gecko' ),
					'type'        => 'textfield',
				),
				array(
					'param_name'  => 'class',
					'heading'     => esc_html__( 'Extra class name', 'gecko' ),
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'gecko' ),
					'type' 	      => 'textfield',
				),
			)
		)
	);
}
add_action( 'vc_before_init', 'jas_gecko_vc_map_wc_categories' );