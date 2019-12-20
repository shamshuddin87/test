
website(document).ready(function()
{getdataonload();website('.bootdatepick').datetimepicker({weekStart:1,todayBtn:0,autoclose:1,todayHighlight:0,startView:2,minView:2,forceParse:0,format:"dd-mm-yyyy"}).on('change',function(e,date)
{var getdate=website(this).val();var getid=website(this).closest('form').attr('id');});});website('#insertformb').ajaxForm({dataType:"json",beforeSend:function()
{website('.preloder_wraper').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{website('.preloder_wraper').fadeIn();},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{website('#Mymodalformb').modal('hide');new PNotify({title:'Record Added Successfully',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});window.location.reload();getdataonload();}else{new PNotify({title:'Record Not Added',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function(jqXHR,textStatus,errorThrown)
{}});website('body').on('change','#noofrows',function(e)
{getdataonload();});website('body').on('click','.paginationmn li',function(e)
{var rscrntpg=website(this).attr('p');website('.panel.panel-white #pagenum').val(rscrntpg);getdataonload();});website('body').on('click','.go_button',function(e)
{var rscrntpg=website('.gotobtn').val();website('.panel.panel-white #pagenum').val(rscrntpg);getdataonload();});function getdataonload()
{var noofrows=website('#noofrows').val();var pagenum=website('#pagenum').val();var formdata={noofrows:noofrows,pagenum:pagenum};website.ajax({url:'sebi/fetchformbdata',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{var addhtmlnxt='';for(var i=0;i<response.resdta.length;i++)
{var senddate=response.resdta[i].send_date?response.resdta[i].send_date:''
var date_added=response.resdta[i].date_added?response.resdta[i].date_added:''
var designation=response.resdta[i].designation?response.resdta[i].designation:''
var draft=response.resdta[i].draft?response.resdta[i].draft:''
var final=response.resdta[i].final?response.resdta[i].final:''
addhtmlnxt+='<tr class="counter" aprvllistid="'+response.resdta[i].id+'" >';if(response.user_group_id=='7')
{addhtmlnxt+='<td width="20%">'+senddate+'</td>';}
else
{addhtmlnxt+='<td width="20%">'+date_added+'</td>';}
addhtmlnxt+='<td width="15%">'+designation+'</td>';if(response.user_group_id=='7')
{if(response.resdta[i].send_status==0)
{addhtmlnxt+='<td width="15%"><i class="fa fa-paper-plane"  id="sendforaprv" formbid="'+response.resdta[i].id+'" apprverid ="'+response.resdta[i].approverid+'" pdfurl ="'+draft+'"></i></td>';}
else
{addhtmlnxt+='<td width="15%"><i class="fa fa-check" aria-hidden="true"></i></td>';}}
addhtmlnxt+='<td width="15%"><i class="fa fa-file-pdf-o" id="preview" doc_id=1 formbid="'+response.resdta[i].id+'"></i></td>';if(response.user_group_id=='7')
{if(response.resdta[i].final)
{addhtmlnxt+='<td width="15%"><a href="'+response.resdta[i].final+'" download>&nbsp;<i class="fa fa-download" id="uploadattached1" aria-hidden="true"></i></a></td>';}
else
{addhtmlnxt+='<td width="15%"></td>';}}
dtfrmt=response.resdta[i].date_added.split("-");dtfrmtspace=response.resdta[i].date_added.split(" ");ddmmyy=dtfrmtspace[0];dtfrmt=dtfrmtspace[0].split("-");ddmmyy=dtfrmt[2]+'-'+dtfrmt[1]+'-'+dtfrmt[0];times=dtfrmtspace[1];addhtmlnxt+='<td width="15%" >'+ddmmyy+'  '+times+'</td>';if(response.resdta[i].send_status!=0)
{addhtmlnxt+='<td width="10%" ></td>';}
else
{addhtmlnxt+='<td width="10%" ><i class="fa fa-edit faicon floatleft editformb" title="Edit entry" formbid="'+response.resdta[i].id+'"></i></td>';}
addhtmlnxt+='</tr>';}
website('.appendrow').html(addhtmlnxt);website('.paginationmn').html(response.pgnhtml);}
else
{website('.appendrow').html('<tr><td colspan="9" style="text-align:center;">Data Not Found..!!</td></tr>');website('.paginationmn').html(response.pgnhtml);}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});}
website('body').on('click','.editformb',function(){var id=website(this).attr('formbid');var formdata={id:id};website.ajax({url:'sebi/fetchformbedit',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{var appendhtml='';var secutype=response.data.securitytype.split(',');if(secutype)
{website.each(secutype,function(k,v)
{if(v=='1')
{website("#Mymodaledit #shrsecuno").removeAttr('readonly');}
if(v=='2')
{website("#Mymodaledit #wrntsecuno").removeAttr('readonly');}
if(v=='3')
{website("#Mymodaledit #debntrsecuno").removeAttr('readonly');}
website("#updateformb #security option[value='"+v+"']").prop("selected",true);});}
website("#Mymodaledit #cin").val(response.data.cin);website("#Mymodaledit #category").val(response.data.category);website("#Mymodaledit #date").val(response.data.appntdate);website("#Mymodaledit #cmpnme").val(response.data.companyid);website("#Mymodaledit #shrsecuno").val(response.data.shresec);website("#Mymodaledit #wrntsecuno").val(response.data.wrntsec);website("#Mymodaledit #debntrsecuno").val(response.data.debsecu);website("#Mymodaledit #shrhldng").val(response.data.sharehldng);website("#Mymodaledit #futureunitnum").val(response.data.futureunit);website("#Mymodaledit #futurentnlvlue").val(response.data.futurevalue);website("#Mymodaledit #optionunitnum").val(response.data.optionunit);website("#Mymodaledit #optionntnlvlue").val(response.data.optionvalue);website('#updateformb #upformbid').val(id);website('#Mymodaledit').modal('show');}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});});website('#updateformb').ajaxForm({dataType:"json",beforeSend:function()
{website('.preloder_wraper').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{website('.preloder_wraper').fadeIn();},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{new PNotify({title:'Record Updated Successfully',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});window.location.reload();}
else
{new PNotify({title:'Record Not Updated',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{website('.preloder_wraper').fadeOut();website('#Mymodaledit .mainprogressbarforall').fadeOut();},error:function()
{website('.preloder_wraper').fadeOut();}});website('body').on('click','#formbrqust',function(){website('#Mymodalformb').modal('show');});website('body').on('click','#sendforaprv',function(){var formbid=website(this).attr('formbid');var pdfurl=website(this).attr('pdfurl');website('#myModalsendaprv .yesapprove').attr('formbid',formbid);website('#myModalsendaprv .yesapprove').attr('pdfurl',pdfurl);website('#myModalsendaprv').modal('show');})
website('body').on('click','.yesapprove',function()
{var id=website(this).attr('formbid');var pdfurl=website(this).attr('pdfurl');if(pdfurl!='')
{var formdata={id:id};website.ajax({url:'sebi/sendforapprvlformb',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{website('.preloder_wraper').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{website('.preloder_wraper').fadeIn();},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{window.location.reload();new PNotify({title:'Alert!!!',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}
else
{new PNotify({title:'Alert!!!',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function()
{}});}
else
{new PNotify({title:'Alert!!!',text:'Please generate pdf!!!',type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}});website('body').on('click','#preview',function()
{var docid=website(this).attr('doc_id');var id=website(this).attr('formbid');var formdata={id:id,docid:docid};website.ajax({url:'sebi/previewofformb',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{website('#modaldocument .formbpdf').show();},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{dtfrmt=response.formdata['appntdate'].split("-");dtfrmtspace=response.formdata['appntdate'].split(" ");ddmmyy=dtfrmtspace[0];dtfrmt=dtfrmtspace[0].split("-");ddmmyy=dtfrmt[2]+'-'+dtfrmt[1]+'-'+dtfrmt[0];website('#modaldocument .downloadpdf').hide();website('#modaldocument .docpdf').html(response.docontent);if(response.secutype)
{website.each(response.secutype,function(k,v)
{var secuty='<br/>'+v;website('.secutype').append(secuty);});}
var secuno='';secuno+=response.formdata['shresec'];secuno+='<br/>'+response.formdata['wrntsec'];secuno+='<br/>'+response.formdata['debsecu'];website('.name').html(response.formdata['fullname']);website('.cmpnme').html(response.formdata['companyname']);website('.pan').html(response.formdata['pan']);website('.cin').html(response.formdata['cin']);website('.contctno').html(response.formdata['mobile']);website('.address').html(response.formdata['address']);website('.category').html(response.formdata['category']);website('.appointdate').html(ddmmyy);website('.secuno').html(secuno);website('.shrhldng').html(response.formdata['sharehldng']);website('.futureunit').html(response.formdata['futureunit']);website('.optionunit').html(response.formdata['optionunit']);website('.futurevalue').html(response.formdata['futurevalue']);website('.optionvalue').html(response.formdata['optionvalue']);website('#modaldocument #formbid').val(id);website('#modaldocument').modal('show');}
else
{}},complete:function(response)
{website('#myModalyesno .mainprogressbarforall').fadeOut();},error:function()
{}});});website('body').on('click','.formbpdf',function(e)
{var htmldata=website('#modaldocument .docpdf').html();var formbid=website('#modaldocument #formbid').val();var formData={htmldata:htmldata,formbid:formbid};website.ajax({type:"POST",url:'sebi/generateformbPDF',data:formData,dataType:"json",beforeSend:function()
{website('.preloder_wraper').fadeIn();website('#modaldocument .downloadpdf .pdfln').html('');website('#modaldocument .trailpdfdownload').addClass('disabled');},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response)
{if(response.logged===true)
{website('.preloder_wraper').fadeOut();website('#modaldocument .formbpdf').fadeOut();website('#modaldocument .button_pdf .down_load').show();website('#modaldocument .downloadpdf').show();website('#modaldocument .downloadpdf').html('<a href="'+response.pdfpath+'" target="_blank" class="downlodthfle" style="color: white;"><span class="glyphicon glyphicon-download-alt floatleft">Download</span> </a>');}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function()
{}});});website('body').on('change','#security',function(){var value='';value=website(this).val();if(jQuery.inArray('1',value)!='-1')
{website('#shrsecuno').removeAttr('readonly');}
else
{website('#shrsecuno').attr('readonly','readonly');}
if(jQuery.inArray('2',value)!='-1')
{website('#wrntsecuno').removeAttr('readonly');}
else
{website('#wrntsecuno').attr('readonly','readonly');}
if(jQuery.inArray('3',value)!='-1')
{website('#debntrsecuno').removeAttr('readonly');}
else
{website('#debntrsecuno').attr('readonly','readonly');}});website('body').on('change','#Mymodaledit #security',function(){var value='';value=website(this).val();if(jQuery.inArray('1',value)!='-1')
{website('#Mymodaledit #shrsecuno').removeAttr('readonly');}
else
{website('#Mymodaledit #shrsecuno').attr('readonly','readonly');website('#Mymodaledit #shrsecuno').val('');}
if(jQuery.inArray('2',value)!='-1')
{website('#Mymodaledit #wrntsecuno').removeAttr('readonly');}
else
{website('#Mymodaledit #wrntsecuno').attr('readonly','readonly');website('#Mymodaledit #wrntsecuno').val('');}
if(jQuery.inArray('3',value)!='-1')
{website('#Mymodaledit #debntrsecuno').removeAttr('readonly');}
else
{website('#Mymodaledit #debntrsecuno').attr('readonly','readonly');website('#Mymodaledit #debntrsecuno').val('');}});website('body').on('click','.downloadpdf',function(){website('#modaldocument').modal('hide');window.location.reload();});function numberalphOnly()
{var charCode=event.keyCode;if((charCode>47&&charCode<58)||charCode==32||(charCode>64&&charCode<91)||(charCode>96&&charCode<123)||charCode==8||charCode==44||charCode==40||charCode==41||charCode==46||charCode==47)
return true;else
return false;}
function emailOnly()
{var re=/[A-Z0-9a-z@\._-]/.test(event.key);if(!re){return false;}};