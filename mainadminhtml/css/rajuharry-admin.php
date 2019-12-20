<?php
$cssFiles = array(
  "bootstrap.min.css",
  "font-awesome.min.css",
  "icons/icomoon/styles.css",  
  "animate.min.css",
  "buttonfloat.css",  
  "pnotify/pnotifycutom.css", 
  "internet/offline-theme-chrome.css",
  "core.css",
  "custom.css",    
 /* "plugin/menu/rajuharry-mega-menu.css",  */
);
/**
 * Ideally, you wouldn't need to change any code beyond this point.
 */
$buffer = "";
foreach ($cssFiles as $cssFile) {
  $buffer .= file_get_contents($cssFile);
}
// Remove comments
$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
$buffer = preg_replace("/(\/\*[\w\'\s\r\n\*\+\,\"\-\.]*\*\/)/", "", $buffer);
// Remove space after colons
$buffer = str_replace(': ', ':', $buffer);
// Remove whitespace
//$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '', '    ', '    '), '', $buffer);

$buffer = preg_replace("/\s{2,}/", " ", $buffer);
$buffer = str_replace("\r\n", "", $buffer);
$buffer = str_replace("\n", "", $buffer);
$buffer = str_replace("\t", "", $buffer);
$buffer = str_replace('@CHARSET "UTF-8";', "", $buffer);
$buffer = str_replace(', ', ",", $buffer);

// Enable GZip encoding.
ob_start("ob_gzhandler");
// Enable caching
header('Cache-Control: public');
// Expire in one day
header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 1186400) . ' GMT');
// Set the correct MIME type, because Apache won't set it for us
header("Content-type: text/css");
// Write everything out
echo($buffer);

?>
