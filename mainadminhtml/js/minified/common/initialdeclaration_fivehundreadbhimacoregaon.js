
website(document).ready(function()
{var addhtmlnxt='';addhtmlnxt+='<tr class="counter">';addhtmlnxt+='<td width="25%">'+""+'</td>';addhtmlnxt+='<td width="25%">'+""+'</td>';addhtmlnxt+='</tr>';website('.dpgradu').html(addhtmlnxt);website('.mfr').html(addhtmlnxt);website("#infomod").modal('show');});website('body').on('click','.getdata',function(){website.ajax({type:"POST",url:'initialdeclaration/getfilecontent',dataType:"json",beforeSend:function()
{website('.preloder_wraper').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response)
{if(response.logged===true)
{website('.modalform').html(response.pdf_content);getallmydata();}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function()
{}});});function getallmydata()
{website.ajax({url:'initialdeclaration/fetchinitialdeclaration',method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{website('.preloder_wraper').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged==true)
{var addhtmlnxt='';var addhtmlnxt1='';var addhtmlnxt2='';var depertable='';if(response.data.length!=0)
{for(var i=0;i<response.data.length;i++)
{addhtmlnxt+='<tr class="counter">';addhtmlnxt+='<td width="25%">'+response.data[i]['related_party']+'</td>';addhtmlnxt+='<td width="25%">'+response.data[i]['pan']+'</td>';addhtmlnxt+='</tr>';}}
else
{addhtmlnxt+='<tr class="counter">';addhtmlnxt+='<td width="25%">'+""+'</td>';addhtmlnxt+='<td width="25%">'+""+'</td>';addhtmlnxt+='</tr>';}
if(response.persinfo.length!=0)
{var today=new Date();var dd=String(today.getDate()).padStart(2,'0');var mm=String(today.getMonth()+1).padStart(2,'0');var yyyy=today.getFullYear();today=dd+'/'+mm+'/'+yyyy;for(var i=0;i<response.persinfo.length;i++)
{addhtmlnxt1+='<tr class="counter">';addhtmlnxt1+='<td width="25%">'+response.persinfo[i]['education']+'</td>';addhtmlnxt1+='<td width="25%">'+response.persinfo[i]['institute']+'</td>';addhtmlnxt1+='</tr>';website("#dpname").html("<p>"+response.persinfo[i]['name']+"</p>");website("#dppan").html("<p>"+response.persinfo[i]['pan']+"</p>");website("#dpid").html("<p>"+response.clrhouse+"</p>");website("#dpnoofshares").html("<p>"+response.heldshares['desigpershareheld']+"</p>");website("#designame").html(response.persinfo[i]['name']);website("#mobileno").html(response.persinfo[i]['mobileno']);website('#empcode').html(response.getemployeecode[i]['employeecode']);website("#todaydate").html(today);}}
else
{addhtmlnxt1+='<tr class="counter">';addhtmlnxt1+='<td width="25%">'+""+'</td>';addhtmlnxt1+='<td width="25%">'+""+'</td>';addhtmlnxt1+='</tr>';}
if(response.pastemployee.length!=0)
{for(var i=0;i<response.pastemployee.length;i++)
{var j=i+1;addhtmlnxt2+='<tr class="counter">';addhtmlnxt2+='<td width="25%">'+j+'</td>';addhtmlnxt2+='<td width="25%">'+response.pastemployee[i]['emp_name']+'</td>';addhtmlnxt2+='</tr>';}}
else
{addhtmlnxt2+='<tr class="counter">';addhtmlnxt2+='<td width="25%">'+""+'</td>';addhtmlnxt2+='<td width="25%">'+""+'</td>';addhtmlnxt2+='</tr>';}
if(response.getallrelative.length!=0)
{for(var i=0;i<response.getallrelative.length;i++)
{if(response.getallrelative[i]['relationshipname']=="Spouse")
{website("#spname").html("<p>"+response.getallrelative[i]['name']+"</p>");website("#sppan").html("<p>"+response.getallrelative[i]['pan']+"</p>");website("#spid").html("<p>"+response.getallrelative[i]['clearing_house']+"</p>");website("#spnoofshares").html("<p>"+response.heldshares['spouse']+"</p>");}
if(response.getallrelative[i]['relationshipname']=="Father")
{website("#ftname").html("<p>"+response.getallrelative[i]['name']+"</p>");website("#ftpan").html("<p>"+response.getallrelative[i]['pan']+"</p>");website("#ftid").html("<p>"+response.getallrelative[i]['clearing_house']+"</p>");website("#ftnoofshares").html("<p>"+response.heldshares['father']+"</p>");}
if(response.getallrelative[i]['relationshipname']=="Sister")
{website("#sitname").html("<p>"+response.getallrelative[i]['name']+"</p>");website("#sitpan").html("<p>"+response.getallrelative[i]['pan']+"</p>");website("#sitid").html("<p>"+response.getallrelative[i]['clearing_house']+"</p>");website("#sitnoofshares").html("<p>"+response.heldshares['sister']+"</p>");}
if(response.getallrelative[i]['relationshipname']=="Mother")
{website("#mtname").html("<p>"+response.getallrelative[i]['name']+"</p>");website("#mtpan").html("<p>"+response.getallrelative[i]['pan']+"</p>");website("#mtid").html("<p>"+response.getallrelative[i]['clearing_house']+"</p>");website("#mtnoofshares").html("<p>"+response.heldshares['mother']+"</p>");}
if(response.getallrelative[i]['relationshipname']=="HUF")
{website("#hfname").html("<p>"+response.getallrelative[i]['name']+"</p>");website("#hfpan").html("<p>"+response.getallrelative[i]['pan']+"</p>");website("#hfid").html("<p>"+response.getallrelative[i]['clearing_house']+"</p>");website("#hfnoofshares").html("<p>"+response.heldshares['huf']+"</p>");}
if(response.getallrelative[i]['relationshipname']=="Brother")
{website("#btname").html("<p>"+response.getallrelative[i]['name']+"</p>");website("#btpan").html("<p>"+response.getallrelative[i]['pan']+"</p>");website("#btid").html("<p>"+response.getallrelative[i]['clearing_house']+"</p>");website("#btnoofshares").html("<p>"+response.heldshares['brother']+"</p>");}
if(response.getallrelative[i]['relationshipname']=="Child-1")
{website("#chld1name").html("<p>"+response.getallrelative[i]['name']+"</p>");website("#chld1pan").html("<p>"+response.getallrelative[i]['pan']+"</p>");website("#chld1id").html("<p>"+response.getallrelative[i]['clearing_house']+"</p>");website("#chld1noofshares").html("<p>"+response.heldshares['child1']+"</p>");}
if(response.getallrelative[i]['relationshipname']=="Child-2")
{website("#chld2name").html("<p>"+response.getallrelative[i]['name']+"</p>");website("#chld2pan").html("<p>"+response.getallrelative[i]['pan']+"</p>");website("#chld2id").html("<p>"+response.getallrelative[i]['clearing_house']+"</p>");website("#chld2noofshares").html("<p>"+response.heldshares['child2']+"</p>");}}}
website('.mfr').html(addhtmlnxt);website('.dpgradu').html(addhtmlnxt1);website('.pastemply').html(addhtmlnxt2);website('#Mymodaldeclara').modal('show');}
else
{new PNotify({title:'Alert',text:"Please Fill All The Data In Software..!!!",type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function(jqXHR,textStatus,errorThrown)
{}})}
website('body').on('click','.formpdf',function(e)
{var htmldata=website('#Mymodaldeclara .modalform').html();var formData={htmldata:htmldata};website.ajax({type:"POST",url:'initialdeclaration/generateformbPDF',data:formData,dataType:"json",beforeSend:function()
{website('.preloder_wraper').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response)
{if(response.logged===true)
{website('#Mymodaldeclara .formpdf').css('display','none');website("#Mymodaldeclara #downloadpdf").append('<a  href="'+response.pdfpath+'" target="_blank" class="downlodthfle btn btn-primary" style="color: white;"><span class="glyphicon glyphicon-download-alt floatleft">Download</span> </a>');website("#infomod1").modal('show');getdataonload();}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function()
{}});});getdataonload();function getdataonload()
{website.ajax({type:"POST",url:'initialdeclaration/getallsavedpdf',dataType:"json",beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response)
{var addhtmlnxt='';if(response.logged==true)
{for(var i=0;i<response.data.length;i++)
{var j=i+1;var sentdate=response.data[i]['sent_date']?response.data[i]['sent_date']:"";addhtmlnxt+='<tr class="counter">';addhtmlnxt+='<td width="25%">'+j+'</td>';addhtmlnxt+='<td width="25%">'+response.data[i]['date_added']+'</td>';addhtmlnxt+='<td width="25%"><i class="fa fa-paper-plane sendpdf" reqid="'+response.data[i]["srno"]+'"></i></td>';addhtmlnxt+='<td width="25%">'+sentdate+'</td>';if(response.data[i]['send_status']==0)
{addhtmlnxt+='<td width="25%"><a  href="'+response.data[i]["pdfpath"]+'"  class="downlodthfle" style="color:black;"><span class="glyphicon glyphicon-download-alt floatleft"></span></a> <span class="glyphicon glyphicon-trash delfile" delid="'+response.data[i]["srno"]+'"></span></td>';}
else
{addhtmlnxt+='<td width="25%"><a  href="'+response.data[i]["pdfpath"]+'"  class="downlodthfle" style="color:black;"><span class="glyphicon glyphicon-download-alt floatleft"></span></a></td>';}
addhtmlnxt+='</tr>';}}
else
{addhtmlnxt+='<tr class="counter"><td>Data Not Found</td></tr>';}
website('.allpdf').html(addhtmlnxt);},complete:function(response)
{},error:function()
{}});}
website('body').on('click','.sendpdf',function(){var reqid=website(this).attr("reqid");website('#reqid').val(reqid);website('#sendmod').modal('show');});website('body').on('click','#sendreq',function(){var reqid=website('#reqid').val();website.ajax({url:'initialdeclaration/sendrequest',data:{reqid:reqid},method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{website('.preloder_wraper').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged==true)
{website('#sendmod').modal('hide');new PNotify({title:'Alert',text:"Mail Sent Successfilly..!!!",type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});getdataonload();}
else{new PNotify({title:'Alert',text:"Mail Not Sent..!!! ",type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function(jqXHR,textStatus,errorThrown)
{}});});website('body').on('click','.delfile',function(){var delid=website(this).attr("delid");website('#deleteid').val(delid);website('#delmod').modal('show');});website('body').on('click','#deletereq',function(){var delid=website('#deleteid').val();website.ajax({url:'initialdeclaration/deletepdfreq',data:{delid:delid},method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged==true)
{website('#delmod').modal('hide');new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});getdataonload();}
else{new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});});;