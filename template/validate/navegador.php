<?php echo '<?xml version="1.0"?>' ?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" >
  <head>
    <meta charset="UTF-8">
    <link href="template/css/navegador.css" rel="stylesheet" type="text/css"  />
    <style type="text/css">
      a {text-decoration:none;}
      p {font-size:18px;font-weight:bold;}
      .termofservice {color:#bbbbbb;font-size:12px;}
      input{width:100%}
      textarea{width:100%}
    </style>
    
  </head>
  <body>
<?php if(isset($this->subscribed) && $this->subscribed->error) : ?>
  <p>
    <?php echo $this->subscribed->mesage ?>
  </p>
<?php endif;?>
  <div class="block-service" >
    <img src="<?php echo $this->img_service?>" width="100%"/>
    <p width="<?php echo $this->width?>">
      <?php echo $this->service_description?>
    </p>
    <?php echo $this->service_form?>
    <p width="<?php echo $this->width?>" class="termofservice">
      <?php echo $this->service_term_of_service?>
    </p>
  </div>
  </body>
</html>