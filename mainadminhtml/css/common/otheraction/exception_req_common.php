<?php
$cssFiles = array(
  "../../plugin/tab/rajuharry-ironman-tabs.css", 
  "../../datatables/jquery.dataTables.min.css",
  "../../calendar/bootstrap-material-datetimepicker.css",  
    "../../calendar/bootstrap-datetimepicker.min.css",
  "../../preloader.css",     
  "commoncss/exception_req_common.css",
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