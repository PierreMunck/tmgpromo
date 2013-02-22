<?php

class TmgImage {
  private $img_path = '/';
  private $img_url = NULL;
  private $image = NULL;
  
  function __construct($img_url,$img_path = null) {
    
    $this->img_url = $img_url;
    
    if(isset($img_path)){
      $this->img_path = ROOTPATH.$img_path;
    }
  }
  
  public function getImage($path, $width = NULL, $height = NULL){
    
    
    
    
    return $this->img_url.$path;
    
    switch (strtolower(substr(strrchr($file_name, '.'), 1))) {
      case 'jpg' :
      case 'jpeg' :
        $this->image = @imagecreatefromjpeg($file_path);
        break;
      case 'gif' :
        @imagecolortransparent($new_img, @imagecolorallocate($new_img, 0, 0, 0));
        $this->image = @imagecreatefromgif($file_path);
        break;
      case 'png' :
        @imagecolortransparent($new_img, @imagecolorallocate($new_img, 0, 0, 0));
        @imagealphablending($new_img, false);
        @imagesavealpha($new_img, true);
        $this->image = @imagecreatefrompng($file_path);
        break;
      default :
        $this->image = null;
    }
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