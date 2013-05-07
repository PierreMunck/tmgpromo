<?php

require_once "Item.php";

class FormCheckboxItem extends FormItem{
  protected $fieldValues = array();
  
  public function __construct($mode = 'View') {
    parent::__construct('Checkbox',$mode);
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
  
  protected function renderCheckboxEdit(){
    foreach ($this->fieldValues as $key => $value) {
      $out = '<input ';
      if(isset($this->fieldClass)){
        $out .= ' class="'.implode(' ', $this->fieldClass).'" ';
      }
      if(isset($this->fieldId)){
        $out .= ' id="'.$this->fieldId.'" ';
      }
      if(isset($this->fieldName)){
        $out .= ' name="'.$this->fieldName.'" ';
      }
      $out .= ' type="checkbox" ';
      if(isset($this->fieldTitle)){
        $out .= ' title="'.$this->fieldTitle.'" ';
      }
      if(isset($this->fieldValue) && $this->fieldValue == $key){
        $out .= ' checked="checked" ';
      }
      $out .= ' />';
      $out .= '<span>'.$value.'</span>';
    }
    return $out;
  }
}
?>