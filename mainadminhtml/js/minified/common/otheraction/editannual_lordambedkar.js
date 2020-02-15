
website(document).ready(function()
{loadnoofsec();});function addhtml(clicked)
{website.ajax({url:'annualdeclaration/fetchrelative',method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{var id=clicked;if(id=='adddiv1'){var getlastid=website('.appendd1').attr('plancntr');getlastid=++getlastid;var addhtmlnxt='';addhtmlnxt+='<div class="row'+getlastid+' append_row3" id="t1row'+getlastid+'"   >';addhtmlnxt+='<table  style="border-collapse: collapse; border: 1px solid #ccc" width="100%" border="1">';addhtmlnxt+='<tr>';addhtmlnxt+=' <td style="border-right: 1px solid #f7f7f7;width: 2.5%"></td>';addhtmlnxt+='<td style="width: 22%"><label class="control-label">Company Name</label>';addhtmlnxt+='</td>';addhtmlnxt+='<td><label class="control-label">Can you significantly influence the decision making of this company?</label>';addhtmlnxt+='</td>';addhtmlnxt+='<td><label class="control-label">Do this company have any commercial or financial transactions with Dr. Reddys Laboratories Limited or any of its group company/subsidiary?</label>';addhtmlnxt+='</td>';addhtmlnxt+='</tr>';addhtmlnxt+='<tr>';addhtmlnxt+=' <td style="border-right: 1px solid #fff"></td>';addhtmlnxt+='<td><div class="input" > <input type="text" class="form-control inputbox3" id="d1ques1" name="d1ques1[]" >  </div>';addhtmlnxt+='</td>';addhtmlnxt+=' <td><div class="input"><select id="d1ques2" name="d1ques2[]" class="form_fields form-control col-md-7 col-xs-12"  > <option value="">Select Option</option><option value="Yes">Yes</option> <option value="No">No</option> </select></div></section></td>';addhtmlnxt+='<td><div class="input"><select id="d1ques3" name="d1ques3[]" class="form_fields form-control col-md-7 col-xs-12"  ><option value="">Select Option</option><option value="Yes">Yes</option> <option value="No">No</option> </select></div></section></td>';addhtmlnxt+='</tr>';addhtmlnxt+='</table>';addhtmlnxt+='</div>';website('.appenddiv1').append(addhtmlnxt);website('.appendd1').attr('plancntr',getlastid);}
else if(id=='adddiv2'){var getlastid=website('.appendd2').attr('plancntr');getlastid=++getlastid;var addhtmlnxt='';addhtmlnxt+='<div class="row'+getlastid+' append_row3" style="padding-bottom:20px;" id="t2row'+getlastid+'" >';addhtmlnxt+='<table style="border-collapse: collapse; border: 1px solid #ccc" width="100%" border="1">';addhtmlnxt+='<tr>';addhtmlnxt+=' <td style="border-right: 1px solid #fff;width:2.0%;"></td>';addhtmlnxt+='<td style="width: 22%"><label class="control-label">Firm Name</label>';addhtmlnxt+='</td>';addhtmlnxt+='<td style="width: 15%"><label class="control-label">Nature of Interest</label>';addhtmlnxt+='</td>';addhtmlnxt+='<td><label class="control-label">Can you significantly influence the decision making of this firm?</label>';addhtmlnxt+='</td>';addhtmlnxt+='<td><label class="control-label">Do this firm have any commercial or financial transactions with Dr. Reddys Laboratories Limited or any of its group company/subsidiary?</label>';addhtmlnxt+='</td>';addhtmlnxt+='</tr>';addhtmlnxt+='<tr>';addhtmlnxt+='<td style="border-right: 1px solid #fff"></td>';addhtmlnxt+='<td><div class="input">  <input type="text" class="form-control inputbox4" id="d2ques1" name="d2ques1[]" >  </div></td> ';addhtmlnxt+=' <td><div class="input">  <input type="text" class="form-control inputbox4" id="d2ques2" name="d2ques2[]" value="Partner" readonly="readonly"></div></td>';addhtmlnxt+='<td> <div class="input"> <select id="d2ques3" name="d2ques3[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4"  ><option value="">Select Option </option> <option value="Yes">Yes</option> <option value="No">No</option> </select></div></td>';addhtmlnxt+=' <td><div class="input">   <select id="d2ques4" name="d2ques4[]" class="form_fields form-control col-md-7 col-xs-12" ><option value="">Select Option</option><option value="Yes">Yes</option> <option value="No">No</option> </select></div></td>';addhtmlnxt+='</tr>';addhtmlnxt+='</table>';addhtmlnxt+='</div>';website('.appenddiv2').append(addhtmlnxt);website('.appendd2').attr('plancntr',getlastid);}else if(id=='adddiv3'){var getlastid=website('.appendd3').attr('plancntr');getlastid=++getlastid;var addhtmlnxt='';addhtmlnxt+='<div class="row'+getlastid+' append_row3" style="padding-bottom:20px;" id="t3row'+getlastid+'" >';addhtmlnxt+='<table style="border-collapse: collapse; border: 1px solid #ccc" width="100%" border="1">';addhtmlnxt+='<tr>';addhtmlnxt+=' <td style="border-right: 1px solid #fff;width:2.5%"></td>';addhtmlnxt+='<td style="width: 22%"><label class="control-label">Company Name</label>';addhtmlnxt+='</td>';addhtmlnxt+='<td style="width: 15%"><label class="control-label">Nature of Interest</label>';addhtmlnxt+='</td>';addhtmlnxt+='<td style="width: 15%"><label class="control-label">No. of shares held</label>';addhtmlnxt+='</td>';addhtmlnxt+='<td><label class="control-label">Can you significantly influence the decision making of this company?</label>';addhtmlnxt+='</td>';addhtmlnxt+='<td><label class="control-label">Do this company have any commercial or financial transactions with Dr. Reddys Laboratories Limited or any of its group company/subsidiary?</label>';addhtmlnxt+='</td>';addhtmlnxt+='</tr>';addhtmlnxt+='<tr>';addhtmlnxt+='<td style="border-right: 1px solid #fff"></td>';addhtmlnxt+='<td><div class="input">  <input type="text" class="form-control inputbox4" id="d3ques1" name="d3ques1[]" >  </div></td> ';addhtmlnxt+=' <td><div class="input">  <select class="form-control inputbox4" id="d3ques2" rownum="t3row'+getlastid+'" name="d3ques2[]"><option value="">Select Option</option><option value="1">Member</option><option value="2">Director</option><option value="3">Member And Director</option></select></div></td>';addhtmlnxt+='<td><input type="text" class="form-control inputbox4" id="d3ques5" name="d3ques5[]" ></td>';addhtmlnxt+='<td> <div class="input"> <select id="d3ques3" name="d3ques3[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4"  ><option value="">Select Option </option> <option value="Yes">Yes</option> <option value="No">No</option> </select></div></td>';addhtmlnxt+=' <td><div class="input">   <select id="d3ques4" name="d3ques4[]" class="form_fields form-control col-md-7 col-xs-12" ><option value="">Select Option</option><option value="Yes">Yes</option> <option value="No">No</option> </select></div></td>';addhtmlnxt+='</tr>';addhtmlnxt+='</table>';addhtmlnxt+='</div>';website('.appenddiv3').append(addhtmlnxt);website('.appendd3').attr('plancntr',getlastid);loadnoofsec();}
else if(id=='adddiv4'){var getlastid=website('.appendd4').attr('plancntr');getlastid=++getlastid;var addhtmlnxt='';addhtmlnxt+='<div class="row'+getlastid+' append_row3" style="padding-bottom:20px;" id="t4row'+getlastid+'" >';addhtmlnxt+='<table style="border-collapse: collapse; border: 1px solid #ccc" width="100%" border="1">';addhtmlnxt+='<tr>';addhtmlnxt+=' <td style="border-right: 1px solid #fff;width:2.0%"></td>';addhtmlnxt+='<td style="width: 22%"><label class="control-label">Company Name</label>';addhtmlnxt+='</td>';addhtmlnxt+='<td style="width: 15%"><label class="control-label">Nature of Interest</label>';addhtmlnxt+='</td>';addhtmlnxt+='<td><label class="control-label">Can you significantly influence the decision making of this company?</label>';addhtmlnxt+='</td>';addhtmlnxt+='<td><label class="control-label">Do this company have any commercial or financial transactions with Dr. Reddys Laboratories Limited or any of its group company/subsidiary?</label>';addhtmlnxt+='</td>';addhtmlnxt+='</tr>';addhtmlnxt+='<tr>';addhtmlnxt+='<td style="border-right: 1px solid #fff"></td>';addhtmlnxt+='<td><div class="input">  <input type="text" class="form-control inputbox4" id="d4ques1" name="d4ques1[]" >  </div></td> ';addhtmlnxt+=' <td><div class="input">  <input type="text" class="form-control inputbox4" id="d4ques2" name="d4ques2[]" value = "holding above 2% shares" readonly="readonly"></div></td>';addhtmlnxt+='<td> <div class="input"> <select id="d4ques3" name="d4ques3[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4"  ><option value="">Select Option </option> <option value="Yes">Yes</option> <option value="No">No</option> </select></div></td>';addhtmlnxt+=' <td><div class="input">   <select id="d4ques4" name="d4ques4[]" class="form_fields form-control col-md-7 col-xs-12" ><option value="">Select Option</option><option value="Yes">Yes</option> <option value="No">No</option> </select></div></td>';addhtmlnxt+='</tr>';addhtmlnxt+='</table>';addhtmlnxt+='</div>';website('.appenddiv4').append(addhtmlnxt);website('.appendd4').attr('plancntr',getlastid);}
else if(id=='adddiv5')
{console.log(response.resdta);var getlastid=website('.appendd5').attr('plancntr');getlastid=++getlastid;var addhtmlnxt='';addhtmlnxt+='<div class="row'+getlastid+' append_row3" style="padding-bottom:20px;" id="t5row'+getlastid+'" >';addhtmlnxt+='<table style="border-collapse: collapse; border: 1px solid #ccc" width="100%" border="1">';addhtmlnxt+='<tr>';addhtmlnxt+=' <td style="border-right: 1px solid #fff;width:2.0%"></td>';addhtmlnxt+='<td style="width: 20%"><label class="control-label">Relative Name</label>';addhtmlnxt+='</td >';addhtmlnxt+='<td style="width: 22%"><label class="control-label">Company Name</label>';addhtmlnxt+='</td>';addhtmlnxt+='<td><label class="control-label">Can this relative significantly influence the decision making of this company?</label>';addhtmlnxt+='</td>';addhtmlnxt+='<td><label class="control-label">Do this company have any commercial or financial transactions with Dr. Reddys Laboratories Limited or any of its group company/subsidiary?</label>';addhtmlnxt+='</td>';addhtmlnxt+='</tr>';addhtmlnxt+='<tr>';addhtmlnxt+='<td style="border-right: 1px solid #fff"></td>';addhtmlnxt+='<td><div class="input"> <select id="d5ques1" name="d5ques1[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4"  >';addhtmlnxt+='<option value="">Select Option </option>';website.each(response.resdta,function(index,value){addhtmlnxt+='<option value='+value['name']+'>'+value['name']+'</option>';});addhtmlnxt+=' </select>  </div></td> ';addhtmlnxt+=' <td><div class="input">  <input type="text" class="form-control inputbox4" id="d5ques2" name="d5ques2[]" ></div></td>';addhtmlnxt+='<td> <div class="input"> <select id="d5ques3" name="d5ques3[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4"  ><option value="">Select Option </option> <option value="Yes">Yes</option> <option value="No">No</option> </select></div></td>';addhtmlnxt+=' <td><div class="input">   <select id="d5ques4" name="d5ques4[]" class="form_fields form-control col-md-7 col-xs-12" ><option value="">Select Option</option><option value="Yes">Yes</option> <option value="No">No</option> </select></div></td>';addhtmlnxt+='</tr>';addhtmlnxt+='</table>';addhtmlnxt+='</div>';website('.appenddiv5').append(addhtmlnxt);website('.appendd5').attr('plancntr',getlastid);}
else if(id=='adddiv6')
{var getlastid=website('.appendd6').attr('plancntr');getlastid=++getlastid;var addhtmlnxt='';addhtmlnxt+='<div class="row'+getlastid+' append_row3" style="padding-bottom:20px;" id="t6row'+getlastid+'" >';addhtmlnxt+='<table style="border-collapse: collapse; border: 1px solid #ccc" width="100%" border="1">';addhtmlnxt+='<tr>';addhtmlnxt+=' <td style="border-right: 1px solid #fff;width:2.5%"></td>';addhtmlnxt+='<td style="width: 20%"><label class="control-label">Relative Name</label>';addhtmlnxt+='</td>';addhtmlnxt+='<td style="width: 20%"><label class="control-label">Firm Name</label>';addhtmlnxt+='</td>';addhtmlnxt+='<td style="width: 15%"><label class="control-label">Nature of interest</label>';addhtmlnxt+='</td>';addhtmlnxt+='<td><label class="control-label">Can this relative significantly influence the decision making of this firm?</label>';addhtmlnxt+='</td>';addhtmlnxt+='<td><label class="control-label">Do this firm have any commercial or financial transactions with Dr. Reddys Laboratories Limited or any of its group company/subsidiary?</label>';addhtmlnxt+='</td>';addhtmlnxt+='</tr>';addhtmlnxt+='<tr>';addhtmlnxt+='<td style="border-right: 1px solid #fff"></td>';addhtmlnxt+='<td><div class="input"> <select id="d6ques1" name="d6ques1[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4"  >';addhtmlnxt+='<option value="">Select Option </option>';website.each(response.resdta,function(index,value){addhtmlnxt+='<option value='+value['name']+'>'+value['name']+'</option>';});addhtmlnxt+=' <td><div class="input">  <input type="text" class="form-control inputbox4" id="d6ques2" name="d6ques2[]" ></div></td>';addhtmlnxt+=' <td><div class="input">  <input type="text" class="form-control inputbox4" id="d6ques3" name="d6ques3[]" value="Partner" readonly="readonly"></div></td>';addhtmlnxt+='<td> <div class="input"> <select id="d6ques4" name="d6ques4[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4"  ><option value="">Select Option </option> <option value="Yes">Yes</option> <option value="No">No</option> </select></div></td>';addhtmlnxt+=' <td><div class="input">   <select id="d6ques5" name="d6ques5[]" class="form_fields form-control col-md-7 col-xs-12" ><option value="">Select Option</option><option value="Yes">Yes</option> <option value="No">No</option> </select></div></td>';addhtmlnxt+='</tr>';addhtmlnxt+='</table>';addhtmlnxt+='</div>';website('.appenddiv6').append(addhtmlnxt);website('.appendd6').attr('plancntr',getlastid);}
else if(id=='adddiv7')
{var getlastid=website('.appendd7').attr('plancntr');getlastid=++getlastid;var addhtmlnxt='';addhtmlnxt+='<div class="row'+getlastid+' append_row3" style="padding-bottom:20px;" id="t7row'+getlastid+'" >';addhtmlnxt+='<table style="border-collapse: collapse; border: 1px solid #ccc" width="100%" border="1">';addhtmlnxt+='<tr>';addhtmlnxt+=' <td style="border-right: 1px solid #fff;width:2.5%"></td>';addhtmlnxt+='<td style="width: 20%"><label class="control-label">Relative Name</label>';addhtmlnxt+='</td>';addhtmlnxt+='<td style="width: 20%"><label class="control-label">Company Name</label>';addhtmlnxt+='</td>';addhtmlnxt+='<td style="width: 15%"><label class="control-label">Nature of interest</label>';addhtmlnxt+='</td>';addhtmlnxt+='<td><label class="control-label">No. of shares held</label>';addhtmlnxt+='</td>';addhtmlnxt+='<td><label class="control-label">Can this relative significantly influence the decision making of this company?</label>';addhtmlnxt+='</td>';addhtmlnxt+='<td><label class="control-label">Do this company have any commercial or financial transactions with Dr. Reddys Laboratories Limited or any of its group company/subsidiary?</label>';addhtmlnxt+='</td>';addhtmlnxt+='</tr>';addhtmlnxt+='<tr>';addhtmlnxt+='<td style="border-right: 1px solid #fff"></td>';addhtmlnxt+='<td><div class="input"> <select id="d7ques1" name="d7ques1[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4"  >';addhtmlnxt+='<option value="">Select Option </option>';website.each(response.resdta,function(index,value){addhtmlnxt+='<option value='+value['name']+'>'+value['name']+'</option>';});addhtmlnxt+=' <td><div class="input">  <input type="text" class="form-control inputbox4" id="d7ques2" name="d7ques2[]" ></div></td>';addhtmlnxt+=' <td><div class="input">  <select class="form-control inputbox4" id="d7ques6" rownum="t7row'+getlastid+'" name="d7ques6[]"><option value="">Select Option</option><option value="1">Member</option><option value="2">Director</option><option value="3">Member And Director</option></select></div></td>';addhtmlnxt+=' <td><input type="text" class="form-control inputbox4" id="d7ques5" name="d7ques5[]" ></td>';addhtmlnxt+='<td> <div class="input"> <select id="d7ques3" name="d7ques3[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4"  ><option value="">Select Option </option> <option value="Yes">Yes</option> <option value="No">No</option> </select></div></td>';addhtmlnxt+=' <td><div class="input">   <select id="d7ques4" name="d7ques4[]" class="form_fields form-control col-md-7 col-xs-12" ><option value="">Select Option</option><option value="Yes">Yes</option> <option value="No">No</option> </select></div></td>';addhtmlnxt+='</tr>';addhtmlnxt+='</table>';addhtmlnxt+='</div>';website('.appenddiv7').append(addhtmlnxt);website('.appendd7').attr('plancntr',getlastid);loadnoofsec();}
else if(id=='adddiv8')
{var getlastid=website('.appendd8').attr('plancntr');getlastid=++getlastid;var addhtmlnxt='';addhtmlnxt+='<div class="row'+getlastid+' append_row3" style="padding-bottom:20px;" id="row'+getlastid+'" >';addhtmlnxt+='<table style="border-collapse: collapse; border: 1px solid #ccc" width="100%" border="1">';addhtmlnxt+='<tr>';addhtmlnxt+=' <td style="border-right: 1px solid #f7f7f7;width:2.5%; "></td>';addhtmlnxt+='<td style="width: 22%"><label class="control-label">Company Name</label>';addhtmlnxt+='</td>';addhtmlnxt+='<td style="width: 16%"><label class="control-label">Can you significantly influence the decision making of this company?</label>';addhtmlnxt+='</td>';addhtmlnxt+="<td><label class='control-label'>Do this company have any commercial or financial transactions with Dr. Reddy's Laboratories Limited or any of its group company/subsidiary?</label>";addhtmlnxt+='</td>';addhtmlnxt+='</td>';addhtmlnxt+='</tr>';addhtmlnxt+='<tr>';addhtmlnxt+='<td style="border-right: 1px solid #f7f7f7;width:2.5%"></td>';addhtmlnxt+=' <td><div class="input">  <input type="text" class="form-control inputbox4" id="d8ques1" name="d8ques1[]" ></div></td>';addhtmlnxt+='<td> <div class="input"> <select id="d8ques2" name="d8ques2[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4"  ><option value="">Select Option </option> <option value="Yes">Yes</option> <option value="No">No</option> </select></div></td>';addhtmlnxt+=' <td><div class="input">   <select id="d8ques3" name="d8ques3[]" class="form_fields form-control col-md-7 col-xs-12" ><option value="">Select Option</option><option value="Yes">Yes</option> <option value="No">No</option> </select></div></td>';addhtmlnxt+='</tr>';addhtmlnxt+='</table>';addhtmlnxt+='</div>';website('.appenddiv8').append(addhtmlnxt);website('.appendd8').attr('plancntr',getlastid);}
else if(id=='adddiv9')
{var getlastid=website('.appendd9').attr('plancntr');getlastid=++getlastid;var addhtmlnxt='';addhtmlnxt+='<div class="row'+getlastid+' append_row3" style="padding-bottom:20px;" id="row'+getlastid+'" >';addhtmlnxt+='<table style="border-collapse: collapse; border: 1px solid #ccc" width="100%" border="1">';addhtmlnxt+='<tr>';addhtmlnxt+=' <td style="border-right: 1px solid #f7f7f7;width:2.5%"></td>';addhtmlnxt+='<td style="width: 22%">  <label class="control-label">Relative Name</label></td>';addhtmlnxt+='<td style="width: 22%"><label class="control-label">Company Name</label>';addhtmlnxt+='</td>';addhtmlnxt+='<td style="width: 16%"><label class="control-label">Percentage of Shares alongwith relative(%)</label>';addhtmlnxt+='</td>';addhtmlnxt+='<td><label class="control-label">Can you significantly influence the decision making of this company?</label>';addhtmlnxt+='</td>';addhtmlnxt+='<td><label class="control-label">Do this company have any commercial or financial transactions with Dr. Reddys Laboratories Limited or any of its group company/subsidiary?</label>';addhtmlnxt+='</td>';addhtmlnxt+='</tr>';addhtmlnxt+='<tr>';addhtmlnxt+='<td style="border-right: 1px solid #f7f7f7;width:2.5%"></td>';addhtmlnxt+='<td><div class="input"> <select id="d9ques1" name="d9ques1[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4"  >';addhtmlnxt+='<option value="">Select Option </option>';website.each(response.resdta,function(index,value){addhtmlnxt+='<option value='+value['id']+'>'+value['name']+'</option>';});addhtmlnxt+='<td><div class="input">  <input type="text" class="form-control inputbox4" id="d9ques2" name="d9ques2[]" >  </div></td> ';addhtmlnxt+=' <td><div class="input">  <input type="text" class="form-control inputbox4" id="d9ques3" name="d9ques3[]" value="holding above 2% shares" readonly="readonly" ></div></td>';addhtmlnxt+='<td> <div class="input"> <select id="d9ques4" name="d9ques4[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4"  ><option value="">Select Option </option> <option value="Yes">Yes</option> <option value="No">No</option> </select></div></td>';addhtmlnxt+=' <td><div class="input">   <select id="d9ques5" name="d9ques5[]" class="form_fields form-control col-md-7 col-xs-12" ><option value="">Select Option</option><option value="Yes">Yes</option> <option value="No">No</option> </select></div></td>';addhtmlnxt+='</tr>';addhtmlnxt+='</table>';addhtmlnxt+='</div>';website('.appenddiv9').append(addhtmlnxt);website('.appendd9').attr('plancntr',getlastid);}
else if(id=='adddiv10')
{var getlastid=website('.appendd10').attr('plancntr');getlastid=++getlastid;var addhtmlnxt='';addhtmlnxt+='<div class="row'+getlastid+' append_row3" style="padding-bottom:20px;" id="row'+getlastid+'" >';addhtmlnxt+='<table style="border-collapse: collapse; border: 1px solid #ccc" width="100%" border="1">';addhtmlnxt+='<tr>';addhtmlnxt+=' <td style="border-right: 1px solid #f7f7f7;width:2.5%;"></td>';addhtmlnxt+='<td style="width: 20%">  <label class="control-label">Relative Name</label></td>';addhtmlnxt+='<td style="width: 22%"><label class="control-label">Company Name</label>';addhtmlnxt+='</td>';addhtmlnxt+='<td style="width: 16%"><label class="control-label">Can you significantly influence the decision making of this company?</label>';addhtmlnxt+='</td>';addhtmlnxt+="<td><label class='control-label'>Do this company have any commercial or financial transactions with Dr. Reddy's Laboratories Limited or any of its group company/subsidiary?</label>";addhtmlnxt+='</td>';addhtmlnxt+='</td>';addhtmlnxt+='</tr>';addhtmlnxt+='<tr>';addhtmlnxt+='<td style="border-right: 1px solid #f7f7f7;width:2.5%"></td>';addhtmlnxt+='<td><div class="input"> <select id="d10ques1" name="d10ques1[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4"  >';addhtmlnxt+='<option value="">Select Option </option>';website.each(response.resdta,function(index,value){addhtmlnxt+='<option value='+value['id']+'>'+value['name']+'</option>';});addhtmlnxt+=' <td><div class="input">  <input type="text" class="form-control inputbox4" id="d10ques2" name="d10ques2[]" ></div></td>';addhtmlnxt+='<td> <div class="input"> <select id="d10ques3" name="d10ques3[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4"  ><option value="">Select Option </option> <option value="Yes">Yes</option> <option value="No">No</option> </select></div></td>';addhtmlnxt+=' <td><div class="input">   <select id="d10ques4" name="d10ques4[]" class="form_fields form-control col-md-7 col-xs-12" ><option value="">Select Option</option><option value="Yes">Yes</option> <option value="No">No</option> </select></div></td>';addhtmlnxt+='</tr>';addhtmlnxt+='</table>';addhtmlnxt+='</div>';website('.appenddiv10').append(addhtmlnxt);website('.appendd10').attr('plancntr',getlastid);}
else{var addhtmlnxt='';}},complete:function(response)
{},error:function(jqXHR,textStatus,errorThrown)
{}});}
function annualmodal(uniqueid){var uniqueid=uniqueid;website.ajax({type:"POST",url:'annualdeclaration/getfilecontent',dataType:"json",beforeSend:function()
{website('.preloder_wraper').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response)
{if(response.logged===true)
{website('.modalform').html(response.pdf_content);getpdfdata(uniqueid);}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function()
{}});}
function getpdfdata(uniqueid)
{var formData={uniqueid:uniqueid};website.ajax({url:'annualdeclaration/fetchannualdeclaration',data:formData,method:'POST',contentType:'application/x-www-form-urlencoded; charset=UTF-8',dataType:"json",cache:false,beforeSend:function()
{website('.preloder_wraper').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response,textStatus,jqXHR)
{if(response.logged==true)
{var addhtmlnxt='';var addhtmlnxt1='';var addhtmlnxt2='';var addhtmlnxt3='';var addhtmlnxt4='';var addhtmlnxt5='';var addhtmlnxt6='';var addhtmlnxt7='';var addhtmlnxt8='';var addhtmlnxt9='';var pastemp='';var mfr='';var dematacc='';var reldetail='';var reldemat='';if(response!=0)
{website("#uniqueid").val(uniqueid);if(response.selfcompany!=0)
{for(var i=0;i<response.selfcompany.length;i++)
{addhtmlnxt+='<tr class="counter">';addhtmlnxt+='<td width="25%">'+response.selfcompany[i]['company']+'</td>';addhtmlnxt+='<td width="25%">'+response.selfcompany[i]['decision']+'</td>';addhtmlnxt+='<td width="25%">'+response.selfcompany[i]['transaction']+'</td>';addhtmlnxt+='</tr>';}}
if(response.selffirm!=0)
{for(var i=0;i<response.selffirm.length;i++)
{addhtmlnxt1+='<tr class="counter">';addhtmlnxt1+='<td width="25%">'+response.selffirm[i]['firm']+'</td>';addhtmlnxt1+='<td width="25%">'+response.selffirm[i]['interest']+'</td>';addhtmlnxt1+='<td width="25%">'+response.selffirm[i]['decision']+'</td>';addhtmlnxt1+='<td width="25%">'+response.selffirm[i]['transaction']+'</td>'
addhtmlnxt+='</tr>';}}
if(response.selfpubpri!=0)
{for(var i=0;i<response.selfpubpri.length;i++)
{addhtmlnxt2+='<tr class="counter">';addhtmlnxt2+='<td width="25%">'+response.selfpubpri[i]['company']+'</td>';var interst='';if(response.selfpubpri[i]['interest']==1)
{interst='Member';}
else if(response.selfpubpri[i]['interest']==1)
{interst='Director';}
else if(response.selfpubpri[i]['interest']==1)
{interst='Member and Director';}
addhtmlnxt2+='<td width="25%">'+interst+'</td>';addhtmlnxt2+='<td width="25%">'+response.selfpubpri[i]['noofshare']+'</td>';addhtmlnxt2+='<td width="25%">'+response.selfpubpri[i]['decision']+'</td>';addhtmlnxt2+='<td width="25%">'+response.selfpubpri[i]['transaction']+'</td>'
addhtmlnxt+='</tr>';}}
if(response.selfpubshare!=0)
{for(var i=0;i<response.selfpubshare.length;i++)
{addhtmlnxt3+='<tr class="counter">';addhtmlnxt3+='<td width="25%">'+response.selfpubshare[i]['company']+'</td>';addhtmlnxt3+='<td width="25%">'+response.selfpubshare[i]['interest']+'</td>';addhtmlnxt3+='<td width="25%">'+response.selfpubshare[i]['decision']+'</td>';addhtmlnxt3+='<td width="25%">'+response.selfpubshare[i]['transaction']+'</td>';addhtmlnxt+='</tr>';}}
if(response.selfholdngshare!=0)
{for(var i=0;i<response.selfholdngshare.length;i++)
{addhtmlnxt7+='<tr class="counter">';addhtmlnxt7+='<td width="25%">'+response.selfholdngshare[i]['cmpname']+'</td>';addhtmlnxt7+='<td width="25%">'+response.selfholdngshare[i]['isdecisionmaking']+'</td>';addhtmlnxt7+='<td width="25%">'+response.selfholdngshare[i]['isfincltrans']+'</td>';addhtmlnxt7+='</tr>';}}
if(response.relative!=0)
{for(var i=0;i<response.relative.length;i++)
{if(response.relative[i]['relative']!='')
{addhtmlnxt4+='<tr class="counter">';addhtmlnxt4+='<td width="25%">'+response.relative[i]['relative']+'</td>';addhtmlnxt4+='<td width="25%">'+response.relative[i]['company']+'</td>';addhtmlnxt4+='<td width="25%">'+response.relative[i]['decision']+'</td>';addhtmlnxt4+='<td width="25%">'+response.relative[i]['transaction']+'</td>'
addhtmlnxt+='</tr>';}}}
if(response.relativefirm!=0)
{for(var i=0;i<response.relativefirm.length;i++)
{if(response.relativefirm[i]['relative']!='')
{addhtmlnxt5+='<tr class="counter">';addhtmlnxt5+='<td width="25%">'+response.relativefirm[i]['relative']+'</td>';addhtmlnxt5+='<td width="25%">'+response.relativefirm[i]['firm']+'</td>';addhtmlnxt5+='<td width="25%">'+response.relativefirm[i]['interest']+'</td>';addhtmlnxt5+='<td width="25%">'+response.relativefirm[i]['decision']+'</td>';addhtmlnxt5+='<td width="25%">'+response.relativefirm[i]['transaction']+'</td>'
addhtmlnxt+='</tr>';}}}
if(response.relativepubpri!=0)
{for(var i=0;i<response.relativepubpri.length;i++)
{if(response.relativepubpri[i]['relative']!='')
{addhtmlnxt6+='<tr class="counter">';addhtmlnxt6+='<td width="25%">'+response.relativepubpri[i]['relative']+'</td>';addhtmlnxt6+='<td width="25%">'+response.relativepubpri[i]['company']+'</td>';var interst='';if(response.relativepubpri[i]['interest']==1)
{interst='Member';}
else if(response.relativepubpri[i]['interest']==1)
{interst='Director';}
else if(response.relativepubpri[i]['interest']==1)
{interst='Member and Director';}
addhtmlnxt6+='<td width="25%">'+interst+'</td>';addhtmlnxt6+='<td width="25%">'+response.relativepubpri[i]['noofshare']+'</td>';addhtmlnxt6+='<td width="25%">'+response.relativepubpri[i]['decision']+'</td>';addhtmlnxt6+='<td width="25%">'+response.relativepubpri[i]['transaction']+'</td>'
addhtmlnxt6+='</tr>';}}}
if(response.relativepubshare!=0)
{for(var i=0;i<response.relativepubshare.length;i++)
{if(response.relativepubshare[i]['relative']!='')
{addhtmlnxt8+='<tr class="counter">';addhtmlnxt8+='<td width="25%">'+response.relativepubshare[i]['relative']+'</td>';addhtmlnxt8+='<td width="25%">'+response.relativepubshare[i]['company']+'</td>';addhtmlnxt8+='<td width="25%">'+response.relativepubshare[i]['interest']+'</td>';addhtmlnxt8+='<td width="25%">'+response.relativepubshare[i]['decision']+'</td>';addhtmlnxt8+='<td width="25%">'+response.relativepubshare[i]['transaction']+'</td>';addhtmlnxt8+='</tr>';}}}
if(response.relativeholdngshare!=0)
{for(var i=0;i<response.relativeholdngshare.length;i++)
{if(response.relativeholdngshare[i]['relative']!='')
{addhtmlnxt9+='<tr class="counter">';addhtmlnxt9+='<td width="25%">'+response.relativeholdngshare[i]['relative']+'</td>';addhtmlnxt9+='<td width="25%">'+response.relativeholdngshare[i]['cmpname']+'</td>';addhtmlnxt9+='<td width="25%">'+response.relativeholdngshare[i]['isdecisionmaking']+'</td>';addhtmlnxt9+='<td width="25%">'+response.relativeholdngshare[i]['isfincltrans']+'</td>';addhtmlnxt9+='</tr>';}}}
if(response.userlevel)
{website('.empcode').html(response.userlevel['employeecode']);website('.username').html(response.personaldetail['name']);website('.emailid').html(response.userlevel['email']);website('.pan').html(response.personaldetail['pan']);website('.legalidentifier').html(response.personaldetail['legal_identifier']);website('.legalidentityno').html(response.personaldetail['legal_identification_no']);website('.dob').html(response.personaldetail['dob']);website('.gender').html(response.personaldetail['sex']);website('.edu').html(response.personaldetail['education']);website('.institute').html(response.personaldetail['institute']);website('.address').html(response.personaldetail['address']);website('.mobno').html(response.personaldetail['mobileno']);website('.noofshare').html(response.personaldetail['sharehldng']);website('.adrsshare').html(response.personaldetail['adrshldng']);}
if(response.empdetail.length>0)
{for(var i=0;i<response.empdetail.length;i++)
{if(response.empdetail[i]['emp_name']!='')
{j=i;j++;pastemp+='<tr class="counter">';pastemp+='<td width="25%">'+j+'</td>';pastemp+='<td width="25%">'+response.empdetail[i]['emp_name']+'</td>';pastemp+='<td width="25%">'+response.empdetail[i]['emp_desigtn']+'</td>';pastemp+='<td width="25%">'+response.empdetail[i]['startdate']+'</td>';pastemp+='<td width="25%">'+response.empdetail[i]['enddate']+'</td>';pastemp+='</tr>';}}}
else
{pastemp='<tr><td colspan ="5">No Data Found..</td></tr>';}
if(response.mfrdetail.length>0)
{for(var i=0;i<response.mfrdetail.length;i++)
{if(response.mfrdetail[i]['related_party']!='')
{j=i;j++;mfr+='<tr class="counter">';mfr+='<td width="25%">'+j+'</td>';mfr+='<td width="25%">'+response.mfrdetail[i]['related_party']+'</td>';mfr+='<td width="25%">'+response.mfrdetail[i]['pan']+'</td>';mfr+='<td width="25%">'+response.mfrdetail[i]['relationship']+'</td>';mfr+='<td width="25%">'+response.mfrdetail[i]['address']+'</td>';mfr+='</tr>';}}}
else
{mfr='<tr><td colspan ="5">No Data Found..</td></tr>';}
if(response.dematdetail.length>0)
{for(var i=0;i<response.dematdetail.length;i++)
{if(response.dematdetail[i]['accountno']!='')
{j=i;j++;dematacc+='<tr class="counter">';dematacc+='<td width="25%">'+j+'</td>';dematacc+='<td width="25%">'+response.dematdetail[i]['accountno']+'</td>';dematacc+='<td width="25%">'+response.dematdetail[i]['depository_participient']+'</td>';dematacc+='<td width="25%">'+response.dematdetail[i]['clearing_house']+'</td>';dematacc+='</tr>';}}}
else
{dematacc='<tr><td colspan ="4">No Data Found..</td></tr>';}
if(response.reldetail.length>0)
{var deptype='';for(var i=0;i<response.reldetail.length;i++)
{if(response.reldetail[i]['name']!='')
{j=i;j++;reldetail+='<tr class="counter">';reldetail+='<td>'+j+'</td>';reldetail+='<td>'+response.reldetail[i]['name']+'</td>';reldetail+='<td>'+response.reldetail[i]['relationshipname']+'</td>';if(response.reldetail[i]['dependency_nature']!='')
{deptype=response.reldetail[i]['dependency_nature'].toString(',');}
reldetail+='<td>'+deptype+'</td>';reldetail+='<td>'+response.reldetail[i]['pan']+'</td>';reldetail+='<td>'+response.reldetail[i]['legal_identifier']+'</td>';reldetail+='<td>'+response.reldetail[i]['legal_identification_no']+'</td>';reldetail+='<td>'+response.reldetail[i]['aadhar']+'</td>';reldetail+='<td>'+response.reldetail[i]['dob']+'</td>';reldetail+='<td>'+response.reldetail[i]['address']+'</td>';reldetail+='<td>'+response.reldetail[i]['education']+'</td>';reldetail+='<td>'+response.reldetail[i]['education']+'</td>';reldetail+='<td>'+response.reldetail[i]['sharehldng']+'</td>';reldetail+='<td>'+response.reldetail[i]['adrshldng']+'</td>';reldetail+='</tr>';}}}
else
{reldetail='<tr><td colspan ="14">No Data Found..</td></tr>';}
if(response.relDematdetail.length>0)
{for(var i=0;i<response.relDematdetail.length;i++)
{if(response.relDematdetail[i]['accountno']!='')
{j=i;j++;reldemat+='<tr class="counter">';reldemat+='<td>'+j+'</td>';reldemat+='<td>'+response.reldetail[i]['accountno']+'</td>';reldemat+='<td>'+response.reldetail[i]['depository_participient']+'</td>';reldemat+='<td>'+response.reldetail[i]['clearing_house']+'</td>';reldemat+='</tr>';}}}
else
{reldemat='<tr><td colspan ="14">No Data Found..</td></tr>';}
website('.selfcompany').html(addhtmlnxt);website('.selffirm').html(addhtmlnxt1);website('.selfpubpri').html(addhtmlnxt2);website('.selfpubshare').html(addhtmlnxt3);website('.selfholdcontrl').html(addhtmlnxt7);website('.relative').html(addhtmlnxt4);website('.relativefirm').html(addhtmlnxt5);website('.relativepubpri').html(addhtmlnxt6);website('.relativepubshare').html(addhtmlnxt8);website('.relativeholdngcontrl').html(addhtmlnxt9);website('.pastemp').html(pastemp);website('.mfr').html(mfr);website('.dematacc').html(dematacc);website('.reldetail').html(reldetail);website('.reldemat').html(reldemat);}
website('#Mymodaldeclara').modal('show');}
else
{new PNotify({title:'Alert',text:"Please Fill All The Data In Software..!!!",type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function(jqXHR,textStatus,errorThrown)
{}});}
website('body').on('click','.formpdf',function(e)
{var htmldata=website('#Mymodaldeclara .modalform').html();var uniqueid=website('#uniqueid').val();var annualyear=website('#annualyear').val();var formData={htmldata:htmldata,annualyear:annualyear,uniqueid:uniqueid};website.ajax({type:"POST",url:'annualdeclaration/generateformbPDF',data:formData,dataType:"json",beforeSend:function()
{website('.preloder_wraper').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{},success:function(response)
{if(response.logged===true)
{website('#Mymodaldeclara .formpdf').css('display','none');website("#Mymodaldeclara #downloadpdf").append('<a  href="'+response.pdfpath+'" target="_blank" class="downlodthfle btn btn-primary" style="color: white;"><span class="glyphicon glyphicon-download-alt floatleft">Download</span> </a>');}
else
{}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function()
{}});});function removehtml(clicked)
{var rmid=clicked;if(rmid=='remvdiv1')
{var count=website('.appendd1').attr('plancntr');if(count!=0)
{website('#t1row'+count).remove();website('.appendd1').attr('plancntr',parseInt(count)-1);}
else
{return false;}}else if(rmid=='remvdiv2'){var count=website('.appendd2').attr('plancntr');if(count!=0)
{website('#t2row'+count).remove();website('.appendd2').attr('plancntr',parseInt(count)-1);}
else
{return false;}}else if(rmid=='remvdiv3'){var count=website('.appendd3').attr('plancntr');if(count!=0)
{website('#t3row'+count).remove();website('.appendd3').attr('plancntr',parseInt(count)-1);}
else
{return false;}}else if(rmid=='remvdiv4'){var count=website('.appendd4').attr('plancntr');if(count!=0)
{website('#t4row'+count).remove();website('.appendd4').attr('plancntr',parseInt(count)-1);}
else
{return false;}}else if(rmid=='remvdiv5'){var count=website('.appendd5').attr('plancntr');if(count!=0)
{website('#t5row'+count).remove();website('.appendd5').attr('plancntr',parseInt(count)-1);}
else
{return false;}}else if(rmid=='remvdiv6'){var count=website('.appendd6').attr('plancntr');if(count!=0)
{website('#t6row'+count).remove();website('.appendd6').attr('plancntr',parseInt(count)-1);}
else
{return false;}}else if(rmid=='remvdiv7'){var count=website('.appendd7').attr('plancntr');if(count!=0)
{website('#t7row'+count).remove();website('.appendd7').attr('plancntr',parseInt(count)-1);}
else
{return false;}}
else if(rmid=='remvdiv8'){var count=website('.appendd8').attr('plancntr');console.log(count);if(count!=0)
{website('#t8row'+count).remove();website('.appendd8').attr('plancntr',parseInt(count)-1);}
else
{return false;}}
else if(rmid=='remvdiv9'){var count=website('.appendd9').attr('plancntr');if(count!=0)
{website('#t9row'+count).remove();website('.appendd9').attr('plancntr',parseInt(count)-1);}
else
{return false;}}
else if(rmid=='remvdiv10'){var count=website('.appendd10').attr('plancntr');if(count!=0)
{website('#t10row'+count).remove();website('.appendd10').attr('plancntr',parseInt(count)-1);}
else
{return false;}}}
website('body').on('click','#submituserdata',function(e)
{var pdfdata=website("div #belowleveluserdet").html();website('.modalform').html(pdfdata);website('#Mymodaldeclara').modal('show');});function showsection(id){var id=id;var x=document.querySelector('[class="test"]');var y=document.querySelector('[class="test1"]');var selfhldng=document.querySelector('[class="test2"]');var reltvhldng=document.querySelector('[class="test3"]');console.log(reltvhldng);if(id=='showsec1')
{if(x.style.display==="none")
{x.style.display="block";}}
else if(id=='showsec2')
{if(y.style.display==="none")
{y.style.display="block";}}
else if(id=='showsec3')
{if(selfhldng.style.display==="none")
{selfhldng.style.display="block";}}
else if(id=='showsec4')
{if(reltvhldng.style.display==="none")
{reltvhldng.style.display="block";}}}
function hidesection(id)
{var x=document.querySelector('[class="test"]');var y=document.querySelector('[class="test1"]');var selfhldng=document.querySelector('[class="test2"]');var reltvhldng=document.querySelector('[class="test3"]');if(id=='hidesec1')
{if(x.style.display==="block")
{x.style.display="none";}}
if(id=='hidesec2')
{if(y.style.display==="block")
{y.style.display="none";}}
if(id=='hidesec3')
{if(selfhldng.style.display==="block")
{selfhldng.style.display="none";}}
if(id=='hidesec4')
{if(reltvhldng.style.display==="block")
{reltvhldng.style.display="none";}}}
website('#updateannual').ajaxForm({dataType:"json",beforeSend:function()
{website('.preloder_wraper').fadeIn();},uploadProgress:function(event,position,total,percentComplete)
{website('.preloder_wraper').fadeIn();},success:function(response,textStatus,jqXHR)
{console.log(response);if(response.logged==true)
{new PNotify({title:'Record Updated Successfully',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});annualmodal(response['uniqueid']);}else
{new PNotify({title:'Record Not Updated Successfully',text:response.message,type:'university',hide:true,styling:'bootstrap3',addclass:'dark ',});}},complete:function(response)
{website('.preloder_wraper').fadeOut();},error:function(jqXHR,textStatus,errorThrown)
{}});function loadnoofsec()
{website("#d3ques2").change(function(){var value=website(this).val();if(value==1||value==3)
{website('#d3ques5').removeAttr('readonly','readonly');}
else
{website('#d3ques5').attr('readonly','readonly');website('#d3ques5').val('');}});website("#appenddiv3 #d3ques2").change(function(){var value=website(this).val();var rownum=website(this).attr('rownum');if(value==1||value==3)
{website('#'+rownum+' #d3ques5').removeAttr('readonly','readonly');}
else
{website('#'+rownum+' #d3ques5').attr('readonly','readonly');website('#'+rownum+' #d3ques5').val('');}});website("#d7ques6").change(function(){var value=website(this).val();if(value==1||value==3)
{website('#d7ques5').removeAttr('readonly','readonly');}
else
{website('#d7ques5').attr('readonly','readonly');website('#d7ques5').val('');}});website("#appenddiv7  #d7ques6").change(function(){var value=website(this).val();var rownum=website(this).attr('rownum');if(value==1||value==3)
{website('#'+rownum+' #d7ques5').removeAttr('readonly','readonly');}
else
{website('#'+rownum+' #d7ques5').attr('readonly','readonly');website('#'+rownum+' #d7ques5').val('');}});}
function numberOnly()
{var charCode=event.keyCode;if((charCode>47&&charCode<58)||charCode==46)
return true;else
return false;};