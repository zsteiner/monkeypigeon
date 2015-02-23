<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons-->
<link rel="SHORTCUT ICON" href="<?php echo get_theme_mod('spoke_favicon'); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;
	wp_title( '|', true, 'right' );
	// Add the blog name.
	bloginfo( 'name' );
	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";
	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'wp_spoke' ), max( $paged, $page ) );
	?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />

		  <script src="<?php echo bloginfo('template_url');?>/js/color-thief.js"></script>
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
<?php $GLOBALS['options'] = get_option('rc_theme_options'); $options = $GLOBALS['options'];?>
</head>
<?php
$body_background_styles_text = '';
$body_background_image = (@$smof_data['body_background_image'] != '')?@$smof_data['body_background_image']:'';
if ($body_background_image != '')
{
    $body_background_styles = array( 'background-image' => 'url('.$body_background_image.')');
    $body_background_image_stretch = (@$smof_data['body_background_image_stretch'] == 1)?TRUE:FALSE;
    if ($body_background_image_stretch) {
        $body_background_styles['background-size'] = 'cover';
    }
    if (@$smof_data['body_background_image_repeat'] != '') {
        $baclgroundRepeatCss = array(
            'Repeat' => 'repeat',
            'Repeat Horizontally' => 'repeat-x',
            'Repeat Vertically' => 'repeat-y',
            'Do Not Repeat' => 'no-repeat',
        );
        $body_background_styles['background-repeat'] = $baclgroundRepeatCss[@$smof_data['body_background_image_repeat']];
    }
    if (@$smof_data['body_background_image_position'] != '') {
        $body_background_styles['background-position'] = @$smof_data['body_background_image_position'];
    }
    if (@$smof_data['body_background_image_attachment'] == 'Background is fixed with regard to the viewport') {
        $body_background_styles['background-attachment'] = 'fixed';
    }
    foreach ($body_background_styles as $body_background_style => $body_background_style_val)
    {
        $body_background_styles_text .= $body_background_style.': '.$body_background_style_val.';';
    }
}
$body_class = get_theme_mod('spoke_width_layout');
if( empty($body_class) ){
	$body_class = 'fullwidth';
}
?>
<body <?php body_class( $body_class ); ?>>
<?php echo  ($body_background_styles_text != '')?' style="'.$body_background_styles_text.'"':''; ?>
<?php
if (defined('IS_FULLWIDTH') AND IS_FULLWIDTH)
{
	$sidebar_position_class = 'col_cont';
}
elseif (defined('IS_POST') AND IS_POST)
{
	$sidebar_position_class = (@$smof_data['post_sidebar_pos'] == 'Right')?'col_contside':'col_sidecont';
}
elseif (defined('IS_BLOG') AND IS_BLOG)
{
	$sidebar_position_class = (@$smof_data['blog_sidebar_pos'] == 'Right')?'col_contside':'col_sidecont';
}
else
{
	$sidebar_position_class = (defined('SIDEBAR_POS') AND SIDEBAR_POS == 'right')?'col_contside':'col_sidecont';
}
$layout_class = (@$smof_data['boxed_layout'] == 1)?'type_boxed':'type_wide';
$extended_header_class = '';
if (@$smof_data['header_is_extended'] == 1) {
	$extended_header_class = ' headertype_extended';
}
$header_position_class = '';
if (@$smof_data['header_is_sticky'] == 1) {
	$header_position_class = ' headerpos_fixed';
}
?>
<div class="l-canvas <?php echo $layout_class.' '.$sidebar_position_class.$extended_header_class.$header_position_class; ?>">
	<div class="l-canvas-h">

