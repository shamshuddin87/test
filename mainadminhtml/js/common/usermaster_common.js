

/* ===================== Pagination Start ===================== */
website('body').on('click','.paginationmn li', function(e) 
{
    var rscrntpg = website(this).attr('p');
    //alert(rscrntpg);
    website('.panel.panel-white #pagenum').val(rscrntpg);
    
    getuserlistonload();    
});
website('body').on('change','#noofrows', function(e) 
{
    website('.pagechnum').val(1);
    //alert(rscrntpg);
    
    getuserlistonload();
});
website('body').on('click','.go_button', function(e) 
{
    var rscrntpg = website('.gotobtn').val();
    //alert(rscrntpg);
    website('.panel.panel-white #pagenum').val(rscrntpg);
    
    getuserlistonload();
});
/* ===================== Pagination End ===================== */



//########################Department and Company Access#################
datepicker();
function datepicker(){
website('.bootdatepick').datetimepicker({
        weekStart: 1,
        todayBtn:  0,
        autoclose: 1,
        todayHighlight: 0,
        startView: 2,
        minView: 2,
        forceParse: 0,
        format: "dd-mm-yyyy"

    }).on('change', function(e, date)
    {
        var getdate = website(this).val();
        // console.log(getdate);
        var getid = website(this).closest('form').attr('id');
    });
  }


website('body').on('click','#cmpaccnme option',function(e)
{
    //console.log("u r hereeee ");return false;
    if (website(this).hasClass('optncmp')) {
        website(this).closest('form').find('#deptaccess option').prop('disabled',true);
        website(this).closest('form').find('#cmpaccnme option:selected').each(function(){
            var attrval = website(this).val();
            //console.log(attrval);
            //website(this).closest('form').find('#deptaccess option[cmplink="' + attrval + '"]').prop('disabled',false); 
            website(this).closest('form').find('#deptaccess option').each(function(){
                var chk = website(this).attr('cmplink');
                if (chk) {
                    var chkhr = chk.split(',');
                    //console.log('kahkjhakjash');console.log(chk);
                    for (var i = 0; i < chkhr.length; i++) {
                        if (chkhr[i] == attrval) {
                            website(this).prop('disabled',false);
                        }
                    }
                }
            });
        });
    }else{
        website(this).closest('form').find('#deptaccess option').prop('disabled',true);
        website(this).closest('form').find('#deptaccess option:eq(0)').prop('disabled',false); 
    }
});

website('body').on('click','#cmpaccnmee option',function(e)
{
    //console.log("u r hereeee ");return false;
    if (website(this).hasClass('optncmp')) {
        website(this).closest('form').find('#deptaccess option').prop('disabled',true);
        website(this).closest('form').find('#cmpaccnmee option:selected').each(function(){
            var attrval = website(this).val();
            //console.log(attrval);
            //website(this).closest('form').find('#deptaccess option[cmplink="' + attrval + '"]').prop('disabled',false); 
            website(this).closest('form').find('#deptaccess option').each(function(){
                var chk = website(this).attr('cmplink');
                if (chk) {
                    var chkhr = chk.split(',');
                    //console.log('kahkjhakjash');console.log(chk);
                    for (var i = 0; i < chkhr.length; i++) {
                        if (chkhr[i] == attrval) {
                            website(this).prop('disabled',false);
                        }
                    }
                }
            });
        });
    }else{
        website(this).closest('form').find('#deptaccess option').prop('disabled',true);
        website(this).closest('form').find('#deptaccess option:eq(0)').prop('disabled',false); 
    }
});


//####################Department and Company Acces Finish Here##########################



//##########################################Ajax FORM FOR INSERT MASTER LIST##################################//
website('#insertmasterlist').ajaxForm({
    //data:formdata,
    //contentType:'application/x-www-form-urlencoded; charset=UTF-8',
    dataType:"json",
    beforeSend: function() 
    {  website('.preloder_wraper').fadeIn(); },
    uploadProgress: function(event, position, total, percentComplete) 
    {   },
    success: function(response, textStatus, jqXHR) 
    {
         if(response.logged === true)
         {
             window.location.reload();
             new PNotify({title: 'Alert',
                    text:response.message,
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
            }); 
            getuserlistonload();
             
         }
         else
         {    
            new PNotify({title: 'Alert',
                    text: response.message,
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
            });
         }
    },
    complete: function(response) 
    {  website('.preloder_wraper').fadeOut(); },
    error: function() 
    {   }
});

