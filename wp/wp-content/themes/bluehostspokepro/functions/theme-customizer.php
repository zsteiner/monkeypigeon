<?php 

function spoke_css_customizer(){ 

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

    $fonts_collections = array();

    foreach($fonts_collection as $font => $value):
        $fonts_collections[] = $font;
    endforeach;  

    $load_fonts = implode( '|' , $fonts_collections );
?>

<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=<?php echo $load_fonts; ?>">

<style type="text/css">
        body { 
        <?php
            $bg_option = get_theme_mod('spoke_bg_option');
            $bg_color = get_theme_mod('spoke_bg_color');
            $bg_image = get_theme_mod('spoke_bg_image');


            if( $bg_option == 'image' ):
                echo 'background-image: url("' . $bg_image . '");' ;
            else:
                echo 'background-color: ' . $bg_color . '' ;
            endif

        ?>;
        <?php if( get_theme_mod('spoke_font_body') != 'default' ): ?>
            font-family: "<?php echo get_theme_mod('spoke_font_body'); ?>";
        <?php endif; ?>
            color: <?php echo get_theme_mod('spoke_color_texts'); ?>; 
        }
		p, td{
			<?php if( get_theme_mod('spoke_font_body') != 'default' ): ?> font-family: "<?php echo get_theme_mod('spoke_font_body'); ?>";  <?php endif; ?>
		}
		
		input[type="submit"], .w-actionbox-button, .g-btn {
		 <?php if( get_theme_mod('spoke_font_buttons') != 'default' ): ?> font-family: "<?php echo get_theme_mod('spoke_font_buttons'); ?>";  <?php endif; ?>
		}
        /*content texts*/

		.l-canvas{
			color: <?php echo get_theme_mod('spoke_color_texts'); ?>; 
		}

        p, .hbuttons p {
		<?php if( get_theme_mod('spoke_font_body') != 'default' ): ?> font-family: "<?php echo get_theme_mod('spoke_font_body'); ?>";  <?php endif; ?>
		}
        .content{ 
            background-color: <?php echo get_theme_mod('spoke_color_background'); ?>;  
            color: <?php echo get_theme_mod('spoke_color_texts'); ?>; 
        }

        .content p {
        	color: <?php echo get_theme_mod('spoke_color_texts'); ?>;
        }

		/* PRIMARY */	

		a { 
            color: <?php echo get_theme_mod('spoke_color_primary'); ?>;
        }

        .content h1, .content a { 
            color: <?php echo get_theme_mod('spoke_color_primary'); ?>;
        }

		.l-main .w-contacts-item i{
			box-shadow: 0 0 0 2px <?php echo get_theme_mod('spoke_color_primary'); ?> inset;
			 color: <?php echo get_theme_mod('spoke_color_primary'); ?>;
		}

		.primary , .no-touch .w-team-member-links, .w-team-member-link, input[type="submit"]{
			background-color: <?php echo get_theme_mod('spoke_color_primary'); ?>;
		}

		select.responsiveMenuSelect {
			/*border: 2px solid <?php echo get_theme_mod('spoke_color_menu'); ?>;*/
			/*border: 1px solid #CCCCCC;*/
		}

		input[type="text"]:focus, input[type="password"]:focus, input[type="email"]:focus, input[type="url"]:focus, input[type="tel"]:focus, input[type="number"]:focus, input[type="date"]:focus, textarea:focus, select:focus{
			box-shadow: 0 0 0 2px <?php echo get_theme_mod('spoke_color_primary'); ?>;
		}

		.no-touch .g-pagination-item:before, .w-timeline-item:before, .w-timeline-section-title:before, .no-touch .flex-direction-nav li span:before, .no-touch .tp-leftarrow.default:before, .no-touch .tp-rightarrow.default:before,

		.g-btn.type_primary, input[type="submit"], .w-actionbox.color_primary, .no-touch .w-filters-item-link:hover, .no-touch .l-subheader .w-nav-item.level_2:hover .w-nav-anchor.level_2, .no-touch .l-subheader .w-nav-item.level_3:hover .w-nav-anchor.level_3, .no-touch .w-toplink.active:hover{

			background-color: <?php echo get_theme_mod('spoke_color_primary'); ?>;

		}

		.no-touch .w-blog-entry-link:hover .w-blog-entry-title-h, .w-blog.imgpos_atleft .w-blog-entry.format-audio .w-blog-entry-link:hover .w-blog-entry-preview-icon, .w-blog.imgpos_atleft .w-blog-entry.format-gallery .w-blog-entry-link:hover .w-blog-entry-preview-icon, .w-blog.imgpos_atleft .w-blog-entry.format-link .w-blog-entry-link:hover .w-blog-entry-preview-icon, .w-blog.imgpos_atleft .w-blog-entry.format-quote .w-blog-entry-link:hover .w-blog-entry-preview-icon, .w-blog.imgpos_atleft .w-blog-entry.format-status .w-blog-entry-link:hover .w-blog-entry-preview-icon, .w-blog.imgpos_atleft .w-blog-entry.format-video .w-blog-entry-link:hover .w-blog-entry-preview-icon, .no-touch .w-blog.type_masonry .w-blog-entry.format-video .w-blog-entry-link:hover .w-blog-entry-preview-icon, .w-cart-link:hover, .w-counter.color_primary .w-counter-number, .w-icon.color_primary .w-icon-link, .no-touch .w-iconbox-link:hover .w-iconbox-title, .no-touch .l-subheader .w-nav-item.level_1:hover .w-nav-anchor.level_1, .l-subheader .w-nav-item.level_1.active .w-nav-anchor.level_1, .l-subheader .w-nav-item.level_1.current-menu-item .w-nav-anchor.level_1, .l-subheader .w-nav-item.level_1.current-menu-ancestor .w-nav-anchor.level_1, .l-subheader .w-nav-item.level_2.active .w-nav-anchor.level_2, .l-subheader .w-nav-item.level_3.active .w-nav-anchor.level_3, .l-subheader .w-nav-item.level_2.current-menu-item .w-nav-anchor.level_2, .l-subheader .w-nav-item.level_3.current-menu-item .w-nav-anchor.level_3, .l-subheader .w-nav-item.level_2.current-menu-ancestor .w-nav-anchor.level_2, .l-subheader .w-nav-item.level_3.current-menu-ancestor .w-nav-anchor.level_3, .l-subheader .w-nav.touch_enabled .w-nav-item.level_1.active .w-nav-anchor.level_1, .l-subheader .w-nav.touch_enabled .w-nav-item.level_2.active .w-nav-anchor.level_2, .l-subheader .w-nav.touch_enabled .w-nav-item.level_3.active .w-nav-anchor.level_3, .l-subheader .w-nav.touch_enabled .w-nav-item.level_1.current-menu-item .w-nav-anchor.level_1, .l-subheader .w-nav.touch_enabled .w-nav-item.level_2.current-menu-item .w-nav-anchor.level_2, .l-subheader .w-nav.touch_enabled .w-nav-item.level_3.current-menu-item .w-nav-anchor.level_3, .l-subheader .w-nav.touch_enabled .w-nav-item.level_1.current-menu-ancestor .w-nav-anchor.level_1, .l-subheader .w-nav.touch_enabled .w-nav-item.level_2.current-menu-ancestor .w-nav-anchor.level_2, .l-subheader .w-nav.touch_enabled .w-nav-item.level_3.current-menu-ancestor .w-nav-anchor.level_3, .w-nav.layout_ver .w-nav-item.active > .w-nav-anchor, .no-touch .l-subheader .w-search-show:hover{
			color: <?php echo get_theme_mod('spoke_color_primary'); ?>;
		}

		/* SECONDARY */

		a { 
			text-decoration: none;
			transition: padding 0.2s ease-out 0s, color 0.2s ease-out 0s, background-color 0.2s ease-out 0s, box-shadow 0.2s ease-out 0s, border 0.2s ease-out 0s;
		}

        .content h2, .content h3, .content h4, .content h5, .content h6, .content a:hover, a:hover{ 
            color: <?php echo get_theme_mod('spoke_color_secondary'); ?>;   
        }

		a:hover, a:active, .no-touch .w-blog.type_masonry .w-blog-entry-meta a:hover, .no-touch .l-subheader .w-contacts-item-value a:hover, .w-counter.color_secondary .w-counter-number, .w-icon.color_text .w-icon-link, .color_primary .w-icon.color_text.with_circle .w-icon-link, .w-icon.color_secondary .w-icon-link, .no-touch .w-lang-list .w-lang-item:hover, .no-touch .w-lang-current:hover, .no-touch .w-team-member-links-item:hover, .no-touch .l-submain.color_alternate .w-team-member-links-item:hover, .no-touch .l-submain.color_primary .w-team-member-links-item:hover, .no-touch .w-team-member-link:hover .w-team-member-name{
			color: <?php echo get_theme_mod('spoke_color_secondary'); ?>;   
		}

		.g-btn.type_secondary, input[type="submit"]:hover{
			background-color:  <?php echo get_theme_mod('spoke_color_secondary'); ?>;   
		}

		/* BORDERS */

		.g-hr-h:before, .g-hr-h:after{
			background-color: <?php echo get_theme_mod('spoke_color_borders'); ?>; 
		}

		.g-hr-h i{ 

		}

		.top_header{
			border-bottom: thin solid  <?php echo get_theme_mod('spoke_color_borders'); ?>; 
		}

        /*fonts*/

        h1, h1.site-title {
           <?php if( get_theme_mod('spoke_font_h1') != 'default' ): ?>  font-family: "<?php echo get_theme_mod('spoke_font_h1'); ?>";  <?php endif; ?>
            color: <?php echo get_theme_mod('spoke_color_titles'); ?>;
        } 

        h2, h2.site-subtitle {
           <?php if( get_theme_mod('spoke_font_h2') != 'default' ): ?>  font-family: "<?php echo get_theme_mod('spoke_font_h2'); ?>";  <?php endif; ?>
            color: <?php echo get_theme_mod('spoke_color_titles'); ?>;
        }

        h3 , .img_area .hbuttons h3{
           <?php if( get_theme_mod('spoke_font_h3') != 'default' ): ?>  font-family: "<?php echo get_theme_mod('spoke_font_h3'); ?>";  <?php endif; ?>
            color: <?php echo get_theme_mod('spoke_color_titles'); ?>;

        }

        h4 {
           <?php if( get_theme_mod('spoke_font_h4') != 'default' ): ?>  font-family: "<?php echo get_theme_mod('spoke_font_h4'); ?>";  <?php endif; ?>
            color: <?php echo get_theme_mod('spoke_color_titles'); ?>;
        }

        h5 {
           <?php if( get_theme_mod('spoke_font_h5') != 'default' ): ?>  font-family: "<?php echo get_theme_mod('spoke_font_h5'); ?>";  <?php endif; ?>
            color: <?php echo get_theme_mod('spoke_color_titles'); ?>;
        }

        h6 {
           <?php if( get_theme_mod('spoke_font_h6') != 'default' ): ?>  font-family: "<?php echo get_theme_mod('spoke_font_h6'); ?>";  <?php endif; ?>
            color: <?php echo get_theme_mod('spoke_color_titles'); ?>;
        } 

        /*menu*/

        .navbar {
            background-color: <?php echo get_theme_mod('spoke_color_menu'); ?>;
        }

        .top-menu {
            background-color: <?php echo get_theme_mod('spoke_color_menu_bg'); ?>;
        }

        .navbar ul.nav > li:hover {
            background-color: <?php echo get_theme_mod('spoke_color_menu_hover'); ?>;
        }

        .navbar ul.nav  > li.current-menu-item, .navbar ul.nav  > li.current-menu-ancestor {
            background-color: <?php echo get_theme_mod('spoke_color_menu_active'); ?>;
        }

        .navbar-default .navbar-nav > li > a,

        .navbar ul.nav li a {
            color: <?php echo get_theme_mod('spoke_color_menu_text'); ?>;
           <?php if( get_theme_mod('spoke_font_nav') != 'default' ): ?>  font-family: "<?php echo get_theme_mod('spoke_font_nav'); ?>";  <?php endif; ?>
        }

        .navbar ul.nav > li > a:hover {
            color: <?php echo get_theme_mod('spoke_color_menu_text_hover'); ?>;
        }

        .navbar ul.nav > li.current-menu-item > a , .navbar ul.nav > li.current-menu-ancestor > a {
            color: <?php echo get_theme_mod('spoke_color_menu_text_active'); ?>;
        }

		.navbar .nav > li > a {
			text-align: <?php echo get_theme_mod('spoke_menu_align'); ?>; 
		}

		.submenu-head ul > li > a, .submenuChild ul > li > a, ul.w-nav-list li a.w-nav-anchor, select.responsiveMenuSelect{
			text-align: <?php echo get_theme_mod('spoke_dropmenu_align'); ?>;
		}

        .submenu-head ul, ul.w-nav-list   {
            background-color: <?php echo get_theme_mod('spoke_color_dropmenu'); ?>!important;
        }

        .nav .fa-caret-up  {
            color: <?php echo get_theme_mod('spoke_color_dropmenu'); ?>!important;
        }

        .submenu-head ul > li > a:hover, ul.w-nav-list > li > a:hover {
            background-color: <?php echo get_theme_mod('spoke_color_dropmenu_hover'); ?>!important;
            color: <?php echo get_theme_mod('spoke_color_dropmenu_text_hover'); ?>!important;
        }

        .submenu-head ul > li > a, ul.w-nav-list > li > a {
            color: <?php echo get_theme_mod('spoke_color_dropmenu_text'); ?>!important;
        }

		.w-iconbox-link:hover .w-iconbox-title, .w-iconbox-link:hover {
			color: <?php echo get_theme_mod('spoke_color_icon_bg_hover'); ?>; 
		}

		.no-touch .w-iconbox.with_circle .w-iconbox-icon:before {
			background-color: <?php echo get_theme_mod('spoke_color_icon_bg_hover'); ?> ;  
		} 

		.w-iconbox.with_circle .w-iconbox-icon {
			background-color: <?php echo get_theme_mod('spoke_color_icon_bg'); ?>; 
			color: #ffffff; 
		}

		.w-tabs-item, .no-touch .w-tabs-item { 
			border-bottom: 15px solid <?php echo get_theme_mod('spoke_color_tab_bg'); ?>; 
		}

		.w-tabs-item.active, .no-touch .w-tabs-item.active, .w-portfolio.columns_4 .w-portfolio-h .w-filters-item.active .w-filters-item-link {
			background-color: <?php echo get_theme_mod('spoke_color_tab_bg_active'); ?>; 
			border-color:  <?php echo get_theme_mod('spoke_color_tab_bg_active'); ?>; 
		}

		.no-touch .w-tabs-item.active:hover , .w-tabs-item.active:hover, .no-touch .w-tabs-item:hover, .w-tabs-item:hover, .w-portfolio.columns_4 .w-portfolio-h .w-filters-item-link:hover {
			background-color: <?php echo get_theme_mod('spoke_color_tab_bg_hover'); ?>; 
			border-color: <?php echo get_theme_mod('spoke_color_tab_bg_hover'); ?>; 
		}
	<?php if ( get_theme_mod('spoke_menu_breadcrumbs') == 'no' ): ?>
		.breadcrumbs{
			display: none;
		}
	<?php endif; ?>
		
		/* tabs */

		.w-tabs, .w-tabs p{
			<?php if( get_theme_mod('spoke_font_tabs') != 'default' ): ?> font-family: "<?php echo get_theme_mod('spoke_font_tabs'); ?>"!important;  <?php endif; ?>
		}

		 .w-tabs-item-title{
			color: <?php echo get_theme_mod('spoke_color_tab_color'); ?>!important;
			<?php if( get_theme_mod('spoke_font_tabs') != 'default' ): ?> font-family: "<?php echo get_theme_mod('spoke_font_tabs'); ?>"!important;  <?php endif; ?>
		 }

		 .w-tabs-item.active .w-tabs-item-title, .w-tabs-item:hover .w-tabs-item-title , .w-portfolio.columns_4 .w-portfolio-h .w-filters-item.active .w-filters-item-link, .w-portfolio.columns_4 .w-portfolio-h .w-filters-item.active .w-filters-item-link:hover{
			color: <?php echo get_theme_mod('spoke_color_tab_hover'); ?>!important;
		 }
		 
		 .w-tabs-section-title  {
			background-color: <?php echo get_theme_mod('spoke_color_acc_bg'); ?> !important;
			color: <?php echo get_theme_mod('spoke_color_acc_color'); ?> !important;
		}
		/* accordion */
		 
		.w-tabs.layout_accordion, .w-tabs.layout_accordion p, .w-tabs.layout_accordion .w-tabs-section-title-text{
			<?php if( get_theme_mod('spoke_font_accordion') != 'default' ): ?> font-family: "<?php echo get_theme_mod('spoke_font_accordion'); ?>" !important;  <?php endif; ?>
		}

		 .w-tabs-section-title:hover  {
			background-color: <?php echo get_theme_mod('spoke_color_acc_bg_hover'); ?> !important;
			color: <?php echo get_theme_mod('spoke_color_acc_hover_color'); ?> !important;
			<?php if( get_theme_mod('spoke_font_accordion') != 'default' ): ?> font-family: "<?php echo get_theme_mod('spoke_font_accordion'); ?>" !important;  <?php endif; ?>
		}

		.w-tabs-section.active .w-tabs-section-title {
			background-color: <?php echo get_theme_mod('spoke_color_acc_bg_active'); ?> !important;
			color: <?php echo get_theme_mod('spoke_color_acc_hover'); ?> !important;
		}

		.w-portfolio.columns_4 .w-portfolio-h .w-filters-item .w-filters-item-link{
			border-bottom: 15px solid <?php echo get_theme_mod('spoke_color_tab_bg'); ?>; 
			color: <?php echo get_theme_mod('spoke_color_tab_color'); ?>!important;
			<?php if( get_theme_mod('spoke_font_tabs') != 'default' ): ?> font-family: "<?php echo get_theme_mod('spoke_font_tabs'); ?>"!important;  <?php endif; ?>
		}

		.w-portfolio.columns_4 .w-portfolio-h .w-filters-item .w-filters-item-link:hover {
			background-color: <?php echo get_theme_mod('spoke_color_tab_bg_hover'); ?>; 
			border-color:  <?php echo get_theme_mod('spoke_color_tab_bg_hover'); ?>; 
			color: <?php echo get_theme_mod('spoke_color_tab_hover'); ?> !important;
		}

		.social-media .span2{
			margin: 0 0 0 6px !important
		}

		.social-media .fa{
			font-size: 58px;
		}

		.g-btn.type_default.outlined, .w-socials-item-link {
			box-shadow: 0 0 0 2px <?php echo get_theme_mod('spoke_color_social'); ?>  inset;
			color: <?php echo get_theme_mod('spoke_color_social'); ?> ;
		} 
		 
		.w-testimonial{
			box-shadow: 0 0 0 2px <?php echo get_theme_mod('spoke_color_primary'); ?> inset;
		}
		
		.w-testimonial:hover{
			box-shadow: 0 0 0 2px <?php echo get_theme_mod('spoke_color_secondary'); ?> inset !important;
		}
		 
		.top_header .fa{
			font-size: 30px;
		}

        #left_sidebar, #right_sidebar{
			display: none;
		}

		.widget_recent_entries ul li a, a.w-shortblog-entry-link, .w-shortblog-entry-title-h {
			color: <?php echo get_theme_mod('spoke_color_titles'); ?> ;
		}
		
		.widget_recent_entries ul li a:hover, a.w-shortblog-entry-link:hover {
			color: <?php echo get_theme_mod('spoke_color_secondary'); ?> ;
		}
		
		/* footer */

		#footer{
			background-color: <?php echo get_theme_mod('spoke_color_footer_bg'); ?>; 
		}

		.bottom_footer{
			background-color: <?php echo get_theme_mod('spoke_color_footer_bar_bg'); ?>; 
		}		

