<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK SETTINGS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$type = 'add_submenu';
$settings = array(
	'menu_title'  => esc_html__( 'Theme Options', 'gecko' ),
	'menu_parent' => 'jas',
	'menu_type'   => $type . '_page',
	'menu_slug'   => 'jas-theme-options',
	'ajax_save'   => true,
);

// Get list all menu
$menus = wp_get_nav_menus();
$menu  = array();
if ( $menus ) {
	foreach ( $menus as $key => $value ) {
		$menu[$value->term_id] = $value->name;
	}
}

// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options = array();

// ----------------------------------------
// a option section for options layout    -
// ----------------------------------------
$options[] = array(
	'name'  => 'layout',
	'title' => esc_html__( 'General Layout', 'gecko' ),
	'icon'  => 'fa fa-building-o',
	'fields' => array(
		array(
			'id'      => 'content-width',
			'type'    => 'number',
			'title'   => esc_html__( 'Content Width', 'gecko' ),
			'desc'    => esc_html__( 'Set the maximum allowed width for content', 'gecko' ),
			'after'   => ' <i class="cs-text-muted">px</i>',
			'default' => '1170'
		),
		array(
			'id'    => 'boxed',
			'type'  => 'switcher',
			'title' => esc_html__( 'Enable Boxed Layout', 'gecko' ),
		),
		array(
			'id'         => 'boxed-bg',
			'type'       => 'background',
			'title'      => esc_html__( 'Background', 'gecko' ),
			'dependency' => array( 'boxed', '==', 'true' ),
		),
		array(
			'id'    => 'breadcrumbs',
			'type'  => 'switcher',
			'title' => esc_html__( 'Enable Breadcrumbs', 'gecko' ),
			'default' => true,
		),
		array(
			'id'    => 'custom-css',
			'type'  => 'textarea',
			'title' => esc_html__( 'Custom CSS Style', 'gecko' ),
			'desc'  => esc_html__( 'Paste your CSS code here. Do not place any &lt;style&gt; tags in these areas as they are already added for your convenience', 'gecko' ),
		),
		array(
			'id'    => 'custom-js',
			'type'  => 'textarea',
			'title' => esc_html__( 'Custom JS Code', 'gecko' ),
			'desc'  => esc_html__( 'Paste your Javscript code here. You can add your Google Analytics Code here. Do not place any &lt;script&gt; tags in these areas as they are already added for your convenience.', 'gecko' ),
		),
	),
);


