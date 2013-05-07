<?php

require_once "Item.php";
require_once "SelectItem.php";
require_once "TextareaItem.php";
require_once "FotoItem.php";
require_once "TextItem.php";
require_once "PasswordItem.php";
require_once "CheckboxItem.php";
require_once "NumberItem.php";
require_once "SubmitItem.php";
require_once "FechaItem.php";
require_once "MobilItem.php";
require_once "HiddenItem.php";

class FormItemFactory {
  public static function factory($fieldName, $description, $mode = 'FormView'){
      $type = ucfirst($description['type']);
      switch ($type) {
        case 'Text':
          $item = new FormTextItem($mode);
          break;
        case 'Password':
          $item = new FormPasswordItem($mode);
          break;
        case 'Foto':
          $item = new FormFotoItem($mode);
          break;
        case 'Textarea':
          $item = new FormTextareaItem($mode);
          break;
        case 'Select':
          $item = new FormSelectItem($mode);
          if(isset($description['multiple'])){
            $item->setMultiple($description['multiple']);
          }
          break;
        case 'Mobil':
          $item = new FormMobilItem($mode);
          if(isset($description['maxlenght'])){
            $item->setMaxlenght($description['maxlenght']);
          }
          break;
        case 'Fecha':
          $item = new FormFechaItem($mode);
          break;
        case 'Number':
          $item = new FormNumberItem($mode);
          break;
        case 'Submit':
          $item = new FormSubmitItem($mode);
          if(isset($description['fields'])){
            $item->setFieldList($description['fields']);
          }
          break;
        case 'Checkbox':
          $item = new FormCheckboxItem($mode);
          break;
        case 'Hidden':
          $item = new FormHiddenItem($mode);
          break;
        default:
          $item = new FormItem('default',$mode);
          break;
      }
      if(isset($description['id'])){
        $item->setFieldId($description['id']);
      }else{
        $item->setFieldId($fieldName);
      }
      if(isset($description['name'])){
        $item->setFieldName($description['name']);
      }else{
        $item->setFieldName($fieldName);
      }
      if(isset($description['values'])){
        $item->addFieldValues($description['values']);
      }
      if(isset($description['default_value'])){
        $item->setFieldDefaultValue($description['default_value']);
      }
      if(isset($description['style'])){
        $item->setFieldStyle($description['style']);
      }
      if(isset($description['class'])){
        $item->addFieldClass($description['class']);
      }
      if(isset($description['option'])){
        $item->setFieldOption($description['option']);
      }
      $item->addFieldClass('item_'.$fieldName);
      if(isset($description['label'])){
        $item->setFieldTitle($description['label']);
      }
      return $item;
    }
}