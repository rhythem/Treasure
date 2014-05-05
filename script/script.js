$(document).ready( function () {
	$('#login-button').click(function(){
		$('#signupform').hide();
		$('#login-form').show("slow");
		$('#loginform').show("slow");
		
	});
	$('#signup-button').click(function(){
		$('#login-form').show("slow");
		$('#loginform').hide();
		$('#signupform').show("slow");
	});
	$('#difficulty_container div div').click(function (){
	if($(this).attr('class')=='lfloat wborder easy'){
		$('.diff span').hide();
		$('.easy span').css('display','inline-block');
	} else{
		$('.easy span').hide();
		$('.diff span').css('display','inline-block');
	}
	});
});
