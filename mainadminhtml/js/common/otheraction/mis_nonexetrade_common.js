
/* ===================== Pagination Start ===================== */
website('body').on('click','.paginationmn li', function(e) 
{
    var rscrntpg = website(this).attr('p');
    website('.panel.panel-white #pagenum').val(rscrntpg);
    getmisnonexetrde();
});
website('body').on('change','#noofrows', function(e) 
{
    getmisnonexetrde();
});
website('body').on('click','.go_button', function(e) 
{
    var rscrntpg = website('.gotobtn').val();
    website('.panel.panel-white #pagenum').val(rscrntpg);
    getmisnonexetrde();
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
        format: "dd-mm-yyyy"

    }).on('change', function(e, date)
    {
        var getdate = website(this).val();
        // console.log(getdate);
        var getid = website(this).closest('form').attr('id');
    });
  }

website('body').on('change','#emp_status', function(e) 
{
    getmisnonexetrde();
});

getmisnonexetrde();

function getmisnonexetrde()
{
    var search=website('#srch').val();
    var noofrows = website('#noofrows').val(); 
    var pagenum = website('#pagenum').val();
    var emp_status = website('#emp_status').val();
    //console.log(noofrows+'*'+pagenum);return false;
    website.ajax({
        url:'mis/misnonexetrde',
        data:{noofrows:noofrows,pagenum:pagenum,search:search,emp_status:emp_status},
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
                //console.log(response.data);return false;
                for(var i=0;i<response.data.length;i++)
                {  
                    var j=i+1;
                    var apprvdte = response.data[i].approved_date?response.data[i].approved_date:'';
                    htmlelements+='<tr>';
                    htmlelements+='<td width="10%">'+j+'</td>';
                    htmlelements+='<td width="10%">'+response.data[i].fullname+'</td>';
                    if(response.data[i].emp_status == '1')
                    {
                        htmlelements+='<td width="10%">Active</td>';
                    }
                    else if(response.data[i].emp_status == '2')
                    {
                        htmlelements+='<td width="10%">Resigned</td>';
                    }
                    else if(response.data[i].emp_status == '3')
                    {
                        htmlelements+='<td width="10%">Not a DP</td>';
                    }
                    // htmlelements+='<td width="10%">'+response.data[i].company_name+'</td>';
                    // if(response.data[i].no_of_shares>=25000)
                    // {
                    //     htmlelements+='<td width="10%">'+response.data[i].ceoaprv_date+'</td>';
                    // }
                    // else
                    // {
                    //     htmlelements+='<td width="10%">'+apprvdte+'</td>';
                    // }
                    htmlelements+='<td width="10%">'+response.data[i].no_of_shares+'</td>';
                    htmlelements+='<td width="10%">'+response.data[i].date_added+'</td>';
                    // if(response.data[i].trading_status == 0)
                    // {
                    //     htmlelements+='<td width="10%">Compliance</td>';
                    // }
                    // else
                    // {
                    //    htmlelements+='<td width="10%">Non-Compliance</td>'; 
                    // }
                    htmlelements+='</tr>';
                }
            }
            else
            {
                htmlelements+='<tr>';
                htmlelements+='<td colspan="8" style="text-align: center;">Data Not Found..!!</td></tr>';
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
    getmisnonexetrde();
    
});

