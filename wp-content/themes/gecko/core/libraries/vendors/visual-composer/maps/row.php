<?php
/**
 * Custom row for visual composer.
 *
 * @since   1.0.0
 * @package Gecko
 */

function jas_gecko_vc_add_params_to_row() {
	vc_remove_param( 'vc_row', 'full_width' );
	vc_map_update( 'vc_row', array( 'icon' => 'pe-7s-menu' ) );
	vc_add_params(
		'vc_row',
		array(
			array(
				'heading'     => esc_html__( 'Full width row?', 'gecko' ),
				'description' => esc_html__( 'If checked row will be set to full width.', 'gecko' ),
				'type'        => 'checkbox',
				'param_name'  => 'fullwidth',
				'weight'      => 1,
				'value'       => array(
					esc_html__( 'Yes', 'gecko' ) => 'yes'
				),
			),
			array(
				'heading'     => esc_html__( 'Wrap Content', 'gecko' ),
				'description' => esc_html__( 'Wrap content to 1170px (You can change wrapper\'s width in theme options.', 'gecko' ),
				'type'        => 'checkbox',
				'param_name'  => 'wrap',
				'weight'      => 1,
				'value'       => array(
					esc_html__( 'Yes', 'gecko' ) => 'yes'
				),
				'dependency' => array(
					'element'   => 'fullwidth',
					'not_empty' => true
				)
			),
			array(
				'heading'          => esc_html__( 'Background Position', 'gecko' ),
				'description'      => esc_html__( 'Sets the starting position of a background image.', 'gecko' ),
				'group'            => esc_html__( 'Design Options', 'gecko' ),
				'type'             => 'dropdown',
				'param_name'       => 'background_position',
				'edit_field_class' => 'vc_col-xs-6',
				'value'            => array(
					esc_html__( 'Left Top', 'gecko' )      => 'default',
					esc_html__( 'Left Center', 'gecko' )   => 'left center',
					esc_html__( 'Left Bottom', 'gecko' )   => 'left bottom',
					esc_html__( 'Right Top', 'gecko' )     => 'right top',
					esc_html__( 'Right Center', 'gecko' )  => 'right center',
					esc_html__( 'Right Bottom', 'gecko' )  => 'right bottom',
					esc_html__( 'Center Top', 'gecko' )    => 'center top',
					esc_html__( 'Center Center', 'gecko' ) => 'center center',
					esc_html__( 'Center Bottom', 'gecko' ) => 'center bottom',
				),
			),
		)
	);

	vc_add_params(
		'vc_row_inner',
		array(
			array(
				'heading'          => esc_html__( 'Background Position', 'gecko' ),
				'description'      => esc_html__( 'Sets the starting position of a background image.', 'gecko' ),
				'group'            => esc_html__( 'Design Options', 'gecko' ),
				'type'             => 'dropdown',
				'param_name'       => 'background_position',
				'edit_field_class' => 'vc_col-xs-6',
				'value'            => array(
					esc_html__( 'Left Top', 'gecko' )      => 'default',
					esc_html__( 'Left Center', 'gecko' )   => 'left center',
					esc_html__( 'Left Bottom', 'gecko' )   => 'left bottom',
					esc_html__( 'Right Top', 'gecko' )     => 'right top',
					esc_html__( 'Right Center', 'gecko' )  => 'right center',
					esc_html__( 'Right Bottom', 'gecko' )  => 'right bottom',
					esc_html__( 'Center Top', 'gecko' )    => 'center top',
					esc_html__( 'Center Center', 'gecko' ) => 'center center',
					esc_html__( 'Center Bottom', 'gecko' ) => 'center bottom',
				),
			),
		)
	);
}
add_action( 'vc_after_init', 'jas_gecko_vc_add_params_to_row' );