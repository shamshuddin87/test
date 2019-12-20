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
    getdataonload(); 
});

website('#insertreconcilation').ajaxForm({
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
            
        }
        else
        {
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
      url:'reconcilation/fetchreconcilation',
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
            var addhtmlnxt = '';
            
            for(var i = 0; i < response.resdta.length; i++) 
            {
                     dtfrmt = response.resdta[i].date_modified.split("-");                   
                     dtfrmtspace = response.resdta[i].date_modified.split(" ");                    
                     ddmmyy = dtfrmtspace[0];
                     dtfrmt = dtfrmtspace[0].split("-");
                     ddmmyy = dtfrmt[2]+'-'+dtfrmt[1]+'-'+dtfrmt[0];
                     times = dtfrmtspace[1];
                 
                var dateofreconciliation=response.resdta[i].dateofreconcilition?response.resdta[i].dateofreconcilition:'';
                addhtmlnxt += '<tr class="counter" reconcilationid="'+response.resdta[i].id+'" >';
                addhtmlnxt += '<td width="25%">'+dateofreconciliation+'</td>';
                addhtmlnxt += '<td width="25%">'+ddmmyy+'</td>';
                addhtmlnxt += '<td width="25%">'+times+'</td>';
//                addhtmlnxt += '<td width="15%">'+holding+'</td>';
                addhtmlnxt += '<td width="30%"><i class="fa fa-eye faicon floatleft viewreconci" title="View entry" id="edittrade" reconciid="'+response.resdta[i].id+'" uniqueid="'+response.resdta[i].uniqueid+'" tilldate="'+response.resdta[i].dateofreconcilition+'"></i></td>';  

                addhtmlnxt += '</tr>';
            }
            website('.appendrow').html(addhtmlnxt);
            website('.paginationmn').html(response.pgnhtml);
        }
        else
        {
           website('.appendrow').html('<tr><td style="text-align:center;" colspan="13">Data Not Found!!!!</td></tr>');
            website('.paginationmn').html(response.pgnhtml); 
        }
    },
    complete: function(response)
    {},
    error: function(jqXHR, textStatus, errorThrown)
    {}
  });
          
}

website('body').on('click','.viewreconci', function()
{
    var reconciid = website(this).attr('reconciid');
    reconciid = btoa(reconciid);
    var uniquid = website(this).attr('uniqueid');
    uniquid = btoa(uniquid);
    var dateofrecon = website(this).attr('tilldate');
    dateofrecon = btoa(dateofrecon);
    var baseHref = getbaseurl(); 
    window.location.href=baseHref+'reconcilation/viewreconcilation?reconciid='+reconciid+'&&uniqueid='+uniquid+ '&&dateofrecon='+dateofrecon+''; 
});





