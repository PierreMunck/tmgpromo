<?php

require_once "Item.php";

class FormNumberItem extends FormItem{
  
  public function __construct($mode = 'View') {
    parent::__construct('Number',$mode);
  }

  protected function renderNumberFormEdit(){

    if(isset($this->fieldValue)){
      $out ="<input type=\"hidden\" id=\"".$this->fieldId."\" name=\"".$this->fieldName."\">";
    }else{
      $out = "Ingreza su país<br/>\n";
      $out .= "<select id=\"".$this->fieldId."_prefix\" name=\"".$this->fieldName."_prefix\" "; 
      if(!empty($this->fieldOption)){
        foreach ($this->fieldOption as $key => $value) {
          $out .= " ".$key."=\"".$value."\" ";
        }
      }
      $out .= ">\n";
      foreach ($this->fieldValues as $key => $value) {
        $out .= "<option title=\"".$value."\" value=\"".$key."\" "; 
        if($key == $this->fieldDefaultValue){
          $out .= " selected ";
        }
        $out .= " >";
        $out .= $value."</option>\n";
      }
      
      $out .= '</select>'."\n";
      $out .= '<br/>'."\n";
      $out .= 'Ingreza su numero';
      $out .= '<br/>'."\n";
      
      $out .= "<input type=\"number\" id=\"".$this->fieldId."_mobile\" "; 
      $out .= " name=\"".$this->fieldName."_mobile\" "; 
      if(!empty($this->fieldOption)){
        foreach ($this->fieldOption as $key => $value) {
          $out .= " ".$key."=\"".$value."\" ";
        }
      }
      $out .=">\n";
    }
    return $out;
  }

  protected function renderNumberWapEdit(){

    if(isset($this->fieldValue)){
      $out ="<input type=\"hidden\" id=\"".$this->fieldId."\" name=\"".$this->fieldName."\">";
    }else{
      $out = "Ingreza su país<br/>\n";
      $out .= "<select id=\"".$this->fieldId."_prefix\" name=\"".$this->fieldName."_prefix\" "; 
      if(!empty($this->fieldOption)){
        foreach ($this->fieldOption as $key => $value) {
          $out .= " ".$key."=\"".$value."\" ";
        }
      }
      $out .= ">\n";
      foreach ($this->fieldValues as $key => $value) {
        $out .= "<option title=\"".$value."\" value=\"".$key."\" "; 
        if($key == $this->fieldDefaultValue){
          $out .= " selected ";
        }
        $out .= " >";
        $out .= $value."</option>\n";
      }
      
      $out .= '</select>'."\n";
      $out .= '<br/>'."\n";
      $out .= 'Ingreza su numero';
      $out .= '<br/>'."\n";
      
      $out .= "<input type=\"number\" id=\"".$this->fieldId."_mobile\" "; 
      $out .= " name=\"".$this->fieldName."_mobile\" "; 
      if(!empty($this->fieldOption)){
        foreach ($this->fieldOption as $key => $value) {
          $out .= " ".$key."=\"".$value."\" ";
        }
      }
      $out .=">\n";
    }
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