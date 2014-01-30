<?php
$f3=require('lib/base.php');
$f3->config('config/config.ini');

//charge le fichier de conf
$f3->config('config/routes.ini');
$f3->set('dB',new DB\SQL('mysql:host=127.0.0.1;port=3306;dbname=cortex','root',''));



$f3->set('dB',new DB\SQL('mysql:host=127.0.0.1;port=3306;dbname=cortex','root',''));


$f3->run();
//on met en route notre instance (la fleche est un pointeur)

?>