<?php
/**
 * Add element blog for visual composer.
 *
 * @since   1.0.0
 * @package Gecko
 */

function jas_gecko_vc_map_portfolio() {
	vc_map(
		array(
			'name'     => esc_html__( 'Portfolio', 'gecko' ),
			'base'     => 'jas_portfolio',
			'icon'     => 'pe-7s-photo',
			'category' => esc_html__( 'Content', 'gecko' ),
			'params'   => array(
				array(
					'param_name' => 'columns',
					'heading'    => esc_html__( 'Columns', 'gecko' ),
					'type'       => 'dropdown',
					'value' => array(
						esc_html__( '2 Columns', 'gecko' ) => '6',
						esc_html__( '3 Columns', 'gecko' ) => '4',
						esc_html__( '4 Columns', 'gecko' ) => '3',
					),
				),
				array(
					'param_name'  => 'limit',
					'heading'     => esc_html__( 'Per Page', 'gecko' ),
					'description' => esc_html__( 'How much items per page to show (-1 to show all portfolio)', 'gecko' ),
					'type'        => 'textfield',
					'value'       => 10,
				),
				array(
					'param_name' => 'filter',
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'Enable Filter?', 'gecko' ),
				),
				vc_map_add_css_animation(),
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
add_action( 'vc_before_init', 'jas_gecko_vc_map_portfolio' );