<!-- Fixed navbar -->
    <div class="navbar navbar-fixed-top">

		<div class="top_header row-fluid">
		<div class="logo-area span8">			<a class="brand" href="<?php echo bloginfo('url');?>"><img src="<?php if ( get_theme_mod('spoke_logo') ): echo get_theme_mod('spoke_logo'); else: echo get_bloginfo('template_url') . '/images/logo2211.jpg'; endif;?>" class="default_logo" alt="Logo" title="Logo" /></a>		</div>
			<div class="span4">
				<div class="row-fluid">
							<div class="w-socials size_small">
								<div class="w-socials-h">
									<div class="w-socials-list">
                            <?php $social_text  = 'spoke_social_'; ?>
                            <?php if( stripos( get_theme_mod( $social_text . 'facebook' ), 'facebook.com') !== FALSE) : ?>
                                    <div class="w-socials-item facebook">
                                        <a href="<?php if(!parse_url(get_theme_mod($social_text . 'facebook'), PHP_URL_SCHEME)) echo 'http://'; ?><?php echo get_theme_mod($social_text . 'facebook'); ?>" target="_blank" class="w-socials-item-link">
                                            <i class="fa fa-facebook"></i>
                                        </a>                            
                                    </div>
                            <?php endif; ?>
                            <?php if( stripos( get_theme_mod( $social_text . 'twitter'), 'twitter.com' ) !== FALSE ) : ?>
                                    <div class="w-socials-item twitter">
                                        <a href="<?php if(!parse_url(get_theme_mod($social_text . 'twitter'), PHP_URL_SCHEME)) echo 'http://'; ?><?php echo get_theme_mod($social_text . 'twitter'); ?>" target="_blank" class="w-socials-item-link">
                                            <i class="fa fa-twitter"></i>
                                        </a>                                        
                                    </div>
                            <?php endif; ?>
                            <?php if( stripos( get_theme_mod( $social_text . 'google'), 'plus.google.com') !== FALSE ) : ?>
                                    <div class="w-socials-item gplus">
                                        <a href="<?php if(!parse_url(get_theme_mod($social_text . 'google'), PHP_URL_SCHEME)) echo 'http://'; ?><?php echo get_theme_mod($social_text . 'google'); ?>" target="_blank" class="w-socials-item-link">
                                            <i class="fa fa-google-plus"></i>
                                        </a>
                                    </div>
                            <?php endif; ?>
                            <?php if( stripos( get_theme_mod( $social_text . 'linkedin'), 'linkedin.com') !== FALSE ) : ?>
                                    <div class="w-socials-item linkedin">
                                        <a href="<?php if(!parse_url(get_theme_mod($social_text . 'linkedin'), PHP_URL_SCHEME)) echo 'http://'; ?><?php echo get_theme_mod($social_text . 'linkedin'); ?>" target="_blank" class="w-socials-item-link">
                                            <i class="fa fa-linkedin"></i>
                                        </a>											
                                    </div>
                            <?php endif; ?>
                            <?php if( stripos( get_theme_mod( $social_text . 'youtube'), 'youtube.com' ) !== FALSE  ) : ?>
                            <div class="w-socials-item youtube">
                                <a href="<?php if(!parse_url(get_theme_mod($social_text . 'youtube'), PHP_URL_SCHEME)) echo 'http://'; ?><?php echo get_theme_mod($social_text . 'youtube'); ?>" target="_blank" class="w-socials-item-link">
                                    <i class="fa fa-youtube-play"></i>
                                </a>                                
                            </div>
                            <?php endif; ?>
                            <?php if( stripos( get_theme_mod( $social_text . 'vimeo'), 'vimeo.com' ) !== FALSE ) : ?>
                            <div class="w-socials-item vimeo">											
                                <a href="<?php if(!parse_url(get_theme_mod($social_text . 'vimeo'), PHP_URL_SCHEME)) echo 'http://'; ?><?php echo get_theme_mod($social_text . 'vimeo'); ?>" target="_blank" class="w-socials-item-link">
                                    <i class="fa fa-vimeo-square"></i>
                                </a>                                
                            </div>
                            <?php endif; ?>
                            <?php if( stripos( get_theme_mod( $social_text . 'flickr'), 'flickr.com' ) !== FALSE ) : ?>
                            <div class="w-socials-item flickr">
                                <a href="<?php if(!parse_url(get_theme_mod($social_text . 'flickr'), PHP_URL_SCHEME)) echo 'http://'; ?><?php echo get_theme_mod($social_text . 'flickr'); ?>" target="_blank" class="w-socials-item-link">
                                    <i class="fa fa-flickr"></i>
                                </a>
                            </div>
                            <?php endif; ?>
                            <?php if( stripos( get_theme_mod( $social_text . 'instagram'), 'instagram.com' ) !== FALSE ) : ?>
                            <div class="w-socials-item instagram">	
                                <a href="<?php if(!parse_url(get_theme_mod($social_text . 'instagram'), PHP_URL_SCHEME)) echo 'http://'; ?><?php echo get_theme_mod($social_text . 'instagram'); ?>" target="_blank" class="w-socials-item-link">
                                    <i class="fa fa-instagram"></i>
                                </a>                         
                            </div>
                            <?php endif; ?>
                            <?php if( stripos( get_theme_mod( $social_text . 'pinterest'), 'pinterest.com' ) !== FALSE ) : ?>
                            <div class="w-socials-item pinterest">
                                <a href="<?php if(!parse_url(get_theme_mod($social_text . 'pinterest'), PHP_URL_SCHEME)) echo 'http://'; ?><?php echo get_theme_mod($social_text . 'pinterest'); ?>" target="_blank" class="w-socials-item-link">
                                    <i class="fa fa-pinterest"></i>
                                </a>
                            </div>
                            <?php endif; ?>
                            <?php if( stripos( get_theme_mod( $social_text . 'skype'), 'skype' ) !== FALSE ) : ?>
                            <div class="w-socials-item skype">
                                <a href="<?php if(!parse_url(get_theme_mod($social_text . 'skype'), PHP_URL_SCHEME)) echo 'http://'; ?><?php echo get_theme_mod($social_text . 'skype'); ?>" target="_blank" class="w-socials-item-link">
                                    <i class="fa fa-skype"></i>
                                </a>									
                            </div>
                            <?php endif; ?>
                            <?php if( stripos( get_theme_mod( $social_text . 'tumblr'), 'tumblr.com' ) !== FALSE ) : ?>
                            <div class="w-socials-item tumblr">
                                <a href="<?php if(!parse_url(get_theme_mod($social_text . 'tumblr'), PHP_URL_SCHEME)) echo 'http://'; ?><?php echo get_theme_mod($social_text . 'tumblr'); ?>" target="_blank" class="w-socials-item-link">
                                    <i class="fa fa-tumblr"></i>
                                </a>                                
                            </div>
                            <?php endif; ?>
                            <?php if( stripos( get_theme_mod( $social_text . 'dribbble'), 'dribbble.com' ) !== FALSE ) : ?>
                            <div class="w-socials-item dribbble">
                                <a href="<?php if(!parse_url(get_theme_mod($social_text . 'dribbble'), PHP_URL_SCHEME)) echo 'http://'; ?><?php echo get_theme_mod($social_text . 'dribbble'); ?>" target="_blank" class="w-socials-item-link">
                                    <i class="fa fa-dribbble"></i>
                                </a>
                            </div>
                            <?php endif; ?>
                    </div></div></div>
				</div>
			</div>
		</div>
      <div class="navbar-inner top-menu">
          <div class="container">
			<?php /* 
              <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">           	<span class="fa fa-bars"></span>           </button>
			  */ ?>
			  <div class="clearfix"></div>                  
			  <div id="top-nav" class="nav-collapse collapse">           
          <?php
			  $main_menu = has_nav_menu('main-menu');			
			  $alt_menu = wp_get_nav_menu_object('Alternative Menu');			
			  $one_page = get_theme_mod('spoke_one_page');

              if($one_page == 'true'){ ?>
					<ul id="menu-top-menu" class="nav navbar-nav">						
                        <li><a href="<?php echo bloginfo('url');?>/#main">Home</a></li>
                    </ul>
					<script type="text/javascript">
							$(document).ready(function(){
								var a , li,
								menu = $('ul#menu-top-menu');
								row = $('#main div.vc-rows');

								row.each(function(){
									var thisrow = $(this),
									href = thisrow.attr('id'),
									title = thisrow.data('title');
									if(href){
										li = $('<li><a href="#'+href+'">'+title+'</a></li>')
										menu.append(li);
									}
								})

								var nav_h = jQuery('.navbar-fixed-top').height();
								jQuery('#top-nav ul > li > a').on('click',function(){
									var section = jQuery(jQuery(this).attr("href"));
									var top = section.offset().top - nav_h;
									jQuery("html, body").animate({ scrollTop: top }, 700);
									return false;
								});

							})
					</script>
			<?php }else{

					if ( $main_menu ) {
						 wp_nav_menu( array( 'theme_location' => 'main-menu', 'menu_id' => 'menu-top-menu', 'container' => false, 'menu_class' => 'nav navbar-nav', 'walker' => new Walker_Nav_Menu_us()  ));
					} 
					else{
						echo '<ul id="menu-top-menu" class="nav navbar-na responsiveSelectFullMenu">';
						$args = array(
						'title_li' => '' ,
						'walker'=> new Custom_Walker_Page()
						);
						wp_list_pages( $args );
						echo '</ul>';
						
						echo '<div class="responsiveWrap"><select class="responsiveMenuSelect"><option selected="selected" value=""></option>';
						$args = array(
						'title_li' => '' ,
						'walker'=> new ResponsivePageSelectWalker()
						);
						wp_list_pages( $args );
						echo '</select></div>';
						
						
					}
			}




			?>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

	<!-- MAIN -->
		<div id="main" class=" l-main">
			<div class="l-main-h">
