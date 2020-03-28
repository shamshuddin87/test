
/* ----------- Start DatePicker ----------- */
datepicker();
function datepicker(){
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
/* ----------- End DatePicker ----------- */

checkredirecturl();
function checkredirecturl()
{
    var redirecturl=website('#redirecturl').val();
    if(redirecturl=="modal")
    {
        website('#Mymodalreq').modal('show');
    }
}

/* ---------------- Start Pagination ---------------- */
website('body').on('click','.paginationmn li', function(e) 
{
    var rscrntpg = website(this).attr('p');
    //alert(rscrntpg);
    website('.panel.panel-white #pagenum').val(rscrntpg);
    // var noofrows = website('#noofrows').val(); 

    getalltradingrequest("");
});

website('body').on('change','#noofrows', function(e) 
{
    getalltradingrequest("");
});

website('body').on('click','.go_button', function(e) 
{
    var rscrntpg = website('.gotobtn').val();
    // alert(rscrntpg);
    website('.panel.panel-white #pagenum').val(rscrntpg);
    getalltradingrequest("");
});
/* ---------------- End Pagination ---------------- */


 website('.relativesform').hide();

 website('.personal').click(function(e) {
   e.preventDefault();
   website(this).addClass('active');
   website('.relatives').removeClass('active');
   website('.relativesform').hide();
 });

 website('.relatives').click(function(e) {
   e.preventDefault();
   website(this).addClass('active');
   website('.personal').removeClass('active');
   website('.relativesform').show();
 });

    website('.createreq').click(function(e) 
    {
        website('#Mymodalreq').modal('show');
    });


website("#pricepershare").keyup(function(){
   var noofshare=website('#noofshare').val();
   var pricepershare=website('#pricepershare').val();
   if(noofshare !='' && pricepershare!='')
   {
      var totalamt=noofshare*pricepershare;
      website('#totalamt').val(totalamt)
   }  

});


//-----------------------------------on key up search user----------------------
onkeysearchcmp();
function onkeysearchcmp(){ 
 website('#searchcmp').css("display", "none");
 website("#nameofcmp").keyup(function(){

 var search=website('#nameofcmp').val();
 var addhtml='';
  website('#tradinform #searchcmp').html("");
 var formdata={search:search};
 if(search==''){
  website('#searchcmp').css("display", "none");
 }
 else{
        website.ajax({
                  url:'tradingrequest/searchcompany',
                  data:formdata,
                  method:'POST',
                  contentType:'application/x-www-form-urlencoded; charset=UTF-8',
                  dataType:"json",
                  cache:false,
                  beforeSend: function()
                  { 
                     

                   },
                   uploadProgress: function(event, position, total, percentComplete)
                   { 
                   },
                   success: function(response, textStatus, jqXHR) 
                   {
                        addhtml+='<ul>';
                        if(response.logged==true)
                        {
                          website('#searchcmp').css("display", "block");
                          
                          for(var i=0;i<response.data.length;i++)
                          {
                           addhtml+='<li  id="'+response.data[i].id+'" name="'+response.data[i].company_name+'"  class="topul validatorsid">'+response.data[i].company_name+'</li>';
                          }
                          
                      }
                      else{
                        //alert();
                          addhtml+='<li> Result Not Found..!!</li>';
                        }
                        addhtml+='</ul>';
                        website('#tradinform #searchcmp').html(addhtml);
                   },
                  complete: function(response) 
                  {
                  
                   },
                  error: function(jqXHR, textStatus, errorThrown)
                  {   }
          });
        }
    });

}


website("body").on("click",".topul",function(e){
var id=website(this).attr('id');
website('#idofcmp').val(id);
var name=website(this).attr('name');
website('#nameofcmp').val(name);
  website('#searchcmp').css("display", "none");
});


website("body").on("click",".myupnaresh",function(e){

   var id=website(this).attr('id');
// alert(id);
  website('#tradinformupdate #idofcmp').val(id);
  var name=website(this).attr('name');
  website('#tradinformupdate #nameofcmp').val(name);
  website('#tradinformupdate #searchcmp').css("display", "none");
});


 //##############################################AJAX FORM########################################################
website('body').on('click','.sendrequst',function()
{   
    var approverids = website('#approverid').val();
    website('#checkappvlrequest #approverid').val(approverids);
    var reqnames = website('#reqname').val();
    website('#checkappvlrequest #reqname').val(reqnames);
    var typeofrequests = website('#typeofrequest').val();
    website('#checkappvlrequest #typeofrequest').val(typeofrequests);
    
    var selrelatives = website('#selrelative').val();
    website('#checkappvlrequest #selrelative').val(selrelatives);
    var idofcmps = website('#idofcmp').val();
    website('#checkappvlrequest #idofcmp').val(idofcmps);
    var nameofcmps = website('#nameofcmp').val();
    website('#checkappvlrequest #nameofcmp').val(nameofcmps);
    var noofshares = website('#noofshare').val();
    website('#checkappvlrequest #noofshare').val(noofshares);
    var sectypes = website('#sectypeid').val();
    website('#checkappvlrequest #sectype').val(sectypes);
    var typeoftranss = website('#typeoftrans').val();
    website('#checkappvlrequest #typeoftrans').val(typeoftranss);
    var sendreq = website('#sendrequest').val();
    website('#checkappvlrequest #sendreq').val(sendreq);

    var approxprice = website('#sharesprice').val();

    website('#checkappvlrequest #approxprice').val(approxprice);

    var broker = website('#broker').val();
    website('#checkappvlrequest #broker').val(broker);

     var demataccount = website('#demataccount').val();
    website('#checkappvlrequest #demataccount').val(demataccount);

     var place = website('#place').val();
    website('#checkappvlrequest #place').val(place);

    var datetrans = website("input[name='dateoftrans[]']")
              .map(function(){return website(this).val();}).get();
    //console.log(datetrans);
    website('#checkappvlrequest #datetrans').val(datetrans);

     var transaction = website("input[name='trans[]']")
              .map(function(){return website(this).val();}).get();
    
    website('#checkappvlrequest #transaction').val(transaction);

     var sharestrans =website("input[name='sharestrans[]']")
              .map(function(){return website(this).val();}).get();
      
    website('#checkappvlrequest #sharestrans').val(sharestrans);

 
    
    website.ajax({
        url:'tradingrequest/checkclosebalval',
        data:{datetrans:datetrans,approxprice:approxprice,broker:broker,place:place,idofcmps:idofcmps,typeoftranss:typeoftranss,sectypes:sectypes,typeoftranss:typeoftranss,typeofrequests:typeofrequests,noofshares:noofshares},
        method:'POST',
        //contentType:'json',
        contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
        dataType:"json",
        cache:false,
        //async:true, /*Cross domain checking*/
        beforeSend: function()
        { website('.preloder_wraper').fadeIn();   },
        uploadProgress: function(event, position, total, percentComplete)
        {   },
        success: function(response, textStatus, jqXHR)
        {
            website('.preloder_wraper').fadeOut();
            if(response.logged === true)
            {


                if(response.contratrd['status'] === true)
                {
                   // console.log(response.contratrd);
                 
                    if(response.contratrd['message']=='Please Complete Your Latest Trade..!!')
                    {

                        new PNotify({title: 'Alert',
                            text: response.contratrd.message,
                            type: 'university',
                            hide: true,
                            styling: 'bootstrap3',
                            addclass: 'dark ',
                      });  
                    }
                    else
                    {
                      //form 2
                        website('#chckexcptnrequest #Yesexcreqst').attr('requesttype','send'); 
                        website('#chckexcptnrequest').modal('show');
                    }
                }
                else
                {
                  //form 1
                  website('#checkappvlrequest').modal('show');
                }
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
        {   website('.preloder_wraper').fadeOut();   },
        error: function() 
        {   }
    });
});


function getform(formtype)
{
    website.ajax({
        type:"POST",
        url:'tradingrequest/getfilecontent',
        data:{formtype:formtype},
        dataType:"json",
        beforeSend: function()
        { website('.preloder_wraper').fadeIn();  },
        uploadProgress: function(event, position, total, percentComplete)
        {  website('.preloder_wraper').fadeIn(); },
        success: function(response) 
        {
            //console.log(response); return false;
            if(response.logged===true)
            {
                if(formtype == 'form1')
                {

                  //website('#checkappvlrequest #pdflink').attr('href',response.pdf_path);
                  website('#checkappvlrequest').modal('show');
                  
                    
                }
                else if(formtype == 'form2')
                {

                    website('#chckexcptnrequest #Yesexcreqst').attr('requesttype','send'); 
                    website('#chckexcptnrequest #pdflink').attr('href',response.pdf_path);
                    website('#chckexcptnrequest').modal('show');
                }
            }
        },
        complete: function(response)
        { website('.preloder_wraper').fadeOut();  },
        error: function() 
        { website('.preloder_wraper').fadeOut();  }
    });
}




website('body').on('click','.reqdraft',function()
{
    var approverids = website('#approverid').val();
    website('#checkappvlrequest #approverid').val(approverids);
    var reqnames = website('#reqname').val();
    website('#checkappvlrequest #reqname').val(reqnames);
    var typeofrequests = website('#typeofrequest').val();
    website('#checkappvlrequest #typeofrequest').val(typeofrequests);

    var selrelatives = website('#selrelative').val();
    website('#checkappvlrequest #selrelative').val(selrelatives);
    var idofcmps = website('#idofcmp').val();
    website('#checkappvlrequest #idofcmp').val(idofcmps);
    var nameofcmps = website('#nameofcmp').val();
    website('#checkappvlrequest #nameofcmp').val(nameofcmps);
    var noofshares = website('#noofshare').val();
    website('#checkappvlrequest #noofshare').val(noofshares);
    var sectypes = website('#sectypeid').val();
    website('#checkappvlrequest #sectype').val(sectypes);
    var typeoftranss = website('#typeoftrans').val();
    website('#checkappvlrequest #typeoftrans').val(typeoftranss);
    var sendreq = website('#sendrequest').val();
    website('#checkappvlrequest #sendreq').val(sendreq);
    // website('#checkappvlrequest').modal('show');
    // //$idofcmp,$typeoftrans,$sectype,
    //                   $noofshare
    
    website.ajax({
        url:'tradingrequest/checkclosebalval',
        data:{idofcmps:idofcmps,typeoftranss:typeoftranss,sectypes:sectypes,typeoftranss:typeoftranss,typeofrequests:typeofrequests,noofshares:noofshares},
        method:'POST',
        //contentType:'json',
        contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
        dataType:"json",
        cache:false,
        //async:true, /*Cross domain checking*/
        beforeSend: function()
        {   website('.preloder_wraper').fadeIn();   },
        uploadProgress: function(event, position, total, percentComplete)
        {   },
        success: function(response, textStatus, jqXHR)
        {
            if(response.logged === true)
            {
                draftreq();
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
        {  website('.preloder_wraper').fadeOut();    },
        error: function() 
        {   }
    });
});

function draftreq()
{
    var approverid = website('#approverid').val();
    var reqname = website('#reqname').val();
    var typeofrequest = website('#typeofrequest').val();
    var selrelative = website('#selrelative').val();
    var idofcmp = website('#idofcmp').val();
    var nameofcmp = website('#nameofcmp').val();
    var noofshare = website('#noofshare').val();
    var sectype = website('#sectypeid').val();
    var typeoftrans = website('#typeoftrans').val();
    var sendreq = '';
    
    var formdata = {approverid:approverid,reqname:reqname,typeofrequest:typeofrequest,selrelative:selrelative,sectype:sectype,idofcmp:idofcmp,nameofcmp:nameofcmp,noofshare:noofshare,typeoftrans:typeoftrans,sendreq:sendreq};
   
    website.ajax({
        url:'tradingrequest/tradingrequests',
        data:formdata,
        method:'POST',
        //contentType:'json',
        contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
        dataType:"json",
        cache:false,
        //async:true, /*Cross domain checking*/
        beforeSend: function()
        {   website('.preloder_wraper').fadeIn();   },
        uploadProgress: function(event, position, total, percentComplete)
        {    },
        success: function(response, textStatus, jqXHR)
        {
            if(response.logged === true)
            {
                website('#Mymodalreq').modal('hide');
                getalltradingrequest("");

                new PNotify({title: 'Alert',
                    text: response.message,
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
                }); 
                setTimeout(function(){window.location.reload();}, 1000);
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
            website('.preloder_wraper').fadeOut();
        },
        error: function() 
        {   }
});    

}
website('body').on('click','#Yesreqst',function(e)
{
    
    var approverid = website('#checkappvlrequest #approverid').val();
    var reqname = website('#checkappvlrequest #reqname').val();
    var typeofrequest = website('#checkappvlrequest #typeofrequest').val();
    var selrelative = website('#checkappvlrequest #selrelative').val();
    var sectype = website('#checkappvlrequest #sectype').val();
    var idofcmp = website('#checkappvlrequest #idofcmp').val();
    var nameofcmp = website('#checkappvlrequest #nameofcmp').val();
    var noofshare = website('#checkappvlrequest #noofshare').val();
    var typeoftrans = website('#checkappvlrequest #typeoftrans').val();
    var sendreq = website('#checkappvlrequest #sendreq').val();
    var approxprice = website('#checkappvlrequest #approxprice').val();
    var broker = website('#checkappvlrequest #broker').val();
    var demataccount = website('#checkappvlrequest #demataccount').val();
    var place = website('#checkappvlrequest #place').val();
    var datetrans = website('#checkappvlrequest #datetrans').val();
    var transaction = website('#checkappvlrequest #transaction').val();
    var sharestrans = website('#checkappvlrequest #sharestrans').val();
   

    var link = website('#checkappvlrequest #pdflink').attr('href');


    var formdata = {approxprice:approxprice,broker:broker,demataccount:demataccount,place:place,datetrans:datetrans,transaction:transaction,sharestrans:sharestrans,approverid:approverid,reqname:reqname,typeofrequest:typeofrequest,selrelative:selrelative,sectype:sectype,idofcmp:idofcmp,nameofcmp:nameofcmp,noofshare:noofshare,typeoftrans:typeoftrans,sendreq:sendreq,link:link};
    website.ajax({
      url:'tradingrequest/tradingrequests',
      data:formdata,
      method:'POST',
      //contentType:'json',
      contentType:'application/x-www-form-urlencoded; charset=UTF-8',
      //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
      dataType:"json",
      cache:false,
      //async:true, /*Cross domain checking*/
      beforeSend: function()
      { website('.preloder_wraper').fadeIn(); },
      uploadProgress: function(event, position, total, percentComplete)
      {  website('.preloder_wraper').fadeIn();  },
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
             setTimeout(function(){window.location.reload();}, 1000);
              
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
        website('.preloder_wraper').fadeOut(); 
        //window.location.reload();
     },
    error: function() 
    {   }
});
});





 

website('#uploadtrade').ajaxForm({
    //data:formdata,
    //contentType:'application/x-www-form-urlencoded; charset=UTF-8',
    dataType:"json",
    beforeSend: function() 
    { website('.preloder_wraper').fadeIn(); },
    uploadProgress: function(event, position, total, percentComplete) 
    { website('.preloder_wraper').fadeIn();  },
    success: function(response, textStatus, jqXHR) 
    {
          if(response.logged===true)
          {
                  if(response.message=="exception")
                  {

                      website("#subfile").css("display", "none");
                      website("#excdiv").css("display", "block");

                        new PNotify({title: 'Alert',
                            text: "You have not traded within the trading window. Please take exception approval.",
                            type: 'university',
                            hide: true,
                            styling: 'bootstrap3',
                            addclass: 'dark ',
                          }); 
//                      website("#exceptnresionmodal").modal('show');
                  }
                  else if(response.message=="limit exception")
                  {
                        website("#subfile").css("display", "none");
                        website("#excdiv").css("display", "block");

                         new PNotify({title: 'Alert',
                            text: "You have Exceed The Limit Of No Of Alloted Shares.",
                            type: 'university',
                            hide: true,
                            styling: 'bootstrap3',
                            addclass: 'dark ',
                          }); 
//                      website("#exceptnresionmodal").modal('show');
                  }
                  else
                  {
                      //console.log(response); return false;
                        if(response.exceptinappr==1)
                        {
                            var baseHref = getbaseurl();
                            var redirecturl=baseHref+"exceptionreq";
                            window.location.href =redirecturl;
                        }
                        else
                        {
                             website('#uploadmyfile').modal('hide');
                             window.location.reload();

                            new PNotify({title: 'Alert',
                                text: response.message,
                                type: 'university',
                                hide: true,
                                styling: 'bootstrap3',
                                addclass: 'dark ',
                              }); 
                        }
                   }
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
    {  website('.preloder_wraper').fadeOut();  },
    error: function() 
    {   }
});

website('#tradinformupdate').ajaxForm({
    //data:formdata,
    //contentType:'application/x-www-form-urlencoded; charset=UTF-8',
    dataType:"json",
    beforeSend: function() 
    {   },
    uploadProgress: function(event, position, total, percentComplete) 
    {   },
    success: function(response, textStatus, jqXHR) 
     {
        if(response.logged === true)
        {
            website('#updatemodal').modal('hide');
            getalltradingrequest("");

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
    {   },
    error: function() 
    {   }
});



/* start: fetch url parameter status */
var url_string = window.location.href;
var url = new URL(url_string);
var url_status = url.searchParams.get("status");

var newurlchk = new URL(url_string);
var newurlchkst = atob(url.searchParams.get("redirect"));
  // alert(atob(newurlchkst));
  if(newurlchkst=='modal')
  {
    // alert("hi Naresh");
    website('#Mymodalreq').modal('show');
  }
//console.log(status);
/* end: fetch url parameter status */
if(url_status!=null)
{
	getalltradingrequest(atob(url_status));
}
else
{
  getalltradingrequest("");
}

function getalltradingrequest(url_status)
{
    var noofrows = website('#noofrows').val(); 
    var pagenum = website('#pagenum').val();
    var myredirecturl=website('#redirecturl').val();
    if(url_status) {
      var status = url_status;
      website('#filterstatus').val(status);
    } else {
      var status = website('#filterstatus').val();
    }
    
    var formdata = {noofrows:noofrows,pagenum:pagenum,redirecturl:myredirecturl,status:status};
    
    //alert(myredirecturl);
   website.ajax({
        url:'tradingrequest/gettradingrequest',
        data:formdata,
        method:'POST',
        contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        dataType:"json",
        cache:false,
        beforeSend: function()
        { 
          website('.preloder_wraper').fadeIn(); 
        },
        uploadProgress: function(event, position, total, percentComplete)
        { 
        },
        success: function(response, textStatus, jqXHR) 
        {
            if(response.logged==true)
            {
                //console.log(response.data);return false;
                var addhtmlnxt='';
                for(var i=0;i<response.data.length;i++)
                {
                    var j=i+1;
                    var demat_acc_no=response.data[i].demat_acc_no?response.data[i].demat_acc_no:'';
                    var sectype=response.data[i].security_type?response.data[i].security_type:'';
                    var name_of_company=response.data[i].mycompany?response.data[i].mycompany:''
                    var no_of_shares=response.data[i].no_of_shares?response.data[i].no_of_shares:'';
                    var type_of_transaction=response.data[i].transaction?response.data[i].transaction:'';
                    var price_per_share=response.data[i].price_per_share?response.data[i].price_per_share:''
                    var total_amount=response.data[i].total_amount?response.data[i].total_amount:'';

                    // --- Start Date ---
                    var dateadded=response.data[i].date_added?response.data[i].date_added:'';
                    var dteadded = dateadded.split("-"); 
                    //console.log(dteadded);
                    var ddtm = dteadded[2].split(" "); 
                    //console.log(ddtm);
                    var rqdd = ddtm[0];
                    var rqmm = dteadded[1];
                    var rqyy = dteadded[0];
                    var rqtm = ddtm[1];
                    var date_added = rqdd+'-'+rqmm+'-'+rqyy;
                    // --- End Date ---
                    
                    var date_modified=response.data[i].date_modified?response.data[i].date_modified:'';
                    var transaction_date=response.data[i].transaction_date?response.data[i].transaction_date:'';
                    var trading_date=response.data[i].trading_date?response.data[i].trading_date:'';
                    var send_status=response.data[i].send_status;
                    var approved_status=response.data[i].approved_status;
                    var file=response.data[i].file?response.data[i].file:'';
                    var type_of_request=response.data[i].type_of_request?response.data[i].type_of_request:'';
                    var trading_status=response.data[i].trading_status?response.data[i].trading_status:'';
                    var message=response.data[i].rejected_message?response.data[i].rejected_message:'';
                    var typeofrequest=response.data[i].request_type?response.data[i].request_type:'';
                    var nameofreq=response.data[i].name?response.data[i].name:'';
                    var relationship=response.data[i].relationship?response.data[i].relationship:'';
                    var exception_approve=response.data[i].exception_approve?response.data[i].exception_approve:'';
                    //   console.log(exception_approve);

                    addhtmlnxt += '<tr class="counter" tempid="'+response.data[i].id+'" >';
                    if(send_status==0)
                    {
                        addhtmlnxt += '<td>'+j+' <input type="checkbox" class="sendchkbox" chkval="'+response.data[i].id+'" name="sendapprove" value="'+response.data[i].id+'"></td>';
                    }
                    else
                    {
                        addhtmlnxt += '<td>'+j+'</td>';
                    }

                    addhtmlnxt += '<td>'+sectype+'</td>';
                    addhtmlnxt += '<td>'+name_of_company+'</td>';
                    addhtmlnxt += '<td>'+type_of_transaction+'</td>';
                    addhtmlnxt += '<td>'+no_of_shares+'</td>';
                    addhtmlnxt += '<td>'+typeofrequest+'</td>';
                    addhtmlnxt += '<td>'+nameofreq+'</td>';
                    addhtmlnxt += '<td>'+relationship+'</td>';
                    // console.log(trading_status);

                    //addhtmlnxt += '<td width="15%">'+price_per_share+'</td>';
                    //addhtmlnxt += '<td width="15%">'+total_amount+'</td>';

//                    if(send_status==1)
//                    {
//                        addhtmlnxt += '<td>Sent</td>';
//                    }
//                    else
//                    {
//                        addhtmlnxt += '<td>Drafted</td>';
//                    }


                    if(approved_status==1)
                    {
                        addhtmlnxt += '<td><i class="fa fa-check-circle" style="font-size:15px;color:green;"></i></td>';
                    }
                    else if(approved_status==2)
                    {
                        addhtmlnxt += '<td class="rejmessage" mymessage="'+message+'"><i class="fa fa-times-circle" style="font-size:15px;color:red;" ></i></td>';
                    }
                    else
                    {
                        addhtmlnxt += '<td style="color:#F44336;">Not Approved</td>';
                    }

                    addhtmlnxt += '<td>'+trading_date+'</td>';
                    addhtmlnxt += '<td>'+date_added+'</td>';
                    //addhtmlnxt += '<td>'+date_modified+'</td>';

                    if((approved_status==1 && trading_status=='') && exception_approve!=1 )
                    {
                        addhtmlnxt += '<td>';
                            addhtmlnxt += '<i class="fa fa-line-chart uploadfile" typeofreq="'+type_of_request+'" modtotal="'+total_amount+'" modpriceshare="'+price_per_share+'" modnoofshare="'+no_of_shares+'" modaltransdate="'+transaction_date+'" editid="'+response.data[i].id+'" compid="'+response.data[i].id_of_company+'" sectype="'+response.data[i].sectype+'" trading_date="'+trading_date+'" create_date="'+date_added+'" ></i>';
                        addhtmlnxt += '</td>';
                    }
                    else
                    {  
                        // alert(trading_status);
                        if((trading_status==1 && approved_status==1) || (exception_approve==1 && trading_status==1) )
                        {
                           // alert();
                            addhtmlnxt += '<td>'+file+'<p reqid="'+response.data[i].id+'" class="checkstatus"><i class="fa fa-line-chart" style="color:green;"></i></p></td>';
                        }
                        else if(exception_approve==1)
                        {
                             
                            addhtmlnxt += '<td>';
                                addhtmlnxt += '<i class="fa fa-line-chart uploadfile" typeofreq="'+type_of_request+'" modtotal="'+total_amount+'" modpriceshare="'+price_per_share+'" modnoofshare="'+no_of_shares+'" modaltransdate="'+transaction_date+'" editid="'+response.data[i].id+'" compid="'+response.data[i].id_of_company+'" sectype="'+response.data[i].sectype+'" trading_date="'+trading_date+'" create_date="'+date_added+'" ></i>';
                            addhtmlnxt += '</td>';

                        }
                        else if(trading_status==0 && approved_status==1)
                        {
                            addhtmlnxt += '<td><i class="fa fa-line-chart" style="color:red;"></i></td>';
                        }
                        else
                        {
                            addhtmlnxt += '<td></td>';
                        }

                    }

                    addhtmlnxt+='<td><i class="fa fa-bar-chart requsttrail" rqstid="'+response.data[i].id+'"></i></td>';
//                    if(send_status==1)
//                    { 
//                        addhtmlnxt+='<td><i class="fa fa-ban" style="color:#F44336;"></i></td>';;
//                    }
//                    else
//                    {
//                        addhtmlnxt+='<td>';
//                        addhtmlnxt += '<i class="fa fa-edit editper" pereditid="'+response.data[i].id+'" style="font-size:15px;"></i>';
//                        addhtmlnxt += '<i class="fa fa-trash-o delreq" perdelid="'+response.data[i].id+'" style="font-size:15px; color:#F44336;"></i>';
//                        addhtmlnxt += '</td>';
//                    }

                    addhtmlnxt+='</tr>';
                }                          
            }
            else
            {
                addhtmlnxt += '<tr><td colspan="13" style="text-align:center;"> No Data Found..!!!</td></tr>';
            }

            website(".reqtable").html(addhtmlnxt);
            website('.paginationmn').html(response.pgnhtml);

        },
        complete: function(response) 
        { 
          website('.preloder_wraper').fadeOut(); 
        },
        error: function(jqXHR, textStatus, errorThrown)
        {   }
    });

}   


website("body").on("click",".tradedel",function(e){
    var delid=website(this).attr('delmytrade');
    website("#delthistrade").attr('tempid',delid)
    website('#delmytrade').modal('show');
});

website("body").on("click","#delthistrade",function(e){
    var delid=website(this).attr('tempid');
	 website.ajax({
                  url:'tradingrequest/deltrade',
                  data:{delid:delid},
                  method:'POST',
                  contentType:'application/x-www-form-urlencoded; charset=UTF-8',
                  dataType:"json",
                  cache:false,
                  beforeSend: function()
                  { 
                  },
                   uploadProgress: function(event, position, total, percentComplete)
                   { 
                   },
                   success: function(response, textStatus, jqXHR) 
                   {
                        if(response.logged==true)
                        {

                          // getalltradingrequest();
                          //  website('#delmod').modal('hide');
                           new PNotify({title: 'Alert',
                           text: response.message,
                           type: 'university',
                           hide: true,
                           styling: 'bootstrap3',
                              addclass: 'dark ',
                             });

                            setTimeout(function(){window.location.reload();}, 1000);
                          }
                        else{
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
                  
                   },
                  error: function(jqXHR, textStatus, errorThrown)
                  {   }
          })


})
website("body").on("click",".delreq",function(e){

 var delid=website(this).attr('perdelid');
 website("#deletereq").attr('tempid',delid)
  website('#delmod').modal('show');
});

website("body").on("click","#deletereq",function(e){
  var delid=website(this).attr('tempid');
   website.ajax({
                  url:'tradingrequest/deletepersrequest',
                  data:{delid:delid},
                  method:'POST',
                  contentType:'application/x-www-form-urlencoded; charset=UTF-8',
                  dataType:"json",
                  cache:false,
                  beforeSend: function()
                  { 
                     

                   },
                   uploadProgress: function(event, position, total, percentComplete)
                   { 
                   },
                   success: function(response, textStatus, jqXHR) 
                   {
                        if(response.logged==true)
                        {

                           getalltradingrequest("");
                            website('#delmod').modal('hide');
                           new PNotify({title: 'Alert',
                           text: response.message,
                           type: 'university',
                           hide: true,
                           styling: 'bootstrap3',
                              addclass: 'dark ',
                             });
                          }
                        else{
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
                  
                   },
                  error: function(jqXHR, textStatus, errorThrown)
                  {   }
          });

});

// //##############################Save Data As Drafte###########################################################//
website("body").on("click",".editper",function(e)
{
     var editid=website(this).attr('pereditid');
  
   website.ajax({
                  url:'tradingrequest/getsinglereq',
                  data:{editid:editid},
                  method:'POST',
                  contentType:'application/x-www-form-urlencoded; charset=UTF-8',
                  dataType:"json",
                  cache:false,
                  beforeSend: function()
                  { 
                     

                   },
                   uploadProgress: function(event, position, total, percentComplete)
                   { 
                   },
                   success: function(response, textStatus, jqXHR) 
                   {
                        if(response.logged==true)
                        {
                               //name_of_requester ,demat_acc_no,,name_of_company,id_of_company,no_of_shares,type_of_transaction,price_per_share,approver_id,total_amount,transaction_date 
                                //console.log(response.data);return false;
                                //console.log(response.data.type_of_request)
                               
                                website('#updatemodal #typeofrequest [value="'+response.data.type_of_request+'"]').attr('selected','true');
                                website('#updatemodal #sectype [value="'+response.data.sectype+'"]').attr('selected','true');
                                website('#updatemodal #typeoftrans [value="'+response.data.type_of_transaction+'"]').attr('selected','true');
                                website('#updatemodal #noofshare').val(response.data.no_of_shares);
                                website('#updatemodal #transdate').val(response.data.transaction_date);
                                website('#updatemodal #pricepershare').val(response.data.price_per_share);
                                website('#updatemodal #totalamt').val(response.data.total_amount);
                                website('#updatemodal #nameofcmp').val(response.data.name_of_company);
                                website('#updatemodal #idofcmp').val(response.data.id_of_company);
                                website('#updatemodal #editid').val(editid);
                                 if(response.data.type_of_request==2)
                                {
                                   website('#updatemodal #selrel').css("display", "block");
                                   website('#updatemodal #selrelative [value="'+response.data.relative_id+'"]').attr('selected','true');
                                }
                                else
                                {
                                   website('#updatemodal #selrel').css("display", "none");
                                }
                                website('#updatemodal').modal('show'); 
                                onkeysearchcmp();  
                                selecttypeofreqonmodal();               
                         }
                      else{
                         
                           }
                        
                   },
                  complete: function(response) 
                  {
                  
                   },
                  error: function(jqXHR, textStatus, errorThrown)
                  {   }
          });
 });
//###############################################onkery search cmp for modal######################################################
website("body").on("click",".close",function(e){
 // website('#searchcmp').html("");
  website('#searchcmp').css("display", "none");
});
website("body").on("click",".modalclose",function(e){
 // website('#searchcmp').html("");

  website('#tradinformupdate #searchcmp').css("display", "none");

});
onkeysearchcmpmodal();
function onkeysearchcmpmodal(){ 
 website('#tradinformupdate #searchcmp').css("display", "none");
 website("#tradinformupdate #nameofcmp").keyup(function(){

 var search=website('#tradinformupdate #nameofcmp').val();
 var addhtml='';
  website('#tradinformupdate #searchcmp').html("");
 var formdata={search:search};
 if(search==''){
  website('#tradinformupdate #searchcmp').css("display", "none");
 }
 else{
        website.ajax({
                  url:'tradingrequest/searchcompany',
                  data:formdata,
                  method:'POST',
                  contentType:'application/x-www-form-urlencoded; charset=UTF-8',
                  dataType:"json",
                  cache:false,
                  beforeSend: function()
                  { 
                     

                   },
                   uploadProgress: function(event, position, total, percentComplete)
                   { 
                   },
                   success: function(response, textStatus, jqXHR) 
                   {
                        addhtml+='<ul>';
                        if(response.logged==true)
                        {
                          website('#tradinformupdate #searchcmp').css("display", "block");
                          
                          for(var i=0;i<response.data.length;i++)
                          {
                           addhtml+='<li  id="'+response.data[i].id+'" class="myupnaresh" cmpid="'+response.data[i].id+'" name="'+response.data[i].company_name+'">'+response.data[i].company_name+'</li>';
                          }
                          
                      }
                      else{
                          addhtml+='<li> Result Not Found..!!</li>';
                        }
                        addhtml+='</ul>';
                        website('#tradinformupdate #searchcmp').html(addhtml);
                   },
                  complete: function(response) 
                  {
                  
                   },
                  error: function(jqXHR, textStatus, errorThrown)
                  {   }
          });
        }
    });

}


website("body").on("click",".getallchkbox",function(e){
   if(website(this).is(":checked")) 
  {
     website('div input').attr('checked', true);   
   }
   else
   {
     website('div input').attr('checked', false);  
   }
});
website("body").on("click","#sendmulreq",function(e){
    
 var selected_value = []; // initialize empty array 
    website(".sendchkbox:checked").each(function(){
        selected_value.push(website(this).val());
    }); 
    website('#checkappvlreq #selctedid').val(selected_value);
    website('#checkappvlreq #selctedidlength').val(selected_value.length);
    website('#checkappvlreq').modal('show');
});
website("body").on("click","#Yesreqstsend",function(e){
    var selctedid = website('#checkappvlreq #selctedid').val();
    var selected_value = website('#checkappvlreq #selctedidlength').val();
 
    if(selected_value > 0)
    {
        website.ajax({
            url:'tradingrequest/sendmultiplereq',
            data:{selctedid:selctedid},
            method:'POST',
            contentType:'application/x-www-form-urlencoded; charset=UTF-8',
            dataType:"json",
            cache:false,
            beforeSend: function()
            {   website('.preloder_wraper').fadeIn();   },
            uploadProgress: function(event, position, total, percentComplete)
            { 
            },
            success: function(response, textStatus, jqXHR) 
            {
                if(response.logged==true)
                {
                    website('#checkappvlreq').modal('hide');
                    getalltradingrequest("");

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
            {
                website('.preloder_wraper').fadeOut();
            },
            error: function(jqXHR, textStatus, errorThrown)
            {   }
        });
    }
    else
    {
        new PNotify({title: 'Alert',
            text: "You Should Selct At Least One Request",
            type: 'university',
            hide: true,
            styling: 'bootstrap3',
            addclass: 'dark ',
        });
    }
});


website("body").on("click",".uploadfile",function(e)
{  
    var editid= website(this).attr('editid');
    var typeofreq=website(this).attr('typeofreq');
    var compid= website(this).attr('compid');
    var sectype= website(this).attr('sectype');
    var total=website(this).attr('modtotal');
    var priceofshare=website(this).attr('modpriceshare');
    var noofshare=website(this).attr('modnoofshare');
    var transdate=website(this).attr('modaltransdate');
    var tradedate = website(this).attr('trading_date');
    var createdate = website(this).attr('create_date');

   
    var status=website("#modalcheck").prop("checked");
    if(status==true)
    {
        website("#modalcheck"). prop("checked", false);
    }
    
    website.ajax({
      url:'tradingrequest/checktradestatus',
      data:{editid:editid,typeofreq:typeofreq},
      method:'POST',
      contentType:'application/x-www-form-urlencoded; charset=UTF-8',
      dataType:"json",
      cache:false,
      beforeSend: function()
      { 


       },
       uploadProgress: function(event, position, total, percentComplete)
       { 
       },
       success: function(response, textStatus, jqXHR) 
       {
            var tradehtml='';

            if(response.logged===true)
            {
                var transactedshares=0;

                for(var i=0;i<response.data.length;i++)
                {
                    var no_of_share=response.data[i].no_of_share;
                    var price_per_share=response.data[i].price_per_share;
                    var total_amount=response.data[i].total_amount;
                    var date_of_transaction=response.data[i].date_of_transaction;
                    var demat_acc_no=response.data[i].demat_acc_no;
                    var dnlfile=response.data[i].file;

                    tradehtml+='<tr>';
                    tradehtml+='<td>'+no_of_share+'</td>';
                    tradehtml+='<td>'+price_per_share+'</td>';
                    tradehtml+='<td>'+total_amount+'</td>';
                    tradehtml+='<td>'+date_of_transaction+'</td>';
                    tradehtml+='<td>'+demat_acc_no+'</td>';
                    tradehtml+='<td>'+dnlfile+'</td>';
                    tradehtml+='<td><i class="fa fa-trash-o tradedel" delmytrade="'+response.data[i].id+'" style="font-size:15px; color:#F44336;"></i></td>';
                    tradehtml+='</tr>';
                    transactedshares=parseInt(transactedshares)+parseInt(no_of_share);

                    // website('#alloutedshares').val(no_of_share);
                    website('#nottrade').css("display", "none");

                }
            }
            else
            {
                  tradehtml+='<tr>';
                  tradehtml+='<td colspan="7" style="text-align:center;">Data Not Found</td>';
                  tradehtml+='</tr>';
                  website('#nottrade').css("display", "block")
            }

           // ------ Start Fields ------
                if(transactedshares)
                {   var leftnfshr = noofshare-transactedshares; }
                else
                {   var leftnfshr = noofshare; }
                if(leftnfshr<0)
                {   var leftnfshr = 0; }
           
                website('#noofsharemodal').val(leftnfshr);
                website('#pricepersharemodal').val(priceofshare);
                website('#totalamtmodal').val(total);
                website('#transdatemodal').val(transdate);

                var appendsel = '';
                website.each(response.dematacc, function (index, value) 
                {  
                    appendsel += '<option value='+value['accountno']+'>'+value['accountno']+'</option>';
                });
                website('#dmatacc').html(appendsel);
           // ------ End Fields ------
           
           // ------ Start OtherFields ------
                website('#uploadmyfile #transtype').val(typeofreq);
                website('#noofffshares').val(noofshare);
                website('#transshare').val(transactedshares);
                website('#uploadmyfile #filereqid').val(editid);
                website('#uploadmyfile #compid').val(compid);
                website('#uploadmyfile #sectype').val(sectype);
                website('#uploadmyfile #tradedate').val(tradedate);
                website('#uploadmyfile #createdate').val(createdate);
           // ------ End OtherFields ------
           
            website('.tradeviewtb').html(tradehtml);
            if(response.data.length == 0)
            {
                website('.cmplttrans').hide();
            }
            else
            {
                website('.trade').show();
            }

            website('#uploadmyfile').modal('show');
            datepicker();
         } 
    });
                     
});

/* -------- Start autoCalculate -------- */
website('#uploadtrade #noofsharemodal,#pricepersharemodal').on('keyup', function(e){
    var noofshare=website('#noofsharemodal').val();
    var pricepershare=website('#pricepersharemodal').val();
    if(noofshare !='' && pricepershare!='')
    {
        var totalamt=noofshare*pricepershare;
        website('#totalamtmodal').val(totalamt);
    }  
    else
    {
        website('#totalamtmodal').val('');
    }
});
/* -------- End autoCalculate -------- */


website("body").on("click",".rejmessage",function(e){ 
    var mymessage=website(this).attr('mymessage');
    //console.log(mymessage);
    // alert();
    website('#mymess').val(mymessage);
    website('#commentmodal').modal('show');
        
});  

website(":checkbox[name='modalcheck']").change(function() {
       var checkbox_Value = website(this).val();
	   var chkhtml='';
	      if (website(this).is(':checked')) 
	      {
	          website(this).attr('value', 'false');
	          chkhtml='<input type="button" id="donetrade" class="btn btn-primary" value="Final Submit" >';
	      } 
	     else
	    {
	       //website(this).attr('value', 'false');
	       chkhtml='';
	      

	     }
	     website('#typebtn').html(chkhtml);


})




    website("body").on("click","#donetrade",function(e){
        var reqid=website('#filereqid').val();
        website.ajax({
            url:'tradingrequest/donetrade',
            data:{reqid:reqid},
            method:'POST',
            contentType:'application/x-www-form-urlencoded; charset=UTF-8',
            dataType:"json",
            cache:false,
            beforeSend: function()
            { 
                website('.preloder_wraper').fadeIn();
            },
            uploadProgress: function(event, position, total, percentComplete)
            { 
                website('.preloder_wraper').fadeIn();

            },
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
                    website('#uploadmyfile').modal('hide');
                    getalltradingrequest("");

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
                website('.preloder_wraper').fadeOut();
            },
            error: function(jqXHR, textStatus, errorThrown)
            {   }

        });

    });

website("body").on("click","#nottrade",function(e){

  var reqid=website('#filereqid').val();

  website.ajax({
                  url:'tradingrequest/notdonetrade',
                  data:{reqid:reqid},
                  method:'POST',
                  contentType:'application/x-www-form-urlencoded; charset=UTF-8',
                  dataType:"json",
                  cache:false,
                  beforeSend: function()
                  { 
                     

                   },
                   uploadProgress: function(event, position, total, percentComplete)
                   { 


                   },
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
                              website('#uploadmyfile').modal('hide');
                              getalltradingrequest("");

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
                   }

                 });


});


hidereldropdown();
function hidereldropdown(){

   website('#selrel').css("display", "none");


}
selecttypeofreqonmodal();

function selecttypeofreqonmodal()
{
website("body").on("click","#updatemodal #typeofrequest",function(e){
var typeofreq=website( "#updatemodal #typeofrequest option:selected" ).val(); 
if(typeofreq==2)
{
  website('#updatemodal #selrel').css("display", "block");
}
else
{
   website('#updatemodal #selrel').css("display", "none");
}
});
}

selecttypeofreq();

function selecttypeofreq()
{
website("body").on("click","#typeofrequest",function(e){
var typeofreq=website( "#typeofrequest option:selected" ).val(); 

if(typeofreq==2)
{
  website('#selrel').css("display", "block");

   website.ajax({
                  url:'tradingrequest/fetchdemat',
                  data:{typeofreq:typeofreq},
                  method:'POST',
                  contentType:'application/x-www-form-urlencoded; charset=UTF-8',
                  dataType:"json",
                  cache:false,
                  beforeSend: function()
                  { 
                     

                   },
                   uploadProgress: function(event, position, total, percentComplete)
                   { 
                   },
                   success: function(response, textStatus, jqXHR) 
                   {
                     var addhtmlnxt ='';
                      if(response.logged==true)
                      {
                        //console.log(response);
                         //addhtmlnxt+=' <option value="">Select Demat Account</option>';
                         for(var i=0;i<response.data.length;i++)
                         {
                           var id=response.data[i].id?response.data[i].id:'Not Found';
                           var accno=response.data[i].accountno?response.data[i].accountno:'Not Found';
                           var dp=response.data[i].depository_participient?response.data[i].depository_participient:'Not Found';
                           
                          
                           addhtmlnxt+='<option value="'+id+'">'+accno+'</option>';

                          
                          

                          
                          }
                            // console.log(addhtmlnxt);return false;
                              website('#demataccount').html(addhtmlnxt);
                             

                      }
                      else{
                           addhtmlnxt+=' ';
                      }

                   
                   }
    });
}
else
{
   website('#selrel').css("display", "none");
   
   website.ajax({
                  url:'tradingrequest/fetchdemat',
                  data:{typeofreq:typeofreq},
                  method:'POST',
                  contentType:'application/x-www-form-urlencoded; charset=UTF-8',
                  dataType:"json",
                  cache:false,
                  beforeSend: function()
                  { 
                     

                   },
                   uploadProgress: function(event, position, total, percentComplete)
                   { 
                   },
                   success: function(response, textStatus, jqXHR) 
                   {
                     var addhtmlnxt ='';
                      if(response.logged==true)
                      {
                         //console.log(response);
                          addhtmlnxt+=' <option value="">Select Demat Account</option>';
                         for(var i=0;i<response.data.length;i++)
                         {
                           var id=response.data[i].id?response.data[i].id:'Not Found';
                           var accno=response.data[i].accountno?response.data[i].accountno:'Not Found';
                           var dp=response.data[i].depository_participient?response.data[i].depository_participient:'Not Found';
                           
                          
                           addhtmlnxt+='<option value="'+id+'">'+accno+'</option>';
                            //website("#dpdemat").val(dp);
                          
                          
                          }
                          
                          website('#demataccount').html(addhtmlnxt);

                      }
                      else
                      {
                                     addhtmlnxt+=' ';
                      }

                   
                   }
    });

}
});
}

website("body").on("click",".checkstatus",function(e){

var reqid=website(this).attr('reqid');
 website.ajax({
                  url:'tradingrequest/getsuccesstrade',
                  data:{reqid:reqid},
                  method:'POST',
                  contentType:'application/x-www-form-urlencoded; charset=UTF-8',
                  dataType:"json",
                  cache:false,
                  beforeSend: function()
                  { 
                     

                   },
                   uploadProgress: function(event, position, total, percentComplete)
                   { 
                   },
                   success: function(response, textStatus, jqXHR) 
                   {
                   	 var addhtmlnxt ='';
                      if(response.logged==true)
                      {
                      	// console.log("herereeee");return false;
                      	 for(var i=0;i<response.data.length;i++)
                      	 {
                           var noofshare=response.data[i].no_of_share?response.data[i].no_of_share:'Not Found';
                           var price_per_share=response.data[i].price_per_share?response.data[i].price_per_share:'Not Found';
                           var total_amount=response.data[i].total_amount?response.data[i].total_amount:'Not Found';
                           var date_of_transaction=response.data[i].date_of_transaction?response.data[i].date_of_transaction:'Not Found';
                           var demat_acc_no=response.data[i].demat_acc_no?response.data[i].demat_acc_no:'Not Found';
                           var file=response.data[i].file?response.data[i].file:'Not Found';
                           addhtmlnxt+='<tr>';
                           addhtmlnxt+='<td>'+noofshare+'</td>';
                           addhtmlnxt+='<td>'+price_per_share+'</td>';
                           addhtmlnxt+='<td>'+total_amount+'</td>';
                           addhtmlnxt+='<td>'+date_of_transaction+'</td>';
                           addhtmlnxt+='<td>'+demat_acc_no+'</td>';
                           addhtmlnxt+='<td>'+file+'</td>';
                           addhtmlnxt += '</tr>';

                          
                          }
                            // console.log(addhtmlnxt);return false;
                              website('#myModal .statustable').html(addhtmlnxt);
                              website('#myModal').modal('show');

                      }
                      else{
                                  new PNotify({title: 'Alert',
                                  text:"You Have Not Done Trade For This Request",
                                  type: 'university',
                                  hide: true,
                                 styling: 'bootstrap3',
                                 addclass: 'dark ',
                          });
                      }

                   
                   }
    });
});

website('body').on('click','#Norequestsend',function(e)
{
    new PNotify({title: 'Alert',
              text: 'You cannot sent request',
              type: 'university',
              hide: true,
              styling: 'bootstrap3',
              addclass: 'dark ',
                });
    setTimeout(function(){window.location.reload();}, 1000);
});

website('body').on('click','#Norequest',function(e)
{
    
    new PNotify({title: 'Alert',
              text: 'You cannot sent request',
              type: 'university',
              hide: true,
              styling: 'bootstrap3',
              addclass: 'dark ',
                });
    setTimeout(function(){window.location.reload();}, 1000);
});


/* start: status filter */

website('body').on('change','#filterstatus', function(e) 
{     
  getalltradingrequest("");
});

/* end: status filter */

website('body').on("click",".requsttrail",function(e){
    var rqstid = website(this).attr('rqstid');
    var formdata = {rqstid:rqstid}
    website.ajax({
      url:'tradingrequest/fetchreqtrail',
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
            /* for date_added start */
             dteadded = response.data[0].date_added.split("-");                   
             dteaddedspace = response.data[0].date_added.split(" ");                    
                     ddmmyyadded = dteaddedspace[0];
                     dteadded = dteaddedspace[0].split("-");
                     ddmmyyadded = dteadded[2]+'-'+dteadded[1]+'-'+dteadded[0];
                     timesadded = dteaddedspace[1];
            /* for date_added end */
            
            /* for date_added start */
             dtemodified = response.data[0].date_modified.split("-");                   
             dtemodifdspace = response.data[0].date_modified.split(" ");                    
                     ddmmyymodified = dtemodifdspace[0];
                     dtemodified = dtemodifdspace[0].split("-");
                     ddmmyymodified = dtemodified[2]+'-'+dtemodified[1]+'-'+dtemodified[0];
                     timesmodified = dtemodifdspace[1];
            /* for date_added end */
                    
                    
           website('#Mymodalaudittrail .reqstcreateddte' ).html(ddmmyyadded+' '+timesadded);
           website('#Mymodalaudittrail .reqstupdteddte' ).html(ddmmyymodified+' '+timesmodified);
            
            /* -----  Application copy ----*/
            if(response.data[0].pdffilepath)
            {
               website('#Mymodalaudittrail .pdfpath').html('<a href="'+response.data[0].pdffilepath+'" target="_blank"><i class="fa fa-download" style="font-size:15px;color:black;"></i></a>'); 
            }
            else
            {
                website('#Mymodalaudittrail .pdfpath').html('');
            }
           if(response.data[0].send_status == 1)
           {
               if(response.data[0].sendaprvl_date)
                {
                    /* for sent apprvl start */
                     dtesendaprv = response.data[0].sendaprvl_date.split("-");                   
                     dtesendaprvspace = response.data[0].sendaprvl_date.split(" ");                    
                     ddmmyysendaprv = dtesendaprvspace[0];
                     dtesendaprv = dtesendaprvspace[0].split("-");
                     ddmmyysendaprv = dtesendaprv[2]+'-'+dtesendaprv[1]+'-'+dtesendaprv[0];
                     timessendaprv = dtesendaprvspace[1];
                    /* for sent apprvl end */
                    website('#Mymodalaudittrail .reqstsendapprv' ).html(ddmmyysendaprv+' '+timessendaprv);
                }
                    
               
           }
           else
           {
               website('#Mymodalaudittrail .reqstsendapprv' ).html(''); 
           }
           if(response.data[0].approved_status == 1)
           {
               if(response.data[0].approved_date)
                {
                    /* for apprvl start */
                     dteaprv = response.data[0].approved_date.split("-");                   
                     dteaprvspace = response.data[0].approved_date.split(" ");                    
                     ddmmyyaprv = dteaprvspace[0];
                     dteaprv = dteaprvspace[0].split("-");
                     ddmmyyaprv = dteaprv[2]+'-'+dteaprv[1]+'-'+dteaprv[0];
                     timesaprv = dteaprvspace[1];
                    /* for apprvl end */  
                    website('#Mymodalaudittrail .reqstapprvd' ).html(ddmmyyaprv+' '+timesaprv);
                }
               
           }
           else
           {
               website('#Mymodalaudittrail .reqstapprvd' ).html(''); 
           }
           if(response.data[0].trading_status == 1)
           {
               website('#Mymodalaudittrail .reqsttrdngsts' ).html('Completed');
               if(response.data[0].tradestatus_date)
                {
                    /* for tradestts start */
                     dtetrdsts = response.data[0].tradestatus_date.split("-");                   
                     dtetrdstsspace = response.data[0].tradestatus_date.split(" ");                    
                     ddmmyytrdsts = dtetrdstsspace[0];
                     dtetrdsts = dtetrdstsspace[0].split("-");
                     ddmmyytrdsts = dtetrdsts[2]+'-'+dtetrdsts[1]+'-'+dtetrdsts[0];
                     timestrdsts = dtetrdstsspace[1];
                    /* for tradestts end */
                    website('#Mymodalaudittrail .reqststsupdate' ).html(ddmmyytrdsts+' '+timestrdsts);
                }
               
             if(response.transdate)
             {
                 /* for transactiondate start */
                     dtetransdate = response.transdate.split("-");                   
                     dtetransdatespace = response.transdate.split(" ");                    
                     ddmmyytransdate = dtetransdatespace[0];
                     dtetransdate = dtetransdatespace[0].split("-");
                     ddmmyytransdate = dtetransdate[2]+'-'+dtetransdate[1]+'-'+dtetransdate[0];
                /* for transactiondate end */
                 website('#Mymodalaudittrail .reqsttranscmplt').html(ddmmyytransdate);
             }
           
               
               
           }
           else
           {
               website('#Mymodalaudittrail .reqsttrdngsts' ).html('Pending'); 
               website('#Mymodalaudittrail .reqststsupdate' ).html(''); 
               website('#Mymodalaudittrail .reqsttranscmplt').html('');
           }
            
           website('#Mymodalaudittrail').modal('show'); 
        }
        else
        {
            
        }
    },
    complete: function(response)
    {},
    error: function(jqXHR, textStatus, errorThrown)
    {}
  }); 
});

website('body').on("click","#Yesexcreqst",function(e){
  var link =  website('#chckexcptnrequest #pdflink').attr('href');

  website('#reasonexceptn #reasonlink').attr('link',link);
  website("#reasonexceptn").modal('show');

});

website('body').on('click','#Noexcrequest',function(e)
{
    new PNotify({title: 'Alert',
              text: 'You cannot send request',
              type: 'university',
              hide: true,
              styling: 'bootstrap3',
              addclass: 'dark ',
                });
      var base_url = getbaseurl();
      window.location.href = base_url+'tradingrequest';
    setTimeout(function(){window.location.reload();}, 1000);
});

//website('body').on('click','#reasonexe',function(e)
//{
//    var reasonmsg = website("#reason").val();
//    var status = website("#uploadtrade #reasonexe").val(reasonmsg);
//    if(status)
//    {
//        website("#exceptnresionmodal").modal('hide');
//    }
//});

website('body').on('click','#reasonexetrans',function(e)
{
    var reasonmsg = website("#reasontrans").val();
    var approverids = website('#approverid').val();
    var reqname = website('#reqname').val();
    var typeofrequests = website('#Mymodalreq #typeofrequest').val();
    
    if(typeofrequests==3)
    {
        var dpuserid=website("#dpuserid").val();
        var dpusergroup=website("#dpusergroup").val();

    }
    else
    {
       var dpuserid=website("#dpuserid").val();
       var dpusergroup=website("#dpusergroup").val();
    }
    var selrelatives = website('#Mymodalreq #selrelative').val();
    var idofcmps = website('#Mymodalreq #idofcmp').val();
    var nameofcmps = website('#Mymodalreq #nameofcmp').val();
    var noofshares = website('#Mymodalreq #noofshare').val();
    var sectypes = website('#Mymodalreq #sectypeid').val();
    var typeoftranss = website('#Mymodalreq #typeoftrans').val();
    var typeofsave = website('#chckexcptnrequest #Yesexcreqst').attr('requesttype');
    
    /*----additional questions*/
    var reasonoftrans = website("#reasonexceptn #reasonoftrans").val();
    var otherreason = website("#reasonexceptn #otherreason").val();
    var lasttransdate = website("#reasonexceptn #lasttransdate").val();
    var noofshareoftrans = website("#reasonexceptn #noofshareoftrans").val();
    var form2place = website("#Mymodalreq #place").val();
    
    var formdata = {approverid:approverids,reqname:reqname,typeofrequest:typeofrequests,selrelative:selrelatives,idofcmp:idofcmps,nameofcmp:nameofcmps,noofshare:noofshares,sectype:sectypes,typeoftrans:typeoftranss,typeofsave:typeofsave,reasonmsg:reasonmsg,dpuserid:dpuserid,dpusergroup:dpusergroup,reasonoftrans:reasonoftrans,otherreason:otherreason,lasttransdate:lasttransdate,noofshareoftrans:noofshareoftrans,form2place:form2place}
    website.ajax({
        url:'tradingrequest/savecontratrdexceptn',
        data:formdata,
        method:'POST',
        //contentType:'json',
        contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
        dataType:"json",
        cache:false,
        //async:true, /*Cross domain checking*/
        beforeSend: function()
        { website('.preloder_wraper').fadeIn();   },
        uploadProgress: function(event, position, total, percentComplete)
        {   },
        success: function(response, textStatus, jqXHR)
        {
            if(response.logged === true)
            {
                 var baseHref = getbaseurl();
                 var redirecturl=baseHref+"exceptionreq";
                 window.location.href =redirecturl;
                
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
        {   website('.preloder_wraper').fadeOut();   },
        error: function() 
        {   }
    });
});

website('body').on('change','#reasonoftrans', function(e) 
{
    var reasontype = website(this).val();
    if(reasontype == 5)
    {
        website('.otherreason').css('display','block');
    }
    else
    {
        website('.otherreason').css('display','none');
    }
});



function addhtml(clicked)
{
    
    var id = clicked;
    
   
     //alert(datepre);
    if(id == 'adddiv') {
         
        datepicker();
        var getlastid = website('.append').attr('plancntr');

         getlastid = ++getlastid;
         var addhtmlnxt='';

        
        addhtmlnxt += '<div class=" form-group col-md-12 row'+getlastid+' "  id="row'+getlastid+'" >';
         // addhtmlnxt += ' <label for="">Provide, details, of any transaction done in Company’s Security in the last Six months (Except exercise of stock options)</label>';
        addhtmlnxt += ' <div id = "left" class="form-group col-md-4" style="margin-left: -18px;">';
        addhtmlnxt += '<label for="">Date</label>';
        addhtmlnxt += ' <input type="text" class="form-control bootdatepick" id="dateoftrans" name="dateoftrans[]" placeholder="Date" >';
        addhtmlnxt += '</div>';
        addhtmlnxt += ' <div id = "middle" class="form-group col-md-4">';
        addhtmlnxt += '<label for="">Transaction</label>';
        addhtmlnxt += ' <input type="text" class="form-control " id="trans" name="trans[]" placeholder="Transaction" >';
        
        
        addhtmlnxt += '</div>';
        addhtmlnxt +=' <div id = "right" class="form-group col-md-4">';
        addhtmlnxt += ' <label for="">No of Shares</label>';
        addhtmlnxt += '<input type="text" class="form-control " id="sharestrans" name="sharestrans[]" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="No of Shares">';
        addhtmlnxt += ' </div>';
        

        addhtmlnxt += '</div>';
        
        let invalid = '';
        website('input[name^="dateoftrans"]').each(function() {
     
        const date = website(this).val();
        if(!date.length )
        {
           invalid = true;
        }
       
        });

        if(!invalid)
        {
          website('.appenddiv').append(addhtmlnxt);
          website('.append').attr('plancntr',getlastid);
        }
        else
        {
            new PNotify({title: 'Alert',
                    text: 'Please Fill All the Fields First',
                    type: 'university',
                    hide: true, 
                    styling: 'bootstrap3',
                    addclass: 'dark ',
            });  
            
        }
       
       
      }
      else{
      
       var addhtmlnxt='';
      
      }
     

}


function removehtml(clicked)
{

    var rmid = clicked;

    if(rmid == 'remvdiv')
    {


        var count = website('.append').attr('plancntr');
        if(count != 1)
        {
              website('.appenddiv #row'+count).remove();
              website('.append').attr('plancntr',parseInt(count)-1);
        }
        else
        {
             return false;
        }
    }

  
}