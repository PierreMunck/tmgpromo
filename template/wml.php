<?php echo '<?xml version="1.0"?>' ?>
<!DOCTYPE wml PUBLIC "-//WAPFORUM//DTD WML 1.1//EN"  "http://www.wapforum.org/DTD/wml_1.1.xml">
<wml>
  <card id="card1" title="Home">
<?php if(isset($this->subscribed) && !$this->subscribed->error) : ?>
  <p>
    <h2><?php echo $this->subscribed_service->name ?></h2>
    <?php echo $this->subscribed->mesage ?>
  </p>
<?php endif;?>
  <?php foreach ($this->serviceList as $service) :?>
    <?php 
      $img_service = $this->getImgUrl('service/'. $service->key . '/'. $service->key .'.jpg',$this->width);
      $service_url = $this->base . $service->key . '/validate'; 
    ?>
    <anchor>
      <go href="<?php echo $service_url?>"/>
      <img title="<?php echo $service->name ?>" src="<?php echo $img_service?>" />
    </anchor>
    <p>
      <?php echo $service->description ?>
    </p>
  <?php endforeach?>
  </card>
</wml>