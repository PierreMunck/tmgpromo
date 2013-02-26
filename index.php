<?php
require_once 'load.php';

$service = NULL;
if(isset($clear_uri[0]) && in_array($clear_uri[0], $tmgConfig['service'])){
  $service = $clear_uri[0];
}
if(isset($_GET['service'])){
  $service =  $_GET['service'];
}

$action = NULL;
$view = NULL;
if(isset($clear_uri[1])){
  $action = $clear_uri[1];
}

include_once 'Core/WebApi.php';
$api = new WebApi($service);

// log info
$api->logData('download_file',$tmgConfig['base_url'].$request_uri);
$api->logData('download_ip',$_SERVER['REMOTE_ADDR']);
$api->logData('download_browser',$_SERVER['HTTP_USER_AGENT']);
$api->logData('download_date',$_SERVER['REQUEST_TIME']);


if(!isset($service)){
  $view = $api->index();
}else {
  if(isset($action)){
    $action = strtolower($action);
    if(method_exists($api, $action)){
      $view = $api->$action();
    }
    if(!isset($view)){
      $view = $api->index();
    }
  }else{
    $view = $api->index();
  }
}

if(isset($view)){
  $view->setModeMobile($mobile_detect);
  if(isset($UaProf)){
    $view->setProfileMobile($UaProf);
  }
  echo $view->render();
}else{
  echo 'error View';
}

?>