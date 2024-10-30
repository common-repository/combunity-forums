<div class="combunity-forum-post-title">
	<?php
		$htmltag = '';
		$htmltagend = '';	
		if ( is_single() ){
			$htmltag = '<h1>';
			$htmltagend = '</h1>';
		}
	?>
	<?php echo $htmltag ?>
		<?php if ( Combunity_Api()->is_sticky()) : ?>
			<i class="fa fa-thumb-tack" aria-hidden="true"></i>
		<?php endif; ?>

	
		<a href='<?php the_permalink() ?>' class='combunity-link'>
			<?php echo get_the_title() ?>
		</a>
	<?php echo $htmltagend ?>

	<?php
		// Begin loading tags for this post
	// $tag = Co_get_the_first_post_tag();
	$tag = null;
	$cats = Combunity_Api()->get_thread_categories( get_the_ID() );
	if( sizeof( $cats ) > 0 ){
		$tag = $cats[0];
	}
	
	if ( $tag ) :
			$tagcolor = '#' . Combunity_Api()->get_forum_meta( $tag , 'custom_color', 'FFFFFF' );;
			$taglink = get_term_link( $tag );
			// var_dump( $tag );
			$tagname = $tag->name;
			// var_dump( $posttags );
	?>
		<span class="pull-right "><span class="tag combunity-tag-color"><span class="combunity-widget-sub-color" style="background-color: <?php echo $tagcolor ?>"></span><span class="combunity-forum-post-tag-text"><a href="<?php echo $taglink ?>" class="combunity-link"><?php echo $tagname; ?></a></span></span></span>
	<?php endif; ?>
	
</div>