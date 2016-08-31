<?php
/**
 * Vertical Slide shortcode.
 *
 * @package JASAddons
 * @since   1.0.0
 */

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'jas_shortcode_vertical_slide' ) ) {
	function jas_shortcode_vertical_slide( $atts, $content = null ) {
		$output = $data = '';

		extract( shortcode_atts( array(
			'speed'               => 7000,
			'navigation'          => '',
			'navigation_position' => 'left',
			'class'               => '',
		), $atts ) );

		$classes = array( 'jas-vertical-slide' );

		$attr = array();

		if ( ! empty( $speed ) ) {
			$attr[] = '"speed": "' . ( int ) $speed . '"';
		}
		if ( $navigation ) {
			$attr[] = '"navigation": "true"';

			if ( $navigation_position ) {
				$attr[] = '"navigationPosition": "' . $navigation_position . '"';
			}
		}

		if ( ! empty( $attr ) ) {
			$data = 'data-slide=\'{' . esc_attr( implode( ', ', $attr ) ) . '}\'';
		}

		$output .= '<div class="' . esc_attr( implode( ', ', $classes ) ) . '" ' . $data . '>';
			$output .= do_shortcode( $content );
		$output .= '</div>';

		// Return output
		return apply_filters( 'jas_shortcode_vertical_slide', force_balance_tags( $output ) );
	}
}