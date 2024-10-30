<?php
class Combunity_Ashes_Internal_Page_Handler {
	/**
	 * The parent constructor
	 */
	private $_p;

	/**
	 * An array containing all pages
	 */
	public $pages;

	/**
	 * GET argument
	 */
	public $getarg;

	/**
	 * Construct
	 */
	public function __construct( $parent ){
		$this->_p = &$parent;
		$this->getarg = 'combunityipage';
		$this->pages = array();
		$this->create_pages();
		$this->_p->loader->add_action( 'template_redirect',$this, 'render_page_if_needed' );
	}

	/**
	 * Runs on a template redirect and loads a page if required
	 */
	public function render_page_if_needed(){
		if ( isset( $_GET[ $this->getarg ] ) ){
			$name = $_GET[ $this->getarg ];
			if ( isset( $this->pages[ $name ] ) ){
				echo $this->pages[ $name ]->load();
				exit;
			}
		}
	}

	/**
	 * Create Combunity pages
	 */
	public function create_pages(  ){
		/**
		 * Edit post page
		 */
		$opts = array('name'=>'edit', 'type'=>'edit');
		$this->pages['edit'] = new Combunity_Ashes_Page( $this , $this->_p, $opts );
		/**
		 * View post page
		 */
		$opts = array('name'=>'view', 'type'=>'view');
		$this->pages['view'] = new Combunity_Ashes_Page( $this , $this->_p, $opts );		
		/**
		*	Notification page for displaying messages
		*/
		$opts = array('name'=>'notification', 'type'=>'notification');
		$this->pages['notification'] = new Combunity_Ashes_Page( $this , $this->_p, $opts );
		/**
		* 
		*/		
		$opts = array('name'=>'post-thread', 'type'=>'post-thread');
		$this->pages['post-thread'] = new Combunity_Ashes_Page( $this , $this->_p, $opts );
		/**
		 * 
		 */
		$opts = array('name'=>'login', 'type'=>'login');
		$this->pages['login'] = new Combunity_Ashes_Page( $this , $this->_p, $opts );	
		/**
		 * 
		 */
		$opts = array('name'=>'logout', 'type'=>'logout');
		$this->pages['logout'] = new Combunity_Ashes_Page( $this , $this->_p, $opts );
		/**
		 * 
		 */
		$opts = array('name'=>'user', 'type'=>'user');
		$this->pages['user'] = new Combunity_Ashes_Page( $this , $this->_p, $opts );		
	}

	public function getlink( $name ){
		if ( isset( $this->pages[ $name ] ) ){
			if ( $this->_p->notheme() ){
				return $this->pages[ $name ]->getlink();
			}else{
				return '#';
			}
		}else{
			throw new Exception("Page does not exist");
		}
	}

}

class Combunity_Ashes_Page{
	/**
	 * The parent
	 */
	private $_p;

	/**
	 * The current page
	 */
	private $page;
	/**
	 * Construct new page
	 */
	public function __construct( $parent, $grandparent, $opts = array() ){
		$this->_p = &$parent;
		$this->__p = &$grandparent;
		$this->page = array();
		$this->page['opts'] = $opts;
	}	

	/**
	 * Return link
	 */
	public function getlink(){
		$id = get_the_ID();
		$link = add_query_arg( $this->_p->getarg, $this->page[ 'opts' ][ 'name' ] , site_url() );
		$link = add_query_arg( 'id', $id , $link );
		return $link;
	}

	/**
	 * Load actual page and return a string for it
	 * @return string of content
	 */
	public function load(){
		
		
		$base = $this->__p->basedir . '/templates/ipage/';
		$basedir = $this->__p->basedir ;
		ob_start();
		include( $base . $this->page[ 'opts' ][ 'name' ] . '.php' );
		return ob_get_clean();
	}
}