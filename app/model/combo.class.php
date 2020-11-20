<?php
namespace wcComboSales\model;

class combo {
  public function __construct(){
    // add_action( 'init', [$this, 'register_taxonomy'], 0 );
    add_action( 'acf/init', [ $this, 'register_fields' ] );
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

  public function register_fields() {
    acf_add_local_field_group(array(
      'key' => 'group_5fb3b98c70cfe',
      'title' => 'Combo',
      'fields' => array(
        array(
          'key' => 'field_5fb3b994722e9',
          'label' => 'Products',
          'name' => 'products',
          'type' => 'relationship',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'post_type' => array(
            0 => 'product',
          ),
          'taxonomy' => '',
          'filters' => array(
            0 => 'search',
            1 => 'post_type',
            2 => 'taxonomy',
          ),
          'elements' => '',
          'min' => '',
          'max' => '',
          'return_format' => 'id',
        ),
        array(
          'key' => 'field_5fb3ba79157a0',
          'label' => 'Discount Type',
          'name' => 'discount_type',
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
            'percentage' => 'Percentage',
            'fixed_value' => 'Fixed Value',
          ),
          'default_value' => array(
            0 => 'percentage',
          ),
          'allow_null' => 0,
          'multiple' => 0,
          'ui' => 0,
          'return_format' => 'value',
          'ajax' => 0,
          'placeholder' => '',
        ),
        array(
          'key' => 'field_5fb3baaa157a1',
          'label' => 'Discount',
          'name' => 'discount',
          'type' => 'number',
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
          'prepend' => '',
          'append' => '',
          'min' => '',
          'max' => '',
          'step' => '',
        ),
      ),
      'location' => array(
        array(
          array(
            'param' => 'post_type',
            'operator' => '==',
            'value' => 'combo',
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