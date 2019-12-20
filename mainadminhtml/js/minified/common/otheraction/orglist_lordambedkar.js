
function getcurrencyt()
{var cmid='currunctype';var appendhtml='';website.ajax({url:'commonbuddha/getcurrency',data:'',method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{website('.progress-indeterminate').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{if(response.logged===true)
{for(var i=0;i<response.data.length;i++)
{appendhtml+='<option value="'+response.data[i].currency_id+'">'+response.data[i].title+'</option>';}
website('#'+cmid).html(appendhtml);website('#'+cmid).prepend('<option value="" selected>Select one option</option>');}
else
{website('#'+cmid).prepend('<option value="" selected>Contact to website Admin</option>');}}},complete:function(response)
{website('.progress-indeterminate').fadeOut();},error:function(jqXHR,textStatus,errorThrown)
{}});}
function getstatet(cmid,cid)
{var appendhtml='';var cid=cid;var formData={cid:cid};website.ajax({url:'commonbuddha/getstate',data:formData,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{website('.progress-indeterminate').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{if(response.logged===true)
{for(var i=0;i<response.data.length;i++)
{appendhtml+='<option value="'+response.data[i].id+'">'+response.data[i].name+'</option>';}
website('#'+cmid).html(appendhtml);website('#'+cmid).prepend('<option value="" selected>Select one option</option>');if(cmid=='stateget')
{website('#'+cmid).val('22');}}
else
{website('#'+cmid).prepend('<option value="" selected>Contact to website Admin</option>');}}},complete:function(response)
{website('.progress-indeterminate').fadeOut();},error:function(jqXHR,textStatus,errorThrown)
{}});}
function getaddrtbl(tpof,cid)
{var appendhtml='';var formData={tpof:tpof,cid:cid};website.ajax({url:'organisation/getaddrdtl',data:formData,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{website('.progress-indeterminate').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{var appendhtml='';if(response.logged===true)
{var j=1;for(var i=0;i<1;i++)
{appendhtml+='<div class="bnaddrdtl">';appendhtml+='<div class="addrdtlltml banknamemlp nmnmnm">Address '+j+' : </div>';appendhtml+='<div class="addresslong">'+response.data[i].addresslong+'</div>';appendhtml+='<div class="mobile"><i class="fa fa-mobile"></i> '+response.data[i].mobile+'</div>';appendhtml+='<div class="landline"><i class="fa fa-phone"></i> '+response.data[i].landline+'</div>';appendhtml+='</div>';j++;}
website('.bnaddrdtlmn').html(appendhtml);}
else
{}},complete:function(response)
{website('.progress-indeterminate').fadeOut();},error:function(jqXHR,textStatus,errorThrown)
{}});}
function getbanctbl(tpof,cid)
{var appendhtml='';var formData={tpof:tpof,cid:cid};website.ajax({url:'organisation/getbancdtl',data:formData,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{website('.progress-indeterminate').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{var appendhtml='';if(response.logged===true)
{var j=1;for(var i=0;i<1;i++)
{appendhtml+='<div class="bncdtlmn">';appendhtml+='<div class="banknamemlp nmnmnm">Bank Details '+j+'</div>';appendhtml+='<div class="bankname nmnmnm"><div class="ttl">Bank Name :</div><div class="floatleft"> '+response.data[i].bankname+'</div>';appendhtml+='<div class="clearelement"></div></div>';appendhtml+='<div class="actype nmnmnm"><div class="ttl">Bank Name :</div><div class="floatleft">'+response.data[i].actype+'</div>';appendhtml+='<div class="clearelement"></div></div>';appendhtml+='<div class="bankac nmnmnm"><div class="ttl">A/C num :</div>'+response.data[i].bankac+'</div>';appendhtml+='<div class="bankbranch nmnmnm"><div class="ttl">Branch :</div><div class="floatleft">'+response.data[i].bankbranch+'</div>';appendhtml+='<div class="clearelement"></div></div>';appendhtml+='<div class="bankifsc nmnmnm"><div class="ttl">IFSC :</div><div class="floatleft">'+response.data[i].bankifsc+'</div>';appendhtml+='<div class="clearelement"></div></div>';appendhtml+='<div class="bankmirc nmnmnm"><div class="ttl">MIRC :</div><div class="floatleft">'+response.data[i].bankmirc+'</div>';appendhtml+='<div class="clearelement"></div></div>';appendhtml+='<div class="addressshort nmnmnm"><div class="ttl">Address :</div><div class="floatleft">'+response.data[i].addressshort+'</div>';appendhtml+='<div class="clearelement"></div></div>';appendhtml+='</div>';j++;}
website('.bncdtl').html(appendhtml);}
else
{}},complete:function(response)
{website('.progress-indeterminate').fadeOut();},error:function(jqXHR,textStatus,errorThrown)
{}});}
website('body').on('change','#countryget',function(e){var cid=website(this).val();if(cid!='')
{getstatet('stateget',cid);}});website('body').on('change','#countrygetu',function(e){var cid=website(this).val();if(cid!='')
{getstatet('stategetu',cid);}});website('body').on('click','.viewbtnattr',function(e){var cid=website(this).attr('data-iron');var attr=website(this).attr('data-bat');getattrtbl('all',cid);getaddrtbl('all',cid);getbanctbl('all',cid);getorgdtmmnmn('one',cid);website('#myModalViewOrg').modal('show');website('.nnmtmtmtmtm a').attr('href','organisation?moc='+cid);});function getattrtbl(tpof,cid)
{var appendhtml='';var formData={tpof:tpof,cid:cid};website.ajax({url:'organisation/getattrdtl',data:formData,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{website('.progress-indeterminate').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{var appendhtml='';if(response.logged===true)
{var j=1;for(var i=0;i<response.data.length;i++)
{appendhtml+='<div class="bnattrdtl">';appendhtml+='<div class="namenmm floatleft">'+response.data[i].name+'</div>';appendhtml+='<div class="descnmnm floatleft">'+response.data[i].desc+'</div>';appendhtml+='<div class="clearelement"></div>';appendhtml+='</div>';}
website('.bnattrdtlmn').html(appendhtml);}
else
{}},complete:function(response)
{website('.progress-indeterminate').fadeOut();},error:function(jqXHR,textStatus,errorThrown)
{}});}
function getorgdtm(tpof,cid)
{var formData='';website.ajax({url:'organisation/getorgdtlmn',data:formData,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{website('.progress-indeterminate').fadeIn();website('#Validateorgdtl').addClass('disabled');},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{var j=1;var appendhtml='';for(var i=0;i<response.data.length;i++)
{appendhtml+='<tr ironmanraju="'+response.data[i].id+'">';appendhtml+='<td>'+j+'</td>';appendhtml+='<td>'+response.data[i].fullname+'</td>';appendhtml+='<td>'+response.data[i].indtp+'</td>';appendhtml+='<td>'+response.data[i].orgcode+'</td>';appendhtml+='<td>'+response.data[i].empcount+'</td>';appendhtml+='<td><div class="comnbtnact">';appendhtml+='<div class="floatleft viewbtnattr" data-iron="'+response.data[i].id+'" ><i class="fa fa-eye"></i></div>';appendhtml+='<div class="floatleft editbtnattr"  data-iron="'+response.data[i].id+'" ><a href="organisation?moc='+response.data[i].id+'" ><i class="fa fa-edit"></i></a></div>';appendhtml+='<div class="floatleft trashbtnattr" data-iron="'+response.data[i].id+'" ><i class="fa fa-trash"></i></div>';appendhtml+='<div class="clearelement"></div>';appendhtml+='</div></td>';appendhtml+='</tr>';++j;}
website('.tdsdeducteedata').html(appendhtml);website('.addrorgtl .datatable-responsive').DataTable();}
else
{website('.orgdtlmmn').fadeOut();}
website('#Validateorgdtl').removeClass('disabled');},complete:function(response)
{website('.progress-indeterminate').fadeOut();},error:function(jqXHR,textStatus,errorThrown)
{}});}
function getorgdtmmnmn(tpof,cid)
{var formData={tpof:tpof,cid:cid};website.ajax({url:'organisation/getorgdtlmn',data:formData,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{website('.progress-indeterminate').fadeIn();website('#Validateorgdtl').addClass('disabled');},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{website('.compnamem').html(response.data[0].fullname);website('.indtype').html(response.data[0].indtp);website('.ownerfname').html(response.data[0].ownerfname);website('.ownerlname').html(response.data[0].ownerlname);website('.frmtp').html(response.data[0].frmtp);website('.emailmn').html(response.data[0].emailmn);}
else
{}},complete:function(response)
{website('.progress-indeterminate').fadeOut();},error:function(jqXHR,textStatus,errorThrown)
{}});}
getorgdtm('all',0);;