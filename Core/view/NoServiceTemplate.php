<?php
/**
 * 
 */
include_once 'Core/view/Template.php';

class ViewNoServiceTemplate extends ViewTemplate{
  
  protected $templatePath = 'no_service/';
  
  public function __construct() {
    parent::__construct();
  }

}
?>