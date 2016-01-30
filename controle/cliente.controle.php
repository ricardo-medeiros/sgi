<?php
	//define('__ROOT__',dirname(dirname(dirname(__FILE__))));
	require_once(__ROOT__.'/modelo/cliente.model.php');
	//require_once "../modelo/cliente.model.php";
	require_once(__ROOT__.'/dao/daoCliente.php');
    //require_once '../dao/daoCliente.php';

	class Cliente_Controle{	

		function salvarCliente($cliente)
		{
			 $cpf = $cliente->cpf;
			 $daoCliente = new daoCliente();
			 $ok = $daoCliente->salvarCliente($cliente); 
			 
			 $idCliente = $daoCliente->getClienteCPF($cpf);
			 
			 if (!$ok)
			 {
				echo 'Erro ao Salvar Cliente';
			 }
			 else 
			 {
				//echo 'Cliente Salvo com Sucesso';
			 	header("Location: ../views/site/cadCliente.php?tipo=UPD&idCliente=".$idCliente);
				//echo "<script language='JavaScript'> window.parent.document.getElementById('resultado').innerHTML = 'Cliente Salvo com Sucesso';</script>";
			 }
			 //header("Location:http://localhost:90/sgi/index.php"); //exemplo de redirecti
		}
		
		function listaCliente(){
			$daoCliente = new daoCliente();
			$lista = $daoCliente->listaCliente(); 

			return $lista;
		}
		
		function getCliente($idCliente){
			$daoCliente = new daoCliente();
			$cliente = $daoCliente->getCliente($idCliente);
		
			return $cliente;
		}
		
		function alterarCliente($cliente){
			$daoCliente = new daoCliente();
			$idCliente = $cliente->idCliente;
			$ok = $daoCliente->alterarCliente($cliente);
		
			 if (!$ok)
			 {
				echo 'Erro ao Alterar Cliente';
			 }
			 else 
			 {
				//echo 'Cliente Salvo com Sucesso';
				//echo "<script language='JavaScript'> window.parent.document.getElementById('resultado').innerHTML = 'Cliente Salvo com Sucesso';</script>";
			 	header("Location: ../views/site/cadCliente.php?tipo=UPD&idCliente=".$idCliente); 
			 }
		}
		
		function excluirCliente($idCliente){
			$daoCliente = new daoCliente();
			$ok = $daoCliente->excluirCliente($idCliente);
			header("Location: ../views/site/cliente.php");
		}
	}
?>
