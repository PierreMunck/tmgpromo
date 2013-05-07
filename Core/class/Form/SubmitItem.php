<?php

require_once "Item.php";

class FormSubmitItem extends FormItem{
  
  private $fieldList = array();
  private $formAction = NULL;
  private $formMethod = NULL;
  
  public function __construct($mode = 'View') {
    parent::__construct('Submit',$mode);
  }
  
  protected function renderSubmitFormEdit(){
    $out = "<input ";
    
    // if $this->fieldValue = image 
    $out .= " type=\"image\" src=\"".$this->fieldValue."\" ";
    // if isset($this->fieldTitle)
    $out .= " alt=\"".$this->fieldTitle."\" ";
    if(!empty($this->fieldOption)){
      foreach ($this->fieldOption as $key => $value) {
        $out .= " ".$key."=\"".$value."\" ";
      }
    }
    $out .= " >\n";
    return $out;
  }
  protected function renderSubmitWapEdit(){
    $out = "<anchor>";
    //form method form url retrun
    $out .= "<go method=\"".$this->formMethod."\" href=\"".$this->formAction."\">";
    foreach ($this->$fieldList as $key => $value) {
      $out .= "<postfield name=\"".$key.'\" value="$('.$value.")\"/>";
    }
    $out .= "</go>";
    $out .= $this->fieldTitle;
    $out .= "</anchor>";
  }
  
  public function setFieldList($fieldList){
    $this->fieldList = $fieldList;
  }
  
  public function setFormMethod($formMethod){
    $this->formMethod = $formMethod;
  }
  
  public function setFormAction($formAction){
    $this->formAction = $formAction;
  }
  
  public function returnValue($post){
    return NULL;
  }
}
?>