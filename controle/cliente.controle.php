<?php
	//define('__ROOT__',dirname(dirname(dirname(__FILE__))));
	require_once(__ROOT__.'/modelo/cliente.model.php');
	require_once(__ROOT__.'/modelo/endereco.model.php');
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
			 $tipo   = base64_encode('UPD');
			 $codigo = base64_encode($idCliente);
			 
			 if (!$ok)
			 {
				echo 'Erro ao Salvar Cliente';
			 }
			 else 
			 {
				//echo 'Cliente Salvo com Sucesso';
			 	header("Location: ../views/site/cadCliente.php?tipo=".$tipo."&idCliente=".$codigo);
				//echo "<script language='JavaScript'> window.parent.document.getElementById('resultado').innerHTML = 'Cliente Salvo com Sucesso';</script>";
			 }
			 //header("Location:http://localhost:90/sgi/index.php"); //exemplo de redirecti
		}
		
		function salvarEndCliente($idCliente,$endereco)
		{			
			$daoCliente = new daoCliente();
			$ok =  false;
			if ($endereco->idEndereco > 0){
				$ok = $daoCliente->alterarEndCliente($endereco);					
			}
			else {				
				$idEndereco = $daoCliente->salvarEndCliente($endereco);	
				$cliente = $daoCliente->getCliente($idCliente);					
				$ok = $daoCliente->alterarCliente($cliente,$idEndereco);							
			}			
			
			$tipo   = base64_encode('UPD');
			$codigo = base64_encode($idCliente);
			if (!$ok)
			{
				echo 'Erro ao Alterar Cliente';
			}
			else
			{
				//echo 'Cliente Salvo com Sucesso';
				//echo "<script language='JavaScript'> window.parent.document.getElementById('resultado').innerHTML = 'Cliente Salvo com Sucesso';</script>";
				header("Location: ../views/site/cadCliente.php?tipo=".$tipo."&idCliente=".$codigo);
			}
			
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
		
		function getEndCliente($cliente){
			$daoCliente = new daoCliente();
			$endereco = $daoCliente->getEndCliente($cliente);
		
			return $endereco;
		}
		
		function alterarCliente($cliente,$idEndereco){
			$daoCliente = new daoCliente();
			$idCliente = $cliente->idCliente;
			$ok = $daoCliente->alterarCliente($cliente,$idEndereco);
		
			$tipo   = base64_encode('UPD');
			$codigo = base64_encode($idCliente);
			
			 if (!$ok)
			 {
				echo 'Erro ao Alterar Cliente';
			 }
			 else 
			 {
				//echo 'Cliente Salvo com Sucesso';
				//echo "<script language='JavaScript'> window.parent.document.getElementById('resultado').innerHTML = 'Cliente Salvo com Sucesso';</script>";
			 	header("Location: ../views/site/cadCliente.php?tipo=".$tipo."&idCliente=".$codigo); 
			 }
		}
		
		function excluirCliente($idCliente){
			$daoCliente = new daoCliente();
			$ok = $daoCliente->excluirCliente($idCliente);
			header("Location: ../views/site/cliente.php");
		}
		
		function getEstados(){
		  		   
		   $estados = array();
		   $estados["idEstado"]   = array('#','AC','AL','AP','AM','BA','CE','DF','ES','GO','MA','MS','MT','MG',
		   								'PA','PB','PR','PE','PI','RJ','RN','RS','RO','RR','SC','SP','SE','TO');
		   $estados["nomeEstado"] = array('Selecione','Acre','Alagoas','Amapa','Amazonas','Bahia','Ceara','Distrito Federal',
		   								'Espirito Santo','Goias','Maranhao','Mato Grosso do Sul','Mato Grosso','Minas Gerais','Para','Paraiba','Parana',
		   								'Pernambuco','Piaui','Rio de Janeiro','Rio Grande do Norte','Rio Grande do Sul','Rondonia','Roraima',
		   								'Santa Catarina','Sao Paulo','Sergipe','Tocantins');
		   return $estados;
		}
	}
?>
