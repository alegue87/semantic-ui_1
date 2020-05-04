<?php

/***********************************************************************/
/* Actions
/***********************************************************************/
function semantic_ui_setup(){
  //wp_deregister_script('jquery');
  //wp_enqueue_script('main-js', get_theme_file_uri('/dist/jquery-3.1.1.min.js'), null , microtime(), $in_footer=true);

  wp_enqueue_script('semantic-ui', get_theme_file_uri('/dist/semantic.js'), null , microtime(), $in_footer=true);
  wp_enqueue_script('main-js', get_theme_file_uri('main.js'), array('jquery') , microtime(), $in_footer=true);
  wp_enqueue_script('visibility', get_theme_file_uri('/dist/components/visibility.js'), array('jquery'), microtime(), true);
  wp_enqueue_script('jqcloud', get_theme_file_uri('/dist/jqcloud/jqcloud.min.js'), array('jquery'), microtime(), true);
  wp_enqueue_style('jqcloud-css', get_theme_file_uri('/dist/jqcloud/jqcloud.min.css'), null, microtime(), 'all');
  wp_enqueue_style('semantic-ui-css', get_theme_file_uri('/dist/semantic.css'), null, microtime(), 'all');
  wp_enqueue_style('base-css', get_theme_file_uri('/style.css'), null, microtime(), 'all');
  if(is_page('contatto')){
    wp_deregister_script('contact-form-7');
    wp_enqueue_script('wpcf7-mods', get_theme_file_uri('/dist/wpcf7-edit.js'), array('jquery'), microtime(), true);
  }
}

function semantic_ui_init(){
  add_theme_support('post-thumbnails');
  add_theme_support('title-tag');
  add_theme_support('html5');
  add_theme_support('responsive-embeds');
}

add_action('wp_enqueue_scripts', 'semantic_ui_setup');
add_action('after_setup_theme', 'semantic_ui_init');

/***********************************************************************/
/* Filters
/***********************************************************************/
require('filters/wpcf7.php');

/*
  create_list

  Costruisce lista di key values da:
  $li: lista di oggetti ( iterabili )
*/
function extract_and_append(&$list, $li){
  foreach($li as $elem){
    $num = explode(' ', $elem->nodeValue)[0];
    $text = explode($num, $elem->nodeValue)[1];
    $elem->setAttribute('id', $num);      
    $list += array($num => $text);
  }

}
function add_content_menu($content){  
  // Aggiunge menu solo per la pagina del post singolo e roadmap
  if(!is_single() && !is_page('roadmap')) return $content;

  $dom = new DOMDocument;
  $dom->encoding = 'utf-8';
  @$dom->loadHTML(utf8_decode($content)); // per caratteri particolari tipo Ã
  // la '@' elimina gli warning dati da entità non riconosciute:
  // tipo <figure> ecc.. 

  $headers_list  = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6');
  $tags_list = array();
  foreach($headers_list as $header){
    array_push($tags_list, $dom->getElementsByTagName($header));
  }

  $kw_list = array();
  for($i=0; $i<6; $i++){
    extract_and_append($kw_list, $tags_list[$i]);
  }

  ksort($kw_list);

  $menu = '<div class="contents-menu"><ul>';
  foreach($kw_list as $num => $text ){
    $menu .= '<li><a href="#'. $num . '">' . $num . ' ' . $text . '</a></li>';
  }
  $menu .= '</ul></div>';

  $content = $dom->saveHTML();
  return $menu.$content;
}

add_filter('the_content', 'add_content_menu');

function set_embed_class($classes){
  if(!is_single()) return $classes;
  if(in_array('wp-embed', $classes)){
    $classes = array_merge($classes, array('wp-embed-fix-padding'));  
  }
  return $classes;
}
add_filter('post_class', 'set_embed_class');



/***********************************************************************/
/* Actions
/***********************************************************************/
function fix_padding(){
  if(!is_single()) return;
  echo '
  <style>
    /* essenzialmente per mobile */
    .wp-embed-fix-padding {
      padding:10px!important;
      text-align:justify;
    }
  </style>';
}
add_action('embed_head', 'fix_padding');

function my_js_variables(){
  $script = '<script type="text/javascript">'.
    'var home_url=' . json_encode(home_url()) .
  '</script>';
  echo $script;
}
add_action('wp_head', 'my_js_variables');

/***********************************************************************/
/* Utility
/***********************************************************************/
function print_the_categories($return=false){
  $categories = get_the_category();
  $separator = ' ';
  $output = '';
  if(! empty($categories) ){
    foreach($categories as $category){
      $output .= 
      '<span href="' . esc_url( get_category_link( $category->term_id ) ) . '"'. 
      'class="category-or-tag-link"'.
      'alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . 
      '">' . esc_html( $category->name ) . '</span>' . $separator;
    }
    $output = trim($output, $separator);
    if($return) return $output;
    echo $output; 
  }
}

function print_the_tags($return=false){
  $tags = get_the_tags();
  $output = '';
  if(!empty($tags)){
    foreach($tags as $tag){
      $output .= '<div class="ui circular label category-or-tag-link" href="'. 
      get_tag_link($tag->term_id) . '">' . $tag->name . '</div>';
    }
    $output = trim($output, ' | ');
    if($return) return $output;
    echo $output; 
  }          
}
?>