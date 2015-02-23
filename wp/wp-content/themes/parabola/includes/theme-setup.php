<?php
/*
 * Theme setup functions. Theme initialization, theme support , widgets , navigation
 *
 * @package parabola
 * @subpackage Functions
 */

/*
// Bringing up Parabola Settings page after install
if ( is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {
	wp_redirect( 'themes.php?page=parabola-page' );
}
*/

$parabola_totalSize = $parabola_sidebar + $parabola_sidewidth;

 /**

 *
 * @package Cryout Creations
 * @subpackage parabola
 * @since parabola 0.5
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = $parabola_sidewidth;

/** Tell WordPress to run parabola_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'parabola_setup' );

if ( ! function_exists( 'parabola_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override parabola_setup() in a child theme, add your own parabola_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since parabola 0.5
 */
function parabola_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style( "styles/editor-style.css" );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150 ); // default Post Thumbnail dimensions (cropped)

	// Add default posts and comments RSS feed links to head

	add_theme_support( 'automatic-feed-links' );
	add_theme_support('post-formats', array( 'aside', 'chat', 'gallery', 'image', 'link', 'quote', 'status','video'));

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'parabola', get_template_directory() . '/languages' );

	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );



	// This theme uses wp_nav_menu() in 3 locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'parabola' ),
		'top' => __( 'Top Navigation', 'parabola' ),
		'footer' => __( 'Footer Navigation', 'parabola' ),
	) );

	// This theme allows users to set a custom background
	add_theme_support( 'custom-background' );

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be the same size as the header.
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	global $parabola_hheight;
	$parabola_hheight=(int)$parabola_hheight;
	global $parabola_totalSize;
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'parabola_header_image_width', $parabola_totalSize ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'parabola_header_image_height', $parabola_hheight) );
	//set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );
	add_image_size('header',HEADER_IMAGE_WIDTH,HEADER_IMAGE_HEIGHT,true);	

	global $parabola_fpsliderwidth;
	global $parabola_fpsliderheight;
	add_image_size('slider',$parabola_fpsliderwidth,$parabola_fpsliderheight,true);
	// Add a way for the custom header to be styled in the admin panel that controls
	// custom headers. See parabola_admin_header_style(), below.
	define( 'NO_HEADER_TEXT', true );
	add_theme_support( 'custom-header' );
	// ... and thus ends the changeable header business.

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(

		'parabola' => array(
			'url' => '%s/images/headers/parabola.jpg',
			'thumbnail_url' => '%s/images/headers/parabola_thumbnail.jpg',
			'description' => __( 'Parabola Default Header Image', 'parabola' )
		),


	) );
}
endif;

if ( ! function_exists( 'parabola_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in parabola_setup().
 *
 * @since parabola 0.5
 */
function parabola_admin_header_style() {
?>
<style type="text/css">
/* Shows the same border as on front end */
#headimg {
	border-bottom: 1px solid #000;
	border-top: 4px solid #000;
}
/* If NO_HEADER_TEXT is false, you would style the text with these selectors:
	#headimg #name { }
	#headimg #desc { }
*/
</style>
<?php
}
endif;

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since parabola 0.5
 */
function parabola_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'parabola_page_menu_args' );

/**
 * Create menus
 */

// TOP MENU
function parabola_top_menu() {
 if ( has_nav_menu( 'top' ) ) wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'topmenu', 'theme_location' => 'top', 'depth' =>1 ) );
 }

 add_action ('cryout_masthead_hook','parabola_top_menu');

 // MAIN MENU
 function parabola_main_menu() {
  /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff */ ?>
<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'parabola' ); ?>"><?php _e( 'Skip to content', 'parabola' ); ?></a></div>
<?php /* Main navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu.  The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */
wp_nav_menu( array( 'container_class' => 'menu', 'menu_id' =>'prime_nav', 'theme_location' => 'primary','link_before' => '<span>', 'link_after' => '</span>' ) );
}

add_action ('cryout_access_hook','parabola_main_menu');

// FOOTER MENU
 function parabola_footer_menu() {
  if ( has_nav_menu( 'footer' ) ) wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'footermenu', 'theme_location' => 'footer', 'depth' =>1 ) );
  }

  add_action ('cryout_footer_hook','parabola_footer_menu',10);


/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override parabola_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since parabola 0.5
 * @uses register_sidebar
 */
function parabola_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Left Sidebar', 'parabola' ),
		'id' => 'left-widget-area',
		'description' => __( 'Left sidebar', 'parabola' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Right Sidebar', 'parabola' ),
		'id' => 'right-widget-area',
		'description' => __( 'Right sidebar', 'parabola' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 5, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Area', 'parabola' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'First footer area', 'parabola' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 6, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Area', 'parabola' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'Second footer area', 'parabola' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 7, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer Area', 'parabola' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer area', 'parabola' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 8, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Footer Area', 'parabola' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer area', 'parabola' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

		// Area 9, located above the content area. Empty by default.
	register_sidebar( array(
		'name' => __( 'Above Content Area', 'parabola' ),
		'id' => 'above-content-widget-area',
		'description' => __( 'Above Content Area', 'parabola' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

		// Area 10, located below the content area. Empty by default.
	register_sidebar( array(
		'name' => __( 'Below Content Area', 'parabola' ),
		'id' => 'below-content-widget-area',
		'description' => __( 'Below Content Area', 'parabola' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
		// Area 0, located inside the header
	register_sidebar( array(
		'name' => __( 'Header Widgets', 'parabola' ),
		'id' => 'header-widget-area',
		'description' => __( 'Header Widgets', 'parabola' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
/** Register sidebars by running parabola_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'parabola_widgets_init' );


/**
 * Creates different class names for footer widgets depending on their number.
 * This way they can fit the footer area.
 */

function parabola_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'first-footer-widget-area' ) )
		$count++;

	if ( is_active_sidebar( 'second-footer-widget-area' ) )
		$count++;

	if ( is_active_sidebar( 'third-footer-widget-area' ) )
		$count++;

	if ( is_active_sidebar( 'fourth-footer-widget-area' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
		case '4':
			$class = 'four';
			break;
	}

	if ( $class )
		echo 'class="footer' . $class . '"';
}

 function parabola_header_widget() {
 if ( is_active_sidebar( 'header-widget-area' )) { ?>
		<div id="header-widget-area">
			<ul class="yoyo">
				<?php dynamic_sidebar( 'header-widget-area' ); ?>
			</ul>
		</div>
		<?php } }
		
add_action ('cryout_header_widgets_hook','parabola_header_widget');


 function parabola_above_widget() {
 if ( is_active_sidebar( 'above-content-widget-area' )) { ?>
			<ul class="yoyo">
				<?php dynamic_sidebar( 'above-content-widget-area' ); ?>
			</ul>
		<?php } }

function parabola_below_widget() {
 if ( is_active_sidebar( 'below-content-widget-area' )) { ?>
			<ul class="yoyo">
				<?php dynamic_sidebar( 'below-content-widget-area' ); ?>
			</ul>
		<?php } }

add_action ('cryout_before_content_hook','parabola_above_widget');
add_action ('cryout_after_content_hook','parabola_below_widget');

?>