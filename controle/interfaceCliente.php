<?php 
	define('__ROOT__',dirname(dirname(__FILE__)));
	require_once(__ROOT__. '/modelo/cliente.model.php');
	require_once(__ROOT__.'/controle/cliente.controle.php');
	
	if(isset($_POST["salvar"]) == 'Salvar'){
		salvarCliente();
	}

	if(isset($_POST["alterar"]) == 'Alterar'){
		alterarCliente();
	}
	
	if(isset($_REQUEST["idCliente"]) != '0' && isset($_REQUEST["tipo"]) == 'DLT')
	{
		$idCliente = $_REQUEST["idCliente"];
		excluirCliente($idCliente);
	}
	
	
	function salvarCliente(){
		$cliente = new Cliente_Model();
		$cliente->nome = $_POST["nome"];
		$cliente->email= $_POST["emailCliente"];
		$cliente->cpf = $_POST["cpf"];
		$cliente->status = $_POST["status"];
		$cliente->rg = $_POST["rg"];
		$cliente->telefoneCelular = $_POST["telefoneCelular"];
		$cliente->dataNascimento = $_POST["dataNascimento"];
		
		$clienteControle = new Cliente_Controle();
		$clienteControle->salvarCliente($cliente);
	}
	
	function alterarCliente(){
		$cliente = new Cliente_Model();
		$cliente->idCliente = $_POST["idCliente"];
		$cliente->nome = $_POST["nome"];
		$cliente->email= $_POST["emailCliente"];
		$cliente->cpf = $_POST["cpf"];
		$cliente->status = $_POST["status"];
		$cliente->rg = $_POST["rg"];
		$cliente->telefoneCelular = $_POST["telefoneCelular"];
		$cliente->dataNascimento = $_POST["dataNascimento"];		
	
		$clienteControle = new Cliente_Controle();
		$clienteControle->alterarCliente($cliente);
	}
	
	function excluirCliente($idCliente){	
		$clienteControle = new Cliente_Controle();
		$clienteControle->excluirCliente($idCliente);
	}
?>
