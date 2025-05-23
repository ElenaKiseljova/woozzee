'use strict';

(function ($) {
  // Таймер
  /*
  if (!Date.now) {
    Date.now = function now() {
      return new Date().getTime();
    };
  }
  
  let threeHours = Date.now() + (3 * 60 * 60 * 1000);*/
  
  // Конечная дата переданная куками
  
  let spanDateOffTimer = document.querySelector('#timer-off');
  
  //Дата для обратного отсчета
  
  let dateOffTimer;
  
  if (spanDateOffTimer) {
    dateOffTimer = parseInt(spanDateOffTimer.textContent, 10);
  }
  /*
  if (!dateOffTimer) {
    let today = new Date();
    let dd = String(today.getDate()).padStart(2, '0');
    let mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    let yyyy = today.getFullYear();
    
    dateOffTimer = yyyy + '-' + mm + '-' + dd + ' ' + '23' + ':' + '59';
  }*/
  
  function get_timer() {
   ////////////////////////////////////
   ////////////////////////////////////

   //Объект даты для обратного отсчета
   var date_t = new Date(dateOffTimer);
   
   //Объект текущей даты
   var date = new Date();
   //Вычисляем сколько миллисекунд пройдет
   //от текущей даты до даты отсчета времени
   var timer = date_t - date;

   //Проверяем не нужно ли закончить отсчет
    //если дата отсчета еще не истекла, то количество
    //миллисекунд в переменной date_t будет больше чем в переменной date
    if(date_t > date) {

      //Вычисляем сколько осталось дней до даты отсчета.
      //Для этого количество миллисекунд до даты отсчета делим
      //на количество миллисекунд в одном дне
      var day = parseInt(timer/(60*60*1000*24));
      //если полученное число меньше 10 прибавляем 0
      if(day < 10) {
        day = '0' + day;
      }
      //Приводим результат к строке
      day = day.toString();

      //Вычисляем сколько осталось часов до даты отсчета.
      //Для этого переменную timer делим на количество
      //миллисекунд в одном часе и отбрасываем дни
      var hour = parseInt(timer/(60*60*1000))%24;
      //если полученное число меньше 10 прибавляем 0
      if(hour < 10) {
        hour = '0' + hour;
      }
      //Приводим результат к строке
      hour = hour.toString();

      //Вычисляем сколько осталось минут до даты отсчета.
      //Для этого переменную timer делим на количество
      //миллисекунд в одной минуте и отбрасываем часы
      var min = parseInt(timer/(1000*60))%60;
      //если полученное число меньше 10 прибавляем 0
      if(min < 10) {
        min = '0' + min;
      }
      //Приводим результат к строке
      min = min.toString();

      //Вычисляем сколько осталось секунд до даты отсчета.
      //Для этого переменную timer делим на количество
      //миллисекунд в одной минуте и отбрасываем минуты
      var sec = parseInt(timer/1000)%60;
      //если полученное число меньше 10 прибавляем 0
      if(sec < 10) {
        sec = '0' + sec;
      }
      //Приводим результат к строке
      sec = sec.toString();
      
      //Выводим дни
     //Проверяем какие предыдущие цифры времени должны вывестись на экран
     //Для десятков дней
     /*if(day[1] == 9 &&
       hour[0] == 2 &&
       hour[1] == 3 &&
       min[0] == 5 &&
       min[1] == 9 &&
       sec[0] == 5 &&
       sec[1] == 9) {
       animation($(".day0"),day[0]);
     } else {
       $(".day0").html(day[0]);
     }*/
     //Для единиц  дней
     /*if(hour[0] == 2 &&
       hour[1] == 3 &&
       min[0] == 5 &&
       min[1] == 9 &&
       sec[0] == 5 &&
       sec[1] == 9) {
       animation($(".day1"),day[1]);
     } else {
       $(".day1").html(day[1]);
     }*/
     //Выводим часы
     //Проверяем какие предыдущие цифры времени должны вывестись на экран
     //Для десятков часов
     if(hour[1] == 3 &&
       min[0] == 5 &&
       min[1] == 9 &&
       sec[0] == 5 &&
       sec[1] == 9) {
       animation($(".hour0"),hour[0]);
     } else {
       $(".hour0").html(hour[0]);
     }
     //Для единиц часов
     if(min[0] == 5 &&
       min[1] == 9 &&
       sec[0] == 5 &&
       sec[1] == 9) {
       animation($(".hour1"),hour[1]);
     } else {
       $(".hour1").html(hour[1]);
     }

     //Выводим минуты
     //Проверяем какие предыдущие цифры времени должны вывестись на экран
     //Для десятков минут
     if(min[1] == 9 &&
       sec[0] == 5 &&
       sec[1] == 9) {
       animation($(".min0"),min[0]);
     } else {
       $(".min0").html(min[0]);
     }
     //Для единиц минут
     if(sec[0] == 5 && sec[1] == 9) {
       animation($(".min1"),min[1]);
     } else {
       $(".min1").html(min[1]);
     }

     //Выводим секунды
     //Проверяем какие предыдущие цифры времени должны вывестись на экран
     //Для десятков секунд
     if(sec[1] == 9) {
       animation($(".sec0"),sec[0]);
     } else {//Для единиц секунд
       $(".sec0").html(sec[0]);
     }
     animation($(".sec1"),sec[1]);
     //Периодически вызываем созданную функцию,
     //интервал вызова одна секунда(1000 милли секунд)
     setTimeout(get_timer,1000);
    } else {
      $('#timer-off').siblings('.discount-section__wrapper').hide();
      $(".clock").html("<span id='stop'>Отсчет закончен!!!</span>");
    }
  }

  //Функция для красивого отображения времени.
  function animation(vibor,param) {
   vibor.html(param)
   .css({'marginTop':'-20px','opacity':'0'})
   .animate({'marginTop':'0px','opacity':'1'});
  }

  //Вызываем функцию на исполнение
  get_timer();
})(jQuery);