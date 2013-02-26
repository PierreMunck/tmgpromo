<?php echo '<?xml version="1.0"?>' ?>

<?php
  $img_service = $this->getImgUrl('service/'. $this->service . '/'. $this->service .'.gif',$this->width);
  $img_btn = $this->getImgUrl('btn/regresar.gif',$this->width);
  
  $return_url = $this->base . $this->service . '/validate';
?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" >
  <head>
    <meta charset="UTF-8">
    <style type="text/css">
      a {text-decoration:none;}
    </style>
    
  </head>
  <body width="<?php echo $this->width?>">
  
    <img src="<?php echo $img_service?>"/>
    <br/>
    <p>
      <?php echo $this->termService?>
    </p>
    <br/>
    <a style=" margin: 0 auto; width: <?php echo $this->width?>px; display: block;" href="<?php echo $return_url?>">
      <img src="<?php echo $img_btn?>" style="margin: 0 auto"/>
    </a>
  </body>
</html>