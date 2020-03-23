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

website('#insertblackoutperiod').ajaxForm({
    //method:'POST',
    //contentType:'json',
    //contentType:'application/x-www-form-urlencoded; charset=UTF-8',
    //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
    dataType:"json",
    beforeSend: function()
    { /*website('.preloder_wraper').fadeIn();*/},
    uploadProgress: function(event, position, total, percentComplete)
    {  /*website('.preloder_wraper').fadeIn();*/ },
    success: function(response, textStatus, jqXHR)
    {
        if(response.logged===true)
        {  

            //website('#myModalemail').modal('show');

            new PNotify({title: 'Alert!!',
                  text: response.message,
                  type: 'university',
                  hide: true,
                  styling: 'bootstrap3',
                  addclass: 'dark ',
            }); 

              window.location.reload();
        }
        else
        {
            new PNotify({title: 'Record Not Added',
                    text: response.message,
                    type: 'university',
                    hide: true,
                    styling: 'bootstrap3',
                    addclass: 'dark ',
                });
        }
    },
    complete: function(response)
    {  website('.preloder_wraper').fadeOut(); },
    error: function(jqXHR, textStatus, errorThrown)
    {   }
});

function getdataonload()
{
    website.ajax({
      url:'blackoutperiod/fetchblackoutperiod',
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
//            var date = response.resdta[i].date_modified;
//            date = date.split(' ')[0];
//            dtfrmt = date.split("-"); 
//            dtfrmtspace = date.split(" ");                    
//            ddmmyy = dtfrmtspace[0];
//            dtfrmt = dtfrmtspace[0].split("-");
//            ddmmyy = dtfrmt[2]+'-'+dtfrmt[1]+'-'+dtfrmt[0];
            
             //for restriction from
            var blckdatefrom = response.resdta[i].datefrom;
//            datefrom = blckdatefrom.split(' ')[0];
//            dtfrmtfrom = blckdatefrom.split("-"); 
//            dtfrmtspacefrom = blckdatefrom.split(" ");                    
//            ddmmyyfrom = dtfrmtspacefrom[0];
//            dtfrmtfrom = dtfrmtspacefrom[0].split("-");
//            ddmmyyfrom = dtfrmtfrom[2]+'-'+dtfrmtfrom[1]+'-'+dtfrmtfrom[0];
            
             //for restriction to
            
                var blckdateto = response.resdta[i].dateto;
//                dateto = blckdateto.split(' ')[0];
//                dtfrmtto = blckdateto.split("-"); 
//                dtfrmtspaceto = blckdateto.split(" ");                    
//                ddmmyyto = dtfrmtspaceto[0];
//                dtfrmtto = dtfrmtspaceto[0].split("-");
//                ddmmyyto = dtfrmtto[2]+'-'+dtfrmtto[1]+'-'+dtfrmtto[0];
           
       
//            //------------------------- Table Fields Insertion START ------------------------
            addhtmlnxt += '<tr class="counter" aprvllistid="'+response.resdta[i].id+'" >';
            addhtmlnxt += '<td width="25%">'+response.resdta[i].companyname+'</td>';
            addhtmlnxt += '<td width="25%">'+blckdatefrom+'</td>';
            addhtmlnxt += '<td width="25%">'+blckdateto+'</td>';
            if(response.user_group_id == '2' || response.user_group_id == '14')
            {
              addhtmlnxt += '<td width="25%" ><i class="fa fa-trash-o faicon floatleft deleteblackoutcmp" title="Delete entry" blckoutcmpid="'+response.resdta[i].id+'" ></i></td>';  
            }
            else
            {
                
            }
            
            
            
            addhtmlnxt += '</tr>';                        
            //------------------------ Table Fields Insertion END ------------------------
        }
        website('.appendrow').html(addhtmlnxt);
        website('#datableabhi').DataTable();
      }
      else
      {
        website('.appendrow').html('<tr><td colspan="4" style="text-align:center;">No Data Found</td></tr>');
      }
    },
    complete: function(response)
    {},
    error: function(jqXHR, textStatus, errorThrown)
    {}
  });
    
    
}





