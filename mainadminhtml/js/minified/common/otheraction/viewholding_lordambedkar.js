
website(document).ready(function()
{website('.bootdatepick').datetimepicker({weekStart:1,todayBtn:0,autoclose:1,todayHighlight:0,startView:2,minView:2,forceParse:0,format:"dd-mm-yyyy"}).on('change',function(e,date)
{var getdate=website(this).val();var getid=website(this).closest('form').attr('id');});});website('body').on('change','#noofrows',function(e)
{getdataonload();});website('body').on('click','.paginationmn li',function(e)
{var rscrntpg=website(this).attr('p');website('.panel.panel-white #pagenum').val(rscrntpg);getdataonload();});website('body').on('click','.go_button',function(e)
{var rscrntpg=website('.gotobtn').val();website('.panel.panel-white #pagenum').val(rscrntpg);getdataonload();});getdataonload();function getdataonload()
{var noofrows=website('#noofrows').val();var pagenum=website('#pagenum').val();var rtaid=website('#rtaid').val();var rtauniqueid=website('#rtauniqueid').val();var dateofrecon=website('#dateofrecon').val();var formdata={rtaid:rtaid,rtauniqueid:rtauniqueid,dateofrecon:dateofrecon,noofrows:noofrows,pagenum:pagenum}
website.ajax({url:'uploadholding/fetchholdingforview',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{var addhtmlnxt='';for(var i=0;i<response.resdta['data'].length;i++)
{var pan=response.resdta['data'][i].panno?response.resdta['data'][i].panno:'';var username=response.resdta['username'][i]?response.resdta['username'][i]:'';var relativename=response.resdta['data'][i].relativename?response.resdta['data'][i].relativename:'';var relationship=response.resdta['data'][i].relationship?response.resdta['data'][i].relationship:'';var holding=response.resdta['data'][i].holding?response.resdta['data'][i].holding:'';addhtmlnxt+='<tr class="counter" reconciid="'+response.resdta['data'][i].id+'">';addhtmlnxt+='<td width="15%">'+pan+'</td>';addhtmlnxt+='<td width="10%">'+username+'</td>';addhtmlnxt+='<td width="15%">'+relativename+'</td>';addhtmlnxt+='<td width="10%">'+relationship+'</td>';addhtmlnxt+='<td width="15%">'+holding+'</td>';addhtmlnxt+='</tr>';}
website('.appendviewholding').html(addhtmlnxt);website('#datableabhi').DataTable();}
else
{}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function(jqXHR,textStatus,errorThrown)
{}});};