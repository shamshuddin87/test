<?php
$cssFiles = array(
    "../../plugin/rajuharryironman-forms.css",  
    "../../calendar/bootstrap-material-datetimepicker.css",  
    "../../calendar/bootstrap-datetimepicker.min.css",
    "../../calendar/calendersupercal.css",      
    "../../plugin/tab/rajuharry-ironman-tabs.css", 
    "../../datatables/jquery.dataTables.min.css",
    "../../preloader.css",     
    "commoncss/startmeeting_common.css",
);
/**
 * Ideally, you wouldn't need to change any code beyond this point.
 */
$buffer = "";
foreach ($cssFiles as $cssFile) {
  $buffer .= file_get_contents($cssFile);
}
include('../minify/common.php');
?>
