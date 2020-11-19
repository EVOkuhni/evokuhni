$(function(){

	$('.bas_catalog_carousel_inner').each(function(){

		var basElem = $(this).find('.carousel').owlCarousel({
			loop				: true,
			margin				: 30,
			nav					: false,
			pagination			: false,
			autoplay			: false,
			responsive:{
				0:{
					items:1
				},
				500:{
					items:2
				},
				992:{
					items:3
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