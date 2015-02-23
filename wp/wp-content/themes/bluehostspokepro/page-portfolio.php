<?php 

/*

* Template Name: Portfolio Page Template

*/

	get_header(); 

?>  

<div id="container" class="">

<?php /*

	<div class="header-title">

		<h3><?php the_title();?></h3>

		<div class="breadcrumbs">

		    <?php if(function_exists('bcn_display'))

		    {

		        bcn_display();

		    }?>

		</div>

	</div> */ ?>

	<?php 

	

	$spoke_portfolio_image_album = 1;

	/*echo do_shortcode("[album id=$spoke_portfolio_image_album template=portdisplay]"); */

	

	include_once( 'display-portfolio.php' ); 

	

	?>  

	

	<div class="clear clearfix"></div>

</div>

<?php

	get_footer();

?>

