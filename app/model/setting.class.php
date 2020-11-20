<?php
namespace wcComboSales\model;

class setting {
  public function __construct(){
    add_action( 'acf/init', [ $this, 'register_fields' ] );
  }

  public function register_fields(){
    acf_add_local_field_group(array(
      'key' => 'group_5fb7c867e588f',
      'title' => 'Settings',
      'fields' => array(
        array(
          'key' => 'field_5fb7c885d886d',
          'label' => 'Cart',
          'name' => '',
          'type' => 'tab',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'placement' => 'top',
          'endpoint' => 0,
        ),
        array(
          'key' => 'field_5fb7c8bfd886e',
          'label' => 'Section Title',
          'name' => 'cart_section_title',
          'type' => 'text',
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
          'maxlength' => '',
        ),
        array(
          'key' => 'field_5fb7c939d886f',
          'label' => 'Add to Cart Button',
          'name' => 'cart_add_to_cart_button',
          'type' => 'text',
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
          'maxlength' => '',
        ),
        array(
          'key' => 'field_5fb7c952d8870',
          'label' => 'Max Combos per Cart',
          'name' => 'max_combos_per_cart',
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
            'param' => 'options_page',
            'operator' => '==',
            'value' => 'wc-combo-sales-settings',
          ),
        ),
      ),
      'menu_order' => 0,
      'position' => 'normal',
      'style' => 'seamless',
      'label_placement' => 'top',
      'instruction_placement' => 'label',
      'hide_on_screen' => '',
      'active' => 1,
      'description' => '',
    ));
  }
}