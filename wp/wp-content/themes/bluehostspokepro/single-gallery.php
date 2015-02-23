 <?php
get_header(); ?>  
<div id="container" class="">
<div class="header-title">
<h3><?php
the_title(); ?></h3>
<div class="breadcrumbs">
<?php

if (function_exists('qt_custom_breadcrumbs')) qt_custom_breadcrumbs(); ?>	
</div>
</div>

 <?php
$categories = get_categories(array(
'taxonomy' => 'img_cat',
'hide_empty' => 0
)); ?>	 
 <div class="w-portfolio columns_4 ratio_1-1 type_sortable ">
 <div class="w-portfolio-h">
 <div class="w-filters">                            
 <div class="w-filters-h">                               
 <div class="w-filters-list">                                    
 <div class="w-filters-item active">                                        
 <a data-filter="*" href="javascript:void(0);" class="w-filters-item-link">All</a>                                    
 </div>
 <?php

foreach($categories as $category):
$category_array[$category->term_id] = $category->category_nicename; ?>	<div class="w-filters-item"> <a data-filter=".portfolio_cat-<?php
echo $category->category_nicename; ?>" href="javascript:void(0);" class="w-filters-item-link"><?php
echo $category->category_nicename; ?></a> </div>  <?php
endforeach; ?>	</div>                            </div>                    </div> <div class="w-portfolio-list"> <div class="w-portfolio-list-h isotope" > <?php
$image_gallery = get_post_meta($post->ID, '_easy_image_gallery', true);
$attachements = array_filter(explode(',', $image_gallery)); ?>	  <?php
global $nggdb;
$k = 1;

foreach($attachements as $key => $value):
$post_categories = wp_get_object_terms($value, 'img_cat', array(
'fields' => 'ids'
));
$category_class = '';
foreach($post_categories as $cat => $val):
$category_class.= ' portfolio_cat-' . $category_array[$val];
endforeach;
$image_link = wp_get_attachment_image_src($value, 'gallery-l');
$image_link = $image_link[0];
$image_meta = wp_get_attachment($value);
$image_caption = $image_meta['caption'];
$image_description = $image_meta['description'];
$image_title = $image_meta['title'];
$image_src = $image_meta['src'];
$image_smart_color = '-' . get_post_meta($value, '_gallery_smart_color', true); /* // gets "on" or "off" for smart color */
$image_transition = get_post_meta($value, '_gallery_transition', true); /*  // gets "fade" or "slide" for smart color*/
$image_link_url = get_post_meta($value, '_gallery_link_url', true); /*  // gets external link to be used*/
$image_hover_color = get_post_meta($value, '_gallery_color_hover', true); /* // gets custom hover color*/
$image_text_color = get_post_meta($value, '_gallery_color_text', true); /* // gets custom hover color*/
$image_show_thumb = get_post_meta($value, '_gallery_show', true); /*  // gets "yes" or "no" value, if yes.. display the image thumb. if no, display the caption*/ 

if($image_smart_color != '-off'){
$image_smart_color = '-on';
}
if($image_show_thumb != 'no'){
$image_show_thumb = 'yes';
}
if($image_transition != 'slide'){
$image_transition = 'fade';
}
?>	<div  id="gal_<?php
echo $k++; ?>" class="w-portfolio-item smart-color<?php
echo $image_smart_color; ?> order_<?php
echo $k++; ?> <?php
echo $category_class; ?> isotope-item"> <div class="w-portfolio-item-h">   <div class="w-portfolio-item-image wpb_wrapper img_area"> <div class="img_item"> <img width="570"  height="380" <?php
if ($image_show_thumb == 'no'):
echo 'style="display: none;"';
endif; ?> alt="img-<?php
echo $k++; ?>" class="w-portfolio-item-image-first wp-post-image" src="<?php
echo $image_link; ?>"> <div class="img_text" style="border: 2px solid #ccc; height: <?php
if ($image_show_thumb == 'yes'):
echo '0';
else:
echo '339';
endif; ?>px;"> <h3 style="text-align: center;"> <?php
echo $image_caption; ?> </h3> </div> </div> <div class="hbuttons <?php
echo $image_transition; ?>" rel="<?php
echo $image_hover_color; ?>"> <h2 class="w-portfolio-item-title" style="color: <?php
echo $image_text_color; ?>;"> <?php
echo $image_title; ?> </h2>  <div class="imag-desc" style="color: <?php
echo $image_text_color; ?>;"> <p style="color: <?php
echo $image_text_color; ?>;"> <?php
echo implode(' ', array_slice(explode(' ', $image_description) , 0, 10)); ?> </p> </div>  <div class="hover-buttons"> <a  rel="portfolio_gallery"  title="<?php
echo $image_title; ?> <br/><?php
echo $image_caption; ?> " alt="<?php
echo $image_title; ?> <br/><?php
echo $image_caption; ?>" href="<?php
echo $image_src; ?>" class="fancybox" style="color: <?php
echo $image_text_color; ?>;"><i class="fa fa-search-plus "></i></a> <a class="link" href="<?php
echo $image_link_url; ?>" style="color: <?php
echo $image_text_color; ?>;"><i class="fa fa-link"></i></a> </div> </div> </div>  </div> </div>   <?php
endforeach; ?>      </div> </div> </div>            </div> <div class="clear clearfix"></div></div> <?php
get_footer(); ?>
