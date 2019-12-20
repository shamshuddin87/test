website(document).ready(function(){

website('body').on('click','.change_password', function(e){
    //website('#newpasswordmodal').modal('show');
    var newpassword = website('#newpassword').val();
    var confirmpassword = website('#confirmpassword').val();
    var  formData={newpassword:newpassword,confirmpassword:confirmpassword};
    //return false;
    //alert('i m here');
    
    
    if(newpassword == '' || newpassword == null){
        website('#newpasswordmodal').modal('show');
    }
    else if(confirmpassword == '' || confirmpassword == null){        
        website('#confirmpasswordmodal').modal('show');       
    }
     else if(newpassword != confirmpassword){
         website('#newconfirmpasswordmodal').modal('show'); 
        //alert('New Password and Confirm Password has to be match');
    }
    else if(newpassword.length < 6 || confirmpassword < 6){
         website('#passwordlengthmodal').modal('show'); 
            
            }
    else{
        
       // alert('COmpleted');
        website.ajax({
        type:"POST",
        url:'changepassword/passwordchange',
        data: formData,
        //contentType: "application/json; charset=utf-8",
        dataType:"json",
        beforeSend: function()
        {
            
        },
        uploadProgress: function(event, position, total, percentComplete)
        {
           
        },
        success: function(response) {
        window.location.href="home";
        },
        complete: function(response)
        {

        },
        error: function() {
            
        }
    });
    }
    
  
    // website('#newpassword').modal('show');
   
});

}); 
