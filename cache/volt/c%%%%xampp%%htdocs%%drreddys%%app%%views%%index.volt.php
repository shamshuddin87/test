<?php header('Access-Control-Allow-Origin: *'); ?> 
<?php $timestampfile = time(); ?><?php $getcontrollername = Phalcon\Text::lower($this->dispatcher->getControllerName()); ?><?php $getcontrolleractionname = Phalcon\Text::lower($this->dispatcher->getActionName()); ?><?php $commoncssname = join(['css/common/', $getcontrollername, '_common', '.php?v=' . $timestampfile], ''); ?>
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
<?= $this->tag->getTitle() ?>
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

<!-- Favicons-->
<meta name="msapplication-TileColor" content="#00bcd4">
<meta name="msapplication-TileImage" content="img/favicon/mstile-144x144.png">

<!--<meta name="google-site-verification" content="gOw13LcYXMaHkLZZYhwzzxoZngZ0EjFVZ_yN8fJUK4k" />-->
<base href="<?php echo $this->url->getBaseUri(); ?>">

<?php if ($getcontrollername != 'highlight') { ?>


<?= $this->tag->stylesheetLink(['css/rajuharry-admin.php?v=' . $timestampfile, 'media' => 'screen,projection']) ?>




<?php } ?>


<?php if ($getcontrolleractionname != 'orglog' && $getcontrolleractionname != 'orglist' && $getcontrolleractionname != 'exception_req' && $getcontrolleractionname != 'autoaprove' && $getcontrolleractionname != 'startmeeting' && $getcontrolleractionname != 'employeeblocking' && $getcontrolleractionname != 'companytradingperiod' && $getcontrolleractionname != 'employeeblocking' && $getcontrolleractionname != 'companytradebyemp' && $getcontrolleractionname != 'recipient' && $getcontrolleractionname != 'reqview' && $getcontrolleractionname != 'tradingdays' && $getcontrolleractionname != 'infosharing' && $getcontrolleractionname != 'archive_infosharing' && $getcontrolleractionname != 'tradeplanview' && $getcontrolleractionname != 'planreqstview' && $getcontrolleractionname != 'planreqstapprv' && $getcontrolleractionname != 'viewreconcilation' && $getcontrolleractionname != 'viewpastemployer' && $getcontrolleractionname != 'mis_recipient' && $getcontrolleractionname != 'mis_infosharing' && $getcontrolleractionname != 'archive_missharing' && $getcontrolleractionname != 'viewesop' && $getcontrolleractionname != 'formb' && $getcontrolleractionname != 'formc' && $getcontrolleractionname != 'formd' && $getcontrolleractionname != 'viewformb' && $getcontrolleractionname != 'viewformc' && $getcontrolleractionname != 'viewformd' && $getcontrolleractionname != 'transformc' && $getcontrolleractionname != 'transformd' && $getcontrolleractionname != 'viewtransformc' && $getcontrolleractionname != 'viewtransformd' && $getcontrolleractionname != 'misdetails' && $getcontrolleractionname != 'getuserinfo' && $getcontrolleractionname != 'accesstouser' && $getcontrolleractionname != 'mis_changedesprsn' && $getcontrolleractionname != 'mis_contratrd' && $getcontrolleractionname != 'mis_nonexetrade' && $getcontrolleractionname != 'mis_confirmtrade' && $getcontrolleractionname != 'mis_formc' && $getcontrolleractionname != 'mis_formpct' && $getcontrolleractionname != 'mis_initialdiscsr' && $getcontrolleractionname != 'mis_annualdiscsr' && $getcontrolleractionname != 'upsi_infosharing' && $getcontrolleractionname != 'upsitypeclassify') { ?>
<?= $this->tag->stylesheetLink([$commoncssname, 'media' => 'screen,projection']) ?>
<?php } ?>




