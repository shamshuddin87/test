

/* ===================== Pagination Start ===================== */
website('body').on('click','.paginationmn li', function(e) 
{
    var rscrntpg = website(this).attr('p');
    //alert(rscrntpg);
    website('.panel.panel-white #pagenum').val(rscrntpg);
    
    subuserapproval();    
});
website('body').on('change','#noofrows', function(e) 
{
    website('.pagechnum').val(1);
    //alert(rscrntpg);
    
    subuserapproval();
});
website('body').on('click','.go_button', function(e) 
{
    var rscrntpg = website('.gotobtn').val();
    //alert(rscrntpg);
    website('.panel.panel-white #pagenum').val(rscrntpg);
    
    subuserapproval();
});

website('body').on('change','#filterstatus', function(e) 
{     
    subuserapproval();
});
/* ===================== Pagination End ===================== */


subuserapproval();
function subuserapproval()
{
    var noofrows = website('#noofrows').val(); 
    var pagenum = website('#pagenum').val();
    var status = website('#filterstatus').val();
    
    var formdata = {noofrows:noofrows,pagenum:pagenum,status:status};
   website.ajax({
        url:'tradingrequest/subuserapproval',
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
                    //console.log(response.dept);return false; 
                    var addhtmlnxt='';
                    for(var i=0;i<response.data.length;i++)
                    {
                        var j=i+1;
                        var demat_acc_no=response.data[i].demat_acc_no?response.data[i].demat_acc_no:'';
                        var sectype=response.data[i].security_type?response.data[i].security_type:'';
                        var name_of_company=response.data[i].mycompany?response.data[i].mycompany:'';
                        var no_of_shares=response.data[i].no_of_shares?response.data[i].no_of_shares:'';
                        var nameofrelative=response.data[i].name?response.data[i].name:'';
                        var relationship=response.data[i].relationship?response.data[i].relationship:'';
                        var name=response.data[i].name_of_requester?response.data[i].name_of_requester:'';
                        var type_of_transaction=response.data[i].transaction?response.data[i].transaction:'';
                        var price_per_share=response.data[i].price_per_share?response.data[i].price_per_share:'';
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
                        var typeofrequest=response.data[i].request_type?response.data[i].request_type:'';

                        var message=response.data[i].rejected_message?response.data[i].rejected_message:'';
                        var trading_status=response.data[i].trading_status?response.data[i].trading_status:'';
                        var user_group=response.chkusergroup?response.chkusergroup:'';
                        // console.log(trading_status);
                      
                      
                        if(trading_status==1)
                        {
                            var file='<p  class="gettradestatus" reqid="'+response.data[i].id+'"><i class="fa fa-line-chart" style="font-size:15px;color:green;"></i></p>';
                        }
                        else if(trading_status=='')
                        {
                            var file=response.data[i].file?response.data[i].file:'Not Uploaded';
                        }
                        else
                        {
                            var file=response.data[i].file?response.data[i].file:'<p style="color:red;"><i class="fa fa-line-chart" style="font-size:15px;color:red;"></i></p>';
                        }
                              
                        addhtmlnxt += '<tr class="counter" tempid="'+response.data[i].id+'" >';

                        /*addhtmlnxt += '<td>'+j+'</td>';*/
                        addhtmlnxt += '<td>'+name+'</td>';
                        addhtmlnxt += '<td>'+sectype+'</td>';
                        addhtmlnxt += '<td>'+name_of_company+'</td>';
                        addhtmlnxt += '<td>'+type_of_transaction+'</td>';
                        addhtmlnxt += '<td>'+no_of_shares+'</td>';
                        addhtmlnxt += '<td>'+typeofrequest+'</td>';
                        addhtmlnxt += '<td>'+nameofrelative+'</td>';
                        addhtmlnxt += '<td>'+relationship+'</td>';
                                   
                        if(approved_status==1){
                            addhtmlnxt += '<td><i class="fa fa-check-circle" style="font-size:15px;color:green;"></i></td>';
                        }
                        else if(approved_status==2){
                            addhtmlnxt += '<td class="getmsg" mymessage="'+message+'"><i class="fa fa-close" style="font-size:15px;color:red;"></i></td>';
                        }
                        else{
                            addhtmlnxt += '<td style="color:#F44336;">Not Approved</td>';
                        }
                                      
                        addhtmlnxt += '<td>'+trading_date+'</td>';
                        addhtmlnxt += '<td>'+date_added+'</td>';
                        //                                       addhtmlnxt += '<td>'+date_modified+'</td>';
                        addhtmlnxt += '<td>'+file+'</td>';
                        addhtmlnxt+='<td><i class="fa fa-bar-chart viewrequsttrail" rqstid="'+response.data[i].id+'"></i></td>';
                      
                        if(approved_status==1)
                        { 
                            if(user_group==2)
                            {
                                addhtmlnxt+='<td><i class="fa fa-trash delapprove" perdelid="'+response.data[i].id+'" style="font-size:15px;"></i></td>';
                            }
                            else
                            {
                                addhtmlnxt+='<td></td>';
                            }
                        }
                        else if(approved_status==2)
                        {
                            if(user_group==2)
                            {
                                addhtmlnxt+='<td><i class="fa fa-trash delapprove" perdelid="'+response.data[i].id+'" style="font-size:15px;"></i>';
                            }
                            else
                            {
                                addhtmlnxt+='<td></td>';
                            }
                        }
                        else
                        {
                            if(user_group==2)
                            {
                                addhtmlnxt+='<td><i class="fa fa-trash delapprove" perdelid="'+response.data[i].id+'" style="font-size:15px;"></i>'+'<input type="checkbox" class="sendchkbox" chkval="'+response.data[i].id+'" name="sendapprove" value="'+response.data[i].id+'"><button class="rejectbutton"  rejectid="'+response.data[i].id+'"><i class="fa fa-close"></i></button></td>';
                            }
                            else
                            { 
                                addhtmlnxt+='<td><input type="checkbox" class="sendchkbox" chkval="'+response.data[i].id+'" name="sendapprove" value="'+response.data[i].id+'"><button class="rejectbutton"  rejectid="'+response.data[i].id+'"><i class="fa fa-close"></i></button></td>';
                            }
                        }
                                       
                        addhtmlnxt+='</tr>';
                         
                    }                          
                }
                else
                {
                    addhtmlnxt += '<tr><td colspan="13" style="text-align:center;">Data Not Found..!!!</td></tr>';
                }
                       
                website(".viewreqtable").html(addhtmlnxt);
                //website('#datable').DataTable();
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


website("body").on("click","#acceeptappr",function(e){
 var selected_value = []; // initialize empty array 
    website(".sendchkbox:checked").each(function(){
        selected_value.push(website(this).val());
    });
    website('#approvedreq #selctedid').val(selected_value);
    website('#approvedreq #selctedidlength').val(selected_value.length);
    website('#approvedreq').modal('show');
});

website("body").on("click","#aprvsubmit",function(e)
{
   var selctedid = website('#approvedreq #selctedid').val();
   var selected_value = website('#approvedreq #selctedidlength').val();
   // var dateoftrans = website('#approvedreq #tradedate').val();
    
   if(selected_value > 0){
    website.ajax({
                  url:'tradingrequest/acceptapprovel',
                  data:{selctedid:selctedid},
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
                        if(response.logged===true)
                        {
                            website('#approvedreq').modal('hide');
                           subuserapproval();
                          
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
                    website('.preloder_wraper').fadeOut();
                   },
                  error: function(jqXHR, textStatus, errorThrown)
                  {   }
          })

}
else{
         new PNotify({title: 'Alert',
            text:"You Should Select At Least One Request",
            type: 'university',
            hide: true,
            styling: 'bootstrap3',
            addclass: 'dark ',
          });
      }
});


website("body").on("click",".delapprove",function(e){

 var delid=website(this).attr('perdelid');
 website("#approvedel").attr('tempid',delid)
  website('#approvdel').modal('show');
});


website("body").on("click","#approvedel",function(e){
  var delid=website(this).attr('tempid');
  // console.log(delid);
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

                            subuserapproval();
                            website('#approvdel').modal('hide');
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


website("body").on("click",".rejectbutton",function(e){
  var rejectid=website(this).attr('rejectid');
  website('#rejectapprov').attr('rejectid',rejectid)
   website('#commentmodal').modal('show');
});
website("body").on("click","#rejectapprov",function(e){
var message=website("#rejectmessage").val();
var rejectid=website('#rejectapprov').attr('rejectid');

   website.ajax({
                  url:'tradingrequest/rejectapprovel',
                  data:{message:message,rejectid:rejectid},
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

                            subuserapproval();
                            website('#commentmodal').modal('hide');
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
website("body").on("click",".getmsg",function(e){ 
      var mymessage=website(this).attr('mymessage');
      // console.log(mymessage);
     // alert();
     website('#mymess').val(mymessage);
     website('#showcomment').modal('show');
        
}); 



website("body").on("click",".gettradestatus",function(e){

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
                     var addhtmlnxt='';
                     // console.log(response.data);return false;
                      if(response.logged==true){
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
                          website('#myModal .statustable').html(addhtmlnxt)
                          website('#myModal').modal('show');

                      }
                      else{
                                  new PNotify({title: 'Alert',
                                  text:"Something Went To Wrong",
                                  type: 'university',
                                  hide: true,
                                 styling: 'bootstrap3',
                                 addclass: 'dark ',
                          });
                      }
                   }
    });
});


website('body').on("click",".viewrequsttrail",function(e){
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