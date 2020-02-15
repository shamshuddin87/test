
website(document).ready(function()
{website('.bootdatepick').datetimepicker({weekStart:1,todayBtn:0,autoclose:1,todayHighlight:0,startView:2,minView:2,forceParse:0,format:"dd-mm-yyyy"}).on('change',function(e,date)
{var getdate=website(this).val();var getid=website(this).closest('form').attr('id');});getdataonload();});website('#insertesop').ajaxForm
({dataType:"json",beforeSend:function()
{website('.preloder_wraper').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{website('.preloder_wraper').fadeIn();},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{new PNotify({title:'Record Added Successfully',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});setTimeout(function(){window.location.reload();},2000);}
else
{new PNotify({title:'Record Not Added',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function(jqXHR,textStatus,errorThrown)
{}});website('body').on('change','#noofrows',function(e)
{getdataonload();});website('body').on('click','.paginationmn li',function(e)
{var rscrntpg=website(this).attr('p');website('.panel.panel-white #pagenum').val(rscrntpg);getdataonload();});website('body').on('click','.go_button',function(e)
{var rscrntpg=website('.gotobtn').val();website('.panel.panel-white #pagenum').val(rscrntpg);getdataonload();});function getdataonload()
{var noofrows=website('#noofrows').val();var pagenum=website('#pagenum').val();var formdata={noofrows:noofrows,pagenum:pagenum};website.ajax({url:'esop/fetchesop',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{var addhtmlnxt='';for(var i=0;i<response.resdta.length;i++)
{dtfrmt=response.resdta[i].date_added.split("-");dtfrmtspace=response.resdta[i].date_added.split(" ");ddmmyy=dtfrmtspace[0];dtfrmt=dtfrmtspace[0].split("-");yymmdd=dtfrmt[0]+'-'+dtfrmt[1]+'-'+dtfrmt[2];times=dtfrmtspace[1];addhtmlnxt+='<tr class="counter" esopid="'+response.resdta[i].id+'" >';addhtmlnxt+='<td width="25%">'+yymmdd+'</td>';addhtmlnxt+='<td width="25%">'+times+'</td>';addhtmlnxt+='<td width="30%"><i class="fa fa-eye faicon floatleft viewesop" title="View entry" id="editesop" esopid="'+response.resdta[i].id+'" uniqueid="'+response.resdta[i].uniqueid+'"></i></td>';addhtmlnxt+='</tr>';}
website('.appendrow').html(addhtmlnxt);website('.paginationmn').html(response.pgnhtml);}
else
{website('.appendrow').html('<tr><td style="text-align:center;" colspan="13">Data Not Found!!!!</td></tr>');website('.paginationmn').html(response.pgnhtml);}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});}
website('body').on('click','.viewesop',function()
{var esopid=website(this).attr('esopid');var uniquid=website(this).attr('uniqueid');uniquid=btoa(uniquid);esopid=btoa(esopid);var baseHref=getbaseurl();window.location.href=baseHref+'esop/viewesop?esopid='+esopid+'&&uniqueid='+uniquid+'';});;