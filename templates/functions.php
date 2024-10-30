<?php
function Co_get_pagination_per_page(){
	return 10;
}

function Co_the_fp_meta( $key, $default ){
    return Combunity_Api()->the_fp_meta( $key, $default );
}

function Co_the_comment_voted_class( $asked ){
    $already_voted = Combunity_Api()->check_and_get_user_vote( get_comment_ID() );

    if ($already_voted != false){
        $current_class = "";
        $vote_type = $already_voted;
        if ($vote_type=="up"){
            // if ( $asked == $post_type ){
                $current_class =  " combunity-vote-$vote_type-highlight ";
            // }
        }else if ($vote_type=="down"){
            // if ( $asked == $post_type ){
                $current_class =  " combunity-vote-$vote_type-highlight ";
            // }
        }
        if ( $vote_type == $asked ){
            echo $current_class;
        }
    }
}

function Co_get_pagination_offset( $perpage = -1 ){
	$number = get_option( 'posts_per_page' );
	if ( $perpage == -1 ){
		$number = get_option( 'posts_per_page' );
	}else{
		$number = $perpage ;
	}
    
	$page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

    return 1 == $page ? ( $page - 1 ) : ( ( $page - 1 ) * $number );

}

function Co_render_pagination( $total_comments, $perpage = -1 ){
	$num = isset( $_GET['paged'] ) ? $_GET['paged'] : 1;
	if ( $perpage == -1 ){
		$number = get_option( 'posts_per_page' );
	}else{
		$number = $perpage ;
	}
	$prevlink = add_query_arg('paged', $num-1 );
	$nextlink = add_query_arg('paged', $num+1 );
	$next = ''; $prev='';
	$total_comments = $total_comments/$number;
	// var_dump( $total_comments );
	if ( ($num+1) <= $total_comments  ){
		$next = '<a href="'.$nextlink.'" class="btn btn-primary">'. __("Next", "combunity") .'</a>';
	}
	if ( ( $num - 1 ) != 0 ){
		$prev = '<a href="'.$prevlink.'" class="btn btn-primary">'. __("Previous", "combunity") .'</a>';
	}
	?>
	<br>
	<div>
		<div class="row">
			<div class="col-xs-4">
				<?php echo $prev ?>
			</div>
			<div class="col-xs-4">
			</div>
			<div class="col-xs-4">
				<?php echo $next ?>
			</div>
		</div>		
	</div>
	<br>
	<?php
}