<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form. 
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>

	<h3 id="comments">
		<?php
			printf( _n( 'One Response on &ldquo;%2$s&rdquo;', '%1$s Responses on &ldquo;%2$s&rdquo;', get_comments_number(), 'twentyfourteen' ),
				number_format_i18n( get_comments_number() ), get_the_title() );
		?>
	</h3> 

	<ol class="comment-list">
		<?php
			wp_list_comments( array(
				'style'      => 'ol',
				'short_ping' => true,
				'avatar_size'=> 34,
			) );
		?>
	</ol><!-- .comment-list -->
  <script language="javascript"> 	     jQuery(document).ready(function(){		jQuery("#container .commentmetadata").each(function(){			jQuery(this).after("<div class='clear'></div>");		});		jQuery("#container .reply").each(function(){			jQuery(this).before("<div class='clear'></div>");		});	});</script>

	<?php endif; // have_comments() ?>

	<?php 
		$comments_args = array(
		        // change the title of send button 
		        'label_submit'=>'SUBMIT',
		        // change the title of the reply section
		        'title_reply'=>'ADD COMMENT',
		        // remove "Text or HTML to be displayed after the set of comment fields"
		        'comment_notes_after' => '',
		        // redefine your own textarea (the comment body)
		        'comment_field' => '</label><br /><textarea id="comment" name="comment" aria-required="true"></textarea></p>',
		);

		comment_form($comments_args);
	?>

</div><!-- #comments -->
