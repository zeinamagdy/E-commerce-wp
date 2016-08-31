<?php
/**
 * Action hooks.
 *
 * @since   1.0.0
 * @package Gecko
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jas_gecko_setup' ) ) {
	function jas_gecko_setup() {
		/**
		 * Set the content width in pixels, based on the theme's design and stylesheet.
		 *
		 * @since 1.0.0
		 */
		$GLOBALS['content_width'] = apply_filters( 'gecko_content_width', 820 );

		/**
		 * Make theme available for translation.
		 * Translations can be filed in the /language/ directory.
		 *
		 * @since 1.0.0
		 */
		load_theme_textdomain( 'gecko', JAS_GECKO_PATH . '/core/libraries/janstudio/language' );

		/**
		 * Add theme support.
		 *
		 * @since 1.0.0
		 */
		add_theme_support( 'title-tag' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
		add_theme_support( 'custom-header' );
		add_theme_support( 'custom-background' );

		/**
		 * Register theme location.
		 *
		 * @since 1.0.0
		 */
		register_nav_menus(
			array(
				'primary-menu' => esc_html__( 'Primary Menu', 'gecko' ),
				'left-menu'    => esc_html__( 'Left Menu', 'gecko' ),
				'right-menu'   => esc_html__( 'Right Menu', 'gecko' ),
				'footer-menu'  => esc_html__( 'Footer Menu', 'gecko' ),
			)
		);

		// Tell TinyMCE editor to use a custom stylesheet.
		add_editor_style( get_template_directory_uri() . '/assets/css/editor-style.css' );
	}
}
add_action( 'after_setup_theme', 'jas_gecko_setup' );

/**
 * Register widget area.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jas_gecko_register_sidebars' ) ) {
	function jas_gecko_register_sidebars() {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Primary Sidebar', 'gecko' ),
				'id'            => 'primary-sidebar',
				'description'   => esc_html__( 'The Primary Sidebar', 'gecko' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h4 class="widget-title tu">',
				'after_title'   => '</h4>',
			)
		);
		for ( $i = 1, $n = 4; $i <= $n; $i++ ) {
			register_sidebar(
				array(
					'name'          => esc_html__( 'Footer Area #', 'gecko' ) . $i,
					'id'            => 'footer-' . $i,
					'description'   => sprintf( esc_html__( 'The #%s column in footer area', 'gecko' ), $i ),
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget'  => '</aside>',
					'before_title'  => '<h3 class="widget-title tu">',
					'after_title'   => '</h3>',
				)
			);
		}
	}
}
add_action( 'widgets_init', 'jas_gecko_register_sidebars' );

/**
 * Register custom widgets.
 *
 * @since   1.0.0
 */

if ( ! function_exists( 'jas_gecko_register_widgets' ) ) {
	function jas_gecko_register_widgets() {
		// Widgets
		$widgets = 'instagram';
		$widgets = array_map( 'trim', explode( ',', $widgets ) );
		foreach ( $widgets as $widget ) {
			include JAS_GECKO_PATH . '/core/libraries/janstudio/widgets/' . $widget . '.php';
		}

		register_widget( 'JAS_Gecko_Widget_Instagram' );
	}
	add_action( 'widgets_init', 'jas_gecko_register_widgets' );
}

/**
 * Add Menu Page Link.
 *
 * @return void
 * @since  1.0.0
 */
if ( ! function_exists( 'jas_gecko_add_framework_menu' ) ) {
	function jas_gecko_add_framework_menu() {
		$menu = 'add_menu_' . 'page';
		$menu(
			'jas_panel',
			esc_html__( 'JanStudio', 'gecko' ),
			'',
			'jas',
			NULL,
			'dashicons-layout',
			99
		);
	}
}
add_action( 'admin_menu', 'jas_gecko_add_framework_menu' );

