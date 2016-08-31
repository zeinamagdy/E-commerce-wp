<?php
/**
 * Initialize woocommerce.
 *
 * @since   1.0.0
 * @package Gecko
 */

if ( ! class_exists( 'WooCommerce' ) ) return;

// Add this theme support woocommerce
add_theme_support( 'woocommerce' );

// Remove WooCommerce default styles.
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

/**
 * Locate a template and return the path for inclusion.
 *
 * @since 1.0.0
 */
function jas_gecko_wc_locate_template( $template, $template_name, $template_path ) {
	global $woocommerce;

	$_template = $template;

	if ( ! $template_path ) $template_path = $woocommerce->template_url;

	$theme_path = get_template_directory() . '/core/libraries/vendors/woocommerce/templates/';

	// Look within passed path within the theme - this is priority
	$template = locate_template(
		array(
			trailingslashit( $template_path ) . $template_name,
			$template_name
		)
	);

	// Modification: Get the template from this folder, if it exists
	if ( ! $template && file_exists( $theme_path . $template_name ) )
	$template = $theme_path . $template_name;

	// Use default template
	if ( ! $template )
	$template = $_template;

	// Return what we found
	return $template;
}
function jas_gecko_wc_template_parts( $template, $slug, $name ) {
	$theme_path  = get_template_directory() . '/core/libraries/vendors/woocommerce/templates/';
	if ( $name ) {
		$newpath = $theme_path . "{$slug}-{$name}.php";
	} else {
		$newpath = $theme_path . "{$slug}.php";
	}
	return file_exists( $newpath ) ? $newpath : $template;
}
add_filter( 'woocommerce_locate_template', 'jas_gecko_wc_locate_template', 10, 3 );
add_filter( 'wc_get_template_part', 'jas_gecko_wc_template_parts', 10, 3 );

/**
 * Change the breadcrumb separator.
 *
 * @since 1.0.0
 */
function jas_gecko_wc_change_breadcrumb_delimiter( $defaults ) {
	$defaults['delimiter'] = '<i class="fa fa-angle-right"></i>';
	return $defaults;
}
add_filter( 'woocommerce_breadcrumb_defaults', 'jas_gecko_wc_change_breadcrumb_delimiter' );

/**
 * Ordering and result count.
 *
 * @since 1.0.0
 */
function jas_gecko_wc_result_count() {
	echo '<div class="bgd cw result-count-order"><div class="jas-container flex between-xs middle-xs">';
}
function jas_gecko_wc_catalog_ordering() {
	echo '</div></div>';
}
function jas_gecko_wc_catalog_filter() {
	if ( is_active_sidebar( 'wc-top' ) ) {
		echo '<span><a href="javascript:void(0);" id="jas-filter"><i class="fa fa-sliders"></i> '. esc_html( 'Filter', 'gecko' ) .'</a></span>';
	}
}
add_action( 'woocommerce_before_shop_loop', 'jas_gecko_wc_result_count', 10 );
add_action( 'woocommerce_before_shop_loop', 'jas_gecko_wc_catalog_filter', 20 );
add_action( 'woocommerce_before_shop_loop', 'jas_gecko_wc_catalog_ordering', 30);

function jas_gecko_wc_product_title() {
	echo '<h3 class="product-title tu pr fs__13 mg__0"><a class="cd chp" href="' . esc_url( get_permalink() ) . '">' . get_the_title() . '</a></h3>';
}
add_action( 'woocommerce_shop_loop_item_title', 'jas_gecko_wc_product_title', 15 );
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open' );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close' );
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

/**
 * Register widget area for wc.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jas_gecko_wc_register_sidebars' ) ) {
	function jas_gecko_wc_register_sidebars() {
		register_sidebar(
			array(
				'name'          => esc_html__( 'WooCommerce Top Sidebar', 'gecko' ),
				'id'            => 'wc-top',
				'description'   => esc_html__( 'The sidebar area for woocommerce, It will display on top of archive product page', 'gecko' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			)
		);
		register_sidebar(
			array(
				'name'          => esc_html__( 'WooCommerce Sidebar', 'gecko' ),
				'id'            => 'wc-primary',
				'description'   => esc_html__( 'The woocommerce sidebar, It will display in archive product page on left or right', 'gecko' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			)
		);
	}
}
add_action( 'widgets_init', 'jas_gecko_wc_register_sidebars' );
   
/**
 * Disable page title on archive product.
 *
 * @since 1.0.0
 */
