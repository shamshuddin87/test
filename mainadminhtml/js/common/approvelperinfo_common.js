website('body').on('click','.paginationmn li', function(e) 
{
    //alert(itntfr);
    var rscrntpg = website(this).attr('p');

    //alert(rscrntpg);
    website('.panel.panel-white #pagenum').val(rscrntpg);
            // alert(rscrntpg);
    // var noofrows = website('#noofrows').val(); 
    
   getallusers();
});


website(document).ready(function()
{  
   
   getallusers();
});
website('body').on('change','#noofrows', function(e) 
{
     
    // alert(pagenum);
   getallusers();
});
//-------------------------GO BUTTON-------------------------

website('body').on('click','.go_button', function(e) 
{
   
    var rscrntpg = website('.gotobtn').val();
    // alert(rscrntpg);
    website('.panel.panel-white #pagenum').val(rscrntpg);
     getallusers();
   
});



//--------------------------------------------------------------


function  getallusers()
{
    var noofrows = website('#noofrows').val(); 
    var pagenum = website('#pagenum').val();
    // var chkclk = '';
    // var numofdata = 'all';
    var formdata = {noofrows:noofrows,pagenum:pagenum};
    website.ajax({
                  url:'approvelperinfo/getallusers',
                  data:formdata,
                  method:'POST',
                  contentType:'application/x-www-form-urlencoded; charset=UTF-8',
                  dataType:"json",
                  cache:false,
                  beforeSend: function()
                  { 
                     

                   },
                   uploadProgress: function(event, position, total, percentComplete)
                   { 
                   },
                   success: function(response, textStatus, jqXHR) 
                   {
                       
                       

                        if(response.logged==true)
                        {
                        	
                            var addhtmlnxt='';
                            for(var i=0;i<response.data.length;i++)
                            {
                                  	j=i+1;
                            	   var fullname=response.data[i].fullname?response.data[i].fullname:'None';
                            	   var send_status=response.data[i].send_status;
                            	   var approved_status=response.data[i].approved_status;
                                      addhtmlnxt += '<tr class="counter" tempid="'+response.data[i].wr_id+'" >';
                                      addhtmlnxt += '<td>'+j+'</td>';
                                      addhtmlnxt += '<td>'+fullname+'</td>';
                                      // console.log(send_status);
                                      // send_status=0;
                                     if(send_status)  
                                     {
                                     	 addhtmlnxt += '<td><span style="color:green;">Received</span<</td>';
                                     }
                                     else
                                     {
                                          addhtmlnxt += '<td><span style="color:red;">Not Received</span></td>';
                                     }

                                      if(approved_status==1)  
                                     {
                                          addhtmlnxt +='<td> <p><span class="glyphicon glyphicon-ok" style="color:green;"></span></p>   </td>';
                                     }
                                     else
                                     {
                                         addhtmlnxt +='<td> <span class="glyphicon glyphicon-remove" style="color:red;"></span></td>';
                                     }
                                     if(send_status)
                                     {
                                          addhtmlnxt +='<td class="viewinfo"   reqid="'+response.data[i].wr_id+'"><i class="fa fa-eye" style="font-size:20px"></i></td>';
                                     }
                                     else 
                                     {
                                            addhtmlnxt +='<td>---</td>';
                                     }
                                    
                            }
                          
                         }
                      else
                      {
                          addhtmlnxt += '<td width="15%" colspan="6" style="text-align:center;">Data No Found..!!!</td>';
                       }


                        website(".userdetails").html(addhtmlnxt);
                        website('.paginationmn').html(response.pgnhtml);
                       
                   },
                  complete: function(response) 
                  {
                  
                   },
                  error: function(jqXHR, textStatus, errorThrown)
                  {   }
          });
}

website('body').on('click','.viewinfo',function(e){
var userid=website(this).attr('reqid')
var baseHref = getbaseurl();
var myurl=baseHref+"approvelperinfo/getuserinfo?userid="+btoa(userid);
location.replace(myurl);
// alert(baseHref);
});