$(function(){

	$('body').delegate('.bas_menu_top_btn', 'click', function(){

		$('.bas_menu_top').slideToggle();
		$('.bs-navbar-collapse').collapse('hide');
	});

	$('.bs-navbar-collapse').on('show.bs.collapse', function () {
		$('.bas_menu_top').slideUp();
    })
});