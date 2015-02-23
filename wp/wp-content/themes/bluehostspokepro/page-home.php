<?php
/**
 * Template Name: Home Page Template
 **/
	get_header(); 
?> 

			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();

					// Include the page content template.
					get_template_part( 'content', 'page' );
 
				endwhile;
			?>
	
<?php
	get_footer();
?>