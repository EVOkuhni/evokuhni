$(function(){

	var basStopClick = true;

	$('body').delegate('.bas_pagination_ajax a', 'click', function(){

		if (basStopClick) {

			BX.showWait();

			basStopClick = false;

			var url = $(this).attr('href');

			location.hash = $(this).attr("data-numb");

			$.ajax({
				type: "GET",
				url: url,
				dataType: "html",
				data: 'bas_pagination_ajax=Y',
				success: function(html){

					$('.bas_pagination_ajax').remove();

					$('.ajax_box').append(html);

					basStopClick = true;
				},
				error: function(){

					console.log('Ошибка получени¤ данных!');
				},
				complete: function(){

					BX.closeWait();
				}
			});
		}

		return false;
	});
		
});

$(function() {

	initPages();
});

var maxPageCount;
var pagerNumb;
var loadPageNumb;
var curPage;
var positionScroll;

function initPages(){

	console.log(">>initPages");
	curPage=parseInt(location.hash.replace("#",""));
	loadPageNumb=1;
	console.log(">>curPage="+curPage);

	if (curPage>1&&curPage<=maxPageCount) loadPages();
}


function loadPages(){

	console.log(">>>loadPages");
	loadPageNumb++;
	console.log(">>>loadPageNumb="+loadPageNumb);

	if (loadPageNumb<=maxPageCount&&loadPageNumb<=curPage)
	{
		$.ajax({
			type: "GET",
			url: location.href,
			dataType: "html",
			data: 'bas_pagination_ajax=Y&PAGEN_'+pagerNumb+"="+loadPageNumb,
			success: function(html){
	
				$('.bas_pagination_ajax').remove();
				console.log(">>>offset top="+$('.ajax_box').offset().top);
				console.log(">>>height="+$('.ajax_box').height());
				positionScroll=$('.ajax_box').offset().top+$('.ajax_box').height();
				$('.ajax_box').append(html);
	
				loadPages();
			},
			error: function(){
	
				console.log('Ошибка получения данных!');
			}
		});
	}
	else
	{
		console.log(">>>animate");

		$('html, body').animate({
			scrollTop: positionScroll
		}, 500);
	}
}