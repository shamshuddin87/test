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

   website('#insertinfosharing').ajaxForm({
      //method:'POST',
      //contentType:'json',
      //contentType:'application/x-www-form-urlencoded; charset=UTF-8',
      //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
      dataType:"json",
      beforeSend: function()
      { website('.preloder_wraper').fadeIn();},
      uploadProgress: function(event, position, total, percentComplete)
      {  website('.preloder_wraper').fadeIn(); },
      success: function(response, textStatus, jqXHR)
      {
        if(response.logged===true)
        {  
          new PNotify({title: 'Record Added Successfully',
            text: response.message,
            type: 'university',
            hide: true,
            styling: 'bootstrap3',
            addclass: 'dark ',
          });
         window.location.reload();
            getdataonload();
          //window.location.reload();
           
            
        }else{
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
  //});
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
    var upsitypeid = website('#upsitypeid').val(); 
    var noofrows = website('#noofrows').val(); 
    var pagenum = website('#pagenum').val();
    var formdata = {noofrows:noofrows,pagenum:pagenum,upsitypeid:upsitypeid};
    website.ajax({
      url:'sensitiveinformation/fetchinfosharing',
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
            
          //console.log(response.resdta); 
          var addhtmlnxt='';
            
        for(var i = 0; i < response.resdta.length; i++) 
        {
            var name = ''
            if(response.resdta[i].recipienttype=='connected person')
            {
                name = response.resdta[i].name?response.resdta[i].name:'';
            }
            else if(response.resdta[i].recipienttype=='userlist')
            {
                name = response.resdta[i].username?response.resdta[i].username:'';
            }
            var category = response.resdta[i].category_name?response.resdta[i].category_name:'';
            var enddate = response.resdta[i].enddate?response.resdta[i].enddate:'';
            var datefrom = response.resdta[i].sharingdate;
            var upsiname = response.resdta[i].upsiname;
             // alert(upsitype);
            var time = response.resdta[i].sharingtime?response.resdta[i].sharingtime:'';
            var newtime = time.replace(/:[^:]*$/,'');

//            //------------------------- Table Fields Insertion START ------------------------
            addhtmlnxt += '<tr class="counter" aprvllistid="'+response.resdta[i].id+'" >';
            addhtmlnxt += '<td width="10%">'+name+'</td>';
            if(response.resdta[i].category == 16)
            {
                category = response.resdta[i].othercategory?response.resdta[i].othercategory:'';
            }
            addhtmlnxt += '<td width="10%">'+category+'</td>';
            addhtmlnxt += '<td width="10%">'+datefrom+'</td>';
            addhtmlnxt += '<td width="5%">'+newtime+'</td>';
            addhtmlnxt += '<td width="10%">'+enddate+'</td>';
            addhtmlnxt += '<td width="10%">'+response.resdta[i].datashared+'</td>';
//            addhtmlnxt += '<td width="10%">'+response.resdta[i].purpose+'</td>';
            addhtmlnxt += '<td width="10%">'+upsiname+'</td>';
            addhtmlnxt += '<td width="10%"><i class="fa fa-file" aria-hidden="true" id="upsiattachmnt" filepath="'+response.resdta[i].filepath+'"></i></td>';
            
//            if(response.resdta[i].filepath)
//            {
//                addhtmlnxt += '<td width="10%"><i class="fa fa-download getfile" filepath="'+response.resdta[i].filepath+'" d="uploadattached1" aria-hidden="true"></i></td>';
//            }
//            else
//            {
//                addhtmlnxt += '<td width="10%"></td>';
//            }
            addhtmlnxt += '<td width="5%"><i class="fa fa-bar-chart viewtrail" infoshrid="'+response.resdta[i].id+'"></i></td>';
            addhtmlnxt += '<td width="10%">'+response.resdta[i].fullname+'</td>';
            addhtmlnxt += '<td width="25%">';

            if(response.getaccess[0].upsi_infoshare_delete && response.getaccess[0].upsi_infoshare_delete==1)
            {
                addhtmlnxt += '<i class="fa fa-trash-o faicon floatleft deleterestrictedcmp" title="Delete entry" aprvllistid="'+response.resdta[i].id+'" ></i>';
            }
            else
            {
                addhtmlnxt+='';
                // alert();
            }

            if(enddate == '')
            {
                addhtmlnxt += '<i class="fa fa-edit faicon floatleft editenddate" title="View entry" infoidtid="'+response.resdta[i].id+'"></i>';
            }
            
            addhtmlnxt += '</td>';  
            addhtmlnxt += '</tr>';     
     
            //------------------------ Table Fields Insertion END ------------------------
            //hide edit field <i class="fa fa-edit faicon floatleft editrestrictedcmp" title="Edit entry" aprvllistid="'+response.resdta[i].id+'"></i>
        }
	             if(response.getaccess[0].upsi_infoshare_add && response.getaccess[0].upsi_infoshare_add==1)
	              {
	              	   
	                  website('.formelementmain').css('display','block');

                 
	              }       
	              else
	              {
	              	    // alert();
	                    website('.formelementmain').css('display','none');
                        
                        //  new PNotify({title: 'You Do Not Have Access To Add Info Sharing',
                        //   text:"Please Contact To Your Admin",
                        //   type: 'university',
                        //   hide: true,
                        //   styling: 'bootstrap3',
                        //   addclass: 'dark ',
                        // });
                          website('#alertcommon #allalertmsg').html("You Do Not Have Access To Add Info Sharing");
                          website('#alertcommon').modal('show');
	              }      

	                if(response.getaccess[0].upsi_infoshare_view==1)
	              {
	              	   // alert(1);
	                  website('.table-responsive.table_wraper ').css('display','block');
	                  website('.appendrow').html(addhtmlnxt);
	                  website('.paginationmn').html(response.pgnhtml);
	              }       
	              else
	              {
	              	    
	                    website('.table-responsive.table_wraper ').css('display','none');

                         website('#alertcommon #allalertmsg').html("You Do Not Have Access To View This Section");
                         website('#alertcommon').modal('show');
	              }      
	        
	//        website('#datableabhi').DataTable();
      }
      else
      {
   
                 if(response.getaccess[0].upsi_infoshare_add==1)
	              {
	              	   // alert(1);
	                  website('.formelementmain').css('display','block');
	              }       
	              else
	              {
	              	    // alert();
	                    website('.formelementmain').css('display','none');
                      
                        website('#alertcommon #allalertmsg').html("You Do Not Have Access To Add Info Sharing");
                        website('#alertcommon').modal('show');
	              }      

	              if(response.getaccess[0].upsi_infoshare_view==1)
	              {
	                  website('.table-responsive.table_wraper ').css('display','block');
	                  website('.appendrow').html('<tr><td style="text-align:center;" colspan="14">Data Not Found!!!!</td></tr>');
	                  website('.paginationmn').html(response.pgnhtml);
	              }       
	              else
	              {
	                    website('.table-responsive.table_wraper ').css('display','none');

                        //  new PNotify({title: 'You Do Not Have Access To View This Section',
                        //   text:"Please Contact To Your Admin",
                        //   type: 'university',
                        //   hide: true,
                        //   styling: 'bootstrap3',
                        //   addclass: 'dark ',
                        // });
                        website('#alertcommon #allalertmsg').html("You Do Not Have Access To View This Section");
                        website('#alertcommon').modal('show');
	              }       
      
      }
    },
    complete: function(response)
    {},
    error: function(jqXHR, textStatus, errorThrown)
    {}
  });
    
    
}

website('body').on('click','.editrestrictedcmp', function(){
var id = website(this).attr('aprvllistid');
    var formdata = {id:id};
    
    website.ajax({
      url:'sensitiveinformation/fetchinfosharingforedit',
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
            //console.log(response.data);return false;
            var datefrom = response.data['0'].date;
            datefrom = datefrom.split(' ')[0];
            dtfrmtfrom = datefrom.split("-"); 
            dtfrmtspacefrom = datefrom.split(" ");                    
            ddmmyyfrom = dtfrmtspacefrom[0];
            dtfrmtfrom = dtfrmtspacefrom[0].split("-");
            ddmmyyfrom = dtfrmtfrom[2]+'-'+dtfrmtfrom[1]+'-'+dtfrmtfrom[0];
            var appendhtml= '';  
            
            website("#Mymodaledit #name").val(response.data['0'].name);
            website("#Mymodaledit #date").val(ddmmyyfrom);
            website("#Mymodaledit #datashared").val(response.data['0'].datashared);
            website("#Mymodaledit #purpose").val(response.data['0'].purpose);
            
           
            website('#updateinfosharing #tempid').val(id);
            website('#updateinfosharing #filepath').val(response.data['0'].filepath);
            website('#Mymodaledit').modal('show');
            
     }
      else
      {
        website('.appendrowwaprvl').html('');
      }
    },
    complete: function(response)
    {},
    error: function(jqXHR, textStatus, errorThrown)
    {}
  });
    
    
});

