<?php
/**
 * Service shortcode.
 *
 * @package JASAddons
 * @since   1.0.0
 */

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'jas_shortcode_service' ) ) {
	function jas_shortcode_service( $atts, $content = null ) {
		$output = $icon_color_attr = $title_color_attr = $content_color_attr = '';

		extract( shortcode_atts( array(
			'icon'          => '',
			'icon_style'    => '',
			'icon_size'     => 'small',
			'icon_position' => 'tc',
			'title'         => '',
			'entry'         => '',
			'icon_color'    => '',
			'title_color'   => '',
			'content_color' => '',
			'css_animation' => '',
			'class'         => '',
		), $atts ) );

		$classes = array();

		if ( $icon_position ) {
			$classes[] = $icon_position;
		}

		if ( $icon_style ) {
			$classes[] = 'jas-icon-' . $icon_style;
		}

		if ( ! empty( $icon_color ) ) {
			$icon_color_attr = ' style="color: ' . esc_attr( $icon_color ) . ';"';
		}

		if ( ! empty( $title_color ) ) {
			$title_color_attr = ' style="color: ' . esc_attr( $title_color ) . ';"';
		}

		if ( ! empty( $content_color ) ) {
			$content_color_attr = ' style="color: ' . esc_attr( $content_color ) . ';"';
		}

		if ( '' !== $css_animation ) {
			wp_enqueue_script( 'waypoints' );
			$classes[] = 'wpb_animate_when_almost_visible wpb_' . $css_animation;
		}

		if ( ! empty( $class ) ) {
			$classes[] = $class;
		}

		$output .= '<div class="jas-service ' . esc_attr( implode( ' ', $classes ) ) . '">';
			$output .= '<div class="icon ' . esc_attr( $icon_size ) . ' cp"' . $icon_color_attr . '>';
				$output .= '<i class="' . esc_attr( $icon ) . '"></i>';
			$output .= '</div>';
			$output .= '<div class="content">';
				$output .= '<h3 class="title cp tu fs__14 mt__5 mb__25"' . $title_color_attr . '>' . $title . '</h3>';
				$output .= '<p' . $content_color_attr . '>' . $entry . '</p>';
			$output .= '</div>';
		$output .= '</div>';

		// Return output
		return apply_filters( 'jas_shortcode_service', force_balance_tags( $output ) );
	}
}