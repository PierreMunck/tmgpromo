<?php
define('ROOTPATH', getcwd());
include_once 'Core/lib/tmg/Image.php';

$tools = new TmgImage('/img','/img');


$url_img = $tools->getImage('service/ALERTS_MALA2/ALERTS_MALA2.jpg');

?>

<img src="<?php echo $url_img?>" />