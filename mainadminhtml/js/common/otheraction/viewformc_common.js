website(document).ready(function()
{
    getdataonload();
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
    
});

website('body').on('change','#noofrows', function(e) 
{
  getdataonload();
});

website('body').on('click','.paginationmn li', function(e) 
{
    var rscrntpg = website(this).attr('p');
    website('.panel.panel-white #pagenum').val(rscrntpg);
    getdataonload();
});
//-------------------------GO BUTTON-------------------------

website('body').on('click','.go_button', function(e) 
{
   
    var rscrntpg = website('.gotobtn').val();
    website('.panel.panel-white #pagenum').val(rscrntpg);
    getdataonload();
});

function getdataonload()
{
    var noofrows = website('#noofrows').val(); 
    var pagenum = website('#pagenum').val();
    var formdata = {noofrows:noofrows,pagenum:pagenum};
    website.ajax({
      url:'sebi/fetchformcdataforaprvl',
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
        if(response.logged===true)
        {
            
        //console.log(response.resdta); return false;
        var addhtmlnxt='';
            
        for(var i = 0; i < response.resdta.length; i++) 
        {
//            //------------------------- Table Fields Insertion START ------------------------
            
            var draft = response.resdta[i].draft?response.resdta[i].draft:''
            var final = response.resdta[i].final?response.resdta[i].final:''
            addhtmlnxt += '<tr class="counter" aprvllistid="'+response.resdta[i].id+'" >';
            dtfrmt = response.resdta[i].date_added.split("-");                   
            dtfrmtspace = response.resdta[i].date_added.split(" ");                    
            ddmmyy = dtfrmtspace[0];
            dtfrmt = dtfrmtspace[0].split("-");
            ddmmyy = dtfrmt[2]+'-'+dtfrmt[1]+'-'+dtfrmt[0];
            times = dtfrmtspace[1];
            addhtmlnxt += '<td width="5%"><input type="checkbox"  name="chkbox"  size="30px;" value='+response.resdta[i].id+'></td>';
            addhtmlnxt += '<td width="15%" >'+ddmmyy+'  '+times+'</td>';
            
            addhtmlnxt += '<td width="20%">'+response.resdta[i].fullname+'</td>';
            addhtmlnxt += '<td width="15%">'+response.resdta[i].pan+'</td>';
            addhtmlnxt += '<td width="15%">'+response.resdta[i].cin+'</td>';
            addhtmlnxt += '<td width="15%">'+response.resdta[i].address+'</td>';
            addhtmlnxt += '<td width="15%">'+response.resdta[i].mobile+'</td>';
            addhtmlnxt += '<td width="15%">'+response.resdta[i].category+'</td>';
            
            if(response.resdta[i].draft)
            {
                addhtmlnxt += '<td width="25%"><a href="'+draft+'" download>&nbsp;<i class="fa fa-download" id="uploadattached1" aria-hidden="true"></i></a></td>';
            }
            else
            {
                addhtmlnxt += '<td width="15%"></td>';
            }
            if(response.resdta[i].approvestatus == 0)
            {
                addhtmlnxt += '<td width="15%"><button type="button" class="btn btn-primary" id="apprvrqstformc" formcid="'+response.resdta[i].id+'" pdfurl="'+draft+'">Approve</button></td>';
            }
            else
            {
                addhtmlnxt += '<td width="15%"><i class="fa fa-check" aria-hidden="true"></i></td>';
            }
            

            addhtmlnxt += '</tr>';                        
            //------------------------ Table Fields Insertion END ------------------------
        }
        website('.appendrow').html(addhtmlnxt);
        website('.paginationmn').html(response.pgnhtml);
        //website('#datableabhi').DataTable();
      }
      else
      {
        website('.appendrow').html('<tr><td colspan="9" style="text-align:center;">Data Not Found..!!</td></tr>');
        website('.paginationmn').html(response.pgnhtml);
      }
    },
    complete: function(response)
    {},
    error: function(jqXHR, textStatus, errorThrown)
    {}
  });
    
    
}


website('body').on('click','#apprvrqstformc', function(){
var id = website(this).attr('formcid');
var pdfurl = website(this).attr('pdfurl');
    var formdata = {id:id,pdfurl:pdfurl};
    website.ajax({
      url:'sebi/apprvrqstformc',
      data:formdata,
      method:'POST',
      //contentType:'json',
      contentType:'application/x-www-form-urlencoded; charset=UTF-8',
      //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
      dataType:"json",
      cache:false,
      //async:true, /*Cross domain checking*/
      beforeSend: function()
      {  website('.preloder_wraper').fadeIn(); },
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
               window.location.reload();
        }
      else
        {
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
    { website('.preloder_wraper').fadeOut(); },
    error: function(jqXHR, textStatus, errorThrown)
    {}
  });
    
    
});


