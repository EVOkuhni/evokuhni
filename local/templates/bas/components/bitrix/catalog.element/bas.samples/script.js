$(function(){

	/* - - - Слайдер карточки - - - */
	var fotoramaDiv = $('#fotorama').fotorama();

	var fotorama = fotoramaDiv.data('fotorama');

	fotorama.resize({
		width: '100%',
		height: $('#fotorama').width() * 0.59
	});

	/* - - - Слайдер цветов - - - */
 	var viewport = $(window).width();

	$('.bas_catalog_element .text_line .color .slider').each(function(){

		$(this).owlCarousel({
			loop				: false,
			margin				: 15,
			nav					: true,
			pagination			: false,
			autoplay			: false,
			responsive:{
				0 : {
					items: 2
				},
				400 : {
					items: 3
				},
				600 : {
					items: 4
				},
				768 : {
					items: 2
				},
				992 : {
					items: 3
				},
				1200 : {
					items: 4
				}
			}
		});

		var itemCount = $(this).find(".owl-item").length;
		var itemActive = $(this).find(".owl-item.active").length;

		if (itemCount <= itemActive) $(this).find(".owl-controls").hide();
	});

	/* - - - Увеличение цветов - - - */
	$('.fancybox_color').each(function(){

		var elem = $(this).attr('data-fancybox');

		$('[data-fancybox="' + elem + '"]').fancybox();
	});

	$('.bas_catalog_element .text_line .title .btn_elem a').click(function(){

		$(this).parents('.title').next('.color').find('.fancybox_color').eq(0).click();
	});
});