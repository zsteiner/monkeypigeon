<?php 

function spoke_content_import(){
	
	$content_opt = get_option('spoke_content_option');
	
	if( ! $content_opt || $content_opt == 'dismissed'){
		if( isset( $_POST['demo_content'] ) ){
			include_once( TEMPLATEPATH . '/functions/autoimporter.php' );

			/* // call the function */
			update_option('spoke_content_option','imported');
			$args = array(
					'file'        => TEMPLATEPATH . '/functions/autoimport/test-english.xml',
					'map_user_id' => 1
			);

			auto_import( $args );  
			
//			$args = array(
//					'file'        => TEMPLATEPATH . '/functions/autoimport/test-attachments.xml',
//					'map_user_id' => 1
//			);
//
//			auto_import( $args );
			
		}
	}
}

/* //add_action('after_setup_theme', 'spoke_content_import'); */

add_action('after_setup_theme', 'spoke_content_post_check');

function spoke_content_post_check(){ 
	if( isset( $_POST['demo_content'] ) ){
	
		$slider = new RevSlider();
		$response = $slider->importSliderFromPost(true, true);

		spoke_content_import();
		$form_url = admin_url( 'themes.php?page=spoke-theme-option&demo_status=activate' );
		wp_safe_redirect( $form_url );
	} elseif ( isset( $_POST['dismiss_demo_content'] ) ) {
		update_option('spoke_content_option','dismissed');
	}

}


add_action('admin_head', 'spoke_content_import_notice');

function spoke_content_import_notice(){ 
?>
<style>
.fonts_option_form{
	background-color: #FFFFFF;
    border-left: 4px solid #7AD03A;
    box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.1);
	margin: 5px 0 15px;
}
.fonts_option_div{
	height: 300px;
	overflow-y: scroll;
}
.fonts_options_list{
	width: 100%;
}

.fonts_options_list li{
	width: 13%;
	float: left;
	padding-left: 10px;
}

</style>
<script>
var category_html = "";
jQuery(document).ready(function($){
<?php 
	$content_opt = get_option('spoke_content_option'); 
	$form_url = admin_url( 'themes.php?page=spoke-theme-option' );

	if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
		$slider_zip = dirname(__FILE__) . '\autoimport\spokeintro.zip';
	} else {
		$slider_zip = dirname(__FILE__) . '/autoimport/spokeintro.zip';
	}
	
	
	if( ! $content_opt){
?>
	var html = '<div class="updated" id="message2">' ;
		html += '<form id="spoke_theme_option_form" action="<?php echo $form_url;?>" method="post">' ;
		html += '<input type="hidden" name="import_filename" id="import_filename" value=<?php echo json_encode($slider_zip) ;?> />';
		html += '<p> Install demo content for this theme? &nbsp; <input type="submit" value="Install Content" name="demo_content" class="button button-primary save" /> &nbsp; &nbsp; <input type="submit" value="Dismiss" name="dismiss_demo_content" class="button button-primary save" /> </p></form> </div>' ;
	$('#wpbody-content').find('.wrap').prepend(html);
	
<?php 
	}elseif( $content_opt == 'dismissed'){
		if( isset( $_GET['page'] ) && $_GET['page'] == 'spoke-theme-option' ):
?>
	var html = '<div class="updated" id="message2">' ;
		html += '<form id="spoke_theme_option_form" action="<?php echo $form_url;?>" method="post" onsubmit="return submitdata();">' ;
		html += '<input type="hidden" name="import_filename" id="import_filename" value=<?php echo json_encode($slider_zip) ;?> /> ';
		html += '<p> Install demo content for this theme? &nbsp; <input type="submit" value="Install Content" name="demo_content" class="button button-primary save" /> &nbsp; &nbsp;  </p></form> </div>' ;
	$('#wpbody-content').find('.dismiss-area').prepend(html);
	

<?php 		
		endif;
	}	?>
	 
	
});
	
</script>
	
	<?php 

}



