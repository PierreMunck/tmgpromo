<?php

$_GET['file'];
$file_path = realpath("../%%cont/??!@sms/");
$file = $file_path ."/". $_GET['file'];

header("Pragma: public");
header("Expires: 0");
//header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: no-store, no-cache, must-revalidate");  
header("Cache-Control: post-check=0, pre-check=0", false);  
header("Content-Description: File Transfer");
header('Content-Type: ' . mime_content_type ($file));
//header("Content-Type: application/force-download");
header("Content-Disposition: attachment; filename=".basename($file));
header("Content-Transfer-Encoding: binary");
header('Content-length: '.filesize($file));  

@readfile($file);

?>