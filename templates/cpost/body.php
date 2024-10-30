<!-- Post Body -->
<div class="post-body">
	<div>
		<?php echo apply_filters('combunity_cpost_body_pre', '' ) ?>
	</div>
	<div class="post-container">
		<?php 
	
			echo $args['content'];

		?>
	</div>
	<?php
		// Co_thread_body_after_content();
		$edit = Combunity_Api()->get_edit_thread_link( );	
		$delete = Combunity_Api()->get_delete_thread_link( );
		if ( strlen( $edit ) > 0 && strlen( $delete ) > 0 ) :
	?>
		<div class="combunity-thread-actions">
			<span>
			<?php
				echo $edit;
			?>
			</span>
			<span><?php
				echo $delete;
			?></span>		
		</div>
	<?php endif ?>
</div>
<?php
	include( Combunity_Api()->gettemplatedirpath() . 'comments.php');
?>