<?php echo '<?xml version="1.0"?>' ?>

<!DOCTYPE wml PUBLIC "-//WAPFORUM//DTD WML 1.2//EN" "http://www.wapforum.org/DTD/wml12.dtd">

<?php $img_btn = '/img/btn/confirmar-170.jpg'; ?>
<wml>
<card id="card1" title="WML Form">
  <?php print_r($_POST); ?>
<p>
  <img src="/img/service/ALERTS_MALA/ALERTS_MALA-170.jpg" alt="Thumb Image"/>
</p>
<p>
   Ingreza su país : 
      <select name="prefix">
          <option title="Nicaragua (505)" value="505">Nicaragua (505)</option>
          <option title="Honduras (504)" value="504">Honduras (504)</option>
      </select>
   Ingreza su numero :
      <input name="mobile" size="12" format="*N"/>
   <anchor>
      <go method="post" href="test2.php">
          <postfield name="prefix" value="$(prefix)"/>
          <postfield name="mobile" value="$(mobile)"/>
      </go>
      <img src="<?php echo $img_btn?>" />
    </anchor>
</p>
</card>

</wml>