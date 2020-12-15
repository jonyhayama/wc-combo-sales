<?php
namespace wcComboSales\controller;

class combos{
  protected static $populated_static = false;
  protected static $products_in_cart = [];
  protected static $related_combos = [];
  protected static $combos_in_cart = [];
  protected static $incomplete_combos_in_cart = [];

  public function __construct(){
    add_action( 'template_redirect', [$this, 'add_to_cart'] );
    add_action( 'template_redirect', [$this, 'maybe_redirect_archive'] );
    add_action( 'template_include', [$this, 'template_include'] );
    add_action( 'woocommerce_cart_calculate_fees', [$this, 'add_cart_discount'] );
    add_action( 'woocommerce_cart_collaterals', [$this, 'add_combo_offers_to_cart'], 0 );
    // add_action( 'pre_get_posts', [$this, 'set_combos_per_page'], 999 );
    add_shortcode( 'wc_combo_sales_archive', [$this, 'archive_shortcode'] );
  }

  public static function populate_static_vars(){
    if( self::$populated_static ){
      return;
    }

    $products = [];
    $cart = WC()->cart;
    $meta_query = [
      'relation' => 'OR'
    ];
    foreach($cart->get_cart() as $item ){
      $product_id = $item['data']->get_id();
      $products[$product_id] = [ 'quantity' => $item['quantity'], 'price' => (float) $item['data']->get_price() ];
      $meta_query[] = [
        'key' => 'products',
        'value' => '"' . $product_id . '"',
        'compare' => 'LIKE'
      ];
    }
    $combos = get_posts( [
      'post_type' => 'combo',
      'meta_query' => $meta_query
    ] );

    self::$products_in_cart = $products;
    self::$related_combos = $combos;

    
    foreach($combos as $combo){
      $combo_products = get_field('products', $combo->ID);
      $intersect = array_intersect($combo_products, array_keys($products));
      if( count($intersect) != count($combo_products) ){
        // User does not have all products in this combo
        self::$incomplete_combos_in_cart[] = $combo;
        continue;
      }

      self::$combos_in_cart[] = $combo;
    }
    self::$populated_static = true;
  }

  public function add_combo_offers_to_cart(){
    self::populate_static_vars();
    $max_combos_per_cart = wc_combo_sales('settings')->get_field('max_combos_per_cart') ?: 3;
    $combos = array_filter(self::$incomplete_combos_in_cart, function($c){
      foreach( get_field('products', $c) as $cp ){
        $product = wc_get_product( $cp );
        if( !$product->is_in_stock() ){
          return false;
        }
      }
      return true;
    });
    $combos = array_slice($combos, 0, $max_combos_per_cart);
    if( empty( $combos ) ){
      return;
    }
    
    wc_combo_sales()->get_template_part( [ 'template' => 'combos/cart-content', 'locals' => [ 'combos' => $combos ] ] );
  }

  public function calculate_combo_discount( $combo_total_price, $combo_id ){
    switch( get_field('discount_type', $combo_id) ){
      case 'percentage':
        return ($combo_total_price * ( get_field('discount', $combo_id) / 100 ));
      case 'fixed_value':
        return get_field('discount', $combo_id);
      default:
        return 0;
    }
  }

  public function add_cart_discount( \WC_Cart $cart ){
    self::populate_static_vars();

    foreach(self::$combos_in_cart as $combo){
      $combo_products = get_field('products', $combo->ID);
      $combo_count = 0;
      $combo_total_price = 0;
      foreach( $combo_products as $cp ){
        $combo_total_price += self::$products_in_cart[$cp]['price'];
        if( $combo_count == 0 || $combo_count > self::$products_in_cart[$cp]['quantity'] ){
          $combo_count = self::$products_in_cart[$cp]['quantity'];
        }
      }

      $combo_discount = $this->calculate_combo_discount($combo_total_price, $combo->ID);
      
      if( $combo_discount > 0 ){
        $combo_discount *= $combo_count;
        $description = $combo->post_title;
        $description .= ($combo_count > 1) ? ' x ' . $combo_count : '';
        $cart->add_fee( $description, -$combo_discount);
      }
    }
  }

  public function add_to_cart(){
    self::populate_static_vars();

    if( get_post_type() != 'combo' ) {
      return;
    }
    if( !is_singular() ){
      return;
    }

    $products = get_field('products');
    foreach( $products as $product_id ){
      if( !in_array($product_id, array_keys(self::$products_in_cart) ) ){
        WC()->cart->add_to_cart( $product_id );
      }
    }
    wp_safe_redirect( wc_get_cart_url() );
    exit;
  }

  public function maybe_redirect_archive(){
    if( get_post_type() != 'combo' ) {
      return;
    }
    if( is_singular() ){
      return;
    }
    if( $combos_archive_page = wc_combo_sales('settings')->get_field('combos_archive_page') ){
      wp_redirect( get_permalink( $combos_archive_page ) ); 
      exit;
    }
  }

  public function archive_shortcode(){
    $the_query = new \WP_Query([
      'post_type' => 'combo',
      'posts_per_page' => -1,
    ]);

    return wc_combo_sales()->fetch_template_part( [ 'template' => 'combos/archive-shortcode', 'locals' => [ 'the_query' => $the_query ] ] );
  }

  public function set_combos_per_page( $query ){
    if ( ! is_admin() && $query->is_main_query() ) {
      if( $query->is_archive('combo') && !get_search_query() ) {
        $query->set( 'posts_per_page', -1 );
      }
    }
  }

  public function template_include( $template ){
    if( get_post_type() != 'combo' ) {
      return $template;
    }
    if( is_singular() ){
      return $template;
    }
    
    return wc_combo_sales()->locate_template( [ 'template' => 'combos/archive' ] );
  }
}