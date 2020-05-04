<?php

function wpcf7_form_elements($html){
  if(!is_page('contatto')) return;

  $form = '
  <div class="field">
    <label>Nome</label>
    <input type="text" name="your-name" size="40" placeholder="Mario Rossi">
  </div>
  <div class="field">
    <label>Email</label>
    <input type="email" name="your-email" size="40" placeholder="your@mail.com">
  </div>
  <div class="field">
    <label>Oggetto</label>
    <input type="text" name="your-subject" size="40" placeholder="Oggetto del messaggio">
  </div>
  <div class="field">
    <label>Messaggio</label>
    <textarea name="your-message" cols="40" rows="10"></textarea>
  </div>
  <button id="wpcf7-submit" class="ui blue button" type="submit">Invia</button>
  <div class="ui error message"></div>
  <div class="ui success message"></div>
  ';

  return $form;
}
add_filter('wpcf7_form_elements', 'wpcf7_form_elements');