<?php
	require_once(__ROOT__.'/modelo/proprietario.model.php');
	require_once(__ROOT__.'/modelo/endereco.model.php');
	require_once(__ROOT__.'/dao/daoProprietario.php');

	
	class Proprietario_Controle{	

		function salvarProprietario($proprietario)
		{
			 $cpf = $proprietario->cpf;
			 $daoProprietario = new daoProprietario();
			 $ok = $daoProprietario->salvarProprietario($proprietario); 
			 
			 $idProprietario = $daoProprietario->getProprietarioCPF($cpf);
			 $tipo   = base64_encode('UPD');
			 $codigo = base64_encode($idProprietario);
			 
			 if (!$ok)
			 {
				echo 'Erro ao Salvar Proprietario';
			 }
			 else 
			 {
				//echo 'Cliente Salvo com Sucesso';
			 	header("Location: ../views/site/cadProprietario.php?tipo=".$tipo."&idProprietario=".$codigo);
				//echo "<script language='JavaScript'> window.parent.document.getElementById('resultado').innerHTML = 'Cliente Salvo com Sucesso';</script>";
			 }
			 //header("Location:http://localhost:90/sgi/index.php"); //exemplo de redirecti
		}
		
		function salvarEndProprietario($idProprietario,$endereco)
		{			
			$daoProprietario = new daoProprietario();
			$ok =  false;
			if ($endereco->idEndereco > 0){
				$ok = $daoProprietario->alterarEndProprietario($endereco);					
			}
			else {				
				$idEndereco = $daoProprietario->salvarEndProprietario($endereco);	
				$proprietario = $daoProprietario->getProprietario($idProprietario);					
				$ok = $daoProprietario->alterarProprietario($proprietario,$idEndereco);							
			}			
			
			$tipo   = base64_encode('UPD');
			$codigo = base64_encode($idProprietario);
			if (!$ok)
			{
				echo 'Erro ao Alterar Proprietario';
			}
			else
			{
				//echo 'Cliente Salvo com Sucesso';
				//echo "<script language='JavaScript'> window.parent.document.getElementById('resultado').innerHTML = 'Cliente Salvo com Sucesso';</script>";
				header("Location: ../views/site/cadProprietario.php?tipo=".$tipo."&idProprietario=".$codigo);
			}
			
		}
		
		function listaProprietario(){
			$daoProprietario = new daoProprietario();
			$lista = $daoProprietario->listaProprietario(); 
			return $lista;
		}
		
		function getProprietario($idProprietario){
			$daoProprietario = new daoProprietario();
			$proprietario = $daoProprietario->getProprietario($idProprietario);
			return $proprietario;
		}
				
		function getEndProprietario($proprietario){
			$daoProprietario = new daoProprietario();
			$endereco = $daoProprietario->getEndProprietario($proprietario);
		
			return $endereco;
		}
				
		//function alterarCliente($cliente,$idEndereco){
		function alterarProprietario($proprietario,$idEndereco){
			$daoProprietario = new daoProprietario();
			$idProprietario = $proprietario->idProprietario;
			//$ok = $daoProprietario->alterarProprietario($proprietario,$idEndereco);
			$ok = $daoProprietario->alterarProprietario($proprietario,$idEndereco);
		
			$tipo   = base64_encode('UPD');
			$codigo = base64_encode($idProprietario);
			
			 if (!$ok)
			 {
				echo 'Erro ao Alterar Proprietario';
			 }
			 else 
			 {
				//echo 'Cliente Salvo com Sucesso';
				//echo "<script language='JavaScript'> window.parent.document.getElementById('resultado').innerHTML = 'Cliente Salvo com Sucesso';</script>";
			 	header("Location: ../views/site/cadProprietario.php?tipo=".$tipo."&idProprietario=".$codigo); 
			 }
		}
		
		function excluirProprietario($idProprietario){
			$daoProprietario = new daoProprietario();
			$ok = $daoProprietario->excluirProprietario($idProprietario);
			header("Location: ../views/site/proprietario.php");
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
