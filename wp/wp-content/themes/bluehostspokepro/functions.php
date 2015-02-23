<?php
 /**
 * Include all needed files
 */
/* Slightly Modified Options Framework */
/* Slightly Modified Options Framework */
//require_once ('admin/index.php');
/* Admin specific functions */
require_once('functions/admin.php');
/* Load shortcodes */
require_once('functions/shortcodes.php');
require_once('functions/zilla-shortcodes/zilla-shortcodes.php');
/* Breadcrumbs function */
require_once('functions/breadcrumbs.php');
/* Post formats */
require_once('functions/post_formats.php');
/* Custom Post types */
/*require_once('functions/post_types.php');*/
/* Meta Box plugin and settings */
define( 'RWMB_URL', trailingslashit( get_template_directory_uri() . '/vendor/meta-box' ) );
define( 'RWMB_DIR', trailingslashit( get_template_directory() . '/vendor/meta-box' ) );
require_once RWMB_DIR . 'meta-box.php';

define( 'REVSLIDER_DIR', trailingslashit( get_template_directory() . '/vendor/revslider' ) );
require_once REVSLIDER_DIR . 'revslider.php';

/*
define( 'EASYFANCYBOX_DIR', trailingslashit( get_template_directory() . '/vendor/easy-fancybox' ) );
require_once(EASYFANCYBOX_DIR.'easy-fancybox.php');
*/

require_once('functions/meta-box_spoke.php');

/* Menu and it's custom markup */
require_once('functions/menu.php');
/* Comments custom markup */
require_once('functions/comments.php');
/* wp_link_pages both next and numbers usage */
require_once('functions/link_pages.php');
/* Sidebars init */
require_once('functions/sidebars.php');
/* Sidebar generator */
//require_once('vendor/sidebar_generator.php');
/* Plugins activation */
//require_once('functions/plugin_activation.php');
/* CSS and JS enqueue */
require_once('functions/enqueue.php');
/* Widgets */
require_once('functions/widgets/contact.php');
require_once('functions/widgets/socials.php');
require_once('functions/widgets/icon.php');

/* For Gallery */
require_once dirname( __FILE__ ) . '/includes/plugins/easy-image-gallery/easy-image-gallery.php';  
require_once dirname( __FILE__ ) . '/includes/plugins/wp-gallery-custom-links/wp-gallery-custom-links.php';  
require_once dirname( __FILE__ ) . '/includes/plugins/responsive-select-menu/responsive-select-menu.php';  

add_filter('widget_text', 'do_shortcode');

//require_once('functions/ajax_grid_blog.php');
//require_once('functions/ajax_import.php');

/* WooCommerce */
//require_once('functions/woocommerce.php');

require 'theme-updates/theme-update-checker.php';
$example_update_checker = new ThemeUpdateChecker(
    'bluehostspokepro',
    'http://ripeconcepts.com/bluehostspoke/info.json'
);

/**
 * Theme Setup
 */
function us_theme_setup()
{
	global $smof_data, $content_width;

	if ( ! isset( $content_width ) ) $content_width = 1500;
	add_theme_support('automatic-feed-links');

	/*add_theme_support('post-formats', array('quote', 'image', 'gallery', 'video', )); */

	/* Add post thumbnail functionality */
	add_theme_support('post-thumbnails');
	add_image_size('portfolio-list', 570, 380, true);
	add_image_size('portfolio-list-3-2', 570, 380, true);
	add_image_size('portfolio-list-4-3', 570, 428, true);
	add_image_size('portfolio-list-1-1', 570, 570, true);
	add_image_size('portfolio-list-2-3', 380, 570, true);
	add_image_size('portfolio-list-3-4', 428, 570, true);
	add_image_size('blog-small', 350, 350, true);
	add_image_size('blog-grid', 500, 0, false);
	add_image_size('blog-large', 1140, 600, true);
	add_image_size('carousel-thumb', 200, 133, false);
	add_image_size('gallery-xs', 114, 114, true);
	add_image_size('gallery-s', 190, 190, true);
	add_image_size('gallery-m', 228, 228, true);
	add_image_size('gallery-l', 285, 285, true);
	add_image_size('gallery-masonry', 500, 0, false);
	add_image_size('member', 350, 350, true);
	add_image_size('blog-bg', 99999, 381, false);


}

add_action( 'after_setup_theme', 'us_theme_setup' );
 

// Implement Custom Header features.
//require get_template_directory() . '/functions/custom-header.php';


// Add Theme Customizer functionality.
require get_template_directory() . '/functions/theme-customizer.php';
require get_template_directory() . '/functions/theme-option.php';
require get_template_directory() . '/functions/theme-content.php';
require get_template_directory() . '/functions/theme-breadcurmbs.php';


