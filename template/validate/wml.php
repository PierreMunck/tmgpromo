<?php echo '<?xml version="1.0"?>' ?>
<!DOCTYPE wml PUBLIC "-//WAPFORUM//DTD WML 1.1//EN"  "http://www.wapforum.org/DTD/wml_1.1.xml">
<?php
  $img_service = $this->getImgUrl('service/'. $this->service . '/'. $this->service .'.jpg',$this->width);
  $img_btn = $this->getImgUrl('btn/confirmar.gif',$this->width);
?>
<wml>
  <card id="card1" title="validate">
  <?php if(isset($this->subscribed) && $this->subscribed->error) : ?>
    <p>
      <?php echo $this->subscribed->mesage ?>
    </p>
  <?php endif;?>
    <p><img src="<?php echo $this->img_service?>" width="100%"/></p>
    <p width="<?php echo $this->width?>">
      <?php echo $this->service_description?>
    </p>
    
    <?php echo $this->service_form?>

    <p width="<?php echo $this->width?>">
      <?php echo $this->service_term_of_service?>
    </p>
  </card>
</wml>