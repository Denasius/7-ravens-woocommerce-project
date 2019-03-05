jQuery(function($){
	$('#true_loadmore').click(function(){
		$(this).find('a').text('Загружаю...'); // изменяю текст кнопки
		var data = { 				// формирую параметры для запроса
			'action': 'loadmore',
			'query': true_posts,
			'page' : current_page
		};
		$.ajax({
			url:ajaxurl, // обработчик
			data:data, // данные
			type:'POST', // тип запроса
			success:function(data){
				if( data ) { 
					$('#true_loadmore a').text('Загрузить ещё');
					$('#true_loadmore').before(data); // вставляю новые посты
					current_page++; // увеличиваю номер страницы на единицу
					if (current_page == max_pages) $("#true_loadmore").remove(); // если последняя страница, удаляю кнопку
				} else {
					$('#true_loadmore').remove(); // если дошли до последней страницы постов, скрываю кнопку
				}
			}
		});
	});
});