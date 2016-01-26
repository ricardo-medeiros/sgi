<?php
	session_start();
	$login = $_POST["j_username"];
    $senha = $_POST["j_password"];
    //fazer conexao aqui
	if ($login == 'ricardo@gmail.com' && $senha == '123')
	{
		$_SESSION["NOME"] = "Ricardo dos Santos Medeiros";
		header('Location: http://localhost:90/sgi/views/site/principal.php');
	}
?>