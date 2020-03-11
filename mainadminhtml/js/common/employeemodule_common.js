website(document).ready(function()
{
     var url = new URL(window.location.href);
    var action = url.searchParams.has("from");
    //console.log(action);return false;
    if(action)
        {
            var actval = atob(url.searchParams.get("from"));
        }
    else
        {
        }
    if(actval == 'dash')
    {
        website('.personal').removeClass('active');
        website('.relatives').addClass('active');
        website('.relativesform').show();
        website('.personaldetails').hide();
        website('.mymfr').hide();
          
    }
    else
    {

    }
});



website('.relativesform').hide();

 website('.personal').click(function(e) {
   e.preventDefault();
   website(this).addClass('active');
   website('.relatives').removeClass('active');
   website('.mfr').removeClass('active');
   website('.personaldetails').show();
   website('.mymfr').hide();
   website('.relativesform').hide();
 });

 website('.relatives').click(function(e) {
   e.preventDefault();
   website(this).addClass('active');
   website('.personal').removeClass('active');
    website('.mfr').removeClass('active');
   website('.relativesform').show();
   website('.mymfr').hide();
   website('.personaldetails').hide();
 });
  website('.mfr').click(function(e) {
   e.preventDefault();
   website(this).addClass('active');
   website('.relatives').removeClass('active');
   website('.personal').removeClass('active');
   website('.relativesform').hide();
   website('.personaldetails').hide();
   website('.mymfr').show();
 });

 // Added input value check on postback/load, removed floatLabel class from select input. Modified the scss, added color map.

(function(replace){
   function floatLabel(inputType){
      replace(inputType).each(function(){
         var replacethis = replace(this);
         var text_value = replace(this).val();

         // on focus add class "active" to label
         replacethis.focus(function(){
            replacethis.next().addClass("active");
         });

         // on blur check field and remove class if needed
         replacethis.blur(function(){
            if(replacethis.val() === '' || replacethis.val() === 'blank'){
               replacethis.next().removeClass();
               }
         });
               
         // Check input values on postback and add class "active" if value exists
         if(text_value!=''){
            replacethis.next().addClass("active");
            }
         });
    
      // Automatically remove floatLabel class from select input on load
      replace( "select" ).next().removeClass();
   }
   // Add a class of "floatLabel" to the input field
   floatLabel(".floatLabel");
})(jQuery);

datepicker();
function datepicker(){
website('.bootdatepick').datetimepicker({
        weekStart: 1,
        todayBtn:  0,
        autoclose: 1,
        todayHighlight: 0,
        startView: 2,
        minView: 2,
        forceParse: 0,
        format: "dd-mm-yyyy"

    }).on('change', function(e, date)
    {
        var getdate = website(this).val();
        // console.log(getdate);
        var getid = website(this).closest('form').attr('id');
    });
  }


//######################################### AJAX Personal INSERTION ################################################//

