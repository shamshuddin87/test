website(document).ready(function () {
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
  fetchCoiMgrData();
});


/* ---------------- Start Pagination ---------------- */
website('body').on('click','.paginationmn li', function(e) 
{
    var rscrntpg = website(this).attr('p');
    //alert(rscrntpg);
    website('.panel.panel-white #pagenum').val(rscrntpg);
    // var noofrows = website('#noofrows').val(); 

    fetchCoiMgrData();
});

website('body').on('change','#noofrows', function(e) 
{
    fetchCoiMgrData();
});

website('body').on('click','.go_button', function(e) 
{
    var rscrntpg = website('.gotobtn').val();
    // alert(rscrntpg);
    website('.panel.panel-white #pagenum').val(rscrntpg);
    //Getting value of last page of pagination
    var lastPage = website('.pagination .paginateul li').last().attr('p');

    //Validation added for goto button value should be less than last page value
    if(parseInt(rscrntpg) <= parseInt(lastPage))
    {
        fetchCoiMgrData();
    }
    
});
/* ---------------- End Pagination ---------------- */

/* ---------------- Start Filter ---------------- */
website('body').on('change','#filterstatus', function(e) 
{     
    fetchCoiMgrData();
});
/* ---------------- End Filter ---------------- */

/* ---------------- Start Search  ---------------- */
website("#srch").on("keyup", function() {
    var pagenum = website('#pagenum').val();
    website('#srch').attr('status','0');
    if(pagenum!=1)
    {
        website('#pagenum').val(1);
    }
    fetchCoiMgrData();
});
/* ---------------- End Search ---------------- */

/* ---------------- Start search date range ---------------- */
website('body').on('click','#dtrange', function(e) 
{
   fetchCoiMgrData();
});
/* ---------------- End search date range ---------------- */

function fetchCoiMgrData()
{
    var noofrows = website('#noofrows').val(); 
    var pagenum = website('#pagenum').val();
    var filterstatus = website('#filterstatus').val();
    var srchbyusr = website('#srch').val();
    var startdate= website('#date1').val();
    var enddate= website('#date2').val();
    
    var formdata = {noofrows:noofrows,pagenum:pagenum,filterstatus:filterstatus,srchbyusr:srchbyusr,startdate:startdate,enddate:enddate}
    website.ajax({
    url: "coi/fetchCoiMgrData",
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
                addhtmlnxt += '<td width="10%">'+response.data[i]['reqempid']+'</td>';
                addhtmlnxt += '<td width="10%">'+response.data[i]['reqname']+'</td>';
                addhtmlnxt += '<td width="10%">'+response.data[i]['reqdeptname']+'</td>';
                addhtmlnxt += '<td width="10%">'+response.data[i]['reqdate']+'</td>';
                if(response.managertype == "hr")
                {
                  addhtmlnxt += '<td width="10%">'+response.data[i]['hrMstatus']+'</td>';
                  var status = response.data[i]['hrMstatus'];
                }
                else if(response.managertype == "dept")
                {
                  addhtmlnxt += '<td width="10%">'+response.data[i]['deptMstatus']+'</td>';
                  var status = response.data[i]['deptMstatus'];
                }
                
                addhtmlnxt += '<td width="10%" style="text-align:center">';
                if(status == 'Returned' || status == 'Rejected' || status == 'Approved')
                {
                    var cssvar = 'csspointernone';
                }
                else
                {
                    var cssvar = '';
                }
                addhtmlnxt += '<i class="fa fa-check faiconbtn '+cssvar+'" id="approve" reqid="'+response.data[i]["reqid"]+'"  title="Approve"></i>';
                addhtmlnxt += '&nbsp;&nbsp;<i class="fa fa-times faiconbtn '+cssvar+'" id="reject" reqid="'+response.data[i]["reqid"]+'"  title="Reject"></i>';
                addhtmlnxt += '&nbsp;&nbsp;<i class="fa fa-exchange faiconbtn '+cssvar+'" id="return" reqid="'+response.data[i]["reqid"]+'"  title="Return"></i>';
                addhtmlnxt += '</td>';
                
                addhtmlnxt += '<td width="11%" style="text-align:center"><i class="fa fa-list-ul faicon" id="audit_trail" reqid="'+response.data[i]["reqid"]+'" title="Audit Trail"></i></td>';
                
                addhtmlnxt += '<td width="11%" style="text-align:center"><i class="fa fa-file faicon" id="coi_attachment" reqid="'+response.data[i]["reqid"]+'" attachments="'+response.data[i]["attachments"]+'" title="Attachment"></i></td>';
                
                addhtmlnxt += '<td width="11%" style="text-align:center">';
                if(response.data[i]["coi_pdfpath"])
                {
                    addhtmlnxt += '<a  href="'+response.data[i]["coi_pdfpath"]+'" target="_blank"  class="downlodthfle" style="color:black;"><span class="glyphicon glyphicon-download-alt floatleft"></span></a>';
                }
                addhtmlnxt += '</td>';                
                addhtmlnxt += '</tr>';      
            }
        }
        else
        {
            addhtmlnxt += '<tr class="counter"><td>Data Not Found</td></tr>';
        }
        website('.approvaldata').html(addhtmlnxt);
        website('.paginationmn').html(response.pgnhtml);
    },
    complete: function (response) {},
    error: function (jqXHR, textStatus, errorThrown) {},
  });
}

