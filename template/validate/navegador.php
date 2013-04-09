<?php
$width = $this->width;
$height = $this->height;

if($height == 0){
  $height = 800;
}


$img_service = $this->getImgUrl('service/'. $this->service . '/'. $this->service .'.jpg',$this->width);
$img_btn = $this->getImgUrl('btn/confirmar.gif',$this->width);

?>



<?php echo '<?xml version="1.0"?>' ?>

<html xmlns="http://www.w3.org/1999/xhtml" lang="es" >
  <head>
    <meta charset="UTF-8">
    <link href="template/css/navegador.css" rel="stylesheet" type="text/css"  />
    <style type="text/css">
      a {text-decoration:none;}
      .termofservice {color:#bbbbbb;}
    </style>
    
  </head>
  <body>
<?php if(isset($this->subscribed) && $this->subscribed->error) : ?>
  <p>
    <?php echo $this->subscribed->mesage ?>
  </p>
<?php endif;?>
  <div class="block-service" >
    <img src="<?php echo $img_service?>" />
    <p width="<?php echo $this->width?>">
      <?php echo $this->service_description?>
    </p>
    <?php if(isset($this->subscriber_number)) : ?>
      <form name="" action="confirm?token=<?php echo $this->token?>" method="post">
        <input type="hidden" id="subscriber_number" name="subscriber_number">
        <input type="submit" value="Validate" width="<?php echo $this->width?>">
      </form>
    <?php else :?>
      <form name="" action="confirm?token=<?php echo $this->token?>" method="post">
        Ingreza su país
        <br/>
        <select id="prefix" name="prefix" width="<?php echo $this->width?>" style="width:100%; height:<?php echo $this->width * 0.05?>px">
          <option title="Nicaragua (505)" value="505">Nicaragua (505)</option>
          <option title="Honduras (504)" value="504">Honduras (504)</option>
        </select>
        <br/>
        Ingreza su numero
        <br/>
        <input type="number" id="mobile" name="mobile" style="width:100%; height:<?php echo $this->width * 0.05?>px">
        <input type="image" src="<?php echo $img_btn?>" alt="Validate" width="100%">
      </form>
    <?php endif;?>
    <p width="<?php echo $this->width?>" class="termofservice">
      <?php echo $this->service_term_of_service?>
    </p>
  </div>
  </body>
</html>