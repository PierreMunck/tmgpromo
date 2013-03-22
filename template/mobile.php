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
      a {text-decoration:none;}
    <?php
      $block_height = floor($height * 0.33);
      echo ".block-large {width:10; height:".$block_height."px}\n";
      echo ".block-medium {width: 69%; height:".$block_height."px}\n";
      echo ".block-small {width: 29%; height:".$block_height."px}\n";
      echo ".block-service {margin: 2px 0.5%; height:".$block_height."px}\n";
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
      $j = $i % 4;
      $class = " ";
      $format = NULL;
      if($j == 0 || $j == 3){
        $block_width = floor($width * 0.69);
        $class = " block-medium";
      }
      if($j == 1 || $j == 2){
        $block_width = floor($width * 0.29);
        $class = " block-small";
        $format = 'lt';
      }
      $img_height = floor($block_height * 0.79);
      $img_service = $this->getImgUrl('service/'. $service->key . '/'. $service->key .'.jpg',$block_width,$img_height,$format);
      $service_url = $this->base . $service->key . '/validate'; 
    ?>
    
    <a style="" href="<?php echo $service_url?>">
      <div class="block-service<?php echo $class ?>" >
      <img title="<?php echo $service->name ?>" src="<?php echo $img_service?>" height="<?php echo $img_height ?>"/>
      <p>
        <?php echo $service->name ?> <?php echo $service->description ?>
      </p>
      </div>
    </a>
    <?php $i++; ?>
  <?php endforeach?>
<?php endif?>
  </body>
</html>