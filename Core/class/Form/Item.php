<?php
 
class FormItem {
  
  protected $type = NULL;
  protected $mode = 'View';
  protected $fieldName = NULL;
  protected $fieldClass = array();
  protected $fieldId = NULL;
  protected $fieldValue = NULL;
  protected $fieldDefaultValue = NULL;
  protected $fieldTitle = NULL;
  protected $fieldStyle = NULL;
  protected $fieldOption = array();
  protected $fieldWidth = NULL;
  protected $fieldValues = array();
  
  public function __construct($type, $mode = 'View') {
    $this->type = $type;
    $this->mode = $mode;
  }
  
  public function setType($type){
    $this->type = $type;
  }
  
  public function setMode($mode){
    $this->mode = $mode;
  }
  
  public function setFieldName($name){
    $this->fieldName = $name;
  }
  
  public function setFieldStyle($style){
    $this->fieldStyle = $style;
  }
  
  public function setFieldTitle($title){
    $this->fieldTitle = $title;
  }
  
  public function setFieldWidth($width){
    $this->fieldWidth = $width;
  }
  
  public function setFieldId($id){
    $this->fieldId = $id;
  }
  
  public function setFieldValue($value){
    $this->fieldValue = $value;
  }
  
  public function setFieldDefaultValue($value){
    $this->fieldDefaultValue = $value;
  }
  
  public function addFieldClass($class){
    $this->fieldClass[] = $class;
  }
  
  public function setFieldOption($option){
    if(!is_array($option)){
      return FALSE;
    }
    foreach ($option as $key => $value) {
      $this->addFieldOption($key, $value);
    }
    return TRUE;
  }
  
  public function addFieldOption($key,$option){
    if($key == 'class'){
      $this->addFieldClass($option);
    }elseif($key == 'id'){
      $this->setFieldId($option);
    }else{
      $this->fieldOption[$key] = $option;
    }
  }
  
  public function addFieldValues($value,$key = NULL){
    if(is_array($value)){
      foreach ($value as $key => $value) {
        $this->fieldValues[$key] = $value;
      }
    }elseif(isset($key)) {
      $this->fieldValues[$key] = $value;
    }else{
      $this->fieldValues = array();
      $this->fieldValues[] = $value;
    }
  }
  
  public function render(){
    if(isset($this->type)){
      if(isset($this->mode) && method_exists($this, 'render'.$this->type.$this->mode)){
        $funcRender = 'render'.$this->type.$this->mode;
        return $this->$funcRender();
      }
      return 'Unknow mode form Item'.$this->mode;
    }
    return 'Unknow type form Item';
  }
  
  public function submitCampo(&$SubmitCampo){
    $SubmitCampo['fields'][$this->fieldName] = $this->fieldName;
  }
}
?>