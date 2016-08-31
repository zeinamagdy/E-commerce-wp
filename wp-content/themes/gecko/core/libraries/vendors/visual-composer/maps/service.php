<?php
/**
 * Add element service for VC.
 *
 * @since   1.0.0
 * @package Gecko
 */

function jas_gecko_vc_map_service() {
	vc_map(
		array(
			'name'     => esc_html__( 'Service', 'gecko' ),
			'base'     => 'jas_service',
			'icon'     => 'pe-7s-display2',
			'category' => esc_html__( 'Content', 'gecko' ),
			'params'   => array(
				array(
					'param_name' => 'icon',
					'heading'    => esc_html__( 'Icon', 'gecko' ),
					'type'       => 'iconpicker',
					'settings'   => array(
						'emptyIcon'    => true,
						'iconsPerPage' => 4000,
						'type'         => 'stroke'
					) ,
				),
				array(
					'param_name' => 'icon_style',
					'heading'    => esc_html__( 'Icon Style', 'gecko' ),
					'type'       => 'dropdown',
					'value' => array(
						esc_html__( 'Default', 'gecko' ) => '',
						esc_html__( 'Square', 'gecko' )  => 'square',
						esc_html__( 'Circle', 'gecko' )  => 'circle',
					),
				),
				array(
					'param_name' => 'icon_size',
					'heading'    => esc_html__( 'Icon Size', 'gecko' ),
					'type'       => 'dropdown',
					'value' => array(
						esc_html__( 'Small', 'gecko' )  => 'small',
						esc_html__( 'Medium', 'gecko' ) => 'medium',
						esc_html__( 'Large', 'gecko' )  => 'large',
					),
				),
				array(
					'param_name' => 'icon_position',
					'heading'    => esc_html__( 'Icon Position', 'gecko' ),
					'type'       => 'dropdown',
					'value' => array(
						esc_html__( 'Top', 'gecko' )   => 'tc',
						esc_html__( 'Right', 'gecko' ) => 'tr',
						esc_html__( 'Left', 'gecko' )  => 'tl',
					),
				),
				array(
					'param_name' => 'title',
					'heading'    => esc_html__( 'Title', 'gecko' ),
					'type'       => 'textfield',
				),
				array(
					'param_name' => 'entry',
					'heading'    => esc_html__( 'Content', 'gecko' ),
					'type'       => 'textarea',
				),
				array(
					'param_name'       => 'icon_color',
					'heading'          => esc_html__( 'Icon Color', 'gecko' ),
					'type'             => 'colorpicker',
					'edit_field_class' => 'vc_col-sm-4 vc_column',
				),
				array(
					'param_name'       => 'title_color',
					'heading'          => esc_html__( 'Title Color', 'gecko' ),
					'type'             => 'colorpicker',
					'edit_field_class' => 'vc_col-sm-4 vc_column',
				),
				array(
					'param_name'       => 'content_color',
					'heading'          => esc_html__( 'Content Color', 'gecko' ),
					'type'             => 'colorpicker',
					'edit_field_class' => 'vc_col-sm-4 vc_column',
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
add_action( 'vc_before_init', 'jas_gecko_vc_map_service' );