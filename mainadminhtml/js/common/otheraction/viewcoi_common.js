website(document).ready(function () {
  fetchCoiMgrData();
});


function fetchCoiMgrData()
{
    website.ajax({
    url: "coi/fetchCoiMgrData",
    //data:formdata,
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
                }
                else if(response.managertype == "dept")
                {
                  addhtmlnxt += '<td width="10%">'+response.data[i]['deptMstatus']+'</td>';
                }
                
                addhtmlnxt += '<td width="10%" style="text-align:center">';
                addhtmlnxt += '<i class="fa fa-check" id="approve" reqid="'+response.data[i]["reqid"]+'" title="Approve"></i>';
                addhtmlnxt += '&nbsp;&nbsp;&nbsp;<i class="fa fa-times" id="reject" reqid="'+response.data[i]["reqid"]+'" title="Reject"></i>';
                addhtmlnxt += '&nbsp;&nbsp;&nbsp;<i class="fa fa-exchange" id="return" reqid="'+response.data[i]["reqid"]+'" title="Return"></i>';
                addhtmlnxt += '</td>';
                addhtmlnxt += '<td width="11%" style="text-align:center"><i class="fa fa-list-ul faicon" id="audit_trail" reqid="'+response.data[i]["reqid"]+'" title="Audit Trail"></i></td>';
                addhtmlnxt += '<td width="11%" style="text-align:center">';
                if(response.data[i]["coi_pdfpath"])
                {
                    addhtmlnxt += '<a  href="'+response.data[i]["coi_pdfpath"]+'"  class="downlodthfle" style="color:black;"><span class="glyphicon glyphicon-download-alt floatleft"></span></a>';
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
    },
    complete: function (response) {},
    error: function (jqXHR, textStatus, errorThrown) {},
  });
}

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
  website("#rejectModal").modal("show");
  var reqid = website(this).attr("reqid");
  website("#rejectConfirm").attr("reqid",reqid);
});


website('body').on('click','#rejectConfirm', function(e) 
{
    var reqid = website(this).attr("reqid");
    var recommendation = website("#recommendation").val();
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
    complete: function (response) {website('.preloder_wraper').fadeIn();},
    error: function (jqXHR, textStatus, errorThrown) {},
  });
});

website('body').on('click','#return', function(e) 
{
  website("#returnModal").modal("show");
  var reqid = website(this).attr("reqid");
  website("#returnConfirm").attr("reqid",reqid);
});


website('body').on('click','#returnConfirm', function(e) 
{
    var reqid = website(this).attr("reqid");
    var recommendation = website("#recommendation").val();
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
    complete: function (response) {website('.preloder_wraper').fadeIn();},
    error: function (jqXHR, textStatus, errorThrown) {},
  });
});