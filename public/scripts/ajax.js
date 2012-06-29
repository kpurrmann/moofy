//$(function(){
//
//	//@todo Auslagern
//	var urlPrefix = $('head base').attr('href');
//	var run = false;
//	if(!run){
//		$('a.lightbox').each(function(){
//			var link = $(this).attr('href');
//			$(this).attr('href', urlPrefix + link + '/layout/lightbox');
//		});
//		run = true;
//	}
//
//	$('a.lightbox').colorbox({
//		'title' : false,
//		'maxWidth' : '450px'
//	});
//
//	$('a[rel=tooltip]').tooltip({
//		'placement' : 'bottom'
//	});
//
//	$('input').blur(function(){
//		if(doValidation($(this).attr('name'))){
//
//		} else {
//			return false;
//		}
//	});
//
//	$('input[type=submit]').click(function(){
//		doValidation($(this).attr('name'));
//		if(valid){
//
//		} else {
//			return false;
//		}
//	});
//
//});
//
//var valid = false;
//
//function doValidation(name) {
//	var url = 'public/remindMe/validate';
//	var data = {};
//	$('input').each(function(){
//		data[$(this).attr('name')] = $(this).val();
//	});
//	$.post(url,data, function(resp){
//		console.log(resp);
//		if(!$.isArray(resp)){
//			for(errorKey in resp[name]){
//				$('input[name='+ name +']').val(resp[name][errorKey]).parent().removeClass('success').addClass('error');
//			}
//			valid = false;
//		} else {
//			$('input[name='+ name +']').parent().removeClass('error').addClass('success');
//			valid = true;
//		}
//	});
//}
