<?php
/*
Plugin Name: Open Swatch - Woocommerce Color Swatch
Plugin URI: http://magetop.com/open-swatch
Description: Swatch image for woocommerce plugin.
Author: anhvnit@gmail.com
Author URI: http://magetop.com/
Version: 2.0
Text Domain: open-swatch
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/
define('OPENSWATCH_PATH',plugin_dir_path(__FILE__));
define('OPENSWATCH_URI',plugins_url('openswatch'));

require_once OPENSWATCH_PATH.'modules/options/options-framework.php';
require_once OPENSWATCH_PATH . '/modules/class-tgm-plugin-activation.php';
require_once OPENSWATCH_PATH.'/includes/class-color-swatch.php';
if(!class_exists('WC_Openswatch_Widget'))
{
    include_once( OPENSWATCH_PATH.'/includes/abstract-wc-widget.php' );
}

require_once OPENSWATCH_PATH.'/includes/class-wc-widget-layered-nav.php';
require_once OPENSWATCH_PATH.'/includes/class-wc-widget-price-filter.php';

if(!function_exists('openswatch_theme_header_script'))
{
    function openswatch_theme_header_script() {
        echo '
        <script type="text/javascript" >
            var openwatch_ajax_url = "'.admin_url('admin-ajax.php').'";
            var openwatch_swatch_attr = "'.esc_attr( sanitize_title(openwatch_get_option('openwatch_attribute_image_swatch'))).'";
        </script>';

    }
}

add_action( 'wp_head', 'openswatch_theme_header_script' );


//frontend
if(!function_exists('openswatch_name_scripts'))
{
    function openswatch_name_scripts() {

        wp_register_script( 'openswatch', OPENSWATCH_URI.'/assets/js/openswatch.js',array('jquery') );
        wp_register_style('openswatch', OPENSWATCH_URI.'/assets/css/openswatch.css');

        wp_register_script( 'tooltipster', OPENSWATCH_URI.'/assets/js/jquery.tooltipster.min.js',array('jquery') );
        wp_register_style('tooltipster', OPENSWATCH_URI.'/assets/css/tooltipster.css');

        wp_enqueue_script('openswatch');
        wp_enqueue_style('openswatch');

        if(openwatch_get_option('openwatch_attribute_tooltips'))
        {
            wp_enqueue_script('tooltipster');
            wp_enqueue_style('tooltipster');
        }

    }
}


add_action( 'wp_enqueue_scripts', 'openswatch_name_scripts' );

add_filter('wc_get_template','openswatch_get_template',10,5);

function openswatch_get_template($located, $template_name, $args, $template_path, $default_path)
{
    if($template_name == 'single-product/add-to-cart/variable.php')
    {
        global $post;

        $tmp = get_post_meta( $post->ID, '_allow_openswatch', true );
        if($tmp != 0) {
            if (file_exists(get_stylesheet_directory() . '/openswatch/' . $template_name)) {
                return get_stylesheet_directory().'/openswatch/'. $template_name;
            } else {
                global $woocommerce;
                $woo_version = $woocommerce->version;
                if ($woo_version < 2.4) {
                    $template_name = 'single-product/add-to-cart/old.variable.php';
                }
                return OPENSWATCH_PATH . 'templates/' . $template_name;
            }
        }

    }


    return $located;
}

// Require woocommerce plugin
add_action( 'tgmpa_register', 'openswatch_register_required_plugins' );
function openswatch_register_required_plugins() {
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        array(
            'name'        => 'Woocommerce',
            'slug'        => 'woocommerce',
            'required'    => true,
        )
    );

    $config = array(
        'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug'  => 'plugins.php',            // Parent menu slug.
        'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.

    );
    tgmpa( $plugins, $config );
}



if ( ! function_exists( 'wc_dropdown_variation_attribute_options' ) ) {

    /**
     * Output a list of variation attributes for use in the cart forms.
     *
     * @param array $args
     * @since 2.4.0
     */
    function wc_dropdown_variation_attribute_options( $args = array() ) {
        $args = wp_parse_args( $args, array(
            'options'          => false,
            'attribute'        => false,
            'product'          => false,
            'selected' 	       => false,
            'name'             => '',
            'id'               => '',
            'class'            => '',
            'show_option_none' => __( 'Choose an option', 'woocommerce' )
        ) );

        $options   = $args['options'];
        $product   = $args['product'];
        $attribute = $args['attribute'];
        $name      = $args['name'] ? $args['name'] : 'attribute_' . sanitize_title( $attribute );
        $id        = $args['id'] ? $args['id'] : sanitize_title( $attribute );
        $class     = $args['class'];

        if ( empty( $options ) && ! empty( $product ) && ! empty( $attribute ) ) {
            $attributes = $product->get_variation_attributes();
            $options    = $attributes[ $attribute ];
        }

        echo '<select id="' . esc_attr( $id ) . '" class="' . esc_attr( $class ) . '" name="' . esc_attr( $name ) . '" data-attribute_name="attribute_' . esc_attr( sanitize_title( $attribute ) ) . '">';

        if ( $args['show_option_none'] ) {
            echo '<option value="">' . esc_html( $args['show_option_none'] ) . '</option>';
        }

        if ( ! empty( $options ) ) {
            if ( $product && taxonomy_exists( $attribute ) ) {
                // Get terms if this is a taxonomy - ordered. We need the names too.
                $terms = wc_get_product_terms( $product->id, $attribute, array( 'fields' => 'all' ) );

                foreach ( $terms as $term ) {
                    if ( in_array( $term->slug, $options ) ) {
                        echo '<option value="' . esc_attr( $term->slug ) . '" ' . selected( sanitize_title( $args['selected'] ), $term->slug, false ) . '>' . apply_filters( 'woocommerce_variation_option_name', $term->name ) . '</option>';
                    }
                }
            } else {
                foreach ( $options as $option ) {
                    // This handles < 2.4.0 bw compatibility where text attributes were not sanitized.
                    $selected = sanitize_title( $args['selected'] ) === $args['selected'] ? selected( $args['selected'], sanitize_title( $option ), false ) : selected( $args['selected'], $option, false );
                    echo '<option value="' . esc_attr( $option ) . '" ' . $selected . '>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $option ) ) . '</option>';
                }
            }
        }

        echo '</select>';
    }
}