<?php if ($getcontrolleractionname == 'orglog' || $getcontrolleractionname == 'orglist' || $getcontrolleractionname == 'startmeeting' || $getcontrolleractionname == 'employeeblocking' || $getcontrolleractionname == 'companytradingperiod' || $getcontrolleractionname == 'companytradebyemp' || $getcontrolleractionname == 'recipient' || $getcontrolleractionname == 'infosharing' || $getcontrolleractionname == 'archive_infosharing' || $getcontrolleractionname == 'reqview' || $getcontrolleractionname == 'tradingdays' || $getcontrolleractionname == 'autoaprove' || $getcontrolleractionname == 'exception_req' || $getcontrolleractionname == 'tradeplanview' || $getcontrolleractionname == 'planreqstview' || $getcontrolleractionname == 'planreqstapprv' || $getcontrolleractionname == 'viewreconcilation' || $getcontrolleractionname == 'viewpastemployer' || $getcontrolleractionname == 'mis_recipient' || $getcontrolleractionname == 'mis_infosharing' || $getcontrolleractionname == 'archive_missharing' || $getcontrolleractionname == 'viewesop' || $getcontrolleractionname == 'formb' || $getcontrolleractionname == 'formc' || $getcontrolleractionname == 'formd' || $getcontrolleractionname == 'viewformb' || $getcontrolleractionname == 'viewformc' || $getcontrolleractionname == 'viewformd' || $getcontrolleractionname == 'transformc' || $getcontrolleractionname == 'transformd' || $getcontrolleractionname == 'viewtransformc' || $getcontrolleractionname == 'viewtransformd' || $getcontrolleractionname == 'misdetails' || $getcontrolleractionname == 'getuserinfo' || $getcontrolleractionname == 'accesstouser' || $getcontrolleractionname == 'mis_changedesprsn' || $getcontrolleractionname == 'mis_contratrd' || $getcontrolleractionname == 'mis_nonexetrade' || $getcontrolleractionname == 'mis_confirmtrade' || $getcontrolleractionname == 'mis_formc' || $getcontrolleractionname == 'mis_formpct' || $getcontrolleractionname == 'mis_initialdiscsr' || $getcontrolleractionname == 'mis_annualdiscsr' || $getcontrolleractionname == 'upsi_infosharing' || $getcontrolleractionname == 'upsitypeclassify') { ?>
<?php $otheractioncss = join(['css/common/otheraction/', $this->dispatcher->getActionName(), '_common', '.php?v=' . $timestampfile], ''); ?>
<?= $this->tag->stylesheetLink([$otheractioncss, 'media' => 'screen,projection']) ?>
<?php } ?>


<link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" >
<link rel="resource" type="application/l10n" href="locale/locale.properties">
<!-- <link rel="stylesheet" type="text/css" href="../insidertrading/mainadminhtml/css/common/commoncss/employeemodule_common.css"> -->
    
<!-- End User Tracking Code -->
</head>

<body tabindex="1" class="nav-md loadingInProgress  <?php echo ($getcontrollername=='index' || $getcontrollername=='login') ? 'login-cover' : $getcontrollername.'_bodymncl '; ?>" ><!--bg-purple-->
<?php if ($getcontrollername != 'highlight' && $getcontrollername != 'agendapdflink') { ?>
<div class="maincontentelement container">

<body class="nav-sm">
<div class="container body">
<div class="main_container">

<?php if ($getcontrollername != 'login' && $getcontrollername != 'index' && $getcontrollername != 'forgotpassword' && $getcontrollername != 'randomrequest' && $getcontrollername != 'randomexception') { ?>
    <!-- Main navbar -->
    <?= $this->partial('commonman/header') ?>
    <!-- /main navbar -->
<?php } ?>

       
        <!--<?php if ($getcontrollername != 'index' && $getcontrollername != 'login' && $getcontrollername != 'forgotpassword') { ?>
            
        <?php } ?>-->	
        <!-- Page container Start -->
            <div class="main_container page_<?php echo $getcontrollername.'_controller'.$getcontrolleractionname; ?>">
                <?= $this->getContent() ?>
            </div>
        <!-- /page container -->			

</div>
</div>
</body>

</div>
<?php } ?>

<?php if ($getcontrollername == 'highlight' || $getcontrollername == 'agendapdflink') { ?>	 
 <?= $this->getContent() ?>
<?php } ?> 

<?= $this->assets->outputJs('common') ?>


