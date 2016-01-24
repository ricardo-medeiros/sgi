<?php 
	require_once "../modelo/cliente.model.php";
	require_once "../dao/dao.php";
		
	
	if ($_POST["salvar"] == 'Salvar')
	{
		salvar();
	}
	else 
	{
		echo 'Erro ao Salvar';
	}
	
	function salvar(){
		$cliente = new Cliente_Model();
		$cliente->nome = $_POST["nome"];
		$cliente->email = $_POST["email"];
		echo 'Salvo com Sucesso';
		//header("Location:http://localhost:90/sgi/index.php"); //exemplo de redirecti
	}
?>