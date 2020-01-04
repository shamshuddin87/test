<?php header('Access-Control-Allow-Origin: *'); ?> 
{% set timestampfile = time() %}{% set getcontrollername = dispatcher.getControllerName() | lower %}{% set getcontrolleractionname = dispatcher.getActionName() | lower %}{% set commoncssname = ['css/common/',getcontrollername,'_common', '.php?v='~timestampfile]|join('') %}{#{{ getcontrollername == 'index' ? 'class="active"' : '' }}#}{#{% if getcontrollername == "index" %}<!--Robot is a The Great Lord Ganesha-->{% elseif getcontrollername == "login" %}<!--Robot is Great Lord Buddha-->{% elseif getcontrollername == "mechanical" %}<!--Robot is Great Warrior Hanuman-->{% endif %}#}
<?php
/*if (!empty($this->request->getHTTPReferer())) {$referer = $this->request->getHTTPReferer();} else {$referer = '';}
$domain = isset($_SERVER['HTTP_REFERER']) ? parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) : '';*/?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="msapplication-tap-highlight" content="no">
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="msapplication-TileColor" content="#373F89">
<meta name="theme-color" content="#373F89">
{{ get_title() }}
<?php
/*------------ any valid date in the past ------------------------
$this->response->setHeader('Cache-Control', 'max-age=26400');
*/
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
/* always modified right now*/
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
/* HTTP/1.1*/
header("Cache-Control: private, no-store, max-age=0, no-cache, must-revalidate, post-check=0, pre-check=0");
/* HTTP/1.0*/
header("Pragma: no-cache");
?>

<!-- For iPhone -->
{#<link rel="icon" type="image/png" sizes="16x16" href="{{ url('img/favicon/favicon-16x16.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ url('img/favicon/apple-touch-icon-152x152.png') }}">#}
<!-- Favicons-->
<meta name="msapplication-TileColor" content="#00bcd4">
<meta name="msapplication-TileImage" content="img/favicon/mstile-144x144.png">

<!--<meta name="google-site-verification" content="gOw13LcYXMaHkLZZYhwzzxoZngZ0EjFVZ_yN8fJUK4k" />-->
<base href="<?php echo $this->url->getBaseUri(); ?>">

{% if getcontrollername !="highlight" %}

{# commoncssname #}
{{ stylesheet_link(['css/rajuharry-admin.php?v='~timestampfile, 'media':'screen,projection']) }}

{# assets.outputCss('commoncss') #}


{% endif %}


{% if getcontrolleractionname !="orglog" 
and getcontrolleractionname !="orglist"
and getcontrolleractionname !="exception_req"
and getcontrolleractionname !="autoaprove"
and getcontrolleractionname !="startmeeting"
and getcontrolleractionname !="employeeblocking" 
and getcontrolleractionname !="companytradingperiod"
and getcontrolleractionname !="employeeblocking"
and getcontrolleractionname !="companytradebyemp"
and getcontrolleractionname !="recipient"
and getcontrolleractionname !="reqview"
and getcontrolleractionname !="tradingdays"
and getcontrolleractionname !="infosharing"
and getcontrolleractionname !="archive_infosharing"
and getcontrolleractionname !="tradeplanview"
and getcontrolleractionname !="planreqstview"
and getcontrolleractionname !="planreqstapprv"
and getcontrolleractionname !="viewreconcilation"
and getcontrolleractionname !="viewpastemployer"
and getcontrolleractionname !="mis_recipient"
and getcontrolleractionname !="mis_infosharing"
and getcontrolleractionname !="archive_missharing"
and getcontrolleractionname !="viewesop"
and getcontrolleractionname !="formb"
and getcontrolleractionname !="formc"
and getcontrolleractionname !="formd"
and getcontrolleractionname !="viewformb"
and getcontrolleractionname !="viewformc"
and getcontrolleractionname !="viewformd"
and getcontrolleractionname !="transformc"
and getcontrolleractionname !="transformd"
and getcontrolleractionname !="viewtransformc"
and getcontrolleractionname !="viewtransformd"
and getcontrolleractionname  !="misdetails"
and getcontrolleractionname  !="getuserinfo"
and getcontrolleractionname  !="accesstouser"
and getcontrolleractionname  !="mis_changedesprsn"
and getcontrolleractionname  !="mis_contratrd"
and getcontrolleractionname  !="mis_nonexetrade"
and getcontrolleractionname  !="mis_confirmtrade"
and getcontrolleractionname  !="mis_formc"
and getcontrolleractionname  !="mis_formpct"
and getcontrolleractionname  !="mis_initialdiscsr"
and getcontrolleractionname  !="mis_annualdiscsr"
and getcontrolleractionname  !="upsi_infosharing"
and getcontrolleractionname  !="upsitypeclassify"
and getcontrolleractionname !="createannual"
and getcontrolleractionname !="editannual"














    %}
{{ stylesheet_link([commoncssname, 'media':'screen,projection']) }}
{% endif %}




{% if getcontrolleractionname =="orglog" 
or getcontrolleractionname =="orglist"
or getcontrolleractionname =="startmeeting"
or getcontrolleractionname =="employeeblocking"
or getcontrolleractionname =="companytradingperiod"
or getcontrolleractionname =="companytradebyemp"
or getcontrolleractionname =="recipient"
or getcontrolleractionname =="infosharing"
or getcontrolleractionname =="archive_infosharing"
or getcontrolleractionname =="reqview"
or getcontrolleractionname =="tradingdays"
or getcontrolleractionname =="autoaprove"
or getcontrolleractionname =="exception_req"
or getcontrolleractionname =="tradeplanview"
or getcontrolleractionname =="planreqstview"
or getcontrolleractionname =="planreqstapprv"
or getcontrolleractionname =="viewreconcilation"
or getcontrolleractionname =="viewpastemployer"
or getcontrolleractionname =="mis_recipient"
or getcontrolleractionname =="mis_infosharing"
or getcontrolleractionname =="archive_missharing"
or getcontrolleractionname =="viewesop"
or getcontrolleractionname =="formb"
or getcontrolleractionname =="formc"
or getcontrolleractionname =="formd"
or getcontrolleractionname =="viewformb"
or getcontrolleractionname =="viewformc"
or getcontrolleractionname =="viewformd"
or getcontrolleractionname =="transformc"
or getcontrolleractionname =="transformd"
or getcontrolleractionname =="viewtransformc"
or getcontrolleractionname =="viewtransformd"
or getcontrolleractionname =="misdetails"
or getcontrolleractionname =="getuserinfo"
or getcontrolleractionname  =="accesstouser"
or getcontrolleractionname  =="mis_changedesprsn"
or getcontrolleractionname  =="mis_contratrd"
or getcontrolleractionname  =="mis_nonexetrade"
or getcontrolleractionname  =="mis_confirmtrade"
or getcontrolleractionname  =="mis_formc"
or getcontrolleractionname  =="mis_formpct"
or getcontrolleractionname  =="mis_initialdiscsr"
or getcontrolleractionname =="mis_annualdiscsr"
or getcontrolleractionname =="upsi_infosharing"
or getcontrolleractionname =="upsitypeclassify"
or getcontrolleractionname == "createannual"
or getcontrolleractionname == "editannual"



%}
{% set otheractioncss = ['css/common/otheraction/',dispatcher.getActionName(),'_common', '.php?v='~timestampfile]|join('') %}
{{ stylesheet_link([otheractioncss, 'media':'screen,projection']) }}
{% endif %}


<link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" >
<link rel="resource" type="application/l10n" href="locale/locale.properties">
<!-- <link rel="stylesheet" type="text/css" href="../insidertrading/mainadminhtml/css/common/commoncss/employeemodule_common.css"> -->
    
<!-- End User Tracking Code -->
</head>

<body tabindex="1" class="nav-md loadingInProgress  <?php echo ($getcontrollername=='index' || $getcontrollername=='login') ? 'login-cover' : $getcontrollername.'_bodymncl '; ?>" ><!--bg-purple-->
{% if getcontrollername != "highlight" and getcontrollername != "agendapdflink" %}
<div class="maincontentelement container">

<body class="nav-sm">
<div class="container body">
<div class="main_container">

{% if getcontrollername != "login" and getcontrollername != "index" and getcontrollername != "forgotpassword" and getcontrollername != "randomrequest" and getcontrollername != "randomexception" %}
    <!-- Main navbar -->
    {{ partial("commonman/header") }}
    <!-- /main navbar -->
{% endif %}

       
        <!--{% if getcontrollername != "index" and getcontrollername != "login" and getcontrollername != "forgotpassword" %}
            
        {% endif %}-->	
        <!-- Page container Start -->
            <div class="main_container page_<?php echo $getcontrollername.'_controller'.$getcontrolleractionname; ?>">
                {{ content() }}
            </div>
        <!-- /page container -->			

</div>
</div>
</body>

</div>
{% endif %}

{% if getcontrollername == "highlight" or getcontrollername == "agendapdflink" %}	 
 {{ content() }}
{% endif %} 

{{ assets.outputJs('common') }}


{% if  getcontrollername !="highlight" %} <!-- ########################################## pdfHighLight Important Condition Start ########################################## -->
{{ assets.outputJs('customscroll') }}  
{{ assets.outputJs('commonmaterial') }}
{{ assets.outputJs('inputmaskforn') }}  
    
{% if getcontrollername =="clientservicerelk" or getcontrollername =="taskbundle"  or getcontrollername =="leadbundle" or getcontrollername =="edittaskbundle" %}
{{ assets.outputJs('multiselect') }}
{% endif %}

{% if getcontrollername =="index" or getcontrollername =="login" or getcontrollername =="forgotpassword" or getcontrollername =="taskbundle" or getcontrollername =="leadbundle" or getcontrollername =="accountsetting" or getcontrollername =="event"  %}

{{ assets.outputJs('validatejs') }}
{% endif %}

{% if getcontrollername =="organisation" or getcontrollername =="particalrecordsetting" or getcontrollername =="employeerecord" or getcontrollername =="clientrecord" or getcontrollername =="servicerecord" or getcontrollername =="taskrecord" or getcontrollername =="clientservicerelk" or getcontrollername =="taskbundle" or getcontrollername =="invoicerecord" or getcontrollername =="leadbundle" or getcontrollername =="edittaskbundle" or getcontrollername =="accountsetting" or  getcontrollername =="restrictedcompany" or getcontrollername =="employeemodule"  or getcontrollername =="portfolio" or getcontrollername =="holdingstatement" or  getcontrollername =="sensitiveinformation" or getcontrollername =="tradingrequest"  or getcontrollername =="holdingsummary" or getcontrollername =="blackoutperiod" or getcontrollername =="tradingplan" or getcontrollername =="declarationform" or getcontrollername =="exceptionreq" or getcontrollername =="reconcilation" or getcontrollername =="esop" or getcontrollername =="randomrequest" or getcontrollername =="randomexception" or getcontrollername =="sebi" or getcontrollername =="mis" or getcontrollername =="usermaster"  or getcontrollername =="approvelperinfo"  or getcontrollername =="upsimaster"%}
{{ assets.outputJs('daterangepicker') }}
{{ assets.outputJs('datatablemn') }}
{% endif %}
    
{% if  getcontrollername =="event" or getcontrollername =="agendarequest" %}
{{ assets.outputJs('tableexport') }}  
{% endif %} 

{% if  getcontrollername =="home" or getcontrollername =="adminmodule" or getcontrollername =="companymaster" or getcontrollername =="upsimaster" or getcontrollername =="departmentmaster" or getcontrollername =="homepage" or getcontrollername =="meeting" or getcontrollername =="sharescreen" or getcontrollername =="companymodule" or getcontrollername =="employeemodule" or getcontrollername =="restrictedcompany" or getcontrollername =="sensitiveinformation" or getcontrollername =="holdingstatement" or getcontrollername =="holdingsummary" or getcontrollername =="blackoutperiod" or getcontrollername =="tradingplan" or getcontrollername =="declarationform" or getcontrollername =="exceptionreq"  or getcontrollername =="reconcilation" or getcontrollername =="esop" or getcontrollername =="randomrequest" or getcontrollername =="randomexception" or getcontrollername =="sebi" or  getcontrollername =="mis"  or getcontrollername =="upsimaster"%}
{{ assets.outputJs('highcharts') }}  
{{ assets.outputJs('datatablemn') }}
<script src="js/shared/jquery.cookie.js"></script>
 <script type="text/javascript" src="https://api.screenleap.com/js/screenleap.js"></script>   
{% endif %}
     
{% endif %}


<!-- ############# pdfHighLight Important Condition End ########### -->


     
{% if  getcontrollername =="highlight" %}
{#
{{ assets.outputJs('pdfjs') }} 
{{ assets.outputJs('pdfviewerjs') }} 
{{ assets.outputJs('indexjs') }} #}
<script src="js/shared/pdf.js"></script>
<script src="js/shared/pdf.worker.js"></script>
<script src="js/shared/pdf_viewer.js"></script>
<script src="js/shared/jquery.cookie.js"></script>
<script src="js/index.js"></script>

{% endif %} 


{% if  getcontrollername =="agendapdflink" %}
    
   

  <script src="js/pdfhighlighter/pdf.js?var=<?php echo $timestampfile; ?>"></script> 
  <script src="js/pdfhighlighter/pdf.worker.js?var=<?php echo $timestampfile; ?>"></script>    
  <script src="js/pdfhighlighter/viewer.js?var=<?php echo $timestampfile; ?>"></script>
  <script src="js/pdfhighlighter/texthighlighter.js?var=<?php echo $timestampfile; ?>"></script>
  <script src="js/pdfhighlighter/jquery.cookie.js?var=<?php echo $timestampfile; ?>"></script>
  <script src="js/pdfhighlighter/jquery.min.js?var=<?php echo $timestampfile; ?>"></script>
    

{% endif %}  
    
    
{% if getcontrollername == "meeting" %}

<script src="js/editor/tinymce.min.js"></script>

{% endif %}
    
{% if getcontrolleractionname !="orglog" 
and getcontrolleractionname !="orglist"
and getcontrolleractionname !="autoaprove"
and getcontrolleractionname !="startmeeting"
and getcontrolleractionname !="employeeblocking"
and getcontrolleractionname !="companytradingperiod"
and getcontrolleractionname !="companytradebyemp"
and getcontrolleractionname !="recipient"
and getcontrolleractionname !="reqview"
and getcontrolleractionname !="infosharing"
and getcontrolleractionname !="archive_infosharing"
and getcontrolleractionname !="archive_missharing"
and getcontrolleractionname !="tradeplanview"
and getcontrolleractionname !="planreqstview"
and getcontrolleractionname !="planreqstapprv"
and getcontrolleractionname !="exception_req"
and getcontrolleractionname !="viewreconcilation"
and getcontrolleractionname !="viewpastemployer"
and getcontrolleractionname !="mis_recipient"
and getcontrolleractionname !="mis_infosharing"
and getcontrolleractionname !="viewesop"
and getcontrolleractionname !="formb"
and getcontrolleractionname !="formc"
and getcontrolleractionname !="formd"
and getcontrolleractionname !="viewformb"
and getcontrolleractionname !="viewformc"
and getcontrolleractionname !="viewformd"
and getcontrolleractionname !="transformc"
and getcontrolleractionname !="tradingdays"
and getcontrolleractionname !="viewtransformc"
and getcontrolleractionname !="transformd"
and getcontrolleractionname !="viewtransformd"
and getcontrolleractionname !="getuserinfo"
and getcontrolleractionname  !="misdetails"
and getcontrolleractionname  !="accesstouser"
and getcontrolleractionname  !="mis_changedesprsn"
and getcontrolleractionname  !="mis_contratrd"
and getcontrolleractionname  !="mis_nonexetrade"
and getcontrolleractionname  !="mis_confirmtrade"
and getcontrolleractionname  !="mis_formc"
and getcontrolleractionname  !="mis_formpct"
and getcontrolleractionname  !="mis_initialdiscsr"
and getcontrolleractionname  !="mis_annualdiscsr"
and getcontrolleractionname  !="upsi_infosharing"
and getcontrolleractionname  !="upsitypeclassify"
and getcontrolleractionname != "createannual"
and getcontrolleractionname != "editannual"

%}
<?php

        $this->assets->collection('fivehundreadbhimacoregaon')
        ->addJs('js/common/'.$getcontrollername.'_common.js')
        ->setTargetPath('js/minified/common/'.$getcontrollername.'_fivehundreadbhimacoregaon.js')
        ->setTargetUri('js/minified/common/'.$getcontrollername.'_fivehundreadbhimacoregaon.js?var='.$timestampfile)
        ->addFilter(new Phalcon\Assets\Filters\Jsmin());
        $this->assets->outputJs('fivehundreadbhimacoregaon');
?>
{% endif %}

{% if getcontrolleractionname =="orglog" 
or getcontrolleractionname =="orglist"
or getcontrolleractionname =="startmeeting"  
or getcontrolleractionname =="employeeblocking"
or getcontrolleractionname =="companytradingperiod"
or getcontrolleractionname =="companytradebyemp"
or getcontrolleractionname =="recipient"
or getcontrolleractionname =="infosharing"
or getcontrolleractionname =="archive_infosharing"
or getcontrolleractionname =="reqview"
or getcontrolleractionname =="misdetails"
or getcontrolleractionname =="getuserinfo"
or getcontrolleractionname =="tradingdays"
or getcontrolleractionname =="autoaprove"
or getcontrolleractionname =="exception_req"
or getcontrolleractionname =="tradeplanview"
or getcontrolleractionname =="planreqstview"
or getcontrolleractionname =="planreqstapprv"
or getcontrolleractionname =="viewreconcilation"
or getcontrolleractionname =="viewpastemployer"
or getcontrolleractionname =="mis_recipient"
or getcontrolleractionname =="mis_infosharing"
or getcontrolleractionname =="archive_missharing"
or getcontrolleractionname =="viewesop"
or getcontrolleractionname =="formb"
or getcontrolleractionname =="formc"
or getcontrolleractionname =="formd"
or getcontrolleractionname =="viewformb"
or getcontrolleractionname =="viewformc"
or getcontrolleractionname =="viewformd"
or getcontrolleractionname =="transformc"
or getcontrolleractionname =="viewtransformc"
or getcontrolleractionname =="transformd"
or getcontrolleractionname =="viewtransformd"
or getcontrolleractionname  =="accesstouser"
or getcontrolleractionname  =="mis_changedesprsn"
or getcontrolleractionname  =="mis_contratrd"
or getcontrolleractionname  =="mis_nonexetrade"
or getcontrolleractionname  =="mis_confirmtrade"
or getcontrolleractionname  =="mis_formc"
or getcontrolleractionname  =="mis_formpct"
or getcontrolleractionname  =="mis_initialdiscsr"
or getcontrolleractionname  =="mis_annualdiscsr"
or getcontrolleractionname  =="upsi_infosharing"
or getcontrolleractionname  =="upsitypeclassify"
or getcontrolleractionname == "createannual"
or getcontrolleractionname == "editannual"
    
%}
<?php
        $this->assets->collection('lordvishnushivaction')
        ->addJs('js/common/otheraction/'.$getcontrolleractionname.'_common.js')
        ->setTargetPath('js/minified/common/otheraction/'.$getcontrolleractionname.'_lordambedkar.js')
        ->setTargetUri('js/minified/common/otheraction/'.$getcontrolleractionname.'_lordambedkar.js?var='.$timestampfile)
        ->addFilter(new Phalcon\Assets\Filters\Jsmin());
        $this->assets->outputJs('lordvishnushivaction');
?>
{% endif %}

{% if getcontrollername =="commingsoon" %}
 <!-- birds start --><div id="WE-container"></div><div id="WE-holder"><canvas></canvas></div><!-- birds end -->
{{ assets.outputJs('commingsoon') }}
{{ assets.outputJs('commingsoonnxt') }}
{% endif %}


<?php  //echo $this->partial('commonman/footer'); ?>

{% if  getcontrollername !="highlight" %} <!-- ########################################## pdfHighLight Important Condition Start ########################################## -->    
{% if getcontrollername !="index" and getcontrollername !="login" and getcontrollername !="forgotpassword" and getcontrollername !="randomrequest" and getcontrollername !="randomexception"  %}   
{{ partial("commonman/footer") }}    
<script type="text/javascript">chlogironmanrajuharry();</script>
{% endif %}  
 
{% if getcontrollername =="index" or getcontrollername =="login" or getcontrollername =="forgotpassword" or getcontrollername =="randomrequest" or getcontrollername =="randomexception"  %}
<script type="text/javascript">chlogiironmanrajuharry();</script>
{% endif %} 

{{ assets.outputJs('chatpanel') }}
<div id="mnotificationcmmm">
        <audio   class="player_audio" controls="" preload="none">
        </audio>
</div> 
{% endif %} <!-- ########################################## pdfHighLight Important Condition End ########################################## -->  

 
</body>

</html>