function jas_gecko_wc_disable_page_title() {
	return false;
}
add_filter( 'woocommerce_show_page_title', 'jas_gecko_wc_disable_page_title' );

/**
 * Custom add to wishlist button in single product.
 *
 * @since 1.0.0
 */
function jas_gecko_before_single_add_to_cart() {
	echo '<div class="btn-atc">';
}
function jas_gecko_after_single_add_to_cart() {
	echo '</div>';
}
function jas_gecko_after_add_to_cart_button() {
	if ( class_exists( 'YITH_WCWL' ) ) {
		echo jas_gecko_wc_wishlist_button();
	}
}
add_action( 'woocommerce_single_product_summary', 'jas_gecko_before_single_add_to_cart', 25 );
add_action( 'woocommerce_single_product_summary', 'jas_gecko_after_single_add_to_cart', 35 );
add_action( 'woocommerce_after_add_to_cart_button', 'jas_gecko_after_add_to_cart_button' );
function jas_gecko_return() {
	return;
}
add_filter( 'yith_wcwl_positions', 'jas_gecko_return' );

/**
 * Add button product quick view after add to cart.
 *
 * @since 1.0.0
 */
function jas_gecko_wc_add_buton() {
	global $post, $jassc;

	// Get product hover style
	$hover_style = $jassc ? $jassc['hover-style'] : cs_get_option( 'wc-hover-style' );

	if ( $hover_style == 1 ) {
		// Quick view
		echo '<a class="btn-quickview cp pr br-36 mb__10" href="javascript:void(0);" data-prod="' . esc_attr( $post->ID ) . '"><i class="fa fa-eye mr__10"></i>' . esc_html__( 'Quick View', 'gecko' ) . '</a>';

		// Wishlist
		echo jas_gecko_wc_wishlist_button();
	} elseif ( $hover_style == 2 ) {
		// Quick view
		echo '<a class="btn-quickview cp pr bs-36" href="javascript:void(0);" data-prod="' . esc_attr( $post->ID ) . '"><i class="fa fa-eye"></i><span class="tooltip pa cw fs__12 ts__03">' . esc_html__( 'Quick View', 'gecko' ) . '</span></a>';

		// Wishlist
		echo jas_gecko_wc_wishlist_button();
	}
}
add_action( 'woocommerce_after_shop_loop_item', 'jas_gecko_wc_add_buton' );

/**
 * Custom add to wishlist button on product listing.
 *
 * @since 1.0.0
 */
