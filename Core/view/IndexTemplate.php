<?php
/**
 * 
 */
include_once 'Core/view/Template.php';

class ViewIndexTemplate extends ViewTemplate{
  
  protected $service_name = NULL;
  protected $service = NULL;
  protected $templatePath = '/';
  
  public function __construct($service_info = NULL) {
    parent::__construct();
    if(isset($service_info)){
      $this->service = $service_info->key;
      $this->service_name = $service_info->name;
    }
  }

  public function render(){
    parent::render();
  }
}
?>