website('.genfile').on('click', function(e) {
    var exporttype = website(this).attr('request');
    var filterstatus = website('#filterstatus').val();
    var srchbyusr = website('#srch').val();
    var startdate= website('#date1').val();
    var enddate= website('#date2').val();
    
    var formdata = {exporttype:exporttype,filterstatus:filterstatus,srchbyusr:srchbyusr,startdate:startdate,enddate:enddate}
    website.ajax({
    url: "coi/exportCoiMgrData",
    data:formdata,
    method: "POST",
    //contentType:'json',
    contentType: "application/x-www-form-urlencoded; charset=UTF-8",
    //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
    dataType: "json",
    cache: false,
    //async:true, /*Cross domain checking*/
    beforeSend: function () { website(".preloder_wraper").fadeIn(); },
    uploadProgress: function (event, position, total, percentComplete) { website(".preloder_wraper").fadeIn(); },
    success: function (response, textStatus, jqXHR) 
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
    {  website('.preloder_wraper').fadeOut();  },
    error:function(response)
    { website('.preloder_wraper').fadeOut();  }
});
});

website('body').on('click','#approve', function(e) 
{
  website("#apprModalyesno").modal("show");
  var reqid = website(this).attr("reqid");
  website("#appryesconfirm").attr("reqid",reqid);
});


website('body').on('click','#appryesconfirm', function(e) 
{
    var reqid = website(this).attr("reqid");
    var formdata = { reqid : reqid };
    website.ajax({
    url: "coi/approveRequest",
    data:formdata,
    method: "POST",
    contentType: "application/x-www-form-urlencoded; charset=UTF-8",
    dataType: "json",
    cache: false,
    beforeSend: function () {website('.preloder_wraper').fadeIn();},
    uploadProgress: function (event, position, total, percentComplete) {},
    success: function (response, textStatus, jqXHR) 
    {
        if(response.logged === true) 
        {
            new PNotify({title: 'Alert',
                text: response.message,
                type: 'university',
                hide: true,
                styling: 'bootstrap3',
                addclass: 'dark '
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
                addclass: 'dark '
                    });     
        }
    },
    complete: function (response) {website('.preloder_wraper').fadeIn();},
    error: function (jqXHR, textStatus, errorThrown) {},
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
            addhtmlnxt += '<tr class="counter"><td>No Audit Trail Found!!!</td></tr>';
        }
        website('#audittrail').html(addhtmlnxt);
    },
    complete: function (response) {},
    error: function (jqXHR, textStatus, errorThrown) {},
  });
});

