<?php
namespace wcComboSales\model;

class combo {
  public function __construct(){
    // add_action( 'init', [$this, 'register_taxonomy'], 0 );
    // add_action( 'acf/init', array( $this, 'register_fields' ) );
    add_action( 'init', [$this, 'register_post_type'], 0 );
  }

  // Register Custom Post Type
  public function register_post_type() {

    $labels = array(
      'name'                  => _x( 'Combos', 'Post Type General Name', 'wc-combo-sales' ),
      'singular_name'         => _x( 'Combo', 'Post Type Singular Name', 'wc-combo-sales' ),
      'menu_name'             => __( 'Combos', 'wc-combo-sales' ),
      'name_admin_bar'        => __( 'Combo', 'wc-combo-sales' ),
      'archives'              => __( 'Combo Archives', 'wc-combo-sales' ),
      'attributes'            => __( 'Combo Attributes', 'wc-combo-sales' ),
      'parent_item_colon'     => __( 'Parent Combo:', 'wc-combo-sales' ),
      'all_items'             => __( 'All Combos', 'wc-combo-sales' ),
      'add_new_item'          => __( 'Add New Combo', 'wc-combo-sales' ),
      'add_new'               => __( 'Add New', 'wc-combo-sales' ),
      'new_item'              => __( 'New Combo', 'wc-combo-sales' ),
      'edit_item'             => __( 'Edit Combo', 'wc-combo-sales' ),
      'update_item'           => __( 'Update Combo', 'wc-combo-sales' ),
      'view_item'             => __( 'View Combo', 'wc-combo-sales' ),
      'view_items'            => __( 'View Combos', 'wc-combo-sales' ),
      'search_items'          => __( 'Search Combo', 'wc-combo-sales' ),
      'not_found'             => __( 'Not found', 'wc-combo-sales' ),
      'not_found_in_trash'    => __( 'Not found in Trash', 'wc-combo-sales' ),
      'featured_image'        => __( 'Featured Image', 'wc-combo-sales' ),
      'set_featured_image'    => __( 'Set featured image', 'wc-combo-sales' ),
      'remove_featured_image' => __( 'Remove featured image', 'wc-combo-sales' ),
      'use_featured_image'    => __( 'Use as featured image', 'wc-combo-sales' ),
      'insert_into_item'      => __( 'Insert into item', 'wc-combo-sales' ),
      'uploaded_to_this_item' => __( 'Uploaded to this item', 'wc-combo-sales' ),
      'items_list'            => __( 'Combos list', 'wc-combo-sales' ),
      'items_list_navigation' => __( 'Combos list navigation', 'wc-combo-sales' ),
      'filter_items_list'     => __( 'Filter items list', 'wc-combo-sales' ),
    );
    $rewrite = array(
      'slug'                  => 'combos',
      'with_front'            => true,
      'pages'                 => true,
      'feeds'                 => true,
    );
    $args = array(
      'label'                 => __( 'Combo', 'wc-combo-sales' ),
      'description'           => __( 'Combos', 'wc-combo-sales' ),
      'labels'                => $labels,
      'supports'              => array( 'title', 'thumbnail' ),
      'hierarchical'          => false,
      'public'                => true,
      'show_ui'               => true,
      'show_in_menu'          => true,
      'menu_position'         => 5,
      'show_in_admin_bar'     => true,
      'show_in_nav_menus'     => true,
      'can_export'            => true,
      'has_archive'           => true,
      'exclude_from_search'   => false,
      'publicly_queryable'    => true,
      'rewrite'               => $rewrite,
      'capability_type'       => 'post',
    );
    register_post_type( 'combo', $args );

  }

