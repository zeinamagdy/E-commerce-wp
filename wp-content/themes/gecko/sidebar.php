<?php
/**
 * The sidebar containing the main widget area.
 *
 * @since   1.0.0
 * @package Gecko
 */
// Get all sidebars
$sidebar = cs_get_option( 'blog-sidebar' );

echo '<div class="sidebar mt__60 mb__60" role="complementary">';
	if ( is_active_sidebar( $sidebar ) ) {
		dynamic_sidebar( $sidebar );
	} elseif ( is_active_sidebar( 'primary-sidebar' ) ) {
		dynamic_sidebar( 'primary-sidebar' );
	}
echo '</div>';