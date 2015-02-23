<?php  
/* Initiate Spoke Theme Options */


function spoke_customizer_register_init($wp_customize){ 
 	
	/*
	$fonts = json_decode( 
        file_get_contents( 'https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyC_jRCMhhUctxMJ-kmPRj2tE1fgUE9vlII' ) 
		); 
		echo '<pre>'; print_r($fonts); echo '</pre>';
			 die();
	 $installed_fonts = get_option( 'spoke_installed_fonts' , '');
	
	 */
	 
    $fonts_collection = array(
        'default' => 'Default',
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

    $installed_fonts = get_option( 'spoke_installed_fonts', true);
    if( $installed_fonts && $installed_fonts != 1 ):
         foreach( $installed_fonts as $font):
            $fonts_collection[$font] = $font . ", regular";
         endforeach;
    endif;
	/* Sections */
	$settings = array();
	$settings['sections'][] = array('id' => 'spoke_section_logo', 'title' => 'Logo', 'description' => 'Modify the theme logo.' );
	$settings['sections'][] = array('id' => 'spoke_section_favicon', 'title' => 'Favicon', 'description' => 'Modify the Favicon.' );
	$settings['sections'][] = array('id' => 'spoke_section_fonts', 'title' => 'Fonts', 'description' => 'Modify the Theme Fonts.' );
	$settings['sections'][] = array('id' => 'spoke_section_colors', 'title' => 'Colors', 'description' => 'Modify the Theme Colors.' );
	$settings['sections'][] = array('id' => 'spoke_section_background', 'title' => 'Background', 'description' => 'Modify website background.' );
	$settings['sections'][] = array('id' => 'spoke_section_widget', 'title' => 'Widget Areas', 'description' => 'Modify theme widget areas.' );
	
	/* Settings and Controls */

	/* Logo */
	$settings['controls'][] = array(  'section' => 'spoke_section_logo',  'default' => get_bloginfo('template_url') . '/images/logo2211.jpg',  'setting_id' => 'spoke_logo', 'type' => 'image', 'label' => 'Header Logo 162x58 px ( jpg, jpeg, png )' );
	
	/* Favicon */
	$settings['controls'][] = array(  'section' => 'spoke_section_favicon',  'default' =>  get_bloginfo('template_url') . '/images/favicon.ico',  'setting_id' => 'spoke_favicon', 'type' => 'image', 'label' => 'Website Favicon 16x16 px ( jpg, jpeg, png )' );
	
	/* Fonts */
	$settings['controls'][] = array(  'section' => 'spoke_section_fonts',  'default' => '',  'setting_id' => 'spoke_font_h1', 'label' => 'H1', 'type' => 'select', 'choices' => $fonts_collection );
	$settings['controls'][] = array(  'section' => 'spoke_section_fonts',  'default' => '',  'setting_id' => 'spoke_font_h2', 'label' => 'H2', 'type' => 'select', 'choices' => $fonts_collection );
	$settings['controls'][] = array(  'section' => 'spoke_section_fonts',  'default' => '',  'setting_id' => 'spoke_font_h3', 'label' => 'H3', 'type' => 'select', 'choices' => $fonts_collection );
	$settings['controls'][] = array(  'section' => 'spoke_section_fonts',  'default' => '',  'setting_id' => 'spoke_font_h4', 'label' => 'H4', 'type' => 'select', 'choices' => $fonts_collection );
	$settings['controls'][] = array(  'section' => 'spoke_section_fonts',  'default' => '',  'setting_id' => 'spoke_font_h5', 'label' => 'H5', 'type' => 'select', 'choices' => $fonts_collection );
	$settings['controls'][] = array(  'section' => 'spoke_section_fonts',  'default' => '',  'setting_id' => 'spoke_font_h6', 'label' => 'H6', 'type' => 'select', 'choices' => $fonts_collection );
	$settings['controls'][] = array(  'section' => 'spoke_section_fonts',  'default' => '',  'setting_id' => 'spoke_font_nav', 'label' => 'Navigation', 'type' => 'select', 'choices' => $fonts_collection );
	$settings['controls'][] = array(  'section' => 'spoke_section_fonts',  'default' => '',  'setting_id' => 'spoke_font_body', 'label' => 'Body Text', 'type' => 'select', 'choices' => $fonts_collection );
	$settings['controls'][] = array(  'section' => 'spoke_section_fonts',  'default' => '',  'setting_id' => 'spoke_font_accordion', 'label' => 'Accordion Text', 'type' => 'select', 'choices' => $fonts_collection );
	$settings['controls'][] = array(  'section' => 'spoke_section_fonts',  'default' => '',  'setting_id' => 'spoke_font_tabs', 'label' => 'Tabs Text', 'type' => 'select', 'choices' => $fonts_collection );
	$settings['controls'][] = array(  'section' => 'spoke_section_fonts',  'default' => '',  'setting_id' => 'spoke_font_buttons', 'label' => 'Buttons Text', 'type' => 'select', 'choices' => $fonts_collection );
	
	/* Colors */
	$settings['controls'][] = array(  'section' => 'spoke_section_colors',  'default' => '#ffffff',  'setting_id' => 'spoke_color_background', 'label' => 'Main Content Background Color' , 'type' => 'color' ); 
	$settings['controls'][] = array(  'section' => 'spoke_section_colors',  'default' => '#ffffff',  'setting_id' => 'spoke_color_footer_bg', 'label' => 'Footer Background Color' , 'type' => 'color' ); 
	$settings['controls'][] = array(  'section' => 'spoke_section_colors',  'default' => '#fafafa',  'setting_id' => 'spoke_color_footer_bar_bg', 'label' => 'Footer Bar Background Color' , 'type' => 'color' ); 
	$settings['controls'][] = array(  'section' => 'spoke_section_colors',  'default' => '#cccccc',  'setting_id' => 'spoke_color_borders', 'label' => 'Borders' , 'type' => 'color' ); 
	$settings['controls'][] = array(  'section' => 'spoke_section_colors',  'default' => '#666666',  'setting_id' => 'spoke_color_primary', 'label' => 'Primary Color' , 'type' => 'color' ); 
	$settings['controls'][] = array(  'section' => 'spoke_section_colors',  'default' => '#1e73be',  'setting_id' => 'spoke_color_secondary', 'label' => 'Secondary Color' , 'type' => 'color' ); 
	$settings['controls'][] = array(  'section' => 'spoke_section_colors',  'default' => '#666666',  'setting_id' => 'spoke_color_titles', 'label' => 'Titles Color' , 'type' => 'color' ); 
	$settings['controls'][] = array(  'section' => 'spoke_section_colors',  'default' => '#666666',  'setting_id' => 'spoke_color_subtitles', 'label' => 'Subtitles Color' , 'type' => 'color' ); 
	$settings['controls'][] = array(  'section' => 'spoke_section_colors',  'default' => '#666666',  'setting_id' => 'spoke_color_texts', 'label' => 'Content Texts' , 'type' => 'color' ); 
	$settings['controls'][] = array(  'section' => 'spoke_section_colors',  'default' => '#ffffff',  'setting_id' => 'spoke_color_menu', 'label' => 'Header Color' , 'type' => 'color' );
   $settings['controls'][] = array(  'section' => 'spoke_section_colors',  'default' => '#ffffff',  'setting_id' => 'spoke_color_menu_bg', 'label' => 'Menu Color' , 'type' => 'color' );
	$settings['controls'][] = array(  'section' => 'spoke_section_colors',  'default' => '#cccccc',  'setting_id' => 'spoke_color_social', 'label' => 'Social Icons Color' , 'type' => 'color' ); 
	$settings['controls'][] = array(  'section' => 'spoke_section_colors',  'default' => '',  'setting_id' => 'spoke_color_menu_hover', 'label' => 'Menu Hover Color' , 'type' => 'color' ); 
	$settings['controls'][] = array(  'section' => 'spoke_section_colors',  'default' => '',  'setting_id' => 'spoke_color_menu_active', 'label' => 'Menu Active Background color' , 'type' => 'color' ); 
	$settings['controls'][] = array(  'section' => 'spoke_section_colors',  'default' => '',  'setting_id' => 'spoke_color_menu_text', 'label' => 'Menu Text Color' , 'type' => 'color' ); 
	$settings['controls'][] = array(  'section' => 'spoke_section_colors',  'default' => '',  'setting_id' => 'spoke_color_menu_text_hover', 'label' => 'Menu Hover Text Color' , 'type' => 'color' ); 
	$settings['controls'][] = array(  'section' => 'spoke_section_colors',  'default' => '',  'setting_id' => 'spoke_color_menu_text_active', 'label' => 'Menu Active Text Color' , 'type' => 'color' ); 
	$settings['controls'][] = array(  'section' => 'spoke_section_colors',  'default' => '',  'setting_id' => 'spoke_color_dropmenu', 'label' => 'Dropdown Menu Background Color' , 'type' => 'color' ); 
	$settings['controls'][] = array(  'section' => 'spoke_section_colors',  'default' => '',  'setting_id' => 'spoke_color_dropmenu_hover', 'label' => 'Dropdown Menu Hover Color' , 'type' => 'color' ); 
	$settings['controls'][] = array(  'section' => 'spoke_section_colors',  'default' => '',  'setting_id' => 'spoke_color_dropmenu_text', 'label' => 'Dropdown Menu Text Color' , 'type' => 'color' ); 
	$settings['controls'][] = array(  'section' => 'spoke_section_colors',  'default' => '',  'setting_id' => 'spoke_color_dropmenu_text_hover', 'label' => 'Dropdown Menu Text Hover Color' , 'type' => 'color' ); 
	
	$settings['controls'][] = array(  'section' => 'spoke_section_colors',  'default' => '#1850A3',  'setting_id' => 'spoke_color_icon_bg', 'label' => 'Icon Background Color' , 'type' => 'color' ); 
	$settings['controls'][] = array(  'section' => 'spoke_section_colors',  'default' => '#F9A11B',  'setting_id' => 'spoke_color_icon_bg_hover', 'label' => 'Icon Background Hover Color' , 'type' => 'color' ); 
	
	$settings['controls'][] = array(  'section' => 'spoke_section_colors',  'default' => '#FCBA64',  'setting_id' => 'spoke_color_tab_color', 'label' => 'Tabs Text Color' , 'type' => 'color' ); 
	$settings['controls'][] = array(  'section' => 'spoke_section_colors',  'default' => '#ffffff',  'setting_id' => 'spoke_color_tab_hover', 'label' => 'Tabs Text Active Color' , 'type' => 'color' );
	$settings['controls'][] = array(  'section' => 'spoke_section_colors',  'default' => '#FCBA64',  'setting_id' => 'spoke_color_tab_bg', 'label' => 'Tab Background Color' , 'type' => 'color' ); 
	$settings['controls'][] = array(  'section' => 'spoke_section_colors',  'default' => '#FCBA64',  'setting_id' => 'spoke_color_tab_bg_hover', 'label' => 'Tab Background Hover Color' , 'type' => 'color' ); 
	$settings['controls'][] = array(  'section' => 'spoke_section_colors',  'default' => '#FCBA64',  'setting_id' => 'spoke_color_tab_bg_active', 'label' => 'Tab Background Active Color' , 'type' => 'color' ); 
	
	$settings['controls'][] = array(  'section' => 'spoke_section_colors',  'default' => '#FFFFFF',  'setting_id' => 'spoke_color_acc_color', 'label' => 'Accordion Text Color' , 'type' => 'color' ); 
	$settings['controls'][] = array(  'section' => 'spoke_section_colors',  'default' => '#FFFFFF',  'setting_id' => 'spoke_color_acc_hover_color', 'label' => 'Accordion Text Hover Color' , 'type' => 'color' );
	$settings['controls'][] = array(  'section' => 'spoke_section_colors',  'default' => '#FFFFFF',  'setting_id' => 'spoke_color_acc_hover', 'label' => 'Accordion Text Active Color' , 'type' => 'color' );
	$settings['controls'][] = array(  'section' => 'spoke_section_colors',  'default' => '#1850A3',  'setting_id' => 'spoke_color_acc_bg', 'label' => 'Accordion Background Color' , 'type' => 'color' ); 
	$settings['controls'][] = array(  'section' => 'spoke_section_colors',  'default' => '#1850A3',  'setting_id' => 'spoke_color_acc_bg_hover', 'label' => 'Accordion Background Hover Color' , 'type' => 'color' ); 
	$settings['controls'][] = array(  'section' => 'spoke_section_colors',  'default' => '#1850A3',  'setting_id' => 'spoke_color_acc_bg_active', 'label' => 'Accordion Background Active Color' , 'type' => 'color' ); 
	
	
	/* Background */
	$settings['controls'][] = array(  'section' => 'spoke_section_background',  'default' => 'color',  'setting_id' => 'spoke_bg_option', 'label' => 'Select Body background type' , 'type' => 'select', 'choices' => array( 'image' => 'Background Image', 'color' => 'Background Color' ) ); 
	$settings['controls'][] = array(  'section' => 'spoke_section_background',  'default' => '#fff',  'setting_id' => 'spoke_bg_color', 'label' => 'Body Background color' , 'type' => 'color' ); 
	$settings['controls'][] = array(  'section' => 'spoke_section_background',  'default' => '',  'setting_id' => 'spoke_bg_image', 'label' => 'Body Background image' , 'type' => 'image' ); 
	
	/* Widget Areas */
	$settings['controls'][] = array(  'section' => 'spoke_section_widget',  'default' => 'left',  'setting_id' => 'spoke_widget_sidebars', 'label' => 'Sidebar Layout' , 'type' => 'select', 'choices' => array( 'left' => 'Left Sidebar', 'right' => 'Right Sidebar', 'both' => 'Left and Right Sidebar' ) ); 
	$settings['controls'][] = array(  'section' => 'spoke_section_widget',  'default' => '75%',  'setting_id' => 'spoke_widget_main_width', 'label' => 'Main content width in percent (eg. 50%)' , 'type' => 'text' ); 
	$settings['controls'][] = array(  'section' => 'spoke_section_widget',  'default' => '25%',  'setting_id' => 'spoke_widget_sidebar_width', 'label' => 'Sidebar Left width in percent (eg. 25%)' , 'type' => 'text' ); 
	$settings['controls'][] = array(  'section' => 'spoke_section_widget',  'default' => '0%',  'setting_id' => 'spoke_widget_sidebar_right_width', 'label' => 'Sidebar Right width (eg. 25%)' , 'type' => 'text' ); 
	$settings['controls'][] = array(  'section' => 'spoke_section_widget',  'default' => '',  'setting_id' => 'spoke_widget_footer', 'label' => 'Hide/Show Sticky Footer Bar' , 'type' => 'select', 'choices' => array( 'show' => 'Show Sticky Footer', 'hide' => 'Hide the Sticky Footer' ) ); 
	$settings['controls'][] = array(  'section' => 'spoke_section_widget',  'default' => 'show',  'setting_id' => 'spoke_widget_footer_show', 'label' => 'Hide/Show Footer' , 'type' => 'select', 'choices' => array( 'show' => 'Show Footer', 'hide' => 'Hide the Footer' ) ); 
	$settings['controls'][] = array(  'section' => 'spoke_section_widget',  'default' => 'static',  'setting_id' => 'spoke_widget_footer_transition', 'label' => 'Footer Transition' , 'type' => 'select', 'choices' => array( 'static' => 'Static', 'slide' => 'Slide Open' ) );
	$settings['controls'][] = array(  'section' => 'spoke_section_widget',  'default' => 'All rights reserved. Spoke Theme ',  'setting_id' => 'spoke_widget_copyright', 'label' => 'Footer Copyright Text' , 'type' => 'text' ); 
	
	$settings['controls'][] = array(  'section' => 'spoke_section_widget',  'default' => '',  'setting_id' => 'spoke_social_facebook', 'label' => 'Facebook Link' , 'type' => 'text' ); 
	$settings['controls'][] = array(  'section' => 'spoke_section_widget',  'default' => '',  'setting_id' => 'spoke_social_twitter', 'label' => 'Twitter Link' , 'type' => 'text' ); 
	$settings['controls'][] = array(  'section' => 'spoke_section_widget',  'default' => '',  'setting_id' => 'spoke_social_google', 'label' => 'Google Plus Link' , 'type' => 'text' );
	$settings['controls'][] = array(  'section' => 'spoke_section_widget',  'default' => '',  'setting_id' => 'spoke_social_linkedin', 'label' => 'Linkedin Link' , 'type' => 'text' ); 
	$settings['controls'][] = array(  'section' => 'spoke_section_widget',  'default' => '',  'setting_id' => 'spoke_social_youtube', 'label' => 'Youtube Link' , 'type' => 'text' ); 
	$settings['controls'][] = array(  'section' => 'spoke_section_widget',  'default' => '',  'setting_id' => 'spoke_social_vimeo', 'label' => 'Vimeo Link' , 'type' => 'text' );
	$settings['controls'][] = array(  'section' => 'spoke_section_widget',  'default' => '',  'setting_id' => 'spoke_social_flickr', 'label' => 'Flickr Link' , 'type' => 'text' ); 
	$settings['controls'][] = array(  'section' => 'spoke_section_widget',  'default' => '',  'setting_id' => 'spoke_social_instagram', 'label' => 'Instagram Link' , 'type' => 'text' ); 
	$settings['controls'][] = array(  'section' => 'spoke_section_widget',  'default' => '',  'setting_id' => 'spoke_social_pinterest', 'label' => 'Pinterest Link' , 'type' => 'text' ); 
	$settings['controls'][] = array(  'section' => 'spoke_section_widget',  'default' => '',  'setting_id' => 'spoke_social_tumblr', 'label' => 'Tumblr Link' , 'type' => 'text' ); 
	$settings['controls'][] = array(  'section' => 'spoke_section_widget',  'default' => '',  'setting_id' => 'spoke_social_dribbble', 'label' => 'Dribbble Link' , 'type' => 'text' ); 
	$settings['controls'][] = array(  'section' => 'spoke_section_widget',  'default' => '',  'setting_id' => 'spoke_social_skype', 'label' => 'Skype Link' , 'type' => 'text' );  
	
	$settings['controls'][] = array(  'section' => 'spoke_section_widget',  'default' => 'yes',  'setting_id' => 'spoke_widget_header', 'label' => 'Show Social Accounts in Header?' , 'type' => 'select', 'choices' => array( 'yes' => 'Yes', 'no' => 'No' ) ); 
	
	/* Front Page */
	$settings['controls'][] = array(  'section' => 'static_front_page',  'default' => 'fullwidth',  'setting_id' => 'spoke_width_layout', 'label' => 'Theme Full Width Layout' , 'type' => 'select', 'choices' => array( 'fullwidth' => 'Yes', 'non-fullwidth' => 'No' ) ); 
	$settings['controls'][] = array(  'section' => 'static_front_page',  'default' => 'false',  'setting_id' => 'spoke_one_page', 'label' => 'Theme One Page Option' , 'type' => 'select', 'choices' => array( 'true' => 'Yes', 'false' => 'No' ) ); 
	
	/* Navigation */
	$settings['controls'][] = array(  'section' => 'nav',  'default' => 'left',  'setting_id' => 'spoke_menu_align', 'label' => 'Text Alignment on Top Menu' , 'type' => 'select', 'choices' => array( 'center' => 'Center', 'left' => 'Left', 'right' => 'Right', 'justify' => 'Justify' ) ); 
	$settings['controls'][] = array(  'section' => 'nav',  'default' => 'left',  'setting_id' => 'spoke_dropmenu_align', 'label' => 'Text Alignment on Dropdown Menu' , 'type' => 'select', 'choices' => array( 'center' => 'Center', 'left' => 'Left', 'right' => 'Right', 'justify' => 'Justify' ) ); 
	$settings['controls'][] = array(  'section' => 'nav',  'default' => 'yes',  'setting_id' => 'spoke_menu_breadcrumbs', 'label' => 'Display Breadcrumbs?' , 'type' => 'select', 'choices' => array( 'yes' => 'Yes', 'no' => 'No' ) ); 
	/* $settings['controls'][] = array(  'section' => '',  'default' => '',  'setting_id' => '', 'label' => '' , 'type' => '' );  */

	 
	/* Build the Spoke Customizer */
 
	
	$sections_arr = $settings['sections'];
	$controls_arr = $settings['controls'];
	
	$html = "";
	$i = 40;
	foreach($sections_arr as $section):
		$wp_customize->add_section( $section['id'], 
			array(
				'title' => $section['title'],
				'description' => $section['description'],
				'priority'   => $i++
			)
		); 
		//echo '<pre>'; print_r( $section ); echo '</pre>';
	endforeach;
	/* end foreach sections */ 
	 
	 
	$i = 40;
	foreach($controls_arr as $control):
		$id =  $control['setting_id'];
		$default = $control['default'];
		$label = $control['label'];
		$section_set = $control['section'];
		$type = $control['type'];
		
		if( isset( $control['choices'] ) && !empty( $control['choices'] ) ){
			$choices = $control['choices'];
		} else {
			$choices = false;
		}
		
		$wp_customize->add_setting( $id, 
			array(
				'default' => $default,
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options'
			)
		);
		 
		switch( $type ):
		 
			case 'image':  
			
					$wp_customize->add_control( 
							new WP_Customize_Image_Control( 
							$wp_customize, 
							'ctr_' . $id, 
							array(
								'label'      => $label,
								'section'    => $section_set,
								'settings'   => $id,
								'priority'   => $i++
							)
						) ); 
						
				break;
		
			case 'color': 
			
					$wp_customize->add_control( 
							new WP_Customize_Color_Control( 
							$wp_customize, 
							'ctr_' . $id, 
							array(
								'label'      => $label,
								'section'    => $section_set,
								'settings'   => $id,
								'priority'   => $i++
							)
						) ); 
						
				break;
		
			case 'radio':  
			case 'select':  
					$wp_customize->add_control( 'ctr_' . $id, array(
						'label' => $label,
						'section' => $section_set,
						'settings' => $id,
						'type' => $type,
						'choices' => $choices,
						'priority'   => $i++
					) ); 
					
				break;
		 
			default:
			
					$wp_customize->add_control( 'ctr_' . $id, array(
						'label' => $label,
						'section' => $section_set,
						'settings' => $id,
						'placeholder'=> 'Link',
						'priority'   => $i++
					) ); 
					
			
				break;
				
		endswitch; 
		
		//end switch
		 
	endforeach; 
	/* end foreach settings */
	 
	
}

add_action('customize_register', 'spoke_customizer_register_init');


?>