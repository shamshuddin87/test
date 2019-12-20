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


function getdataonload()
{
    website.ajax({
      url:'mis/fetchrecipient',
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
            var mobileno = response.resdta[i].mobileno?response.resdta[i].mobileno:''
            var email = response.resdta[i].email?response.resdta[i].email:''
            addhtmlnxt += '<tr class="counter" aprvllistid="'+response.resdta[i].id+'" >';
            addhtmlnxt += '<td width="25%">'+response.resdta[i].fullname+'</td>';
            addhtmlnxt += '<td width="25%">'+response.resdta[i].categoryname+'</td>';
            addhtmlnxt += '<td width="25%">'+response.resdta[i].nameofentity+'</td>';
            addhtmlnxt += '<td width="25%">'+response.resdta[i].name+'</td>';
            addhtmlnxt += '<td width="25%">'+response.resdta[i].identityno+'</td>';
            addhtmlnxt += '<td width="25%">'+response.resdta[i].phoneno+'</td>';
            addhtmlnxt += '<td width="25%">'+mobileno+'</td>';
            addhtmlnxt += '<td width="25%">'+response.resdta[i].designation+'</td>';
            addhtmlnxt += '<td width="25%">'+email+'</td>';
            if(response.resdta[i].filepath)
            {
                addhtmlnxt += '<td width="25%"><a href="'+response.resdta[i].filepath+'" download>&nbsp;<i class="fa fa-download" id="uploadattached1" aria-hidden="true"></i></a></td>';
            }
            else
            {
                addhtmlnxt += '<td width="25%"></td>';
            }
            if(response.resdta[i].agreemntfile)
            {
                addhtmlnxt += '<td width="25%"><a href="'+response.resdta[i].agreemntfile+'" download>&nbsp;<i class="fa fa-download" id="uploadattached1" aria-hidden="true"></i></a></td>';
            }
            else
            {
                addhtmlnxt += '<td width="25%"></td>';
            }
             
            addhtmlnxt += '</tr>';                        
            //------------------------ Table Fields Insertion END ------------------------
        }
        website('.appendrow').html(addhtmlnxt);
        website('#datableabhi').DataTable();
      }
      else
      {
        website('.appendroww').html('');
      }
    },
    complete: function(response)
    {},
    error: function(jqXHR, textStatus, errorThrown)
    {}
  });
    
    
}


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
    if (!re) {
        return false;
    }
}
