
website('body').on('click','.paginationmn li',function(e)
{var rscrntpg=website(this).attr('p');website('.panel.panel-white #pagenum').val(rscrntpg);getannualdisclsr();});website('body').on('change','#noofrows',function(e)
{getannualdisclsr();});website('body').on('click','.go_button',function(e)
{var rscrntpg=website('.gotobtn').val();website('.panel.panel-white #pagenum').val(rscrntpg);getannualdisclsr();});website('body').on('change','#filterstatus',function(e)
{getannualdisclsr();});datepicker();function datepicker(){website('.bootdatepick').datetimepicker({weekStart:1,todayBtn:0,autoclose:1,todayHighlight:0,startView:2,minView:2,forceParse:0,format:"dd-mm-yyyy"}).on('change',function(e,date)
{var getdate=website(this).val();var getid=website(this).closest('form').attr('id');});}
website('body').on('change','#annualyear',function(e)
{getannualdisclsr();});getannualdisclsr();function getannualdisclsr()
{var noofrows=website('#noofrows').val();var pagenum=website('#pagenum').val();var annualyr=website('#annualyear').val();var filterstatus=website('#filterstatus').val();var search=website('#srch').val();website.ajax({url:'mis/pendingcontdisclsr',data:{noofrows:noofrows,pagenum:pagenum,annualyr:annualyr,filterstatus:filterstatus,search:search},method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged==true)
{var htmlelements='';for(var i=0;i<response.data.length;i++)
{if(filterstatus=='pending')
{var j=i+1;var sent_date=response.data[i].sent_date?response.data[i].sent_date:'';htmlelements+='<tr>';htmlelements+='<td width="10%">'+j+'</td>';htmlelements+='<td width="10%">'+response.data[i].fullname+'</td>';htmlelements+='<td width="10%">'+annualyr+'</td>';htmlelements+='<td width="10%"></td>';if(response.data[i].pdfpath!==null&&annualyr==response.data[i].annualyear)
{htmlelements+='<td width="10%"><a target="_blank" href="'+response.data[i].pdfpath+'" class="downlodthfle" style="color:black;"><span class="glyphicon glyphicon-download-alt floatleft"></span></a></td>';}
else
{htmlelements+='<td width="10%"></td>';}
htmlelements+='</tr>';}
else if(filterstatus=='sent_for_approval')
{var j=i+1;var sent_date=response.data[i].sent_date?response.data[i].sent_date:'';htmlelements+='<tr>';htmlelements+='<td width="10%">'+j+'</td>';htmlelements+='<td width="10%">'+response.data[i].fullname+'</td>';htmlelements+='<td width="10%">'+response.data[i].annualyear+'</td>';htmlelements+='<td width="10%">'+sent_date+'</td>';if(response.data[i].sent_date)
{htmlelements+='<td width="10%"><a target="_blank" href="'+response.data[i].pdfpath+'" class="downlodthfle" style="color:black;"><span class="glyphicon glyphicon-download-alt floatleft"></span></a></td>';}
else
{htmlelements+='<td width="10%"></td>';}
htmlelements+='</tr>';}
else if(filterstatus=='')
{var j=i+1;var sent_date=response.data[i].sent_date?response.data[i].sent_date:'';htmlelements+='<tr>';htmlelements+='<td width="10%">'+j+'</td>';htmlelements+='<td width="10%">'+response.data[i].fullname+'</td>';htmlelements+='<td width="10%">'+annualyr+'</td>';if(response.data[i].pdfpath!=null&&annualyr==response.data[i].annualyear)
{htmlelements+='<td width="10%">'+sent_date+'</td>';htmlelements+='<td width="10%"><a target="_blank" href="'+response.data[i].pdfpath+'" class="downlodthfle" style="color:black;"><span class="glyphicon glyphicon-download-alt floatleft"></span></a></td>';}
else
{htmlelements+='<td width="10%"></td>';htmlelements+='<td width="10%"></td>';}
htmlelements+='</tr>';}}}
else
{htmlelements+='<tr>';htmlelements+='<td colspan="8" style="text-align: center;">Data Not Found..!!</td></tr>';}
website('.accdetails7').html(htmlelements);website('#acc7').html(response.pgnhtml);},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});}
website("#srch").on("keyup",function(){var search=website('#srch').val();var pagenum=website('#pagenum').val();website('#srch').attr('status','0');if(pagenum!=1)
{website('#pagenum').val(1);}
getannualdisclsr();});website('.genfile').on('click',function(e){var noofrows=website('#noofrows').val();var pagenum=website('#pagenum').val();var annualyr=website('#annualyear').val();var filterstatus=website('#filterstatus').val();var search=website('#srch').val();var formdata={noofrows:noofrows,pagenum:pagenum,annualyr:annualyr,filterstatus:filterstatus,search:search};website.ajax({url:'mis/exportAnnualDisclsr',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{website('.preloder_wraper').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response)
{if(response.logged==true)
{website('.dwnldExcel').fadeIn();website('.dwnldExcel').attr('href',response.genfile);new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}
else
{new PNotify({title:response.message,text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function(response)
{}});});;