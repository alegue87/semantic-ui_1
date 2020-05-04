

// nota ancora $ non esiste ( esiste solo 'jQuery' )
$ = jQuery.noConflict();

$(document).ready(function () {

  /* 
  Dato che non è possibile inserire un link in un link
  è stato necessario, per le categorie, creare un evento che
  apra la categoria all'interno di una card 
  */
  $('.category-or-tag-link').click(function (e) {
    e.preventDefault();
    location.href = $(this).attr('href');
  })


  /* ----------------------------------------------------------------------------------- */
  /* Apertura contentuto del code Ace 
  /* ----------------------------------------------------------------------------------- */
  if ($('div.wp-block-simple-code-block-ace')[0]) { // Ace presente nella pagina?
    var old_ace = null;
    var old_width = $('div.wp-block-simple-code-block-ace').css('width').split('px')[0];
    $('div.wp-block-simple-code-block-ace').mouseenter(function () {
      old_ace = this;
      old_width = $(this).css('width').split('px')[0];
      var ace_gutter_width = $('div.ace_gutter-cell').css('width').split('px')[0] * 1;
      var content_width = $(this).find('div.ace_content').css('width').split('px')[0] * 1;
      $(this).css('width', ace_gutter_width + content_width + 'px');
    });
    $('.wp-block-simple-code-block-ace').mouseleave(function () {
      $(old_ace).css('width', 'auto');
    });
  }

  /* ----------------------------------------------------------------------------------- */
  /* Content menu sticky
  /* ----------------------------------------------------------------------------------- */

  $('.contents-menu').visibility({
    type: 'fixed',
    offset: 63,
  });

  /* ----------------------------------------------------------------------------------- */
  /* Accordion
  /* ----------------------------------------------------------------------------------- */
  if ($('.ui.accordion')[0]) {
    $('.ui.accordion').accordion();
  }
 
  /* ----------------------------------------------------------------------------------- */
  /* Searcher
  /* ----------------------------------------------------------------------------------- */
  $.fn.search.settings.templates.standard_1 = function(res){
    var html = '';
    $.each(res.results, function(i, item){
      html += item.html;
    });
    return html;
  }
  $('.ui.search')
  .search({
    type: 'standard_1',
    apiSettings: {
      url: home_url+'?s={query}',
      method:'post',
      onResponse: function(res){
        return res;
      }, 
    },
  });

  /* ----------------------------------------------------------------------------------- */
  /* Submit per ricerca ( menu per mobile e simili)
  /* ----------------------------------------------------------------------------------- */
  $('button .search').click(function(){
    $(this).parent().submit();
  })
  /* ----------------------------------------------------------------------------------- */
  /* Submit form commenti
  /* ----------------------------------------------------------------------------------- */
  $('#respond .button.submit').click(function(){
    $(this).parent().submit();
  })
  /* ----------------------------------------------------------------------------------- */
  /* jQCloud
  /* ----------------------------------------------------------------------------------- */
  var words = JSON.parse($('#tags-cloud').attr('data'));
  $('#tags-cloud').jQCloud(words, {
    'autoResize': true
  });
});



