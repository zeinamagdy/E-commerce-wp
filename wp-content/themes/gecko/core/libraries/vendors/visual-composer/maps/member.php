<?php
/**
 * Add element member for VC.
 *
 * @since   1.0.0
 * @package Gecko
 */

function jas_gecko_vc_map_member() {
	vc_map(
		array(
			'name'     => esc_html__( 'Member', 'gecko' ),
			'base'     => 'jas_member',
			'icon'     => 'pe-7s-id',
			'category' => esc_html__( 'Content', 'gecko' ),
			'params'   => array(
				array(
					'param_name' => 'avatar',
					'heading'    => esc_html__( 'Avatar', 'gecko' ),
					'type'       => 'attach_image',
				),
				array(
					'param_name' => 'name',
					'heading'    => esc_html__( 'Name', 'gecko' ),
					'type'       => 'textfield',
				),
				array(
					'param_name' => 'job',
					'heading'    => esc_html__( 'Job', 'gecko' ),
					'type'       => 'textfield',
				),
				array(
					'param_name' => 'facebook',
					'heading'    => esc_html__( 'Facebook Link', 'gecko' ),
					'type'       => 'textfield',
					'group'      => esc_html__( 'Social Network', 'gecko' ),
				),
				array(
					'param_name' => 'twitter',
					'heading'    => esc_html__( 'Twitter Link', 'gecko' ),
					'type'       => 'textfield',
					'group'      => esc_html__( 'Social Network', 'gecko' ),
				),
				array(
					'param_name' => 'dribbble',
					'heading'    => esc_html__( 'Dribbble Link', 'gecko' ),
					'type'       => 'textfield',
					'group'      => esc_html__( 'Social Network', 'gecko' ),
				),
				array(
					'param_name' => 'behance',
					'heading'    => esc_html__( 'Behance Link', 'gecko' ),
					'type'       => 'textfield',
					'group'      => esc_html__( 'Social Network', 'gecko' ),
				),
				array(
					'param_name' => 'linkedin',
					'heading'    => esc_html__( 'Linkedin Link', 'gecko' ),
					'type'       => 'textfield',
					'group'      => esc_html__( 'Social Network', 'gecko' ),
				),
				array(
					'param_name' => 'tumblr',
					'heading'    => esc_html__( 'Tumblr Link', 'gecko' ),
					'type'       => 'textfield',
					'group'      => esc_html__( 'Social Network', 'gecko' ),
				),
				array(
					'param_name' => 'pinterest',
					'heading'    => esc_html__( 'Pinterest Link', 'gecko' ),
					'type'       => 'textfield',
					'group'      => esc_html__( 'Social Network', 'gecko' ),
				),
				array(
					'param_name' => 'googleplus',
					'heading'    => esc_html__( 'Google Plus Link', 'gecko' ),
					'type'       => 'textfield',
					'group'      => esc_html__( 'Social Network', 'gecko' ),
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
add_action( 'vc_before_init', 'jas_gecko_vc_map_member' );