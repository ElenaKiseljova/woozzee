<?php
  get_header(  );
?>

<main class="page-main page-main--blog">
  <?php 
    if ( function_exists( 'woozzee_yoast_breadcrumbs' ) ) {
      $class_breadcrumbs = 'breadcrumbs';
      
      woozzee_yoast_breadcrumbs($class_breadcrumbs);
    }
  ?>
 
  <section class="page-main__section page-main__section--articles articles-section page-main__section--single">
    <div class="articles-section__wrapper">            
       <?php
         if ( have_posts() ){
           while ( have_posts() ) {
             the_post();
             
             ?>
               <div class="articles-section__thumbnail">
                 <?php if (has_post_thumbnail()): ?>
                   <?php the_post_thumbnail(); ?>
                 <?php endif; ?>
               </div>
               
               <h1 class="articles-section__title articles-section__title--single">
                 <?php 
                   the_title();
                 ?>
               </h1>
               
               <div class="page-info__text">
                 <?php 
                   the_content(  );
                 ?>
               </div>
             <?php
           }
         }
       ?>   
    </div>
  </section>
  
</main>

<?php
  get_footer(  );
?>