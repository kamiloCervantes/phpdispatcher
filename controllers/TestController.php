<?php

require 'Controller.php';

class TestController extends Controller{

	
	public function TestBDConnection(){
		return $this->connection->connect();
	}

}