<?php if( get_theme_mod('spoke_widget_footer') == 'hide' ) : ?> 
        .bottom_footer { position : relative; }
        #footer { position : relative; }                        
<?php endif; ?>

<?php     
		$main_width = get_theme_mod('spoke_widget_main_width');
		$main_width = str_replace('px','%',$main_width);
		$pos_main = strpos($main_width,'%');
		if( $pos_main === false ){
			$main_width = $main_width + "%";
		}
		
		$left_width = get_theme_mod('spoke_widget_sidebar_width');
		$left_width = str_replace('px','%',$left_width);
		$pos_left = strpos($left_width,'%');
		if( $pos_left === false ){
			$left_width = $left_width + "%";
		}
		
		$right_width = get_theme_mod('spoke_widget_sidebar_right_width');
		$right_width = str_replace('px','%',$right_width);
		$pos_right = strpos($right_width,'%');

		if( $pos_right === false ){
			$right_width = $right_width + "%";
		}		
		
		$main_width = get_theme_mod('spoke_widget_main_width');
		$main_width = filter_var($main_width, FILTER_SANITIZE_NUMBER_INT);
		$main_width = $main_width + '%';
		
		
		$left_width = get_theme_mod('spoke_widget_sidebar_width');
		$left_width = filter_var($left_width, FILTER_SANITIZE_NUMBER_INT);
		$left_width = $left_width + '%';
		
		
		$right_width = get_theme_mod('spoke_widget_sidebar_right_width');
		$right_width = filter_var($right_width, FILTER_SANITIZE_NUMBER_INT);
		$right_width = $right_width + '%';
		
		
		if ( get_theme_mod('spoke_widget_sidebars') == 'left' || get_theme_mod('spoke_widget_sidebars') == 'right' ) : ?>


		#left_sidebar {
		   float: <?php echo get_theme_mod('spoke_widget_sidebars'); ?>;
		   width: <?php if ( get_theme_mod('spoke_widget_sidebars') == 'left' ) {  echo $left_width.'%'; } else {  echo $right_width.'%'; } ?>;
		   display: block;

		}

		.content {
			width: <?php echo $main_width.'%'; ?>;
<?php 
    if ( get_theme_mod('spoke_widget_sidebars') == 'left' ): 
        echo 'float: left';
    else: 
        echo 'float: right'; 
    endif; 
?>
		}

