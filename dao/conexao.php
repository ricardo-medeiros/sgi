<?php

// Base de dados de conexão Ambiente

class conexao{
	
	public $conn;
	
	public function setConn($conn){
		$this->conn = $conn;
	}
	public function getConn(){
		return $this->conn;
	}
	public function conectar () {

//configuração Open Shift
		 $dbusername =  "adminudkGdl1";  // Mysql nome de usuário
		 $dbpassword =  "prAm4Es4dwzc";  // Mysql senha
		 $conn = new PDO('mysql:host=127.10.128.2:3306;dbname=sgi', $dbusername, $dbpassword);
		 if (!$conn) {
		 	echo "Erro ao conectar ao banco de dado SGI-MySQL.";
		 	exit;
 		 };
 		 return $conn;
		 
//configuração locahost
		
// 		 $dbusername =  "root";  // Mysql nome de usuário
// 		 $dbpassword =  "root";  // Mysql senha
// 		 $conn = new PDO('mysql:host=127.0.0.1:3306;dbname=sgi', $dbusername, $dbpassword);
// 		 if (!$conn) {
// 		 	echo "Erro ao conectar ao banco de dado SGI-MySQL.";
// 		 	 exit;
// 		 };
// 		 return $conn;
	}

	public function desconectar()
	{
		$conn = null;
	}
}
?>