<?php if ($getcontrollername != 'highlight') { ?> <!-- ########################################## pdfHighLight Important Condition Start ########################################## -->
<?= $this->assets->outputJs('customscroll') ?>  
<?= $this->assets->outputJs('commonmaterial') ?>
<?= $this->assets->outputJs('inputmaskforn') ?>  
    
<?php if ($getcontrollername == 'clientservicerelk' || $getcontrollername == 'taskbundle' || $getcontrollername == 'leadbundle' || $getcontrollername == 'edittaskbundle') { ?>
<?= $this->assets->outputJs('multiselect') ?>
<?php } ?>

<?php if ($getcontrollername == 'index' || $getcontrollername == 'login' || $getcontrollername == 'forgotpassword' || $getcontrollername == 'taskbundle' || $getcontrollername == 'leadbundle' || $getcontrollername == 'accountsetting' || $getcontrollername == 'event') { ?>

<?= $this->assets->outputJs('validatejs') ?>
<?php } ?>

<?php if ($getcontrollername == 'organisation' || $getcontrollername == 'particalrecordsetting' || $getcontrollername == 'employeerecord' || $getcontrollername == 'clientrecord' || $getcontrollername == 'servicerecord' || $getcontrollername == 'taskrecord' || $getcontrollername == 'clientservicerelk' || $getcontrollername == 'taskbundle' || $getcontrollername == 'invoicerecord' || $getcontrollername == 'leadbundle' || $getcontrollername == 'edittaskbundle' || $getcontrollername == 'accountsetting' || $getcontrollername == 'restrictedcompany' || $getcontrollername == 'employeemodule' || $getcontrollername == 'portfolio' || $getcontrollername == 'holdingstatement' || $getcontrollername == 'sensitiveinformation' || $getcontrollername == 'tradingrequest' || $getcontrollername == 'holdingsummary' || $getcontrollername == 'blackoutperiod' || $getcontrollername == 'tradingplan' || $getcontrollername == 'declarationform' || $getcontrollername == 'exceptionreq' || $getcontrollername == 'reconcilation' || $getcontrollername == 'esop' || $getcontrollername == 'randomrequest' || $getcontrollername == 'randomexception' || $getcontrollername == 'sebi' || $getcontrollername == 'mis' || $getcontrollername == 'usermaster' || $getcontrollername == 'approvelperinfo' || $getcontrollername == 'upsimaster') { ?>
<?= $this->assets->outputJs('daterangepicker') ?>
<?= $this->assets->outputJs('datatablemn') ?>
<?php } ?>
    
<?php if ($getcontrollername == 'event' || $getcontrollername == 'agendarequest') { ?>
<?= $this->assets->outputJs('tableexport') ?>  
<?php } ?> 

<?php if ($getcontrollername == 'home' || $getcontrollername == 'adminmodule' || $getcontrollername == 'companymaster' || $getcontrollername == 'upsimaster' || $getcontrollername == 'departmentmaster' || $getcontrollername == 'homepage' || $getcontrollername == 'meeting' || $getcontrollername == 'sharescreen' || $getcontrollername == 'companymodule' || $getcontrollername == 'employeemodule' || $getcontrollername == 'restrictedcompany' || $getcontrollername == 'sensitiveinformation' || $getcontrollername == 'holdingstatement' || $getcontrollername == 'holdingsummary' || $getcontrollername == 'blackoutperiod' || $getcontrollername == 'tradingplan' || $getcontrollername == 'declarationform' || $getcontrollername == 'exceptionreq' || $getcontrollername == 'reconcilation' || $getcontrollername == 'esop' || $getcontrollername == 'randomrequest' || $getcontrollername == 'randomexception' || $getcontrollername == 'sebi' || $getcontrollername == 'mis' || $getcontrollername == 'upsimaster') { ?>
<?= $this->assets->outputJs('highcharts') ?>  
<?= $this->assets->outputJs('datatablemn') ?>
<script src="js/shared/jquery.cookie.js"></script>
 <script type="text/javascript" src="https://api.screenleap.com/js/screenleap.js"></script>   
<?php } ?>
     
<?php } ?>


<!-- ############# pdfHighLight Important Condition End ########### -->


     
<?php if ($getcontrollername == 'highlight') { ?>

<script src="js/shared/pdf.js"></script>
<script src="js/shared/pdf.worker.js"></script>
<script src="js/shared/pdf_viewer.js"></script>
<script src="js/shared/jquery.cookie.js"></script>
<script src="js/index.js"></script>

<?php } ?> 


