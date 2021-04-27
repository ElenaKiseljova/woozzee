<?php
  $locations = get_nav_menu_locations();

  if( isset( $locations['categories_cards_menu'] ) ) {
  	$all_categories = wp_get_nav_menu_items( $locations['categories_cards_menu'], [
    	'output_key'  => 'menu_order',
    ] );
  } 
?>

<ul class="catalog-section__goods-list">     
  <?php
    if ($all_categories) {
      foreach ($all_categories as $cat) {
        if($cat->menu_item_parent == 0) {
          $category_id = $cat->object_id;
          
          // Для получения ссылки на картинку
          $thumbnail_id = get_woocommerce_term_meta( $category_id, 'thumbnail_id', true );
          $thumbnail_src = wp_get_attachment_url( $thumbnail_id );
          ?>
            <li class="catalog-section__goods-item">
              <article class="goods-card">
                <h2 class="goods-card__title visually-hidden">
                  <?php echo $cat->title; ?>
                </h2>
                <div class="goods-card__img-wrapper goods-card__img-wrapper--1">
                  <?php 
                    $count_cat_images = 5;
                    
                    // Если заполнены ACF поля
                    $cat_slider_images = array();
                    
                    // Если пустые ACF поля
                    $cat_slider_thumbnails = array();
                    
                    // Получение термина
                    $cat_term = get_term_by( 'id', $cat->object_id, 'product_cat', 'OBJECT' );
                    
                    // Получение группы изображений Таксономии
                    if ($cat_term) {
                      $cat_images = get_field( 'category_product', $cat_term );
                    }                    
                    
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
                <a href="<?php echo $cat->url; ?>" class="goods-card__link">
                  <?php echo $cat->title; ?>
                </a>
              </article>
            </li>
          <?php
        }
      }
    }
    
  ?>
</ul>