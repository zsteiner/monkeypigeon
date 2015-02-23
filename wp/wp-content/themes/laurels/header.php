<?php
/*
 * Header For Laurels Theme.
 */
$laurels_options = get_option('laurels_theme_options');
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
  <!--<![endif]-->
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width">
    <title><?php wp_title('|', true, 'right'); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php if (!empty($laurels_options['favicon'])) { ?>
      <link rel="shortcut icon" href="<?php echo esc_url($laurels_options['favicon']); ?>">
    <?php } ?>
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <header>
      <div class="header_top">
        <div class="container webpage-container">
          <div class="col-md-12 no-padding top-header">
            <div class="col-md-7 col-sm-5"></div>                 
            <div class="col-md-3 col-sm-4">               
              <ul class="list-inline logo_div">
                <?php if (!empty($laurels_options['facebook'])) { ?>
                  <li ><a href="<?php echo esc_url($laurels_options['facebook']); ?>"><i class="fa fa-facebook"></i> </a></li>
                <?php } ?>  
                <?php if (!empty($laurels_options['twitter'])) { ?>
                  <li ><a href="<?php echo esc_url($laurels_options['twitter']); ?>"> <i class="fa fa-twitter"></i> </a></li>
                <?php } ?>  
                <?php if (!empty($laurels_options['pinterest'])) { ?>
                  <li ><a href="<?php echo esc_url($laurels_options['pinterest']); ?>"> <i class="fa fa-pinterest"></i> </a></li>
                <?php } ?>
                <?php if (!empty($laurels_options['googleplus'])) { ?>  
                  <li ><a href="<?php echo esc_url($laurels_options['googleplus']); ?>"> <i class="fa fa-google-plus"></i> </a></li>  
                <?php } ?>
                <?php if (!empty($laurels_options['rss'])) { ?>
                  <li ><a href="<?php echo esc_url($laurels_options['rss']); ?>"> <i class="fa fa-rss"></i></a></li>            
                <?php } ?> 
              </ul>                       
            </div>              
            <div class="col-md-2 col-sm-3  no-padding search-box">       	
              <form method="get" id="searchform" action="<?php echo esc_url(home_url()); ?>/">
                <input type="text" class="input-medium search-query search-input" name="s" placeholder="<?php _e('Search..', 'laurels'); ?>" id="s" value="<?php the_search_query(); ?>">
                <button type="submit" class="add-on" id="searchsubmit">
                  <span class="fa fa-search"></span>
                </button>      
              </form>              
            </div>                				
          </div>            
        </div>
      </div>
      <div class="header_bottom">
        <div class="container webpage-container">
          <div class="col-md-12 no-padding "> 
            <div class="header_menu">    
              <div class="col-sm-2 col-md-2 logo-display  no-padding">
                <?php if (empty($laurels_options['logo'])) { ?>
                  <h1 class="laurels-site-name"><a href="<?php echo esc_url(site_url()); ?>"><?php echo get_bloginfo('name'); ?></a></h1>
                <?php } else { ?>
                  <a href="<?php echo site_url(); ?>"><img src="<?php echo esc_url($laurels_options['logo']); ?>" alt="Theme Logo" class="img-responsive logo" /></a>
                <?php } ?> 
              </div>    
              <div class="col-sm-10 col-md-10 no-padding">                  
                <nav class="navbar-default main_menu navigation-deafault" role="navigation">
                  <div class="navbar-header res-nav-header toggle-respon">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                      <span class="sr-only"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                  </div>
                  <?php
                  $laurels_defaults = array(
                      'theme_location' => 'primary',
                      'container' => 'div',
                      'container_class' => 'collapse navbar-collapse nav_coll main-menu-ul no-padding',
                      'container_id' => '',
                      'menu_class' => 'collapse navbar-collapse nav_coll main-menu-ul no-padding',
                      'menu_id' => '',
                      'echo' => true,
                      'fallback_cb' => 'wp_page_menu',
                      'before' => '',
                      'after' => '',
                      'link_before' => '',
                      'link_after' => '',
                      'items_wrap' => '<ul>%3$s</ul>',
                      'depth' => 0,
                      'walker' => ''
                  );
                  wp_nav_menu($laurels_defaults);
                  ?>
                </nav>	             
              </div>
            </div>				
          </div>
        </div> 
      </div>                
    </header>
