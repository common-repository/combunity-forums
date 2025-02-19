<?php
	include_once( Combunity_Api()->gettemplatedirpath() . 'functions.php');
	$comment_status = wp_get_comment_status( get_comment_ID() );
	$bad = array( "deleted", "spam", false );
	if ( in_array( $comment_status , $bad ) ){
		/**
		 * We don't want to display crappy replies
		 */
		return ;
	}
?>
<li id="comment-<?php comment_ID() ?>" class="comment-holder">
	<div class="combunity-comment-box">
	    <div class="comment-voting-bar text-center">
	    	<?php 
	    		//echo combunity_voting_bar_comments();
	    		//get_template_part('template-parts/voting-bar', '');
	    		include( Combunity_Api()->gettemplatedirpath() . 'voting-bar.php' );
	    	?>
	    </div>
		<div class="combunity-comment-body-container">
		    <div class="author-info">
		        <div class="author-vcard">
		        	<?php 
		        		/**
		        		 * Get the user's avatar
		        		 */
		        		$id = get_comment_ID();
		        		$comment = get_comment( $id );
		        		$avatar = get_avatar( $comment , 32, "", 
	            					"Avatar Image", 
	            					array("class"=>"combunity-forum-avatar")  );

		        		$author_email = get_comment_author_email(  $comment->ID );

		        		$comment_author = get_user_by( 'email', $author_email );

		        		$comment_author_display_text = $comment_author->user_login;

		        		// $profile_link = get_author_posts_url($comment_author->ID);

		        		$profile_link = Combunity_Api()->get_user_link( $comment_author->ID );

		        		echo $avatar
		        	?>
		        </div>
		        <!-- .vcard -->
		    	<span data-cid='comment-<?php comment_ID(); ?>' class='combunity-comment-extendible'>[-]</span><span class="author-name combunity-comment-upper-field"><a href='<?php echo $profile_link ?>' class='combunity-comment-author'><?php echo $comment_author_display_text; ?></a></span><span class="combunity-comment-points combunity-comment-upper-field"> </span><span class="combunity-comment-timeago combunity-comment-upper-field"><?php printf( _x( '%s ago', '%s = human-readable time difference', 'combunity' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ); ?></span>
		    </div>
			<div class="comment-text">
				<div class="combunity-comment-text-inner">
					<?php 
						
						if (  $comment_status == "unapproved" ){

							echo __('Reply awaiting moderation');

						} else {

							comment_text(); 

						}
					 ?>
				 </div>
			</div>
		    <!-- </div> -->
		    
		</div><!-- comment-body -->

		<footer class="combunity-comment-footer">
			<div class="combunity-comment-actions-bar">
				<span class="reply combunity-login-required"><?php 
					$max_depth = get_option('thread_comments_depth');
					comment_reply_link( 
						array(
							'reply_text' => __('Reply'),
							'depth' => $max_depth-1, 
							'max_depth' => $max_depth 
							)
						);

					
			        ?>
			    </span><!-- .reply -->
			    <span>
			    	<?php //Co_edit_comment_link(); ?>
			    </span>
		    	<?php  ?>
			</div>
		</footer><!-- .comment-footer -->
	</div><!-- #comment-<?php comment_ID(); ?> -->