function create_post_type() {
	register_post_type( 'gallery',
		array(
			'labels' => array(
				'name' => 'Galleries',
				'singular_name' => 'Gallery',
				'featured_image' => 'Thumbnail Cover',
				'set_featured_image' => 'Set thumbnail cover',
				'remove_featured_image' => 'Remove thumbnail cover',
				'use_featured_image' => 'Use as thumbnail cover',
				'menu_name'          =>  'Galleries', 
				'name_admin_bar'     =>  'Gallery', 
				'add_new'            =>  'Add New', 
				'add_new_item'       =>  'Add New Gallery', 
				'new_item'           =>  'New Gallery', 
				'edit_item'          =>  'Edit Gallery', 
				'view_item'          =>  'View Gallery', 
				'all_items'          =>  'All Galleries', 
				'search_items'       =>  'Search Galleries', 
				'parent_item_colon'  =>  'Parent Galleries:', 
				'not_found'          =>  'No Galleries found.', 
				'not_found_in_trash' =>  'No Galleries found in Trash.'
			),
		'public' => true,
		'has_archive' => true,
		'supports' => array('title', 'editor', 'thumbnail')
		)
	);
	
	
register_post_type( 'us_client',

	array(

		'labels' => array(

			'name' => 'Clients Logos',

			'singular_name' => 'Client Logo',

			'add_new' => 'Add Client Logo',
			'menu_name'          =>  'Clients Logos', 
			'name_admin_bar'     =>  'Client Logo',  
			'add_new_item'       =>  'Add New Client Logo', 
			'new_item'           =>  'New Client Logo', 
			'edit_item'          =>  'Edit Client Logo', 
			'view_item'          =>  'View Client Logo', 
			'all_items'          =>  'All Clients Logos', 
			'search_items'       =>  'Search Clients Logos', 
			'parent_item_colon'  =>  'Parent Clients Logos:', 
			'not_found'          =>  'No Clients Logos found.', 
			'not_found_in_trash' =>  'No Clients Logos found in Trash.'

		),

		'public' => true,

		'publicly_queryable' => false,

		'has_archive' => true,

		'supports' => array('title', 'thumbnail'),

		'can_export' => true,

	)

);
	
	$labels = array(
		'name'              => _x( 'Gallery Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Gallery Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Gallery Categories' ),
		'all_items'         => __( 'All Gallery Categories' ),
		'parent_item'       => __( 'Parent Category' ),
		'parent_item_colon' => __( 'Parent Category:' ),
		'edit_item'         => __( 'Edit Category' ),
		'update_item'       => __( 'Update Category' ),
		'add_new_item'      => __( 'Add New Category' ),
		'new_item_name'     => __( 'New Category Name' ),
		'menu_name'         => __( 'Image Categories' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'img_cat' ),
	);

	register_taxonomy( 'img_cat', array( 'attachment' ), $args );
	
	
}
add_action( 'init', 'create_post_type' );

