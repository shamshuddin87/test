/* ------------------------- onLoad Functionality START ----------------------------- */ 
website('body').on('click','.paginationmn li', function(e) 
{
    //alert(itntfr);
    var rscrntpg = website(this).attr('p');

    //alert(rscrntpg);
    website('.panel.panel-white #pagenum').val(rscrntpg);
            // alert(rscrntpg);
    var noofrows = website('#noofrows').val(); 
    
    getdataonload();
});


website(document).ready(function()
{  
   
   getdataonload();
});


website('body').on('change','#noofrows', function(e) 
{
     
    // alert(pagenum);
   getdataonload();
});


//-------------------------GO BUTTON-------------------------

website('body').on('click','.go_button', function(e) 
{
   
    var rscrntpg = website('.gotobtn').val();
    // alert(rscrntpg);
    website('.panel.panel-white #pagenum').val(rscrntpg);
    getdataonload();
});



function getdataonload()
{
    var noofrows = website('#noofrows').val(); 
    var pagenum = website('#pagenum').val();
    var chkclk = '';
    var numofdata = 'all';
    var formdata = {numofdata:numofdata,noofrows:noofrows,pagenum:pagenum};
    website.ajax({
        url:'departmentmaster/fetchdept',
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
                //console.log(response.data); return false;
                var addhtmlnxt='';
                var dept = '';
                var companyname = '';
                for(var i = 0; i < response.data.length; i++) 
                {   
                    dept = response.data[i].deptname ?response.data[i].deptname:'NONE';
                    companyname = response.data[i].companyname ?response.data[i].companyname:'NONE';
                    //console.log(response.data.length); return false;
                    //------------------------- Table Fields Insertion START ------------------------
                    //var created = response.data[i].date_added.split(' ')[0];
                    //var modified = response.data[i].date_modified.split(' ')[0];
                    var j=i+1;
                    addhtmlnxt += '<tr class="counter" tempid="'+response.data[i].id+'" >';
                    addhtmlnxt += '<td width="15%">'+j+'</td>';
                    addhtmlnxt += '<td width="15%">'+dept+'</td>';
                    addhtmlnxt += '<td width="15%">'+companyname+'</td>';
                    addhtmlnxt += '<td width="10%"><i class="fa fa-edit faicon dbeditme" title="Edit entry" tempid="'+response.data[i].id+'" ></i><i class="fa fa-trash-o faicon dbdeleteme" title="Delete entry" tempid="'+response.data[i].id+'" ></i></td>';
                    addhtmlnxt += '</tr>';                        
                    //------------------------ Table Fields Insertion END ------------------------
                }
               
                
            }
            else
            {
                addhtmlnxt += '<tr><td colspan="4" style="text-align:center;">NO DATA FOUND</td></tr>';
              
                
            }
                website('.appendrow').html(addhtmlnxt);
                website('.paginationmn').html(response.pgnhtml);
        },
        complete: function(response)
        {   },
        error: function(jqXHR, textStatus, errorThrown)
        {   }
    });
}
/* ------------------------- onLoad Functionality END ----------------------------- */ 
website('#insertdepartment').ajaxForm({
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
                // window.location.reload();
                getdataonload();
                new PNotify({title: 'Alert',
                    text: response.message,
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
                }); 
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
        { website('.preloder_wraper').fadeOut();  },
        error: function() { website('.preloder_wraper').fadeOut(); }
    });


