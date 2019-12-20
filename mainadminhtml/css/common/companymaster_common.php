<?php
$cssFiles = array(
   "../plugin/rajuharryironman-forms.css",    
   "../plugin/tab/rajuharry-ironman-tabs.css", 
   "../scrollbar/jquery.mCustomScrollbar.css", 
   "../plugin/higchart.css", 
   "../preloader.css", 
   "../calendar/calendersupercal.css",  
   "commoncss/companymaster_common.css"   
);
/**
 * Ideally, you wouldn't need to change any code beyond this point.
 */
$buffer = "";
foreach ($cssFiles as $cssFile) {
  $buffer .= file_get_contents($cssFile);
}
include('minify/common.php');
?>


