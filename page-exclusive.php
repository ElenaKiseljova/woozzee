<?php 
  /*
    Template Name: Эксклюзив
  */
?>

<?php
  get_header(  );
?>

<?php 
  /* ID страницы для ACF полей */
  
  $id_page = get_the_id();
?>

<main class="page-main page-main--exclusive">
  <?php 
    if ( function_exists( 'woozzee_yoast_breadcrumbs' ) ) {
      $class_breadcrumbs = 'breadcrumbs breadcrumbs--outer';
      
      woozzee_yoast_breadcrumbs($class_breadcrumbs);
    }
  ?>
  <section class="page-main__section page-main__section--video video-section">
    <div class="video-section__wrapper video-section__wrapper--gradient">
      <div class="video-section__video-wrapper">
        <video src="<?php the_field( 'about_video_file' ); ?>" poster="<?php the_field( 'about_video_poster' ); ?>"></video>
        <button type="button" class="video-section__button">
          <span class="visually-hidden">Играть</span>
        </button>
      </div>
      <div class="video-section__gradient"></div>
    </div>
  </section>
  <?php 
    if ( function_exists( 'woozzee_yoast_breadcrumbs' ) ) {
      $class_breadcrumbs = 'breadcrumbs breadcrumbs--inner';
      
      woozzee_yoast_breadcrumbs($class_breadcrumbs);
    }
  ?>
  
  <?php 
    $looking_for = get_field( 'looking_for' );
  ?>
  
  <?php if (!empty($looking_for) && is_array($looking_for)): ?>
    <section class="page-main__section page-main__section--idea idea-section">
      <div class="idea-section__wrapper">
        <?php if ($looking_for['title']): ?>
          <h1 class="idea-section__title">
            <?= $looking_for['title']; ?>
          </h1>
        <?php endif; ?>
        <?php if ($looking_for['subtitle']): ?>
          <p class="idea-section__text">
            <?= $looking_for['subtitle']; ?>
          </p>
        <?php endif; ?>
        <?php if ($looking_for['text']): ?>
          <p class="idea-section__description">
            <?= $looking_for['text']; ?>
          </p>
        <?php endif; ?>
      </div>
    </section>
  <?php endif; ?>
  
  <section class="page-main__section page-main__section--contact contact-section contact-section--idea">
    <div class="contact-section__wrapper">
      <div class="contact-section__form">
        <?php echo do_shortcode( '[contact-form-7 id="713" title="Эксклюзив"]' ); ?>      
      </div>
      <a href="<?php echo get_privacy_policy_url(); ?>" class="contact-section__confident-policy">
        Политика конфиденциальности
      </a>
    </div>
  </section>
  
  <?php 
    $no_limit = get_field( 'no_limit' );
  ?>
  <?php if (!empty($no_limit) && is_array($no_limit)): ?>
    <section class="page-main__section main-site-section">
      <div class="main-site-section__wrapper">
        <div class="main-site-section__img-wrapper">
          <?php if ($no_limit['image']): ?>
            <img src="<?= $no_limit['image']['url']; ?>" alt="<?= $no_limit['image']['alt']; ?>">
          <?php endif; ?>          
        </div>
        
        <?php if ($no_limit['text']): ?>
          <p class="main-site-section__text">
            <?= $no_limit['text']; ?>
          </p>
        <?php endif; ?>
          
        <?php if ($no_limit['link']): ?>
          <a href="<?= $no_limit['link']; ?>" class="main-site-section__link">
            Перейти на сайт
          </a>
        <?php endif; ?>
        
      </div>
    </section>
  <?php endif; ?>

  <?php get_template_part( 'template-parts/contact', 'form' ) ?>
</main>

<?php
  get_footer(  );
?>