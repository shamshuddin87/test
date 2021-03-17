
website(document).ready(function()
{fetchCoiAllData();});function fetchCoiAllData()
{website.ajax({url:"coi/fetchCoiAllData",method:"POST",contentType:"application/x-www-form-urlencoded; charset=UTF-8",dataType:"json",cache:false,beforeSend:function(){},uploadProgress:function(event,position,total,percentComplete){},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{var addhtmlnxt='';for(var i=0;i<response.data.length;i++)
{var j=i+1;var sentdate=response.data[i]['sent_date']?response.data[i]['sent_date']:"";addhtmlnxt+='<tr class="counter">';addhtmlnxt+='<td width="5%">'+j+'</td>';addhtmlnxt+='<td width="11%">'+response.data[i]['date_added']+'</td>';addhtmlnxt+='<td width="11%">';if(response.data[i]['sent_status']=='1')
{addhtmlnxt+='Sent';}
else
{addhtmlnxt+='Pending';}
addhtmlnxt+='</td>';addhtmlnxt+='<td width="11%"></td>';addhtmlnxt+='<td width="11%"></td>';addhtmlnxt+='<td width="11%"></td>';addhtmlnxt+='<td width="11%"></td>';addhtmlnxt+='<td width="11%"></td>';addhtmlnxt+='<td width="11%">';if(response.data[i]["coi_pdfpath"])
{addhtmlnxt+='<a  href="'+response.data[i]["coi_pdfpath"]+'"  class="downlodthfle" style="color:black;"><span class="glyphicon glyphicon-download-alt floatleft"></span></a>';}
addhtmlnxt+='</td>';addhtmlnxt+='</tr>';}}
else
{addhtmlnxt+='<tr class="counter"><td>Data Not Found</td></tr>';}
website('.allcoidata').html(addhtmlnxt);},complete:function(response){},error:function(jqXHR,textStatus,errorThrown){},});};