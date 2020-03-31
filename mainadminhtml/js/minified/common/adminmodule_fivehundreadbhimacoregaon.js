
website('body').on('change','#noofrows',function(e)
{getuserlistonload();});website('body').on('click','.paginationmn li',function(e)
{var rscrntpg=website(this).attr('p');website('.panel.panel-white #pagenum').val(rscrntpg);getuserlistonload();});website('body').on('click','.go_button',function(e)
{var rscrntpg=website('.gotobtn').val();website('.panel.panel-white #pagenum').val(rscrntpg);getuserlistonload();});getuserlistonload();function getuserlistonload()
{var noofrows=website('#noofrows').val();var pagenum=website('#pagenum').val();var searchby=website('#srch').val();var formdata={noofrows:noofrows,pagenum:pagenum,searchby:searchby};website.ajax({url:'adminmodule/fetchuser',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{var addhtmlnxt='';var dept='';var companyname='';for(var i=0;i<response.data.length;i++)
{var fullname=response.data[i].fullname?response.data[i].fullname:'NONE';var email=response.data[i].email?response.data[i].email:'NONE';var dpdate=response.data[i].dpdate?response.data[i].dpdate:'NONE'
var designation=response.data[i].designation?response.data[i].designation:'NONE';var companyname=response.data[i].companyname?response.data[i].companyname:'NONE';var departmentname=response.data[i].department?response.data[i].department:'NONE'
var j=i+1;addhtmlnxt+='<tr class="counter useraccess" tempid="'+response.data[i].wr_id+'">';addhtmlnxt+='<td width="15%">'+j+'</td>';addhtmlnxt+='<td width="15%">'+fullname+'</td>';addhtmlnxt+='<td width="15%">'+email+'</td>';addhtmlnxt+='<td width="15%">'+designation+'</td>';addhtmlnxt+='<td width="15%">'+dpdate+'</td>';addhtmlnxt+='<td width="15%">'+companyname+'</td>';addhtmlnxt+='<td width="15%">'+departmentname+'</td>';addhtmlnxt+='<td width="10%"><i class="fa fa-eye" ></i></td>';addhtmlnxt+='</tr>';}}
else
{addhtmlnxt+='<tr><td colspan="8" style="text-align:center;">NO DATA FOUND</td></tr>';}
website('.appendrow').html(addhtmlnxt);website('.paginationmn').html(response.pgnhtml);},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});}
website('body').on('click','.useraccess',function(e){var userid=website(this).attr('tempid');var baseHref=getbaseurl();var encodedString=btoa(userid);var myurl=baseHref+"adminmodule/accesstouser?userid="+encodedString;location.replace(myurl);});website("#srch").on("keyup",function(){var search=website('#srch').val();getuserlistonload();});;