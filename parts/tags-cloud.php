<?php

$posts = get_posts(array('numberposts' => -1));

$cloud = array(); // 'slug'
                  // 'occurrences'
                  // 'link'
$tags = array();
foreach($posts as $p){
  $tags = get_the_tags($p->ID);
  //no get_tag_link();
  if($tags){
    foreach($tags as $tag){
      $slug = $tag->slug;
      if(isset($cloud[$slug])){
        $count = $cloud[$slug]['count'] +1 ;
        $cloud[$slug]['count'] = $count;
      }
      else{
        $cloud[$slug] = array(
          'count' => 1,
          'link' => get_home_url().'/tag/'.$slug
        );
      }
    }
  }  
}

$tags_list = array();
foreach($cloud as $tag => $data){
  $tmp = array(
    'text' => $tag,
    'weight' => $data['count']*0.1,
    'link' => $data['link']
  );
  array_push($tags_list, $tmp);
}
//var_dump($cloud);

echo "<div id='tags-cloud' style='width:100%;height:100%' data='" . json_encode($tags_list) . "'></div>";
?>


