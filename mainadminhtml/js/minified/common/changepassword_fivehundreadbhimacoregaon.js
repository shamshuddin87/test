
website(document).ready(function(){website('body').on('click','.change_password',function(e){var newpassword=website('#newpassword').val();var confirmpassword=website('#confirmpassword').val();var formData={newpassword:newpassword,confirmpassword:confirmpassword};if(newpassword==''||newpassword==null){website('#newpasswordmodal').modal('show');}
else if(confirmpassword==''||confirmpassword==null){website('#confirmpasswordmodal').modal('show');}
else if(newpassword!=confirmpassword){website('#newconfirmpasswordmodal').modal('show');}
else if(newpassword.length<6||confirmpassword<6){website('#passwordlengthmodal').modal('show');}
else{website.ajax({type:"POST",url:'changepassword/passwordchange',data:formData,dataType:"json",beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response){window.location.href="home";},complete:function(response)
{},error:function(){}});}});});;