<?php 
	define('__ROOT__',dirname(dirname(__FILE__)));
	require_once(__ROOT__. '/modelo/usuario.model.php');
	require_once(__ROOT__.'/controle/usuario.controle.php');
	
	if(isset($_POST["salvar"]) == 'Salvar'){
		salvarUsuario();
	}

	if(isset($_POST["alterar"]) == 'Alterar'){
		alterarUsuario();
	}
	
	if(isset($_REQUEST["idUsuario"]) != '0' && isset($_REQUEST["tipo"]) == 'DLT')
	{
		$idUsuario = $_REQUEST["idUsuario"];
		excluirUsuario($idUsuario);
	}
	
	
	function salvarUsuario(){
		$usuario = new Usuario_Model();
		$usuario->nome = $_POST["nome"];
		$usuario->login= $_POST["login"];
		$usuario->cpf = $_POST["cpf"];
		$usuario->status = $_POST["status"];
		$usuario->senha = $_POST["senha"];
		$usuario->telefoneContato = $_POST["telefoneContato"];
		$usuario->caminhoLogo = $_POST["caminhoLogo"];
		
		$usuarioControle = new Usuario_Controle();
		$usuarioControle->salvarUsuario($usuario);
	}
	
	function alterarUsuario(){
		$usuario = new Usuario_Model();
		$usuario->idUsuario = $_POST["idUsuario"];
		$usuario->nome = $_POST["nome"];
		$usuario->login= $_POST["login"];
		$usuario->cpf = $_POST["cpf"];
		$usuario->status = $_POST["status"];
		$usuario->senha = $_POST["senha"];
		$usuario->telefoneContato = $_POST["telefoneContato"];
		$usuario->caminhoLogo = $_POST["caminhoLogo"];
		
		$usuarioControle = new Usuario_Controle();
		$usuarioControle->salvarUsuario($usuario);
	}
	
	function excluirUsuario($idUsuario){	
		$usuarioControle = new Usuario_Controle();
		$usuarioControle->excluirUsuario($idUsuario);
	}
?>
