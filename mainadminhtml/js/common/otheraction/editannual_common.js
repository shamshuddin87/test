website(document).ready(function()
{
  
   
    
});




function addhtml(clicked)
 {

    website.ajax({
      url:'annualdeclaration/fetchrelative',
      //data:formdata,
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
       // console.log(response.resdta);
     


 var id = clicked;
 //alert(id);
 if(id == 'adddiv1') {
         
         var getlastid = website('.appendd1').attr('plancntr');

         getlastid = ++getlastid;
         var addhtmlnxt='';

        
         addhtmlnxt += '<div class="row'+getlastid+' append_row3"  id="row'+getlastid+'" >';
          addhtmlnxt += '<table style="border-collapse: collapse; border: 1px solid #ccc" width="100%" border="1">';
          addhtmlnxt += '<tr>';
          addhtmlnxt += ' <td style="border-right: 1px solid #f7f7f7"></td>';
          addhtmlnxt += '<td style="width: 22%"><label class="control-label">Company Name</label>';
            addhtmlnxt += '</td>';
          addhtmlnxt += '<td><label class="control-label">Can you significantly influence the decision making of this company?</label>';
            addhtmlnxt += '</td>';
          addhtmlnxt += '<td><label class="control-label">Do this company have any commercial or financial transactions with Dr. Reddys Laboratories Limited or any of its group company/subsidiary?</label>';
        
        
          addhtmlnxt += '</td>';
          addhtmlnxt +='</tr>';
          addhtmlnxt += '<tr>';
          addhtmlnxt += ' <td style="border-right: 1px solid #fff"></td>';
          addhtmlnxt += '<td><div class="input" > <input type="text" class="form-control inputbox3" id="d1ques1" name="d1ques1[]" >  </div>';
          addhtmlnxt += '</td>';
          addhtmlnxt+=' <td><div class="input"><select id="d1ques2" name="d1ques2[]" class="form_fields form-control col-md-7 col-xs-12"  > <option value="">Select Option</option><option value="Yes">Yes</option> <option value="No">No</option> </select></div></section></td>';
          addhtmlnxt+='<td><div class="input"><select id="d1ques3" name="d1ques3[]" class="form_fields form-control col-md-7 col-xs-12"  ><option value="">Select Option</option><option value="Yes">Yes</option> <option value="No">No</option> </select></div></section></td>';
          addhtmlnxt +='</tr>';
          addhtmlnxt +='</table>';

           addhtmlnxt += '</div>';

      
         website('.appenddiv1').append(addhtmlnxt);
       
         website('.appendd1').attr('plancntr',getlastid);
      }
      else if(id == 'adddiv2'){
      
       var getlastid = website('.appendd2').attr('plancntr');

         getlastid = ++getlastid;
         var addhtmlnxt='';
          addhtmlnxt += '<div class="row'+getlastid+' append_row3" style="padding-bottom:20px;" id="row'+getlastid+'" >';
          addhtmlnxt += '<table style="border-collapse: collapse; border: 1px solid #ccc" width="100%" border="1">';
          addhtmlnxt += '<tr>';
          addhtmlnxt += ' <td style="border-right: 1px solid #fff"></td>';
          addhtmlnxt += '<td style="width: 22%"><label class="control-label">Firm Name</label>';
          addhtmlnxt += '</td>';
            addhtmlnxt += '<td><label class="control-label">Nature of Interest</label>';
          addhtmlnxt += '</td>';
          addhtmlnxt += '<td><label class="control-label">Can you significantly influence the decision making of this firm?</label>';
            addhtmlnxt +='</td>';
          addhtmlnxt += '<td><label class="control-label">Do this firm have any commercial or financial transactions with Dr. Reddys Laboratories Limited or any of its group company/subsidiary?</label>';
        
        
          addhtmlnxt += '</td>';
          addhtmlnxt +='</tr>';
          addhtmlnxt += '<tr>';
          addhtmlnxt += '<td style="border-right: 1px solid #fff"></td>';

        
         addhtmlnxt += '<td><div class="input">  <input type="text" class="form-control inputbox4" id="d2ques1" name="d2ques1[]" >  </div></td> ';
         addhtmlnxt+=' <td><div class="input">  <input type="text" class="form-control inputbox4" id="d2ques2" name="d2ques2[]" ></div></td>';
          addhtmlnxt+='<td> <div class="input"> <select id="d2ques3" name="d2ques3[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4"  ><option value="">Select Option </option> <option value="Yes">Yes</option> <option value="No">No</option> </select></div></td>';
          addhtmlnxt+=' <td><div class="input">   <select id="d2ques4" name="d2ques4[]" class="form_fields form-control col-md-7 col-xs-12" ><option value="">Select Option</option><option value="Yes">Yes</option> <option value="No">No</option> </select></div></td>';
          addhtmlnxt +='</tr>';
          addhtmlnxt +='</table>';
         addhtmlnxt += '</div>';

      
         website('.appenddiv2').append(addhtmlnxt);
       
        website('.appendd2').attr('plancntr',getlastid);



      } else if(id == 'adddiv3'){
      
       var getlastid = website('.appendd3').attr('plancntr');

         getlastid = ++getlastid;
         var addhtmlnxt='';
       
         addhtmlnxt += '<div class="row'+getlastid+' append_row3" style="padding-bottom:20px;" id="row'+getlastid+'" >';
          addhtmlnxt += '<table style="border-collapse: collapse; border: 1px solid #ccc" width="100%" border="1">';
          addhtmlnxt += '<tr>';
          addhtmlnxt += ' <td style="border-right: 1px solid #fff"></td>';
          addhtmlnxt += '<td style="width: 22%"><label class="control-label">Company Name</label>';
          addhtmlnxt += '</td>';
            addhtmlnxt += '<td><label class="control-label">Nature of Interest</label>';
          addhtmlnxt += '</td>';
          addhtmlnxt += '<td><label class="control-label">Can you significantly influence the decision making of this company?</label>';
            addhtmlnxt +='</td>';
          addhtmlnxt += '<td><label class="control-label">Do this company have any commercial or financial transactions with Dr. Reddys Laboratories Limited or any of its group company/subsidiary?</label>';
        
        
          addhtmlnxt += '</td>';
          addhtmlnxt +='</tr>';
          addhtmlnxt += '<tr>';
          addhtmlnxt += '<td style="border-right: 1px solid #fff"></td>';

        
         addhtmlnxt += '<td><div class="input">  <input type="text" class="form-control inputbox4" id="d3ques1" name="d3ques1[]" >  </div></td> ';
         addhtmlnxt+=' <td><div class="input">  <input type="text" class="form-control inputbox4" id="d3ques2" name="d3ques2[]" ></div></td>';
          addhtmlnxt+='<td> <div class="input"> <select id="d3ques3" name="d3ques3[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4"  ><option value="">Select Option </option> <option value="Yes">Yes</option> <option value="No">No</option> </select></div></td>';
          addhtmlnxt+=' <td><div class="input">   <select id="d3ques4" name="d3ques4[]" class="form_fields form-control col-md-7 col-xs-12" ><option value="">Select Option</option><option value="Yes">Yes</option> <option value="No">No</option> </select></div></td>';
          addhtmlnxt +='</tr>';
          addhtmlnxt +='</table>';
        
         addhtmlnxt += '</div>';

      
         website('.appenddiv3').append(addhtmlnxt);
       
        website('.appendd3').attr('plancntr',getlastid);



      }

      else if(id == 'adddiv4'){
      
       var getlastid = website('.appendd4').attr('plancntr');

         getlastid = ++getlastid;
         var addhtmlnxt='';
       
         addhtmlnxt += '<div class="row'+getlastid+' append_row3" style="padding-bottom:20px;" id="row'+getlastid+'" >';
         addhtmlnxt += '<table style="border-collapse: collapse; border: 1px solid #ccc" width="100%" border="1">';
          addhtmlnxt += '<tr>';
          addhtmlnxt += ' <td style="border-right: 1px solid #fff"></td>';
          addhtmlnxt += '<td style="width: 22%"><label class="control-label">Company Name</label>';
          addhtmlnxt += '</td>';
            addhtmlnxt += '<td><label class="control-label">Nature of Interest</label>';
          addhtmlnxt += '</td>';
          addhtmlnxt += '<td><label class="control-label">Can you significantly influence the decision making of this company?</label>';
            addhtmlnxt +='</td>';
          addhtmlnxt += '<td><label class="control-label">Do this company have any commercial or financial transactions with Dr. Reddys Laboratories Limited or any of its group company/subsidiary?</label>';
        
        
          addhtmlnxt += '</td>';
          addhtmlnxt +='</tr>';
          addhtmlnxt += '<tr>';
          addhtmlnxt += '<td style="border-right: 1px solid #fff"></td>';

        
         addhtmlnxt += '<td><div class="input">  <input type="text" class="form-control inputbox4" id="d4ques1" name="d4ques1[]" >  </div></td> ';
         addhtmlnxt+=' <td><div class="input">  <input type="text" class="form-control inputbox4" id="d4ques2" name="d4ques2[]" ></div></td>';
          addhtmlnxt+='<td> <div class="input"> <select id="d4ques3" name="d4ques3[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4"  ><option value="">Select Option </option> <option value="Yes">Yes</option> <option value="No">No</option> </select></div></td>';
          addhtmlnxt+=' <td><div class="input">   <select id="d4ques4" name="d4ques4[]" class="form_fields form-control col-md-7 col-xs-12" ><option value="">Select Option</option><option value="Yes">Yes</option> <option value="No">No</option> </select></div></td>';
          addhtmlnxt +='</tr>';
          addhtmlnxt +='</table>';
        
       
         addhtmlnxt += '</div>';

      
         website('.appenddiv4').append(addhtmlnxt);
       
        website('.appendd4').attr('plancntr',getlastid);



      }
       else if(id == 'adddiv5')
       {
       console.log(response.resdta);
       var getlastid = website('.appendd5').attr('plancntr');

         getlastid = ++getlastid;
         var addhtmlnxt='';
       
         addhtmlnxt += '<div class="row'+getlastid+' append_row3" style="padding-bottom:20px;" id="row'+getlastid+'" >';
         addhtmlnxt += '<table style="border-collapse: collapse; border: 1px solid #ccc" width="100%" border="1">';
          addhtmlnxt += '<tr>';
          addhtmlnxt += ' <td style="border-right: 1px solid #fff"></td>';
          addhtmlnxt += '<td style="width: 20%"><label class="control-label">Relative Name</label>';
          addhtmlnxt += '</td style="width: 22%">';
            addhtmlnxt += '<td><label class="control-label">Company Name</label>';
          addhtmlnxt += '</td>';
          addhtmlnxt += '<td><label class="control-label">Can this relative significantly influence the decision making of this company?</label>';
            addhtmlnxt +='</td>';
          addhtmlnxt += '<td><label class="control-label">Do this company have any commercial or financial transactions with Dr. Reddys Laboratories Limited or any of its group company/subsidiary?</label>';
        
        
          addhtmlnxt += '</td>';
          addhtmlnxt +='</tr>';
          addhtmlnxt += '<tr>';
          addhtmlnxt += '<td style="border-right: 1px solid #fff"></td>';

        
         addhtmlnxt += '<td><div class="input"> <select id="d5ques1" name="d5ques1[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4"  >';
           addhtmlnxt +='<option value="">Select Option </option>';   
          website.each(response.resdta, function (index, value) {

                addhtmlnxt += '<option value='+value['name']+'>'+value['name']+'</option>';    

              });
        
        
         //addhtmlnxt+=' <option value="Yes">Yes</option> <option value="No">No</option>';
         addhtmlnxt+=' </select>  </div></td> ';
         addhtmlnxt+=' <td><div class="input">  <input type="text" class="form-control inputbox4" id="d5ques2" name="d5ques2[]" ></div></td>';
          addhtmlnxt+='<td> <div class="input"> <select id="d5ques3" name="d5ques3[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4"  ><option value="">Select Option </option> <option value="Yes">Yes</option> <option value="No">No</option> </select></div></td>';
          addhtmlnxt+=' <td><div class="input">   <select id="d5ques4" name="d5ques4[]" class="form_fields form-control col-md-7 col-xs-12" ><option value="">Select Option</option><option value="Yes">Yes</option> <option value="No">No</option> </select></div></td>';
          addhtmlnxt +='</tr>';
          addhtmlnxt +='</table>';
        
         addhtmlnxt += '</div>';

      
         website('.appenddiv5').append(addhtmlnxt);
       
        website('.appendd5').attr('plancntr',getlastid);



      }


       else if(id == 'adddiv6')
       {
      
       var getlastid = website('.appendd6').attr('plancntr');

         getlastid = ++getlastid;
         var addhtmlnxt='';
       
        addhtmlnxt += '<div class="row'+getlastid+' append_row3" style="padding-bottom:20px;" id="row'+getlastid+'" >';
         addhtmlnxt += '<table style="border-collapse: collapse; border: 1px solid #ccc" width="100%" border="1">';
          addhtmlnxt += '<tr>';
          addhtmlnxt += ' <td style="border-right: 1px solid #fff"></td>';
          addhtmlnxt += '<td style="width: 20%"><label class="control-label">Relative Name</label>';
          addhtmlnxt += '</td>';
            addhtmlnxt += '<td style="width: 22%"><label class="control-label">Firm Name</label>';
          addhtmlnxt += '</td>';

           addhtmlnxt += '<td><label class="control-label">Nature of interest</label>';
          addhtmlnxt += '</td>';
          addhtmlnxt += '<td><label class="control-label">Can this relative significantly influence the decision making of this firm?</label>';
            addhtmlnxt +='</td>';
          addhtmlnxt += '<td><label class="control-label">Do this firm have any commercial or financial transactions with Dr. Reddys Laboratories Limited or any of its group company/subsidiary?</label>';
        
        
          addhtmlnxt += '</td>';
          addhtmlnxt +='</tr>';
          addhtmlnxt += '<tr>';
          addhtmlnxt += '<td style="border-right: 1px solid #fff"></td>';

        addhtmlnxt += '<td><div class="input"> <select id="d6ques1" name="d6ques1[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4"  >';
           addhtmlnxt +='<option value="">Select Option </option>';   
          website.each(response.resdta, function (index, value) {

                addhtmlnxt += '<option value='+value['name']+'>'+value['name']+'</option>';    

              });
         //addhtmlnxt += '<td><div class="input">  <select id="d6ques1" name="d6ques1[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4"  ><option value="">Select Option </option> <option value="Yes">Yes</option> <option value="No">No</option> </select>  </div></td> ';
         addhtmlnxt+=' <td><div class="input">  <input type="text" class="form-control inputbox4" id="d6ques2" name="d6ques2[]" ></div></td>';
          addhtmlnxt+=' <td><div class="input">  <input type="text" class="form-control inputbox4" id="d6ques2" name="d6ques2[]" ></div></td>';
          addhtmlnxt+='<td> <div class="input"> <select id="d6ques3" name="d6ques3[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4"  ><option value="">Select Option </option> <option value="Yes">Yes</option> <option value="No">No</option> </select></div></td>';
          addhtmlnxt+=' <td><div class="input">   <select id="d6ques4" name="d6ques4[]" class="form_fields form-control col-md-7 col-xs-12" ><option value="">Select Option</option><option value="Yes">Yes</option> <option value="No">No</option> </select></div></td>';
          addhtmlnxt +='</tr>';
          addhtmlnxt +='</table>';
        
        addhtmlnxt += '</div>';

      
         website('.appenddiv6').append(addhtmlnxt);
       
        website('.appendd6').attr('plancntr',getlastid);

      }


       else if(id == 'adddiv7')
       {
      
       var getlastid = website('.appendd7').attr('plancntr');

         getlastid = ++getlastid;
         var addhtmlnxt='';
       
        addhtmlnxt += '<div class="row'+getlastid+' append_row3" style="padding-bottom:20px;" id="row'+getlastid+'" >';
       addhtmlnxt += '<table style="border-collapse: collapse; border: 1px solid #ccc" width="100%" border="1">';
          addhtmlnxt += '<tr>';
          addhtmlnxt += ' <td style="border-right: 1px solid #fff"></td>';
          addhtmlnxt += '<td style="width: 20%"><label class="control-label">Relative Name</label>';
          addhtmlnxt += '</td>';
            addhtmlnxt += '<td style="width: 20%"><label class="control-label">Company Name</label>';
          addhtmlnxt += '</td>';

           addhtmlnxt += '<td><label class="control-label">Nature of interest</label>';
          addhtmlnxt += '</td>';
          addhtmlnxt += '<td><label class="control-label">Can this relative significantly influence the decision making of this company?</label>';
            addhtmlnxt +='</td>';
          addhtmlnxt += '<td><label class="control-label">Do this company have any commercial or financial transactions with Dr. Reddys Laboratories Limited or any of its group company/subsidiary?</label>';
        
        
          addhtmlnxt += '</td>';
          addhtmlnxt +='</tr>';
          addhtmlnxt += '<tr>';
          addhtmlnxt += '<td style="border-right: 1px solid #fff"></td>';

        addhtmlnxt += '<td><div class="input"> <select id="d7ques1" name="d7ques1[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4"  >';
        addhtmlnxt += '<option value="">Select Option </option>';   
          website.each(response.resdta, function (index, value) {

                addhtmlnxt += '<option value='+value['name']+'>'+value['name']+'</option>';    

              });
         //addhtmlnxt += '<td><div class="input">  <select id="d7ques1" name="d7ques1[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4"  ><option value="">Select Option </option> <option value="Yes">Yes</option> <option value="No">No</option> </select>  </div></td> ';
         addhtmlnxt+=' <td><div class="input">  <input type="text" class="form-control inputbox4" id="d7ques2" name="d7ques2[]" ></div></td>';
          addhtmlnxt+=' <td><div class="input">  <input type="text" class="form-control inputbox4" id="d7ques2" name="d7ques2[]" ></div></td>';
          addhtmlnxt+='<td> <div class="input"> <select id="d7ques3" name="d7ques3[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4"  ><option value="">Select Option </option> <option value="Yes">Yes</option> <option value="No">No</option> </select></div></td>';
          addhtmlnxt+=' <td><div class="input">   <select id="d7ques4" name="d7ques4[]" class="form_fields form-control col-md-7 col-xs-12" ><option value="">Select Option</option><option value="Yes">Yes</option> <option value="No">No</option> </select></div></td>';
          addhtmlnxt +='</tr>';
          addhtmlnxt +='</table>';
      
         addhtmlnxt += '</div>';

      
         website('.appenddiv7').append(addhtmlnxt);
       
         website('.appendd7').attr('plancntr',getlastid);



      }

      else{
      
       var addhtmlnxt='';
      
      }
       },
        complete: function(response)
        {},
        error: function(jqXHR, textStatus, errorThrown)
        {}
    });

}

