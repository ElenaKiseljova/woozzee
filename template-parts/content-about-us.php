<?php 
  $catalog_page_id = get_option( 'woocommerce_shop_page_id' );

  if (!$catalog_page_id) {
    $catalog_page_id = 24;
  }

  $about_toggle = get_field( 'about_toggle', $catalog_page_id );
?>

<?php if (!empty($about_toggle) && $about_toggle == 'Да'): ?>
  <section class="page-main__section page-main__section--about-us about-us">
    <div class="about-us__wrapper">
      
      <ul class="about-us__list">
        <?php 
          for ($advantage=1; $advantage <= 5; $advantage++) {
            ?>
              <li class="about-us__item" style="background-image: url('<?php the_field( 'about_advantage_icon_' . $advantage, $catalog_page_id ); ?>');">
                <h3 class="about-us__item-title">
                  <?php the_field( 'about_advantage_title_' . $advantage, $catalog_page_id ); ?>
                </h3>
                <p class="about-us__item-text">
                  <?php the_field( 'about_advantage_text_' . $advantage, $catalog_page_id ); ?>
                </p>
              </li>
            <?php
          }
        ?>
      </ul>
    </div>
  </section>
<?php endif; ?>