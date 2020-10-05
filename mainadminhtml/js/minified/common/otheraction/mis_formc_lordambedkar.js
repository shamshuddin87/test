
website('body').on('click','.paginationmn li',function(e)
{var rscrntpg=website(this).attr('p');website('.panel.panel-white #pagenum').val(rscrntpg);getmisformc("");});website('body').on('change','#noofrows',function(e)
{getmisformc("");});website('body').on('click','.go_button',function(e)
{var rscrntpg=website('.gotobtn').val();website('.panel.panel-white #pagenum').val(rscrntpg);getmisformc("");});website('body').on('change','#filterstatus',function(e)
{var urlredirect=website('#filterstatus').val();website('#redirecturl').val(urlredirect);getmisformc("");});website('body').on('change','#emp_status',function(e)
{getmisformc();});datepicker();function datepicker(){website('.bootdatepick').datetimepicker({weekStart:1,todayBtn:0,autoclose:1,todayHighlight:0,startView:2,minView:2,forceParse:0,format:"yyyy-mm-dd"}).on('change',function(e,date)
{var getdate=website(this).val();var getid=website(this).closest('form').attr('id');});}
var url_string=window.location.href;var url=new URL(url_string);var url_status=url.searchParams.get("status");getmisformc(url_status);function getmisformc(url_status)
{var urlredirect=website('#redirecturl').val();if(urlredirect)
{var status=urlredirect;website('#filterstatus').val(status);}
else
{var status=website('#filterstatus').val();}
var search=website('#srch').val();var noofrows=website('#noofrows').val();var pagenum=website('#pagenum').val();var startdate=website('#date1').val();var enddate=website('#date2').val();var filterstatus=website('#filterstatus').val();var emp_status=website('#emp_status').val();website.ajax({url:'mis/misformc',data:{noofrows:noofrows,pagenum:pagenum,search:search,startdate:startdate,enddate:enddate,filterstatus:filterstatus,emp_status:emp_status},method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{var htmlelements='';if(response.logged==true)
{for(var i=0;i<response.data.length;i++)
{var formcsenddate=response.data[i].send_date?response.data[i].send_date:'';var date=response.data[i].date_of_transaction;var submsndate=new Date(date.split("-").reverse().join("-"));submsndate.setDate(submsndate.getDate()+2);var dd=("0"+submsndate.getDate()).slice(-2);var mm=("0"+(submsndate.getMonth()+1)).slice(-2);var y=submsndate.getFullYear();var duesubDate=dd+'-'+mm+'-'+y;var j=i+1;htmlelements+='<tr>';htmlelements+='<td width="10%">'+j+'</td>';htmlelements+='<td width="10%">'+response.data[i].fullname+'</td>';if(response.data[i].emp_status=='1')
{htmlelements+='<td width="10%">Active</td>';}
else if(response.data[i].emp_status=='2')
{htmlelements+='<td width="10%">Resigned</td>';}
else if(response.data[i].emp_status=='3')
{htmlelements+='<td width="10%">Not a DP</td>';}
htmlelements+='<td width="10%">'+response.data[i].date_of_transaction+'</td>';htmlelements+='<td width="10%">'+response.data[i].no_of_share+'</td>';htmlelements+='<td width="10%">'+duesubDate+'</td>';htmlelements+='<td width="10%">'+formcsenddate+'</td>';if(response.data[i].send_date)
{var senddte=response.data[i].send_date.split("-");var formsenddte=new Date(senddte[2],senddte[1],senddte[0]);}
var duetrade=duesubDate.split("-");var duetradedte=new Date(duetrade[2],duetrade[1],duetrade[0]);htmlelements+='</tr>';}}
else
{htmlelements+='<tr>';htmlelements+='<td colspan="10" style="text-align: center;">Data Not Found..!!</td></tr>';}
website('.accdetails8').html(htmlelements);website('#acc8').html(response.pgnhtml);},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});}
website("#srch").on("keyup",function(){var search=website('#srch').val();var pagenum=website('#pagenum').val();website('#srch').attr('status','0');if(pagenum!=1)
{website('#pagenum').val(1);}
getmisformc("");});website('body').on('click','#dtrange',function(e)
{getmisformc("");});;