
website(document).ready(function()
{var base_url=window.location.origin;website(".mcscrollbar1,.mcscrollbar2,.mcscrollbar3").mCustomScrollbar({scrollButtons:{enable:true,scrollType:"stepped"},keyboard:{scrollType:"stepped"},mouseWheel:{scrollAmount:188},theme:"rounded-dark",});countofreqpendapp();countofrestrictcomp();countofdepreltv();getallholdingsummary();});function countofrestrictcomp()
{var base_url=window.location.origin;website.ajax({url:'home/countofrestrictcomp',method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{var countofcomp=response.data.length;website('#complist').html(countofcomp);}
else
{var countofcomp=0;website('#complist').html(countofcomp);}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});}
function countofdepreltv()
{var base_url=window.location.origin;website.ajax({url:'home/countofdepreltv',method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{var countofreltv=response.data.length;website('#reltvlist').html(countofreltv);}
else
{var countofreltv=0;website('#reltvlist').html(countofreltv);}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});}
function countofreqpendapp()
{var base_url=window.location.origin;website.ajax({url:'home/countofreqpendapp',method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{var countofpendapprvl=response.data.length;website('#appvlpend').html(countofpendapprvl);}
else
{var countofpendapprvl=0;website('#appvlpend').html(countofpendapprvl);}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});}
function getallholdingsummary()
{var base_url=window.location.origin;website.ajax({url:'home/getallholdingsummary',method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{var addhtmlnxt='';var equitybuysell=[];var preferbuysell=[];var debntrbuysell=[];var equityclosblnc=[];var preferclosblnc=[];var debntrclosblnc=[];var equityopnblnc='';var preferopnblnc='';var debntropnblnc='';var othercloseequity=[];var othercloseprefer=[];var otherclosedebtr=[];var n=0;addhtmlnxt+='<tr class="counter"  >';addhtmlnxt+='<td width="25%">'+response.cmpname+'</td>';addhtmlnxt+='<td width="25%">'+response.equity+'</td>';addhtmlnxt+='<td width="25%">'+response.prefer+'</td>';addhtmlnxt+='</tr>';website('.holdingsummry').html(addhtmlnxt);}
else
{var addhtmlnxt='<tr><td style="text-align:center;" colspan="13">Data Not Found..!!</td></tr>';website('.holdingsummry').html(addhtmlnxt);}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});}
function pdfOpen(){window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');return false;};function remindrofprsnlinfo()
{website.ajax({url:'home/remindrofprsnlinfo',method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{}
else
{}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});}
function remindrofhldngstmnt()
{website.ajax({url:'home/sendremindr',method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{}
else
{}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});}
checkdetails();function checkdetails()
{var firstlogin=website("#firstlogin").val();website.ajax({url:'home/checkdetails',method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{if(firstlogin==0)
{if(response.usergroup!=2)
{website('#updateholdings').modal('show');}}}
else
{var base_url=getbaseurl();if(response.data=="relative")
{var strng=btoa("dash");base_url=base_url+"employeemodule?from="+strng;}
else
{base_url=base_url+response.data;}
var link='<a href="'+base_url+'" style="background: #36186e;">Click Here</a>';website('#declaration .arng').html('<h5 style="text-align:center;color: #000;margin: 45px 50px 25px 50px;line-height: 25px;">'+response.message+'</h5><p style="text-align: center;"><u>'+link+'</u></p>');if(response.usergroup!=2)
{website('#declaration').modal('show');}}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});}
function disclosures(id)
{var base_url=getbaseurl();if(id=="yesdisclosures")
{website('#updateholdings').modal('hide');website.ajax({url:'home/firstlogin',method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{window.location.href=base_url+"/employeemodule";}
else
{}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});}
else if(id=="nodisclosures")
{website('#updateholdings').modal('hide');website.ajax({url:'home/firstlogin',method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{window.location.reload();}
else
{}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});}}
website('#updateholdings').on('hidden.bs.modal',function(e){website.ajax({url:'home/firstlogin',method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{window.location.reload();}
else
{}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});});