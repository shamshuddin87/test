var url = new URL(window.location.href);
var action = url.searchParams.has("tab");
if(action)
{
    var actval = atob(url.searchParams.get("tab"));
    if(actval == 2)
    {
        website('.relatives').addClass('active');
        website('.personal').removeClass('active');
        website('.relativesform').show();
        website('.personaldetails').hide();
    }
}
else
{
    website('.relativesform').hide();
}


 website('.personal').click(function(e) {
   e.preventDefault();
   website(this).addClass('active');
   website('.relatives').removeClass('active');
   website('.personaldetails').show();
   website('.relativesform').hide();
 });

 website('.relatives').click(function(e) {
   e.preventDefault();
   website(this).addClass('active');
   website('.personal').removeClass('active');
   website('.relativesform').show();
   website('.personaldetails').hide();
 });
  
  //show demat when clicked yes
 let yeschecked = website("input[name='pastemp']:checked").val();
 if(yeschecked == 1)
 {
      website("#showdemat").css('display','block');
 }
 else
 {
    website("#showdemat").css('display','none');
 }


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

website("body").on("click","#noofdmat",function(e) {
var no=website('#noofacc').val();
var self_nation = website('#self_nation').val();
//alert(self_nation);
if(no<=10){
var myhtml='<table class="table table-inverse" id="datableabhi"><tr><th>Account No </th><th>Depository Participant </th></tr>';
for(var i=1;i<=no;i++)
{
  if(self_nation == 'Indian')
  {

  myhtml+='<tr><td style = "position:relative;"><input type="text" class="form-control acsub showhovertext3'+i+'" id="field_'+i+'" placeholder="Account No '+i+'" onkeypress="return isAlphaNumeric(event,this.value);"maxlength="16" pattern="[A-Za-z0-9]{16}" onmouseover="boxshow(this.className)" onmouseout="boxhide(this.className)"> <span id= "showhovertext3'+i+'" class ="cssclass1 " style="display: none;z-index: 2;">  <ol type="a" style="padding: 5px 5px 5px 15px;"> <li>Demat account,  mention the 16 digit DP ID-Client ID (For eg.: IN123456-12345678 or 12345678-12345678</li>   <li>In case of Securities Account (held in a country other than India): please mention the account no. and entity where the account is held  </li><li>In case your Demat account no. is less than 16 digits then prefix the relevant number of "0"s</li>  </ol> </span></td><td><input type="text" class="form-control deppoparticipient"  id="field2_'+i+'" placeholder="Depository Participant '+i+'" ></td></tr>';
  }
  else
  {
    myhtml+='<tr><td style = "position:relative;"><input type="text" class="form-control acsub showhovertext3'+i+'" id="field_'+i+'" placeholder="Account No '+i+'" onkeypress="return isAlphaNumeric(event,this.value); pattern="[A-Za-z0-9]" onmouseover="boxshow(this.className)" onmouseout="boxhide(this.className)"> <span id= "showhovertext3'+i+'" class ="cssclass1 " style="display: none;z-index: 2;">  <ol type="a" style="padding: 5px 5px 5px 15px;"> <li>Demat account,  mention the 16 digit DP ID-Client ID (For eg.: IN123456-12345678 or 12345678-12345678</li>   <li>In case of Securities Account (held in a country other than India): please mention the account no. and entity where the account is held  </li><li>In case your Demat account no. is less than 16 digits then prefix the relevant number of "0"s</li>  </ol> </span></td><td><input type="text" class="form-control deppoparticipient"  id="field2_'+i+'" placeholder="Depository Participant '+i+'" ></td></tr>';
  }
}
myhtml+='</table>';
myhtml+='<button type="button" class="btn btn-primary" id="subdemat">Submit</button>';
website('.appendaccfield').html(myhtml);
}
else{
  
   new PNotify({title: 'Alert',
                    text: "No Of Accounts Must Be Less Than 10",
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
                });
}
});

//#######################STORE ACCOUNT NO IN DB#############################################################//

