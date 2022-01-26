<?php 
  $args = array(
    'container_class' => 'catalog-section__menu-list',
    'menu_class'        => 'catalog-section__menu-list-wrapper', 
		'theme_location'  => 'categories_sidebar_menu'
  );
  
  wp_nav_menu( $args ); 
?>