<?php
$cssFiles = array(
  "../plugin/rajuharryironman-forms.css",  
  "../plugin/tab/rajuharry-ironman-tabs.css", 
  "../calendar/bootstrap-material-datetimepicker.css",  
  "../calendar/bootstrap-datetimepicker.min.css",
  "../datatables/jquery.dataTables.min.css",
  "../preloader.css",   
  "commoncss/declarationform_common.css"
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


