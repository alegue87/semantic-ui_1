<?php get_header(); ?>

<?php 
$args = array(
  'post_type' => 'post',
  'posts_per_page' => 6
);
$posts = new WP_Query($args);
?>

<div class="ui fluid a-background-main container"></div>

<div class="ui hidden divider"></div>

<section class="ui grid container">
  <div class="centered a-header row">
    <h3 class="ui header">Ultimi Appunti</h3>
  </div>
  <div class="row">
    <div class="ui three stackable cards link">
      <?php while($posts->have_posts()): $posts->the_post(); ?>
      <a href='<?php the_permalink(); ?>' class="ui card">
        <div class="ui image">
          <?php echo get_the_post_thumbnail(get_the_ID()); ?>
        </div>
        <div class="content">
          <div class="ui header"><?php the_title(); ?></div>
          <div class="meta">
            <?php print_the_categories(); ?>            
            <span style='text-align:right; float:right; width:auto'>
              <?php the_time('F j, Y') ?>
            </span>
          </div>
          <div class="description"><?php echo wp_trim_words(get_the_excerpt(), 30); ?></div>
        </div>
        <div class="extra content">
          <?php print_the_tags(); ?>
        </div>
      </a>
    <?php endwhile; ?>
  </div>
  <div class="row" id="search-results"></div>
</section> 
<?php get_footer(); ?>