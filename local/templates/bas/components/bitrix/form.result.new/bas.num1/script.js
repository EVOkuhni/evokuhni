//function $_GET(key)
//{
//    var s = window.location.search;
//    s = s.match(new RegExp(key + '=([^&=]+)'));
//    return s ? s[1] : false;
//};

$(function(){

	$('body').delegate('.bas_result_new_num1 div.link a', 'click', function(){

		$('.bas_result_new_num1 div.bottom').slideToggle();
	});

    $('body').delegate('.bas_result_new_num1 a.hide_btn', 'click', function(){

		$('.bas_result_new_num1 div.bottom').slideUp();
	});

//    if ($_GET('s') == 'r')
//    {
//        $('.bas_result_new_num1 select').val("72").change();
//    }
//
//    if ($_GET('s') == 'i')
//    {
//        $('.bas_result_new_num1 select').val("71").change();
//    }
});