//##########################################Ajax FORM FOR INSERT MASTER LIST FINISH HERE##################################//
//###########################################Ajax Form For Update###########################################//
website('#updatemasterlistid').ajaxForm({
    //data:formdata,
    //contentType:'application/x-www-form-urlencoded; charset=UTF-8',
    dataType:"json",
    beforeSend: function() 
     {  
        // website('.preloder_wraper').fadeIn(); 
    },
    uploadProgress: function(event, position, total, percentComplete) 
    {   },
    success: function(response, textStatus, jqXHR) 
    {
         if(response.logged === true)
         {

                new PNotify({title: 'Alert',
                    text: response.message,
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
                }); 
                getuserlistonload();
                website('#Mymodaledit').modal('hide');
                window.location.reload();
         }
         else
         {    
            new PNotify({title: 'Alert',
                    text: response.message,
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
            });
         }
    },
    complete: function(response) 
     { 
     // website('.preloder_wraper').fadeOut(); 
     },
    error: function() 
    {   }
});
//###########################################Ajax Form For Update FInish###########################################//


//##########################################ONLOAD USER MASTER LIST START HERE############################################//
getuserlistonload();
function getuserlistonload()
{
   var noofrows = website('#noofrows').val(); 
    var pagenum = website('#pagenum').val();
    // var chkclk = '';
    // var numofdata = 'all';
    var formdata = {noofrows:noofrows,pagenum:pagenum};
    website.ajax({
        url:'usermaster/fetchuser',
        data:formdata,
        method:'POST',
        //contentType:'json',
        contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
        dataType:"json",
        cache:false,
        //async:true, Cross domain checking
        beforeSend: function()
        {   website('.preloder_wraper').fadeIn();   },
        uploadProgress: function(event, position, total, percentComplete)
        {   },
        success: function(response, textStatus, jqXHR)
        {
            if(response.logged===true)
            {    
                //console.log(response.data); return false;
                var addhtmlnxt='';
                var dept = '';
                var companyname = '';
                for(var i = 0; i < response.data.length; i++) 
                {   
                    // dept = response.data[i].deptname ?response.data[i].deptname:'NONE';
                    // companyname = response.data[i].companyname ?response.data[i].companyname:'NONE';
                    var fullname=response.data[i].fullname?response.data[i].fullname:'NONE';
                    var  email=response.data[i].email?response.data[i].email:'NONE';
                    // var mobile=response.data[i].mobile?response.data[i].mobile:'NONE'
                    var dpdate=response.data[i].dpdate?response.data[i].dpdate:'NONE'
                    var designation=response.data[i].designation?response.data[i].designation:'NONE';
                    var companyname=response.data[i].companyname?response.data[i].companyname:'NONE';
                    var departmentname=response.data[i].department?response.data[i].department:'NONE'
                    // var  reminderdays=response.data[i].reminderdays?response.data[i].reminderdays:'NONE';
                    var employeecode=response.data[i].employeecode?response.data[i].employeecode:'';
                    //console.log(response.data.length); return false;
                    //------------------------- Table Fields Insertion START ------------------------
                    //var created = response.data[i].date_added.split(' ')[0];
                    //var modified = response.data[i].date_modified.split(' ')[0];
                    var j=i+1;
                    addhtmlnxt += '<tr class="counter" tempid="'+response.data[i].id+'" >';
                    addhtmlnxt += '<td width="15%">'+j+'</td>';
                    addhtmlnxt += '<td width="10%">'+employeecode+'</td>';
                    addhtmlnxt += '<td width="15%">'+fullname+'</td>';
                    addhtmlnxt += '<td width="15%">'+email+'</td>';
                    // addhtmlnxt += '<td width="15%">'+mobile+'</td>';
                    addhtmlnxt += '<td width="15%">'+designation+'</td>';
                    addhtmlnxt += '<td width="15%">'+dpdate+'</td>';
                    addhtmlnxt +='<td width="15%">'+companyname+'</td>';
                    addhtmlnxt+='<td width="15%">'+departmentname+'</td>';
                    // addhtmlnxt += '<td width="15%">'+reminderdays+'</td>';
                    if(response.data[i].master_group_id==2)
                    {
                       addhtmlnxt += '<td width="10%"><i class="fa fa-edit faicon dbeditme" title="Edit entry" tempid="'+response.data[i].id+'" ></i></td>';
                    }
                    else
                    {
                    addhtmlnxt += '<td width="10%"><i class="fa fa-edit faicon dbeditme" title="Edit entry" tempid="'+response.data[i].id+'" ></i><i class="fa fa-trash-o faicon dbdeleteme" title="Delete entry" tempid="'+response.data[i].id+'" ></i></td>';
                    }
                    addhtmlnxt += '</tr>';    

                    //------------------------ Table Fields Insertion END ------------------------
                }
               
                
            }
            else
            {
                addhtmlnxt += '<tr><td colspan="8" style="text-align:center;">NO DATA FOUND</td></tr>';
            }
            
            website('.appendrow').html(addhtmlnxt);
            website('.paginationmn').html(response.pgnhtml);
        },
        complete: function(response)
        {   website('.preloder_wraper').fadeOut();   },
        error: function(jqXHR, textStatus, errorThrown)
        {   }
    });
}
//##########################################ONLOAD USER MASTER LIST Finish START HERE##############################//





