<?php
function us_fonts() {
	global $smof_data;
	$protocol = is_ssl() ? 'https' : 'http';
	if (empty($smof_data['font_subset'])) {
		$subset = '';
	} else {
		$subset = '&subset='.$smof_data['font_subset'];
	}
	if ($smof_data['body_text_font'] != '' AND $smof_data['body_text_font'] != 'none')
	{
		wp_enqueue_style( 'us-body-text-font', "$protocol://fonts.googleapis.com/css?family=".str_replace(' ', '+', $smof_data['body_text_font']).":400,700,400italic,700italic".$subset );
	}
	else
	{
		wp_enqueue_style( 'us-body-text-font', "$protocol://fonts.googleapis.com/css?family=Open+Sans:400,700,400italic,700italic".$subset );
	}
	if ($smof_data['body_text_font'] != $smof_data['navigation_font'] AND $smof_data['navigation_font'] != '' AND $smof_data['navigation_font'] != 'none')
	{
		wp_enqueue_style( 'us-navigation-font', "$protocol://fonts.googleapis.com/css?family=".str_replace(' ', '+', $smof_data['navigation_font']).$subset );
	}
	if ($smof_data['heading_font'] != '' AND $smof_data['heading_font'] != 'none')
	{
		wp_enqueue_style( 'us-heading-font', "$protocol://fonts.googleapis.com/css?family=".str_replace(' ', '+', $smof_data['heading_font']).":400,700".$subset );
	}
	else
	{
		wp_enqueue_style( 'us-heading-font', "$protocol://fonts.googleapis.com/css?family=Noto+Sans:400,700".$subset );
	}
}
//add_action( 'wp_enqueue_scripts', 'us_fonts' );
function us_styles()
{
	wp_register_style( 'us_motioncss', get_template_directory_uri() . '/css/motioncss.css', array(), '1', 'all' );
	wp_register_style( 'maincss',get_template_directory_uri() . '/css/main.css', array(), '1', 'all' );
	wp_register_style( 'us_motioncss-widgets', get_template_directory_uri() . '/css/motioncss-widgets.css', array(), '1', 'all' );
	wp_register_style( 'us_font-awesome', get_template_directory_uri() . '/css/font-awesome.css', array(), '1', 'all' );
	wp_register_style( 'us_magnific-popup', get_template_directory_uri() . '/css/magnific-popup.css', array(), '1', 'all' );
	wp_register_style( 'us_wp-widgets', get_template_directory_uri() . '/css/wp-widgets.css', array(), '1', 'all' );
//	wp_register_style( 'us_woocommerce', get_template_directory_uri() . '/css/woocommerce-impreza.css', array(), '1', 'all' );
	wp_register_style( 'us_style', get_template_directory_uri() . '/css/style.css', array(), '1', 'all' );
	wp_register_style( 'us_responsive', get_template_directory_uri() . '/css/responsive.css', array(), '1', 'all' );
	wp_register_style( 'us_animation', get_template_directory_uri() . '/css/animation.css', array(), '1', 'all' );
	wp_register_style( 'impeza-style' ,  get_stylesheet_directory_uri() . '/style.css', array(), '1', 'all' );
	//wp_register_style( 'bootstrap_responsives',get_template_directory_uri() . '/css/bootstrap-responsive.css', array(), '1', 'all' );
	wp_enqueue_style( 'bootstrap_responsives' ); 
	wp_enqueue_style( 'us_motioncss' );
	wp_enqueue_style( 'maincss' );
	wp_enqueue_style( 'us_motioncss-widgets' );
	wp_enqueue_style( 'us_font-awesome' );
	//wp_enqueue_style( 'us_magnific-popup' );
	wp_enqueue_style( 'us_wp-widgets' );
//	wp_enqueue_style( 'us_woocommerce' );
	wp_enqueue_style( 'us_style' );
	wp_enqueue_style( 'us_responsive' );
	wp_enqueue_style( 'us_animation' );
	
		wp_enqueue_style( 'impeza-style');
}
add_action('wp_enqueue_scripts', 'us_styles', 12);
function us_jscripts()
{
	wp_register_script('us_modernizr', get_template_directory_uri().'/js/modernizr.js', array('jquery'), '', TRUE);
	wp_register_script('us_carousello', get_template_directory_uri().'/js/jquery.carousello.js', array('jquery'), '', TRUE);
	wp_register_script('us_isotope', get_template_directory_uri().'/js/jquery.isotope.js', array('jquery'), '', TRUE);
	wp_register_script('us_magnific-popup', get_template_directory_uri().'/js/jquery.magnific-popup.js', array('jquery'), '', TRUE);
	wp_register_script('us_smoothScroll', get_template_directory_uri().'/js/jquery.smoothScroll.js', array('jquery'), '', TRUE);
	wp_register_script('us_simpleplaceholder', get_template_directory_uri().'/js/jquery.simpleplaceholder.js', array('jquery'), '', TRUE);
	wp_register_script('us_widgets', get_template_directory_uri().'/js/us.widgets.js', array('jquery'), '', TRUE);
	wp_register_script('us_waypoints', get_template_directory_uri().'/js/waypoints.min.js', array('jquery'), '', TRUE);
	wp_register_script('us_flexslider', get_template_directory_uri().'/js/jquery.flexslider.js', array('jquery'), '', TRUE);
	wp_register_script('us_parallax', get_template_directory_uri().'/js/jquery.parallax.js', array('jquery'), '', TRUE);
	wp_register_script('us_hor_parallax', get_template_directory_uri().'/js/jquery.horparallax.js', array('jquery'), '', TRUE);
	wp_register_script('us_plugins', get_template_directory_uri().'/js/plugins.js', array('jquery'), '', TRUE);
	wp_register_script('gmaps', get_template_directory_uri().'/js/jquery.gmap.min.js', array('jquery'), '', TRUE);
	wp_register_script('jqueryui', 'http://code.jquery.com/ui/1.10.4/jquery-ui.js', array('jquery'), '', TRUE);		wp_register_script('stellar', get_template_directory_uri().'/js/jquery.stellar.min.js', array('jquery'), '0.6.2', TRUE);	wp_register_script('iscroll', get_template_directory_uri().'/js/iscroll.js', array('jquery'), '4.2.5', TRUE);
	wp_register_script('custom_script', get_template_directory_uri().'/js/scripts.js', array('jquery'), '', TRUE);
	wp_register_script('bootstrap_min', get_template_directory_uri().'/js/bootstrap.min.js', array('jquery'), '', TRUE);
//	wp_register_script('', get_template_directory_uri().'/js/.js', array('jquery'), '');
	
	wp_enqueue_script('jqueryui');
	
	
	
	wp_enqueue_script('us_modernizr');
	wp_enqueue_script('us_carousello');
	wp_enqueue_script('us_isotope');
	//wp_enqueue_script('us_magnific-popup');
	wp_enqueue_script('us_smoothScroll');
	wp_enqueue_script('us_simpleplaceholder');
	wp_enqueue_script('us_widgets');
	wp_enqueue_script('us_waypoints');
	wp_enqueue_script('us_flexslider');
	wp_enqueue_script('us_parallax');	
	/*wp_enqueue_script('stellar');	
	wp_enqueue_script('iscroll');*/
	wp_enqueue_script('us_hor_parallax');
	wp_enqueue_script('us_plugins');
	wp_enqueue_script('bootstrap_min');	//wp_enqueue_script('custom_script');
}
add_action('wp_enqueue_scripts', 'us_jscripts');
function us_wp_admin_assets() {
	wp_register_style( 'admin_buttons', get_template_directory_uri() . '/css/buttons.css' );
	wp_enqueue_style( 'admin_buttons' );
}
add_action( 'admin_enqueue_scripts', 'us_wp_admin_assets' );
