<?php get_header(); ?>

<?php while(have_posts()): the_post(); ?>
<section class="ui a-post grid container">
  <div class="centered stackable row">
    <div class="nine wide column">
      <h2 class="ui centered header"><?php the_title(); ?></h2>  
      <?php the_content(); ?>
    </div>
  </div>
</section>
<?php endwhile; ?>

<?php get_footer(); ?>