/**
 * Enqueue scripts and styles.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jas_gecko_enqueue_scripts' ) ) {
	function jas_gecko_enqueue_scripts() {
		// Google font
		wp_enqueue_style( 'jas-font-google', jas_gecko_google_font_url() );

		// Font Awesome
		wp_enqueue_style( 'font-awesome', JAS_GECKO_URL . '/assets/vendors/font-awesome/css/font-awesome.min.css' );

		// Font Stroke
		wp_enqueue_style( 'font-stroke', JAS_GECKO_URL . '/assets/vendors/font-stroke/css/font-stroke.min.css' );

		// Slick Carousel
		wp_enqueue_style( 'slick', JAS_GECKO_URL . '/assets/vendors/slick/slick.css' );
		wp_enqueue_script( 'slick', JAS_GECKO_URL . '/assets/vendors/slick/slick.min.js', array(), false, true );

		// Magnific Popup
		wp_enqueue_script( 'magnific-popup', JAS_GECKO_URL . '/assets/vendors/magnific-popup/jquery.magnific-popup.min.js', array(), false, true );

		// Isotope
		wp_enqueue_script( 'isotope', JAS_GECKO_URL . '/assets/vendors/isotope/isotope.pkgd.min.js', array(), false, true );

		// Scroll Reveal
		wp_enqueue_script( 'scrollreveal', JAS_GECKO_URL . '/assets/vendors/scrollreveal/scrollreveal.min.js', array(), false, true );

		// jQuery Countdown
		wp_enqueue_script( 'countdown', JAS_GECKO_URL . '/assets/vendors/jquery-countdown/jquery.countdown.min.js', array(), false, true );

		// Elevate Zoom
		if ( is_singular( 'product' ) && cs_get_option( 'wc-single-elevate' ) ) {
			wp_enqueue_script( 'elevate-zoom', JAS_GECKO_URL . '/assets/vendors/elevatezoom/jquery.elevateZoom.min.js', array(), false, true );
		}

		if ( class_exists( 'WooCommerce' ) ) {
			wp_enqueue_script( 'wc-add-to-cart-variation' );
			wp_enqueue_script( 'jquery-ui-autocomplete' );
		}

		// Main scripts
		wp_enqueue_script( 'jas-gecko-script', JAS_GECKO_URL . '/assets/js/theme.js', array( 'jquery' ), '', true );

		// Custom localize script
		wp_localize_script( 'jas-gecko-script', 'JAS_Data_Js', jas_gecko_custom_data_js() );

		// Responsive stylesheet
		wp_enqueue_style( 'jas-gecko-animated', JAS_GECKO_URL . '/assets/css/animate.css');

		// Main stylesheet
		wp_enqueue_style( 'jas-gecko-style', get_stylesheet_uri() );

		// Inline stylesheet
		wp_add_inline_style( 'jas-gecko-style', jas_gecko_custom_css() );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		do_action( 'gecko_scripts');
	}
}
add_action( 'wp_enqueue_scripts', 'jas_gecko_enqueue_scripts' );

/**
 * Redirect to under construction page
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jas_gecko_offline' ) ) {
	function jas_gecko_offline() {
		// Check if under construction page is enabled
		if ( cs_get_option( 'maintenance' ) ) {
			if ( ! is_feed() ) {
				// Check if user is not logged in
				if ( ! is_user_logged_in() ) {
					// Load under construction page
					include JAS_GECKO_PATH . '/views/pages/offline.php';
					exit;
				}
			}

			// Check if user is logged in
			if ( is_user_logged_in() ) {
				global $current_user;

				// Get user role
				wp_get_current_user();

				$loggedInUserID = $current_user->ID;
				$userData = get_userdata( $loggedInUserID );

				// If user role is not 'administrator' then redirect to under construction page
				if ( 'administrator' != $userData->roles[0] ) {
					if ( ! is_feed() ) {
						include JAS_GECKO_PATH . '/views/pages/offline.php';
						exit;
					}
				}
			}
		}
	}
}
add_action( 'template_redirect', 'jas_gecko_offline' );

/**
 * Add meta data for social network
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jas_gecko_social_meta' ) ) {
	function jas_gecko_social_meta() {
		$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
		$output  = '<meta property="og:site_name" content="' . get_bloginfo( 'name') . '"/>'. "\n";
		$output .= '<meta property="og:image" content="' . $image_src_array[ 0 ] . '"/>'. "\n";
		$output .= '<meta property="og:image:url" content="' . $image_src_array[ 0 ] . '"/>'. "\n";
		$output .= '<meta property="og:url" content="' . esc_url( get_permalink() ) . '"/>'. "\n";
		$output .= '<meta property="og:title" content="' . esc_attr( strip_tags( get_the_title() ) ) . '"/>'. "\n";
		$output .= '<meta property="og:description" content="' . esc_attr( strip_tags( get_the_excerpt() ) ) . '"/>'. "\n";
		if ( function_exists( 'is_product' ) && is_product() ) {
			$output .= '<meta property="og:type" content="product"/>'. "\n";
		} else {
			$output .= '<meta property="og:type" content="article"/>'. "\n";
		}

		echo balanceTags( $output );
	}
	add_action( 'wp_head', 'jas_gecko_social_meta' );
}

/**
 * Add custom javascript code
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jas_gecko_custom_js' ) ) {
	function jas_gecko_custom_js() {
		$data = cs_get_option( 'custom-js' );
		if ( ! empty( $data ) ) :
			echo '<scr' . 'ipt>' . $data . '</scr' . 'ipt>';
		endif;
	}
	add_action( 'wp_footer', 'jas_gecko_custom_js' );
}