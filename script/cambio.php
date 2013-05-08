<?php

defined('APPLICATION_ENV') || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));
$tmgConfig = parse_ini_file('../tmg.'.APPLICATION_ENV.'.conf',true);

$htaccess_noche = "
#AddHandler cgi-php5 .php

#SetEnv APPLICATION_ENV dev

# clean url
#RewriteEngine on

#RewriteCond %{REQUEST_FILENAME} !-f
#RewriteCond %{REQUEST_FILENAME} !-d
#RewriteCond %{REQUEST_URI} !=/favicon.ico
#RewriteRule ^ index.php [L]

Redirect 301 / ".$conf['htaccess']['urlnoche']."
";

$htaccess_dia = "
#AddHandler cgi-php5 .php

#SetEnv APPLICATION_ENV dev

# clean url
RewriteEngine on

RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_URI} !=/favicon.ico
RewriteRule ^ index.php [L]

#Redirect 301 / ".$conf['htaccess']['urlnoche']."
";

if($_SERVER['REMOTE_ADDR'] == $conf['htaccess']['remotecontrol'] ){
  if($_GET['tmp'] == "noche" || $_GET['tmp'] == "dia"){
    if($_GET['tmp'] == "dia"){
      $htaccess_file = $conf['htaccess']['filedia'];
      $fh = fopen($htaccess_file, 'w') or die("can't open file");
      print_r("se puso el .htaccess de dia en :\n".realpath ($htaccess_file)."\n");
      print_r("\n".$htaccess_dia);
      fwrite($fh, $htaccess_dia);
      fclose($fh);
    }
    if($_GET['tmp'] == "noche"){
      $htaccess_file = $conf['htaccess']['filenoche'];
      $fh = fopen($htaccess_file, 'w') or die("can't open file");
      print_r("se puso el .htaccess de noche en :\n".realpath ($htaccess_file)."\n");
      print_r("\n".$htaccess_noche);
      fwrite($fh, $htaccess_noche);
      fclose($fh);
    }
  }
  print_r('ok');
}else{
  print_r('restricted');
}

?>