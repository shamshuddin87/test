website(document).ready(function()
{
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

getdataonload();
function getdataonload()
{
    var noofrows = website('#noofrows').val(); 
    var pagenum = website('#pagenum').val();
    var esopid = website('#esopid').val(); 
    var esopuniqueid = website('#esopuniqueid').val();
    var formdata = {esopid:esopid,esopuniqueid:esopuniqueid,noofrows:noofrows,pagenum:pagenum}
    website.ajax({
      url:'esop/fetchesopforview',
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
             var addhtmlnxt='';
            for(var i = 0; i < response.resdta.length; i++) 
            {
                var allotment = response.resdta[i].altmntdate?response.resdta[i].altmntdate:'';
                addhtmlnxt += '<tr class="counter" esopid="'+response.resdta[i].id+'" >';
                addhtmlnxt += '<td width="20%">'+response.resdta[i].emp_name+'</td>';
                addhtmlnxt += '<td width="20%">'+response.resdta[i].emp_pan+'</td>';
                addhtmlnxt += '<td width="20%">'+response.resdta[i].emp_shares+'</td>';
                addhtmlnxt += '<td width="20%">'+allotment+'</td>';
                // addhtmlnxt += '<td width="20%">'+response.resdta[i].cmp_name+'</td>';
                addhtmlnxt += '</tr>';
                if(response.resdta[i].finalsave == 1)
                {
                    website('.savefinal').hide();
                }
                
            }
              
              website('.appendviewesop').html(addhtmlnxt);
              website('.paginationmn').html(response.pgnhtml);
             
          }
          else
           {
               website('.paginationmn').html(response.pgnhtml);
           }
      },
      complete: function(response)
      {  website('.preloder_wraper').fadeOut(); },
      error: function(jqXHR, textStatus, errorThrown)
      {   }
});
}

website('body').on('click','.savefinal', function(e) 
{
    var uniqueid = website(this).attr('uniqueid');
    website('#myModalsavefinal #esopuniqid').val(uniqueid);
    website('#myModalsavefinal').modal('show'); 
});

website('body').on('click','.finalsaveyes',function(e)
{
    var esopuniq = website('#myModalsavefinal #esopuniqid').val();
    var formdata = {esopuniq:esopuniq}
    website.ajax({
      url:'esop/saveesopfinal',
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
                new PNotify({title: 'Alert!!',
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
               new PNotify({title: 'Alert!!',
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
    });
});


