<?php
/**
 * 
 */
include_once 'Core/view/Template.php';

class ViewValidateTemplate extends ViewTemplate{
  
  protected $service_name = NULL;
  protected $service = NULL;
  protected $templatePath = 'validate/';
  
  public function __construct($service_info) {
    parent::__construct();
    $this->service = $service_info->key;
    $this->service_name = $service_info->name;
  }
  
}
?>