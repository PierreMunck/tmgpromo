<?php

require_once "Item.php";

class FormMobilItem extends FormItem{
  
  protected $maxlenght = 'View';
  
  public function setMaxlenght($maxlenght){
    $this->maxlenght = $maxlenght;
  }
  
  public function __construct($mode = 'View') {
    parent::__construct('Mobil',$mode);
  }
  
  protected function renderMobilEdit(){
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
    if(isset($this->maxlenght) && is_int($this->maxlenght)){
      $out .= ' maxlength="'.$this->maxlenght.'" ';
    }
    $out .= ' type="text" ';
    if(isset($this->fieldTitle)){
      $out .= ' title="'.$this->fieldTitle.'" ';
    }
    if(isset($this->fieldValue)){
      $out .= ' value="'.$this->fieldValue.'" ';
    }else{
      $out .= ' value="" ';
    }
    if(isset($this->fieldDefaultValue)){
      $out .= ' placeholder="'.$this->fieldDefaultValue.'" ';
    }
    $out .= ' />';
    $out .= '<select name="operator" id="operator">';
    $out .= '</select>';
    return $out;
  }
}
?>