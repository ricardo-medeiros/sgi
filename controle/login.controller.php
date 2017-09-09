<?php
	session_start();
	define('__ROOT__',dirname(dirname(__FILE__)));
	require_once(__ROOT__.'/controle/usuario.controle.php');
	
	$site = "http://".$_SERVER["HTTP_HOST"];
	//$_SESSION["INDEX"]  = "http://sgi-web.com:90/index.php";
	$_SESSION["INDEX"]  = $site."/index.php";
	$login = $_POST["j_username"];
    $senha = $_POST["j_password"];
    
    $usuarioControle = new Usuario_Controle();
    $usuario = $usuarioControle->efetuarLogin($login,$senha);
    
	if ($usuario->nome != '')
	{
		$_SESSION["NOME"]   = $usuario->nome;
		$_SESSION["USUARIO"]= $usuario->idUsuario;
		//$_SESSION["SITE"]   = "http://sgi-web.com:90/views/site/principal.php";
		//$_SESSION["LOGOUT"] = "http://sgi-web.com:90/controle/logout.controller.php";
		$_SESSION["SITE"]   = $site."/views/site/principal.php";
		$_SESSION["LOGOUT"] = $site."/controle/logout.controller.php";		
		header('Location: ' .$_SESSION["SITE"]);
	}
	else
	{
		$_SESSION["erroLogin"] = "erro";
		header('Location: ' .$_SESSION["INDEX"]);
	}
?>
<!-- 
//<?php
//	session_start();
//	$_SESSION["INDEX"]  = "http://sgi-programasweb.rhcloud.com";
//	$login = $_POST["j_username"];
//  $senha = $_POST["j_password"];

    //fazer conexao aqui
//	if ($login == 'ricardo@gmail.com' && $senha == '123')
//	{
//		$_SESSION["NOME"]   = "Ricardo dos Santos Medeiros";
//		$_SESSION["SITE"]   = "http://sgi-programasweb.rhcloud.com/views/site/principal.php";
//		$_SESSION["LOGOUT"] = "http://sgi-programasweb.rhcloud.com/controle/logout.controller.php";
//		header('Location: ' .$_SESSION["SITE"]);
//	}
//	else
//	{
//		$_SESSION["erroLogin"] = "erro";
//		header('Location: ' .$_SESSION["INDEX"]);
//	}
//?>
 -->