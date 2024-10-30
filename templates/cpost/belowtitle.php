<span class="combunity-forum-post-author-post-info combunity-forum-icon-color">
	<?php 
		// var_dump( $GLOBALS['comment'] );

		$_comment = Combunity_Api()->the_last_comment();
		// $_comment = null;

		$author_post_id = get_the_author_meta( 'ID' );

		// $author_post = get_the_author();

		$ago = "";

		// var_dump( $comment )
		
		if (  $_comment  ) : 
			// This means the last action on this thread was someone's reply

			$curauth_post = get_user_by('ID', $author_post_id);

			$author_post = $curauth_post->user_login;

			$author = get_comment_author_email( $_comment->comment_ID );

			$ago = Combunity_Api()->get_comment_time( $_comment );

			$ago = human_time_diff( $ago, current_time( 'timestamp' ) );

			$curauth = get_user_by('email', $author);

			$author = $curauth->user_login;

			$profile_link = Combunity_Api()->get_user_link($curauth->ID);
			
			?>
			<a href="<?php echo $profile_link ?>" noblank="true" class=""><i class="fa fa-reply combunity-forum-icon" aria-hidden="true"></i><?php echo $author ?></a> <?php echo __('replied') ?>
	<?php else : ?>
	<?php 

		$curauth_post = get_user_by('ID', $author_post_id);

		$curauth_post_text = $curauth_post->user_login;

		$ago = human_time_diff( get_the_time('U'), current_time('timestamp') );

		if ( Combunity_Api()->notheme() ){

			$profile_link = Combunity_Api()->get_user_link( get_the_author_meta( 'ID' ) );

		}else{

			$profile_link = Combunity_Api()->the_userprofile_link();

		}
		
	?>
		<a href="<?php echo $profile_link ?>"  noblank="true"  class="combunity-forum-post-author-link"><?php echo $curauth_post_text ?></a> <?php echo __('created') ?>
	<?php endif; ?>
	<?php echo $ago ?> <?php echo __('ago'); ?>
	<?php 
	// $tag = Co_get_the_first_post_tag();
	$tag = null;
	if ( $tag ) : 
		$tagname = $tag->name;
		$taglink = get_term_link( $tag );
		$tagahref = sprintf( '<a href="%s">%s</a>', $taglink, $tagname );
		?>
		<span class="visible-xs-inline"> | <?php echo __(' in ') . $tagahref ?></span>
	<?php  endif; ?>
	<?php if ($_comment && is_single() )  : 
		if ( Combunity_Api()->notheme() ){

			$profile_link = Combunity_Api()->get_user_link( get_the_author_meta( 'ID' ) );

		}else{

			$profile_link = Combunity_Api()->the_userprofile_link(); 

		}

		?>
		<span><?php echo sprintf( __(', created by %s' ) , '<a  noblank="true" href="'.$profile_link.'" class="combunity-forum-post-author-link ">'.$author_post.'</a>' ); ?></span>
	<?php endif ; ?>
</span>