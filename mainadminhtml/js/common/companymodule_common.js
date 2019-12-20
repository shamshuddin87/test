//#################################PAGINATION START HERE###################################//
website('body').on('click','.paginationmn li', function(e) 
{
    //alert(itntfr);
    var rscrntpg = website(this).attr('p');

    //alert(rscrntpg);
    website('.panel.panel-white #pagenum').val(rscrntpg);
            // alert(rscrntpg);
    var noofrows = website('#noofrows').val(); 
    var status = website('#srch').attr('status'); 
     if(status)
    { //calling to searchlist method
      getsearchlist();
    }
    else
    {
       //calling to Fetch all records
       getcmplist();
    }
});



website('body').on('change','#noofrows', function(e) 
{
     
    var status = website('#srch').attr('status'); 
     if(status)
    { 
      getsearchlist();
    }
    else
    {
       getcmplist();
    }
});


//-------------------------GO BUTTON-------------------------

website('body').on('click','.go_button', function(e) 
{
   
    var rscrntpg = website('.gotobtn').val();
    // alert(rscrntpg);
    website('.panel.panel-white #pagenum').val(rscrntpg);

    var status = website('#srch').attr('status'); 
    if(status)
    {
      getsearchlist();
    }
    else{
      getcmplist();
    }
});
//#################################GET ALL COMPANY DETAILS###################################################//
getcmplist()
function getcmplist()
{

 var noofrows = website('#noofrows').val(); 
    var pagenum = website('#pagenum').val();
    // var chkclk = '';
    // var numofdata = 'all';
    // alert(noofrows+""+pagenum);
    var formdata = {noofrows:noofrows,pagenum:pagenum};
    website.ajax({
        url:'companymodule/fetchcmplist',
        data:formdata,
        method:'POST',
        //contentType:'json',
        contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
        dataType:"json",
        cache:false,
        //async:true, Cross domain checking
        beforeSend: function()
        { website('.preloder_wraper').fadeIn();  },
        uploadProgress: function(event, position, total, percentComplete)
        {   },
        success: function(response, textStatus, jqXHR)
        {
            var myhtml='';
        

            if(response.logged===true)
            { var j=1;
              for(var i=0;i<response.data.length;i++)
              {   myhtml+='<tr>';
                  myhtml+='<td>'+j+'</td>';
                  myhtml+='<td>'+response.data[i]['company_name']+'</td>';
                 //  if(response.data[i]['access']==1)
                 //  {
                 //    myhtml+='<td>Access</td>';
                 //  }
                 // else{
                 //    myhtml+='<td>Access Denied</td>';
                 //   }
                   myhtml += '<td width="10%"><i class="fa fa-edit faicon dbeditme" title="Edit entry" tempid="'+response.data[i]["id"]+'" ></i><i class="fa fa-trash-o faicon dbdeleteme" title="Delete entry" tempid="'+response.data[i]["id"]+'" ></i></td>';
                   myhtml+='</tr>';
                   j++;
              
              }
              
            }
            else
            {
              myhtml+='<tr>'; 
               
              // myhtml+="<td></td><td></td><td>DATA NOT FOUND..!!</td><td></td>";
              myhtml+="<td colspan='4' style='text-align:center;'>DATA NOT FOUND..!!</td>";
              myhtml+='</tr>';
                
            }

            website('.appendroww').html(myhtml);
            website('.paginationmn').html(response.pgnhtml);
        },
        complete: function(response)
        {   website('.preloder_wraper').fadeOut();},
        error: function(jqXHR, textStatus, errorThrown)
        {   }
    });

}
//##########################GET ALL COMPANY DETAILS FINISH HERE##############################################//


//#########################INSERT COMPANY USING EXCEL########################################################//

//#######################################AJAX FORM START HERE INSERT EXCEL##################################//
website('#insertexcl').ajaxForm({
        dataType:"json",
        beforeSend: function() 
        {  website('.preloder_wraper').fadeIn();   },
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
                     getcmplist()
                
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
        { website('.preloder_wraper').fadeOut();    },
        error: function() {  }
    });

//#########################INSERT COMPANY USING EXCEL  FINISH########################################################//

//###############################INSERT CMPANY IN DB##############################################################
website('body').on('click','#subcmp',function(e){
var cmpname=website('#lcmp').val();
      if(cmpname=='')
      {
        new PNotify({title: 'Alert',
                    text: "Company Name Required",
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
                }); 
      }
    else
    {
        //-------------------------ajax start here---------------------------------------//
         website.ajax({
        url:'companymodule/addcmpmodule',
        data:{cmpname:cmpname},
        method:'POST',
        //contentType:'json',
        contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
        dataType:"json",
        cache:false,
        //async:true, Cross domain checking
        beforeSend: function()
        {  website('.preloder_wraper').fadeIn(); },
        uploadProgress: function(event, position, total, percentComplete)
        {   },
        success: function(response, textStatus, jqXHR)
        {
            if(response.logged==true)
            {   
                 new PNotify({title: 'Alert',
                    text: response.message,
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
                }); 
                 getcmplist();
                window.location.reload();
            }
            else
            {
                  new PNotify({title: 'Alert',
                    text: "Something Went To Wrong..!!!",
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
                }); 

            }

        },
       complete: function(response) 
       { website('.preloder_wraper').fadeOut();},
        error: function() {  }
    });

    }


 });

