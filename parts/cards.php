<div class="ui three stackable cards link">
  <?php while(have_posts()): the_post(); ?>
  <a href='<?php the_permalink(); ?>' class="ui card">
    <div class="ui image">
      <?php echo get_the_post_thumbnail(get_the_ID()); ?>
    </div>
    <div class="content">
      <div class="ui header"><?php the_title(); ?></div>
      <div class="meta">
        <?php print_the_categories(); ?>            
        <span class='a-time'>
          <?php the_time('F j, Y') ?>
        </span>
      </div>
      <div class="description"><?php echo wp_trim_words(get_the_excerpt(), 30); ?></div>
    </div>
    <div class="extra content">
      <?php
        print_the_tags();
      ?>
    </div>
  </a>
<?php endwhile; ?>
</div>