<?php
/**
 * Member shortcode.
 *
 * @package JASAddons
 * @since   1.0.0
 */

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'jas_shortcode_member' ) ) {
	function jas_shortcode_member( $atts, $content = null ) {
		$output = $icon_color_attr = $title_color_attr = $content_color_attr = '';

		extract( shortcode_atts( array(
			'avatar'        => '',
			'name'          => '',
			'job'           => '',
			'facebook'      => '',
			'twitter'       => '',
			'dribbble'      => '',
			'behance'       => '',
			'instagram'     => '',
			'linkedin'      => '',
			'tumblr'        => '',
			'pinterest'     => '',
			'googleplus'    => '',
			'css_animation' => '',
			'class'         => '',
		), $atts ) );

		$classes = array( 'jas-member tc pr' );

		if ( ! empty( $class ) ) {
			$classes[] = $class;
		}

		if ( '' !== $css_animation ) {
			wp_enqueue_script( 'waypoints' );
			$classes[] = 'wpb_animate_when_almost_visible wpb_' . $css_animation;
		}

		$channels = array(
			'facebook'    => $facebook,
			'twitter'     => $twitter,
			'linkedin'    => $linkedin,
			'dribbble'    => $dribbble,
			'behance'     => $behance,
			'instagram'   => $instagram,
			'pinterest'   => $pinterest,
			'tumblr'      => $tumblr,
			'google-plus' => $googleplus,
		);

		$output .= '<div class="' . esc_attr( implode( ' ', $classes ) ) . '">';
			if ( ! empty( $avatar ) ) {
				$img_id = preg_replace( '/[^\d]/', '', $avatar );
				$image  = wpb_getImageBySize( array( 'attach_id' => $img_id ) );

				$output .= '<img src="' . esc_url( $image['p_img_large'][0] ) . '" width="' . esc_attr( $image['p_img_large'][1] ) . '" height="' . esc_attr( $image['p_img_large'][2] ) . '" alt="' . esc_attr( $name ) . '" />';
			}
			$output .= '<h4 class="tu fs__14">' . esc_html( $name ) . '</h4>';
			$output .= '<span>' . esc_html( $job ) . '</span>';
			$output .= '<div class="social pa w__100 ts__03">';
				foreach ( $channels as $key => $value ) {
					if ( ! empty( $value ) ) {
						$output .= '<a class="' . esc_attr( $key ) . '" href="' . esc_url( $value ) . '" target="_blank"><i class="fa fa-' . esc_attr( $key ) . '"></a></a>';
					}
				}
			$output .= '</div>';
		$output .= '</div>';

		// Return output
		return apply_filters( 'jas_shortcode_member', force_balance_tags( $output ) );
	}
}