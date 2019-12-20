website(document).ready(function() {
website('.noAutoComplete').attr('autocomplete', 'off');

website("#ValidateForgotPassword").validate({
rules: {
	youremail: {
		required: true,
		email: true,
	},
},
messages: {
	youremail: {
		required: "Type your e-mail address",
		email: "Not valid Email",
	},
},

errorPlacement: function(error, element) {
	var name = website(element).attr("name");
	error.appendTo(website("#" + name + "_validate"));
	website(element).attr("placeholder", error.text());
	website(element).addClass('invalid');
	setTimeout(function() {website(element).removeClass('invalid'); website(element).removeClass('valid');}, 5000) ;
	website('label.labelofman').addClass('active');
},

 submitHandler: function(form) {
	website(form).ajaxSubmit({
		type:"POST",
		data: website(form).serialize(),
		dataType:"json",
		beforeSend: function() 
		{website('.nextnowbtn').addClass('disabled');website('.mainprogressbarforall').fadeIn('slow');},
		uploadProgress: function(event, position, total, percentComplete) 
		{},
		success: function(response) {
			if (response.logged == true) {
				website('#login').hide();
				website('#mnfrm').show();
                website('.loginnowbtn').addClass('disabled');
				website('#emailid').val(response.email);
				website('#useridget').val(response.userid);
			} 
			else if (response.logged == false) {
				website('#login').show();
				website('#mnfrm').hide();
                website('#emailid').val('');
				website('#useridget').val('');
                website('.loginnowbtn').removeClass('disabled');
			}								
												
		},
		complete: function(response) 
		{website('.mainprogressbarforall').fadeOut('slow');},
		error: function() {website('html, body').animate({ scrollTop: 0 }, 'slow');}
	});
}
});

website("#ValidateForgotPasswordConfirm").validate({
rules: {
	emailid: {
		required: true,
	},
	useridget: {
		required: true,
	},
	yoursecuritycode: {
		required: true,
	},
	passwordnew: {
		required: true,
	},
},
messages: {
	emailid: {
		required: "You are doing cheating with console",
	},
	useridget: {
		required: "You are doing cheating with console",
	},
	yoursecuritycode: {
		required: "Please enter security code",
	},
	passwordnew: {
		required: "Please enter your new password",
	},
},

errorPlacement: function(error, element) {
	var name = website(element).attr("name");
	error.appendTo(website("#" + name + "_validate"));
	website(element).attr("placeholder", error.text());
	website(element).addClass('invalid');
	setTimeout(function() {website(element).removeClass('invalid'); website(element).removeClass('valid');}, 5000) ;
	website('label.labelofman').addClass('active');
},

 submitHandler: function(form) {
	website(form).ajaxSubmit({
		type:"POST",
		data: website(form).serialize(),
		dataType:"json",
		beforeSend: function() 
		{
			website('.mainprogressbarforall').fadeIn('slow');
			website('.confirmnowbtn').addClass('disabled');
		},
		uploadProgress: function(event, position, total, percentComplete) 
		{
			website('.confirmnowbtn').addClass('disabled');
		},
		success: function(response) {
			if (response.logged == true) {
				
				website('.confirmnowbtn').addClass('disabled');
				website('.errormainpwdchange').html(response.message+'<div class="logintxt">Now <a href="login">login</a> with your new password</div>').fadeIn(1000);
				website('#yoursecuritycode').attr('disabled','disabled');
				website('#passwordnew').attr('disabled','disabled');
				website('.pwdtext-form-text').html('Your email verification is confirmed');
				website('.pwdconfirm-form-text').html('Your are '+response.username);
				website('label[for="yoursecuritycode"]').html('Your code just verfied');
				setTimeout(function() {var baseHref = getbaseurl(); window.location.href=baseHref+'login';}, 3000) ;
				
			} 
			else if (response.logged == false) {
				if(response.type=='codenotmatch')
				{
					website('#yoursecuritycode').val('');
					website('#password').val('');
				}
				
				//website('.pwdconfirm-form-text').text('');
				website('.confirmnowbtn').removeClass('disabled');
				//website('#emailid').val('');
				//website('#useridget').val('');
				website('.pwdtext-form-text').html(response.message).fadeIn(1000);
			}								
												
		},
		complete: function(response) 
		{
			website('.confirmnowbtn').removeClass('disabled');
            website('.mainprogressbarforall').fadeOut('slow');
		},
		error: function() {
		}
	});
}
});



});