<?php 	elseif ( get_theme_mod('spoke_widget_sidebars') == 'both' ) : ?>

		#left_sidebar {
			float: left;
			width: <?php echo $left_width.'%'; ?>;
			display: block;
		}

		#right_sidebar{
			float: right;
			width: <?php echo $right_width.'%'; ?>;
			display: block;
		}		

		.content{
			width: <?php echo  $main_width.'%'; ?>; 
            float: left;			
		}

		<?php 

		else:

		endif;

		?>
<?php if( get_theme_mod('spoke_widget_header') == 'no' ) : ?>
    .top_header.row-fluid .span4  { display: none; }
<?php endif; ?>
		 

    </style>
	<script type="text/javascript" src="<?php echo bloginfo('template_url');?>/js/customselect.js"></script>
	<script type="text/javascript" src="<?php echo bloginfo('template_url');?>/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo bloginfo('template_url');?>/js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
	<script language="javascript"> 	
        var $ = jQuery.noConflict();

        jQuery(window).load(function(){  
            var nav_h = jQuery('.navbar').height();

            jQuery('#main').css( 'padding-top', nav_h + "px" );  

            jQuery("html, body").animate({top: 0 },{duration:0,queue:false});    

			jQuery('select.responsiveMenuSelect').wrap("<div class='responsiveWrap'></div>");

            var $cs = $('.responsiveMenuSelect').customSelect();

            var fb_val = "<?php echo get_theme_mod('spoke_social_facebook')?>";
            var twitter_val = "<?php echo get_theme_mod('spoke_social_twitter')?>";
            var google_val = "<?php echo get_theme_mod('spoke_social_google')?>";
            var linkedin_val = "<?php echo get_theme_mod('spoke_social_linkedin')?>";
            var youtube_val = "<?php echo get_theme_mod('spoke_social_youtube')?>";
            var vimeo_val = "<?php echo get_theme_mod('spoke_social_vimeo')?>";
            var flickr_val = "<?php echo get_theme_mod('spoke_social_flickr')?>";
            var instagram_val = "<?php echo get_theme_mod('spoke_social_instagram')?>";
            var pinterest_val = "<?php echo get_theme_mod('spoke_social_pinterest')?>";
            var tumblr_val = "<?php echo get_theme_mod('spoke_social_tumblr')?>";
            var dribble_val = "<?php echo get_theme_mod('spoke_social_dribble')?>";
            var skype_val = "<?php echo get_theme_mod('spoke_social_skype')?>"; 

            if( fb_val == '' && twitter_val == '' && google_val == '' && linkedin_val == '' && youtube_val == '' && vimeo_val == '' && flickr_val == '' && instagram_val == '' && pinterest_val == '' && tumblr_val == '' && dribble_val == '' && skype_val == '' ){
              jQuery('.top_header.row-fluid .span4').css('display','none');
            }				             
			
            jQuery('.portfolio_category_nav').find('li').each( function(){
                jQuery(this).click(function() {
                    var cat_id = jQuery(this).find('a').attr('rel'); 
                    jQuery('.portfolio_category_nav').find('.active').removeClass('active');
                    jQuery(this).addClass('active');
                    jQuery('.thumb').fadeOut();
                    if(cat_id == 'cat_portfolio_all'){
                        jQuery('.thumb').fadeIn();
                    } else {
                        jQuery( '.under_' + cat_id ).fadeIn();
                    }
                } );
            } );
        
            jQuery('.hbuttons').each(function(){
                var fade = jQuery(this).hasClass('fade');
                var slide = jQuery(this).hasClass('slide');
                if( !slide && !fade ){
                    jQuery(this).addClass('slide');
                }

            });

            jQuery('.w-portfolio-item').each(function(){
                var $image = jQuery(this).find('.w-portfolio-item-image-first'); 

                if( jQuery(this).hasClass('smart-color-on') == true ){
                    var image  = $image[0];
                    var colorThief = new ColorThief();
                    var dominant = colorThief.getColor(image);
                    var color = 'rgb( ' + dominant + ' )';
                    jQuery(this).find('.hbuttons').css('background-color', color);  

                } else {

                    var color = jQuery(this).find('.hbuttons').attr('rel');

                    if ( color == ''){ 
                        var bgcolor = "<?php echo get_theme_mod('spoke_color_primary'); ?>";  
                        jQuery(this).find('.hbuttons').css('background-color', bgcolor);
                    } else {
                        jQuery(this).find('.hbuttons').css('background-color', color); 	
                    }
                }	

                var h = jQuery(this).find('.img_item').height();
                var h3 = jQuery(this).find('.img_text h3').height();
                var pad = (h - h3) / 2;

                jQuery(this).find('.img_text h3').css("padding-top", pad + "px");
            });

 			jQuery('ul#menu-top-menu').children('li').each(function(){
                var h = jQuery(this).width();

                jQuery(this).css( 'min-width', ( h + 19 ) + "px" );

                /* jQuery(this).children('a').css('padding',  "30px 10px"); */
            });   

            jQuery('#menu-top-menu').children('li').each(function(){
                if( jQuery(this).find('.submenu-head') ){
                    jQuery(this).addClass('has_sublevel');
                }
            });

            jQuery('.w-clients-item img').each(function(){
        		var calc_height = jQuery(this).height();
        		var img_padding = (136 - calc_height) / 2;
        		jQuery(this).css("padding", img_padding+"px 0");
        	});


        });
     </script>

