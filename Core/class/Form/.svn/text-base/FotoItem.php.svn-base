<?php

require_once "Item.php";

class FormFotoItem extends FormItem{
  protected $fieldValues = array();
  
  public function __construct($mode = 'View') {
    parent::__construct('Foto',$mode);
  }
  
protected function renderFotoEdit(){
    $out = '<div id="fotoUpload">';
    $out .= '<img ';
    if(isset($this->fieldId)){
      $out .= ' id="'.$this->fieldId.'UploadImg" ';
    }
    if(isset($this->fieldName)){
      $out .= ' name="'.$this->fieldDefaultValue.'" ';
    }
    if(isset($this->fieldTitle)){
      $out .= ' alt="'.$this->fieldTitle.'" ';
    }
    if(isset($this->fieldValue)){
      if($this->fieldValue == 'default'){
        $url = $GLOBALS['conf']['base_url'] .'/img/female_default_avatar.jpg';
      }else{
        $url = $this->fieldValue;
      }
      $out .= ' src="'.$url.'" ';
    }
    $out .= ' />';
    $out .= '<input ';
    if(isset($this->fieldClass)){
      $out .= ' class="'.implode(' ', $this->fieldClass).'" ';
    }
    if(isset($this->fieldTitle)){
      $out .= ' title="'.$this->fieldTitle.'" ';
    }
    $out .= ' data-url="'. $GLOBALS['conf']['script_img_load'].'" type="file" ';
    if(isset($this->fieldName)){
      $out .= ' name="'.$this->fieldName.'" ';
    }
    if(isset($this->fieldId)){
      $out .= ' id="'.$this->fieldId.'" ';
    }
    if(isset($this->fieldValue)){
      $out .= ' value="'.$this->fieldValue.'" ';
    }
    $out .= ' />';
    return $out;
  }
}

?>