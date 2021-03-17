website(document).ready(function()
{
  fetchCoiAllData();
});


function fetchCoiAllData()
{
    website.ajax({
    url: "coi/fetchCoiAllData",
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
                addhtmlnxt += '<td width="11%">'+response.data[i]['date_added']+'</td>';
                addhtmlnxt += '<td width="11%">';
                if(response.data[i]['sent_status'] == '1')
                {
                    addhtmlnxt += 'Sent';
                }
                else
                {
                    addhtmlnxt += 'Pending';
                }
                addhtmlnxt += '</td>';
                
                addhtmlnxt += '<td width="11%"></td>';
                addhtmlnxt += '<td width="11%"></td>';
                addhtmlnxt += '<td width="11%"></td>';
                addhtmlnxt += '<td width="11%"></td>';
                addhtmlnxt += '<td width="11%"></td>';
                addhtmlnxt += '<td width="11%">';
                if(response.data[i]["coi_pdfpath"])
                {
                    addhtmlnxt += '<a  href="'+response.data[i]["coi_pdfpath"]+'"  class="downlodthfle" style="color:black;"><span class="glyphicon glyphicon-download-alt floatleft"></span></a>';
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
        website('.allcoidata').html(addhtmlnxt);
    },
    complete: function (response) {},
    error: function (jqXHR, textStatus, errorThrown) {},
  });
}




