
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
    console.log(getdate);
    var getid = website(this).closest('form').attr('id');
});

website('document').ready(function()
{ 
    var excrqst = website('#excrqst').val();
    var vote = website('#vote').val();
    var rqstid = website('#rqstid').val();
    if(vote == 1)
    {
        var formdata = {excrqst:excrqst,vote:vote,rqstid:rqstid}
        website.ajax({
              url:'randomexception/updateexcrequst',
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
                         website('#apprvrqst').html(response.apprvmsg); 
                         sendmailackexcreqstr(response.rqstid);
                  }
              },
             complete: function(response)
             {},
             error: function(jqXHR, textStatus, errorThrown)
             {}
        });
    }
    else
    {
        website('.forreject').show();
        website('#apprvrqst').hide();
        website('#updateexcrqst').ajaxForm({
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
              
                if(response.logged===true)
                {
                     website('.forreject').hide();
                     website('#apprvrqst').hide();
                     website('#rejctmsg').html(response.rejctmsg); 
                }  
           }
        },
        complete: function(response) 
        {   },
        error: function() 
        {   }
    });
    }
    
    
});

function sendmailackexcreqstr(excrqstid)
{
    var formdata = {excrqstid:excrqstid}
     website.ajax({
              url:'randomexception/mailacknwtoexcapprvr',
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
                        
                  }
              },
             complete: function(response)
             {},
             error: function(jqXHR, textStatus, errorThrown)
             {}
        });
}
