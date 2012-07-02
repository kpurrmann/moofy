$(function(){

	$('input[type=text]').blur(function(){
		doValidation($(this).attr('name'));
		if(valid){
			return false;
		} else {
			return false;
		}
	});

	$('input[type=submit]').click(function(){
		doValidation($(this).attr('name'));
		alert('hgzugu');
		
		return false;
		if(valid){
			$.colorbox.close();
			return false;
		} else {
			return false;
		}
		return false;
	});

});

var valid = false;

function doValidation(name) {
	var url = 'public/remindMe/validate';
	var data = {};
	$('input').each(function(){
		data[$(this).attr('name')] = $(this).val();
	});
	$.post(url,data, function(resp){
		console.log(resp);
		if(!$.isArray(resp)){
			for(errorKey in resp[name]){
				$('input[name='+ name +']').val(resp[name][errorKey]).parent().removeClass('control-group success').addClass('control-group error');
			}
			valid = false;
		} else {
			$('input[name='+ name +']').parent().removeClass('control-group error').addClass('control-group success');
			valid = true;
		}
	});
}
