<?php
define('ROOTPATH', getcwd());

include_once 'Mobile_Detect/Mobile_Detect.php';
include_once 'Mobile_Detect/UAProf.php';

session_start();

$tmgConfig = parse_ini_file('tmg.conf',true);

$tmgConfig['base'] .= '/';
$mobile_detect = new Mobile_Detect();

$UaProf = NULL;
if(isset($_SERVER['HTTP_X_WAP_PROFILE'])){
  $url = substr($_SERVER['HTTP_X_WAP_PROFILE'], 1, -1);
  $UaProf = new UAProf();
  $UaProf->process($url);
}

$request_uri = str_replace($tmgConfig['host'] . $tmgConfig['base'], '', $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
 
if($_SERVER['SERVER_PORT'] == '443' || $_SERVER['SERVER_PORT'] == 443){
  $tmgConfig['base_url'] = 'https://'. $tmgConfig['host'] . $tmgConfig['base'];
} else {
  $tmgConfig['base_url'] = 'http://'. $tmgConfig['host'] . $tmgConfig['base'];
}

//clear url
$clear_uri = explode("/", $request_uri);

foreach($clear_uri as $key => $value){
  if(is_null($value) || $value == ''){
    unset($clear_uri[$key]);
  }
}

$end = sizeof($clear_uri) - 1;

if($end >= 0 && strpos($clear_uri[$end], '?') !== FALSE){
  $clear_uri[$end] = substr($clear_uri[$end],0,strpos($clear_uri[$end], '?'));
}

//para pruebas de numero
//$_SERVER['MSISDN'] = '50589284686';

?>