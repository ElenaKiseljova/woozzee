<?php 
  global $id_page;
  
  $contacts_toggle = get_field( 'contacts_toggle', $id_page );
?>

<?php if (!empty($contacts_toggle) && $contacts_toggle == 'Да'): ?>
  <?php 
    $class_section = 'page-main__section page-main__section--contact contact-section contact-section--white';
    
    if (is_front_page()) {
      $class_section = 'page-main__section page-main__section--contact contact-section';
    } else if( is_page_template( 'page-about-us.php' ) ) {
      $class_section = 'page-main__section page-main__section--contact contact-section';
    } else if( is_page_template( 'page-exclusive.php' ) ) {
      $class_section = 'page-main__section page-main__section--contact contact-section';
    }
  ?>
  <section class="<?= $class_section; ?>">
    <div class="contact-section__wrapper">
      <h2 class="contact-section__title">
        <?php the_field( 'contacts_title', $id_page ); ?>
      </h2>
      <div class="contact-section__form" id="form-bottom">
        <?php if ( is_page_template( 'page-about-us.php' ) ): ?>
          <?php echo do_shortcode( '[contact-form-7 id="584" title="Написать Антону"]' ); ?>
        <?php else : ?>
          <?php echo do_shortcode( '[contact-form-7 id="448" title="Напишите нам"]' ); ?>
        <?php endif; ?>        
      </div>
      
      <p class="contact-section__text">
        Нажимая на кнопку, вы даете согласие
        <br>
        на обработку персональных данных<br>и соглашаетесь c 
        <a href="<?php echo get_privacy_policy_url(); ?>">
          политикой
          <br>
          конфиденциальности
        </a>
      </p>
      <p class="contact-section__subtext">
        <?php the_field( 'contacts_love', $id_page ); ?>
      </p>
    </div>
  </section>
<?php endif; ?>