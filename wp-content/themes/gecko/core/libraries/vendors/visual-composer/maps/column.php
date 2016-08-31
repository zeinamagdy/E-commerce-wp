<?php
/**
 * Custom column for visual composer.
 *
 * @since   1.0.0
 * @package Gecko
 */

function jas_gecko_vc_add_params_to_column() {
	vc_map_update( 'vc_column', array( 'icon' => 'pe-7s-graph3' ) );
	vc_add_params(
		'vc_column',
		array(
			array(
				'heading'          => esc_html__( 'Background  Position', 'gecko' ),
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
		'vc_column_inner',
		array(
			array(
				'heading'          => esc_html__( 'Background  Position', 'gecko' ),
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
add_action( 'vc_after_init', 'jas_gecko_vc_add_params_to_column' );