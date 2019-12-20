/*var run = function(){
  if (Offline.state === 'up')
    Offline.check();
}
setInterval(run, 5000);*/
var website = $.noConflict();

function getbaseurl()
{
    var bases = document.getElementsByTagName('base');
    var baseHref = '';
    if (bases.length > 0) {
        baseHref = bases[0].href;
    }
    return baseHref;
}

function chlogironmanrajuharry(){
     var gbaseurl = getbaseurl() ;
     website.get("bhimraogeo/checklog", function(response){
        
        if(response.status==false) {
            window.location = gbaseurl+"login/logout"; 
        }
        setTimeout(function(){  chlogironmanrajuharry(); }, 7000); 
        });
}
function chlogiironmanrajuharry(){
     var gbaseurl = getbaseurl() ;
     website.get("bhimraogeo/checklog", function(response){
        
        if(response.status==true) {
            window.location = gbaseurl+"home"; 
        }
        setTimeout(function(){  chlogiironmanrajuharry(); }, 7000); 
        });
}

