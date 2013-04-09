<?php
$width = $this->width;
$height = $this->height;
$UaProf = NULL;

if($height == 0){
  $height = 300;
}
?>

<?php echo '<?xml version="1.0"?>' ?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" >
  <head>
    <link href="<?php echo $this->base ?>template/css/mobile.css" rel="stylesheet" type="text/css"  />
    <style type="text/css">
      a {text-decoration:none; color:#000000;}
    <?php
      echo ".block-service img{width: 100%}\n";
    ?>
    </style>
    
  </head>
  <body>
<?php if(isset($this->subscribed) && !$this->subscribed->error) : ?>
  <p>
    <h2><?php echo $this->subscribed_service->name ?></h2>
    <?php echo $this->subscribed->mesage ?>
  </p>
<?php endif;?>
<?php if(isset($this->serviceList)) :?>
  <?php $i = 0; ?>
  <?php foreach ($this->serviceList as $service) :?>
    <?php
      $format = NULL;
      $block_height = floor($height * 0.33);
      $img_height = floor($block_height * 0.79);
      $img_service = $this->getImgUrl('service/'. $service->key . '/'. $service->key .'.jpg',$width,$img_height,$format);
      $service_url = $this->base . $service->key . '/validate'; 
    ?>
    
    
    <div class="block-service" >
      <a style="" href="<?php echo $service_url?>">
        <img title="<?php echo $service->name ?>" src="<?php echo $img_service?>" height="<?php echo $img_height ?>"/>
        <p>
          <?php echo $service->description ?>
        </p>
      </a>
    </div>
    
    <?php $i++; ?>
  <?php endforeach?>
<?php endif?>
  </body>
</html>