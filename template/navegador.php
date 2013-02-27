<?php echo '<?xml version="1.0"?>' ?>
<?php
      $width = 800;
      $height = $width * 0.3;
?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" >
  <head>
    <link href="<?php echo $this->base ?>template/css/navegador.css" rel="stylesheet" type="text/css"  />
    
    <style type="text/css">
      .block-service {height: <?php echo $height ?>px;}
    </style>
    
  </head>
  <body>
<?php if(isset($this->subscribed) && !$this->subscribed->error) : ?>
  <p>
    <h2><?php echo $this->subscribed_service->name ?></h2>
    <?php echo $this->subscribed->mesage ?>
  </p>
<?php endif;?>
  <?php $i = 0; ?>
  <?php if(isset($this->serviceList)) :?>
  <?php foreach ($this->serviceList as $service) :?>
    <?php
      $j = $i % 4;
      $class = " ";
      if($j == 0 || $j == 3){
        $width = floor($width * 0.68);
        
        $class = " block-medium";
      }
      if($j == 1 || $j == 2){
        $width = floor($width * 0.28);
        $class = " block-small";
      }
      
      $img_service = $this->getImgUrl('service/'. $service->key . '/'. $service->key .'.gif',$width, $height);
      $service_url = $this->base . $service->key . '/validate';
      
    ?>
    <a style="" href="<?php echo $service_url?>">
    <div class="block-service<?php echo $class ?>">
      <h3><?php echo $service->name ?></h3>
      <img title="<?php echo $service->name ?>" src="<?php echo $img_service?>"/>
      <p>
        <?php echo $service->description ?>
      </p>
    </div>
    </a>
    <?php $i++; ?>
  <?php endforeach?>
  <?php endif?>
  </body>
</html>