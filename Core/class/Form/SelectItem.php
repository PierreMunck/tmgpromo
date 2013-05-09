<?php

require_once "Item.php";

class FormSelectItem extends FormItem{
  protected $fieldMultiple = false;
  protected $fieldDefaultOption = array();
  
  public function __construct($mode = 'View') {
    parent::__construct('Select',$mode);
  }
  
  public function setMultiple($multiple){
    $this->fieldMultiple = $multiple;
  }
  
  public function setDefaultOption($defaultOption){
    $this->fieldDefaultOption = $defaultOption;
  }
  
  public function setFieldValue($value){
    if(isset($this->fieldMultiple) && $this->fieldMultiple == true){
      $this->fieldValue = explode(',', $value);
    }else{
      $this->fieldValue = $value;
    }
  }
  
  protected function renderSelectFormEdit(){
    $out = '<select ';
    if(isset($this->fieldClass)){
      $out .= ' class="'.implode(' ', $this->fieldClass).'" ';
    }
    if(isset($this->fieldId)){
      $out .= ' id="'.$this->fieldId.'" ';
    }
    if(isset($this->fieldName)){
      $out .= ' name="'.$this->fieldName.'" ';
    }
    if(isset($this->fieldMultiple) && $this->fieldMultiple == true){
      $out .= ' multiple ';
    }
    if(!empty($this->fieldOption)){
      foreach ($this->fieldOption as $key => $value) {
        $out .= " ".$key."=\"".$value."\" ";
      }
    }
    $out .= ' >';
    if(isset($this->fieldDefaultOption) && !empty($this->fieldDefaultOption)){
      foreach ($this->fieldDefaultOption as $key => $value){
        $out .= '<option title="'.$value.'" ';
        $out .= ' value="'.$key.'" ';
        $out .= ' >'.$value.'</option>';
      }
    }
    foreach ($this->fieldValues as $key => $value){
      $out .= '<option title="'.$value.'" ';
      if(is_array($this->fieldValue)){
        foreach($this->fieldValue as $fieldValue){
          if($fieldValue == $key){
            $out .= ' selected="selected" ';
          }
        }
      }else{
        if($this->fieldValue == $key){
          $out .= ' selected="selected" ';
        }
      }
      
      $out .= ' value="'.$key.'" ';
      $out .= ' >'.$value.'</option>';
    }
    $out .= '</select>';
    return $out;
  }

  protected function renderSelectWapEdit(){
    $out = '<select ';
    if(isset($this->fieldClass)){
      $out .= ' class="'.implode(' ', $this->fieldClass).'" ';
    }
    if(isset($this->fieldId)){
      $out .= ' id="'.$this->fieldId.'" ';
    }
    if(isset($this->fieldName)){
      $out .= ' name="'.$this->fieldName.'" ';
    }
    if(isset($this->fieldMultiple) && $this->fieldMultiple == true){
      $out .= ' multiple ';
    }
    $out .= ' >';
    if(isset($this->fieldDefaultOption) && !empty($this->fieldDefaultOption)){
      foreach ($this->fieldDefaultOption as $key => $value){
        $out .= '<option title="'.$value.'" ';
        $out .= ' value="'.$key.'" ';
        $out .= ' >'.$value.'</option>';
      }
    }
    foreach ($this->fieldValues as $key => $value){
      $out .= '<option title="'.$value.'" ';
      if(is_array($this->fieldValue)){
        foreach($this->fieldValue as $fieldValue){
          if($fieldValue == $key){
            $out .= ' selected="selected" ';
          }
        }
      }else{
        if($this->fieldValue == $key){
          $out .= ' selected="selected" ';
        }
      }
      
      $out .= ' value="'.$key.'" ';
      $out .= ' >'.$value.'</option>';
    }
    $out .= '</select>';
    return $out;
  }

  public function returnValue($post){
    
    if(isset($post[$this->fieldName.'_prefix']) && isset($post[$this->fieldName.'_mobile'])){
      return $post[$this->fieldName.'_prefix'].$post[$this->fieldName.'_mobile'];
    }
      
    if(isset($post[$this->fieldName])){
      return $post[$this->fieldName];
    }
  }
}
?>