<?php
  global $class_breadcrumbs;

  if ( function_exists( 'yoast_breadcrumb' ) && ! is_front_page() ) {
    yoast_breadcrumb( '<p id="breadcrumbs" class="' . $class_breadcrumbs . '">', '</p>' );
  }
?>
