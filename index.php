<?php
  get_header(  );
?>

<?php if (is_front_page()): ?>
  <main class="page-main">
    <section class="page-main__section page-main__section--welcome welcome-section">
      <div class="welcome-section__wrapper">
        <div class="welcome-section__banner">
          <?php 
            $blue_text = get_field( 'promo_blue_text' );
          ?>
          
          <?php if (!empty($blue_text) && is_array($blue_text)): ?>
            <h1 class="welcome-section__title">
              <span class="title__big">
                <?= $blue_text['big'] ?>
              </span>
              <?= $blue_text['middle'] ?>
            </h1>
            <p class="welcome-section__text">
              <?= $blue_text['small'] ?>
            </p>
          <?php endif; ?>
          
          <div class="welcome-section__callback callback-form">
            <?php 
              echo do_shortcode( '[contact-form-7 id="70" title="Обратный звонок"]' );
            ?>
          </div>
          <!-- <form action="" class="welcome-section__callback callback-form">
            <p class="callback-form__text">Нет времени листать каталог? Оставьте номер, наш менеджер поможет выбрать за 5 минут</p>
            <div class="callback-form__wrapper">
              <input class="callback-form__input" type="text" name="phone" placeholder="+7 (999) 999 99 99"> 
              <button class="callback-form__button" type="submit">Отправить</button>
            </div>
          </form> -->
        </div>
      </div>
    </section>
    
    <?php 
      // Голубой баннер
      $banner_toggle = get_field( 'banner_toggle' );
    ?>
    
    <?php if (!empty($banner_toggle) && $banner_toggle == 'да'): ?>
      <?php 
        $banner_image = get_field( 'banner_image' );
      ?>
      <section class="page-main__section page-main__section--holyday holyday-section">
        <?php if (!empty($banner_image) && is_array($banner_image)): ?>          
          <a href="<?php the_field( 'banner_link' ); ?>" class="holyday-section__wrapper">
            <div class="holyday-section__img-wrapper">
              <img src="<?php echo esc_url( $banner_image['url'] ); ?>" alt="<?php echo esc_attr( $banner_image['alt'] ); ?>">
            </div>
            
            <h2 class="holyday-section__title">              
              <span>
                <?php 
                  the_field( 'banner_text_upper' );
                ?>
              </span>
              <?php 
                the_field( 'banner_text_supper' );
              ?>
            </h2>
            <p class="holyday-section__text">
              <?php 
                the_field( 'banner_description' );
              ?>
            </p>
          </a>
        <?php endif; ?>        
      </section>
    <?php endif; ?>
    
    <section class="page-main__section page-main__section--slider slider-section">
      <div class="slider-section__wrapper">
        <?php 
          $count_slides = 4;
          
          $center_slides = array();
          
          for ($s=1; $s <= $count_slides; $s++) {
            $slide_image_desktop = get_field( 'promo_slide_image_desktop_' . $s );
            $slide_image_mobile = get_field( 'promo_slide_image_mobile_' . $s );
            $slide_image_link = get_field( 'promo_slide_link_' . $s );
            
            if (!empty($slide_image_desktop) && is_array($slide_image_desktop) && !empty($slide_image_mobile) && is_array($slide_image_mobile)) {
              $slide_item = array(
                'image_desktop' => $slide_image_desktop,
                'image_mobile' => $slide_image_mobile,
                'link' => '',
              );
              
              if (!empty($slide_image_link)) {
                $slide_item['link'] = $slide_image_link;
              }
              
              array_push($center_slides, $slide_item);
            }
          }
        ?>
        <?php if (!empty($center_slides)): ?>
          <div class="slider-section__slider-container">
            <ul class="slider-section__slider swiper-wrapper">
              <?php foreach ($center_slides as $center_slide): ?>
                <li class="slider-section__slide swiper-slide">
                  <a href="<?= $center_slide['link']; ?>">
                    <picture>                  
                      <source media="(min-width: 500px)" srcset="<?= $center_slide['image_desktop']['url']; ?>" alt="<?= $center_slide['image_desktop']['alt']; ?>">
                      <img src="<?= $center_slide['image_mobile']['url']; ?>" alt="<?= $center_slide['image_mobile']['alt']; ?>">
                    </picture>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
            <div class="slider-section__swiper-pagination swiper-pagination"></div>
          </div>
        <?php endif; ?>        
      </div>
    </section>
    
    <section class="page-main__section page-main__section--catalog catalog-section">
      <div class="catalog-section__wrapper">
        <h2 class="catalog-section__title">Каталог</h2>
        
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
      </div>
    </section>
    <?php 
      // Бирюзовый слайдер
      $cyan_slider_toggle = get_field( 'cyan_slider_toggle' );
    ?>
    <?php if (!empty($cyan_slider_toggle) && $cyan_slider_toggle == 'Да'): ?>
      <section class="page-main__section page-main__section--banner banner-section">
        <?php 
          $count_cyan_slides = 4;
          
          $cyan_slides = array();
          
          for ($с=1; $с <= $count_cyan_slides; $с++) {
            $cyan_slide_image_desktop = get_field( 'cyan_slide_image_desktop_' . $с );
            $cyan_slide_image_mobile = get_field( 'cyan_slide_image_mobile_' . $с );
            $cyan_slide_link = get_field( 'cyan_slide_link_' . $с );
            $cyan_slide_title = get_field( 'cyan_slide_title_' . $с );
            $cyan_slide_text = get_field( 'cyan_slide_text_' . $с );
            
            if (!empty($cyan_slide_image_desktop) && is_array($cyan_slide_image_desktop) && !empty($cyan_slide_image_mobile) && is_array($cyan_slide_image_mobile)  && !empty($cyan_slide_text) && !empty($cyan_slide_title)) {
              $cyan_slide_item = array(
                'image_desktop' => $cyan_slide_image_desktop,
                'image_mobile' => $cyan_slide_image_mobile,
                'link' => '',
                'title' => $cyan_slide_title,
                'text' => $cyan_slide_text,
              );
              
              if (!empty($cyan_slide_link)) {
                $cyan_slide_item['link'] = $cyan_slide_link;
              }
              
              array_push($cyan_slides, $cyan_slide_item);
            }
          }
        ?>
        <?php if (!empty($cyan_slides)): ?>          
          <div class="banner-section__container">
            <div class="banner-section__wrapper swiper-wrapper">
              <?php foreach ($cyan_slides as $cyan_slide): ?>
                <div class="banner-section__item  swiper-slide">
                  <p class="banner-section__title">
                    <a href="<?= $cyan_slide['link']; ?>">
                      <?= $cyan_slide['title']; ?>
                    </a>
                  </p>
                  <p class="banner-section__text">
                    <a href="<?= $cyan_slide['link']; ?>">
                      <?= $cyan_slide['text']; ?>
                    </a>
                  </p>
                  
                  <div class="banner-section__img-wrapper">
                     <a href="<?= $cyan_slide['link']; ?>">
                        <picture>
                          <!-- <source media="(min-width: 1200px)" srcset="img/naklejka-na-pol-1,5-metra-desktop.png">
                          <source media="(min-width: 1024px)" srcset="img/naklejka-na-pol-1,5-metra-laptop.png"> -->
                          <source media="(min-width: 768px)" srcset="<?= $cyan_slide['image_desktop']['url']; ?>">
                          <img src="<?= $cyan_slide['image_mobile']['url']; ?>" alt="<?= $cyan_slide['image_desktop']['alt']; ?>">
                        </picture>
                     </a>
                  </div>
                  
                  <?php if ($cyan_slide['link'] !== ''): ?>
                    <a href="<?= $cyan_slide['link']; ?>" class="banner-section__more">
                      Подробнее
                    </a>
                  <?php endif; ?>                
                </div>
              <?php endforeach; ?>
            </div>
            <div class="banner-section__swiper-pagination swiper-pagination"></div>
          </div>
        <?php endif; ?>           
      </section>
    <?php endif; ?>
    
    <?php 
      $popularity_toggle = get_field( 'popularity_toggle' );
    ?>
    
    <?php if (!empty($popularity_toggle) && $popularity_toggle == 'Да'): ?>
      <section class="page-main__section page-main__section--popular popular-section">
        <div class="popular-section__wrapper">
          <?php 
            $popularity_array_category = get_field( 'popularity_array_category' );
          ?>
          <?php if (!empty($popularity_array_category)): ?>
            <ul class="popular-section__goods-list link-list">
              <?php foreach ($popularity_array_category as $popularity_category): ?>
                <?php
                  // Для получения ссылки на картинку
                  $thumbnail_id = get_woocommerce_term_meta( $popularity_category->term_id, 'thumbnail_id', true );
                  $thumbnail_src = wp_get_attachment_url( $thumbnail_id );
                ?>
                <li class="link-list__item link-list__item--bold">
                  <a href="<?php echo get_term_link($popularity_category->slug, 'product_cat'); ?>">                  
                    <?php if (!empty($thumbnail_src)): ?>
                      <img src="<?php echo $thumbnail_src; ?>" alt="<?= $popularity_category->name; ?>">                           
                    <?php else: ?>
                      <img src="<?php echo wc_placeholder_img_src(); ?>" alt="<?= $popularity_category->name; ?>">                             
                    <?php endif; ?>
                    
                    <?= $popularity_category->name; ?>
                  </a>
                 </li>
              <?php endforeach; ?>
              
            </ul>
          <?php endif; ?>        
        </div>
      </section>
    <?php endif; ?>    
    
    <?php 
      // Таймер
      
      $timer_toggle = get_field( 'timer_toggle' );
    ?>
    
    <section class="page-main__section page-main__section--discount discount-section">
      <?php if (!empty($timer_toggle) && $timer_toggle == 'Да'): ?>
        <span class="visually-hidden" id="timer-off">
          <?php if (isset($_COOKIE['timer_coupon'])): ?>
            <?php 
              // Время для таймера в куках
              echo $_COOKIE['timer_coupon'] * 1000; 
            ?>
          <?php elseif(!isset($_COOKIE['timer_coupon']) && !isset($_COOKIE['timer_flag'])) : ?>
            <?php 
              // Если куки не задались еще, присваивается 3 часа, потом это время плавно куками заменяется, если страница перезагружена
              echo (time() + (3 * 60 * 60)) * 1000; 
            ?>
          <?php 
            // Время будет меньше текущего и блок таймера скроется
            else :
          ?>
            0
          <?php endif; ?>          
        </span>
        
        <div class="discount-section__wrapper">
          <div class="discount-section__form-wrapper">
            <form id="timer-form" action="" class="discount-section__form">
              <h2 class="discount-section__form-title">
                <?php the_field( 'timer_title' ); ?>
              </h2>
              <p class="discount-section__form-text">
                <?php the_field( 'timer_text' ); ?>
              </p>
              <div class="discount-section__controls">
                <input class="discount-section__input" placeholder="Введите e-mail" type="email" name="email" required> 
                
                <input type="hidden" name="antibot" value="false">
                <input type="hidden" name="sale" value="<?php the_field( 'timer_sale' ); ?>">
                
                <button id="timer-submit" class="discount-section__button" type="submit">
                  Отправить
                </button>
              </div>
              <div class="message"></div>
            </form>
            <div class="discount-section__img-wrapper">
              <?php 
                $timer_image = get_field( 'timer_image' );
              ?>
              <?php if (!empty($timer_image) && is_array($timer_image)): ?>
                <img src="<?= $timer_image['url']; ?>" alt="<?= $timer_image['alt']; ?>">
              <?php else : ?>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/upakovka.png" alt="упаковка">
              <?php endif; ?>              
            </div>
            <div class="discount-section__countdown discount-section__countdown--timer">
              <!-- <input value="00:59:59" type="text" readonly="readonly"> -->
              <div class="clock">
                <div class='clock__item hour'>
                  <p class="clock__time">
                    <span class='hour0'></span>
                  </p>
                  <p class="clock__time">
                    <span class='hour1'></span>
                  </p>
                  <p class="visually-hidden">Часов</p>
                </div>
                <div class="clock__razd">
                  :
                </div>
                <div class='clock__item min'>
                  <p class="clock__time">
                    <span class='min0'></span>
                  </p>
                  <p class="clock__time">
                    <span class='min1'></span>
                  </p>
                  <p class="visually-hidden">Минут</p>
                </div>
                <div class="clock__razd">
                  :
                </div>
                <div class='clock__item sec'>
                  <p class="clock__time">
                    <span class='sec0'></span>
                  </p>
                  <p class="clock__time">
                    <span class='sec1'></span>
                  </p>
                  <p class="visually-hidden">Секунд</p>
                </div>
              </div>
              
              <p class="discount-section__countdown-text discount-section__countdown-text--timer">
                <?php the_field( 'timer_subtext' ); ?>
              </p>
            </div>
          </div>
        </div>      
      <?php endif; ?>      
    </section>
    
    <?php 
      $tabs_cat_toggle = get_field( 'tabs_cat_toggle' );
    ?>
    
    <?php if (!empty($tabs_cat_toggle) && $tabs_cat_toggle == 'Да'): ?>
      <section class="page-main__section page-main__section--tabs tabs-section">
        <div class="tabs-section__wrapper">
          <?php 
            $tabs_cat_array = get_field( 'tabs_cat_array' );
          ?>
          <ul class="tabs-section__tabs-list">
            <?php $i = 0; ?>
            <?php foreach ($tabs_cat_array as $tabs_cat): ?>
              <?php if ($i == 0): ?>
                <li class="tabs-section__item tabs-section__item--current">
                  <a>
                    <?= $tabs_cat->name; ?>
                  </a>
                </li>
              <?php else : ?>
                <li class="tabs-section__item">
                  <a>
                    <?= $tabs_cat->name; ?>
                  </a>
                </li>
              <?php endif; ?>              
            <?php $i++; ?>
            <?php endforeach; ?>
          </ul>          
          
          <script type="text/javascript">
            // Массивы значений для списков с постами
            var true_posts = [];
            var current_page = [];
            var max_pages = [];
            var post_on_page = [];
            var id_category = [];
          </script>
          
          <?php 
            //Порядковый номер списка с постами
            $h = 0; 
            
            //Порядковый кнопки подгрузки
            $b = 0;
          ?>
          <?php foreach ($tabs_cat_array as $tabs_cat): ?>
            <?php if ($h == 0): ?>
              <ul class="tabs-section__goods-list link-list">              
            <?php else : ?>
              <ul class="tabs-section__goods-list link-list tabs-section__goods-list--hidden">
            <?php endif; ?>  
                <?php 
                  $posts_on_page = get_field( 'tabs_cat_count' );
                  
                  if (empty($posts_on_page)) {
                    $posts_on_page = 8;
                  }
                  
                  $args = array (
                    'posts_per_page' => $posts_on_page, // кол-во товаров
                    'post_type' => 'product',
                    'post_status' => array( 'publish' ),
                    'tax_query' => array(
                      array(
                        'taxonomy' => 'product_cat',
                        'field'    => 'term_id',
                        'terms'    => $tabs_cat->term_id,
                        'include_children' => true
                      ),
                    ),
                    'meta_query' => array(
                  		array(
                  			'key' => '_thumbnail_id',
                  			'compare' => 'EXISTS'
                  		)
                  	),
                  );
                  
                  $query = new WP_Query( $args );
                  if( $query->have_posts() ) {
                    while( $query->have_posts() ) {
                      $query->the_post();                      
                      ?>
                        <li class="link-list__item">
                          <a href="<?php echo get_permalink( ); ?>">
                            <?php if (has_post_thumbnail()): ?>
                              <?php the_post_thumbnail(); ?>
                            <?php endif; ?>
                          </a>                              
                        </li>
                      <?php 
                    }
                  } else {
                    get_template_part( 'template-parts/content', 'none' );
                  }
                ?>
              </ul>      
              <?php 
                if (  $query->max_num_pages > 1 && get_query_var('paged') < $query->max_num_pages ) :
                  ?>
                    <script>
                      true_posts[<?= $b; ?>] = '<?php echo serialize($query->query_vars); ?>';
                      current_page[<?= $b; ?>] = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
                      max_pages[<?= $b; ?>] = '<?php echo $query->max_num_pages; ?>';
                      post_on_page[<?= $b; ?>] = '<?php echo $query->post_count; ?>';                         
                      id_category[<?= $b; ?>] = '<?= $tabs_cat->term_id; ?>';
                    </script>
                    
                    <a class="tabs-section__more-link" id="loadmore-<?= $b; ?>">
                      <span>Показать больше</span>
                    </a>
                  <?php 
                  $b++; 
                endif;
                
                wp_reset_postdata(); // сброс
              ?>    
          <?php $h++; ?>
          <?php endforeach; ?>
        </div>
      </section>
    <?php endif; ?>
    
    <?php 
      $hit_toggle = get_field( 'hit_toggle' );
    ?>
    
    <?php if (!empty($hit_toggle) && $hit_toggle == 'Да'): ?>
      <section class="page-main__section page-main__section--hit hit-section">
        <div class="hit-section__wrapper">
          <?php 
            $hit_title = get_field( 'hit_title' );
          ?>
          
          <h2 class="hit-section__title">
            <?php if (isset($hit_title['white'])): ?>
              <?= $hit_title['white']; ?>
            <?php endif; ?>
            <span class="hit-section__free">
              <?php if (isset($hit_title['yellow'])): ?>
                <?= $hit_title['yellow']; ?>
              <?php endif; ?>
            </span>
          </h2>
          <div class="hit-section__info">
            <p class="hit-section__text">
              <?php the_field( 'hit_text' ); ?>
            </p>
            <div class="hit-section__img-wrapper">
              <?php 
                $hit_image = get_field( 'hit_image' );
              ?> 
              <?php if (!empty($hit_image) && is_array($hit_image)): ?>
                <picture>
                  <?php if (isset($hit_image['desktop'])): ?>
                    <source media="(min-width: 1024px)" srcset="<?= $hit_image['desktop']['url']; ?>">
                  <?php endif; ?>
                  <?php if (isset($hit_image['tablet'])): ?>
                    <source media="(min-width: 500px)" srcset="<?= $hit_image['tablet']['url']; ?>">
                  <?php endif; ?>
                  <?php if (isset($hit_image['mobile'])): ?>
                    <img src="<?= $hit_image['mobile']['url']; ?>" alt="<?= $hit_image['mobile']['alt']; ?>">
                  <?php endif; ?>                  
                </picture>
              <?php endif; ?>              
            </div>
            <p class="hit-section__sub-text">
              <?php the_field( 'hit_subtext' ); ?>
            </p>
            <a href="<?php echo wc_get_page_permalink( 'shop' ); ?>" class="hit-section__catalog-link">
              В каталог
            </a>
          </div>
        </div>
      </section>
    <?php endif; ?>    
    
    <?php 
      $blog_toggle = get_field( 'blog_toggle' );
    ?>
    
    <?php if (!empty($blog_toggle) && $blog_toggle == 'Да'): ?>
      <section class="page-main__section page-main__section--articles articles-section">
        <div class="articles-section__wrapper">
          <h2 class="articles-section__title">
            <?php the_field( 'blog_title' ) ?>
          </h2>
          
          <ul class="articles-section__goods-list link-list">
            <?php 
              $blog_count = get_field( 'blog_count' );
              
              if (empty($blog_count)) {
                $blog_count = 4;
              }
              
              $args = array (
                'posts_per_page' => $blog_count, // кол-во постов
                'post_type' => 'post',
                'post_status' => array( 'publish' ),
                'meta_query' => array(
                  array(
                    'key' => '_thumbnail_id',
                    'compare' => 'EXISTS'
                  )
                ),
              );
              
              $query = new WP_Query( $args );
              if( $query->have_posts() ) {
                while( $query->have_posts() ) {
                  $query->the_post();                      
                  ?>
                    <li class="link-list__item">
                      <a href="<?php echo get_permalink(  ); ?>">
                        <?php if (has_post_thumbnail()): ?>
                          <?php the_post_thumbnail(); ?>
                        <?php endif; ?>
                        
                        <?php the_title(); ?>
                      </a>
                    </li>
                  <?php 
                }
              } else {
                get_template_part( 'template-parts/content', 'none' );
              }
              
              wp_reset_postdata(); // сброс
            ?>             
          </ul>
          
          <a href="<?php echo get_post_type_archive_link( 'post' ); ?>" class="articles-section__link">
            ещё статьи
          </a>
        </div>
      </section>
    <?php endif; ?>
    
    <?php 
      $about_toggle = get_field( 'about_toggle' );
    ?>
    
    <?php if (!empty($about_toggle) && $about_toggle == 'Да'): ?>
      <section class="page-main__section page-main__section--about-us about-us">
        <div class="about-us__wrapper">
          <h2 class="about-us__title">
            <?php the_field( 'about_title' ); ?>
          </h2>
          <p class="about-us__text">
            <?php the_field( 'about_text' ); ?>
          </p>
          <button class="about-us__text-toggler">Читать полностью</button>
          
          <ul class="about-us__list">
            <?php 
              for ($advantage=1; $advantage <= 5; $advantage++) {
                ?>
                  <li class="about-us__item" style="background-image: url('<?php the_field( 'about_advantage_icon_' . $advantage ); ?>');">
                    <h3 class="about-us__item-title">
                      <?php the_field( 'about_advantage_title_' . $advantage ); ?>
                    </h3>
                    <p class="about-us__item-text">
                      <?php the_field( 'about_advantage_text_' . $advantage ); ?>
                    </p>
                  </li>
                <?php
              }
            ?>
          </ul>
        </div>
      </section>
    <?php endif; ?>
    
    <section class="page-main__section page-main__section--contact contact-section">
      <div class="contact-section__wrapper">
        <h2 class="contact-section__title">
          <?php the_field( 'contacts_title' ); ?>
        </h2>
        <div class="contact-section__form">
          <?php echo do_shortcode( '[contact-form-7 id="448" title="Напишите нам"]' ); ?>
        </div>
        
        <!-- <form action="" class="contact-section__form">
          <div class="contact-section__input-wrapper">
            <input class="contact-section__input" type="text" name="name" placeholder="Ваше имя"> 
            <input class="contact-section__input" type="email" name="email" placeholder="Ваш e-mail"> 
            <input class="contact-section__input" type="tel" name="tel" placeholder="Ваш телефон"> 
            <textarea class="contact-section__input contact-section__input--textarea" placeholder="Ваше сообщение" name="message" id="" cols="30" rows="10">
            </textarea>
          </div>
          <button class="contact-section__submit-button" type="submit">Отправить</button>
        </form> -->
        <p class="contact-section__text">
          Нажимая на кнопку, вы даете согласие<br>на обработку персональных данных<br>и соглашаетесь c <a href="<?php echo get_privacy_policy_url(); ?>">политикой<br>конфиденциальности</a>
        </p>
        <p class="contact-section__subtext">
          <?php the_field( 'contacts_love' ); ?>
        </p>
      </div>
    </section>
  </main>
<?php else: ?>
  <main class="page-main">
    <div class="page-main__wrapper page-main__wrapper--another">
      <h1>
        <?php 
          the_title();
        ?>
      </h1>
      
      <div class="">
        <?php 
          the_content();
        ?>
      </div>
      
    </div>    
  </main>
<?php endif; ?>

<?php
  get_footer(  );
?>
