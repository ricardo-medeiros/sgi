<?php
	require_once(__ROOT__.'/modelo/contrato.model.php');
	require_once(__ROOT__.'/modelo/cliente.model.php');
	require_once(__ROOT__.'/modelo/imovel.model.php');
	require_once(__ROOT__.'/dao/daoContrato.php');

	
	class Contrato_Controle{	

		function salvarContrato($contrato,$idImovel,$idCliente)
		{
			 $daoContrato = new daoContrato();
			 $idContrato = $daoContrato->salvarContrato($contrato,$idImovel,$idCliente); 

			 $tipo   = base64_encode('UPD');
			 $codigo = base64_encode($idContrato);
			 
			 if ($idContrato == 0)
			 {
				echo 'Erro ao Salvar Contrato';
			 }
			 else 
			 {
			 	header("Location: ../views/site/cadContrato.php?tipo=".$tipo."&idContrato=".$codigo);
				//echo "<script language='JavaScript'> window.parent.document.getElementById('resultado').innerHTML = 'Cliente Salvo com Sucesso';</script>";
			 }
		}
		
		function novoContrato($contrato)
		{
			$date = date('Y-m-d');
			$contrato->tipo     = "L";
			$contrato->situacao = "V";
			$contrato->dataContrato = $date;
			$contrato->observacao =  "";
			$contrato->dataVigencia   = "0001-01-01";
			$contrato->dataInicial    = "0001-01-01";
			$contrato->dataFinal      = "0001-01-01";
			$contrato->dataEntrada    = "0001-01-01";
			$contrato->dataReajuste   = "0001-01-01";
			$contrato->diaVencimento  = "0";
			$contrato->cpfTest1       = "";
			$contrato->nomeTest1      = "";
			$contrato->cpfTest2       = "";
			$contrato->nomeTest2      = "";
			$contrato->multaAtraso    = "0.00";
			$contrato->diasAtraso     = "0";
			$contrato->multaMora      = "0.00";
			$contrato->diasMora       = "0";
			$contrato->comissaoCorretor = "0.00";
			$contrato->valorProp      = "0.00";
			$contrato->percReaj       = "0.00";
			$contrato->valorContrato  = "0.00";
			$idImovel = 0;
			$idCliente = 0;
			
			$daoContrato = new daoContrato();		
			$idContrato = $daoContrato->salvarContrato($contrato,$idImovel,$idCliente);
		
			$tipo   = base64_encode('UPD');
			$codigo = base64_encode($idContrato);
		
			if ($idContrato == 0)
			{
				echo 'Erro ao Salvar Contrato';
			}
			else
			{
				//localhost
				$local = "http://".$_SERVER["HTTP_HOST"]."/views/site/cadContrato.php?tipo=".$tipo."&idContrato=".$codigo;
				//servidor de produção
				//$local = "http://".$_SERVER["HTTP_HOST"]."/views/site/cadContrato.php?tipo=".$tipo."&idContrato=".$codigo;
				header("Location:" .$local);
			}
		}
		
		function listaContrato(){
			$daoContrato = new daoContrato();
			$lista = $daoContrato->listaContrato(); 
			return $lista;
		}
		
		function listaImoveis(){
			$daoContrato = new daoContrato();
			$lista = $daoContrato->listaImovel();
			return $lista;
		}
		
		function listaClientes(){
			$daoContrato = new daoContrato();
			$lista = $daoContrato->listaCliente();
			return $lista;
		}
		
		function listaFiadores(){
			$daoContrato = new daoContrato();
			$lista = $daoContrato->listaFiador();
			return $lista;
		}
		
		function listaFiadoresContrato($idContrato){
			$lista = new ArrayObject();
			if ($idContrato > 0)
			{
				$daoContrato = new daoContrato();
				$lista = $daoContrato->listaFiadorContrato($idContrato);
				return $lista;
			}		
			else {
				return $lista;
			}
			
		}
		
		function getCliente($idCliente){
			$cliente = new Cliente_Model();
			if ($idCliente > 0)
			{
				$daoContrato = new daoContrato();
				$cliente = $daoContrato->getCliente($idCliente);
			}
			return $cliente;
		}
		
		function getImovel($idImovel){
			$imovel = new Imovel_Model();
			if ($idImovel > 0){
				$daoContrato = new daoContrato();
				$imovel = $daoContrato->getImovel($idImovel);
			}
			return $imovel;
		}
		
		function getContrato($idContrato){
			if($idContrato > 0)
			{
				$daoContrato = new daoContrato();
				$contrato = $daoContrato->getContrato($idContrato);
			}
			else {
				$contrato = new Contrato_Model();
				$date = date("Y-m-d");
				$contrato->dataContrato = $date;
			}
			return $contrato;
		}
		
		function alterarContrato($contrato,$idCliente,$idImovel){
			$daoContrato = new daoContrato();
			$idContrato = $contrato->idContrato;
			$ok = $daoContrato->alterarContrato($contrato,$idCliente,$idImovel);
		
			$tipo   = base64_encode('UPD');
			$codigo = base64_encode($idContrato);
			
			 if (!$ok)
			 {
				echo 'Erro ao Alterar Contrato';
			 }
			 else 
			 {
				//echo "<script language='JavaScript'> window.parent.document.getElementById('resultado').innerHTML = 'Cliente Salvo com Sucesso';</script>";
 			 	header("Location: ../views/site/cadContrato.php?tipo=".$tipo."&idContrato=".$codigo); 
			 }
		}
		
		function excluirContrato($idContrato){
			$daoContrato = new daoContrato();
			$ok = $daoContrato->excluirContrato($idContrato);			
  			header("Location: ../views/site/contrato.php");
		}
				
		function salvarFiadorContrato($idContrato,$idFiador){
			$daoContrato = new daoContrato();
			$ok = $daoContrato->salvarFiadorContrato($idContrato,$idFiador);
			
			$tipo   = base64_encode('UPD');
			$codigo = base64_encode($idContrato);
				
			if (!$ok)
			{
				echo 'Erro ao Alterar Contrato';
			}
			else
			{
				header("Location: ../views/site/cadContrato.php?tipo=".$tipo."&idContrato=".$codigo);
			}
		}
		
		function excluirFiadorContrato($idContrato,$idFiador){
			$daoContrato = new daoContrato();
			$ok = $daoContrato->excluirFiadorContrato($idContrato,$idFiador);
				
			$tipo   = base64_encode('UPD');
			$codigo = base64_encode($idContrato);
		
			if (!$ok)
			{
				echo 'Erro ao Alterar Contrato';
			}
			else
			{
				header("Location: ../views/site/cadContrato.php?tipo=".$tipo."&idContrato=".$codigo);
			}
		}
		
		function salvarHTML($contrato,$html){
			$daoContrato = new daoContrato();
			$daoContrato->guardarHTML($contrato, $html);
			echo '<script type="text/javascript">';
			echo 'function Fechar(){';
			echo 'window.top.location.href = "../views/site/contrato.php";}';
			echo '</script>';
					
			echo '<link rel="stylesheet"	href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">';
			echo "<h4 style='color:red; text-align:center; font-weight: bold;'>Documento de Contrato Atualizado!</h4>";
			echo '<center><button type="button" id="voltar" name="voltar" class="btn btn-success" value="Voltar" onClick="Fechar()">Fechar</button></center>';
		}
		
 		function getTipoImoveis(){
				
 			$tiposImoveis = array();
 			$tiposImoveis["idTipo"]   = array('','Casa','Apartamento','Quitinete','Sobrado','Outros');
 			$tiposImoveis["nomeTipo"] = array('Selecione','Casa','Apartamento','Quitinete','Sobrado','Outros');
 			return $tiposImoveis;
 		}		
	}
?>
