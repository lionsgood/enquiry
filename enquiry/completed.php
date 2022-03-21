<?php
include_once('function.php');
$page = "completed.html";
$output = read_and_parser($page);
//HTMLを表示 
echo $output;

?>