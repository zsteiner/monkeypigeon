<?php
/**
 * Footer For Laurels Theme.
 */
$laurels_options = get_option( 'laurels_theme_options' );
?>
<footer>
	<div class="section_bottom">
    	<div class="container webpage-container">
        	<div class="col-sm-4 col-md-4 no-padding column-footer">
				<div class="bottum_hr">
					<?php if ( is_active_sidebar( 'footer-1' ) ) {  dynamic_sidebar( 'footer-1' ); } ?>
                </div>            
            </div>
            <div class="col-sm-4 col-md-4 no-padding column-footer">
            	<div class="bottum_hr">
					<?php if ( is_active_sidebar( 'footer-2' ) ) {  dynamic_sidebar( 'footer-2' ); } ?>
				 </div>  
             </div>
            <div class="col-sm-4 col-md-4 no-padding column-footer">
            	<div class="bottum_hr">
					<?php if ( is_active_sidebar( 'footer-3' ) ) {  dynamic_sidebar( 'footer-3' ); } ?>
                 </div> 
            </div>
        </div>
   	</div>
	<div class="container webpage-container">
   		<div class="col-sm-6 col-md-9  no-padding bottom-footer">
        	<?php if(!empty($laurels_options['footertext'])) {
			 	echo esc_attr($laurels_options['footertext']).' '; 
			  }
			?>  
			<span class='foot_txt text-left'>
			<?php _e('Powered by','laurels'); ?> <a href='http://wordpress.org' target='_blank'><?php _e('WordPress','laurels'); ?></a> <?php _e('and','laurels'); ?> <a href='http://fasterthemes.com/wordpress-themes/laurels' target='_blank'><?php _e('Laurels','laurels'); ?></a>
			</span>
        </div>
        <div class="col-sm-6 col-md-3 no-padding bottom-footer">
        	<ul>
				<?php if(!empty($laurels_options['facebook'])) { ?>
                <li><a href="<?php echo esc_url($laurels_options['facebook']);?>"><i class="fa fa-facebook facebook-hover"></i></a></li>
                <?php } ?>
                <?php if(!empty($laurels_options['twitter'])) { ?>
                <li><a href="<?php echo esc_url($laurels_options['twitter']);?>"><i class="fa fa-twitter twitter-hover"></i></a></li>
                <?php } ?>
                <?php if(!empty($laurels_options['googleplus'])) { ?>
                <li><a href="<?php echo esc_url($laurels_options['googleplus']);?>"><i class="fa fa-google-plus googleplus-hover"></i></a></li>
                <?php } ?>
                <?php if(!empty($laurels_options['linkedin'])) { ?>
                <li><a href="<?php echo esc_url($laurels_options['linkedin']);?>"><i class="fa fa-linkedin linkedin-hover"></i> </a></li>             
                <?php } ?>
            </ul>
        </div>       
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
