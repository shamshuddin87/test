<?php
$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);$buffer = preg_replace("/(\/\*[\w\'\s\r\n\*\+\,\"\-\.]*\*\/)/", "", $buffer);
$buffer = str_replace(': ', ':', $buffer);
$buffer = preg_replace("/\s{2,}/", " ", $buffer);$buffer = str_replace("\r\n", "", $buffer);
$buffer = str_replace("\n", "", $buffer);$buffer = str_replace("\t", "", $buffer);$buffer = str_replace('@CHARSET "UTF-8";', "", $buffer);
$buffer = str_replace(', ', ",", $buffer);
ob_start("ob_gzhandler");
header('Cache-Control: public');
header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 1186400) . ' GMT');
header("Content-type: text/css");
echo($buffer);
?>