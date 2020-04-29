
website(document).ready(function()
{getdataonload();website('.bootdatepick').datetimepicker({weekStart:1,todayBtn:0,autoclose:1,todayHighlight:0,startView:2,minView:2,forceParse:0,format:"dd-mm-yyyy"}).on('change',function(e,date)
{var getdate=website(this).val();var getid=website(this).closest('form').attr('id');});});website('body').on('change','#noofrows',function(e)
{getdataonload();});website('body').on('click','.paginationmn li',function(e)
{var rscrntpg=website(this).attr('p');website('.panel.panel-white #pagenum').val(rscrntpg);getdataonload();});website('body').on('click','.go_button',function(e)
{var rscrntpg=website('.gotobtn').val();website('.panel.panel-white #pagenum').val(rscrntpg);getdataonload();});getdataonload();function getdataonload()
{var noofrows=website('#noofrows').val();var pagenum=website('#pagenum').val();var formdata={noofrows:noofrows,pagenum:pagenum};website.ajax({url:'sebi/fetchformcdata',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{var addhtmlnxt='';for(var i=0;i<response.resdta.length;i++)
{var senddate=response.resdta[i].send_date?response.resdta[i].send_date:''
var date_added=response.resdta[i].date_added?response.resdta[i].date_added:''
var designation=response.resdta[i].designation?response.resdta[i].designation:''
var company=response.resdta[i].company_name?response.resdta[i].company_name:''
var draft=response.resdta[i].draft?response.resdta[i].draft:''
var final=response.resdta[i].final?response.resdta[i].final:''
addhtmlnxt+='<tr class="counter" aprvllistid="'+response.resdta[i].id+'" >';if(response.user_group_id=='7')
{addhtmlnxt+='<td width="20%">'+senddate+'</td>';}
else
{addhtmlnxt+='<td width="20%">'+date_added+'</td>';}
addhtmlnxt+='<td width="15%">'+company+'</td>';addhtmlnxt+='<td width="15%">'+designation+'</td>';if(response.resdta[i].send_status==0)
{if(response.user_group_id=='7')
{addhtmlnxt+='<td width="15%"><i class="fa fa-paper-plane" id="sendforaprvformc" formcid="'+response.resdta[i].id+'" pdfurl ="'+draft+'"></i></td>';}}
else
{addhtmlnxt+='<td width="15%"><i class="fa fa-check" aria-hidden="true"></i></td>';}
addhtmlnxt+='<td width="15%"><i class="fa fa-file-pdf-o" id="previewc" type="'+response.resdta[i].isitesop+'" doc_id=2 formcid="'+response.resdta[i].id+'"></i></td>';if(response.user_group_id=='7')
{if(response.resdta[i].final)
{addhtmlnxt+='<td width="15%"><a href="'+response.resdta[i].final+'" download>&nbsp;<i class="fa fa-download" id="uploadattached1" aria-hidden="true"></i></a></td>';}
else
{addhtmlnxt+='<td width="15%"></td>';}}
dtfrmt=response.resdta[i].date_added.split("-");dtfrmtspace=response.resdta[i].date_added.split(" ");ddmmyy=dtfrmtspace[0];dtfrmt=dtfrmtspace[0].split("-");ddmmyy=dtfrmt[2]+'-'+dtfrmt[1]+'-'+dtfrmt[0];times=dtfrmtspace[1];addhtmlnxt+='<td width="15%" >'+ddmmyy+'  '+times+'</td>';if(response.resdta[i].send_status!=0)
{addhtmlnxt+='<td width="10%" ></td>';}
else
{addhtmlnxt+='<td width="10%" ><i class="fa fa-edit faicon floatleft editformc" title="Edit entry" formcid="'+response.resdta[i].id+'"></i></td>';}
addhtmlnxt+='</tr>';}
website('.appendrow').html(addhtmlnxt);website('.paginationmn').html(response.pgnhtml);}
else
{website('.appendrow').html('<tr><td colspan="9" style="text-align:center;">Data Not Found..!!</td></tr>');website('.paginationmn').html(response.pgnhtml);}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});}
website('body').on('click','.editformc',function(){var id=website(this).attr('formcid');var formdata={id:id};website.ajax({url:'sebi/fetchformcedit',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{var typcntr=response.data.type_of_contract;if(typcntr=='')
{website('#Mymodaledit #contracttype option[value=""]').prop('selected','selected').change();}
else
{website('#Mymodaledit #contracttype option[value='+typcntr+']').prop('selected','selected').change();}
website('#Mymodaledit #contractspeci').val(response.data.contract_specification);website("#Mymodaledit #cin").val(response.data.cin);website("#Mymodaledit #category").val(response.data.category);website("#Mymodaledit #cmpnme").val(response.data.companyid);website("#Mymodaledit #fromdate").val(response.data.fromdate);website("#Mymodaledit #todate").val(response.data.todate);website("#Mymodaledit #pretrans").val(response.data.pretrans);website("#Mymodaledit #posttrans").val(response.data.posttrans);website("#Mymodaledit #dateofintimtn").val(response.data.dateofintimtn);website("#Mymodaledit #acquimode").val(response.data.acquimode);website("#Mymodaledit #buyvalue").val(response.data.buyvalue);website("#Mymodaledit #buynumbrunt").val(response.data.buynumbrunt);website("#Mymodaledit #sellvalue").val(response.data.sellvalue);website("#Mymodaledit #sellnumbrunt").val(response.data.sellnumbrunt);website("#Mymodaledit #exetrd").val(response.data.exetrd);website('#updateformc #upformcid').val(id);if(response.data['user_group_id']==7)
{website('#Mymodaledit #category option[value=6]').prop('selected','selected').change();website('#Mymodaledit #category option[value=1]').prop('disabled','disabled').change();website('#Mymodaledit #category option[value=2]').prop('disabled','disabled').change();website('#Mymodaledit #category option[value=3]').prop('disabled','disabled').change();website('#Mymodaledit #category option[value=4]').prop('disabled','disabled').change();website('#Mymodaledit #category option[value=5]').prop('disabled','disabled').change();}
website('#Mymodaledit').modal('show');}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});});website('#updateformc').ajaxForm({dataType:"json",beforeSend:function()
{website('.preloder_wraper').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{website('.preloder_wraper').fadeIn();},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{new PNotify({title:'Record Updated Successfully',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});window.location.reload();}
else
{new PNotify({title:'Record Not Updated',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{website('.preloder_wraper').fadeOut();website('#Mymodaledit .mainprogressbarforall').fadeOut();},error:function()
{}});website('body').on('click','#sendforaprvformc',function(){var formcid=website(this).attr('formcid');var pdfurl=website(this).attr('pdfurl');website('#myModalsendaprv .yesapprove').attr('formcid',formcid);website('#myModalsendaprv .yesapprove').attr('pdfurl',pdfurl);website('#myModalsendaprv').modal('show');});website('body').on('click','.yesapprove',function()
{var id=website(this).attr('formcid');var pdfurl=website(this).attr('pdfurl');if(pdfurl!='')
{var formdata={id:id};website.ajax({url:'sebi/sendforapprvlformc',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{website('.preloder_wraper').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{website('.preloder_wraper').fadeIn();},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{window.location.reload();new PNotify({title:'Alert!!!',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}
else
{new PNotify({title:'Alert!!!',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function()
{}});}
else
{new PNotify({title:'Alert!!!',text:'Please generate pdf!!!',type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}});website('body').on('click','#previewc',function()
{var docid=website(this).attr('doc_id');var id=website(this).attr('formcid');var type=website(this).attr('type');var formdata={id:id,docid:docid,type:type};website.ajax({url:'sebi/previewofformc',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{website('#modaldocument .formcpdf').show();},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{dtfrom=response.formdata['fromdate'].split("-");ddmmyyfrom=dtfrom[2]+'-'+dtfrom[1]+'-'+dtfrom[0];dteto=response.formdata['todate'].split("-");ddmmyyto=dteto[2]+'-'+dteto[1]+'-'+dteto[0];dteadded=response.formdata['date_added'].split(" ");dtadd=dteadded[0].split("-");finaldtadd=dtadd[2]+'-'+dtadd[1]+'-'+dtadd[0];if(response.formdata['dateofintimtn'])
{dtinti=response.formdata['dateofintimtn'].split("-");ddmmyyinti=dtinti[2]+'-'+dtinti[1]+'-'+dtinti[0];}
else
{ddmmyyinti='';}
website('#modaldocument .downloadpdf').hide();website('#modaldocument .docpdf').html(response.docontent);if(response.formdata['sectype']==1||response.formdata['sectype']==2)
{var secutype='Shares';website('.secutype1').html(secutype);website('.secutype2').html(secutype);website('.excelsecutype1').val(secutype);website('.excelsecutype2').val(secutype);}
else
{var secutype='Convertible Debenture';website('.secutype1').html(secutype);website('.secutype2').html(secutype);website('.excelsecutype1').val(secutype);website('.excelsecutype2').val(secutype);}
website('.contractspecific').html(response.formdata['contract_specification']);website('.excelcontractspecific').val(response.formdata['contract_specification']);website('.contracttype').html(response.formdata['contractname']);website('.excelcontracttype').val(response.formdata['contractname']);website('.posttrans').html(response.pershare);website('.excelposttrans').val(response.pershare);if(response.formdata['typtrans']!=null)
{website('.transtype').html(response.formdata['typtrans']);website('.exceltranstype').html(response.formdata['typtrans']);}
else
{website('.transtype').html('<p style="color:green;">BUY</p>');website('.exceltranstype').html('<p style="color:green;">BUY</p>');}
website('.name').html(response.formdata['fullname']);website('.excelname').val(response.formdata['fullname']);website('.cmpnme').html(response.formdata['company_name']);website('.excelcmpnme').val(response.formdata['company_name']);website('.pan').html(response.formdata['pan']);website('.excelpan').val(response.formdata['pan']);website('.cin').html(response.formdata['cin']);website('.excelcmpisin').val(response.formdata['cin']);website('.contctno').html(response.formdata['mobile']);website('.excelcontctno').val(response.formdata['mobile']);website('.opngblnc').html(response.formdata['adrshldng']);website('.excelopngblnc').val(response.formdata['adrshldng']);website('.pershare').html(response.postnumber);website('.excelpershare').val(response.postnumber);website('.prepercent').html(response.prepercent);website('.excelprepercent').val(response.prepercent);website('.postpercent').html(response.postpercent);website('.excelpostpercent').val(response.postpercent);website('.noofshares').html(response.formdata['tdsshare']);website('.excelnoofshares').val(response.formdata['tdsshare']);website('.totalamt').html(response.formdata['totalamnt']);website('.exceltotalamt').val(response.formdata['totalamnt']);website('.address').html(response.formdata['address']);website('.exceladdress').val(response.formdata['address']);website('.category').html(response.formdata['category']);website('.excelcategory').val(response.formdata['category']);website('.pretrans').html(response.formdata['pretrans']);website('.excelpretrans').val(response.formdata['pretrans']);website('.posttrans').html(response.formdata['posttrans']);website('.excelposttrans').val(response.formdata['posttrans']);website('.fromdate').html(ddmmyyfrom);website('.excelfromdate').val(ddmmyyfrom);website('.todate').html(ddmmyyto);website('.exceltodate').val(ddmmyyto);website('.dateofintimtn').html(ddmmyyinti);website('.exceldateofintimtn').val(ddmmyyinti);website('.acquimode').html(response.formdata['acquistnmode']);website('.excelacquimode').val(response.formdata['acquistnmode']);website('.buyvalue').html(response.formdata['buyvalue']);website('.excelbuyvalue').val(response.formdata['buyvalue']);website('.buynumbrunt').html(response.formdata['buynumbrunt']);website('.excelbuynumbrunt').val(response.formdata['buynumbrunt']);website('.sellvalue').html(response.formdata['sellvalue']);website('.excelsellvalue').val(response.formdata['sellvalue']);website('.sellnumbrunt').html(response.formdata['sellnumbrunt']);website('.excelsellnumbrunt').val(response.formdata['sellnumbrunt']);website('.exetrd').html(response.formdata['exetrd']);website('.excelexetrd').val(response.formdata['exetrd']);website('.formcidexcel').val(id);website('#modaldocument #formcid').val(id);website('#modaldocument').modal('show');}
else
{}},complete:function(response)
{website('#myModalyesno .mainprogressbarforall').fadeOut();},error:function()
{}});});website('body').on('click','.formcpdf',function(e)
{var htmldata=website('#modaldocument .docpdf').html();var formcid=website('#modaldocument #formcid').val();var dataString=website("form[name=excelupload]").serializeArray();var formData={htmldata:htmldata,formcid:formcid,exceldata:dataString};website.ajax({type:"POST",url:'sebi/generateformcPDF',data:formData,dataType:"json",beforeSend:function()
{website('.preloder_wraper').fadeIn();website('#modaldocument .downloadpdf .pdfln').html('');website('#modaldocument .trailpdfdownload').addClass('disabled');},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response)
{if(response.logged===true)
{website('.preloder_wraper').fadeOut();website('#modaldocument .formcpdf').fadeOut();website('#modaldocument .button_pdf .down_load').show();website('#modaldocument .downloadpdf').show();website('#sendforaprvformc').attr('pdfurl',response.pdfpath);website('#modaldocument .downloadpdf').html('<a href="'+response.pdfpath+'" target="_blank" class="downlodthfle" style="color: white;"><span class="glyphicon glyphicon-download-alt floatleft">Download</span></a>');}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function()
{}});});website('body').on('click','.downloadpdf',function(){website('#modaldocument').modal('hide');window.location.reload();});website('body').on('click','.previous',function(e)
{var baseHref=getbaseurl();window.location.href=baseHref+"sebi/transformc";});function numberalphOnly()
{var charCode=event.keyCode;if((charCode>47&&charCode<58)||charCode==32||(charCode>64&&charCode<91)||(charCode>96&&charCode<123)||charCode==8||charCode==44||charCode==40||charCode==41||charCode==46||charCode==47)
return true;else
return false;}
function emailOnly()
{var re=/[A-Z0-9a-z@\._-]/.test(event.key);if(!re){return false;}};