
website(document).ready(function()
{getdataonload();website('.bootdatepick').datetimepicker({weekStart:1,todayBtn:0,autoclose:1,todayHighlight:0,startView:2,minView:2,forceParse:0,format:"dd-mm-yyyy"}).on('change',function(e,date)
{var getdate=website(this).val();var getid=website(this).closest('form').attr('id');});});website('#insertcomprestriction').ajaxForm({dataType:"json",beforeSend:function()
{website('.preloder_wraper').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{website('.preloder_wraper').fadeIn();},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{new PNotify({title:'Alert..!!',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});window.location.reload();getdataonload();}else{new PNotify({title:'Alert..!!',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function(jqXHR,textStatus,errorThrown)
{website('.preloder_wraper').fadeOut();}});function getdataonload()
{website.ajax({url:'restrictedcompany/fetchcompanyrestricted',method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{var addhtmlnxt='';for(var i=0;i<response.resdta.length;i++)
{var date=response.resdta[i].date_modified;date=date.split(' ')[0];dtfrmt=date.split("-");dtfrmtspace=date.split(" ");ddmmyy=dtfrmtspace[0];dtfrmt=dtfrmtspace[0].split("-");ddmmyy=dtfrmt[2]+'-'+dtfrmt[1]+'-'+dtfrmt[0];var restriction_to=response.resdta[i].restriction_to?response.resdta[i].restriction_to:'';addhtmlnxt+='<tr class="counter" aprvllistid="'+response.resdta[i].id+'" >';addhtmlnxt+='<td width="25%">'+response.resdta[i].company_name+'</td>';addhtmlnxt+='<td width="25%">'+response.resdta[i].restriction_from+'</td>';addhtmlnxt+='<td width="25%">'+restriction_to+'</td>';addhtmlnxt+='<td width="25%">'+ddmmyy+'</td>';addhtmlnxt+='<td width="25%" >';if(response.getaccess[0].comp_trad_rest_edit==1)
{addhtmlnxt+='<i class="fa fa-edit faicon floatleft editrestrictedcmp" title="Edit entry" aprvllistid="'+response.resdta[i].id+'"></i>';}
else
{addhtmlnxt+='';}
if(response.getaccess[0].comp_trad_rest_delete==1)
{addhtmlnxt+='<i class="fa fa-trash-o faicon floatleft deleterestrictedcmp" title="Delete entry" aprvllistid="'+response.resdta[i].id+'" ></i>';}
else
{addhtmlnxt+='';}
addhtmlnxt+='</td>';addhtmlnxt+='</tr>';}
if(response.getaccess[0].comp_trad_rest_add==1)
{website('.formelementmain').css('display','block');}
else
{website('.formelementmain').css('display','none');new PNotify({title:'You Do Not Have Access To Add Company Restriction',text:"Please Contact To Your Admin",type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}
if(response.getaccess[0].comp_trad_rest_view==1)
{website('.table-responsive.table_wraper').css('display','block');}
else
{website('.table-responsive.table_wraper').css('display','none');new PNotify({title:'You Do Not Have Access To View This Section',text:"Please Contact To Your Admin",type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}
website('.appendrow').html(addhtmlnxt);website('#datableabhi').DataTable();}
else
{if(response.getaccess[0].comp_trad_rest_add==1)
{website('.formelementmain').css('display','block');}
else
{website('.formelementmain').css('display','none');new PNotify({title:'You Do Not Have Access To Add Company Restriction',text:"Please Contact To Your Admin",type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}
if(response.getaccess[0].comp_trad_rest_view==1)
{website('.table-responsive.table_wraper').css('display','block');}
else
{website('.table-responsive.table_wraper').css('display','none');new PNotify({title:'You Do Not Have Access To View This Section',text:"Please Contact To Your Admin",type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}
website('.appendroww').html('');}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});}
website('body').on('click','.editrestrictedcmp',function(){var id=website(this).attr('aprvllistid');var formdata={id:id};website.ajax({url:'restrictedcompany/companyrestrictedforedit',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{var appendhtml='';if(response.data['0'].restriction_to)
{var ddmmyyto=response.data['0'].restriction_to;}
else
{var ddmmyyto='';}
website("#Mymodaledit #validators").val(response.data['0'].company_name);website("#Mymodaledit #compid").val(response.data['0'].listed_company);website("#Mymodaledit #perdresfrom").val(response.data['0'].restriction_from);if(ddmmyyto)
{website("#Mymodaledit #perdresto").val(ddmmyyto);website("#Mymodaledit #perpetuity").prop("checked",false);}
else
{website("#Mymodaledit #perdresto").val('');website("#Mymodaledit #perpetuity").prop("checked",true);website("#Mymodaledit #perdresto").attr('disabled','disabled');}
website('#updatecomprestriction #tempid').val(id);website('#Mymodaledit').modal('show');}
else
{website('.appendrowwaprvl').html('');}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});});website('#updatecomprestriction').ajaxForm({dataType:"json",beforeSend:function()
{website('#Mymodaledit').modal('hide');website('.preloder_wraper').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{website('.preloder_wraper').fadeIn();},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{new PNotify({title:'Alert..!!',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});window.location.reload();}
else
{new PNotify({title:'Alert..!!',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function()
{}});website('input[name="perpetuity"]').click(function(){if(website(this).prop("checked")==true)
{website("#perdresto").attr('disabled','disabled');website("#perdresto").val('');}
else
{website("#perdresto").removeAttr("disabled");}});website('#Mymodaledit input[name="perpetuity"]').click(function(){if(website(this).prop("checked")==true)
{website("#Mymodaledit #perdresto").attr('disabled','disabled');website("#Mymodaledit #perdresto").val('');}
else
{website("#Mymodaledit #perdresto").removeAttr("disabled");}});var timer=0;function mySearch(){var getvalue=website('.header-search-input').val();doSearch(getvalue);}
website('.header-search-input').on('keyup',function(e){var getkeycode=website.trim(e.keyCode);if(getkeycode!='40'&&getkeycode!='38'&&getkeycode!='13'){if(timer){clearTimeout(timer);}
timer=setTimeout(mySearch,400);}});var timer=0;function mySearchforedit(){var getvalue=website('#Mymodaledit .header-search-input').val();doSearchforedit(getvalue);}
website('#Mymodaledit .header-search-input').on('keyup',function(e){var getkeycode=website.trim(e.keyCode);if(getkeycode!='40'&&getkeycode!='38'&&getkeycode!='13'){if(timer){clearTimeout(timer);}
timer=setTimeout(mySearchforedit,400);}});website("#live-search-header-wrapper").scroll(function(){});website("#Mymodaledit #live-search-header-wrapper").scroll(function(){});function myCustomFn(el){}
website("#live-search-header-wrapper").mCustomScrollbar({scrollButtons:{enable:true,scrollType:"stepped"},keyboard:{scrollType:"stepped"},mouseWheel:{scrollAmount:188},theme:"rounded-dark",autoExpandScrollbar:true,snapAmount:188,snapOffset:65,callbacks:{onScroll:function(){myCustomFn(this);}}});website("#Mymodaledit #live-search-header-wrapper").mCustomScrollbar({scrollButtons:{enable:true,scrollType:"stepped"},keyboard:{scrollType:"stepped"},mouseWheel:{scrollAmount:188},theme:"rounded-dark",autoExpandScrollbar:true,snapAmount:188,snapOffset:65,callbacks:{onScroll:function(){}}});function doSearch(getvalue)
{var getkeyword=getvalue;if(website.trim(getkeyword)=="")
{website('#live-search-header-wrapper ul').html('<li class="noresultfound">No Result Fould!!!!</li>');}
else
{var formdata={searchvallist:getkeyword,geturl:''}
website.ajax({url:'restrictedcompany/cmplists',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{website('#live-search-header-wrapper').fadeIn();website('#live-search-header-wrapper ul').html("<li>Please wait...</li>");website('.mainprogressbarforall .progress').fadeIn();website('.filtr-container').html("");website('.filtr-container').removeAttr("style");website('.filtr-search').fadeIn();website('.filtr-search').val("");},uploadProgress:function(event,position,total,percentComplete)
{website('#live-search-header-wrapper').fadeIn();website('#live-search-header-wrapper ul').html("<li>Please wait...</li>");website('.mainprogressbarforall .progress').fadeIn();website(".mainprogressbarforall .progress .progress-bar").width(percentComplete+'%');},success:function(response,textStatus,jqXHR)
{var addhtml='';website('#live-search-header-wrapper ul').html("");website('#live-search-header-wrapper').fadeIn();if(response.logged==true&&response.data.length>=1)
{for(var i=0;i<response.data.length;i++)
{if(i==0)
{addhtml+='<li id="'+response.data[i].id+'" company_name="'+response.data[i].company_name+'" class="topul validatorsid">'+response.data[i].company_name;addhtml+='<div class="clearelement"></div></li>';}
else if(i==((response.data.length)-1))
{addhtml+='<li id="'+response.data[i].id+'" company_name="'+response.data[i].company_name+'"  class="bottomul validatorsid">'+response.data[i].company_name;addhtml+='<div class="clearelement"></div></li>';}
else
{addhtml+='<li id="'+response.data[i].id+'" company_name="'+response.data[i].company_name+'"  class="bottomul validatorsid">'+response.data[i].company_name;addhtml+='<div class="clearelement"></div></li>';}}
website('#live-search-header-wrapper ul').html(addhtml);}
else
{website('#live-search-header-wrapper ul').html('<li class="noresultfound"><span class="resp_new">'+response.message+'</span></li>');}
website(".mainprogressbarforall .progress .progress-bar").width('100%');},complete:function(response)
{website('.search-row').fadeIn();website(".mainprogressbarforall .progress .progress-bar").fadeOut();},error:function(jqXHR,textStatus,errorThrown)
{}});}}
function doSearchforedit(getvalue)
{var getkeyword=getvalue;if(website.trim(getkeyword)=="")
{website('#Mymodaledit #live-search-header-wrapper ul').html('<li class="noresultfound">No Result Fould!!!!</li>');}
else
{var formdata={searchvallist:getkeyword,geturl:''}
website.ajax({url:'restrictedcompany/cmplists',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{website('#Mymodaledit #live-search-header-wrapper').fadeIn();website('#Mymodaledit #live-search-header-wrapper ul').html("<li>Please wait...</li>");website('#Mymodaledit .mainprogressbarforall .progress').fadeIn();website('#Mymodaledit .filtr-container').html("");website('#Mymodaledit .filtr-container').removeAttr("style");website('#Mymodaledit .filtr-search').fadeIn();website('#Mymodaledit .filtr-search').val("");},uploadProgress:function(event,position,total,percentComplete)
{website('#Mymodaledit #live-search-header-wrapper').fadeIn();website('#Mymodaledit #live-search-header-wrapper ul').html("<li>Please wait...</li>");website('#Mymodaledit .mainprogressbarforall .progress').fadeIn();website("#Mymodaledit .mainprogressbarforall .progress .progress-bar").width(percentComplete+'%');},success:function(response,textStatus,jqXHR)
{var addhtml='';website('#Mymodaledit #live-search-header-wrapper ul').html("");website('#Mymodaledit #live-search-header-wrapper').fadeIn();if(response.logged==true&&response.data.length>=1)
{for(var i=0;i<response.data.length;i++)
{if(i==0)
{addhtml+='<li id="'+response.data[i].id+'" company_name="'+response.data[i].company_name+'" class="topul validatorsid">'+response.data[i].company_name;addhtml+='<div class="clearelement"></div></li>';}
else if(i==((response.data.length)-1))
{addhtml+='<li id="'+response.data[i].id+'" company_name="'+response.data[i].company_name+'"  class="bottomul validatorsid">'+response.data[i].company_name;addhtml+='<div class="clearelement"></div></li>';}
else
{addhtml+='<li id="'+response.data[i].id+'" company_name="'+response.data[i].company_name+'"  class="bottomul validatorsid">'+response.data[i].company_name;addhtml+='<div class="clearelement"></div></li>';}}
website('#live-search-header-wrapper ul').html(addhtml);}
else
{website('#Mymodaledit #live-search-header-wrapper ul').html('<li class="noresultfound"><span class="resp_new">'+response.message+'</span></li>');}
website("#Mymodaledit .mainprogressbarforall .progress .progress-bar").width('100%');},complete:function(response)
{website('#Mymodaledit .search-row').fadeIn();website("#Mymodaledit .mainprogressbarforall .progress .progress-bar").fadeOut();},error:function(jqXHR,textStatus,errorThrown)
{}});}}
website('body').on('click','.validatorsid',function(e){var compid=website(this).attr('id');var compname=website(this).attr('company_name');website('#insertcomprestriction #search-box').val(compname);website('#search-box').attr('compid',compid);website('#search-box').attr('compname',compname);website('#insertcomprestriction #compid').val(compid);website('#live-search-header-wrapper').fadeOut();website('#insertcomprestriction #validators').val(compname);website('#validators').attr('compid',compid);website('#validators').attr('compnyname',compname);});website('body').on('click','#Mymodaledit .validatorsid',function(e){var compid=website(this).attr('id');var compname=website(this).attr('company_name');website('#updatecomprestriction #search-box').val(compname);website('#Mymodaledit #search-box').attr('compid',compid);website('#Mymodaledit #search-box').attr('compname',compname);website('#Mymodaledit #live-search-header-wrapper').fadeOut();website('#updatecomprestriction #validators').val(compname);website('#updatecomprestriction #compid').val(compid);website('#Mymodaledit #validators').attr('compid',compid);website('#Mymodaledit #validators').attr('compnyname',compname);});website(function(){});website('body').on('click','.deleterestrictedcmp',function(){var id=website(this).attr('aprvllistid');website('#myModalyesno').modal('show');website('#myModalyesno .yesconfirm').attr('aprvllistid',id);});website('body').on('click','.yesconfirm',function(){var id=website(this).attr('aprvllistid');var formdata={id:id};website.ajax({url:'restrictedcompany/companyrestrictedfordelete',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{window.location.reload();new PNotify({title:'Record Deleted Successfully',text:'Record Deleted Successfully',type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}
else
{new PNotify({title:'Record Not Deleted',text:'Record Not Updated',type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{website('#myModalyesno .mainprogressbarforall').fadeOut();},error:function()
{}});});;