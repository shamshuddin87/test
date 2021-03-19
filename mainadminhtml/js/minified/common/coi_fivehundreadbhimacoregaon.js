
website(document).ready(function()
{fetchCoiAllData();});function fetchCoiAllData()
{website.ajax({url:"coi/fetchCoiAllData",method:"POST",contentType:"application/x-www-form-urlencoded; charset=UTF-8",dataType:"json",cache:false,beforeSend:function(){},uploadProgress:function(event,position,total,percentComplete){},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{var addhtmlnxt='';for(var i=0;i<response.data.length;i++)
{var j=i+1;var sentdate=response.data[i]['sent_date']?response.data[i]['sent_date']:"";addhtmlnxt+='<tr class="counter">';addhtmlnxt+='<td width="5%">'+j+'</td>';addhtmlnxt+='<td width="11%">'+response.data[i]['date_added']+'</td>';addhtmlnxt+='<td width="11%">';if(response.data[i]["hrM_processed_status"]=='To Be Send'||response.data[i]["hrM_processed_status"]=='Returned')
{addhtmlnxt+='Pending';}
else
{addhtmlnxt+='Sent';}
addhtmlnxt+='</td>';addhtmlnxt+='<td width="11%" style="text-align:center">';if(response.data[i]["hrM_processed_status"]=="Returned"||response.data[i]["hrM_processed_status"]=="To Be Send"||response.data[i]["deptM_processed_status"]=="Returned")
{addhtmlnxt+='<i class="fa fa-external-link faicon" id="sendtohrM" reqid="'+response.data[i]["id"]+'" title="Send to HR Manager"></i>';}
else
{addhtmlnxt+=response.data[i]["hrM_processed_status"];}
addhtmlnxt+='</td>';addhtmlnxt+='<td width="11%" style="text-align:center">';addhtmlnxt+=response.data[i]["deptM_processed_status"];addhtmlnxt+='</td>';addhtmlnxt+='<td width="11%" style="text-align:center"><i class="fa fa-list-ul faicon" id="audit_trail" reqid="'+response.data[i]["id"]+'" title="Audit Trail"></i></td>';addhtmlnxt+='<td width="11%" style="text-align:center"><i class="fa fa-edit"></i></td>';addhtmlnxt+='<td width="11%" style="text-align:center"><i class="fa fa-trash"></i></td>';addhtmlnxt+='<td width="11%" style="text-align:center">';if(response.data[i]["coi_pdfpath"])
{addhtmlnxt+='<a  href="'+response.data[i]["coi_pdfpath"]+'"  class="downlodthfle" style="color:black;"><span class="glyphicon glyphicon-download-alt floatleft"></span></a>';}
addhtmlnxt+='</td>';addhtmlnxt+='</tr>';}}
else
{addhtmlnxt+='<tr class="counter"><td>Data Not Found</td></tr>';}
website('.allcoidata').html(addhtmlnxt);},complete:function(response){},error:function(jqXHR,textStatus,errorThrown){},});}
website('body').on('click','#sendtohrM',function(e)
{var reqid=website(this).attr("reqid");formdata={reqid:reqid};website.ajax({url:"coi/sendaprvmailtohrmgr",data:formdata,method:"POST",contentType:"application/x-www-form-urlencoded; charset=UTF-8",dataType:"json",cache:false,beforeSend:function()
{website('.preloder_wraper').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});setTimeout(function(){window.location.reload()},2000);}
else
{new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function(){}});});website('body').on('click','#audit_trail',function(e)
{var reqid=website(this).attr("reqid");var formdata={reqid:reqid};website.ajax({url:"coi/fetchAuditTrail",data:formdata,method:"POST",contentType:"application/x-www-form-urlencoded; charset=UTF-8",dataType:"json",cache:false,beforeSend:function(){},uploadProgress:function(event,position,total,percentComplete){},success:function(response,textStatus,jqXHR)
{website("#auditTrailModal").modal("show");if(response.logged===true)
{var addhtmlnxt='';for(var i=0;i<response.data.length;i++)
{var j=i+1;addhtmlnxt+='<tr class="counter">';addhtmlnxt+='<td width="5%">'+j+'</td>';addhtmlnxt+='<td width="10%">'+response.data[i]['action']+'</td>';addhtmlnxt+='<td width="10%">'+response.data[i]['action_date']+'</td>';addhtmlnxt+='<td width="10%">'+response.data[i]['status']+'</td>';addhtmlnxt+='<td width="10%">'+response.data[i]['recommendation']+'</td>';addhtmlnxt+='</tr>';}}
else
{addhtmlnxt+='<tr class="counter"><td colspan="5">No Audit Trail Found!!!</td></tr>';}
website('#audittrail').html(addhtmlnxt);},complete:function(response){},error:function(jqXHR,textStatus,errorThrown){},});});;