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
 
  <section class="page-main__section page-main__section--articles articles-section">
    <div class="articles-section__wrapper">
       <h1 class="articles-section__title visually-hidden">
         Советы и лайфхаки
       </h1>
       
       <ul class="articles-section__goods-list link-list">
         <?php
           if ( have_posts() ){
             while ( have_posts() ) {
               the_post();
               
               get_template_part( 'template-parts/content', 'post' );
             }
           } else {
             get_template_part( 'template-parts/content', 'none' );
           }
         ?>           
       </ul>
    </div>
  </section>
</main>

<?php
  get_footer(  );
?>