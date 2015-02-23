<?php 

	get_header(); 

?>  

<div id="container" class="">

	<div class="header-title">

		<h3><?php the_title();?></h3>

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
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="content">
				<?php the_content(); ?>
				<div class="nav-links">
					<span class="nav-previous"><?php previous_post_link( '%link', 'Previous Post' ); ?></span>
					<span class="nav-next"><?php next_post_link( '%link', 'Next Post' ); ?></span>
				</div>
				<div class="clear"></div>
				<?php comments_template(); ?>				
			</div>
		<?php endwhile; ?>
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

