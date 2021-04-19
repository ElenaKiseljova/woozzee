<?php 
  $taxonomy     = 'product_cat';
  $orderby      = 'menu_order';
  $show_count   = 0;      // 1 for yes, 0 for no
  $pad_counts   = 1;      // 1 for yes, 0 for no
  $hierarchical = 1;      // 1 for yes, 0 for no
  $title        = '';
  $empty        = 1;

  $args = array(
         'taxonomy'     => $taxonomy,
         'orderby'      => $orderby,
         'show_count'   => $show_count,
         'pad_counts'   => $pad_counts,
         'hierarchical' => $hierarchical,
         'title_li'     => $title,
         'hide_empty'   => $empty
  );

  $all_categories = get_categories( $args );

  // Если возникла ошибка запроса или терминов нет - прерываем выполнение функции
  if ( is_wp_error( $all_categories ) || ! $all_categories ) {
    return;
  }
?>

<div class="catalog-section__menu-list">
  <ul class="catalog-section__menu-list-wrapper">
    <?php
      foreach ($all_categories as $cat) {
        if($cat->category_parent == 0) {
          $category_id = $cat->term_id;
          
          $args2 = array(
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
          $sub_cats = get_categories( $args2 );
          
          if($sub_cats) {
            ?>
              <li class="catalog-section__menu-item">
                <button class="catalog-section__button catalog-section__button--opened">
                  <span><?php echo $cat->name; ?></span>
                </button>
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
                <a href="<?php echo get_term_link($cat->slug, 'product_cat'); ?>" class="catalog-section__button">
                  <span><?php echo $cat->name; ?></span>
                </a>
              </li>
            <?php
          }
        }
      }
    ?>
  </ul>
</div>