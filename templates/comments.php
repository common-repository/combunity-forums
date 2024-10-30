<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
 
/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() )
    return;

function Co_comment_template(){

    include( 'cpost/comment-single.php' );
}
?>
 
<div id="comments" class="comments-area">
         <ul class="comment-list">
            <?php
                $comments = get_comments(array(
                    'post_id' => get_the_ID(),
                    // 'status' => 'approve' //Change this to the type of comments to be displayed
                ));
                wp_list_comments( array(
                    'style'       => 'ul',
                    'short_ping'  => true,
                    'avatar_size' => 74,
                    'callback'    => 'Co_comment_template',
                ), $comments );
            ?>
        </ul><!-- .comment-list -->
    <?php if ( have_comments() ) : ?>
        <p class="comments-title">
            <?php
                printf( _nx( __('One reply'), __('%1$s replies'), get_comments_number(), 'comments title', 'combunity' ),
                    number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
            ?>
        </p>
 
        <ul class="comment-list">
            <?php
                $comments = get_comments(array(
                    'post_id' => get_the_ID(),
                    // 'status' => 'approve' //Change this to the type of comments to be displayed
                ));

                var_dump( $comments );
                wp_list_comments( array(
                    'style'       => 'ul',
                    'short_ping'  => true,
                    'avatar_size' => 74,
                    'callback'    => 'Co_comment_template',
                ), $comments );
            ?>
        </ul><!-- .comment-list -->
 
        <?php
            // Are there comments to navigate through?
            if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
        ?>
        <nav class="navigation comment-navigation combunity-pagination" role="navigation">
            <?php
                ob_start();
                previous_comments_link( __( '&larr; Previous', 'combunity' ) );
                $previous = ob_get_clean();

                ob_start();
                next_comments_link( __( 'Next &rarr;', 'combunity' ) );
                $next = ob_get_clean(); 
            ?>
            <?php if ( strlen( $previous ) > 0 ) : ?>
            <span class="nav-previous page-numbers"><?php echo $previous ?></span>
            <?php endif; ?>
            <?php if ( strlen( $next ) > 0 ) : ?>
            <span class="nav-next page-numbers"><?php echo $next ?></span>
            <?php endif; ?>
        </nav><!-- .comment-navigation -->
        <?php endif; // Check for comment navigation ?>
 
        <?php if ( ! comments_open() && get_comments_number() ) : ?>
        <p class="no-comments"><?php _e( 'Comments are closed.' , 'twentythirteen' ); ?></p>
        <?php endif; ?>
 
    <?php endif; // have_comments() ?>
    
    <?php 

        comment_form(array(
            'title_reply' => __('Write a reply'),
            'label_submit' => __('Post Reply'),
            'class_submit' => 'submit btn btn-primary ',
            'fields' => array(),
            'comment_notes_before'  => '',
            'class_form' => 'comment-form combunity-comment-form combunity-login-required'
        )); 

    ?>
 
</div><!-- #comments -->
<?php

include('footer.php');

?>