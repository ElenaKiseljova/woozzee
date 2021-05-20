<?php
  $locations = get_nav_menu_locations();

  if( isset( $locations['categories_sidebar_menu'] ) ) {
  	$all_categories = wp_get_nav_menu_items( $locations['categories_sidebar_menu'], [
    	'output_key'  => 'menu_order',
    ] );
  } 
?>

<div class="catalog-section__menu-list">
  <ul class="catalog-section__menu-list-wrapper">
    <?php
      if ($all_categories) {
        foreach ($all_categories as $cat) {
          if($cat->menu_item_parent == 0) {
            $category_id = $cat->object_id;
            
            $taxonomy     = 'product_cat';
            $orderby      = 'menu_order';
            $show_count   = 0;      // 1 for yes, 0 for no
            $pad_counts   = 1;      // 1 for yes, 0 for no
            $hierarchical = 1;      // 1 for yes, 0 for no
            $title        = '';
            $empty        = 1;
            
            $args = array(
                    'taxonomy'     => $taxonomy,
                    'child_of'     => 0,
                    'parent'       => $category_id,
                    'orderby'      => $orderby,
                    'show_count'   => $show_count,
                    'pad_counts'   => $pad_counts,
                    'hierarchical' => $hierarchical,
                    'title_li'     => $title,
                    'hide_empty'   => $empty
            );
            
            $sub_cats = get_categories( $args );
            
            if( $sub_cats ) {
              ?>
                <li class="catalog-section__menu-item">                  
                  <div class="catalog-section__button catalog-section__button--opened">
                      <a href="<?php echo $cat->url; ?>">
                        <span>
                          <?php echo $cat->title; ?>
                        </span>
                      </a>
                      <button class="catalog-section__button-element">
                          <span class="visually-hidden">Меню</span>
                      </button>
                  </div>
                  <ul class="catalog-section__sublist">
                    <?php 
                      foreach($sub_cats as $sub_category) : 
                        ?>
                          <li class="catalog-section__item catalog-section__item--sublist">
                            <a href="<?php echo get_term_link($sub_category->slug, 'product_cat'); ?>">
                              <?php echo $sub_category->name; ?>
                            </a>
                          </li>
                        <?php 
                      endforeach;
                    ?>                          
                  </ul>
                </li>
              <?php
            } else {
              ?>
                <li class="catalog-section__menu-item">
                  <a href="<?php echo $cat->url; ?>" class="catalog-section__button">
                    <span>
                      <?php echo $cat->title; ?>
                    </span>
                  </a>
                </li>
              <?php
            }
          }
        }
      }
    ?>
  </ul>
</div>