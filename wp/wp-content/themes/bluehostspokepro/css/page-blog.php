<?php 
/*
* Template Name: Blog Page
*/
	get_header(); 
?>   
<div id="container" class=""> 

	<div id="blog-container"> 
	<?php
		$args = array('post_type'=>'post');
		$spo_fix = "spoke_post_";
	?>
	<?php $the_query = new WP_Query(); ?>
	<?php if ( $the_query->have_posts() ) : ?>
	<?php while ( $the_query->have_posts() ) : $the_query->the_post();  

		$title_hover_color = get_post_meta($post->ID,"{$spo_fix}title_hover_color",true);
		$overlay_color = get_post_meta($post->ID, "{$spo_fix}overlay_color", true);
		$title_color = get_post_meta($post->ID, "{$spo_fix}title_color", true);
		$author_color = get_post_meta($post->ID, "{$spo_fix}author_color", true);
		$calendar_color = get_post_meta($post->ID, "{$spo_fix}calendar_color", true);
		$comment_color = get_post_meta($post->ID, "{$spo_fix}comment_color", true);
		$excerpt_color = get_post_meta($post->ID, "{$spo_fix}excerpt_color", true);
		$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
	?>  
			<article style="<?php if (has_post_thumbnail()):?>background:url(<?php echo $url; ?>);<?php endif;?>overflow: hidden; height: 381px;" <?php post_class(); ?> id="post-<?php the_ID(); ?>">
				<div class="blog-entry"> 
					<div class="color-overlay" <?php if(!empty($overlay_color)):?>style="background-color:<?php echo $overlay_color;?>"<?php endif;?>></div>
					<div class="entry-container">
						<header class="entry-header">
							<h1 class="entry-title"> 
								<a onMouseOver="this.style.color='<?php echo $title_hover_color;?>'" onMouseOut="this.style.color='<?php echo $title_color;?>'" style="color: <?php echo $title_color;?>;" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a> 
								
							</h1>
							<div class="blog-post-meta"> 
								<ul>
									<li class="span4" style="color: <?php echo $author_color;?>; "><span class="fa fa-user"></span><?php the_author_link(); ?> </li>
									<li class="span4" style="color: <?php echo $calendar_color;?>; "><span class="fa fa-calendar"></span><?php the_time('y/m/d') ?></li>
									<li class="span4" style="color: <?php echo $comment_color;?>; "><span class="fa fa-comments"></span><a style="color: <?php echo $comment_color;?>; " href="<?php the_permalink(); ?>"><?php comments_number(); ?></a></li>
								</ul>
							</div>
						</header><!-- .entry-header --> 
						<div class="entry-summary">
							<p style="color: <?php echo $excerpt_color;?>; ">
								<?php $content = get_the_content();
							      $content = strip_tags($content);
							      echo substr($content, 0, 512);
								?>
								<a style="color: <?php echo $excerpt_color;?>; " href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">[...]</a>
							</p>
						</div><!-- .entry-summary --> 
						<div class="clear"></div>
					</div><!-- .entry-container -->
					<!-- <div class="blog-feat-image" style="overflow: hidden; height: 381px;" > 
						<?php if ( has_post_thumbnail() ) {
							the_post_thumbnail( 'full' );
							} /* else { ?>
							<img src="<?php bloginfo('template_url'); ?>/images/blog<?php echo $i++; if( $i == 5){ $i = 1;} ?>.jpg"/>
						<?php } */ ?>
					</div> -->
				</div><!-- .entry -->
			</article><!-- .post -->	 	 
	<?php endwhile; ?> 

			<div class="nav-links"> 
				<?php echo paginate_links($the_query->max_num_pages);  ?> 
			</div><!--nav-links--> 
		<?php else : ?>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>	
	<?php wp_reset_query(); ?>	
	</div><!-- end of #blog-container -->
	<div class="clear clearfix"></div>
</div>
<?php
	get_footer();
?>