function confirmdisclosure(id)
{
    
   var id = id;
 

  if(id == "confirmpersonalinfo" )
  {

    var shareholdng = website('#shareholdng').val();
    var adrsholdng = website('#adrsholdng').val();
    
    if(shareholdng || adrsholdng )
    {
     
       website('#updateholdings1').modal('show');
    }
    else
    {

      website('input[name="confirmpersonalinfo"]').attr("type", "submit");
      
      //alert("inelse");
      website('#perdetail').ajaxForm({
      dataType:"json",
      beforeSend: function() 
      {  website('.preloder_wraper').fadeIn(); },
      uploadProgress: function(event, position, total, percentComplete) 
      {   },
      success: function(response, textStatus, jqXHR) 
      {
         if(response.logged === true)
         {

              
               getpersonalinfo();
               new PNotify({title: 'Alert',
                    text: response.message,
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
                }); 
            window.location.reload();
 
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
    {  website('.preloder_wraper').fadeOut();


    },
    error: function() 
    {   }


   });
  }
    
    
  }
  else if(id == "relsub")
  {
    
    var shareholdng = website('#getdata_1 #shareholdng').val();
    var adrsholdng = website('#getdata_1 #adrsholdng').val();

   
     if(shareholdng || adrsholdng )
    {
     
       website('#updateholdings2').modal('show');
    }
    else
    {

      website('input[name="relsub"]').attr("type", "submit");
      
      alert("inelse");
      website('#getdata_1').ajaxForm({
      dataType:"json",
      beforeSend: function() 
      {  website('.preloder_wraper').fadeIn(); },
      uploadProgress: function(event, position, total, percentComplete) 
      {   },
      success: function(response, textStatus, jqXHR) 
      {
         if(response.logged === true)
         {

              
               getpersonalinfo();
               new PNotify({title: 'Alert',
                    text: response.message,
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
                }); 
            window.location.reload();
 
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
    {  website('.preloder_wraper').fadeOut();


    },
    error: function() 
    {   }


   });
  }
  }
  else if(id == "relupdate" )
  {
    
    var shareholdng =  website("#reledit #shareholdng").val();
    var adrsholdng =  website("#reledit #adrsholdng").val();

     if(shareholdng || adrsholdng )
    {
     
       website('#updateholdings3').modal('show');
    }
    else
    {

      website('input[name="relupdate"]').attr("type", "submit");
      
      //alert("inelse");
      website('#uprel').ajaxForm({
      dataType:"json",
      beforeSend: function() 
      {  website('.preloder_wraper').fadeIn(); },
      uploadProgress: function(event, position, total, percentComplete) 
      {   },
      success: function(response, textStatus, jqXHR) 
      {
         if(response.logged === true)
         {

               getpersonalinfo();
               new PNotify({title: 'Alert',
                    text: response.message,
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
                }); 
            window.location.reload();
 
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
    {  website('.preloder_wraper').fadeOut();


    },
    error: function() 
    {   }


   });
  }
    
    
  }
  
  
} 


function nodisclosures(id)
{

 if(id == "nodisclosures1" )
  {
    
    new PNotify({title: 'Alert',
                    text: 'Please Submit necessary disclosures First',
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
                }); 
  website('#updateholdings1').modal('hide');

   
  }
  else if(id == "nodisclosures2")
  {

    new PNotify({title: 'Alert',
                    text: 'Please Submit necessary disclosures First',
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
                }); 
  website('#updateholdings2').modal('hide');
  }
  else if(id == "nodisclosures3" )
  {

    new PNotify({title: 'Alert',
                    text: 'Please Submit necessary disclosures First',
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
                }); 
  website('#updateholdings3').modal('hide');
  website('#reledit').modal('hide');
  }
 
}



website('body').on('click','#yesdisclosures1',function(e){
   
   var fname =  website("#fname").val();
   var pan =  website("#pan").val();
   var aadhar =  website("#aadhar").val();
   var dob =  website("#dob").val();
   var sex =  website("input[name='sex']:checked").val();
   
   var address =  website("#address").val();
   var eduqulfcn =  website("#eduqulfcn").val();
   var institute =  website("#institute").val();
   var mobno =  website("#mobno").val();
   var hldngfile =  website("#hldngfile").val();
   var legal_idntfr =  website("#legal_idntfr").val();
   var legal_idntfctn_no =  website("#legal_idntfctn_no").val();
   var rqid =  website("#rqid").val();
   var toemail =  website("#toemail").val();
   //alert(toemail);
    var shareholdng =  website("#shareholdng").val();
     var adrsholdng =  website("#adrsholdng").val();
     var occupation =  website("#occupation").val();
     var company =  website("#company").val();


   var formdata = {fname:fname,pan:pan,aadhar:aadhar,dob:dob,sex:sex,address:address,eduqulfcn:eduqulfcn,institute:institute,mobno:mobno,hldngfile:hldngfile,legal_idntfr:legal_idntfr,legal_idntfctn_no:legal_idntfctn_no,rqid:rqid,toemail:toemail,shareholdng:shareholdng,adrsholdng:adrsholdng,occupation:occupation,company:company}
   website.ajax({
        url:'employeemodule/insmydetail',
        
        method:'POST',
        data:formdata,
        // contentType:'json',
        contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
        dataType:"json",
        cache:false,
        //async:true, Cross domain checking
        beforeSend: function()
        {  website('.preloder_wraper').fadeIn(); },
        uploadProgress: function(event, position, total, percentComplete)
        {   },
        success: function(response, textStatus, jqXHR)
        {    website('.preloder_wraper').fadeOut();
          website('#updateholdings1').modal('hide');
              if(response.logged==true)
              {
                getpersonalinfo(); 
                new PNotify({title: 'Alert',
                          text: response.message,
                          type: 'university',
                          hide: true,
                          styling: 'bootstrap3',
                          addclass: 'dark ',
                      });

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
        }
   });
});
 



website('body').on('click','#yesdisclosures2',function(e)
{
   
  var fname =  website("#getdata_1 #fname").val();
   var relationship =  website("#getdata_1 #relationship").val();
   var depnature    = website("#getdata_1 #depnature").val();
   var pan =  website("#getdata_1 #pan").val();
   var aadhar =  website("#getdata_1 #aadhar").val();
   var dob =  website("#getdata_1 #1_dob").val();

   var sex =  website("#getdata_1 input[name='sex']:checked").val();
   
   var address =  website("#getdata_1 #addr").val();
   var eduqulfcn =  website("#getdata_1 #eduqulfcn").val();
  
   var file =  website("#getdata_1 #file").val();
   var legal_idntfr =  website("#getdata_1 #legal_idntfr").val();
   var legal_idntfctn_no =  website("#getdata_1 #legal_idntfctn_no").val();
  
   var shareholdng =  website("#getdata_1 #shareholdng").val();
   var adrsholdng =  website("#getdata_1 #adrsholdng").val();
   var reloccupation =  website("#getdata_1 #reloccupation").val();
   var relcompany =  website("#getdata_1 #relcompany").val();


  var formdata = {relationship:relationship,fname:fname,pan:pan,aadhar:aadhar,dob:dob,sex:sex,address:address,eduqulfcn:eduqulfcn,file:file,legal_idntfr:legal_idntfr,legal_idntfctn_no:legal_idntfctn_no,shareholdng:shareholdng,adrsholdng:adrsholdng,reloccupation:reloccupation,relcompany:relcompany,depnature:depnature}
   website.ajax({
        url:'employeemodule/relationdata',
        
        method:'POST',
        data:formdata,
        // contentType:'json',
        contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
        dataType:"json",
        cache:false,
        //async:true, Cross domain checking
        beforeSend: function()
        {  website('.preloder_wraper').fadeIn(); },
        uploadProgress: function(event, position, total, percentComplete)
        {   },
        success: function(response, textStatus, jqXHR) 
        { website('#updateholdings2').modal('hide');
         if(response.logged === true)
         {
               
              
               getrelationdata();
               new PNotify({title: 'Alert',
                    text: response.message,
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
                }); 
             window.location.reload();
            
 
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
    {  website('.preloder_wraper').fadeOut();  },
    error: function() 
    {   }
   });
 });



website('body').on('click','#yesdisclosures3',function(e)
{
   
   var name =  website("#reledit #name").val();
    var relationship =  website("#reledit #relationship").val();
   var depnature    = website("#reledit #depnature").val();
   var releditid =  website("#reledit #releditid").val();
 
   var pan =  website("#reledit #pan").val();
   var aadhar =  website("#reledit #aadhar").val();
   var dob =  website("#reledit #dob").val();
   var sex =  website("#reledit input[name='sex']:checked").val();
   
   var address =  website("#reledit #address").val();
   var eduqulfcn =  website("#reledit #eduqulfcn").val();
  
   var file =  website("#reledit #file").val();
   var legal_idntfr =  website("#reledit #legal_idntfr").val();
   var legal_idntfctn_no =  website("#reledit #legal_idntfctn_no").val();
 
  
    var shareholdng =  website("#reledit #shareholdng").val();
     var adrsholdng =  website("#reledit #adrsholdng").val();
     var occupation =  website("#reledit #reloccupationup").val();
     var company =  website("#reledit #relcompanyup").val();


     var formdata = {releditid:releditid,relationship:relationship,name:name,pan:pan,aadhar:aadhar,dob:dob,sex:sex,address:address,eduqulfcn:eduqulfcn,file:file,legal_idntfr:legal_idntfr,legal_idntfctn_no:legal_idntfctn_no,shareholdng:shareholdng,adrsholdng:adrsholdng,reloccupationup:occupation,relcompanyup:company,depnature:depnature}

       website.ajax({

        url:'employeemodule/updaterelatives',
        
        method:'POST',
        data:formdata,
        // contentType:'json',
        contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
        dataType:"json",
        cache:false,
        //async:true, Cross domain checking
        beforeSend: function()
        {  website('.preloder_wraper').fadeIn(); },
        uploadProgress: function(event, position, total, percentComplete)
        {   },
        success: function(response, textStatus, jqXHR) 
       {
           website('#updateholdings3').modal('hide');
         if(response.logged === true)
         {
             website('#reledit').modal('hide');
             
              
              getrelationdata();

               new PNotify({title: 'Alert',
                    text: response.message,
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
                }); 
            
 
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
    {  website('.preloder_wraper').fadeOut();    },
    error: function() 
    {   }
   });
});



//#########################################UPDATE MY DETAILS#########################################
website('#upmydetails').ajaxForm({
dataType:"json",
    beforeSend: function() 
    {  },
    uploadProgress: function(event, position, total, percentComplete) 
    {   },
    success: function(response, textStatus, jqXHR) 
    {
         if(response.logged === true)
         {

               website('#mydataedit').modal('hide');
               getpersonalinfo();
               new PNotify({title: 'Alert',
                    text: response.message,
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
                }); 
            
 
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
    {  website('.preloder_wraper').fadeOut();  },
    error: function() 
    {   }


});




//######################################################################################################//
getpersonalinfo();
function getpersonalinfo(){
      website.ajax({
        url:'employeemodule/getmydetails',
       
        method:'POST',
        //contentType:'json',
        contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
        dataType:"json",
        cache:false,
        //async:true, Cross domain checking
        beforeSend: function()
        {   },
        uploadProgress: function(event, position, total, percentComplete)
        {   },
        success: function(response, textStatus, jqXHR)
        {     var myhtml='<tr>';
              if(response.logged==true){

                   
               
                obj = response.data;
                // console.log(obj);return false;
                var fname=obj['fname']?obj['fname']:'';
                var pan=obj['pan']?obj['pan']:'';

                var dob=obj['dob']?obj['dob']:'';
                var aadhar=obj['aadhar']?obj['aadhar']:'';
                var education=obj['education']?obj['education']:'';
                var institute=obj['institute']?obj['institute']:'';
                var filepath=obj['filepath']?obj['filepath']:'';
                var dpdate=obj['dpdate']?obj['dpdate']:'';
                var mobno=obj['mobileno']?obj['mobileno']:'';
                var id=response.data.id?response.data.id:'';
                myhtml+='<td>1</td>';
                myhtml+='<td>'+pan+'</td>';
                myhtml+='<td>'+aadhar+'</td>';
                myhtml+='<td>'+dpdate+'</td>';
                myhtml+='<td>'+dob+'</td>';
                myhtml+='<td>'+education+'</td>';
                myhtml+='<td>'+institute+'</td>';
                myhtml+='<td>'+mobno+'</td>';
                
                if(filepath)
                {
                     myhtml+='<td><a href="'+filepath+'" download>&nbsp;<i class="fa fa-download" id="uploadattached1" aria-hidden="true"></i></a></td>';
                }
                else
                {
                    myhtml+='<td></td>';
                }

                myhtml+='<td><i class="fa fa-eye faicon floatleft viewdetail" title="View entry" id="editdetail" personalid="'+response.data.id+'"></i></td>';
                if(response.data.send_status==1)
                {
                	 myhtml+='<td>---</td>';
                }
                else
                {
                    myhtml+='<td><i class="fa fa-thumbs-o-up sendfrapp" style="font-size:20px"></i></td>';
                }


                // myhtml+='<td><i class="fa fa-thumbs-o-up sendfrapp" style="font-size:20px"></i></td>';
                
                if(response.data.approved_status==1)
                {
                	   myhtml+='<td><p style="color:green;">Accepted</p></td>';
                }
                else if(response.data.approved_status==0  &&  response.data.approved_status!='')
                {
                	    myhtml+='<td><p style="color:red;">Rejected</p></td>';
                }
                else if(response.data.send_status==1 && response.data.approved_status=='')
                {
                     myhtml+='<td><p>Sent</p></td>';
                }
                else
                {
                   myhtml+='<td><p>--</p></td>';
                }
             
                if(response.data.send_status==1 && response.data.approved_status==1)
                {
                     myhtml+='<td>---</td>'; 
                }
                else
                {
                     myhtml+='<td><i class="fa fa-edit editcmp" editid="'+id+'"  style=""></i><i class="fa fa-trash del" delid="'+id+'"  style=""></i></td>'; 
                }
              
              
              }   
              else{
                myhtml+='<td colspan="9" style="text-align:center;">Data Not Found..!!</td>'
              }      
                myhtml+='</tr>';
                website('.perdetail').html(myhtml);  
                
        },
        complete: function(response)
        {   },
        error: function(jqXHR, textStatus, errorThrown)
        {   }
    });
 //Delete modal start here---------------------------------------------------------------------------------//
 

  website('body').on('click','.del',function(e){ 
     delid=website(this).attr('delid');
     website('#deleteid').val(delid);
     website('#delmod').modal('show');
 }); 


website('body').on('click','#delinfo',function(e){
var delid=website('#deleteid').val();
 // alert(delid);
  website.ajax({
        url:'employeemodule/delmydetails',
        data:{delid:delid},
        method:'POST',
        // contentType:'json',
        contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
        dataType:"json",
        cache:false,
        //async:true, Cross domain checking
        beforeSend: function()
        {   },
        uploadProgress: function(event, position, total, percentComplete)
        {   },
        success: function(response, textStatus, jqXHR)
        {     website('#delmod').modal('hide');
              if(response.logged==true)
              {
                getpersonalinfo(); 
                new PNotify({title: 'Alert',
                          text: response.message,
                          type: 'university',
                          hide: true,
                          styling: 'bootstrap3',
                          addclass: 'dark ',
                      });

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
        }
   });
});
//----------------------------------------------Delete Modal Finish here-----------------------------------//
  //----------------------------Ftch data for modal box---------------------------------------------------//
website('body').on('click','.editcmp',function(e)
{ 
        editid=website(this).attr('editid');
        website.ajax({
            url:'employeemodule/getmydetails',
            method:'POST',
            //contentType:'json',
            contentType:'application/x-www-form-urlencoded; charset=UTF-8',
            //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
            dataType:"json",
            cache:false,
            //async:true, Cross domain checking
            beforeSend: function()
            {   },
            uploadProgress: function(event, position, total, percentComplete)
            {   },
            success: function(response, textStatus, jqXHR)
            {     
                var myhtml='<tr>';
                if(response.logged==true)
                {
        //                    console.log(response.data.mobileno);
                    website('#mydataedit').modal('show');
                    var id=response.data.id?response.data.id:'';
                    var mobileno=response.data.mobileno?response.data.mobileno:'';
                    //var myarray = mobileno.split(",");
                    var upmyhtml='';
                    var clid='';
       //                    for(var n=0;n<myarray.length;n++)
       //                    {
       //                       clid="my_id"+n;
       //                       var mobile=myarray[n];
      //                       upmyhtml+="<ul class='upremovemob' id='"+clid+"' upmobno='"+mobile+"'><li>"+mobile+"<span class='close' >&times;</span></li></ul>";
     //                    }
                    var pan=obj['pan']?obj['pan']:'';
                    var dob=obj['dob']?obj['dob']:'';
                    var sex=obj['sex']?obj['sex']:'';
                    var aadhar=obj['aadhar']?obj['aadhar']:'';
                    var education=obj['education']?obj['education']:'';
                    var institute=obj['institute']?obj['institute']:'';
                    var address=obj['address']?obj['address']:'';
                    var filepath=obj['filepath']?obj['filepath']:'';
                    website('#mydataedit #upmobno').val(mobileno)
                    website('#mydataedit #pan').val(pan);
                    website('#mydataedit #aadhar').val(aadhar);
                    website('#mydataedit #dob').val(dob);
                    website('#mydataedit #address').val(address);
                    website('#mydataedit #eduqulfcn').val(education);
                    website('#mydataedit #institute').val(institute);
                    website('#mydataedit #reqid').val(id);
                    website('#mydataedit #upmobileappend').remove();
                    // console.log(upmyhtml);
                    // alert(upmyhtml);
                    website('#mydataedit #addmobileonmd').html(upmyhtml);
                    website('#mydataedit #filepath').val(filepath);
                    jQuery("input[value='"+sex+"']").attr('checked', true); 

                }   
                else
                {
                    new PNotify({title: 'Alert',
                    text: "Something Went To Wrong",
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
                    }); 
                } 
            },
            complete: function(response)
            {   },
            error: function(jqXHR, textStatus, errorThrown)
            {   }
        });

        });
    }
//###############################Relative Personal Details Start Here#####################################//

website('body').on('click','.addrelinfo',function(e){//on click addrelinfo one more form added 
    var myform=website(this).attr('formno');//get last form no
    // alert(myform);
    var newno=parseInt(myform)+1;//new form no
    
    //-------------------------------------------------Create Form--------------------------------------//
    myhtml='<form method="post" id="getdata_'+newno+'" class="chklength"  enctype="multipart/form-data"><div class="input-group col-md-12 col-xs-12 col-sm-12 remdiv_'+newno+'">'+
           '<div class="col-md-3">'+
            '<label>Full name</label>'+
            '<input  class="form-control " placeholder="full name" id="'+newno+'_fname"  name="'+newno+'_fname" type="text" />'+
          '</div>'+
          '<div class="col-md-3">'+
             '<label>Pan</label>'+
            '<input  class="form-control panval"  placeholder="pan" id="'+newno+'_pan" name="'+newno+'_pan" type="text" />'+
           '</div>'+
           '<div class="col-md-3">'+
            '<label>Aadhar</label>'+
             '<input  class="form-control aadhar"  placeholder="aadhar" id="'+newno+'_aadhar" name="'+newno+'_aadhar" type="text" />'+
           '</div>'+
           '<div class="col-md-3">'+
            '<label>Age</label>'+
              '<input  class="form-control " placeholder="age" id="'+newno+'_age" name="'+newno+'_age" type="text" />'+
            '</div>' +  
               '<div class="col-md-3">'+
                  '<label for="sex">Sex:</label>'+
                  '<input type="radio" id="'+newno+'_sex" name="'+newno+'_sex" value="Male" checked/>Male'+
                  '<input type="radio" id="'+newno+'_sex" name="'+newno+'_sex"  value="Female"/>Female '+
                '<div class="col -md-3">  </div>'+
            
                 '<lable>Date of birth</lable>'+
               '<input type="text" name="'+newno+'_dob" id="'+newno+'_dob" class="bootdatepick" placeholder="dob">'+
               '</div>'+ 
  
        '<div class="col-md-3">'+
              '<lable>Relationship</lable>'+
           '<input  class="form-control " placeholder="relationship" id="'+newno+'_relationship"  name="'+newno+'_relationship" type="text" />'+
         '</div>'+

       '<div class="col-md-3">'+
           '<label >Address</label>'+
           '<textarea class="form-control " placeholder="address" id="'+newno+'_addr"  name="'+newno+'_address" type="text"></textarea>'+
          
       '</div>'+   
       
        '</form>';
        var buttonhtml='<div class="valida"><span class="glyphicon glyphicon-plus addrelinfo" style="color:green;" formno="'+newno+'"></span><span class="glyphicon glyphicon-minus deleterelinfo" style="color:red;" formno="'+newno+'"></span></div>';
       //-------------------------remove button------------------------------------------------// 
        website('.addrelinfo').remove();
        website('.deleterelinfo').remove();
        //-------------------------remove button FInish------------------------------------------------//
        //-----------------append form--------------------//
        website('.appndnew').append(myhtml);
       //-----------------append form finish--------------------//
       //------------------append button------------------------//
        website('.appndnew').append(buttonhtml);
      //------------------append button------------------------//
      //---------call to datepicker function------------------//
        datepicker();
        aadharvalidation();
    //---------------------------//

 });

//###############################FINISH APPEND FORM FUNCTIONALLITY###################################
//###############################Start Delete Rel Info###################################
website('body').on('click','.deleterelinfo',function(e){//on click minus remove last form
var myform=website(this).attr('formno');//get last form no
 var newno=myform-1;//set new button no 
 if(newno>=1){//if form is greater then 1 then remove it
  website('.addrelinfo').remove();
  website('.deleterelinfo').remove();
 
  var buttonhtml='<span class="glyphicon glyphicon-plus addrelinfo" style="color:green;" formno="'+newno+'"></span><span class="glyphicon glyphicon-minus deleterelinfo" style="color:red;" formno="'+newno+'"></span>';
  website(".remdiv_"+myform).remove();
   website('.appndnew').append(buttonhtml);
 }
 //remove functionality finish here
 });
//###############################FINISH REL INFO DELETE###################################



//##################################FINISH FUNCTIONALLITY TO SAVE RELATION DATA#########################
getrelationdata();
function getrelationdata(){
website.ajax({
        url:'employeemodule/getrelativedata',
      
        method:'POST',
        //contentType:'json',
        contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
        dataType:"json",
        cache:false,
        //async:true, Cross domain checking
        beforeSend: function()
        {   },
        uploadProgress: function(event, position, total, percentComplete)
        {   },
        success: function(response, textStatus, jqXHR)
        {
             if(response.logged===true)
             { 
                var j=1;
                var myhtml='';
                 //console.log(response.data.length);return false;
                for(var i=0;i<response.data.length;i++)
                {
                    var education=response.data[i].education?response.data[i].education:'';
                    var sharehldng=response.data[i].sharehldng?response.data[i].sharehldng:'';
                    var adrshldng=response.data[i].adrshldng?response.data[i].adrshldng:'';
                   myhtml+='<tr>';
                   myhtml+='<td>'+j+'</td>';
                   myhtml+='<td>'+response.data[i].relationshipname+'</td>';
                   myhtml+='<td>'+response.data[i].name+'</td>';
                   myhtml+='<td>'+response.data[i].pan+'</td>';
                   myhtml+='<td>'+response.data[i].aadhar+'</td>';
//                   myhtml+='<td>'+response.data[i].age+'</td>';
                   myhtml+='<td>'+response.data[i].dob+'</td>';
                   myhtml+='<td>'+education+'</td>';
                   if(response.data[i].filepath)
                   {
                     myhtml+='<td><a href="'+response.data[i].filepath+'" download>&nbsp;<i class="fa fa-download" id="uploadattached1" aria-hidden="true"></i></a></td>';
                   }
                    else
                    {
                        myhtml+='<td></td>';
                    }
                    myhtml+='<td>'+sharehldng+'</td>';
                    myhtml+='<td>'+adrshldng+'</td>';
                   myhtml+='<td><i class="fa fa-edit editrel" releditid="'+response.data[i].id+'" style=""></i><i class="fa fa-trash delrel"  reldelid="'+response.data[i].id+'" style=""></i></td>';
                   myhtml+='</tr>';
                   j++;

                }        
             }
             else
             {
                    myhtml+='<tr>';
                    myhtml+='<td colspan="11" style="text-align:center;">Data Not Found..!!</td>';
                    myhtml+='</tr>';
         
             }
             
              website('.reldetails').html(myhtml);
         },
   });  
}

//-----------------------DELETE RELATION INFO---------------------------------------------------//
website('body').on('click','.delrel',function(e){//on click submit button get data
  var delid= website(this).attr('reldelid');
  website('#delrel').val(delid);
 website('#delrelation').modal('show');
});

website('body').on('click','#deleterel',function(e){
  delid=website('#delrel').val();
  website.ajax({
        url:'employeemodule/reldelinfo',
        data:{delid:delid},
        method:'POST',
        //contentType:'json',
        contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
        dataType:"json",
        cache:false,
        //async:true, Cross domain checking
        beforeSend: function()
        {   },
        uploadProgress: function(event, position, total, percentComplete)
        {   },
        success: function(response, textStatus, jqXHR)
        {
           if(response.logged==true){
               new PNotify({title: 'Alert',
                    text: response.message,
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
                });
               getrelationdata();
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
       {  website('#delrelation').modal('hide');  },
        error: function(jqXHR, textStatus, errorThrown)
        {   }

});
});
//###############################################EDIT RELATIONSHIP START HERE################################//
website('body').on('click','.editrel',function()
{
    var releditid  = website(this).attr('releditid');
    //console.log(tempid); return false;

    
    // website('#reledit').modal('show');
   website.ajax({
        url:'employeemodule/singlerelative',
        data:{releditid:releditid},
        method:'POST',
        //contentType:'json',
        contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
        dataType:"json",
        cache:false,
        //async:true, Cross domain checking
        beforeSend: function()
        {   },
        uploadProgress: function(event, position, total, percentComplete)
        {   },
        success: function(response, textStatus, jqXHR)
        {
           if(response.logged==true)
           {
               var name=response.data.name?response.data.name:""; 
               var pan=response.data.pan?response.data.pan:"";
               var aadhar=response.data.aadhar?response.data.aadhar:"";
               var dob=response.data.dob?response.data.dob:"";
               var sex=response.data.sex?response.data.sex:"";
               var relationship=response.data.relationship?response.data.relationship:"";
               var education=response.data.education?response.data.education:'';
               var id=response.data.id?response.data.id:"";
               var relationship=response.data.relationship?response.data.relationship:"";        
               var address=response.data.address?response.data.address:"";
               var sharehldng=response.data.sharehldng?response.data.sharehldng:"";
               var adrshldng=response.data.adrshldng?response.data.adrshldng:"";
               var legal_idntfr=response.data.legal_identifier?response.data.legal_identifier:"";
               var legal_idntfctn_no=response.data.legal_identification_no?response.data.legal_identification_no:"";
               var dependantnature=response.data.dependency_nature?response.data.dependency_nature:"";
               var occupation=response.data.occupation?response.data.occupation:"";
               var company=response.data.company?response.data.company:"";
               var filepath=response.data.filepath
               jQuery("#reledit input[value='"+sex+"']").attr('checked', true);
                website('#reledit #name').val(name);
                website('#reledit #releditid').val(id);
                website('#reledit #relationship').val(relationship);
                website('#reledit #pan').val(pan);
                website('#reledit #aadhar').val(aadhar);
//                website('#reledit #age').val(age);
                website('#reledit #dob').val(dob);
                website('#reledit #relationship').val(relationship);
                website('#reledit #address').val(address);
                website('#reledit #eduqulfcn').val(education);
                website('#reledit #filepath').val(filepath);
                website('#reledit #shareholdng').val(sharehldng);
                website('#reledit #adrsholdng').val(adrshldng);
                website('#reledit #legal_idntfr').val(legal_idntfr);
                website('#reledit #legal_idntfctn_no').val(legal_idntfctn_no);
                website('#reledit #reloccupationup').val(occupation);
                website('#reledit #relcompanyup').val(company);
               dependantnature = dependantnature.split(",");
               website.each(dependantnature, function( key, value ) {
                   website('#reledit #depnature option[value="' + value + '"]').attr('selected','selected');
                 
               });
                website('#reledit').modal('show');
           }  
           else{
           
           }
        },  
        complete: function(response)
       {    },
        error: function(jqXHR, textStatus, errorThrown)
        {   }
   });
});


//--------------------------AAdhar validation Start Here--------------------------
 aadharvalidation();
 function aadharvalidation(){
 website(".aadhar").on("keyup", function() {
  var aadharno=parseInt(website(this).val());
  len=aadharno.toString().length;
  // console.log(len);
  if(aadharno!='' && len>=12)
  {
        website.ajax({
        url:'employeemodule/aadharvalidation',
        data:{aadharno:aadharno},
        method:'POST',
        //contentType:'json',
        contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
        dataType:"json",
        cache:false,
        //async:true, Cross domain checking
        beforeSend: function()
        {   },
        uploadProgress: function(event, position, total, percentComplete)
        {   },
        success: function(response, textStatus, jqXHR)
        {
          if(response.logged==true){
              document.getElementById("relsub").disabled = true;
              website(".valida").css("display", "none");
              
              new PNotify({title: 'Alert',
                    text:"Aadhar No Already Exist You Can Not Insert Data",
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
                });
          }
        }
      });
  }
  else
  {
    document.getElementById("relsub").disabled = false;
    website(".valida").css("display", "block");
    
  }
    });      
}
//###############pan validation#######################################

panvalidation();
function panvalidation()
{

 website(".panval").on("keyup", function() {
 var panno=website(this).val();
 len=panno.toString().length;
 if(len>=5 && panno!='')
 {
    website.ajax({
            url:'employeemodule/panvalidation',
            data:{panno:panno},
            method:'POST',
            //contentType:'json',
            contentType:'application/x-www-form-urlencoded; charset=UTF-8',
            //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
            dataType:"json",
            cache:false,
            //async:true, Cross domain checking
            beforeSend: function()
            {   },
            uploadProgress: function(event, position, total, percentComplete)
            {   },
            success: function(response, textStatus, jqXHR)
            {
                  if(response.logged==true)
                  {
                       document.getElementById("relsub").disabled = true;
                       website(".valida").css("display", "none");
                  
                          new PNotify({title: 'Alert',
                                text:"Pan No Already Exist You Can Not Insert Data",
                                type: 'university',
                                hide: true,
                                styling: 'bootstrap3',
                                addclass: 'dark ',
                            });
                  }
                 
             }
    });
  }
   else
    {
       document.getElementById("relsub").disabled = false;
       website(".valida").css("display", "block");
   }  
 });
}




website('body').on('click','.viewdetail', function()
{
    var id = website(this).attr('personalid');
    var baseHref = getbaseurl(); 
    // window.location.href=baseHref+'employeemodule/viewpastemployer?personid='+id; 

     window.location.href=baseHref+'employeemodule/viewpastemployer';
});


website('#upmfrmod').click(function(e) {
  var mfreditid= website('#mfreditid').val();
  var mfrname = website('#mfrnameup').val();
  var panup = website('#adharpanup').val();
  var addressup = website('#materialaddressup').val();
  var mfrrelation= website('#mfrrelationup').val();
   var transaction= website('#mfrtransactionup').val();
  var clientid= website('#mfrclientidup').val();
  website.ajax({
        url:'employeemodule/updatemfr',
        data:{mfrname:mfrname,mfrrelation:mfrrelation,mfreditid:mfreditid,panup:panup,addressup:addressup,transaction:transaction,clientid:clientid},
        method:'POST',
        //contentType:'json',
        contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
        dataType:"json",
        cache:false,
        //async:true, Cross domain checking
        beforeSend: function()
        {   },
        uploadProgress: function(event, position, total, percentComplete)
        {   },
        success: function(response, textStatus, jqXHR)
        {
            if(response.logged === true)
          {
              getmfrdata();
              website('#mfrdelmodaledit').modal('hide');
              window.location.reload();
               new PNotify({title: 'Alert',
                    text: response.message,
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
                }); 
            
 
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
        }
      });
});


website('#savemfr').click(function(e) {
  var mfrname = website('#mfrname').val();
  var mfrrelation= website('#mfrrelation').val();
  var pan= website('#adharpan').val();
  var address= website('#materialaddress').val();
  var transaction= website('#mfrtransaction').val();
  var clientid= website('#mfrclientid').val();
 website.ajax({
        url:'employeemodule/savemfr',
        data:{mfrname:mfrname,mfrrelation:mfrrelation,pan:pan,address:address,transaction:transaction,clientid:clientid},
        method:'POST',
        //contentType:'json',
        contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
        dataType:"json",
        cache:false,
        //async:true, Cross domain checking
        beforeSend: function()
        {   },
        uploadProgress: function(event, position, total, percentComplete)
        {   },
        success: function(response, textStatus, jqXHR)
        {
            if(response.logged === true)
          {
              getmfrdata();
              window.location.reload();
               new PNotify({title: 'Alert',
                    text: response.message,
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
                }); 
            
 
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
        }
      });
});

getmfrdata();
function getmfrdata(){
website.ajax({
        url:'employeemodule/getmfrdata',
      
        method:'POST',
        //contentType:'json',
        contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
        dataType:"json",
        cache:false,
        //async:true, Cross domain checking
        beforeSend: function()
        {   },
        uploadProgress: function(event, position, total, percentComplete)
        {   },
        success: function(response, textStatus, jqXHR)
        {
             if(response.logged===true)
             { 
                var j=1;
                var myhtml='';
                for(var i=0;i<response.data.length;i++)
                {
            
                   myhtml+='<tr>';
                   myhtml+='<td>'+j+'</td>';
                   myhtml+='<td>'+response.data[i].related_party+'</td>';
                   myhtml+='<td>'+response.data[i].pan+'</td>';
                   myhtml+='<td>'+response.data[i].relationship+'</td>';
                   myhtml+='<td>'+response.data[i].address+'</td>';
                   myhtml+='<td><i class="fa fa-edit mymfredit"  mfredit="'+response.data[i].id+'" style="font-size:20px;"></i><i class="fa fa-trash delmfr"  mfrdel="'+response.data[i].id+'" style="font-size:20px;"></i></td>';
                   myhtml+='</tr>';
                   j++;
                  

                }        
             }
             else
             {

                    myhtml+='<tr>';
                    myhtml+='<td colspan="6" style="text-align:center;">Data Not Found..!!</td>';
                    myhtml+='</tr>';
         
             }
             
              website('.mfrtable').html(myhtml);
         },
   });  
}

website('body').on('click','.delmfr',function(e){//on click submit button get data
  var delid= website(this).attr('mfrdel');
  website('#mfrdelid').val(delid);
 website('#mfrdelmodal').modal('show');
});

website('body').on('click','.mymfredit',function(e){//on click submit button get data
  var editid= website(this).attr('mfredit');
  website.ajax({
        url:'employeemodule/fetchmfrdataedit',
        data:{editid:editid},
        method:'POST',
        //contentType:'json',
        contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
        dataType:"json",
        cache:false,
        //async:true, Cross domain checking
        beforeSend: function()
        {   },
        uploadProgress: function(event, position, total, percentComplete)
        {   },
        success: function(response, textStatus, jqXHR)
        {
           if(response.logged==true)
           {
              var mfrnameu = response.data[0].related_party;
              var mfrrel = response.data[0].relationship;
              var mrfpan = response.data[0].pan;
              var mrfaddress = response.data[0].address;
              var transaction = response.data[0].transaction;
              var clientid = response.data[0].clientid;
              website('#mfrnameup').val(mfrnameu);
              website('#mfrrelationup').val(mfrrel);
              website('#adharpanup').val(mrfpan);
              website('#materialaddressup').val(mrfaddress);
              website('#mfrtransactionup').val(transaction);
              website('#mfrclientidup').val(clientid);
              website('#mfreditid').val(editid);
              website('#mfrdelmodaledit').modal('show');
              
           }  
           else
           {
               
           }
        },  
        complete: function(response)
       {   },
        error: function(jqXHR, textStatus, errorThrown)
        {   }

}); 
});

website('body').on('click','#delbtnmfr',function(e){
  delid=website('#mfrdelid').val();
  website.ajax({
        url:'employeemodule/deletemfr',
        data:{delid:delid},
        method:'POST',
        //contentType:'json',
        contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
        dataType:"json",
        cache:false,
        //async:true, Cross domain checking
        beforeSend: function()
        {   },
        uploadProgress: function(event, position, total, percentComplete)
        {   },
        success: function(response, textStatus, jqXHR)
        {
           if(response.logged==true){
               new PNotify({title: 'Alert',
                    text: response.message,
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
                });
               getmfrdata();
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
       {  website('#mfrdelmodal').modal('hide');  },
        error: function(jqXHR, textStatus, errorThrown)
        {   }

});
});

website('body').on('click','#trdeintimatn', function()
{
    website('#tradeintimationmodel').modal('show');
});

/************** for search **********/

var timer = 0;
function mySearch (){ 
    var getvalue = website('.header-search-input').val();
    doSearch(getvalue); 
}

website('.header-search-input').on('keyup', function(e){
    var getkeycode = website.trim(e.keyCode);
     if (getkeycode != '40' && getkeycode !='38' && getkeycode != '13'){
        if (timer) {
            clearTimeout(timer);
        }
        timer = setTimeout(mySearch, 400); 
     }
});

var timer = 0;
function mySearchforedit (){ 
    var getvalue = website('#Mymodaledit .header-search-input').val();
    doSearchforedit(getvalue); 
}

website('#Mymodaledit .header-search-input').on('keyup', function(e){
    var getkeycode = website.trim(e.keyCode);
     if (getkeycode != '40' && getkeycode !='38' && getkeycode != '13'){
        if (timer) {
            clearTimeout(timer);
        }
        timer = setTimeout(mySearchforedit, 400); 
     }
});

website( "#live-search-header-wrapper" ).scroll(function() {
  //console.log('got it');
});

website( "#Mymodaledit #live-search-header-wrapper" ).scroll(function() {
  //console.log('got it');
});

function myCustomFn(el){
   // console.log('coming here');
}

website("#live-search-header-wrapper").mCustomScrollbar({
        scrollButtons:{enable:true,scrollType:"stepped"},
        keyboard:{scrollType:"stepped"},
        mouseWheel:{scrollAmount:188},
        theme:"rounded-dark",
        autoExpandScrollbar:true,
        snapAmount:188,
        snapOffset:65,
        callbacks:{
            onScroll:function(){
                myCustomFn(this);
            }
        }
}); 

website("#Mymodaledit #live-search-header-wrapper").mCustomScrollbar({
        scrollButtons:{enable:true,scrollType:"stepped"},
        keyboard:{scrollType:"stepped"},
        mouseWheel:{scrollAmount:188},
        theme:"rounded-dark",
        autoExpandScrollbar:true,
        snapAmount:188,
        snapOffset:65,
        callbacks:{
            onScroll:function(){
                //myCustomFn(this);
            }
        }
}); 

function doSearch(getvalue)
{
  var getkeyword = getvalue;
  if(website.trim(getkeyword)=="")
  {
    website('#live-search-header-wrapper ul').html('<li class="noresultfound">No Result Fould!!!!</li>');
  }
  else
  {
  var formdata = {searchvallist:getkeyword,geturl:''}
    website.ajax({
      url:'restrictedcompany/cmplists',
      //url:'template/templatedetails',   
      data:formdata,
      method:'POST',
      //contentType:'json',
      contentType:'application/x-www-form-urlencoded; charset=UTF-8',
      //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
      dataType:"json",
      cache:false,
      //async:true, /*Cross domain checking*/
      beforeSend: function() 
      {
                website('#live-search-header-wrapper').fadeIn();
        website('#live-search-header-wrapper ul').html("<li>Please wait...</li>");
                website('.mainprogressbarforall .progress').fadeIn();
                website('.filtr-container').html("");
                website('.filtr-container').removeAttr("style");
                website('.filtr-search').fadeIn();
                website('.filtr-search').val("");
      },
      uploadProgress: function(event, position, total, percentComplete) 
      {
                website('#live-search-header-wrapper').fadeIn();
        website('#live-search-header-wrapper ul').html("<li>Please wait...</li>");
                website('.mainprogressbarforall .progress').fadeIn();
                website(".mainprogressbarforall .progress .progress-bar").width(percentComplete+'%');
                
      },
      success: function(response, textStatus, jqXHR) 
      {
        var addhtml='';
        website('#live-search-header-wrapper ul').html("");  
        website('#live-search-header-wrapper').fadeIn();
                
        if (response.logged == true && response.data.length>=1) 
                {         
          //console.log(response.data);return false;
          for(var i = 0; i < response.data.length; i++) 
                    {   
            if(i==0)
            {                           
              addhtml += '<li id="'+response.data[i].id+'" company_name="'+response.data[i].company_name+'" class="topul validatorsid">'+response.data[i].company_name;
              //addhtml += '<a target="_blank" href="profile/willline/'+response.data[i].cid+'" class="floatleft searchavtarname">'+response.data[i].comanyname+'</a>';
              addhtml += '<div class="clearelement"></div></li>';
            }
            else if(i==((response.data.length)-1))
            {
              addhtml += '<li id="'+response.data[i].id+'" company_name="'+response.data[i].company_name+'"  class="bottomul validatorsid">'+response.data[i].company_name;
              //addhtml += '<a target="_blank" href="profile/willline/'+response.data[i].cid+'" class="floatleft searchavtarname">'+response.data[i].comanyname+'</a>';
              addhtml += '<div class="clearelement"></div></li>';
              
            }
            else
            {
              addhtml += '<li id="'+response.data[i].id+'" company_name="'+response.data[i].company_name+'"  class="bottomul validatorsid">'+response.data[i].company_name;
              //addhtml += '<a target="_blank" href="profile/willline/'+response.data[i].cid+'" class="floatleft searchavtarname">'+response.data[i].comanyname+'</a>';
              addhtml += '<div class="clearelement"></div></li>';
            }
          }
          website('#live-search-header-wrapper ul').html(addhtml);
          //window.location.reload();
        }
        else
        {
          website('#live-search-header-wrapper ul').html('<li class="noresultfound"><span class="resp_new">'+response.message+'</span></li>');
        }
        website(".mainprogressbarforall .progress .progress-bar").width('100%');
      },
      complete: function(response) 
      {
                website('.search-row').fadeIn();
                website(".mainprogressbarforall .progress .progress-bar").fadeOut();
      },
      error: function(jqXHR, textStatus, errorThrown)
      {
        //website('#live-search-header-wrapper ul').fadeOut();      
      }
    }); 
  }
  
}

function doSearchforedit(getvalue)
{  
  var getkeyword = getvalue;
  if(website.trim(getkeyword)=="")
  {
    website('#Mymodaledit #live-search-header-wrapper ul').html('<li class="noresultfound">No Result Fould!!!!</li>');
  }
  else
  {
  var formdata = {searchvallist:getkeyword,geturl:''}
    website.ajax({
      url:'restrictedcompany/cmplists',
      //url:'template/templatedetails',   
      data:formdata,
      method:'POST',
      //contentType:'json',
      contentType:'application/x-www-form-urlencoded; charset=UTF-8',
      //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
      dataType:"json",
      cache:false,
      //async:true, /*Cross domain checking*/
      beforeSend: function() 
      {
                website('#Mymodaledit #live-search-header-wrapper').fadeIn();
        website('#Mymodaledit #live-search-header-wrapper ul').html("<li>Please wait...</li>");
                website('#Mymodaledit .mainprogressbarforall .progress').fadeIn();
                website('#Mymodaledit .filtr-container').html("");
                website('#Mymodaledit .filtr-container').removeAttr("style");
                website('#Mymodaledit .filtr-search').fadeIn();
                website('#Mymodaledit .filtr-search').val("");
      },
      uploadProgress: function(event, position, total, percentComplete) 
      {
                website('#Mymodaledit #live-search-header-wrapper').fadeIn();
        website('#Mymodaledit #live-search-header-wrapper ul').html("<li>Please wait...</li>");
                website('#Mymodaledit .mainprogressbarforall .progress').fadeIn();
                website("#Mymodaledit .mainprogressbarforall .progress .progress-bar").width(percentComplete+'%');
                
      },
      success: function(response, textStatus, jqXHR) 
      {
        var addhtml='';
        website('#Mymodaledit #live-search-header-wrapper ul').html("");  
        website('#Mymodaledit #live-search-header-wrapper').fadeIn();
                
        if (response.logged == true && response.data.length>=1) 
        {         
          //console.log(response.data);return false;
          for(var i = 0; i < response.data.length; i++) 
                    {   
            if(i==0)
            {                           
              addhtml += '<li id="'+response.data[i].id+'" company_name="'+response.data[i].company_name+'" class="topul validatorsid">'+response.data[i].company_name;
              //addhtml += '<a target="_blank" href="profile/willline/'+response.data[i].cid+'" class="floatleft searchavtarname">'+response.data[i].comanyname+'</a>';
              addhtml += '<div class="clearelement"></div></li>';
            }
            else if(i==((response.data.length)-1))
            {
              addhtml += '<li id="'+response.data[i].id+'" company_name="'+response.data[i].company_name+'"  class="bottomul validatorsid">'+response.data[i].company_name;
              //addhtml += '<a target="_blank" href="profile/willline/'+response.data[i].cid+'" class="floatleft searchavtarname">'+response.data[i].comanyname+'</a>';
              addhtml += '<div class="clearelement"></div></li>';
              
            }
            else
            {
              addhtml += '<li id="'+response.data[i].id+'" company_name="'+response.data[i].company_name+'"  class="bottomul validatorsid">'+response.data[i].company_name;
              //addhtml += '<a target="_blank" href="profile/willline/'+response.data[i].cid+'" class="floatleft searchavtarname">'+response.data[i].comanyname+'</a>';
              addhtml += '<div class="clearelement"></div></li>';
            }
          }
          website('#live-search-header-wrapper ul').html(addhtml);
          //window.location.reload();
        }
        else
        {
          website('#Mymodaledit #live-search-header-wrapper ul').html('<li class="noresultfound"><span class="resp_new">'+response.message+'</span></li>');
        }
        website("#Mymodaledit .mainprogressbarforall .progress .progress-bar").width('100%');
      },
      complete: function(response) 
      {
                website('#Mymodaledit .search-row').fadeIn();
                website("#Mymodaledit .mainprogressbarforall .progress .progress-bar").fadeOut();
      },
      error: function(jqXHR, textStatus, errorThrown)
      {
        //website('#live-search-header-wrapper ul').fadeOut();      
      }
    }); 
  }
  
}
/* ------- operation on companydatali li start ------- */ 

    website('body').on('click','.validatorsid',function(e){
   
       var compid = website(this).attr('id');
       var compname = website(this).attr('company_name');
        
       website('#tradeintimationmodel #search-box').val(compname);
       website('#search-box').attr('compid',compid);
       website('#search-box').attr('compname',compname);
       website('#tradeintimationmodel #compid').val(compid);
       website('#live-search-header-wrapper').fadeOut();       
       
       website('#tradeintimationmodel #validators').val(compname);
       website('#validators').attr('compid',compid);
       website('#validators').attr('compnyname',compname);
    });


    website('body').on('click','#Mymodaledit .validatorsid',function(e){
   
       var compid = website(this).attr('id');
       var compname = website(this).attr('company_name');
       //alert(fullname);
       website('#updatetrdintimtn #search-box').val(compname);
       website('#Mymodaledit #search-box').attr('compid',compid);
       website('#Mymodaledit #search-box').attr('compname',compname);

       website('#Mymodaledit #live-search-header-wrapper').fadeOut();       
       
       website('#updatetrdintimtn #validators').val(compname);
       website('#updatetrdintimtn #compid').val(compid);
       website('#Mymodaledit #validators').attr('compid',compid);
       website('#Mymodaledit #validators').attr('compnyname',compname);
    });

    website(function() {
            //Initialize filterizr with default options
            //website('.filtr-container').filterizr();
    });


website('#trnstype').on('change',function(){
   var value = website(this).val();
    if(value == 5)
    {
        website('#dateoftrans').hide();
    }
    else
    {
         website('#dateoftrans').show();
    }
});

 website('#inserttrdintimtn').ajaxForm({
      dataType:"json",
      beforeSend: function()
      { website('.preloder_wraper').fadeIn();},
      uploadProgress: function(event, position, total, percentComplete)
      {  website('.preloder_wraper').fadeIn(); },
      success: function(response, textStatus, jqXHR)
      {
        if(response.logged===true)
        {  
          new PNotify({title: 'Record Added Successfully',
            text: response.message,
            type: 'university',
            hide: true,
            styling: 'bootstrap3',
            addclass: 'dark ',
          });
            
          //window.location.reload();
           fetchtradeeintimtn();
            
        }else{
          new PNotify({title: 'Record Not Added',
            text: response.message,
            type: 'university',
            hide: true,
            styling: 'bootstrap3',
            addclass: 'dark ',
          });
        }
      },
      complete: function(response)
      {  website('#tradeintimationmodel').modal('hide');
         website('.preloder_wraper').fadeOut();

       },
      error: function(jqXHR, textStatus, errorThrown)
      {   }
  //});
});

website('#updatetrdintimtn').ajaxForm({
      dataType:"json",
      beforeSend: function()
      { website('.preloder_wraper').fadeIn();},
      uploadProgress: function(event, position, total, percentComplete)
      {  website('.preloder_wraper').fadeIn(); },
      success: function(response, textStatus, jqXHR)
      {
        if(response.logged===true)
        {  
          new PNotify({title: 'Record Updates Successfully',
            text: response.message,
            type: 'university',
            hide: true,
            styling: 'bootstrap3',
            addclass: 'dark ',
          });
            
          //window.location.reload();
           fetchtradeeintimtn();
            
        }else{
          new PNotify({title: 'Record Not Updates',
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
         website('#tradeintimationmodel').modal('hide');
         website('.preloder_wraper').fadeOut();

       },
      error: function(jqXHR, textStatus, errorThrown)
      {   }
  //});
});

fetchtradeeintimtn();
function fetchtradeeintimtn()
{
    website.ajax({
        url:'employeemodule/fetchtradeeintimtn',
        method:'POST',
        //contentType:'json',
        contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
        dataType:"json",
        cache:false,
        //async:true, Cross domain checking
        beforeSend: function()
        {   },
        uploadProgress: function(event, position, total, percentComplete)
        {   },
        success: function(response, textStatus, jqXHR)
        {
            if(response.logged===true)
            { 
                var j=1;
                var myhtml='';
                for(var i=0;i<response.data.length;i++)
                {
                    var transctndate = response.data[i].transaction_date?response.data[i].transaction_date:''; 
                    myhtml+='<tr>';
                    myhtml+='<td>'+j+'</td>';
                    myhtml+='<td>'+response.data[i].related_party+'</td>';
                    myhtml+='<td>'+response.data[i].security_type+'</td>';
                    myhtml+='<td>'+response.data[i].company_name+'</td>';
                    myhtml+='<td>'+response.data[i].noofshares+'</td>';
                    myhtml+='<td>'+transctndate+'</td>';
                    myhtml+='<td>'+response.data[i].transaction+'</td>';
                    myhtml+='<td><i class="fa fa-edit trdintmtnedit"  mfredit="'+response.data[i].id+'" style="font-size:20px;"></i><i class="fa fa-trash deltrdintmtn"  trdintmtndel="'+response.data[i].id+'" style="font-size:20px;"></i></td>';
                    myhtml+='</tr>';
                    j++;

                }        
            }
            else
            {
                myhtml+='<tr>';
                myhtml+='<td colspan="8" style="text-align:center;">Data Not Found..!!</td>';
                myhtml+='</tr>';
            }
            website('.trdeintimatndetail').html(myhtml);
        },
        complete: function(response)
        {   },
        error: function(jqXHR, textStatus, errorThrown)
        {   }
    }); 
}

website('body').on('click','.trdintmtnedit',function()
{
    var editid = website(this).attr('mfredit');
    website.ajax({
        url:'employeemodule/fetchtradeeintimtnedit',
        data:{editid:editid},
        method:'POST',
        //contentType:'json',
        contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
        dataType:"json",
        cache:false,
        //async:true, Cross domain checking
        beforeSend: function()
        {   },
        uploadProgress: function(event, position, total, percentComplete)
        {   },
        success: function(response, textStatus, jqXHR)
        {
           if(response.logged==true)
           {
              website('#Mymodaledit #validators').val(response.data[0].company_name);
              website('#Mymodaledit #reltedprty').val(response.data[0].related_party);
              website('#Mymodaledit #secutype').val(response.data[0].security_type);
              website('#Mymodaledit #trnstype').val(response.data[0].transctn_type);
              website('#Mymodaledit #shres').val(response.data[0].noofshares);
              
              if(response.data[0].transctn_type == 5)
              {
                  website('#Mymodaledit #dateoftrans').hide();
                  
              }
              else
              {
                  website('#Mymodaledit #transdate').val(response.data[0].transaction_date);
              }
              
              website('#Mymodaledit #trdeditid').val(editid);
              website('#Mymodaledit #compid').val(response.data[0].cmp_id);
              website('#Mymodaledit').modal('show');
           }  
           else
           {
               
           }
        },  
        complete: function(response)
       {  website('#mfrdelmodal').modal('hide');  },
        error: function(jqXHR, textStatus, errorThrown)
        {   }

});
})

website('body').on('click','.deltrdintmtn', function(){
    var id = website(this).attr('trdintmtndel');
    //console.log(id);return false;
    website('#myModalyesno').modal('show');
    website('#myModalyesno .yesconfirm').attr('trdintmtndel',id);
});

website('body').on('click','.yesconfirm', function(){
    
    var id = website(this).attr('trdintmtndel');
//    console.log(id);return false;
    var formdata = {id:id};
    website.ajax({
      url:'employeemodule/trdintimtndelete',
      data:formdata,
      method:'POST',
      //contentType:'json',
      contentType:'application/x-www-form-urlencoded; charset=UTF-8',
      //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
      dataType:"json",
      cache:false,
      //async:true, /*Cross domain checking*/
      beforeSend: function()
      {   },
      uploadProgress: function(event, position, total, percentComplete)
      {   },
        success: function(response, textStatus, jqXHR) 
        {
           if(response.logged === true)
           {
              //fetchmasterlist();
              fetchtradeeintimtn();
              new PNotify({title: 'Record Deleted Successfully',
                  text: 'Record Deleted Successfully',
                  type: 'university',
                  hide: true,
                  styling: 'bootstrap3',
                  addclass: 'dark ',
              }); 
           }
           else
           {    
              new PNotify({title: 'Record Not Deleted',
                  text: 'Record Not Updated',
                  type: 'university',
                  hide: true,
                  styling: 'bootstrap3',
                  addclass: 'dark ',
              });
           }
        },
        complete: function(response) 
        {
            website('#myModalyesno').modal('hide');
            website('#myModalyesno .mainprogressbarforall').fadeOut(); 
        },
        error: function() 
        {   }
    });
});

 website('#updatetrdintimtn').ajaxForm({
      dataType:"json",
      beforeSend: function()
      { website('.preloder_wraper').fadeIn();},
      uploadProgress: function(event, position, total, percentComplete)
      {  website('.preloder_wraper').fadeIn(); },
      success: function(response, textStatus, jqXHR)
      {
        if(response.logged===true)
        {  
          new PNotify({title: 'Record Updated Successfully',
            text: response.message,
            type: 'university',
            hide: true,
            styling: 'bootstrap3',
            addclass: 'dark ',
          });
            
          //window.location.reload();
           fetchtradeeintimtn();
            
        }else{
          new PNotify({title: 'Record Not Updated',
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

          website('#Mymodaledit').modal('hide');
          website('.preloder_wraper').fadeOut();


       },
      error: function(jqXHR, textStatus, errorThrown)
      {   }
  //});
});

website('#Mymodaledit #trnstype').on('change',function(){
   var value = website(this).val();
    if(value == 5)
    {
        website('#Mymodaledit #dateoftrans').hide();
    }
    else
    {
         website('#Mymodaledit #dateoftrans').show();
    }
});


website('#insertpastemp').ajaxForm({
      //method:'POST',
      //contentType:'json',
      //contentType:'application/x-www-form-urlencoded; charset=UTF-8',
      //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
      dataType:"json",
      beforeSend: function()
      { website('.preloder_wraper').fadeIn();},
      uploadProgress: function(event, position, total, percentComplete)
      {  website('.preloder_wraper').fadeIn(); },
      success: function(response, textStatus, jqXHR)
      {
        if(response.logged===true)
        {  
          new PNotify({title: 'Record Added Successfully',
            text: response.message,
            type: 'university',
            hide: true,
            styling: 'bootstrap3',
            addclass: 'dark ',
          });
             getdataonload();
         window.location.reload();
           
          //window.location.reload();
           
            
        }else{
          new PNotify({title: 'Record Not Added',
            text: response.message,
            type: 'university',
            hide: true,
            styling: 'bootstrap3',
            addclass: 'dark ',
          });
        }
      },
      complete: function(response)
      {  website('.preloder_wraper').fadeOut(); },
      error: function(jqXHR, textStatus, errorThrown)
      {   }
  //});
});

website('body').on('click','.add_button',function(e)
{
var getno=website('#pastemp').val();
// alert(getno);
if(getno<=5)
{
  website("#pstbtn").css("display", "block");
  var htmlele='<div class="box_css">';
  for(var i=0;i<getno;i++)
  {
     htmlele+=  '<section class="col col-md-6 col-xs-6">'+
                            '<div class="input">'+
                                '<label class="control-label">Name of employer*</label>'+
                                '<input type="text" id="empname_'+i+'" name="empname" class="form_fields form-control col-md-7 col-xs-12 empnm" required>'+
                            '</div>'+
                        '</section>'+
                        
                         '<section class="col col-md-6 col-xs-6">'+
                            '<div class="input">'+
                                '<label class="control-label">Designation Served*</label>'+
                                '<input type="text" id="designtn_'+i+'" name="designtn" class="form_fields form-control col-md-7 col-xs-12 desig" required>'+
                            '</div>'+
                       '</section>'+
                    
                        
                    '<section class="col col-md-6 col-xs-6">'+
                    '<div class="input">'+
                        '<label class="control-label">Start Date of Employment*</label>'+ 
                        '<input type="text" name="strtdte" id="strtdte_'+i+'" class="form-control bootdatepick sde" required readonly>'+
                    '</div>'+
                    '</section>'+
                        
                    '<section class="col col-md-6 col-xs-6">'+
                    '<div class="input">'+
                    '<label class="control-label">End Date of employent*</label>'+  
                        '<input type="text" name="enddte" id="enddte_'+i+'" class="form-control bootdatepick ede" required readonly>'+
                    '</div>'+
                    '</section>';



                  
                    
                      
  }


  htmlele+=  '<section class="col col-md-12 col-xs-12 company_asses" id="pstbtn">'
  htmlele+= '<input type="button" value="Submit" class="btn btn-primary contractexcelbtn" id="pastbtnsub">'+
                    '</section></div>';

  website('#addnoofforms').html(htmlele);
  datepicker();
}
else
{
new PNotify({title: 'Please Enter value Less Than Five',
            text:'Please Enter value Less Than Five',
            type: 'university',
            hide: true,
            styling: 'bootstrap3',
            addclass: 'dark ',
          });
     }
});


//################################################STORE DATA OF PAST EMPLOYE######################################//

// var approveid=website('#approveid').val();//check appended user id on modal box
//   var arr=approveid.split(",");//str to array conversion
//    var len=website(".closeedit").length;
//   var idd = website(this).attr('edituserid');//get id of closed user
//   website('#edit_'+idd).remove();//remove user from modal

//        var  position = arr.indexOf(idd);//position in array 
//        arr.splice(position, 1);//remove value from array
//        var str=arr.toString();//to string conversion
//        // console.log(str);
//        website('#approveid').val(str);//insert into hidden field
//#########################################UPDATE MOBILE NO###############################################



website("body").on("click",".upremovemob",function(e)
{

	var id=this.id;
	var mobileno=website('#'+id).attr("upmobno");
	// alert(mobileno)
	var gtapmb=website("#mydataedit #upmobileno").val();
	gtapmb=gtapmb.split(",");
	var  position = gtapmb.indexOf(mobileno);
	gtapmb.splice(position, 1);
	var arr=gtapmb.toString()
	console.log(arr);
	website('#mydataedit #upmobileno').val(arr);
	website('#'+id).remove();
});

website(document).ready(function()
{
		var i=0;
		website("body").on("click","#mydataedit  #upaddmobile",function(e){
		var mobileno=website('#mydataedit  #upmobno').val();
		var gtapmb=website("#mydataedit  #upmobileno").val();
		// var myarr=[];
        // alert(mobileno.length);
		if(gtapmb=='' && mobileno!=''  && mobileno.length>=10)
		{

            // alert();
			str=mobileno.toString();//arr to string
			clid="my_id"+i;
			var myhtml="<ul class='upremovemob' id='"+clid+"' upmobno='"+mobileno+"'><li>"+mobileno+"<span class='close' >&times;</span></li></ul>";
			// alert(myhtml);
			website('#mydataedit  #addmobileonmd').append(myhtml);
			website("#mydataedit  #upmobileno").val(str);
			new PNotify({title: 'Mobile No Added',
			            text:'Mobile No Added',
			            type: 'university',
			            hide: true,
			            styling: 'bootstrap3',
			            addclass: 'dark ',
			          });
			  i++;
		}
		else if( mobileno!='' && mobileno.length>=10)
		{
            

			var myarr=gtapmb.split(",");
			myarr.push(mobileno);
			clid="my_id"+i;
			var myhtml="<ul class='upremovemob' id='"+clid+"' upmobno='"+mobileno+"'><li>"+mobileno+"<span class='close' >&times;</span></li></ul>";
			website('#mydataedit  #addmobileonmd').append(myhtml);
			str=myarr.toString();//arr to string


			website("#mydataedit  #upmobileno").val(str);
			new PNotify({title: 'Mobile No Added',
			            text:'Mobile No Added',
			            type: 'university',
			            hide: true,
			            styling: 'bootstrap3',
			            addclass: 'dark ',
			          });

			i++;


		}
        else
        {
                    new PNotify({title: 'Invalid Mobile No',
                        text:'Invalid Mobile No',
                        type: 'university',
                        hide: true,
                        styling: 'bootstrap3',
                        addclass: 'dark ',
                      });
        }

  });

});


//#########################################MOBILE NO########################################################

website("body").on("click",".removemob",function(e)
{
	var id=this.id;

	var mobileno=website('#'+id).attr("mobno");
	// alert(mobileno)
	var gtapmb=website("#mobileno").val();
	gtapmb=gtapmb.split(",");
	var  position = gtapmb.indexOf(mobileno);
	gtapmb.splice(position, 1);
	var arr=gtapmb.toString()
	website('#mobileno').val(arr);
	website('#'+id).remove();
});

website(document).ready(function()
{
		var i=0;
		website("body").on("click","#addmobile",function(e){
		var mobileno=website('#mobno').val();
		var gtapmb=website("#mobileno").val();
		var flag=0;
		// if(mobileno>="7777777777"  && mobileno<="9999999999")
		// {
  //           flag=1;
		// }
		// else
		// {
  //          flag=0;
		// }
		// // alert(mobileno.length);
		// // var myarr=[];
		if(mobileno.length>=10)
		{
				if(gtapmb=='' && mobileno!='')
				{
				    str=mobileno.toString();//arr to string
				    clid="my_id"+i;
				    var myhtml="<ul class='removemob' id='"+clid+"' mobno='"+mobileno+"'><li>"+mobileno+"<span class='close' >&times;</span></li></ul>";
				    website('#mobileappend').append(myhtml);
				    website("#mobileno").val(str);
				    new PNotify({title: 'Mobile No Added',
				                text:'Mobile No Added',
				                type: 'university',
				                hide: true,
				                styling: 'bootstrap3',
				                addclass: 'dark ',
				              });
				      i++;
				    }
				    else if( mobileno!='')
				    {

				    var myarr=gtapmb.split(",");
				    myarr.push(mobileno);
				    clid="my_id"+i;
				    var myhtml="<ul class='removemob' id='"+clid+"' mobno='"+mobileno+"'><li>"+mobileno+"<span class='close' >&times;</span></li></ul>";
				    website('#mobileappend').append(myhtml);
				    str=myarr.toString();//arr to string


				    website("#mobileno").val(str);
				    new PNotify({title: 'Mobile No Added',
				                text:'Mobile No Added',
				                type: 'university',
				                hide: true,
				                styling: 'bootstrap3',
				                addclass: 'dark ',
				              });

				    i++;


				    }
		}


		else
		{


		     new PNotify({title: 'Please Enter Valid Mobile No',
		                text:'Please Enter Valid Mobile No',
		                type: 'university',
		                hide: true,
		                styling: 'bootstrap3',
		                addclass: 'dark ',
		              });
		}
	});

});



//##################################################################################################################

website("body").on("click","#pastbtnsub",function(e){
  var nooffield=website('.empnm').length;
//   "empname_'+i+'"
// "designtn_'+i+'"
// "strtdte_'+i+'" 
// "enddte_'+i+'"
  var myarr=[];
  for(var i=0;i<nooffield;i++)
    {
       var empname=website('#empname_'+i).val();
       var designtn=website('#designtn_'+i).val();
       var strtdte=website('#strtdte_'+i).val();
       var enddte=website('#enddte_'+i).val();
       
       if(empname!='' &&  designtn!='' && strtdte!='' && enddte!='')
       {
          var obj={empname:empname,designtn:designtn,strtdte:strtdte,enddte:enddte};
          myarr.push(obj);
          // console.log(myarr);
       }
       else
       {
           new PNotify({
                title: 'Alert',
                      text: "Please Check All The Input Fields",
                      type: 'university',
                      hide: true,
                      styling: 'bootstrap3',
                      addclass: 'dark ',
                    });  
        }
     }
      if(myarr.length>=1)
      {
        website.ajax({
        url:'employeemodule/insertpastemp',
        method:'POST',
        data:{myarr:myarr},
        contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
        dataType:"json",
        cache:false,
        //async:true, Cross domain checking
        beforeSend: function()
        {     },
        uploadProgress: function(event, position, total, percentComplete)
        {   },
        success: function(response, textStatus, jqXHR)
        {
            if(response.logged==true){
                 
                  new PNotify({title: 'Alert',
                    text: response.message,
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
                });
                    relativeaccinfo();

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
        {   },
        error: function(jqXHR, textStatus, errorThrown)
        {   }
   });
 }

});

 website('body').on('click','.sendfrapp',function(e){ 
     website('#sendappp').modal('show');
 });


 website('body').on('click','.sendreq',function(e){ 
    website.ajax({
        url:'employeemodule/sendreq',
        method:'POST',
        // data:{myarr:myarr},
        contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
        dataType:"json",
        cache:false,
        //async:true, Cross domain checking
        beforeSend: function()
        {   website('.preloder_wraper').fadeIn();   },
        uploadProgress: function(event, position, total, percentComplete)
        {   website('.preloder_wraper').fadeIn();  },
        success: function(response, textStatus, jqXHR)
        {
            if(response.logged==true){
                 
                  new PNotify({title: 'Alert',
                    text: response.message,
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
                });

                     website('#sendappp').modal('hide');

                     location.reload();

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
        {  website('.preloder_wraper').fadeOut(); 
         },
        error: function(jqXHR, textStatus, errorThrown)
        {   }
   });
 });


getpastempdata();
function getpastempdata()
{
    var noofrows = website('#noofrows').val(); 
    var pagenum = website('#pagenum').val();
    var persnid = website('#personid').val();
    var formdata = {persnid:persnid,noofrows:noofrows,pagenum:pagenum}
    website.ajax({
      url:'employeemodule/fetchpastemployer',
      data:formdata,
      method:'POST',
      //contentType:'json',
      contentType:'application/x-www-form-urlencoded; charset=UTF-8',
      //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
      dataType:"json",
      cache:false,
      //async:true, /*Cross domain checking*/
      beforeSend: function()
      {   },
      uploadProgress: function(event, position, total, percentComplete)
      {   },
      success: function(response, textStatus, jqXHR)
      {
          if(response.logged === true)
          { //console.log(response);return false;
                     var htmlele='';
                      for(var i=0;i < response.resdta.length;i++)
                      {
                        response.resdta
                         var emp_name=response.resdta[i].emp_name?response.resdta[i].emp_name:''; 
                         var emp_desigtn=response.resdta[i].emp_desigtn?response.resdta[i].emp_desigtn:'';
                         var startdate=response.resdta[i].startdate?response.resdta[i].startdate:'';
                         var enddate=response.resdta[i].enddate?response.resdta[i].enddate:'';
                         htmlele+=  '<div class="box_css">'+
                         '<div class="col-md-12 text-right"><i class="fa fa-trash deletepastemp" id ="'+response.resdta[i].id+'"  aria-hidden="true" onclick="deleteemp(this.id);"></i></div>'+
                        
                         '<section class="col col-md-6 col-xs-6">'+
                                                '<div class="input">'+
                                                    '<label class="control-label">Name of employer*</label>'+
                                                     '<input type="text" id="empid_'+i+'" name="empid" class="form_fields form-control col-md-7 col-xs-12 empnm"  value= "'+response.resdta[i].id+'"  empid ="'+response.resdta[i].id+'"  style = "display:none;">'+
               
                                                    '<input type="text" id="empname_'+i+'" name="empname" class="form_fields form-control col-md-7 col-xs-12 empnm" value= "'+emp_name+'" empname= "'+emp_name+'" required>'+
                                                '</div>'+
                                            '</section>'+
                                            
                                             '<section class="col col-md-6 col-xs-6">'+
                                                '<div class="input">'+
                                                    '<label class="control-label">Designation Served*</label>'+
                                                    '<input type="text" id="designtn_'+i+'" name="designtn" class="form_fields form-control col-md-7 col-xs-12 desig" value= "'+emp_desigtn+'" emp_desigtn= "'+emp_desigtn+'" required>'+
                                                '</div>'+
                                           '</section>'+
                                        
                                            
                                        '<section class="col col-md-6 col-xs-6">'+
                                        '<div class="input">'+
                                            '<label class="control-label">Start Date of Employment*</label>'+ 
                                            '<input type="text" name="strtdte" id="strtdte_'+i+'" class="form-control bootdatepick sde" value= "'+startdate+'"  startdate= "'+startdate+'"  required readonly>'+
                                        '</div>'+
                                        '</section>'+
                                            
                                        '<section class="col col-md-6 col-xs-6">'+
                                        '<div class="input">'+
                                        '<label class="control-label">End Date of employent*</label>'+  
                                            '<input type="text" name="enddte" id="enddte_'+i+'" class="form-control bootdatepick ede" value= "'+enddate+'"  enddate= "'+enddate+'" required readonly>'+
                                        '</div>'+
                                        '</section></div>';
                   
                     
                               
                      }
                     


                      htmlele+=  '<section class="col col-md-12 col-xs-12 company_asses" id="pstbtn">'
                      htmlele+= '<input type="button" value="Update" class="btn btn-primary contractexcelbtn" id="pastupdate">'+
                                        '</section>';

                      website('#addnoofforms').html(htmlele);
                      datepicker();
                                 
          }
          else
           {
               website('.paginationmn').html(response.pgnhtml);
           }
      },
      complete: function(response)
      {  website('.preloder_wraper').fadeOut(); },
      error: function(jqXHR, textStatus, errorThrown)
      {   }
    });
}

function deleteemp(id){


var delid = id ;
var formdata = {id:delid}
    website.ajax({
      url:'employeemodule/deleteempdetail',
      data:formdata,
      method:'POST',
      //contentType:'json',
      contentType:'application/x-www-form-urlencoded; charset=UTF-8',
      //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
      dataType:"json",
      cache:false,
      //async:true, /*Cross domain checking*/
      beforeSend: function()
      {   },
      uploadProgress: function(event, position, total, percentComplete)
      {   },
      success: function(response, textStatus, jqXHR)
      {
           if(response.logged==true){
                 
                  new PNotify({title: 'Alert',
                    text: response.message,
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
                });
                   
                   window.location.reload();
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
      {  website('.preloder_wraper').fadeOut(); },
      error: function(jqXHR, textStatus, errorThrown)
      {   }
    });
}

function IsAlphaNumeric(e) 
{
   var regex = new RegExp("^[a-zA-Z0-9 ]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
       event.preventDefault();
       return false;
    }
}