function jas_gecko_wc_wishlist_button() {
	global $product, $yith_wcwl, $jassc, $quickview;

	// Get product hover style
	$hover_style = $jassc ? $jassc['hover-style'] : cs_get_option( 'wc-hover-style' );
	if ( ! class_exists( 'YITH_WCWL' ) ) return;

	$url          = $yith_wcwl->get_wishlist_url();
	$product_type = $product->product_type;
	$exists       = $yith_wcwl->is_product_in_wishlist( $product->id );
	$classes      = 'class="add_to_wishlist cp"';
	$add          = get_option( 'yith_wcwl_add_to_wishlist_text' );
	$browse       = get_option( 'yith_wcwl_browse_wishlist_text' );
	$added        = get_option( 'yith_wcwl_product_added_text' );

	$output = '';

	if ( $quickview ) {
		$output  .= '<div class="yith-wcwl-add-to-wishlist ts__03 bs-36 mg__0 pr add-to-wishlist-' . esc_attr( $product->id ) . '">';
			$output .= '<div class="yith-wcwl-add-button';
				$output .= $exists ? ' hide" style="display:none;"' : ' show"';
				$output .= '><a href="' . esc_url( htmlspecialchars( $yith_wcwl->get_addtowishlist_url() ) ) . '" data-product-id="' . esc_attr( $product->id ) . '" data-product-type="' . esc_attr( $product_type ) . '" ' . $classes . ' ><i class="fa fa-heart-o"></i><span class="tooltip pa cw fs__12 ts__03">' . esc_html( $add ) . '</span></a>';
				$output .= '<i class="fa fa-spinner fa-pulse ajax-loading" style="visibility:hidden"></i>';
			$output .= '</div>';

			$output .= '<div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;"><a class="cp" href="' . esc_url( $url ) . '"><i class="fa fa-check mr__10 ml__30"></i><span class="tooltip pa cw fs__12 ts__03">' . esc_html( $added ) . '</span></a></div>';
			$output .= '<div class="yith-wcwl-wishlistexistsbrowse ' . ( $exists ? 'show' : 'hide' ) . '" style="display:' . ( $exists ? 'block' : 'none' ) . '"><a href="' . esc_url( $url ) . '" class="cp"><i class="fa fa-heart"></i><span class="tooltip pa cw fs__12 ts__03">' . esc_html( $browse ) . '</span></a></div>';
		$output .= '</div>';
	} else {
		if ( $hover_style == 2 || is_singular( 'product' ) ) {
			$output  .= '<div class="yith-wcwl-add-to-wishlist ts__03 bs-36 mg__0 pr add-to-wishlist-' . esc_attr( $product->id ) . '">';
				$output .= '<div class="yith-wcwl-add-button';
					$output .= $exists ? ' hide" style="display:none;"' : ' show"';
					$output .= '><a href="' . esc_url( htmlspecialchars( $yith_wcwl->get_addtowishlist_url() ) ) . '" data-product-id="' . esc_attr( $product->id ) . '" data-product-type="' . esc_attr( $product_type ) . '" ' . $classes . ' ><i class="fa fa-heart-o"></i><span class="tooltip pa cw fs__12 ts__03">' . esc_html( $add ) . '</span></a>';
					$output .= '<i class="fa fa-spinner fa-pulse ajax-loading" style="visibility:hidden"></i>';
				$output .= '</div>';

				$output .= '<div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;"><a class="cp" href="' . esc_url( $url ) . '"><i class="fa fa-check mr__10 ml__30"></i><span class="tooltip pa cw fs__12 ts__03">' . esc_html( $added ) . '</span></a></div>';
				$output .= '<div class="yith-wcwl-wishlistexistsbrowse ' . ( $exists ? 'show' : 'hide' ) . '" style="display:' . ( $exists ? 'block' : 'none' ) . '"><a href="' . esc_url( $url ) . '" class="cp"><i class="fa fa-heart"></i><span class="tooltip pa cw fs__12 ts__03">' . esc_html( $browse ) . '</span></a></div>';
			$output .= '</div>';
		} elseif ( $hover_style == 1 ) {
			$output  .= '<div class="yith-wcwl-add-to-wishlist ts__03 br-36 mg__0 pr add-to-wishlist-' . esc_attr( $product->id ) . '">';
				$output .= '<div class="yith-wcwl-add-button';
					$output .= $exists ? ' hide" style="display:none;"' : ' show"';
					$output .= '><a href="' . esc_url( htmlspecialchars( $yith_wcwl->get_addtowishlist_url() ) ) . '" data-product-id="' . esc_attr( $product->id ) . '" data-product-type="' . esc_attr( $product_type ) . '" ' . $classes . ' ><i class="fa fa-heart-o mr__10"></i>' . esc_html( $add ) . '</a>';
					$output .= '<i class="fa fa-spinner fa-pulse ajax-loading" style="visibility:hidden"></i>';
				$output .= '</div>';

				$output .= '<div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;"><a class="cp" href="' . esc_url( $url ) . '"><i class="fa fa-check mr__10"></i>' . esc_html( $added ) . '</a></div>';
				$output .= '<div class="yith-wcwl-wishlistexistsbrowse ' . ( $exists ? 'show' : 'hide' ) . '" style="display:' . ( $exists ? 'block' : 'none' ) . '"><a href="' . esc_url( $url ) . '" class="cp"><i class="fa fa-heart mr__10"></i>' . esc_html( $browse ) . '</a></div>';
			$output .= '</div>';
		}
	}

	return $output;
}

