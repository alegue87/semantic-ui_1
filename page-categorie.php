<?php get_header(); ?>
<div class="ui fluid a-main container">

  <div class="ui grid container">
    <div class="centered a-header row">
      <h3 class="ui header">Categorie</h3>
    </div>
    <div class="row">
      <div class="ui  styled fluid accordion">
      <?php
      function fill_card($post){
        $permalink = get_the_permalink($post->term_id);
        $thumbnail = get_the_post_thumbnail($post->term_id);
        $title = get_the_title( $post );
        $date = get_the_date('F j, Y', $post);
        $excerpt = get_the_excerpt($post);
        $card = sprintf('
          <a href="%1$s" class="ui card">
            <div class="ui image">
              %2$s
            </div>
            <div class="content">
              <div class="ui header">%3$s</div>
              <div class="meta">
                %4$s
                <span class="a-time">
                  %5$s
                </span>
              </div>
              <div class="description">%6$s</div>
            </div>
            <div class="extra content">
              %7$s
            </div>
          </a>',
          $permalink,
          $thumbnail,
          $title,
          print_the_categories($return=true),
          $date,
          wp_trim_words($excerpt, 30),
          print_the_tags($return=true)
        );
        return $card;
      }

      $categories = get_categories( array(
        'orderby' => 'name',
        'order'   => 'ASC'
      ) );
      $accordion = '';
      foreach($categories as $category){

        $posts = get_posts(array('category_name'=>$category->name));
        $post_cards = '';
        if(!empty($posts)){
          foreach($posts as $post){
            $post_cards .= fill_card($post);
          }  
        }     

        $accordion .= sprintf( /* funziona solo se la stringa è raccolta da apici singoli! */
          '<div class="title">'.
            '%1$s <i class="dropdown icon"></i>'.
          '</div>'.
          '<div class="content">'.
            '<div class="ui three stackable cards link">%2$s</div>'.
          '</div>',
          $category->name,
          $post_cards
        );
      }
      echo $accordion;
      ?>  
      </div>
    </div>
  </div>

</div>
<?php get_footer(); ?>