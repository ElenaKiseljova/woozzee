<?php 
  /*
    Template Name: Доставка
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
  <section class="page-main__section page-main__section--page-info page-info page-info--delivery">
    <div class="page-info__wrapper">
      <h1 class="visually-hidden">
        <?php the_title(); ?>
      </h1>
      
      <?php get_template_part( 'template-parts/yoast', 'breadcrumbs' ); ?>
      
      <div class="page-main__content page-main__content--inner">
        <?php 
          the_content(  );
        ?>
      </div>
    </div>
  </section>
  
  <?php get_template_part( 'template-parts/contact', 'form' ) ?>
  
</main>

<?php
  get_footer(  );
?>