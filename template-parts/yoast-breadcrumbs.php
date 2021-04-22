<?php
  $class_breadcrumbs = 'breadcrumbs';

  if ( is_page_template( 'page-delivery.php' ) ) {
    $class_breadcrumbs = 'breadcrumbs breadcrumbs--inner';
  }

  if ( function_exists( 'yoast_breadcrumb' ) && ! is_front_page() ) {
    yoast_breadcrumb( '<p id="breadcrumbs" class="' . $class_breadcrumbs . '">', '</p>' );
  }
?>
