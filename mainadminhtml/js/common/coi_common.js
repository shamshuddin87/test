website(document).ready(function()
{
  fetchCoiAllData();
});

/* ---------------- Start Pagination ---------------- */
website('body').on('click','.paginationmn li', function(e) 
{
    var rscrntpg = website(this).attr('p');
    //alert(rscrntpg);
    website('.panel.panel-white #pagenum').val(rscrntpg);
    // var noofrows = website('#noofrows').val(); 

    fetchCoiAllData();
});

website('body').on('change','#noofrows', function(e) 
{
    fetchCoiAllData();
});

website('body').on('click','.go_button', function(e) 
{
    var rscrntpg = website('.gotobtn').val();
    // alert(rscrntpg);
    website('.panel.panel-white #pagenum').val(rscrntpg);
    fetchCoiAllData();
});
/* ---------------- End Pagination ---------------- */

function fetchCoiAllData()
{
    var noofrows = website('#noofrows').val(); 
    var pagenum = website('#pagenum').val();
    var formdata = {noofrows:noofrows,pagenum:pagenum}
    website.ajax({
    url: "coi/fetchCoiAllData",
    data:formdata,
    method: "POST",
    //contentType:'json',
    contentType: "application/x-www-form-urlencoded; charset=UTF-8",
    //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
    dataType: "json",
    cache: false,
    //async:true, /*Cross domain checking*/
    beforeSend: function () {},
    uploadProgress: function (event, position, total, percentComplete) {},
    success: function (response, textStatus, jqXHR) 
    {
        if(response.logged === true) 
        {
            var addhtmlnxt = '';
            for(var i=0;i<response.data.length;i++)
            {
                var j=i+1;
                // console.log(response);
                var sentdate = response.data[i]['sent_date']?response.data[i]['sent_date']:"";
                addhtmlnxt += '<tr class="counter">';
                addhtmlnxt += '<td width="5%">'+j+'</td>';
                addhtmlnxt += '<td width="11%">'+response.data[i]['date_added']+'</td>';
                addhtmlnxt += '<td width="11%">';
                if(response.data[i]["sent_status"] == '0' || response.data[i]["hrM_processed_status"] == 'To Be Send' || response.data[i]["hrM_processed_status"] == 'Returned')
                {
                    addhtmlnxt += 'Pending';
                }
                else
                {
                    addhtmlnxt += 'Sent';
                }
                addhtmlnxt += '</td>';
                
                addhtmlnxt += '<td width="11%" style="text-align:center">';

                if(response.data[i]["hrM_processed_status"] == "Returned" || response.data[i]["hrM_processed_status"] == "To Be Send" || response.data[i]["deptM_processed_status"] == "Returned")
                {
                // addhtmlnxt += '<i class="fa fa-check-circle-o faicon" style="font-size:20px;" title="Already sent"></i>';
                   addhtmlnxt += '<i class="fa fa-external-link faicon" id="sendtohrM" reqid="'+response.data[i]["id"]+'" title="Send to HR Manager"></i>';
                }
                else
                {
                    addhtmlnxt += response.data[i]["hrM_processed_status"];
                }
                addhtmlnxt += '</td>';
                addhtmlnxt += '<td width="11%" style="text-align:center">';
                // if(response.data[i]["deptM_processed_status"] == "Returned" || response.data[i]["deptM_processed_status"] == "To Be Send")
                // {
                //     addhtmlnxt += '<i class="fa fa-external-link faicon sendtodeptM" reqid="'+response.data[i]["id"]+'" title="Send to Department Manager"></i>';
                    // addhtmlnxt += '<i class="fa fa-check-circle-o faicon" style="font-size:20px;" title="Already sent"></i>';    
                // }
                addhtmlnxt += response.data[i]["deptM_processed_status"];
                addhtmlnxt += '</td>';
                
                addhtmlnxt += '<td width="11%" style="text-align:center"><i class="fa fa-list-ul faicon" id="audit_trail" reqid="'+response.data[i]["id"]+'" title="Audit Trail"></i></td>';
                
                addhtmlnxt += '<td width="11%" style="text-align:center">';
                if(response.data[i]["sent_status"] == '0')
                {
                    addhtmlnxt += '<i class="fa fa-edit coiedit" reqid="'+response.data[i]["id"]+'" title="Edit Entry"></i>';
                }
                addhtmlnxt += '</td>';
                
                addhtmlnxt += '<td width="11%" style="text-align:center">';
                if(response.data[i]["sent_status"] == '0')
                {
                    addhtmlnxt += '<i class="fa fa-trash coidelete" reqid="'+response.data[i]["id"]+'" title="Delete Entry"></i>';
                }
                addhtmlnxt += '</td>';
                
                addhtmlnxt += '<td width="11%" style="text-align:center">';
                if(response.data[i]["coi_pdfpath"])
                {
                    addhtmlnxt += '<a  href="'+response.data[i]["coi_pdfpath"]+'" target="_blank" class="downlodthfle" style="color:black;"><span class="glyphicon glyphicon-download-alt floatleft"></span></a>';
                }
                addhtmlnxt += '</td>';
                
                /*if(response.data[i]['send_status']==0)
                {
                  addhtmlnxt += '<td width="25%"><a  href="'+response.data[i]["pdfpath"]+'"  class="downlodthfle" style="color:black;"><span class="glyphicon glyphicon-download-alt floatleft"></span></a> <span class="glyphicon glyphicon-trash delfile" delid="'+response.data[i]["srno"]+'"></span> <a href = "annualdeclaration/editannual?id='+response.data[i]['uniqueid']+'" <span class="glyphicon glyphicon-edit editfile" editid="'+response.data[i]["uniqueid"]+'"></span></a></td>';
                }
                else
                {
                    addhtmlnxt += '<td width="25%"><a  href="'+response.data[i]["pdfpath"]+'"  class="downlodthfle" style="color:black;"><span class="glyphicon glyphicon-download-alt floatleft"></span></a></td>';
                }*/
                
                addhtmlnxt += '</tr>';      
            }
        }
        else
        {
            addhtmlnxt += '<tr class="counter"><td>Data Not Found</td></tr>';
        }
        website('.paginationmn').html(response.pgnhtml);
        website('.allcoidata').html(addhtmlnxt);
    },
    complete: function (response) {},
    error: function (jqXHR, textStatus, errorThrown) {},
  });
}

