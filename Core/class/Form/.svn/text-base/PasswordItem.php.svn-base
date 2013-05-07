<?php

require_once "Item.php";

class FormPasswordItem extends FormItem{
  
  public function __construct($mode = 'View') {
    parent::__construct('Password',$mode);
  }
  
  protected function renderPasswordEdit(){
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
    $out .= ' type="password" ';
    if(isset($this->fieldTitle)){
      $out .= ' title="'.$this->fieldTitle.'" ';
    }
    if(isset($this->fieldValue)){
      $out .= ' value="'.$this->fieldValue.'" ';
    }
    $out .= ' />';
    return $out;
  }
}
?>