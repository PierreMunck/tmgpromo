<?php echo '<?xml version="1.0"?>' ?>
<?php

defined('APPLICATION_ENV') || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

define('ROOTPATH', getcwd());

include_once 'Mobile_Detect/Mobile_Detect.php';
include_once 'Mobile_Detect/UAProf.php';
include_once 'Core/lib/tmg/Image.php';
?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" >
  <head>
    <link href="template/css/navegador.css" rel="stylesheet" type="text/css"  />
  </head>
  <body>
    <?php

$tmgConfig = parse_ini_file('tmg.'.APPLICATION_ENV.'.conf',true);
    
$serviceList = array(
  'CLUB_BCORAZONES',
  'ALERTS_MALA',
  'CLUB_BCORAZONES',
  'ALERTS_MALA'
);

$number = NULL;
//TODO : codigo segun el header del operador
foreach ($_SERVER as $key => $value) {
  if(preg_match('/MSISDN/i', $key)){
    $number = $_SERVER[$key];
  }
  if(preg_match('/IMSI/i', $key)){
    // http://en.wikipedia.org/wiki/IMSI
  }
}

if(isset($number)){
  echo "Number :".$number."  ";
}else{
  echo "Number :  Undefined  ";
}

$width = 1024;
$height = 0;
$UaProf = NULL;
if(isset($_SERVER['HTTP_X_WAP_PROFILE'])){
  $url = str_replace('\'','',$_SERVER['HTTP_X_WAP_PROFILE']);
  $url = str_replace('"','',$url);
  $UaProf = new UAProf();
  $UaProf->process($url);
  $width = $UaProf->getInfo('screenwidth');
  $height = $UaProf->getInfo('screenheight');
}
?>
<p>
  screen width = <?php echo " ".$width."  ";?><br/>
  screen height = <?php echo " ".$height."  ";?><br/>
</p>

<?php

if($height == 0){
  $height = 800;
}
$toolImg = new TmgImage($tmgConfig['base'].'img/','/img/');
    
?>
  <?php $i = 0; ?>
  <?php foreach ($serviceList as $service) :?>
    <?php
      $j = $i % 4;
      $class = " ";
      
      if($j == 0 || $j == 3){
        $block_width = floor($width * 0.70);
        
        $class = " block-medium";
      }
      if($j == 1 || $j == 2){
        $block_width = floor($width * 0.30);
        $class = " block-small";
      }
      $block_height = floor($height * 0.30);
      $img_service =  $toolImg->getImage('service/'. $service . '/'. $service .'.jpg',$width);
      $service_url = $service . '/validate';
      
    ?>
    <a style="" href="<?php echo $service_url?>">
    <div class="block-service<?php echo $class ?>" width="<?php echo $block_width?>" height="<?php echo $block_height?>">
      <h3>titltlt </h3>
      <img title="tittlele" src="<?php echo $img_service?>" width="<?php echo $block_width?>" height="<?php echo $block_height?>" />
      <p>
        desc
      </p>
    </div>
    </a>
    <?php $i++; ?>
  <?php endforeach?>
  </body>
</html>