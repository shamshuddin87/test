
website('body').on('click','.paginationmn li',function(e)
{var rscrntpg=website(this).attr('p');website('.panel.panel-white #pagenum').val(rscrntpg);getuserlistonload();});website('body').on('change','#noofrows',function(e)
{website('.pagechnum').val(1);getuserlistonload();});website('body').on('click','.go_button',function(e)
{var rscrntpg=website('.gotobtn').val();website('.panel.panel-white #pagenum').val(rscrntpg);getuserlistonload();});datepicker();function datepicker(){website('.bootdatepick').datetimepicker({weekStart:1,todayBtn:0,autoclose:1,todayHighlight:0,startView:2,minView:2,forceParse:0,format:"dd-mm-yyyy"}).on('change',function(e,date)
{var getdate=website(this).val();var getid=website(this).closest('form').attr('id');});}
website('body').on('click','#cmpaccnme option',function(e)
{if(website(this).hasClass('optncmp')){website(this).closest('form').find('#deptaccess option').prop('disabled',true);website(this).closest('form').find('#cmpaccnme option:selected').each(function(){var attrval=website(this).val();website(this).closest('form').find('#deptaccess option').each(function(){var chk=website(this).attr('cmplink');if(chk){var chkhr=chk.split(',');for(var i=0;i<chkhr.length;i++){if(chkhr[i]==attrval){website(this).prop('disabled',false);}}}});});}else{website(this).closest('form').find('#deptaccess option').prop('disabled',true);website(this).closest('form').find('#deptaccess option:eq(0)').prop('disabled',false);}});website('body').on('click','#cmpaccnmee option',function(e)
{if(website(this).hasClass('optncmp')){website(this).closest('form').find('#deptaccess option').prop('disabled',true);website(this).closest('form').find('#cmpaccnmee option:selected').each(function(){var attrval=website(this).val();website(this).closest('form').find('#deptaccess option').each(function(){var chk=website(this).attr('cmplink');if(chk){var chkhr=chk.split(',');for(var i=0;i<chkhr.length;i++){if(chkhr[i]==attrval){website(this).prop('disabled',false);}}}});});}else{website(this).closest('form').find('#deptaccess option').prop('disabled',true);website(this).closest('form').find('#deptaccess option:eq(0)').prop('disabled',false);}});website('#insertmasterlist').ajaxForm({dataType:"json",beforeSend:function()
{website('.preloder_wraper').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{window.location.reload();new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});getuserlistonload();}
else
{new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function()
{}});website('#updatemasterlistid').ajaxForm({dataType:"json",beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});getuserlistonload();website('#Mymodaledit').modal('hide');window.location.reload();}
else
{new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{},error:function()
{}});getuserlistonload();function getuserlistonload()
{var noofrows=website('#noofrows').val();var pagenum=website('#pagenum').val();var formdata={noofrows:noofrows,pagenum:pagenum};website.ajax({url:'usermaster/fetchuser',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{website('.preloder_wraper').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{var addhtmlnxt='';var dept='';var companyname='';for(var i=0;i<response.data.length;i++)
{var fullname=response.data[i].fullname?response.data[i].fullname:'NONE';var email=response.data[i].email?response.data[i].email:'NONE';var dpdate=response.data[i].dpdate?response.data[i].dpdate:'NONE'
var designation=response.data[i].designation?response.data[i].designation:'NONE';var companyname=response.data[i].companyname?response.data[i].companyname:'NONE';var departmentname=response.data[i].department?response.data[i].department:'NONE'
var j=i+1;addhtmlnxt+='<tr class="counter" tempid="'+response.data[i].id+'" >';addhtmlnxt+='<td width="15%">'+j+'</td>';addhtmlnxt+='<td width="15%">'+fullname+'</td>';addhtmlnxt+='<td width="15%">'+email+'</td>';addhtmlnxt+='<td width="15%">'+designation+'</td>';addhtmlnxt+='<td width="15%">'+dpdate+'</td>';addhtmlnxt+='<td width="15%">'+companyname+'</td>';addhtmlnxt+='<td width="15%">'+departmentname+'</td>';if(response.data[i].master_group_id==2)
{addhtmlnxt+='<td width="10%"><i class="fa fa-edit faicon dbeditme" title="Edit entry" tempid="'+response.data[i].id+'" ></i></td>';}
else
{addhtmlnxt+='<td width="10%"><i class="fa fa-edit faicon dbeditme" title="Edit entry" tempid="'+response.data[i].id+'" ></i><i class="fa fa-trash-o faicon dbdeleteme" title="Delete entry" tempid="'+response.data[i].id+'" ></i></td>';}
addhtmlnxt+='</tr>';}}
else
{addhtmlnxt+='<tr><td colspan="8" style="text-align:center;">NO DATA FOUND</td></tr>';}
website('.appendrow').html(addhtmlnxt);website('.paginationmn').html(response.pgnhtml);},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function(jqXHR,textStatus,errorThrown)
{}});}
website('body').on('click','.dbdeleteme',function(e){var delid=website(this).attr('tempid');website('#deleteid').val(delid);website('#delmod').modal('show');});website('body').on('click','#deleteuser',function(e){var delid=website('#deleteid').val();var formdata={delid:delid};website.ajax({url:'usermaster/deleteuser',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged==true)
{website('#delmod').modal('hide');new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});getuserlistonload();}
else{new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});});website('body').on('click','.dbeditme',function(e){var tempid=website(this).attr('tempid');website('#appapnd').html('');var formdata={tempid:tempid};var len=website(".closeedit").length;if(len==0){website('#appapnd').css('display','none');}
website.ajax({url:'usermaster/fetchsingleuser',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{website('#Mymodaledit #appapnd').remove('.closeuser');var addhtmlnxt='';var dept='';var companyname='';for(var i=0;i<response.data.length;i++)
{var firstname=response.data[i].firstname?response.data[i].firstname:'';var lastname=response.data[i].lastname?response.data[i].lastname:'';var dpdate=response.data[i].dpdate?response.data[i].dpdate:'';var email=response.data[i].dpdate?response.data[i].email:'';var designation=response.data[i].designation?response.data[i].designation:'';var approveid=response.data[i].approvid?response.data[i].approvid:'';var approver=response.data[i].approver?response.data[i].approver:'';website('#Mymodaledit #mlistid').val(response.data[i].id)
website('#Mymodaledit #firstname').val(firstname);website('#Mymodaledit #lastname').val(lastname);website('#Mymodaledit #email').val(email);website('#Mymodaledit #designation').val(designation);website('#Mymodaledit #dpdate').val(dpdate);website('#Mymodaledit #typeofusr').val(response.data[i].master_group_id);website('#Mymodaledit #masterid').val(response.data[i].master_group_id);website('#Mymodaledit #approveid').val(approveid);var approveuser='';approveuser=approver.split(',');console.log(approveuser.length);if(approveuser!='')
{website('#appapnd').css('display','block');website("#Mymodaledit #appapnd").html('');for(var k=0;k<approveuser.length;k++)
{website("#Mymodaledit #appapnd").append(approveuser[k]);}}
else{website('#appapnd').css('display','none');}
var access=response.data[i].access;var access=access.split(',');if(access!=''){website.each(access,function(k,v)
{website("#Mymodaledit #accrgt option[value='"+v+"']").prop("disabled",false);website("#Mymodaledit #accrgt option[value='"+v+"']").prop("selected",true);});}
else
{website("#Mymodaledit #accrgt option").prop("selected",false);}
var dept=response.data[i].deptaccess;var dept=dept.split(',');if(dept!='')
{website.each(dept,function(k,v)
{website("#Mymodaledit #deptaccess option[value='"+v+"']").prop("selected",true);});}
else
{website("#Mymodaledit #deptaccess option").prop("selected",false);}
var cmpny=response.data[i].cmpaccess;var cmpny=cmpny.split(',');if(cmpny!='')
{website.each(cmpny,function(k,v)
{website("#Mymodaledit #cmpaccnme option[value='"+v+"']").prop("selected",true);});}
else
{website("#Mymodaledit #cmpaccnme option").prop("selected",false);}
if(response.data[i].master_group_id==2)
{website('#Mymodaledit #approvername').css('display','none');website('#Mymodaledit #typeofusr').css('display','none');website('#Mymodaledit .typu').css('display','none');}
else
{website('#Mymodaledit #approvername').css('display','block');website('#Mymodaledit #typeofusr').css('display','block');website('#Mymodaledit .typu').css('display','block');}
website('#Mymodaledit').modal('show');}}
else
{}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});});var useridarray=[];website('body').on('click','.validatorsid',function(e)
{var uid=website(this).attr('uid');var name=website(this).attr('name');website('#appendapp').css('display','block');if(website("#appendapp #"+uid).length==0)
{useridarray.push(uid);arr=useridarray.toString()
website('#appendapp').append('<div class="appendapp_div" id="'+uid+'">'+name+'<i class="fa fa-close ser_cross closeuser" id="'+uid+'" userid="'+uid+'"></i> </div> ');website('#approvernm').val(arr);new PNotify({title:'Alert',text:"APPROVER ADDED SUCCESSFULLY",type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}
else
{new PNotify({title:'Alert',text:"APPROVER Already EXIST",type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}});website('body').on('click','.closeuser',function(e)
{var idd=website(this).attr('id');var len=website(".closeuser").length;website('#'+idd).remove();var position=useridarray.indexOf(idd);useridarray.splice(position,1);var arr=useridarray.toString()
website('#approvernm').val(arr);if(len==1)
{website('#appendapp').css('display','none');}});website(document).ready(function(){var len=website(".closeuser").length;if(len==0)
{website('#appendapp').css('display','none');}
website("#search-box").on("keyup",function(){var search=website('#search-box').val();if(search=="")
{website('#live-search-header-wrapper ul').html('<li class="noresultfound"><span class="resp_new">USER NOT FOUND..!!</span></li>');}
else{var formdata={search:search};website.ajax({url:'usermaster/searchuser',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{website('#live-search-header-wrapper').fadeIn();website('#live-search-header-wrapper ul').html("<li>Please wait...</li>");website('.mainprogressbarforall .progress').fadeIn();website('.filtr-container').html("");website('.filtr-container').removeAttr("style");website('.filtr-search').fadeIn();website('.filtr-search').val("");},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{var addhtml='';website('#live-search-header-wrapper ul').html("");website('#live-search-header-wrapper').fadeIn();if(response.logged==true&&response.data.length>=1)
{for(var i=0;i<response.data.length;i++)
{if(i==0)
{addhtml+='<li uid="'+response.data[i].wr_id+'" id="'+response.data[i].id+'" name="'+response.data[i].fullname+'"  class="topul validatorsid">'+response.data[i].fullname;addhtml+='<div class="clearelement"></div></li>';}
else if(i==((response.data.length)-1))
{addhtml+='<li uid="'+response.data[i].wr_id+'" id="'+response.data[i].id+'" name="'+response.data[i].fullname+'" class="topul validatorsid">'+response.data[i].fullname;addhtml+='<div class="clearelement"></div></li>';}
else
{addhtml+='<li uid="'+response.data[i].wr_id+'" id="'+response.data[i].id+'"  name="'+response.data[i].fullname+'" class="topul validatorsid">'+response.data[i].fullname;addhtml+='<div class="clearelement"></div></li>';}}
website('#live-search-header-wrapper ul').html(addhtml);}
else
{website('#live-search-header-wrapper ul').html('<li class="noresultfound"><span class="resp_new">'+response.message+'</span></li>');}
website(".mainprogressbarforall .progress .progress-bar").width('100%');},complete:function(response)
{website('.search-row').fadeIn();website(".mainprogressbarforall .progress .progress-bar").fadeOut();},complete:function(response)
{website('.search-row').fadeIn();website(".mainprogressbarforall .progress .progress-bar").fadeOut();},error:function(jqXHR,textStatus,errorThrown)
{}});}});});website('body').on('click','.editapprover',function(e)
{var idd=website(this).attr('edituserid');var fullname=website(this).attr('fullname');var chkid="edit_"+idd;len=website("#appapnd #"+chkid).length;if(len<=0){html='<div class="append_div" id="edit_'+idd+'" edituserid="'+idd+'">'+fullname+'<i class="fa fa-close ser_cross closeedit" edituserid="'+idd+'"></i></div>';website('#appapnd').css('display','block');var approveid=website('#approveid').val();var arr=approveid.split(",");if(arr=='')
{var arr=[];arr.push(idd);str=arr.toString();website("#Mymodaledit #approveid").val(str);}
else{arr.push(idd);str=arr.toString();website("#Mymodaledit #approveid").val(str);}
website('#appapnd').append(html);new PNotify({title:'Alert',text:"APPROVER ADDED SUCCESSFULLY",type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}else{new PNotify({title:'Alert',text:"APPROVER Already EXIST",type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}});website('body').on('click','.closeedit',function(e)
{var approveid=website('#approveid').val();var arr=approveid.split(",");var len=website(".closeedit").length;var idd=website(this).attr('edituserid');website('#edit_'+idd).remove();var position=arr.indexOf(idd);arr.splice(position,1);var str=arr.toString();website('#approveid').val(str);if(len==1){website('#appapnd').css('display','none');}});website(document).ready(function(){if(website(".closeedit").length==0)
{website('#myeditlist').css('display','none');}
website("#Mymodaledit #approvername").on("keyup",function(){var search=website('#Mymodaledit #approvername').val();if(search==""){website('#myeditlist').css('display','none');}
else{website('#myeditlist').css('display','block');var formdata={search:search};website.ajax({url:'usermaster/searchuser',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged==true||response.length>=1)
{var myhtml='<ul>';for(var z=0;z<response.data.length;z++)
{myhtml+='<li class="editapprover" edituserid="'+response.data[z].wr_id+'" fullname="'+response.data[z].fullname+'">'+response.data[z].fullname+'</li>';myhtml+='<div class="clearelement"></div>';}
myhtml+='</ul>';website('#myeditlist').html(myhtml);}
else{website('#myeditlist').html('<div>User Not Found..!!</div>');}},});}});});;