/************** for search **********/

var timer = 0;
function mySearch (){ 
    var getvalue = website('.header-search-input').val();
    doSearch(getvalue); 
}

website('.header-search-input').on('keyup', function(e){
    var getkeycode = website.trim(e.keyCode);
     if (getkeycode != '40' && getkeycode !='38' && getkeycode != '13'){
        if (timer) {
            clearTimeout(timer);
        }
        timer = setTimeout(mySearch, 400); 
     }
});


website( "#live-search-header-wrapper" ).scroll(function() {
  //console.log('got it');
});


function myCustomFn(el){
   // console.log('coming here');
}

website("#live-search-header-wrapper").mCustomScrollbar({
        scrollButtons:{enable:true,scrollType:"stepped"},
        keyboard:{scrollType:"stepped"},
        mouseWheel:{scrollAmount:188},
        theme:"rounded-dark",
        autoExpandScrollbar:true,
        snapAmount:188,
        snapOffset:65,
        callbacks:{
            onScroll:function(){
                myCustomFn(this);
            }
        }
}); 


function doSearch(getvalue)
{
    //console.log(getvalue);return false;
  var getkeyword = getvalue;
  if(website.trim(getkeyword)=="")
  {
    website('#live-search-header-wrapper ul').html('<li class="noresultfound">No Result Found!!!!</li>');
  }
  else
  {
  var formdata = {searchvallist:getkeyword,geturl:''}
    website.ajax({
      url:'blackoutperiod/companymaster',
      //url:'template/templatedetails',   
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
                website('#live-search-header-wrapper').fadeIn();
        website('#live-search-header-wrapper ul').html("<li>Please wait...</li>");
                website('.mainprogressbarforall .progress').fadeIn();
                website('.filtr-container').html("");
                website('.filtr-container').removeAttr("style");
                website('.filtr-search').fadeIn();
                website('.filtr-search').val("");
      },
      uploadProgress: function(event, position, total, percentComplete) 
      {
                website('#live-search-header-wrapper').fadeIn();
        website('#live-search-header-wrapper ul').html("<li>Please wait...</li>");
                website('.mainprogressbarforall .progress').fadeIn();
                website(".mainprogressbarforall .progress .progress-bar").width(percentComplete+'%');
                
      },
      success: function(response, textStatus, jqXHR) 
      {
        var addhtml='';
        website('#live-search-header-wrapper ul').html("");  
        website('#live-search-header-wrapper').fadeIn();
                
        if (response.logged == true && response.data.length>=1) 
                {         
          //console.log(response.data);return false;
          for(var i = 0; i < response.data.length; i++) 
                    {   
            if(i==0)
            {                           
              addhtml += '<li cmpid="'+response.data[i].id+'" companyname="'+response.data[i].companyname+'" class="topul validatorsid">'+response.data[i].companyname;
              //addhtml += '<a target="_blank" href="profile/willline/'+response.data[i].cid+'" class="floatleft searchavtarname">'+response.data[i].comanyname+'</a>';
              addhtml += '<div class="clearelement"></div></li>';
            }
            else if(i==((response.data.length)-1))
            {
              addhtml += '<li cmpid="'+response.data[i].id+'" companyname="'+response.data[i].companyname+'"  class="bottomul validatorsid">'+response.data[i].companyname;
              //addhtml += '<a target="_blank" href="profile/willline/'+response.data[i].cid+'" class="floatleft searchavtarname">'+response.data[i].comanyname+'</a>';
              addhtml += '<div class="clearelement"></div></li>';
              
            }
            else
            {
              addhtml += '<li cmpid="'+response.data[i].id+'" companyname="'+response.data[i].companyname+'"  class="bottomul validatorsid">'+response.data[i].companyname;
              //addhtml += '<a target="_blank" href="profile/willline/'+response.data[i].cid+'" class="floatleft searchavtarname">'+response.data[i].comanyname+'</a>';
              addhtml += '<div class="clearelement"></div></li>';
            }
          }
          website('#live-search-header-wrapper ul').html(addhtml);
          //window.location.reload();
        }
        else
        {
          website('#live-search-header-wrapper ul').html('<li class="noresultfound"><span class="resp_new">'+response.message+'</span></li>');
        }
        website(".mainprogressbarforall .progress .progress-bar").width('100%');
      },
      complete: function(response) 
      {
                website('.search-row').fadeIn();
                website(".mainprogressbarforall .progress .progress-bar").fadeOut();
      },
      error: function(jqXHR, textStatus, errorThrown)
      {
        //website('#live-search-header-wrapper ul').fadeOut();      
      }
    }); 
  }
  
}

