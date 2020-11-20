<?php
namespace wcComboSales\controller;

class settings{
  protected $page_slug = 'wc-combo-sales-settings';

  public function __construct(){
    acf_add_options_sub_page(array(
      'page_title' 	=> 'Settings',
      'menu_title'	=> 'Settings',
      'parent_slug'	=> 'edit.php?post_type=combo',
      'capability' => 'manage_options',
      'menu_slug' => $this->page_slug,
      'post_id' => $this->page_slug,
      'autoload' => true,
    ));
  }

  public function get_field( $name ){
    return get_field($name, $this->page_slug);
  }
}