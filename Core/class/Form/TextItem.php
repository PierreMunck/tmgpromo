<?php

require_once "Item.php";

class FormTextItem extends FormItem{
  
  public function __construct($mode = 'View') {
    parent::__construct('Text',$mode);
  }
  
  protected function renderTextFormEdit(){
    $out = ' ';
    if(isset($this->fieldTitle)){
      $out = $this->fieldTitle."<br/>";
    }
    $out .= '<input ';
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
    if(isset($this->fieldValue)){
      $out .= ' value="'.$this->fieldValue.'" ';
    }
    $out .= ' />';
    return $out;
  }
  
  protected function renderTextWapEdit(){
    $out = ' ';
    if(isset($this->fieldTitle)){
      $out = $this->fieldTitle."<br/>";
    }
    $out .= '<input ';
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
    if(isset($this->fieldValue)){
      $out .= ' value="'.$this->fieldValue.'" ';
    }
    $out .= ' />';
    return $out;
  }
  
}
?>