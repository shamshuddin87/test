getuserlistonload();
function getuserlistonload()
{
   var noofrows = website('#noofrows').val(); 
    var pagenum = website('#pagenum').val();
    // var chkclk = '';
    // var numofdata = 'all';
    var formdata = {noofrows:noofrows,pagenum:pagenum};
    website.ajax({
        url:'adminmodule/fetchuser',
        data:formdata,
        method:'POST',
        //contentType:'json',
        contentType:'application/x-www-form-urlencoded; charset=UTF-8',
        //default: 'application/x-www-form-urlencoded; charset=UTF-8' ,'multipart/form-data' , 'text/plain'
        dataType:"json",
        cache:false,
        //async:true, Cross domain checking
        beforeSend: function()
        {   },
        uploadProgress: function(event, position, total, percentComplete)
        {   },
        success: function(response, textStatus, jqXHR)
        {
            if(response.logged===true)
            {    
                //console.log(response.data); return false;
                var addhtmlnxt='';
                var dept = '';
                var companyname = '';
                for(var i = 0; i < response.data.length; i++) 
                {   

                    // console.log(response.data[i].wr_id);return false;
                    // dept = response.data[i].deptname ?response.data[i].deptname:'NONE';
                    // companyname = response.data[i].companyname ?response.data[i].companyname:'NONE';
                    var fullname=response.data[i].fullname?response.data[i].fullname:'NONE';
                    var  email=response.data[i].email?response.data[i].email:'NONE';
                    // var mobile=response.data[i].mobile?response.data[i].mobile:'NONE'
                    var dpdate=response.data[i].dpdate?response.data[i].dpdate:'NONE'
                    var designation=response.data[i].designation?response.data[i].designation:'NONE';
                    var companyname=response.data[i].companyname?response.data[i].companyname:'NONE';
                    var departmentname=response.data[i].department?response.data[i].department:'NONE'
                    // var  reminderdays=response.data[i].reminderdays?response.data[i].reminderdays:'NONE';

                    //console.log(response.data.length); return false;
                    //------------------------- Table Fields Insertion START ------------------------
                    //var created = response.data[i].date_added.split(' ')[0];
                    //var modified = response.data[i].date_modified.split(' ')[0];
                    var j=i+1;
                    addhtmlnxt += '<tr class="counter useraccess" tempid="'+response.data[i].wr_id+'">';
                    addhtmlnxt += '<td width="15%">'+j+'</td>';
                    addhtmlnxt += '<td width="15%">'+fullname+'</td>';
                    addhtmlnxt += '<td width="15%">'+email+'</td>';
                    addhtmlnxt += '<td width="15%">'+designation+'</td>';
                    addhtmlnxt += '<td width="15%">'+dpdate+'</td>';
                    addhtmlnxt +='<td width="15%">'+companyname+'</td>';
                    addhtmlnxt +='<td width="15%">'+departmentname+'</td>';
                    addhtmlnxt +='<td width="10%"><i class="fa fa-eye" ></i></td>';
                    addhtmlnxt += '</tr>';    

                    //------------------------ Table Fields Insertion END ------------------------
                }
               
                
            }
            else
            {
                addhtmlnxt += '<tr><td colspan="8" style="text-align:center;">NO DATA FOUND</td></tr>';
              
                
            }
                website('.appendrow').html(addhtmlnxt);
                website('.paginationmn').html(response.pgnhtml);
        },
        complete: function(response)
        {   },
        error: function(jqXHR, textStatus, errorThrown)
        {   }
    });
}



website('body').on('click','.useraccess',function(e){
var userid=website(this).attr('tempid');
// alert(userid);

var baseHref = getbaseurl();
var encodedString = btoa(userid);
// alert(encodedString);
var myurl=baseHref+"adminmodule/accesstouser?userid="+encodedString;
location.replace(myurl);
// alert(baseHref);
});