<?php
class wcComboSales{
  private $pluginInfo;
	
	public function __construct(){
		if( $this->check_dependencies() ){
			$this->register_autoload();
			$this->load_classes();
	
			$this->add_hooks();
		}
	}

	public function locate_template( $args ){
		$plugin_path  = WC_COMBO_SALES_APP_PATH . 'views' . DIRECTORY_SEPARATOR;
		$template_name = ( is_string( $args ) ) ? $args : $args['template'];
		$template_name = "$template_name.php";
		$template = locate_template( array(
			'wc-combo-sales' . DIRECTORY_SEPARATOR . $template_name,
		) );
		$template = ( $template ) ? $template : $plugin_path . $template_name;
		return $template;
	}

	public function fetch_template_part( $args ){
		ob_start();
    $this->get_template_part( $args );
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
	}

	public function get_template_part( $args ){
		if( is_array( $args ) && isset( $args['locals'] ) && is_array( $args['locals'] ) ){
			$locals = $args['locals'];
			extract($locals);
		}
		include $this->locate_template( $args );
	}
  
  public function camel2dashed( $class_name ) {
    return strtolower( preg_replace( '/([a-zA-Z])(?=[A-Z])/', '$1-', $class_name ) );
	}
	
	public function check_dependencies(){
		if( ! class_exists( 'acf' ) ) {
			add_action('admin_notices', function(){ ?>
				<div class="notice notice-error">
					<p><?php _e('WC Product Stamps depends on Advanced Custom Fields PRO, please activate it.', 'wc-combo-sales'); ?></p>
				</div>
			<?php });
			return false;
		}
		return true;
	}

	public function register_autoload(){
    spl_autoload_register(function ($class_name) {
      if( strpos( $class_name, 'wcComboSales') === 0 ){
				$classPath = WC_COMBO_SALES_APP_PATH;
				if( strpos( $class_name, 'wcComboSales\config') === 0 ){
					$classPath = WC_COMBO_SALES_DIR_PATH;
				}
        $class_name = str_replace( '\\', DIRECTORY_SEPARATOR, $class_name );
				$class_name = str_replace( 'wcComboSales' . DIRECTORY_SEPARATOR, $classPath, $class_name );
        $path = dirname( $class_name );
				$filename = $this->camel2dashed( basename( $class_name ) ) . '.class.php';
        include $path . DIRECTORY_SEPARATOR . $filename;
      }
    });
  }
  
  public function load_classes(){
		$this->setting = new wcComboSales\model\setting;
		$this->settings = new wcComboSales\controller\settings;
		
    $this->combo = new wcComboSales\model\combo;

    $this->combos = new wcComboSales\controller\combos;
  }

  public function add_hooks(){
		add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain') );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts'), 999 );
		// add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts'), 999 );
  }
  
  public function enqueue_scripts(){
		$file = '/css/frontend.css';
		wp_enqueue_style( 'wc-combo-sales-style', WC_COMBO_SALES_ASSETS_URL . $file, array(), filemtime( WC_COMBO_SALES_ASSETS_PATH . $file ), 'all' );

    // wp_enqueue_script( 'wc-combo-sales-script', WC_COMBO_SALES_ASSETS_URL . '/js/frontend.js', array('jquery'), '0.0.1', true );
    // wp_localize_script( 'wc-combo-sales-script', 'WC_COMBO_SALES', [ 'ajax_url' => admin_url( 'admin-ajax.php' ) ] );
	}

	public function admin_enqueue_scripts(){
		// wp_enqueue_style( 'wc-combo-sales-style', WC_COMBO_SALES_ASSETS_URL . '/css/backend.css', array(), '0.1', 'all' );

		// wp_enqueue_script( 'wc-combo-sales-script', WC_COMBO_SALES_ASSETS_URL . '/js/backend.js', array('jquery'), '0.1', true );
	}
  
	public function load_plugin_textdomain(){
		load_plugin_textdomain( 'wc-combo-sales', false, basename( dirname( WC_COMBO_SALES_PLUGIN_FILE ) ) . '/languages' ); 
	}
	
	public function getModule( $module ){
		if( property_exists( $this, $module ) ){
			return $this->$module;
		}
	}
	
	public function getPluginInfo( $info = '' ){
		if( !$this->pluginInfo ){
			$this->pluginInfo = get_plugin_data( WC_COMBO_SALES_DIR_PATH . 'wc-combo-sales.php' );
		}
		if( $info ){
			return $this->pluginInfo[$info];
		}
		return $this->pluginInfo;
	}
	public function getVersion(){
		return $this->getPluginInfo( 'Version' );
	}
}