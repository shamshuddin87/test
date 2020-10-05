
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

website('body').on('click','#emp_status', function(e) 
{
    getdataonload();
});

 getdataonload();
function getdataonload()
{
    var noofrows = website('#noofrows').val(); 
    var pagenum = website('#pagenum').val();
    var emp_status = website('#emp_status').val();
    var formdata = {noofrows:noofrows,pagenum:pagenum,emp_status:emp_status};
    website.ajax({
      url:'mis/fetchallupsitypes',
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
            var myhtml='';
            //console.log(response.resdta);
            for(var i=0;i<response.resdta.length;i++)
            {
                var j=i+1;
                var enddate = response.resdta[i]['enddate']?response.resdta[i]['enddate']:'';
                myhtml+='<tr class="getallups" upsid="'+response.resdta[i]['uppid']+'">';
                myhtml+='<td>'+j+'</td>';
                myhtml+='<td>'+response.resdta[i]['upsitype']+'</td>';
                myhtml+='<td>'+response.resdta[i]['projstartdate']+'</td>';
                myhtml+='<td>'+enddate+'</td>';
                myhtml+='<td>'+response.resdta[i]['dtadd']+'</td>';
                myhtml+='<td>'+response.resdta[i]['fullname']+'</td>';
                if(response.resdta[i].emp_status == '1')
                {
                    myhtml+='<td>Active</td>';
                }
                else if(response.resdta[i].emp_status == '2')
                {
                    myhtml+='<td>Resigned</td>';
                }
                else if(response.resdta[i].emp_status == '3')
                {
                    myhtml+='<td>Not a DP</td>';
                }
                myhtml+='</tr>';
            }

             website('.appendrow').html(myhtml);
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

website('body').on('click','.getallups', function(e) 
{
    var baseHref = getbaseurl();
    var upsid =website(this).attr('upsid');
   
    window.location.href =baseHref+"mis/mis_infosharing?upsid="+upsid;
});
  website('.genfile').on('click', function(e) {
    var request=website(this).attr('request');
    var emp_status = website("#emp_status").val();
    var formdata={request:request,emp_status:emp_status}
    // alert(request);return false;
 website.ajax({
        url:'mis/fetchallupsiexport',
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

