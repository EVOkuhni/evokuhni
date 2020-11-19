$(function(){

	$('.our_form_styler input[type="checkbox"]:not(".nostyler")').styler();
	$('.our_form_styler input[type="radio"]').styler();
	$('.our_form_styler input[type="file"]').styler();
    $('.our_form_styler select').styler();

	$('body').delegate('.basOrderMake', 'click', function() {

		var form_name = $(this).attr('form-name');

		if (form_name)
		{
			$('#basOrderModal .modal-title').text(form_name);
			$('#basOrderFormName').val(form_name);
		}
		else
		{
			$('#basOrderModal .modal-title').text('Заказать расчет');
			$('#basOrderFormName').val("Заказ товара");
		}

		$('#basOrderTovar').val($(this).parents('.basTovarBlock').find('.basTovarName').text());
		$('#basTvrName').text($(this).parents('.basTovarBlock').find('.basTovarName').text());
		$('#basTvrPrice').html($(this).parents('.basTovarBlock').find('.price').html());

		$('#basOrderModal').modal();
	});

	$('input[type="tel"]').mask("+7 (999) 999-99-99");

	$('#up').click(function(){

		$('html, body').animate({scrollTop: 0}, 1000);
	});

	$('.bas_tooltip').tooltip();
    $('[data-toggle="popover"]').popover();

	$('.js-emaillink').click(function(event) {

		var range = document.createRange();  

		range.selectNode(this);  
		window.getSelection().addRange(range);  
		
		try {

			var successful = document.execCommand('copy');
			var msg = successful ? 'Email успешно скопирован' : 'Ошибка копирования Email';

			alert(msg);

		} catch(err) {  
			console.log('Произошла ошибка копирования');  
		}

		window.getSelection().removeAllRanges();  
	});

	$('[data-toggle="tooltip"]').tooltip();

	$('.bas_my_tab_link a').click(function(){

		if($(this).data('contentClass'))
		{
			var contentClass = $(this).data('contentClass');
			$('.' + contentClass).removeClass('active');
		}

		$(this).parent().children().removeClass('active');
		$(this).addClass('active');
		$(this).parent().next('.bas_my_tab').children().removeClass('active');
		$($(this).attr('href')).addClass('active');

		return false;
	});

	$('.header__contacts-block .link').click(function (e) {
		location.href = $(this).attr('href');
		$('.contacts-tab-link[href="'+location.hash+'"]').click();
		$('html, body').scrollTop($(location.hash).offset().top);
    });

	function getLocalStorageObject(type) {
		var items = {};
		if(localStorage.getItem(type))
		{
			items = JSON.parse(localStorage.getItem(type));
			if(!items || items == 'null') items = {};
		}

		return items;
    }

	function sync_favs_and_seen() {
		if(parseInt(localStorage.fs_timestamp) < 1577356603173)
		{
			localStorage.clear();
			localStorage.fs_timestamp = + new Date();
		}
		var favorites = getLocalStorageObject('favorites');
		var seen = getLocalStorageObject('seen');
		console.log({fs_timestamp: localStorage.fs_timestamp});
		$.ajax({
			url: '/ajax/favorites_and_seen_set.php',
			data: {favorites: favorites, seen: seen, t: 1},
			type: 'post',
			success: function () {
				//console.log('sync ok');
            }
		});
		$('.favorite-btn').each(function () {
			var id = $(this).data('id');
			if(favorites[id])
				$(this).find('.favorite-icon').addClass('active');
			else
			    $(this).find('.favorite-icon').removeClass('active');
        });

		$('.favorites-counter').text(Object.keys(favorites).length);
		$('.seen-counter').text(Object.keys(seen).length);
    }

    function seen_add(id) {

		var seen = getLocalStorageObject('seen');
		seen[id] = + new Date();
		localStorage.seen = JSON.stringify(seen);
		$('.seen-counter').text(Object.keys(seen).length);

		$.ajax({
			url: '/ajax/seen_add.php',
			data: {id: id, all: seen},
			type: 'post',
			dataType: 'json',
			success: function (data) {
				/*seen = data;
				localStorage.seen = JSON.stringify(seen);
				$('.seen-counter').text(Object.keys(seen).length);*/
            }
		});
    }

    sync_favs_and_seen();

	//FAVORITES & SEEN
	$('.favorite-btn, .favorites-remove-btn').click(function (e) {
		e.preventDefault();
		var favorites = getLocalStorageObject('favorites');
		var id = $(this).data('id');
		if(favorites[id])
			delete favorites[id];
		else
			favorites[id] = + new Date();

		localStorage.favorites = JSON.stringify(favorites);

		sync_favs_and_seen();
    });
	$('.favorites-remove-btn').click(function () {
		location.href = location.href.replace(/\?.+/, "")
    });

	$('.seen-trigger').each(function () {
		var id = $(this).data('id');
		seen_add(id);
    });

	$('.seen-reset').click(function () {
		localStorage.seen = '';
    });

	$('a[data-fancybox-link]').click(function (e) {
		e.preventDefault();
		$('a[data-fancybox="'+$(this).data('fancyboxLink')+'"]:first').click();
    });

	$('[data-fancybox]').fancybox({
		thumbs : {
			autoStart : true
		}
	});


	$('.bas_menu_top .parent').click(function (e) {
		if($(window).width() <= 991) {
			e.preventDefault();
			$(this).parent().children('ul').toggleClass('show');
			$(this).toggleClass('opened');
		}
	});

	switchXsImages();

	function switchXsImages() {
		if($(window).width() <= 768)
		{
			$('img[data-xs-image]').each(function () {
				var img = $(this).data('xsImage');
				if(img)
					$(this).attr('src', img);
			});
		}
    }
});