// ----------------------------------------
// a option section for options header    -
// ----------------------------------------
$options[] = array(
	'name'  => 'header',
	'title' => esc_html__( 'Header', 'gecko' ),
	'icon'  => 'fa fa-home',
	'fields' => array(
		array(
			'id'    => 'header-layout',
			'type'  => 'image_select',
			'title' => esc_html__( 'Layout', 'gecko' ),
			'radio' => true,
			'options' => array(
				'1' => CS_URI . '/assets/images/layout/header-1.png',
				'2' => CS_URI . '/assets/images/layout/header-2.png',
				'3' => CS_URI . '/assets/images/layout/header-3.png',
				'4' => CS_URI . '/assets/images/layout/header-4.png',
				'5' => CS_URI . '/assets/images/layout/header-5.png',
				'6' => CS_URI . '/assets/images/layout/header-6.png',
				'7' => CS_URI . '/assets/images/layout/header-7.png',
			),
			'default'    => '5',
			'attributes' => array(
				'data-depend-id' => 'header-layout',
			),
		),
		array(
			'id'         => 'header-bg',
			'type'       => 'background',
			'title'      => esc_html__( 'Background', 'gecko' ),
			'dependency' => array( 'header-layout', 'any', '6,7' ),
		),
		array(
			'id'         => 'header-sticky',
			'type'       => 'switcher',
			'title'      => esc_html__( 'Enable Header Sticky', 'gecko' ),
			'default'    => false,
			'dependency' => array( 'header-layout', '!=', 7 ),
		),
		array(
			'id'         => 'header-transparent',
			'type'       => 'switcher',
			'title'      => esc_html__( 'Enable Header Transparent', 'gecko' ),
			'default'    => false,
			'dependency' => array( 'header-layout', '!=', 7 ),
		),
		array(
			'type'    => 'subheading',
			'content' => esc_html__( 'Logo Settings', 'gecko' ),
		),
		array(
			'id'        => 'logo',
			'type'      => 'image',
			'title'     => esc_html__( 'Logo', 'gecko' ),
			'add_title' => esc_html__( 'Upload', 'gecko' ),
			'dependency' => array( 'header-transparent', '==', 'false' ),
		),
		array(
			'id'        => 'logo-retina',
			'type'      => 'image',
			'title'     => esc_html__( 'Logo Retina', 'gecko' ),
			'desc'      => esc_html__( 'Upload logo for retina devices, mobile devices', 'gecko' ),
			'add_title' => esc_html__( 'Upload', 'gecko' ),
			'dependency' => array( 'header-transparent', '==', 'false' ),
		),
		array(
			'id'         => 'logo-transparent',
			'type'       => 'image',
			'title'      => esc_html__( 'Transparent Header Logo', 'gecko' ),
			'desc'       => esc_html__( 'Add logo for transparent header layout', 'gecko' ),
			'add_title'  => esc_html__( 'Upload', 'gecko' ),
			'dependency' => array( 'header-transparent', '==', 'true' ),
		),
		array(
			'id'         => 'logo-transparent-retina',
			'type'       => 'image',
			'title'      => esc_html__( 'Transparent Header Logo Retina', 'gecko' ),
			'desc'       => esc_html__( 'Add logo for transparent header layout for retina devices, mobile devices', 'gecko' ),
			'add_title'  => esc_html__( 'Upload', 'gecko' ),
			'dependency' => array( 'header-transparent', '==', 'true' ),
		),
		array(
			'type'    => 'subheading',
			'content' => esc_html__( 'Header Top Settings', 'gecko' ),
		),
		array(
			'id'         => 'header-top-left',
			'type'       => 'textarea',
			'title'      => esc_html__( 'Header left content', 'gecko' ),
			'desc'       => esc_html__( 'HTML is allowed', 'gecko' ),
			'dependency' => array( 'header-layout', 'any', '1,2,3,4,5' ),
		),

		array(
			'id'         => 'header-top-center',
			'type'       => 'textarea',
			'title'      => esc_html__( 'Center promo text', 'gecko' ),
			'desc'       => esc_html__( 'HTML is allowed', 'gecko' ),
			'dependency' => array( 'header-layout', 'any', '1,2,3,4,5' ),
		),
		array(
			'id'    => 'header-currency',
			'type'  => 'switcher',
			'title' => esc_html__( 'Enable Currency', 'gecko' ),
			'default' => true,
		),
	),
);

// ----------------------------------------
// a option section for options footer    -
// ----------------------------------------
$options[] = array(
	'name'  => 'footer',
	'title' => esc_html__( 'Footer', 'gecko' ),
	'icon'  => 'fa fa-copyright',
	'fields' => array(
		array(
			'id'    => 'footer-layout',
			'type'  => 'image_select',
			'title' => esc_html__( 'Layout', 'gecko' ),
			'options' => array(
				'1' => CS_URI . '/assets/images/layout/footer-1.png',
				'2' => CS_URI . '/assets/images/layout/footer-2.png',
				'3' => CS_URI . '/assets/images/layout/footer-3.png',
			),
			'default' => '1'
		),
		array(
			'id'    => 'footer-bg',
			'type'  => 'background',
			'title' => esc_html__( 'Background', 'gecko' ),
		),
		array(
			'id'      => 'footer-copyright',
			'type'    => 'textarea',
			'title'   => esc_html__( 'Copyright Text', 'gecko' ),
			'desc'    => esc_html__( 'HTML is allowed', 'gecko' ),
			'default' => sprintf( wp_kses_post( 'Copyright 2016 <span class="cp">Gecko</span> all rights reserved. Powered by <a href="%s">JanStudio</a>', 'gecko' ), esc_url( home_url() ) )
		),
	),
);

