$(document).ready(function(){

	// Показать пароль
	$('.password-checkbox').click(function(){
		if ($(this).is(':checked')){
			$('#pass').attr('type', 'text');
		} else {
			$('#pass').attr('type', 'password');
		}
	});

	$('.password-checkbox_2').click(function(){
		if ($(this).is(':checked')){
			$('#pass_2').attr('type', 'text');
		} else {
			$('#pass_2').attr('type', 'password');
		}
	});

	$('.password-checkbox').click(function(){
		if ($(this).is(':checked')){
			$('#pass').attr('type', 'text');
		} else {
			$('#pass').attr('type', 'password');
		}
	});

	// Кнопка наверх
	$(window).scroll(function(){
		if ($(window).scrollTop() > 20 ){
			$('.btn-top').fadeIn();
		} else {
			$('.btn-top').fadeOut();
		};
	});

	$('.btn-top').click(function(){
		$('html, body').animate({scrollTop:0}, 700);
	
	});

});