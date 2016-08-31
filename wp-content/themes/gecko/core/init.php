<?php
/**
 * Initialize framework and libraries.
 *
 * @since   1.0.0
 * @package Gecko
 */

// Theme options
include JAS_GECKO_PATH . '/core/admin/cs-framework.php';

// Vendor libraries
$libs = 'woocommerce, visual-composer, tgmpa, aq-resizer';
$libs = array_map( 'trim', explode( ',', $libs ) );
foreach ( $libs as $lib ) {
	include JAS_GECKO_PATH . '/core/libraries/vendors/' . $lib . '/init.php';
}

// Theme libraries
include JAS_GECKO_PATH . '/core/libraries/janstudio/hooks/action.php';
include JAS_GECKO_PATH . '/core/libraries/janstudio/hooks/filter.php';
include JAS_GECKO_PATH . '/core/libraries/janstudio/hooks/helper.php';
include JAS_GECKO_PATH . '/core/libraries/janstudio/classes/menu.php';
include JAS_GECKO_PATH . '/core/libraries/janstudio/classes/sidebar.php';