// ----------------------------------------
// a option section for options woocommerce-
// ----------------------------------------
if ( class_exists( 'WooCommerce' ) ) {
	$attributes = array();
	$attributes_tax = wc_get_attribute_taxonomies();
	foreach ( $attributes_tax as $attribute ) {
		$attributes[ $attribute->attribute_name ] = $attribute->attribute_label;
	}
	$options[]  = array(
		'name'  => 'woocommerce',
		'title' => esc_html__( 'WooCommerce', 'gecko' ),
		'icon'  => 'fa fa-shopping-basket',
		'sections' => array(

			// General Setting
			array(
				'name'   => 'wc_general_setting',
				'title'  => esc_html__( 'General Setting', 'gecko' ),
				'icon'   => 'fa fa-minus',
				'fields' => array(
					array(
						'type'    => 'heading',
						'content' => esc_html__( 'General Setting', 'gecko' ),
					),
					array(
						'id'      => 'wc-page-title',
						'type'    => 'text',
						'title'   => esc_html__( 'Page Title', 'gecko' ),
						'default' => esc_html__( 'Gecko' , 'gecko' ),
					),
					array(
						'id'      => 'wc-page-desc',
						'type'    => 'textarea',
						'title'   => esc_html__( 'Description', 'gecko' ),
						'default' => esc_html__( 'Online fashion, furniture, handmade... store', 'gecko' ),
					),
					array(
						'id'    => 'wc-pagehead-bg',
						'type'  => 'background',
						'title' => esc_html__( 'Page Title Background', 'gecko' ),
					),
				)
			),

			// Sub category layout
			array(
				'name'   => 'wc_sub_cat_setting',
				'title'  => esc_html__( 'Sub Category Setting', 'gecko' ),
				'icon'   => 'fa fa-minus',
				'fields' => array(
					array(
						'type'    => 'heading',
						'content' => esc_html__( 'Sub Category', 'gecko' ),
					),
					array(
						'id'    => 'wc-sub-cat-layout',
						'type'  =>'image_select',
						'title' => esc_html__( 'Sub-Categories Layout', 'gecko' ),
						'desc'  => esc_html__( 'Display sub-categories as grid or masonry', 'gecko' ),
						'radio' => true,
						'options' => array(
							'grid'    => CS_URI . '/assets/images/layout/grid.png',
							'masonry' => CS_URI . '/assets/images/layout/masonry.png',
						),
						'default' => 'masonry'
					),
					array(
						'id'    => 'wc-sub-cat-column',
						'type'  =>'image_select',
						'title' => esc_html__( 'Columns', 'gecko' ),
						'desc'  => esc_html__( 'Display number of sub-category per row', 'gecko' ),
						'radio' => true,
						'options' => array(
							'6' => CS_URI . '/assets/images/layout/2cols.png',
							'4' => CS_URI . '/assets/images/layout/3cols.png',
							'3' => CS_URI . '/assets/images/layout/4cols.png',
						),
						'default' => '6'
					),
				)
			),

			// Product Listing Setting
			array(
				'name'   => 'wc_list_setting',
				'title'  => esc_html__( 'Product Listing Setting', 'gecko' ),
				'icon'   => 'fa fa-minus',
				'fields' => array(
					array(
						'type'    => 'heading',
						'content' => esc_html__( 'Product Listing', 'gecko' ),
					),
					array(
						'id'    => 'wc-style',
						'type'  => 'image_select',
						'title' => esc_html__( 'Style', 'gecko' ),
						'desc'  => esc_html__( 'Display product listing as grid or masonry', 'gecko' ),
						'radio' => true,
						'options' => array(
							'grid'    => CS_URI . '/assets/images/layout/grid.png',
							'masonry' => CS_URI . '/assets/images/layout/masonry.png',
						),
						'default' => 'grid',
					),
					array(
						'id'         => 'wc-pagination',
						'type'       => 'select',
						'title'      => esc_html__( 'Pagination Style', 'gecko' ),
						'options' => array(
							'number'   => esc_html__( 'Number', 'gecko' ),
							'loadmore' => esc_html__( 'Load More', 'gecko' ),
						),
						'default' => 'number'
					),
					array(
						'id'         => 'wc-scroll',
						'type'       => 'switcher',
						'title'      => esc_html__( 'Enable Infinite Scroll', 'gecko' ),
						'dependency' => array( 'wc-pagination', '==', 'loadmore' ),
						'default'	 => false,
					),
					array(
						'id'         => 'wc-filter',
						'type'       => 'switcher',
						'title'      => esc_html__( 'Enable Isotope Category Filter', 'gecko' ),
						'dependency' => array( 'wc-style_masonry', '==', true ),
						'default'	 => false,
					),
					array(
						'id'    => 'wc-column',
						'type'  =>'image_select',
						'title' => esc_html__( 'Number Of Column', 'gecko' ),
						'desc'  => esc_html__( 'Display number of product per row', 'gecko' ),
						'radio' => true,
						'options' => array(
							'6' => CS_URI . '/assets/images/layout/2cols.png',
							'4' => CS_URI . '/assets/images/layout/3cols.png',
							'3' => CS_URI . '/assets/images/layout/4cols.png',
						),
						'default' => '3'
					),
					array(
						'id'      => 'wc-number-per-page',
						'type'    => 'number',
						'title'   => esc_html__( 'Per Page', 'gecko' ),
						'desc'    => esc_html__( 'How much items per page to show (-1 to show all products)', 'gecko' ),
						'default' => '12',
					),
					array(
						'id'    => 'wc-layout',
						'type'  => 'image_select',
						'title' => esc_html__( 'Layout', 'gecko' ),
						'radio' => true,
						'options' => array(
							'left-sidebar'  => CS_URI . '/assets/images/layout/left-sidebar.png',
							'no-sidebar'    => CS_URI . '/assets/images/layout/no-sidebar.png',
							'right-sidebar' => CS_URI . '/assets/images/layout/right-sidebar.png',
						),
						'default' => 'no-sidebar'
					),
					array(
						'id'         => 'wc-sidebar',
						'type'       => 'select',
						'title'      => esc_html__( 'Select Sidebar', 'gecko' ),
						'options'    => jas_gecko_get_sidebars(),
						'dependency' => array( 'wc-layout_no-sidebar', '==', false ),
					),
					array(
						'id'    => 'wc-hover-style',
						'type'  => 'image_select',
						'title' => esc_html__( 'Hover Style', 'gecko' ),
						'radio' => true,
						'options' => array(
							'1' => CS_URI . '/assets/images/layout/hover-1.png',
							'2' => CS_URI . '/assets/images/layout/hover-2.png',
							'3' => CS_URI . '/assets/images/layout/hover-3.png',
							'4' => CS_URI . '/assets/images/layout/hover-4.png',

						),
						'default' => '1'
					),
					array(
						'id'      => 'wc-attr',
						'type'    => 'checkbox',
						'title'   => esc_html__( 'Enable Products Attribute On Product List', 'gecko' ),
						'options' => $attributes,
					),
				)
			),
			// Product Detail Setting
			array(
				'name'   => 'wc_detail_setting',
				'title'  => esc_html__( 'Product Detail Setting', 'gecko' ),
				'icon'   => 'fa fa-minus',
				'fields' => array(
					array(
						'type'    => 'heading',
						'content' => esc_html__( 'Product Detail', 'gecko' ),
					),
					array(
						'id'      => 'wc-single-style',
						'type'    => 'image_select',
						'title'   => esc_html__( 'Product Detail Style', 'gecko' ),
						'radio'   => true,
						'options' => array(
							'1' => CS_URI . '/assets/images/layout/product-1.png',
							'2' => CS_URI . '/assets/images/layout/product-2.png',
							'3' => CS_URI . '/assets/images/layout/product-3.png',
						),
						'default' => '1'
					),
					array(
						'id'      => 'wc-single-layout',
						'type'    => 'image_select',
						'title'   => esc_html__( 'Product Detail Layout', 'gecko' ),
						'radio'   => true,
						'options' => array(
							'left-sidebar'  => CS_URI . '/assets/images/layout/detail-left-sidebar.png',
							'no-sidebar'    => CS_URI . '/assets/images/layout/detail-no-sidebar.png',
							'right-sidebar' => CS_URI . '/assets/images/layout/detail-right-sidebar.png',
						),
						'default'    => 'no-sidebar',
						'dependency' => array( 'wc-single-style_1', '==', true ),
					),
					array(
						'id'         => 'wc-single-sidebar',
						'type'       => 'select',
						'title'      => esc_html__( 'Select Sidebar', 'gecko' ),
						'options'    => jas_gecko_get_sidebars(),
						'dependency' => array( 'wc-single-layout_no-sidebar', '==', false ),
					),
					array(
						'type'    => 'subheading',
						'content' => esc_html__( 'Miscellaneous', 'gecko' ),
					),
					array(
						'id'      => 'wc-single-elevate',
						'type'    => 'switcher',
						'title'   => esc_html__( 'Enable Zoom Image', 'gecko' ),
						'default' => false,
					),
					array(
						'id'    => 'wc-single-size-guide',
						'title' => esc_html__( 'Size Guide Image', 'gecko' ),
						'type'  => 'upload',
					),
					array(
						'id'    => 'wc-single-shipping-return',
						'title' => esc_html__( 'Shipping & Return Content', 'gecko' ),
						'type'  => 'textarea',
						'desc'  => esc_html__( 'HTML allowed', 'gecko' ),
					),

				)
			),

		),
	);
}

