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
    var upsitypeid = website('#upsitypeid').val();
    var formdata = {noofrows:noofrows,pagenum:pagenum,upsitypeid:upsitypeid};
    website.ajax({
      url:'mis/fetchinfosharing',
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
        {    console.log(response.resdta[i].category_name);
            var datefrom = response.resdta[i].sharingdate;

            var enddate = response.resdta[i].enddate?response.resdta[i].enddate:'';
            var time = response.resdta[i].sharingtime?response.resdta[i].sharingtime:'';
            var newtime = time.replace(/:[^:]*$/,'');

//            //------------------------- Table Fields Insertion START ------------------------
            addhtmlnxt += '<tr class="counter" aprvllistid="'+response.resdta[i].id+'" >';
            addhtmlnxt += '<td width="10%">'+response.resdta[i].name+'</td>';
            var category = response.resdta[i].category_name;
            if(response.resdta[i].category == 16)
            {
                var category = response.resdta[i].othercategory?response.resdta[i].othercategory:'';
            }
            else if(response.resdta[i].category_name == null)
            {
              var category = 'Employee';
            }
            addhtmlnxt += '<td width="10%">'+category+'</td>';
            addhtmlnxt += '<td width="10%">'+datefrom+'</td>';
            addhtmlnxt += '<td width="10%">'+newtime+'</td>';
            addhtmlnxt += '<td width="10%">'+enddate+'</td>';
            addhtmlnxt += '<td width="10%">'+response.resdta[i].datashared+'</td>';
//            addhtmlnxt += '<td width="10%">'+response.resdta[i].purpose+'</td>';
            addhtmlnxt += '<td width="10%"><i class="fa fa-file" aria-hidden="true" id="upsiattachmnt" filepath="'+response.resdta[i].filepath+'"></i></td>';
            addhtmlnxt += '<td width="5%"><i class="fa fa-bar-chart viewtrail" infoshrid="'+response.resdta[i].id+'"></i></td>';
            addhtmlnxt += '<td width="10%">'+response.resdta[i].fullname+'</td>';
            
            addhtmlnxt += '</tr>';                        
            //------------------------ Table Fields Insertion END ------------------------
        }
        website('.appendrow').html(addhtmlnxt);
        website('.paginationmn').html(response.pgnhtml);
      }
      else
      {
        website('.appendrow').html('<tr><td style="text-align:center;" colspan="13">Data Not Found!!!!</td></tr>');
        website('.paginationmn').html(response.pgnhtml);
      }
    },
    complete: function(response)
    {},
    error: function(jqXHR, textStatus, errorThrown)
    {}
  });
    
    
}

website('body').on("click",".viewtrail",function(e){
    var infoid = website(this).attr('infoshrid');
    var formdata = {infoid:infoid}
    website.ajax({
      url:'sensitiveinformation/fetchinfotrail',
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
            ///console.log(response.data);
           /* for date_added start */
             dteadded = response.data.date_added.split("-");                   
             dteaddedspace = response.data.date_added.split(" ");                    
                     ddmmyyadded = dteaddedspace;
                     dteadded = dteaddedspace[0].split("-");
                     ddmmyyadded = dteadded[2]+'-'+dteadded[1]+'-'+dteadded[0];
                     timesadded = dteaddedspace[1];
            /* for date_added end */
            
            /* for date_added start */
             dtemodified = response.data.date_modified.split("-");                   
             dtemodifdspace = response.data.date_modified.split(" ");                    
                     ddmmyymodified = dtemodifdspace[0];
                     dtemodified = dtemodifdspace[0].split("-");
                     ddmmyymodified = dtemodified[2]+'-'+dtemodified[1]+'-'+dtemodified[0];
                     timesmodified = dtemodifdspace[1];
            /* for date_added end */
            
           website('#Mymodalaudittrail .reqstcreateddte' ).html(ddmmyyadded+' '+timesadded);
           website('#Mymodalaudittrail .reqstupdteddte' ).html(ddmmyymodified+' '+timesmodified);
         
           website('#Mymodalaudittrail').modal('show'); 
        }
        else
        {
            
        }
    },
    complete: function(response)
    {},
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

website('body').on('click','.archiveinfoshr',function(e){
    var upsitype = website(this).attr('upsitype');
    var baseHref = getbaseurl(); 
    window.location.href=baseHref+'mis/archive_missharing?upsitype='+upsitype+'';
});

website('.genfile').on('click', function(e) {
    var upsitypeid = website('#upsitypeid').val();
    var request=website(this).attr('request');
    //console.log(upsitypeid);return false;
    var formdata={request:request,upsitypeid:upsitypeid}
    // alert(request);return false;
    website.ajax({
        url:'mis/ExportSharedInfo',
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
                new PNotify({title: response.message,
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

website('body').on('click','#upsiattachmnt',function()
{
    var filepath = website(this).attr('filepath');
    //console.log(filepath);
    if(filepath)
    {
        filepath = filepath.split(',');
        var addhtml = '';
        addhtml+= '<table class="table datatable-responsive" width="100%" border="1"><tr><th>Sr No.</th><th>Attachment</th></tr>';
        for(var i=0;i<filepath.length;i++)
        {
            var j = i;
            j++;
            addhtml+= '<tr><td width="50%">'+j+'.</td>';
            addhtml += '<td width="50%"><i class="fa fa-download getfile" filepath="'+filepath[i]+'" d="uploadattached1" aria-hidden="true"></i></td></tr>';
        }
        addhtml+= '</tr></table>';
        website('#modalupsiattachmnt .upsifilepath').html(addhtml);  
        website('#modalupsiattachmnt').modal('show');  
    }
    else
    {
        new PNotify({title: 'Alert!!',
                  text: 'File not available',
                  type: 'university',
                  hide: true,
                  styling: 'bootstrap3',
                  addclass: 'dark ',
              });
    }
    
});