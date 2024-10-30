<?php

/**
 * Fired during plugin activation
 *
 * @link       http://combunity.com
 * @since      1.0.0
 *
 * @package    Combunity_Ashes
 * @subpackage Combunity_Ashes/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run the Forums on Combunity.
 *
 * @since      1.0.0
 * @package    Combunity_Ashes
 * @subpackage Combunity_Ashes/includes
 * @author     Abdullah <abdullah@combunity.com>
 */
class Combunity_Ashes_Forums {
	/**
	 * The parent class instance.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      class    $_p    The parent class instance.
	 */
	protected $_p;

	/**
	 * The wp post type of forums.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $_wp_post_type    The post type of forums.
	 */
	protected $_wp_post_type = "cforum";

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */

	public function __construct( $parent ){

		$this->_p = &$parent;
		$this->_p->loader->add_shortcode( "testShortcode", $this , "shortcode_function", 10,2 );
		$this->_p->loader->add_action( 'init', $this, 'register_taxonomy' );
		$this->_p->loader->add_action( 'init', $this, 'register_post_type' );
		$this->_p->loader->add_action( 'create_term', $this, 'create_cforum_page_after_term', 10, 3);
		$this->_p->loader->add_action( 'cforum_add_form_fields', $this,  'taxonomy_add_form_field', 10, 2 );
		$this->_p->loader->add_action( 'cforum_edit_form_fields', $this,  'taxonomy_edit_form_field', 10, 2 );
		$this->_p->loader->add_shortcode( 'combunitycforump', $this, 'render_shortcode_cforump', 10, 2 );
		$this->_p->loader->add_action( 'edited_cforum',$this, 'save_taxonomy_custom_meta', 10, 2 );  
		$this->_p->loader->add_action( 'create_cforum',$this, 'save_taxonomy_custom_meta', 10, 2 );
		$this->_p->loader->add_filter( 'manage_edit-cforum_columns' , $this, 'manage_cforum_custom_column' );

		$this->_p->loader->add_action( 'pre_get_posts', $this, 'alter_wp_query_for_forum_page' );
		$this->_p->loader->add_filter( 'term_link', $this, 'modify_category_link', 10, 3 );
	}

	public function render_shortcode_cforump( $atts, $content ){
		return $this->_p->Frontend->build_cforum( $atts );
	}



	/**
	 * Change category link if notheme mode is on
	 */
	public function modify_category_link( $url, $term, $taxonomy  ){
		if ( $taxonomy == "cforum" ){
			if ( !$this->_p->notheme() ){
				return $link;
			}else{
				return str_replace('cforum', 'cforump', $url);
			}			
		}else{
			return $link;
		}

		
	}

	/**
	 * Create fake page after term is created
	 */
	public function create_cforum_page_after_term( $term_id, $tt_id, $taxonomy ){
		if ( $taxonomy != 'cforum' )
			return;
		$term = get_term( $term_id, $taxonomy );

		$slug = $term->slug;

		$name = $term->name;

		$desc = $term->description;

		wp_insert_post( 
			array(
				'post_title' => $slug,
				'post_content' => '[combunitycforump slug="'.$slug.'" term_id="'.$term_id.'"]',
				'post_type' => 'cforump',
				'post_status' => 'publish'
			) 
		);
	}

