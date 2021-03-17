
website(document).ready(function()
{fetchCoiAllData();});function fetchCoiAllData()
{website.ajax({url:"coi/fetchCoiAllData",method:"POST",contentType:"application/x-www-form-urlencoded; charset=UTF-8",dataType:"json",cache:false,beforeSend:function(){},uploadProgress:function(event,position,total,percentComplete){},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{var addhtmlnxt='';for(var i=0;i<response.data.length;i++)
{var j=i+1;var sentdate=response.data[i]['sent_date']?response.data[i]['sent_date']:"";addhtmlnxt+='<tr class="counter">';addhtmlnxt+='<td width="5%">'+j+'</td>';addhtmlnxt+='<td width="11%">'+response.data[i]['date_added']+'</td>';addhtmlnxt+='<td width="11%">';if(response.data[i]['sent_status']=='1')
{addhtmlnxt+='Sent';}
else
{addhtmlnxt+='Pending';}
addhtmlnxt+='</td>';addhtmlnxt+='<td width="11%" style="text-align:center">';addhtmlnxt+='<i class="fa fa-external-link faicon" id="sendtohrM" reqid="'+response.data[i]["id"]+'" title="Send to HR Manager"></i>';addhtmlnxt+='&nbsp;&nbsp;&nbsp;<i class="fa fa-check-circle-o faicon" style="font-size:20px;" title="Already sent"></i>';addhtmlnxt+='</td>';addhtmlnxt+='<td width="11%" style="text-align:center">';addhtmlnxt+='<i class="fa fa-external-link faicon sendtodeptM" reqid="'+response.data[i]["id"]+'" title="Send to Department Manager"></i>';addhtmlnxt+='&nbsp;&nbsp;&nbsp;<i class="fa fa-check-circle-o faicon" style="font-size:20px;" title="Already sent"></i>';addhtmlnxt+='</td>';addhtmlnxt+='<td width="11%" style="text-align:center"><i class="fa fa-list-ul faicon" title="Audit Trail"></i></td>';addhtmlnxt+='<td width="11%" style="text-align:center"><i class="fa fa-edit"></i></td>';addhtmlnxt+='<td width="11%" style="text-align:center"><i class="fa fa-trash"></i></td>';addhtmlnxt+='<td width="11%" style="text-align:center">';if(response.data[i]["coi_pdfpath"])
{addhtmlnxt+='<a  href="'+response.data[i]["coi_pdfpath"]+'"  class="downlodthfle" style="color:black;"><span class="glyphicon glyphicon-download-alt floatleft"></span></a>';}
addhtmlnxt+='</td>';addhtmlnxt+='</tr>';}}
else
{addhtmlnxt+='<tr class="counter"><td>Data Not Found</td></tr>';}
website('.allcoidata').html(addhtmlnxt);},complete:function(response){},error:function(jqXHR,textStatus,errorThrown){},});}
website("i#sendtohrM").click(function()
{alert('dssdd');var reqid=website(this).attr("reqid");formdata={reqid:reqid};website.ajax({url:"coi/sendaprvmailtomgr",data:formdata,method:"POST",contentType:"application/x-www-form-urlencoded; charset=UTF-8",dataType:"json",cache:false,beforeSend:function()
{website('.preloder_wraper').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});getcmplist()}
else
{new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function(){}});});;