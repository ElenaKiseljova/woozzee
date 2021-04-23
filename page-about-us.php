<?php 
  /*
    Template Name: О компании
  */
?>

<?php
  get_header(  );
?>

<?php 
  /* ID страницы для ACF полей */
  
  $id_page = get_the_id();
?>

<main class="page-main page-main--about-us">
  <?php 
    if ( function_exists( 'woozzee_yoast_breadcrumbs' ) ) {
      $class_breadcrumbs = 'breadcrumbs breadcrumbs--outer';
      
      woozzee_yoast_breadcrumbs($class_breadcrumbs);
    }
  ?>
  
  <section class="page-main__section page-main__section--video video-section">
    <div class="video-section__wrapper">
      <div class="video-section__video-wrapper">
        <video src="<?php the_field( 'about_video_file' ); ?>" poster="<?php the_field( 'about_video_poster' ); ?>"></video>
        <button type="button" class="video-section__button"><span class="visually-hidden">Играть</span></button>
      </div>
    </div>
  </section>
  <section class="page-main__section page-main__section--decription description-section">
    <div class="description-section__wrapper">
      
      <?php 
        if ( function_exists( 'woozzee_yoast_breadcrumbs' ) ) {
          $class_breadcrumbs = 'breadcrumbs breadcrumbs--inner';
          
          woozzee_yoast_breadcrumbs($class_breadcrumbs);
        }
      ?>
      
      <div class="page-main__content page-main__content--about-1">
        <div class="description-section__text">
          <?php the_field( 'about_content_1'); ?>
        </div>      
        
        <?php 
          $section_about_images_1 = get_field( 'about_images_1' );
        ?>
        <ul class="description-section__img-list">
          <li class="description-section__img-wrapper">
            <?php if ($section_about_images_1['img_1'] && is_array($section_about_images_1['img_1'])): ?>
              <img src="<?= $section_about_images_1['img_1']['url']; ?>" alt="<?= $section_about_images_1['img_1']['alt']; ?>">
            <?php endif; ?>            
          </li>
          <li class="description-section__img-wrapper">
            <?php if ($section_about_images_1['img_2'] && is_array($section_about_images_1['img_2'])): ?>
              <img src="<?= $section_about_images_1['img_2']['url']; ?>" alt="<?= $section_about_images_1['img_2']['alt']; ?>">
            <?php endif; ?>  
          </li>
          <li class="description-section__img-wrapper">
            <?php if ($section_about_images_1['img_3'] && is_array($section_about_images_1['img_3'])): ?>
              <img src="<?= $section_about_images_1['img_3']['url']; ?>" alt="<?= $section_about_images_1['img_3']['alt']; ?>">
            <?php endif; ?>  
          </li>
        </ul>  
      </div>      
      
      <div class="page-main__content page-main__content--about-2">
        <div class="description-section__text">
          <?php the_field( 'about_content_2'); ?>
        </div>
        <?php 
          $section_about_images_2 = get_field( 'about_images_2' );
        ?>
        <ul class="description-section__img-list">
          <li class="description-section__img-wrapper">
            <?php if ($section_about_images_2['img_1'] && is_array($section_about_images_2['img_1'])): ?>
              <img src="<?= $section_about_images_2['img_1']['url']; ?>" alt="<?= $section_about_images_2['img_1']['alt']; ?>">
            <?php endif; ?>            
          </li>
        </ul>
      </div>      
    </div>
  </section>
  
  <?php 
    $hit_toggle = get_field( 'hit_toggle' );
  ?>
  
  <?php if (!empty($hit_toggle) && $hit_toggle == 'Да'): ?>
    
  <section class="page-main__section page-main__section--hit hit-section">
    <div class="hit-section__wrapper">
      
      <h2 class="hit-section__title">
        <span class="hit-section__free">
          <?php the_field( 'hit_title' ); ?>
        </span>
      </h2>
      <div class="hit-section__info">
        <p class="hit-section__text">
          <?php the_field( 'hit_text' ); ?>
        </p>
        <p class="hit-section__sub-text">
          <?php the_field( 'hit_subtext' ); ?>
        </p>
        <a href="<?php the_field( 'hit_link' ); ?>" class="hit-section__catalog-link"target="blank">
          ПОДРОБНЕЕ
        </a>
      </div>
    </div>
  </section>
  
  <?php endif; ?> 
  
  <section class="page-main__section page-main__section--text-block text-block">
    <div class="page-main__content page-main__content--about-3">
      <div class="description-section__text">
        <?php the_field( 'about_content_3'); ?>
      </div>
      <?php 
        $section_about_images_3 = get_field( 'about_images_3' );
      ?>
      <ul class="description-section__img-list">
        <li class="description-section__img-wrapper description-section__img-wrapper--tall">
          <?php if ($section_about_images_3['img_1'] && is_array($section_about_images_3['img_1'])): ?>
            <img src="<?= $section_about_images_3['img_1']['url']; ?>" alt="<?= $section_about_images_3['img_1']['alt']; ?>">
          <?php endif; ?>            
        </li>
      </ul>
    </div>
  </section>
  
  <?php get_template_part( 'template-parts/contact', 'form' ) ?>
  
</main>

<?php
  get_footer(  );
?>