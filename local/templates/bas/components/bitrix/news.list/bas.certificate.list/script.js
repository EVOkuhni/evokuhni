$(function(){

	$('.bas_certificate_list').each(function(){

		var basElem = $(this).find('.carousel').owlCarousel({
			loop		: true,
			margin		: 20,
			nav			: false,
			pagination	: false,
			autoplay	: false,
			responsive	: {
				0:{
					items: 2
				},
				500:{
					items: 3
				},
				768:{
					items: 4
				},
			}
		});

		$(this).find('.control_next').click(function() {
			basElem.trigger('next.owl.carousel');
		});

		$(this).find('.control_prev').click(function() {
			basElem.trigger('prev.owl.carousel');
		});
	});
});