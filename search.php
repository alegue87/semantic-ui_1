<?php 

if($_SERVER['REQUEST_METHOD'] === 'POST'){

  header('Content-Type: application/json');

  $results = array();
  while(have_posts()){
    the_post();
    $results[] = array('html' => '
    <a class="result" href="'. get_the_permalink() .'">
      <div class="image">
        <img src="'. (has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID()) : '') .'"></div>
        <div class="content"><div class="title">'. get_the_title() .'</div>
        <div class="description">'. wp_trim_words(get_the_excerpt(), 10) .'</div>
      </div>
    </a>');
  }
  echo json_encode(array('results' => $results));

  die();  
}

get_header();
?>
<div class="ui fluid a-main container">
  <section class="ui grid container">
    <div class="centered a-header row">
      <h3 class="ui header">
        Ricerca per: "<?php echo get_search_query(); ?>"
      </h3>
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