website('body').on('click','#reject', function(e) 
{
    website("#rejectModal #recommendation").val('');
    website("#rejectModal").modal("show");
    var reqid = website(this).attr("reqid");
    website("#rejectConfirm").attr("reqid",reqid);
});


website('body').on('click','#rejectConfirm', function(e) 
{
    var reqid = website(this).attr("reqid");
    var recommendation = website("#rejectModal #recommendation").val();
    if(recommendation)
    {
        var formdata = { reqid : reqid , recommendation:recommendation};
        website.ajax({
        url: "coi/rejectRequest",
        data:formdata,
        method: "POST",
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        dataType: "json",
        cache: false,
        beforeSend: function () {website('.preloder_wraper').fadeIn();},
        uploadProgress: function (event, position, total, percentComplete) {},
        success: function (response, textStatus, jqXHR) 
        {
            if(response.logged === true) 
            {
                new PNotify({title: 'Alert',
                    text: response.message,
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark '
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
                    addclass: 'dark '
                        });     
            }
        },
        complete: function (response) {website('.preloder_wraper').fadeOut();},
        error: function (jqXHR, textStatus, errorThrown) {website('.preloder_wraper').fadeOut();},
      });
    }
    else
    {
        new PNotify({title: 'Alert',
            text: 'Please fill Recommendation detail.',
            type: 'university',
            hide: true,
            styling: 'bootstrap3',
            addclass: 'dark '
        });   
    }
    
});

website('body').on('click','#return', function(e) 
{
    website("#returnModal #recommendation").val('');
    website("#returnModal").modal("show");
    var reqid = website(this).attr("reqid");
    website("#returnConfirm").attr("reqid",reqid);
});


website('body').on('click','#returnConfirm', function(e) 
{
    var reqid = website(this).attr("reqid");
    var recommendation = website("#returnModal #recommendation").val();
    if(recommendation)
    {
        var formdata = { reqid : reqid , recommendation:recommendation};
        website.ajax({
        url: "coi/returnRequest",
        data:formdata,
        method: "POST",
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        dataType: "json",
        cache: false,
        beforeSend: function () {website('.preloder_wraper').fadeIn();},
        uploadProgress: function (event, position, total, percentComplete) {},
        success: function (response, textStatus, jqXHR) 
        {
            if(response.logged === true) 
            {
                new PNotify({title: 'Alert',
                    text: response.message,
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark '
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
                    addclass: 'dark '
                        });     
            }
        },
        complete: function (response) {website('.preloder_wraper').fadeOut();},
        error: function (jqXHR, textStatus, errorThrown) {website('.preloder_wraper').fadeOut();},
      });
    }
    else
    {
        new PNotify({title: 'Alert',
            text: 'Please fill Recommendation detail.',
            type: 'university',
            hide: true,
            styling: 'bootstrap3',
            addclass: 'dark '
        });   
    }
});

website('body').on('click','#coi_attachment', function(e) 
{
    var attachments = website(this).attr("attachments");
    //console.log(attachments)
    var addhtmlnxt = '';
    if(attachments)
    {
        var attachment = attachments.split(",");
        for(var i=0;i<attachment.length;i++)
        {
            var j=i+1;
            // console.log(response);
            addhtmlnxt += '<tr class="counter">';
            addhtmlnxt += '<td width="5%">'+j+'</td>';
            addhtmlnxt += '<td width="5%"><a  href="'+attachment[i]+'" target="_blank"  class="downlodthfle" style="color:black;"><span class="glyphicon glyphicon-download-alt floatleft"></span></a></td>';                    
            addhtmlnxt += '</tr>';      
        }
        website('#attachment').html(addhtmlnxt);
        website("#attachmentsModal").modal("show");
    }
    else
    {
        new PNotify({title: 'Alert',
               text: 'Attachment not found',
               type: 'university',
               hide: true,
               styling: 'bootstrap3',
               addclass: 'dark ',
             }); 
    }
});
