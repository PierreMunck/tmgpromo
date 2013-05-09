<?php
/**
 * 
 */
include_once 'Core/view/Template.php';

class ViewGeneralTemplate extends ViewTemplate{
  
  protected $service_name = NULL;
  protected $service = NULL;
  protected $templatePath = 'validate/';
  
  public function __construct($service_info) {
    parent::__construct();
    $this->service = $service_info->key;
    $this->service_name = $service_info->name;
  }
  
   public function render(){
     $img_service = $this->getImgUrl('service/'. $this->service . '/'. $this->service .'.jpg',$this->width);
     $this->setValue('img_service',$img_service);
     $img_btn = $this->getImgUrl('btn/confirmar.gif',$this->width);
     $this->form->addFieldValues($img_btn,'submit');
     $this->form->addFieldOptions(array('style' => 'width:100%'),'submit');
     $this->form->addFieldOptions(array('style' => 'width:100%'),'number');
     
     if($this->mode == MODE_WML){
       $this->form->setType("Wap");
     }else{
       $this->form->setType("Form");
     }
     
     $this->setValue('service_form',$this->form->render());
     parent::render();
   }
  
}
?>