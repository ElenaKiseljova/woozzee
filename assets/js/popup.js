'use strict';

document.addEventListener("DOMContentLoaded", function () {
  try {
    const rootElement = document.documentElement;
    const overlayPopup = document.querySelector('.popup__overlay');

    let pageHeader = document.querySelector('.page-header');

    let onPopupEscPress = function (evt) {
      if (evt.keyCode === 27) {
        closePopup();
      }
    }

    let openPopup = function (popup, sufix) {
      let allPopup = document.querySelectorAll('.popup');

      if (allPopup) {
        allPopup.forEach(function (item) {
          if (item.classList.contains('active')) {
            item.classList.remove('active');

            if (item.classList.contains('popup--menu')) {
              if (pageHeader) {
                let logoHeader = pageHeader.querySelector('.logo--header');

                if (logoHeader) {
                  logoHeader.classList.toggle('active'); //появление лого после выезда меню
                }

                pageHeader.classList.toggle('active'); // static
              }
            }
          }
        });
      }

      if (rootElement && !rootElement.classList.contains('active')) {
        rootElement.classList.add('active');
      }

      if (overlayPopup && !overlayPopup.classList.contains('active')) {
        overlayPopup.classList.add('active');

        if (sufix === 'cart' || sufix === 'search') {
          overlayPopup.style.opacity = 0;
        }
      }

      popup.classList.add('active');

      if (sufix == 'menu' && screen.width < 1130) {
        if (pageHeader) {
          let logoHeader = pageHeader.querySelector('.logo--header');

          if (logoHeader) {
            logoHeader.classList.toggle('active'); //появление лого после выезда меню
          }

          pageHeader.classList.toggle('active'); // static
        }
      }

      document.addEventListener('keydown', onPopupEscPress, true);
    }

    window.closePopup = function () {
      // Swiper Cart
      let cartPopup = document.querySelector('.popup--cart.active');

      if (cartPopup) {
        window.swiperInit.cartListDestroy(); // Скролл для списка корзины (удаление)
      }

      // Swiper Search
      let searchPopup = document.querySelector('.popup--search.active');

      if (searchPopup) {
        window.search.searchReset('.search--popup');
      }

      let allPopup = document.querySelectorAll('.popup');

      if (allPopup) {
        allPopup.forEach(function (item) {
          if (item.classList.contains('active')) {
            item.classList.remove('active');

            if (item.classList.contains('popup--menu')) {
              if (pageHeader) {
                let logoHeader = pageHeader.querySelector('.logo--header');

                if (logoHeader) {
                  logoHeader.classList.toggle('active'); //появление лого после выезда меню
                }

                pageHeader.classList.toggle('active'); // static
              }
            }
          }
        });
      }

      if (rootElement && rootElement.classList.contains('active')) {
        rootElement.classList.remove('active');
      }

      if (overlayPopup && overlayPopup.classList.contains('active')) {
        overlayPopup.classList.remove('active');
        overlayPopup.style = '';
      }

      document.removeEventListener('keydown', onPopupEscPress, true);
    }

    let popupButtons = document.querySelectorAll('.openpopup');

    if (popupButtons) {
      popupButtons.forEach(function (item) {
        let sufixPopupName = item.getAttribute('data-popup');
        let popupName = '.popup--' + sufixPopupName;

        let popupItem = document.querySelector(popupName);

        if (popupItem) {
          item.addEventListener('click', function () {
            if (popupName == '.popup--cart') {
              window.swiperInit.cartListInit(); // Скролл для списка
              window.countProduct('.my-basket__item', 0);
              window.cart.qtyChange();
              window.cart.removeItem();
              window.cart.couponClick();
              window.cart.couponRemove();
            }

            if (popupName == '.popup--oneclick') {
              let variationId = document.querySelector('input[name="variation_id"]');

              if (variationId && variationId.value == 0) {
                return false;
              }
            }

            openPopup(popupItem, sufixPopupName);
          });

          var onEnterPressOpen = function (evt) {
            if (evt.keyCode === 13) {
              openPopup(popupItem, sufixPopupName);

              document.removeEventListener('keydown', onEnterPressOpen);
            }
          }

          item.addEventListener('focus', function () {
            if (popupItem) {
              document.addEventListener('keydown', onEnterPressOpen);
            }
          });

          item.addEventListener('blur', function () {
            if (popupItem) {
              document.removeEventListener('keydown', onEnterPressOpen);
            }
          });
        }
      });
    }

    let closePopupButtons = document.querySelectorAll('.popup__close');

    if (closePopupButtons) {
      for (var i = 0; i < closePopupButtons.length; i++) {
        closePopupButtons[i].addEventListener('click', closePopup);

        var onEnterPressClose = function (evt) {
          if (evt.keyCode === 13) {
            closePopup();

            document.removeEventListener('keydown', onEnterPressClose);
          }
        }

        closePopupButtons[i].addEventListener('focus', function () {
          document.addEventListener('keydown', onEnterPressClose);
        });

        closePopupButtons[i].addEventListener('blur', function () {
          document.removeEventListener('keydown', onEnterPressClose);
        });
      }
    }

    if (overlayPopup) {
      overlayPopup.addEventListener('click', closePopup);
    }

  } catch (e) {
    console.log(e);
  }
});
