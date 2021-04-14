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
              <br class="holyday-section__br-mobile">
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
    <section class="page-main__section page-main__section--banner banner-section">
      <div class="banner-section__container">
        <div class="banner-section__wrapper swiper-wrapper">
          <div class="banner-section__item swiper-slide">
            <p class="banner-section__title">Желаете напомнить клиентам о социальной дистанции?</p>
            <p class="banner-section__text">У нас есть требуемые по закону наклейки</p>
            <a href="#" class="banner-section__more">Подробнее</a>
          </div>
          <div class="banner-section__item swiper-slide">
            <p class="banner-section__title">Желаете напомнить клиентам о социальной дистанции?</p>
            <p class="banner-section__text">У нас есть требуемые по закону наклейки</p>
            <a href="#" class="banner-section__more">Подробнее</a>
          </div>
          <div class="banner-section__item swiper-slide">
            <p class="banner-section__title">Желаете напомнить клиентам о социальной дистанции?</p>
            <p class="banner-section__text">У нас есть требуемые по закону наклейки</p>
            <a href="#" class="banner-section__more">Подробнее</a>
          </div>
        </div>
        <div class="banner-section__swiper-pagination swiper-pagination"></div>
      </div>
    </section>
    <section class="page-main__section page-main__section--popular popular-section">
      <div class="popular-section__wrapper">
        <ul class="popular-section__goods-list link-list">
          <li class="link-list__item"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/previu-kalendari.jpg" width="264" height="342" alt="календари"> Календари</a></li>
          <li class="link-list__item"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/previu-raskraski.jpg" width="264" height="342" alt="раскраски"> Раскраски</a></li>
          <li class="link-list__item"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/rectangle-230.jpg" width="264" height="342" alt="календари"> Открытки</a></li>
          <li class="link-list__item"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/rectangle-231.jpg" width="264" height="342" alt="календари"> Таблички</a></li>
        </ul>
      </div>
    </section>
    <section class="page-main__section page-main__section--discount discount-section">
      <div class="discount-section__wrapper">
        <div class="discount-section__form-wrapper">
          <form action="" class="discount-section__form">
            <h2 class="discount-section__form-title">Активируйте 10% скидку на первый заказ!</h2>
            <p class="discount-section__form-text">Промокод пришлем на e-mail</p>
            <div class="discount-section__controls"><input class="discount-section__input" placeholder="Введите e-mail" type="email" name="email"> <button class="discount-section__button" type="submit">Отправить</button></div>
          </form>
          <div class="discount-section__img-wrapper"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/upakovka.png" alt="упаковка" width="280" height="183"></div>
          <div class="discount-section__countdown">
            <input value="00:59:59" type="text" readonly="readonly">
            <p class="discount-section__countdown-text">Осталось до окончания действия предложения</p>
          </div>
        </div>
      </div>
    </section>
    <section class="page-main__section page-main__section--tabs tabs-section">
      <div class="tabs-section__wrapper">
        <ul class="tabs-section__tabs-list">
          <li class="tabs-section__item tabs-section__item--current"><a href="#">Лидеры продаж</a></li>
          <li class="tabs-section__item"><a href="#">Новинки</a></li>
          <li class="tabs-section__item"><a href="#">Акции</a></li>
        </ul>
        <ul class="tabs-section__goods-list link-list">
          <li class="link-list__item"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/1.jpg" alt=""></a></li>
          <li class="link-list__item"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/2.jpg" alt=""></a></li>
          <li class="link-list__item"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/3.jpg" alt=""></a></li>
          <li class="link-list__item"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/4.jpg" alt=""></a></li>
          <li class="link-list__item"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/5.jpg" alt=""></a></li>
          <li class="link-list__item"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/6.jpg" alt=""></a></li>
          <li class="link-list__item"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/7.jpg" alt=""></a></li>
          <li class="link-list__item"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/8.jpg" alt=""></a></li>
        </ul>
        <ul class="tabs-section__goods-list link-list tabs-section__goods-list--hidden">
          <li class="link-list__item"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/1.jpg" alt=""></a></li>
          <li class="link-list__item"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/2.jpg" alt=""></a></li>
          <li class="link-list__item"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/3.jpg" alt=""></a></li>
          <li class="link-list__item"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/4.jpg" alt=""></a></li>
          <li class="link-list__item"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/5.jpg" alt=""></a></li>
          <li class="link-list__item"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/6.jpg" alt=""></a></li>
          <li class="link-list__item"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/7.jpg" alt=""></a></li>
          <li class="link-list__item"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/8.jpg" alt=""></a></li>
        </ul>
        <ul class="tabs-section__goods-list link-list tabs-section__goods-list--hidden">
          <li class="link-list__item"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/1.jpg" alt=""></a></li>
          <li class="link-list__item"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/2.jpg" alt=""></a></li>
          <li class="link-list__item"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/3.jpg" alt=""></a></li>
          <li class="link-list__item"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/4.jpg" alt=""></a></li>
          <li class="link-list__item"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/5.jpg" alt=""></a></li>
          <li class="link-list__item"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/6.jpg" alt=""></a></li>
          <li class="link-list__item"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/7.jpg" alt=""></a></li>
          <li class="link-list__item"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/8.jpg" alt=""></a></li>
        </ul>
        <a class="tabs-section__more-link" href="#">Показать больше</a>
      </div>
    </section>
    <section class="page-main__section page-main__section--hit hit-section">
      <div class="hit-section__wrapper">
        <h2 class="hit-section__title">Хит сезона - <span class="hit-section__free">бесплатно!</span></h2>
        <div class="hit-section__info">
          <p class="hit-section__text">Закажите на сумму от 1000 руб.<br class="hit-section__br">и получите дизайнерский набор стикеров для ноутбука.</p>
          <div class="hit-section__img-wrapper">
            <picture>
              <source media="(min-width: 1200px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/img/laptop1920.png">
              <source media="(min-width: 768px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/img/(1).png">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/noutbuk.png" alt="Ноутбук" width="514" height="377">
            </picture>
          </div>
          <p class="hit-section__sub-text">Акция действует до 1 апреля 2021 года.</p>
          <a href="#" class="hit-section__catalog-link">В каталог</a>
        </div>
      </div>
    </section>
    <section class="page-main__section page-main__section--articles articles-section">
      <div class="articles-section__wrapper">
        <h2 class="articles-section__title">Это может вам пригодиться</h2>
        <ul class="articles-section__goods-list link-list">
          <li class="link-list__item"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/previu-kalendari.jpg" width="264" height="342" alt="календари"> Как скрыть дефекты неровной стены?</a></li>
          <li class="link-list__item"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/previu-raskraski.jpg" width="264" height="342" alt="раскраски"> 5 дизайнерских идей для спальни</a></li>
          <li class="link-list__item"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/rectangle-230.jpg" width="264" height="342" alt="календари"> Как приклеить и снять стикер?</a></li>
          <li class="link-list__item"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/rectangle-231.jpg" width="264" height="342" alt="календари"> ТОП 10 учебных постеров для школьников</a></li>
        </ul>
        <a href="#" class="articles-section__link">ещё статьи</a>
      </div>
    </section>
    <section class="page-main__section page-main__section--about-us about-us">
      <div class="about-us__wrapper">
        <h2 class="about-us__title">Интернет-магазин Woozzee — отличное качество по лучшей цене!</h2>
        <p class="about-us__text">Долой скучные однотонные поверхности! Оживите интерьер красочным декором. Создайте уютное пространство для себя и всей семьи: больше не надо возиться с обоями и рисовать узоры кисточкой. Достаточно наклеить большую красивую наклейку - она отлично смотрится, не боится времени и котиков с когтями. Если через год надоест — спокойно удалите, не отдирая краску или обои от стены.<br><br>Или вам нужен плакат? Мы тщательно выбираем для нашго каталога самые лучшие и стильные плакаты и постеры с максимальной детализацией. Лёгкий для восприятия шрифт, качественные краски и высокая детализация — мы знаем толк в визуализации, пусть наши знания вам послужат!<br><br>Даже если вам нужен обычный стикер для товара, закажите у нас — и сам Артемий Лебедев, когда зайдёт к вам в магазин, будет изумлённо спрашивать, где вы взяли такие крутые наклейки.<br><br>Картины, календари, таблички, открытки, фотообои, раскраски — у нас есть всё, на чём можно нарисовать классный визуал!</p>
        <button class="about-us__text-toggler">Читать полностью</button>
        <ul class="about-us__list">
          <li class="about-us__item">
            <h3 class="about-us__item-title">Доставим куда угодно</h3>
            <p class="about-us__item-text">От Москвы до Антарктиды</p>
          </li>
          <li class="about-us__item">
            <h3 class="about-us__item-title">Передумали?</h3>
            <p class="about-us__item-text">Возврат до 14 дней с момента покупки</p>
          </li>
          <li class="about-us__item">
            <h3 class="about-us__item-title">Ваши деньги никто не перехватит!</h3>
            <p class="about-us__item-text">Безопасные платежи с SSL-шифрованием</p>
          </li>
          <li class="about-us__item">
            <h3 class="about-us__item-title">Отвечаем за качество</h3>
            <p class="about-us__item-text">Собственное производство на европейском оборудовании</p>
          </li>
          <li class="about-us__item">
            <h3 class="about-us__item-title">Заботимся о здоровье</h3>
            <p class="about-us__item-text">Нет испарений и запахов. Материалы соответсвуют международным экостандартам</p>
          </li>
        </ul>
      </div>
    </section>
    <section class="page-main__section page-main__section--contact contact-section">
      <div class="contact-section__wrapper">
        <h2 class="contact-section__title">Остались вопросы? Напишите нам:</h2>
        <form action="" class="contact-section__form">
          <div class="contact-section__input-wrapper"><input class="contact-section__input" type="text" name="name" placeholder="Ваше имя"> <input class="contact-section__input" type="email" name="email" placeholder="Ваш e-mail"> <input class="contact-section__input" type="tel" name="tel" placeholder="Ваш телефон"> <textarea class="contact-section__input contact-section__input--textarea" placeholder="Ваше сообщение" name="message" id="" cols="30" rows="10"></textarea></div>
          <button class="contact-section__submit-button" type="submit">Отправить</button>
        </form>
        <p class="contact-section__text">Нажимая на кнопку, вы даете согласие<br>на обработку персональных данных<br>и соглашаетесь c политикой<br>конфиденциальности</p>
        <p class="contact-section__subtext">С любовью, Woozzee</p>
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
