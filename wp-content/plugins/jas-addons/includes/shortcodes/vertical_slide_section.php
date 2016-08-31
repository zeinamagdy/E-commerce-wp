<?php
/**
 * Vertical Slide shortcode.
 *
 * @package JASAddons
 * @since   1.0.0
 */

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'jas_shortcode_vertical_slide_section' ) ) {
	function jas_shortcode_vertical_slide_section( $atts, $content = null ) {
		$output = '';

		extract( shortcode_atts( array(
			'setting' => '',
		), $atts ) );

		$classes = array( 'ms-section' );

		if ( $setting ) {
			$setting_class = vc_shortcode_custom_css_class( $setting, '' );
			$classes[]     = $setting_class;
		}

		$output .= '<div class="' . esc_attr( implode( ' ', $classes ) ) . '">';
			$output .= do_shortcode( $content );
		$output .= '</div>';

		// Return output
		return apply_filters( 'jas_shortcode_vertical_slide_section', force_balance_tags( $output ) );
	}
}