
website(document).ready(function()
{getdataonload();website('.bootdatepick').datetimepicker({weekStart:1,todayBtn:0,autoclose:1,todayHighlight:0,startView:2,minView:2,forceParse:0,format:"dd-mm-yyyy"}).on('change',function(e,date)
{var getdate=website(this).val();var getid=website(this).closest('form').attr('id');});});website('body').on('change','#noofrows',function(e)
{getdataonload();});website('body').on('click','.paginationmn li',function(e)
{var rscrntpg=website(this).attr('p');website('.panel.panel-white #pagenum').val(rscrntpg);getdataonload();});website('body').on('click','.go_button',function(e)
{var rscrntpg=website('.gotobtn').val();website('.panel.panel-white #pagenum').val(rscrntpg);getdataonload();});function getdataonload()
{var noofrows=website('#noofrows').val();var pagenum=website('#pagenum').val();var formdata={noofrows:noofrows,pagenum:pagenum};website.ajax({url:'sensitiveinformation/fetchupsiinfo',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{var addhtmlnxt='';for(var i=0;i<response.resdta.length;i++)
{var upsitype=response.resdta[i].upsitype?response.resdta[i].upsitype:'';var projstartdate=response.resdta[i].projstartdate?response.resdta[i].projstartdate:'';var enddate=response.resdta[i].enddate?response.resdta[i].enddate:'';var date_added=response.resdta[i].date_added?response.resdta[i].date_added:'';addhtmlnxt+='<tr class="counter" aprvllistid="'+response.resdta[i].id+'" >';addhtmlnxt+='<td width="25%">'+upsitype+'</td>';addhtmlnxt+='<td width="25%">'+projstartdate+'</td>';addhtmlnxt+='<td width="25%">'+enddate+'</td>';addhtmlnxt+='<td width="25%">'+date_added+'</td>';addhtmlnxt+='<td width="25%"><i class="fa fa-plus faicon setupsitype" title="View entry" upsitypeid="'+response.resdta[i].id+'" ></i></td>';addhtmlnxt+='</tr>';}
website('.appendrow').html(addhtmlnxt);website('.paginationmn').html(response.pgnhtml);}
else
{website('.appendrow').html('<tr><td style="text-align:center;" colspan="5">No Data Found..!!!</td></tr>');website('.paginationmn').html(response.pgnhtml);}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});}
website('body').on('click','.editupsitype',function(){var id=website(this).attr('upsitypeid');var formdata={id:id};website.ajax({url:'sensitiveinformation/fetchupsiinfoedit',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{website("#Mymodaledit #upsitype").val(response.data['0'].upsitype);website('#updateupsiinfo #tempid').val(id);website('#Mymodaledit').modal('show');}
else
{website('#alertcommon #allalertmsg').html("Something Went To Wrong");website('#alertcommon').modal('show');}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});});website('#updateupsiinfo').ajaxForm({dataType:"json",beforeSend:function()
{website('.preloder_wraper').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{website('.preloder_wraper').fadeIn();},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{new PNotify({title:'Alert..!!',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});window.location.reload();}
else
{website('#alertcommon #allalertmsg').html(response.message);website('#alertcommon').modal('show');}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function()
{website('.preloder_wraper').fadeOut();}});website('body').on('click','.deleteupsitype',function(){var id=website(this).attr('upsitypeid');website('#myModalyesno').modal('show');website('#myModalyesno .yesconfirm').attr('upsitypeid',id);});website('body').on('click','.yesconfirm',function(){var id=website(this).attr('upsitypeid');var formdata={id:id};website.ajax({url:'sensitiveinformation/upsiinfodelete',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{window.location.reload();new PNotify({title:'Alert..!!',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}
else
{website('#alertcommon #allalertmsg').html(response.message);website('#alertcommon').modal('show');}},complete:function(response)
{website('#myModalyesno .mainprogressbarforall').fadeOut();},error:function()
{}});});website('body').on('click','.setupsitype',function(){var upsitypeid=website(this).attr('upsitypeid');var formdata={upsitypeid:upsitypeid};website.ajax({url:'sensitiveinformation/upsiidSETsession',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{website('.progress-indeterminate').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{setTimeout(function(){var baseHref=getbaseurl();window.location.href=baseHref+'sensitiveinformation/infosharing';},1000);}
else
{website('#alertcommon #allalertmsg').html(response.message);website('#alertcommon').modal('show');}},complete:function(response)
{website('.progress-indeterminate').fadeOut();},error:function(jqXHR,textStatus,errorThrown)
{website('#alertcommon #allalertmsg').html("Something went wrong ! Please Contact to website admin");website('#alertcommon').modal('show');}});});;