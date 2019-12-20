
website('body').on('click','.paginationmn li',function(e)
{var rscrntpg=website(this).attr('p');website('.panel.panel-white #pagenum').val(rscrntpg);var noofrows=website('#noofrows').val();getdataonload();});website(document).ready(function()
{getdataonload();});website('body').on('change','#noofrows',function(e)
{getdataonload();});website('body').on('click','.go_button',function(e)
{var rscrntpg=website('.gotobtn').val();website('.panel.panel-white #pagenum').val(rscrntpg);getdataonload();});function getdataonload()
{var noofrows=website('#noofrows').val();var pagenum=website('#pagenum').val();var chkclk='';var numofdata='all';var formdata={numofdata:numofdata,noofrows:noofrows,pagenum:pagenum};website.ajax({url:'departmentmaster/fetchdept',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{var addhtmlnxt='';var dept='';var companyname='';for(var i=0;i<response.data.length;i++)
{dept=response.data[i].deptname?response.data[i].deptname:'NONE';companyname=response.data[i].companyname?response.data[i].companyname:'NONE';var j=i+1;addhtmlnxt+='<tr class="counter" tempid="'+response.data[i].id+'" >';addhtmlnxt+='<td width="15%">'+j+'</td>';addhtmlnxt+='<td width="15%">'+dept+'</td>';addhtmlnxt+='<td width="15%">'+companyname+'</td>';addhtmlnxt+='<td width="10%"><i class="fa fa-edit faicon dbeditme" title="Edit entry" tempid="'+response.data[i].id+'" ></i><i class="fa fa-trash-o faicon dbdeleteme" title="Delete entry" tempid="'+response.data[i].id+'" ></i></td>';addhtmlnxt+='</tr>';}}
else
{addhtmlnxt+='<tr><td colspan="4" style="text-align:center;">NO DATA FOUND</td></tr>';}
website('.appendrow').html(addhtmlnxt);website('.paginationmn').html(response.pgnhtml);},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});}
website('#insertdepartment').ajaxForm({dataType:"json",beforeSend:function()
{website('.preloder_wraper').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{website('.preloder_wraper').fadeIn();},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{getdataonload();new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}
else
{new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function(){website('.preloder_wraper').fadeOut();}});website('body').on('click','.dbeditme',function(e)
{var tempid=website(this).attr('tempid');website('#Mymodaledit .mainprogressbarforall').fadeOut();var noofrows=website('#noofrows').val();var pagenum=website('#pagenum').val();var chkclk='';var numofdata='one';var formdata={numofdata:numofdata,noofrows:noofrows,pagenum:pagenum,tempid:tempid};website.ajax({url:'departmentmaster/fetchsingdept',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{if(response.data[0].deptname=='Legal Department')
{website('#Mymodaledit #deptname').attr('readonly','readonly');}
else
{website('#Mymodaledit #deptname').removeAttr('readonly');}
var cmpsel=response.data[0].companyid.split(",");website('#Mymodaledit').modal('show');website('#updatedept #tempid').val(tempid);website('#Mymodaledit #cmpaccnme option').prop('selected',false);website.each(response.data[0],function(k,v)
{if(k!='')
{website('#Mymodaledit #'+k).val(v);}});website.each(cmpsel,function(k,v)
{website('#Mymodaledit #cmpaccnme option[value="'+v+'"]').prop('selected',true);});}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});});website('#updatedept').ajaxForm({dataType:"json",beforeSend:function()
{website('#Mymodaledit .mainprogressbarforall').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{website('#Mymodaledit').modal('hide');new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});getdataonload();}
else
{new PNotify({title:'Record Not Updated',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{website('#Mymodaledit .mainprogressbarforall').fadeOut();},error:function()
{}});website('body').on('click','.dbdeleteme',function()
{var tempid=website(this).attr('tempid');website('#myModalyesno').modal('show');website('.yesconfirm').attr('tempid',tempid);});website('body').on('click','.yesconfirm',function(e)
{var tempid=website(this).attr('tempid');var formdata={tempid:tempid};website.ajax({url:'departmentmaster/deletedept',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{website('#myModalyesno').modal('hide');getdataonload();new PNotify({title:'Record Deleted Successfully',text:'Record Deleted Successfully',type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});});website('body').on('click','.editrel',function()
{var tempid=website(this).attr('tempid');website('#myModalyesno').modal('show');website('.yesconfirm').attr('tempid',tempid);});;