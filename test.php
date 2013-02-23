<?php
define('ROOTPATH', getcwd());
include_once 'Core/lib/tmg/Image.php';

$tools = new TmgImage('img/','/img/');



$url_imgnot = $tools->getImage('service/ALERTS_MALA2/not.jpg');

$url_img_equiv = $tools->getImage('service/ALERTS_MALA2/ALERTS_MALA2.jpg');

$url_img100 = $tools->getImage('service/ALERTS_MALA2/ALERTS_MALA2.jpg',100);

$url_img50 = $tools->getImage('service/ALERTS_MALA2/ALERTS_MALA2.jpg',50);

$url_img100100 = $tools->getImage('service/ALERTS_MALA2/ALERTS_MALA2.jpg',100,100);

$url_imgrot1 = $tools->getImage('service/ALERTS_MALA2/ALERTS_MALA2.jpg',NULL,NULL,ORIENTATION1);

$url_imgrot2 = $tools->getImage('service/ALERTS_MALA2/ALERTS_MALA2.jpg',NULL,NULL,ORIENTATION2);

$url_imgrot3 = $tools->getImage('service/ALERTS_MALA2/ALERTS_MALA2.jpg',NULL,NULL,ORIENTATION3);

$url_imgrot4 = $tools->getImage('service/ALERTS_MALA2/ALERTS_MALA2.jpg',NULL,NULL,ORIENTATION4);



?>

<img src="<?php echo $url_imgnot?>" />

<img src="<?php echo $url_img_equiv?>" />

<img src="<?php echo $url_img100?>" />

<img src="<?php echo $url_img50?>" />

<img src="<?php echo $url_img100100?>" />

<img src="<?php echo $url_imgrot1?>" />

<img src="<?php echo $url_imgrot2?>" />

<img src="<?php echo $url_imgrot3?>" />

<img src="<?php echo $url_imgrot4?>" />