<?php if ($getcontrollername == 'agendapdflink') { ?>
    
   

  <script src="js/pdfhighlighter/pdf.js?var=<?php echo $timestampfile; ?>"></script> 
  <script src="js/pdfhighlighter/pdf.worker.js?var=<?php echo $timestampfile; ?>"></script>    
  <script src="js/pdfhighlighter/viewer.js?var=<?php echo $timestampfile; ?>"></script>
  <script src="js/pdfhighlighter/texthighlighter.js?var=<?php echo $timestampfile; ?>"></script>
  <script src="js/pdfhighlighter/jquery.cookie.js?var=<?php echo $timestampfile; ?>"></script>
  <script src="js/pdfhighlighter/jquery.min.js?var=<?php echo $timestampfile; ?>"></script>
    

<?php } ?>  
    
    
<?php if ($getcontrollername == 'meeting') { ?>

<script src="js/editor/tinymce.min.js"></script>

<?php } ?>
    
<?php if ($getcontrolleractionname != 'orglog' && $getcontrolleractionname != 'orglist' && $getcontrolleractionname != 'autoaprove' && $getcontrolleractionname != 'startmeeting' && $getcontrolleractionname != 'employeeblocking' && $getcontrolleractionname != 'companytradingperiod' && $getcontrolleractionname != 'companytradebyemp' && $getcontrolleractionname != 'recipient' && $getcontrolleractionname != 'reqview' && $getcontrolleractionname != 'infosharing' && $getcontrolleractionname != 'archive_infosharing' && $getcontrolleractionname != 'archive_missharing' && $getcontrolleractionname != 'tradeplanview' && $getcontrolleractionname != 'planreqstview' && $getcontrolleractionname != 'planreqstapprv' && $getcontrolleractionname != 'exception_req' && $getcontrolleractionname != 'viewreconcilation' && $getcontrolleractionname != 'viewpastemployer' && $getcontrolleractionname != 'mis_recipient' && $getcontrolleractionname != 'mis_infosharing' && $getcontrolleractionname != 'viewesop' && $getcontrolleractionname != 'formb' && $getcontrolleractionname != 'formc' && $getcontrolleractionname != 'formd' && $getcontrolleractionname != 'viewformb' && $getcontrolleractionname != 'viewformc' && $getcontrolleractionname != 'viewformd' && $getcontrolleractionname != 'transformc' && $getcontrolleractionname != 'tradingdays' && $getcontrolleractionname != 'viewtransformc' && $getcontrolleractionname != 'transformd' && $getcontrolleractionname != 'viewtransformd' && $getcontrolleractionname != 'getuserinfo' && $getcontrolleractionname != 'misdetails' && $getcontrolleractionname != 'accesstouser' && $getcontrolleractionname != 'mis_changedesprsn' && $getcontrolleractionname != 'mis_contratrd' && $getcontrolleractionname != 'mis_nonexetrade' && $getcontrolleractionname != 'mis_confirmtrade' && $getcontrolleractionname != 'mis_formc' && $getcontrolleractionname != 'mis_formpct' && $getcontrolleractionname != 'mis_initialdiscsr' && $getcontrolleractionname != 'mis_annualdiscsr' && $getcontrolleractionname != 'upsi_infosharing' && $getcontrolleractionname != 'upsitypeclassify') { ?>
<?php

        $this->assets->collection('fivehundreadbhimacoregaon')
        ->addJs('js/common/'.$getcontrollername.'_common.js')
        ->setTargetPath('js/minified/common/'.$getcontrollername.'_fivehundreadbhimacoregaon.js')
        ->setTargetUri('js/minified/common/'.$getcontrollername.'_fivehundreadbhimacoregaon.js?var='.$timestampfile)
        ->addFilter(new Phalcon\Assets\Filters\Jsmin());
        $this->assets->outputJs('fivehundreadbhimacoregaon');
?>
<?php } ?>

