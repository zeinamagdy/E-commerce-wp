<?php
/**
 * Filter hooks.
 *
 * @since   1.0.0
 * @package Gecko
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function jas_gecko_body_class( $classes ) {
	// Add class for header left
	if ( cs_get_option( 'header-layout' ) == 7 ) {
		$classes[] = 'header-lateral';
	}

	// Add class for boxed layout
	if ( cs_get_option( 'boxed' ) ) {
		$classes[] = 'boxed';
	}

	return $classes;
}
add_filter( 'body_class', 'jas_gecko_body_class' );

/**
 * Add Meta Slider.
 *
 * @since 1.0.0
 */
function jas_gecko_metaslider_hoplink( $link ) {
    return "https://getdpd.com/cart/hoplink/15318?referrer=ribje3lp1uogw48ks4";
}
add_filter( 'metaslider_hoplink', 'jas_gecko_metaslider_hoplink', 10, 1 );

/**
 * Filter portfolio limit per page.
 *
 * @since 1.0.0
 */
function jas_gecko_portfolio_per_page( $query ) {
	if ( ! is_post_type_archive( 'portfolio' ) ) return;

	// Get portfolio number per page
	$limit = cs_get_option( 'portfolio-number-per-page' );
    if ( $query->query_vars['post_type'] == 'portfolio' ) $query->query_vars['posts_per_page'] = $limit;

    return $query;
}
add_filter( 'pre_get_posts', 'jas_gecko_portfolio_per_page' );