<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require 'config/dbconf.php';	

class databaseAdapter {

   //Datos de conexion
	private $_user;
	private $_password;
	private $_database;
	private $_server;
    private $_databaseManager;

	//Variable de conexion y consulta
	private $_conn;

	//Variable estatica para implementar singleton
	private static $INSTANCIA_DE_CLASE;
	
	//Constructor
	private function __construct(){
		$this->setConnectDefault();
	}

	//Metodo para crear una instancia unica de la clase.
	public static function getInstance(){
		if(!self::$INSTANCIA_DE_CLASE instanceof self)
		{
			self::$INSTANCIA_DE_CLASE = new self();
		}
		return self::$INSTANCIA_DE_CLASE;
	}

	public function getDatabaseManager(){
		return $this->_databaseManager;
	}
	
	//Conectarse con una base de datos en Mysql
	public function connect(){
		$this->_conn = mysql_connect($this->_server, $this->_user, $this->_password)
		or die(mysql_error());
		mysql_select_db($this->_database, $this->_conn);
                return $this->_conn;
	}

      
        
	public function close(){
       	mysql_close($this->_conn);
    }
        
	//Ejecutar consulta en mysql
    public function execute($query)
	{
		$respuesta = mysql_query($query, $this->_conn);
		if(!$respuesta){
			die(mysql_error());
		}
		return $respuesta;
	}
    
    public function countRows($result){
    	return mysql_num_rows($result);
    }

	public function fetchAssoc($result){
    	$fil = mysql_fetch_assoc($result);
    	return $fil;
    }
    
    public  function returnId(){
    	return mysql_insert_id($this->_conn);
    }
    
    	
	public function fetchObject($result){
		$result = mysql_fetch_object($result);
		return $result;
	}
	
	private function free_ResultMysql($result){
		$res = mysql_free_result($result);
		return $res;
	}
	
	
    public function setConnectDefault(){
    	$info = new dbconf();
  		$this->_databaseManager = $info->getDatabaseManager();
  		$this->_database = $info->getDatabase();
  		$this->_user = $info->getUser();
  		$this->_password = $info->getPassword();
  		$this->_server = $info->getServer();
    }
        
	public function __clone()
   	{
            trigger_error("Operacion Invalida: No puedes clonar una instancia de ". get_class($this) ." class.", E_USER_ERROR );
   	}

   	public function __wakeup()
   	{
            trigger_error("No puedes deserializar una instancia de ". get_class($this) ." class.");
   	} 
}