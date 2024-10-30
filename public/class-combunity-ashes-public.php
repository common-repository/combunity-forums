<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Combunity_Ashes
 * @subpackage Combunity_Ashes/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Combunity_Ashes
 * @subpackage Combunity_Ashes/public
 * @author     Your Name <email@example.com>
 */
class Combunity_Ashes_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $Combunity_Ashes    The ID of this plugin.
	 */
	private $Combunity_Ashes;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Container of script urls
	 */
	private $scripts;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $Combunity_Ashes       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $Combunity_Ashes, $version, $parent ) {

		$this->Combunity_Ashes = $Combunity_Ashes;
		$this->version = $version;
		$this->_p = $parent;
		$this->scripts = array();

		add_action( 'admin_bar_menu', array($this, 'toolbar_link_to_mypage'), 999 );

		add_action( 'template_redirect', array($this, 'hook_query_based_frontend_pages') );

		add_filter( 'combunity_meta_description', array( $this, 'load_meta_description' ) );

		add_action( 'combunity_print_scripts', array( $this, 'combunity_print_scripts') );

		add_action( 'combunity_print_styles', array( $this, 'combunity_print_styles') );

		add_filter( 'combunity_get_scripts', array( $this, 'combunity_get_scripts' ) );

		add_action( 'wp_footer', array( $this, 'combunity_footer_scripts' ) );

	}

	/**
	 * Combunity load footer scripts
	 */
	public function combunity_footer_scripts(){
		do_action( 'combunity_echo_scripts' );
	}

	/**
	 * Loads meta for SEO
	 */
	public function load_meta_description(){
		if ( is_front_page() ){
			return get_bloginfo('description');
		}
		if ( is_single() ){
			$post = get_post();
			return wp_trim_words( $post->post_content, 100 );
		}
		if ( is_archive() ){
			return wp_trim_words( term_description(), 100 );
		}	

	}

	/**
	 * For User picker
	 */
	public function hook_query_based_frontend_pages(){
		if ( isset($_GET['combunity_custom'] ) ){
			if ( isset($_GET['editor']) ){
				$editor = $_GET['editor'];
				if( $editor == 'frontend' ){
					if ( isset($_GET['type']) && $_GET['type'] == 'userpicker') {
						if ( isset($_GET['json']) ) {
							$q = sanitize_text_field( $_GET['q'] );
							$q = preg_replace("/[^a-zA-Z0-9]+/", "", $q);

							$q = strtolower( $q ) . "*";
							if ( $q == "*" )
								// return;
								exit;
							if ( strlen($q) >1 && $q[1] == "*")
								exit;
							$args = array(
								'search'         => $q,
								'search_columns' => array( 'user_login', 'user_nicename' )
							);
							$user_query = new WP_User_Query( $args );
							$data = array();
							$urls = array();
							if ( ! empty( $user_query->results ) ) {
								foreach ( $user_query->results as $user ) {
									// $data[  ] = get_author_posts_url($user->ID );
									$data[] = $user->user_login;
									$urls[] = get_author_posts_url($user->ID );
								}
							} 

							
							// $x = $data;
							// $x[] = $data;
							echo json_encode( array( 'urls' => $urls, 'data' => $data ) );
							exit;
						}
						get_template_part('custom_views/userpicker','');
						exit;
					}
				}
			}else if ( isset( $_GET['view'] ) ){
				$name = isset( $_GET['name'] ) ? $_GET['name']: '';
				$id = $_GET['id'];
				
				// var_dump( $this->Combunity_Ashes );
				switch ( $name ) {
					case 'cpost':
						$args = array(
							'p' => $id, // id of a page, post, or custom type
							'post_type' => 'cpost'
						);
						$the_query = new WP_Query( $args );
						if ( $the_query->have_posts() ) {
							while ( $the_query->have_posts() ) {
								$the_query->the_post();
								echo $this->_p->Frontend->build_cpost( array() );
							}
							wp_reset_postdata();
						}
						break;
					default:
						# code...
						break;
				}
				exit;

			}
		}
	}

	public function toolbar_link_to_mypage( $wp_admin_bar ) {
		$args = array(
			'parent' => 'user-actions',
			'id'    => 'my-profile-page',
			'title' => __('My Profile'),
			'href'  => get_author_posts_url( get_current_user_id() ),
			'meta'  => array( 'class' => 'my-toolbar-page' )
		);
		$wp_admin_bar->add_node( $args );
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Combunity_Ashes_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Combunity_Ashes_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// wp_enqueue_style( $this->Combunity_Ashes, plugin_dir_url( __FILE__ ) . 'css/combunity-ashes-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Print Combunity's styles
	 *
	 * @since 1.1.0
	 */
	public function combunity_print_styles(){
		$views = array('view', 'post-thread', 'login', 'logout', 'user');
		if ( isset($_GET['combunityipage']) &&  in_array( $_GET['combunityipage'] , $views ) ){
		?>
		<style>
			<?php include( $this->_p->basedir . '/templates/styles/combunity-base-theme.css' )  ?>
		</style>
		<?php
		}
	}

	/**
	 * Print Combunity's scripts
	 *
	 * @since 1.1.0
	 */
	public function combunity_print_scripts(){
		$this->combunity_load_scripts();
		?>
		<script type='text/javascript'>
		/* <![CDATA[ */
		var combunity = {
			<?php
				$json = $this->scripts['json'];
				$text = '';
				foreach ($json as $key => $value) {
					$text .= '"' . $key . '" : "' . $value . '",';
				}
				echo rtrim( $text , ',' );
			?>
		}
		/* ]]> */
		</script>
		<?php
		foreach ($this->scripts as $key => $value) {
			if ( $key == 'json' )
				continue;
			?>
			<script src="<?php echo $value ?>"></script>
			<?php
		}
	}

	/**
	 * Get Combunity's scripts
	 */
	public function combunity_get_scripts(){
		$this->combunity_load_scripts();
		return $this->scripts;
	}

	/**
	 * Load Combunity's scripts
	 *
	 * @since 1.1.0
	 */
	public function combunity_load_scripts(){
		$this->scripts['jquery'] = 'http://code.jquery.com/jquery-1.12.4.min.js';


		// wp_enqueue_script( $this->Combunity_Ashes. '-ckeditor', plugin_dir_url( __FILE__ ) .'js/ckeditor/ckeditor.js', array(  'jquery'), $this->version, false );
		// $this->scripts[$this->Combunity_Ashes. '-ckeditor'] = plugin_dir_url( __FILE__ ) .'js/ckeditor/ckeditor.js';



		// wp_enqueue_script( $this->Combunity_Ashes. '-ckeditor-adapter', plugin_dir_url( __FILE__ ) .'js/ckeditor/adapters/jquery.js', array( $this->Combunity_Ashes. '-ckeditor' ), $this->version, false );
		// $this->scripts[$this->Combunity_Ashes. '-ckeditor-adapter'] = plugin_dir_url( __FILE__ ) .'js/ckeditor/adapters/jquery.js';



		wp_enqueue_script( $this->Combunity_Ashes. '-tinymce45', plugin_dir_url( __FILE__ ) . 'js/tinymce/tinymce.min.js', array(), $this->version, false );
		$this->scripts[$this->Combunity_Ashes. '-tinymce45'] = plugin_dir_url( __FILE__ ) .'js/tinymce/tinymce.min.js';


		// wp_enqueue_script( $this->Combunity_Ashes. '-eqcss', plugin_dir_url( __FILE__ ) . 'js/EQCSS.min.js', array(), $this->version, false );
		// $this->scripts[$this->Combunity_Ashes. '-eqcss'] = plugin_dir_url( __FILE__ ) .'js/EQCSS.min.js';


		$this->scripts['combunity-reply-min-js'] = site_url('wp-includes/js/comment-reply.min.js');



		// wp_enqueue_script( $this->Combunity_Ashes, plugin_dir_url( __FILE__ ) . 'js/combunity-ashes-public.min.js', array( 'jquery' ), $this->version, false );
		// $this->scripts[$this->Combunity_Ashes] = plugin_dir_url( __FILE__ ) .'js/combunity-ashes-public.min.js';



		// wp_enqueue_script( $this->Combunity_Ashes . '-tinymce-jquery', plugin_dir_url( __FILE__ ) . 'js/tinymce45/jquery.tinymce.min.js', array( 'jquery' ), $this->version, false );
		// $this->scripts[$this->Combunity_Ashes. '-tinymce-jquery'] = plugin_dir_url( __FILE__ ) . 'js/tinymce45/jquery.tinymce.min.js';



		$logged_in  = "1";
		if ( !is_user_logged_in() ){
			$logged_in = "0";
		}
		

		$opts = array( 
    		'ajax_url' => admin_url( 'admin-ajax.php' ),
    		'login_form_back_to_social_login' => __('Back to social login'),
    		'login_form_use_email_address' => __('Or Click here to use your email address'),
    		'logged_in' => $logged_in,
    		'jquery_url' => 'https://code.jquery.com/jquery-1.12.4.min.js',
    		'script_url' => plugin_dir_url( __FILE__ ) . 'js/combunity-ashes-public.min.js',
    		'iframe_url' => plugin_dir_url( __FILE__ ) . 'js/combunity-ashes-iframe.js',
    		'tinymce_url' => plugin_dir_url( __FILE__ ) . 'js/tinymce/tinymce.min.js',
    		'login_required_text' => __('You need to be logged in to do that.', 'combunity-forums'),
    		'nothememode' => $this->_p->notheme()
       	);

		if ( get_option('combunity_adminpage_entrance', false ) ){
			$entrance = get_page_link( get_post( get_option('combunity_adminpage_entrance', false ) ) );
			$opts['entrance_url'] = $entrance;
		}

		wp_localize_script( $this->Combunity_Ashes, 
			"combunity",
        	$opts	 
        );
		add_action('combunity_echo_scripts', function( $opts ) use ( $opts ){
			$this->xor++;
			if ( $this->xor > 1 )
				return;
	    ?>	
	    	<script>
	    		var combunity = <?php echo json_encode( $opts ); ?>
	    	</script>
	        <script id="combunity-ashes-public">
	        	<?php
	        	// if ( $this->_p->notheme() ):
	        		echo file_get_contents(plugin_dir_path( __FILE__ ) . 'js/combunity-ashes-public.min.js');
	        	// endif;
	        	?>
	        </script>
	        
	    <?php
		});

		do_action( 'combunity_print_styles' );

		$this->scripts['json'] = $opts;
	}


	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Combunity_Ashes_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Combunity_Ashes_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// wp_enqueue_script( $this->Combunity_Ashes, plugin_dir_url( __FILE__ ) . 'js/tinymce-dev/tinymce.dev.js', array( 'jquery' ), $this->version, false );

		$this->combunity_load_scripts();

		

		// wp_enqueue_script( $this->Combunity_Ashes . '-iframe', plugin_dir_url( __FILE__ ) . 'js/combunity-ashes-iframe.js', array( 'jquery' ), $this->version, false );
  		// wp_enqueue_script('tinymce-combunity');  		
	}

}
