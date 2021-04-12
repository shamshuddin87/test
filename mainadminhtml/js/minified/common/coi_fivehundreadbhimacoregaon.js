
website(document).ready(function()
{fetchCoiAllData();});website('body').on('click','.paginationmn li',function(e)
{var rscrntpg=website(this).attr('p');website('.panel.panel-white #pagenum').val(rscrntpg);fetchCoiAllData();});website('body').on('change','#noofrows',function(e)
{fetchCoiAllData();});website('body').on('click','.go_button',function(e)
{var rscrntpg=website('.gotobtn').val();website('.panel.panel-white #pagenum').val(rscrntpg);var lastPage=website('.pagination .paginateul li').last().attr('p');if(parseInt(rscrntpg)<=parseInt(lastPage))
{fetchCoiAllData();}});function fetchCoiAllData()
{var noofrows=website('#noofrows').val();var pagenum=website('#pagenum').val();var formdata={noofrows:noofrows,pagenum:pagenum}
website.ajax({url:"coi/fetchCoiAllData",data:formdata,method:"POST",contentType:"application/x-www-form-urlencoded; charset=UTF-8",dataType:"json",cache:false,beforeSend:function(){},uploadProgress:function(event,position,total,percentComplete){},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{var addhtmlnxt='';for(var i=0;i<response.data.length;i++)
{var j=i+1;var sentdate=response.data[i]['sent_date']?response.data[i]['sent_date']:"";addhtmlnxt+='<tr class="counter">';addhtmlnxt+='<td width="5%">'+j+'</td>';addhtmlnxt+='<td width="11%">'+response.data[i]['date_added']+'</td>';addhtmlnxt+='<td width="11%" style="text-align:center">';if(response.data[i]["hrM_processed_status"]=="Returned"||response.data[i]["hrM_processed_status"]=="To Be Send"||response.data[i]["deptM_processed_status"]=="Returned")
{addhtmlnxt+='<i class="fa fa-external-link faicon" id="sendtohrM" reqid="'+response.data[i]["id"]+'" title="Send to HR Manager"></i>';}
else
{addhtmlnxt+=response.data[i]["hrM_processed_status"];}
addhtmlnxt+='</td>';addhtmlnxt+='<td width="11%" style="text-align:center">';addhtmlnxt+=response.data[i]["deptM_processed_status"];addhtmlnxt+='</td>';addhtmlnxt+='<td width="11%" style="text-align:center"><i class="fa fa-list-ul faicon" id="audit_trail" reqid="'+response.data[i]["id"]+'" title="Audit Trail"></i></td>';addhtmlnxt+='<td width="11%" style="text-align:center">';if(response.data[i]["hrM_processed_status"]=="Returned"||response.data[i]["hrM_processed_status"]=="To Be Send"||response.data[i]["deptM_processed_status"]=="Returned")
{addhtmlnxt+='<i class="fa fa-edit coiedit" reqid="'+response.data[i]["id"]+'" title="Edit Entry"></i>';}
addhtmlnxt+='</td>';addhtmlnxt+='<td width="11%" style="text-align:center">';if(response.data[i]["hrM_processed_status"]=="Returned"||response.data[i]["hrM_processed_status"]=="To Be Send"||response.data[i]["deptM_processed_status"]=="Returned")
{addhtmlnxt+='<i class="fa fa-trash coidelete" reqid="'+response.data[i]["id"]+'" title="Delete Entry"></i>';}
addhtmlnxt+='</td>';addhtmlnxt+='<td width="11%" style="text-align:center">';if(response.data[i]["coi_pdfpath"])
{addhtmlnxt+='<a  href="'+response.data[i]["coi_pdfpath"]+'" target="_blank" class="downlodthfle" style="color:black;"><span class="glyphicon glyphicon-download-alt floatleft"></span></a>';}
addhtmlnxt+='</td>';addhtmlnxt+='</tr>';}}
else
{addhtmlnxt+='<tr class="counter"><td>Data Not Found</td></tr>';}
website('.paginationmn').html(response.pgnhtml);website('.allcoidata').html(addhtmlnxt);},complete:function(response){},error:function(jqXHR,textStatus,errorThrown){},});}
website("body").on("click",".coiedit",function(e){var coi_id=website(this).attr('reqid');coi_id=btoa(coi_id);var baseHref=getbaseurl();setTimeout(function(){window.location.href=baseHref+'coi/editcoi?coiid='+coi_id;},1000);});website("body").on("click",".coidelete",function(e){var coi_id=website(this).attr('reqid');website('#modaldelcoi #deleteid').val(coi_id);website('#modaldelcoi').modal('show');});website('body').on('click','#confirmdeletereq',function(){var coi_id=website('#deleteid').val();website.ajax({url:'coi/deletecoireq',data:{coi_id:coi_id},method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged==true)
{website('#modaldelcoi').modal('hide');new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});fetchCoiAllData();}
else
{new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});});website('body').on('click','#sendtohrM',function(e)
{var reqid=website(this).attr("reqid");website('#sendcoiforapproval #coi_id').val(reqid);website('#sendcoiforapproval').modal('show');});website('body').on('click','.sendcoiform',function(e)
{var reqid=website('#sendcoiforapproval #coi_id').val();formdata={reqid:reqid};website.ajax({url:"coi/sendaprvmailtohrmgr",data:formdata,method:"POST",contentType:"application/x-www-form-urlencoded; charset=UTF-8",dataType:"json",cache:false,beforeSend:function()
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