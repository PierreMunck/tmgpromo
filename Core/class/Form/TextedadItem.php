<?php

require_once "TextItem.php";

class FormTextedadItem extends FormTextItem{

  public function returnValue($post){
    if(isset($post[$this->fieldName])){
      $value = intval($post[$this->fieldName]);
      if(preg_match("/^[1-9][0-9]$/",$value)){
        return $value;
      }
    }
    return NULL;
  }
}
?>