// ----------------------------------------
// a option section for options blog      -
// ----------------------------------------
$options[] = array(
	'name'  => 'blog',
	'title' => esc_html__( 'Blog', 'gecko' ),
	'icon'  => 'fa fa-file-text-o',
	'fields' => array(
		array(
			'id'    => 'blog-style',
			'type'  => 'image_select',
			'title' => esc_html__( 'Style', 'gecko' ),
			'radio' => true,
			'options' => array(
				'grid'    => CS_URI . '/assets/images/layout/grid.png',
				'masonry' => CS_URI . '/assets/images/layout/masonry.png',
			),
			'default' => 'grid'
		),
		array(
			'id'    => 'blog-masonry-column',
			'type'  =>'image_select',
			'title' => esc_html__( 'Columns', 'gecko' ),
			'desc'  => esc_html__( 'Display number of post per row', 'gecko' ),
			'radio' => true,
			'options' => array(
				'6' => CS_URI . '/assets/images/layout/2cols.png',
				'4' => CS_URI . '/assets/images/layout/3cols.png',
			),
			'default'    => '6',
			'dependency' => array( 'blog-style_masonry', '==', true ),
		),
		array(
			'id'    => 'blog-layout',
			'type'  => 'image_select',
			'title' => esc_html__( 'Layout', 'gecko' ),
			'radio' => true,
			'options' => array(
				'left-sidebar'  => CS_URI . '/assets/images/layout/left-sidebar.png',
				'no-sidebar'    => CS_URI . '/assets/images/layout/no-sidebar.png',
				'right-sidebar' => CS_URI . '/assets/images/layout/right-sidebar.png',
			),
			'default'    => 'right-sidebar',
		),
		array(
			'id'      => 'blog-latest-slider',
			'type'    => 'switcher',
			'title'   => esc_html__( 'Enable latest post slider', 'gecko' ),
			'default' => false,
		),
		array(
			'id'         => 'blog-sidebar',
			'type'       => 'select',
			'title'      => esc_html__( 'Select Sidebar', 'gecko' ),
			'options'    => jas_gecko_get_sidebars(),
			'dependency' => array( 'blog-layout_no-sidebar', '==', false ),
		),
	),
);

