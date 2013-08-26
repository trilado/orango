$(document).ready(function(){
	$('a[data-toggle="confirm"]').click(function(e){
		e.preventDefault();
		var confirm = $($(this).attr('href'));
		confirm.show('fast')
		.find('*[data-toggle="dismiss"]')
		.click(function(){
			confirm.hide('fast');
		});
	});
	
	$('select[data-toggle="chosen-multiple"]').chosen();
	
	$('#form-post #btn-publish').click(function(e){
		e.preventDefault();
		var self = $(this);
		$('#form-post').attr('action', self.attr('href')).submit();
	});
	
	$('#form-post #btn-search').click(function(e){
		e.preventDefault();
		$('#form-post').attr('action', '').attr('method', 'GET').submit();
	});
	
	$('#form-post #input-search').keypress(function(e){
		var code = (e.keyCode ? e.keyCode : e.which);
		if(code == 13) { //Enter keycode
			e.preventDefault();
			$('#form-post #btn-search').click();
		}
	});

	$('#post-form #Image').click(function(){
		$(this).parent().find('input[type="file"]').click();
	});
	
	// User add validation
	$('#user-form').validate({
		rules: {
			Name: {
				minlength: 3,
				required: true
			},
			Email: {
				required: true,
				email: true
			},
			Password: {
				minlength: 6
			}
		},
		messages: {
			Name: {
				minlength: 'Seu nome deve conter no mínimo 3 caractéres.',
				required: 'Você deve informar seu nome.'
			},
			Email: {
				required: 'Você deve informar o seu e-mail.',
				email: 'O e-mail está em formato incorreto.'
			},
			Password: {
				required: 'Você deve informar uma senha.',
				minlength: 'A senha deve ter pelo menos 6 caractéres'
			}
		},
		highlight: validateHighLight(),
		success: validateSuccess()
	});

	//Category add validation
	$('#form-category').validate({
		rules: {
			Name: {
				required: true,
				minlength: 3
			}
		},
		messages: {
			Name: {
				required: 'Você deve informar um nome para a categoria.',
				minlength: 'O nome da categoria deve ter pelo menos 3 caractéres.'
			}
		}
	});

	//Profile form
	$('#profile-form').validate({
		rules: {
			Email: {
				required: true,
				email: true
			},
			Name: {
				required: true,
				minlength: 3
			}
		},
		messages: {
			Email: {
				required: 'Você deve informar seu e-mail.',
				email: 'O e-mail está em formato incorreto.'
			},
			Name: {
				required: 'Você deve informar seu nome.',
				minlength: 'O nome deve possuir no mínimo 3 caractéres.'
			}
		}
	});

	$('#profile-form #Password').keydown(function(){
		var self = $(this);
		if(self.val())
		{
			$('#Repassword-group, #OldPassword-group').show('fast');
		}
		else
		{
			$('#Repassword-group, #OldPassword-group').hide('fast');
		}
	});
});

function validateSuccess(){
	return function(element) {
		element
		.text('OK!').addClass('valid')
		.closest('.control-group').removeClass('error').addClass('success');
	};
}

function validateHighLight(){
	return function(element) {
		$(element).closest('.control-group').removeClass('success').addClass('error');
	};
}
