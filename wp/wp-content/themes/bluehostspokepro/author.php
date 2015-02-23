<?php 

	get_header(); 

?>   

<div id="container" class=""> 

	<div class="header-title">
		<h3> 
		<?php 
		
		if(  have_posts() ):
			printf( __( 'All posts by %s', 'spoke-theme' ), get_the_author() );
		else:
			echo  get_the_author() . ' has no post.';
		endif;
		?>
		</h3>
		<div class="breadcrumbs">
		    <?php if(function_exists('bcn_display'))
		    {
		        bcn_display();
		    }?>
		</div>
	</div>
	
	<?php 

		if( have_posts() ):
			get_template_part( 'content', 'archives' );
		endif;
 
	?>

<?php

	get_footer();

?>

