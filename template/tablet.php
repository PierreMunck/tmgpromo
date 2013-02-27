<?php echo '<?xml version="1.0"?>' ?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" >
  <head>
    <style type="text/css">
      a {text-decoration:none;}
    </style>
    
  </head>
  <body width="<?php echo $this->width?>">
<?php if(isset($this->subscribed) && !$this->subscribed->error) : ?>
  <p>
    <h2><?php echo $this->subscribed_service->name ?></h2>
    <?php echo $this->subscribed->mesage ?>
  </p>
<?php endif;?>
<?php if(isset($this->serviceList)) :?>
  <?php foreach ($this->serviceList as $service) :?>
    <?php 
      $img_service = $this->img_path .'service/'. $service->key . '/'. $service->key .'-'.$this->width.'.jpg';
      $service_url = $this->base . $service->key . '/validate'; 
    ?>
    
    <a style="" href="<?php echo $service_url?>">
      <img title="<?php echo $service->name ?>" src="<?php echo $img_service?>" />
    </a>
    <p>
      <?php echo $service->description ?>
    </p>
  <?php endforeach?>
  <?php endif?>
  </body>
</html>