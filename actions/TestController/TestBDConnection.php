<?php

$rootPath = dirname(dirname(dirname(__FILE__)));
set_include_path(get_include_path() . PATH_SEPARATOR . $rootPath . PATH_SEPARATOR);

include_once 'controllers/TestController.php';

$test = new TestController();
if($test->TestBDConnection()){
	echo "Conexión establecida";
}
else{
	echo "No hay conexión a la BD";
}