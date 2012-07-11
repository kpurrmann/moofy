$(function(){

	$('input[type=submit]').live('click', function(){		
		doValidation($('input#email').attr('name'));
		return false;
	});

	$('input[type=text]').live('click', function(){
		if($(this).val().indexOf('@') == -1) {
			$(this).val('');
		}
		if($(this).parent().hasClass('error')){
			$(this).parent().removeClass('error');
		}
	});

});

var valid = false;

function doValidation(name) {
	var url = 'reminder/sign';
	var data = {};
	var content = $('#cboxLoadedContent').find('#view-content');
	$('#cboxLoadingOverlay').show();
	$('input').each(function(){
		data[$(this).attr('name')] = $(this).val();
	});
	$.post(url,data, function(resp){
		//		console.log(resp.status);
		if(resp.status == 'error'){
			content.show();
			$('#cboxLoadingOverlay').hide();
			for(errorKey in resp[name]){
				$('input[name='+ name +']').val(resp[name][errorKey]).parent().removeClass('control-group success').addClass('control-group error');
			}
		} else {
			$('input[name='+ name +']').parent().removeClass('control-group error').addClass('control-group success');
			$('#cboxLoadingOverlay').hide();
			content.text('Herzlichen Glückwunsch.').wrapInner('<h2>');
			content.append('Ihre E-Mail-Adresse wurde erfolgreich registriert. Sie erhalten in Kürze eine E-Mail, in der Sie Ihre Anmeldung bestätigen müssen.').wrapInner('<p>');
			content.append('Ihr Soundpuzzle-Team.').wrapInner('<p>');
		}
	});
}
