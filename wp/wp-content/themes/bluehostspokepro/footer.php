<?php global $smof_data; ?></div>
</div>
<!-- /MAIN -->
</div>
</div>
<!-- /CANVAS -->
<!-- Footer -->
 <?php 
 $spoke_color_footer_bg = get_theme_mod('spoke_color_footer_bg'); 
 $border_text = '';
 if( empty( $spoke_color_footer_bg ) ):  
	 $spoke_color_primary = get_theme_mod('spoke_color_primary');  
	 /*$border_text = " style='border-top: thin solid {$spoke_color_primary}' "; */
 endif; ?>
<?php if( get_theme_mod('spoke_widget_footer_show') != 'hide' ) : ?>
<div id="footer" <?php echo $border_text; ?>>   
  <div class="container">    
    <div class="row-fluid">      
      <div class="span4 wpb_column column_container foot-widget">
          <?php if( ! dynamic_sidebar('footer_first')){  }	?>
      </div>
      
      <div class="span4 wpb_column column_container foot-widget">
          <?php if( ! dynamic_sidebar('footer_second')){  }?>
      </div>
  	  <div class="span4 wpb_column column_container foot-widget">
	  <?php if( ! dynamic_sidebar('footer_third')){  }?>
	  </div>
   </div>
   </div>   
</div>
<?php endif; ?>       
<?php if( get_theme_mod('spoke_widget_footer') == 'show' ) : ?>
<div class="bottom_footer  row-fluid">
    <div class="non-fullwidth">
        <p style="text-align: center;padding-top: 10px;">
          &copy; <?php echo get_theme_mod('spoke_widget_copyright'); ?>
        </p>
   </div>
</div>
<?php endif; ?>

<!-- /Footer -->

<?php wp_footer(); ?>


</body>

</html>
