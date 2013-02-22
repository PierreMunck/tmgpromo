<?php echo '<?xml version="1.0"? encoding="UTF-8">' ?>


<?php $img_btn = '/img/btn/confirmar-170.jpg'; ?>

<html xmlns="http://www.w3.org/1999/xhtml" lang="es" >
  <head>
    <meta charset="UTF-8">
    <link href="/tmgpromo/template/css/navegador.css" rel="stylesheet" type="text/css"  />
  </head>
  <body>
    <?php print_r($_POST)?>
    <img src="/img/service/ALERTS_MALA/ALERTS_MALA-170.jpg" />
    <br/>
          <br/>
      <form name="" action="test.php" method="post">
        Ingreza su país<br/>
        <select id="prefix" name="prefix">
          <option title="Nicaragua (505)" value="505">Nicaragua (505)</option>
          <option title="Honduras (504)" value="504">Honduras (504)</option>
        </select><br/>
        Ingreza su numero<br/>
        <input type="number" name="mobile" pattern="[0-9]*" format="N*">
        <input type="image" src="<?php echo $img_btn?>" alt="Validate">
      </form>
        <p width="1024">
      accepto <a href="term_of_service">los terminos del servicio</a>
      mala    </p>
<?php
include_once 'Mobile_Detect/Mobile_Detect.php';
$mobile_detect = new Mobile_Detect();
print_r($mobile_detect->LevelAccept());

?>
  </body>
</html>