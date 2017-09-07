<?php
	require_once(__ROOT__.'/modelo/imovel.model.php');
	require_once(__ROOT__.'/modelo/endereco.model.php');
	require_once(__ROOT__.'/modelo/proprietario.model.php');
	require_once(__ROOT__.'/dao/daoImovel.php');

	
	class Imovel_Controle{	

		function salvarImovel($imovel)
		{
			 //$cpf = $cliente->cpf;
			 $daoImovel = new daoImovel();
			 $idImovel = $daoImovel->salvarImovel($imovel); 
			 
			 //$idImovel = $daoCliente->getClienteCPF($cpf);
			 $tipo   = base64_encode('UPD');
			 $codigo = base64_encode($idImovel);
			 
			 if ($idImovel == 0)
			 {
				echo 'Erro ao Salvar Imovel';
			 }
			 else 
			 {
			 	header("Location: ../views/site/cadImovel.php?tipo=".$tipo."&idImovel=".$codigo);
				//echo "<script language='JavaScript'> window.parent.document.getElementById('resultado').innerHTML = 'Cliente Salvo com Sucesso';</script>";
			 }
		}
		
		function salvarEndImovel($idImovel,$idProprietario,$endereco)
		{			
			$daoImovel = new daoImovel();
			$ok =  false;
			if ($endereco->idEndereco > 0){
				$ok = $daoImovel->alterarEndImovel($endereco);					
			}
			else {				
				$idEndereco = $daoImovel->salvarEndImovel($endereco);	
				$imovel = $daoImovel->getImovel($idImovel);					
				$ok = $daoImovel->alterarImovel($imovel,$idEndereco,$idProprietario);							
			}			
			
			$tipo   = base64_encode('UPD');
			$codigo = base64_encode($idImovel);
			if (!$ok)
			{
				echo 'Erro ao Alterar Imovel';
			}
			else
			{
				//echo "<script language='JavaScript'> window.parent.document.getElementById('resultado').innerHTML = 'Cliente Salvo com Sucesso';</script>";
				header("Location: ../views/site/cadImovel.php?tipo=".$tipo."&idImovel=".$codigo);
			}
			
		}
		
		function salvarPropImovel($idImovel,$idEndereco,$proprietario)
		{			
			$daoImovel = new daoImovel();
			$ok =  false;
			if ($proprietario->idProprietario > 0){
				$ok = $daoImovel->alterarPropImovel($proprietario);
			}
			else {
				$idProprietario = $daoImovel->salvarPropImovel($proprietario);
				$imovel = $daoImovel->getImovel($idImovel);
				$ok = $daoImovel->alterarImovel($imovel,$idEndereco,$idProprietario);
			}
				
			$tipo   = base64_encode('UPD');
			$codigo = base64_encode($idImovel);
			if (!$ok)
			{
				echo 'Erro ao Alterar Imovel';
			}
			else
			{
				//echo "<script language='JavaScript'> window.parent.document.getElementById('resultado').innerHTML = 'Cliente Salvo com Sucesso';</script>";
				header("Location: ../views/site/cadImovel.php?tipo=".$tipo."&idImovel=".$codigo);
			}
				
		}		
		
		function listaImovel(){
			$daoImovel = new daoImovel();
			$lista = $daoImovel->listaImovel(); 
			return $lista;
		}
		
		function getImovel($idImovel){
			$daoImovel = new daoImovel();
			$imovel = $daoImovel->getImovel($idImovel);
			return $imovel;
		}
		
		function getEndImovel($imovel){
			$daoImovel = new daoImovel();
			$endereco = $daoImovel->getEndImovel($imovel);
		
			return $endereco;
		}
		
		function getPropImovel($imovel){
			$daoImovel = new daoImovel();
			$proprietario = $daoImovel->getPropImovel($imovel);
		
			return $proprietario;
		}
		
		function alterarImovel($imovel,$idEndereco,$idProprietario){
			$daoImovel = new daoImovel();
			$idImovel = $imovel->idImovel;
			$ok = $daoImovel->alterarImovel($imovel,$idEndereco,$idProprietario);
		
			$tipo   = base64_encode('UPD');
			$codigo = base64_encode($idImovel);
			
			 if (!$ok)
			 {
				echo 'Erro ao Alterar Imovel';
			 }
			 else 
			 {
				//echo "<script language='JavaScript'> window.parent.document.getElementById('resultado').innerHTML = 'Cliente Salvo com Sucesso';</script>";
 			 	header("Location: ../views/site/cadImovel.php?tipo=".$tipo."&idImovel=".$codigo); 
			 }
		}
		
		function excluirImovel($idImovel){
			$daoImovel = new daoImovel();
			$ok = $daoImovel->excluirImovel($idImovel);			
  			header("Location: ../views/site/imovel.php");
		}
		
		function listaProprietarios()
		{
			$daoImovel = new daoImovel();
			$listaProprietario = $daoImovel->listaProprietarios();
			return $listaProprietario;
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
		
		function getTipoImoveis(){
				
			$tiposImoveis = array();
			$tiposImoveis["idTipo"]   = array('','Casa','Apartamento','Quitinete','Sobrado','Outros');
			$tiposImoveis["nomeTipo"] = array('Selecione','Casa','Apartamento','Quitinete','Sobrado','Outros');
			return $tiposImoveis;
		}		
	}
?>
