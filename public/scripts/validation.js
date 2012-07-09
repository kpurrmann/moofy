$(function(){

	$('input[type=submit]').live('click', function(){		
		doValidation($('input#email').attr('name'));
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
		} else {
			$('input[name='+ name +']').parent().removeClass('control-group error').addClass('control-group success');
			var content = $('#cboxLoadedContent').find('#view-content');
			content.text('supi');
		}
	});
}
