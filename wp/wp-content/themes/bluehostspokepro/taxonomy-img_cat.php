<?php
/**
 * The template for displaying Post Format pages
 *
 * Used to display archive-type pages for posts with a post format.
 * If you'd like to further customize these Post Format views, you may create a
 * new template file for each specific one.
 *
 * @todo http://core.trac.wordpress.org/ticket/23257: Add plural versions of Post Format strings
 * and remove plurals below.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<div id="container" class=""> 
<?php  
$current_cat = get_queried_object()->term_id; 
$test = get_queried_object()->slug; 
$title = get_queried_object()->name; 
?>

	<div class="header-title">
		<h3><?php echo $title;?></h3>
		<div class="breadcrumbs"> 
		</div>
	</div> 
	 
<div class="w-portfolio columns_4 ratio_1-1 type_sortable ">
			<div class="w-portfolio-h">
			 
					<?php ?>	
					<div class="w-portfolio-list">
						<div class="w-portfolio-list-h" >
							
						

	
					<div class="w-portfolio-list">
						<div class="w-portfolio-list-h isotope" >
							
							
						<?php

						$args = array(
									'post_type' => 'attachment',
									'img_cat' => $test 
								);
						
						$gal_post = get_posts( $args );
						 /* echo '<pre>'; print_r($gal_post);   echo'</pre>'; die(); */
						$attachment_ids_arr = array();
						foreach($gal_post as $post): setup_postdata($post);
							/*
							$attachment_ids = get_post_meta( $post->ID, '_easy_image_gallery', true );
							$attachment_ids = explode( ',', $attachment_ids );
							$attachment_ids_arr  = array_merge($attachment_ids_arr, $attachment_ids); 
							$post_categories = wp_get_object_terms($post->ID, 'img_cat', array('fields' => 'ids')); 
							*/
							$attachment_ids_arr[]  = $post->ID;
						endforeach;
						 
						 $attachements = array_unique($attachment_ids_arr); 
						 
						 foreach($attachements as $key=>$value):
							$post_categories = wp_get_object_terms($value, 'img_cat', array('fields' => 'ids'));  
						 endforeach;
						 ?>
						 
							
	<?php  
	global $nggdb;
	$k = 1;

						 foreach($attachements as $key=>$value):	
							$post_categories = wp_get_object_terms($value, 'img_cat', array('fields' => 'ids'));
							
							$image_link	= wp_get_attachment_image_src( $value , 'gallery-l'  );
							$image_link	= $image_link[0];
							
							$image_meta = wp_get_attachment( $value );
							
							$image_caption = $image_meta['caption'];
							$image_description = $image_meta['description'];
							$image_title = $image_meta['title'];
							$image_src = $image_meta['src'];
							$image_smart_color = '-' . get_post_meta( $value, '_gallery_smart_color', true ); // gets "on" or "off" for smart color
							$image_transition =  get_post_meta( $value, '_gallery_transition', true ); // gets "fade" or "slide" for smart color
							$image_link_url = get_post_meta( $value, '_gallery_link_url', true ); // gets external link to be used
							$image_hover_color = get_post_meta( $value, '_gallery_color_hover', true ); // gets custom hover color
							$image_show_thumb = get_post_meta( $value, '_gallery_show', true ); // gets "yes" or "no" value, if yes.. display the image thumb. if no, display the caption
							 
						 ?>		
							
							<div  id="gal_<?php echo $k++;?>" class="w-portfolio-item smart-color<?php echo $image_smart_color;?> order_<?php echo $k++;?>  isotope-item">
									<div class="w-portfolio-item-h">
										 
											<div class="w-portfolio-item-image wpb_wrapper img_area">
												<div class="img_item">
													<img width="570"  height="380" <?php if( $image_show_thumb == 'no' ) : echo 'style="display: none;"';  endif; ?> alt="img-<?php echo $k++;?>" class="w-portfolio-item-image-first wp-post-image" src="<?php echo $image_link;  ?>">
													<div class="img_text" style="border: 2px solid #ccc; height: <?php if( $image_show_thumb == 'yes' ) : echo '0'; else: echo '339'; endif; ?>px;">
														<h3 style="text-align: center;"> <?php echo $image_caption; ?> </h3>
													</div>
												</div>
												<div class="hbuttons <?php echo $image_transition;?>" rel="<?php echo $image_hover_color; ?>">
														<h2 class="w-portfolio-item-title"> <?php echo $image_title; ?> </h2>
														 <div class="imag-desc"><?php echo '<p> ' . $image_description  . ' <p>' ; ?></div>
														 <div class="hover-buttons">
															<a href="<?php echo $image_src; ?>" class="fancybox"><i class="fa fa-search-plus "></i></a>
															<a class="link" href="<?php echo $image_link_url; ?>"><i class="fa fa-link"></i></a>
														</div>
												</div>
											</div> 
									</div>
							</div>
							 
		<?php endforeach; ?> 
		 
	 
								
						</div>
					</div>
				
				</div>
            </div>




	
	<div class="clear clearfix"></div>
</div>
<?php
	get_footer();
?>
