<?php
/**
 * Register the required plugins for this theme.
 *
 * @since   1.0.0
 * @package Gecko
 */
// Include the TGM_Plugin_Activation class.
include JAS_GECKO_PATH . '/core/libraries/vendors/tgmpa/class-tgmpa.php';

/**
 * Register the required plugins for this theme.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function jas_gecko_register_required_plugins() {
	$plugins = array(
        array(
            'name'     => 'JAS Addons',
            'slug'     => 'jas-addons',
            'source'   => 'http://janstudio.net/gecko/plugins/jas-addons.zip',
            'version' => '1.0.1',
            'required' => true,
        ),
		array(
			'name'     => 'Visual Composer',
			'slug'     => 'js_composer',
			'source'   => 'http://janstudio.net/gecko/plugins/js_composer.zip',
            'version' => '4.11.2.1',
            'required' => true,
		),
        array(
            'name'     => 'Gecko Sample Data',
            'slug'     => 'gecko-sample',
            'source'   => 'http://janstudio.net/gecko/plugins/gecko-sample.zip',
            'required' => true,
        ),
        array(
            'name'     => 'Open Swatch',
            'slug'     => 'openswatch',
            'source'   => 'http://janstudio.net/gecko/plugins/openswatch.zip',
        ),
		array(
			'name'   => 'Meta Slider',
			'slug'   => 'ml-slider',
			'required'  => false,
		),
		array(
            'name'      => 'YITH WooCommerce Wishlist',
            'slug'      => 'yith-woocommerce-wishlist',
            'required'  => false,
        ),
        array(
            'name'      => 'Regenerate Thumbnails',
            'slug'      => 'regenerate-thumbnails',
            'required'  => false,
            ),
        array(
            'name'      => 'Contact Form 7',
            'slug'      => 'contact-form-7',
            'required'  => false,
            ),
        array(
            'name'      => 'MailChimp',
            'slug'      => 'mailchimp-for-wp',
            'required'  => false,
            ),
        array(
            'name'      => 'YITH WooCommerce Newsletter Popup',
            'slug'      => 'yith-woocommerce-popup',
            'required'  => false,
            ),
      	array(
            'name'      => 'YITH WooCommerce Ajax Product Filter',
            'slug'      => 'yith-woocommerce-ajax-navigation',
            'required'  => false,
            ),
      	array(
            'name'      => 'YIKES Custom Product Tabs',
            'slug'      => 'yikes-inc-easy-custom-woocommerce-product-tabs',
            'required'  => false,
            ),
		array(
			'name'      => 'WooCommerce',
			'slug'      => 'woocommerce',
			'required'  => true,
		),
	);

	$config = array(
		'id'           => 'tgmpa',
		'default_path' => '',
		'menu'         => 'jas-install-plugins',
		'parent_slug'  => 'jas',
		'capability'   => 'edit_theme_options',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => true,
	);
	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'jas_gecko_register_required_plugins' );