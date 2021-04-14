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
    
    wp_enqueue_script( 'mask-script', 'https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js', $deps = array('jquery'), $ver = false, $in_footer = true );
    wp_enqueue_script('swiper-script', get_template_directory_uri() . '/assets/js/vendor/swiper-bundle.min.js', $deps = array(), $ver = null, $in_footer = true );
    wp_enqueue_script('woozzee-script', get_template_directory_uri() . '/assets/js/script.min.js', $deps = array('jquery'), $ver = null, $in_footer = true );
    wp_enqueue_script('animation-anchor-script', get_template_directory_uri() . '/assets/js/animation-anchor.js', $deps = array(), $ver = null, $in_footer = true );
    wp_enqueue_script('customizer-script', get_template_directory_uri() . '/assets/js/customizer-scripts.js', $deps = array('jquery', 'customize-preview'), $ver = null, $in_footer = true );

    /*$args = array();

    $args['url'] = admin_url('admin-ajax.php');
    
    if (class_exists('WooCommerce')) {
      $args['cart'] = WC()->cart;

      if (is_product()) {
        $args['nonce'] = wp_create_nonce('oneclick-woozzee');
      }
    }

    wp_localize_script( 'form-script', 'woozzee_ajax', $args);*/
  }
  
  if (class_exists('WooCommerce')) {
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
  }
?>
