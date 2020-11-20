<?php
/*
Plugin Name: WooCommerce Combo Sales
Plugin URI: 
Description: WooCommerce Combo Sales
Version: 0.0.2
Author: Jony Hayama
Author URI: https://jony.dev
*/

define( 'WC_COMBO_SALES_PLUGIN_FILE', __FILE__ );
define( 'WC_COMBO_SALES_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'WC_COMBO_SALES_PLUGIN_URL', plugins_url('', __FILE__ ) );
define( 'WC_COMBO_SALES_ASSETS_URL', WC_COMBO_SALES_PLUGIN_URL . '/app/assets' );
define( 'WC_COMBO_SALES_APP_PATH', WC_COMBO_SALES_DIR_PATH . 'app' . DIRECTORY_SEPARATOR );

require_once( WC_COMBO_SALES_APP_PATH . 'application.class.php' );

function wc_combo_sales( $module = '' ){
	static $_wcComboSales_obj = null;
	if( !$_wcComboSales_obj ){
		$_wcComboSales_obj = new wcComboSales();
	} 
	if( $module ){
		return $_wcComboSales_obj->getModule( $module );
	}
	return $_wcComboSales_obj;
}
wc_combo_sales();


require 'lib/plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/jonyhayama/wc-combo-sales',
	__FILE__,
	'wc-combo-sales'
);

//Optional: If you're using a private repository, specify the access token like this:
// $myUpdateChecker->setAuthentication('your-token-here');

//Optional: Set the branch that contains the stable release.
$myUpdateChecker->setBranch('production');