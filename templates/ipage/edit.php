<!DOCTYPE html>
<html>
<head>
	<title>Edit</title>
</head>
<body>
	<div class="container">
	<?php
		// The Query
		$id = 0;
		if ( isset($_GET['id'])){
			$id = $_GET['id'];
		}
		// $the_query = new WP_Query( array(
		// 	'post_type' => 'cpost',
		// 	'p' => $id
		// ) );
		// // The Loop
		// if ( $the_query->have_posts() ) {
		// 	while ( $the_query->have_posts() ) {
				include( $basedir . '/templates/cpost-single.php' );
				include( $basedir . '/templates/cpost/body.php' );
				do_action('combunity_print_scripts');
				do_action('combunity_print_styles');
				?>
				<script type="text/javascript">
					jQuery(document).ready(function(){
						jQuery(".combunity-edit-thread-link").click();
					})
				</script>
				<?php
		// 	}
		// 	// wp_reset_postdata();
		// }
	?>
	</div>
	
	<?php //do_action('combunity_print_scripts'); ?>

	<?php //do_action('combunity_print_styles'); ?>
</body>
</html>

