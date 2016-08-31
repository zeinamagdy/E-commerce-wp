<?php
/**
 * The heading of page.
 *
 * @since   1.0.0
 * @package Gecko
 */

// Get page options
$options = get_post_meta( get_the_ID(), '_custom_page_options', true );

if ( function_exists( 'is_woocommerce') && is_woocommerce() || function_exists( 'is_product') && is_product() || ( isset( $options['pagehead'] ) && ! $options['pagehead'] ) ) return;

if ( is_single() ) {

	echo jas_gecko_head_single();

} else {

	echo jas_gecko_head_page();

}