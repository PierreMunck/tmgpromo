<?php

require_once "Item.php";

class FormHiddenItem extends FormItem{
  
  public function __construct($mode = 'View') {
    parent::__construct('Hidden',$mode);
  }
  
  protected function renderHiddenEdit(){
    $out = '<input ';
    if(isset($this->fieldId)){
      $out .= ' id="'.$this->fieldId.'" ';
    }
    if(isset($this->fieldName)){
      $out .= ' name="'.$this->fieldName.'" ';
    }
    $out .= ' type="hidden" ';
    if(isset($this->fieldValue)){
      $out .= ' value="'.$this->fieldValue.'" ';
    }
    $out .= ' />';
    return $out;
  }
}
?>