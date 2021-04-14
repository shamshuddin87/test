
website(document).ready(function(){fetchEmpDetails();inittinymace();});function fetchEmpDetails()
{website.ajax({url:"coi/fetchEmpDetails",method:"POST",contentType:"application/x-www-form-urlencoded; charset=UTF-8",dataType:"json",cache:false,beforeSend:function(){},uploadProgress:function(event,position,total,percentComplete){},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{website('.empname').html(response.data.fullname);website('.empid').html(response.data.employeecode);website('.designation').html(response.data.designation);website('.department').html(response.data.deptname);website('.dept').html(response.data.dept);website('.hr').html(response.data.hr);}},complete:function(response){},error:function(jqXHR,textStatus,errorThrown){},});}
function inittinymace()
{tinymce.init({selector:'.textareforedit',plugins:["lists"],a_plugin_option:true,toolbar:'undo redo | formatselect | '+'bold italic backcolor | alignleft aligncenttextareforediter '+'alignright alignjustify | bullist numlist outdent indent | '+'removeformat ',a_configuration_option:400,});}
website("body").on("click",".coipolicy",function(e){var coival=website(this).val();if(coival=='Yes')
{website("input[name=coipolicy][value=No]").removeAttr('checked');website("input[name=coipolicy][value=Yes]").attr('checked','checked');website('.divcoipolicy').css('display','block');website('#attachment_section').css('display','block');}
else if(coival=='No')
{website('.divcoipolicy').css('display','none');website('#attachment_section').css('display','none');}});website("#coicategory").change(function(){var coicate=website(this).val();var formdata={coicate:coicate}
website.ajax({url:"coi/fetchCateQuestions",data:formdata,method:"POST",contentType:"application/x-www-form-urlencoded; charset=UTF-8",dataType:"json",cache:false,beforeSend:function(){},uploadProgress:function(event,position,total,percentComplete){},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{var target='textareforedit';tinymce.get(target).setContent('');website('#insertcoi #coiothers').css("display","none");website('.coicateque').html(response.data)}},complete:function(response){},error:function(jqXHR,textStatus,errorThrown){},});});website('body').on('click','.savecoi',function(e)
{var coipolicy=website('#insertcoi input[name="coipolicy"]:checked').val();if(coipolicy=='Yes')
{var others_des=tinyMCE.activeEditor.getContent();website('#insertcoi #others_des').val(others_des);var coicategory=website('#insertcoi #coicategory').val();var cateque=website('#insertcoi input[name="question"]:checked').val();var catequeid=website('#insertcoi input[name="question"]:checked').attr('id');website('#insertcoi .coicategory option[value="'+coicategory+'"]').attr("selected","selected");website('input[name=question][value="'+cateque+'"]').attr('checked','checked');if(coipolicy=='Yes'&&coicategory=='')
{new PNotify({title:"Alert",text:'Please select the category.',type:"university",hide:true,styling:"bootstrap3",addclass:"dark ",});}
else if(coipolicy=='Yes'&&!cateque)
{new PNotify({title:"Alert",text:'Please select the category question.',type:"university",hide:true,styling:"bootstrap3",addclass:"dark ",});}
else
{website('#insertcoi #attachment_section').css("display","none");if(others_des)
{website('#insertcoi #textarea_othersbox').html('<div class="form-group"><textarea class="form-control rounded-0" id="textarea_othershtml" rows="5" style="pointer-events: all;"></textarea></div>');website('#insertcoi #textarea_othersbox').css("display","block");website('#insertcoi #coiothers').css("display","none");var decoded_others_des=website("<div/>").html(others_des).text();website('#insertcoi #textarea_othershtml').html(decoded_others_des);}
var pdfdata=website("div .coihtmldata").html();website('#insertcoi #coipdfhtml').val(pdfdata)
website(".modalcoihtmldata").html(pdfdata);website('.modalcoihtmldata #textarea_othersbox').css("display","block");if(others_des)
{website('#insertcoi #coiothers').css("display","block");}
website('#insertcoi #textarea_othersbox').css("display","none");website('#insertcoi #attachment_section').css("display","block");website('.modalcoihtmldata #attachment_section').css("display","none");website("#Mymodalcoideclara").modal("show");}}
else
{new PNotify({title:"Alert",text:'You have selected any actual / potential conflict of interest situations you are facing as per Conflict of Interest Policy as No.',type:"university",hide:true,styling:"bootstrap3",addclass:"dark ",});}});website("#insertcoi").ajaxForm({dataType:"json",beforeSend:function()
{website(".preloder_wraper").fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{website(".preloder_wraper").fadeIn();},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{website('#sendcoiforapproval').modal('hide');website("#Mymodalcoideclara .coigeneratepdf").css("display","none");new PNotify({title:"Alert",text:response.message,type:"university",hide:true,styling:"bootstrap3",addclass:"dark ",});var baseHref=getbaseurl();setTimeout(function(){window.location.href=baseHref+'coi';},1000);}
else
{new PNotify({title:"Alert",text:response.message,type:"university",hide:true,styling:"bootstrap3",addclass:"dark ",});}},complete:function(response)
{website(".preloder_wraper").fadeOut();},error:function(jqXHR,textStatus,errorThrown){},});website("body").on("click",".coigeneratepdf",function(e){website("#sendcoiforapproval").modal("show");});website("body").on("click",".sendcoiform",function(e){var sendtype=website(this).val();website('#insertcoi #formsendtype').val(sendtype);website('#insertcoi').submit();});website("body").on("click",".cateque",function(e){var idattr=website(this).attr('id');if(idattr.indexOf('_others')>-1)
{website('#coiothers').css('display','block');}
else
{website('#coiothers').css('display','none');}});website('body').on('click','.btnaddfile',function()
{var getlastid=website('.appendfile').attr('filecntr');getlastid=++getlastid;var addhtmlnxt='';addhtmlnxt+='<div class="col-md-12 col-xs-12 " id="row-'+getlastid+'">';addhtmlnxt+='<label class="control-label">Upload File</label>';addhtmlnxt+='<div class="choose_files">';addhtmlnxt+='<input type="file" name="attachment[]" id="attachment" >';addhtmlnxt+='</div>';addhtmlnxt+='</div>';website('.appendfile').append(addhtmlnxt);website('.appendfile').attr('filecntr',getlastid);});website('body').on('click','.btndeletefile',function()
{var rownum=website('.appendfile').attr('filecntr');if(rownum!=1)
{website('.appendfile #row-'+rownum).remove();website('.appendfile').attr('filecntr',parseInt(rownum)-1);}
else
{return false;}});;