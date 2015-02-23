<?php 
	get_header(); 
?>  
<div id="container" class=""> 
	<?php if ( is_single() ) {
		get_template_part( 'content', 'single' );
	} else {
		get_template_part( 'content', 'blog' );
	}
	?>
<?php
	get_footer();
?>
