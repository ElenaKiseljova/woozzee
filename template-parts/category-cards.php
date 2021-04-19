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

<ul class="catalog-section__goods-list">     
  <?php
    foreach ($all_categories as $cat) {
      if($cat->category_parent == 0) {
        $category_id = $cat->term_id;
        
        // Для получения ссылки на картинку
        $thumbnail_id = get_woocommerce_term_meta( $category_id, 'thumbnail_id', true );
        $thumbnail_src = wp_get_attachment_url( $thumbnail_id );
        ?>
          <li class="catalog-section__goods-item">
            <article class="goods-card">
              <h2 class="goods-card__title visually-hidden">
                <?php echo $cat->name; ?>
              </h2>
              <div class="goods-card__img-wrapper goods-card__img-wrapper--1">
                <?php 
                  $count_cat_images = 5;
                  
                  // Если заполнены ACF поля
                  $cat_slider_images = array();
                  
                  // Если пустые ACF поля
                  $cat_slider_thumbnails = array();
                  
                  // Получение группы изображений Таксономии
                  $cat_images = get_field( 'category_product', $cat );
                  
                  if (!empty($cat_images)) {
                    for ($c=1; $c <= $count_cat_images; $c++) {
                      $cat_image_item = $cat_images['image_' . $c];
                      
                      if (!empty($cat_image_item) && is_array($cat_image_item)) {
                        array_push($cat_slider_images, $cat_image_item);
                      }
                    }
                  }                          
                  
                  if (empty($cat_slider_images)) {
                    $args = array (
                      'posts_per_page' => 5,
                      'post_type' => 'product',
                      'post_status' => array( 'publish' ),
                      'tax_query' => array(
                        array(
                          'taxonomy' => 'product_cat',
                          'field'    => 'term_id',
                          'terms'    => $category_id,
                          'include_children' => true
                        ),
                      ),
                    );
                    
                    $query = new WP_Query( $args );
                    if( $query->have_posts() ) {
                      while( $query->have_posts() ) {
                        $query->the_post();

                        $image_product = get_the_post_thumbnail();
                        
                        if (!empty($image_product)) {
                          array_push($cat_slider_thumbnails, $image_product);
                        }
                      }
                    }

                    wp_reset_postdata(); // сброс
                  }
                ?>
                <ul class="goods-card__img-list swiper-wrapper">
                  <?php if (!empty($cat_slider_images)): ?>
                    <!-- ACF -->
                    <?php foreach ($cat_slider_images as $cat_slider_image): ?>
                      <li class="goods-card__img-item swiper-slide">
                        <img src="<?= $cat_slider_image['url']; ?>" alt="<?= $cat_slider_image['alt']; ?>">
                      </li>
                    <?php endforeach; ?>
                  <?php elseif (!empty($cat_slider_thumbnails)) : ?>
                    <!-- Thumbnails -->
                    <?php foreach ($cat_slider_thumbnails as $cat_slider_thumbnail): ?>
                      <li class="goods-card__img-item swiper-slide">
                        <?= $cat_slider_thumbnail; ?>
                      </li>
                    <?php endforeach; ?>
                  <?php else : ?>
                    <?php if (!empty($thumbnail_src)): ?>
                      <li class="goods-card__img-item swiper-slide">
                        <img src="<?php echo $thumbnail_src; ?>" alt="<?php echo $cat->name; ?>">
                      </li>                              
                    <?php else: ?>
                      <li class="goods-card__img-item swiper-slide">
                        <img src="<?php echo wc_placeholder_img_src(); ?>" alt="<?php echo $cat->name; ?>">
                      </li>                              
                    <?php endif; ?>
                  <?php endif; ?>
                </ul>
                <div class="goods-card__swiper-pagination swiper-pagination"></div>
              </div>
              <a href="<?php echo get_term_link($cat->slug, 'product_cat'); ?>" class="goods-card__link">
                <?php echo $cat->name; ?>
              </a>
            </article>
          </li>
        <?php
      }
    }
  ?>
</ul>