$(function(){

	$('.bas_partner_list').each(function(){

		var basElem = $(this).find('.carousel').owlCarousel({
			loop		: true,
			margin		: 10,
			nav			: false,
			pagination	: false,
			autoplay	: false,
			responsive:{
				0:{
					items: 2
				},
				500:{
					items: 3
				},
				768:{
					items: 4
				},
				992:{
					items: 5
				},
				1200:{
					items: 6
				}
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