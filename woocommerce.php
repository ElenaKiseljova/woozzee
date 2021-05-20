<?php
  get_header(  );
?>

<?php if ( is_shop() || is_product_category() || is_search() || is_product_tag() ): ?>
  <main class="page-main page-main--catalog-page">
    <?php 
      global $wp_query;
      
      $cat = $wp_query->get_queried_object();
      $termID = $cat->term_id; //динамическое получение ID текущей рубрики
      $taxonomyName = 'product_cat';
      $termchildren = get_term_children( $termID, $taxonomyName );
      
      $sufix_page = 'category';
      
      if ( (count($termchildren) > 0) || is_shop() || is_search() ) {
        $sufix_page = 'shop';
      }
    ?>
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
        
        <?php if ( ((count($termchildren) == 0) && is_product_category()) || is_product_tag() ) : ?>
          <section class="page-section__popular-queries popular-queries">
            <div class="popular-queries__wrapper">
              <?php   
                $title_flag_category = true;
                
                $cat_object = $cat;
                
                $catalog_popularity_toggle = get_field( 'catalog_popularity_toggle', $cat_object );
                
                if (empty($catalog_popularity_toggle)) {
                  $title_flag_category = false;
                  
                  $catalog_page_id = get_option( 'woocommerce_shop_page_id' );
                  
                  if (!$catalog_page_id) {
                    $catalog_page_id = 24;
                  }
                  
                  $cat_object = $catalog_page_id;
                  
                  $catalog_popularity_toggle = get_field( 'catalog_popularity_toggle', $cat_object );
                }
              ?>
              
              <?php if (!empty($catalog_popularity_toggle) && $catalog_popularity_toggle == 'Да'): ?>
                <h2 class="popular-queries__title popular-queries__title--<?= $sufix_page; ?>">
                  <?php the_field( 'catalog_popularity_title', $cat_object ); ?>
                  <?php if ($title_flag_category): ?>
                    <b style="text-transform: lowercase;">
                      раздела <?= $cat->name; ?>:
                    </b>
                  <?php endif; ?>
                </h2>
                
                <?php 
                  $catalog_popularity_tags = get_field( 'catalog_popularity_tags', $cat_object );
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
            </div>
          </section>
          
          <section class="page-section__sorting sorting-section">
            <div class="sorting-section__wrapper">
              <?php 
                /**
                 * Hook: woozzee_catalog_sort.
                 *
                 * @hooked woozzee_catalog_sort_list - 5
                 * @hooked woocommerce_pagination - 10
                 * 
                 * 
                 */
                 
                 do_action( 'woozzee_catalog_sort' );
              ?>
              <div class="sorting-section__cards-amount">
                <?php 
                  /**
                   * Hook: woozzee_catalog_sort_after.
                   *
                   * @hooked woocommerce_result_count - 5
                   * @hooked amount_products_on_page - 10
                   * 
                   */
                   
                   do_action( 'woozzee_catalog_sort_after' );
                ?>                
              </div>
            </div>
          </section>
      
          <section class="page-main__section list-section">
            <div class="list-section__wrapper">
              <?php
                woocommerce_content();
              ?>
            </div>
          </section>
        <?php endif; ?>
      </div>
    </section> 
    
    <?php if ( (count($termchildren) > 0) || is_shop() || is_search() ): ?>
      <section class="page-section__popular-queries popular-queries">
        <div class="popular-queries__wrapper">
          <?php   
            $title_flag_category = true;
            
            $cat_object = $cat;
            
            $catalog_popularity_toggle = get_field( 'catalog_popularity_toggle', $cat_object );
            
            if (empty($catalog_popularity_toggle)) {
              $title_flag_category = false;
              
              $catalog_page_id = get_option( 'woocommerce_shop_page_id' );
              
              if (!$catalog_page_id) {
                $catalog_page_id = 24;
              }
              
              $cat_object = $catalog_page_id;
              
              $catalog_popularity_toggle = get_field( 'catalog_popularity_toggle', $cat_object );
            }
          ?>
          
          <?php if (!empty($catalog_popularity_toggle) && $catalog_popularity_toggle == 'Да'): ?>
            <h2 class="popular-queries__title popular-queries__title--<?= $sufix_page; ?>">
              <?php the_field( 'catalog_popularity_title', $cat_object ); ?>
              <?php if ($title_flag_category): ?>
                <b style="text-transform: lowercase;">
                  раздела <?= $cat->name; ?>:
                </b>
              <?php endif; ?>
            </h2>
            
            <?php 
              $catalog_popularity_tags = get_field( 'catalog_popularity_tags', $cat_object );
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
        </div>
      </section>
      
      <section class="page-section__sorting sorting-section">
        <div class="sorting-section__wrapper">
          <?php 
            /**
             * Hook: woozzee_catalog_sort.
             *
             * @hooked woozzee_catalog_sort_list - 5
             * @hooked woocommerce_pagination - 10
             * 
             * 
             */
             
             do_action( 'woozzee_catalog_sort' );
          ?>
          <div class="sorting-section__cards-amount">
            <?php 
              /**
               * Hook: woozzee_catalog_sort_after.
               *
               * @hooked woocommerce_result_count - 5
               * @hooked amount_products_on_page - 10
               * 
               */
               
               do_action( 'woozzee_catalog_sort_after' );
            ?>
          </div>
        </div>
      </section>
  
      <section class="page-main__section list-section">
        <div class="list-section__wrapper">
          <?php
            woocommerce_content();
          ?>
        </div>
      </section>
    <?php endif; ?>   
    
    <?php if ( ((count($termchildren) == 0) && is_product_category()) || is_product_tag() ): ?>
      <?php 
        /**
         * Hook: woozzee_tablet_pagination.
         *
         * @hooked woocommerce_pagination - 5
         * 
         * 
         */
         
         do_action( 'woozzee_tablet_pagination' );
      ?>
    <?php endif; ?> 
    
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
                  
                  get_template_part( 'template-parts/content', 'post' );
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
<?php elseif ( is_singular( $post_types = 'product' ) ) : ?>

  <main class="page-main page-main--product">   
    <?php 
      if ( function_exists( 'woozzee_yoast_breadcrumbs' ) ) {
        $class_breadcrumbs = 'breadcrumbs';
        
        woozzee_yoast_breadcrumbs($class_breadcrumbs);
      }
    ?>
    
    <?php
      woocommerce_content();
    ?> 
  </main>

<?php endif; ?>
<?php
  get_footer(  );
?>
