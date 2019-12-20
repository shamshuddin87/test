
website('body').on('click','#upsi_conn_per',function(e){ 
 

   var  userid = website("#getuserid").val();
   var add_p=0;
   var view_p=0;
   var edit_p=0;
   var del_p=0;

   var info_add_p=0;
   var info_view_p=0;
   var info_del_p=0;
    

  website('input:checkbox[name=upsi_conn_per_add]').each(function() 
{    
    if(website(this).is(':checked'))
     {
     	 add_p=1;
     }
     else
     {
        add_p=0;
     }
});

 //-------------------------------------------------

  website('input:checkbox[name=upsi_conn_per_view]').each(function() 
{    
    if(website(this).is(':checked'))
     {
     	 view_p=1;
     }
     else
     {
        view_p=0;
     }
});

//----------------------------------------------------


 website('input:checkbox[name=upsi_conn_per_edit]').each(function() 
{    
    if(website(this).is(':checked'))
     {
     	 edit_p=1;
     }
     else
     {
        edit_p=0;
     }
});

 // alert(edit_p);

//---------------------------------------------------

 website('input:checkbox[name=upsi_conn_per_delete]').each(function() 
{    
    if(website(this).is(':checked'))
     {
     	 del_p=1;
     }
     else
     {
        del_p=0;
     }
});

 website('input:checkbox[name=upsi_infoshare_add]').each(function() 
{    
    if(website(this).is(':checked'))
     {
     	 info_add_p=1;
     }
     else
     {
        info_add_p=0;
     }
});
website('input:checkbox[name=upsi_infoshare_view]').each(function() 
{    
    if(website(this).is(':checked'))
     {
     	 info_view_p=1;
     }
     else
     {
        info_view_p=0;
     }
});

website('input:checkbox[name=upsi_infoshare_delete]').each(function() 
{    
    if(website(this).is(':checked'))
     {
     	 info_del_p=1;
     }
     else
     {
        info_del_p=0;
     }
});

//--------------------------------------------------
 var formdata={userid:userid,add_p:add_p,view_p:view_p,edit_p:edit_p,del_p:del_p,info_add_p:info_add_p,info_view_p:info_view_p,info_del_p:info_del_p};
 website.ajax({
        url:'adminaccess/updateconnectedper',
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
               	new PNotify({title: 'Data Updated Successfully',
			            text:'Data Updated Successfully',
			            type: 'university',
			            hide: true,
			            styling: 'bootstrap3',
			            addclass: 'dark ',
			          });
            
            }
            else
            {
                	new PNotify({title: 'Something Went To wrong',
			            text:'Something Went To Wrong',
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

//----------------------------------------------------------------------------Restricted Company Checkbox------------------------------------------



website('body').on('click','#rest_comp_list',function(e)
{ 

    var  userid = website("#getuserid").val();
    var cmp_trd_rest_add=0;
    var cmp_trd_rest_view=0;
    var cmp_trd_rest_edit=0;
    var cmp_trd_rest_delete=0;
    var emplblock_add=0;
    var emplblock_view=0;
    var emplblock_edit=0;
    var emplblock_delete=0;
   
     if (website('.comp_trad_rest_add').is(":checked"))
    {
        cmp_trd_rest_add=1;
    }
    else
    {
        cmp_trd_rest_add=0;
    }

     if (website('.comp_trad_rest_view').is(":checked"))
    {
      // it is checked
       cmp_trd_rest_view=1;
    }
    else
    {
       cmp_trd_rest_view=0;
    }


     if (website('.comp_trad_rest_edit').is(":checked"))
    {
       cmp_trd_rest_edit=1;
    }
    else
    {
       cmp_trd_rest_edit=0;
    }


     if (website('.comp_trad_rest_delete').is(":checked"))
    {
       cmp_trd_rest_delete=1;
    }
    else
    {
         cmp_trd_rest_delete=0;
    }

    if(website('.emplblock_add').is(":checked"))
    {
       emplblock_add=1;
    }
    else
    {
      emplblock_add=0;
    }
    if(website('.emplblock_view').is(":checked"))
    {
       emplblock_view=1;
    }
    else
    {
      emplblock_view=0;
    }
    if(website('.emplblock_edit').is(":checked"))
    {
       emplblock_edit=1;
    }
    else
    {
      emplblock_edit=0;
    }
    if(website('.emplblock_delete').is(":checked"))
    {
       emplblock_delete=1;
    }
    else
    {
      emplblock_delete=0;
    }



    var formdata={userid:userid,cmp_trd_rest_add:cmp_trd_rest_add,cmp_trd_rest_view:cmp_trd_rest_view,cmp_trd_rest_edit:cmp_trd_rest_edit,cmp_trd_rest_delete:cmp_trd_rest_delete,
                  emplblock_delete:emplblock_delete,emplblock_add:emplblock_add,emplblock_view:emplblock_view,emplblock_edit:emplblock_edit};
 website.ajax({
        url:'adminaccess/restrictedcmpaccess',
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
                new PNotify({title: 'Data Updated Successfully',
                        text:'Data Updated Successfully',
                        type: 'university',
                        hide: true,
                        styling: 'bootstrap3',
                        addclass: 'dark ',
                      });
            
            }
            else
            {
                    new PNotify({title: 'Something Went To wrong',
                        text:'Something Went To Wrong',
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
