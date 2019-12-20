
loadattendancedata();function loadattendancedata()
{var appendhtml='';var formData={};website.ajax({url:'meeting/loadattendance',data:formData,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{var addhtmlnxt='';var j=1;for(var i=0;i<response.data.length;i++)
{var weurid='';var weid='';weurid=response.data[i].weurid;weid=response.data[i].weid;addhtmlnxt+='<tr weurid="'+response.data[i].weurid+'" weid="'+response.data[i].weid+'" id="attrow-'+weurid+'" >';addhtmlnxt+='<td width="">'+j+'</td>';addhtmlnxt+='<td width="">'+response.data[i].fname+' '+response.data[i].lname+'</td>';if(response.data[i].preab==null||response.data[i].preab=='')
{addhtmlnxt+='<td class="decide" weurid="'+weurid+'" weid="'+weid+'" > <input type="radio" name="preab_'+weurid+'" value="present" > Present</input>  <input type="radio" name="preab_'+weurid+'" value="absent" > Absent</input> </td>';}
else if(response.data[i].preab=='present')
{addhtmlnxt+='<td class="decide" weurid="'+weurid+'" weid="'+weid+'" > <input type="radio" name="preab_'+weurid+'" value="present" checked> Present</input>  <input type="radio" name="preab_'+weurid+'" value="absent" > Absent</input> </td>';}
else if(response.data[i].preab=='absent')
{addhtmlnxt+='<td class="decide" weurid="'+weurid+'" weid="'+weid+'" > <input type="radio" name="preab_'+weurid+'" value="present" > Present</input>  <input type="radio" name="preab_'+weurid+'" value="absent" checked> Absent</input> </td>';}
if(response.data[i].ipvc==null||response.data[i].ipvc=='')
{addhtmlnxt+='<td><div class="mode-'+weurid+'"> <input type="radio" name="ipvc_'+weurid+'" value="inperson" > In Person</input>  <input type="radio" name="ipvc_'+weurid+'" value="videoconference"> Video Conference</input> </div></td>';}
else if(response.data[i].ipvc=='inperson')
{addhtmlnxt+='<td><div class="mode-'+weurid+'"> <input type="radio" name="ipvc_'+weurid+'" value="inperson" checked> In Person</input>  <input type="radio" name="ipvc_'+weurid+'" value="videoconference"> Video Conference</input> </div></td>';}
else if(response.data[i].ipvc=='videoconference')
{addhtmlnxt+='<td><div class="mode-'+weurid+'"> <input type="radio" name="ipvc_'+weurid+'" value="inperson" > In Person</input>  <input type="radio" name="ipvc_'+weurid+'" value="videoconference" checked> Video Conference</input> </div></td>';}
addhtmlnxt+='<td><i class="fa fa-floppy-o faicon attsaveme" title="Save Entry" weurid="'+response.data[i].weurid+'" weid="'+response.data[i].weid+'" ></i></td>';addhtmlnxt+='</tr>';j++;}
website('.rowsattendance').html(addhtmlnxt);website('#datablerushi').DataTable();showhide(response.data);}
else
{website('.rowsattendance').html('');website('#datablerushi').DataTable();}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});}
website('body').on('click','.btnsharescreen',function(e)
{var baseHref=getbaseurl();window.location.href=baseHref+'sharescreen';});function showhide(resdata)
{for(var i=0;i<resdata.length;i++)
{var weurid='';var weid='';weurid=resdata[i].weurid;weid=resdata[i].weid;if(resdata[i].preab=='absent')
{website('#attrow-'+weurid+' .mode-'+weurid).fadeOut();website('#attrow-'+weurid+' input[name=ipvc_'+weurid+']').prop("checked",false);}}}
website('body').on('click','.decide',function(e)
{var weurid=website(this).attr('weurid');var weid=website(this).attr('weid');var preab=website('#attrow-'+weurid+' input[name=preab_'+weurid+']:checked').val();var ipvc=website('#attrow-'+weurid+' input[name=ipvc_'+weurid+']:checked').val();if(preab=='present')
{website('#attrow-'+weurid+' .mode-'+weurid).fadeIn();}
else if(preab=='absent')
{website('#attrow-'+weurid+' .mode-'+weurid).fadeOut();website('#attrow-'+weurid+' input[name=ipvc_'+weurid+']').prop("checked",false);}});website('body').on('click','.attsaveme',function(e)
{var weurid=website(this).attr('weurid');var weid=website(this).attr('weid');var preab=website('#attrow-'+weurid+' input[name=preab_'+weurid+']:checked').val();var ipvc=website('#attrow-'+weurid+' input[name=ipvc_'+weurid+']:checked').val();var formdata={weurid:weurid,weid:weid,preab:preab,ipvc:ipvc};website.ajax({url:'meeting/attupdate',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{new PNotify({title:response.message,text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}
else
{new PNotify({title:'Alert...',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});});itemvotingdata();function itemvotingdata()
{var appendhtml='';var formData={};website.ajax({url:'meeting/itemvotingdata',data:formData,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{var addhtmlnxt='';var j=0;for(var i=0;i<response.data.length;i++)
{++j;var itemid='';var voteid='';itemid=response.data[i].itemid;voteid=response.data[i].voteid;addhtmlnxt+='<tr itemid="'+itemid+'" voteid="'+voteid+'" id="voterow-'+itemid+'" >';addhtmlnxt+='<td width="">'+j+'</td>';addhtmlnxt+='<td width="">'+response.data[i].itemheader+'</td>';if(response.data[i].note!=null)
{addhtmlnxt+='<td width=""><input type="text" name="pbnote_'+itemid+'" value="'+response.data[i].note+'" placeholder="Please Enter Note" class="nmvt"></td>';}
else
{addhtmlnxt+='<td width=""><input type="text" name="pbnote_'+itemid+'" value="" placeholder="Please Enter Note" class="nmvt"></td>';}
if(response.data[i].vote==null||response.data[i].vote=='')
{addhtmlnxt+='<td>';addhtmlnxt+='<select name="pollbooth_'+itemid+'" class="selvt">';addhtmlnxt+='<option value="">Select Option</option>';addhtmlnxt+='<option value="assent">Assent</option>';addhtmlnxt+='<option value="dissent">Dissent</option>';addhtmlnxt+='<option value="interested">Interested</option>';addhtmlnxt+='</select>';addhtmlnxt+='</div></td>';}
else if(response.data[i].vote=='assent')
{addhtmlnxt+='<td>';addhtmlnxt+='<select name="pollbooth_'+itemid+'" class="selvt">';addhtmlnxt+='<option value="assent" selected>Assent</option>';addhtmlnxt+='<option value="dissent">Dissent</option>';addhtmlnxt+='<option value="interested">Interested</option>';addhtmlnxt+='</select>';addhtmlnxt+='</div></td>';}
else if(response.data[i].vote=='dissent')
{addhtmlnxt+='<td>';addhtmlnxt+='<select name="pollbooth_'+itemid+'" class="selvt">';addhtmlnxt+='<option value="assent">Assent</option>';addhtmlnxt+='<option value="dissent" selected>Dissent</option>';addhtmlnxt+='<option value="interested">Interested</option>';addhtmlnxt+='</select>';addhtmlnxt+='</div></td>';}
else if(response.data[i].vote=='interested')
{addhtmlnxt+='<td>';addhtmlnxt+='<select name="pollbooth_'+itemid+'" class="selvt">';addhtmlnxt+='<option value="assent">Assent</option>';addhtmlnxt+='<option value="dissent">Dissent</option>';addhtmlnxt+='<option value="interested" selected>Interested</option>';addhtmlnxt+='</select>';addhtmlnxt+='</div></td>';}
if(response.data[i].vote==null||response.data[i].vote=='')
{addhtmlnxt+='<td><i class="fa fa-hand-o-up faicon voteme" title="Save Entry" itemid="'+itemid+'" voteid="'+voteid+'" ></i></td>';}
else
{addhtmlnxt+='<td></td>';}
addhtmlnxt+='</tr>';}
website('.rowsvoting').html(addhtmlnxt);website('#datablevoting').DataTable();}
else
{website('.rowsvoting').html('');website('#datablevoting').DataTable();}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});}
website('body').on('click','.voteme',function(e)
{var itemid=website(this).attr('itemid');var voteid=website(this).attr('voteid');var pbnote=website('#voterow-'+itemid+' input[name=pbnote_'+itemid+']').val();var pollres=website('#voterow-'+itemid+' select[name=pollbooth_'+itemid+'] option:selected').val();var formdata={itemid:itemid,voteid:voteid,pbnote:pbnote,pollres:pollres};website.ajax({url:'meeting/voteupdate',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{window.location.reload();new PNotify({title:'Alert...',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}
else
{new PNotify({title:'Alert...',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});});fetchVotingResult();function fetchVotingResult()
{var formdata={};var chkclk='';website.ajax({url:'meeting/fetchVotingResult',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{var addhtmlnxt='';var j=0;for(var i=0;i<response.chartdata.length;i++)
{++j;var assent='';var dissent='';var interested='';var total='';var assentper='';var dessentper='';var interestedper='';var assent=response.chartdata[i].assent;var dissent=response.chartdata[i].dissent;var interested=response.chartdata[i].interested;var total=response.chartdata[i].total;var assentper=(assent/total)*100;var dessentper=(dissent/total)*100;var interestedper=(interested/total)*100;addhtmlnxt+='<tr>';addhtmlnxt+='<td width="5%">'+j+'</td>';addhtmlnxt+='<td width="20%">'+response.chartdata[i].itemheader+'</td>';addhtmlnxt+='<td width="70%"><div class="progress p_'+j+'">';addhtmlnxt+='<div class="progress-bar progress-bar-success" role="progressbar" style="width:'+assentper+'%">'+assent+' ('+assentper+'%) </div>';addhtmlnxt+='<div class="progress-bar progress-bar-danger" role="progressbar" style="width:'+dessentper+'%">'+dissent+' ('+dessentper+'%) </div>';addhtmlnxt+='<div class="progress-bar progress-bar-warning" role="progressbar" style="width:'+interestedper+'%">'+interested+' ('+interestedper+'%) </div>';addhtmlnxt+='</div></td>';addhtmlnxt+='<td width="5%">'+total+'</td>';addhtmlnxt+='</tr>';}
website('.rowsexitpoll').html(addhtmlnxt);website('#datableexitpoll').DataTable();}
else
{website('.rowsexitpoll').html('');website('#datableexitpoll').DataTable();}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});}
website('body').on('click','.saverecord',function(e)
{website(".preloder_wraper").fadeIn();website('#wirteyournotes').ajaxForm({dataType:"json",beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{website('.preloder_wraper').fadeOut();if(response.logged===true)
{new PNotify({title:'Success',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});setTimeout(function(){window.location.reload();},2000);}
else
{new PNotify({title:'Failed',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{},error:function()
{}});});fetchwritenotesdata();function fetchwritenotesdata()
{var appendhtml='';var formData={};website.ajax({url:'meeting/loadwritenotes',data:formData,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{var addhtmlnxt='';if(response.logged===true)
{addhtmlnxt+='<textarea type="text" name="wynotes" id="wynotes" class="form-control" >'+response.wrtntdata[0]['notes']+'</textarea>';website('#wrtyrnotes').html(addhtmlnxt);}
else
{console.log('nothing happend');}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});};