// ----------------------------------------
// a option section for options portfolio -
// ----------------------------------------
$options[] = array(
	'name'  => 'portfolio',
	'title' => esc_html__( 'Portfolio', 'gecko' ),
	'icon'  => 'fa fa-flask',
	'fields' => array(
		array(
			'type'    => 'heading',
			'content' => esc_html__( 'Portfolio Listing', 'gecko' ),
		),
		array(
			'id'      => 'portfolio-page-title',
			'type'    => 'text',
			'title'   => esc_html__( 'Page Title', 'gecko' ),
			'default' => esc_html__( 'Portfolio', 'gecko' ),
		),
		array(
			'id'      => 'portfolio-sub-title',
			'type'    => 'text',
			'title'   => esc_html__( 'Sub Title', 'gecko' ),
			'default' => esc_html__( 'See our recent projects', 'gecko' ),
		),
		array(
			'id'    => 'portfolio-pagehead-bg',
			'type'  => 'background',
			'title' => esc_html__( 'Page Title Background', 'gecko' ),
		),
		array(
			'id'    => 'portfolio-column',
			'type'  =>'image_select',
			'title' => esc_html__( 'Columns', 'gecko' ),
			'desc'  => esc_html__( 'Display number of post per row', 'gecko' ),
			'radio' => true,
			'options' => array(
				'6' => CS_URI . '/assets/images/layout/2cols.png',
				'4' => CS_URI . '/assets/images/layout/3cols.png',
				'3' => CS_URI . '/assets/images/layout/4cols.png',
			),
			'default' => 4,
		),
		array(
			'id'      => 'portfolio-number-per-page',
			'type'    => 'number',
			'title'   => esc_html__( 'Per Page', 'gecko' ),
			'desc'    => esc_html__( 'How much items per page to show (-1 to show all portfolio)', 'gecko' ),
			'default' => 10,
		),		
	),
);


