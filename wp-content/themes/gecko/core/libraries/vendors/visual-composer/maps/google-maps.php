<?php
/**
 * Add element google map for visual composer.
 *
 * @since   1.0.0
 * @package Gecko
 */

function jas_gecko_vc_map_google_map() {
	vc_remove_element( 'vc_gmaps' );
	vc_map(
		array(
			'base'            => 'jas_google_maps',
			'name'            => esc_html__( 'Google Maps', 'gecko' ),
			'icon'            => 'pe-7s-map-marker',
			'category'        => esc_html__( 'Content', 'gecko' ),
			'content_element' => true,
			'params'          => array(
				array(
					'param_name'       => 'address',
					'heading'          => esc_html__( 'Address', 'gecko' ),
					'type'             => 'textfield',
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					'param_name'       => 'z',
					'heading'          => esc_html__( 'Zoom Level ( 0 -> 20 )', 'gecko' ),
					'type'             => 'textfield',
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					'param_name'       => 'lat',
					'heading'          => esc_html__( 'Latitude', 'gecko' ),
					'type'             => 'textfield',
					'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				),
				array(
					'param_name'       => 'lon',
					'heading'          => esc_html__( 'Longitude', 'gecko' ),
					'type'             => 'textfield',
					'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				),
				array(
					'param_name'       => 'w',
					'heading'          => esc_html__( 'Width', 'gecko' ),
					'description'      => esc_html__( 'Numeric value only, Unit is Pixel.', 'gecko' ),
					'type'             => 'textfield',
					'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
				),
				array(
					'param_name'       => 'h',
					'heading'          => esc_html__( 'Height', 'gecko' ),
					'description'      => esc_html__( 'Numeric value only, Unit is Pixel.', 'gecko' ),
					'type'             => 'textfield',
					'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding vc_column',
				),
				array(
					'param_name' => 'marker',
					'heading'    => esc_html__( 'Marker', 'gecko' ),
					'type'       => 'checkbox',
					'edit_field_class' => 'vc_col-sm-12 vc_column',
					'dependency' => array(
						'element'   => 'address',
						'not_empty' => true,
					),
				),
				array(
					'param_name'  => 'markerimage',
					'heading'     => esc_html__( 'Marker Image', 'gecko' ),
					'description' => esc_html__( 'Change default Marker.', 'gecko' ),
					'type'        => 'attach_image',
					'dependency' => array(
						'element' => 'marker',
						'value'   => array( 'true' ),
					),
				),
				array(
					'param_name'  => 'infowindow',
					'heading'     => esc_html__( 'Content Info Map', 'gecko' ),
					'description' => esc_html__( 'Strong, br are accepted.', 'gecko' ),
					'type'        => 'textfield',
					'dependency' => array(
						'element' => 'marker',
						'value'   => array( 'true' ),
					),
				),
				array(
					'param_name' => 'infowindowdefault',
					'heading'    => esc_html__( 'Show content info map', 'gecko' ),
					'type'       => 'checkbox',
					'value'      => array(
						'' => 'true',
					),
					'dependency' => array(
						'element' => 'marker',
						'value'   => array( 'true' ),
					),
				),
				array(
					'param_name' => 'traffic',
					'heading'    => esc_html__( 'Show Traffic', 'gecko' ),
					'type'       => 'checkbox',
					'value'      => array(
						'' => 'true',
					)
				),
				array(
					'param_name' => 'draggable',
					'heading'    => esc_html__( 'Draggable', 'gecko' ),
					'type'       => 'checkbox',
					'value'      => array(
						'' => 'true',
					),
					'dependency' => array(
						'element' => 'marker',
						'value'   => array( 'true' ),
					),
				),
				array(
					'param_name' => 'hidecontrols',
					'heading'    => esc_html__( 'Hide Control', 'gecko' ),
					'type'       => 'checkbox',
					'value'      => array(
						'' => 'true',
					)
				),
				array(
					'param_name' => 'scrollwheel',
					'heading'    => esc_html__( 'Scroll wheel zooming', 'gecko' ),
					'type'       => 'checkbox',
					'value'      => array(
						'' => 'true',
					)
				),
				array(
					'param_name' => 'maptype',
					'heading'    => esc_html__( 'Map Type', 'gecko' ),
					'type'       => 'dropdown',
					'value'      => array(
						esc_html__( 'ROADMAP', 'gecko' ) => 'ROADMAP',
						esc_html__( 'SATELLITE', 'gecko' ) => 'SATELLITE',
						esc_html__( 'HYBRID', 'gecko' ) => 'HYBRID',
						esc_html__( 'TERRAIN', 'gecko' ) => 'TERRAIN',
					),
				),
				array(
					'param_name' => 'mapstyle',
					'heading'    => esc_html__( 'Map style', 'gecko' ),
					'type'       => 'dropdown',
					'value'      => array(
						esc_html__( 'None', 'gecko' ) => '',
						esc_html__( 'Subtle Grayscale', 'gecko' ) => 'grayscale',
						esc_html__( 'Blue water', 'gecko' ) => 'blue_water',
						esc_html__( 'Pale Dawn', 'gecko' ) => 'pale_dawn',
						esc_html__( 'Shades of Grey', 'gecko' ) => 'shades_of_grey',
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
add_action( 'vc_before_init', 'jas_gecko_vc_map_google_map' );