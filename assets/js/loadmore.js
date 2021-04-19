jQuery(function($) {
	window.loadMore = function (buttons) {
    $buttons = $(buttons);
		
    if ($buttons.length > 0) {
			$buttons.each(function (index) {	
				if (true_posts[index] && current_page[index] && max_pages[index] && id_category[index]) {
					$( this ).click( function () {
		        $this = $( this );
						//console.log(max_pages[index]);
						//console.log(current_page[index]);
		        //console.log(true_posts[index]);
						
		    		var data = {
		    			'action': 'load_more',
		    			'query': true_posts[index],
		    			'page' : current_page[index],
							'id_category' : id_category[index]
		    		};

		    		$.ajax({
		    			url: woozzee_ajax.url, // обработчик
		    			data: data, // данные
		    			type: 'POST', // тип запроса
		          beforeSend: function (response) {
		            $this.children('span').text('Загружаю...'); // изменяем текст кнопки, вы также можете добавить прелоадер
		        		$this.addClass('active');
		          },
		    			success: function(response){
		            if( response ) {
		    					$this.removeClass('active');
		    					$this.remove();
									console.log(response, $(".tabs-section__goods-list link-list:not(.tabs-section__goods-list--hidden)"));
		    					$(".tabs-section__goods-list.link-list:not(.tabs-section__goods-list--hidden)").append(response); // вставляем новые посты

		    					current_page[index]++; // увеличиваем номер страницы на единицу
		    				} else {
									console.log('Пусто...');
		    					$this.remove(); // если мы дошли до последней страницы постов, скроем кнопку
		    				}
		    			},
		          error: function(error) {
		            console.log(error);
		          }
		    		});
		    	});
				}      
			});     
    }
  };

  // Index

  window.loadMore('.tabs-section__more-link');
});
