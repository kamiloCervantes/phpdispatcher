<?php

$rootPath = dirname(dirname(__FILE__));
set_include_path(get_include_path() . PATH_SEPARATOR . $rootPath . PATH_SEPARATOR);

require 'models/databaseAdapter.php';

class Controller{

	protected $connection;
	
	public function __construct(){
		$this->connection = databaseAdapter::getInstance();
	}
}