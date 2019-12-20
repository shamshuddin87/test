getpersonalinfo();
function getpersonalinfo(){
    var getuser=website('#getuser').val();
    // alert(getuser);
      website.ajax({
        url:'approvelperinfo/getuserdetails',
        data:{getuser:getuser},
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
//                var age=obj['age']?obj['age']:'';
                var dob=obj['dob']?obj['dob']:'';
                var aadhar=obj['aadhar']?obj['aadhar']:'';
                var education=obj['education']?obj['education']:'';
                var institute=obj['institute']?obj['institute']:'';
                var filepath=obj['filepath']?obj['filepath']:'';
                var dpdate=obj['dpdate']?obj['dpdate']:'';
                var mobno=obj['mobileno']?obj['mobileno']:'';
                var id=response.data.id?response.data.id:'';

                if(response.data.approved_status==1)
                {
                   website('#acprejstatus').html("<p style='color:green;'>You Have Accepted This Request</p>");
                    website('.rejbtn').css('display','none');
                    website('.accptbtn').css('display','none');
                   

                }
                else if(response.data.approved_status==0 && response.data.approved_status!='')
                {
                    website('#acprejstatus').html("<p style='color:red;'>You Have Rejected This Request</p>");
                    website('.rejbtn').css('display','none');
                    website('.accptbtn').css('display','none');
                   
                }

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
                // myhtml+='<td><i class="fa fa-eye faicon floatleft viewdetail" title="View entry" id="editdetail" personalid="'+response.data.id+'"></i></td>';
               
                myhtml+='<td><i class="fa fa-edit editcmp" editid="'+id+'"  style=""></i><i class="fa fa-trash del" delid="'+id+'"  style=""></i></td>'; 
              
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
  }



   
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


   website('body').on('click','.editcmp',function(e)
    { 
        var getuserid=website('#getuser').val();
        // alert(getuserid)
        website.ajax({
            url:'approvelperinfo/getmydetailsmod',
            method:'POST',
            data:{getuserid:getuserid},
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

                    website('#mydataedit').modal('show');
                    var id=response.data.id?response.data.id:'';
                    var mobileno=response.data.mobileno?response.data.mobileno:'';
                    var myarray = mobileno.split(",");
                    var upmyhtml='';
                    var clid='';
                    for(var n=0;n<myarray.length;n++)
                    {
                       clid="my_id"+n;
                       var mobile=myarray[n];
                       upmyhtml+="<ul class='upremovemob' id='"+clid+"' upmobno='"+mobile+"'><li>"+mobile+"<span class='close' >&times;</span></li></ul>";
                    }
                    var pan=obj['pan']?obj['pan']:'';
                    var dob=obj['dob']?obj['dob']:'';
                    var sex=obj['sex']?obj['sex']:'';
                    var aadhar=obj['aadhar']?obj['aadhar']:'';
                    var education=obj['education']?obj['education']:'';
                    var institute=obj['institute']?obj['institute']:'';
                    var address=obj['address']?obj['address']:'';
                    var filepath=obj['filepath']?obj['filepath']:'';
                    website('#mydataedit #upmobileno').val(mobileno)
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
        if(gtapmb=='' && mobileno!='')
        {
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
        else if( mobileno!='')
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

  });

});






website('#upmydetails').ajaxForm({
dataType:"json",
    beforeSend: function() 
    {   website('.preloder_wraper').fadeIn(); },
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

//##############################################FETCH PAST EMPLOYER ############################################################//
getdataonload();
function getdataonload()
{
    var noofrows = website('#noofrows').val(); 
    var pagenum = website('#pagenum').val();
    var persnid = website('#personid').val();
    var getuserid=website('#getuser').val();
    var formdata = {persnid:persnid,noofrows:noofrows,pagenum:pagenum,getuserid:getuserid}
    website.ajax({
      url:'approvelperinfo/getpastemployer',
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
             var addhtmlnxt='';
              for(var i = 0; i < response.resdta.length; i++) 
              {
                var emp_name=response.resdta[i].emp_name?response.resdta[i].emp_name:''; 
                var emp_desigtn=response.resdta[i].emp_desigtn?response.resdta[i].emp_desigtn:'';
                var startdate=response.resdta[i].startdate?response.resdta[i].startdate:'';
                var enddate=response.resdta[i].enddate?response.resdta[i].enddate:'';
                var j=i+1;
                                     
                //------------------------- Table Fields Insertion START ------------------------
                 
                        addhtmlnxt += '<tr class="counter" empid="'+response.resdta[i].id+'" >';
                        addhtmlnxt += '<td width="20%">'+j+'</td>';
                        addhtmlnxt += '<td width="20%">'+emp_name+'</td>';
                        addhtmlnxt += '<td width="20%">'+emp_desigtn+'</td>';
                        addhtmlnxt += '<td width="20%">'+startdate+'</td>';
                        addhtmlnxt += '<td width="20%">'+enddate+'</td>';
                        // addhtmlnxt += '<td width="20%" ><i class="fa fa-edit faicon floatleft editemp" title="Edit entry" empid="'+response.resdta[i].id+'" ></i><i class="fa fa-trash-o faicon floatleft deleteemp" title="Delete entry" empid="'+response.resdta[i].id+'" ></i></td>';  
                        addhtmlnxt += '</tr>';
                        
                //------------------------ Table Fields Insertion END ------------------------
             }

              website('.appendviewemplyee').html(addhtmlnxt);
              // website('.paginationmn').html(response.pgnhtml);
             
          }
          else
           {
               // website('.paginationmn').html(response.pgnhtml);
           }
      },
      complete: function(response)
      {  website('.preloder_wraper').fadeOut(); },
      error: function(jqXHR, textStatus, errorThrown)
      {   }
});
}


website('body').on('click','.accptbtn',function(e){
  var getuser=website('#getuser').val();
  website('#acceptreq').attr('acptid',getuser)
  website('#acptmodel').modal('show');
 });

website('body').on('click','#acceptreq',function(e){
 
  var getuser=website('#getuser').val();
website.ajax({
        url:'approvelperinfo/acceptrequest',
        data:{getuser:getuser},
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
        {     website('#acptmodel').modal('hide');
              var baseHref = getbaseurl();
              var myurl=baseHref+"approvelperinfo";
              if(response.logged==true)
              {
                // getpersonalinfo(); 
                new PNotify({title: 'Alert',
                          text: response.message,
                          type: 'university',
                          hide: true,
                          styling: 'bootstrap3',
                          addclass: 'dark ',
                      });
                
              location.replace(myurl);

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

website('body').on('click','.rejbtn',function(e){
  var getuser=website('#getuser').val();
  website('#rejid').attr('acptid',getuser)
  website('#rejmodel').modal('show');
 });



website('body').on('click','#rejid',function(e){
 
  var getuser=website('#getuser').val();
website.ajax({
        url:'approvelperinfo/rejectrequest',
        data:{getuser:getuser},
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
        {     website('#acptmodel').modal('hide');
              var baseHref = getbaseurl();
              var myurl=baseHref+"approvelperinfo";
              if(response.logged==true)
              {
                // getpersonalinfo(); 
                new PNotify({title: 'Alert',
                          text: response.message,
                          type: 'university',
                          hide: true,
                          styling: 'bootstrap3',
                          addclass: 'dark ',
                      });
                
              location.replace(myurl);

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
