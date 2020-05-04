$(document).ready(function(){
  /* ----------------------------------------------------------------------------------- */
  /* Submit form wpcf7
  /* ----------------------------------------------------------------------------------- */
  $('#wpcf7-submit').click(function(e){
    $(this).parent().submit(function(e){
      e.preventDefault();
      var formdata = $(this).serializeArray();
      var action = $(this).attr('action');

      if(!$('.ui.form').form('is valid')) return;
      $.ajax({
        url: action,
        type: 'POST',
        data: formdata,
        success: function(res){
          $('.ui.form input[name="your-name"]').val('');
          $('.ui.form input[name="your-email"]').val('');
          $('.ui.form input[name="your-subject"]').val('');
          $('.ui.form textarea[name="your-message"]').val('');
          $('.ui.form .ui.success.message').html('Messaggio inviato')
        },
        error: function(err){
          $('.ui.form .ui.error.message').html('Errore durante l\'invio del messaggio');
        }
      })
    });
  })
  $('.ui.form input[name="your-name"]').blur(function(){
    $('.ui.form .ui.success.message').html('');
    $('.ui.form .ui.error.message').html('');
  });
  /* ----------------------------------------------------------------------------------- */
  /* WPCF7 (disabilitato in frontend) con semantic-ui validation 
  /* ----------------------------------------------------------------------------------- */
  $('.ui.form').form({
    on: 'blur',
    fields: {
      name:{
        identifier:'your-name',
        rules:[{
          type: 'empty',
          prompt: 'Il nome è necessario'
        }]
      },
      email:{
        identifier:'your-email',
        rules:[{
          type:'email',
          prompt:'L\'email è necessaria'
        }]
      }
    }
  });
});