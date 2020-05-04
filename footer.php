  <footer class="ui centered stackable grid ">
    <div class="row">

      <div class="two wide column"></div>

      <div class="black eight wide column" style='height:300px;'>
        <?php get_template_part('parts/tags-cloud'); ?>
      </div>           

      <div class="black four wide left aligned column">
        <div class="left aligned row">
          <h2 class="ui inverted header">Vai a..</h2>
          <div class="ui list">
            <div class="item"><a href="<?php echo site_url('/categorie'); ?>">Categorie</a></div>
            <div class="item"><a href="<?php echo site_url('/roadmap'); ?>">Roadmap</a></div>
          </div>
          <div class="ui divider"></div>
          <h2 class="ui inverted header">Thanks to</h2>
          <div class="ui list">
            <div class="item"><a 
              data-tooltip='..for the good tool!'
              data-position='bottom left'
              target='_blank' href="http://www.wordpress.com">WordPress</a></div>
            <div class="item"><a 
              data-tooltip='..for the beautiful images!'
              data-position='top left'
              target='_blank' href="http://unsplash.com">Unsplash</a></div>
            <div class="item"><a 
              data-tooltip='..for the intuitive ui and responsive design!'
              data-position='top right'
              target='_blank' href="http://semantic-ui.com">Semantic-ui</a></div>
            <div class="item"><a 
              data-tooltip='..for the simple tags cloud!'
              data-position='top left'
              target='_blank' href="https://github.com/mistic100/jQCloud">Mistic100</a></div>
          </div>
        </div>
      </div>

      <div class="two wide column"></div>

    </div>
  </footer>

<?php wp_footer(); ?>

</body>

</html>