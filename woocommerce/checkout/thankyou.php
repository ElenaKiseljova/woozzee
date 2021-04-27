<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
?>


  <section class="page-main__section page-main__section--thanks thanks-section">
    <div class="thanks-section__wrapper">
      <?php
      if ( $order ) :

        do_action( 'woocommerce_before_thankyou', $order->get_id() );
        ?>
            
        <?php if ( $order->has_status( 'failed' ) ) : ?>

          <h2 class="thanks-section__title">Что-то пошло не так...</h2>
          
          <p class="thanks-section__text ">
            Попробуйте повторить заказ чуть позже или сообщите нам об ошибке.
          </p>
          
          <button data-popup="contact" class="page-header__call-button openpopup <?php if(is_front_page()) echo 'page-header__call-button--main'; ?>">
            Сообщить об ошибке
          </button>

        <?php else : ?>
          <h2 class="thanks-section__title">Спасибо за доверие!</h2>
          <p class="thanks-section__text thanks-section__text--blue">
            Номер Вашего заказа: <?php echo $order->get_order_number(); ?>
            <span class="thanks-section__oneline">
              Чек и информация о доставке придут вам на e-mail.
            </span>
          </p>
          <!-- <p class="thanks-section__text ">
            Ваш бонусный счёт пополнен на ХХХ баллов. Баллы можно использовать при следующей покупке. <span class="thanks-section__oneline">1 балл = 1 рубль скидки!</span>
          </p> -->
          <div class="thanks-section__container">
            <h3 class="thanks-section__title thanks-section__title--h3">
              Хотите получать лучшие ценовые предложения и новости об акциях раньше всех?
            </h3>
            <p class="thanks-section__text ">
              Подпишитесь на нашу рассылку:
              <span class="thanks-section__oneline">
                обещаем не присылать спам, все письма строго по делу!
              </span>
            </p>
            
            <input class="visually-hidden" type="checkbox" name="subscribe" id="subscribe">
            <label for="subscribe" class="thanks-section__subscribe">
              ПОДПИСАТЬСЯ
            </label>      
            
            <form id="timer-form" action="" class="discount-section__form discount-section__form--thancks">
              <div class="discount-section__controls">
                <input class="discount-section__input" placeholder="Введите e-mail" type="email" name="email" required> 
                
                <input type="hidden" name="antibot" value="false">
                <input type="hidden" name="sale" value="0">
                
                <button id="timer-submit" class="discount-section__button" type="submit">
                  ПОДПИСАТЬСЯ
                </button>
              </div>
              <div class="message"></div>
            </form>
            
            <p class="thanks-section__text thanks-section__text--bigger">
              Предпочитаете соцсети?
              Вот наши странички:
            </p>
            
            <?php 
              $contacts_page_id = 7;
              $socials_list = get_field( 'contacts_socials', $contacts_page_id );
            ?>
            
            <?php if (!empty($socials_list) && is_array($socials_list)): ?>
              <ul class="socials-list socials-list--turned">
                <?php if (!empty($socials_list['instagram'])): ?>
                  <li class="socials-list__item socials-list__item--instagram">
                    <a href="<?= $socials_list['instagram']; ?>" target="_blank">
                      <span class="visually-hidden">instagram</span>
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
                
                <?php if (!empty($socials_list['vk'])): ?>
                  <li class="socials-list__item socials-list__item--vk">
                    <a href="<?= $socials_list['vk']; ?>" target="_blank">
                      <span class="visually-hidden">Вконтакте</span>
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
                
                <!-- <?php if (!empty($socials_list['telegram'])): ?>
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
                <?php endif; ?> -->
              </ul>
            <?php endif; ?>
          </div>
          <p class="thanks-section__end-text">
            Рады сотрудничеству, приятного дня!
          </p>

        <?php endif; ?>

      <?php else : ?>

        <h2 class="thanks-section__title">Спасибо за доверие!</h2>
        <!-- <p class="thanks-section__text thanks-section__text--blue">
          Номер Вашего заказа: <?php echo $order->get_order_number(); ?>
          <span class="thanks-section__oneline">
            Чек и информация о доставке придут вам на e-mail.
          </span>
        </p> -->
        <!-- <p class="thanks-section__text ">
          Ваш бонусный счёт пополнен на ХХХ баллов. Баллы можно использовать при следующей покупке. <span class="thanks-section__oneline">1 балл = 1 рубль скидки!</span>
        </p> -->
        <div class="thanks-section__container">
          <h3 class="thanks-section__title thanks-section__title--h3">
            Хотите получать лучшие ценовые предложения и новости об акциях раньше всех?
          </h3>
          <p class="thanks-section__text ">
            Подпишитесь на нашу рассылку:
            <span class="thanks-section__oneline">
              обещаем не присылать спам, все письма строго по делу!
            </span>
          </p>
          
          <input class="visually-hidden" type="checkbox" name="subscribe" id="subscribe">
          <label for="subscribe" class="thanks-section__subscribe">
            ПОДПИСАТЬСЯ
          </label>      
          
          <form id="timer-form" action="" class="discount-section__form discount-section__form--thancks">
            <div class="discount-section__controls">
              <input class="discount-section__input" placeholder="Введите e-mail" type="email" name="email" required> 
              
              <input type="hidden" name="antibot" value="false">
              <input type="hidden" name="sale" value="0">
              
              <button id="timer-submit" class="discount-section__button" type="submit">
                ПОДПИСАТЬСЯ
              </button>
            </div>
            <div class="message"></div>
          </form>
          
          <p class="thanks-section__text thanks-section__text--bigger">
            Предпочитаете соцсети?
            Вот наши странички:
          </p>
          
          <?php 
            $contacts_page_id = 7;
            $socials_list = get_field( 'contacts_socials', $contacts_page_id );
          ?>
          
          <?php if (!empty($socials_list) && is_array($socials_list)): ?>
            <ul class="socials-list socials-list--turned">
              <?php if (!empty($socials_list['instagram'])): ?>
                <li class="socials-list__item socials-list__item--instagram">
                  <a href="<?= $socials_list['instagram']; ?>" target="_blank">
                    <span class="visually-hidden">instagram</span>
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
              
              <?php if (!empty($socials_list['vk'])): ?>
                <li class="socials-list__item socials-list__item--vk">
                  <a href="<?= $socials_list['vk']; ?>" target="_blank">
                    <span class="visually-hidden">Вконтакте</span>
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
              
              <!-- <?php if (!empty($socials_list['telegram'])): ?>
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
              <?php endif; ?> -->
            </ul>
          <?php endif; ?>
        </div>
        <p class="thanks-section__end-text">
          Рады сотрудничеству, приятного дня!
        </p>

      <?php endif; ?>

    </div>
  </section>

