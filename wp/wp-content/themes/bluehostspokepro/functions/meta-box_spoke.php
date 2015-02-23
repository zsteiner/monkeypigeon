<?php 
/* meta boxes */$spo_fix = "spoke_post_";$gallery_post = get_posts( array(	'post_type' => 'gallery',	'post_per_page' => '-1'));$gallery_options = array();$gallery_options[0] = 'Select Gallery';if( $gallery_post ):	foreach($gallery_post as $post){		$gallery_options[$post->ID] = $post->post_title;	}endif;
$meta_boxes[] = array(
	'id' => 'spoke_gallery_settings',
	'title' => 'Gallery Page Template Settings',
	'pages' => array( 'page'),
	'context' => 'normal',
	'priority' => 'low',  	'fields' => array(	    array(            'name'		=> 'Display Gallery',            'id'		=>  "spoke_page_gallery_id", 			'type'		=> 'select',						'desc'		=> 'Choose the gallery you want to display on this page.',						'options'	=> $gallery_options,         ),      ), 
);/* end of gallery metaboxes */
/* post metaboxes */$post_metafields = array(		array( 			'name'  => __( 'Overlay Color', 'spoke' ), 			'id'    => "{$spo_fix}overlay_color", 			'desc'  => __( 'Overlay color for featured image.', 'spoke' ),			'type'  => 'color',  		),	array( 			'name'  => __( 'Title Color', 'spoke' ), 			'id'    => "{$spo_fix}title_color", 			'desc'  => __( '', 'spoke' ),			'type'  => 'color',  		),	array( 			'name'  => __( 'Title Hover Color', 'spoke' ), 			'id'    => "{$spo_fix}title_hover_color", 			'desc'  => __( '', 'spoke' ),			'type'  => 'color',  		),	array( 			'name'  => __( 'Author Text Color', 'spoke' ), 			'id'    => "{$spo_fix}author_color", 			'desc'  => __( '', 'spoke' ),			'type'  => 'color',  		),	array( 			'name'  => __( 'Calendar Text Color', 'spoke' ), 			'id'    => "{$spo_fix}calendar_color", 			'desc'  => __( '', 'spoke' ),			'type'  => 'color',  		),	array( 			'name'  => __( 'Comment Text Color', 'spoke' ), 			'id'    => "{$spo_fix}comment_color", 			'desc'  => __( '', 'spoke' ),			'type'  => 'color',  		),	array( 			'name'  => __( 'Excerpt Text Color', 'spoke' ), 			'id'    => "{$spo_fix}excerpt_color", 			'desc'  => __( '', 'spoke' ),			'type'  => 'color',  		),);$meta_boxes[] = array(	'id' => 'spoke_post_settings',	'title' => 'Post Settings',	'pages' => array( 'post'),	'context' => 'side',	'priority' => 'default', 	/* List of meta fields */ 	'fields' =>  $post_metafields, );/*end of post metaboxes */
function spoke_register_meta_boxes()
{
	global $meta_boxes;
	//echo '<pre>'; print_r($meta_boxes); echo '</pre>'; die();
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( class_exists( 'RW_Meta_Box' ) )
	{
		foreach ( $meta_boxes as $meta_box )
		{
			new RW_Meta_Box( $meta_box );
		}
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'spoke_register_meta_boxes' );function spoke_gallery_js(){ ?>	 <script type="text/javascript">    jQuery(document).ready(function($) { 		var def_page = $( '#page_template' ).val(); 		check_gallery_template(def_page);		$('#spoke_gallery_settings').addClass('shown');				 $( '#page_template' ).change(function(){			var page = $(this).val();			check_gallery_template(page); 		 } );		 		 		 function check_gallery_template( page ){		 			if ( page == 'page-gallery.php' ) {								$('.composer-switch').slideUp('fast');				$('#wpb_visual_composer').slideUp('fast');				$('#postdivrich').slideUp('fast'); 				$('#spoke_gallery_settings').slideDown('fast');				$('#spoke_gallery_settings').addClass('shown');							} else {												if ( $('#spoke_gallery_settings').hasClass('shown') ) { 									var js_vc = $("#wpb_vc_js_status").val();					if( js_vc == "false"){						$('#postdivrich').slideDown('fast');					}else{						$('#wpb_visual_composer').slideDown('fast');					}					$('.composer-switch').slideDown('fast');					$('#spoke_gallery_settings').slideUp('fast');					$('#spoke_gallery_settings').removeClass('shown'); 									}  			} 		 }		 		     });                 </script>	<?php }add_action ( 'admin_footer', 'spoke_gallery_js' );