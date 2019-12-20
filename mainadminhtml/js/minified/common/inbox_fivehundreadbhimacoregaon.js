
function getemptbl()
{var appendhtml='';var formData={tpof:'all',cid:0};website.ajax({url:'inbox/getempconvo',data:formData,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{website('.progress-indeterminate').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{var j=1;for(var i=0;i<response.data.length;i++)
{appendhtml+='<div class="friend getelementrybg" ironmanraju="'+response.data[i].id+'">';appendhtml+='<i class="fa fa-user faiconvb"></i>';appendhtml+='<div class="userprofl">';appendhtml+='<div class="usermnnn">'+response.data[i].fname+' '+response.data[i].lname+'</div>';appendhtml+='<div class="useremaildid">'+response.data[i].emaild+'</div>';appendhtml+='</div>';appendhtml+='<div class="genderid">';if(response.data[i].genderid=='2')
{appendhtml+='<i class="fa fa-female gefaiconvb"></i>';}
else
{appendhtml+='<i class="fa fa-male gefaiconvb"></i>';}
if(response.data[i].dobtrue==true)
{appendhtml+='<i class="fa fa-birthday-cake notdob"></i>';}
appendhtml+='</div>';appendhtml+='<div class="status away cmdot"></div>';appendhtml+='<div class="clearelement"></div>';appendhtml+='</div>';}
website('.getempl').html(appendhtml);website(".getempl").mCustomScrollbar({axis:"y",scrollButtons:{enable:true},theme:"rounded-dark",scrollbarPosition:"inside"});}
else
{}},complete:function(response)
{website('.progress-indeterminate').fadeOut();},error:function(jqXHR,textStatus,errorThrown)
{}});}
getemptbl();;