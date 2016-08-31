<?php
/**
 * The template to display woocommerce content.
 *
 * @since   1.0.0
 * @package Gecko
 */

get_header();

get_template_part( 'views/common/page', 'head' );

if ( is_singular( 'product' ) ) {
	echo '<div id="jas-content">';
		woocommerce_content();
	echo '</div>';
} else {
	wc_get_template( 'archive-product.php' );
}

get_footer();

