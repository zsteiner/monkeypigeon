<?php
function laurels_options_init(){
 register_setting( 'laurels_options', 'laurels_theme_options','laurels_options_validate');
} 
add_action( 'admin_init', 'laurels_options_init' );
function laurels_options_validate($input)
{
	 $input['logo'] = laurels_image_validation(esc_url_raw( $input['logo']));
	 $input['favicon'] = laurels_image_validation(esc_url_raw( $input['favicon']));
	 $input['footertext'] = sanitize_text_field( $input['footertext'] );
	 	
	 $input['facebook'] = esc_url_raw( $input['facebook'] );
	 $input['twitter'] = esc_url_raw( $input['twitter'] );
	 $input['pinterest'] = esc_url_raw( $input['pinterest'] );
	 $input['googleplus'] = esc_url_raw( $input['googleplus'] );
	 $input['rss'] = esc_url_raw( $input['rss'] );
	 $input['linkedin'] = esc_url_raw( $input['linkedin'] );

	for($laurels_i=1; $laurels_i <=5 ;$laurels_i++ ):
	 $input['slider-img-'.$laurels_i] = laurels_image_validation(esc_url( $input['slider-img-'.$laurels_i]));
	 $input['slidelink-'.$laurels_i] = esc_url( $input['slidelink-'.$laurels_i]);
	 endfor;
	 
	 $input['home-title'] = sanitize_text_field( $input['home-title'] );
	 $input['home-content'] = sanitize_text_field( $input['home-content'] );
	 
	 for($laurels_section_i=1; $laurels_section_i <=4 ;$laurels_section_i++ ):
	 $input['home-icon-'.$laurels_section_i] = laurels_image_validation(esc_url_raw( $input['home-icon-'.$laurels_section_i]));
	 $input['section-title-'.$laurels_section_i] = sanitize_text_field($input['section-title-'.$laurels_section_i]);
	 $input['section-content-'.$laurels_section_i] = sanitize_text_field($input['section-content-'.$laurels_section_i]);
	 endfor;
	 
	 
    return $input;
}
function laurels_image_validation($laurels_imge_url){
	$laurels_filetype = wp_check_filetype($laurels_imge_url);
	$laurels_supported_image = array('gif','jpg','jpeg','png','ico');
	if (in_array($laurels_filetype['ext'], $laurels_supported_image)) {
		return $laurels_imge_url;
	} else {
	return '';
	}
}
function laurels_framework_load_scripts(){
	wp_enqueue_media();
	wp_enqueue_style( 'laurels_framework', get_template_directory_uri(). '/theme-options/css/fasterthemes_framework.css' ,false, '1.0.0');
	// Enqueue custom option panel JS
	wp_enqueue_script( 'options-custom', get_template_directory_uri(). '/theme-options/js/fasterthemes-custom.js', array( 'jquery' ) );
	wp_enqueue_script( 'media-uploader', get_template_directory_uri(). '/theme-options/js/media-uploader.js', array( 'jquery') );		
}
add_action( 'admin_enqueue_scripts', 'laurels_framework_load_scripts' );
function laurels_framework_menu_settings() {
	$laurels_menu = array(
				'page_title' => __( 'FasterThemes Options', 'laurels_framework'),
				'menu_title' => __('Theme Options', 'laurels_framework'),
				'capability' => 'edit_theme_options',
				'menu_slug' => 'laurels_framework',
				'callback' => 'laurels_framework_page'
				);
	return apply_filters( 'fasterthemes_framework_menu', $laurels_menu );
}
add_action( 'admin_menu', 'laurels_options_add_page' ); 
function laurels_options_add_page() {
	$laurels_menu = laurels_framework_menu_settings();
   	add_theme_page($laurels_menu['page_title'],$laurels_menu['menu_title'],$laurels_menu['capability'],$laurels_menu['menu_slug'],$laurels_menu['callback']);
} 
function laurels_framework_page(){ 
		global $select_options; 
		if ( ! isset( $_REQUEST['settings-updated'] ) ) 
		$_REQUEST['settings-updated'] = false;		

?>
<div class="fasterthemes-themes">
	<form method="post" action="options.php" id="form-option" class="theme_option_ft">
  <div class="fasterthemes-header">
    <div class="logo">
      <?php
		$laurels_image=get_template_directory_uri().'/theme-options/images/logo.png';
		echo "<a href='http://fasterthemes.com' target='_blank'><img src='".$laurels_image."' alt='FasterThemes' /></a>";
		?>
    </div>
    <div class="header-right">
		<h1> <?php _e( 'Theme Options', 'laurels' ) ?> </h1>
		<div class='btn-save'><input type='submit' class='button-primary' value='<?php _e('Save Options','laurels') ?>' /></div>
    </div>
  </div>
  <div class="fasterthemes-details">
    <div class="fasterthemes-options">
      <div class="right-box">
        <div class="nav-tab-wrapper">
          <ul>
            <li><a id="options-group-1-tab" class="nav-tab basicsettings-tab" title="<?php _e('Basic Settings','laurels'); ?>" href="#options-group-1"><?php _e('Basic Settings','laurels'); ?></a></li>
            <li><a id="options-group-3-tab" class="nav-tab socialsettings-tab" title="<?php _e('Social Settings','laurels'); ?>" href="#options-group-3"><?php _e('Social Settings','laurels'); ?></a></li>
            <li><a id="options-group-2-tab" class="nav-tab homepagesettings-tab" title="<?php _e('Home page Settings','laurels'); ?>" href="#options-group-2"> <?php _e('Home page Settings','laurels'); ?></a></li>
            <li><a id="options-group-4-tab" class="nav-tab profeatures-tab" title="<?php _e('PRO Theme Features','laurels'); ?>" href="#options-group-4"><?php _e('PRO Theme Features','laurels'); ?></a></li>
  		  </ul>
        </div>
      </div>
      <div class="right-box-bg"></div>
      <div class="postbox left-box"> 
        <!--======================== F I N A L - - T H E M E - - O P T I O N ===================-->
          <?php settings_fields( 'laurels_options' );  
		$laurels_options = get_option( 'laurels_theme_options' );
		 ?>
        
            <!-------------- Header group ----------------->
          <div id="options-group-1" class="group faster-inner-tabs">   
          	<div class="section theme-tabs theme-logo">
            <a class="heading faster-inner-tab active" href="javascript:void(0)"><?php _e('Site Logo','laurels'); ?></a>
            <div class="faster-inner-tab-group active">
              	<div class="ft-control">
                <input id="logo-img" class="upload" type="text" name="laurels_theme_options[logo]" 
                            value="<?php if(!empty($laurels_options['logo'])) { echo esc_url($laurels_options['logo']); } ?>" placeholder="<?php _e('No file chosen','laurels'); ?>" />
                <input id="upload_image_button" class="upload-button button" type="button" value="<?php _e('Upload','laurels'); ?>" />
                <div class="screenshot" id="logo-image">
                  <?php if(!empty($laurels_options['logo'])) { echo "<img src='".esc_url($laurels_options['logo'])."' />
					  <a class='remove-image'></a>"; } ?>
                </div>
              </div>
            </div>
          </div>
            <div class="section theme-tabs theme-favicon">
              <a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Favicon','laurels'); ?></a>
              <div class="faster-inner-tab-group">
              	<div class="explain"><?php _e('Size of favicon should be exactly 32x32px for best results.','laurels'); ?></div>
                <div class="ft-control">
                  <input id="favicon-img" class="upload" type="text" name="laurels_theme_options[favicon]" 
                            value="<?php if(!empty($laurels_options['favicon'])) { echo esc_url($laurels_options['favicon']); } ?>" placeholder="<?php _e('No file chosen','laurels'); ?>" />
                  <input id="upload_image_button1" class="upload-button button" type="button" value="<?php _e('Upload','laurels'); ?>" />
                  <div class="screenshot" id="favicon-image">
                    <?php  if(!empty($laurels_options['favicon'])) { echo "<img src='".esc_url($laurels_options['favicon'])."' /><a class='remove-image'></a>"; } ?>
                  </div>
                </div>
              </div>
            </div>     
            <div id="section-footertext" class="section theme-tabs">
            	<a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Copyright Text','laurels'); ?></a>
              <div class="faster-inner-tab-group">
              	<div class="ft-control">
              		<div class="explain"><?php _e('Some text regarding copyright of your site, you would like to display in the footer.','laurels'); ?></div>                
                  	<input type="text" id="footertext" class="of-input" name="laurels_theme_options[footertext]" size="32"  value="<?php if(!empty($laurels_options['footertext'])) { echo esc_attr($laurels_options['footertext']); } ?>">
                </div>                
              </div>
            </div>
          </div>    
            
                   
          
          <!-- HOME PAGE -->
<div id="options-group-2" class="group faster-inner-tabs">  
	
	
	<h3><?php _e('Banner Slider','laurels'); ?></h3>
            <?php for($laurels_i=1; $laurels_i <= 5 ;$laurels_i++ ):?>
            <div class="section theme-tabs theme-slider-img"> <a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Slider','laurels');?> <?php echo $laurels_i;?></a>
              <div class="faster-inner-tab-group">
                <div class="ft-control">
                  <input id="slider-img-<?php echo $laurels_i;?>" class="upload" type="text" name="laurels_theme_options[slider-img-<?php echo $laurels_i;?>]" 
                            value="<?php if(!empty($laurels_options['slider-img-'.$laurels_i])) { echo esc_url($laurels_options['slider-img-'.$laurels_i]); } ?>" placeholder="<?php _e('No file chosen','placeholder'); ?>" />
                  <input id="1upload_image_button" class="upload-button button" type="button" value="<?php _e('Upload','laurels'); ?>" />
                  <div class="screenshot" id="slider-img-<?php echo $laurels_i;?>">
                    <?php if(!empty($laurels_options['slider-img-'.$laurels_i])) { echo "<img src='".esc_url($laurels_options['slider-img-'.$laurels_i])."' /><a class='remove-image'></a>"; } ?>
                  </div>
                </div>
                <div class="ft-control">
                  <input type="text" placeholder="<?php _e('Slide','laurels');?><?php echo $laurels_i; ?> <?php _e('Link','laurels'); ?>" id="slidelink-<?php echo $laurels_i;?>" class="of-input" name="laurels_theme_options[slidelink-<?php echo $laurels_i;?>]" size="32"  value="<?php if(!empty($laurels_options['slidelink-'.$laurels_i])) { echo esc_url($laurels_options['slidelink-'.$laurels_i]); } ?>">
                </div>
              </div>
            </div>
            <?php endfor; ?>
	
	
	
	<h3><?php _e('Title Bar','laurels'); ?></h3>	
	<div id="section-title" class="section theme-tabs"> <a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Title','laurels'); ?></a>
              <div class="faster-inner-tab-group">
                <div class="ft-control">
                  <div class="explain"><?php _e('Enter home page title for your site , you would like to display in the Home Page.','laurels'); ?></div>
                  <input id="title" class="of-input" name="laurels_theme_options[home-title]" type="text" size="50" value="<?php if(!empty($laurels_options['home-title'])) { echo esc_attr($laurels_options['home-title']); } ?>" />
                </div>
              </div>
            </div>
            <div class="section theme-tabs theme-short_description"> <a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Short Description','laurels'); ?></a>
              <div class="faster-inner-tab-group">
                <div class="ft-control">
                  <div class="explain"><?php _e('Enter home content for your site , you would like to display in the Home Page.','laurels'); ?></div>
                  <textarea name="laurels_theme_options[home-content]" rows="6" id="home-content1" class="of-input"><?php if(!empty($laurels_options['home-content'])) { echo esc_attr($laurels_options['home-content']); } ?></textarea>
                </div>
              </div>
            </div>


   <h3><?php _e('First Section','laurels'); ?></h3>
            <?php for($laurels_section_i=1; $laurels_section_i <=4 ;$laurels_section_i++ ): ?>
            <div class="section theme-tabs theme-slider-img"> <a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Tab','laurels'); ?> <?php echo $laurels_section_i; ?></a>
              <div class="faster-inner-tab-group">
                <div class="ft-control">
                  <input id="first-image-<?php echo $laurels_section_i;?>" class="upload" type="text" name="laurels_theme_options[home-icon-<?php echo $laurels_section_i;?>]" 
                            value="<?php if(!empty($laurels_options['home-icon-'.$laurels_section_i])) { echo esc_url($laurels_options['home-icon-'.$laurels_section_i]); } ?>" placeholder="<?php _e('No file chosen','laurels'); ?>" />
                  <input id="upload_image_button" class="upload-button button" type="button" value="<?php _e('Upload','laurels'); ?>" />
                  <div class="screenshot" id="first-img-<?php echo $laurels_section_i;?>">
                    <?php if(!empty($laurels_options['home-icon-'.$laurels_section_i])) { echo "<img src='".esc_url($laurels_options['home-icon-'.$laurels_section_i])."' /><a class='remove-image'></a>"; } ?>
                  </div>
                </div>
                <div class="ft-control">
                  <div class="explain"><?php _e('Enter secion title for your home template , you would like to display in the Home Page.','laurels'); ?></div>
                  <input type="text" placeholder="<?php _e('Enter title here','laurels'); ?>" id="title-<?php echo $laurels_section_i;?>" class="of-input" name="laurels_theme_options[section-title-<?php echo $laurels_section_i;?>]" size="32"  value="<?php if(!empty($laurels_options['section-title-'.$laurels_section_i])) { echo esc_attr($laurels_options['section-title-'.$laurels_section_i]); } ?>">
                </div>
                <div class="ft-control">
                  <div class="explain"><?php _e('Enter secion post for your home template , you would like to display in the Home Page.','laurels'); ?></div>
                  <input type="text" placeholder="<?php _e('Enter post here','laurels'); ?>" id="post-<?php echo $laurels_section_i;?>" class="of-input" name="laurels_theme_options[section-post-<?php echo $laurels_section_i;?>]" size="32"  value="<?php if(!empty($laurels_options['section-post-'.$laurels_section_i])) { echo esc_attr($laurels_options['section-post-'.$laurels_section_i]); } ?>">
                </div>
                <div class="ft-control">
                  <div class="explain"><?php _e('Enter section content for home template , you would like to display in the Home Page.','laurels');?></div>
                  <textarea name="laurels_theme_options[section-content-<?php echo $laurels_section_i; ?>]" rows="6" id="content-<?php echo $laurels_section_i; ?>" placeholder="<?php _e('Enter Content here','laurels'); ?>" class="of-input"><?php if(!empty($laurels_options['section-content-'.$laurels_section_i])) { echo esc_attr($laurels_options['section-content-'.$laurels_section_i]); } ?></textarea>
                </div>
              </div>
            </div>
            <?php endfor; ?>

            <h3><?php _e('Second Section','laurels'); ?></h3>
            <div id="section-recent-title" class="section theme-tabs"> <a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Category post title','laurels'); ?></a>
              <div class="faster-inner-tab-group">
                <div class="ft-control">
                  <div class="explain"><?php _e('Enter category post title for your site , you would like to display in the Home Page.','laurels'); ?></div>
                  <input id="post" class="of-input" name="laurels_theme_options[post-title]" type="text" size="50" value="<?php if(!empty($laurels_options['post-title'])) { echo esc_attr($laurels_options['post-title']); } ?>" />
                </div>
              </div>
            </div>
            <div class="section theme-tabs theme-short_description"> <a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Category','laurels'); ?></a>
              <div class="faster-inner-tab-group">
                <div class="ft-control">
                  <select name="laurels_theme_options[post-category]" id="category">
                    <option value=""><?php echo esc_attr(__('Select Category','laurels')); ?></option>
                    <?php 
				$laurels_args = array(
				'meta_query' => array(
									array(
									'key' => '_thumbnail_id',
									'compare' => 'EXISTS'
										),
									)
								);  
				$laurels_post = new WP_Query( $laurels_args );
				$laurels_cat_id=array();
				while($laurels_post->have_posts()){
				$laurels_post->the_post();
				$laurels_post_categories = wp_get_post_categories( get_the_id());   
				$laurels_cat_id[]=$laurels_post_categories[0];
				}
				$laurels_cat_id=array_unique($laurels_cat_id);
				$laurels_args = array(
				'orderby' => 'name',
				'parent' => 0,
				'include'=>$laurels_cat_id
				);
				
				$laurels_categories = get_categories($laurels_args); 
			
                  foreach ($laurels_categories as $laurels_category) {
					  if($laurels_category->term_id == $laurels_options['post-category'])
					  	$laurels_selected="selected=selected";
					  else
					  	$laurels_selected='';
                    $laurels_option = '<option value="'.$laurels_category->term_id .'" '.$laurels_selected.'>';
                    $laurels_option .= $laurels_category->cat_name;
                    $laurels_option .= '</option>';
                    echo $laurels_option;
                  }
                 ?>
                  </select>
                </div>
              </div>
            </div>
            
            <h3><?php _e('Third Section','laurels'); ?></h3>
            <div id="section-latespost-title" class="section theme-tabs"> <a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Latest Post Title','laurels'); ?></a>
              <div class="faster-inner-tab-group">
                <div class="ft-control">
                  <div class="explain"><?php _e('Enter Latest post title for your site , you would like to display in the Home Page.','laurels');?></div>
                  <input id="post" class="of-input" name="laurels_theme_options[latestpost-title]" type="text" size="50" value="<?php if(!empty($laurels_options['latestpost-title'])) { echo esc_attr($laurels_options['latestpost-title']); } ?>" />
                </div>
              </div>
            </div>
          
          
</div>             
          <!-- END HOME PAGE -->
          
          <!-------------- Social group ----------------->
          <div id="options-group-3" class="group faster-inner-tabs">            
            <div id="section-facebook" class="section theme-tabs">
            	<a class="heading faster-inner-tab active" href="javascript:void(0)"><?php _e('Facebook','laurels'); ?></a>
              <div class="faster-inner-tab-group active">
              	<div class="ft-control">
              		<div class="explain"><?php _e('Facebook profile or page URL i.e. ','laurels'); ?> http://facebook.com/username/ </div>                
                  	<input id="facebook" class="of-input" name="laurels_theme_options[facebook]" size="30" type="text" value="<?php if(!empty($laurels_options['facebook'])) { echo esc_url($laurels_options['facebook']); } ?>" />
                </div>                
              </div>
            </div>
            <div id="section-twitter" class="section theme-tabs">
            	<a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Twitter','laurels'); ?></a>
              <div class="faster-inner-tab-group">
              	<div class="ft-control">
              		<div class="explain"><?php _e('Twitter profile or page URL i.e. ','laurels'); ?>http://www.twitter.com/username/</div>                
                  	<input id="twitter" class="of-input" name="laurels_theme_options[twitter]" type="text" size="30" value="<?php if(!empty($laurels_options['twitter'])) { echo esc_url($laurels_options['twitter']); } ?>" />
                </div>                
              </div>
            </div>
            <div id="section-pinterest" class="section theme-tabs">
            	<a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Pinterest','laurels'); ?></a>
              <div class="faster-inner-tab-group">
              	<div class="ft-control">
              		<div class="explain"><?php _e('Pinterest profile or page URL i.e. ','laurels'); ?>https://pinterest.com/username/</div>                
                  	 <input id="pinterest" class="of-input" name="laurels_theme_options[pinterest]" type="text" size="30" value="<?php if(!empty($laurels_options['pinterest'])) { echo esc_url($laurels_options['pinterest']); } ?>" />
                </div>                
              </div>
            </div>
			<div id="section-googleplus" class="section theme-tabs">
            	<a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Google plus','laurels'); ?></a>
              <div class="faster-inner-tab-group">
              	<div class="ft-control">
              		<div class="explain"><?php _e('Google plus profile or page URL i.e.','laurels'); ?> https://googleplus.com/username/</div>                
                  	 <input id="googleplus" class="of-input" name="laurels_theme_options[googleplus]" type="text" size="30" value="<?php if(!empty($laurels_options['googleplus'])) { echo esc_url($laurels_options['googleplus']); } ?>" />
                </div>                
              </div>
            </div>
            <div id="section-rss" class="section theme-tabs">
            	<a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('RSS','laurels'); ?></a>
              <div class="faster-inner-tab-group">
              	<div class="ft-control">
              		<div class="explain"><?php _e('RSS profile or page URL i.e.','laurels'); ?> https://www.rss.com/username/</div>                
                  	<input id="rss" class="of-input" name="laurels_theme_options[rss]" type="text" size="30" value="<?php if(!empty($laurels_options['rss'])) { echo esc_url($laurels_options['rss']); } ?>" />
                </div>                
              </div>
            </div>
            <div id="section-linkedin" class="section theme-tabs">
            	<a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Linkedin','laurels'); ?></a>
              <div class="faster-inner-tab-group">
              	<div class="ft-control">
              		<div class="explain"><?php _e('Linkedin profile or page URL i.e.','laurels');?>https://www.linkedin.com/username/</div>                
                  	<input id="rss" class="of-input" name="laurels_theme_options[linkedin]" type="text" size="30" value="<?php if(!empty($laurels_options['linkedin'])) { echo esc_url($laurels_options['linkedin']); } ?>" />
                </div>                
              </div>
            </div>
          </div>
          <!-------------- Social group ----------------->          
          <div id="options-group-4" class="group faster-inner-tabs fasterthemes-pro-image">
          	<div class="fasterthemes-pro-header">
              <img src="<?php echo get_template_directory_uri(); ?>/theme-options/images/laurels_logopro_features.png" class="fasterthemes-pro-logo" />
              <a href="http://fasterthemes.com/checkout/get_checkout_details?theme=Laurels" target="_blank">
			  <img src="<?php echo get_template_directory_uri(); ?>/theme-options/images/buy-now.png" class="fasterthemes-pro-buynow" /></a>
              </div>
          	<img src="<?php echo get_template_directory_uri(); ?>/theme-options/images/laurels_pro_features.png" />
          </div> 
        <!--======================== F I N A L - - T H E M E - - O P T I O N S ===================--> 
      </div>
     </div>
	</div>
	<div class="fasterthemes-footer">
      	<ul>
            <li class="btn-save"><input type="submit" class="button-primary" value="<?php _e('Save Options','laurels'); ?>" /></li>
        </ul>
    </div>
    </form>    
</div>
<div class="save-options"><h2><?php _e('Options saved successfully.','laurels'); ?></h2></div>


<?php } ?>
