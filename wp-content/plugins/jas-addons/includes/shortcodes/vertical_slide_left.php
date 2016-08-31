<?php
/**
 * Vertical Slide shortcode.
 *
 * @package JASAddons
 * @since   1.0.0
 */

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'jas_shortcode_vertical_slide_left' ) ) {
	function jas_shortcode_vertical_slide_left( $atts, $content = null ) {
		$output = '';

		extract( shortcode_atts( array(), $atts ) );

		$output .= '<div class="ms-left">';
			$output .= do_shortcode( $content );
		$output .= '</div>';

		// Return output
		return apply_filters( 'jas_shortcode_vertical_slide_left', force_balance_tags( $output ) );
	}
}