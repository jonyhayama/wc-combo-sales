<?php
$section_title = wc_combo_sales('settings')->get_field('cart_section_title') ?: __('Check out our combos', 'wc-combo-sales');
echo '<div class="wc-combo-sales">';
echo '<h2>' . esc_html($section_title) . '</h2>';
foreach( $combos as $combo ){
  wc_combo_sales()->get_template_part( [ 'template' => 'combos/content', 'locals' => [ 'combo' => $combo ] ] );
}
echo '</div>';