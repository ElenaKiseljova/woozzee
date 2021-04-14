'use strict';

document.addEventListener('DOMContentLoaded', () => {
  try {
    window.animationAnchor = function (animationTime, elementToScrollId, draftY) {
      let startAnimation = function (elementToScroll) {
        let start = Date.now(); // запомнить время начала

        let draw = function (timePassed) {
          let topScroll = elementToScroll.offsetTop;

          if (draftY !== null) {
            topScroll = elementToScroll.offsetTop - draftY;
          }

          let yCoord = ( timePassed * topScroll ) / animationTime;

          window.scroll(0, yCoord);
        };

        let timer = setInterval(function() {
          // сколько времени прошло с начала анимации?
          let timePassed = Date.now() - start;

          if (timePassed >= animationTime) {
            clearInterval(timer); // закончить анимацию через 'animationTime' секунды
            return;
          }

          // отрисовать анимацию на момент timePassed, прошедший с начала анимации
          draw(timePassed);

        }, 20);
      };

      if (elementToScrollId == null) {
        let allElementAnchors = document.querySelectorAll('a[href*="#"]');

        allElementAnchors.forEach((itemAnchor, i) => {
          itemAnchor.addEventListener('click', (evt) => {
            //evt.preventDefault();

            let hrefElementAnchor = itemAnchor.href;

            let hrefElementAnchorArr = hrefElementAnchor.split('#');
            let elementScrollId = hrefElementAnchorArr[hrefElementAnchorArr.length - 1];

            if (elementScrollId.length > 0) {
              let elementToScroll = document.querySelector(`#${elementScrollId}`);

              if (elementToScroll) {
                startAnimation(elementToScroll);
              }
            }
          });
        });
      } else {
        let elementToScroll = document.querySelector(`#${elementToScrollId}`);

        if (elementToScroll) {
          startAnimation(elementToScroll);
        }
      }
    };

    window.animationAnchor(500, null, null);

  } catch (e) {
    console.log(e);
  }
});
