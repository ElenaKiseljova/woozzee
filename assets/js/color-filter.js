'use strict';

//
document.addEventListener('DOMContentLoaded', function () {
  let colorCheckboxes = document.querySelectorAll('.popular-queries__wrapper .wpfCheckbox input[type="checkbox"]');

  if (colorCheckboxes) {
    colorCheckboxes.forEach((colorCheckbox, i) => {
      if (colorCheckbox.checked) {
        colorCheckbox.closest('li').classList.add('active');
      }
    });
    
  }
});