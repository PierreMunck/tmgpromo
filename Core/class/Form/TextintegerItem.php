<?php

require_once "TextItem.php";

class FormTextintegerItem extends FormTextItem{
  
  public function returnValue($post){
    if(isset($post[$this->fieldName])){
      return intval($post[$this->fieldName]);
    }
    return NULL;
  }
}
?>