//##########################################DELETE USER#############################################################//
website('body').on('click','.dbdeleteme',function(e){ 
   var delid = website(this).attr('tempid');
   // alert(cmpid);
   website('#deleteid').val(delid);
   website('#delmod').modal('show');
});

website('body').on('click','#deleteuser',function(e){

var delid = website('#deleteid').val();
var formdata={delid:delid};
 website.ajax({
        url:'usermaster/deleteuser',
        data:formdata,
        method:'POST',
        contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        dataType:"json",
        cache:false,
        beforeSend: function()
        { 
            // website('.progress-indeterminate').fadeIn(); 

         },
        uploadProgress: function(event, position, total, percentComplete)
        {   },
        success: function(response, textStatus, jqXHR)
        {  
            if(response.logged==true)
            {
               // window.location.reload();
               // website('#delmod').modal('hide');
              
                
               website('#delmod').modal('hide');
               new PNotify({title: 'Alert',
                    text: response.message,
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
            }); 
              getuserlistonload();

           }
           else{
              new PNotify({title: 'Alert',
                    text: response.message,
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
                });
           }
        },
        complete: function(response)
         { 
         // website('.progress-indeterminate').fadeOut();
         },
        error: function(jqXHR, textStatus, errorThrown)
        {   }
    });
});

//##########################################DELETE USER FUNCTIONALLITY FINISH HERE##########################//