<?php if ($getcontrolleractionname == 'orglog' || $getcontrolleractionname == 'orglist' || $getcontrolleractionname == 'startmeeting' || $getcontrolleractionname == 'employeeblocking' || $getcontrolleractionname == 'companytradingperiod' || $getcontrolleractionname == 'companytradebyemp' || $getcontrolleractionname == 'recipient' || $getcontrolleractionname == 'infosharing' || $getcontrolleractionname == 'archive_infosharing' || $getcontrolleractionname == 'reqview' || $getcontrolleractionname == 'misdetails' || $getcontrolleractionname == 'getuserinfo' || $getcontrolleractionname == 'tradingdays' || $getcontrolleractionname == 'autoaprove' || $getcontrolleractionname == 'exception_req' || $getcontrolleractionname == 'tradeplanview' || $getcontrolleractionname == 'planreqstview' || $getcontrolleractionname == 'planreqstapprv' || $getcontrolleractionname == 'viewreconcilation' || $getcontrolleractionname == 'viewpastemployer' || $getcontrolleractionname == 'mis_recipient' || $getcontrolleractionname == 'mis_infosharing' || $getcontrolleractionname == 'archive_missharing' || $getcontrolleractionname == 'viewesop' || $getcontrolleractionname == 'formb' || $getcontrolleractionname == 'formc' || $getcontrolleractionname == 'formd' || $getcontrolleractionname == 'viewformb' || $getcontrolleractionname == 'viewformc' || $getcontrolleractionname == 'viewformd' || $getcontrolleractionname == 'transformc' || $getcontrolleractionname == 'viewtransformc' || $getcontrolleractionname == 'transformd' || $getcontrolleractionname == 'viewtransformd' || $getcontrolleractionname == 'accesstouser' || $getcontrolleractionname == 'mis_changedesprsn' || $getcontrolleractionname == 'mis_contratrd' || $getcontrolleractionname == 'mis_nonexetrade' || $getcontrolleractionname == 'mis_confirmtrade' || $getcontrolleractionname == 'mis_formc' || $getcontrolleractionname == 'mis_formpct' || $getcontrolleractionname == 'mis_initialdiscsr' || $getcontrolleractionname == 'mis_annualdiscsr' || $getcontrolleractionname == 'upsi_infosharing' || $getcontrolleractionname == 'upsitypeclassify') { ?>
<?php
        $this->assets->collection('lordvishnushivaction')
        ->addJs('js/common/otheraction/'.$getcontrolleractionname.'_common.js')
        ->setTargetPath('js/minified/common/otheraction/'.$getcontrolleractionname.'_lordambedkar.js')
        ->setTargetUri('js/minified/common/otheraction/'.$getcontrolleractionname.'_lordambedkar.js?var='.$timestampfile)
        ->addFilter(new Phalcon\Assets\Filters\Jsmin());
        $this->assets->outputJs('lordvishnushivaction');
?>
<?php } ?>

<?php if ($getcontrollername == 'commingsoon') { ?>
 <!-- birds start --><div id="WE-container"></div><div id="WE-holder"><canvas></canvas></div><!-- birds end -->
<?= $this->assets->outputJs('commingsoon') ?>
<?= $this->assets->outputJs('commingsoonnxt') ?>
<?php } ?>


<?php  //echo $this->partial('commonman/footer'); ?>

<?php if ($getcontrollername != 'highlight') { ?> <!-- ########################################## pdfHighLight Important Condition Start ########################################## -->    
<?php if ($getcontrollername != 'index' && $getcontrollername != 'login' && $getcontrollername != 'forgotpassword' && $getcontrollername != 'randomrequest' && $getcontrollername != 'randomexception') { ?>   
<?= $this->partial('commonman/footer') ?>    
<script type="text/javascript">chlogironmanrajuharry();</script>
<?php } ?>  
 
<?php if ($getcontrollername == 'index' || $getcontrollername == 'login' || $getcontrollername == 'forgotpassword' || $getcontrollername == 'randomrequest' || $getcontrollername == 'randomexception') { ?>
<script type="text/javascript">chlogiironmanrajuharry();</script>
<?php } ?> 

<?= $this->assets->outputJs('chatpanel') ?>
<div id="mnotificationcmmm">
        <audio   class="player_audio" controls="" preload="none">
        </audio>
</div> 
<?php } ?> <!-- ########################################## pdfHighLight Important Condition End ########################################## -->  

 
</body>

</html>