/**
 * Shopping cart.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jas_gecko_wc_my_account' ) ) {
	function jas_gecko_wc_my_account() {
		$output = '';

		$output .= '<div class="jas-my-account hidden-xs ts__05 pr">';
			$output .= '<a class="cb chp db" href="' . esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ) . '"><i class="pe-7s-user"></i></a>';
			$output .= '<ul class="pa tc">';
				if ( is_user_logged_in() ) {
					$output .= '<li><a class="db cg chp" href="' . esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ) . '">' . esc_html__( 'My Account', 'gecko' ) . '</a></li>';
					$output .= '<li><a class="db cg chp" href="' . esc_url( wp_logout_url() ) . '">' . esc_html__( 'Logout', 'gecko' ) . '</a></li>';
				} else {
					$output .= '<li><a class="db cg chp" href="' . esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ) . '">' . esc_html__( 'Login / Register', 'gecko' ) . '</a></li>';
				}
			$output .= '</ul>';
		$output .= '</div>';

		return apply_filters( 'jas_gecko_wc_my_account', $output );
	}
}

/**
 * Ensure cart contents update when products are added to the cart via AJAX.
 *
 * @since 1.0.0
 */
function jas_gecko_wc_add_to_cart_fragment( $fragments ) {
	ob_start();
	?>
	<a class="cart-contents pr cb chp db" href="#" title="<?php esc_html_e( 'View your shopping cart', 'gecko' ); ?>">
		<i class="pe-7s-shopbag"></i>
		<span class="pa count bgb br__50 cw tc"><?php echo sprintf ( wp_kses_post( '%d', '%d', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?></span>
	</a>
	<?php
	
	$fragments['a.cart-contents'] = ob_get_clean();
	
	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'jas_gecko_wc_add_to_cart_fragment' );

/**
 * Custom ajax add to cart
 *
 * @since  1.0.0
 *
 * @return  json
 */
function jas_gecko_wc_custom_add_to_cart_ajax() {

	if ( ! ( isset( $_REQUEST['product_id'] ) && (int) $_REQUEST['product_id'] > 0 ) )
		return;

	$titles 	= array();
	$product_id = (int) $_REQUEST['product_id'];

	if ( is_array( $product_id ) ) {
		foreach ( $product_id as $id ) {
			$titles[] = get_the_title( $id );
		}
	} else {
		$titles[] = get_the_title( $product_id );
	}

	$titles     = array_filter( $titles );
	$added_text = sprintf( _n( '%s has been added to your cart.', '%s have been added to your cart.', sizeof( $titles ), 'gecko' ), wc_format_list_of_items( $titles ) );

	// Output success messages
	if ( 'yes' === get_option( 'woocommerce_cart_redirect_after_add' ) ) {
		$return_to = apply_filters( 'woocommerce_continue_shopping_redirect', wp_get_referer() ? wp_get_referer() : home_url() );
		$message   = sprintf( '<a href="%s" class="button wc-forward">%s</a> %s', esc_url( $return_to ), esc_html__( 'Continue Shopping', 'gecko' ), esc_html( $added_text ) );
	} else {
		$message   = sprintf( '<a href="%s" class="button wc-forward">%s</a> %s', esc_url( wc_get_page_permalink( 'cart' ) ), esc_html__( 'View Cart', 'gecko' ), esc_html( $added_text ) );
	}

	$data = array( 'message' => apply_filters( 'wc_add_to_cart_message', $message, $product_id ) );

	wp_send_json( $data );

	exit();
}
add_action( 'wp_ajax_jas_open_cart_side', 'jas_gecko_wc_custom_add_to_cart_ajax' );
add_action( 'wp_ajax_nopriv_jas_open_cart_side', 'jas_gecko_wc_custom_add_to_cart_ajax' );

/**
 * Shopping cart in header.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jas_gecko_wc_shopping_cart' ) ) {
	function jas_gecko_wc_shopping_cart() {
		global $woocommerce;
		$output = '';
		$output .= '<div class="jas-icon-cart pr">';
			$output .= '<a class="cart-contents pr cb chp db" href="#" title="' . esc_html( 'View your shopping cart', 'gecko' ) . '">';
				$output .= '<i class="pe-7s-shopbag"></i>';
				$output .= '<span class="pa count bgb br__50 cw tc">' . esc_html( $woocommerce->cart->get_cart_contents_count() ) . '</span>';
			$output .= '</a>';
		$output .= '</div>';
		return apply_filters( 'jas_gecko_wc_shopping_cart', $output );
	}
}

/**
 * Load mini cart on header.
 *
 * @since 1.0.0
 */
function jas_gecko_wc_render_mini_cart() {
	$output = '';
	wc_clear_notices();

	ob_start();
		$args['list_class'] = '';
		wc_get_template( 'cart/mini-cart.php' );
	$output = ob_get_clean();

	$result = array(
		'cart_total' => WC()->cart->cart_contents_count,
		'cart_html'  => $output
	);
	echo json_encode( $result );
	exit;
}
add_action( 'wp_ajax_load_mini_cart', 'jas_gecko_wc_render_mini_cart' );
add_action( 'wp_ajax_nopriv_load_mini_cart', 'jas_gecko_wc_render_mini_cart' );

/**
 * Customize product quick view.
 *
 * @since  1.0
 */
function jas_gecko_wc_quickview() {
	// Get product from request.
	if ( isset( $_POST['product'] ) && (int) $_POST['product'] ) {
		global $post, $product, $woocommerce;

		$id      = ( int ) $_POST['product'];
		$post    = get_post( $id );
		$product = get_product( $id );

		if ( $product ) {
			// Get quickview template.
			include JAS_GECKO_PATH . '/core/libraries/vendors/woocommerce/templates/content-quickview-product.php';
		}
	}

	exit;
}
add_action( 'wp_ajax_jas_quickview', 'jas_gecko_wc_quickview' );
add_action( 'wp_ajax_nopriv_jas_quickview', 'jas_gecko_wc_quickview' );

/**
 * Customize shipping & return content.
 *
 * @since  1.0
 */
function jas_gecko_wc_shipping_return() {
	// Get help content
	$message = cs_get_option( 'wc-single-shipping-return' );
	if ( ! $message ) return;

	$output = '<div class="wc-content-help pr">' . $message . '</div>';

	echo wp_kses_post( $output );
	exit;
}
add_action( 'wp_ajax_jas_shipping_return', 'jas_gecko_wc_shipping_return' );
add_action( 'wp_ajax_nopriv_jas_shipping_return', 'jas_gecko_wc_shipping_return' );

/**
 * Add some script to header.
 *
 * @since 1.0.0
 */
function jas_gecko_wc_header_script() {
	?>
	<script>
		var JASAjaxURL = '<?php echo esc_js( admin_url( 'admin-ajax.php' ) ); ?>';
		var JASSiteURL = '<?php echo get_site_url() . '/index.php'; ?>';
	</script>
	<?php
}
add_action( 'wp_head', 'jas_gecko_wc_header_script' );

/**
 * Customize WooCommerce image dimensions.
 *
 * @since  1.0
 */
function jas_gecko_wc_customize_image_dimensions() {
	global $pagenow;

	if ( $pagenow != 'themes.php' || ! isset( $_GET['activated'] ) ) {
		return;
	}

	// Update WooCommerce image dimensions.
	update_option(
		'shop_catalog_image_size',
		array( 'width' => '570', 'height' => '760', 'crop' => 1 )
	);

	update_option(
		'shop_single_image_size',
		array( 'width' => '750', 'height' => '1100', 'crop' => 1 )
	);

	update_option(
		'shop_thumbnail_image_size',
		array( 'width' => '160', 'height' => '215', 'crop' => 1 )
	);
}
add_action( 'admin_init', 'jas_gecko_wc_customize_image_dimensions', 1 );

/**
 * Add social sharing to single product.
 *
 * @since  1.0
 */
function jas_gecko_wc_single_social_share() {
	jas_gecko_social_share();
}
add_action( 'woocommerce_share', 'jas_gecko_wc_single_social_share' );

/**
 * Add page title to archive product.
 *
 * @since  1.0
 */
function jas_gecko_wc_page_head() {
	// Remove old position of breadcrumb
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

	$title = cs_get_option( 'wc-page-title' );

	$output = '<div class="page-head pr tc"><div class="jas-container pr">';
		if ( is_shop() ) {
			$output .= '<h1 class="tu mb__10 cw">' . esc_html( cs_get_option( 'wc-page-title' ) ) . '</h1>';
			$output .= '<p>' . do_shortcode( cs_get_option( 'wc-page-desc' ) ) . '</p>';
		} else {
			// Remove old position of category description
			remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );

			$output .= '<h1 class="tu mb__10 cw">' . single_cat_title( '', false ) . '</h1>';
			$output .= do_shortcode( category_description() );
		}
		ob_start();
			woocommerce_breadcrumb();
		$output .= ob_get_clean();
	$output .= '</div></div>';

	echo wp_kses_post( $output );
}
add_action( 'woocommerce_before_main_content', 'jas_gecko_wc_page_head', 15 );
add_action( 'woocommerce_before_single_product', 'jas_gecko_wc_page_head', 15 );

/**
 * Woocommerce currency switch.
 *
 * @since 1.0.0
 */
function jas_gecko_wc_currency() {
	if ( ! class_exists( 'JAS_Addons_Currency' ) ) return;
	$currencies = JAS_Addons_Currency::getCurrencies();
					
	if ( count( $currencies > 0 ) ) :
		$woocurrency = JAS_Addons_Currency::woo_currency();
		$woocode = $woocurrency['currency'];
		if ( ! isset( $currencies[$woocode] ) ) {
			$currencies[$woocode] = $woocurrency;
		}
		$default = JAS_Addons_Currency::woo_currency();
		$current = isset( $_COOKIE['jas_currency'] ) ? $_COOKIE['jas_currency'] : $default['currency'];

		$output = '';

		$output .= '<div class="jas-currency dib pr">';
			$output .= '<span class="current">' . esc_html( $current ) . '<i class="fa fa-angle-down ml__5"></i></span>';
			$output .= '<ul class="pa tr ts__03">';
				foreach( $currencies as $code => $val ) :
					$output .= '<li>';
						$output .= '<a class="currency-item cw chp" href="javascript:void(0);" data-currency="' . esc_attr( $code ) . '">' . esc_html( $code ) . '</a>';
					$output .= '</li>';
				endforeach;
			$output .= '</ul>';
		$output .= '</div>';
	endif;
	return apply_filters( 'jas_gecko_wc_currency', $output );
}

/**
 * Change number of products displayed per page.
 *
 * @since  1.0
 *
 * @return  number
 *
 */
function jas_gecko_wc_change_product_per_page() {
	$number = cs_get_option( 'wc-number-per-page' );

	return $number;
}
add_filter( 'loop_shop_per_page', 'jas_gecko_wc_change_product_per_page' );

/**
 * Preview Email Transaction.
 *
 * @since  1.0
 */
$preview = JAS_GECKO_PATH . '/core/libraries/vendors/woocommerce/templates/emails/woo-preview-emails.php';
if ( file_exists( $preview ) ) {
	include $preview;
}

/**
 * Change pagination position.
 *
 * @since  1.0
 */
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination' );
add_action( 'jas_pagination', 'woocommerce_pagination' );

/**
 * Ajax search.
 *
 * @since  1.0
 */
function jas_gecko_wc_live_search() {
	$result = array();
	$args = array(
		's'              => urldecode( $_REQUEST['q'] ),
		'post_type'      => 'product',
		'posts_per_page' => 10
	);
	$query = new WP_Query( $args );
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), array( 60,60 ) );
			if ( ! empty( $thumb ) ) {
				$thumb = $thumb[0];
			} else {
				$thumb = '';
			}
			$result[] = array(
				'id'     => get_the_ID(),
				'label'  => get_the_title(),
				'value'  => get_the_title(),
				'thumb'  => $thumb,
				'url'    => get_the_permalink(),
				'except' => substr( strip_tags( get_the_excerpt() ), 0, 60 ) . '...'
			);
		}
	}
	echo json_encode( $result );
	exit;
}
add_action( 'wp_ajax_jas_gecko_live_search', 'jas_gecko_wc_live_search' );
add_action( 'wp_ajax_nopriv_jas_gecko_live_search', 'jas_gecko_wc_live_search' );