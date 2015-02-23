<?php 

	get_header(); 

?>  

<div id="container" class="">

	<div class="header-title">

		<h3><?php _e( 'Not Found', 'spoke-theme' ); ?></h3>

		<div class="breadcrumbs">

		   <?php if (function_exists('qt_custom_breadcrumbs')) qt_custom_breadcrumbs(); ?>

		</div>

	</div>
	
	<div class="wrap-content sidebar-desktop">
		
		<div id="left_sidebar">
		   <?php 
			if( ! dynamic_sidebar('default_sidebar')){ 
			}
			?>
		</div>	 
		
		<div class="content"> 
		<p>Sorry, but the page you were trying to view does not exist.</p>
	       <p>It looks like this was the result of either:
		   <br/> > a mistyped address 
		   <br/> > an out-of-date link
		   </p> <br/>
			<p><?php _e( ' Maybe try a search?', 'spoke-theme' ); ?></p><br/>
			<?php get_search_form(); ?>
		</div> 
		
		<div id="right_sidebar">
		   <?php 
			if( ! dynamic_sidebar('right_sidebar')){ 
			}
			?>
		</div>

	</div>

	<div class="wrap-content sidebar-mobile">
			
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="content">
				<?php the_content(); ?>
				<?php comments_template(); ?> 
			</div>
		<?php endwhile; ?>
		<div id="left_sidebar">
		   <?php 
			if( ! dynamic_sidebar('default_sidebar')){ 
			}
			?>
		</div>
		<div id="right_sidebar">
		   <?php 
			if( ! dynamic_sidebar('right_sidebar')){ 
			}
			?>
		</div>

	</div>	 


	<div class="clear clearfix"></div>

</div>

<?php

	get_footer();

?>

