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
      if ( ($item->post_title === 'Каталог') || ($item->title === 'Каталог') ) {
        $args->before = '<svg width="24" height="24">
          <use xlink:href="' . get_template_directory_uri() . '/assets/img/sprite.svg#grid"></use>
        </svg>';
      } else if ( ($item->post_title === 'О нас') || ($item->title === 'О нас') ) {
          $args->before = '<svg width="24" height="24">
            <use xlink:href="' . get_template_directory_uri() . '/assets/img/sprite.svg#people"></use>
          </svg>';
      } else if ( ($item->post_title === 'Оплата и доставка') || ($item->title === 'Оплата и доставка') ) {
          $args->before = '<svg width="24" height="24">
            <use xlink:href="' . get_template_directory_uri() . '/assets/img/sprite.svg#transport"></use>
          </svg>';
      } else if ( ($item->post_title === 'Советы и лайфхаки') || ($item->title === 'Советы и лайфхаки') ) {
          $args->before = '<svg width="24" height="24">
            <use xlink:href="' . get_template_directory_uri() . '/assets/img/sprite.svg#lightbulb"></use>
          </svg>';
      } else if ( ($item->post_title === 'Эксклюзив') || ($item->title === 'Эксклюзив') ) {
          $args->before = '<svg width="24" height="24">
            <use xlink:href="' . get_template_directory_uri() . '/assets/img/sprite.svg#extension"></use>
          </svg>';
      } else if ( ($item->post_title === 'Юридическим лицам') || ($item->title === 'Юридическим лицам') ) {
          $args->before = '<svg width="24" height="24">
            <use xlink:href="' . get_template_directory_uri() . '/assets/img/sprite.svg#support"></use>
          </svg>';
      } else if ( ($item->post_title === 'Контакты') || ($item->title === 'Контакты') ) {
          $args->before = '<svg width="24" height="24">
            <use xlink:href="' . get_template_directory_uri() . '/assets/img/sprite.svg#envelope-alt"></use>
          </svg>';
      } else {
        $args->before = '';
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
    if (($args->theme_location == 'top_menu') && ($depth == 0)) {
      foreach ( $classes as $key => $class ) {
    		if ( $class == 'menu-item' ) {
    			$classes[ $key ] = 'header-nav__item';
    		} else if ( ($class == 'current-menu-item') || ($class == 'current_page_item') ) {
    			$classes[ $key ] = 'header-nav__item--active';
    		} else if ( $class == 'menu-item-has-children' ) {
    			$classes[ $key ] = 'header-nav__item--sublist header-nav__item--arrow';
    		} else {
          $classes[ $key ] = '';
        }
    	}
    } else if (($args->theme_location == 'top_menu') && ($depth !== 0)) {
      foreach ( $classes as $key => $class ) {
    		if ( $class == 'menu-item' ) {
    			$classes[ $key ] = 'nav-sublist__item';
    		} else if ( ($class == 'current-menu-item') || ($class == 'current_page_item') ) {
    			$classes[ $key ] = 'nav-sublist__item--current';
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
    
  	return $classes;
  }

  // Изменение класса подменю
  
  add_filter( 'nav_menu_submenu_css_class', 'filter_nav_menu_submenu_css_class', 10, 3 );
  
  function filter_nav_menu_submenu_css_class ( $classes, $args, $depth ){
    foreach ( $classes as $key => $class ) {
  		if ( $class == 'sub-menu' ) {
  			$classes[ $key ] = 'nav-sublist';
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
    wp_enqueue_script('animation-anchor-script', get_template_directory_uri() . '/assets/js/animation-anchor.js', $deps = array(), $ver = null, $in_footer = true );
    
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
      
      $image_size_thumb = 'full';
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
                $coupon_code = 'PP' . generatePIN(6) ; // Code
                $email = $sanitized_a;
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

                $site_name = get_bloginfo( 'name' );
                
                $message = "Уважаемый гость! \r\nМы рады, что Вы успели получить свой код на скидку!\r\nСпешите воспользовать Вашим купоном! Срок его действия истекает через 7 дней. \r\n\r\nВаш личный купон на " . $sale . "% скидку:  " . $coupon_code. " \r\n\r\nЧтобы воспользоваться скидкой, введите промокод в поле «купон» в корзине при заказе на сайте. \r\nРады будем видеть вас в числе любимых гостей и постоянных клиентов на нашем сайте " . $site_name;
                $headers = 'From: '. get_option('admin_email') . "\r\n" .
                    'Reply-To: ' . get_option('admin_email') . "\r\n";
                $sent = wp_mail($email, $subject, strip_tags($message), $headers);    


                $wpdb->insert($wpdb->prefix."subscribers",array('email'=>$sanitized_a,'datetime'=>current_time('mysql')));
                echo "Купон успешно отправлен! Проверьте свою почту.";
            } else {
              echo "Купон уже был отправлен на данный e-mail.";
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
