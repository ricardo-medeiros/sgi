<?php 
	define('__ROOT__',dirname(dirname(__FILE__)));
	require_once(__ROOT__. '/modelo/cliente.model.php');
	require_once(__ROOT__.'/controle/cliente.controle.php');
	
	if($_POST["salvar"] == 'Salvar'){
		salvarCliente();
	}
	
	function salvarCliente(){
		$cliente = new Cliente_Model();
		$cliente->nome = $_POST["nome"];
		$cliente->email= $_POST["emailCliente"];
		
		$clienteControle = new Cliente_Controle();
		$clienteControle->salvarCliente($cliente);
	}
?>
