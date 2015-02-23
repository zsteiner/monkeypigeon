<?php 
/*
 * Template Name: Home Page 
 */
get_header();
$laurels_options = get_option( 'laurels_theme_options' ); ?>
<section>
	<?php
	$laurels_flag=0;
	for($laurels_loop=1 ; $laurels_loop <=5 ; $laurels_loop++):?>
	<?php if(!empty($laurels_options['slider-img-'.$laurels_loop])){
		$laurels_flag=1;
		break;
	}
	endfor;
	?>
	<?php if($laurels_flag == 1){ ?>
   <div class="banner">    	
         <!--Carousel-->
          <div id="sidebar-carousel-1" class="carousel slide " data-ride="carousel">
		  <div class="carousel-inner">
         	<?php 
         	$laurels_first_slide=0;
         	for($laurels_loop=1 ; $laurels_loop <=5 ; $laurels_loop++):?>
			<?php if(!empty($laurels_options['slider-img-'.$laurels_loop])){				
				?>	
				<div <?php  echo ($laurels_first_slide == 0) ? "class='item active'" : "class='item'"; ?> >
                	<?php if(!empty($laurels_options['slidelink-'.$laurels_loop])) {?>
					  <a href="<?php echo esc_url($laurels_options['slidelink-'.$laurels_loop]);?>" target="_blank" data-lightbox="image-1">
							<img src="<?php echo esc_url($laurels_options['slider-img-'.$laurels_loop]); ?>" alt="<?php the_title(); ?>" /></a>
					  <?php }else{ ?>
							<img src="<?php echo esc_url($laurels_options['slider-img-'.$laurels_loop]); ?>" alt="<?php the_title(); ?>" />
					  <?php 					  
					  } ?>
                </div>
            <?php
            $laurels_first_slide++;
             } ?>
			<?php endfor;?>
			</div>
             <!-- Controls -->
            <?php if($laurels_first_slide > 1){ ?>
            <a class="left carousel-control slider_button" href="#sidebar-carousel-1" data-slide="prev">
              	<img src="<?php echo get_template_directory_uri(); ?>/images/prev.png" alt="...">
            </a>
            <a class="right carousel-control slider_button" href="#sidebar-carousel-1" data-slide="next">
             	<img src="<?php echo get_template_directory_uri(); ?>/images/next.png" alt="...">
            </a>
            <?php } ?>
            
    </div><!--/Carousel-->
    </div>
    
    <?php } ?>
    <div class="webpage-container">
    	<div class="section_row_1 text-center col-md-12">
        	<h2><?php if(!empty($laurels_options['home-title'])) { echo esc_attr($laurels_options['home-title']); } ?></h2>
        	<p><?php if(!empty($laurels_options['home-content'])) { echo esc_attr($laurels_options['home-content']); } ?></p>			        
        </div>
        
     <div class="section_row_2 col-md-12 no-padding">        	
		<?php for($laurels_loop=1 ; $laurels_loop <=4 ; $laurels_loop++):?>
		<?php if(!empty($laurels_options['home-icon-'.$laurels_loop])){ ?>
            <div class="col-sm-6 col-md-3">
                <div class="img_inline text-center center-block">
                    <div class="row_img">
					<?php if(!empty($laurels_options['home-icon-'.$laurels_loop])) {?>
							<img src="<?php echo esc_url($laurels_options['home-icon-'.$laurels_loop]); ?>" alt="<?php the_title(); ?>" class="img-circle"  />
					  <?php }else{ ?>
							<img src="<?php echo esc_url($laurels_options['home-icon-'.$laurels_loop]); ?>" alt="<?php the_title(); ?>" class="img-circle"  />
					  <?php } ?>
					  <p><?php echo esc_attr($laurels_options['section-title-'.$laurels_loop]); ?>
							<span><?php echo esc_attr($laurels_options['section-post-'.$laurels_loop]); ?></span>
						</p>                            
                    </div>
                    <div class="row_content">
                        <p><?php echo esc_attr($laurels_options['section-content-'.$laurels_loop]); ?></p>
                    </div>
                </div>
            </div>   
      <?php  } ?>
      <?php endfor;?> 
    </div>   
   </div>
     <?php if(!empty($laurels_options['post-category'])){ ?>
    <div class="container webpage-container">
        <div class="section_row_3">                           
            <div class="col-md-12 title lx no-padding">
            	<h3><?php if(!empty($laurels_options['post-title'])) { echo esc_attr($laurels_options['post-title']); }else{ echo _e('Recent Post','laurels'); }?></h3>
            </div>
            <div class="row">
            <?php
				$laurels_args = array(
				'cat'  => $laurels_options['post-category'],
				'meta_query' => array(
				array(
					'key' => '_thumbnail_id',
					'compare' => 'EXISTS'
					),
			)
		);	
		$laurels_query=new $wp_query($laurels_args); ?>
				<?php if ( $laurels_query->have_posts() ) { ?>	
			<div class="gallary">
				<?php while($laurels_query->have_posts()) {  $laurels_query->the_post(); ?>	
				<?php $laurels_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'laurels-home-thumbnail-image', true ); ?>
                    <div class="col-sm-6 col-md-4">
						<div class="box">
                        	<div class="gallery-img">
								<a href="<?php echo get_permalink(get_the_ID()); ?>">
									<img src="<?php echo $laurels_image[0]; ?>" width="<?php echo $laurels_image[1]; ?>" height="<?php echo $laurels_image[2]; ?>" alt="<?php the_title(); ?>">
								 </a>
                             </div>
                            <div class="prod_detail">
                                <h5><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo get_the_title(); ?></a></h5>  
                            </div>                        
                        </div>                      
                    </div>
           
                    <?php } ?>
            </div>    
                    <?php } else { echo '<p>no posts found</p>'; } ?>
            </div>            
        </div>  
    </div>
  <?php } ?>
    <div class="container webpage-container">   
        <div class="section_row_4">
        	<div class="header_line">          
                <div class="col-md-12 title no-padding">
            		<h3><?php if(!empty($laurels_options['latestpost-title'])) { echo esc_attr($laurels_options['latestpost-title']); }else{ echo _e('OUR LATEST POSTS','laurels'); }?></h3>
                </div>                               
                <div class="customNavigation">
                    <a class="btn prev btn-default btn_lr">
                    <i class="fa fa-angle-left"></i></a>
                    <a class="btn next btn-default btn_lr">
                    <i class="fa fa-angle-right"></i></a>
                </div>                 
            </div> 
            <div class="media_blog">
            <div class="" id="media_slide">                    
		 <?php 
  		  $laurels_args = array( 
					'orderby'      => 'post_date', 
					'order'        => 'DESC',
					'post_type'    => 'post',
					'post_status'    => 'publish'	
				  );
		$laurels_query = new WP_Query($laurels_args);
		?>
	<?php if ($laurels_query->have_posts() ) : while ($laurels_query->have_posts()) : $laurels_query->the_post(); ?>	
	
	<?php $laurels_image = wp_get_attachment_link(get_post_thumbnail_id(get_the_ID()), 'laurels-home-latestpost-thumbnails' ); ?>
			<div class="owl-item">
                        <div class="media media_left"> 
			<?php if(get_post_thumbnail_id(get_the_ID())) { echo $laurels_image; } ?>
                            <div class="media-body"> 
                            <h4 class="media-heading"><?php the_title(); ?></h4> 
                            <?php the_excerpt(); ?>
                            </div> 
                        </div>
                    </div>
                 <?php endwhile; endif; // end of the loop. ?>   
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>
