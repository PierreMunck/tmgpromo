<?php

require_once "Form/ItemFactory.php";

class FormFactory {
  
  private $formDescription = array();
  private $formName = NULL;
  private $formDir = NULL;
  
  public function __construct($dir = NULL){
    if(isset($dir)){
      $this->formDir = $dir;
    }
  }
  
  private function cargarDescription(){
    
  }
  
  public function get($formName){
    $this->formName = $formName;
  }
  
  $login_form = array(
  'prefix' => array(
    'type' => 'Select',
    'label' => 'Pa&iacute;s',
    'class' => 'full',
    'values' => $prefix_global,
  ),
  'email_or_mobile' => array(
    'type' => 'Text',
    'label' => 'Correo o Celular',
    'class' => 'input_text',
  ),
  'country_id' => array(
    'type' => 'Hidden',
    'default_value' => $GLOBALS['global_option']->form->prefixs[0]->country_id,
  ),
);

$form = new Form($login_form,'Table','Edit');
$form->addClass('frm');
echo $form->render();


  
}