//##########################################UPDATE USER#####################################################//
website('body').on('click','.dbeditme',function(e){ 
   var tempid = website(this).attr('tempid');
    website('#appapnd').html('');
    var formdata={tempid:tempid};
     var len=website(".closeedit").length;
     if(len==0){
       website('#appapnd').css('display','none');
    
     }
     website.ajax({
        url:'usermaster/fetchsingleuser',
        data:formdata,
        method:'POST',
        //contentType:'json',
        contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
        dataType:"json",
        cache:false,
        //async:true, Cross domain checking
        beforeSend: function()
        {   },
        uploadProgress: function(event, position, total, percentComplete)
        {   },
        success: function(response, textStatus, jqXHR)
        {
            if(response.logged===true)
            {    
                
                website('#Mymodaledit #appapnd').remove('.closeuser');
                var addhtmlnxt='';
                var dept = '';
                var companyname = '';
                for(var i = 0; i < response.data.length; i++) 
                {   
                       
                        //console.log(response.data[i]);
                       var  firstname = response.data[i].firstname?response.data[i].firstname:'';
                       var lastname = response.data[i].lastname ?response.data[i].lastname:'';
                       var dpdate=response.data[i].dpdate ?response.data[i].dpdate:'';
                       var email=response.data[i].email?response.data[i].email:'';
                       // var  mobile=response.data[i].mobile?response.data[i].mobile:''
                       var designation=response.data[i].designation?response.data[i].designation:'';
                       // var reminderdays=response.data[i].reminderdays?response.data[i].reminderdays:'';
                       var approveid=response.data[i].approvid?response.data[i].approvid:'';
                       var approver=response.data[i].approver?response.data[i].approver:'';
                       var employeecode=response.data[i].employeecode?response.data[i].employeecode:'';
                       var l1firstname=response.data[i].l1firstname?response.data[i].l1firstname:'';
                       var l1lastname=response.data[i].l1lastname?response.data[i].l1lastname:'';
                       var l1email=response.data[i].l1email?response.data[i].l1email:'';
                       var l1empid=response.data[i].l1empid?response.data[i].l1empid:'';
                          website('#Mymodaledit #mlistid').val(response.data[i].id);
                          website('#Mymodaledit #userid').val(response.data[i].wr_id);
                          website('#Mymodaledit #firstname').val(firstname);
                          website('#Mymodaledit #lastname').val(lastname);
                          website('#Mymodaledit #email').val(email);
                          website('#Mymodaledit #empcode').val(employeecode);
                          // website('#Mymodaledit #mobile').val(mobile);
                          website('#Mymodaledit #designation').val(designation);
                          // website('#Mymodaledit #reminderdays').val(reminderdays);
                          website('#Mymodaledit #dpdate').val(dpdate);
                          website('#Mymodaledit #typeofusr').val(response.data[i].master_group_id);
                          website('#Mymodaledit #masterid').val(response.data[i].master_group_id);
                          website('#Mymodaledit #approveid').val(approveid);
                          website('#Mymodaledit #l1firstname').val(l1firstname);
                          website('#Mymodaledit #l1lastname').val(l1lastname);
                          website('#Mymodaledit #l1email').val(l1email);
                          website('#Mymodaledit #l1empid').val(l1empid);
                          

                          // console.log(response.data[i].approver);
                         

                              var approveuser='';
                              approveuser = approver.split(',');
//                              console.log(approveuser.length);

                              if (approveuser!= '')
                               { 
                                 website('#appapnd').css('display','block');
                                 website("#Mymodaledit #appapnd").html('');
                                 for(var k=0;k<approveuser.length;k++)
                                 {
                                    website("#Mymodaledit #appapnd").append(approveuser[k]);
                                 }
                              
                              }
                              else{
                                 website('#appapnd').css('display','none');
                                // website("#Mymodaledit #appapnd").html('');
                              }
   
                         //------------selct access write---------------------------------------------//
                           var  access= response.data[i].access;
                                // console.log(access);
                           
                          var access = access.split(',');
                         
                         if (access!= '') {
                         website.each(access, function(k, v) 
                        { 
                            website("#Mymodaledit #accrgt option[value='"+v+"']").prop("disabled",false);
                            website("#Mymodaledit #accrgt option[value='"+v+"']").prop("selected",true);
                        
                        });
                       }
                       else
                       {
                          website("#Mymodaledit #accrgt option").prop("selected",false);
                         }

                       
                        //-------------------------------Department selection---------------------------------------------//
                          
                             var  dept= response.data[i].deptaccess;
                             var dept = dept.split(',');
                            if (dept!= '')
                             {
                                website.each(dept, function(k, v) 
                                {  //console.log("checking values hre ");console.log(v);
                                  website("#Mymodaledit #deptaccess option[value='"+v+"']").prop("selected",true);
                                 });
                             }
                           else
                             {
                                   website("#Mymodaledit #deptaccess option").prop("selected",false);
                              }
                           //--------------------------------------------------------------------------//

                        //-----------------------select company--------------------------------------//
                             var  cmpny= response.data[i].cmpaccess;
                             var cmpny = cmpny.split(',');
                            if (cmpny!= '')
                             {
                                website.each(cmpny, function(k, v) 
                                {  //console.log("checking values hre ");console.log(v);
                                  website("#Mymodaledit #cmpaccnme option[value='"+v+"']").prop("selected",true);
                                 });
                             }
                           else
                             {
                                   website("#Mymodaledit #cmpaccnme option").prop("selected",false);
                              }
                                if(response.data[i].master_group_id==2)
                              {
                               // alert("2");
                                  website('#Mymodaledit #approvername').css('display','none');
                                  website('#Mymodaledit #typeofusr').css('display','none');
                                  website('#Mymodaledit .typu').css('display','none');
                                
                              }
                              else
                              {
                                //alert();
                                 website('#Mymodaledit #approvername').css('display','block');
                                  website('#Mymodaledit #typeofusr').css('display','block');
                                   website('#Mymodaledit .typu').css('display','block');
                                }
                           //--------------------------------------------------------------------------//
                                website('#Mymodaledit').modal('show');
                 
                }
               
                
            }
            else
            {
               
              
                
            }
                
        },
        complete: function(response)
        {   },
        error: function(jqXHR, textStatus, errorThrown)
        {   }
    });
});
//##########################################UPDATE USER##################################################################//

//########################search functiontionality for approve user######################################//

