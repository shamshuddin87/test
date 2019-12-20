website(document).ready(function()
{
    
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


getdataonload();

website('body').on('click','.savedeclaration', function()
{
    if (website('#agree').attr('checked'))
    {
        var value = website('#agree').val();
        var formdata = {value:value}
        website.ajax({
          url:'declarationform/insertdeclrnfrm',
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
              if(response.logged==true)
              {
                new PNotify({title: 'Alert',
                            text: response.message,
                            type: 'university',
                            hide: true,
                            styling: 'bootstrap3',
                            addclass: 'dark ',
                          }); 
                  getdataonload();
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
          {

           },
          error: function(jqXHR, textStatus, errorThrown)
          {   }
        })
    }
    else
    {
        new PNotify({title: 'Alert',
                  text: 'Please Agree Declaration Form',
                  type: 'university',
                  hide: true,
                  styling: 'bootstrap3',
                  addclass: 'dark ',
            });
    }
});

function getdataonload()
{
    website.ajax({
          url:'declarationform/fetchdeclrnfrm',
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
              if(response.logged==true)
              {
                  website('#agree').hide();
                  website('.savedeclaration').hide();
                  dtfrmt = response.resdta[0]['date_added'].split("-");                   
                    dtfrmtspace = response.resdta[0]['date_added'].split(" ");                    
                     ddmmyy = dtfrmtspace[0];
                     dtfrmt = dtfrmtspace[0].split("-");
                     ddmmyy = dtfrmt[2]+'-'+dtfrmt[1]+'-'+dtfrmt[0];
                    website('.dateofsub').html(ddmmyy);
                    
              }
              else
              {
                   
              }
          },
          complete: function(response) 
          {

           },
          error: function(jqXHR, textStatus, errorThrown)
          {   }
        })
}



