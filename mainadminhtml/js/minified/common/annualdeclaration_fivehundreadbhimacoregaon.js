
website(document).ready(function()
{var addhtmlnxt='';addhtmlnxt+='<tr class="counter">';addhtmlnxt+='<td width="25%">'+""+'</td>';addhtmlnxt+='<td width="25%">'+""+'</td>';addhtmlnxt+='</tr>';website('.dpgradu').html(addhtmlnxt);website('.mfr').html(addhtmlnxt);});website('body').on('click','.getdata',function(){website('#annualdeclarationform').modal('show');});website('body').on('click','.annualform',function(){var ques1=website('#ques1').val();var ques2=website('#ques2').val();var ques3=website('#ques3').val();var ques4=website('#ques4').val();var ques5=website('#ques5').val();var ques7=website('#ques7').val();var ques8=website('#ques8').val();var ques9=website('#ques9').val();var ques10=website('#ques10').val();var ques11=website('#ques11').val();getdataonload();website('#annualdeclarationform').modal('hide');website('#Mymodaldeclara').modal('show');website.ajax({type:"POST",url:'annualdeclaration/getfilecontent',dataType:"json",beforeSend:function()
{website('.preloder_wraper').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response)
{if(response.logged===true)
{website('.modalform').html(response.pdf_content);getrelativedata(ques1,ques2,ques3,ques4,ques5,ques7,ques8,ques9,ques10,ques11);}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function()
{}});});function getallmydata()
{website.ajax({url:'annualdeclaration/fetchinitialdeclaration',method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
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
{addhtmlnxt1+='<tr class="counter">';addhtmlnxt1+='<td width="25%">'+response.persinfo[i]['education']+'</td>';addhtmlnxt1+='<td width="25%">'+response.persinfo[i]['institute']+'</td>';addhtmlnxt1+='</tr>';website("#dpname").html("<p>"+response.persinfo[i]['name']+"</p>");website("#dpname1").html("<span>"+response.persinfo[i]['name']+"</span>");website("#dppan").html("<p>"+response.persinfo[i]['pan']+"</p>");website("#dppan1").html("<span>"+response.persinfo[i]['pan']+"</span>");website("#dpid").html("<p>"+response.clrhouse+"</p>");website("#dpnoofshares").html("<p>"+response.heldshares['desigpershareheld']+"</p>");website("#designame").html(response.persinfo[i]['name']);website("#mobileno").html(response.persinfo[i]['mobileno']);website('#empcode').html(response.getemployeecode[i]['employeecode']);website("#todaydate").html(today);}}
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
function getrelativedata(ques1,ques2,ques3,ques4,ques5,ques7,ques8,ques9,ques10,ques11)
{website.ajax({url:'annualdeclaration/fetchinitialdeclaration',method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{website('.preloder_wraper').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged==true)
{var addhtmlnxt='';var addhtmlnxt1='';var addhtmlnxt2='';var depertable='';if(response.getallrelative.length!=0)
{for(var i=0;i<response.getallrelative.length;i++)
{if(response.getallrelative[i]['relationshipname']=="Spouse")
{website("#rel1").html("<p>"+response.getallrelative[i]['name']+"</p>");website("#sppan").html("<p>"+response.getallrelative[i]['pan']+"</p>");website("#spid").html("<p>"+response.getallrelative[i]['clearing_house']+"</p>");website("#spnoofshares").html("<p>"+response.heldshares['spouse']+"</p>");}
if(response.getallrelative[i]['relationshipname']=="Father")
{website("#rel2").html("<p>"+response.getallrelative[i]['name']+"</p>");website("#ftpan").html("<p>"+response.getallrelative[i]['pan']+"</p>");website("#ftid").html("<p>"+response.getallrelative[i]['clearing_house']+"</p>");website("#ftnoofshares").html("<p>"+response.heldshares['father']+"</p>");}
if(response.getallrelative[i]['relationshipname']=="Sister")
{website("#rel9").html("<p>"+response.getallrelative[i]['name']+"</p>");website("#sitpan").html("<p>"+response.getallrelative[i]['pan']+"</p>");website("#sitid").html("<p>"+response.getallrelative[i]['clearing_house']+"</p>");website("#sitnoofshares").html("<p>"+response.heldshares['sister']+"</p>");}
if(response.getallrelative[i]['relationshipname']=="Mother")
{website("#rel3").html("<p>"+response.getallrelative[i]['name']+"</p>");website("#mtpan").html("<p>"+response.getallrelative[i]['pan']+"</p>");website("#mtid").html("<p>"+response.getallrelative[i]['clearing_house']+"</p>");website("#mtnoofshares").html("<p>"+response.heldshares['mother']+"</p>");}
if(response.getallrelative[i]['relationshipname']=="HUF")
{website("#hfname").html("<p>"+response.getallrelative[i]['name']+"</p>");website("#hfpan").html("<p>"+response.getallrelative[i]['pan']+"</p>");website("#hfid").html("<p>"+response.getallrelative[i]['clearing_house']+"</p>");website("#hfnoofshares").html("<p>"+response.heldshares['huf']+"</p>");}
if(response.getallrelative[i]['relationshipname']=="Brother")
{website("#rel8").html("<p>"+response.getallrelative[i]['name']+"</p>");website("#btpan").html("<p>"+response.getallrelative[i]['pan']+"</p>");website("#btid").html("<p>"+response.getallrelative[i]['clearing_house']+"</p>");website("#btnoofshares").html("<p>"+response.heldshares['brother']+"</p>");}
if(response.getallrelative[i]['relationshipname']=="Son")
{website("#rel4").html("<p>"+response.getallrelative[i]['name']+"</p>");website("#chld1pan").html("<p>"+response.getallrelative[i]['pan']+"</p>");website("#chld1id").html("<p>"+response.getallrelative[i]['clearing_house']+"</p>");website("#chld1noofshares").html("<p>"+response.heldshares['child1']+"</p>");}
if(response.getallrelative[i]['relationshipname']=="Daughter")
{website("#rel6").html("<p>"+response.getallrelative[i]['name']+"</p>");website("#chld2pan").html("<p>"+response.getallrelative[i]['pan']+"</p>");website("#chld2id").html("<p>"+response.getallrelative[i]['clearing_house']+"</p>");website("#chld2noofshares").html("<p>"+response.heldshares['child2']+"</p>");}
if(response.getallrelative[i]['relationshipname']=="Son's Wife")
{website("#rel5").html("<p>"+response.getallrelative[i]['name']+"</p>");website("#chld2pan").html("<p>"+response.getallrelative[i]['pan']+"</p>");website("#chld2id").html("<p>"+response.getallrelative[i]['clearing_house']+"</p>");website("#chld2noofshares").html("<p>"+response.heldshares['child2']+"</p>");}
if(response.getallrelative[i]['relationshipname']=="Daughter's Husband")
{website("#rel7").html("<p>"+response.getallrelative[i]['name']+"</p>");website("#chld2pan").html("<p>"+response.getallrelative[i]['pan']+"</p>");website("#chld2id").html("<p>"+response.getallrelative[i]['clearing_house']+"</p>");website("#chld2noofshares").html("<p>"+response.heldshares['child2']+"</p>");}
if(response.getallrelative[i]['relationshipname']=="Others")
{website("#rel10").html("<p>"+response.getallrelative[i]['name']+"</p>");website("#chld2pan").html("<p>"+response.getallrelative[i]['pan']+"</p>");website("#chld2id").html("<p>"+response.getallrelative[i]['clearing_house']+"</p>");website("#chld2noofshares").html("<p>"+response.heldshares['child2']+"</p>");}}}
if(ques1!=''&&ques1!=null)
{website("#ans1").html("<p>"+ques1+"</p>");}
if(ques2!=''&&ques2!=null)
{website("#ans2").html("<p>"+ques2+"</p>");}
if(ques3!=''&&ques3!=null)
{website("#ans3").html("<p>"+ques3+"</p>");}
if(ques4!=''&&ques4!=null)
{website("#ans4").html("<p>"+ques4+"</p>");}
if(ques5!=''&&ques5!=null)
{website("#ans5").html("<p>"+ques5+"</p>");}
if(ques7!=''&&ques7!=null)
{website("#ans7").html("<p>"+ques7+"</p>");}
if(ques8!=''&&ques8!=null)
{website("#ans8").html("<p>"+ques8+"</p>");}
if(ques9!=''&&ques9!=null)
{website("#ans9").html("<p>"+ques9+"</p>");}
if(ques10!=''&&ques10!=null)
{website("#ans10").html("<p>"+ques10+"</p>");}
if(ques11!=''&&ques11!=null)
{website("#ans11").html("<p>"+ques11+"</p>");}
website('.mfr').html(addhtmlnxt);website('.dpgradu').html(addhtmlnxt1);website('.pastemply').html(addhtmlnxt2);website('#Mymodaldeclara').modal('show');}
else
{new PNotify({title:'Alert',text:"Please Fill All The Data In Software..!!!",type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function(jqXHR,textStatus,errorThrown)
{}})}
website('body').on('click','.formpdf',function(e)
{var htmldata=website('#Mymodaldeclara .modalform').html();var annualyear=website('#annualyear').val();var formData={htmldata:htmldata,annualyear:annualyear};website.ajax({type:"POST",url:'annualdeclaration/generateformbPDF',data:formData,dataType:"json",beforeSend:function()
{website('.preloder_wraper').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response)
{if(response.logged===true)
{website('#Mymodaldeclara .formpdf').css('display','none');website("#Mymodaldeclara #downloadpdf").append('<a  href="'+response.pdfpath+'" target="_blank" class="downlodthfle btn btn-primary" style="color: white;"><span class="glyphicon glyphicon-download-alt floatleft">Download</span> </a>');getdataonload();}
else
{}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function()
{}});});getdataonload();function getdataonload()
{website.ajax({type:"POST",url:'annualdeclaration/getallsavedpdf',dataType:"json",beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response)
{var addhtmlnxt='';if(response.logged==true)
{for(var i=0;i<response.data.length;i++)
{var j=i+1;var sentdate=response.data[i]['sent_date']?response.data[i]['sent_date']:"";addhtmlnxt+='<tr class="counter">';addhtmlnxt+='<td width="25%">'+j+'</td>';addhtmlnxt+='<td width="25%">'+response.data[i]['date_added']+'</td>';addhtmlnxt+='<td width="25%"><i class="fa fa-paper-plane sendpdf" reqid="'+response.data[i]["srno"]+'"></i></td>';addhtmlnxt+='<td width="25%">'+response.data[i]["annualyear"]+'</i></td>';addhtmlnxt+='<td width="25%">'+sentdate+'</td>';if(response.data[i]['send_status']==0)
{addhtmlnxt+='<td width="25%"><a  href="'+response.data[i]["pdfpath"]+'"  class="downlodthfle" style="color:black;"><span class="glyphicon glyphicon-download-alt floatleft"></span></a> <span class="glyphicon glyphicon-trash delfile" delid="'+response.data[i]["srno"]+'"></span></td>';}
else
{addhtmlnxt+='<td width="25%"><a  href="'+response.data[i]["pdfpath"]+'"  class="downlodthfle" style="color:black;"><span class="glyphicon glyphicon-download-alt floatleft"></span></a></td>';}
addhtmlnxt+='</tr>';}}
else
{addhtmlnxt+='<tr class="counter"><td>Data Not Found</td></tr>';}
website('.allpdf').html(addhtmlnxt);},complete:function(response)
{},error:function()
{}});}
website('body').on('click','.sendpdf',function(){var reqid=website(this).attr("reqid");website('#reqid').val(reqid);website('#sendmod').modal('show');});website('body').on('click','#sendreq',function(){var reqid=website('#reqid').val();website.ajax({url:'annualdeclaration/sendrequest',data:{reqid:reqid},method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{website('.preloder_wraper').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged==true)
{website('#sendmod').modal('hide');new PNotify({title:'Alert',text:"Mail Sent Successfilly..!!!",type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});getdataonload();}
else{new PNotify({title:'Alert',text:"Mail Not Sent..!!! ",type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function(jqXHR,textStatus,errorThrown)
{}});});website('body').on('click','.delfile',function(){var delid=website(this).attr("delid");website('#deleteid').val(delid);website('#delmod').modal('show');});website('body').on('click','#deletereq',function(){var delid=website('#deleteid').val();website.ajax({url:'annualdeclaration/deletepdfreq',data:{delid:delid},method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged==true)
{website('#delmod').modal('hide');new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});getdataonload();}
else{new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});});;