	/**
	 * Register post type for the forum page
	 */
	public function register_post_type( ){
		$args = array(
			'show_ui' => false,
			'public' => true,
			'labels' => array(
				'name' => 'CForumP',
				'singular_name' => 'CForumP',
				'add_new_item' => 'Add new CForumP',
				'menu_name' => __('Combunity'),
				'all_items' => __('CForumP')
			),
			'map_meta_cap' => true,
			'supports' => array('title', 'editor' )
		);
		register_post_type( 'cforump', $args );
	}
	/**
	 * Register taxonomy so that they can be used as forums
	 * of Combunity.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	public function register_taxonomy(){
		$taxonomy = "cforum";
		$object_type = "cpost";
		$args = array(
			'labels' => array(
				'name' => __('Forums'),
				'singular_name' => __('Forum'),
				'add_new_item' => __('Add new Forum'),
				'edit_item' => __('Edit Forum'),
			),
			'show_admin_column' => true,
			'show_in_quick_edit' => true,
		);
		register_taxonomy( $taxonomy, $object_type, $args ); 
	}

	/**
	 * Modify column of the taxonomy page for forums
	 * .
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function manage_cforum_custom_column( $columns ){
		$columns['posts'] = __('Threads');
		return $columns;
	}

	/**
	 * Add custom fields to taxonomies to allow things such as forum rules
	 * .
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function taxonomy_add_form_field(){
		?>
		<div class="form-field">
			<label for="term_meta[custom_color]"><?php _e( 'Color' ); ?></label>
			<input type="text" name="term_meta[custom_color]" id="term_meta[custom_color]" class="jscolor">
			<p class="description"><?php _e( 'Choose a tag color for this forum' ); ?></p>
		</div>
		<?php
	}


	/**
	 * Add Edit custom fields to taxonomies to allow things such as forum rules
	 * .
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function taxonomy_edit_form_field($term) {
		// put the term ID into a variable
		$t_id = $term->term_id;
	 
		// retrieve the existing value(s) for this meta field. This returns an array
		$term_meta = get_option( "taxonomy_$t_id" ); ?>
		<tr class="form-field">
		<th scope="row" valign="top"><label for="term_meta[custom_color]"><?php _e( 'Forum Color' ); ?></label></th>
			<td>
				<input class="jscolor" type="text" name="term_meta[custom_color]" id="term_meta[custom_rules]" value="<?php echo esc_attr( $term_meta['custom_color'] ) ? esc_attr( $term_meta['custom_color'] ) : ''; ?>">
				<p class="description"><?php _e( 'Forum Color' ); ?></p>
			</td>
		</tr>
	<?php
	}

	/**
	 * Add Edit custom fields to taxonomies to allow things such as forum rules
	 * .
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function save_taxonomy_custom_meta( $term_id ){
		if ( isset( $_POST['term_meta'] ) ) {
			$t_id = $term_id;
			$term_meta = get_option( "taxonomy_$t_id" );
			$cat_keys = array_keys( $_POST['term_meta'] );
			foreach ( $cat_keys as $key ) {
				$key = sanitize_key( $key );
				if ( isset ( $_POST['term_meta'][$key] ) ) {
					$term_meta[$key] = sanitize_text_field( $_POST['term_meta'][$key] );
				}
			}
			// Save the option array.
			update_option( "taxonomy_$t_id", $term_meta );
		}
	}

	/**
	 * Modifies the WP Query for the archive page in case a special sort is selected
	 * .
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function alter_wp_query_for_forum_page( $query ){

		if ( !is_admin() ){
			if ( !$query->is_main_query() ) {
				return;
			}
			if ( is_home() ){
				$query->set('post_type', 'cpost');
			}
			if ( $query->is_posts_page ){
				$query->set('post_type', 'post');
			}	

			$cforum = get_query_var( 'cforum', null );
			$csort = isset($_REQUEST['csort'])? $_REQUEST['csort']:null;
			if ( !$cforum ){
				return;
			}
			if ( is_archive()  ){
				$query->set('post_type', 'cpost');
			}
			if ( !$csort ){
				return;
			}
			// print '<h1>I was used!</h1>';
			switch ($csort) {
				case 'popular':
					$query->set('orderby', 'meta_value_num');
					$query->set('meta_key', 'combunity_post_views');
					$query->set('order', 'DESC');
					break;
				case 'lastreply':
					$query->set('orderby', 'meta_value_num');
					$query->set('meta_key', 'combunity_comment_time');
					$query->set('order', 'DESC');
					break;						
				
				default:
					# code...
					break;
			}


				// For recent
				// $query->set('order', 'DESC');
			// }
		}

	}


	public function shortcode_function(){
        return 'Test the plugin';
    }

}