if(! function_exists('openswatch_price_ranges'))
{
    function openswatch_price_ranges()
    {
        $ranges = openwatch_get_option('openwatch_price_range');
        $result = false;
        if($ranges != '')
        {
            $result = array();
            $lines = explode(PHP_EOL,$ranges);
            foreach($lines as $line)
            {
                $tmp = explode('|',trim($line));
                if(count($tmp) == 2)
                {
                    $key = esc_attr(trim($tmp[0]));
                    $value = trim($tmp[1]);
                    $tmp = explode(',',$key);
                    $min = isset($tmp[0]) ? $tmp[0] : 0;
                    $max = isset($tmp[1]) ? $tmp[1] : 10000000;
                    $key = implode(',',array($min,$max));
                    $value = array(
                        'label' => $value,
                        'min' => $min,
                        'max' => $max
                    );
                    $result[$key] = $value;
                }
            }
        }
        return $result;
    }

}

function openswatch_register_widgets() {
    register_widget( 'OpenSwatch_Widget_Layered_Nav' );
    register_widget( 'OpenSwatch_Widget_Price_Filter' );
}
add_action( 'widgets_init', 'openswatch_register_widgets' );




if(!function_exists('openswatch_price_filter'))
{
    function openswatch_price_filter($post_in)
    {
        if ( isset( $_GET['max_price'] ) || isset( $_GET['min_price'] ) ) {
            $filtered = WC()->query->price_filter();

            if(is_array($post_in) && !empty($post_in))
            {
                $tmp = array_intersect($filtered,$post_in);
                if(empty($tmp))
                {
                    return array(0);
                }
                return array_intersect($filtered,$post_in);
            }
            return $filtered;
        }
        return $post_in;
    }
}
if(!function_exists('openswatch_price_filter_init'))
{
    function openswatch_price_filter_init()
    {
        add_filter( 'loop_shop_post_in', 'openswatch_price_filter',1000,1 );
    }
}
add_action('init','openswatch_price_filter_init');

if(!function_exists('openswatch_is_layered_nav_active'))
{
    function openswatch_is_layered_nav_active($active)
    {
        if(!$active)
        {
            if(is_active_widget( false, false, 'openswatch_layered_nav', true ))
            {
                $active = true;
            }
        }
        return $active;
    }
}

add_filter('woocommerce_is_layered_nav_active','openswatch_is_layered_nav_active',10,1);

function openswatch_custom_wc_ajax_variation_threshold( $qty, $product ) {
    return 1000;
}

add_filter( 'woocommerce_ajax_variation_threshold', 'openswatch_custom_wc_ajax_variation_threshold', 100, 2 );
