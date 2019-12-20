
website("body").on("click","#tradingsub",function(e){var tshares=website('#tshares').val();website.ajax({url:'adminmodule/insertapproversharess',data:{tshares:tshares},method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged==true)
{new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});gettradingshares();}
else{new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});});gettradingshares();function gettradingshares()
{website.ajax({url:'adminmodule/fetchautoapproveshares',method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{var htmlelement='';if(response.logged==true)
{htmlelement+='<tr>';htmlelement+='<td>1</td>';htmlelement+='<td>'+response.data[0]['date_added']+'</td>';htmlelement+='<td>'+response.data[0]['noofshares']+'</td>';htmlelement+='<td><i class="fa fa-trash delday" delid="'+response.data[0].srno+'" style="font-size:15px;color:black;"></i><i class="fa fa-edit faicon editdays" title="Edit entry" noofsharesaa="'+response.data[0]['noofshares']+'"  editid="'+response.data[0].srno+'" ></i></td>';htmlelement+='</tr>';}
else{htmlelement+='<tr>';htmlelement+='<td colspan="5" style="text-align:center;">Data Not Found</td>';htmlelement+='<tr>';}
website('.appendroww').html(htmlelement);},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});}
website('body').on('click','.delday',function(e){var delid=website(this).attr('delid');website('#deleteid').val(delid);website('#delmod').modal('show');});website('body').on('click','#delterms',function(e){var delid=website('#deleteid').val();formdata={reqid:delid};website.ajax({url:'adminmodule/delautoapproveshares',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged==true)
{website('#delmod').modal('hide');new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});gettradingshares();}
else{new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});});website('body').on('click','.editdays',function(e){var editid=website(this).attr('editid');var tdays=website(this).attr('noofsharesaa');website('#editmodal #mdadays').val(tdays)
website('#editmodal #updateid').val(editid)
website('#editmodal').modal('show');});website('body').on('click','#mduptradedays',function(e){var updateid=website('#updateid').val();var mdadays=website('#mdadays').val();formdata={reqid:updateid,mdadays:mdadays};website.ajax({url:'adminmodule/updateautoapprovel',data:formdata,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged==true)
{website('#editmodal').modal('hide');new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});gettradingshares();}
else{new PNotify({title:'Alert',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});});;