website('#updateformb').ajaxForm({
        //data:formdata,
        //contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        dataType:"json",
        beforeSend: function() 
        {   /*website('#Mymodaledit').modal('hide');*/
            website('.preloder_wraper').fadeIn();  },
        uploadProgress: function(event, position, total, percentComplete) 
        { website('.preloder_wraper').fadeIn();},
        success: function(response, textStatus, jqXHR) 
        {
           if(response.logged === true)
           {
              //fetchmasterlist();
              
              //website('#Mymodaledit').fadeOut();
              new PNotify({title: 'Record Updated Successfully',
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
            website('#Mymodaledit .mainprogressbarforall').fadeOut(); 
        },
        error: function() 
        {   }
    });


website('body').on('click','#formbrqust', function(){
    website('#Mymodalformb').modal('show');
});

website('body').on('click','#sendforaprv',function(){
    var formbid = website(this).attr('formbid');
    website('#myModalsendaprv .yesapprove').attr('formbid',formbid);
    website('#myModalsendaprv').modal('show');
})

website('body').on('click','.yesapprove',function()
{
    var id = website(this).attr('formbid');
    var formdata = {id:id};
    website.ajax({
      url:'sebi/sendforapprvlformb',
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
              window.location.reload();
              //website('#Mymodaledit').fadeOut();
              new PNotify({title: 'Alert!!!',
                  text: response.message,
                  type: 'university',
                  hide: true,
                  styling: 'bootstrap3',
                  addclass: 'dark ',
              }); 
           }
           else
           {    
              new PNotify({title: 'Alert!!!',
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
            website('#myModalyesno .mainprogressbarforall').fadeOut(); 
        },
        error: function() 
        {   }
    });
});

website('body').on('click','#preview',function()
{
   var docid = website(this).attr('doc_id');
    var id = website(this).attr('formbid');
    var formdata = {id:id,docid:docid};
    website.ajax({
      url:'sebi/previewofformb',
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
               website('#modaldocument .downloadpdf').hide(); 
               website('#modaldocument .docpdf').html(response.docontent);
               if(response.secutype)
                {
                    website.each(response.secutype, function(k, v) 
                    {
                        website('.secutype').append(v);
                    });
                }
               website('.name').html(response.formdata['fullname']);
               website('.cmpnme').html(response.formdata['companyname']);
               website('.pan').html(response.formdata['pan']);
               website('.cin').html(response.formdata['cin']);
               website('.contctno').html(response.formdata['mobile']);
               website('.address').html(response.formdata['address']);
               website('.category').html(response.formdata['category']);
               website('.appointdate').html(response.formdata['date']);
               website('.secuno').html(response.formdata['securityno']);
               website('.shrhldng').html(response.formdata['sharehldng']);
               website('.futureunit').html(response.formdata['futureunit']);
               website('.optionunit').html(response.formdata['optionunit']);
               website('.futurevalue').html(response.formdata['futurevalue']);
               website('.optionvalue').html(response.formdata['optionvalue']);
               website('#modaldocument #formbid').val(id);
                website('#modaldocument').modal('show');
           }
           else
           {    
              
           }
        },
        complete: function(response) 
        {
            website('#myModalyesno .mainprogressbarforall').fadeOut(); 
        },
        error: function() 
        {   }
    });
});

website('body').on('click','.formbpdf', function(e)
{
    var htmldata = website('#modaldocument .docpdf').html();
    var formbid = website('#modaldocument #formbid').val();
    var formData = {htmldata:htmldata,formbid:formbid};
    website.ajax({
        type:"POST",
        url:'sebi/generateformbPDF',
        data: formData,
        //contentType: "application/json; charset=utf-8",
        dataType:"json",
        beforeSend: function()
        {
            website('.preloder_wraper').fadeIn();
            website('#modaldocument .downloadpdf .pdfln').html('');
            website('#modaldocument .trailpdfdownload').addClass('disabled');
        },
        uploadProgress: function(event, position, total, percentComplete)
        {
            
        },
        success: function(response) 
        {
            //console.log(response); return false;
            if(response.logged===true)
            {
                website('.preloder_wraper').fadeOut();
                website('#modaldocument .formbpdf').fadeOut();
                website('#modaldocument .button_pdf .down_load').show();
                website('#modaldocument .downloadpdf').show();
                website('#modaldocument .downloadpdf .pdfln').html('<a href="'+response.pdfpath+'" target="_blank" class="downlodthfle" style="color: white;"> Download</a>');
            }
        },
        complete: function(response)
        {
            website('.preloder_wraper').fadeOut();
            //window.location.reload();
        },
        error: function() 
        {
            
        }
    });
});


website('.genfile').on('click', function(e) {
    // alert(request);return false;
    var noofrows = website('#noofrows').val(); 
    var pagenum = website('#pagenum').val();
    var annualyr = website('#annualyear').val();
    var filterstatus = website('#filterstatus').val();
    var search = website('#srch').val();
    let id = new Array();
    website("input:checkbox[name=chkbox]:checked").each(function(){
    id.push(website(this).val());
   });
    //console.log(id);return false;
    var formdata = {noofrows:noofrows,pagenum:pagenum,annualyr:annualyr,filterstatus:filterstatus,search:search,id:id};
    website.ajax({
        url:'sebi/exportformc',
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
            website('.preloder_wraper').fadeIn();
            // website('.dwnldExcel').fadeOut();   
        },
        uploadProgress: function(event, position, total, percentComplete) 
        {   },
        success:function(response)
        {
            if(response.logged==true)
            {
                website('.dwnldExcel').fadeIn();
                website('.dwnldExcel').attr('href',response.genfile);
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
                new PNotify({title: response.message,
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
        error:function(response)
        {   }
    });
});


function numberalphOnly() 
{
            var charCode = event.keyCode;
    
            if ((charCode > 47 && charCode < 58) || charCode == 32 || (charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || charCode == 8 || charCode == 44 || charCode == 40 || charCode == 41 || charCode == 46 || charCode == 47)
                return true;
            else
                return false;
}
function emailOnly() 
{
    var re = /[A-Z0-9a-z@\._-]/.test(event.key);
    if (!re) {return false;}
}
