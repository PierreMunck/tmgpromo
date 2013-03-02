<?php
/**
 * 
 */
include_once 'Core/Curl.php';

class WebApi {
  
  private $service = NULL;
  private $token;
  private $serviceInfo = NULL;
  private $subscriberNumber = NULL;
  private $logData = array();
  public $view = NULL;
  
  
  public function logData($key,$value){
    $this->logData[$key] = $value;
  }
  
  
  public function __construct($service = NULL) {
    if(isset($service)){
      $this->service = $service;
    }
    if(isset($_GET['token'])){
      $this->token = $_GET['token'];
    }
    $this->chargeSubscriberNumber();
  }
  
  public function getToken($session){
    $curl = new Curl();
  
    $curl->addPostVar('q','Register');
    $curl->addPostVar('user',$GLOBALS['tmgConfig']['tokenAccess']['user']);
    $curl->addPostVar('password',$GLOBALS['tmgConfig']['tokenAccess']['password']);
    $curl->addPostVar('service',$this->service);
    $curl->addPostVar('session',$session);
    if(isset($GLOBALS['tmgConfig']['urlToken'])){
      $curl->exec($GLOBALS['tmgConfig']['urlToken']);
    }
    if($curl->getHeader('http_code') == 200){
      return json_decode($curl->getResult());
    }
  }

  public function callService($action,$session,$subscriber_number = NULL){
    $curl = new Curl();

    $curl->addPostVar('token',$this->token);
    $curl->addPostVar('service',$this->service);
    $curl->addPostVar('session',$session);
    $curl->addPostVar('logData',json_encode($this->logData));
    
    if(isset($subscriber_number)){
      $curl->addPostVar('subscriber_number',$subscriber_number);
    }
    
    if(isset($GLOBALS['tmgConfig']['urlWebApp'][$action])){
      $curl->exec($GLOBALS['tmgConfig']['urlWebApp'][$action]);
    }
    if($curl->getHeader('http_code') == 200){
      if($action == 'subscribe'){
        print_r($curl->getResult());
      }
      return json_decode($curl->getResult());
    }
  }

  public function getServiceList(){
    return $this->callService('listservice',session_id());
  }
  
  public function chargeServiceInfo(){
    if(!isset($this->serviceInfo)){
      $this->token = $this->getToken(session_id());
      if(isset($this->token)){
        $this->serviceInfo = $this->callService('info',session_id());
      }
    }
    return $this->serviceInfo;
  }

  private function chargeSubscriberNumber(){
    
    //TODO : codigo segun el header del operador
    foreach ($_SERVER as $key => $value) {
      if(preg_match('/MSISDN/i', $key)){
        $this->subscriberNumber = $_SERVER[$key]; // http://en.wikipedia.org/wiki/MSISDN
        return $this->subscriberNumber;
      }
      if(preg_match('/IMSI/i', $key)){
        // http://en.wikipedia.org/wiki/IMSI
      }
    }
    $subscriber_number = NULL;
    $prefix = NULL;
    if(isset($_POST['prefix'])){
      $prefix = $_POST['prefix'];
    }elseif(isset($_GET['prefix'])){
      $prefix = $_GET['prefix'];
    }
    
    $mobil = NULL;
    if(isset($_POST['mobile'])){
      $mobil = $_POST['mobile'];
    }elseif(isset($_GET['mobile'])){
      $mobil = $_GET['mobile'];
    }
    
    if(isset($prefix) && isset($mobil)){
      $this->subscriberNumber = $prefix.$mobil;
      return $this->subscriberNumber;
    }
    
    if(isset($_POST['subscriber_number'])){
      $this->subscriberNumber = $_POST['subscriber_number'];
    }
    return $this->subscriberNumber;
  }
  
  public function validate(){
    $view = NULL;
    $this->chargeServiceInfo();
    if(isset($this->serviceInfo)){
      include_once 'Core/view/ValidateTemplate.php';
      $this->token = $this->getToken(session_id());
      $this->chargeSubscriberNumber();
      
      $view = new ViewValidateTemplate($this->serviceInfo);
      $view->setValue('token',$this->token);
      $view->setValue('service',$this->service);
      if(isset($this->subscriberNumber)){
        $view->setValue('subscriber_number',$this->subscriberNumber);
      }
    }
    return $view;
  }
  
  public function confirm(){
    $this->token = $_GET['token'];
    $this->chargeSubscriberNumber();
    $subscribed = NULL;
    if(isset($this->token) && isset($this->service) && isset($this->subscriberNumber)){
      $subscribed = $this->callService('subscribe',session_id(),$this->subscriberNumber);
    }
    
    $this->chargeServiceInfo();
    if(isset($this->serviceInfo)){
      if(isset($subscribed) && !$subscribed->error){
        include_once 'Core/view/IndexTemplate.php';
        $view = new ViewIndexTemplate();
        $serviceList = $this->getServiceList();
        $view->setValue('serviceList',$serviceList);
        $view->setValue('subscribed',$subscribed);
        $view->setValue('subscribed_service',$this->serviceInfo);
        return $view;
      }
      
      include_once 'Core/view/ValidateTemplate.php';
      $view = new ViewValidateTemplate($this->serviceInfo);
      $view->setValue('token',$this->token);
      $view->setValue('service',$this->service);
      $view->setValue('subscribed',$subscribed);
    }
    return $view;
  }
  
  public function term_of_service(){
    $view = NULL;
    $service_info = $this->chargeServiceInfo();
    if(isset($service_info)){
      include_once 'Core/view/TermServiceTemplate.php';
      
      $this->chargeSubscriberNumber();
      
      $view = new ViewTermServiceTemplate($service_info);
      if(isset($this->subscriberNumber)){
        $view->setValue('subscriber_number',$this->subscriberNumber);
      }
    }
    return $view;
  }
  
  public function index(){
    include_once 'Core/view/IndexTemplate.php';
    $view = new ViewIndexTemplate();
    $serviceList = $this->getServiceList();
    $view->setValue('serviceList',$serviceList);
    
    return $view;
  }
}
?>