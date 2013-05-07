<?php

require_once "Item.php";

class FormFechaItem extends FormItem{

  public function __construct($mode = 'View') {
    parent::__construct('Fecha',$mode);
  }
  
  protected function renderFechaEdit(){
    $out = '<select class="day" ';
    if(isset($this->fieldId)){
      $out .= ' id="'.$this->fieldId.'_day" ';
    }
    if(isset($this->fieldName)){
      $out .= ' name="'.$this->fieldName.'_day" ';
    }
    $out .= ' >';
    
    if(isset($this->fieldDefaultValue) && isset($this->fieldDefaultValue['day'])){
      $out .= '<option title="'.$this->fieldDefaultValue['day'].'" ';
      $out .= ' value="'.$this->fieldDefaultValue['day'].'" ';
      $out .= ' >'.$this->fieldDefaultValue['day'].'</option>';
    }
    foreach ($GLOBALS['bdays'] as $value){
      $out .= '<option title="'.$value.'" ';
      if(!is_null($this->fieldValue) && date("d",strtotime($this->fieldValue)) == $value){
        $out .= ' selected="selected" ';
      }
      $out .= ' value="'.$value.'" ';
      $out .= ' >'.$value.'</option>';
    }
    $out .= '</select>';
    $out .= 'de';
    $out .= '<select  class="month" ';
    if(isset($this->fieldId)){
      $out .= ' id="'.$this->fieldId.'_month" ';
    }
    if(isset($this->fieldName)){
      $out .= ' name="'.$this->fieldName.'_month" ';
    }
    $out .= ' >';
    if(isset($this->fieldDefaultValue) && isset($this->fieldDefaultValue['month'])){
      $out .= '<option title="'.$this->fieldDefaultValue['month'].'" ';
      $out .= ' value="'.$this->fieldDefaultValue['month'].'" ';
      $out .= ' >'.$this->fieldDefaultValue['month'].'</option>';
    }
    foreach ($GLOBALS['bmonths_number'] as $key => $value){
      $out .= '<option title="'.$value.'" ';
      if(!is_null($this->fieldValue) && date("m",strtotime($this->fieldValue)) == $value){
        $out .= ' selected="selected" ';
      }
      $out .= ' value="'.$value.'" ';
      $out .= ' >'.$GLOBALS['bmonths_names'][$key].'</option>';
    }
    $out .= '</select>';
    $out .= 'de';
    $out .= '<select class="year" ';
    if(isset($this->fieldId)){
      $out .= ' id="'.$this->fieldId.'_year" ';
    }
    if(isset($this->fieldName)){
      $out .= ' name="'.$this->fieldName.'_year" ';
    }
    $out .= ' >';
    if(isset($this->fieldDefaultValue) && isset($this->fieldDefaultValue['year'])){
      $out .= '<option title="'.$this->fieldDefaultValue['year'].'" ';
      $out .= ' value="'.$this->fieldDefaultValue['year'].'" ';
      $out .= ' >'.$this->fieldDefaultValue['year'].'</option>';
    }
    foreach ($GLOBALS['byears'] as $value){
      $out .= '<option title="'.$value.'" ';
      if(!is_null($this->fieldValue) && date("Y",strtotime($this->fieldValue)) == $value){
        $out .= ' selected="selected" ';
      }
      $out .= ' value="'.$value.'" ';
      $out .= ' >'.$value.'</option>';
    }
    $out .= '</select>';
    return $out;
  }
}
?>