<style type="text/css" >
	.combunity-iframe{
		border:0;
		overflow:hidden;height:100%;width:100%
	}
	
</style>
<?php

// var_dump( $this-> );
$post_link = $this->_p->Pages->getlink('post-thread');
$paged = isset( $_GET['cpaged'] ) ? $_GET['cpaged'] : 1;
// $paged = 2;
// var_dump( $paged );
$args_query = array(
	'post_type' => 'cpost',
	'tax_query' => array(
		array(
			'taxonomy' => 'cforum',
			'field'    => 'term_id',
			'terms'    => array( $args['term_id'] ),
		),
	),
	'posts_per_page' => 20,
    'paged' => $paged
);
// -1 means its a front forum
if ( $args['term_id'] == -1 ){
	unset( $args_query['tax_query'] );
}
$the_query = new WP_Query( $args_query ); ?>
<div style="display:none" id="cforumphtml<?php the_ID() ?>" class="cforumphtml">
	<div class="container">
		<?php include_once('ipage/header.php') ?>
		<div class="row">
			<div class="col-xs-8">
				<?php
					$terms = get_terms( array(
					    'taxonomy' => 'cforum',
					    'hide_empty' => false,
					) );
					echo '<strong>' . __('Forums: ', 'combunity') . '</strong>';
					$all = '';
					foreach ($terms as $key => $term) {
						$all .= ' <a href="'.get_term_link( $term->term_id ).'">'. ucfirst( $term->name ) . '</a>,';
					}
					echo rtrim( $all, "," );

				?>
			</div>
			<div class="col-xs-4">
				<div class="pull-right">
					<a href="<?php echo $post_link ?>" class="combunity-login-required" noblank="true"><button class="btn btn-primary submit btn btn-primary post-btn "><?php echo __('Post', 'combunity') ?></button></a>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
	<?php if ( $the_query->have_posts() ) : ?>

		<!-- pagination here -->

		<!-- the loop -->
		<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			
				<?php include('cpost-single.php')	 ?>
			
		<?php endwhile; ?>
		<!-- end of the loop -->
		<br>
		<div class="pagination">
			<?php if ($the_query->max_num_pages > 1) { // check if the max number of pages is greater than 1  
				$next_link = add_query_arg('cpaged', $paged+1 );
				$prev_link = add_query_arg('cpaged', $paged-1 );
				if ( $paged < $the_query->max_num_pages ){
					$next = '<a href="'.$next_link.'" class="btn btn-primary submit btn btn-primary post-btn">Next</a>';
				}
				if ( $paged > 1 ){
					$prev = '<a href="'.$prev_link.'" class="btn btn-primary submit btn btn-primary post-btn">Previous</a>';
				}
				?>
				<div class="row">
					<div class="col-xs-3">
						<?php echo $prev ?>
					</div>
					<div class="col-xs-6">
					</div>
					<div class="col-xs-3">
						<?php echo $next ?>
					</div>
				</div>
			
 			 
			<?php } ?>
		</div>

	<?php wp_reset_postdata(); ?>

<?php else : ?>
	
<?php endif; ?>

<?php include('footer.php') ?>
	</div>
	<div class="container">
		<!-- pagination -->
	</div>
</div>
<div class="combunity-forums-plugin-stylesheet" style="display:none;"><?php include_once('styles/combunity-base-theme.css') ?></div>
	
<iframe src="javascript:''" id="cforump<?php the_ID() ?>" class="combunity-iframe combunity-cforump" 	frameborder="0" ></iframe>
