<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>

<?php
  $categories = get_categories( array(
    'orderby' => 'name',
    'order'   => 'ASC'
  ) );

  $the_categories = '';
  foreach( $categories as $category ) {
    $category_link = sprintf( 
        '<a class="item %5$s" href="%1$s" alt="%2$s"><span>%3$s </span> %4$s</a>',
        esc_url( get_category_link( $category->term_id ) ),
        esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ),
        esc_html( $category->name  ),
        '<span class="ui blue tiny basic label">'.$category->count.'</span>',
        get_active_if_page_is('/category/'.$category->name, $return=true)
    );
    $the_categories .= $category_link;
    /*
    echo '<p>' . sprintf( esc_html__( 'Category: %s', 'textdomain' ), $category_link ) . '</p> ';
    echo '<p>' . sprintf( esc_html__( 'Description: %s', 'textdomain' ), $category->description ) . '</p>';
    echo '<p>' . sprintf( esc_html__( 'Post Count: %s', 'textdomain' ), $category->count ) . '</p>';
    
    //var_dump(get_posts( array('category' => $category->term_id) ));
    $posts_list = get_posts( array('category' => $category->term_id));
    foreach($posts_list as $post){
      echo '<h2>'.$post->post_title.'</h2>';
    }
    */
  } 
?>

<?php

function get_active_if_page_is($slug, $return=false){
  // Recupera url corrente del tipo: "http:.../appunti"
  global $wp;
  $current_url = home_url( $wp->request );

  if($current_url == strtolower(site_url($slug))){
    if($return) return 'active';
    echo 'active';
  }
}
?>

<body class='wp-embed-responsive'>
  <nav class="ui fixed a-slideout menu ">
    <div class="ui container">
      <a 
        href="<?php echo site_url(); ?>" 
        class="item <?php get_active_if_page_is(''); ?>">Rocky mountain</a>
      <div class="right menu">
        <a 
          href="<?php echo site_url('/appunti'); ?>" 
          class="item <?php get_active_if_page_is('/appunti'); ?>">Appunti</a>
          <a 
          href="<?php echo site_url('/contatto'); ?>" 
          class="item <?php get_active_if_page_is('/contatto'); ?>">Contatto</a>
        <div 
          class="ui simple dropdown item 
          <?php if(get_active_if_page_is('/categorie', $return=true)=='active') echo 'a-active'; ?>">
          <a
            href="<?php echo site_url('/categorie'); ?>">Categorie</a>
          <i class="dropdown icon"></i>
          <div class="menu">
            <?= $the_categories; ?>
          </div>
        </div>
        <div class="item">
          <div class="ui search">
            <div class="ui left icon input">
              <input class="prompt" type="text" placeholder="Search..">
              <i class="search icon"></i>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <nav class="ui fixed a-mobile menu">

    <div class="ui fluid simple dropdown item">
      <!-- Il simple dropdown non funzionando con js, per uscirne è necessario cliccare al di fuori del menu -->
      <i class="sidebar icon"></i>
      <div class="fluid menu">
        <a href="<?php echo site_url('/appunti'); ?>" class="item <?php if(get_post_type() == 'post') echo 'active'; ?>">Appunti</a>
        <div class="ui divider"></div>
        <a 
          class="ui item header <?php get_active_if_page_is('/categorie'); ?>"
          href="<?php echo site_url('/categorie'); ?>">
        Categorie
        </a>
        <?php echo $the_categories; ?> 
        <a 
          class="ui item header <?php get_active_if_page_is('/contatto'); ?>"
          href="<?php echo site_url('/contatto'); ?>">
        Contatto
        </a>   
        <ui class="divider"></ui>
        <form 
          id="search-mobile" 
          class='ui item'
          action='<?php echo home_url(); ?>'
          method='get'
        >
          <div class="ui icon input">
            <input                  
              type="search"
              name="s" 
              placeholder="Search...">
          </div>
          <button class="ui icon button">
            <i class="search icon"></i>
          </button>
        </form>                    
      </div>
      <div class="ui container">
        <a href="<?php echo site_url(); ?>" class="">Rocky mountain</a>
      </div>
    </div>
  </nav>