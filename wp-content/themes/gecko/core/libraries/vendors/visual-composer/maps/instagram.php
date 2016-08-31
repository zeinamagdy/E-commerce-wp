<?php
/**
 * Add element instagram for VC.
 *
 * @since   1.0.0
 * @package Gecko
 */

function jas_gecko_vc_map_instagram() {
	vc_map(
		array(
			'name'     => esc_html__( 'Instagram', 'gecko' ),
			'base'     => 'jas_instagram',
			'icon'     => 'pe-7s-share',
			'category' => esc_html__( 'Social', 'gecko' ),
			'params'   => array(
				array(
					'param_name'  => 'user_id',
					'heading'     => esc_html__( 'User ID', 'gecko' ),
					'description' => sprintf( wp_kses_post( 'Lookup User ID <a target="_blank" href="%s">here</a>', 'gecko' ), 'https://smashballoon.com/instagram-feed/find-instagram-user-id/' ),
					'type'        => 'textfield',
				),
				array(
					'param_name'  => 'access_token',
					'heading'     => esc_html__( 'Access Token', 'gecko' ),
					'description' => sprintf( wp_kses_post( 'Lookup Access Token <a target="_blank" href="%s">here</a>', 'gecko' ), 'http://instagram.pixelunion.net/' ),
					'type'        => 'textfield',
				),
				array(
					'param_name'  => 'limit',
					'heading'     => esc_html__( 'Per Page', 'gecko' ),
					'description' => esc_html__( 'How much items per page to show', 'gecko' ),
					'type'        => 'textfield',
					'value'       => 12
				),
				array(
					'param_name'  => 'columns',
					'heading'     => esc_html__( 'Columns', 'gecko' ),
					'description' => esc_html__( 'This parameter is not working if slider has enabled', 'gecko' ),
					'type'        => 'dropdown',
					'value'       => array(
						esc_html__( '2 columns', 'gecko' ) => 2,
						esc_html__( '3 columns', 'gecko' ) => 3,
						esc_html__( '4 columns', 'gecko' ) => 4,
						esc_html__( '5 columns', 'gecko' ) => 5,
						esc_html__( '6 columns', 'gecko' ) => 6,
						esc_html__( '7 columns', 'gecko' ) => 7,
						esc_html__( '8 columns', 'gecko' ) => 8,
						esc_html__( '9 columns', 'gecko' ) => 9,
						esc_html__( '10 columns', 'gecko' ) => 10,
					),
					'dependency' => array(
						'element' => 'slider',
						'value'   => 'no'
					),
				),
				array(
					'param_name' => 'gutter',
					'heading'    => esc_html__( 'Gutter Width', 'gecko' ),
					'type'       => 'textfield',
				),
				array(
					'param_name' => 'slider',
					'heading'    => esc_html__( 'Enable Slider', 'gecko' ),
					'type'       => 'dropdown',
					'value'      => array(
						esc_html__( 'No', 'gecko' )  => 'no',
						esc_html__( 'Yes', 'gecko' ) => 'yes',
					)
				),
				array(
					'param_name'  => 'items',
					'heading'     => esc_html__( 'Items (Number only)', 'gecko' ),
					'group'       => esc_html__( 'Slider Settings', 'gecko' ),
					'description' => esc_html__( 'Set the maximum amount of items displayed at a time with the widest browser width', 'gecko' ),
					'type'        => 'textfield',
					'value'       => 4,
					'dependency' => array(
						'element' => 'slider',
						'value'   => 'yes'
					),
				),
				array(
					'param_name' => 'autoplay',
					'heading'    => esc_html__( 'Enable Auto play', 'gecko' ),
					'group'      => esc_html__( 'Slider Settings', 'gecko' ),
					'type'       => 'checkbox',
					'dependency' => array(
						'element' => 'slider',
						'value'   => 'yes'
					),
				),
				array(
					'param_name' => 'arrows',
					'heading'    => esc_html__( 'Enable Navigation', 'gecko' ),
					'group'      => esc_html__( 'Slider Settings', 'gecko' ),
					'type'       => 'checkbox',
					'dependency' => array(
						'element' => 'slider',
						'value'   => 'yes'
					),
				),
				array(
					'param_name' => 'dots',
					'heading'    => esc_html__( 'Enable Pagination', 'gecko' ),
					'group'      => esc_html__( 'Slider Settings', 'gecko' ),
					'type'       => 'checkbox',
					'dependency' => array(
						'element' => 'slider',
						'value'   => 'yes'
					),
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
add_action( 'vc_before_init', 'jas_gecko_vc_map_instagram' );