website(document).ready(function()
{
    getdataonload();
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

   website('#insertrecipient').ajaxForm({
      //method:'POST',
      //contentType:'json',
      //contentType:'application/x-www-form-urlencoded; charset=UTF-8',
      //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
      dataType:"json",
      beforeSend: function()
      { website('.preloder_wraper').fadeIn();},
      uploadProgress: function(event, position, total, percentComplete)
      {  website('.preloder_wraper').fadeIn(); },
      success: function(response, textStatus, jqXHR)
      {
        if(response.logged===true)
        {  
          new PNotify({title: 'Record Added Successfully',
            text: response.message,
            type: 'university',
            hide: true,
            styling: 'bootstrap3',
            addclass: 'dark ',
          });
         window.location.reload();
            getdataonload();
          //window.location.reload();
           
            
        }else{
          new PNotify({title: 'Record Not Added',
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
      error: function(jqXHR, textStatus, errorThrown)
      {   }
  //});
});

function getdataonload()
{
    website.ajax({
      url:'sensitiveinformation/fetchrecipient',
      method:'POST',
      //contentType:'json',
      contentType:'application/x-www-form-urlencoded; charset=UTF-8',
      //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
      dataType:"json",
      cache:false,
      //async:true, /*Cross domain checking*/
      beforeSend: function()
      {   },
      uploadProgress: function(event, position, total, percentComplete)
      {   },
      success: function(response, textStatus, jqXHR)
      {
        if(response.logged===true)
        {
            
           // console.log(response.getaccess[0]); return false;
        var addhtmlnxt='';
            
        for(var i = 0; i < response.resdta.length; i++) 
        {
           //------------------------- Table Fields Insertion START ------------------------
            
            var mobileno = response.resdta[i].mobileno?response.resdta[i].mobileno:''
            var email = response.resdta[i].email?response.resdta[i].email:''
            addhtmlnxt += '<tr class="counter" aprvllistid="'+response.resdta[i].id+'" >';
            addhtmlnxt += '<td>'+response.resdta[i].categoryname+'</td>';
            addhtmlnxt += '<td>'+response.resdta[i].nameofentity+'</td>';
            addhtmlnxt += '<td>'+response.resdta[i].name+'</td>';
            addhtmlnxt += '<td>'+response.resdta[i].identityno+'</td>';
            addhtmlnxt += '<td>'+response.resdta[i].phoneno+'</td>';
            addhtmlnxt += '<td>'+mobileno+'</td>';
            addhtmlnxt += '<td>'+response.resdta[i].designation+'</td>';
            addhtmlnxt += '<td>'+email+'</td>';
            if(response.resdta[i].filepath)
            {
                addhtmlnxt += '<td><a href="'+response.resdta[i].filepath+'" download>&nbsp;<i class="fa fa-download" id="uploadattached1" aria-hidden="true"></i></a></td>';
            }
            else
            {
                addhtmlnxt += '<td></td>';
            }
            if(response.resdta[i].agreemntfile)
            {
                addhtmlnxt += '<td><a href="'+response.resdta[i].agreemntfile+'" download>&nbsp;<i class="fa fa-download" id="uploadattached1" aria-hidden="true"></i></a></td>';
            }
            else
            {
                addhtmlnxt += '<td></td>';
            }
            addhtmlnxt += '<td >';

            if(response.getaccess[0]['upsi_conn_per_edit']==1)
            {
                addhtmlnxt+='<i class="fa fa-edit faicon floatleft editrestrictedcmp" title="Edit entry" aprvllistid="'+response.resdta[i].id+'"> </i>';
            }
            else
            {
                 addhtmlnxt+='';
            }
            if(response.getaccess[0]['upsi_conn_per_delete']==1)
            {

               addhtmlnxt+='<i class="fa fa-trash-o faicon floatleft deleterestrictedcmp" title="Delete entry" aprvllistid="'+response.resdta[i].id+'" ></i>';
            }
            else
            {
                addhtmlnxt+='';
            }
           
            addhtmlnxt+='</td>';
            addhtmlnxt += '</tr>';                        
            //------------------------ Table Fields Insertion END ------------------------
        }

            if(response.getaccess[0]['upsi_conn_per_add']==0)
            {
                website(".formelementmain").css("display", "none");

                       new PNotify({title: 'You Do Not Have Access To Add Connected Person',
                          text:"Please Contact To Your Admin",
                          type: 'university',
                          hide: true,
                          styling: 'bootstrap3',
                          addclass: 'dark ',
                        });
            }
            else
            {
            	  website(".formelementmain").css("display", "block");
                
            }
              if(response.getaccess[0]['upsi_conn_per_view']==0)
            {
                website(".table-responsive.table_wraper.rectable").css("display", "none");

                 new PNotify({title: 'You Do Not Have Access To View This Section',
                          text:"Please Contact To Your Admin",
                          type: 'university',
                          hide: true,
                          styling: 'bootstrap3',
                          addclass: 'dark ',
                        });
            }
            else
            {
            	  website(".table-responsive.table_wraper.rectable").css("display", "block");
            }
         
      
          website('.appendrow').html(addhtmlnxt);
          website('#datableabhi').DataTable();
      }
      else
      {
        
          // alert();
             website('.appendrow').html('<tr><td >Data Not Found</td></tr>');
             if(response.getaccess[0]['upsi_conn_per_add']==0)
              {
                  // alert();
                  website(".formelementmain").css("display", "none");
                   new PNotify({title: 'You Do Not Have Access To Add Connected Person',
                          text:"Please Contact To Your Admin",
                          type: 'university',
                          hide: true,
                          styling: 'bootstrap3',
                          addclass: 'dark ',
                        });
              }
              else
              {
                 // alert("1")
                  website(".formelementmain").css("display", "block");
              }
                if(response.getaccess[0]['upsi_conn_per_view']==0)
              {
                  website(".table-responsive.table_wraper.rectable").css("display", "none");

                   new PNotify({title: 'You Do Not Have Access To View This Section',
                          text:"Please Contact To Your Admin",
                          type: 'university',
                          hide: true,
                          styling: 'bootstrap3',
                          addclass: 'dark ',
                        });
              }
              else
              {
                  website(".table-responsive.table_wraper.rectable").css("display", "block");
              }
      }
    },
    complete: function(response)
    {},
    error: function(jqXHR, textStatus, errorThrown)
    {}
  });
    
    
}

website('body').on('click','.editrestrictedcmp', function(){
var id = website(this).attr('aprvllistid');
    var formdata = {id:id};
    
    website.ajax({
      url:'sensitiveinformation/fetchrecipientforedit',
      data:formdata,
      method:'POST',
      //contentType:'json',
      contentType:'application/x-www-form-urlencoded; charset=UTF-8',
      //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
      dataType:"json",
      cache:false,
      //async:true, /*Cross domain checking*/
      beforeSend: function()
      {   },
      uploadProgress: function(event, position, total, percentComplete)
      {   },
      success: function(response, textStatus, jqXHR)
      {
        if(response.logged===true)
        {
            //console.log(response.data);return false;
            var appendhtml= '';  
            
            website("#Mymodaledit #category").val(response.data['0'].category);
            website("#Mymodaledit #entity").val(response.data['0'].nameofentity);
            website("#Mymodaledit #name").val(response.data['0'].name);
            website("#Mymodaledit #identitynum").val(response.data['0'].identityno);
            website("#Mymodaledit #phonenum").val(response.data['0'].phoneno);
            website("#Mymodaledit #mobilenum").val(response.data['0'].mobileno);
            website("#Mymodaledit #designation").val(response.data['0'].designation);
            website("#Mymodaledit #email").val(response.data['0'].email);
            
           
            website('#updaterecipient #tempid').val(id);
            website('#updaterecipient #confiagrmnt').val(response.data['0'].agreemntfile);
            website('#updaterecipient #identityfile').val(response.data['0'].filepath);
            website('#Mymodaledit').modal('show');
            
     }
      else
      {
        website('.appendrowwaprvl').html('');
      }
    },
    complete: function(response)
    {},
    error: function(jqXHR, textStatus, errorThrown)
    {}
  });
    
    
});


website('#updaterecipient').ajaxForm({
        //data:formdata,
        //contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        dataType:"json",
        beforeSend: function() 
        {   /*website('#Mymodaledit').modal('hide');*/
            website('.preloder_wraper').fadeIn();  },
        uploadProgress: function(event, position, total, percentComplete) 
        { website('.preloder_wraper').fadeIn();},
        success: function(response, textStatus, jqXHR) 
        {
           if(response.logged === true)
           {
              //fetchmasterlist();
              
              //website('#Mymodaledit').fadeOut();
              new PNotify({title: 'Record Updated Successfully',
                  text: response.message,
                  type: 'university',
                  hide: true,
                  styling: 'bootstrap3',
                  addclass: 'dark ',
              }); 
               window.location.reload();
           }
           else
           {    
              new PNotify({title: 'Record Not Updated',
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
            website('#Mymodaledit .mainprogressbarforall').fadeOut(); 
        },
        error: function() 
        {   }
    });


website('body').on('click','.deleterestrictedcmp', function(){
    var id = website(this).attr('aprvllistid');
    //console.log(id);return false;
    website('#myModalyesno').modal('show');
    website('#myModalyesno .yesconfirm').attr('aprvllistid',id);
});

website('body').on('click','.yesconfirm', function(){
    
    var id = website(this).attr('aprvllistid');
    //console.log(id);return false;
    var formdata = {id:id};
    website.ajax({
        
      url:'sensitiveinformation/recipientfordelete',
      data:formdata,
      method:'POST',
      //contentType:'json',
      contentType:'application/x-www-form-urlencoded; charset=UTF-8',
      //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
      dataType:"json",
      cache:false,
      //async:true, /*Cross domain checking*/
      beforeSend: function()
      {   },
      uploadProgress: function(event, position, total, percentComplete)
      {   },
        success: function(response, textStatus, jqXHR) 
        {
           if(response.logged === true)
           {
              //fetchmasterlist();
              window.location.reload();
              //website('#Mymodaledit').fadeOut();
              new PNotify({title: 'Record Deleted Successfully',
                  text: 'Record Deleted Successfully',
                  type: 'university',
                  hide: true,
                  styling: 'bootstrap3',
                  addclass: 'dark ',
              }); 
           }
           else
           {    
              new PNotify({title: 'Record Not Deleted',
                  text: 'Record Not Updated',
                  type: 'university',
                  hide: true,
                  styling: 'bootstrap3',
                  addclass: 'dark ',
              });
           }
        },
        complete: function(response) 
        {
            website('#myModalyesno .mainprogressbarforall').fadeOut(); 
        },
        error: function() 
        {   }
    });
});

function numberalphOnly() 
{
            var charCode = event.keyCode;
    
            if ((charCode > 47 && charCode < 58) || charCode == 32 || (charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || charCode == 8 || charCode == 44 || charCode == 40 || charCode == 41 || charCode == 46 || charCode == 47)

                return true;
            else
                return false;
}
function emailOnly() 
{
var re = /[A-Z0-9a-z@\._-]/.test(event.key);
    if (!re) {
        return false;
    }
}