var useridarray=[];//global array declaread
website('body').on('click','.validatorsid',function(e)
{
  var uid=website(this).attr('uid');
  var name=website(this).attr('name');

 website('#appendapp').css('display','block');
  
  if(website("#appendapp #"+uid).length == 0)
   {
      useridarray.push(uid);

      arr=useridarray.toString()
      // console.log(arr);
      website('#appendapp').append('<div class="appendapp_div" id="'+uid+'">'+name+'<i class="fa fa-close ser_cross closeuser" id="'+uid+'" userid="'+uid+'"></i> </div> ');
      website('#approvernm').val(arr);
        new PNotify({title: 'Alert',
                    text: "APPROVER ADDED SUCCESSFULLY",
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
            }); 
   }
  else
  {

      new PNotify({title: 'Alert',
                    text: "APPROVER Already EXIST",
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
            }); 

    }
});
//---------------------remove append user------------------------
website('body').on('click','.closeuser',function(e)
{
  var idd = website(this).attr('id');
  var len=website(".closeuser").length;
  website('#'+idd).remove();
  var  position = useridarray.indexOf(idd);
  useridarray.splice(position, 1);
  var arr=useridarray.toString()
  website('#approvernm').val(arr);

  if(len==1)
  {
    website('#appendapp').css('display','none');
   }
 
 });
//------------------------remove append user Finish here---------------------------------

//-----------------------------------on key up search user----------------------
website(document).ready(function(){
 var len=website(".closeuser").length;
 if(len==0)
 {
    website('#appendapp').css('display','none');
  }
  website("#search-box").on("keyup", function() {
    var search=website('#search-box').val();

     if(search=="")
     {
      website('#live-search-header-wrapper ul').html('<li class="noresultfound"><span class="resp_new">USER NOT FOUND..!!</span></li>');
      }
    else{
            var formdata={search:search};
            website.ajax({
                url:'usermaster/searchuser',
                data:formdata,
                method:'POST',
                contentType:'application/x-www-form-urlencoded; charset=UTF-8',
                dataType:"json",
                cache:false,
                beforeSend: function()
                { 
                   
                        website('#live-search-header-wrapper').fadeIn();
                        website('#live-search-header-wrapper ul').html("<li>Please wait...</li>");
                        website('.mainprogressbarforall .progress').fadeIn();
                        website('.filtr-container').html("");
                        website('.filtr-container').removeAttr("style");
                        website('.filtr-search').fadeIn();
                        website('.filtr-search').val("");

                 },
                uploadProgress: function(event, position, total, percentComplete)
                {   },
                 success: function(response, textStatus, jqXHR) 
                {
                var addhtml='';
                website('#live-search-header-wrapper ul').html("");  
                website('#live-search-header-wrapper').fadeIn();
                        
                   if (response.logged == true && response.data.length>=1) 
                  {         
                    for(var i = 0; i < response.data.length; i++) 
                   {   
                      if(i==0)
                      {                           
                        addhtml += '<li uid="'+response.data[i].wr_id+'" id="'+response.data[i].id+'" name="'+response.data[i].fullname+'"  class="topul validatorsid">'+response.data[i].fullname;
                        addhtml += '<div class="clearelement"></div></li>';
                      }
                      else if(i==((response.data.length)-1))
                      {
                        addhtml += '<li uid="'+response.data[i].wr_id+'" id="'+response.data[i].id+'" name="'+response.data[i].fullname+'" class="topul validatorsid">'+response.data[i].fullname;
                        
                        addhtml += '<div class="clearelement"></div></li>';
                        
                      }
                      else
                      {
                        addhtml += '<li uid="'+response.data[i].wr_id+'" id="'+response.data[i].id+'"  name="'+response.data[i].fullname+'" class="topul validatorsid">'+response.data[i].fullname;
                        
                        addhtml += '<div class="clearelement"></div></li>';
                       }
                    }
                    website('#live-search-header-wrapper ul').html(addhtml);
                    
                  }
                else
                {
                  website('#live-search-header-wrapper ul').html('<li class="noresultfound"><span class="resp_new">'+response.message+'</span></li>');
                }
                website(".mainprogressbarforall .progress .progress-bar").width('100%');
              },
              complete: function(response) 
              {
                 website('.search-row').fadeIn();
                 website(".mainprogressbarforall .progress .progress-bar").fadeOut();
              },
                complete: function(response)
                 { 
                   website('.search-row').fadeIn();
                   website(".mainprogressbarforall .progress .progress-bar").fadeOut();
                 },
                error: function(jqXHR, textStatus, errorThrown)
                {   }
            });

        }

  });
});

