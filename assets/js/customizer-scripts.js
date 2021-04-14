'use strict';

(function ($) {
  // Изменение поля Политики из Кастомайзера
  wp.customize('footer_privacy_text', function (value) {
    value.bind(function (newVal) {
      $('#privacy-footer').text(newVal);
    });
  });
  
  // Изменение поля Договора из Кастомайзера
  wp.customize('footer_document_text', function (value) {
    value.bind(function (newVal) {
      $('#document-footer').text(newVal);
    });
  });
})(jQuery);