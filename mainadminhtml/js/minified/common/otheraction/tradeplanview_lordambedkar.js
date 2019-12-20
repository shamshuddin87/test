
website(document).ready(function()
{website('.bootdatepick').datetimepicker({weekStart:1,todayBtn:0,autoclose:1,todayHighlight:0,startView:2,minView:2,forceParse:0,format:"dd-mm-yyyy"}).on('change',function(e,date)
{var getdate=website(this).val();var getid=website(this).closest('form').attr('id');});});website('body').on('change','#noofrows',function(e)
{getdataonload();});website('body').on('click','.paginationmn li',function(e)
{var rscrntpg=website(this).attr('p');website('.panel.panel-white #pagenum').val(rscrntpg);getdataonload();});website('body').on('click','.go_button',function(e)
{var rscrntpg=website('.gotobtn').val();website('.panel.panel-white #pagenum').val(rscrntpg);getdataonload();});getdataonload();function getdataonload()
{var tradeid=website('#tradeid').val();var tradeuniqid=website('#tradeuniqueid').val();var noofrows=website('#noofrows').val();var pagenum=website('#pagenum').val();var formdata={tradeid:tradeid,tradeuniqid:tradeuniqid,noofrows:noofrows,pagenum:pagenum}
website.ajax({url:'tradingplan/fetchtradeplanview',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{var addhtmlnxt='';var a=[];var planid='';var sendstatus=[];for(var i=0;i<response.resdta.length;i++)
{sendstatus.push(response.resdta[i].send_status);var name=response.resdta[i].name?response.resdta[i].name:'';var tradingplan=response.resdta[i].tradingplan?response.resdta[i].tradingplan:'';var companyname=response.resdta[i].companyname?response.resdta[i].companyname:'';var fromdate=response.resdta[i].fromdate?response.resdta[i].fromdate:'';var todate=response.resdta[i].todate?response.resdta[i].todate:'';var security_type=response.resdta[i].security_type?response.resdta[i].security_type:'';var specificdate=response.resdta[i].specificdate?response.resdta[i].specificdate:'';var daterangefrm=response.resdta[i].daterangefrm?response.resdta[i].daterangefrm:'';var daterangeto=response.resdta[i].daterangeto?response.resdta[i].daterangeto:'';var valueofsecu=response.resdta[i].valueofsecu?response.resdta[i].valueofsecu:'';var noofsecu=response.resdta[i].noofsecu?response.resdta[i].noofsecu:'';website('#reqstfr option[value='+response.resdta[i].requestfor+']').attr("selected","selected");if(response.resdta[i].relative)
{website('#relative option[value='+response.resdta[i].relative+']').attr("selected","selected");}
else
{website('#reltv').hide();}
website('#frmdate').val(fromdate);website('#todate').val(todate);website('#cmpnme option[value='+response.resdta[i].companyid+']').attr("selected","selected");addhtmlnxt+='<tr class="counter" tradeplnid="'+response.resdta[i].id+'">';addhtmlnxt+='<td width="15%">'+security_type+'</td>';addhtmlnxt+='<td width="15%">'+specificdate+'</td>';addhtmlnxt+='<td width="15%">'+daterangefrm+'</td>';addhtmlnxt+='<td width="15%">'+daterangeto+'</td>';addhtmlnxt+='<td width="15%">'+noofsecu+'</td>';addhtmlnxt+='<td width="15%">'+valueofsecu+'</td>';if(response.resdta[i].send_status==0)
{website('.sendtradeplan').show();website('#edittradeplan').show();addhtmlnxt+='<td width="15%"><i class="fa fa-edit faicon floatleft updatetrading" title="Edit entry" tradeplanid="'+response.resdta[i].id+'" uniquid="'+response.resdta[i].uniqueid+'"></i><i class="fa fa-trash-o faicon floatleft deletetrade" title="Delete entry" tradeplanid="'+response.resdta[i].id+'" ></i></td>';}
if(response.resdta[i].send_status==1&&response.resdta[i].approvedstatus==0)
{website('.sendtradeplan').hide();website('#edittradeplan').hide();addhtmlnxt+='<td width="15%"></td>';}
if(response.resdta[i].send_status==1&&response.resdta[i].approvedstatus==1)
{website('.sendtradeplan').hide();website('#edittradeplan').hide();addhtmlnxt+='<td width="15%"></td>';}
if(response.resdta[i].send_status==1&&response.resdta[i].approvedstatus==2)
{website('.sendtradeplan').show();website('#edittradeplan').show();addhtmlnxt+='<td width="15%"><i class="fa fa-edit faicon floatleft updatetrading" title="Edit entry" tradeplanid="'+response.resdta[i].id+'" uniquid="'+response.resdta[i].uniqueid+'"></i><i class="fa fa-trash-o faicon floatleft deletetrade" title="Delete entry" tradeplanid="'+response.resdta[i].id+'" ></i></td>';}
else
{}
addhtmlnxt+='</tr>';a.push(response.resdta[i].id);planid=a.join(",");}
website('.sendtradeplan').attr('idss',planid);website('.appendtradeplanview').html(addhtmlnxt);website('.paginationmn').html(response.pgnhtml);}
else
{website('.paginationmn').html(response.pgnhtml);}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function(jqXHR,textStatus,errorThrown)
{}});}
website('body').on('click','.edittradeplan',function()
{var trdeplnids=website(this).attr('tradeplanid');var uniquid=website(this).attr('uniquid');var baseHref=getbaseurl();window.location.href=baseHref+'tradingplan/tradeplanview?tradeid='+trdeplnids+'&&uniqueid='+uniquid+'';});website('body').on('click','.sendtradeplan',function()
{var tradeid=website(this).attr('idss');var formdata={tradeid:tradeid}
website.ajax({url:'tradingplan/sendplanforapprv',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{website('.preloder_wraper').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{website('.preloder_wraper').fadeIn();},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{new PNotify({title:'Alert!',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});window.location.reload();}
else
{new PNotify({title:'Alert!',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function(jqXHR,textStatus,errorThrown)
{}});});website('body').on('click','.updatetrading',function()
{var trdeplnids=website(this).attr('tradeplanid');var uniquid=website(this).attr('uniquid');var formdata={trdeplnids:trdeplnids}
website.ajax({url:'tradingplan/fetchtradeplanedit',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{website('#specfdte').hide();website('#dtrngfrm').hide();website('#dterngto').hide();var addhtmlnxt='';for(var i=0;i<response.resdta.length;i++)
{var name=response.resdta[i].name?response.resdta[i].name:'';var tradingplan=response.resdta[i].tradingplan?response.resdta[i].tradingplan:'';var companyname=response.resdta[i].companyname?response.resdta[i].companyname:'';var fromdate=response.resdta[i].fromdate?response.resdta[i].fromdate:'';var todate=response.resdta[i].todate?response.resdta[i].todate:'';var security_type=response.resdta[i].security_type?response.resdta[i].security_type:'';var specificdate=response.resdta[i].specificdate?response.resdta[i].specificdate:'';var daterangefrm=response.resdta[i].daterangefrm?response.resdta[i].daterangefrm:'';var daterangeto=response.resdta[i].daterangeto?response.resdta[i].daterangeto:'';var valueofsecu=response.resdta[i].valueofsecu?response.resdta[i].valueofsecu:'';var noofsecu=response.resdta[i].noofsecu?response.resdta[i].noofsecu:'';website('#requestfor').val(response.resdta[i].requestfor);website('#relative').val(response.resdta[i].relative);website('#companyid').val(response.resdta[i].companyid);website('#fromdate').val(fromdate);website('#todate').val(todate);website('#planid').val(response.resdta[i].id);website('#sectype option[value='+response.resdta[i].secutype+']').attr("selected","selected");website('#datetype option[value='+response.resdta[i].datetype+']').attr("selected","selected");if(daterangefrm)
{website('#dtrngfrm').show();website('#daterngfrm').val(daterangefrm);}
if(daterangeto)
{website('#dterngto').show();website('#daterngto').val(daterangeto);}
if(specificdate)
{website('#specfdte').show();website('#spficdate').val(specificdate);}
website('#noofsec').val(noofsecu);website('#valueofsecurity').val(valueofsecu);}
website('#Mymodalplanedit').modal('show');}
else
{}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function(jqXHR,textStatus,errorThrown)
{}});});website('#updateplan').ajaxForm({dataType:"json",beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{new PNotify({title:'Record Added Successfully',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});window.location.reload();getdataonload();}else{new PNotify({title:'Record Not Added',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function(jqXHR,textStatus,errorThrown)
{}});website("#reqstfr").change(function()
{var value=website(this).val();if(value==2)
{website('#reltv').show();}
else
{website('#reltv').hide();}});website("#Mymodalplanedit #datetype").change(function()
{var value=website(this).val();if(value==1)
{website('#Mymodalplanedit #specfdte').show();website('#Mymodalplanedit #dtrngfrm').hide();website('#Mymodalplanedit #dterngto').hide();website("#Mymodalplanedit #dtrngfrm").val('');website("#Mymodalplanedit #dterngto").val('');}
else if(value==2)
{website('#Mymodalplanedit #specfdte').hide();website('#Mymodalplanedit #dtrngfrm').show();website('#Mymodalplanedit #dterngto').show();website("#Mymodalplanedit #specfdte").val('');}
else
{website('#Mymodalplanedit #specfdte').hide();website('#Mymodalplanedit #dtrngfrm').hide();website('#Mymodalplanedit #dterngto').hide();website("#Mymodalplanedit #dtrngfrm").val('');website("#Mymodalplanedit #dterngto").val('');website("#Mymodalplanedit #specfdte").val('');}});website('body').on('click','.addtradeplan',function()
{website.ajax({url:'tradingplan/fetchsectype',method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{var getlastid=website('.appendtrade').attr('plancntr');getlastid=++getlastid;var addhtmlnxt='';addhtmlnxt+='<div class="row'+getlastid+' formelementmain" id="row'+getlastid+'" >';var appendsectype='';appendsectype+='<option value="">Select Security</option>';website.each(response.resdta,function(index,value){appendsectype+='<option value='+value['id']+'>'+value['security_type']+'</option>';});addhtmlnxt+='<section class="col col-md-3 col-xs-3"><div class="input"><label class="control-label">Type Of Security</label><select id="sectype" name="sectype[]" class="form_fields form-control col-md-7 col-xs-12" required>'+appendsectype+'</select></div></section>';addhtmlnxt+='<section class="col col-md-3 col-xs-3"><div class="input"><label class="control-label">Date Type</label><select id="datetype" name="datetype[]" class="form_fields form-control col-md-7 col-xs-12" required><option value="">Select Date Type</option><option value="1">Specific Date</option><option value="2">Date Range</option></select></div></section>';addhtmlnxt+='<section class="col col-md-3 col-xs-3" id="specfdte"><div class="input"><label class="control-label">Specific Date</label><input type="text" class="form-control bootdatepick" id="spficdate"  name="spficdate[]" readonly></div></section>';addhtmlnxt+='<section class="col col-md-3 col-xs-3" id="dtrngfrm"><div class="input"><label class="control-label">Date Range From</label><input type="text" class="form-control bootdatepick" id="daterngfrm"  name="daterngfrm[]" readonly></div></section>';addhtmlnxt+='<section class="col col-md-3 col-xs-3" id="dterngto"><div class="input"><label class="control-label">Date Range To</label><input type="text" class="form-control bootdatepick" id="daterngto"  name="daterngto[]" readonly></div></section>';addhtmlnxt+='<section class="col col-md-3 col-xs-3"><div class="input"><label class="control-label">No.of Securities</label><input type="text" class="form-control" id="noofsec"  name="noofsec[]" onkeypress="return numberOnly()"></div></section>';addhtmlnxt+='<section class="col col-md-3 col-xs-3"><div class="input"><label class="control-label">Value of Securities</label><input type="text" class="form-control" id="valueofsecurity"  name="valueofsecurity[]" onkeypress="return numberOnly()"></div></section>';addhtmlnxt+='</div>';website('.num').attr('value',getlastid);website('.appendtradingplan').append(addhtmlnxt);website('.row'+getlastid+' #specfdte').hide();website('.row'+getlastid+' #dtrngfrm').hide();website('.row'+getlastid+' #dterngto').hide();website('.appendtrade').attr('plancntr',getlastid);loaddatetype();loaddatepick();numberOnly();},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});});function loaddatepick()
{website('.bootdatepick').datetimepicker({weekStart:1,todayBtn:0,autoclose:1,todayHighlight:0,startView:2,minView:2,forceParse:0,format:"dd-mm-yyyy"}).on('change',function(e,date)
{var getdate=website(this).val();var getid=website(this).closest('form').attr('id');});}
function loaddatetype()
{website(".appendtradingplan #datetype").on('change',function()
{var rowid=website(this).closest('div .formelementmain').attr('id');var value=website(this).val();if(value==1)
{website('.'+rowid+' #specfdte').show();website('.'+rowid+' #dtrngfrm').hide();website('.'+rowid+' #dterngto').hide();website('.'+rowid+' #dtrngfrm').val('');website('.'+rowid+' #dterngto').val('');}
else if(value==2)
{website('.'+rowid+' #specfdte').hide();website('.'+rowid+' #dtrngfrm').show();website('.'+rowid+' #dterngto').show();website('.'+rowid+' #specfdte').val('');}
else
{website('.'+rowid+' #specfdte').hide();website('.'+rowid+' #dtrngfrm').hide();website('.'+rowid+' #dterngto').hide();website('.'+rowid+' #dtrngfrm').val('');website('.'+rowid+' #dterngto').val('');website('.'+rowid+' #specfdte').val('');}});}
website('body').on('click','.remvtradeplan',function()
{var count=website('.appendtrade').attr('plancntr');if(count!=1)
{website('.appendtradingplan #row'+count).remove();website('.appendtrade').attr('plancntr',parseInt(count)-1);}
else
{return false;}});website("#reqstfr").change(function()
{var value=website(this).val();if(value==2)
{website('#reltv').show();}
else
{website('#reltv').hide();}})
website("#datetype").change(function()
{var value=website(this).val();if(value==1)
{website('#specfdte').show();website('#dtrngfrm').hide();website('#dterngto').hide();website("#dtrngfrm").val('');website("#dterngto").val('');}
else if(value==2)
{website('#specfdte').hide();website('#dtrngfrm').show();website('#dterngto').show();website("#specfdte").val('');}
else
{website('#specfdte').hide();website('#dtrngfrm').hide();website('#dterngto').hide();website("#dtrngfrm").val('');website("#dterngto").val('');website("#specfdte").val('');}})
website('#updateplan').ajaxForm({dataType:"json",beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{new PNotify({title:'Record Added Successfully',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});window.location.reload();getdataonload();}else{new PNotify({title:'Record Not Added',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function(jqXHR,textStatus,errorThrown)
{}});website('#inserttrade').ajaxForm({dataType:"json",beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{new PNotify({title:'Record Added Successfully',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});window.location.reload();getdataonload();}else{new PNotify({title:'Record Not Added',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function(jqXHR,textStatus,errorThrown)
{}});website('body').on('click','.deletetrade',function(){var id=website(this).attr('tradeplanid');website('#myModalyesno').modal('show');website('#myModalyesno .yesconfirm').attr('tradeplanid',id);});website('body').on('click','.yesconfirm',function(){var id=website(this).attr('tradeplanid');var formdata={id:id};website.ajax({url:'tradingplan/deletetradeplan',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{window.location.reload();new PNotify({title:'Record Deleted Successfully',text:'Record Deleted Successfully',type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}
else
{new PNotify({title:'Record Not Deleted',text:'Record Not Updated',type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{website('#myModalyesno .mainprogressbarforall').fadeOut();},error:function()
{}});});function numberOnly()
{var charCode=event.keyCode;if((charCode>47&&charCode<58)||charCode==46)
return true;else
return false;};