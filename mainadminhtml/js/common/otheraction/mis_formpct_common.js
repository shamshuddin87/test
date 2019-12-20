
/* ===================== Pagination Start ===================== */
website('body').on('click','.paginationmn li', function(e) 
{
    var rscrntpg = website(this).attr('p');
    website('.panel.panel-white #pagenum').val(rscrntpg);
    getmisformpct();
});
website('body').on('change','#noofrows', function(e) 
{
   getmisformpct();
});
website('body').on('click','.go_button', function(e) 
{
    var rscrntpg = website('.gotobtn').val();
    website('.panel.panel-white #pagenum').val(rscrntpg);
    getmisformpct();
});
/* ===================== Pagination End ===================== */



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
        format: "yyyy-mm-dd"

    }).on('change', function(e, date)
    {
        var getdate = website(this).val();
        // console.log(getdate);
        var getid = website(this).closest('form').attr('id');
    });
  }

getmisformpct();

function getmisformpct()
{
    var search=website('#srch').val();
    var noofrows = website('#noofrows').val(); 
    var pagenum = website('#pagenum').val();
    var startdate= website('#date1').val();
    var enddate= website('#date2').val();
    website.ajax({
        url:'mis/misformpct',
        data:{noofrows:noofrows,pagenum:pagenum,search:search,startdate:startdate,enddate:enddate},
        method:'POST',
        contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        dataType:"json",
        cache:false,
        beforeSend: function()
        {   },
        uploadProgress: function(event, position, total, percentComplete)
        {   },
        success: function(response, textStatus, jqXHR) 
        {
            var htmlelements='';
            if(response.logged==true)
            {
                for(var i=0;i<response.data.length;i++)
                {
                    var j=i+1;
                    htmlelements+='<tr>';
                    // if(response.data[i].no_of_shares>=25000)
                    // {
                    //     var aprvdate =response.data[i].ceoaprv_date;
                    // }
                    // else
                    // {
                    //     var aprvdate =response.data[i].approved_date;
                    // }
                    htmlelements+='<td width="10%">'+j+'</td>';
                    htmlelements+='<td width="10%">'+response.data[i].fullname+'</td>';
                    htmlelements+='<td width="10%">'+response.data[i].company_name+'</td>';
                    // htmlelements+='<td width="10%">'+response.data[i].approverno+'</td>';
                    htmlelements+='<td width="10%">'+response.data[i].no_of_shares+'</td>';
                    htmlelements+='<td width="10%">'+response.data[i].transaction+'</td>';
                    if(response.data[i].approved_date!=null)
                    {
                          htmlelements+='<td width="10%">'+response.data[i].approved_date+'</td>';
                    }
                    else
                    {
                         htmlelements+='<td width="10%">'+response.data[i].date_added+'</td>';
                    }
                  
                    htmlelements+='</tr>';
                }
            }
            else
            {
                htmlelements+='<tr>';
                htmlelements+='<td colspan="10" style="text-align: center;">Data Not Found..!!</td></tr>';
            }

            //console.log(response.pgnhtml); return false;
            website('.accdetails8').html(htmlelements);
            website('#acc8').html(response.pgnhtml);
        },
        complete: function(response) 
        {   },
        error: function(jqXHR, textStatus, errorThrown)
        {   }
    });
}

 website("#srch").on("keyup", function() {
    var search=website('#srch').val();
    var pagenum = website('#pagenum').val();
    website('#srch').attr('status','0');
    if(pagenum!=1)
    {
        website('#pagenum').val(1);
    }
    getmisformpct();
});

website('body').on('click','#dtrange', function(e) 
{
   getmisformpct();
});
