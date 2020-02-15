
website(document).ready(function()
{
    var base_url = window.location.origin;
    website(".mcscrollbar1,.mcscrollbar2,.mcscrollbar3").mCustomScrollbar({
                                    scrollButtons:{enable:true,scrollType:"stepped"},
                                    keyboard:{scrollType:"stepped"},
                                    mouseWheel:{scrollAmount:188},
                                    theme:"rounded-dark",
                            });
    countofreqpendapp();
    countofrestrictcomp();
    countofdepreltv();
    getallholdingsummary();
//    remindrofprsnlinfo();
//    remindrofhldngstmnt();
});

function countofrestrictcomp() 
{
    var base_url = window.location.origin;
    website.ajax({
      url:'home/countofrestrictcomp',
      //data:formdata,
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
            var countofcomp = response.data.length;
            website('#complist').html(countofcomp);
            //website('#restcomplist a').attr('href',base_url+'/insidertrading/restrictedcompany/companytradingperiod');
            
        }
      else
      {
        var countofcomp = 0;
        website('#complist').html(countofcomp);
      }
    },
    complete: function(response)
    {},
    error: function(jqXHR, textStatus, errorThrown)
    {}
  });
}


function countofdepreltv() 
{
    var base_url = window.location.origin;
    website.ajax({
      url:'home/countofdepreltv',
      //data:formdata,
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
            var countofreltv = response.data.length;
            website('#reltvlist').html(countofreltv);
            //website('#depndreltve a').attr('href',base_url+'/insidertrading/employeemodule?from=dash');
            
        }
      else
      {
        var countofreltv = 0;
        website('#reltvlist').html(countofreltv);
      }
    },
    complete: function(response)
    {},
    error: function(jqXHR, textStatus, errorThrown)
    {}
  });
}


function countofreqpendapp() 
{
    var base_url = window.location.origin;
    website.ajax({
      url:'home/countofreqpendapp',
      //data:formdata,
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
            
          var countofpendapprvl = response.data.length;
        
            website('#appvlpend').html(countofpendapprvl);
            //website('#pendappvl a').attr('href',base_url+'/insidertrading/tradingrequest/reqview');
            
        }
      else
      {
        var countofpendapprvl = 0;
        website('#appvlpend').html(countofpendapprvl);
      }
    },
    complete: function(response)
    {},
    error: function(jqXHR, textStatus, errorThrown)
    {}
  });
}

