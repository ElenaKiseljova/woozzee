'use strict';

document.addEventListener('DOMContentLoaded', function () {
  try {
    let formWPPP = document.querySelector('.form-wppp-select');
    
    if (formWPPP) {
      let sortingPerPages = document.querySelectorAll('.sorting-section__amount-item');
      
      let selectOptionsWPPP = formWPPP.querySelectorAll('.select option');
      
      if (selectOptionsWPPP && sortingPerPages) {
        let selectsWPPP = formWPPP.querySelector('.select');
        
        selectOptionsWPPP.forEach((optionItem, i) => {
          let valueOption = optionItem.value;
          
          if (sortingPerPages[i]) {
            let itemSortingInput = sortingPerPages[i].querySelector('input');
            let itemSortingLabel = sortingPerPages[i].querySelector('label');
          
            if (itemSortingInput && itemSortingLabel) {
              if (optionItem.selected) {
                itemSortingInput.checked = true;
              }
              
              itemSortingInput.id = valueOption;
              itemSortingInput.value = valueOption;
              
              itemSortingLabel.setAttribute('for', valueOption);
              itemSortingLabel.textContent = valueOption;
              
              itemSortingInput.addEventListener('change', function () {
                if (itemSortingInput.checked) {
                  //console.log('checked');
                  
                  optionItem.selected = true;
                  
                  if (selectsWPPP) {
                    selectsWPPP.value = valueOption;
                    formWPPP.submit();
                  }
                }                
              });
            }
          }     
        });
        
      }
    }
  } catch (e) {
    console.log(e);
  }
});