
subuserapproval();function subuserapproval()
{var noofrows=website('#noofrows').val();var pagenum=website('#pagenum').val();var redirecturl=website('#redirecturl').val();var formdata={noofrows:noofrows,pagenum:pagenum,redirecturl:redirecturl};website.ajax({url:'exceptionreq/excesubuserapproval',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged==true)
{var addhtmlnxt='';for(var i=0;i<response.data.length;i++)
{var j=i+1;var demat_acc_no=response.data[i].demat_acc_no?response.data[i].demat_acc_no:'';var sectype=response.data[i].security_type?response.data[i].security_type:'';var name_of_company=response.data[i].mycompany?response.data[i].mycompany:''
var no_of_shares=response.data[i].no_of_shares?response.data[i].no_of_shares:'';var nameofrelative=response.data[i].name?response.data[i].name:'';var relationship=response.data[i].relationship?response.data[i].relationship:'';var name=response.data[i].name_of_requester?response.data[i].name_of_requester:'';var type_of_transaction=response.data[i].transaction?response.data[i].transaction:'';var price_per_share=response.data[i].price_per_share?response.data[i].price_per_share:''
var total_amount=response.data[i].total_amount?response.data[i].total_amount:'';var date_added=response.data[i].date_added?response.data[i].date_added:'';var date_modified=response.data[i].date_modified?response.data[i].date_modified:'';var transaction_date=response.data[i].date_of_transaction?response.data[i].date_of_transaction:'';var trading_date=response.data[i].trading_date?response.data[i].trading_date:'';var send_status=response.data[i].send_status;var approved_status=response.data[i].approved_status;var contraexcapvsts=response.data[i].contraexcapvsts?response.data[i].contraexcapvsts:'';var typeofrequest=response.data[i].request_type?response.data[i].request_type:'';var message=response.data[i].rejmsg?response.data[i].rejmsg:'';var trading_status=response.data[i].trading_status?response.data[i].trading_status:'';var user_group=response.chkusergroup?response.chkusergroup:'';var excep_approv=response.data[i].excepapp_status?response.data[i].excepapp_status:'';addhtmlnxt+='<tr class="counter" tempid="'+response.data[i].tradeid+'" reqid="'+response.data[i].id+'" >';addhtmlnxt+='<td width="15%">'+j+'</td>';addhtmlnxt+='<td width="15%">'+name+'</td>';addhtmlnxt+='<td width="15%">'+sectype+'</td>';addhtmlnxt+='<td width="15%">'+name_of_company+'</td>';addhtmlnxt+='<td width="15%">'+type_of_transaction+'</td>';addhtmlnxt+='<td width="15%">'+no_of_shares+'</td>';addhtmlnxt+='<td width="15%">'+typeofrequest+'</td>';addhtmlnxt+='<td width="15%">'+nameofrelative+'</td>';addhtmlnxt+='<td width="15%">'+relationship+'</td>';if(response.data[i].sent_contraexeaprvl==1)
{if(trading_status==1)
{var file=response.data[i].file?response.data[i].file:'File Not FounD On Server';file=file+'<p  class="gettradestatus" reqid="'+response.data[i].tradeid+'"><i class="fa fa-line-chart" style="font-size:18px;color:green;"></p>';}
else if(trading_status==0)
{var file='';}
if(contraexcapvsts==1)
{addhtmlnxt+='<td width="15%"><i class="fa fa-check-circle" style="font-size:18px;color:green;">Approved</i></td>';}
else if(contraexcapvsts==2)
{addhtmlnxt+='<td width="15%" class="getmsg" mymessage="'+messagepersnl+'"><i class="fa fa-close" style="font-size:18px;color:red;">Rejected</i></td>';}
else
{addhtmlnxt+='<td width="15%">Not Approved</td>';}}
else
{if(trading_status==1||trading_status=='')
{var file=response.data[i].file?response.data[i].file:'File Not FounD On Server';file=file+'<p  class="gettradestatus" reqid="'+response.data[i].tradeid+'"><i class="fa fa-line-chart" style="font-size:18px;color:green;"></p>';}
else if(trading_status==0)
{var file=response.data[i].file?response.data[i].file:'<p style="color:red;">Trading Not Done</p>';}
if(excep_approv==1)
{addhtmlnxt+='<td width="15%"><i class="fa fa-check-circle" style="font-size:18px;color:green;">Approved</i></td>';}
else if(excep_approv==2)
{addhtmlnxt+='<td width="15%" class="getmsg" mymessage="'+message+'"><i class="fa fa-close" style="font-size:18px;color:red;">Rejected</i></td>';}
else
{addhtmlnxt+='<td width="15%">Not Approved</td>';}}
addhtmlnxt+='<td width="15%">'+transaction_date+'</td>';addhtmlnxt+='<td width="15%">'+date_modified+'</td>';addhtmlnxt+='<td width="15%">'+file+'</td>';addhtmlnxt+='<td width="15%"><i class="fa fa-bar-chart viewexcprequsttrail" trdeid="'+response.data[i].tradeid+'" rqstid="'+response.data[i].id+'"></i></td>';if(response.data[i].sent_contraexeaprvl==1)
{addhtmlnxt+='<td width="15%"><i class="fa fa-comments-o exereason" type="contra" rqstid="'+response.data[i].id+'" trdeid="'+response.data[i].tradeid+'" ></i></td>';if(contraexcapvsts==1)
{if(user_group==2)
{addhtmlnxt+='<td width="15%"><i class="fa fa-trash delapprove" perdelid="'+response.data[i].id+'" type=personal ></i></td>';}
else
{addhtmlnxt+='<td width="15%"></td>';}}
else if(contraexcapvsts==2)
{if(user_group==2)
{addhtmlnxt+='<td width="15%"><i class="fa fa-trash delapprove" perdelid="'+response.data[i].id+'" type=personal></i>';}
else
{addhtmlnxt+='<td width="15%"></td>';}}
else
{if(user_group==2)
{addhtmlnxt+='<td width="15%"><i class="fa fa-trash delapprove" perdelid="'+response.data[i].id+'" type=personal style="font-size:20px;"></i>'+'<input type="checkbox" class="sendchkbox" chkval="'+response.data[i].tradeid+'" chkval2="'+response.data[i].id+'" name="sendapprove" value="'+response.data[i].tradeid+'"><button class="rejectbutton"  rejectid="'+response.data[i].id+'" type=personal><i class="fa fa-close"></i></button></td>';}
else
{addhtmlnxt+='<td width="15%"><input type="checkbox" class="sendchkbox" chkval="'+response.data[i].tradeid+'" chkval2="'+response.data[i].id+'" name="sendapprove" value="'+response.data[i].tradeid+'"><button class="rejectbutton"  rejectid="'+response.data[i].id+'" type=personal><i class="fa fa-close"></i></button></td>';}}}
else
{addhtmlnxt+='<td width="15%"></td>';if(excep_approv==1)
{if(user_group==2)
{addhtmlnxt+='<td width="15%"><i class="fa fa-trash delapprove" perdelid="'+response.data[i].tradeid+'" ></i></td>';}
else
{addhtmlnxt+='<td width="15%"></td>';}}
else if(excep_approv==2)
{if(user_group==2)
{addhtmlnxt+='<td width="15%"><i class="fa fa-trash delapprove" perdelid="'+response.data[i].tradeid+'"></i>';}
else
{addhtmlnxt+='<td width="15%"></td>';}}
else
{if(user_group==2)
{addhtmlnxt+='<td width="15%"><i class="fa fa-trash delapprove" perdelid="'+response.data[i].tradeid+'" style="font-size:20px;"></i>'+'<input type="checkbox" class="sendchkbox" chkval="'+response.data[i].tradeid+'" chkval2="'+response.data[i].id+'" name="sendapprove" value="'+response.data[i].tradeid+'"><button class="rejectbutton"  rejectid="'+response.data[i].tradeid+'"><i class="fa fa-close"></i></button></td>';}
else
{addhtmlnxt+='<td width="15%"><input type="checkbox" class="sendchkbox" chkval="'+response.data[i].tradeid+'" chkval2="'+response.data[i].id+'" name="sendapprove" value="'+response.data[i].tradeid+'"><button class="rejectbutton"  rejectid="'+response.data[i].tradeid+'"><i class="fa fa-close"></i></button></td>';}}}
addhtmlnxt+='</tr>';}}
else
{addhtmlnxt+='<td width="15%" colspan="13" style="text-align:center;">Data Not Found..!!!</td>';}
website(".viewreqtable").html(addhtmlnxt);website('.paginationmn').html(response.pgnhtml);},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});}
website("body").on("click","#exceptapproval",function(e)
{var ckkval2='';var selected_value=[];website(".sendchkbox:checked").each(function(){selected_value.push(website(this).val());ckkval2=website(this).attr('chkval2');});if(selected_value!=''){website.ajax({url:'exceptionreq/exceacceptapprovel',data:{selctedid:selected_value,ckkval2:ckkval2},method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{website('#approvedreq').modal('hide');subuserapproval();new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}
else{new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}})}
else{new PNotify({title:'Alert',text:"You Should Select At Least One Request",type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}});website("body").on("click",".delapprove",function(e){var delid=website(this).attr('perdelid');var reqtype=website(this).attr('type');website("#approvedel").attr('tempid',delid)
website("#approvedel").attr('reqtype',reqtype)
website('#approvdel').modal('show');});website("body").on("click","#approvedel",function(e){var delid=website(this).attr('tempid');var reqtype=website(this).attr('reqtype');website.ajax({url:'exceptionreq/deletepersrequest',data:{delid:delid,reqtype:reqtype},method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged==true)
{subuserapproval();website('#approvdel').modal('hide');new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}
else{new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});});website("body").on("click",".rejectbutton",function(e){var rejectid=website(this).attr('rejectid');website('#rejectapprov').attr('rejectid',rejectid)
website('#commentmodal').modal('show');});website("body").on("click","#rejectapprov",function(e){var message=website("#rejectmessage").val();var rejectid=website('#rejectapprov').attr('rejectid');website.ajax({url:'exceptionreq/excerejectapprovel',data:{message:message,rejectid:rejectid},method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged==true)
{subuserapproval();website('#commentmodal').modal('hide');new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}
else{new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});});website("body").on("click",".getmsg",function(e){var mymessage=website(this).attr('mymessage');website('#mymess').val(mymessage);website('#showcomment').modal('show');});website('body').on('click','.paginationmn li',function(e)
{var rscrntpg=website(this).attr('p');website('.personaldetails .panel.panel-white #pagenum').val(rscrntpg);subuserapproval();});website('body').on('change','#noofrows',function(e)
{var itntfr=website(this).closest('.itntfr').attr('itntfr');subuserapproval();});website('body').on('click','.go_button',function(e)
{var rscrntpg=website('.personaldetails .gotobtn').val();website('.personaldetails .panel.panel-white #pagenum').val(rscrntpg);subuserapproval();});website("body").on("click",".gettradestatus",function(e){var reqid=website(this).attr('reqid');website.ajax({url:'exceptionreq/getsuccesstrade',data:{reqid:reqid},method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged==true){var noofshare=response.data.no_of_share?response.data.no_of_share:'Not Found';var price_per_share=response.data.price_per_share?response.data.price_per_share:'Not Found';var total_amount=response.data.total_amount?response.data.total_amount:'Not Found';var date_of_transaction=response.data.date_of_transaction?response.data.date_of_transaction:'Not Found';var demat_acc_no=response.data.demat_acc_no?response.data.demat_acc_no:'Not Found';var addhtmlnxt='<tr>';addhtmlnxt+='<td>'+noofshare+'</td>';addhtmlnxt+='<td>'+price_per_share+'</td>';addhtmlnxt+='<td>'+total_amount+'</td>';addhtmlnxt+='<td>'+date_of_transaction+'</td>';addhtmlnxt+='<td>'+demat_acc_no+'</td>';addhtmlnxt+='</tr>';website('#myModal .statustable').html(addhtmlnxt)
website('#myModal').modal('show');}
else{new PNotify({title:'Alert',text:"Something Went To Wrong",type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}}});});website('body').on("click",".viewexcprequsttrail",function(e){var rqstid=website(this).attr('rqstid');var trdeid=website(this).attr('trdeid');var formdata={rqstid:rqstid,trdeid:trdeid}
website.ajax({url:'exceptionreq/fetchexcereqtrail',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{if(response.persnreq[0].sent_contraexeaprvl!=1)
{dteadded=response.data[0].date_added.split("-");dteaddedspace=response.data[0].date_added.split(" ");ddmmyyadded=dteaddedspace[0];dteadded=dteaddedspace[0].split("-");ddmmyyadded=dteadded[2]+'-'+dteadded[1]+'-'+dteadded[0];timesadded=dteaddedspace[1];dtemodified=response.data[0].date_modified.split("-");dtemodifdspace=response.data[0].date_modified.split(" ");ddmmyymodified=dtemodifdspace[0];dtemodified=dtemodifdspace[0].split("-");ddmmyymodified=dtemodified[2]+'-'+dtemodified[1]+'-'+dtemodified[0];timesmodified=dtemodifdspace[1];website('#Mymodalaudittrail .reqstcreateddte').html(ddmmyyadded+' '+timesadded);website('#Mymodalaudittrail .reqstupdteddte').html(ddmmyymodified+' '+timesmodified);if(response.data[0].pdffilepath)
{website('#Mymodalaudittrail .pdfpath').html('<a href="'+response.data[0].pdffilepath+'" target="_blank"><i class="fa fa-download" style="font-size:15px;color:black;"></i></a>');}
else
{website('#Mymodalaudittrail .pdfpath').html('');}
if(response.data[0].excep_approv==1)
{if(response.data[0].excepsendaprv_date)
{dtesendaprv=response.data[0].excepsendaprv_date.split("-");dtesendaprvspace=response.data[0].excepsendaprv_date.split(" ");ddmmyysendaprv=dtesendaprvspace[0];dtesendaprv=dtesendaprvspace[0].split("-");ddmmyysendaprv=dtesendaprv[2]+'-'+dtesendaprv[1]+'-'+dtesendaprv[0];timessendaprv=dtesendaprvspace[1];website('#Mymodalaudittrail .reqstsendapprv').html(ddmmyysendaprv+' '+timessendaprv);}}
else
{website('#Mymodalaudittrail .reqstsendapprv').html('');}
if(response.data[0].excepapp_status==1)
{if(response.data[0].excepapprv_date)
{dteaprv=response.data[0].excepapprv_date.split("-");dteaprvspace=response.data[0].excepapprv_date.split(" ");ddmmyyaprv=dteaprvspace[0];dteaprv=dteaprvspace[0].split("-");ddmmyyaprv=dteaprv[2]+'-'+dteaprv[1]+'-'+dteaprv[0];timesaprv=dteaprvspace[1];website('#Mymodalaudittrail .reqstapprvd').html(ddmmyyaprv+' '+timesaprv);}}
else
{website('#Mymodalaudittrail .reqstapprvd').html('');}
if(response.persnreq[0].trading_status==1)
{website('#Mymodalaudittrail .reqsttrdngsts').html('Completed');if(response.persnreq[0].tradestatus_date)
{dtetrdsts=response.persnreq[0].tradestatus_date.split("-");dtetrdstsspace=response.persnreq[0].tradestatus_date.split(" ");ddmmyytrdsts=dtetrdstsspace[0];dtetrdsts=dtetrdstsspace[0].split("-");ddmmyytrdsts=dtetrdsts[2]+'-'+dtetrdsts[1]+'-'+dtetrdsts[0];timestrdsts=dtetrdstsspace[1];website('#Mymodalaudittrail .reqststsupdate').html(ddmmyytrdsts+' '+timestrdsts);}
if(response.data[0].date_of_transaction)
{dtetransdate=response.data[0].date_of_transaction.split("-");dtetransdatespace=response.data[0].date_of_transaction.split(" ");ddmmyytransdate=dtetransdatespace[0];dtetransdate=dtetransdatespace[0].split("-");ddmmyytransdate=dtetransdate[2]+'-'+dtetransdate[1]+'-'+dtetransdate[0];website('#Mymodalaudittrail .reqsttranscmplt').html(ddmmyytransdate);}}
else
{website('#Mymodalaudittrail .reqsttrdngsts').html('Pending');website('#Mymodalaudittrail .reqststsupdate').html('');website('#Mymodalaudittrail .reqsttranscmplt').html('');}}
else
{dteadded=response.persnreq[0].date_added.split("-");dteaddedspace=response.persnreq[0].date_added.split(" ");ddmmyyadded=dteaddedspace[0];dteadded=dteaddedspace[0].split("-");ddmmyyadded=dteadded[2]+'-'+dteadded[1]+'-'+dteadded[0];timesadded=dteaddedspace[1];dtemodified=response.persnreq[0].date_modified.split("-");dtemodifdspace=response.persnreq[0].date_modified.split(" ");ddmmyymodified=dtemodifdspace[0];dtemodified=dtemodifdspace[0].split("-");ddmmyymodified=dtemodified[2]+'-'+dtemodified[1]+'-'+dtemodified[0];timesmodified=dtemodifdspace[1];if(response.persnreq[0].sent_contraexeaprvl==1)
{if(response.persnreq[0].apprv_contraexedte)
{var ddmmyysendaprv='';var timessendaprv='';dtesendaprv=response.persnreq[0].apprv_contraexedte.split("-");dtesendaprvspace=response.persnreq[0].apprv_contraexedte.split(" ");ddmmyysendaprv=dtesendaprvspace[0];dtesendaprv=dtesendaprvspace[0].split("-");ddmmyysendaprv=dtesendaprv[2]+'-'+dtesendaprv[1]+'-'+dtesendaprv[0];timessendaprv=dtesendaprvspace[1];website('#Mymodalaudittrail .reqstsendapprv').html(ddmmyysendaprv+' '+timessendaprv);}}
else
{website('#Mymodalaudittrail .reqstsendapprv').html('');}
if(response.persnreq[0].contraexcapvsts==1)
{if(response.persnreq[0].contraexcapvdte)
{dteaprv=response.persnreq[0].contraexcapvdte.split("-");dteaprvspace=response.persnreq[0].contraexcapvdte.split(" ");ddmmyyaprv=dteaprvspace[0];dteaprv=dteaprvspace[0].split("-");ddmmyyaprv=dteaprv[2]+'-'+dteaprv[1]+'-'+dteaprv[0];timesaprv=dteaprvspace[1];website('#Mymodalaudittrail .reqstapprvd').html(ddmmyyaprv+' '+timesaprv);}}
else
{website('#Mymodalaudittrail .reqstapprvd').html('');}
website('#Mymodalaudittrail .reqstcreateddte').html(ddmmyyadded+' '+timesadded);website('#Mymodalaudittrail .reqstupdteddte').html(ddmmyymodified+' '+timesmodified);if(response.persnreq[0].trading_status==1)
{website('#Mymodalaudittrail .reqsttrdngsts').html('Completed');if(response.persnreq[0].tradestatus_date)
{dtetrdsts=response.persnreq[0].tradestatus_date.split("-");dtetrdstsspace=response.persnreq[0].tradestatus_date.split(" ");ddmmyytrdsts=dtetrdstsspace[0];dtetrdsts=dtetrdstsspace[0].split("-");ddmmyytrdsts=dtetrdsts[2]+'-'+dtetrdsts[1]+'-'+dtetrdsts[0];timestrdsts=dtetrdstsspace[1];website('#Mymodalaudittrail .reqststsupdate').html(ddmmyytrdsts+' '+timestrdsts);}
if(response.data[0].date_of_transaction)
{dtetransdate=response.data[0].date_of_transaction.split("-");dtetransdatespace=response.data[0].date_of_transaction.split(" ");ddmmyytransdate=dtetransdatespace[0];dtetransdate=dtetransdatespace[0].split("-");ddmmyytransdate=dtetransdate[2]+'-'+dtetransdate[1]+'-'+dtetransdate[0];website('#Mymodalaudittrail .reqsttranscmplt').html(ddmmyytransdate);}}
else
{website('#Mymodalaudittrail .reqsttrdngsts').html('Pending');website('#Mymodalaudittrail .reqststsupdate').html('');website('#Mymodalaudittrail .reqsttranscmplt').html('');}}
website('#Mymodalaudittrail').modal('show');}
else
{}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});});website("body").on("click",".exereason",function(e){var reqid=website(this).attr('rqstid');var trdeid=website(this).attr('trdeid');var type=website(this).attr('type');var formdata={reqid:reqid,trdeid:trdeid,type:type}
website.ajax({url:'exceptionreq/fetchreasonofexe',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged==true)
{website('#showexereason #exereason').val(response.data.exception_reason)
website('#showexereason').modal('show');}
else
{new PNotify({title:'Alert',text:'Something went wrong',type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});});;