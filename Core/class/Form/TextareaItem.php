<?php

require_once "Item.php";

class FormTextareaItem extends FormItem{
  
  public function __construct($mode = 'View') {
    parent::__construct('Textarea',$mode);
  }
  
  protected function renderTextareaEdit(){
    $out = '<textarea ';
    if(isset($this->fieldClass)){
      $out .= ' class="'.implode(' ', $this->fieldClass).'" ';
    }
    if(isset($this->fieldId)){
      $out .= ' id="'.$this->fieldId.'" ';
    }
    if(isset($this->fieldName)){
      $out .= ' name="'.$this->fieldName.'" ';
    }
    $out .= ' type="text" ';
    if(isset($this->fieldTitle)){
      $out .= ' title="'.$this->fieldTitle.'" ';
    }
    $out .= ' >';
    if(isset($this->fieldValue)){
      $out .= $this->fieldValue;
    }
    $out .= '</textarea>';
    return $out;
  }
}