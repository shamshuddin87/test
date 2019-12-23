
website(document).ready(function()
{getdataonload();website('.bootdatepick').datetimepicker({weekStart:1,todayBtn:0,autoclose:1,todayHighlight:0,startView:2,minView:2,forceParse:0,format:"dd-mm-yyyy"}).on('change',function(e,date)
{var getdate=website(this).val();var getid=website(this).closest('form').attr('id');});});website('body').on('change','#noofrows',function(e)
{getdataonload();});website('body').on('click','.paginationmn li',function(e)
{var rscrntpg=website(this).attr('p');website('.panel.panel-white #pagenum').val(rscrntpg);getdataonload();});website('body').on('click','.go_button',function(e)
{var rscrntpg=website('.gotobtn').val();website('.panel.panel-white #pagenum').val(rscrntpg);getdataonload();});function getdataonload()
{var noofrows=website('#noofrows').val();var pagenum=website('#pagenum').val();var upsitypeid=website('#upsitypeid').val();var formdata={noofrows:noofrows,pagenum:pagenum,upsitypeid:upsitypeid};website.ajax({url:'mis/fetcharchiveinfosharing',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{var addhtmlnxt='';for(var i=0;i<response.resdta.length;i++)
{var category=response.resdta[i].category_name?response.resdta[i].category_name:'';var enddate=response.resdta[i].enddate?response.resdta[i].enddate:'';var datefrom=response.resdta[i].sharingdate;var time=response.resdta[i].sharingtime?response.resdta[i].sharingtime:'';var newtime=time.replace(/:[^:]*$/,'');datefrom=datefrom.split(' ')[0];dtfrmtfrom=datefrom.split("-");dtfrmtspacefrom=datefrom.split(" ");ddmmyyfrom=dtfrmtspacefrom[0];dtfrmtfrom=dtfrmtspacefrom[0].split("-");ddmmyyfrom=dtfrmtfrom[2]+'-'+dtfrmtfrom[1]+'-'+dtfrmtfrom[0];addhtmlnxt+='<tr class="counter" aprvllistid="'+response.resdta[i].id+'" >';addhtmlnxt+='<td width="10%">'+response.resdta[i].name+'</td>';addhtmlnxt+='<td width="10%">'+category+'</td>';addhtmlnxt+='<td width="10%">'+ddmmyyfrom+'</td>';addhtmlnxt+='<td width="5%">'+newtime+'</td>';addhtmlnxt+='<td width="10%">'+enddate+'</td>';addhtmlnxt+='<td width="10%">'+response.resdta[i].datashared+'</td>';addhtmlnxt+='<td width="10%">'+response.resdta[i].purpose+'</td>';addhtmlnxt+='<td width="5%"><i class="fa fa-bar-chart viewtrail" infoshrid="'+response.resdta[i].id+'"></i></td>';addhtmlnxt+='<td width="10%">'+response.resdta[i].fullname+'</td>';addhtmlnxt+='</tr>';}
website('.appendrow').html(addhtmlnxt);website('.paginationmn').html(response.pgnhtml);}
else
{website('.appendrow').html('<tr><td style="text-align:center;" colspan="13">Data Not Found!!!!</td></tr>');website('.paginationmn').html(response.pgnhtml);}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});}
function numberalphOnly()
{var charCode=event.keyCode;if((charCode>47&&charCode<58)||charCode==32||(charCode>64&&charCode<91)||(charCode>96&&charCode<123)||charCode==8||charCode==44||charCode==40||charCode==41||charCode==46||charCode==47)
return true;else
return false;}
website(".time_of_data").inputmask();website('body').on("click",".viewtrail",function(e){var infoid=website(this).attr('infoshrid');var formdata={infoid:infoid}
website.ajax({url:'sensitiveinformation/fetchinfotrail',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{dteadded=response.data.date_added.split("-");dteaddedspace=response.data.date_added.split(" ");ddmmyyadded=dteaddedspace;dteadded=dteaddedspace[0].split("-");ddmmyyadded=dteadded[2]+'-'+dteadded[1]+'-'+dteadded[0];timesadded=dteaddedspace[1];dtemodified=response.data.date_modified.split("-");dtemodifdspace=response.data.date_modified.split(" ");ddmmyymodified=dtemodifdspace[0];dtemodified=dtemodifdspace[0].split("-");ddmmyymodified=dtemodified[2]+'-'+dtemodified[1]+'-'+dtemodified[0];timesmodified=dtemodifdspace[1];website('#Mymodalaudittrail .reqstcreateddte').html(ddmmyyadded+' '+timesadded);website('#Mymodalaudittrail .reqstupdteddte').html(ddmmyymodified+' '+timesmodified);website('#Mymodalaudittrail').modal('show');}
else
{}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});});;