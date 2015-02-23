<?php 

	get_header(); 

?>   

<div id="container" class=""> 

	<div class="header-title">
		<h3> 
		<?php printf( __( 'Search Results for: %s', 'twentyfourteen' ), get_search_query() ); 
		if( ! have_posts() ):
			echo '<p> No results found. </p>';
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