  public function register_taxonomy() {

    $labels = array(
      'name'                       => _x( 'Product Stamps', 'Taxonomy General Name', 'wc-product-stamps' ),
      'singular_name'              => _x( 'Product Stamp', 'Taxonomy Singular Name', 'wc-product-stamps' ),
      'menu_name'                  => __( 'Product Stamps', 'wc-product-stamps' ),
      'all_items'                  => __( 'All Stamps', 'wc-product-stamps' ),
      'parent_item'                => __( 'Parent Stamp', 'wc-product-stamps' ),
      'parent_item_colon'          => __( 'Parent Stamp:', 'wc-product-stamps' ),
      'new_item_name'              => __( 'New Stamp Name', 'wc-product-stamps' ),
      'add_new_item'               => __( 'Add New Stamp', 'wc-product-stamps' ),
      'edit_item'                  => __( 'Edit Stamp', 'wc-product-stamps' ),
      'update_item'                => __( 'Update Stamp', 'wc-product-stamps' ),
      'view_item'                  => __( 'View Stamp', 'wc-product-stamps' ),
      'separate_items_with_commas' => __( 'Separate items with commas', 'wc-product-stamps' ),
      'add_or_remove_items'        => __( 'Add or remove items', 'wc-product-stamps' ),
      'choose_from_most_used'      => __( 'Choose from the most used', 'wc-product-stamps' ),
      'popular_items'              => __( 'Popular Stamps', 'wc-product-stamps' ),
      'search_items'               => __( 'Search Stamps', 'wc-product-stamps' ),
      'not_found'                  => __( 'Not Found', 'wc-product-stamps' ),
      'no_terms'                   => __( 'No items', 'wc-product-stamps' ),
      'items_list'                 => __( 'Stamps list', 'wc-product-stamps' ),
      'items_list_navigation'      => __( 'Stamps list navigation', 'wc-product-stamps' ),
    );
    $rewrite = array(
      'slug'                       => 'product-stamp',
      'with_front'                 => true,
      'hierarchical'               => false,
    );
    $args = array(
      'labels'                     => $labels,
      'hierarchical'               => false,
      'public'                     => true,
      'show_ui'                    => true,
      'show_admin_column'          => true,
      'show_in_nav_menus'          => true,
      'show_tagcloud'              => true,
      'rewrite'                    => $rewrite,
    );
    register_taxonomy( 'product_stamp', array( 'product' ), $args );
  }

  public function register_fields(){
    acf_add_local_field_group(array(
      'key' => 'group_5f846e71683cd',
      'title' => 'Product Stamp',
      'fields' => array(
        array(
          'key' => 'field_5f89843279e96',
          'label' => 'Image',
          'name' => 'image',
          'type' => 'image',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'return_format' => 'url',
          'preview_size' => 'thumbnail',
          'library' => 'all',
          'min_width' => '',
          'min_height' => '',
          'min_size' => '',
          'max_width' => '',
          'max_height' => '',
          'max_size' => '',
          'mime_types' => '',
        ),
        array(
          'key' => 'field_5f846e8d89377',
          'label' => 'Behavior',
          'name' => 'behavior',
          'type' => 'select',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'choices' => array(
            'visual-aid' => 'Visual Aid',
            'add-free-shipping' => 'Add Free Shipping',
            'last-units' => 'Last Units in Stock',
          ),
          'default_value' => array(
            0 => 'visual-aid',
          ),
          'allow_null' => 0,
          'multiple' => 0,
          'ui' => 0,
          'return_format' => 'value',
          'ajax' => 0,
          'placeholder' => '',
        ),
        array(
          'key' => 'field_5f8984620b2e4',
          'label' => 'Last Units',
          'name' => 'last_units',
          'type' => 'number',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => array(
            array(
              array(
                'field' => 'field_5f846e8d89377',
                'operator' => '==',
                'value' => 'last-units',
              ),
            ),
          ),
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'default_value' => '',
          'placeholder' => '',
          'prepend' => '',
          'append' => '',
          'min' => 1,
          'max' => '',
          'step' => '',
        ),
        array(
          'key' => 'field_5f899437a472b',
          'label' => 'Custom CSS',
          'name' => 'custom_css',
          'type' => 'textarea',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'default_value' => '',
          'placeholder' => '',
          'maxlength' => '',
          'rows' => '',
          'new_lines' => '',
        ),
      ),
      'location' => array(
        array(
          array(
            'param' => 'taxonomy',
            'operator' => '==',
            'value' => 'product_stamp',
          ),
        ),
      ),
      'menu_order' => 0,
      'position' => 'normal',
      'style' => 'default',
      'label_placement' => 'top',
      'instruction_placement' => 'label',
      'hide_on_screen' => '',
      'active' => 1,
      'description' => '',
    ));
  }
}