<?php 
/*
 * laurels Enqueue css and js files
*/
function laurels_enqueue()
{
	wp_enqueue_style( 'laurels-lato', laurels_font_url(), array(), null );
	wp_enqueue_style('laurels-bootstrap-min',get_template_directory_uri().'/css/bootstrap.min.css',array());
	wp_enqueue_style('laurels-font-awesome',get_template_directory_uri().'/css/font-awesome.css',array());
	wp_enqueue_style('laurels-custom',get_template_directory_uri().'/css/custom.css',array());
   	wp_enqueue_style('style',get_stylesheet_uri(),array());
	wp_enqueue_style('laurels-media',get_template_directory_uri().'/css/media.css',array());
	
	wp_enqueue_script('laurels-bootstrap-min-js',get_template_directory_uri().'/js/bootstrap.min.js',array('jquery'));
	if(is_page_template('page-template/home-page.php')){
		wp_enqueue_script('laurels-owl-carousel-min-js',get_template_directory_uri().'/js/owl.carousel.min.js',array('jquery'));
		wp_enqueue_style('laurels-owl-carousel-css',get_template_directory_uri().'/css/owl.carousel.css',array());
            wp_enqueue_script('laurels-default-js',get_template_directory_uri().'/js/default.js',array('jquery'));
	}

	if ( is_singular() ) wp_enqueue_script( "comment-reply" ); 
}
add_action('wp_enqueue_scripts', 'laurels_enqueue');	
