
website('body').on('change','#noofrows',function(e)
{getMisData();});website('body').on('click','.paginationmn li',function(e)
{var rscrntpg=website(this).attr('p');website('.panel.panel-white #pagenum').val(rscrntpg);getMisData();});website('body').on('click','.go_button',function(e)
{var rscrntpg=website('.gotobtn').val();website('.panel.panel-white #pagenum').val(rscrntpg);getMisData();});website("#srch").on("keyup",function(){var search=website('#srch').val();var pagenum=website('#pagenum').val();website('#srch').attr('status','0');if(pagenum!=1)
{website('#pagenum').val(1);}
getMisData();});getMisData();function getMisData()
{var noofrows=website('#noofrows').val();var pagenum=website('#pagenum').val();var search=website('#srch').val();var emp_status=website('#emp_status').val();website.ajax({url:'mis/getMisAllusers',data:{noofrows:noofrows,pagenum:pagenum,search:search,emp_status:emp_status},method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged===true)
{var frnhtml='<span>Total no of Designated Person <h1 style="color:#bd0111;">'+response.count+'</h1></span>';website('#noofusers').html(frnhtml);website('.appendrow').html(response.mishtml);}
else
{var frnhtml='<span>Total no of Designated Person</span> <h1 style="color:#bd0111;">'+response.count+'</h1>';website('#noofusers').html(frnhtml);website('.appendrow').html('<tr><td colspan="4">No data found...!!!</td></tr>');}
website('#mis1').html(response.pgnhtml);},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});}
website('body').on('click','.redirectpg',function(e)
{var baseHref=getbaseurl();var userid=website(this).attr('userid');window.location.href=baseHref+"mis/misdetails?userid="+btoa(userid);});website('body').on('change','#emp_status',function(e)
{getMisData();});;