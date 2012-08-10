<?php


class Auth{
	private static $INSTANCIA_DE_CLASE;

	private $user;
	private $password;


	public function __construct(){
		
	}

	public static function getInstance(){
		if(!self::$INSTANCIA_DE_CLASE instanceof self)
		{
			self::$INSTANCIA_DE_CLASE = new self();
		}
		return self::$INSTANCIA_DE_CLASE;
	}

	public function setCredenciales($user,$password){
		$this->user = $user;
		$this->password = $password;
	}

	public function autenticar($connection){
		$valid = false;
		$sqlformat = "select * from usuario where username='%s' and password='%s'";
		$sql = sprintf($sqlformat, $this->user, $this->password); 
		$connection->connect();
		$result = $connection->execute($sql);
		if($connection->countRows($result)==1){
			session_start();
			$user = $connection->fetchObject($result);
			$_SESSION["user_logged"] = $user->id;
			$valid = true;
		}
		return $valid;
	}

	public function getUserLoggedInfo($connection){
		session_start();
		$user_logged = null;
		if(isset($_SESSION["user_logged"])){
			$user = new Usuario();
			if($user->find($_SESSION["user_logged"], $connection)){
				$user_logged = $user;
			}
		}
		return $user_logged;
	}

	public function clearSession(){
		session_start();
		$this->setCredenciales(null,null);
		unset($_SESSION["user_logged"]);
	}
}