//######################################################################################################################
//##############################DELETE COMPANY MODEL BOX#########################################################

website('body').on('click','.dbdeleteme',function(e){ 
   var delid = website(this).attr('tempid');
    // alert(delid);
   website('#deleteid').val(delid);
   website('#delmod').modal('show');
});
website('body').on('click','#deletecmp',function(e){ 
   var delid =  website('#deleteid').val();
    website.ajax({
        url:'companymodule/deletecmp',
        data:{delid:delid},
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
            if(response.logged==true)
            {    website('#delmod').modal('hide');
                 new PNotify({title: 'Alert',
                    text: response.message,
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
                }); 
                 getcmplist();
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
    });
});
//#########################################EDIT COMPANY MODULE show###############################################
website('body').on('click','.dbeditme',function(e){ 
   var editid = website(this).attr('tempid');
   website.ajax({
        url:'companymodule/fetcheditcmp',
        data:{editid:editid},
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
            if(response.logged==true)
            { 
              var cmpname=response.data.company_name?response.data.company_name:'';
              var id=response.data.id?response.data.id:'';
              var access=response.data.access?response.data.access:0;
            //  website('#accselect option[value='+access+']').attr('selected', true);
              website('#cmpname').val(cmpname);
              website('#editcmpid').val(id);
              website('#editcompany').modal('show');   
            }
            else
            {
                 
            }

        },
    });
});
//#########################DELETE COMPANY FINISH#############################################################

//#########################UPDATE COMPANY  START HERE########################################################
website('body').on('click','.updatecmp',function(e){ 
   var cmpname = website('#cmpname').val();
   // var accselect=website('#accselect').val();
   var editcmpid=website('#editcmpid').val();
   if(cmpname!='')
   {
     website.ajax({
        url:'companymodule/updatecmpmod',
        data:{cmpname:cmpname,editcmpid:editcmpid},
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
            if(response.logged==true)
            {    website('#editcompany').modal('hide');
                 new PNotify({title: 'Alert',
                    text: response.message,
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
                }); 
                 getcmplist();
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
    });
   }
   else{
     new PNotify({title: 'Alert',
                    text: "Please Type Name Of Company",
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
                }); 
   }
   });
//############################################################################################################

//############################SEARCH FUNCTIONALLITY ##########################################################
 website("#srch").on("keyup", function() {
    var search=website('#srch').val();
    var pagenum = website('#pagenum').val();
    website('#srch').attr('status','0');
     if(pagenum!=1)
     {
       website('#pagenum').val(1);
     }
      if(search=="")
      {
           getcmplist();
      }
      else
      {
         getsearchlist();
       }
    });

 function getsearchlist(){
      var search=website('#srch').val();
      var noofrows = website('#noofrows').val(); 
      var pagenum = website('#pagenum').val();
      var formdata = {noofrows:noofrows,pagenum:pagenum,search:search};
      website.ajax({
        url:'companymodule/fetchsearchlist',
        data:formdata,
        method:'POST',
        //contentType:'json',
        contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
        dataType:"json",
        cache:false,
        //async:true, Cross domain checking
        beforeSend: function()
        {   if(search=='')
           { website('.preloder_wraper').fadeIn();}
        },
        uploadProgress: function(event, position, total, percentComplete)
        {   },
        success: function(response, textStatus, jqXHR)
        {
            var myhtml='';
        

            if(response.logged===true)
            { var j=1;
              for(var i=0;i<response.data.length;i++)
              {   myhtml+='<tr>';
                  myhtml+='<td>'+j+'</td>';
                  myhtml+='<td>'+response.data[i]['company_name']+'</td>';
                 //  if(response.data[i]['access']==1)
                 //  {
                 //    myhtml+='<td>Access</td>';
                 //  }
                 // else{
                 //    myhtml+='<td>Access Denied</td>';
                 //   }
                   myhtml += '<td width="10%"><i class="fa fa-edit faicon dbeditme" title="Edit entry" tempid="'+response.data[i]["id"]+'" ></i><i class="fa fa-trash-o faicon dbdeleteme" title="Delete entry" tempid="'+response.data[i]["id"]+'" ></i></td>';
                   myhtml+='</tr>';
                   j++;
              
              }
              
                website('#srch').attr('status','1')
              
            }
            else
            {
              myhtml+='<tr>'; 
               
              // myhtml+="<td></td><td></td><td>DATA NOT FOUND..!!</td><td></td>";
              myhtml+="<td colspan='4' style='text-align:center;'>DATA NOT FOUND..!!</td>";
              myhtml+='</tr>';
              website('#srch').attr('status','0')
                
            }

            website('.appendroww').html(myhtml);
            website('.paginationmn').html(response.pgnhtml);
        },
        complete: function(response)
        { website('.preloder_wraper').fadeOut();},
        error: function(jqXHR, textStatus, errorThrown)
        {   }
    });






 }
