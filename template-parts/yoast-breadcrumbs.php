<?php
  $class_breadcrumbs = 'breadcrumbs';

  if ( is_shop() || is_product_category() ) {
    //$class_breadcrumbs = 'breadcrumbs';
  } else {
    //$class_breadcrumbs = 'breadcrumbs breadcrumbs--single';
  }

  if ( function_exists( 'yoast_breadcrumb' ) && ! is_front_page() ) {
    yoast_breadcrumb( '<p id="breadcrumbs" class="' . $class_breadcrumbs . '">', '</p>' );
  }
?>
