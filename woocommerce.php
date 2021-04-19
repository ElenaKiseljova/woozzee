<?php
  get_header(  );
?>

<?php if ( is_shop() || is_product_category() || is_search() || is_product_tag() ): ?>
<main class="page-main page-main--catalog-page">
  <section class="page-main__section catalog-section">
    <div class="catalog-section__wrapper">
      
      <?php 
        /**
         * Hook: woozzee_header_catalog.
         *
         * @hooked woozzee_catalog_title - 5
         * @hooked woozzee_catalog_category_list - 6
         * @hooked woozzee_catalog_breadcrumbs - 7
         * @hooked woozzee_catalog_description - 10
         * @hooked woozzee_catalog_banner - 20
         * @hooked woo_show_subcategory - 30
         * 
         * 
         */
         
         do_action( 'woozzee_header_catalog' );
      ?>
    </div>
  </section> 
  <section class="page-section__popular-queries popular-queries">
    <div class="popular-queries__wrapper">
      <?php 
        $catalog_page_id = get_option( 'woocommerce_shop_page_id' );
        
        if (!$catalog_page_id) {
          $catalog_page_id = 24;
        }
      
        $catalog_popularity_toggle = get_field( 'catalog_popularity_toggle', $catalog_page_id );
      ?>
      
      <?php if (!empty($catalog_popularity_toggle) && $catalog_popularity_toggle == 'Да'): ?>
        <h2 class="popular-queries__title">
          <?php the_field( 'catalog_popularity_title', $catalog_page_id ); ?>
        </h2>
        
        <?php 
          $catalog_popularity_tags = get_field( 'catalog_popularity_tags', $catalog_page_id );
        ?>
        
        <?php if (!empty($catalog_popularity_tags) && is_array($catalog_popularity_tags)): ?>
          <ul class="popular-queries__list">
            <?php foreach ($catalog_popularity_tags as $catalog_popularity_tag): ?>
              <li class="popular-queries__item">
                <svg>
                  <use xlink:href="#border"></use>
                </svg>
                <a href="<?php echo get_term_link($catalog_popularity_tag->slug, 'product_tag'); ?>">
                  <?= $catalog_popularity_tag->name; ?>
                </a>
              </li>
            <?php endforeach; ?>            
          </ul>
        <?php endif; ?>        
      <?php endif; ?>
      
      <?php echo do_shortcode( '[wpf-filters id=1]' ); ?>
      <!-- 
      <h2 class="popular-queries__title popular-queries__title--color">По цвету:</h2>
      <ul class="popular-queries__color-list">
        <li class="popular-queries__color-item popular-queries__color-item--white">
          <a href="#"><span class="popular-queries__color-name">Белый</span></a>
        </li>
        <li class="popular-queries__color-item popular-queries__color-item--black">
          <a href="#"><span class="popular-queries__color-name">Черный</span></a>
        </li>
        <li class="popular-queries__color-item popular-queries__color-item--gray">
          <a href="#"><span class="popular-queries__color-name">Серый</span></a>
        </li>
        <li class="popular-queries__color-item popular-queries__color-item--red">
          <a href="#"><span class="popular-queries__color-name">Красный</span></a>
        </li>
        <li class="popular-queries__color-item popular-queries__color-item--yellow">
          <a href="#"><span class="popular-queries__color-name">Желтый</span></a>
        </li>
        <li class="popular-queries__color-item popular-queries__color-item--gold">
          <a href="#"><span class="popular-queries__color-name">Золотой</span></a>
        </li>
        <li class="popular-queries__color-item popular-queries__color-item--blue">
          <a href="#"><span class="popular-queries__color-name">Синий</span></a>
        </li>
        <li class="popular-queries__color-item popular-queries__color-item--orange">
          <a href="#"><span class="popular-queries__color-name">Оранжевый</span></a>
        </li>
        <li class="popular-queries__color-item popular-queries__color-item--green">
          <a href="#"><span class="popular-queries__color-name">Зеленый</span></a>
        </li>
        <li class="popular-queries__color-item popular-queries__color-item--purple">
          <a href="#"><span class="popular-queries__color-name">Фиолетовый</span></a>
        </li>
        <li class="popular-queries__color-item popular-queries__color-item--pink">
          <a href="#"><span class="popular-queries__color-name">Розовый</span></a>
        </li>
        <li class="popular-queries__color-item popular-queries__color-item--brown">
          <a href="#"><span class="popular-queries__color-name">Коричневый</span></a>
        </li>
      </ul>-->
    </div>
  </section>
  <section class="page-section__sorting sorting-section">
    <div class="sorting-section__wrapper">
      <h2 class="sorting-section__title">Сортировать по:</h2>
      
      <?php 
        /**
         * Hook: woozzee_catalog_sort.
         *
         * @hooked woozzee_catalog_sort_list - 20
         * 
         * 
         */
         
         do_action( 'woozzee_catalog_sort' );
      ?>
      <!--
      <ul class="sorting-section__sort-by">
        <li class="sorting-section__item sorting-section__item--current">
          <a href="">Цене</a>
        </li>
        <li class="sorting-section__item">
          <a href="">Размеру скидки</a>
        </li>
        <li class="sorting-section__item">
          <a href="">Популярности</a>
        </li>
      </ul>
      -->
      <ul class="pagination">
        <li class="pagination__item pagination__item--current"><a href="#">1</a></li>
        <li class="pagination__item"><a href="#">2</a></li>
        <li class="pagination__item"><a href="#">3</a></li>
        <li class="pagination__item"><a href="#">3</a></li>
        <li class="pagination__item"><a href="#">3</a></li>
        <li class="pagination__item"><a href="#">3</a></li>
        <li class="pagination__item"><a href="#">...</a></li>
        <li class="pagination__item"><a href="#">99</a></li>
      </ul>
      <form action="/" class="sorting-section__cards-amount">
        <p class="sorting-section__cards-range">
          Показано с 1 по 28 из 13872
        </p>
        <button type="submit">Показать</button>
        <ul class="sorting-section__amount-list">
          <li class="sorting-section__amount-item">
            <input class="visually-hidden" type="radio" name="cards-amount" value="28" id="28" checked>
            <label for="28">
            28
            </label>
          </li>
          <li class="sorting-section__amount-item">
            <input class="visually-hidden" type="radio" name="cards-amount" value="50" id="50">
            <label for="50">
            50
            </label>
          </li>
          <li class="sorting-section__amount-item">
            <input class="visually-hidden" type="radio" name="cards-amount" value="100" id="100">
            <label for="100">
            100
            </label>
          </li>
        </ul>
      </form>
    </div>
  </section>

  <section class="page-main__section list-section">
    <div class="list-section__wrapper">
      <?php
        woocommerce_content();
      ?>
      <!-- 
      <ul class="catalog-section__goods-list link-list link-list--popover">
        <li class="link-list__item">
          <article class="link-list__article good-article">
            <ul class="good-article__img-list">
              <li class="good-article__img-item">
                <img src="img/previu-1.png" width="80" height="100" alt="qweqwe">
              </li>
              <li class="good-article__img-item">
                <img src="img/previu-2.png" width="80" height="100" alt="qweqwe">
              </li>
              <li class="good-article__img-item">
                <img src="img/previu-3.png" width="80" height="100" alt="qweqwe">
              </li>
            </ul>
            <a href="#" class="good-article__img-wrapper">
            <img src="img/previu-kalendari.jpg" width="264" height="342" alt="календари">
            <span class="good-article__new">New</span>
            </a>
            <div class="good-article__info-wrapper">
              <h3 class="good-article__title"><a href="#">Наименование товара</a></h3>
              <a href="#" class="good-article__price">XXX руб.</a>
              <button class="good-article__cart" type="button">
                <svg class="button-icon__icon button-icon__icon--mobile" width="20" height="20">
                  <use xlink:href="img/sprite.svg#Basket_fill">
                </svg>
                <span>В корзину</span>
              </button>
              <button class="good-article__favorite" type="button">
                <svg class="button-icon__icon button-icon__icon--mobile" width="20" height="20">
                  <use xlink:href="img/sprite.svg#Favorite">
                </svg>
                <span>Добавить в избранное</span>
              </button>
              <button class="good-article__close" type="button"><span class="visually-hidden">Закрыть</span></button>
            </div>
          </article>
        </li> 
      </ul>
      <ul class="list-section__pag pagination">
        <li class="pagination__item pagination__item--current"><a href="#">1</a></li>
        <li class="pagination__item"><a href="#">2</a></li>
        <li class="pagination__item"><a href="#">3</a></li>
        <li class="pagination__item"><a href="#">...</a></li>
        <li class="pagination__item"><a href="#">99</a></li>
      </ul>
      -->
    </div>
  </section>
  
  <?php 
    $catalog_page_id = get_option( 'woocommerce_shop_page_id' );
    
    if (!$catalog_page_id) {
      $catalog_page_id = 24;
    }
    
    $blog_toggle = get_field( 'blog_toggle', $catalog_page_id );
  ?>
  
  <?php if (!empty($blog_toggle) && $blog_toggle == 'Да'): ?>
    <section class="page-main__section page-main__section--articles articles-section">
      <div class="articles-section__wrapper">
        <h2 class="articles-section__title">
          <?php the_field( 'blog_title', $catalog_page_id ) ?>
        </h2>
        
        <ul class="articles-section__goods-list link-list">
          <?php 
            $blog_count = get_field( 'blog_count', $catalog_page_id );
            
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
</main>
<?php endif; ?>

<?php
  get_footer(  );
?>