website("body").on("click", ".coiedit", function (e) {
    var coi_id = website(this).attr('reqid');
    coi_id = btoa(coi_id);
    var baseHref=getbaseurl();
    setTimeout(function(){window.location.href=baseHref+'coi/editcoi?coiid='+coi_id;},1000);
});


website('body').on('click','#sendtohrM', function(e) 
{
    var reqid = website(this).attr("reqid");
    formdata = {reqid : reqid};
    website.ajax({
            url: "coi/sendaprvmailtohrmgr",
            data:formdata,
            method: "POST",
            //contentType:'json',
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
            dataType: "json",
            cache: false,
            beforeSend: function() 
            {  website('.preloder_wraper').fadeIn();   },
            uploadProgress: function(event, position, total, percentComplete) 
            {   },
            success: function(response, textStatus, jqXHR) 
            {
                if(response.logged === true)
                {
                    new PNotify({title: 'Alert',
                        text: response.message,
                        type: 'university',
                        hide: true,
                        styling: 'bootstrap3',
                        addclass: 'dark ',
                    });      
                    setTimeout(function() {window.location.reload()}, 2000);              
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
            { website('.preloder_wraper').fadeOut();    },
            error: function() {  }
        });
});


website('body').on('click','#audit_trail', function(e) 
{
    var reqid = website(this).attr("reqid");
    var formdata = { reqid : reqid };
    website.ajax({
    url: "coi/fetchAuditTrail",
    data:formdata,
    method: "POST",
    //contentType:'json',
    contentType: "application/x-www-form-urlencoded; charset=UTF-8",
    //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
    dataType: "json",
    cache: false,
    //async:true, /*Cross domain checking*/
    beforeSend: function () {},
    uploadProgress: function (event, position, total, percentComplete) {},
    success: function (response, textStatus, jqXHR) 
    {
       website("#auditTrailModal").modal("show");
        if(response.logged === true) 
        {
            var addhtmlnxt = '';
            for(var i=0;i<response.data.length;i++)
            {
                var j=i+1;
                // console.log(response);
                addhtmlnxt += '<tr class="counter">';
                addhtmlnxt += '<td width="5%">'+j+'</td>';
                addhtmlnxt += '<td width="10%">'+response.data[i]['action']+'</td>';
                addhtmlnxt += '<td width="10%">'+response.data[i]['action_date']+'</td>';
                addhtmlnxt += '<td width="10%">'+response.data[i]['status']+'</td>';
                addhtmlnxt += '<td width="10%">'+response.data[i]['recommendation']+'</td>';                    
                addhtmlnxt += '</tr>';      
            }
        }
        else
        {
            addhtmlnxt += '<tr class="counter"><td colspan="5">No Audit Trail Found!!!</td></tr>';
        }
        website('#audittrail').html(addhtmlnxt);
    },
    complete: function (response) {},
    error: function (jqXHR, textStatus, errorThrown) {},
  });
});