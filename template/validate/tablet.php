<?php echo '<?xml version="1.0"?>' ?>

<?php
  $img_service = $this->getImgUrl('service/'. $this->service . '/'. $this->service .'.gif',$this->width);
  $img_btn = $this->getImgUrl('btn/confirmar.gif',$this->width);
?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" >
  <head>
    <meta charset="UTF-8">
    <style type="text/css">
      a {text-decoration:none;}
    </style>
    
  </head>
  <body>
<?php if(isset($this->subscribed) && $this->subscribed->error) : ?>
  <p>
    <?php echo $this->subscribed->mesage ?>
  </p>
<?php endif;?>
    <p><img src="<?php echo $img_service?>" /></p>
    <?php if(isset($this->subscriber_number)) : ?>
      <form name="" action="confirm?token=<?php echo $this->token?>" method="post">
        <input type="hidden" id="subscriber_number" name="subscriber_number">
        <input type="submit" value="Validate" width="<?php echo $this->width?>">
      </form>
    <?php else :?>
      <form name="" action="confirm?token=<?php echo $this->token?>" method="post">
        Ingreza su país
        <br/>
        <select id="prefix" name="prefix" width="<?php echo $this->width?>">
          <option title="Nicaragua (505)" value="505">Nicaragua (505)</option>
          <option title="Honduras (504)" value="504">Honduras (504)</option>
        </select>
        <br/>
        Ingreza su numero
        <br/>
        <input type="number" id="mobile" name="mobile" width="<?php echo $this->width?>">
        <input type="image" src="<?php echo $img_btn?>" alt="Validate">
      </form>
    <?php endif;?>
    <p width="<?php echo $this->width?>">
      accepto <a href="term_of_service">los terminos del servicio</a>
      <?php echo $this->service_name?>
    </p>

  </body>
</html>