/* ------- operation on companydatali li start ------- */ 

website('body').on('click','.validatorsid',function(e){
   
       var compid = website(this).attr('cmpid');
       var compname = website(this).attr('companyname');
       website('#insertblackoutperiod #search-box').val(compname);
       website('#search-box').attr('compid',compid);
       website('#search-box').attr('compname',compname);
       website('#insertblackoutperiod #compid').val(compid);
       website('#live-search-header-wrapper').fadeOut();       
       
       website('#insertblackoutperiod #cmpname').val(compname);
       website('#validators').attr('compid',compid);
       website('#validators').attr('compnyname',compname);
    });


website('body').on('click','.deleteblackoutcmp', function(){
    var id = website(this).attr('blckoutcmpid');
    //console.log(id);return false;
    website('#myModalyesno').modal('show');
    website('#myModalyesno .yesconfirm').attr('blckoutcmpid',id);
});

website('body').on('click','.yesconfirm', function(){
    
    var id = website(this).attr('blckoutcmpid');
    //console.log(id);return false;
    var formdata = {id:id};
    website.ajax({
        
      url:'blackoutperiod/blackoutperioddelete',
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
           if(response.logged === true)
           {
              //fetchmasterlist();
              window.location.reload();
              //website('#Mymodaledit').fadeOut();
              new PNotify({title: 'Record Deleted Successfully',
                  text: 'Record Deleted Successfully',
                  type: 'university',
                  hide: true,
                  styling: 'bootstrap3',
                  addclass: 'dark ',
              }); 
           }
           else
           {    
              new PNotify({title: 'Record Not Deleted',
                  text: 'Record Not Updated',
                  type: 'university',
                  hide: true,
                  styling: 'bootstrap3',
                  addclass: 'dark ',
              });
           }
        },
        complete: function(response) 
        {
            website('#myModalyesno .mainprogressbarforall').fadeOut(); 
        },
        error: function() 
        {   }
    });
});

website('body').on('click','.sendemail',function(e){
    var emailcontent = website('#content').val();
    var formdata = {emailcontent:emailcontent};
    website.ajax({
       url:'blackoutperiod/sendmailtoallusers',
      data:formdata,
      method:'POST',
      //contentType:'json',
      contentType:'application/x-www-form-urlencoded; charset=UTF-8',
      //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
      dataType:"json",
      cache:false,
      //async:true, /*Cross domain checking*/
      beforeSend: function()
      {  website('.preloder_wraper').fadeIn(); },
      uploadProgress: function(event, position, total, percentComplete)
      {  website('.preloder_wraper').fadeIn();  },
        success: function(response, textStatus, jqXHR) 
        {
           if(response.logged === true)
           {
              //fetchmasterlist();
              // website('#myModalemail').modal('hide');
            
              //website('#Mymodaledit').fadeOut();
              new PNotify({title: 'Alert!!',
                  text: response.message,
                  type: 'university',
                  hide: true,
                  styling: 'bootstrap3',
                  addclass: 'dark ',
              }); 

              window.location.reload();
           }
           else
           {    
              new PNotify({title: 'Alert!!',
                  text: response.message,
                  type: 'university',
                  hide: true,
                  styling: 'bootstrap3',
                  addclass: 'dark ',
              });
           }
        },
        complete: function(response) 
        {   website('.preloder_wraper').fadeOut();
            website('#myModalyesno .mainprogressbarforall').fadeOut(); 
        },
        error: function() 
        {   }
    });
});

