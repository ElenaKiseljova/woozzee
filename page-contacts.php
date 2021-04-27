<?php 
  /*
    Template Name: Контакты
  */
?>

<?php
  get_header(  );
?>

<?php 
  /* ID страницы для ACF полей */
  
  $id_page = get_the_id();
?>

<main class="page-main page-main--contact">
  <?php 
    if ( function_exists( 'woozzee_yoast_breadcrumbs' ) ) {
      $class_breadcrumbs = 'breadcrumbs breadcrumbs--outer';
      
      woozzee_yoast_breadcrumbs($class_breadcrumbs);
    }
  ?>
  <section class="page-main__section page-main__section--title-banner title-banner-section title-banner-section--contact">
    <div class="title-banner-section__wrapper">
      <h1 class="title-banner-section__title title-banner-section__title--white">
        <?php the_title(  ); ?> 
      </h1> 
    </div>
  </section>
  <?php 
    if ( function_exists( 'woozzee_yoast_breadcrumbs' ) ) {
      $class_breadcrumbs = 'breadcrumbs breadcrumbs--inner';
      
      woozzee_yoast_breadcrumbs($class_breadcrumbs);
    }
  ?>
  <section class="page-main__section page-main__section--address address-section">
    <div class="address-section__wrapper">
      <h2 class="address-section__title">
        <?php the_field( 'contacts_info_title' ); ?>
      </h2>
      <?php 
        $phone_footer = get_field( 'contacts_phone_footer', $contacts_page_id );
      ?>
      
      <?php if (!empty($phone_footer) && is_array($phone_footer)): ?>
        <a href="tel:<?= $phone_footer['link']; ?>" class="address-section__link address-section__link--phone">
          <?= $phone_footer['text']; ?>
        </a>
      <?php endif; ?>
      
      <?php 
        $socials_list = get_field( 'contacts_socials', $contacts_page_id );
      ?>
      
      <?php if (!empty($socials_list) && is_array($socials_list)): ?>
        <ul class="socials-list socials-list--turned">          
          <?php if (!empty($socials_list['telegram'])): ?>
            <li class="socials-list__item socials-list__item--telegram">
              <a href="https://telegram.im/@<?= $socials_list['telegram']; ?>">
                <span class="visually-hidden">Telegram</span>
              </a>
            </li>  
          <?php endif; ?>
        
          <?php if (!empty($socials_list['whatsapp'])): ?>
            <li class="socials-list__item socials-list__item--whatsapp">
              <a href="https://wa.me/<?= $socials_list['whatsapp']; ?>" target="_blank">
                <span class="visually-hidden">whatsapp</span>
              </a>
            </li>
          <?php endif; ?>
        </ul>
      <?php endif; ?>
      
      <a href="mailto:info@smart-mail.su" class="address-section__link address-section__link--mail">info@smart-mail.su</a>
      
      <address class="address-section__address">
        <?php the_field( 'contacts_address', $contacts_page_id ); ?>
      </address>
      
      <p class="address-section__time">
        <?php the_field( 'contacts_worktime', $contacts_page_id ); ?>
      </p>
      
      <?php if (!empty($socials_list) && is_array($socials_list)): ?>
        <ul class="socials-list socials-list--turned">
          <?php if (!empty($socials_list['instagram'])): ?>
            <li class="socials-list__item socials-list__item--instagram">
              <a href="<?= $socials_list['instagram']; ?>" target="_blank">
                <span class="visually-hidden">instagram</span>
              </a>
            </li>
          <?php endif; ?>          
          
          <?php if (!empty($socials_list['vk'])): ?>
            <li class="socials-list__item socials-list__item--vk">
              <a href="<?= $socials_list['vk']; ?>" target="_blank">
                <span class="visually-hidden">Вконтакте</span>
              </a>
            </li>
          <?php endif; ?>
          
          <?php if (!empty($socials_list['youtube'])): ?>
            <li class="socials-list__item socials-list__item--youtube">
              <a href="<?= $socials_list['youtube']; ?>" target="_blank">
                <span class="visually-hidden">youtube</span>
              </a>
            </li>
          <?php endif; ?>
          
          <?php if (!empty($socials_list['tik_tok'])): ?>
            <li class="socials-list__item socials-list__item--tik-tok">
              <a href="<?= $socials_list['tik_tok']; ?>">
                <span class="visually-hidden">Tiktok</span>
              </a>
            </li>
          <?php endif; ?>
        </ul>
      <?php endif; ?>
    </div>
  </section>
  <section class="page-main__section page-main__section--contact contact-section contact-section--mixed">
    <div class="contact-section__wrapper">
      <h2 class="contact-section__title">
        <?php the_field( 'contacts_feedback_title' ); ?>
      </h2>
      <div class="contact-section__form">
        <?php echo do_shortcode( '[contact-form-7 id="650" title="Контакты"]' ); ?>
      </div>
      <p class="contact-section__confident-policy contact-section__confident-policy--gray">
        Нажимая на кнопку, вы даете согласие
        на обработку персональных данных
        и соглашаетесь c <a href="<?php echo get_privacy_policy_url(); ?>">политикой конфиденциальности</a>
      </p>
      
      <p class="contact-section__subtext">С любовью, Woozzee</p>
    </div>
  </section>
  <section class="page-main__section page-main__section--map map-section">
    <div class="map-section__wrapper">
      <h2 class="visually-hidden">Карта</h2>
      <address class="visually-hidden">
        <?php the_field( 'contacts_address', $contacts_page_id ); ?>
      </address>
      <div class="map-section__map">
        <?php the_field( 'contacts_map' ); ?>
        <!-- <a href="https://yandex.ru/maps?utm_medium=mapframe&utm_source=maps" style="color:#000;font-size:16px;position:absolute;top:0px;">Яндекс.Карты</a>
        <a href="https://yandex.ru/maps/1/moscow-and-moscow-oblast/house/ulitsa_sedovtsev_11/Z0EYdgFnTkUHQFtvfXp1eHtrYA==/?ll=38.064761%2C55.654445&utm_medium=mapframe&utm_source=maps&z=13.3" style="color:#000;font-size:16px;position:absolute;top:14px;">Улица Седовцев, 11 — Яндекс.Карты</a>
        <iframe src="https://yandex.ru/map-widget/v1/-/CCUYbFRTpC"  frameborder="0" allowfullscreen="true" style="position:relative;"></iframe> -->
      </div>
    </div>
  </section>
</main>

<?php
  get_footer(  );
?>