<?php }

add_action('wp_head', 'spoke_css_customizer');

function spoke_footer_customizer(){ ?>

	<script language="javascript"> 	
		var $ = jQuery.noConflict();
		jQuery(window).load(function(){  
			jQuery(".fancybox").fancybox({
					'transitionIn'	:	'elastic',
					'transitionOut'	:	'elastic',
					'speedIn'		:	200, 
					'speedOut'		:	200, 
					'titlePosition'	:	'outside',  
					'overlayShow'	:	false, 
					'showNavArrows' : true, 
					'enableKeyboardNav' : false, 
					'cyclic' : true
				});
				
				
				var isMobile = {
					Android: function() {
						return navigator.userAgent.match(/Android/i);
					},
					BlackBerry: function() {
						return navigator.userAgent.match(/BlackBerry/i);
					},
					iOS: function() {
						return navigator.userAgent.match(/iPhone|iPad|iPod/i);
					},
					Opera: function() {
						return navigator.userAgent.match(/Opera Mini/i);
					},
					Windows: function() {
						return navigator.userAgent.match(/IEMobile/i);
					},
					any: function() {
						return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
					}
				};
				
				if(isMobile.any()) {
					jQuery("#footer").css('display','block');   
				} else{
				<?php if( get_theme_mod('spoke_widget_footer_transition') == 'slide' && get_theme_mod('spoke_widget_footer_show') == 'show') : ?>					            			
                    var footer_h = jQuery('#footer').height() + 60;
                
					var wh = jQuery(window).height();
				
					jQuery('#main').css( 'padding-bottom',  "20px" );
                    jQuery("#main").css('z-index','1');
					jQuery('.l-main').css('min-height', wh + "px");
                    jQuery('#main').css( 'margin-bottom', footer_h + "px" );
					jQuery("#footer").css('z-index','-1');
					jQuery("#footer").css('position','fixed');
					jQuery("#footer").css('bottom','0');
					jQuery("#footer").css('left','0');
					jQuery("#footer").css('display','block');
                    //jQuery("#footer").find('*').css('z-index', '-1');
		      <?php endif; ?>					

				}                				
            });
			
            jQuery(window).scroll(function() {
				var set = $(document).scrollTop()+"px";  
				if( set > '23px'){  
					$('.top_header').slideUp('fast');
				}else if( set == '0px' ){ 
					$('.top_header').slideDown('fast');
				} 
			});		
	</script>
<?php }

add_action('wp_footer', 'spoke_footer_customizer');

