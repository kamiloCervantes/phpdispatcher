<?php

class Usuario{
	private $id;
	private $username;
	private $password;
	private $email;
	private $nombre;
	private $apellido;
	private $color;
	private $fechanac;

	public function setId($id){
		$this->id = $id;
	}

	public function setUsername($username){
		$this->username = $username;
	}

	public function setPassword($password){
		$this->password = $password;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function setNombre($nombre){
		$this->nombre = $nombre;
	}

	public function setApellido($apellido){
		$this->apellido = $apellido;
	}

	public function setColor($color){
		$this->color = $color;
	}

	public function setFechanac($fechanac){
		$this->fechanac = $fechanac;
	}

	public function getId(){
		return $this->id;
	}

	public function getUsername(){
		return $this->username;
	}

	public function getPassword(){
		return $this->password;
	}

	public function getEmail(){
		return $this->email;
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function getApellido(){
		return $this->apellido;
	}

	public function getColor(){
		return $this->color;
	}

	public function getFechanac(){
		return $this->fechanac;
	}

	public function save($conexion){
		$conexion->connect();
		$op = false;
		$sqlformat = "INSERT INTO usuario(username, password, email, nombre, apellido, color, fechanac) VALUES ('%s','%s','%s','%s','%s','%s','%s')";
		$sql = sprintf($sqlformat, $this->getUsername(), $this->getPassword(),
			$this->getEmail(), $this->getNombre(),$this->getApellido(),
			$this->getColor(), $this->getFechanac());
		if($conexion->execute($sql)){
			$op = true;
		}
		$conexion->close();
		return $op;
	}

	public function find($id, $conexion){
		$op = false;
		$this->setId($id);
		$conexion->connect();
		$sqlformat = "select * from usuario where id='%d'";
		$sql = sprintf($sqlformat, $this->id);
		$result = $conexion->execute($sql);
		if($conexion->countRows($result)>0){
			$op = true;
			$user_data = $conexion->fetchObject($result);
			$this->setUsername($user_data->username);
			$this->setPassword($user_data->password);
			$this->setEmail($user_data->email);
			$this->setNombre($user_data->nombre);
			$this->setApellido($user_data->apellido);
			$this->setColor($user_data->color);
			$this->setFechanac($user_data->fechanac);
		}
		return $op;
	} 

	public function toArray(){
		$tmp = array();
		//$tmp["id"] = $this->id;
		$tmp["username"] = $this->username;
		//$tmp["password"] = $this->password;
		$tmp["email"] = $this->email;
		$tmp["nombre"] = $this->nombre;
		$tmp["apellido"] = $this->apellido;
		$tmp["color"] = $this->color;
		$tmp["fechanac"] = $this->fechanac;
		return $tmp;
	}
}