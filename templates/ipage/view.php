<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<div class="container">
		<?php include_once('header.php') ?>
	<?php
		// The Query
		$id = 0;
		if ( isset($_GET['id'])){
			$id = $_GET['id'];
		}
		wp_reset_postdata();
		global $post;
		$originalpost = $post;
		$post = get_post( $id );
		$the_query = new WP_Query( array(
			'post_type' => 'cpost',
			'p' => $id
		) );


		// // The Loop
		if ( $the_query->have_posts() ) {
			$i = 0;
			while ( $the_query->have_posts() ) {
				ob_start();
				the_content();
				$content = ob_get_clean();
				$args['content'] = $content ;
				include( $basedir . '/templates/cpost-single.php' );
				include( $basedir . '/templates/cpost/body.php' );

				do_action('combunity_print_scripts');
				do_action('combunity_print_styles');
				do_action('combunity_echo_scripts');
				
				$i++;
				if ( $i > 0 )
					break;
			}
			wp_reset_postdata();
		}
		$post = $originalpost;
	?>
	</div>
	
	<?php //do_action('combunity_print_scripts'); ?>

	<?php //do_action('combunity_print_styles'); ?>
</body>
</html>

