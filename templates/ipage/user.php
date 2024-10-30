<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
	include_once( Combunity_Api()->gettemplatedirpath() . 'functions.php' );
	$uid = $_GET['uid'];
	$user = get_user_by('ID', $uid);
	include_once('header.php') ;
?>
<div class="container">
<div class="container main-container author-page">
	<div class="row">
		<div class="col-xs-1">
		</div>
		<div class="col-xs-10">
			<div class="row">
				<?php do_action('combunity_theme_frontpage_pre_content')   ?>
				<div class="">
					<div class="combunity-box-simple">
						
					
					<?php

					include(  Combunity_Api()->gettemplatedirpath() . 'author/pagetitle.php' );

					$curauth = $user;

					if ( !isset( $_GET['combunity_user_comments'] ) ):

						$perpage = Co_get_pagination_per_page();

						$args = array( 
							'author' => $curauth->ID, 
							'posts_per_page' => $perpage,
							'post_type' => 'cpost',
							'offset' => Co_get_pagination_offset( $perpage ), 
							'paged' => get_query_var( 'page' ) ? get_query_var( 'page' ) : 1,
	 					);

						$the_query = new WP_Query( $args );

						if ( $the_query->have_posts() ) :

							/* Start the Loop */
							while ( $the_query->have_posts() ) : $the_query->the_post();

								// get_template_part( 'template-parts/cpost', get_post_format() );

								include( Combunity_Api()->gettemplatedirpath() . 'cpost-single.php');


							endwhile;

							$pagination_args = array();

							?>

							<?php  
								// $paginated = paginate_links( $args );

								// if (  strlen( $paginated ) > 0 ) : 

							 ?>
								<div class="combunity-pagination">

									<?php Co_render_pagination( $the_query->found_posts, $perpage ) ?>

								</div>	
							

							<?php

							wp_reset_postdata();

						else :

							//get_template_part( 'template-parts/empty', 'user' );

						endif; 

					endif;

					if ( isset( $_GET['combunity_user_comments'] ) ):

						?>

						<ul class="comment-list" style="overflow:auto;">
						
						<?php

						$total_comments = get_comments( 
							array(
								"count" => true, 
								'user_id' => $curauth->ID
								) 
						);
						// print "<h1>Total Comments</h1>";
						// var_dump( $comments_per_page );
						// var_dump( $total_comments );
						// $total_comments = intval(ceil($total_comments/$comments_per_page));
						// $total_comments = 
						// $this->total_user_comments = $total_comments;
						$comments_per_page = Co_get_pagination_per_page();
						$comment_args = array(
							'number' => $comments_per_page,
							// 'offset' => $commentoffset,
							'orderby' => 'comment_date',
							'order' => 'DESC',
							'user_id' => $curauth->ID,
							'count' => false,
							'post_type' => 'cpost',
							'offset' => Co_get_pagination_offset( $comments_per_page )
						);

						$user_comments = get_comments( $comment_args );

						foreach ($user_comments as $comment ) {
							# code...
							$GLOBALS['comment'] = $comment;

							include( Combunity_Api()->gettemplatedirpath() . 'cpost/comment-single.php');

							$GLOBALS['comment'] = null;

						}

						?>

						</ul>

						<?php
						Co_render_pagination( $total_comments, $comments_per_page );
						// var_dump(sizeof($user_comments));
						// $this->current_user_comments = $user_comments;

					endif;




					?>
					</div>
				</div>
				
			</div>
		</div>
		<div class="col-xs-1">
		</div>
	</div>
</div>
</div>

	<?php //do_action( 'combunity_print_styles' ); ?>

	<?php do_action('combunity_print_scripts'); ?>

	<?php do_action('combunity_print_styles'); ?>

	<?php do_action('combunity_echo_scripts'); ?>
</body>
</html>

