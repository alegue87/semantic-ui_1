<?php get_header(); ?>

<div class="ui fluid a-main container">
  <?php while(have_posts()): the_post(); ?>
  <article class="ui a-post grid container">
    <div class="centered stackable row">
      <div class="nine wide column">
        <h2 class="ui centered header"><?php the_title(); ?></h2>  
        <?php the_content(); ?>
        <?php wp_link_pages(array(
          'before' => '
            <div class="ui segment">
              <div class="page-nav">Pagina: ',
          'after'  => '
              </div>
            </div>'
        ));
        ?>      
        <div class="column">
          <?php
          get_template_part('parts/comments');
          ?>
        </div>
      </div>
    </div>
  </article>
  <?php endwhile; ?>
</div>
<?php get_footer(); ?>