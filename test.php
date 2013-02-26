<?php echo '<?xml version="1.0"?>' ?>

<html xmlns="http://www.w3.org/1999/xhtml" lang="es" >
  <head>
    <link href="template/css/navegador.css" rel="stylesheet" type="text/css"  />
  </head>
  <body>
    <?php

$serviceList = array(
  'CLUB_BCORAZONES',
  'ALERTS_MALA'
);

?>
  <?php $i = 0; ?>
  <?php foreach ($serviceList as $service) :?>
    <?php
      $j = $i % 4;
      $class = " ";
      $width = 175;
      $height = $width * 0.3;
      if($j == 0 || $j == 3){
        $width = floor($width * 0.68);
        
        $class = " block-medium";
      }
      if($j == 1 || $j == 2){
        $width = floor($width * 0.28);
        $class = " block-small";
      }
      
      $img_service = 'img/service/'. $service . '/'. $service .'.jpg';
      $service_url = $service . '/validate';
      
    ?>
    <a style="" href="<?php echo $service_url?>">
    <div class="block-service<?php echo $class ?>" height="<?php echo $height ?>">
      <h3 height="10%">titltlt </h3>
      <img title="tittlele" src="<?php echo $img_service?>" width="100%" />
      <p height="10%">
        desc
      </p>
    </div>
    </a>
    <?php $i++; ?>
  <?php endforeach?>
  
  </body>
</html>