website("body").on("click","#subdemat",function(e) {
    var len=website('.acsub').length;
    var self_nation = website('#self_nation').val();

    var mydata=[];
    for(var i=1;i<=len;i++)
    { 
        var accno=website('#field_'+i).val();
        var dp=website('#field2_'+i).val();
        //alert(dp);return false;
        //var clhouse=website('#field3_'+i).val();
        var obj=
        {
            "accno":accno,
            "dp":dp,
        };
        mydata.push(obj);
    }
//console.log(mydata);return false;
  website.ajax({
        url:'portfolio/storeaccno',
       data:{accno:mydata,self_nation:self_nation},
        method:'POST',
        //contentType:'json',
        contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
        dataType:"json",
        cache:false,
        //async:true, Cross domain checking
        beforeSend: function()
        {  website('.preloder_wraper').fadeIn();   },
        uploadProgress: function(event, position, total, percentComplete)
        {   },
        success: function(response, textStatus, jqXHR)
        {
             if(response.logged===true)
             {
                if(response.isfilled == 'no' && response.isnextdatafilled == 'no')
                {
                    var baseHref = getbaseurl();
                    var redirecturl = baseHref + "portfolio?tab=" + btoa(2);
                    website('#modeluserguide #modalcontent').html('<div style="text-align:center;"><h5 style="text-align: center;color: #000;margin: 25px 0;line-height: 25px;">Demat Account Details added successfully.<br>Please Insert Relative Demat Account Details.</h5></div><div class="guidebtn" style="text-align:center;"><a href="'+redirecturl+'"><button type="button" class="btn btn-success" style="border-top:none; text-align: center;">OK</button></a></div>');
                    website('#modeluserguide').modal('show');
                    getuseraccno();
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
                    getuseraccno();
                }
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
        {  website('.preloder_wraper').fadeOut(); },
        error: function(jqXHR, textStatus, errorThrown)
        {   }
   });


});
//#########################################GET USER ACCOUND NO#################################


getuseraccno();
function getuseraccno(){
  website.ajax({
        url:'portfolio/getaccno',
        method:'POST',
        //contentType:'json',
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
             if(response.logged===true)
             {
                var htmlelements='';
                var j=1;
                website("#showdemat").css("display","block");
                 for(var i=0;i<response.data.length;i++)
                 {
                      //console.log(response.data[i].accountno);return false; 
                       htmlelements+='<tr>';
                       htmlelements+='<td>'+j+'</td>';
                       htmlelements+='<td>'+response.data[i].accountno+'</td>';
                        htmlelements+='<td>'+response.data[i].depository_participient+'</td>';
//                        htmlelements+='<td>'+response.data[i].clearing_house+'</td>';
                       htmlelements+='<td><i class="fa fa-edit accedit" accno="'+response.data[i].accountno+'" rp="'+response.data[i].depository_participient+'" hc="'+response.data[i].clearing_house+'"  acountedit="'+response.data[i].id+'" ></i>'+
                      '<i class="fa fa-trash accdel" acountdel="'+response.data[i].id+'" ></i></td>';
                       htmlelements+='</tr>';
                       j=j+1;
                 }
               }
             else{
                    htmlelements+='<tr>';
                    htmlelements+='<td colspan="5" style="text-align:center;">Data Not Found</td>';
                    htmlelements+='</tr>';
                 }
                 website('.accdetails').html(htmlelements);
         },
        complete: function(response)
        {   },
        error: function(jqXHR, textStatus, errorThrown)
        {   }
   });

}
website("body").on("click",".accdel",function(e) {
  var delid=website(this).attr('acountdel');
  website('#myModalyesno #delid').val(delid);
  website('#myModalyesno').modal('show');
});
website("body").on("click",".yesconfirm",function(e){
var delid=website('#myModalyesno #delid').val();

  website.ajax({
        url:'portfolio/deleteacc',
        method:'POST',
        data:{delid:delid},
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
                 website('#myModalyesno').modal('hide');
                 getuseraccno();
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
        {   },
        error: function(jqXHR, textStatus, errorThrown)
        {   }
   });
});
//##############################EDIT ACCOUNT NO#######################################
website("body").on("click",".accedit",function(e){
var accno=website(this).attr('accno');
var editid=website(this).attr('acountedit');
var rp=website(this).attr('rp');
var hc= website(this).attr('hc');

website('#editaccmodal #editaccno').val(accno)
website('#editaccmodal #clhouse').val(hc)

website('#editaccmodal #dpar').val(rp)
website('#editaccmodal .upacc').attr('btnedit',editid);
website('#editaccmodal').modal('show');
});
website('body').on("click",".upacc",function(e){
var accno=website('#editaccno').val();
var rp=website('#dpar').val();
var hc=website('#clhouse').val();
var self_nation =  website("#self_nation").val();
var editid=website(this).attr('btnedit');
  website.ajax({
        url:'portfolio/updateacc',
        method:'POST',
        data:{accno:accno,editid:editid,rp:rp,hc:hc,self_nation:self_nation},
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
              
                 website('#editaccmodal').modal('hide');
                 getuseraccno();
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
        {   },
        error: function(jqXHR, textStatus, errorThrown)
        {   }
   });
})
//################################RELATIVE INFO ACC NO######################################
  //   <table class="table table-inverse" id="datableabhi">
  //    <thead>
  //      <tr>
  //        <th>Sr No</th>
  //        <th>Account No</th> 
  //         <th>Depository Participant</th>
  //         <th>Clearing House</th>
  //        <th>Actions</th>                                                 
  //       </tr>
  //    </thead>
  //  <tbody class="accdetails" appendrow='1'></tbody>
  // </table>
website("body").on("click",".relhtml",function(e){ 
var noofacc=website('#reldematno').val();
var relinfo=website('#relinfo').val();
var nationality =website("#relinfo option:selected").attr("nationality");
  //alert(nationality);

if(relinfo!='')
{

  var no=website('#reldematno').val();
  if(no<=10){
    var myhtml=' <table class="table table-inverse" id="datableabhi"><tr><th>Account No </th><th>Depository Participant </th></tr>';
  
   for(var i=1;i<=no;i++)
   {   
      if(nationality == 'Indian')
     {
       myhtml+='<tr><td style = "position:relative;"><input type="text" class="form-control relac showhovertext4'+i+'" id="relfield_'+i+'"  placeholder="Account No '+i+'" onkeypress="return isAlphaNumeric(event,this.value);"maxlength="16" pattern="[A-Za-z0-9]{16}" onmouseover="boxshow(this.className)" onmouseout="boxhide(this.className)"><span id= "showhovertext4'+i+'" class ="cssclass1 " style="display: none;z-index: 2;">  <ol type="a" style="padding: 5px 5px 5px 15px;"> <li>Demat account,  mention the 16 digit DP ID-Client ID (For eg.: IN123456-12345678 or 12345678-12345678</li><li>In case of Securities Account (held in a country other than India): please mention the account no. and entity where the account is held  </li><li>In case your Demat account no. is less than 16 digits then prefix the relevant number of "0"s</li>  </ol> </span></td><td><input type="text" class="form-control deppoparticipient showhovertext4'+i+'" id="relfield2_'+i+'" placeholder="Depository Participant '+i+'"  onmouseover="boxshow(this.className)" onmouseout="boxhide(this.className)"></td></tr>';
     }
     else
     {
      myhtml+='<tr><td style = "position:relative;"><input type="text" class="form-control relac showhovertext4'+i+'" id="relfield_'+i+'"  placeholder="Account No '+i+'" onkeypress="return isAlphaNumeric(event,this.value);" pattern="[A-Za-z0-9]" onmouseover="boxshow(this.className)" onmouseout="boxhide(this.className)"><span id= "showhovertext4'+i+'" class ="cssclass1 " style="display: none;z-index: 2;">  <ol type="a" style="padding: 5px 5px 5px 15px;"> <li>Demat account,  mention the 16 digit DP ID-Client ID (For eg.: IN123456-12345678 or 12345678-12345678</li><li>In case of Securities Account (held in a country other than India): please mention the account no. and entity where the account is held  </li><li>In case your Demat account no. is less than 16 digits then prefix the relevant number of "0"s</li>  </ol> </span></td><td><input type="text" class="form-control deppoparticipient showhovertext4'+i+'" id="relfield2_'+i+'" placeholder="Depository Participant '+i+'"  onmouseover="boxshow(this.className)" onmouseout="boxhide(this.className)"></td></tr>';
     }
    }
       myhtml+='</table>'
       myhtml+='<section class=""><button type="button" class="btn btn-primary" id="subreldemat">Submit</button>';
       website('.relfieldapnd').html(myhtml);
     
  
     
    
 }
 else{

     new PNotify({title: 'Alert',
                    text: "No Of Accounts Must Be Less Than 10",
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
                });
  }
}
else{
   new PNotify({title: 'Alert',
                    text: "Please Select Relative Name",
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
                });
     }
});
website("body").on("click","#pastbtnsub",function(e){
  var nooffield=website('.relac').length;
  var relinfo=website('#relinfo').val();
  var myarr=[];
  for(var i=1;i<=nooffield;i++)
    {
       var txtdata=website('#relfield_'+i).val();
       var dp=website('#relfield2_'+i).val();
        //var ch=website('#relfield3_'+i).val();
       if(txtdata!='' &&  dp!='' && ch!='')
       {
          var obj={relativeacc:txtdata,dp:dp};
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
        url:'portfolio/insertrelativeacc',
        method:'POST',
        data:{myarr:myarr,relid:relinfo},
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
//####################################GET RELATIVE USER ACCOUNT INFO###########################################


// relativeaccinfo();
// function relativeaccinfo(){
//   website.ajax({
//         url:'portfolio/getreluseracc',
//         method:'POST',
//         //contentType:'json',
//         contentType:'application/x-www-form-urlencoded; charset=UTF-8',
//         //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
//         dataType:"json",
//         cache:false,
//         //async:true, Cross domain checking
//         beforeSend: function()
//         {     },
//         uploadProgress: function(event, position, total, percentComplete)
//         {   },
//         success: function(response, textStatus, jqXHR)
//         {
//              if(response.logged===true)
//              {
//                 var htmlelements='';
//                 var j=1;
//                  for(var i=0;i<response.data.length;i++)
//                  {
                     
//                        htmlelements+='<td>'+j+'</td>';
//                        htmlelements+='<td>'+response.data[i].name+'</td>';
//                        htmlelements+='<td>'+response.data[i].accountno+'</td>';
//                        htmlelements+='<td>'+response.data[i].depository_participient+'</td>';
// //                       htmlelements+='<td>'+response.data[i].clearing_house+'</td>';
//                       htmlelements+='<td><i class="fa fa-edit relaccedit" relname="'+response.data[i].name+'" dp="'+response.data[i].depository_participient+'" ch="'+response.data[i].clearing_house+'" relaccno="'+response.data[i].accountno+'" relacedit="'+response.data[i].id+'" ></i>'+
//                       '<i class="fa fa-trash relaccdel" acourel="'+response.data[i].id+'" ></i></td>';
//                        htmlelements+='</tr>';
//                        j=j+1;
//                  }
//                }
//              else{
//                     htmlelements+='<tr>';
//                     htmlelements+='<td colspan="4" style="text-align:center;">Data Not Found</td>';
//                     htmlelements+='</tr>';
//                  }
//                  website('.relaccdetails').html(htmlelements);
//          },
//         complete: function(response)
//         {   },
//         error: function(jqXHR, textStatus, errorThrown)
//         {   }
//    });

// }


relativeaccinfo();
function relativeaccinfo(){
  website.ajax({
        url:'portfolio/getreluseracc',
        method:'POST',
        //contentType:'json',
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
             if(response.logged===true)
             {
                var htmlelements='';
                var j=1;
                 for(var i=0;i<response.data.length;i++)
                 {
                    //  console.log(response.data[i]);return false; 
                       htmlelements+='<tr>';
                       htmlelements+='<td>'+j+'</td>';
                       htmlelements+='<td>'+response.data[i].name+'</td>';
                       htmlelements+='<td>'+response.data[i].accountno+'</td>';
                       htmlelements+='<td>'+response.data[i].depository_participient+'</td>';
                      
                       htmlelements+='<td><i class="fa fa-edit relaccedit" relname="'+response.data[i].name+'" dp="'+response.data[i].depository_participient+'" ch="'+response.data[i].clearing_house+'" relaccno="'+response.data[i].accountno+'" relacedit="'+response.data[i].id+'"  nationality="'+response.data[i].nationality+'" ></i>'+
                      '<i class="fa fa-trash relaccdel" acourel="'+response.data[i].id+'" ></i></td>';
                       htmlelements+='</tr>';
                       j=j+1;
                 }
               }
             else{
                    htmlelements+='<tr>';
                    htmlelements+='<td colspan="4" style="text-align:center;">Data Not Found</td>';
                    htmlelements+='</tr>';
                 }
                 website('.relaccdetails').html(htmlelements);
         },
        complete: function(response)
        {   },
        error: function(jqXHR, textStatus, errorThrown)
        {   }
   });

}
//##################################SHOW DELETE MODAL FOR RELATIVES USER####################################

website("body").on("click",".relaccdel",function(e) {
  var delid=website(this).attr('acourel');
  website('#myModalrel .reldel').attr('reldel',delid);
 website('#myModalrel').modal('show');

 });
website("body").on("click",".reldel",function(e) {
    var delid=website(this).attr('reldel');
     website.ajax({
            url:'portfolio/reldeleteacc',
            method:'POST',
            data:{delid:delid},
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
                     website('#myModalrel').modal('hide');
                     relativeaccinfo();
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
            {   },
            error: function(jqXHR, textStatus, errorThrown)
            {   }
       });

});
website("body").on("click",".relaccedit",function(e){
var relaccno=website(this).attr('relaccno');
var dp=website(this).attr('dp');
var ch=website(this).attr('ch');
var name=website(this).attr('relname'); 
var editid=website(this).attr('relacedit');
var nationality = website(this).attr('nationality');
//alert(nationality);


website('#releditaccmodal #dparrel').val(dp);
website('#releditaccmodal #relclhouse').val(ch);
website('#releditaccmodal #relednation').val(nationality);


website('#releditaccmodal #reledname').val(name);
website('#releditaccmodal #releditaccno').val(relaccno);
website('#releditaccmodal .relupacc').attr('btnedit',editid);
if(nationality == 'Other')
{
  website('#releditaccmodal #releditaccno').removeAttr("maxlength");

}
else
{
   website('#releditaccmodal #releditaccno').attr("maxlength","16");
}
website('#releditaccmodal').modal('show');
});

website("body").on("click",".relupacc",function(e){
var reledit=website(this).attr('btnedit');
var accno=website("#releditaccno").val();
var dp=website("#dparrel").val();
var ch=website("#relclhouse").val();
let rel_nation=website("#relednation").val();
  website.ajax({
        url:'portfolio/updaterelacc',
        method:'POST',
        data:{reledit:reledit,accno:accno,dp:dp,ch:ch,rel_nation:rel_nation},
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
                 relativeaccinfo();
                 website('#releditaccmodal').modal('hide');
               
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
        {   },
        error: function(jqXHR, textStatus, errorThrown)
        {   }
   });

})
relativeaccinfo();
website("body").on("click","#subreldemat",function(e){
  var nooffield=website('.relac').length;
  var relinfo=website('#relinfo').val();
  var nationality =website("#relinfo option:selected").attr("nationality");
  

  var myarr=[];
  for(var i=1;i<=nooffield;i++){

       var txtdata=website('#relfield_'+i).val();
       var dp=website('#relfield2_'+i).val();
        var ch=website('#relfield3_'+i).val();
       if(txtdata!='' &&  dp!='' && ch!=''){
          var obj={relativeacc:txtdata,dp:dp,ch:ch};
          myarr.push(obj);
         // console.log(myarr);
       }
       else{

           
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
        url:'portfolio/insertrelativeacc',
        method:'POST',
        data:{myarr:myarr,relid:relinfo,nationality:nationality},
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
        {   },
        error: function(jqXHR, textStatus, errorThrown)
        {   }
   });
 }

});



 website('body').on('click','.dematup',function(e){

   var dematup=website(this).val();
   // alert(dematup)
   website.ajax({
        url:'portfolio/zerodematacc',
        data:{dematup:dematup},
        method:'POST',
        //contentType:'json',
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
              //console.log(response);
            if(dematup == 0 && response.isfilled == 'no' && response.isnextdatafilled == 'no')
            {
                var baseHref = getbaseurl();
                var redirecturl = baseHref + "portfolio?tab=" + btoa(2);
                website('#modeluserguide #modalcontent').html('<div style="text-align:center;"><h5 style="text-align: center;color: #000;margin: 25px 0;line-height: 25px;">Updated successfully.<br>Please Insert Relative Demat Account Details.</h5></div><div class="guidebtn" style="text-align:center;"><a href="'+redirecturl+'"><button type="button" class="btn btn-success" style="border-top:none; text-align: center;">OK</button></a></div>');
                website('#modeluserguide').modal('show');
            }
              /*website('#alertcommon #allalertmsg').html(response.message);
              website('#alertcommon').modal('show');*/
         },
        complete: function(response)
        {   },
        error: function(jqXHR, textStatus, errorThrown)
        {   }
   });
});


function showsection(){


var section = document.getElementById("showdemat");


  if (section.style.display === "none") {
    section.style.display = "block";
  } 

}

function hidesection(){

var section = document.getElementById("showdemat");

  if (section.style.display === "block") 
  {
    section.style.display = "none";
  } 
}

function boxshow(name)
{

 var classname = name.split(" ");
 var length = classname.length;
 
 if(length == 5)
 {
  website("#"+classname[4]).css("display","block");

 }
 else if(length == 3)
 {
  

   website("#"+classname[2]).css("display","inline-block");

 }


 
  
 
 
}

function boxhide(name)
{

 var classname = name.split(" ");
 var length = classname.length;
 
 if(length == 5)
 {
  website("#"+classname[4]).css("display","none");

 }
 else if(length == 3)
 {
  

   website("#"+classname[2]).css("display","none");
 }
}
