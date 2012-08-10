<?php

class dbconf {
	private $_user;
	private $_password;
	private $_database;
	private $_server;
    private $_databaseManager;

    public function __construct(){
    	$this->_user = "user_ventas";
    	$this->_password = "danger8931";
    	$this->_database = "db_ventasenlinea";
    	$this->_server = "localhost";
    	$this->_databaseManager = "mysql";
    } 

    public function getUser(){
    	return $this->_user;
    }

    public function getPassword(){
    	return $this->_password;
    }

    public function getDatabase(){
    	return $this->_database;
    }

    public function getServer(){
    	return $this->_server;
    }

    public function getDatabaseManager(){
    	return $this->_databaseManager;
    }


}