
website('.relativesform').hide();website('.personal').click(function(e){e.preventDefault();website(this).addClass('active');website('.relatives').removeClass('active');website('.personaldetails').show();website('.relativesform').hide();});website('.relatives').click(function(e){e.preventDefault();website(this).addClass('active');website('.personal').removeClass('active');website('.relativesform').show();website('.personaldetails').hide();});datepicker();function datepicker(){website('.bootdatepick').datetimepicker({weekStart:1,todayBtn:0,autoclose:1,todayHighlight:0,startView:2,minView:2,forceParse:0,format:"dd-mm-yyyy"}).on('change',function(e,date)
{var getdate=website(this).val();var getid=website(this).closest('form').attr('id');});}
website("body").on("click","#noofdmat",function(e){var no=website('#noofacc').val();if(no<=10){var myhtml='<table class="table table-inverse" id="datableabhi"><tr><th>Account No </th><th>Depository Participient </th><th>Clearing House</th></tr>';for(var i=1;i<=no;i++){myhtml+='<tr><td><input type="text" class="form-control  acsub" id="field_'+i+'" placeholder="Account No '+i+'" onkeypress="return isAlphaNumeric(event,this.value);"maxlength="16" pattern="[A-Za-z0-9]{16}"> </td><td><input type="text" class="form-control deppoparticipient showhovertext3'+i+'" id="field2_'+i+'" placeholder="Depository Participient '+i+'" onmouseover="boxshow(this.className)" onmouseout="boxhide(this.className)"><span id= "showhovertext3'+i+'" class ="cssclass1 " style="display: none;">16 digit DP Id/Client Id</span></td><td><input type="text" class="form-control  clearinghouse" id="field3_'+i+'" placeholder="Clearing House'+i+'"></td></tr>';}
myhtml+='</table>';myhtml+='<button type="button" class="btn btn-primary" id="subdemat">Submit</button>';website('.appendaccfield').html(myhtml);}
else{new PNotify({title:'Alert',text:"No Of Accounts Must Be Less Than 10",type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}});website("body").on("click","#subdemat",function(e){var len=website('.acsub').length;var mydata=[];for(var i=1;i<=len;i++)
{var accno=website('#field_'+i).val();var dp=website('#field2_'+i).val();var clhouse=website('#field3_'+i).val();var obj={"accno":accno,"dp":dp,"clhouse":clhouse};mydata.push(obj);}
website.ajax({url:'portfolio/storeaccno',data:{accno:mydata},method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{website('.preloder_wraper').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true){new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});getuseraccno();}
else{new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function(jqXHR,textStatus,errorThrown)
{}});});getuseraccno();function getuseraccno(){website.ajax({url:'portfolio/getaccno',method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{var htmlelements='';var j=1;website("#showdemat").css("display","block");for(var i=0;i<response.data.length;i++)
{htmlelements+='<tr>';htmlelements+='<td>'+j+'</td>';htmlelements+='<td>'+response.data[i].accountno+'</td>';htmlelements+='<td>'+response.data[i].depository_participient+'</td>';htmlelements+='<td>'+response.data[i].clearing_house+'</td>';htmlelements+='<td><i class="fa fa-edit accedit" accno="'+response.data[i].accountno+'" rp="'+response.data[i].depository_participient+'" hc="'+response.data[i].clearing_house+'"  acountedit="'+response.data[i].id+'" ></i>'+'<i class="fa fa-trash accdel" acountdel="'+response.data[i].id+'" ></i></td>';htmlelements+='</tr>';j=j+1;}}
else{htmlelements+='<tr>';htmlelements+='<td colspan="5" style="text-align:center;">Data Not Found</td>';htmlelements+='</tr>';}
website('.accdetails').html(htmlelements);},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});}
website("body").on("click",".accdel",function(e){var delid=website(this).attr('acountdel');website('#myModalyesno #delid').val(delid);website('#myModalyesno').modal('show');});website("body").on("click",".yesconfirm",function(e){var delid=website('#myModalyesno #delid').val();website.ajax({url:'portfolio/deleteacc',method:'POST',data:{delid:delid},contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged==true){website('#myModalyesno').modal('hide');getuseraccno();new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}
else{new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});});website("body").on("click",".accedit",function(e){var accno=website(this).attr('accno');var editid=website(this).attr('acountedit');var rp=website(this).attr('rp');var hc=website(this).attr('hc');website('#editaccmodal #editaccno').val(accno)
website('#editaccmodal #clhouse').val(hc)
website('#editaccmodal #dpar').val(rp)
website('#editaccmodal .upacc').attr('btnedit',editid);website('#editaccmodal').modal('show');});website('body').on("click",".upacc",function(e){var accno=website('#editaccno').val();var rp=website('#dpar').val();var hc=website('#clhouse').val();var editid=website(this).attr('btnedit');website.ajax({url:'portfolio/updateacc',method:'POST',data:{accno:accno,editid:editid,rp:rp,hc:hc},contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged==true){website('#editaccmodal').modal('hide');getuseraccno();new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}
else{new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});})
website("body").on("click",".relhtml",function(e){var noofacc=website('#reldematno').val();var relinfo=website('#relinfo').val();if(relinfo!='')
{var no=website('#reldematno').val();if(no<=10){var myhtml=' <table class="table table-inverse" id="datableabhi"><tr><th>Account No </th><th>Depository Participient </th><th>Clearing House</th></tr>';for(var i=1;i<=no;i++)
{myhtml+='<tr><td><input type="text" class="form-control relac" id="relfield_'+i+'"  placeholder="Account No '+i+'" onkeypress="return isAlphaNumeric(event,this.value);"maxlength="16" pattern="[A-Za-z0-9]{16}"></td><td><input type="text" class="form-control deppoparticipient showhovertext4'+i+'" id="relfield2_'+i+'" placeholder="Depository Participient '+i+'"  onmouseover="boxshow(this.className)" onmouseout="boxhide(this.className)"><span id = "showhovertext4'+i+'" class = "cssclass1" style = "display:none;">16 digit DP Id/Client Id</span>"</td><td><input type="text" class="form-control clearinghouse" id="relfield3_'+i+'" placeholder="Clearing House'+i+'"></td></tr>';}
myhtml+='</table>'
myhtml+='<section class=""><button type="button" class="btn btn-primary" id="subreldemat">Submit</button>';website('.relfieldapnd').html(myhtml);}
else{new PNotify({title:'Alert',text:"No Of Accounts Must Be Less Than 10",type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}}
else{new PNotify({title:'Alert',text:"Please Select Relative Name",type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}});website("body").on("click","#pastbtnsub",function(e){var nooffield=website('.relac').length;var relinfo=website('#relinfo').val();var myarr=[];for(var i=1;i<=nooffield;i++)
{var txtdata=website('#relfield_'+i).val();var dp=website('#relfield2_'+i).val();var ch=website('#relfield3_'+i).val();if(txtdata!=''&&dp!=''&&ch!='')
{var obj={relativeacc:txtdata,dp:dp,ch:ch};myarr.push(obj);}
else
{new PNotify({title:'Alert',text:"Please Check All The Input Fields",type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}}
if(myarr.length>=1)
{website.ajax({url:'portfolio/insertrelativeacc',method:'POST',data:{myarr:myarr,relid:relinfo},contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged==true){new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});relativeaccinfo();}
else{new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});}});relativeaccinfo();function relativeaccinfo(){website.ajax({url:'portfolio/getreluseracc',method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{var htmlelements='';var j=1;for(var i=0;i<response.data.length;i++)
{htmlelements+='<tr>';htmlelements+='<td>'+j+'</td>';htmlelements+='<td>'+response.data[i].name+'</td>';htmlelements+='<td>'+response.data[i].accountno+'</td>';htmlelements+='<td>'+response.data[i].depository_participient+'</td>';htmlelements+='<td>'+response.data[i].clearing_house+'</td>';htmlelements+='<td><i class="fa fa-edit relaccedit" relname="'+response.data[i].name+'" dp="'+response.data[i].depository_participient+'" ch="'+response.data[i].clearing_house+'" relaccno="'+response.data[i].accountno+'" relacedit="'+response.data[i].id+'" ></i>'+'<i class="fa fa-trash relaccdel" acourel="'+response.data[i].id+'" ></i></td>';htmlelements+='</tr>';j=j+1;}}
else{htmlelements+='<tr>';htmlelements+='<td colspan="4" style="text-align:center;">Data Not Found</td>';htmlelements+='</tr>';}
website('.relaccdetails').html(htmlelements);},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});}
website("body").on("click",".relaccdel",function(e){var delid=website(this).attr('acourel');website('#myModalrel .reldel').attr('reldel',delid);website('#myModalrel').modal('show');});website("body").on("click",".reldel",function(e){var delid=website(this).attr('reldel');website.ajax({url:'portfolio/reldeleteacc',method:'POST',data:{delid:delid},contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged==true){website('#myModalrel').modal('hide');relativeaccinfo();new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}
else{new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});});website("body").on("click",".relaccedit",function(e){var relaccno=website(this).attr('relaccno');var dp=website(this).attr('dp');var ch=website(this).attr('ch');var name=website(this).attr('relname');var editid=website(this).attr('relacedit');website('#releditaccmodal #dparrel').val(dp);website('#releditaccmodal #relclhouse').val(ch);website('#releditaccmodal #reledname').val(name);website('#releditaccmodal #releditaccno').val(relaccno);website('#releditaccmodal .relupacc').attr('btnedit',editid);website('#releditaccmodal').modal('show');});website("body").on("click",".relupacc",function(e){var reledit=website(this).attr('btnedit');var accno=website("#releditaccno").val();var dp=website("#dparrel").val();var ch=website("#relclhouse").val();website.ajax({url:'portfolio/updaterelacc',method:'POST',data:{reledit:reledit,accno:accno,dp:dp,ch:ch},contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged==true){relativeaccinfo();website('#releditaccmodal').modal('hide');new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}
else{new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});})
website("body").on("click","#subreldemat",function(e){var nooffield=website('.relac').length;var relinfo=website('#relinfo').val();var myarr=[];for(var i=1;i<=nooffield;i++){var txtdata=website('#relfield_'+i).val();var dp=website('#relfield2_'+i).val();var ch=website('#relfield3_'+i).val();if(txtdata!=''&&dp!=''&&ch!=''){var obj={relativeacc:txtdata,dp:dp,ch:ch};myarr.push(obj);}
else{new PNotify({title:'Alert',text:"Please Check All The Input Fields",type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}}
if(myarr.length>=1)
{website.ajax({url:'portfolio/insertrelativeacc',method:'POST',data:{myarr:myarr,relid:relinfo},contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged==true){new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});relativeaccinfo();}
else{new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});}});website('body').on('click','.dematup',function(e){var dematup=website(this).val();website.ajax({url:'portfolio/zerodematacc',data:{dematup:dematup},method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{website('#alertcommon #allalertmsg').html(response.message);website('#alertcommon').modal('show');},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});});function showsection(){var section=document.getElementById("showdemat");if(section.style.display==="none"){section.style.display="block";}}
function hidesection(){var section=document.getElementById("showdemat");if(section.style.display==="block")
{section.style.display="none";}}
function boxshow(name)
{var classname=name.split(" ");var length=classname.length;if(length==5)
{website("#"+classname[4]).css("display","block");}
else if(length==3)
{website("#"+classname[2]).css("display","inline-block");}}
function boxhide(name)
{var classname=name.split(" ");var length=classname.length;if(length==5)
{website("#"+classname[4]).css("display","none");}
else if(length==3)
{website("#"+classname[2]).css("display","none");}};