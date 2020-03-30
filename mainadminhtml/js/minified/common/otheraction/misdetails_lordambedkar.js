
website('body').on('click','.paginationmn li',function(e)
{var rsitntfr=website(this).closest('.itntfr').attr('itntfr');var rscrntpg=website(this).attr('p');website('#'+rsitntfr+' .panel.panel-white #pagenum').val(rscrntpg);if(rsitntfr=='personmis')
{getholdingmis();}
else if(rsitntfr=='relativemis')
{relativeholdingmis();}
else if(rsitntfr=='pastemp')
{getpastemployer();}});website('body').on('change','#noofrows',function(e)
{var rsitntfr=website(this).closest('.itntfr').attr('itntfr');if(rsitntfr=='personmis')
{getholdingmis();}
else if(rsitntfr=='relativemis')
{relativeholdingmis();}
else if(rsitntfr=='pastemp')
{getpastemployer();}});website('body').on('click','.go_button',function(e)
{var rsitntfr=website(this).closest('.itntfr').attr('itntfr');var rscrntpg=website('#'+rsitntfr+' .gotobtn').val();website('#'+rsitntfr+' .panel.panel-white #pagenum').val(rscrntpg);if(rsitntfr=='personmis')
{getholdingmis();}
else if(rsitntfr=='relativemis')
{relativeholdingmis();}
else if(rsitntfr=='pastemp')
{getpastemployer();}});datepicker();function datepicker(){website('.bootdatepick').datetimepicker({weekStart:1,todayBtn:0,autoclose:1,todayHighlight:0,startView:2,minView:2,forceParse:0,format:"dd-mm-yyyy"}).on('change',function(e,date)
{var getdate=website(this).val();var getid=website(this).closest('form').attr('id');});}
getholdingmis();function getholdingmis()
{var userid=website('#userid').val();var noofrows=website('#personmis #noofrows').val();var pagenum=website('#personmis #pagenum').val();var startdate=website('#date1').val();var enddate=website('#date2').val();website.ajax({url:'mis/getholingmis',data:{userid:userid,noofrows:noofrows,pagenum:pagenum,startdate:startdate,enddate:enddate},method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{var htmlelements='';if(response.logged==true)
{for(var i=0;i<response.data.length;i++)
{var j=i+1;htmlelements+='<tr>';htmlelements+='<td>'+j+'</td>';htmlelements+='<td>'+response.data[i].company_name+'</td>';htmlelements+='<td>'+response.data[i].security_type+'</td>';htmlelements+='<td>'+response.data[i].no_of_share+'</td>';htmlelements+='<td>'+response.data[i].date_of_transaction+'</td>';htmlelements+='<td>'+response.data[i].transaction+'</td>';htmlelements+='<td>'+response.data[i].demat_acc_no+'</td></tr>';}}
else
{htmlelements+='<tr>';htmlelements+='<td colspan="8" style="text-align: center;">Data Not Found..!!</td></tr>';}
website('.accdetails5').html(htmlelements);website('#acc5').html(response.pgnhtml);},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});}
relativeholdingmis();function relativeholdingmis()
{var userid=website('#userid').val();var noofrows=website('#relativemis #noofrows').val();var pagenum=website('#relativemis #pagenum').val();var startdate=website('#desdate1').val();var enddate=website('#desdate2').val();website.ajax({url:'mis/relativeholding',data:{userid:userid,noofrows:noofrows,pagenum:pagenum,startdate:startdate,enddate:enddate},method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{var htmlelements='';if(response.logged==true)
{for(var i=0;i<response.data.length;i++)
{var j=i+1;htmlelements+='<tr>';htmlelements+='<td>'+j+'</td>';htmlelements+='<td>'+response.data[i].relname+'</td>';htmlelements+='<td>'+response.data[i].relationship+'</td>';htmlelements+='<td>'+response.data[i].company_name+'</td>';htmlelements+='<td>'+response.data[i].security_type+'</td>';htmlelements+='<td>'+response.data[i].no_of_share+'</td>';htmlelements+='<td>'+response.data[i].date_of_transaction+'</td>';htmlelements+='<td>'+response.data[i].transaction+'</td>';htmlelements+='<td>'+response.data[i].demat_acc_no+'</td></tr>';}}
else
{htmlelements+='<tr>';htmlelements+='<td colspan="9" style="text-align: center;">Data Not Found</td></tr>';}
website('.accdetails6').html(htmlelements);website('#acc6').html(response.pgnhtml);},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});}
website('body').on('click','#dtrange',function(e)
{getholdingmis();});website('body').on('click','#dtrangedes',function(e)
{relativeholdingmis();});website('.genfile').on('click',function(e){var userId=website("#userid").val();var noofrows=website('#personmis #noofrows').val();var pagenum=website('#personmis #pagenum').val();var noofrows1=website('#relativemis #noofrows').val();var pagenum1=website('#relativemis #pagenum').val();var startdate=website('#date1').val();var enddate=website('#date2').val();var startdesdate=website('#desdate1').val();var enddesdate=website('#desdate2').val();var formdata={userId:userId,noofrows:noofrows,pagenum:pagenum,startdate:startdate,enddate:enddate,startdesdate:startdesdate,enddesdate:enddesdate,noofrows1:noofrows1,pagenum1:pagenum1};website.ajax({url:'mis/fetchDesigntdPersonMIS',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{website('.preloder_wraper').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response)
{if(response.logged==true)
{website('.dwnldExcel').fadeIn();website('.dwnldExcel').attr('href',response.genfile);new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}
else
{new PNotify({title:response.message,text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function(response)
{}});});getpastemployer();function getpastemployer()
{var noofrows=website('#noofrows').val();var pagenum=website('#pagenum').val();var persnid=website('#personid').val();var getuserid=website('#userid').val();var formdata={persnid:persnid,noofrows:noofrows,pagenum:pagenum,getuserid:getuserid}
website.ajax({url:'approvelperinfo/getpastemployer',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{var addhtmlnxt='';for(var i=0;i<response.resdta.length;i++)
{var emp_name=response.resdta[i].emp_name?response.resdta[i].emp_name:'';var emp_desigtn=response.resdta[i].emp_desigtn?response.resdta[i].emp_desigtn:'';var startdate=response.resdta[i].startdate?response.resdta[i].startdate:'';var enddate=response.resdta[i].enddate?response.resdta[i].enddate:'';var j=i+1;addhtmlnxt+='<tr class="counter" empid="'+response.resdta[i].id+'" >';addhtmlnxt+='<td width="20%">'+j+'</td>';addhtmlnxt+='<td width="20%">'+emp_name+'</td>';addhtmlnxt+='<td width="20%">'+emp_desigtn+'</td>';addhtmlnxt+='<td width="20%">'+startdate+'</td>';addhtmlnxt+='<td width="20%">'+enddate+'</td>';addhtmlnxt+='</tr>';}
website('.appendviewemplyee').html(addhtmlnxt);website('#acc7').html(response.pgnhtml);}
else
{website('#acc7').html(response.pgnhtml);}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function(jqXHR,textStatus,errorThrown)
{}});};