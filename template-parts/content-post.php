<li class="link-list__item link-list__item--hover-shadow">
  <a href="<?php echo get_permalink(  ); ?>">
    <div class="link-list__img-wrapper">
      <?php if (has_post_thumbnail()): ?>
        <?php the_post_thumbnail(); ?>
      <?php endif; ?>
    </div>                        
    
    <?php the_title(); ?>
  </a>
</li>