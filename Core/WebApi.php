<?php
/**
 * 
 */
include_once 'Core/Curl.php';
include_once 'Core/class/Form.php';

class WebApi {
  
  private $service = NULL;
  private $token;
  private $serviceInfo = NULL;
  private $serviceForm = NULL;
  private $subscriberNumber = NULL;
  private $GetNumberFromHeader = FALSE;
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

  public function callLog(){
    $curl = new Curl();
    $curl->addPostVar('data',json_encode($this->logData));
    if(isset($GLOBALS['tmgConfig']['urlWebApp']['log'])){
      $curl->exec($GLOBALS['tmgConfig']['urlWebApp']['log']);
    }
    if($curl->getHeader('http_code') == 200){
      //print_r($curl->getResult());
      return TRUE;
    }
    return FALSE;
  }
  
  public function callService($action,$session,$subscriber_number = NULL){
    $curl = new Curl();

    $curl->addPostVar('token',$this->token);
    $curl->addPostVar('service',$this->service);
    $curl->addPostVar('session',$session);
    $curl->addPostVar('forceDobleOptin',(!$this->GetNumberFromHeader));
    $curl->addPostVar('logData',json_encode($this->logData));
    $otherdata = array();
    if(isset($this->serviceInfo->form)){
      $form = new Form($this->serviceInfo->form);
      $otherdata = $form->getFormValues($_POST);
    }
    if(isset($subscriber_number)){
      $otherdata['subscriber_number'] = $subscriber_number;
    }
    foreach($otherdata as $key => $value){
      $curl->addPostVar($key,$value);
    }
    if(isset($GLOBALS['tmgConfig']['urlWebApp'][$action])){
      $curl->exec($GLOBALS['tmgConfig']['urlWebApp'][$action]);
    }
    if($curl->getHeader('http_code') == 200){
      /*if ($action == 'subscribe') {
        print_r($curl->getResult());
      }*/
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

  public function chargeServiceform(){
    if(!isset($this->serviceForm)){
      $this->token = $this->getToken(session_id());
      if(isset($this->token)){
        $this->serviceForm = $this->callService('infoform',session_id());
      }
    }
    return $this->serviceForm;
  }
  
  private function chargeSubscriberNumber(){
    
    //TODO : codigo segun el header del operador
    foreach ($_SERVER as $key => $value) {
      $this->logData($key,$_SERVER[$key]);
      if(preg_match('/LINE-ID/i', $key)){
        $this->subscriberNumber = $_SERVER[$key]; // 
      }
      if(preg_match('/LINE_ID/i', $key)){
        $this->subscriberNumber = $_SERVER[$key]; // 
      }
      if(preg_match('/MSISDN/i', $key)){
        $this->subscriberNumber = $_SERVER[$key]; // http://en.wikipedia.org/wiki/MSISDN
        $this->logData('subscriber_number',$this->subscriberNumber);
        $this->GetNumberFromHeader = TRUE;
        return $this->subscriberNumber;
      }
      if(isset($this->subscriberNumber)){
        $this->logData('subscriber_number',$this->subscriberNumber);
        $this->GetNumberFromHeader = TRUE;
        return $this->subscriberNumber;
      }
      
      if(preg_match('/IMSI/i', $key)){
        // http://en.wikipedia.org/wiki/IMSI
      }
    }
    $this->logData('subscriber_number',$this->subscriberNumber);
    return $this->subscriberNumber;
  }
  
  public function validate(){
    $view = NULL;
    $this->callLog();
    $this->chargeServiceInfo();
    if(isset($this->serviceInfo)){
      include_once 'Core/view/ValidateTemplate.php';
      $this->token = $this->getToken(session_id());
      $this->chargeSubscriberNumber();
      
      $view = new ViewValidateTemplate($this->serviceInfo);
      if(isset($this->serviceInfo->form)){
        $form = new Form($this->serviceInfo->form,'Edit');
        $form->setAction("confirm?token=".$this->token);
        $form->addFieldValues($this->subscriberNumber,'subscriber_number');
        $view->setForm($form);
      }
      
      $view->setValue('token',$this->token);
      $view->setValue('service',$this->service);
      $view->setValue('service_term_of_service',$this->serviceInfo->term_of_service);
      $view->setValue('service_description',$this->serviceInfo->description);
      if(isset($this->subscriberNumber)){
        $view->setValue('subscriber_number',$this->subscriberNumber);
      }
    }
    return $view;
  }
  
  public function confirm(){
    $this->token = $_GET['token'];
    $this->chargeSubscriberNumber();
    $this->chargeServiceInfo();
    $subscribed = NULL;
    if(isset($this->token) && isset($this->service)){
      $subscribed = $this->callService('subscribe',session_id(),$this->subscriberNumber);
    }
    
    if(isset($this->serviceInfo)){
      if(isset($subscribed) && !$subscribed->error){
        include_once 'Core/view/IndexTemplate.php';
        $view = new ViewIndexTemplate();
        $serviceList = $this->getServiceList();
        $view->setValue('serviceList',$serviceList);
        $view->setValue('subscribed',$subscribed);
        $view->setValue('subscribed_service',$this->serviceInfo);
        $view->setValue('service_term_of_service',$this->serviceInfo->term_of_service);
        $view->setValue('service_description',$this->serviceInfo->description);
        return $view;
      }
      
      include_once 'Core/view/ValidateTemplate.php';
      $view = new ViewValidateTemplate($this->serviceInfo);
      if(isset($this->serviceInfo->form)){
       $form = new Form($this->serviceInfo->form,'Edit');
        $form->setAction("confirm?token=".$this->token);
        $form->addFieldValues($this->subscriberNumber,'subscriber_number');
        $view->setForm($form);
      }
      
      $view->setValue('token',$this->token);
      $view->setValue('service',$this->service);
      $view->setValue('subscribed',$subscribed);
      $view->setValue('service_term_of_service',$this->serviceInfo->term_of_service);
      $view->setValue('service_description',$this->serviceInfo->description);
    }
    return $view;
  }
  
  public function term_of_service(){
    $view = NULL;
    $service_info = $this->chargeServiceInfo();
    $this->callLog();
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
    $this->callLog();
    $view = new ViewIndexTemplate();
    $serviceList = $this->getServiceList();
    $view->setValue('serviceList',$serviceList);
    
    return $view;
  }
}
?>