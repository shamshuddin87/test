website(document).ready(function()
{
   website('#reltv').hide();
   website('#specfdte').hide();
   website('#dtrngfrm').hide();
   website('#dterngto').hide();
    //logic of from date
    var date = new Date();
    var newdate = new Date(date);
    newdate.setDate(newdate.getDate());
    var dd = ("0" + newdate.getDate()).slice(-2);
    var mm = ("0" + (newdate.getMonth() + 1)).slice(-2);
    var y = newdate.getFullYear();
    var periodfromdate = dd + '-' + mm + '-' + y;
    website('#frmdate').val(periodfromdate);
    
    //logic of to date
    var dateto = new Date(date);
    dateto.setDate(dateto.getDate() +365);
    var dd = ("0" + dateto.getDate()).slice(-2);
    var mm = ("0" + (dateto.getMonth() + 1)).slice(-2);
    var y = dateto.getFullYear();
    var periodtodate = dd + '-' + mm + '-' + y;
    website('#todate').val(periodtodate);
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

/*************** pagination calling start ****************/
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
/*************** pagination calling end ****************/

function loaddatepick()
{
    var date = new Date();
    var newdate = new Date(date);
    newdate.setDate(newdate.getDate());
    var dd = ("0" + newdate.getDate()).slice(-2);
    var mm = ("0" + (newdate.getMonth() + 1)).slice(-2);
    var y = newdate.getFullYear();
    var periodfromdate = y + '-' + mm + '-' + dd;
    website('.appendtradingplan #frmdate').val(periodfromdate);
    
    //logic of to date
    var dateto = new Date(date);
    dateto.setDate(dateto.getDate() +365);
    var dd = ("0" + dateto.getDate()).slice(-2);
    var mm = ("0" + (dateto.getMonth() + 1)).slice(-2);
    var y = dateto.getFullYear();
    var periodtodate = y + '-' + mm + '-' + dd;
    website('.appendtradingplan #todate').val(periodtodate);
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

website("#reqstfr").change(function() 
{
   var value = website(this).val();
   if(value == 2)
    {
        website('#reltv').show();
    }
    else
    {
        website('#reltv').hide();
    }
 })

website("#datetype").change(function() 
{
   var value = website(this).val();
   if(value == 1)
    {
        website('#specfdte').show();
        website('#dtrngfrm').hide();
        website('#dterngto').hide();
        website("#dtrngfrm").val('');
        website("#dterngto").val('');
        
    }
    else if(value == 2)
    {
        website('#specfdte').hide();
        website('#dtrngfrm').show();
        website('#dterngto').show();
        website("#specfdte").val('');
    }
    else
    {
        website('#specfdte').hide();
        website('#dtrngfrm').hide();
        website('#dterngto').hide();
        website("#dtrngfrm").val('');
        website("#dterngto").val('');
        website("#specfdte").val('');
    }
 })

website('body').on('click','.addtradeplan', function()
{
    
    website.ajax({
      url:'tradingplan/fetchsectype',
      //data:formdata,
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
          
        var getlastid = website('.appendtrade').attr('plancntr');
        getlastid = ++getlastid;
        var addhtmlnxt='';
        //addhtmlnxt += getlastid+'.';
        addhtmlnxt += '<div class="row'+getlastid+' formelementmain" id="row'+getlastid+'" >';
        var appendsectype = '';
              appendsectype += '<option value="">Select Security</option>';   
              website.each(response.resdta, function (index, value) {

                appendsectype += '<option value='+value['id']+'>'+value['security_type']+'</option>';             
              });
        addhtmlnxt+='<section class="col col-md-3 col-xs-3"><div class="input"><label class="control-label">Type Of Security</label><select id="sectype" name="sectype[]" class="form_fields form-control col-md-7 col-xs-12" required>'+appendsectype+'</select></div></section>';
        addhtmlnxt += '<section class="col col-md-3 col-xs-3"><div class="input"><label class="control-label">Date Type</label><select id="datetype" name="datetype[]" class="form_fields form-control col-md-7 col-xs-12" required><option value="">Select Date Type</option><option value="1">Specific Date</option><option value="2">Date Range</option></select></div></section>';
        addhtmlnxt += '<section class="col col-md-3 col-xs-3" id="specfdte"><div class="input"><label class="control-label">Specific Date</label><input type="text" class="form-control bootdatepick" id="spficdate"  name="spficdate[]" readonly></div></section>';
        addhtmlnxt += '<section class="col col-md-3 col-xs-3" id="dtrngfrm"><div class="input"><label class="control-label">Date Range From</label><input type="text" class="form-control bootdatepick" id="daterngfrm"  name="daterngfrm[]" readonly></div></section>';
        addhtmlnxt += '<section class="col col-md-3 col-xs-3" id="dterngto"><div class="input"><label class="control-label">Date Range To</label><input type="text" class="form-control bootdatepick" id="daterngto"  name="daterngto[]" readonly></div></section>';
        addhtmlnxt += '<section class="col col-md-3 col-xs-3"><div class="input"><label class="control-label">No.of Securities</label><input type="text" class="form-control" id="noofsec"  name="noofsec[]" onkeypress="return numberOnly()"></div></section>';
        addhtmlnxt += '<section class="col col-md-3 col-xs-3"><div class="input"><label class="control-label">Value of Securities</label><input type="text" class="form-control" id="valueofsecurity"  name="valueofsecurity[]" onkeypress="return numberOnly()"></div></section>';
        addhtmlnxt += '</div>';

        website('.num').attr('value',getlastid);
        website('.appendtradingplan').append(addhtmlnxt);
        website('.row'+getlastid+' #specfdte').hide();
        website('.row'+getlastid+' #dtrngfrm').hide();
        website('.row'+getlastid+' #dterngto').hide();
        website('.appendtrade').attr('plancntr',getlastid);
        loaddatepick();
        loaddatetype();
        numberOnly();
              },
        complete: function(response)
        {},
        error: function(jqXHR, textStatus, errorThrown)
        {}
    });
});

website('body').on('click','.remvtradeplan', function()
{
    var count = website('.appendtrade').attr('plancntr');
    if(count != 1)
        {
            website('.appendtradingplan #row'+count).remove();
            website('.appendtrade').attr('plancntr',parseInt(count)-1);
        }
    else
        {
            return false;
        }
});

 website('#inserttradingplan').ajaxForm({
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



function loaddatetype()
{
    website(".appendtradingplan #datetype").on('change', function() 
    {
       var rowid = website(this).closest('div .formelementmain').attr('id');
       var value = website(this).val();
       if(value == 1)
        {
            website('.'+rowid+ ' #specfdte').show();
            website('.'+rowid+ ' #dtrngfrm').hide();
            website('.'+rowid+ ' #dterngto').hide();
            website('.'+rowid+ ' #dtrngfrm').val('');
            website('.'+rowid+ ' #dterngto').val('');
        }
        else if(value == 2)
        {
            website('.'+rowid+ ' #specfdte').hide();
            website('.'+rowid+ ' #dtrngfrm').show();
            website('.'+rowid+ ' #dterngto').show();
            website('.'+rowid+ ' #specfdte').val('');
        }
        else
        {
            website('.'+rowid+ ' #specfdte').hide();
            website('.'+rowid+ ' #dtrngfrm').hide();
            website('.'+rowid+ ' #dterngto').hide();
            website('.'+rowid+ ' #dtrngfrm').val('');
            website('.'+rowid+ ' #dterngto').val('');
            website('.'+rowid+ ' #specfdte').val('');
        }
    });
}
getdataonload();
function getdataonload()
{
    var noofrows = website('#noofrows').val(); 
    var pagenum = website('#pagenum').val();
    //console.log(noofrows+'  '+pagenum);return false;
    var formdata = {noofrows:noofrows,pagenum:pagenum};
    website.ajax({
      url:'tradingplan/fetchtradeplan',
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
                  
                var name=response.resdta[i].name?response.resdta[i].name:'';
                var username=response.resdta[i].fullname?response.resdta[i].fullname:'';
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
                    addhtmlnxt += '<td width="15%">'+username+'</td>';
                    addhtmlnxt += '<td width="15%">'+name+'</td>';
                    addhtmlnxt += '<td width="15%">'+companyname+'</td>';
                    addhtmlnxt += '<td width="15%">'+fromdate+'</td>';
                    addhtmlnxt += '<td width="15%">'+todate+'</td>';
                    if(response.resdta[i].approvedstatus == 0)
                    {
                        addhtmlnxt += '<td width="15%" class="notapprv">Not Approved</td>';
                    }
                    else if(response.resdta[i].approvedstatus == 1)
                    {
                        addhtmlnxt += '<td width="15%" class="apprv" style="color:green;font-weight:600;"><i class="fa fa-check aprvicon" aria-hidden="true"></i>Approved</td>';
                    }
                    else
                    {
                        addhtmlnxt += '<td width="15%" class ="showrejctmsg" style="color:red;font-weight:600;"><i class="fa fa-ban aprvicon" aria-hidden="true"></i>Rejected</td>';
                    }
                    addhtmlnxt += '<td width="15%" class="trade"><i class="fa fa-eye faicon floatleft edittradeplan" title="View entry" id="edittrade" tradeplanid="'+response.resdta[i].id+'" uniquid="'+response.resdta[i].uniqueid+'"></i></td>'; 
                   
                    addhtmlnxt += '</tr>';
   
                //------------------------ Table Fields Insertion END ------------------------
            }
              website('.appendtradeplan').html(addhtmlnxt);
              website('.paginationmn').html(response.pgnhtml);
              //website('#datableabhi').DataTable();
             
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

website('body').on('click','.showrejctmsg', function(e)
{
    var planid = website(this).parent().attr('tradeplnid');
    var formdata = {planid:planid}
    website.ajax({
      url:'tradingplan/fetchrejectmessage',
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
              website('#rejectplantrade').val(response.resdta[0].reject_msg).attr('readonly','readonly');
             website('#tradeplanmodal').modal('show');
          }
          else
           {
               
           }
      },
      complete: function(response)
      {  website('.preloder_wraper').fadeOut(); },
      error: function(jqXHR, textStatus, errorThrown)
      {   }
});
    
});


function numberOnly() 
{
            var charCode = event.keyCode;
    
            if ((charCode > 47 && charCode < 58) || charCode == 46)

                return true;
            else
                return false;
}

