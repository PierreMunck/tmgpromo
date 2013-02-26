<?php echo '<?xml version="1.0"?>' ?>
<!DOCTYPE wml PUBLIC "-//WAPFORUM//DTD WML 1.1//EN"  "http://www.wapforum.org/DTD/wml_1.1.xml">
<?php
  $img_service = $this->getImgUrl('service/'. $this->service . '/'. $this->service .'.gif',$this->width);
  $img_btn = $this->getImgUrl('btn/regresar.gif',$this->width);
  
  $return_url = $this->base . $this->service . '/validate';
?>
<wml>
  <card id="card1" title="term of service">
    <p><img src="<?php echo $img_service?>"/></p>
    <p>
      <?php echo $this->termService?>
    </p>
    <anchor>
      <go href="<?php echo $return_url?>"/>
      <img src="<?php echo $img_btn?>"/>
    </anchor>
  </card>
</wml>