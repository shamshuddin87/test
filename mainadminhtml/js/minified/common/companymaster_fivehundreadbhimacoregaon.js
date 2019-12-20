
website('body').on('click','.paginationmn li',function(e)
{var rscrntpg=website(this).attr('p');website('.panel.panel-white #pagenum').val(rscrntpg);getallcmpdetails();});website(document).ready(function()
{getallcmpdetails();});website('body').on('change','#noofrows',function(e)
{getallcmpdetails();});website('body').on('click','.go_button',function(e)
{var rscrntpg=website('.gotobtn').val();website('.panel.panel-white #pagenum').val(rscrntpg);getallcmpdetails();});function getallcmpdetails(){var noofrows=website('#noofrows').val();var pagenum=website('#pagenum').val();formdata={noofrows:noofrows,pagenum:pagenum};website.ajax({url:'companymaster/allcmpdetails',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{var htmlelements='';if(response.logged==true){for(var i=0;i<response.data.length;i++){var j=i+1;htmlelements+='<tr>';htmlelements+='<td>'+j+'</td>';htmlelements+='<td>'+response.data[i]['companyname']+'</td>';htmlelements+='<td>'+response.data[i]['panid']+'</td>';htmlelements+='<td><i class="fa fa-edit editcmp" cmpid="'+response.data[i][0]+'" ></i>'+'<i class="fa fa-trash delcmp" delcmpid="'+response.data[i][0]+'" ></i></td>';htmlelements+='</tr>';}}
else{htmlelements+='<tr><td colspan="4" style="text-align:center;">NO DATA FOUND</td></tr>';}
website('.cmpdetails').html(htmlelements);website('.paginationmn').html(response.pgnhtml);},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});}
website('#cmpmst').ajaxForm({dataType:"json",beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});window.location.reload();getallcmpdetails();}
else
{new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{},error:function()
{}});website('body').on('click','.editcmp',function(e){var cmpid=website(this).attr('cmpid');var formdata={cmpid:cmpid};website.ajax({url:'companymaster/getsinglecmpdetail',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged==true)
{var cmpid=response.data['id'];var cmpname=response.data['companyname'];var panid=response.data['panid'];website('#cmpmod #cmpid').val(cmpid);website('#cmpmod #cmpnm').val(cmpname);website('#cmpmod #pnid').val(panid);website('#cmpmod').modal('show');}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});});website('body').on('click','#udtcmp',function(e){var cmpid=website('#cmpid').val();var cmpname=website('#cmpnm').val();var panid=website('#pnid').val();var formdata={cmpid:cmpid,cmpname:cmpname,panid:panid};website.ajax({url:'companymaster/updatecompany',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged==true)
{getallcmpdetails();website('#cmpmod').modal('hide');window.location.reload();new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}
else{new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});});website('body').on('click','.delcmp',function(e){var cmpid=website(this).attr('delcmpid');website('#deleteid').val(cmpid);website('#delmod').modal('show');});website('body').on('click','#delcmp',function(e){var cmpid=website('#deleteid').val();formdata={cmpid:cmpid};website.ajax({url:'companymaster/deletecompany',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged==true)
{website('#delmod').modal('hide');new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});getallcmpdetails();}
else{new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});});;