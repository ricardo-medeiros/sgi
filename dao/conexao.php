<?php

// Base de dados de conex�o Ambiente

class conexao{
	
	public $conn;
	
	public function setConn($conn){
		$this->conn = $conn;
	}
	public function getConn(){
		return $this->conn;
	}
	public function conectar () {

//configura��o Open Shift
// 		 $dbusername =  "adminudkGdl1";  // Mysql nome de usu�rio
// 		 $dbpassword =  "prAm4Es4dwzc";  // Mysql senha
// 		 $conn = new PDO('mysql:host=127.10.128.2:3306;dbname=sgi', $dbusername, $dbpassword);
// 		 if (!$conn) {
// 		 	echo "Erro ao conectar ao banco de dado SGI-MySQL.";
// 		 	exit;
// 		 };
		 
//configura��o locahost
		 //******************************************************************************************************************//
		 //nao esquecer de usar o arquivo .httacess do php e adicionar a opção "AddDefaultCharset UTF-8" no servidor hostinger
		 $dbusername =  "root";  // Mysql nome de usu�rio
		 $dbpassword =  "root";  // Mysql senha
		 $conn = new PDO('mysql:host=127.0.0.1:3306;dbname=sgi', $dbusername, $dbpassword);
		 if (!$conn) {
		 	echo "Erro ao conectar ao banco de dado SGI-MySQL.";
		 	 exit;
		 };
		 return $conn;
	}

	public function desconectar()
	{
		$conn = null;
	}
}
?>