
website('#termsandconditions').ajaxForm({dataType:"json",beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged==true)
{new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});getalltermsandconditions();}
else
{new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{},error:function()
{}});getalltermsandconditions();function getalltermsandconditions()
{website.ajax({url:'termsandconditions/getallfiles',method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged==true)
{var myhtml='';for(var i=0;i<response.data.length;i++)
{var j=i+1;myhtml+='<tr>';myhtml+='<td>'+j+'</td>';myhtml+='<td>'+response.data[i].filetitle+'</td>';myhtml+='<td><a href="'+response.data[i].file+'"><i class="fa fa-download" style="font-size:15px;color:black;"></i></a></td>';myhtml+='<td>'+response.data[i].date_of_added+'</td>';myhtml+='<td><i class="fa fa-trash deleteterms" delid="'+response.data[i].id+'" style="font-size:15px;color:black;"></i></a></td>';myhtml+='</tr>';}}
else
{myhtml+='<tr><td colspan="5" style="text-align:center;">Data not Found..!!!</td></tr>';}
website('.modtable').html(myhtml);},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});}
website('body').on('click','.deleteterms',function(e){var delid=website(this).attr('delid');website('#deleteid').val(delid);website('#delmod').modal('show');});website('body').on('click','#delterms',function(e){var delid=website('#deleteid').val();formdata={reqid:delid};website.ajax({url:'termsandconditions/deleteterms',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged==true)
{website('#delmod').modal('hide');new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});getalltermsandconditions();}
else{new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});});;