// ----------------------------------------
// a option section for options typography-
// ----------------------------------------
$options[] = array(
	'name'  => 'typography',
	'title' => esc_html__( 'Typography', 'gecko' ),
	'icon'  => 'fa fa-font',
	'fields' => array(
		array(
			'type'    => 'subheading',
			'content' => esc_html__( 'Body Font Settings', 'gecko' ),
		),
		array(
			'id'        => 'body-font',
			'type'      => 'typography',
			'title'     => esc_html__( 'Font Family', 'gecko' ),
			'default'   => array(
				'family'  => 'Lato',
				'font'    => 'google',
				'variant' => 'regular',
			),
		),
		array(
			'id'      => 'body-font-size',
			'type'    => 'number',
			'title'   => esc_html__( 'Font Size', 'gecko' ),
			'after'   => ' <i class="cs-text-muted">px</i>',
			'default' => 14
		),
		array(
			'id'      => 'body-color',
			'type'    => 'color_picker',
			'title'   => esc_html__( 'Body Color', 'gecko' ),
			'default' => '#999',
		),
		array(
			'type'    => 'subheading',
			'content' => esc_html__( 'Heading Font Settings', 'gecko' ),
		),
		array(
			'id'        => 'heading-font',
			'type'      => 'typography',
			'title'     => esc_html__( 'Font Family', 'gecko' ),
			'default'   => array(
				'family'  => 'Montserrat',
				'font'    => 'google',
				'variant' => '400',
			),
		),
		array(
			'id'      => 'heading-color',
			'type'    => 'color_picker',
			'title'   => esc_html__( 'Heading Color', 'gecko' ),
			'default' => '#4d5959',
		),
		array(
			'id'      => 'h1-font-size',
			'type'    => 'number',
			'title'   => esc_html__( 'H1 Font Size', 'gecko' ),
			'after'   => ' <i class="cs-text-muted">px</i>',
			'default' => '48'
		),
		array(
			'id'      => 'h2-font-size',
			'type'    => 'number',
			'title'   => esc_html__( 'H2 Font Size', 'gecko' ),
			'after'   => ' <i class="cs-text-muted">px</i>',
			'default' => '36'
		),
		array(
			'id'      => 'h3-font-size',
			'type'    => 'number',
			'title'   => esc_html__( 'H3 Font Size', 'gecko' ),
			'after'   => ' <i class="cs-text-muted">px</i>',
			'default' => '24'
		),
		array(
			'id'      => 'h4-font-size',
			'type'    => 'number',
			'title'   => esc_html__( 'H4 Font Size', 'gecko' ),
			'after'   => ' <i class="cs-text-muted">px</i>',
			'default' => '21'
		),
		array(
			'id'      => 'h5-font-size',
			'type'    => 'number',
			'title'   => esc_html__( 'H5 Font Size', 'gecko' ),
			'after'   => ' <i class="cs-text-muted">px</i>',
			'default' => '18'
		),
		array(
			'id'      => 'h6-font-size',
			'type'    => 'number',
			'title'   => esc_html__( 'H6 Font Size', 'gecko' ),
			'after'   => ' <i class="cs-text-muted">px</i>',
			'default' => '16'
		),
	),
);

