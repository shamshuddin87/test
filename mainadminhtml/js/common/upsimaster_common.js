website(document).ready(function()
{
    getallupsietails();
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

});
website('body').on('click','.paginationmn li', function(e) 
{
    var rscrntpg = website(this).attr('p');
    website('.panel.panel-white #pagenum').val(rscrntpg);
    getallupsietails();
});



website('body').on('change','#noofrows', function(e) 
{
   getallupsietails();
});
//-------------------------GO BUTTON-------------------------

website('body').on('click','.go_button', function(e) 
{
    var rscrntpg = website('.gotobtn').val();
    website('.panel.panel-white #pagenum').val(rscrntpg);
    getallupsietails();
 });



//--------------------------------------------------------------


function getallupsietails()
{
    var noofrows = website('#noofrows').val(); 
    var pagenum = website('#pagenum').val();
    formdata={noofrows:noofrows,pagenum:pagenum};
    website.ajax({
        url:'upsimaster/getallupsietail',
        data:formdata,
        method:'POST',
        contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        dataType:"json",
        cache:false,
        beforeSend: function()
        { },
        uploadProgress: function(event, position, total, percentComplete)
        {   },
        success: function(response, textStatus, jqXHR)
        {  
            var htmlelements='';
            if(response.logged==true)
            {
                //console.log(response.data);
                 for(var i=0;i<response.data.length;i++)
                 {
                    var enddate =  response.data[i]['enddate']?response.data[i]['enddate']:'';
                     var dpusers = [];
                    var j=i+1;  
                    htmlelements+='<tr>';
                    htmlelements+='<td width="10%">'+j+'</td>';
                    htmlelements+='<td width="20%">'+response.data[i]['upsitype']+'</td>';
                    htmlelements+='<td width="20%">'+response.data[i]['projstartdate']+'</td>';
                    htmlelements+='<td width="20%">'+enddate+'</td>';
                    htmlelements+='<td width="20%">'+response.data[i]['fullname']+'</td>';
                    htmlelements+='<td width="10%">';
                    if(response.data[i]['connecteddps'])
                    {
                        dpusers = response.data[i]['connecteddps'];
                        dpusers = dpusers.split(",");
                    }
                    if(response.usergrp == '14' || response.usergrp == '2' || response.userid == response.data[i]['projectowner'])
                    {
                        htmlelements+='<i class="fa fa-edit upedit" upsiid="'+response.data[i][0]+'" ></i>';
                    }
                    if(response.usergrp == '14' || response.usergrp == '2')
                    {
                        htmlelements+='<i class="fa fa-trash delups" delupsiid="'+response.data[i][0]+'"></i></td>';
                    }
                   
                    htmlelements+='</tr>';
                 }
            }
            else
            {
                htmlelements += '<tr><td colspan="6" style="text-align:center;">NO DATA FOUND</td></tr>';
            }
             website('.upsitails').html(htmlelements);
             website('.paginationmn').html(response.pgnhtml);
        },
        complete: function(response)
        {   },
        error: function(jqXHR, textStatus, errorThrown)
        {   }
    });                     
                 
}





