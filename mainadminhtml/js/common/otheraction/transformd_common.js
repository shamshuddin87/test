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

website('body').on('change','#noofrows', function(e) 
{
  getdataonload();
});

website('body').on('click','.paginationmn li', function(e) 
{
    var rscrntpg = website(this).attr('p');
    website('.panel.panel-white #pagenum').val(rscrntpg);
    getdataonload();
});
//-------------------------GO BUTTON-------------------------

website('body').on('click','.go_button', function(e) 
{
   
    var rscrntpg = website('.gotobtn').val();
    website('.panel.panel-white #pagenum').val(rscrntpg);
    getdataonload();
});

function getdataonload()
{
    var noofrows = website('#noofrows').val(); 
    var pagenum = website('#pagenum').val();
    var formdata = {noofrows:noofrows,pagenum:pagenum};
    website.ajax({
      url:'sebi/fetchformdtransdata',
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
            var addhtmlnxt='';
            var ids = [];
            for(var i = 0; i < response.resdta.length; i++) 
            {
    //            //------------------------- Table Fields Insertion START ------------------------
                var company_name = response.resdta[i].company_name?response.resdta[i].company_name:''
                var transaction = response.resdta[i].transaction?response.resdta[i].transaction:''
                var no_of_share = response.resdta[i].no_of_share?response.resdta[i].no_of_share:''
                var total_amount = response.resdta[i].total_amount?response.resdta[i].total_amount:''
                var date_of_transaction = response.resdta[i].date_of_transaction?response.resdta[i].date_of_transaction:''
                addhtmlnxt += '<tr class="counter" aprvllistid="'+response.resdta[i].id+'" >';
                addhtmlnxt += '<td width="10%"><input type="checkbox" class="" id="" name="check" value="'+response.resdta[i].id+'" /></td>';
                // addhtmlnxt += '<td width="20%">'+company_name+'</td>';
                addhtmlnxt += '<td width="20%">'+transaction+'</td>';
                addhtmlnxt += '<td width="20%">'+no_of_share+'</td>';
                addhtmlnxt += '<td width="20%">'+total_amount+'</td>';
                addhtmlnxt += '<td width="20%">'+date_of_transaction+'</td>';
                addhtmlnxt += '</tr>';  
                //------------------------ Table Fields Insertion END ------------------------
                ids.push(response.resdta[i].id);
            }
            
            var trdeid = ids.join(",");
            website('#formdsend').attr('trdeid',trdeid);
            website('.appendrow').html(addhtmlnxt);
            website('.paginationmn').html(response.pgnhtml);
      }
      else
      {
        website('.appendrow').html('<tr><td colspan="9" style="text-align:center;">Data Not Found..!!</td></tr>');
        website('.paginationmn').html(response.pgnhtml);
      }
    },
    complete: function(response)
    {},
    error: function(jqXHR, textStatus, errorThrown)
    {}
  });
    
    
}

website('body').on('click','#formdsend', function(){
    var ids = [];
    website.each(website("input[name='check']:checked"), function(){            
                ids.push(website(this).val());
            });
    var trdeid = website(this).attr('trdeid');
    var apprvid = website('.approverid').val();
    var cin = website('.cin').val();
    var category = website('.category').val();
    if(ids.length == 0)
    {
        new PNotify({title: 'Alert!!',
                  text: 'Please Select Atleast One Record',
                  type: 'university',
                  hide: true,
                  styling: 'bootstrap3',
                  addclass: 'dark ',
              }); 
    }
    else
    {
            var formdata = {ids:ids,apprvid:apprvid,cin:cin,category:category,trdeid:trdeid};
            website.ajax({
              url:'sebi/insertformd',
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
                    var baseHref = getbaseurl(); 
                    window.location.href=baseHref+'sebi/formd';  
                }
            },
            complete: function(response)
            {},
            error: function(jqXHR, textStatus, errorThrown)
            {}
          }); 
    }
    
    
    
});

website('body').on('click','#formdprevious', function(){
    var baseHref = getbaseurl(); 
    window.location.href=baseHref+'sebi/viewtransformd';
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
    if (!re) {return false;}
}
