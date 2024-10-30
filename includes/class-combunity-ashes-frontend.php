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
class Combunity_Ashes_Frontend {
	/**
	 * The parent class instance.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $_p    The parent class instance.
	 */
	protected $_p;


	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public function __construct( $parent ){
		$this->_p = &$parent;


		// add_filter( 'template_include', 'my_callback' );
	}

	/**
	 * Build a template for cpost
	 *
	 * @return string
	 */
	public function build_cpost( $args ){
		$this->template_path = $this->_p->basedir . '/templates/';
		$T = $this->template_path;
		ob_start();
		include_once( $T . 'cpost.php' );
		$content = ob_get_clean();
		return $content;
		return '';
	}

	/**
	 * Build a template for cforum
	 *
	 * @return string
	 */
	public function build_cforum( $args ){
		$this->template_path = $this->_p->basedir . '/templates/';
		$T = $this->template_path;
		ob_start();
		include_once( $T . 'cforum.php' );
		$content = ob_get_clean();
		return $content;
		return '';
	}	

	/**
	 * Change template for our iframes
	 */
	// public 	function my_callback( $original_template ) {
	// 	if ( some_condition() ) {
	// 		return SOME_PATH . '/some-custom-file.php';
	// 	} else {
	// 		return $original_template;
	// 	}
	// } 
}
