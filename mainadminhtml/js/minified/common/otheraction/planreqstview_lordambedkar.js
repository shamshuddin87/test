
website(document).ready(function()
{website('.bootdatepick').datetimepicker({weekStart:1,todayBtn:0,autoclose:1,todayHighlight:0,startView:2,minView:2,forceParse:0,format:"dd-mm-yyyy"}).on('change',function(e,date)
{var getdate=website(this).val();var getid=website(this).closest('form').attr('id');});});website('body').on('change','#noofrows',function(e)
{getdataonload();});website('body').on('click','.paginationmn li',function(e)
{var rscrntpg=website(this).attr('p');website('.panel.panel-white #pagenum').val(rscrntpg);getdataonload();});website('body').on('click','.go_button',function(e)
{var rscrntpg=website('.gotobtn').val();website('.panel.panel-white #pagenum').val(rscrntpg);getdataonload();});getdataonload();function getdataonload()
{var noofrows=website('#noofrows').val();var pagenum=website('#pagenum').val();var formdata={noofrows:noofrows,pagenum:pagenum}
website.ajax({url:'tradingplan/fetchplanforapprove',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{var addhtmlnxt='';var a=[];var planid='';for(var i=0;i<response.resdta.length;i++)
{var name=response.resdta[i].name?response.resdta[i].name:'';var username=response.resdta[i].fullname?response.resdta[i].fullname:'';var tradingplan=response.resdta[i].tradingplan?response.resdta[i].tradingplan:'';var companyname=response.resdta[i].companyname?response.resdta[i].companyname:'';var fromdate=response.resdta[i].fromdate?response.resdta[i].fromdate:'';var todate=response.resdta[i].todate?response.resdta[i].todate:'';var security_type=response.resdta[i].security_type?response.resdta[i].security_type:'';var specificdate=response.resdta[i].specificdate?response.resdta[i].specificdate:'';var daterangefrm=response.resdta[i].daterangefrm?response.resdta[i].daterangefrm:'';var daterangeto=response.resdta[i].daterangeto?response.resdta[i].daterangeto:'';var valueofsecu=response.resdta[i].valueofsecu?response.resdta[i].valueofsecu:'';var noofsecu=response.resdta[i].noofsecu?response.resdta[i].noofsecu:'';addhtmlnxt+='<tr class="counter" tradeplnid="'+response.resdta[i].id+'">';addhtmlnxt+='<td width="15%">'+username+'</td>';addhtmlnxt+='<td width="15%">'+name+'</td>';addhtmlnxt+='<td width="15%">'+companyname+'</td>';addhtmlnxt+='<td width="15%">'+fromdate+'</td>';addhtmlnxt+='<td width="15%">'+todate+'</td>';if(response.resdta[i].approvedstatus==0)
{addhtmlnxt+='<td width="15%" style="">Not Approved</td>';}
else if(response.resdta[i].approvedstatus==1)
{addhtmlnxt+='<td width="15%" style="color:green;font-weight:600;"><i class="fa fa-check aprvicon" aria-hidden="true"></i>Approved</td>';}
else
{addhtmlnxt+='<td width="15%" class ="showrejctmsg" style="color:red;font-weight:600;"><i class="fa fa-ban aprvicon" aria-hidden="true"></i>Rejected</td>';}
addhtmlnxt+='<td width="15%" class="trade"><i class="fa fa-eye faicon floatleft edittradeplan" title="Edit entry" id="edittrade" tradeplanid="'+response.resdta[i].id+'" uniquid="'+response.resdta[i].uniqueid+'"></i></td>';addhtmlnxt+='</tr>';a.push(response.resdta[i].id);planid=a.join(",");}
website('.approveplan').attr('idss',planid);website('.appendtradeplanapprvl').html(addhtmlnxt);website('.paginationmn').html(response.pgnhtml);}
else
{website('.paginationmn').html(response.pgnhtml);}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function(jqXHR,textStatus,errorThrown)
{}});}
website('body').on('click','.edittradeplan',function()
{var trdeplnids=website(this).attr('tradeplanid');var uniquid=website(this).attr('uniquid');trdeplnids=btoa(trdeplnids);uniquid=btoa(uniquid);var baseHref=getbaseurl();window.location.href=baseHref+'tradingplan/planreqstapprv?tradeid='+trdeplnids+'&&uniqueid='+uniquid+'';});website('body').on('click','.showrejctmsg',function(e)
{var planid=website(this).parent().attr('tradeplnid');var formdata={planid:planid}
website.ajax({url:'tradingplan/fetchrejectmessage',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{website('#rejectplantrade').val(response.resdta[0].reject_msg).attr('readonly','readonly');website('#tradeplanmodal').modal('show');}
else
{}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function(jqXHR,textStatus,errorThrown)
{}});});;