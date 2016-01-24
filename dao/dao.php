<?php

// Base de dados de conexão Ambiente

// $dbhost =  "127.0.0.1";  // nome do host 
// $dbPort =  "3306";  // host port 
// $dbusername =  "root";  // Mysql nome de usuário 
// $dbpassword =  "root";  // Mysql senha 
// $db_name =  "sgi";  // nome do banco de dados

// $mysqlCon = mysqli_connect ($dbhost, $dbusername, $dbpassword,  "", $dbPort)  
// or die  ("Erro:". mysqli_error ($mysqlCon)); 
// mysqli_select_db ($mysqlCon, $db_name)  or  die ("Erro:"  . mysqli_error ($mysqlCon));

// if (!$mysqlCon) {echo "Não foi possível conectar ao banco MySQL.
// "; exit;}
// else {echo "Parabéns!! A conexão ao banco de dados ocorreu normalmente!.
// ";}
// mysqli_close($mysqlCon);

// $dbhost =  "127.6.60.2";  // nome do host
// $dbPort =  "3306";  // host port
// $dbusername =  "admindxUJ6Rp";  // Mysql nome de usuário
// $dbpassword =  "6XiPRkJ-KU1-";  // Mysql senha
// $db_name =  "php";  // nome do banco de dados

// $mysqlCon = mysqli_connect ($dbhost, $dbusername, $dbpassword,  "", $dbPort)  or die  ("Erro:". mysqli_error ($mysqlCon));
// mysqli_select_db ($mysqlCon, $db_name)  or  die ("Erro:"  . mysqli_error ($mysqlCon));

// if (!$mysqlCon) {echo "Não foi possível conectar ao banco MySQL.
// "; exit;}
// else {echo "Parabéns!! A conexão ao banco de dados ocorreu normalmente!.
// ";}
//mysqli_close($mysqlCon);

//$dbusername =  "root";  // Mysql nome de usuário
//$dbpassword =  "root";  // Mysql senha
// $conn = new PDO('mysql:host=127.0.0.1:3306;dbname=sgi', $dbusername, $dbpassword);
// if (!$conn) {
// 	echo "Erro ao conectar ao banco de dado SGI-MySQL.";
// 	 exit;
// };

$dbusername =  "adminudkGdl1";  // Mysql nome de usuário
$dbpassword =  "prAm4Es4dwzc";  // Mysql senha
 $conn = new PDO('mysql:host=127.10.128.2:3306;dbname=sgi', $dbusername, $dbpassword);
 if (!$conn) {
 	echo "Erro ao conectar ao banco de dado SGI-MySQL.";
 	exit;
 };
?>