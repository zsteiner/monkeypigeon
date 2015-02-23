<?php 

	get_header(); 

?>   

<div id="container" class=""> 

	<div class="header-title">
		<h3> 
		<?php printf( __( 'Category Archives: %s', 'spoke-theme' ), single_cat_title( '', false ) );
		if( ! have_posts() ):
			echo ': No posts on this archive.';
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

