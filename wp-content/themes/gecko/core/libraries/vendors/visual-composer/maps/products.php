<?php
/**
 * Add element product list for visual composer.
 *
 * @since   1.0.0
 * @package Gecko
 */

function jas_gecko_vc_map_products() {
	vc_remove_element( 'products' );
	vc_remove_element( 'recent_products' );
	vc_remove_element( 'featured_products' );
	vc_remove_element( 'product_category' );
	vc_remove_element( 'sale_products' );
	vc_remove_element( 'best_selling_products' );
	vc_remove_element( 'top_rated_products' );
	vc_remove_element( 'product_attribute' );

	// Get all terms of woocommerce
	$product_cat = array();
	$terms = get_terms( 'product_cat' );
	if ( $terms && ! isset( $terms->errors ) ) {
		foreach ( $terms as $key => $value ) {
			$product_cat[$value->name] = $value->term_id;
		}
	}
	vc_map(
		array(
			'name'        => esc_html__( 'Products', 'gecko' ),
			'description' => esc_html__( 'Show multiple products by ID or SKU.', 'gecko' ),
			'base'        => 'jas_products',
			'icon'        => 'pe-7s-shopbag',
			'category'    => esc_html__( 'WooCommerce', 'gecko' ),
			'params'      => array(
				array(
					'param_name' => 'style',
					'heading'    => esc_html__( 'List product style', 'gecko' ),
					'type'       => 'dropdown',
					'value' => array(
						esc_html__( 'Grid', 'gecko' )    => 'grid',
						esc_html__( 'Masonry', 'gecko' ) => 'masonry',
					),
				),
				array(
					'param_name' => 'hover-style',
					'heading'    => esc_html__( 'Hover Style', 'gecko' ),
					'type'       => 'dropdown',
					'value' => array(
						esc_html__( 'Style 1', 'gecko' ) => 1,
						esc_html__( 'Style 2', 'gecko' ) => 2,
						esc_html__( 'Style 3', 'gecko' ) => 3,
						esc_html__( 'Style 4', 'gecko' ) => 4,
					),
					'edit_field_class' => 'vc_col-xs-6 vc_column pt__15',
				),
				array(
					'param_name' => 'display',
					'heading'    => esc_html__( 'Display', 'gecko' ),
					'type' 	     => 'dropdown',
					'value'      => array(
						esc_html__( 'All products', 'gecko' ) 		   => 'all',
						esc_html__( 'Recent products', 'gecko' ) 	   => 'recent',
						esc_html__( 'Featured products', 'gecko' ) 	   => 'featured',
						esc_html__( 'Sale products', 'gecko' ) 		   => 'sale',
						esc_html__( 'Best selling products', 'gecko' ) => 'selling',
						esc_html__( 'Top Rated Products', 'gecko' )    => 'rated',
						esc_html__( 'Products by category', 'gecko' )  => 'cat',
					),
					'edit_field_class' => 'vc_col-xs-6 vc_column pt__15',
				),
				array(
					'param_name'  => 'orderby',
					'heading'     => esc_html__( 'Order By', 'gecko' ),
					'description' => sprintf( wp_kses_post( 'Select how to sort retrieved products. More at %s. Default by Title', 'gecko' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
					'type'        => 'dropdown',
					'value'       => array(
						esc_html__( 'Title', 'gecko' )         => 'title',
						esc_html__( 'Date', 'gecko' )          => 'date',
						esc_html__( 'ID', 'gecko' )            => 'ID',
						esc_html__( 'Author', 'gecko' )        => 'author',
						esc_html__( 'Modified', 'gecko' )      => 'modified',
						esc_html__( 'Random', 'gecko' )        => 'rand',
						esc_html__( 'Comment count', 'gecko' ) => 'comment_count',
						esc_html__( 'Menu order', 'gecko' )    => 'menu_order',
					),
					'dependency'  => array(
						'element' => 'display',
						'value' => array( 'all', 'featured', 'sale', 'rated', 'cat' ),
					),
					'edit_field_class' => 'vc_col-xs-6 vc_column pt__15',
				),
				array(
					'param_name'  => 'order',
					'heading'     => esc_html__( 'Order', 'gecko' ),
					'description' => sprintf( __( 'Designates the ascending or descending order. More at %s. Default by ASC', 'gecko' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
					'type'        => 'dropdown',
					'value'       => array(
						esc_html__( 'Ascending', 'gecko' ) => 'ASC',
						esc_html__( 'Descending', 'gecko' ) => 'DESC',
					),
					'dependency' => array(
						'element' => 'display',
						'value'   => array( 'all', 'featured', 'sale', 'rated', 'cat' ),
					),
					'edit_field_class' => 'vc_col-xs-6 vc_column pt__15',
				),
				array(
					'param_name'  => 'id',
					'heading'     => esc_html__( 'Products', 'gecko' ),
					'description' => esc_html__( 'Input product ID or product SKU or product title to see suggestions', 'gecko' ),
					'type'        => 'autocomplete',
					'settings'    => array(
						'multiple'      => true,
						'sortable'      => true,
						'unique_values' => true,
					),
					'save_always' => true,
					'dependency'  => array(
						'element' => 'display',
						'value'   => 'all',
					),
				),
				array(
					'param_name' => 'sku',
					'type'       => 'hidden',
					'dependency' => array(
						'element' => 'display',
						'value'   => 'all',
					),
				),
				array(
					'heading'    => esc_html__( 'Product Category', 'gecko' ),
					'param_name' => 'cat_id',
					'type'       => 'dropdown',
					'value'      => $product_cat,
					'dependency' => array(
						'element' => 'display',
						'value'   => 'cat',
					),
					'edit_field_class' => 'vc_col-xs-12 vc_column pt__15',
				),
				array(
					'param_name'  => 'limit',
					'heading'     => esc_html__( 'Per Page', 'gecko' ),
					'description' => esc_html__( 'How much items per page to show (-1 to show all products)', 'gecko' ),
					'type'        => 'textfield',
					'value'       => 12,
				),
				array(
					'param_name' => 'slider',
					'heading'    => esc_html__( 'Enable Slider', 'gecko' ),
					'type'       => 'dropdown',
					'value'      => array(
						esc_html__( 'No', 'gecko' ) => 'no',
						esc_html__( 'Yes', 'gecko' )  => 'yes',
					),
					'dependency' => array(
						'element' => 'style',
						'value'   => 'grid'
					),
				),
				array(
					'param_name'  => 'items',
					'heading'     => esc_html__( 'Items (Number only)', 'gecko' ),
					'group'       => esc_html__( 'Slider Settings', 'gecko' ),
					'description' => esc_html__( 'Set the maximum amount of items displayed at a time with the widest browser width', 'gecko' ),
					'type'        => 'textfield',
					'value'       => 4,
					'dependency' => array(
						'element' => 'slider',
						'value'   => 'yes'
					),
				),
				array(
					'param_name' => 'autoplay',
					'heading'    => esc_html__( 'Enable Auto play', 'gecko' ),
					'group'      => esc_html__( 'Slider Settings', 'gecko' ),
					'type'       => 'checkbox',
					'dependency' => array(
						'element' => 'slider',
						'value'   => 'yes'
					),
				),
				array(
					'param_name' => 'arrows',
					'heading'    => esc_html__( 'Enable Navigation', 'gecko' ),
					'group'      => esc_html__( 'Slider Settings', 'gecko' ),
					'type'       => 'checkbox',
					'dependency' => array(
						'element' => 'slider',
						'value'   => 'yes'
					),
				),
				array(
					'param_name' => 'dots',
					'heading'    => esc_html__( 'Enable Pagination', 'gecko' ),
					'group'      => esc_html__( 'Slider Settings', 'gecko' ),
					'type'       => 'checkbox',
					'dependency' => array(
						'element' => 'slider',
						'value'   => 'yes'
					),
				),
				array(
					'param_name'  => 'columns',
					'heading'     => esc_html__( 'Columns', 'gecko' ),
					'description' => esc_html__( 'This parameter is not working if slider has enabled', 'gecko' ),
					'type'        => 'dropdown',
					'value'       => array(
						esc_html__( '2 columns', 'gecko' ) => 6,
						esc_html__( '3 columns', 'gecko' ) => 4,
						esc_html__( '4 columns', 'gecko' ) => 3,
					),
					'std' => 3
				),
				array(
					'param_name'  => 'filter',
					'heading'     => esc_html__( 'Enable Isotope Category Filter ?', 'gecko' ),
					'description' => esc_html__( 'This parameter is not working if slider has enabled', 'gecko' ),
					'type' 	      => 'checkbox'
				),
				vc_map_add_css_animation(),
				array(
					'param_name'  => 'class',
					'heading'     => esc_html__( 'Extra class name', 'gecko' ),
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'gecko' ),
					'type' 	      => 'textfield',
				),
				array(
					'param_name' => 'issc',
					'type'       => 'hidden',
					'value'      => true,
				),
			)
		)
	);
}
add_action( 'vc_before_init', 'jas_gecko_vc_map_products' );