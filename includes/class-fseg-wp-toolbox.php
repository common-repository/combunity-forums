<?php
class Fifthsegment_WP_Toolbox{
	/**
	 * 
	 */
	public function __construct(){

	}

	/**
	 * Actually create a WP page
	 */
	public function create_pages_fly($pageName, $content, $post_type = 'page') {
        $createPage = array(
          'post_title'    => $pageName,
          'post_content'  => $content,
          'post_status'   => 'publish',
          'post_author'   => 1,
          'post_type'     => $post_type,
          'post_name'     => $pageName
        );

        // Insert the post into the database
        wp_insert_post( $createPage );
    } 

	/**
	 * Creates a WordPress page, returns if page exists
	 */
	public function create_page( $args ){

		$defaults = array( 'title', 'content' );

		$opts = array_merge( $defaults, $args );

		if( get_page_by_title( $opts['title'] ) == NULL ){

    		$this->create_pages_fly( $opts['title'], $opts['content'] );	

		}

		$page = get_page_by_title( $opts['title'] );

		if ( $page ){

			return $page->ID;

		}
	}

	/**
	 * 
	 */
	public function create_post( $args ){

		$defaults = array('title', 'content', 'post_type');

		$opts = array_merge( $defaults, $args );

		$the_query = new WP_Query( array( 's' => $opts['search' ], 'post_type' => $opts['post_type']) );

		if ( $the_query->found_posts > 0 ){

			$id = null;

			if ( $the_query->have_posts() ) {
				
				while ( $the_query->have_posts() ) {

					$the_query->the_post();

					$id = get_the_ID();

				}

				/* Restore original Post Data */
				wp_reset_postdata();
			}

			return $id; 
			
		}

		$this->create_pages_fly( $opts['title'], $opts['content'], $opts['post_type'] );	

		$the_query = new WP_Query( array( 's' => $opts['search' ], 'post_type' => $opts['post_type']) );

		if ( $the_query->found_posts > 0 ){

			$id = null;

			if ( $the_query->have_posts() ) {
				
				while ( $the_query->have_posts() ) {

					$the_query->the_post();

					$id = get_the_ID();

				}

				wp_reset_postdata();
			}

			return $id; 
			
		}

	}
}