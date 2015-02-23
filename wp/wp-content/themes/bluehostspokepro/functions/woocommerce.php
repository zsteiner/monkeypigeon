<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page' );
}
?>
<?php
global $woo_options;

/*-----------------------------------------------------------------------------------*/
/* This theme supports WooCommerce, woo! */
/*-----------------------------------------------------------------------------------*/

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support('woocommerce');
}

if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    return false;
}

define('WOOCOMMERCE_USE_CSS', false);
if(!is_admin()){
    wp_register_style('us_woocommerce', get_template_directory_uri() . '/css/woocommerce-impreza.css', array(), '1', 'all' );
    wp_enqueue_style('us_woocommerce');
}

// Adjust markup on all woocommerce pages
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_before_main_content', 'woocommerce_us_before_content', 10);
add_action('woocommerce_after_main_content', 'woocommerce_us_after_content', 20);

if (!function_exists('woocommerce_us_before_content')) {
    function woocommerce_us_before_content() {
        // Disabling Section shortcode
        global $disable_section_shortcode;
        $disable_section_shortcode = TRUE
        ?>
        <div class="l-submain">
        <div class="l-submain-h g-html i-cf">
        <div class="l-content">
        <div class="l-content-h i-widgets">
        <?php
    }
}


if (!function_exists('woocommerce_us_after_content')) {
    function woocommerce_us_after_content() {
        ?>
        </div>
        </div>
        <div class="l-sidebar at_left">
            <div class="l-sidebar-h i-widgets">
                <?php if (defined('SIDEBAR_POS') AND SIDEBAR_POS == 'left') dynamic_sidebar('shop_sidebar'); ?>
            </div>
        </div>

        <div class="l-sidebar at_right">
            <div class="l-sidebar-h i-widgets">
                <?php if (defined('SIDEBAR_POS') AND SIDEBAR_POS == 'right') dynamic_sidebar('shop_sidebar'); ?>
            </div>
        </div>
        </div>
        </div>
    <?php
    }
}

/**
 * WooCommerce Extra Feature
 * --------------------------
 *
 * Change number of related products on product page
 * Set your own value for 'posts_per_page'
 *
 */
function woo_related_products_limit() {
    global $product;

    $args = array(
        'post_type'        		=> 'product',
        'no_found_rows'    		=> 1,
        'posts_per_page'   		=> 4,
        'ignore_sticky_posts' 	=> 1,
        'orderby'             	=> $orderby,
        'post__in'            	=> $related,
        'post__not_in'        	=> array($product->id)
    );
    return $args;
}
add_filter( 'woocommerce_related_products_args', 'woo_related_products_limit' );

// Remove WC sidebar
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

// Add own sidebar
if ( function_exists('register_sidebar') ) {
    register_sidebar(array(
        'name' => 'Shop Sidebar',
        'id' => 'shop_sidebar',
        'description' => 'This is the Shop sidebar. It is used for wooCommerce shop pages.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>'
    ));
}

add_filter('woocommerce_cross_sells_total', 'us_woocommerce_cross_sale_total');
add_filter('woocommerce_cross_sells_columns', 'us_woocommerce_cross_sale_total');
function us_woocommerce_cross_sale_total($count)
{
    return 4;
}

// Move cross sells bellow the shipping
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display' , 10);



// Remove WC lightbox
add_action( 'wp_print_scripts', 'my_deregister_javascript', 100 );
function my_deregister_javascript() {
    wp_deregister_script( 'prettyPhoto' );
    wp_deregister_script( 'prettyPhoto-init' );
}

add_action( 'wp_print_styles', 'my_deregister_styles', 100 );
function my_deregister_styles() {
    wp_deregister_style( 'woocommerce_prettyPhoto_css' );
}