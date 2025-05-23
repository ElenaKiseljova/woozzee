<?php
  /* woozzee */
  add_action('wp_enqueue_scripts', 'woozzee_styles', 3);
  add_action('wp_enqueue_scripts', 'woozzee_scripts', 5);

  add_action( 'after_setup_theme', 'after_setup_theme_function' );

  if (!function_exists('after_setup_theme_function')) :
    function after_setup_theme_function () {
      load_theme_textdomain('woozzee', get_template_directory() . '/languages');

      register_nav_menu( 'top_menu', 'Навигация в шапке сайта' );
      
      register_nav_menu( 'bottom_menu_left', 'Навигация в подвале сайта ( левый столбец )' );
      register_nav_menu( 'bottom_menu_right', 'Навигация в подвале сайта ( правый столбец )' );
      
      register_nav_menu( 'categories_sidebar_menu', 'Список категорий для отображения в боковой панели слева в Каталоге и на Главной' );
      register_nav_menu( 'categories_cards_menu', 'Список категорий для отображения в карточках на Главной' );
      register_nav_menu( 'categories_cyan_menu', 'Список категорий для отображения под бирюзовым слайдером на Главной' );
      
      // WooCommerce support.
      add_theme_support('woocommerce');

      add_theme_support('html5', array('search-form'));

      add_theme_support( 'post-thumbnails' );
    }
  endif;
  
  
  // Customizer
  
  function woozzee_customizer ( $wp_customize ) {
    /* Create Panel Header */
    
    $wp_customize->add_panel('header_panel', array(
      'priority' => 50,
      'theme_supports' => '',
      'title' => __('Хедер', 'woozzee'),
      'description' => __('Элементы в Шапке сайта', 'woozzee'),
    ));
    
    /* Create Sections for Panel Header */
    
    $wp_customize->add_section('header_logo_mobile', array(
      'panel' => 'header_panel',
      'type' => 'theme_mod', 
      'priority' => 5,
      'theme_supports' => '',
      'title' => __('Логотип (мобильный)', 'woozzee'),
      'description' => __('Логотип для отображения на устройствах с шириной экрана <1024px', 'woozzee'),
    ));
    
    $wp_customize->add_section('header_logo_desktop', array(
      'panel' => 'header_panel',
      'type' => 'theme_mod', 
      'priority' => 10,
      'theme_supports' => '',
      'title' => __('Логотип (десктоп)', 'woozzee'),
      'description' => __('Логотип для отображения на устройствах с шириной экрана >1024px', 'woozzee'),
    ));
    
    /* Create Settings for Panel Header */
    
    $wp_customize->add_setting('header_logo_mobile_settings', array(
      'default'    =>  '',
			'transport'  =>  'refresh',
    ));
    
    $wp_customize->add_setting('header_logo_desktop_settings', array(
      'default'    =>  '',
			'transport'  =>  'refresh',
    ));
    
    /* Create Controls for Panel Header */
    
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'header_logo_mobile_image', array(
        'label'    => __('Изображение логотипа', 'woozzee'),
        'section'  => 'header_logo_mobile',
        'settings' => 'header_logo_mobile_settings',
    )));
    
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'header_logo_desktop_image', array(
        'label'    => __('Изображение логотипа', 'woozzee'),
        'section'  => 'header_logo_desktop',
        'settings' => 'header_logo_desktop_settings',
    )));
    
    /* Create Panel Footer */
    
    $wp_customize->add_panel('footer_panel', array(
      'priority' => 51,
      'theme_supports' => '',
      'title' => __('Футер', 'woozzee'),
      'description' => __('Элементы в Подвале сайта', 'woozzee'),
    ));
    
    /* Create Sections for Panel Footer */
    
    $wp_customize->add_section('footer_privacy', array(
      'panel' => 'footer_panel',
      'type' => 'theme_mod', 
      'priority' => 5,
      'theme_supports' => '',
      'title' => __('Пользовательское соглашение', 'woozzee'),
      'description' => __('Ссылка и заголовок для Пользовательского соглашения', 'woozzee'),
    ));
    
    $wp_customize->add_section('footer_document', array(
      'panel' => 'footer_panel',
      'type' => 'theme_mod', 
      'priority' => 5,
      'theme_supports' => '',
      'title' => __('Договор публичной оферты', 'woozzee'),
      'description' => __('Ссылка и заголовок для Договора публичной оферты', 'woozzee'),
    ));
    
    /* Create Settings for Panel Footer */
    
    $wp_customize->add_setting('footer_privacy_text', array(
      'default'    =>  '',
			'transport'  =>  'postMessage',
    ));
    
    $wp_customize->add_setting('footer_privacy_link', array(
      'default'    =>  '',
			'transport'  =>  'refresh',
    ));
    
    $wp_customize->add_setting('footer_document_text', array(
      'default'    =>  '',
			'transport'  =>  'postMessage',
    ));
    
    $wp_customize->add_setting('footer_document_link', array(
      'default'    =>  '',
			'transport'  =>  'refresh',
    ));
    
    /* Create Controls for Panel Footer */
    
    $wp_customize->add_control('footer_privacy_title', array(
        'label'      => __('Заголовок', 'woozzee'),
        'section'    => 'footer_privacy',
        'settings'   => 'footer_privacy_text',
    ));
    
    $wp_customize->add_control('footer_privacy_url', array(
        'label'      => __('Ссылка на страницу', 'woozzee'),
        'type' => 'url',
        'section'    => 'footer_privacy',
        'settings'   => 'footer_privacy_link',
    ));
    
    $wp_customize->add_control('footer_document_title', array(
        'label'      => __('Заголовок', 'woozzee'),
        'section'    => 'footer_document',
        'settings'   => 'footer_document_text',
    ));
    
    $wp_customize->add_control('footer_document_url', array(
        'label'      => __('Ссылка на страницу', 'woozzee'),
        'type' => 'url',
        'section'    => 'footer_document',
        'settings'   => 'footer_document_link',
    ));
  }
  
  add_action( 'customize_register', 'woozzee_customizer' );
  
  // Изменeние стандартного вывода пунктов меню
  
  add_filter( 'nav_menu_item_args', 'change_menu_item_args', 10, 3 );
  
  function change_menu_item_args( $args, $item, $depth ) {
  	if ( $args->theme_location == 'top_menu' ) {
      if ( ($item->post_title === 'Каталог') || ($item->title === 'Каталог') || ($item->url === wc_get_page_permalink( 'shop' )) ) {
        $args->before = '<svg width="24" height="24">
          <use xlink:href="' . get_template_directory_uri() . '/assets/img/sprite.svg#grid"></use>
        </svg>';
      } else if ( ($item->post_title === 'О нас') || ($item->title === 'О нас') || ($item->object_id === 6) ) {
          $args->before = '<svg width="24" height="24">
            <use xlink:href="' . get_template_directory_uri() . '/assets/img/sprite.svg#people"></use>
          </svg>';
      } else if ( ($item->post_title === 'Оплата и доставка') || ($item->title === 'Оплата и доставка') ) {
          $args->before = '<svg width="24" height="24">
            <use xlink:href="' . get_template_directory_uri() . '/assets/img/sprite.svg#transport"></use>
          </svg>';
      } else if ( ($item->post_title === 'Советы и лайфхаки') || ($item->title === 'Советы и лайфхаки') || ($item->url === get_post_type_archive_link( 'post' )) ) {
          $args->before = '<svg width="24" height="24">
            <use xlink:href="' . get_template_directory_uri() . '/assets/img/sprite.svg#lightbulb"></use>
          </svg>';
      } else if ( ($item->post_title === 'Эксклюзив') || ($item->title === 'Эксклюзив') || ($item->object_id === 473) ) {
          $args->before = '<svg width="24" height="24">
            <use xlink:href="' . get_template_directory_uri() . '/assets/img/sprite.svg#extension"></use>
          </svg>';
      } else if ( ($item->post_title === 'Юридическим лицам') || ($item->title === 'Юридическим лицам') || ($item->object_id === 475) ) {
          $args->before = '<svg width="24" height="24">
            <use xlink:href="' . get_template_directory_uri() . '/assets/img/sprite.svg#support"></use>
          </svg>';
      } else if ( ($item->post_title === 'Контакты') || ($item->title === 'Контакты') || ($item->object_id === 7) ) {
          $args->before = '<svg width="24" height="24">
            <use xlink:href="' . get_template_directory_uri() . '/assets/img/sprite.svg#envelope-alt"></use>
          </svg>';
      } else {
        $args->before = '';
      }	
  	}
    
    if ( $args->theme_location == 'categories_sidebar_menu' ) {
      if ($depth == 0) {
        $args->before = '<div class="catalog-section__button catalog-section__button--closed">';
        $args->after = '<button class="catalog-section__button-element">
                            <span class="visually-hidden">Меню</span>
                         </button>
                       </div>';
      } else if ($depth == 1) {
        $args->before = '';
        $args->after = '';
      }
    }
  	return $args;
  }
  
  // Изменение класса пунктов меню
  
  add_filter( 'nav_menu_css_class', 'add_my_class_to_nav_menu', 10, 4 );
  
  function add_my_class_to_nav_menu( $classes, $item, $args, $depth ) {
  	/* $classes содержит
  	Array(
  		[1] => menu-item
  		[2] => menu-item-type-post_type
  		[3] => menu-item-object-page
  		[4] => menu-item-284
  	)
  	*/
    //nav-sublist__item
    if (($args->theme_location == 'top_menu') && (($depth % 2) == 0)) {
      foreach ( $classes as $key => $class ) {
    		if ( $class == 'menu-item' ) {
    			$classes[ $key ] = 'header-nav__item';
    		} else if ( ($class == 'current-menu-item') || ($class == 'current_page_item') ) {
    			$classes[ $key ] = 'header-nav__item--active';
    		} else if ( $class == 'menu-item-has-children' ) {
    			$classes[ $key ] = 'header-nav__item--sublist header-nav__item--arrow';
    		} else if ( $class == 'menu-item-463' ) {
          $classes[ $key ] = 'header-nav__item--catalog';
        } else {
          $classes[ $key ] = '';
        }
    	}
    } else if (($args->theme_location == 'top_menu') && (($depth % 2) > 0)) {
      foreach ( $classes as $key => $class ) {
    		if ( $class == 'menu-item' ) {
    			$classes[ $key ] = 'nav-sublist__item';
    		} else if ( ($class == 'current-menu-item') || ($class == 'current_page_item') ) {
    			$classes[ $key ] = 'nav-sublist__item--current';
    		} else if ($class == 'menu-item-has-children') {
          $classes[ $key ] = 'nav-sublist__item--arrow';
        } else {
          $classes[ $key ] = '';
        }
    	}
    }    
    
    if (($args->theme_location == 'bottom_menu_left') || ($args->theme_location == 'bottom_menu_right')) {
      foreach ( $classes as $key => $class ) {
    		if ( $class == 'menu-item' ) {
    			$classes[ $key ] = 'page-footer__list-item';
    		} else {
          $classes[ $key ] = '';
        }
    	}
    }
    
    if (($args->theme_location == 'categories_sidebar_menu')) {
      foreach ( $classes as $key => $class ) {
    		if ( $class == 'menu-item' ) {
          if ($depth == 0) {
            $classes[ $key ] = 'catalog-section__menu-item';
          } else {
            $classes[ $key ] = 'catalog-section__item catalog-section__item--sublist';
          }    			
    		} else if ($class == 'menu-item-has-children') {
          if ($depth == 0) {
            $classes[ $key ] = 'catalog-section__menu-item-has-children';
          } else {
            $classes[ $key ] = 'catalog-section__item catalog-section__item--sublist catalog-section__item--arrow';
          }           
        } else {
          $classes[ $key ] = '';
        }
    	}
    }
  	return $classes;
  }

  // Изменение класса подменю
  
  add_filter( 'nav_menu_submenu_css_class', 'filter_nav_menu_submenu_css_class', 10, 3 );
  
  function filter_nav_menu_submenu_css_class ( $classes, $args, $depth ) {
    if ($args->theme_location == 'top_menu') {
      foreach ( $classes as $key => $class ) {      
    		if ( ($class == 'sub-menu') && (($depth % 2) == 0) ) {
          $classes[ $key ] = 'nav-sublist nav-sublist--catalog';  			
    		} else {
          $classes[ $key ] = 'header-nav__list';
        }
    	}
    }
    
    if ($args->theme_location == 'categories_sidebar_menu') {
      foreach ( $classes as $key => $class ) {      
    		if ( $class == 'sub-menu' ) {
          $classes[ $key ] = 'catalog-section__sublist';  			
    		} else {
          $classes[ $key ] = '';
        }
    	}
    }
    
  	return $classes;
  }

  // Styles theme

  function woozzee_styles () {
    wp_enqueue_style('woozzee-style', get_stylesheet_uri());
    //wp_enqueue_style('swiper-style', get_template_directory_uri() . '/assets/libs/swiper.min.css');
  }

  // Scripts theme

  function woozzee_scripts () {
    wp_deregister_script( 'jquery' );
  	wp_register_script( 'jquery', get_template_directory_uri() . '/assets/js/vendor/jquery-3.6.0.min.js', $ver = false, $in_footer = true);
  	wp_enqueue_script( 'jquery' );
    
    wp_enqueue_script( 'mask-script', get_template_directory_uri() . '/assets/js/vendor/jquery.inputmask.bundle.js', $deps = array('jquery'), $ver = false, $in_footer = true );
    wp_enqueue_script('swiper-script', get_template_directory_uri() . '/assets/js/vendor/swiper-bundle.min.js', $deps = array(), $ver = null, $in_footer = true );
    wp_enqueue_script('woozzee-script', get_template_directory_uri() . '/assets/js/script.min.js', $deps = array('jquery'), $ver = null, $in_footer = true );
    wp_enqueue_script('popup-script', get_template_directory_uri() . '/assets/js/popup.js', $deps = array(), $ver = null, $in_footer = true );  
    wp_enqueue_script('animation-anchor-script', get_template_directory_uri() . '/assets/js/animation-anchor.js', $deps = array(), $ver = null, $in_footer = true );
    wp_enqueue_script('shop-per-page-script', get_template_directory_uri() . '/assets/js/shop-per-page.js', $deps = array(), $ver = null, $in_footer = true );
    wp_enqueue_script('color-filter-script', get_template_directory_uri() . '/assets/js/color-filter.js', $deps = array(), $ver = null, $in_footer = true );
    
    if (is_singular( 'product' )) {
      wp_enqueue_script('final-price-script', get_template_directory_uri() . '/assets/js/final-price.js', $deps = array(), $ver = null, $in_footer = true );
    }

    wp_enqueue_script('timer-script', get_template_directory_uri() . '/assets/js/timer.js', $deps = array('jquery'), $ver = null, $in_footer = true );
    wp_enqueue_script('coupon-script', get_template_directory_uri() . '/assets/js/coupon.js', $deps = array('jquery'), $ver = null, $in_footer = true );
    
    wp_enqueue_script('loadmore-script', get_template_directory_uri() . '/assets/js/loadmore.js', $deps = array('jquery'), $ver = null, $in_footer = true );
    
    wp_enqueue_script('customizer-script', get_template_directory_uri() . '/assets/js/customizer-scripts.js', $deps = array('jquery', 'customize-preview'), $ver = null, $in_footer = true );

    $args = array();

    $args['url'] = admin_url('admin-ajax.php');
    /*
    if (class_exists('WooCommerce')) {
      $args['nonce'] = wp_create_nonce('woozzee');
    }*/

    wp_localize_script( 'coupon-script', 'woozzee_ajax', $args);
  }
    
  // Вункция для Хлебных крошек
  
  function woozzee_yoast_breadcrumbs ($class_list) {
    get_template_part( 'template-parts/yoast', 'breadcrumbs' );
  }  
  
  // Если Вукомерс
  
  if (class_exists('WooCommerce')) {
    // Генератор ПИН
    
    function generatePIN($digits = 4){
      $i = 0; //counter
      $pin = ""; //our default pin is blank.
      while($i < $digits){
          //generate a random number between 0 and 9.
          $pin .= mt_rand(0, 9);
          $i++;
      }
      return $pin;
    }    
    
    // Переопределяю шаблон формы поиска

    add_filter('get_search_form', 'new_search_form');

    function new_search_form($form) {
    	$form = '
        <form class="page-header__search" action="' . home_url( '/' ) . '" method="get" role="search" >
          <input autocomplete="off" type="text" name="s" value="' . get_search_query() . '" id="s" placeholder="Поиск...">
          
          <button type="submit" name="search-btn">
            <svg width="17" height="16">
              <use xlink:href="' . get_template_directory_uri() . '/assets/img/sprite.svg#Search_alt"></use>
            </svg>
            <span class="visually-hidden">Поиск</span>
          </button>
          <input type="hidden" name="post_type" value="product" />
        </form>
    	';
    	return $form;
    }
    
    // Загрузить ещё (функция-обработчик запроса)

    function load_more () {
    	$args = unserialize( stripslashes( $_POST['query'] ) );

      $paged = $_POST['page'] + 1; // следующая страница
    	$args['paged'] = $paged;

      if ($args[ 'post_type' ] == 'product') {
        $id_category = $_POST['id_category'];

        if (isset($_POST['id_category'])) {
          $args['tax_query'] = array (
              array (
                'taxonomy' => 'product_cat',
                'field'    => 'term_id',
                'terms'    => array( $id_category ),
                'include_children' => true
              ),
          );
          
          $args['meta_query'] = array(
            array(
              'key' => '_thumbnail_id',
              'compare' => 'EXISTS'
            )
          );
        }
      }

      // обычно лучше использовать WP_Query, но не здесь
      query_posts( $args );

    	// если посты есть
    	if( have_posts() ) :

    		// запускаем цикл
        while( have_posts() ):
          the_post();
          if ($args[ 'post_type' ] == 'product') {
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
        endwhile;
    	endif;

      wp_reset_postdata();

    	die();
    }
        
    // Символ валюты

    add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);

    function change_existing_currency_symbol( $currency_symbol, $currency ) {
      switch( $currency ) {
        case 'RUB': $currency_symbol = 'руб.';
        break;
      }
      return $currency_symbol;
    }
    
    // Редактирование карточки товара ( архив )

    if ( ! function_exists( 'woocommerce_template_loop_product_link_open' ) ) {
    	/**
    	 * Insert the opening anchor tag for products in the loop.
    	 */
    	function woocommerce_template_loop_product_link_open() {
    		global $product;

    		$link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );

    		echo '<a href="' . esc_url( $link ) . '" class="good-article__img-wrapper">';
    	}
    }
    
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
    add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 12 );
    
    // Добавляю обертку для всего в карточке
    add_action( 'woocommerce_before_shop_loop_item', 'woozzee_article_tag_start', 3 );
    
    function woozzee_article_tag_start () {
      echo '<article class="link-list__article good-article">';
    }
    
    add_action( 'woocommerce_after_shop_loop_item', 'woozzee_article_tag_end', 15 );
    
    function woozzee_article_tag_end () {
      echo '</article>';
    }
    
    // Добавляю список изображений Галереи
    
    add_action( 'woocommerce_before_shop_loop_item', 'woozzee_images_gallerry_in_product_archive', 5 );
    
    function woozzee_images_gallerry_in_product_archive () {
      global $product;
      
      $attachment_ids = $product->get_gallery_image_ids();
      
      $image_size_thumb = 'woocommerce_thumbnail';
      $icon = false;
      
      if ( $attachment_ids ) {
        ?>
          <ul class="good-article__img-list">
            <?php
              $count_image = 1;
              foreach ( $attachment_ids as $attachment_id ) {
                if ($count_image < 4) :
                  ?>
                    <li class="good-article__img-item">
                      <?php
                        $image = wp_get_attachment_image(	$attachment_id, $image_size_thumb, $icon );
                        echo $image;
                      ?>
                    </li>
                  <?php
                  $count_image++;
                endif;
              } 
            ?>
          </ul>
        <?php    
      }      
    }
    
    // Добавляю Инфо обертку
    
    add_action( 'woocommerce_before_shop_loop_item_title', 'woozzee_info_wrapper_in_product_archive_start', 14 );
    
    function woozzee_info_wrapper_in_product_archive_start () {
      echo '<div class="good-article__info-wrapper">';
    }
    
    add_action( 'woocommerce_after_shop_loop_item', 'woozzee_info_wrapper_in_product_archive_end', 12 );
    
    function woozzee_info_wrapper_in_product_archive_end () {
      echo '</div>';
    }
    
    // Заголовок в списке товаров

    if ( ! function_exists( 'woocommerce_template_loop_product_title' ) ) {

      /**
       * Show the product title in the product loop. By default this is an H2.
       */
      function woocommerce_template_loop_product_title() {
        echo '<h3 class="good-article__title"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h3>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
      }
    }
    
    // Удаляю рейтинг
    
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
    
    // Удаляю стандартный вывод кнопки В корзину
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
  
    // Вывожу после цены
    add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 15);
    
    // Фильтр кнопки "Купить"

    add_filter( 'woocommerce_loop_add_to_cart_link', 'add_to_cart_loop_filter', 10, 3 );
    function add_to_cart_loop_filter ( $sprintf, $product, $args ) {
      global $product;

      $icon_add_to_cart = '<svg class="button-icon__icon button-icon__icon--mobile" width="20" height="20">
        <use xlink:href="' . get_template_directory_uri() . '/assets/img/sprite.svg#Basket_fill">
      </svg>';

      $text_add_to_cart = '<span class="start-state">' . $product->add_to_cart_text() . '</span>' . '<span class="final-state">' . __('В корзине', 'woozzee') . '</span>';

      if( $product->is_type( 'simple' ) ) {
        $args['class'] = 'good-article__cart add_to_cart_button ajax_add_to_cart';
        $sprintf = sprintf(
          '<a href="%s" data-quantity="%s" class="%s" %s>%s %s</a>',
          esc_url( $product->add_to_cart_url() ),
          esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
          esc_attr( isset( $args['class'] ) ? $args['class'] : 'good-article__cart' ),
          isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
          $icon_add_to_cart,
          $text_add_to_cart
        );
      } else if ($product->is_type( 'variable' )) {
        $args['class'] = 'good-article__cart product_type_variable add_to_cart_button';
        $sprintf = sprintf(
          '<a href="%s" data-quantity="%s" class="%s" %s>%s %s</a>',
          esc_url( $product->add_to_cart_url() ),
          esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
          esc_attr( isset( $args['class'] ) ? $args['class'] : 'good-article__cart' ),
          isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
          $icon_add_to_cart,
          $text_add_to_cart
        );
      }

      return $sprintf;
    }

    // Вывожу кнопку Вишлиста
    add_action( 'woocommerce_after_shop_loop_item_title', 'woozzee_wishlist_product_card', 20);
    
    function woozzee_wishlist_product_card () {
      echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
    }
    
    // Вывожу кнопку "Закрыть"
    add_action( 'woocommerce_after_shop_loop_item_title', 'woozzee_popup_product_card_close', 25);
    
    function woozzee_popup_product_card_close () {
      echo '<button class="good-article__close" type="button"><span class="visually-hidden">Закрыть</span></button>';
    }
    
    // Удаляю пагинацию
    
    //remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
    
    // Вывожу пагинацию в топ каталога
    
    add_action( 'woozzee_catalog_sort', 'woocommerce_pagination', 10 );

    // Вывожу пагинацию для планшетной версии категории
    
    add_action( 'woozzee_tablet_pagination', 'woocommerce_pagination', 5 );


    // Удаляю количество найденных товаров и сортировку
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

    // Вывожу сортировку в Топ каталога
    
    add_action( 'woozzee_catalog_sort', 'woozzee_catalog_sort_list', 5 );
    
    function woozzee_catalog_sort_list () {
      if ( ! wc_get_loop_prop( 'is_paginated' ) || ! woocommerce_products_will_display() ) {
    		return;
    	}
      ?>
        <h2 class="sorting-section__title">Сортировать по:</h2>
      <?php
      
      woocommerce_catalog_ordering();
    }
    
    // Вывожу количество найденных товаров и сортировку в Топ каталога
    
    add_action( 'woozzee_catalog_sort_after', 'woocommerce_result_count', 5 );
    
    // Вывожу количество товаров на странице
    
    add_action( 'woozzee_catalog_sort_after', 'amount_products_on_page', 10 );
    
    function amount_products_on_page () {
      if ( ! wc_get_loop_prop( 'is_paginated' ) || ! woocommerce_products_will_display() ) {
    		return;
    	}
      
      ?>
        <span class="amount-products-title">Показать</span>
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
      <?php
    }
    
    // Удаляет название страницы

    add_filter( 'woocommerce_show_page_title', 'wc_hide_title' );
    
    function wc_hide_title ($show) {
      $show = false;

      return $show;
    }
    
    add_action( 'woozzee_header_catalog', 'woozzee_catalog_title', 5 );
    
    // Вывожу Заголовок в кастомную шапку каталога
    
    function woozzee_catalog_title () {
      ?>
        <h1 class="catalog-section__title">
          <?php woocommerce_page_title(); ?>
        </h1>
      <?php
    }
    
    add_action( 'woozzee_header_catalog', 'woozzee_catalog_category_list', 6 );
    
    function woozzee_catalog_category_list () {
      get_template_part( 'template-parts/category', 'list' );
    }
    
    
    // Хлебные крошки в каталоге
    add_action( 'woozzee_header_catalog', 'woozzee_catalog_breadcrumbs', 7, 1 );
    
    $class_breadcrumbs = 'breadcrumbs';
    
    function woozzee_catalog_breadcrumbs ($class_breadcrumbs) {
      if ( function_exists( 'woozzee_yoast_breadcrumbs' ) ) {
        woozzee_yoast_breadcrumbs($class_breadcrumbs);
      }
    }    
    
    // Удаляем стандартный вывод

    remove_filter( 'woocommerce_product_loop_start', 'woocommerce_maybe_show_product_subcategories' );
    
    // Вывожу в кастомную шапку каталога

    add_action( 'woozzee_header_catalog', 'woo_show_subcategory', 30 );

    function woo_show_subcategory () {
      global $wp_query;
      $cat = $wp_query->get_queried_object();
      $termID = $cat->term_id; //динамическое получение ID текущей рубрики
      $taxonomyName = 'product_cat';
      $termchildren = get_term_children( $termID, $taxonomyName );

      if ((count($termchildren) > 0) || is_shop()) {
        ?>
          <ul class="catalog-section__goods-list link-list">
            <?php
              echo woocommerce_maybe_show_product_subcategories();
            ?>
          </ul>
        <?php
      }
    }
    
    // Удаляю стандартный вывод описания
    
    remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
    remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );
    
    // Вывожу в кастомную шапку каталога
    
    add_action( 'woozzee_header_catalog', 'woozzee_catalog_description', 10 );
    
    function woozzee_catalog_description () {
      // Don't display the description on search results page.
    	if ( is_search() ) {
    		return;
    	}

    	if ( is_post_type_archive( 'product' ) && in_array( absint( get_query_var( 'paged' ) ), array( 0, 1 ), true ) ) {
    		$shop_page = get_post( wc_get_page_id( 'shop' ) );
    		if ( $shop_page ) {
    			$description = wc_format_content( wp_kses_post( $shop_page->post_content ) );
    			if ( $description ) {
    				echo '<div class="catalog-article catalog-article--shop"><div class="catalog-article__text">' . $description . '</div><button class="catalog-article__button" type="button"> Читать полностью</button></div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    			}
    		}
    	}
      
      if ( is_product_taxonomy() && 0 === absint( get_query_var( 'paged' ) ) ) {
        $term = get_queried_object();

        if ( $term && ! empty( $term->description ) ) {
          echo '<div class="catalog-article catalog-article--shop"><div class="catalog-article__text">' . wc_format_content( wp_kses_post( $term->description ) ) . '</div><button class="catalog-article__button" type="button"> Читать полностью</button></div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }
      }   
    }
    
    // Контактный баннер
    
    add_action( 'woozzee_header_catalog', 'woozzee_catalog_banner', 20 );

    function woozzee_catalog_banner () {
      global $wp_query;
      $cat = $wp_query->get_queried_object();
      $termID = $cat->term_id; //динамическое получение ID текущей рубрики
      $taxonomyName = 'product_cat';
      $termchildren = get_term_children( $termID, $taxonomyName );

      if ((count($termchildren) > 0) || is_shop()) {
        $catalog_page_id = get_option( 'woocommerce_shop_page_id' );
        
        if (!$catalog_page_id) {
          $catalog_page_id = 24;
        }
        
        $catalog_banner_toggle = get_field( 'catalog_banner_toggle', $catalog_page_id );
        ?>
        
        <?php if (!empty($catalog_banner_toggle) && $catalog_banner_toggle == 'Да'): ?>
          <div class="catalog-banner">
            <p class="catalog-banner__title">
              <?php the_field( 'catalog_banner_title', $catalog_page_id  ); ?>
            </p>
            <p class="catalog-banner__text">
              <?php the_field( 'catalog_banner_text', $catalog_page_id  ); ?>
            </p> 
            <button class="catalog-banner__button openpopup" data-popup="contact" type="button">
              <?php the_field( 'catalog_banner_button', $catalog_page_id  ); ?>
            </button>      
          </div>
        <?php endif;
      }
    }
    
    // Убираю количество товаров в категории из Заголовка
    add_filter( 'woocommerce_subcategory_count_html', 'remove_count_into_the_title_category', 10, 2 );
    function remove_count_into_the_title_category ( $html, $category ){
    	$html = '';

    	return $html;
    }
    
    /* Сортировка */

    // Добавляем/удаляем условия в стандартный вывод сортировки WP (выпадающий список)
    
    function woo_catalog_orderby( $orderby ) {
        unset($orderby["price"]); // Сортировка по цене по возрастанию
        unset($orderby["price-desc"]); // Сортировка по цене по убыванию
        unset($orderby["popularity"]); // Сортировка по популярности
        unset($orderby["rating"]); // Сортировка по рейтингу
        unset($orderby["date"]);    // Сортировка по дате
        unset($orderby["title"]);	 // Сортировка по названию
        unset($orderby["menu_order"]); // Сортировка по умолчанию (можно определить порядок в админ панели)
        
        $orderby['popularity_desc'] = __( 'По популярности', 'woozzee' );
        $orderby['popularity_asc'] = __( 'По популярности', 'woozzee' );
        $orderby['price_asc'] = __( 'Цене', 'woozzee' );
        $orderby['price_desc'] = __( 'Цене', 'woozzee' );
        $orderby['discount_asc'] = __( 'Размеру скидки', 'woozzee' );
        $orderby['discount_desc'] = __( 'Размеру скидки', 'woozzee' );
        
        return $orderby;
    }
    add_filter( 'woocommerce_catalog_orderby', 'woo_catalog_orderby', 20 );
    
    // Добавим/удалим в кастомайзер пункты Сортировки
    
    add_filter( 'woocommerce_default_catalog_orderby_options', 'remove_default_sort_by_rating' );

    function remove_default_sort_by_rating( $orderby ){
      unset($orderby["price"]); // Сортировка по цене по возрастанию
      unset($orderby["price-desc"]); // Сортировка по цене по убыванию
      unset($orderby["popularity"]); // Сортировка по популярности
      unset($orderby["rating"]); // Сортировка по рейтингу
      unset($orderby["date"]);    // Сортировка по дате
      unset($orderby["title"]);	 // Сортировка по названию
      unset($orderby["menu_order"]); // Сортировка по умолчанию (можно определить порядок в админ панели)
      
      $orderby['popularity_desc'] = __( 'По популярности (по убыванию)', 'woozzee' );
      $orderby['popularity_asc'] = __( 'По популярности ( по возрастанию )', 'woozzee' );
      $orderby['price_asc'] = __( 'Цене ( по возрастанию )', 'woozzee' );
      $orderby['price_desc'] = __( 'Цене (по убыванию)', 'woozzee' );
      $orderby['discount_asc'] = __( 'Размеру скидки ( по возрастанию )', 'woozzee' );
      $orderby['discount_desc'] = __( 'Размеру скидки (по убыванию)', 'woozzee' );
      
      return $orderby;
    }
    
    // По каким критериям мы будем осуществлять нашу сортировку
    add_filter( 'woocommerce_get_catalog_ordering_args', 'woocommerce_get_catalog_ordering_new_args' );
     
    function woocommerce_get_catalog_ordering_new_args( $args ) {
      if (isset($_GET['orderby'])) {
        switch ($_GET['orderby']) :
          case 'popularity_desc' :
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'DESC';
            $args['meta_key'] = 'total_sales';  
            break;
          case 'popularity_asc' :
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'ASC';
            $args['meta_key'] = 'total_sales';  
            break;
          case 'price_asc' :
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'ASC';
            $args['meta_key'] = '_price';                 
            break;
          case 'price_desc' :
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'DESC';
            $args['meta_key'] = '_price';                 
            break;
          case 'discount_asc' :
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'ASC';
            $args['meta_key'] = '_sale_field';                 
            break;
          case 'discount_desc' :
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'DESC';
            $args['meta_key'] = '_sale_field';                 
            break;     
        endswitch;
      }  
     
    	return $args;
    }
    
    // Добавление поля для Простого товара
    add_action( 'woocommerce_product_options_pricing', 'art_woo_add_custom_fields' );
    function art_woo_add_custom_fields() {
    	global $product, $post;
      
    	echo '<div class="options_group">';// Группировка полей 
      // цифровое поле
        woocommerce_wp_text_input( array(
          'id'                => '_sale_field',
          'label'             => __( 'Размер скидки', 'woozzee' ),
          'placeholder'       => 'Скидка отобразится после сохранения',
          'description'       => __( '%', 'woozzee' ),
          'type'              => 'number',
          'custom_attributes' => array(
             'step' => 'any',
             'min'  => '0',
             'disabled' => 'true',
          ),
        ) );
    	echo '</div>';
    }
    
    // Сохранение данных
    add_action( 'woocommerce_process_product_meta', 'art_woo_custom_fields_save', 10 );
    function art_woo_custom_fields_save( $post_id ) {
      $percentage = 0;
      
      $_product = wc_get_product( $post_id );
      
      if ($_product->is_type( 'simple' )) {      
        $sale_price = $_POST['_sale_price'];
        
        if ($sale_price) {
          $regular_price = $_POST['_regular_price'];
          
          // рассчитываем процент скидки
          $percentage = round(( ( $regular_price - $sale_price ) / $regular_price ) * 100);
        }
        
        update_post_meta( $post_id, '_sale_field', esc_attr( $percentage ) );
      } elseif( $_product->is_type( 'variable' ) ) {
        $available_variations = $_product->get_available_variations();
        
        if ($available_variations) {
          // Перебираю все вариации, чтобы найти максимальную скидку и присвоить ее оригинальному Продукту
          $a = 0;
          while ($a <= count($available_variations)) {
            $variation_id = $available_variations[$a]['variation_id']; 
            
            $variable_product = new WC_Product_Variation( $variation_id );

            $regular_price = $variable_product->regular_price;
            $sale_price = $variable_product->sale_price;
            
            if ( $regular_price && $sale_price ) {
              // рассчитываем процент скидки
              $percentage_new = round(( ( $regular_price - $sale_price ) / $regular_price ) * 100);
              
              // если больше - меняем процент
              if ($percentage_new > $percentage) {
                $percentage = $percentage_new;
              }
            }
            
            $a++;
          }
        }
                
        update_post_meta( $post_id, '_sale_field', esc_attr( $percentage ) );
      }     
      
    }
    
    // WP ALL Import
    // function sale_percentage ( $price_regular = null,  $price_sale = null ) {
  	// 	$percentage = 0;
    // 
  	// 	if ( !empty( $price_regular) && !empty( $price_sale ) ) {
  	// 		$percentage = round(( ( $price_regular - $price_sale ) / $price_regular ) * 100);
  	// 	}
    // 
  	// 	return $percentage;
  	// }
    
    // Добавление поля для вариативного товара
    
    add_action( 'woocommerce_variation_options_pricing', 'art_term_production_fields', 10, 3 );
    function art_term_production_fields( $loop, $variation_data, $variation ) {
       // цифровое поле
         woocommerce_wp_text_input( array(
           'id'                => '_sale_field[' . $variation->ID . ']', // id поля
           'label'             => __( 'Размер скидки', 'woozzee' ),
           'placeholder'       => 'Скидка отобразится после сохранения',
           'description'       => __( '%', 'woozzee' ),
           'type'              => 'number',
           'custom_attributes' => array(
              'step' => 'any',
              'min'  => '0',
              'disabled' => 'true',
           ),
           'value' => get_post_meta( $variation->ID, '_sale_field', true ),
         ) );
    }
    
    // Сохраняем поля для вариативного товара
    add_action( 'woocommerce_save_product_variation', 'art_save_variation_settings_fields', 10, 2 );
    function art_save_variation_settings_fields( $post_id ) {
       $percentage = 0;
       
       $variable_product = new WC_Product_Variation( $post_id );
       $regular_price = $variable_product->regular_price;
       $sale_price = $variable_product->sale_price;
       
       if ( $regular_price && $sale_price ) {
         // рассчитываем процент скидки
   			 $percentage = round(( ( $regular_price - $sale_price ) / $regular_price ) * 100);
       }
       
       update_post_meta( $post_id, '_sale_field', esc_attr( $percentage ) );
    }
    
    /* Страница продукта */
        
    // Удаляю стандартный вывод Апселов    
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
    // Вывожу после продукта
    add_action( 'woocommerce_after_single_product', 'woocommerce_upsell_display', 45 );
    
    
    // Удаляю стандартный вывод Сопутствующих    
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
    // Вывожу после продукта
    add_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products', 50 );
    
    // Вывожу секцию О нас
    add_action( 'woocommerce_after_single_product', 'woozzee_about_icons_function', 55 );
    
    function woozzee_about_icons_function () {
      get_template_part( 'template-parts/content', 'about-us' );
    }
    
    // Удаляю стандартную скидку
    
    remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
    
    // Удаляю тумбнаилы стандартные
    
    remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
    
    
    // Вывожу в слайдер
    add_action( 'woocommerce_after_images_slider_list', 'woocommerce_show_product_sale_flash', 5 );

    // Удаляю заголовки табов
    
    add_filter( 'woocommerce_product_additional_information_heading', 'woozzee_remove_tabs_titles_filter' );
    add_filter( 'woocommerce_product_description_heading', 'woozzee_remove_tabs_titles_filter' );
    
    function woozzee_remove_tabs_titles_filter ($heading) {
      $heading = '';
      
      return $heading;
    }
    
    // Кастомные заголовки для табов
    
    add_filter( 'woocommerce_product_tabs', 'woo_custom_product_tab' );
  
    function woo_custom_product_tab ( $tabs ) {
      if (!empty($tabs['additional_information'])) {
        $tabs['additional_information']['title'] = __( 'Характеристики', 'woozzee' );
        $tabs['additional_information']['priority'] = 1;
      }
      
      if (!empty($tabs['description'])) {
        $tabs['description']['title'] = __( 'Подходит для', 'woozzee' );
        $tabs['description']['priority'] = 0;
      }      
      
    	return $tabs;   
    }

    // Меняю класс для цены
    
    
    add_filter( 'woocommerce_product_price_class', 'filter_single_price_class' );
    function filter_single_price_class ( $string ){
    	$string = 'product__price';

    	return $string;
    }
    
    // Изменяю текст кнопки
    
    add_filter( 'woocommerce_product_single_add_to_cart_text', 'filter_function_name_8435', 10, 2 );
    function filter_function_name_8435( $__, $that ){
    	$__ = __('Добавить В корзину', 'woozzee');

    	return $__;
    }
    
    // Удаляю вывод Мета
    
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
    
    // Количество товаров в корзине ( ajax добавление )

    if (!function_exists('woozzee_mini_cart')) {

      function woozzee_mini_cart () {
        ?>

        <span class="my-basket__count">
          <?php echo wp_kses_data(WC()->cart->get_cart_contents_count()); ?>
        </span>

        <?php
      }
    }
    
    add_filter( 'woocommerce_add_to_cart_fragments', 'wc_refresh_mini_cart_count');

    function wc_refresh_mini_cart_count ($fragments) {
      ob_start();

      woozzee_mini_cart();

      $fragments['.my-basket__count'] = ob_get_clean();

      return $fragments;
    }

    // Billing fields

    add_filter( 'woocommerce_billing_fields', 'custom_billing_fields' );

    function custom_billing_fields ( $fields ) {
      if ( is_checkout() ) {
        // Unset
        
        unset( $fields[ 'billing_state' ] );
        unset( $fields[ 'billing_address_2' ] );
        unset( $fields[ 'billing_company' ] );
      }

      return $fields;
    }

    // Sipping fields

    add_filter( 'woocommerce_shipping_fields', 'custom_shipping_fields' );

    function custom_shipping_fields ( $fields ) {
      if ( is_checkout() ) {
        // Unset
        
        unset( $fields[ 'shipping_state' ] );
        unset( $fields[ 'shipping_address_2' ] );
        unset( $fields[ 'shipping_company' ] );
      }

      return $fields;
    }
    
    // Купон на скидку
    
    class woozzee_ajax {
      function subscribe () {      
        if($_REQUEST['antibot'] == 'true') {
          $sale = (int) $_REQUEST['sale'];
          
          $a = $_REQUEST['email'];
          $sanitized_a = filter_var($a, FILTER_SANITIZE_EMAIL);
          
          if (!filter_var($sanitized_a, FILTER_VALIDATE_EMAIL)) {
            echo "Введен неправильный e-mail";
          } else {
            global $wpdb;
            $id=$wpdb->get_var($wpdb->prepare("SELECT ID FROM {$wpdb->prefix}subscribers WHERE email=%s",array('email'=>$sanitized_a)));            
            
            if (is_null($id)) {
              $email = $sanitized_a;
              
              $subject = 'Спасибо за подписку!';
              
              $site_name = get_bloginfo( 'name' );
              
              $message = "Уважаемый гость! \r\nМы рады, что Вы подписались на наши новости!\r\nРады будем видеть вас в числе любимых гостей и постоянных клиентов на нашем сайте " . $site_name;
              
              $final_text = 'Поздравляем! Вы успешно подписаны на новости нашего сайта.';
              
              if ($sale !== 0) {
                $coupon_code = 'PP' . generatePIN(6) ; // Code
                $subject = 'Ваш купон на скидку';
                
                $amount = $sale; // Amount
                $discount_type = 'percent'; // Type: fixed_cart, percent, fixed_product, percent_product

                $coupon = array(
                    'post_title' => $coupon_code,
                    'post_content' => '',
                    'post_status' => 'publish',
                    'post_author' => 1,
                    'post_type'     => 'shop_coupon'
                );

                $new_coupon_id = wp_insert_post( $coupon );

                // Add meta
                update_post_meta( $new_coupon_id, 'discount_type', $discount_type );
                update_post_meta( $new_coupon_id, 'coupon_amount', $amount );
                update_post_meta( $new_coupon_id, 'individual_use', 'yes' );
                update_post_meta( $new_coupon_id, 'product_ids', '' );
                update_post_meta( $new_coupon_id, 'exclude_product_ids', '' );
                update_post_meta( $new_coupon_id, 'usage_limit', '1' );
                update_post_meta( $new_coupon_id, 'expiry_date', strtotime("+2 week") );
                update_post_meta( $new_coupon_id, 'customer_email', $email );

                $message = "Уважаемый гость! \r\nМы рады, что Вы успели получить свой код на скидку!\r\nСпешите воспользовать Вашим купоном! Срок его действия истекает через 7 дней. \r\n\r\nВаш личный купон на " . $sale . "% скидку:  " . $coupon_code. " \r\n\r\nЧтобы воспользоваться скидкой, введите промокод в поле «купон» в корзине при заказе на сайте. \r\nРады будем видеть вас в числе любимых гостей и постоянных клиентов на нашем сайте " . $site_name;
              
                $final_text = 'Купон успешно отправлен! Проверьте свою почту.';
              }
                
              $headers = 'From: '. get_option('admin_email') . "\r\n" .
                         'Reply-To: ' . get_option('admin_email') . "\r\n";
              $sent = wp_mail($email, $subject, strip_tags($message), $headers);    


              $wpdb->insert($wpdb->prefix."subscribers",array('email'=>$sanitized_a,'datetime'=>current_time('mysql')));
              
              echo $final_text;
            } else {
              if ($sale !== 0) {
                echo "Купон уже был отправлен на данный e-mail.";
              } else {
                echo "Данный e-mail уже подписан.";
              }              
            }
          }          
        } else{
          echo "Подтвердите, что Вы не робот";
        }
        
        die();    
      }
    }    
    
    $woozzee_ajax = new woozzee_ajax();
    
    if( wp_doing_ajax() ) {
      add_action('wp_ajax_subscribe', array($woozzee_ajax, 'subscribe'));
      add_action('wp_ajax_nopriv_subscribe', array($woozzee_ajax, 'subscribe'));
    
      add_action('wp_ajax_load_more', 'load_more');
      add_action('wp_ajax_nopriv_load_more', 'load_more');
    }
  }
?>
