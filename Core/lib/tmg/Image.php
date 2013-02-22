<?php

class TmgImage {
  private $img_path = 'img/';
  private $image = NULL;
  
  public function getImage($path, $width = NULL, $height = NULL){
    
    
    $this->image = @imagecreatefromjpeg($file_path);
  }
  
  private function rotate($orientation = 8){
    switch ($orientation) {
      case 3 :
        $this->image = @imagerotate($this->image, 180, 0);
        break;
      case 6 :
        $this->image = @imagerotate($this->image, 270, 0);
        break;
      case 8 :
        $this->image = @imagerotate($this->image, 90, 0);
        break;
      default :
        return false;
    }
    $success = imagejpeg($image, $file_path);
  }
  
}


?>