if (!class_exists('WPBakeryVisualComposerAbstract')) {
	$dir = dirname(__FILE__) . '/wpbakery/';
	$composer_settings = Array(
		'APP_ROOT'      => $dir . '/js_composer/',
		'WP_ROOT'       => dirname( dirname( dirname( dirname($dir ) ) ) ). '/',
		'APP_DIR'       => basename( $dir ) . '/js_composer/',
		'CONFIG'        => $dir . '/js_composer/config/',
		'ASSETS_DIR'    => 'assets/',
		'COMPOSER'      => $dir . '/js_composer/composer/',
		'COMPOSER_LIB'  => $dir . '/js_composer/composer/lib/',
		'SHORTCODES_LIB'  => $dir . '/js_composer/composer/lib/shortcodes/',
		'USER_DIR_NAME'  => 'vc_templates', /* Path relative to your current theme, where VC should look for new shortcode templates */

		//for which content types Visual Composer should be enabled by default
		//'default_post_types' => Array('page', 'us_portfolio', 'post'),
      'default_post_types' => Array('page', 'us_portfolio'),
	);
	require_once(get_template_directory().'/wpbakery/js_composer/js_composer.php');
	$wpVC_setup->init($composer_settings);

    vc_disable_frontend();
}

add_action( 'admin_menu', 'register_my_home_page' );
function register_my_home_page(){	
	$show_page_front = get_option('page_on_front');		
	
	if(!empty($show_page_front) ){		
		$front_page = $show_page_front;		
		/*		 $page_template = get_post_meta( $front_page , '_wp_page_template' , true);		 if($page_template != 'page-home.php'){			update_post_meta( $front_page , '_wp_page_template' , 'page-home.php' , $page_template);		 }		add_menu_page( 'Home', 'Home Page' , 'manage_options', '/post.php?post='. get_option('page_on_front') . '&action=edit', '','', 22 );		*/	
	}else{		
		$page_home = get_page_by_title( 'Home' );				
		if( $page_home ){			
			$front_page = $page_home->ID;  		
		}else{				
		
		}	
	}		

	if( $show_page_front != 'page' && !empty($front_page) ){		
		update_option('show_on_front', 'page');	
		update_option('page_on_front', $front_page);	
	}		
	if(!empty($front_page) ){				 
		$page_template = get_post_meta( $front_page , '_wp_page_template' , true);		 
		if($page_template != 'page-home.php'){			
			update_post_meta( $front_page , '_wp_page_template' , 'page-home.php' , $page_template);		 
		}		
		add_menu_page( 'Home', 'Home Page' , 'manage_options', '/post.php?post='. $front_page . '&action=edit', '','', 22 );	
	}		
	add_menu_page( 'Categories', 'Image Categories' , 'manage_options', '/edit-tags.php?taxonomy=img_cat&post_type=attachment', '','', 28 );

}

function wp_get_attachment( $attachment_id ) {

	$attachment = get_post( $attachment_id );
	return array(
		'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
		'caption' => $attachment->post_excerpt,
		'description' => $attachment->post_content,
		'href' => get_permalink( $attachment->ID ),
		'src' => $attachment->guid,
		'title' => $attachment->post_title
	);
}

function clean($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

function unhide_kitchensink( $args ) {
$args['wordpress_adv_hidden'] = false;
return $args;
}
add_filter( 'tiny_mce_before_init', 'unhide_kitchensink' );


if (is_admin()) :
function spoke_remove_homepage_meta() {
	$front_page = get_option('page_on_front');
	if ( ( isset($_GET['post']) && $front_page == $_GET['post'] ) && (  isset($_GET['action']) && $_GET['action'] == 'edit'  ) ) {
	 
		  remove_meta_box('pageparentdiv', 'page', 'side'); 
		  remove_meta_box('postimagediv', 'page', 'side'); 
		    
	 }
	  remove_meta_box('postimagediv', 'gallery', 'side'); 
}
add_action( 'do_meta_boxes', 'spoke_remove_homepage_meta' );
endif;



function add_social_placeholder(){ ?>

<script>
	jQuery(document).ready(function(){ 
		jQuery('#customize-control-ctr_spoke_social_facebook input, #customize-control-ctr_spoke_social_twitter input, #customize-control-ctr_spoke_social_google input, #customize-control-ctr_spoke_social_linkedin input, #customize-control-ctr_spoke_social_youtube input, #customize-control-ctr_spoke_social_vimeo input, #customize-control-ctr_spoke_social_flickr input, #customize-control-ctr_spoke_social_instagram input, #customize-control-ctr_spoke_social_pinterest input, #customize-control-ctr_spoke_social_tumblr input, #customize-control-ctr_spoke_social_dribbble input, #customize-control-ctr_spoke_social_skype input').attr("placeholder","Enter social link to enable icon");
	});  
</script>
<?php 
}

add_action('customize_controls_print_footer_scripts','add_social_placeholder');




 