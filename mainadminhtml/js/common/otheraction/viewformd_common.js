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
      url:'sebi/fetchformddataforaprvl',
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
            addhtmlnxt += '<td width="15%" >'+ddmmyy+'  '+times+'</td>';
            
            addhtmlnxt += '<td width="15%">'+response.resdta[i].fullname+'</td>';
            addhtmlnxt += '<td width="15%">'+response.resdta[i].pan+'</td>';
            addhtmlnxt += '<td width="15%">'+response.resdta[i].cin+'</td>';
            addhtmlnxt += '<td width="15%">'+response.resdta[i].address+'</td>';
            addhtmlnxt += '<td width="15%">'+response.resdta[i].mobile+'</td>';
            addhtmlnxt += '<td width="15%">'+response.resdta[i].cmpcnct+'</td>';
            
            if(response.resdta[i].draft)
            {
                addhtmlnxt += '<td width="15%"><a href="'+draft+'" download>&nbsp;<i class="fa fa-download" id="uploadattached1" aria-hidden="true"></i></a></td>';
            }
            else
            {
                addhtmlnxt += '<td width="15%"></td>';
            }
            if(response.resdta[i].approvestatus == 0)
            {
                addhtmlnxt += '<td width="15%"><button type="button" class="btn btn-primary" id="apprvrqstformd" formdid="'+response.resdta[i].id+'" pdfurl="'+draft+'">Approve</button></td>';
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


website('body').on('click','#apprvrqstformd', function(){
var id = website(this).attr('formdid');
var pdfurl = website(this).attr('pdfurl');
    var formdata = {id:id,pdfurl:pdfurl};
    website.ajax({
      url:'sebi/apprvrqstformd',
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
      { website('.preloder_wraper').fadeIn();  },
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
