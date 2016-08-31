<?php
/**
 * Add element blog for visual composer.
 *
 * @since   1.0.0
 * @package Gecko
 */

function jas_gecko_vc_map_blog() {
	vc_map(
		array(
			'name'        => esc_html__( 'Blog', 'gecko' ),
			'description' => esc_html__( 'Show blog post by ID or title', 'gecko' ),
			'base'        => 'jas_blog',
			'icon'        => 'pe-7s-news-paper',
			'category'    => esc_html__( 'Content', 'gecko' ),
			'params'      => array(
				array(
					'param_name'  => 'id',
					'heading'     => esc_html__( 'Include special posts', 'gecko' ),
					'description' => esc_html__( 'Enter posts title to display only those records.', 'gecko' ),
					'type'        => 'autocomplete',
					'settings'    => array(
						'multiple'      => true,
						'sortable'      => true,
						'unique_values' => true,
					),
				),
				array(
					'param_name' => 'columns',
					'heading'    => esc_html__( 'Columns', 'gecko' ),
					'type'       => 'dropdown',
					'value'      => array(
						esc_html__( '2 columns', 'gecko' ) => '6',
						esc_html__( '3 columns', 'gecko' ) => '4',
						esc_html__( '4 columns', 'gecko' ) => '3',
					),
					'std' => '4',
				),
				array(
					'param_name'  => 'limit',
					'heading'     => esc_html__( 'Per Page', 'gecko' ),
					'description' => esc_html__( 'How much items per page to show (-1 to show all posts)', 'gecko' ),
					'type'        => 'textfield',
					'value'       => 3,
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
add_action( 'vc_before_init', 'jas_gecko_vc_map_blog' );