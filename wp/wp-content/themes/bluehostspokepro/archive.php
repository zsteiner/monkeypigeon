<?php 

	get_header(); 

?>  

<div id="container" class=""> 

	<div class="header-title">
		<h3> 
					<?php
						if ( is_day() ) :
							printf( __( 'Daily Archives: %s', 'spoke-theme' ), get_the_date() );

						elseif ( is_month() ) :
							printf( __( 'Monthly Archives: %s', 'spoke-theme' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'spoke-theme' ) ) );

						elseif ( is_year() ) :
							printf( __( 'Yearly Archives: %s', 'spoke-theme' ), get_the_date( _x( 'Y', 'yearly archives date format', 'spoke-theme' ) ) );

						else :
							_e( 'Archives', 'spoke-theme' );

						endif; 
						
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

