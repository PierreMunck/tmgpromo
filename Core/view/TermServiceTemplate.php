<?php
/**
 * 
 */
include_once 'Core/view/Template.php';

class ViewTermServiceTemplate extends ViewTemplate{
  
  protected $termService = NULL;
  protected $service = NULL;
  protected $templatePath = 'terms_of_service/';
  
  
  public function __construct($service_info) {
    parent::__construct();
    $this->service = $service_info->key;
    $this->termService = $service_info->term_of_service;
  }

}
?>