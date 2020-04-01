/*function preload()
{
    setInterval(function () {
        website('.chmnleft').fadeOut(700).fadeIn(300).fadeOut(160).delay(1350);
    }, 1);

}*/
website(document).ready(function() {
website.validator.addMethod("validEmail", 
function(value, element) 
{
	if(value == '') 
	return true;
	var temp1;
	temp1 = true;
	var ind = value.indexOf('@');
	var str2=value.substr(ind+1);
	var str3=str2.substr(0,str2.indexOf('.'));
	if(str3.lastIndexOf('-')==(str3.length-1)||(str3.indexOf('-')!=str3.lastIndexOf('-')))
		return false;
	var str1=value.substr(0,ind);
	if((str1.lastIndexOf('_')==(str1.length-1))||(str1.lastIndexOf('.')==(str1.length-1))||(str1.lastIndexOf('-')==(str1.length-1)))
		return false;
	str = /(^[a-zA-Z0-9]+[\._-]{0,1})+([a-zA-Z0-9]+[_]{0,1})*@([a-zA-Z0-9]+[-]{0,1})+(\.[a-zA-Z0-9]+)*(\.[a-zA-Z]{2,3})$/;
	temp1 = str.test(value);
	return temp1;
}, "Please enter valid email.");	
website(function() {
	website('#password').on('keypress', function(e) {
		if (e.which == 32)
			return false;
	});
});
website("#ValidateLogin").validate({
rules: {
	youremail: {
		required: true,
		email: true,
		//validEmail:true
	},
	password: {
		required: true,
		minlength: 6
	 },
	
},
messages: {
	youremail: {
		required: "Type your e-mail address",
		email: "Not valid Email",
	},
	password: {
		required: "Passwords should have at least 6 characters",
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
		//contentType: "application/json; charset=utf-8",
		dataType:"json",
		beforeSend: function() 
		{
			website('.progressnew').fadeIn();
			website('.loginnowbtn').addClass('disabled');
            //website('.errorelement').fadeOut('slow');
            website('.loginleftmn').addClass('chmnleft');
            website('.loginrightmn').addClass('chmnright');
            website('.progress-indeterminate').fadeIn();
		},
		uploadProgress: function(event, position, total, percentComplete) 
		{
			website('.loginnowbtn').addClass('disabled');
            website('.errorelement').fadeOut('slow');
		},
		success: function(response) {
            var baseHref = getbaseurl(); 
            
			if (response.logged == true) {
                setTimeout(function(){ 
                    website('.loginleftmn').removeClass('chmnleft');
                    website('.loginrightmn').removeClass('chmnright');
                    website('.progressnew').fadeOut();                    
                    window.location.href=baseHref+'home';
                    website('.loginnowbtn').removeClass('disabled');
                    website('.progress-indeterminate').fadeOut();

                }, 2000);
                 
                  
                //gettaskbundleto();
			} 
			else {
                
                setTimeout(function(){ 
                    website('.loginleftmn').removeClass('chmnleft');
                    website('.loginrightmn').removeClass('chmnright');
                    website('.progress-indeterminate').fadeOut();
                    website('.progressnew').fadeOut();website('.loginnowbtn').removeClass('disabled');
                }, 2500);
				website('.geterrorelemttxt').html(response.message);
                website('.errorelement').fadeIn('slow');
				setTimeout(function() {website('.errormain').html(''); }, 5000) ;
                
			}	
            
												
		},
		complete: function(response) 
		{
			
		},
		error: function() {
			website('html, body').animate({ scrollTop: 0 }, 'slow');
			website('.loginnowbtn').removeClass('disabled');
            website('.errorelement').fadeOut('slow');
		}
	});
}
});



/*+++++++++++++++++++++++++++Heart Animation+++++++++++++++++++++++++++++++++++++++++*/
    
function animateHeart() {
    website('.heart.beat').animate({ fontSize: website('.heart').css('fontSize') == '15px' ? '10px' : '15px' }, 100, animateHeart);
}
website('.heart').hover(function () {
    website(this).addClass('beat');
    animateHeart();
}, function () {
    website(this).removeClass('beat');
});	
   
/*+++++++++++++++++++++++++++Heart Animation+++++++++++++++++++++++++++++++++++++++++*/  
    
});


/*********************   sound beep *************/
function gettaskbundleto()
{
    var appendhtml ='';
    var formData = {tpof:'all',cid:0};
    website.ajax({
        url:'taskbundle/getttodaywman',
        data:formData,
        method:'POST',
        contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        dataType:"json",
        cache:false,
        beforeSend: function()
        { website('.progress-indeterminate').fadeIn();  },
        uploadProgress: function(event, position, total, percentComplete)
        {   },
        success: function(response, textStatus, jqXHR)
        {
            var appendhtml='',appendhtmlm='',clrddot='',appendhtmlmn='';
            website(".top_blo_center").mCustomScrollbar('destroy');
            if(response.logged===true)
            {             
                
                var notcount = parseFloat(response.data.length)+parseFloat(response.mgenditm.length);
                
                website('#dd-notifications-count').html(notcount);
                
                
                
                if(notcount > 0)
                    {
                        
                        website('.fa-bell-o').addClass('pulse2');
                        
                        setTimeout(function(){ 
                            website('#mnotificationcmmm .player_audio').attr("src","mp3/ios_notification.mp3"); 
                                             website('.player_audio').trigger('play');
                        }, 1000);
                    }
                
                
            }
         
            /*<li><a href="accountsetting?moc=changepwd"><i class="icon-user-lock"></i> Account security</a></li>*/
                       
            
            
            /*website(".table-contract").mCustomScrollbar({axis:"y",scrollButtons:{enable:true},theme:"rounded-dark",scrollbarPosition:"inside"});*/
            website(".mnnmp").mCustomScrollbar({
                                    scrollButtons:{enable:true,scrollType:"stepped"},
                                    keyboard:{scrollType:"stepped"},
                                    mouseWheel:{scrollAmount:188},
                                    theme:"rounded-dark",
                            });
        },
        complete: function(response)
        {  website('.progress-indeterminate').fadeOut(); },
        error: function(jqXHR, textStatus, errorThrown)
        {   }
    });
}

/********************* End of sound beep *************/