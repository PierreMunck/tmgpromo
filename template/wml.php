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
    <anchor>
      <go href="<?php echo $service_url?>"/>
      <img title="<?php echo $service->name ?>" src="<?php echo $img_service?>" />
    </anchor>
    <p>
      <?php echo $service->description ?>
    </p>
    <?php $i++; ?>
  <?php endforeach?>
  <? endif?>
  </card>
</wml>