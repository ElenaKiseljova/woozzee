<?php 
  /*
    Template Name: Юридическим лицам
  */
?>

<?php
  get_header(  );
?>

<?php 
  /* ID страницы для ACF полей */
  
  $contacts_page_id = 7;
  $id_page = get_the_id();
?>

<main class="page-main page-main--legal-entities">
  <?php 
    if ( function_exists( 'woozzee_yoast_breadcrumbs' ) ) {
      $class_breadcrumbs = 'breadcrumbs breadcrumbs--outer';
      
      woozzee_yoast_breadcrumbs($class_breadcrumbs);
    }
  ?>
  <section class="page-main__section page-main__section--title-banner title-banner-section">
    <div class="title-banner-section__wrapper">
      <h1 class="title-banner-section__title">
        <?php the_field( 'legal_title_yellow' ); ?>
      </h1>
      <p class="title-banner-section__text">
        <?php the_field( 'legal_subtitle' ); ?>
      </p>
    </div>
  </section>
  <?php 
    if ( function_exists( 'woozzee_yoast_breadcrumbs' ) ) {
      $class_breadcrumbs = 'breadcrumbs breadcrumbs--inner';
      
      woozzee_yoast_breadcrumbs($class_breadcrumbs);
    }
  ?>
  
  <?php 
    $legal_advantages = get_field( 'legal_advantages' );
  ?>
  
  <?php if (!empty($legal_advantages) && is_array($legal_advantages)): ?>
    <section class="page-main__section page-main__section--about-us about-us">
      <div class="about-us__wrapper">
        <?php if ($legal_advantages['title']): ?>
          <h2 class="about-us__title about-us__title--blue">
            <?= $legal_advantages['title']; ?>
          </h2>
        <?php endif; ?>
        
        
        <ul class="about-us__list">
          <?php 
            for ($adv=1; $adv <= 7; $adv++) {
              ?>
                <li class="about-us__item about-us__item--alt" <?php if ($legal_advantages['image_' . $adv]) echo 'style="background-image: url(' . $legal_advantages['image_' . $adv] . ');"'; ?>>
                  <div class="about-us__item-text about-us__item-text--blue">
                    <?php if ($legal_advantages['description_' . $adv]): ?>
                      <?= $legal_advantages['description_' . $adv]; ?>
                    <?php endif; ?>
                  </div>
                </li>
              <?php
            }
          ?>
        </ul>
      </div>
    </section>
  <?php endif; ?>
  
  <?php 
    $legal_benefit = get_field( 'legal_benefit' );
  ?>
  
  <?php if (!empty($legal_benefit) && is_array($legal_benefit)): ?>
    <section class="page-main__section page-main__section--details details">
      <div class="details__wrapper">
        <?php if ($legal_benefit['title']): ?>          
          <h2 class="details__title">
            <?= $legal_benefit['title']; ?>
          </h2>
        <?php endif; ?>
        
        <?php if ($legal_benefit['details']): ?>
          <p class="details__text">
            <?= $legal_benefit['details']; ?>
          </p>
        <?php endif; ?>
        
        <?php if ($legal_benefit['details_bold']): ?>
          <p class="details__text details__text--bold">
            <?= $legal_benefit['details_bold']; ?>
          </p>
        <?php endif; ?>
        
        <div class="details__link-wrapper">
          <?php if ($legal_benefit['details_price']): ?>
            <p class="details__about">
              <?= $legal_benefit['details_price']; ?>
            </p>
          <?php endif; ?>
          
          <?php if ($legal_benefit['file']): ?>
            <a class="details__download-link" href="<?= $legal_benefit['file']; ?>" download target="_blank">
              СКАЧАТЬ КП
            </a>
          <?php endif; ?>
          
        </div>
        
        <?php if ($legal_benefit['text_bottom']): ?>
          <p class="details__contact-us">
            <?= $legal_benefit['text_bottom']; ?>
          </p>
        <?php endif; ?>
        
      </div>
    </section>
  <?php endif; ?>
  
  <?php 
    $hit = get_field( 'hit' );
  ?>
  
  <?php if (!empty($hit) && is_array($hit)): ?>
    <section class="page-main__section page-main__section--hit hit-section">
      <div class="hit-section__wrapper">
        <?php if ($hit['content']): ?>          
          <div class="hit-section__text">
            <?= $hit['content']; ?>
          </div>
        <?php endif; ?>
        
        <?php if ($hit['link']): ?>
          <a href="<?= $hit['link']; ?>" class="hit-section__catalog-link">
            Подробнее
          </a>
        <?php endif; ?>
        
        <?php if ($hit['bold']): ?>
          <p class="hit-section__sub-text">
            <?= $hit['bold']; ?>
          </p>
        <?php endif; ?>        
      </div>
    </section>
  <?php endif; ?>
  
  <section class="page-main__section page-main__section--consultatiton consultation-section">
    <div class="consultation-section__wrapper">
      <h2 class="consultation-section__title">Бесплатная консультация</h2>
      <?php 
        $phone_footer = get_field( 'contacts_phone_footer', $contacts_page_id );
      ?>
      
      <?php if (!empty($phone_footer) && is_array($phone_footer)): ?>
        <a href="tel:<?= $phone_footer['link']; ?>" class="consultation-section__link consultation-section__link--phone">
          <?= $phone_footer['text']; ?>
        </a>
      <?php endif; ?>
      
      <a href="mailto:<?php the_field( 'contacts_email', $contacts_page_id ); ?>" class="consultation-section__link consultation-section__link--mail">
        <?php the_field( 'contacts_email', $contacts_page_id ); ?>
      </a>
    </div>
  </section>
</main>

<?php
  get_footer(  );
?>