function getallholdingsummary()
{
    var base_url = window.location.origin;
    website.ajax({
      url:'home/getallholdingsummary',
      //data:formdata,
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
             var addhtmlnxt=''; 
             var equitybuysell = [];var preferbuysell = [];var debntrbuysell = [];  
             var equityclosblnc = [];var preferclosblnc = [];var debntrclosblnc = [];
             var equityopnblnc = '';var preferopnblnc = '';var debntropnblnc = '';
             var othercloseequity = [];var othercloseprefer = [];var otherclosedebtr = [];
             var n = 0;
            //            ------------------------ Table Fields Insertion START ------------------------
//            if(response.resdta.length>10){ n = 10;}else{n = response.resdta.length}
//             for(var i = 0; i < n; i++) 
//             {
                addhtmlnxt += '<tr class="counter"  >';
                addhtmlnxt += '<td width="25%">'+response.cmpname+'</td>';

                        
//                        for(var k = 0;k<response.equity.length;k++)
//                        {
//                                if(response.equity[k] != '')
//                                {
//
//                                    if(response.equity[k].buyequity == null && response.equity[k].sellequity == null)
//                                    {
//                                        var opnblnceq = response.resdta[k].equityshare;
//                                        if(equitybuysell[k]!=0 || equitybuysell[k]!='')
//                                        {var totaleq = equitybuysell[k];}else{var totaleq = 0;}
//                                    }
//                                    else
//                                    {
//                                        var opnblnceq = response.resdta[k].equityshare;
//                                        var buyeq = response.equity[k].buyequity;
//                                        var selleq = response.equity[k].sellequity;
//                                        var totaleq = Number(buyeq) - Number(selleq);
//                                        var closblnceq = Number(opnblnceq) + Number(totaleq);
//                                        equitybuysell.push(totaleq);
//                                        equityclosblnc.push(closblnceq);
//                                    }
//
//                                }
//                                else
//                                {
//                                    var opnblnceq = response.resdta[k].equityshare;
//                                   if(equitybuysell[k])
//                                    {
//                                        if(equitybuysell[k]!=0 || equitybuysell[k]!='')
//                                        {var totaleq = equitybuysell[k];}else{var totaleq = 0;}  
//                                    }
//                                    else
//                                    {
//                                        var totaleq = 0;
//                                    }
//                                    var closblnceq = Number(opnblnceq) + Number(totaleq);
//                                    equitybuysell.push(totaleq);
//                                    equityclosblnc.push(closblnceq);
//                                }
//
//                                if(response.prefer[k] != '')
//                                {
//
//                                    if(response.prefer[k].buyprefer == null && response.prefer[k].sellprefer == null)
//                                    {
//                                        var opnblncpref = response.resdta[k].prefershare;
//                                        console.log(opnblncpref+' '+k);
//                                        if(preferbuysell[k]!=0 || preferbuysell[k]!='')
//                                        {var totalpref = preferbuysell[k];}else{var totalpref = 0;}
//                                    }
//                                    else
//                                    {
//                                        var opnblncpref = response.resdta[k].prefershare;
//                                        var buypref = response.prefer[k].buyprefer;
//                                        var sellpref = response.prefer[k].sellprefer;;
//                                        var totalpref = Number(buypref) - Number(sellpref);
//                                        var closblncpref = Number(opnblncpref) + Number(totalpref);
//                                        preferbuysell.push(totalpref);
//                                        preferclosblnc.push(closblncpref);
//                                    }
//
//                                }
//                                else
//                                {
//                                    var opnblncpref = response.resdta[k].prefershare;
//                                    if(preferbuysell[k])
//                                    {
//                                        if(preferbuysell[k]!=0 || preferbuysell[k]!='')
//                                        {var totalpref = preferbuysell[k];}else{var totalpref = 0;}  
//                                    }
//                                    else
//                                    {
//                                        var totalpref = 0;
//                                    }
//                                    var closblncpref = Number(opnblncpref) + Number(totalpref);
//                                    preferbuysell.push(totalpref);
//                                    preferclosblnc.push(closblncpref);
//                                }
//                                if(response.debenture[k] != '')
//                                {
//
//                                    if(response.debenture[k].buydebtr == null && response.debenture[k].selldebtr == null)
//                                    {
//                                        var opnblncdeb = response.resdta[k].debntrshare;
//                                        console.log(opnblncdeb+' '+k);
//                                        if(debntrbuysell[k]!=0 || debntrbuysell[k]!='')
//                                        {var totaldeb = debntrbuysell[k];}else{var totaldeb = 0;}
//                                        console.log(totaldeb);
//                                    }
//                                    else
//                                    {
//                                        var opnblncdeb = response.resdta[k].debntrshare;
//                                        var buydeb = response.debenture[k].buydebtr;
//                                        var selldeb = response.debenture[k].selldebtr;;
//                                        var totaldeb = Number(buydeb) - Number(selldeb);
//                                        var closblncdeb = Number(opnblncdeb) + Number(totaldeb);
//                                        debntrbuysell.push(totaldeb);
//                                        debntrclosblnc.push(closblncdeb);
//                                    }
//
//                                }
//                                else
//                                {
//                                    var opnblncdeb = response.resdta[k].debntrshare;
//                                    if(debntrbuysell[k])
//                                    {
//                                        if(debntrbuysell[k]!=0 || debntrbuysell[k]!='')
//                                        {var totaldeb = debntrbuysell[k];}else{var totaldeb = 0;}  
//                                    }
//                                    else
//                                    {
//                                        var totaldeb = 0;
//                                    }
//                                    var closblncdeb = Number(opnblncdeb) + Number(totaldeb);
//                                    debntrbuysell.push(totaldeb);
//                                    debntrclosblnc.push(closblncdeb);
//                                }
//
//                            }
//
//
//                    if(response.equity.length!=0)
//                    { 
//                        if(response.resdta[i].equityshare!=0)
//                        {
//                            var esop= Number(equityclosblnc[i])+Number(response.resdta[i].esop);
//                            addhtmlnxt += '<td width="25%">'+esop+'</td>'; //equity closing blnc
//                        }
//                        else
//                        {
//                            var esop= Number(equityclosblnc[i])+Number(response.resdta[i].esop);
//                            addhtmlnxt += '<td width="25%">'+esop+'</td>'; //equity closing blnc
//                        }
//
//                    }
//
//                    if(response.prefer.length!=0)
//                    {
//                        if(response.resdta[i].prefershare!=0)
//                        {
//                            addhtmlnxt += '<td width="25%">'+preferclosblnc[i]+'</td>'; //prefr closing blnc
//                        }
//                        else
//                        {
//                            addhtmlnxt += '<td width="25%">'+preferclosblnc[i]+'</td>'; //prefr closing blnc
//                        }
//
//                    }
//
//
//                    if(response.debenture.length!=0)
//                    { 
//                        if(response.resdta[i].debntrshare!=0)
//                        {
//                            addhtmlnxt += '<td width="25%">'+debntrclosblnc[i]+'</td>'; //prefr closing blnc
//                        }
//                        else
//                        {
//                            addhtmlnxt += '<td width="25%">'+debntrclosblnc[i]+'</td>'; //debtr closing blnc
//                        }
//                    }
                 addhtmlnxt += '<td width="25%">'+response.equity+'</td>';
                 addhtmlnxt += '<td width="25%">'+response.prefer+'</td>';
                 
            addhtmlnxt += '</tr>';
           
//            ------------------------ Table Fields Insertion END ------------------------
            
//        }
            
            website('.holdingsummry').html(addhtmlnxt);
            //website('#holdingsummary a').attr('href',base_url+'/insidertrading/holdingsummary');
        }
       else
       {
             var addhtmlnxt = '<tr><td style="text-align:center;" colspan="13">Data Not Found..!!</td></tr>';
             website('.holdingsummry').html(addhtmlnxt);              
       }
    },
    complete: function(response)
    {},
    error: function(jqXHR, textStatus, errorThrown)
    {}
  });
}



  
function pdfOpen(){
 window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no'); return false;      
};

/************ send reminder of prsnlinfo start ***********/
function remindrofprsnlinfo()
{
    website.ajax({
      url:'home/remindrofprsnlinfo',
      //data:formdata,
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
}
/************ send reminder of prsnlinfo end ***********/

/************ send reminder of hldng stmnt start ***********/
function remindrofhldngstmnt()
{
    website.ajax({
      url:'home/sendremindr',
      //data:formdata,
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
}
/************ send reminder of hldng stmnt end ***********/



