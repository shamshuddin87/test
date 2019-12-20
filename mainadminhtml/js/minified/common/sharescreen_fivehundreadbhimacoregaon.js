
website('body').on('click','.btnaddrole',function(e)
{var baseHref=getbaseurl();window.location.href=baseHref+'sharescreen';});website('body').on('click','.uploadbtn',function(e)
{website('#sharescreen').ajaxForm({dataType:"json",beforeSend:function()
{website('.preloder_wraper').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{website('.preloder_wraper').fadeIn();},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{setTimeout(function(){website('.preloder_wraper').fadeOut();},2000);new PNotify({title:'Success',text:'Record saved successfully',type:'university',hide:true,styling:'bootstrap3',addclass:'bg-primary alert-styled-left',});setTimeout(function(){window.location.reload();},3000);}
else
{new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'bg-primary alert-styled-left',});window.location.reload();}},complete:function(response)
{setTimeout(function(){website('.preloder_wraper').fadeOut();},2000);},error:function()
{}});});getsharescreenlinks();function getsharescreenlinks(evntid,typeid,bmtype)
{var evntid=website('#evntid').attr('evnt');var typid=website('#typeid').attr('typid');var appendhtml='';var formdata={evntid:evntid,typid:typid};website.ajax({url:'sharescreen/fetchdoclinks',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{var addhtmlnxt='';var j=1;for(var i=0;i<response.data.length;i++)
{addhtmlnxt+='<tr>';addhtmlnxt+='<td width="5%">'+j+'</td>';addhtmlnxt+='<td width="20%"><a href="'+response.data[i].docpath+'">'+response.data[i].filename+'</a></td>';addhtmlnxt+='<td width="5%"><i class="fa fa-trash dellinks"  id="dellinks" evntid='+response.data[i].evnt_id+' linkid='+response.data[i].id+' typeid='+response.data[i].typeid+' aria-hidden="true" style="cursor: pointer;"></i></td>';addhtmlnxt+='</tr>';++j;}
website('#sharedlist').html(addhtmlnxt);website('.sharelistlinks').DataTable();}
else
{addhtmlnxt+='<tr>';addhtmlnxt+='<td>No data found</td>';addhtmlnxt+='</tr>';website('#sharedlist').html(addhtmlnxt);website('.sharelistlinks').DataTable();}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});}
website('body').on('click','.dellinks',function(e)
{var evntid=website(this).attr('evntid');var typid=website(this).attr('typeid');var linkid=website(this).attr('linkid');website('#myModalyesno').fadeIn();website('.yesconfirm').attr('evntid',evntid);website('.yesconfirm').attr('typid',typid);website('.yesconfirm').attr('linkid',linkid);});website('body').on('click','.yesconfirm',function(e)
{website('#myModalyesno').fadeOut();var evntid=website(this).attr('evntid');var typid=website(this).attr('typid');var linkid=website(this).attr('linkid');var formdata={evntid:evntid,typid:typid,linkid:linkid};website.ajax({url:'sharescreen/dellinks',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'bg-primary alert-styled-left',});getsharescreenlinks();}
else
{new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'bg-primary alert-styled-left',});}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});});website('body').on('click','.shscrclose',function(e)
{website('#myModalyesno').fadeOut();});website('body').on('click','.shscrbtnno',function(e)
{website('#myModalyesno').fadeOut();});function shareListHeading(evntid,typeid,bmtype)
{website(".sharedbtn").attr("typeid",typeid);website(".sharedbtn").attr("eventid",evntid);website('.sharedbtn').text("Shared List Of"+" "+bmtype);}
website('body').on('click','.btnaddrole',function(e)
{var baseHref=getbaseurl();window.location.href=baseHref+'sharescreen';});website('body').on('click','.btnsharescreen',function(e)
{website('#sharescreenother').modal('show');var appendhtml='';var formData={tpof:'all',cid:0};website.ajax({url:'employeerecord/getemptbl',data:formData,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{website('.progress-indeterminate').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{var j=1;for(var i=0;i<response.data.length;i++)
{appendhtml+='<tr><td><label class="checkbox-inline"><input type="checkbox" name="sharelist[]" id="chkbx" value="'+response.data[i].id+'" emailid="'+response.data[i].emaild+'"></label></td><td>'+response.data[i].fname+' '+response.data[i].lname+'</td></tr>';++j;}
website('#listforsharesrc').html(appendhtml);}
else
{}},complete:function(response)
{website('.progress-indeterminate').fadeOut();},error:function(jqXHR,textStatus,errorThrown)
{}});});website('body').on('click','.sharesrcwithothr',function(e)
{var uid=website('#sharewithothers #uid').val();website(".preloder_wraper").fadeIn();website('#sharewithothers').ajaxForm({dataType:"json",beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{website('.preloder_wraper').fadeOut();if(response.logged===true)
{new PNotify({title:'Success',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});website('#sharescreenother').modal('hide');var rdata=jQuery.parseJSON(response.screenshare);screenleap.startSharing('DEFAULT',rdata);}
else
{new PNotify({title:'Failed',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{},error:function()
{}});});getconnectionurl();function getconnectionurl()
{var uid=website("#userid").val();var typid=website("#typeid").val();var evntid=website("#evntid").val();var appendhtml='';var formdata={userid:uid,typid:typid,evntid:evntid};website.ajax({url:'sharescreen/fetchscreenshareurl',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{var addhtmlnxt='';var j=1;for(var i=0;i<response.data.length;i++)
{addhtmlnxt+='<div class="share-screen" align="center" style="height:300px;">';addhtmlnxt+='<a href="'+response.data[i].shared_url+'" target="_blank"><button type="button" class="btnblue" style="margin-top:20px;" >Join Now</button></a>';addhtmlnxt+='</div>';++j;}
website('#exitpollcss').html(addhtmlnxt);}
else
{addhtmlnxt+='<tr>';addhtmlnxt+='<td>No data found</td>';addhtmlnxt+='</tr>';website('#exitpollcss').html(addhtmlnxt);}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});};