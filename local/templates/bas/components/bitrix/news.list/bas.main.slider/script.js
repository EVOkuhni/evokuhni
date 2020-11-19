$(function(){

	$('.bas_main_slider').owlCarousel({
		loop				: true,
		margin				: 0,
		navigation			: true,
		nav					: true,
		pagination			: false,
		autoplay			: true,
		autoplayTimeout		: 12000,
		animateOut			: 'fadeOut',
		responsive:{
			0:{
				items	: 1
			}
		}
	});

//	$('.bas_main_slider div.block').show();
});