website('body').on('click','.dbeditme',function(e)
{

    var tempid  = website(this).attr('tempid');
    //console.log(tempid); return false;
    website('#Mymodaledit .mainprogressbarforall').fadeOut();
    var noofrows = website('#noofrows').val(); 
    var pagenum = website('#pagenum').val();
    var chkclk = '';
    var numofdata = 'one';
    var formdata = {numofdata:numofdata,noofrows:noofrows,pagenum:pagenum,tempid:tempid};
    website.ajax({
        url:'departmentmaster/fetchsingdept',
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
                //console.log(response.data);
                // --------------- make readonly if (Legal Department) Start ---------------
                    if(response.data[0].deptname=='Legal Department')
                    {   //console.log(v+' = Legal Department');
                        website('#Mymodaledit #deptname').attr('readonly','readonly');   
                    }
                    else
                    {   website('#Mymodaledit #deptname').removeAttr('readonly');   }
                // --------------- make readonly if (Legal Department) End ---------------
                
                //website('#Mymodaledit #contractid').val(contractid);
                var cmpsel = response.data[0].companyid.split(",");
                //console.log(cmpsel); return false;
                website('#Mymodaledit').modal('show');
                website('#updatedept #tempid').val(tempid);
                website('#Mymodaledit #cmpaccnme option').prop('selected',false);
                website.each(response.data[0], function(k, v) 
                {
                    //console.log('key is '+k+' value is '+v);
                    if(k!='')
                    {           
                        //console.log('key is '+k+' value is '+v);
                        website('#Mymodaledit #'+k).val(v); 
                    }                        
                });
                
                website.each(cmpsel, function(k, v) 
                {
                    website('#Mymodaledit #cmpaccnme option[value="'+v+'"]').prop('selected',true);
                });
                /*if(response.data.filepath != '')
                {
                    var addhtmlnxt='';
                    addhtmlnxt += '<div class="bootstrap-tagsinput"><span class="tag label label-info"><i class="fa fa-download faicon zipdwnld" contractid="'+response.data.id+'" tracking="'+response.data.tracking+'" aria-hidden="true"></i></span></div>';
                    website('#Mymodaledit .oldcontractfile').html(addhtmlnxt);
                }
                else
                {   website('#Mymodaledit .oldcontractfile').html('');    }
                
                website('#Mymodaledit .edremin').attr('litigid',contractid);
                website('#Mymodaledit').modal('show');
                if (dtausrid && (dtausrid == 8 || dtausrid == 9)) {website('#updatecontractid').find('input, textarea, select').attr('readonly','readonly');website('#updatecontractid').find('#contractfile').removeAttr('readonly');}*/
                
            }
        },
        complete: function(response)
        {   },
        error: function(jqXHR, textStatus, errorThrown)
        {   }
    });
});
  
    website('#updatedept').ajaxForm({
        //data:formdata,
        //contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        dataType:"json",
        beforeSend: function() 
        {   website('#Mymodaledit .mainprogressbarforall').fadeIn();   },
        uploadProgress: function(event, position, total, percentComplete) 
        {   },
        success: function(response, textStatus, jqXHR) 
        {
           if(response.logged === true)
           {
                
                 
                website('#Mymodaledit').modal('hide');
                new PNotify({title: 'Alert',
                    text: response.message,
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
                });
                getdataonload(); 
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

website('body').on('click','.dbdeleteme',function()
{
    var tempid  = website(this).attr('tempid');
    //console.log(tempid); return false;
    
    website('#myModalyesno').modal('show');
    website('.yesconfirm').attr('tempid',tempid);
});
website('body').on('click','.yesconfirm',function(e)
{
    var tempid  = website(this).attr('tempid');
    //console.log(tempid); return false;
    
    var formdata = {tempid:tempid};
    website.ajax({
        url:'departmentmaster/deletedept',
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
                //getdataonload();
                 
                 website('#myModalyesno').modal('hide');
                 // website('#Mymodaledit').modal('hide');
                getdataonload();

                new PNotify({title: 'Record Deleted Successfully',
                    text: 'Record Deleted Successfully',
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
                });
            }
        },
        complete: function(response)
        {   },
        error: function(jqXHR, textStatus, errorThrown)
        {   }
    });
});
//###############################################EDIT RELATIONSHIP START HERE################################//
website('body').on('click','.editrel',function()
{
    var tempid  = website(this).attr('tempid');
    //console.log(tempid); return false;
    
    website('#myModalyesno').modal('show');
    website('.yesconfirm').attr('tempid',tempid);
});
