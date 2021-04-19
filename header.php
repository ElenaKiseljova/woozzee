<?php 
  if (is_front_page()) {
    if (!isset($_COOKIE['timer_coupon']) && !isset($_COOKIE['timer_flag'])) {      
      $expires_coupon = time() + (3 * 60 * 60); // Через 3 часа блок скроется у пользователя
      $expires_flag = time() + (30 * 24 * 60 * 60); // 30 дней спустя 
                                                           // блок с возможностью получить скидку 
                                                           // опять покажется
      $value_coupon_cookie = $expires_coupon;
      
      setcookie('timer_coupon', $value_coupon_cookie, $expires_coupon, '/');
      setcookie('timer_flag', 'on', $expires_flag, '/');
    }
  }
?>
<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title></title>
    <?php
      wp_head();
    ?>
  </head>
  <body>
    <?php 
      // IDs для ACF
      
      $contacts_page_id = 7;
    ?>
    
    <header class="page-header">
      <div class="page-header__top-wrapper">
        <a class="page-header__logo header-logo" href="<?php echo bloginfo( 'url' ); ?>">
          <?php 
            $logo_desktop = get_theme_mod( 'header_logo_desktop_settings' );
            $logo_mobile = get_theme_mod( 'header_logo_mobile_settings' );
            
            $logo_desktop = $logo_desktop ? $logo_desktop : '';
            $logo_mobile = $logo_mobile ? $logo_mobile : '';
          ?>
          <div class="header-logo__wrapper">
            <picture>
              <source media="(min-width: 1024px)" srcset="<?= $logo_desktop; ?>">
              <img src="<?= $logo_mobile; ?>" width="38" height="49" alt="Woozzee">
            </picture>
          </div>
          <span class="header-logo__text"><?php echo bloginfo( 'name' ); ?></span> 
        </a>
        <button class="page-header__menu-button page-header__menu-button--closed" type="button">
          <svg class="menu-icon menu-icon--closed" width="20" height="20">
            <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#menu"></use>
          </svg>
          <svg class="menu-icon menu-icon--opened" width="25" height="25">
            <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#close-menu"></use>
          </svg>
          <span class="visually-hidden">Меню</span>
        </button>
        <?php get_search_form(); ?>
        <!-- <form class="page-header__search" action="" method="get">
          <input type="text" name="search" placeholder="Поиск"> 
          <button type="submit">
            <svg width="17" height="16">
              <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#Search_alt"></use>
            </svg>
            <span class="visually-hidden">Поиск</span>
          </button>
        </form> -->
        
        <?php 
          $phone_header = get_field( 'contacts_phone_header', $contacts_page_id );
        ?>
        
        <?php if (!empty($phone_header) && is_array($phone_header)): ?>
          <a href="tel:<?= $phone_header['link']; ?>" class="page-header__phone">
            <?= $phone_header['text']; ?>
          </a> 
        <?php endif; ?>
        
        <!-- <button class="button-icon button-icon--fav" type="button">
          <svg class="button-icon__icon button-icon__icon--mobile" width="20" height="20">
            <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#Favorite"></use>
          </svg>
          <svg class="button-icon__icon button-icon__icon--desktop" width="20" height="20">
            <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#Favorite_fill"></use>
          </svg>
          <span class="visually-hidden">Понравилось</span>
        </button> -->
        <a href="<?php echo bloginfo( 'url' ); ?>/wishlist" class="button-icon button-icon--fav">
          <svg class="button-icon__icon button-icon__icon--mobile" width="20" height="20">
            <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#Favorite"></use>
          </svg>
          <svg class="button-icon__icon button-icon__icon--desktop" width="20" height="20">
            <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#Favorite_fill"></use>
          </svg>
          <span class="visually-hidden">Понравилось</span>
        </a>
        <!-- wishlist -->
        <a href="<?php echo wc_get_cart_url(); ?>" class="button-icon button-icon--cart">
          <svg class="button-icon__icon button-icon__icon--mobile" width="20" height="20">
            <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#Basket"></use>
          </svg>
          <svg class="button-icon__icon button-icon__icon--desktop" width="20" height="20">
            <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#Basket_fill"></use>
          </svg>
          <span class="visually-hidden">Корзина</span>
        </a>
        <a href="<?php echo bloginfo( 'url' ); ?>/#wpcf7-f70-o1" class="page-header__call-button <?php if(is_front_page()) echo 'page-header__call-button--main'; ?>">Обратный звонок</a>
      </div>
      <nav class="page-header__nav header-nav">
        <?php
          wp_nav_menu(
            array(
              'theme_location'  => 'top_menu',
              'container'       => null,
              'menu_class'      => 'header-nav__list',
              'depth'           => 0,
            )
          );
        ?>
        <!-- <ul class="header-nav__list">
          <li class="header-nav__item header-nav__item--active header-nav__item--sublist">
            <svg width="24" height="24">
              <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#grid"></use>
            </svg>
            <a href="#">Каталог</a>
            <ul class="nav-sublist nav-sublist--catalog">
              <li class="nav-sublist__item"><a href="#">Наклейки</a></li>
              <li class="nav-sublist__item"><a href="#">Картины</a></li>
              <li class="nav-sublist__item"><a href="#">Календари</a></li>
            </ul>
          </li>
          <li class="header-nav__item">
            <svg width="24" height="24">
              <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#people"></use>
            </svg>
            <a href="#">О нас</a>
          </li>
          <li class="header-nav__item header-nav__item--sublist header-nav__item--arrow">
            <svg width="24" height="24">
              <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#transport"></use>
            </svg>
            <a href="#">Оплата и доставка</a>
            <ul class="nav-sublist">
              <li class="nav-sublist__item"><a href="#">Доставка</a></li>
              <li class="nav-sublist__item"><a href="#">Оплата</a></li>
              <li class="nav-sublist__item"><a href="#">Возврат</a></li>
              <li class="nav-sublist__item"><a href="#">Соглашения</a></li>
            </ul>
          </li>
          <li class="header-nav__item">
            <svg width="24" height="24">
              <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#lightbulb"></use>
            </svg>
            <a href="#">Советы и лайфхаки</a>
          </li>
          <li class="header-nav__item">
            <svg width="24" height="24">
              <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#extension"></use>
            </svg>
            <a href="#">Эксклюзив</a>
          </li>
          <li class="header-nav__item">
            <svg width="24" height="24">
              <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#support"></use>
            </svg>
            <a href="#">Юридическим лицам</a>
          </li>
          <li class="header-nav__item">
            <svg width="24" height="24">
              <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#envelope-alt"></use>
            </svg>
            <a href="#">Контакты</a>
          </li>
        </ul> -->
      </nav>
    </header>
    