<?php
define('ROOTPATH', getcwd());
defined('APPLICATION_ENV') || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

include_once 'Mobile_Detect/Mobile_Detect.php';
include_once 'Mobile_Detect/UAProf.php';

session_start();

$tmgConfig = parse_ini_file('tmg.'.APPLICATION_ENV.'.conf',true);

$tmgConfig['base'] .= '/';
$mobile_detect = new Mobile_Detect();

$UaProf = NULL;
if(isset($_SERVER['HTTP_X_WAP_PROFILE'])){
  $url = str_replace('\'','',$_SERVER['HTTP_X_WAP_PROFILE']);
  $url = str_replace('"','',$url);
  $UaProf = new UAProf();
  $UaProf->process($url);
}

$request_uri = str_replace($tmgConfig['host'], '', $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
$request_uri = str_replace($tmgConfig['base'], '', $request_uri);

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
$clear_uri_new = array();
foreach($clear_uri as $value){
  $clear_uri_new[] = $value;
}

$clear_uri = $clear_uri_new;
unset($clear_uri_new);

$end = sizeof($clear_uri) - 1;

if($end >= 0 && strpos($clear_uri[$end], '?') !== FALSE){
  $clear_uri[$end] = substr($clear_uri[$end],0,strpos($clear_uri[$end], '?'));
}

//para pruebas de numero
$_SERVER['MSISDN'] = '50589281947';

?>