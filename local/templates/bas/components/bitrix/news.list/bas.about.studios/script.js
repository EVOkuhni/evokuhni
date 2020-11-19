$(function(){

	$('.bas_studio .item').each(function(){

		var elem = $(this).attr('data-fancybox');
		var caption = $(this).next('.caption').html();

		$('[data-fancybox="' + elem + '"]').fancybox({
			idleTime  : false,
			baseClass : 'fancybox-bas-layout',
			margin    : 0,
			gutter    : 0,
			infobar   : false,
			thumbs    : {
				hideOnClose : false,
//				autoStart	: true
			},
			touch : {
				vertical : false
			},
			buttons : [
				"close",
                "thumbs",
				"zoom",
				"fullScreen",
			],
			animationEffect   : "fade",
			animationDuration : 300,
			onInit : function( instance ) {
				instance.$refs.inner.wrap( '<div class="fancybox-outer"></div>' );
			},
			caption : function(instance, item) {
				return caption;
			},
			afterShow : function() {
			/* 	$('.fancybox-button--zoom').click() */
			},
		});
	});
});