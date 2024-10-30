<!DOCTYPE html>
<html>
<head>
	<title><?php echo __('Post thread', 'combunity') ?></title>
</head>
<body>
	<div class="container combunity-post-thread">
		<div class="container">
			<div class="row">
				<h4><?php echo __('Create a new Thread') ?></h4>
				<div class="submissionform">
					
				</div>
			</div>
			<?php include( Combunity_Api()->gettemplatedirpath() . 'footer.php') ?>
		</div>
		
	</div>
	<?php // do_action( 'combunity_print_styles' ); ?>

	<?php do_action('combunity_print_scripts'); ?>

	<?php do_action('combunity_print_styles'); ?>

	<?php do_action('combunity_echo_scripts'); ?>
	<script type="text/javascript">
		jQuery(document).ready(function(){
			combunity.renderpostform();
			combunity.iframeheightadjuster();
		});
	</script>
</body>
</html>

