$(function(){

	//@todo Auslagern
	var urlPrefix = $('head base').attr('href');
	var run = false;
	if(!run){
		$('a.lightbox:not(.ready)').each(function(){
			var link = $(this).attr('href');
			$(this).addClass('ready');
			$(this).attr('href', urlPrefix + link + '/layout/lightbox');
		});
		run = true;
	}

	$('a.lightbox').colorbox({
//		'title' : false,
		'maxWidth' : '450px'
	});
	$('a[rel=tooltip]').tooltip({
		'placement' : 'bottom'
	});

});