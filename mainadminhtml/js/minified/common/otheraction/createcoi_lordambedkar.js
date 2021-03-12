
website(document).ready(function(){fetchEmpDetails();});function fetchEmpDetails()
{website.ajax({url:"coi/fetchEmpDetails",method:"POST",contentType:"application/x-www-form-urlencoded; charset=UTF-8",dataType:"json",cache:false,beforeSend:function(){},uploadProgress:function(event,position,total,percentComplete){},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{website('.empname').html(response.data.fullname);website('.empid').html(response.data.employeecode);website('.designation').html(response.data.designation);website('.department').html(response.data.deptname);website('.dept').html(response.data.dept);website('.hr').html(response.data.hr);}},complete:function(response){},error:function(jqXHR,textStatus,errorThrown){},});}
website("body").on("click",".coipolicy",function(e){var coival=website(this).val();if(coival=='Yes')
{website('.divcoipolicy').css('display','block');}
else if(coival=='No')
{website('.divcoipolicy').css('display','none');}});website("#coicategory").change(function(){var coicate=website(this).val();var formdata={coicate:coicate}
website.ajax({url:"coi/fetchCateQuestions",data:formdata,method:"POST",contentType:"application/x-www-form-urlencoded; charset=UTF-8",dataType:"json",cache:false,beforeSend:function(){},uploadProgress:function(event,position,total,percentComplete){},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{website('.coicateque').html(response.data)}},complete:function(response){},error:function(jqXHR,textStatus,errorThrown){},});});website("#insertcoi").ajaxForm({dataType:"json",beforeSend:function()
{website(".preloder_wraper").fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{website(".preloder_wraper").fadeIn();},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{new PNotify({title:"Alert",text:response.message,type:"university",hide:true,styling:"bootstrap3",addclass:"dark ",});}
else
{new PNotify({title:"Alert",text:response.message,type:"university",hide:true,styling:"bootstrap3",addclass:"dark ",});}},complete:function(response)
{website(".preloder_wraper").fadeOut();},error:function(jqXHR,textStatus,errorThrown){},});;