website('body').on('click','.upedit',function(e){ 
   var  upsiid = website(this).attr('upsiid');
  
    var formdata={upsiid:upsiid};
    website.ajax({
        url:'upsimaster/getsingleupsidetail',
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
                if(response.data['toalldps'] == 1)
                {
                    website('#upalldps').prop('checked', true);
                    website('#upsimodel #dpsmodel').fadeOut();
                    website("#upsimodel #connectdps option").prop("selected",false);
                }
                else
                {
                    website('#upsimodel #dpsmodel').fadeIn();
                    var connecteddps = response.data['connecteddps']?response.data['connecteddps']:'';
                    website('#upsimodel #cmpconnectdps').val(connecteddps);
                    if(response.dpusers)
                    { 
                        var addhtml ='';
                        website.each(response.dpusers, function(k, v) 
                        {
                            var userid = response.dpusers[k]['wr_id'];
                            var username = response.dpusers[k]['fullname'];
                            var useremail = website(this).attr('email');

                            addhtml+= '<div class="row-'+userid+'"><section class="col col-md-8 col-xs-8"><label class="control-label">Name of Connected DP*</label><input type="text" id="approvers" name="approvers[]" class="form_fields form-control col-md-7 col-xs-12" value="'+username+'" userid="'+userid+'" useremail="'+useremail+'" required readonly></section>';

                            addhtml += '<section class="col col-md-4 col-xs-4"><i class="fa fa-trash-o faicon dbaprvl" num="'+userid+'" title="Delete entry"></i></section>';
                            
                            addhtml+= '<input type="hidden" value="'+userid+'" name="connectdps[]">';
                            addhtml+= '<input type="hidden" value="'+useremail+'" name="useremail[]"></div>';
                            website('#upsimodel .connectedp').html(addhtml);
                        });
                      
                    }
                }

                // console.log(response);
                if(response.data.projectowner == response.loggedinuser)
                {
                    // console.log('in iff'); 
                    website("#upsimodel #upname").attr("readonly","readonly");
                    website("#upsimodel #projdesc").attr("readonly","readonly");
                    website(".searchowner").attr("readonly","readonly");
                    website("#upsimodel #pstartdte").attr("disabled","disabled");
                    website("#upsimodel #enddate").attr("disabled","disabled");

                   

                }
                else
                {
                    website("#upsimodel #upname").removeAttr("readonly");
                    website("#upsimodel #projdesc").removeAttr("readonly");
                    website(".searchowner").removeAttr("readonly");
                    website("#upsimodel #pstartdte").removeAttr("disabled");
                    website("#upsimodel #enddate").removeAttr("disabled");
                }

                var upupsnm = response.data['upsitype']?response.data['upsitype']:'';
                var projstartdate = response.data['projstartdate']?response.data['projstartdate']:'';
                var enddate = response.data['enddate']?response.data['enddate']:'';
                var projectownerid = response.data['projectowner']?response.data['projectowner']:'';
                var projectownername = response.data['fullname']?response.data['fullname']:'';
                var projectdes = response.data['projdescriptn']?response.data['projdescriptn']:'';
                
                website('#upsimodel #upname').val(upupsnm);
                website('#upsimodel #cmpupname').val(upupsnm);
                
                website('#upsimodel #pstartdte').val(projstartdate);
                website('#upsimodel #cmppstartdte').val(projstartdate);
                 website('#upsimodel #pstartdtecopy').val(projstartdate);
                
                website('#upsimodel #enddate').val(enddate);
                website('#upsimodel #cmpenddate').val(enddate);
                 website('#upsimodel #enddatecopy').val(enddate);
                
                website('#upsimodel #ownerid').val(projectownerid);
                website('#upsimodel #cmpownerid').val(projectownerid);
                
                website('#upsimodel #ownermodal').val(projectownername);
                website('#upsimodel #cmpownermodal').val(projectownername);
                
                website('#upsimodel #cmpprojdes').val(projectdes);
                website('#upsimodel #projdesc').val(projectdes);
                
                website('#upsimodel #cmpid').val(response.data['companyid']);
                website('#upsimodel #editid').val(response.data['id']);
                website('#upsimodel').modal('show');
                
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



// website('body').on('click','#upbtn',function(e){
//     website('#modaltradingwindowclose #tradingwindowno').attr('action','update');
//     website('#modaltradingwindowclose').modal('show');
//     //website('#addupsimast').submit();
// });

website('#updateupsimast').ajaxForm({
    //data:formdata,
    //contentType:'application/x-www-form-urlencoded; charset=UTF-8',
    dataType:"json",
    beforeSend: function() 
    {   website('.preloder_wraper').fadeIn(); },
    uploadProgress: function(event, position, total, percentComplete) 
    {   },
    success: function(response, textStatus, jqXHR) 
    {
         if(response.logged === true)
         {
            //website('#modaltradingwindowclose').modal('hide');
            website("#upsimodel").modal('hide');
            new PNotify({title: 'Alert',
            text: response.message,
            type: 'university',
            hide: true,
            styling: 'bootstrap3',
            addclass: 'dark ',
            });
            getallupsietails(); 
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
    {   website('.preloder_wraper').fadeOut(); },
    error: function() 
    {  website('.preloder_wraper').fadeOut(); }
});


website('body').on('click','.delups',function(e){ 
  var delid = website(this).attr('delupsiid');
   // alert(delid);
   website('#deleteid').val(delid);
   website('#delmod').modal('show');
});

website('body').on('click','#delups',function(e){

var  delid = website('#deleteid').val();
// alert(delid);
formdata={delid:delid};    
 website.ajax({
        url:'upsimaster/deleteupsi',
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
                website('#delmod').modal('hide');
                  new PNotify({title: 'Alert',
                    text: response.message,
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
                 });
                getallupsietails();
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
         // website('.progress-indeterminate').fadeOut();
         },
        error: function(jqXHR, textStatus, errorThrown)
        {   }
    });
});

 website('body').on('change','#alldps',function() {
    if(website(this).is(":checked"))
    {
        website('#addupsimast #connectedpform #connectdps').removeAttr('required','required');
        website('#addupsimast #connectedpform').css('display','none');
    }
    else
    {
        website('#addupsimast #connectedpform #connectdps').attr('required','required');
        website('#addupsimast #connectedpform').css('display','block');
    }       
});

 website('body').on('change','#upsimodel #upalldps',function() {
     
    if(website(this).is(":checked"))
    {
        website('#updateupsimast #connectdps').removeAttr('required','required');
        website('#updateupsimast #dpsmodel').css('display','none');
    }
    else
    {
        website('#updateupsimast #connectdps').attr('required','required');
        website('#updateupsimast #dpsmodel').css('display','block');
    }       
});

website('body').on('click','.addupsitype',function(e){

    var title = website("#addupsimast #upnm").val();
    var startdt = website("#addupsimast #pstartdte").val();
    var owner = website("#addupsimast #owner").val();
    
    if(!title)
    {
         new PNotify({title: 'Alert',
                    text: 'Please Enter title of UPSI',
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
                 });
    }
    else if(!startdt)
    {
        new PNotify({title: 'Alert',
                    text: 'Please Enter start date of UPSI',
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
                 });
  
    }
    else if(!owner)
    {
        new PNotify({title: 'Alert',
                    text: 'Please Select owner of UPSI',
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
                 });
  
    }
    else
    {
         website('#modaltradingwindowclose #tradingwindowno').attr('action','insert');
        website('#modaltradingwindowclose').modal('show');
    }

   
   
    //website('#addupsimast').submit();
});

//website('body').on('click','#tradingacc',function(e){
//    website('#addupsimast').submit();
//   
//});

website('body').on('click','#tradingwindowno',function(e){
    var actiontype = website(this).attr('action');
    if(actiontype == 'insert')
    {
        website('#addupsimast').submit();
    }
    // else if(actiontype == 'update')
    // {
    //     website('#updateupsimast').submit();
    // }
   
});

website('body').on('click','#tradingrej',function(e){
         
            website('#alertcommon #allalertmsg').html("Upsi Is Not Added..!!!");
            website('#alertcommon').modal('show'); 
            
   
});

 website('#addupsimast').ajaxForm({
    //data:formdata,
    //contentType:'application/x-www-form-urlencoded; charset=UTF-8',
    dataType:"json",
    beforeSend: function() 
    { website('.preloder_wraper').fadeIn();  },
    uploadProgress: function(event, position, total, percentComplete) 
    {  website('.preloder_wraper').fadeIn(); },
    success: function(response, textStatus, jqXHR) 
    {
         if(response.logged === true)
         {
            website('#modaltradingwindow').modal('hide');
             website('#modaltradingwindowclose').modal('hide');
              new PNotify({title: 'Alert',
                    text: response.message,
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
                 });
            website("#addupsimast").trigger('reset');
            getallupsietails(); 
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
/************** for search **********/

var timer = 0;
function mySearch (){ 
    var getvalue = website('.header-search-input').val();
    doSearch(getvalue); 
}

website('.header-search-input').on('keyup', function(e){
    var getkeycode = website.trim(e.keyCode);
     if (getkeycode != '40' && getkeycode !='38' && getkeycode != '13'){
        if (timer) {
            clearTimeout(timer);
        }
        timer = setTimeout(mySearch, 400); 
     }
});

var timer = 0;
function mySearchforedit (){ 
    var getvalue = website('#upsimodel .header-search-input').val();
    doSearchforedit(getvalue); 
}

var timer = 0;
function mySearchfordps (){ 
    var getvalue = website('#connectedpmodal .header-search-input').val();
    doSearchfordps(getvalue); 
}

website('#projowner .header-search-input').on('keyup', function(e){
    var getkeycode = website.trim(e.keyCode);
     if (getkeycode != '40' && getkeycode !='38' && getkeycode != '13'){
        if (timer) {
            clearTimeout(timer);
        }
        timer = setTimeout(mySearchforedit, 400); 
     }
});

website('#connectedpmodal .header-search-input').on('keyup', function(e){
    var getkeycode = website.trim(e.keyCode);
     if (getkeycode != '40' && getkeycode !='38' && getkeycode != '13'){
        if (timer) {
            clearTimeout(timer);
        }
        timer = setTimeout(mySearchfordps, 400); 
     }
});

website( "#live-search-header-wrapper" ).scroll(function() {
  //console.log('got it');
});

website( "#projowner #live-search-header-wrapper" ).scroll(function() {
  //console.log('got it');
});

website( "#connectedpmodal #live-search-header-wrapper" ).scroll(function() {
  //console.log('got it');
});

function myCustomFn(el){
    //console.log('coming here');
}

website("#live-search-header-wrapper").mCustomScrollbar({
        scrollButtons:{enable:true,scrollType:"stepped"},
        keyboard:{scrollType:"stepped"},
        mouseWheel:{scrollAmount:188},
        theme:"rounded-dark",
        autoExpandScrollbar:true,
        snapAmount:188,
        snapOffset:65,
        callbacks:{
            onScroll:function(){
                myCustomFn(this);
            }
        }
}); 

website("#projowner #live-search-header-wrapper").mCustomScrollbar({
        scrollButtons:{enable:true,scrollType:"stepped"},
        keyboard:{scrollType:"stepped"},
        mouseWheel:{scrollAmount:188},
        theme:"rounded-dark",
        autoExpandScrollbar:true,
        snapAmount:188,
        snapOffset:65,
        callbacks:{
            onScroll:function(){
                myCustomFn(this);
            }
        }
}); 

website("#connectedpmodal #live-search-header-wrapper").mCustomScrollbar({
        scrollButtons:{enable:true,scrollType:"stepped"},
        keyboard:{scrollType:"stepped"},
        mouseWheel:{scrollAmount:188},
        theme:"rounded-dark",
        autoExpandScrollbar:true,
        snapAmount:188,
        snapOffset:65,
        callbacks:{
            onScroll:function(){
                myCustomFn(this);
            }
        }
});

function doSearch(getvalue)
{
  var getkeyword = getvalue;
  if(website.trim(getkeyword)=="")
  {
    website('#live-search-header-wrapper ul').html('<li class="noresultfound">No Result Fould!!!!</li>');
  }
  else
  {
  var formdata = {searchvallist:getkeyword,geturl:''}
    website.ajax({
      url:'upsimaster/dpuserlists',
      //url:'template/templatedetails',   
      data:formdata,
      method:'POST',
      //contentType:'json',
      contentType:'application/x-www-form-urlencoded; charset=UTF-8',
      //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
      dataType:"json",
      cache:false,
      //async:true, /*Cross domain checking*/
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
      {
                website('#live-search-header-wrapper').fadeIn();
                website('#live-search-header-wrapper ul').html("<li>Please wait...</li>");
                website('.mainprogressbarforall .progress').fadeIn();
                website(".mainprogressbarforall .progress .progress-bar").width(percentComplete+'%');
                
      },
      success: function(response, textStatus, jqXHR) 
      {
        var addhtml='';
        website('#live-search-header-wrapper ul').html("");  
        website('#live-search-header-wrapper').fadeIn();
                
        if (response.logged == true && response.data.length>=1) 
        {         
          //console.log(response.data);return false;
          for(var i = 0; i < response.data.length; i++) 
                    {   
            if(i==0)
            {                           
              addhtml += '<li userid="'+response.data[i].wr_id+'" username="'+response.data[i].fullname+'" useremail="'+response.data[i].email+'" class="topul dpusers">'+response.data[i].fullname;
              addhtml += '<div class="clearelement"></div></li>';
            }
            else if(i==((response.data.length)-1))
            {
              addhtml += '<li userid="'+response.data[i].wr_id+'" username="'+response.data[i].fullname+'" useremail="'+response.data[i].email+'"  class="bottomul dpusers">'+response.data[i].fullname;
              addhtml += '<div class="clearelement"></div></li>';
              
            }
            else
            {
              addhtml += '<li userid="'+response.data[i].wr_id+'" username="'+response.data[i].fullname+'" useremail="'+response.data[i].email+'"  class="bottomul dpusers">'+response.data[i].fullname;
              addhtml += '<div class="clearelement"></div></li>';
            }
          }
          website('#live-search-header-wrapper ul').html(addhtml);
          //window.location.reload();
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
      error: function(jqXHR, textStatus, errorThrown)
      {
        //website('#live-search-header-wrapper ul').fadeOut();      
      }
    }); 
  }
  
}

function doSearchforedit(getvalue)
{  
  var getkeyword = getvalue;
  if(website.trim(getkeyword)=="")
  {
    website('#projowner #live-search-header-wrapper ul').html('<li class="noresultfound">No Result Fould!!!!</li>');
  }
  else
  {
  var formdata = {searchvallist:getkeyword,geturl:''}
    website.ajax({
      url:'upsimaster/dpuserlists',
      //url:'template/templatedetails',   
      data:formdata,
      method:'POST',
      //contentType:'json',
      contentType:'application/x-www-form-urlencoded; charset=UTF-8',
      //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
      dataType:"json",
      cache:false,
      //async:true, /*Cross domain checking*/
      beforeSend: function() 
      {
                website('#projowner #live-search-header-wrapper').fadeIn();
                website('#projowner #live-search-header-wrapper ul').html("<li>Please wait...</li>");
                website('#projowner .mainprogressbarforall .progress').fadeIn();
                website('#projowner .filtr-container').html("");
                website('#projowner .filtr-container').removeAttr("style");
                website('#projowner .filtr-search').fadeIn();
                website('#projowner .filtr-search').val("");
      },
      uploadProgress: function(event, position, total, percentComplete) 
      {
                website('#projowner #live-search-header-wrapper').fadeIn();
                website('#projowner #live-search-header-wrapper ul').html("<li>Please wait...</li>");
                website('#projowner .mainprogressbarforall .progress').fadeIn();
                website("#projowner .mainprogressbarforall .progress .progress-bar").width(percentComplete+'%');
                
      },
      success: function(response, textStatus, jqXHR) 
      {
        var addhtml='';
        website('#projowner #live-search-header-wrapper ul').html("");  
        website('#projowner #live-search-header-wrapper').fadeIn();
                
        if (response.logged == true && response.data.length>=1) 
        {         
          //console.log(response.data);return false;
          for(var i = 0; i < response.data.length; i++) 
                    {   
            if(i==0)
            {                           
              addhtml += '<li userid="'+response.data[i].wr_id+'" username="'+response.data[i].fullname+'" useremail="'+response.data[i].email+'" class="topul dpusersmodal">'+response.data[i].fullname;
              //addhtml += '<a target="_blank" href="profile/willline/'+response.data[i].cid+'" class="floatleft searchavtarname">'+response.data[i].comanyname+'</a>';
              addhtml += '<div class="clearelement"></div></li>';
            }
            else if(i==((response.data.length)-1))
            {
              addhtml += '<li userid="'+response.data[i].wr_id+'" username="'+response.data[i].fullname+'" useremail="'+response.data[i].email+'"  class="bottomul dpusersmodal">'+response.data[i].fullname;
              //addhtml += '<a target="_blank" href="profile/willline/'+response.data[i].cid+'" class="floatleft searchavtarname">'+response.data[i].comanyname+'</a>';
              addhtml += '<div class="clearelement"></div></li>';
              
            }
            else
            {
              addhtml += '<li userid="'+response.data[i].wr_id+'" username="'+response.data[i].fullname+'" useremail="'+response.data[i].email+'"  class="bottomul dpusersmodal">'+response.data[i].fullname;
              //addhtml += '<a target="_blank" href="profile/willline/'+response.data[i].cid+'" class="floatleft searchavtarname">'+response.data[i].comanyname+'</a>';
              addhtml += '<div class="clearelement"></div></li>';
            }
          }
          website('#projowner #live-search-header-wrapper ul').html(addhtml);
          //window.location.reload();
        }
        else
        {
          website('#projowner #live-search-header-wrapper ul').html('<li class="noresultfound"><span class="resp_new">'+response.message+'</span></li>');
        }
        website("#projowner .mainprogressbarforall .progress .progress-bar").width('100%');
      },
      complete: function(response) 
      {
                website('#projowner .search-row').fadeIn();
                website("#projowner .mainprogressbarforall .progress .progress-bar").fadeOut();
      },
      error: function(jqXHR, textStatus, errorThrown)
      {
        //website('#live-search-header-wrapper ul').fadeOut();      
      }
    }); 
  }
  
}

function doSearchfordps(getvalue)
{  
  var getkeyword = getvalue;
  if(website.trim(getkeyword)=="")
  {
    website('#connectedpmodal #live-search-header-wrapper ul').html('<li class="noresultfound">No Result Fould!!!!</li>');
  }
  else
  {
  var formdata = {searchvallist:getkeyword,geturl:''}
    website.ajax({
      url:'upsimaster/dpuserlists',
      //url:'template/templatedetails',   
      data:formdata,
      method:'POST',
      //contentType:'json',
      contentType:'application/x-www-form-urlencoded; charset=UTF-8',
      //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
      dataType:"json",
      cache:false,
      //async:true, /*Cross domain checking*/
      beforeSend: function() 
      {
                website('#connectedpmodal #live-search-header-wrapper').fadeIn();
                website('#connectedpmodal #live-search-header-wrapper ul').html("<li>Please wait...</li>");
                website('#connectedpmodal .mainprogressbarforall .progress').fadeIn();
                website('#connectedpmodal .filtr-container').html("");
                website('#connectedpmodal .filtr-container').removeAttr("style");
                website('#connectedpmodal .filtr-search').fadeIn();
                website('#connectedpmodal .filtr-search').val("");
      },
      uploadProgress: function(event, position, total, percentComplete) 
      {
                website('#connectedpmodal #live-search-header-wrapper').fadeIn();
                website('#connectedpmodal #live-search-header-wrapper ul').html("<li>Please wait...</li>");
                website('#connectedpmodal .mainprogressbarforall .progress').fadeIn();
                website("#connectedpmodal .mainprogressbarforall .progress .progress-bar").width(percentComplete+'%');
                
      },
      success: function(response, textStatus, jqXHR) 
      {
        var addhtml='';
        website('#connectedpmodal #live-search-header-wrapper ul').html("");  
        website('#connectedpmodal #live-search-header-wrapper').fadeIn();
                
        if (response.logged == true && response.data.length>=1) 
        {         
          //console.log(response.data);return false;
          for(var i = 0; i < response.data.length; i++) 
                    {   
            if(i==0)
            {                           
              addhtml += '<li userid="'+response.data[i].wr_id+'" username="'+response.data[i].fullname+'" useremail="'+response.data[i].email+'" class="topul searchdpusers">'+response.data[i].fullname;
              //addhtml += '<a target="_blank" href="profile/willline/'+response.data[i].cid+'" class="floatleft searchavtarname">'+response.data[i].comanyname+'</a>';
              addhtml += '<div class="clearelement"></div></li>';
            }
            else if(i==((response.data.length)-1))
            {
              addhtml += '<li userid="'+response.data[i].wr_id+'" username="'+response.data[i].fullname+'" useremail="'+response.data[i].email+'"  class="bottomul searchdpusers">'+response.data[i].fullname;
              //addhtml += '<a target="_blank" href="profile/willline/'+response.data[i].cid+'" class="floatleft searchavtarname">'+response.data[i].comanyname+'</a>';
              addhtml += '<div class="clearelement"></div></li>';
              
            }
            else
            {
              addhtml += '<li userid="'+response.data[i].wr_id+'" username="'+response.data[i].fullname+'" useremail="'+response.data[i].email+'"  class="bottomul searchdpusers">'+response.data[i].fullname;
              //addhtml += '<a target="_blank" href="profile/willline/'+response.data[i].cid+'" class="floatleft searchavtarname">'+response.data[i].comanyname+'</a>';
              addhtml += '<div class="clearelement"></div></li>';
            }
          }
          website('#live-search-header-wrapper ul').html(addhtml);
          //window.location.reload();
        }
        else
        {
          website('#connectedpmodal #live-search-header-wrapper ul').html('<li class="noresultfound"><span class="resp_new">'+response.message+'</span></li>');
        }
        website("#connectedpmodal .mainprogressbarforall .progress .progress-bar").width('100%');
      },
      complete: function(response) 
      {
                website('#connectedpmodal .search-row').fadeIn();
                website("#connectedpmodal .mainprogressbarforall .progress .progress-bar").fadeOut();
      },
      error: function(jqXHR, textStatus, errorThrown)
      {
        //website('#live-search-header-wrapper ul').fadeOut();      
      }
    }); 
  }
  
}
/* ------- operation on companydatali li start ------- */ 

    website('body').on('click','.dpusers',function(e){
   
       var userid = website(this).attr('userid');
       var username = website(this).attr('username');
       var useremail = website(this).attr('useremail');
        
       website('#addupsimast #search-box').val(username);
       website('#search-box').attr('userid',userid);
       website('#search-box').attr('username',username);
       website('#addupsimast #ownerid').val(userid);
       website('#live-search-header-wrapper').fadeOut();       
       
       website('#addupsimast #owner').val(username);
       website('#owner').attr('userid',userid);
       website('#owner').attr('username',username);
    });


    website('body').on('click','#projowner .dpusersmodal',function(e){
    
       var userid = website(this).attr('userid');
       var username = website(this).attr('username');
       var useremail = website(this).attr('useremail');
        
       website('#projowner #search-box').val(username);
       website('#projowner #search-box').attr('userid',userid);
       website('#projowner #search-box').attr('username',username);
       website('#projowner #search-box').attr('useremail',useremail);

       website('#projowner #live-search-header-wrapper').fadeOut();       
       
       website('#upsimodel #ownermodal').val(username);
       website('#upsimodel #ownerid').val(userid);
       website('#projowner #ownermodal').attr('userid',userid);
       website('#projowner #ownermodal').attr('username',username);
    });

    website(function() {
            //Initialize filterizr with default options
            //website('.filtr-container').filterizr();
    });

 website('body').on('click','#connectedpmodal .searchdpusers',function(e){
        var addhtml = '';
       var userid = website(this).attr('userid');
       var username = website(this).attr('username');
       var useremail = website(this).attr('useremail');
     
        addhtml+= '<div class="row-'+userid+'"><section class="col col-md-8 col-xs-8"><label class="control-label">Name of Connected DP*</label><input type="text" id="approvers" name="approvers[]" class="form_fields form-control col-md-7 col-xs-12" value="'+username+'" userid="'+userid+'" useremail="'+useremail+'" required readonly></section>';
     
       addhtml += '<section class="col col-md-4 col-xs-4"><i class="fa fa-trash-o faicon dbaprvl" num="'+userid+'" title="Delete entry"></i></section>';
       
       addhtml+= '<input type="hidden" value="'+userid+'" name="connectdps[]">';
       addhtml+= '<input type="hidden" value="'+useremail+'" name="useremail[]"></div>';
       website('#upsimodel .connectedp').append(addhtml);
       website('#connectedpmodal #search-box').attr('userid',userid);
       website('connectedpmodal #search-box').attr('username',username);
       website('#connectedpmodal #search-box').attr('useremail',useremail);
       website('#connectedpmodal #live-search-header-wrapper').fadeOut();
       //alert(fullname);
//       website('#connectedpmodal #search-box').val(username);
//       website('#connectedpmodal #search-box').attr('userid',userid);
//       website('#connectedpmodal #search-box').attr('username',username);
//       website('#connectedpmodal #search-box').attr('useremail',useremail);
//
//       website('#connectedpmodal #live-search-header-wrapper').fadeOut();       
//       
//       website('#connectedpmodal #ownermodal').val(username);
//       website('#connectedpmodal #ownerid').val(userid);
//       website('#connectedpmodal #ownermodal').attr('userid',userid);
//       website('#connectedpmodal #ownermodal').attr('username',username);
    });

 website('body').on('click','.dbaprvl',function(e){
     var deleteid = website(this).attr('num');
     website('.row-'+deleteid).remove();
 });

 