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
//-------------------------GO BUTTON-------------------------

website('body').on('click','.go_button', function(e) 
{
   
    var rscrntpg = website('.gotobtn').val();
    website('.panel.panel-white #pagenum').val(rscrntpg);
    getdataonload();
});

getdataonload();
function getdataonload()
{
    var noofrows = website('#noofrows').val(); 
    var pagenum = website('#pagenum').val();
    var rtaid = website('#rtaid').val(); 
    var rtauniqueid = website('#rtauniqueid').val();
    var dateofrecon = website('#dateofrecon').val();
    var formdata = {rtaid:rtaid,rtauniqueid:rtauniqueid,dateofrecon:dateofrecon,noofrows:noofrows,pagenum:pagenum}
    website.ajax({
        url:'reconcilation/fetchreconcilationforview',
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
                var addhtmlnxt='';
                
               
                for(var i = 0; i < response.resdta['data'].length; i++) 
                {
                   //console.log(response.resdta['data'][i]);
                    var pan=response.resdta['data'][i].panno?response.resdta['data'][i].panno:''; 
                    var username=response.resdta['username'][i]?response.resdta['username'][i]:'';
                    var relativename=response.resdta['data'][i].relativename?response.resdta['data'][i].relativename:'';
                    var relationship=response.resdta['data'][i].relationship?response.resdta['data'][i].relationship:'';
                    var script=response.resdta['data'][i].script?response.resdta['data'][i].script:'';
                    var holding=response.resdta['data'][i].holding?response.resdta['data'][i].holding:'';
                    var equity = response.resdta['data'][i].shares?response.resdta['data'][i].shares:'';
                    //alert(response.equity[i].pan);
                    
                        //var equity = response.equity[i].sharehldng;
                        
                    
                    
                    var diffrnc = Number(holding) - Number(equity);


                    //------------------------- Table Fields Insertion START ------------------------
                    if(diffrnc != 0)
                    { 
                        
                       email = response.resdta['data'][i].email; 
                       
                        
                        addhtmlnxt += '<tr class="counter" reconciid="'+response.resdta['data'][i].id+'" style="background-color:#f5aaaa;">';
                    }
                    else
                    {
                        addhtmlnxt += '<tr class="counter" reconciid="'+response.resdta['data'][i].id+'">';
                    }

                    addhtmlnxt += '<td width="5%"><input type="checkbox" name="emailcheckbox" class="emailcheckbox" value="'+email+'"  username ="'+username+'"  diffrnc ="'+diffrnc+'"><br></td>';

                    addhtmlnxt += '<td width="15%">'+pan+'</td>';
                    addhtmlnxt += '<td width="10%">'+username+'</td>';
                    addhtmlnxt += '<td width="15%">'+relativename+'</td>';
                    addhtmlnxt += '<td width="10%">'+relationship+'</td>';
                    addhtmlnxt += '<td width="15%">'+script+'</td>';
                    addhtmlnxt += '<td width="15%">'+holding+'</td>';

                    addhtmlnxt += '<td width="15%">'+equity+'</td>';
                    addhtmlnxt += '<td width="30%">'+diffrnc+'</td>';
                    addhtmlnxt += '</tr>';

                    //------------------------ Table Fields Insertion END ------------------------
                 }
                
                for(var i = 0; i < response.panuser.length; i++) 
                {
                    var pansheet = response.panlist[i]?response.panlist[i]:'';
                    var pan=response.panuser[i].panno?response.panuser[i].panno:'';
                    var username=response.panuser[i].username?response.panuser[i].username:'';
                    var relativename=response.panuser[i].relativename?response.panuser[i].relativename:'';
                    var relationship=response.panuser[i].relationship?response.panuser[i].relationship:'';
                    
                    if(jQuery.inArray(response.panuser[i].panno, response.panlist)=='-1') // InArray
                    {
                        addhtmlnxt += '<tr class="counter" reconciid="'+response.panuser[i].id+'">';
                        addhtmlnxt += '<td width="5%"><input type="checkbox" name="emailcheckbox" class="emailcheckbox" value="'+email+'" username ="'+username+'"  diffrnc ="'+diffrnc+'" ><br></td>';
                        addhtmlnxt += '<td width="15%">'+pan+'</td>';
                        addhtmlnxt += '<td width="10%">'+username+'</td>';
                        addhtmlnxt += '<td width="15%">'+relativename+'</td>';
                        addhtmlnxt += '<td width="10%">'+relationship+'</td>';
                        addhtmlnxt += '<td width="15%"></td>';
                        addhtmlnxt += '<td width="15%"></td>';
                        addhtmlnxt += '<td width="15%"></td>';
                        addhtmlnxt += '<td width="30%"><input type="submit" value="Error! Message" class="showerror" title="error message"></td>';
                        addhtmlnxt += '</tr>';
                    }
                }

                
                website('.appendviewreconciltn').html(addhtmlnxt);
                website('#datableabhi').DataTable();
                

               
                //website('.paginationmn').html(response.pgnhtml);             
            }
            else
            {
                //website('.paginationmn').html(response.pgnhtml);
            }
        },
        complete: function(response)
        {  website('.preloder_wraper').fadeOut(); },
        error: function(jqXHR, textStatus, errorThrown)
        {   }
    });
}

website('body').on('click','.showerror', function(e) 
{
    website('#myModalerrormssage').modal('show'); 
});
// Email Send if difference is there in RTA Reconcilation



website("body").on("click","#emailExcelToBenpose",function(e){
    var email = [];
    var name = [];
    var difference = [];

    website(".emailcheckbox:checked").each(function(){
        email.push(website(this).val());
    });
     website(".emailcheckbox:checked").each(function(){
        name.push(website(this).attr('username'));
    });
      website(".emailcheckbox:checked").each(function(){
        difference.push(website(this).attr('diffrnc'));
    });

    website("#emailid").val(email);
    website("#name").val(name);
     website("#diffrnc").val(difference);
    website("#sendmail").modal("show");

   
});


website("body").on("click",".getallchkbox",function(e){
    if(website(this).is(":checked")) 
    {
        website('div input').attr('checked', true);   
    }
    else
    {
        website('div input').attr('checked', false);  
    }
});

website(".yesmail").click(function()
{
let email = website("#emailid").val();
let name = website("#name").val();
let diffrnc = website("#diffrnc").val();

formdata={email:email,name:name,diffrnc:diffrnc};
 website.ajax({
        url:'reconcilation/sendRTAmail',
        data:formdata,
        method:'POST',
        //contentType:'json',
        contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
        dataType:"json",
        cache:false,
        //async:true, /*Cross domain checking*/
        beforeSend: function()
        {  website('.preloder_wraper').fadeIn();
         website("#sendmail").modal('hide'); },
        uploadProgress: function(event, position, total, percentComplete)
        {   },
        success: function(response, textStatus, jqXHR)
        {
            if(response.logged == true)
            {
                new PNotify({title: 'Alert',
               text: "Mail Sent Successfully..!!!",
                type: 'university',
               hide: true,
              styling: 'bootstrap3',
               addclass: 'dark ',
             });
            


            }
            else
            {
                new PNotify({title: 'Alert',
               text: "Mail Sent Successfully..!!!",
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

});