function set_messages($messages) {
	global $post, $post_ID;
	$post_type = get_post_type( $post_ID );

	$obj = get_post_type_object($post_type);
	$singular = $obj->labels->singular_name;

	$messages[$post_type] = array(
	0 => '', /* / Unused. Messages start at index 1. */
	1 => sprintf( __($singular.' updated. <a href="%s">View '.strtolower($singular).'</a>'), esc_url( get_permalink($post_ID) ) ),
	2 => __('Custom field updated.'),
	3 => __('Custom field deleted.'),
	4 => __($singular.' updated.'),
	5 => isset($_GET['revision']) ? sprintf( __($singular.' restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
	6 => sprintf( __($singular.' published. <a href="%s">View '.strtolower($singular).'</a>'), esc_url( get_permalink($post_ID) ) ),
	7 => __('Page saved.'),
	8 => sprintf( __($singular.' submitted. <a target="_blank" href="%s">Preview '.strtolower($singular).'</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	9 => sprintf( __($singular.' scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview '.strtolower($singular).'</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
	10 => sprintf( __($singular.' draft updated. <a target="_blank" href="%s">Preview '.strtolower($singular).'</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	);
	return $messages;
}

add_filter('post_updated_messages', 'set_messages' );


function add_media_categories($fields, $post) {
	$all_cats = "";
	$edit_url = admin_url( 'edit-tags.php?taxonomy=img_cat&post_type=attachment' );
    $categories = get_categories(array('taxonomy' => 'img_cat', 'hide_empty' => 0));
    $post_categories = wp_get_object_terms($post->ID, 'img_cat', array('fields' => 'ids'));
    $all_cats .= 'Add Category: <br/> <input type="text" class="txt_add_img_cat" /> <input type="button" class="btn_add_img_cat button tagadd" value="Add Image Category"> '; 
	
	$help_css = 'display:none;position:absolute;background-color:#ffffe0;text-align:left;border:1px solid #dfdfdf;padding:10px;width:75%;font-weight:normal;border-radius:3px;';
	$desc_text = '<div id=\'wpgcl_gallery_link_url_help\' style=\''.$help_css.'\'>  Please limit your text to 200 characters. <a href=\'#\' id=\'link_desc_help_close\' >[X]</a> </div>';
	
    $all_cats_script = ' <script>
	jQuery(document).ready(function($){
        $(\'.setting[data-setting="description"]\').find("span:first").html(\'Description\');
        $(\'.setting[data-setting="description"]\').find("span:first").append(" <a href=\'#\' id=\'link_desc_help\' >[?]</a> ");
        $(\'.setting[data-setting="description"]\').find("span:first").append(" '. $desc_text .' ");
        $(\'.setting[data-setting="description"]\').find("textarea").attr( "maxlength","200" );

        $(\'#link_desc_help\').click(function(){
            $(\'#wpgcl_gallery_link_url_help\').show();
            return false;
        });

        $(\'#link_desc_help_close\').click(function(){
            $(\'#wpgcl_gallery_link_url_help\').hide();
            return false;
        });

        $(".btn_add_img_cat").click(function(){
            var orig_catname = $(".txt_add_img_cat").val(); 		
            if( orig_catname ) {		
                var cat_name = "";
                var cat_html = "";
                cat_name = orig_catname.toLowerCase();
                cat_name = cat_name.replace(/ /g, "-");
                cat_html = \'<li id="'.$post->ID.'-\' + cat_name + \'_list"><input class="cat_list_check" type="checkbox" name="added_gallery[]" id="'.$post->ID.'-\' + cat_name + \'" value="\' + orig_catname + \'"> <label for="'.$post->ID.'-\' + cat_name + \'"> \' + orig_catname + \'</label></li>\';
                category_html += orig_catname + "%";
                $("#media-categories-list").append(cat_html);
                $(".txt_add_img_cat").val(""); 
                $("#'.$post->ID.'-" + cat_name).click(); 
                $("#media-categories-list").toggle("fade");
                $("#media-categories-list").after("Saving. Please wait.");
            }
        });

	 
		$(".cat_list_check").each(function(){
		
			$(this).click(function(){ 
				$("#media-categories-list").fadeToggle("fast",function(){
					$("#media-categories-list").before("Saving. Please wait.");
				});
				
			});
		
		});
		
	});
	
	if(category_html){  
        jQuery(document).ready(function($){
	
			var categories = category_html.split("%"); 
			categories.sort(); 
			var num_cats = categories.length; 
			var last_id = "";
			var sorted = "yes";
			for(var i = 0 ; i < num_cats ; i++  ){
				if(categories[i]){
					var cat_html = "";
					var orig_catname = categories[i]; 
					cat_name = orig_catname.toLowerCase();
					cat_name = cat_name.replace(/ /g, "-");
					var check_id = "'.$post->ID.'-" + cat_name;
					var find_check = $("#" + check_id ).length; 
					if(! find_check){ 
						sorted = "no";
						cat_html = \'<li id="'.$post->ID.'-\' + cat_name + \'_list"><input class="cat_list_check" type="checkbox" name="added_gallery[]" id="'.$post->ID.'-\' + cat_name + \'" value="\' + cat_name + \'"> <label for="'.$post->ID.'-\' + cat_name + \'"> \' + orig_catname + \'</label></li>\';
						$("#media-categories-list").append(cat_html);	
						last_id = "'.$post->ID.'-" + cat_name ; 
					}
				}
			}
            if(sorted == "no"){
                $("#media-categories-list").toggle("fade");
                $("#media-categories-list").after(" Loading the Categories. Please wait.");

            }
            $("#" + last_id).change();
	
        });
	
 	}
	
	</script>' ;
	$all_cats .= ' <ul id="media-categories-list" style="width:500px;">	'; 
    
    foreach ($categories as $category) {
        if (in_array($category->term_id, $post_categories)) {
            $checked = ' checked="checked"';
        } else {
            $checked = '';  
        }
        $option = '<li id="'.$post->ID.'-'.$category->category_nicename.'_list"><input class="cat_list_check" type="checkbox" value="'.$category->category_nicename.'" id="'.$post->ID.'-'.$category->category_nicename.'" name="'.$post->ID.'-'.$category->category_nicename.'"'.$checked.'> ';
        $option .= '<label for="'.$post->ID.'-'.$category->category_nicename.'">'.$category->cat_name.'</label>';
        $option .= '</li>';
        $all_cats .= $option;
    }
    $all_cats .= '</ul>' . $all_cats_script ;

    $categories = array('img_cat' => array (
            'label' => __('Gallery Categories : '),
            'input' => 'html',
            'html' => $all_cats
    ));
    return array_merge($fields, $categories);
}
add_filter('attachment_fields_to_edit', 'add_media_categories', null, 2);

function add_image_attachment_fields_to_save($post, $attachment) {

    $terms = array();
	
	if( isset( $_POST['added_gallery'] ) ){
		$added_gallery =  $_POST['added_gallery'];
		$cat_name = $added_gallery[0];
		$term = term_exists($cat_name, 'img_cat');
		
		if ($term !== 0 && $term !== null) {
		
		} else {
			$term_name = str_replace('-',' ', $cat_name);
			wp_insert_term(
			  $term_name, /* the term  */
			  'product', /* the taxonomy*/
			  array( 
				'slug' => $cat_name
			  )
			); 
		}
		$terms[] = $cat_name;
	}

    $categories = get_categories(array('taxonomy' => 'img_cat', 'hide_empty' => 0));
	
    foreach($categories as $category) {
        if (isset($_POST[$post['ID'].'-'.$category->category_nicename])) {
            $terms[] = $_POST[$post['ID'].'-'.$category->category_nicename];        
        }
    }
    wp_set_object_terms( $post['ID'], $terms, 'img_cat' );
    return $post;
}
add_filter('attachment_fields_to_save', 'add_image_attachment_fields_to_save', null , 2);

 

add_action('init', 'hide_editor'); 
function hide_editor() {
	remove_post_type_support( 'gallery', 'editor' ); 
}  

add_action('admin_menu', 'spoke_theme_option_page');

function spoke_theme_option_page() {
	add_theme_page('Spoke Theme Option', 'Spoke Theme Options', 'edit_theme_options', 'spoke-theme-option', 'spoke_theme_option_page_func');
}

function spoke_theme_option_page_func(){ 
$form_url = admin_url( 'themes.php?page=spoke-theme-option' );

$fonts = json_decode( 
	file_get_contents( 'https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyC_jRCMhhUctxMJ-kmPRj2tE1fgUE9vlII' ) 
	); 
$font_items = $fonts->items;
	/* echo '<pre>'; print_r($font_items); echo '</pre>';	die(); */
 /* $installed_fonts = get_option( 'spoke_installed_fonts' , ''); */

?>
<script>
	function submitdata() { 
        return confirm("Are you sure you want to proceed?"); 
    }
</script>
<div class="wrap">
	<h2> Spoke Theme Options </h2>
 
	<p> Thank you for choosing Spoke Theme </p>

	<div class="dismiss-area">
	</div>
	
	<div class="updated" id="message2"> 
	<?php $content_opt = get_option('spoke_content_option');
		if( isset( $_GET['demo_status'] ) || $content_opt == 'imported' ){ ?>
		<p> Default content has already been installed. </p>
		<?php } ?>
		
		<p>To enhance your website, click the button to customize.  &nbsp; <a href="<?php echo admin_url('customize.php' ); ?>"> <input type="submit" value="Customize" name="customize_website" class="button button-primary save" /> </a> </p> 
		 
	</div>
	
	<div class="fonts_option_container">
	<h3> Theme Fonts </h3>
	<p> Select the fonts to be used in the theme. To know more and view the fonts, visit <a href="http://www.google.com/fonts" target="_blank">Google Fonts page</a></p>
	
	<?php 
		if( isset($_POST['spoke_theme_fonts']) ){
			update_option( 'spoke_installed_fonts' , $_POST['spoke_theme_fonts'] );
		}
	?>
		<form action="<?php echo $form_url; ?>" method="post">
			<div class="fonts_option_form">
			<div id="message3" class="  fonts_option_div">
			
				<ul class="fonts_options_list">
					<?php 
	$fonts_collection = array(  
	'Balthazar' => 'Balthazar, regular', 
	'Audiowide' => 'Audiowide, regular',
	'Oranienbaum' => 'Oranienbaum, regular',
	'Duru Sans' => 'Duru Sans, regular',
	'Alef' => 'Alef, regular',
	'Felipa' => 'Felipa, regular',
	'Great Vibes' => 'Great Vibes, regular',
	'Courgette' => 'Courgette, regular',
	'Petit Formal Script' => 'Petit Formal Script, regular',
	'Bad Script' => 'Bad Script, regular'
);
$fonts_collection = array();
$installed_fonts = get_option( 'spoke_installed_fonts', true);
  
if( $installed_fonts && $installed_fonts != 1 ):
	 foreach( $installed_fonts as $font):
		$fonts_collection[$font] = $font . ", regular";
	 endforeach;
endif;
  
						$i = 1;
						foreach($font_items as $font): 
							$checked = "";
							if( isset( $fonts_collection[ $font->family ] ) ){
								$checked = " checked='true' ";
							}
							echo "<li><input type='checkbox' name='spoke_theme_fonts[]' value='{$font->family}' $checked /> {$font->family} </li>";
							if($i == 7){
								$i = 0;
								echo "</ul><div class='clear'></div><ul class='fonts_options_list'>";
							}
							$i++;
						endforeach;
					?>
				</ul>
				<div class="clear"></div>
			</div>
			</div>
			<input type="submit" value="Include Selected Fonts" name="customize_website_fonts" class="button button-primary save" /> 
		</form>
	</div> 
</div>

<?php 
  /*// echo '<pre>'; print_r($_POST); echo '</pre>'; */
}
?>
