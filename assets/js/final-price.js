'use strict';

document.addEventListener('DOMContentLoaded', function () {
  let tableVariationSelects = document.querySelectorAll('.variations select');
  let finalTimeout;
  
  let finalPriceField = document.querySelector('#final-price');
  let countField = document.querySelector('.product__count .qty');
    
  if (finalPriceField && countField) {
    let changeFinalPrice = function () {
      let flagHide = true;
      
      if (tableVariationSelects) {        
        tableVariationSelects.forEach((tableVariationSelect, i) => {
          if (tableVariationSelect.value == '') {
            flagHide = false;
          }
        });
      }
      
      if (flagHide) {
        let priceCleanField = document.querySelector('#clean-price');
        
        if (priceCleanField && priceCleanField.textContent !== '') {
          finalPriceField.textContent = countField.value * parseFloat(priceCleanField.textContent);
          
          finalPriceField.closest('.product__final-price').style.visibility = 'visible';
        }
      } else {
        finalPriceField.closest('.product__final-price').style.visibility = 'hidden';
      }
      
    };
    
    countField.addEventListener('input', function () {     
      changeFinalPrice();      
    });
    
    
    
    if (tableVariationSelects) {
      tableVariationSelects.forEach((tableVariationSelect, i) => {
        tableVariationSelect.addEventListener('change', function () {
          if (finalTimeout) {
            clearTimeout(finalTimeout);
          }
          
          finalTimeout = setTimeout(function () {
            changeFinalPrice();
          }, 500);         
        });
      });
      
    }
  }
});