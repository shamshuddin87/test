website('body').on('click','.paginationmn li', function(e) 
{
    //alert(itntfr);
    var rscrntpg = website(this).attr('p');

    //alert(rscrntpg);
    website('.panel.panel-white #pagenum').val(rscrntpg);
            // alert(rscrntpg);
    // var noofrows = website('#noofrows').val(); 
    
   getallsharecapital();
});


website(document).ready(function()
{  
   
   getallsharecapital();
});
website('body').on('change','#noofrows', function(e) 
{
     
    // alert(pagenum);
   getallsharecapital();
});
//-------------------------GO BUTTON-------------------------

website('body').on('click','.go_button', function(e) 
{
   
    var rscrntpg = website('.gotobtn').val();
    // alert(rscrntpg);
    website('.panel.panel-white #pagenum').val(rscrntpg);
     getallsharecapital();
   
});



//--------------------------------------------------------------


function getallsharecapital(){
   
    var noofrows = website('#noofrows').val(); 
    var pagenum = website('#pagenum').val();
    formdata={noofrows:noofrows,pagenum:pagenum};
    // alert(pagenum);
    website.ajax({
        url:'sharecapital/getallsharecapital',
        data:formdata,
        method:'POST',
        contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        dataType:"json",
        cache:false,
        beforeSend: function()
        { 
            // website('.progress-indeterminate').fadeIn(); 

         },
        uploadProgress: function(event, position, total, percentComplete)
        {   },
        success: function(response, textStatus, jqXHR)
        {  var htmlelements='';
            if(response.logged==true){
                // console.log(response.data);
                           
             for(var i=0;i<response.data.length;i++){
              var j=i+1;  
             htmlelements+='<tr>';
             htmlelements+='<td>'+j+'</td>';
             htmlelements+='<td>'+response.data[i]['pershare']+'</td>';
             htmlelements+='<td><i class="fa fa-edit upedit" shsiid="'+response.data[i][0]+'" ></i>'+
             '<i class="fa fa-trash delups" delupsiid="'+response.data[i][0]+'"></i></td>';
             htmlelements+='</tr>';
             }
            
             // console.log(response.data.length);
             // console.log(response.data); 
            }
            else{
                
                htmlelements += '<tr><td colspan="4" style="text-align:center;">NO DATA FOUND</td></tr>';
                
            }
             website('.sharecapitaldetail').html(htmlelements);
             website('.paginationmn').html(response.pgnhtml);
        },
        complete: function(response)
         { 
         // website('.progress-indeterminate').fadeOut();
         },
        error: function(jqXHR, textStatus, errorThrown)
        {   }
    });                     
                 
}

website('#addshrecapital').ajaxForm({
    //data:formdata,
    //contentType:'application/x-www-form-urlencoded; charset=UTF-8',
    dataType:"json",
    beforeSend: function() 
    {   },
    uploadProgress: function(event, position, total, percentComplete) 
    {   },
    success: function(response, textStatus, jqXHR) 
    {
         if(response.logged === true)
         {

              
            

            new PNotify({title: 'Alert',
                    text: response.message,
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
            }); 
             window.location.reload();
            getallcmpdetails(); 
         }
         else
         {    
            new PNotify({title: 'Alert',
                    text: response.message,
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
            });
         }
    },
    complete: function(response) 
    {   },
    error: function() 
    {   }
});


//---------------------------AJAX FORM TO ADD COMPANY  FINISH--------------------------------//
website('body').on('click','.upedit',function(e){ 
   var  shsiid = website(this).attr('shsiid');
  // website('#cmpmod').modal('show');
  // alert(upsiid);
  
  var formdata={shsiid:shsiid};
 website.ajax({
        url:'sharecapital/getsingleupsidetail',
        data:formdata,
        method:'POST',
        contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        dataType:"json",
        cache:false,
        beforeSend: function()
        { 
            // website('.progress-indeterminate').fadeIn(); 

         },
        uploadProgress: function(event, position, total, percentComplete)
        {   },
        success: function(response, textStatus, jqXHR)
        {  
            if(response.logged==true)
            {
           
         
             var upupsnm=response.data['pershare']?response.data['pershare']:'';
             website('#upupsnm').val(upupsnm);
             website('#upsimodel').modal('show');
             website('#upbtn').attr('editid',response.data['id'])
            }
        },
        complete: function(response)
         { 
         // website('.progress-indeterminate').fadeOut();
         },
        error: function(jqXHR, textStatus, errorThrown)
        {   }
    });                     
   
});

//udtcmp


website('body').on('click','#upbtn',function(e){ 
     var  upupsnm = website('#upupsnm').val();
     var id=website('#upbtn').attr('editid');
     // alert(id);
    
  
  var formdata={upupsnm:upupsnm,id:id};
 website.ajax({
        url:'sharecapital/updateushare',
        data:formdata,
        method:'POST',
        contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        dataType:"json",
        cache:false,
        beforeSend: function()
        { 
            // website('.progress-indeterminate').fadeIn(); 

         },
        uploadProgress: function(event, position, total, percentComplete)
        {   },
        success: function(response, textStatus, jqXHR)
        {  
            if(response.logged==true)
            {
              
                getallsharecapital();
                website('#cmpmod').modal('hide');
                window.location.reload();
               new PNotify({title: 'Alert',
                    text: response.message,
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
            }); 

           }
           else{
              new PNotify({title: 'Alert',
                    text: response.message,
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
                });
           }
        },
        complete: function(response)
         { 
         // website('.progress-indeterminate').fadeOut();
         },
        error: function(jqXHR, textStatus, errorThrown)
        {   }
    });                     
   
});



website('body').on('click','.delups',function(e){ 
  var delid = website(this).attr('delupsiid');
   // alert(delid);
   website('#deleteid').val(delid);
   website('#delmod').modal('show');
});

website('body').on('click','#delups',function(e){

var  delid = website('#deleteid').val();
// alert(delid);
formdata={delid:delid};    
 website.ajax({
        url:'sharecapital/deleteshare',
        data:formdata,
        method:'POST',
        contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        dataType:"json",
        cache:false,
        beforeSend: function()
        { 
            // website('.progress-indeterminate').fadeIn(); 

         },
        uploadProgress: function(event, position, total, percentComplete)
        {   },
        success: function(response, textStatus, jqXHR)
        {  
            if(response.logged==true)
            {
               // window.location.reload();
               website('#delmod').modal('hide');
              
                
               
               new PNotify({title: 'Alert',
                    text: response.message,
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
            }); 
               getallsharecapital();

           }
           else{
              new PNotify({title: 'Alert',
                    text: response.message,
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
                });
           }
        },
        complete: function(response)
         { 
         // website('.progress-indeterminate').fadeOut();
         },
        error: function(jqXHR, textStatus, errorThrown)
        {   }
    });
});