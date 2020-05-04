
<?php

/*
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );
//$required_text = ' ( * campi necessari )';

//$consent = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';

$fields = array(
  'author' =>
    '<div class="ui fluid labeled input">'.
      '<div class="ui label">Nome</div>' .
      '<input id="author" name="author" type="text" placeholder="..o nick name.. "/>'.
    '</div>',

  'email' =>
    '<div class="ui fluid labeled input">'.
      '<div class="ui label">Email</div>'.
      '<input id="email" name="email" type="text" placeholder="email@example.it"/>'.
    '</div>',
);

$args = array(
  'class_form' => 'ui reply form',
  'title_reply' => 'Lascia un commento',
  'title_reply_to' => __('Lascia un commento a %s'),
  'label_submit' => 'label',
  'comment_field' => 
    '<div class="comment-form-comment field">' .  
      '<textarea id="comment" name="comment" aria-required="true"></textarea>'.
    '</div>',
  'comment_notes_before' => 
    '<i class="comment-notes">' .
      'La mail non verrà resa pubblica.', //. ( $req ? $required_text : '' ) .
    '</i>',
  'fields' => $fields
);


//comment_form($args);

*/
?>

<?php
  isset($_GET['replytocom']) ? $replymode = true : $replymode = false;
?>
<div class="ui minimal comments">
  <h3 class="ui dividing header">Commenti</h3>
  <?php 
  if(get_comments_number() != 0){
    $comments = get_comments(array(
      'post_id' => $post->ID
      //'status' => 'approved'          
    ));
    wp_list_comments(array(/*'per_page' => 15,*/   'style' => 'div', 'callback'=>'mytheme_comment'), $comments);
  }
  ?>
  <form 
    action="<? echo get_home_url(); ?>/wp-comments-post.php" method='post' 
    class="ui reply form" 
    id='respond'
  >
    <div class="field">
      <?php echo comment_form_title("Lascia un commento", "Lascia un commento a %s"); ?> 
      <?= $replymode ? 'o' : '' ?> 
      <?php echo cancel_comment_reply_link("Cancella reply"); ?>
    </div>
    <div class="field comment-form-comment">
      <textarea id="comment" name="comment" aria-required="true" tabindex='1'></textarea>
    </div>

    <?php if(!is_user_logged_in()): ?>
    <div class="field">
      <div class="ui fluid labeled input">
        <div class="ui label">Nome</div>
        <input id="author" name="author" type="text" placeholder="..o nick name.. " tabindex='2'/>
      </div>
    </div>
    <div class="field">
      <div class="ui fluid labeled input">
        <div class="ui label">Email</div>
        <input id="email" name="email" type="text" placeholder="email@example.it" tabindex='3'/>
      </div>
    </div>  
    <div class="field">
      <i class="comment-notes">La mail non verrà resa pubblica.</i>
    </div>
    <?php endif; ?>

    <div class="ui blue labeled submit icon button" type='submit' tabindex='4'>
      <i class="icon edit"></i>Invia
    </div>
    <input type="hidden" name="comment_post_ID" value="<?php echo get_the_ID(); ?>" id="comment_post_ID">
    <input 
      type="hidden" name="comment_parent" id="comment_parent"
      value="<?php echo (isset($_GET['replytocom']) ? $_GET['replytocom'] : 0); ?>">
  </form>  
</div>

<!--
<div class="ui minimal comments">
  <h3 class="ui dividing header">Comments</h3>
  <div class="comment">
    <a class="avatar">
      <img src="/images/avatar/small/matt.jpg">
    </a>
    <div class="content">
      <a class="author">Matt</a>
      <div class="metadata">
        <span class="date">Today at 5:42PM</span>
      </div>
      <div class="text">
        How artistic!
      </div>
      <div class="actions">
        <a class="reply">Reply</a>
      </div>
    </div>
  </div>
  <div class="comment">
    <a class="avatar">
      <img src="/images/avatar/small/elliot.jpg">
    </a>
    <div class="content">
      <a class="author">Elliot Fu</a>
      <div class="metadata">
        <span class="date">Yesterday at 12:30AM</span>
      </div>
      <div class="text">
        <p>This has been very useful for my research. Thanks as well!</p>
      </div>
      <div class="actions">
        <a class="reply">Reply</a>
      </div>
    </div>
    <div class="comments">
      <div class="comment">
        <a class="avatar">
          <img src="/images/avatar/small/jenny.jpg">
        </a>
        <div class="content">
          <a class="author">Jenny Hess</a>
          <div class="metadata">
            <span class="date">Just now</span>
          </div>
          <div class="text">
            Elliot you are always so right :)
          </div>
          <div class="actions">
            <a class="reply">Reply</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="comment">
    <a class="avatar">
      <img src="/images/avatar/small/joe.jpg">
    </a>
    <div class="content">
      <a class="author">Joe Henderson</a>
      <div class="metadata">
        <span class="date">5 days ago</span>
      </div>
      <div class="text">
        Dude, this is awesome. Thanks so much
      </div>
      <div class="actions">
        <a class="reply">Reply</a>
      </div>
    </div>
  </div>
  <form class="ui reply form">
    <div class="field">
      <textarea></textarea>
    </div>
    <div class="ui blue labeled submit icon button">
      <i class="icon edit"></i> Add Reply
    </div>
  </form>
</div>


-->


<?php
function mytheme_comment($comment, $args, $depth) {
  if($comment->comment_approved == 0){
    $text = '<i>In approvazione</i>';
  }
  else{
    $text = get_comment_text();
  }
  echo 
  '<div class="comment" id="comment-'. get_comment_ID() .'">'.
    '<a class="avatar">'. get_avatar($comment, $args['avatar_size']) . '</a>'.
    '<div class="content">'.
      '<a class="author">'. get_comment_author() . '</a>'.
      '<div class="metadata">'.
        '<span class="date">' . get_comment_date() . '</span>'.
      '</div>'.
      '<div class="text">'. $text . '</div>'.
      '<div class="actions">'. get_comment_reply_link(
        array_merge($args, array( 
          'add_below' => 'comment', 
          'depth'     => $depth, 
          'max_depth' => $args['max_depth'] 
        ))) .
      '</div>'.
    '</div>';
  //</div>: Deve mancare altrimenti non va  
}
?>