// ----------------------------------------
// a option section for options social    -
// ----------------------------------------
$options[] = array(
	'name'  => 'social',
	'title' => esc_html__( 'Social Network', 'gecko' ),
	'icon'  => 'fa fa-globe',
	'fields' => array(
		array(
			'id'              => 'social-network',
			'type'            => 'group',
			'title'           => esc_html__( 'Social Account', 'gecko' ),
			'button_title'    => esc_html__( 'Add New', 'gecko' ),
			'accordion_title' => esc_html__( 'Add New Social Network', 'gecko' ),
			'fields'          => array(
				array(
					'id'    => 'link',
					'type'  => 'text',
					'title' => esc_html__( 'URL', 'gecko' ),
				),
				array(
					'id'    => 'icon',
					'type'  => 'icon',
					'title' => esc_html__( 'Icon', 'gecko' ),
				),
			)
		),
	),
);

// ------------------------------
// backup                       -
// ------------------------------
$options[]   = array(
	'name'     => 'backup_section',
	'title'    => 'Backup',
	'icon'     => 'fa fa-shield',
	'fields'   => array(
		array(
			'type'    => 'notice',
			'class'   => 'warning',
			'content' => 'You can save your current options. Download a Backup and Import.',
		),
	array(
	  'type'    => 'backup',
	),
  )
);

// ----------------------------------------
// a option section for options other     -
// ----------------------------------------
$options[] = array(
	'name'  => 'other',
	'title' => esc_html__( 'Maintenance Mode', 'gecko' ),
	'icon'  => 'fa fa-power-off',
	'fields' => array(
		array(
			'id'    => 'maintenance',
			'type'  => 'switcher',
			'title' => esc_html__( 'Enable Maintenance Mode', 'gecko' ),
			'desc'  => esc_html__( 'Put your site is undergoing maintenance, only admin can see the front end', 'gecko' ),
		),
		array(
			'id'         => 'maintenance-bg',
			'type'       => 'background',
			'title'      => esc_html__( 'Background', 'gecko' ),
			'dependency' => array( 'maintenance', '==', 'true' ),
		),
		array(
			'id'         => 'maintenance-title',
			'type'       => 'text',
			'title'      => esc_html__( 'Title', 'gecko' ),
			'default'    => esc_html__( 'Coming Soon', 'gecko' ),
			'dependency' => array( 'maintenance', '==', 'true' ),
		),
		array(
			'id'         => 'maintenance-message',
			'type'       => 'wysiwyg',
			'title'      => esc_html__( 'Message', 'gecko' ),
			'default'    => esc_html__( 'Everything is almost ready for the opening', 'gecko' ),
			'dependency' => array( 'maintenance', '==', 'true' ),
		),
		array(
			'id'          => 'maintenance-date',
			'type'        => 'text',
			'title'       => esc_html__( 'Remaining Time - Date', 'gecko' ),
			'attributes'    => array(
				'placeholder' => esc_html__( '01', 'gecko' ),
				'maxlength'   => 2
			),
			'dependency'  => array( 'maintenance', '==', 'true' ),
		),
		array(
			'id'          => 'maintenance-month',
			'type'        => 'text',
			'title'       => esc_html__( 'Remaining Time - Month', 'gecko' ),
			'attributes'    => array(
				'placeholder' => esc_html__( '01', 'gecko' ),
				'maxlength'   => 2
			),
			'dependency'  => array( 'maintenance', '==', 'true' ),
		),
		array(
			'id'          => 'maintenance-year',
			'type'        => 'text',
			'title'       => esc_html__( 'Remaining Time - Year', 'gecko' ),
			'attributes'    => array(
				'placeholder' => esc_html__( '2020', 'gecko' ),
				'maxlength'   => 4
			),
			'dependency'  => array( 'maintenance', '==', 'true' ),
		),
		array(
			'id'         => 'maintenance-content',
			'type'       => 'textarea',
			'title'      => esc_html__( 'Extra Content', 'gecko' ),
			'desc'       => esc_html__( 'This content will be put at right bottom, HTML is allowed', 'gecko' ),
			'dependency' => array( 'maintenance', '==', 'true' ),
		),
	),
);

CSFramework::instance( $settings, $options );
