<?php get_header(); ?>
<div class="ui fluid a-main container">
  <section class="ui grid container">
    <div class="centered a-header row">
      <h3 class="ui header">Appunti</h3>
    </div>
    <div class="row">
      <?php get_template_part('parts/cards'); ?>
    </div>
    <?php if(paginate_links()): ?>
    <div class="center aligned row">
      <div class="ui segment  column">
      <?php echo paginate_links(); ?>
      </div>
    </div>  
    <?php endif; ?>
  </section>
</div>
<?php get_footer(); ?>