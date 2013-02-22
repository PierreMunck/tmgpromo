<?php echo '<?xml version="1.0"?>' ?>
<!DOCTYPE wml PUBLIC "-//WAPFORUM//DTD WML 1.1//EN"  "http://www.wapforum.org/DTD/wml_1.1.xml">
<?php
  $img_service = $this->img_path .'service/'. $this->service . '/'. $this->service .'-'.$this->width.'.jpg';
  $img_btn = $this->img_path . 'btn/confirmar-'.$this->width.'.jpg';
?>
<wml>
  <card id="card1" title="validate">
  <?php if(isset($this->subscribed) && $this->subscribed->error) : ?>
    <p>
      <?php echo $this->subscribed->mesage ?>
    </p>
  <?php endif;?>
    <p><img src="<?php echo $img_service?>" /></p>
    <?php if(isset($this->subscriber_number)) : ?>
    <p>
      Yo confirmo mi numero
      <input name="subscriber_number" size="12" format="*N"/>
      <anchor>
        <go method="post" href="confirm?token=<?php echo $this->token?>">
          <postfield name="subscriber_number" value="$(subscriber_number)"/>
        </go>
        <img src="<?php echo $img_btn?>" />
      </anchor>
    </p>
    <?php else :?>
    <p>
      Ingreza su país
      <select id="prefix" name="prefix">
        <option title="Nicaragua (505)" value="505">Nicaragua (505)</option>
        <option title="Honduras (504)" value="504">Honduras (504)</option>
      </select>
      Ingreza su numero
      <input name="mobile" size="12" format="*N"/>
      <anchor>
        <go method="post" href="test2.php">
            <postfield name="prefix" value="$(prefix)"/>
            <postfield name="mobile" value="$(mobile)"/>
        </go>
        Validate
      </anchor>
    </p>
    <?php endif;?>
    <p>
      accepto <a href="term_of_service">los terminos del servicio</a> <?php echo $this->service_name?>
    </p>
  </card>
</wml>