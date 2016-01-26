//<?php
//	session_start();
//	$login = $_POST["j_username"];
//    $senha = $_POST["j_password"];
    //fazer conexao aqui
//	if ($login == 'ricardo@gmail.com' && $senha == '123')
//	{
//		$_SESSION["NOME"]   = "Ricardo dos Santos Medeiros";
//		$_SESSION["INDEX"]  = "http://localhost:90/sgi/index.php";
//		$_SESSION["SITE"]   = "http://localhost:90/sgi/views/site/principal.php";
//		$_SESSION["LOGOUT"] = "http://localhost:90/sgi/controle/logout.controller.php";
//		header('Location: ' .$_SESSION["SITE"]);
//	}
//?>

<?php
	session_start();
	$login = $_POST["j_username"];
    $senha = $_POST["j_password"];
    //fazer conexao aqui
	if ($login == 'ricardo@gmail.com' && $senha == '123')
	{
		$_SESSION["NOME"]   = "Ricardo dos Santos Medeiros";
		$_SESSION["INDEX"]  = "http://sgi-programasweb.rhcloud.com";
		$_SESSION["SITE"]   = "http://sgi-programasweb.rhcloud.com/views/site/principal.php";
		$_SESSION["LOGOUT"] = "http://sgi-programasweb.rhcloud.com/controle/logout.controller.php";
		header('Location: ' .$_SESSION["SITE"]);
	}
?>