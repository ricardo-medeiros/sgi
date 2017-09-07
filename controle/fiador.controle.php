<?php
	require_once(__ROOT__.'/modelo/fiador.model.php');
	require_once(__ROOT__.'/modelo/endereco.model.php');
	require_once(__ROOT__.'/dao/daoFiador.php');

	
	class Fiador_Controle{	

		function salvarFiador($fiador)
		{
			 $cpf = $fiador->cpf;
			 $daoFiador = new daoFiador();
			 $ok = $daoFiador->salvarFiador($fiador); 
			 
			 $idFiador = $daoFiador->getFiadorCPF($cpf);
			 $tipo   = base64_encode('UPD');
			 $codigo = base64_encode($idFiador);
			 
			 if (!$ok)
			 {
				echo 'Erro ao Salvar Fiador';
			 }
			 else 
			 {
			 	header("Location: ../views/site/cadFiador.php?tipo=".$tipo."&idFiador=".$codigo);
				//echo "<script language='JavaScript'> window.parent.document.getElementById('resultado').innerHTML = 'Cliente Salvo com Sucesso';</script>";
			 }
			 //header("Location:http://localhost:90/sgi/index.php"); //exemplo de redirecti
		}
		
		function salvarEndFiador($idFiador,$endereco)
		{			
			$daoFiador = new daoFiador();
			$ok =  false;
			if ($endereco->idEndereco > 0){
				$ok = $daoFiador->alterarEndFiador($endereco);					
			}
			else {				
				$idEndereco = $daoFiador->salvarEndFiador($endereco);	
				$fiador = $daoFiador->getFiador($idFiador);					
				$ok = $daoFiador->alterarFiador($fiador,$idEndereco);							
			}			
			
			$tipo   = base64_encode('UPD');
			$codigo = base64_encode($idFiador);
			if (!$ok)
			{
				echo 'Erro ao Alterar Fiador';
			}
			else
			{
				//echo 'Cliente Salvo com Sucesso';
				//echo "<script language='JavaScript'> window.parent.document.getElementById('resultado').innerHTML = 'Cliente Salvo com Sucesso';</script>";
				header("Location: ../views/site/cadFiador.php?tipo=".$tipo."&idFiador=".$codigo);
			}
			
		}
		
		function listaFiador(){
			$daoFiador = new daoFiador();
			$lista = $daoFiador->listaFiador(); 
			return $lista;
		}
		
		function getFiador($idFiador){
			$daoFiador = new daoFiador();
			$fiador = $daoFiador->getFiador($idFiador);
			return $fiador;
		}
				
		function getEndFiador($fiador){
			$daoFiador = new daoFiador();
			$endereco = $daoFiador->getEndFiador($fiador);
		
			return $endereco;
		}
				
		function alterarFiador($fiador,$idEndereco){
			$daoFiador = new daoFiador();
			$idFiador = $fiador->idFiador;
			$ok = $daoFiador->alterarFiador($fiador,$idEndereco);
		
			$tipo   = base64_encode('UPD');
			$codigo = base64_encode($idFiador);
			
			 if (!$ok)
			 {
				echo 'Erro ao Alterar Fiador';
			 }
			 else 
			 {
				//echo "<script language='JavaScript'> window.parent.document.getElementById('resultado').innerHTML = 'Cliente Salvo com Sucesso';</script>";
			 	header("Location: ../views/site/cadFiador.php?tipo=".$tipo."&idFiador=".$codigo); 
			 }
		}
		
		function excluirFiador($idFiador){
			$daoFiador = new daoFiador();
			$ok = $daoFiador->excluirFiador($idFiador);
			header("Location: ../views/site/fiador.php");
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
