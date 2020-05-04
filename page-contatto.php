
<?php get_header(); ?>

<div class="ui fluid a-background-main container">
  <div class="a-spacer"></div>
  <div class="ui centered grid stackable container" style="height:100%">
    <div class="nine wide column" style='background:linear-gradient(180deg, white, transparent);'>
      <div class='a-mobile-padder'>
        <div class="ui header">Idee, commenti, critiche, richieste..</div>
          <?php
          while(have_posts()){
            the_post(); 
            the_content();
          }  
          ?>
        </div>
      </div>
  </div>
</div>
<?php get_footer(); ?>