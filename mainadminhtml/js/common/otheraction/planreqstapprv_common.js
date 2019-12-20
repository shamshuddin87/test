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
    var tradeid = website('#tradeid').val();
    var tradeuniqid = website('#tradeuniqueid').val();
    var noofrows = website('#noofrows').val(); 
    var pagenum = website('#pagenum').val();
    var formdata = {tradeid:tradeid,tradeuniqid:tradeuniqid,noofrows:noofrows,pagenum:pagenum}
    website.ajax({
      url:'tradingplan/fetchallplanforapprove',
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
             var a = [];
             var planid = '';
              for(var i = 0; i < response.resdta.length; i++) 
              {
                  
                var name=response.resdta[i].name?response.resdta[i].name:'';
                var tradingplan=response.resdta[i].tradingplan?response.resdta[i].tradingplan:'';
                var companyname=response.resdta[i].companyname?response.resdta[i].companyname:'';
                var fromdate=response.resdta[i].fromdate?response.resdta[i].fromdate:'';
                var todate=response.resdta[i].todate?response.resdta[i].todate:'';
                var security_type=response.resdta[i].security_type?response.resdta[i].security_type:'';
                var specificdate=response.resdta[i].specificdate?response.resdta[i].specificdate:'';
                var daterangefrm=response.resdta[i].daterangefrm?response.resdta[i].daterangefrm:'';
                var daterangeto=response.resdta[i].daterangeto?response.resdta[i].daterangeto:'';
                var valueofsecu=response.resdta[i].valueofsecu?response.resdta[i].valueofsecu:'';
                var noofsecu=response.resdta[i].noofsecu?response.resdta[i].noofsecu:'';
               
                //------------------------- Table Fields Insertion START ------------------------
                
                    addhtmlnxt += '<tr class="counter" tradeplnid="'+response.resdta[i].id+'">';
                    addhtmlnxt += '<td width="15%">'+security_type+'</td>';
                    addhtmlnxt += '<td width="15%">'+specificdate+'</td>';
                    addhtmlnxt += '<td width="15%">'+daterangefrm+'</td>';
                    addhtmlnxt += '<td width="15%">'+daterangeto+'</td>';
                    addhtmlnxt += '<td width="15%">'+noofsecu+'</td>';
                    addhtmlnxt += '<td width="15%">'+valueofsecu+'</td>'; 
                    addhtmlnxt += '</tr>';
                    a.push(response.resdta[i].id);
                    planid = a.join(",");
                  
                   
                //------------------------ Table Fields Insertion END ------------------------
            }
              website('.approveplan').attr('idss',planid);
              website('.rejectplan').attr('idss',planid);
              website('.appendtradeplanapprvl').html(addhtmlnxt);
              website('.paginationmn').html(response.pgnhtml);
//              website('#datableabhi').DataTable();
             
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

website('body').on('click','.edittradeplan', function()
{
    var trdeplnids = website(this).attr('tradeplanid');
    trdeplnids = btoa(trdeplnids);
    var uniquid = website(this).attr('uniquid');
    uniquid = btoa(uniquid);
    var baseHref = getbaseurl(); 
    window.location.href=baseHref+'tradingplan/tradeplanview?tradeid='+trdeplnids+'&&uniqueid='+uniquid+ ''; 
});

website('body').on('click','.approveplan', function()
{
    var tradeid = website(this).attr('idss');
    var formdata = {tradeid:tradeid}
    website.ajax({
      url:'tradingplan/apprvtradeplan',
      data:formdata,
      method:'POST',
      //contentType:'json',
      contentType:'application/x-www-form-urlencoded; charset=UTF-8',
      //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
      dataType:"json",
      cache:false,
      //async:true, /*Cross domain checking*/
      beforeSend: function()
      { website('.preloder_wraper').fadeIn();  },
      uploadProgress: function(event, position, total, percentComplete)
      {  website('.preloder_wraper').fadeIn(); },
      success: function(response, textStatus, jqXHR)
      {
          if(response.logged === true)
          { 
            new PNotify({title: 'Alert!',
                    text: response.message,
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
                }); 
          }
          else
           {
               new PNotify({title: 'Alert!',
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

website('body').on('click','.rejectplan', function()
{
    var tradeid = website(this).attr('idss');
    website('#tradeplanmodal #rejecttradeplan').attr('rejecttrdeid',tradeid);
    website('#tradeplanmodal').modal('show');
});
website('body').on('click','#rejecttradeplan', function()
{
    var rejctid = website(this).attr('rejecttrdeid');
    var messg = website('#rejectplantrade').val();
    var formdata = {rejctid:rejctid,messg:messg}
    website.ajax({
      url:'tradingplan/rejcttradeplan',
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
            new PNotify({title: 'Alert!',
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
               new PNotify({title: 'Alert!',
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