website('body').on('click','.editenddate', function(){
var id = website(this).attr('infoidtid');
website('#updateenddate #tempid').val(id);
website('#Mymodalenddateedit').modal('show');
});


website('#updateinfosharing').ajaxForm({
        //data:formdata,
        //contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        dataType:"json",
        beforeSend: function() 
        {   
            website('.preloder_wraper').fadeIn();  },
        uploadProgress: function(event, position, total, percentComplete) 
        { website('#Mymodaledit').modal('hide');
         website('.preloder_wraper').fadeIn();},
        success: function(response, textStatus, jqXHR) 
        {
           if(response.logged === true)
           {
              //fetchmasterlist();
              
              //website('#Mymodaledit').fadeOut();
              new PNotify({title: 'Record Updated Successfully',
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
              new PNotify({title: 'Record Not Updated',
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
            website('#Mymodaledit .mainprogressbarforall').fadeOut(); 
        },
        error: function() 
        {   }
    });


website('#updateenddate').ajaxForm({
        //data:formdata,
        //contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        dataType:"json",
        beforeSend: function() 
        {   
            website('.preloder_wraper').fadeIn();  },
        uploadProgress: function(event, position, total, percentComplete) 
        { website('#Mymodaledit').modal('hide');
         website('.preloder_wraper').fadeIn();},
        success: function(response, textStatus, jqXHR) 
        {
           if(response.logged === true)
           {
              //fetchmasterlist();
              
              //website('#Mymodaledit').fadeOut();
              new PNotify({title: 'Record Updated Successfully',
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
              new PNotify({title: 'Record Not Updated',
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
            website('.preloder_wraper').fadeOut();
            website('#Mymodaledit .mainprogressbarforall').fadeOut(); 
        },
        error: function() 
        {   }
    });

website('body').on('click','.deleterestrictedcmp', function(){
    var id = website(this).attr('aprvllistid');
    //console.log(id);return false;
    website('#myModalyesno').modal('show');
    website('#myModalyesno .yesconfirm').attr('aprvllistid',id);
});

website('body').on('click','.yesconfirm', function(){
    
    var id = website(this).attr('aprvllistid');
    //console.log(id);return false;
    var formdata = {id:id};
    website.ajax({
        
      url:'sensitiveinformation/infosharingfordelete',
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

function numberalphOnly() 
{
            var charCode = event.keyCode;
    
            if ((charCode > 47 && charCode < 58) || charCode == 32 || (charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || charCode == 8 || charCode == 44 || charCode == 40 || charCode == 41 || charCode == 46 || charCode == 47)

                return true;
            else
                return false;
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

var timer = 0;
function mySearchforedit (){ 
    var getvalue = website('#Mymodaledit .header-search-input').val();
    doSearchforedit(getvalue); 
}

website('#Mymodaledit .header-search-input').on('keyup', function(e){
    var getkeycode = website.trim(e.keyCode);
     if (getkeycode != '40' && getkeycode !='38' && getkeycode != '13'){
        if (timer) {
            clearTimeout(timer);
        }
        timer = setTimeout(mySearchforedit, 400); 
     }
});

website( "#live-search-header-wrapper" ).scroll(function() {
  //console.log('got it');
});

website( "#Mymodaledit #live-search-header-wrapper" ).scroll(function() {
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

website("#Mymodaledit #live-search-header-wrapper").mCustomScrollbar({
        scrollButtons:{enable:true,scrollType:"stepped"},
        keyboard:{scrollType:"stepped"},
        mouseWheel:{scrollAmount:188},
        theme:"rounded-dark",
        autoExpandScrollbar:true,
        snapAmount:188,
        snapOffset:65,
        callbacks:{
            onScroll:function(){
                //myCustomFn(this);
            }
        }
}); 

function doSearch(getvalue)
{
  var getkeyword = getvalue;
  if(website.trim(getkeyword)=="")
  {
    website('#live-search-header-wrapper ul').html('<li class="noresultfound">No Result Fould!!!!</li>');
  }
  else
  {
  var formdata = {searchvallist:getkeyword,geturl:''}
    website.ajax({
      url:'sensitiveinformation/namelists',
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
         // console.log(response.data);
          for(var i = 0; i < response.data.length; i++) 
          {   
            var categoryname = ''; 
            var name = ''; 
            var category = ''; 
            var rectype = '';

            if(response.data[i].category != null)
            {
                  rectype = 'connected person';
                  if(response.data[i].category == '16')
                  {
                       categoryname = response.data[i].othercategory;
                       name = response.data[i].name;
                       email = response.data[i].email;
                       category = response.data[i].category;
                       id = response.data[i].id;
                       wr_id = '';
                  }
                  else if(response.data[i].category == '14')
                  {
                       categoryname = response.data[i].categoryname;
                        name = response.data[i].name;
                        email = response.data[i].email;
                        category = response.data[i].category;
                        id = response.data[i].id;
                        
                        wr_id = response.data[i].wr_id;
                  }
                  else
                  {
                    categoryname = response.data[i].categoryname;
                     name = response.data[i].name;
                      email = response.data[i].email;
                       category = response.data[i].category;
                         id = response.data[i].id;
                         wr_id = '';
                  }


            }
            else
            {
              rectype = 'userlist';
              categoryname ='Employee';
              name = response.data[i].fullname;
              category = 14;
              id = response.data[i].wr_id;
              email = response.data[i].email;
              wr_id = response.data[i].wr_id;
            }



           
              addhtml += '<li rec_id="'+id+'" rec_type="'+rectype+'" name="'+name+'" category ="'+category+'"  email ="'+email+'"  categoryname="'+categoryname+'"  wr_id = "'+wr_id+'"  class="bottomul validatorsid">'+name;
              //addhtml += '<a target="_blank" href="profile/willline/'+response.data[i].cid+'" class="floatleft searchavtarname">'+response.data[i].comanyname+'</a>';
              addhtml += '<div class="clearelement"></div></li>';
            
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

function doSearchforedit(getvalue)
{  
  var getkeyword = getvalue;
  if(website.trim(getkeyword)=="")
  {
    website('#Mymodaledit #live-search-header-wrapper ul').html('<li class="noresultfound">No Result Fould!!!!</li>');
  }
  else
  {
  var formdata = {searchvallist:getkeyword,geturl:''}
    website.ajax({
      url:'sensitiveinformation/namelists',
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
                website('#Mymodaledit #live-search-header-wrapper').fadeIn();
        website('#Mymodaledit #live-search-header-wrapper ul').html("<li>Please wait...</li>");
                website('#Mymodaledit .mainprogressbarforall .progress').fadeIn();
                website('#Mymodaledit .filtr-container').html("");
                website('#Mymodaledit .filtr-container').removeAttr("style");
                website('#Mymodaledit .filtr-search').fadeIn();
                website('#Mymodaledit .filtr-search').val("");
      },
      uploadProgress: function(event, position, total, percentComplete) 
      {
        website('#Mymodaledit #live-search-header-wrapper').fadeIn();
        website('#Mymodaledit #live-search-header-wrapper ul').html("<li>Please wait...</li>");
        website('#Mymodaledit .mainprogressbarforall .progress').fadeIn();
        website("#Mymodaledit .mainprogressbarforall .progress .progress-bar").width(percentComplete+'%');
                
      },
      success: function(response, textStatus, jqXHR) 
      {
        var addhtml='';
        website('#Mymodaledit #live-search-header-wrapper ul').html("");  
        website('#Mymodaledit #live-search-header-wrapper').fadeIn();
                
        if (response.logged == true && response.data.length>=1) 
        {         
          //console.log(response.data);
          for(var i = 0; i < response.data.length; i++) 
            {   
            if(i==0)
            {                           
              addhtml += '<li rec_id="'+response.data[i].id+'" name="'+response.data[i].name+'" category ="'+response.data[i].category+'"  categoryname="'+categoryname+'" class="topul validatorsid">'+response.data[i].name;
              //addhtml += '<a target="_blank" href="profile/willline/'+response.data[i].cid+'" class="floatleft searchavtarname">'+response.data[i].comanyname+'</a>';
              addhtml += '<div class="clearelement"></div></li>';
            }
            else if(i==((response.data.length)-1))
            {
              addhtml += '<li rec_id="'+response.data[i].id+'" name="'+response.data[i].name+'" category ="'+response.data[i].category+'"  categoryname="'+categoryname+'" class="bottomul validatorsid">'+response.data[i].name;
              //addhtml += '<a target="_blank" href="profile/willline/'+response.data[i].cid+'" class="floatleft searchavtarname">'+response.data[i].comanyname+'</a>';
              addhtml += '<div class="clearelement"></div></li>';
              
            }
            else
            {
              addhtml += '<li rec_id="'+response.data[i].id+'" name="'+response.data[i].name+'" category ="'+response.data[i].category+'"  categoryname="'+categoryname+'" class="bottomul validatorsid">'+response.data[i].name;
              //addhtml += '<a target="_blank" href="profile/willline/'+response.data[i].cid+'" class="floatleft searchavtarname">'+response.data[i].comanyname+'</a>';
              addhtml += '<div class="clearelement"></div></li>';
            }
          }
          website('#live-search-header-wrapper ul').html(addhtml);
          //window.location.reload();
        }
        else
        {
          website('#Mymodaledit #live-search-header-wrapper ul').html('<li class="noresultfound"><span class="resp_new">'+response.message+'</span></li>');
        }
        website("#Mymodaledit .mainprogressbarforall .progress .progress-bar").width('100%');
      },
      complete: function(response) 
      {
                website('#Mymodaledit .search-row').fadeIn();
                website("#Mymodaledit .mainprogressbarforall .progress .progress-bar").fadeOut();
      },
      error: function(jqXHR, textStatus, errorThrown)
      {
        //website('#live-search-header-wrapper ul').fadeOut();      
      }
    }); 
  }
  
}

/* ------- operation on onclick on search list  ------- */ 

    website('body').on('click','.validatorsid',function(e){

   
       var recid = website(this).attr('rec_id');
       var rectype = website(this).attr('rec_type');
       var name = website(this).attr('name');
       var cate = website(this).attr('category');
       var categoryname = website(this).attr('categoryname');
       var email = website(this).attr('email');
       var wr_id = website(this).attr('wr_id');
       
       
        
       website('#insertinfosharing #search-box').val(name);
       website('#search-box').attr('recid',recid);
       website('#search-box').attr('recname',name);
       website('#insertinfosharing #recid').val(recid);
       website('#insertinfosharing #rectype').val(rectype);
       website('#insertinfosharing #category').val(cate);
       website('#insertinfosharing #emailforsendmail').val(email);
       website('#live-search-header-wrapper').fadeOut();       
       
       website('#insertinfosharing #name').val(name);
       website('#insertinfosharing #categoryname').val(categoryname);
       website('#insertinfosharing #wr_id').val(wr_id);
       website('#validators').attr('recid',recid);
       website('#validators').attr('recname',name);
    });


    website('body').on('click','#Mymodaledit .validatorsid',function(e){
   
       var recid = website(this).attr('rec_id');
       var name = website(this).attr('name');
       var cate = website(this).attr('category');
       var categoryname = website(this).attr('categoryname');
       //alert(fullname);
       website('#updateinfosharing #search-box').val(name);
       website('#Mymodaledit #search-box').attr('recid',recid);
       website('#Mymodaledit #search-box').attr('recname',name);

       website('#Mymodaledit #live-search-header-wrapper').fadeOut();       
       
       website('#updateinfosharing #recid').val(recid);
       website('#updateinfosharing #category').val(cate);
       website('#updateinfosharing #name').val(name);
       website('#insertinfosharing #categoryname').val(categoryname);
       website('#Mymodaledit #validators').attr('recid',recid);
       website('#Mymodaledit #validators').attr('recname',name);
    });

    website(function() {
            //Initialize filterizr with default options
            //website('.filtr-container').filterizr();
    });
website(".time_of_data").inputmask();

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
//            console.log(response.data);
           /* for date_added start */
             dteadded = response.data.date_added.split("-");                   
             dteaddedspace = response.data.date_added.split(" ");                    
                     ddmmyyadded = dteaddedspace;
                     dteadded = dteaddedspace[0].split("-");
                     ddmmyyadded = dteadded[2]+'-'+dteadded[1]+'-'+dteadded[0];
                     timesadded = dteaddedspace[1];
            /* for date_added end */
            
            /* for date_modified start */
             dtemodified = response.data.date_modified.split("-");                   
             dtemodifdspace = response.data.date_modified.split(" ");                    
                     ddmmyymodified = dtemodifdspace[0];
                     dtemodified = dtemodifdspace[0].split("-");
                     ddmmyymodified = dtemodified[2]+'-'+dtemodified[1]+'-'+dtemodified[0];
                     timesmodified = dtemodifdspace[1];
            /* for date_modified end */
            
           website('#Mymodalaudittrail .reqstcreateddte' ).html(ddmmyyadded+' '+timesadded);
           website('#Mymodalaudittrail .reqstupdteddte' ).html(ddmmyymodified+' '+timesmodified);
         
           website('#Mymodalaudittrail').modal('show'); 
        }
        else
        {
            new PNotify({title: 'Alert!!',
                  text: 'Something Went Wrong',
                  type: 'university',
                  hide: true,
                  styling: 'bootstrap3',
                  addclass: 'dark ',
              });
        }
    },
    complete: function(response)
    {},
    error: function(jqXHR, textStatus, errorThrown)
    {}
  });
    
});

website('body').on('click','.archiveinfoshr',function(e){
    var baseHref = getbaseurl(); 
    window.location.href=baseHref+'sensitiveinformation/archive_infosharing';
});

//--------------------------------GET DECRYPT FILE---------------------------//

website('body').on('click','.getfile',function(e){
    // var baseHref = getbaseurl(); 
    // window.location.href=baseHref+'sensitiveinformation/archive_infosharing';
     filepath=website(this).attr('filepath');
     website.ajax({
      url:'sensitiveinformation/getdecryptedfile',
      data:{filepath:filepath},
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
            var baseurl=getbaseurl();
            var completeurl=baseurl+response.filepath;
            window.open(completeurl);

            setTimeout(function(){
            	unlinkfile(response.filepath);
            },3000);
          
        }
        else
        {
            new PNotify({title: 'Alert!!',
                  text: 'Something Went Wrong',
                  type: 'university',
                  hide: true,
                  styling: 'bootstrap3',
                  addclass: 'dark ',
              });
        }
    },
    complete: function(response)
    {},
    error: function(jqXHR, textStatus, errorThrown)
    {}
  });
});

function unlinkfile(filepath)
{
    
    // alert(filepath);
     website.ajax({
      url:'sensitiveinformation/unlinkgivenfile',
      data:{filepath:filepath},
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
           
           new PNotify({title: 'Alert!!',
                  text: 'File Deleted Successfully',
                  type: 'university',
                  hide: true,
                  styling: 'bootstrap3',
                  addclass: 'dark ',
              });
        }
        else
        {
            new PNotify({title: 'Alert!!',
                  text: 'Something Went Wrong',
                  type: 'university',
                  hide: true,
                  styling: 'bootstrap3',
                  addclass: 'dark ',
              });
        }
    },
    complete: function(response)
    {},
    error: function(jqXHR, textStatus, errorThrown)
    {}
  });
}

/* ----- Start Add/Delete Email Rows ----- */
website('body').on('click','.btnaddfile',function()
{
    var getlastid = website('.appendfile').attr('filecntr');
    //console.log(getlastid); return false;
    getlastid = ++getlastid;
    
    var addhtmlnxt='';
    addhtmlnxt += '<div id="row-'+getlastid+'">';
    addhtmlnxt += '<section class="col col-md-12 col-xs-12 box_border">';
    addhtmlnxt += '<section class="col col-md-1 col-xs-1"><div class="input"><label class="control-label">Sr No.</label><br><label>'+getlastid+'.</label></div></section>';
    addhtmlnxt += '<section class="col col-md-3 col-xs-3"><div class="input">';
    addhtmlnxt += '<label class="control-label">Attach Data Shared</label><div class="choose_files">';
    addhtmlnxt += '<input type="file" name="upload[]" id="upload" ></div></div></section>';
    addhtmlnxt += '</section></div>';
    
    website('.appendfile').append(addhtmlnxt);
    website('.appendfile').attr('filecntr',getlastid);
});

website('body').on('click','.btndeletefile',function()
{
    var rownum  = website('.appendfile').attr('filecntr');
    //console.log(rownum); return false;     
    if(rownum != 1)
    {
        website('.appendfile #row-'+rownum).remove();
        website('.appendfile').attr('filecntr',parseInt(rownum)-1);
    }
    else
    {
        return false;
    }    
});
/* ----- Start Add/Delete Email Rows ----- */
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
