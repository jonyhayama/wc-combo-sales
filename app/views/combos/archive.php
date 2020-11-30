<?php get_header(); ?>

<div class="wc-combo-sales wc-combo-sales-archive">
  <?php
  while( have_posts() ){ the_post();
    global $post;
    foreach( get_field('products', get_the_ID()) as $cp ){
      $product = wc_get_product( $cp );
      if( !$product->is_in_stock() ){
        continue 2;
      }
    }
    wc_combo_sales()->get_template_part( [ 'template' => 'combos/content', 'locals' => [ 'combo' => $post ] ] );
  }
  ?>
</div>

<?php get_footer();