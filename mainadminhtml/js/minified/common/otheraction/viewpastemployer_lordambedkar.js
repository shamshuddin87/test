
website(document).ready(function()
{website('.bootdatepick').datetimepicker({weekStart:1,todayBtn:0,autoclose:1,todayHighlight:0,startView:2,minView:2,forceParse:0,format:"dd-mm-yyyy"}).on('change',function(e,date)
{var getdate=website(this).val();var getid=website(this).closest('form').attr('id');});});website('body').on('change','#noofrows',function(e)
{getdataonload();});website('body').on('click','.paginationmn li',function(e)
{var rscrntpg=website(this).attr('p');website('.panel.panel-white #pagenum').val(rscrntpg);getdataonload();});website('body').on('click','.go_button',function(e)
{var rscrntpg=website('.gotobtn').val();website('.panel.panel-white #pagenum').val(rscrntpg);getdataonload();});getdataonload();function getdataonload()
{var noofrows=website('#noofrows').val();var pagenum=website('#pagenum').val();var persnid=website('#personid').val();var formdata={persnid:persnid,noofrows:noofrows,pagenum:pagenum}
website.ajax({url:'employeemodule/fetchpastemployer',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{var addhtmlnxt='';for(var i=0;i<response.resdta.length;i++)
{var emp_name=response.resdta[i].emp_name?response.resdta[i].emp_name:'';var emp_desigtn=response.resdta[i].emp_desigtn?response.resdta[i].emp_desigtn:'';var startdate=response.resdta[i].startdate?response.resdta[i].startdate:'';var enddate=response.resdta[i].enddate?response.resdta[i].enddate:'';addhtmlnxt+='<tr class="counter" empid="'+response.resdta[i].id+'" >';addhtmlnxt+='<td width="20%">'+emp_name+'</td>';addhtmlnxt+='<td width="20%">'+emp_desigtn+'</td>';addhtmlnxt+='<td width="20%">'+startdate+'</td>';addhtmlnxt+='<td width="20%">'+enddate+'</td>';addhtmlnxt+='<td width="20%" ><i class="fa fa-edit faicon floatleft editemp" title="Edit entry" empid="'+response.resdta[i].id+'" ></i><i class="fa fa-trash-o faicon floatleft deleteemp" title="Delete entry" empid="'+response.resdta[i].id+'" ></i></td>';addhtmlnxt+='</tr>';}
website('.appendviewemplyee').html(addhtmlnxt);website('.paginationmn').html(response.pgnhtml);}
else
{website('.paginationmn').html(response.pgnhtml);}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function(jqXHR,textStatus,errorThrown)
{}});}
website('#insertpastemp').ajaxForm({dataType:"json",beforeSend:function()
{website('.preloder_wraper').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{website('.preloder_wraper').fadeIn();},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{new PNotify({title:'Record Added Successfully',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});getdataonload();window.location.reload();}else{new PNotify({title:'Record Not Added',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function(jqXHR,textStatus,errorThrown)
{}});website('body').on('click','.editemp',function()
{var empid=website(this).attr('empid');var formdata={empid:empid}
website.ajax({url:'employeemodule/fetchempedit',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{var addhtmlnxt='';for(var i=0;i<response.resdta.length;i++)
{website('#Mymodalempedit #empname').val(response.resdta[i].emp_name);website('#Mymodalempedit #designtn').val(response.resdta[i].emp_desigtn);website('#Mymodalempedit #strtdte').val(response.resdta[i].startdate);website('#Mymodalempedit #enddte').val(response.resdta[i].enddate);website('#Mymodalempedit #empid').val(response.resdta[i].id);website('#Mymodalempedit').modal('show');}}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function(jqXHR,textStatus,errorThrown)
{}});});website('#updateemp').ajaxForm({dataType:"json",beforeSend:function()
{website('.preloder_wraper').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{website('.preloder_wraper').fadeIn();},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});getdataonload();window.location.reload();}else{new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function(jqXHR,textStatus,errorThrown)
{}});website('body').on('click','.deleteemp',function(){var id=website(this).attr('empid');website('#myModalyesno').modal('show');website('#myModalyesno .yesconfirm').attr('empid',id);});website('body').on('click','.yesconfirm',function(){var id=website(this).attr('empid');var formdata={id:id};website.ajax({url:'employeemodule/deleteempdetail',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{window.location.reload();new PNotify({title:'Alert!!',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}
else
{new PNotify({title:'Alert!!',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{website('#myModalyesno .mainprogressbarforall').fadeOut();},error:function()
{}});});;