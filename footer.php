<?php 
  // IDs для ACF
  
  $contacts_page_id = 7;
  $pay_page_id = 112;
  
  $count_pay_methods = 3;
?>

    <footer class="page-footer">
      <div class="page-footer__wrapper">
        <div class="page-footer__info">
          <?php
            wp_nav_menu(
              array(
                'theme_location'  => 'bottom_menu_left',
                'container'       => null,
                'menu_class'      => 'page-footer__list',
                'depth'           => 1,
              )
            );
          ?>
          <?php
            wp_nav_menu(
              array(
                'theme_location'  => 'bottom_menu_right',
                'container'       => null,
                'menu_class'      => 'page-footer__list',
                'depth'           => 1,
              )
            );
          ?>
          
          <div class="page-footer__contacts">
            
            <?php 
              $phone_footer = get_field( 'contacts_phone_footer', $contacts_page_id );
            ?>
            
            <?php if (!empty($phone_footer) && is_array($phone_footer)): ?>
              <a href="tel:<?= $phone_footer['link']; ?>" class="page-footer__link page-footer__link--phone">
                <?= $phone_footer['text']; ?>
              </a>
            <?php endif; ?>
            
            <?php 
              $socials_list = get_field( 'contacts_socials', $contacts_page_id );
            ?>
            
            <?php if (!empty($socials_list) && is_array($socials_list)): ?>
              <ul class="socials-list">
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
            
            <a href="mailto:<?php the_field( 'contacts_email', $contacts_page_id ); ?>" class="page-footer__link page-footer__link--email">
              <?php the_field( 'contacts_email', $contacts_page_id ); ?>
            </a>
            <address class="page-footer__address">              
              <?php the_field( 'contacts_address', $contacts_page_id ); ?>
            </address>
            <p class="page-footer__time">              
              <?php the_field( 'contacts_worktime', $contacts_page_id ); ?>
            </p>
            <?php 
              $pay_methods = array();
              
              for ($i=1; $i <= $count_pay_methods; $i++) {
                $pay_method_title = get_field( 'pay_method_title_' . $i, $pay_page_id);
                $pay_method_image = get_field( 'pay_method_image_' . $i, $pay_page_id);
                $pay_method_link = get_field( 'pay_method_link_' . $i, $pay_page_id);
                
                if (!empty($pay_method_title) && !empty($pay_method_image) && is_array($pay_method_image)) {
                  $pay_method_item = array(
                    'title' => $pay_method_title,
                    'image' => $pay_method_image,
                    'link' => ''
                  );
                  
                  if (!empty($pay_method_link)) {
                    $pay_method_item['link'] = $pay_method_link;
                  }
                  
                  array_push($pay_methods, $pay_method_item);
                }
              }
            ?>
            <ul class="page-footer__payment-list">
              <?php foreach ($pay_methods as $pay_method): ?>
                <li class="page-footer__payment-item">
                  <a href="<?= $pay_method['link']; ?>">
                    <img src="<?= $pay_method['image']['url']; ?>" alt="<?= $pay_method['title']; ?>"> 
                    <span class="visually-hidden"><?= $pay_method['title']; ?></span>
                  </a>
                </li>
              <?php endforeach; ?>
              <!-- <li class="page-footer__payment-item">
                <a href="#">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/rectangle-228.png" alt="Яндекс"> 
                  <span class="visually-hidden">Яндекс</span>
                </a>
              </li>
              <li class="page-footer__payment-item">
                <a href="#">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/rectangle-229.png" alt="Web Money"> 
                  <span class="visually-hidden">Web Money</span>
                </a>
              </li>
              <li class="page-footer__payment-item">
                <a href="#">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/rectangle-230.png" alt="Visa Mastercard"> 
                  <span class="visually-hidden">Visa Mastercard</span>
                </a>
              </li> -->
            </ul>
          </div>
        </div>
        <div class="page-footer__bottom">
          <span class="page-footer__bottom-text">© 2021 Woozzee</span> 
          
          <?php 
            $privacy_link = get_theme_mod( 'footer_privacy_link', $default = false );
            $privacy_title = get_theme_mod( 'footer_privacy_text', $default = false );
            
            $privacy_link = $privacy_link ? $privacy_link : '';
            $privacy_title = $privacy_title ? $privacy_title : '';
          ?>
          <a href="<?= $privacy_link; ?>" id="privacy-footer" class="page-footer__bottom-text">
            <?= $privacy_title; ?>
          </a> 
          
          <?php 
            $document_link = get_theme_mod( 'footer_document_link', $default = false );
            $document_title = get_theme_mod( 'footer_document_text', $default = false );
            
            $document_link = $document_link ? $document_link : '';
            $document_title = $document_title ? $document_title : '';
          ?>
          <a href="<?= $document_link; ?>" id="document-footer" class="page-footer__bottom-text">
            <?= $document_title; ?>
          </a>
        </div>
        
      </div>
    </footer>

    <svg width="0" heigth="0" version="1.1" viewBox="0 0 100 30" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
      <defs>
        <linearGradient id="linearGradient" x1="0%" x2="100%" y1="0%" y2="20%">
          <stop stop-color="rgba(255, 255, 255, 0)" offset="0"/>
          <stop stop-color="rgba(255, 255, 255, 1)" offset="0.9"/>
        </linearGradient>
      </defs>
      <g id="border">
        <rect class="rect1" x="5%" y="5%" width="93%" height="90%" rx="12%"/>
      </g>
    </svg>
    
    <section class="popup popup--contact">
      <div class="popup__contact">
        <?php 
          echo do_shortcode( '[contact-form-7 id="722" title="Попап"]' );        
        ?>
      </div>
      
      <button class="popup__close popup__close--contact" type="button" name="close-search">
        <span class="visually-hidden">Закрыть</span>
      </button>
    </section>
    
    <div class="popup__overlay"></div>

    <?php
      wp_footer();
    ?>
  </body>
</html>
