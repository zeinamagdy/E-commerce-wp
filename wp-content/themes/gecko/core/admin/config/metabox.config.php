<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// METABOX OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options = array();

if ( isset( $_GET['post'] ) && $_GET['post'] == get_option( 'page_for_posts' ) ) return;

// -----------------------------------------
// Page Metabox Options                    -
// -----------------------------------------
$options[] = array(
	'id'        => '_custom_page_options',
	'title'     => esc_html__( 'Page Layout Options','gecko'),
	'post_type' => 'page',
	'context'   => 'normal',
	'priority'  => 'high',
	'sections'  => array(
		array(
			'name'  => 's1',
			'fields' => array(
				array(
					'id'      => 'page-layout',
					'type'    => 'image_select',
					'title'   => esc_html__( 'Page Layout', 'gecko' ),
					'radio'   => true,
					'options' => array(
						'left-sidebar'  => CS_URI . '/assets/images/layout/left-sidebar.png',
						'no-sidebar'    => CS_URI . '/assets/images/layout/no-sidebar.png',
						'right-sidebar' => CS_URI . '/assets/images/layout/right-sidebar.png',
					),
					'default' => 'no-sidebar',
				),
				array(
					'id'      => 'pagehead',
					'type'    => 'switcher',
					'title'   => esc_html__( 'Enable page title', 'gecko' ),
					'default' => true
				),
				array(
					'id'         => 'subtitle',
					'type'       => 'switcher',
					'title'      => esc_html__( 'Enable sub-title', 'gecko' ),
					'default'    => true,
					'dependency' => array( 'pagehead', '==', 'true' ),
				),
				array(
					'id'         => 'title',
					'type'       => 'text',
					'title'   		=> esc_html__( 'Sub Title', 'gecko' ),
					'attributes' => array(
						'placeholder' => esc_html__( 'Do Stuff', 'gecko' )
					),
					'dependency' => array( 'pagehead|subtitle', '==|==', 'true|true' ),
				),
			),
		),
	),
);

// -----------------------------------------
// Post Metabox Options                    -
// -----------------------------------------

// -----------------------------------------
// Product Metabox Options                    -
// -----------------------------------------
$options[] = array(
	'id'        => '_custom_wc_options',
	'title'     => esc_html__( 'Product Detail Layout Options', 'gecko'),
	'post_type' => 'product',
	'context'   => 'normal',
	'priority'  => 'high',
	'sections'  => array(
		array(
			'name'  => 's2',
			'fields' => array(
				array(
					'id'      => 'wc-single-style',
					'type'    => 'image_select',
					'title'   => esc_html__( 'Product Detail Style', 'gecko' ),
					'info'    => sprintf( __( 'Change layout for only this product. You can setup global for all product page layout at <a target="_blank" href="%1$s">here</a> (WooCommerce section).', 'gecko' ), esc_url( admin_url( 'admin.php?page=jas-theme-options' ) ) ),
					'options' => array(
						'1' => CS_URI . '/assets/images/layout/product-1.png',
						'2' => CS_URI . '/assets/images/layout/product-2.png',
						'3' => CS_URI . '/assets/images/layout/product-3.png',
					),
				),
				array(
					'id'      => 'wc-single-layout',
					'type'    => 'image_select',
					'title'   => esc_html__( 'Product Detail Layout', 'gecko' ),
					'options' => array(
						'left-sidebar'  => CS_URI . '/assets/images/layout/detail-left-sidebar.png',
						'no-sidebar'    => CS_URI . '/assets/images/layout/detail-no-sidebar.png',
						'right-sidebar' => CS_URI . '/assets/images/layout/detail-right-sidebar.png',
					),
					'default'    => 'no-sidebar',
					'dependency' => array( 'wc-single-style_1', '==', true ),
				),
				array(
					'title'	  => esc_html__( 'Video Thumbnail', 'gecko'),
					'info'    => esc_html__( 'Support Vimeo & Youtube', 'gecko'),
					'id'      => 'wc-single-video',
					'type'    => 'select',
					'options' => array(
						'url'    => esc_html__( 'Url', 'gecko' ),
						'upload' => esc_html__( 'Self Hosted', 'gecko' )					),
					'default' => 'url',
				),
				array(
					'id'         => 'wc-single-video-upload',
					'type'       => 'upload',
					'title'      => esc_html__( 'Upload Video Thumbnail', 'gecko' ),
					'dependency' => array( 'wc-single-video', '==', 'upload' ),
				),
				array(
					'id'         => 'wc-single-video-url',
					'type'       => 'text',
					'title'      => esc_html__( 'Video Thumbnail Link', 'gecko' ),
					'dependency' => array( 'wc-single-video', '==', 'url' ),
				),
				array(
					'title'   => esc_html__( 'New Arrival Product', 'gecko'),
					'id'      => 'wc-single-new-arrival',
					'type'    => 'number',
					'default' => 5,
					'info'    => esc_html__( 'Set number of days display new arrivals badge for product.', 'gecko' ),
				),
				array(
					'title' => esc_html__( 'Size Guide Image','gecko'),
					'id'    => 'wc-single-size-guide',
					'type'  => 'upload',
					'info'  => sprintf( __( 'Upload size guide image for only this product. You can use image size guide for all product at <a target="_blank" href="%1$s">here</a> (WooCommerce section).', 'gecko' ), esc_url( admin_url( 'admin.php?page=jas-theme-options' ) ) ),
				),
			),
		),
	),
);
CSFramework_Metabox::instance( $options );
