<?php
$cssFiles = array(
   "commoncss/user_common.css",
   "../plugin/rajuharryironman-forms.css",
   "../plugin/datatablemain.css"
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


