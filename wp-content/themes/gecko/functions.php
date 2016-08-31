<?php
/**
 * Theme constants definition and functions.
 *
 * @since   1.0.0
 * @package Gecko
 */

// Constants definition
define( 'JAS_GECKO_PATH', get_template_directory()     );
define( 'JAS_GECKO_URL',  get_template_directory_uri() );

// Initialize core file
require JAS_GECKO_PATH . '/core/init.php';