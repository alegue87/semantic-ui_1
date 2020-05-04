<?php get_header(); ?>
<div class="ui fluid a-main container">
  <section class="ui grid container">
    <div class="centered a-header row">
      <h3 class="ui header"><?php the_archive_title();  ?></h3>
    </div>
    <div class="row">
      <?php get_template_part('parts/cards'); ?>
    </div>
  </section>
</div>
<?php get_footer(); ?>