function removehtml(clicked)
 {

    var rmid = clicked;

    if(rmid == 'remvdiv1')
    {

        
        var count = website('.appendd1').attr('plancntr');

        if(count != 0)
        {
             //alert(count);
              website('#row'+count).remove();
              website('.appendd1').attr('plancntr',parseInt(count)-1);
             
        }
        else
        {
             return false;
        }

    }else if(rmid == 'remvdiv2'){

        var count = website('.appendd2').attr('plancntr');
        if(count != 0)
        { 
              website('#row'+count).remove();
              website('.appendd2').attr('plancntr',parseInt(count)-1);
        }
        else
        {
             return false;
        }
    }else if(rmid == 'remvdiv3'){


       var count = website('.appendd3').attr('plancntr');
        if(count != 1)
        {
              website('.appenddiv3 #row'+count).remove();
              website('.appendd3').attr('plancntr',parseInt(count)-1);
        }
        else
        {
             return false;
        }
    }else if(rmid == 'remvdiv4'){


       var count = website('.appendd4').attr('plancntr');
        if(count != 1)
        {
              website('.appenddiv4 #row'+count).remove();
              website('.appendd4').attr('plancntr',parseInt(count)-1);
        }
        else
        {
             return false;
        }
    }else if(rmid == 'remvdiv5'){

      var count = website('.appendd5').attr('plancntr');
        if(count != 1)
        {
              website('.appenddiv5 #row'+count).remove();
              website('.appendd5').attr('plancntr',parseInt(count)-1);
        }
        else
        {
             return false;
        }
    }else if(rmid == 'remvdiv6'){

      var count = website('.appendd6').attr('plancntr');
        if(count != 1)
        {
              website('.appenddiv6 #row'+count).remove();
              website('.appendd6').attr('plancntr',parseInt(count)-1);
        }
        else
        {
             return false;
        }
    }else if(rmid == 'remvdiv7'){



      var count = website('.appendd7').attr('plancntr');
        if(count != 1)
        {
              website('.appenddiv7 #row'+count).remove();
              website('.appendd7').attr('plancntr',parseInt(count)-1);
        }
        else
        {
             return false;
        }
    }else{

     return false;

    }


}


 website('#updateannual').ajaxForm({

    
      
      //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
      dataType:"json",
      beforeSend: function()
      {    website('.preloder_wraper').fadeIn();
           

       },
      uploadProgress: function(event, position, total, percentComplete)
      {  website('.preloder_wraper').fadeIn(); },
      success: function(response, textStatus, jqXHR)
      {
        //console.log(response);return false;
        if(response.logged == true)
        {  

           new PNotify({ title: 'Record Updated Successfully',
            text: response.message,
            type: 'university',
            hide: true,
            styling: 'bootstrap3',
            addclass: 'dark ',

          });
           
            window.location.reload();
         
        }else{
           new PNotify({title: 'Record Not Updated Successfully',
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




function numberOnly() 
{
            var charCode = event.keyCode;
    
            if ((charCode > 47 && charCode < 58) || charCode == 46)

                return true;
            else
                return false;
}