<?php
$add_to_cart = wc_combo_sales('settings')->get_field('cart_add_to_cart_button') ?: __('Add to cart', 'wc-combo-sales');
$combo_products = get_field('products', $combo->ID);
$combo_total_price = 0;
$products = [];
foreach( $combo_products as $cp ){
  $product = wc_get_product( $cp );
  $combo_total_price += $product->get_price();
  $products[] = do_shortcode('[product id="'.$cp.'" columns="1"]');
}
$discounted_price = $combo_total_price - wc_combo_sales('combos')->calculate_combo_discount($combo_total_price, $combo->ID);
echo '<h3 class="wc-combo-sale-title">' . $combo->post_title . '</h3>';
echo '<div class="wc-combo-sale">';
echo '<ul class="wc-combo-sale-products"><li>'.implode('</li><li>', $products).'</li></ul>';
echo '<div class="wc-combo-sale-info">';
echo '<div class="product"><span class="price">';
echo '<del>' . wc_price( $combo_total_price ) . '</del>' . '<ins>'. wc_price( $discounted_price ).'</ins>' . '<br />';
echo '</span></div>';
echo '<a class="button add_to_cart_button" href="'.get_permalink($combo).'">' . $add_to_cart . '</a>';
echo '</div>';
echo '</div>';