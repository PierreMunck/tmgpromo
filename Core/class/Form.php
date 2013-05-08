<?php

require_once "Form/ItemFactory.php";

class Form {
  
  protected $mode = NULL;
  protected $type = NULL;
  protected $description = array();
  protected $formClass = array();
  protected $formValues = array();
  protected $descriptionHiddenCampo = array();
  protected $width = NULL;
  protected $formAction = NULL;
  protected $formMethod = "POST";
  
  
  private function convertToArray($obj){
    if(is_object($obj)){
      $obj = get_object_vars($obj);
      foreach($obj as $key => $val){
        $obj[$key] = $this->convertToArray($val);
      }
    }
    return $obj;
  }
  
  public function __construct($description, $mode = 'View', $type = 'Form') {
    if(is_object($description)){
      $description = get_object_vars($description);
      foreach($description as $key => $val){
        $description[$key] = $this->convertToArray($val);
      }
    }
    $this->description = $description;
    $this->mode = $mode;
    $this->type = $type;
    
  }
  
  public function setSize($width){
    $this->width = $width;
  }
  
  public function setType($type){
    $this->type = $type;
  }
  
  public function setMode($mode){
    $this->mode = $mode;
  }
  
  public function setAction($action){
    $this->formAction = $action;
  }
  
  public function setDescription($description){
    if(is_object($description)){
      $description = get_object_vars($description);
      foreach($description as $key => $val){
        $description[$key] = $this->convertToArray($val);
      }
    }
    $this->description = $description;
  }
  
  public function addClass($class){
    $this->formClass[] = $class;
  }
  
  public function addFieldValues($value,$key = NULL){
    if(is_array($value)){
      $this->formValues = array_merge($this->formValues,$value);
    }elseif(isset($key)) {
      $this->formValues[$key] = $value;
    }
  }
  
  public function addFieldOptions($option,$fieldType){
    if(!is_array($option)){
      return FALSE;
    }
    foreach ($this->description as $fieldName => $fieldDesc) {
      if(is_array($fieldDesc) && isset($fieldDesc['type']) && $fieldDesc['type'] == $fieldType){
        if(isset($this->description[$fieldName]['option']) && is_array($this->description[$fieldName]['option'])){
          $this->description[$fieldName]['option'] = array_merge($this->description[$fieldName]['option'],$option);
        }else{
          $this->description[$fieldName]['option'] = $option;
        }
      }  
    }
    return TRUE;
  }
  
  public function render(){
    if(isset($this->description)){
      if(isset($this->type) && method_exists($this, 'render'.$this->type)){
        $funcRender = 'render'.$this->type;
        return $this->$funcRender();
      }
      return 'Unknow mode form Item ';
    }
    return 'Unknow type form Item';
  }
  
  public function getFormValues($post){
    $result = array();
    unset($this->description['name']);
    unset($this->description['Description']);
    foreach ($this->description as $fieldName => $info) {
      $item = FormItemFactory::factory($fieldName,$info);
      $result[$fieldName] = $item->returnValue($post);
    }
    return $result;
  }
  
  protected function renderForm(){
    $out = "<form name=\"".$this->description['name']."\" ";
    $out .= " action=\"".$this->formAction."\"";
    $out .= " method=\"".$this->formMethod."\"";
    unset($this->description['name']);
    unset($this->description['Description']);
    if(isset($this->formClass)){
      $out .= ' class="'.implode(' ', $this->formClass).'" ';
    }
    if(isset($this->width)){
      $out .= ' width="'.$this->width.'" ';
    }
    $out .= ' >';
    
    foreach ($this->description as $fieldName => $info) {
      if($info['type'] == 'Hidden'){
        $this->descriptionHiddenCampo[$fieldName] = $info;
        unset($this->description[$fieldName]);
      }
    }
    foreach ($this->description as $fieldName => $info) {
      $item = FormItemFactory::factory($fieldName,$info,$this->type.$this->mode);
      
      
      if(isset($this->formValues) && isset($this->formValues[$fieldName])){
        $item->setFieldValue($this->formValues[$fieldName]);
      }
      $out .= $item->render();
    }
    foreach ($this->descriptionHiddenCampo as $fieldName => $info) {
      $item = FormItemFactory::factory($fieldName,$info,$this->type.$this->mode);
      if(isset($this->formValues) && isset($this->formValues[$fieldName])){
        $item->setFieldValue($this->formValues[$fieldName]);
      }
      $out .= $item->render();
    }
    $out .= '</form>';
    return $out;
  }

  protected function renderWap(){
    $out = "<p ";
    unset($this->description['name']);
    unset($this->description['Description']);
    if(isset($this->formClass)){
      $out .= ' class="'.implode(' ', $this->formClass).'" ';
    }
    if(isset($this->width)){
      $out .= ' width="'.$this->width.'" ';
    }
    $out .= ' >';
    $SubmitCampo = array();
    foreach ($this->description as $fieldName => $info) {
      if($info['type'] == 'hidden' || $info['type'] == 'Hidden'){
        $this->descriptionHiddenCampo[$fieldName] = $info;
        unset($this->description[$fieldName]);
      }
      if($info['type'] == 'submit' || $info['type'] == 'Submit'){
        $info['fieldName'] = $fieldName;
        $SubmitCampo = array_merge($info, $SubmitCampo);
        unset($this->description[$fieldName]);
      } 
    }
    
    foreach ($this->description as $fieldName => $info) {
      $item = FormItemFactory::factory($fieldName,$info,$this->type.$this->mode);
      if(isset($this->formValues) && isset($this->formValues[$fieldName])){
        $item->setFieldValue($this->formValues[$fieldName]);
      }
      $item->submitCampo($SubmitCampo);
      $out .= $item->render();
    }
    
    foreach ($this->descriptionHiddenCampo as $fieldName => $info) {
      $item = FormItemFactory::factory($fieldName,$info,$this->type.$this->mode);
      if(isset($this->formValues) && isset($this->formValues[$fieldName])){
        $item->setFieldValue($this->formValues[$fieldName]);
      }
      $item->submitCampo($SubmitCampo);
      $out .= $item->render();
    }
    
    $item = FormItemFactory::factory($SubmitCampo['fieldName'],$SubmitCampo,$this->type.$this->mode);
    $item->setFormMethod($this->formMethod);
    $item->setFormAction($this->formAction);
    $out .= $item->render();
    
    $out .= '</p>';
    return $out;
  }
}