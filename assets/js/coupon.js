'use strict';

(function ($) {
  //$('#timer-form')
  $('#timer-submit').click(function (evt) {
    evt.preventDefault();
    
    let emailUser = $('#timer-form .discount-section__input').val();
    let antibot = 'true'//$('#timer-form input[name="antibot"]').val();
    let saleValue = $('#timer-form input[name="sale"]').val();
    
    let data = {};
    
    if (emailUser && saleValue && antibot) {
      data = {
        action: 'subscribe',
        email: emailUser,
        sale: saleValue,
        antibot: antibot
      };
      
      $.ajax({
        url: woozzee_ajax.url,
        data: data,
        type: 'POST',
        beforeSend: function (response) {
          $('#timer-form .message').text('Форма отправляется...');
        },
        success: function(response) { 
          if (response) {
            $('#timer-form .message').text(response);
          }
        },
        error: function (error) {
          console.log(error);

          $('#timer-form .message').text('Что-то пошло не так...');
        }
      });      
    } else {
      $('#timer-form .message').text('Поле не может быть пустым...');
    }
  });
})(jQuery);