//-----------------------------------on key up search user Finish here-----------------------------------------
//##########################################Search Functionality FINISH HERE###############################################//


//##########################################modal box search function Start here##########################################//

//----------------------------add approver for edit moadal box------------------------------------------------
website('body').on('click','.editapprover',function(e)
{
  var idd = website(this).attr('edituserid');
  var fullname = website(this).attr('fullname');
  var chkid="edit_"+idd;
  len=website("#appapnd #"+chkid).length;
  
  if(len<=0){
    //if no user appended on modal box then append otherwise show message
   html='<div class="append_div" id="edit_'+idd+'" edituserid="'+idd+'">'+fullname+'<i class="fa fa-close ser_cross closeedit" edituserid="'+idd+'"></i></div>';
   website('#appapnd').css('display','block');//display as bock 

   //---add array------
    var approveid=website('#approveid').val();//get hidden field value of approveid
    var arr=approveid.split(",");//str to array 
    if(arr=='')
    {
      //if array is null
      var arr=[];

      arr.push(idd);//push user id
      str=arr.toString();//arr to string
      website("#Mymodaledit #approveid").val(str);//insert to hidden field

     
    }
    else{
       //---add value to exist array--------------
       arr.push(idd);//push userid in array
       str=arr.toString();//arr to string
       website("#Mymodaledit #approveid").val(str);//insert to hidden field
    }
  

  website('#appapnd').append(html);
   new PNotify({title: 'Alert',
                    text: "APPROVER ADDED SUCCESSFULLY",
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
            }); 
}else{
  //if user allrady exist then show message
   new PNotify({title: 'Alert',
                    text: "APPROVER Already EXIST",
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
                });
}

});

//----------------------------add aapprover  for edit moadal box finish here----------------------------------------------//

//----------------------------remove appeended user from modal box  start here--------------------------------------------//
website('body').on('click','.closeedit',function(e)
{
  var approveid=website('#approveid').val();//check appended user id on modal box
  var arr=approveid.split(",");//str to array conversion
   var len=website(".closeedit").length;
  var idd = website(this).attr('edituserid');//get id of closed user
  website('#edit_'+idd).remove();//remove user from modal

       var  position = arr.indexOf(idd);//position in array 
       arr.splice(position, 1);//remove value from array
       var str=arr.toString();//to string conversion
       // console.log(str);
       website('#approveid').val(str);//insert into hidden field
 

   if(len==1){
    website('#appapnd').css('display','none');
    //if close last usetr then display block as none
    
  }
 

});

//----------------------------remove appeended user from modal box  Finish here-----------------------------------------------//

website(document).ready(function(){
  if(website(".closeedit").length == 0)
  {
  website('#myeditlist').css('display','none');
  //if no appendedd approver then dont show block
 }

 
 //---------------------------------on key up functionallity start here For modal box---------------------------------------------
  website("#Mymodaledit #approvername").on("keyup", function() {
    var search=website('#Mymodaledit #approvername').val();
      if(search==""){
       website('#myeditlist').css('display','none');
    
      }
      else{
         website('#myeditlist').css('display','block');
         var formdata={search:search};
            website.ajax({
                url:'usermaster/searchuser',
                data:formdata,
                method:'POST',
                contentType:'application/x-www-form-urlencoded; charset=UTF-8',
                dataType:"json",
                cache:false,
                beforeSend: function()
                { 
                   },
                     beforeSend: function()
                {   },
                uploadProgress: function(event, position, total, percentComplete)
                {   },
                success: function(response, textStatus, jqXHR)
                {

              
                  if(response.logged==true || response.length>=1 )
                  {
                      var myhtml='<ul>';

                        for(var z=0;z<response.data.length;z++)
                        {
                             // console.log(response.data[z].fullname);
                               myhtml+='<li class="editapprover" edituserid="'+response.data[z].wr_id+'" fullname="'+response.data[z].fullname+'">'+response.data[z].fullname+'</li>';
                               myhtml += '<div class="clearelement"></div>';
                             
                        }

                         myhtml+='</ul>';
                        website('#myeditlist').html(myhtml);
                    

                  } 
                  else{
                         website('#myeditlist').html('<div>User Not Found..!!</div>');
                  }
                },
              
             });
    }
});
});
//---------------------------------on key up functionallity Finish here---------------------------------------------------------//
 // ##########################################EDIT APPROVER SEARCH FINISH HERE##############################################//