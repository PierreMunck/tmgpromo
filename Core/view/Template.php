<?php
/**
 * 
 */

define("MODE_WML", 1);
define("MODE_MOBIL", 2);
define("MODE_TABLET", 3);
define("MODE_NAVIGADOR", 4);

class ViewTemplate {
  
  protected $width = 1024;
  protected $height = 800;
  private   $optimWidth = array(450,300,200,170,150);
  private   $mode = MODE_NAVIGADOR;
  protected $templatePath = '';
  private $img_path = 'img/';
  private $base = '/';
  
  public function __construct() {
     $this->img_path = $GLOBALS['tmgConfig']['base'] . $this->img_path;
     $this->base = $GLOBALS['tmgConfig']['base'];
  }
  
  public function setModeMobile($mobile_detect){
    if($mobile_detect->isMobile()){
      if($mobile_detect->LevelAccept() > 1){
        $this->mode = MODE_MOBIL;
      }else{
        $this->mode = MODE_WML;
      }
    }elseif($mobile_detect->isTablet()){
      $this->mode = MODE_TABLET;
    }else {
      $this->mode = MODE_NAVIGADOR;
    }
  }
  
  public function setProfileMobile($UaProf){
    $last = $this->width;
    $widthProf = intval($UaProf->getInfo('screenwidth'));
    foreach ($this->optimWidth as $cur) {
      if( $last > $widthProf && $widthProf > $cur){
        $this->width = $cur;
        break;
      }
      $last = $cur;
    }
    $this->height = $UaProf->getInfo('screenheight');
  }
  
  public function setValue($name,$value){
    $this->$name = $value;
  }
  
  public function render(){
    if($this->mode == MODE_WML){
      include 'template/'.$this->templatePath.'wml.php';
    }elseif($this->mode == MODE_MOBIL){
      include 'template/'.$this->templatePath.'mobile.php';
    }elseif($this->mode == MODE_TABLET){
      include 'template/'.$this->templatePath.'tablet.php';
    }else {
      include 'template/'.$this->templatePath.'navegador.php';
    }
  }
}
?>