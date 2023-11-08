<?php
$ruta = dirname(__FILE__, 2) . "/";
$ruta = str_replace("\\", "/", $ruta);
$ruta = explode("/", $ruta);
$ruta = $ruta[count($ruta) - 2];

define('URL', 'http://localhost/viauy-develop/');

//conexion a la base de datos
define('HOST', 'localhost');
define('PORT_DB', '3306');
define('DB', 'CoderWise');
define('USER', 'root');
define('PASSWORD', '1234567890');
define('CHARSET', 'utf8mb4');
