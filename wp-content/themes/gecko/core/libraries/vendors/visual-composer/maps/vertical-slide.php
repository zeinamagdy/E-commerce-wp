<?php
/**
 * Add element vertical slide for VC.
 *
 * @since   1.0.0
 * @package Gecko
 */

function jas_gecko_vc_map_vertical_slide() {
	vc_map(
		array(
			'name'      => esc_html__( 'Vertical Slide', 'gecko' ),
			'base'      => 'jas_vertical_slide',
			'icon'      => 'pe-7s-map',
			'category'  => esc_html__( 'Content', 'gecko' ),
			'as_parent' => array( 'only' => 'jas_vertical_slide_left, jas_vertical_slide_right' ),
			'js_view'   => 'VcColumnView',
			'show_settings_on_create' => true,
			'params'   => array(
				array(
					'param_name'  => 'speed',
					'heading'     => esc_html__( 'Speed', 'gecko' ),
					'description' => esc_html__( 'Number Only (ms)', 'gecko' ),
					'type'        => 'textfield',
					'value'       => 700
				),
				array(
					'param_name' => 'navigation',
					'heading'    => esc_html__( 'Enable Navigation', 'gecko' ),
					'type'       => 'checkbox',
				),
				array(
					'param_name' => 'navigation_position',
					'heading'    => esc_html__( 'Navigation Position', 'gecko' ),
					'type'       => 'dropdown',
					'value' => array(
						esc_html__( 'Left', 'gecko' )  => 'left',
						esc_html__( 'Right', 'gecko' ) => 'right',
					),
					'dependency' => array(
						'element' => 'navigation',
						'value'   => 'true'
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

	vc_map(
		array(
			'name'      => esc_html__( 'Content Left', 'gecko' ),
			'base'      => 'jas_vertical_slide_left',
			'icon'      => 'pe-7s-angle-left-circle',
			'category'  => esc_html__( 'Content', 'gecko' ),
			'as_child'  => array( 'only' => 'jas_vertical_slide' ),
			'as_parent' => array( 'only' => 'jas_vertical_slide_section' ),
			'js_view'   => 'VcColumnView',
			'show_settings_on_create' => false,
			'params'    => array()
		)
	);

	vc_map(
		array(
			'name'      => esc_html__( 'Content Right', 'gecko' ),
			'base'      => 'jas_vertical_slide_right',
			'icon'      => 'pe-7s-angle-right-circle',
			'category'  => esc_html__( 'Content', 'gecko' ),
			'as_child'  => array( 'only' => 'jas_vertical_slide' ),
			'as_parent' => array( 'only' => 'jas_vertical_slide_section' ),
			'js_view'   => 'VcColumnView',
			'show_settings_on_create' => false,
			'params'    => array()
		)
	);

	vc_map(
		array(
			'name'      => esc_html__( 'Section', 'gecko' ),
			'base'      => 'jas_vertical_slide_section',
			'icon'      => 'pe-7s-menu',
			'category'  => esc_html__( 'Content', 'gecko' ),
			'as_child'  => array( 'only' => 'jas_vertical_slide_left, jas_vertical_slide_right' ),
			'as_parent' => array( 'only' => 'vc_row, vc_column_text, vc_single_image, vc_custom_heading, vc_raw_html, vc_empty_space, jas_product, jas_products, jas_google_maps' ),
			'js_view'   => 'VcColumnView',
			'show_settings_on_create' => false,
			'params'    => array(
				array(
					'param_name' => 'setting',
					'type'       => 'css_editor',
				),
			),
		)
	);
}
add_action( 'vc_before_init', 'jas_gecko_vc_map_vertical_slide' );
class WPBakeryShortCode_Jas_Vertical_Slide extends WPBakeryShortCodesContainer {}
class WPBakeryShortCode_Jas_Vertical_Slide_Left extends WPBakeryShortCodesContainer {}
class WPBakeryShortCode_Jas_Vertical_Slide_Right extends WPBakeryShortCodesContainer {}
class WPBakeryShortCode_Jas_Vertical_Slide_Section extends WPBakeryShortCodesContainer {}