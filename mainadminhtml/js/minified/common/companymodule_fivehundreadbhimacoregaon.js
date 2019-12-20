
website('body').on('click','.paginationmn li',function(e)
{var rscrntpg=website(this).attr('p');website('.panel.panel-white #pagenum').val(rscrntpg);var noofrows=website('#noofrows').val();var status=website('#srch').attr('status');if(status)
{getsearchlist();}
else
{getcmplist();}});website('body').on('change','#noofrows',function(e)
{var status=website('#srch').attr('status');if(status)
{getsearchlist();}
else
{getcmplist();}});website('body').on('click','.go_button',function(e)
{var rscrntpg=website('.gotobtn').val();website('.panel.panel-white #pagenum').val(rscrntpg);var status=website('#srch').attr('status');if(status)
{getsearchlist();}
else{getcmplist();}});getcmplist()
function getcmplist()
{var noofrows=website('#noofrows').val();var pagenum=website('#pagenum').val();var formdata={noofrows:noofrows,pagenum:pagenum};website.ajax({url:'companymodule/fetchcmplist',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{website('.preloder_wraper').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{var myhtml='';if(response.logged===true)
{var j=1;for(var i=0;i<response.data.length;i++)
{myhtml+='<tr>';myhtml+='<td>'+j+'</td>';myhtml+='<td>'+response.data[i]['company_name']+'</td>';myhtml+='<td width="10%"><i class="fa fa-edit faicon dbeditme" title="Edit entry" tempid="'+response.data[i]["id"]+'" ></i><i class="fa fa-trash-o faicon dbdeleteme" title="Delete entry" tempid="'+response.data[i]["id"]+'" ></i></td>';myhtml+='</tr>';j++;}}
else
{myhtml+='<tr>';myhtml+="<td colspan='4' style='text-align:center;'>DATA NOT FOUND..!!</td>";myhtml+='</tr>';}
website('.appendroww').html(myhtml);website('.paginationmn').html(response.pgnhtml);},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function(jqXHR,textStatus,errorThrown)
{}});}
website('#insertexcl').ajaxForm({dataType:"json",beforeSend:function()
{website('.preloder_wraper').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});getcmplist()}
else
{new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function(){}});website('body').on('click','#subcmp',function(e){var cmpname=website('#lcmp').val();if(cmpname=='')
{new PNotify({title:'Alert',text:"Company Name Required",type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}
else
{website.ajax({url:'companymodule/addcmpmodule',data:{cmpname:cmpname},method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{website('.preloder_wraper').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged==true)
{new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});getcmplist();window.location.reload();}
else
{new PNotify({title:'Alert',text:"Something Went To Wrong..!!!",type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function(){}});}});website('body').on('click','.dbdeleteme',function(e){var delid=website(this).attr('tempid');website('#deleteid').val(delid);website('#delmod').modal('show');});website('body').on('click','#deletecmp',function(e){var delid=website('#deleteid').val();website.ajax({url:'companymodule/deletecmp',data:{delid:delid},method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged==true)
{website('#delmod').modal('hide');new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});getcmplist();}
else
{new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},});});website('body').on('click','.dbeditme',function(e){var editid=website(this).attr('tempid');website.ajax({url:'companymodule/fetcheditcmp',data:{editid:editid},method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged==true)
{var cmpname=response.data.company_name?response.data.company_name:'';var id=response.data.id?response.data.id:'';var access=response.data.access?response.data.access:0;website('#cmpname').val(cmpname);website('#editcmpid').val(id);website('#editcompany').modal('show');}
else
{}},});});website('body').on('click','.updatecmp',function(e){var cmpname=website('#cmpname').val();var editcmpid=website('#editcmpid').val();if(cmpname!='')
{website.ajax({url:'companymodule/updatecmpmod',data:{cmpname:cmpname,editcmpid:editcmpid},method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged==true)
{website('#editcompany').modal('hide');new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});getcmplist();}
else
{new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},});}
else{new PNotify({title:'Alert',text:"Please Type Name Of Company",type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}});website("#srch").on("keyup",function(){var search=website('#srch').val();var pagenum=website('#pagenum').val();website('#srch').attr('status','0');if(pagenum!=1)
{website('#pagenum').val(1);}
if(search=="")
{getcmplist();}
else
{getsearchlist();}});function getsearchlist(){var search=website('#srch').val();var noofrows=website('#noofrows').val();var pagenum=website('#pagenum').val();var formdata={noofrows:noofrows,pagenum:pagenum,search:search};website.ajax({url:'companymodule/fetchsearchlist',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{if(search=='')
{website('.preloder_wraper').fadeIn();}},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{var myhtml='';if(response.logged===true)
{var j=1;for(var i=0;i<response.data.length;i++)
{myhtml+='<tr>';myhtml+='<td>'+j+'</td>';myhtml+='<td>'+response.data[i]['company_name']+'</td>';myhtml+='<td width="10%"><i class="fa fa-edit faicon dbeditme" title="Edit entry" tempid="'+response.data[i]["id"]+'" ></i><i class="fa fa-trash-o faicon dbdeleteme" title="Delete entry" tempid="'+response.data[i]["id"]+'" ></i></td>';myhtml+='</tr>';j++;}
website('#srch').attr('status','1')}
else
{myhtml+='<tr>';myhtml+="<td colspan='4' style='text-align:center;'>DATA NOT FOUND..!!</td>";myhtml+='</tr>';website('#srch').attr('status','0')}
website('.appendroww').html(myhtml);website('.paginationmn').html(response.pgnhtml);},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function(jqXHR,textStatus,errorThrown)
{}});};